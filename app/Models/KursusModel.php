<?php
namespace App\Models;

use PDO;

class KursusModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public static function formatBaris(array $row): array {
        $tujuan = array_values(array_filter(array_map('trim', explode("\n", $row['tujuan_belajar'] ?? ''))));
        return [
            'id_kursus' => (int)$row['id'],
            'judul' => $row['judul'],
            'slug' => $row['slug'],
            'kategori' => $row['nama_kategori'],
            'kategori_slug' => $row['kategori_slug'],
            'level' => $row['tingkat_kesulitan'],
            'estimasi_waktu' => $row['estimasi_waktu'],
            'jumlah_modul' => (int)($row['jumlah_modul'] ?? 0),
            'ringkasan' => $row['ringkasan'],
            'deskripsi' => $row['deskripsi'],
            'tujuan_belajar' => $tujuan,
            'populer' => (bool)$row['populer'],
        ];
    }

    public function ambilStatistik(): array {
        $kursus = (int)$this->pdo->query("SELECT COUNT(*) FROM kursus WHERE diterbitkan = 1")->fetchColumn();
        $modul = (int)$this->pdo->query("SELECT COUNT(*) FROM modul")->fetchColumn();
        $sertifikat = (int)$this->pdo->query("SELECT COUNT(*) FROM sertifikat")->fetchColumn();
        $peserta = (int)$this->pdo->query("SELECT COUNT(*) FROM pengguna WHERE peran = 'peserta'")->fetchColumn();

        // Hitung kursus terpopuler berdasarkan aktivitas nyata (progres modul + sertifikat)
        $popRows = $this->pdo->query("
            SELECT k.judul, k.slug,
                   (SELECT COUNT(DISTINCT pm.pengguna_id) FROM progres_modul pm WHERE pm.kursus_id = k.id) +
                   (SELECT COUNT(DISTINCT s.pengguna_id) FROM sertifikat s WHERE s.kursus_id = k.id) AS peserta_aktif,
                   (SELECT COUNT(*) FROM modul m WHERE m.kursus_id = k.id) AS total_modul
            FROM kursus k
            WHERE k.diterbitkan = 1
            ORDER BY peserta_aktif DESC, k.populer DESC, k.id ASC
            LIMIT 4
        ")->fetchAll();

        // Hitung tren 6 bulan terakhir secara nyata dari tabel pengguna & sertifikat
        $trenBulanan = [];
        $namaBulan = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];
        for ($i = 5; $i >= 0; $i--) {
            $ts = strtotime("-{$i} months");
            $ym = date('Y-m', $ts);
            $blnIdx = (int)date('n', $ts);

            $stmtP = $this->pdo->prepare("SELECT COUNT(*) FROM pengguna WHERE peran = 'peserta' AND DATE_FORMAT(dibuat_pada, '%Y-%m') = ?");
            $stmtP->execute([$ym]);
            $jmlPeserta = (int)$stmtP->fetchColumn();

            $stmtS = $this->pdo->prepare("SELECT COUNT(*) FROM sertifikat WHERE DATE_FORMAT(tanggal_terbit, '%Y-%m') = ?");
            $stmtS->execute([$ym]);
            $jmlLulus = (int)$stmtS->fetchColumn();

            $trenBulanan[] = [
                'periode' => $ym,
                'label' => $namaBulan[$blnIdx] . ' ' . date('Y', $ts),
                'peserta' => $jmlPeserta,
                'lulus' => $jmlLulus,
            ];
        }

        return [
            'total_kursus' => $kursus,
            'total_modul' => $modul,
            'total_sertifikat' => $sertifikat,
            'total_peserta' => $peserta,
            'mitra_komunitas' => 32,
            'tren_bulanan' => $trenBulanan,
            'kursus_populer' => array_map(fn($r) => [
                'judul' => $r['judul'],
                'slug' => $r['slug'],
                'peserta_aktif' => (int)$r['peserta_aktif'],
                'total_modul' => (int)$r['total_modul'],
            ], $popRows),
        ];
    }

    public function ambilSemua(): array {
        $rows = $this->pdo->query("
            SELECT k.*, kat.nama_kategori, kat.slug AS kategori_slug,
                   (SELECT COUNT(*) FROM modul m WHERE m.kursus_id = k.id) AS jumlah_modul
            FROM kursus k
            JOIN kategori kat ON k.kategori_id = kat.id
            WHERE k.diterbitkan = 1
            ORDER BY k.id ASC
        ")->fetchAll();

        return array_map([self::class, 'formatBaris'], $rows);
    }

    public function ambilDetail(string $slugAtauId): ?array {
        $stmt = $this->pdo->prepare("
            SELECT k.*, kat.nama_kategori, kat.slug AS kategori_slug,
                   (SELECT COUNT(*) FROM modul m WHERE m.kursus_id = k.id) AS jumlah_modul
            FROM kursus k
            JOIN kategori kat ON k.kategori_id = kat.id
            WHERE (k.slug = ? OR CAST(k.id AS CHAR) = ?) AND k.diterbitkan = 1
            LIMIT 1
        ");
        $stmt->execute([$slugAtauId, $slugAtauId]);
        $row = $stmt->fetch();
        return $row ? self::formatBaris($row) : null;
    }

    public function ambilRingkasanPeserta(int $penggunaId): array {
        $stmt = $this->pdo->prepare("
            SELECT k.id AS id_kursus, k.judul, k.slug, kat.nama_kategori AS kategori, k.tingkat_kesulitan AS level,
                   (SELECT COUNT(*) FROM modul m WHERE m.kursus_id = k.id) AS total_modul,
                   (SELECT COUNT(*) FROM progres_modul pm WHERE pm.kursus_id = k.id AND pm.pengguna_id = ?) AS modul_selesai,
                   s.nomor_sertifikat, s.nilai_kuis
            FROM kursus k
            JOIN kategori kat ON k.kategori_id = kat.id
            LEFT JOIN sertifikat s ON s.kursus_id = k.id AND s.pengguna_id = ?
            WHERE k.diterbitkan = 1
              AND (
                EXISTS (SELECT 1 FROM progres_modul pm2 WHERE pm2.kursus_id = k.id AND pm2.pengguna_id = ?)
                OR s.id IS NOT NULL
              )
            ORDER BY k.id ASC
        ");
        $stmt->execute([$penggunaId, $penggunaId, $penggunaId]);
        $rows = $stmt->fetchAll();

        return array_map(function ($r) {
            $total = (int)$r['total_modul'] ?: 1;
            $lulus = !empty($r['nomor_sertifikat']);
            $selesai = $lulus ? $total : min((int)$r['modul_selesai'], $total);
            $persen = $lulus ? 100 : (int)round(($selesai / $total) * 100);
            return [
                'id_kursus' => (int)$r['id_kursus'],
                'judul' => $r['judul'],
                'slug' => $r['slug'],
                'kategori' => $r['kategori'],
                'level' => $r['level'],
                'modul_selesai' => $selesai,
                'total_modul' => $total,
                'progress_persen' => $persen,
                'lulus_kuis' => $lulus,
                'nilai_kuis' => $r['nilai_kuis'] !== null ? (float)$r['nilai_kuis'] : null,
                'nomor_sertifikat' => $r['nomor_sertifikat'] ?: null,
            ];
        }, $rows);
    }

    public function tambah(array $in, KategoriModel $kategoriModel): ?array {
        $judul = trim($in['judul'] ?? '');
        if ($judul === '') {
            throw new \InvalidArgumentException('Judul kursus wajib diisi.');
        }

        $katId = $kategoriModel->cariId($in['kategori'] ?? '');
        if (!$katId) {
            throw new \InvalidArgumentException('Kategori kursus tidak valid.');
        }

        $slugDasar = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($judul)), '-') ?: 'kursus-baru';
        $cekSlug = $this->pdo->prepare("SELECT COUNT(*) FROM kursus WHERE slug = ?");
        $cekSlug->execute([$slugDasar]);
        $slug = ((int)$cekSlug->fetchColumn() > 0) ? ($slugDasar . '-' . time()) : $slugDasar;

        $level = in_array($in['level'] ?? '', ['Pemula', 'Menengah', 'Lanjut'], true) ? $in['level'] : 'Pemula';
        $tujuan = $in['tujuan_belajar'] ?? [
            'Memahami konsep dasar materi secara terstruktur',
            'Menerapkan keterampilan kerja secara mandiri',
        ];
        $tujuanText = is_array($tujuan) ? implode("\n", $tujuan) : (string)$tujuan;

        $stmt = $this->pdo->prepare("
            INSERT INTO kursus (kategori_id, judul, slug, ringkasan, deskripsi, tujuan_belajar, tingkat_kesulitan, estimasi_waktu, populer, diterbitkan)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, 1)
        ");
        $stmt->execute([
            $katId,
            $judul,
            $slug,
            trim($in['ringkasan'] ?? ''),
            trim($in['deskripsi'] ?? '') ?: trim($in['ringkasan'] ?? ''),
            $tujuanText,
            $level,
            trim($in['estimasi_waktu'] ?? '2 Jam'),
        ]);

        return $this->ambilDetail((string)$this->pdo->lastInsertId());
    }

    public function ubah(int $idKursus, array $in, KategoriModel $kategoriModel): ?array {
        if ($idKursus <= 0) {
            throw new \InvalidArgumentException('ID kursus tidak valid.');
        }
        $judul = trim($in['judul'] ?? '');
        if ($judul === '') {
            throw new \InvalidArgumentException('Judul kursus wajib diisi.');
        }

        $katId = $kategoriModel->cariId($in['kategori'] ?? '');
        if (!$katId) {
            throw new \InvalidArgumentException('Kategori kursus tidak valid.');
        }

        $level = in_array($in['level'] ?? '', ['Pemula', 'Menengah', 'Lanjut'], true) ? $in['level'] : 'Pemula';
        $setTujuan = '';
        $params = [
            $katId,
            $judul,
            trim($in['ringkasan'] ?? ''),
            trim($in['deskripsi'] ?? '') ?: trim($in['ringkasan'] ?? ''),
            $level,
            trim($in['estimasi_waktu'] ?? '2 Jam'),
        ];

        if (isset($in['tujuan_belajar'])) {
            $tujuan = $in['tujuan_belajar'];
            $tujuanText = is_array($tujuan) ? implode("\n", $tujuan) : (string)$tujuan;
            $setTujuan = ', tujuan_belajar = ?';
            $params[] = $tujuanText;
        }
        $params[] = $idKursus;

        $stmt = $this->pdo->prepare("
            UPDATE kursus
            SET kategori_id = ?, judul = ?, ringkasan = ?, deskripsi = ?, tingkat_kesulitan = ?, estimasi_waktu = ?{$setTujuan}
            WHERE id = ?
        ");
        $stmt->execute($params);

        return $this->ambilDetail((string)$idKursus);
    }

    public function hapus(int $idKursus): bool {
        $stmt = $this->pdo->prepare("DELETE FROM kursus WHERE id = ?");
        return $stmt->execute([$idKursus]);
    }
}
