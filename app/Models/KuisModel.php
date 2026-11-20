<?php
namespace App\Models;

use PDO;

class KuisModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function ambilBerdasarkanKursus(string $slugKursus, bool $sertakanKunci = false): array {
        $stmt = $this->pdo->prepare("
            SELECT q.*, k.slug AS kursus_slug
            FROM soal_kuis q
            JOIN kursus k ON q.kursus_id = k.id
            WHERE k.slug = ?
            ORDER BY q.urutan ASC, q.id ASC
        ");
        $stmt->execute([$slugKursus]);
        $rows = $stmt->fetchAll();

        return array_map(function ($r) use ($sertakanKunci) {
            $item = [
                'id' => (int)$r['id'],
                'kursus_id' => (int)$r['kursus_id'],
                'kursus_slug' => $r['kursus_slug'],
                'urutan' => (int)$r['urutan'],
                'pertanyaan' => $r['pertanyaan'],
                'pilihan' => [
                    'A' => $r['pilihan_a'],
                    'B' => $r['pilihan_b'],
                    'C' => $r['pilihan_c'],
                    'D' => $r['pilihan_d'],
                ],
            ];
            if ($sertakanKunci) {
                $item['jawaban_benar'] = $r['jawaban_benar'];
                $item['pembahasan'] = $r['pembahasan'] ?? '';
            }
            return $item;
        }, $rows);
    }

    public function evaluasiDanSimpan(
        string $slugKursus,
        array $lembarJawaban,
        ?array $sesiUser,
        SertifikatModel $sertifikatModel,
        ModulModel $modulModel
    ): array {
        $stmtK = $this->pdo->prepare("SELECT id, judul FROM kursus WHERE slug = ? LIMIT 1");
        $stmtK->execute([$slugKursus]);
        $kursusRow = $stmtK->fetch();

        if (!$kursusRow) {
            return ['ok' => false, 'pesan' => 'Kursus tidak ditemukan.'];
        }

        $stmtQ = $this->pdo->prepare("SELECT * FROM soal_kuis WHERE kursus_id = ? ORDER BY urutan ASC, id ASC");
        $stmtQ->execute([$kursusRow['id']]);
        $soalRows = $stmtQ->fetchAll();

        $benar = 0;
        $evaluasi = [];
        foreach ($soalRows as $idx => $s) {
            $pilihan = [
                'A' => $s['pilihan_a'],
                'B' => $s['pilihan_b'],
                'C' => $s['pilihan_c'],
                'D' => $s['pilihan_d'],
            ];
            $sid = (string)$s['id'];
            $jawabanPeserta = $lembarJawaban[$sid] ?? ($lembarJawaban[(int)$sid] ?? null);
            $isBenar = $jawabanPeserta === $s['jawaban_benar'];
            if ($isBenar) {
                $benar++;
            }
            $evaluasi[] = [
                'nomor' => $idx + 1,
                'id_soal' => (int)$s['id'],
                'pertanyaan' => $s['pertanyaan'],
                'pilihan' => $pilihan,
                'jawaban_peserta' => $jawabanPeserta,
                'teks_jawaban_peserta' => ($jawabanPeserta && isset($pilihan[$jawabanPeserta])) ? $pilihan[$jawabanPeserta] : 'Tidak dijawab',
                'kunci_benar' => $s['jawaban_benar'],
                'teks_kunci_benar' => $pilihan[$s['jawaban_benar']] ?? '',
                'is_benar' => $isBenar,
                'pembahasan' => $s['pembahasan'] ?? '',
            ];
        }

        $totalSoal = count($soalRows);
        $nilai = $totalSoal > 0 ? (int)round(($benar / $totalSoal) * 100) : 0;
        $isLulus = $nilai >= 70;
        $nomorSertifikat = null;

        if ($sesiUser && isset($sesiUser['id'])) {
            $uid = (int)$sesiUser['id'];
            $kid = (int)$kursusRow['id'];

            $stmtHasil = $this->pdo->prepare("
                INSERT INTO hasil_kuis (pengguna_id, kursus_id, total_soal, jawaban_benar, nilai, status_lulus)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmtHasil->execute([
                $uid,
                $kid,
                $totalSoal,
                $benar,
                $nilai,
                $isLulus ? 'Lulus' : 'Tidak Lulus',
            ]);

            if ($isLulus) {
                // Pastikan seluruh modul kursus ditandai selesai saat lulus kuis
                $modulModel->tandaiSemuaSelesai($uid, $kid);
                $nomorSertifikat = $sertifikatModel->terbitkanAtauPerbarui($uid, $kid, (float)$nilai);
            }
        }

        return [
            'ok' => true,
            'nilai' => $nilai,
            'jawaban_benar' => $benar,
            'total_soal' => $totalSoal,
            'lulus' => $isLulus,
            'nomor_sertifikat' => $nomorSertifikat,
            'evaluasi' => $evaluasi,
        ];
    }

    public function tambah(array $in): int {
        $slug = trim($in['kursus_slug'] ?? '');
        $stmtK = $this->pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
        $stmtK->execute([$slug]);
        $kursusId = (int)$stmtK->fetchColumn();
        if (!$kursusId) {
            throw new \InvalidArgumentException('Kursus tidak ditemukan untuk slug yang diberikan.');
        }

        $pertanyaan = trim($in['pertanyaan'] ?? '');
        $opsiA = trim($in['opsi_a'] ?? '');
        $opsiB = trim($in['opsi_b'] ?? '');
        $opsiC = trim($in['opsi_c'] ?? '');
        $opsiD = trim($in['opsi_d'] ?? '');
        $kunci = strtoupper(trim($in['jawaban_benar'] ?? ''));

        if ($pertanyaan === '' || $opsiA === '' || $opsiB === '' || $opsiC === '' || $opsiD === '') {
            throw new \InvalidArgumentException('Pertanyaan dan seluruh pilihan jawaban (A-D) wajib diisi.');
        }
        if (!in_array($kunci, ['A', 'B', 'C', 'D'], true)) {
            throw new \InvalidArgumentException('Kunci jawaban harus salah satu dari A, B, C, atau D.');
        }

        $stmtCount = $this->pdo->prepare("SELECT COUNT(*) FROM soal_kuis WHERE kursus_id = ?");
        $stmtCount->execute([$kursusId]);
        $urutan = (int)$stmtCount->fetchColumn() + 1;

        $stmt = $this->pdo->prepare("
            INSERT INTO soal_kuis (kursus_id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, pembahasan, urutan)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $kursusId,
            $pertanyaan,
            $opsiA,
            $opsiB,
            $opsiC,
            $opsiD,
            $kunci,
            trim($in['pembahasan'] ?? ''),
            $urutan,
        ]);

        return (int)$this->pdo->lastInsertId();
    }

