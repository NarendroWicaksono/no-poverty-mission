<?php
namespace App\Models;

use PDO;

class SertifikatModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public static function formatBaris(array $row, bool $sertakanEmail = false): array {
        $data = [
            'nomor_sertifikat' => $row['nomor_sertifikat'],
            'nama_peserta' => $row['nama_peserta'],
            'nama_kursus' => $row['nama_kursus'],
            'kursus_slug' => $row['kursus_slug'],
            'tanggal_terbit' => $row['tanggal_terbit'],
            'nilai_kuis' => isset($row['nilai_kuis']) ? (float)$row['nilai_kuis'] : 90,
            'penyelenggara_nama' => $row['penandatangan_nama'] ?? 'Dr. Ir. Hendra Gunawan, M.T.',
            'penyelenggara_jabatan' => $row['penandatangan_jabatan'] ?? 'Direktur Pembina Skill4Life',
            'kode_verifikasi' => $row['kode_verifikasi'],
            'status' => 'Terdaftar sah',
        ];
        if ($sertakanEmail) {
            $data['email'] = $row['email'] ?? '';
        }
        return $data;
    }

    public function terbitkanAtauPerbarui(int $penggunaId, int $kursusId, float $nilai): string {
        $stmtCek = $this->pdo->prepare("SELECT * FROM sertifikat WHERE pengguna_id = ? AND kursus_id = ? LIMIT 1");
        $stmtCek->execute([$penggunaId, $kursusId]);
        $sudah = $stmtCek->fetch();

        if ($sudah) {
            if ($nilai > (float)($sudah['nilai_kuis'] ?? 0)) {
                $this->pdo->prepare("UPDATE sertifikat SET nilai_kuis = ? WHERE id = ?")
                    ->execute([$nilai, $sudah['id']]);
            }
            return $sudah['nomor_sertifikat'];
        }

        $tahun = date('Y');
        $last = $this->pdo->prepare("SELECT nomor_sertifikat FROM sertifikat WHERE nomor_sertifikat LIKE ? ORDER BY nomor_sertifikat DESC LIMIT 1");
        $last->execute(["S4L-{$tahun}-%"]);
        $lastNomor = $last->fetchColumn();
        if ($lastNomor) {
            $parts = explode('-', $lastNomor);
            $urut = (int)end($parts) + 1;
        } else {
            $urut = 123;
        }
        $nomorSertifikat = sprintf('S4L-%s-%06d', $tahun, $urut);
        $kodeVerifikasi = bin2hex(random_bytes(32));

        $stmtSert = $this->pdo->prepare("
            INSERT INTO sertifikat (nomor_sertifikat, pengguna_id, kursus_id, tanggal_terbit, nilai_kuis, kode_verifikasi)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmtSert->execute([
            $nomorSertifikat,
            $penggunaId,
            $kursusId,
            date('Y-m-d'),
            $nilai,
            $kodeVerifikasi,
        ]);

        return $nomorSertifikat;
    }

    public function ambilSemua(): array {
        $rows = $this->pdo->query("
            SELECT s.*, p.nama_lengkap AS nama_peserta, p.email, k.judul AS nama_kursus, k.slug AS kursus_slug
            FROM sertifikat s
            JOIN pengguna p ON s.pengguna_id = p.id
            JOIN kursus k ON s.kursus_id = k.id
            ORDER BY s.id DESC
        ")->fetchAll();

        return array_map(fn($r) => self::formatBaris($r, true), $rows);
    }

    public function ambilContohNomor(int $limit = 4): array {
        $stmt = $this->pdo->prepare("SELECT nomor_sertifikat FROM sertifikat ORDER BY id DESC LIMIT ?");
        $stmt->bindValue(1, max(1, min(10, $limit)), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function ambilBerdasarkanNomor(string $nomor): ?array {
        $stmt = $this->pdo->prepare("
            SELECT s.*, p.nama_lengkap AS nama_peserta, k.judul AS nama_kursus, k.slug AS kursus_slug
            FROM sertifikat s
            JOIN pengguna p ON s.pengguna_id = p.id
            JOIN kursus k ON s.kursus_id = k.id
            WHERE LOWER(s.nomor_sertifikat) = LOWER(?)
            LIMIT 1
        ");
        $stmt->execute([trim($nomor)]);
        $row = $stmt->fetch();
        return $row ? self::formatBaris($row, false) : null;
    }

    public function ambilBerdasarkanPengguna(int $penggunaId): array {
        $stmt = $this->pdo->prepare("
            SELECT s.*, p.nama_lengkap AS nama_peserta, p.email, k.judul AS nama_kursus, k.slug AS kursus_slug
            FROM sertifikat s
            JOIN pengguna p ON s.pengguna_id = p.id
            JOIN kursus k ON s.kursus_id = k.id
            WHERE s.pengguna_id = ?
            ORDER BY s.id DESC
        ");
        $stmt->execute([$penggunaId]);
        $rows = $stmt->fetchAll();

        return array_map(fn($r) => self::formatBaris($r, true), $rows);
    }
}