    public function ubah(int $idSoal, array $in): bool {
        if ($idSoal <= 0) {
            throw new \InvalidArgumentException('ID soal tidak valid.');
        }
        $pertanyaan = trim($in['pertanyaan'] ?? '');
        $opsiA = trim($in['opsi_a'] ?? '');
        $opsiB = trim($in['opsi_b'] ?? '');
        $opsiC = trim($in['opsi_c'] ?? '');
        $opsiD = trim($in['opsi_d'] ?? '');
        $kunci = strtoupper(trim($in['jawaban_benar'] ?? ''));

        if ($pertanyaan === '' || $opsiA === '' || $opsiB === '' || $opsiC === '' || $opsiD === '') {
            throw new \InvalidArgumentException('Pertanyaan dan seluruh pilihan jawaban (A-D) wajib diisi.');
        }
        if (!in_array($kunci, ['A', 'B', 'C', 'D'], true)) {
            throw new \InvalidArgumentException('Kunci jawaban harus salah satu dari A, B, C, atau D.');
        }

        $stmt = $this->pdo->prepare("
            UPDATE soal_kuis
            SET pertanyaan = ?, pilihan_a = ?, pilihan_b = ?, pilihan_c = ?, pilihan_d = ?, jawaban_benar = ?, pembahasan = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $pertanyaan,
            $opsiA,
            $opsiB,
            $opsiC,
            $opsiD,
            $kunci,
            trim($in['pembahasan'] ?? ''),
            $idSoal,
        ]);
    }

    public function hapus(int $idSoal): bool {
        $stmt = $this->pdo->prepare("DELETE FROM soal_kuis WHERE id = ?");
        return $stmt->execute([$idSoal]);
    }
}
