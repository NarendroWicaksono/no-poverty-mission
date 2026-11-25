<?php
namespace App\Models;

use PDO;

class ModulModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Normalisasi berbagai format link YouTube (watch?v=, youtu.be/, shorts/, embed/)
     * menjadi format https://www.youtube.com/embed/VIDEO_ID agar tidak gagal dimuat di iframe.
     */
    public static function normalisasiVideoUrl(?string $url): string {
        $url = trim((string)$url);
        if ($url === '') {
            return '';
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        return $url;
    }

    public function ambilBerdasarkanKursus(string $slugKursus): array {
        $stmt = $this->pdo->prepare("
            SELECT m.*, k.slug AS kursus_slug
            FROM modul m
            JOIN kursus k ON m.kursus_id = k.id
            WHERE k.slug = ?
            ORDER BY m.urutan ASC, m.id ASC
        ");
        $stmt->execute([$slugKursus]);
        $rows = $stmt->fetchAll();

        return array_map(fn($r) => [
            'id' => (int)$r['id'],
            'kursus_id' => (int)$r['kursus_id'],
            'kursus_slug' => $r['kursus_slug'],
            'judul_modul' => $r['judul_modul'],
            'urutan' => (int)$r['urutan'],
            'estimasi_menit' => (int)$r['estimasi_menit'],
            'video_url' => self::normalisasiVideoUrl($r['video_url'] ?? ''),
            'konten' => $r['konten'],
        ], $rows);
    }

    public function ambilProgresPeserta(int $penggunaId, string $slugKursus): array {
        $stmt = $this->pdo->prepare("
            SELECT pm.modul_id
            FROM progres_modul pm
            JOIN kursus k ON pm.kursus_id = k.id
            WHERE pm.pengguna_id = ? AND k.slug = ?
        ");
        $stmt->execute([$penggunaId, $slugKursus]);
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public function simpanProgres(int $penggunaId, string $slugKursus, int $idModul): array {
        $stmtK = $this->pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
        $stmtK->execute([$slugKursus]);
        $kursusId = (int)$stmtK->fetchColumn();

        if (!$kursusId || !$idModul) {
            return ['ok' => false, 'pesan' => 'Kursus atau modul tidak ditemukan.', 'modul_selesai' => []];
        }

        // Pastikan modul tersebut benar milik kursus terkait
        $stmtCekM = $this->pdo->prepare("SELECT id FROM modul WHERE id = ? AND kursus_id = ? LIMIT 1");
        $stmtCekM->execute([$idModul, $kursusId]);
        if (!$stmtCekM->fetchColumn()) {
            return ['ok' => false, 'pesan' => 'Modul tidak terdaftar pada kursus ini.', 'modul_selesai' => $this->ambilProgresByKursusId($penggunaId, $kursusId)];
        }

        $stmtIns = $this->pdo->prepare("
            INSERT IGNORE INTO progres_modul (pengguna_id, modul_id, kursus_id)
            VALUES (?, ?, ?)
        ");
        $stmtIns->execute([$penggunaId, $idModul, $kursusId]);

        return [
            'ok' => true,
            'modul_selesai' => $this->ambilProgresByKursusId($penggunaId, $kursusId),
        ];
    }

    public function hapusProgres(int $penggunaId, string $slugKursus, int $idModul): array {
        $stmtK = $this->pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
        $stmtK->execute([$slugKursus]);
        $kursusId = (int)$stmtK->fetchColumn();

        if (!$kursusId || !$idModul) {
            return ['ok' => false, 'pesan' => 'Kursus atau modul tidak ditemukan.', 'modul_selesai' => []];
        }

        $stmtDel = $this->pdo->prepare("DELETE FROM progres_modul WHERE pengguna_id = ? AND modul_id = ?");
        $stmtDel->execute([$penggunaId, $idModul]);

        return [
            'ok' => true,
            'modul_selesai' => $this->ambilProgresByKursusId($penggunaId, $kursusId),
        ];
    }

    /**
     * Tandai seluruh modul pada kursus sebagai selesai ketika peserta lulus kuis akhir.
     */
    public function tandaiSemuaSelesai(int $penggunaId, int $kursusId): void {
        $stmtM = $this->pdo->prepare("SELECT id FROM modul WHERE kursus_id = ?");
        $stmtM->execute([$kursusId]);
        $modulIds = $stmtM->fetchAll(PDO::FETCH_COLUMN);

        $stmtIns = $this->pdo->prepare("
            INSERT IGNORE INTO progres_modul (pengguna_id, modul_id, kursus_id)
            VALUES (?, ?, ?)
        ");
        foreach ($modulIds as $mid) {
            $stmtIns->execute([$penggunaId, (int)$mid, $kursusId]);
        }
    }

    private function ambilProgresByKursusId(int $penggunaId, int $kursusId): array {
        $stmtP = $this->pdo->prepare("SELECT modul_id FROM progres_modul WHERE pengguna_id = ? AND kursus_id = ?");
        $stmtP->execute([$penggunaId, $kursusId]);
        return array_map('intval', $stmtP->fetchAll(PDO::FETCH_COLUMN));
    }

    public function tambah(array $in): array {
        $slug = trim($in['kursus_slug'] ?? '');
        $stmtK = $this->pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
        $stmtK->execute([$slug]);
        $kursusId = (int)$stmtK->fetchColumn();
        if (!$kursusId) {
            throw new \InvalidArgumentException('Kursus tidak ditemukan untuk slug yang diberikan.');
        }

        $judul = trim($in['judul_modul'] ?? '');
        if ($judul === '') {
            throw new \InvalidArgumentException('Judul modul wajib diisi.');
        }

        $videoUrl = self::normalisasiVideoUrl($in['video_url'] ?? '');
        $urutan = max(1, (int)($in['urutan'] ?? 1));
        $estimasi = max(1, (int)($in['estimasi_menit'] ?? 20));
        $konten = trim($in['konten'] ?? '') ?: '<p>Materi pembelajaran.</p>';

        $stmt = $this->pdo->prepare("
            INSERT INTO modul (kursus_id, judul_modul, urutan, estimasi_menit, konten, video_url)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$kursusId, $judul, $urutan, $estimasi, $konten, $videoUrl]);

        return [
            'id' => (int)$this->pdo->lastInsertId(),
            'kursus_id' => $kursusId,
            'kursus_slug' => $slug,
            'judul_modul' => $judul,
            'urutan' => $urutan,
            'estimasi_menit' => $estimasi,
            'video_url' => $videoUrl,
            'konten' => $konten,
        ];
    }

    public function ubah(int $idModul, array $in): bool {
        if ($idModul <= 0) {
            throw new \InvalidArgumentException('ID modul tidak valid.');
        }
        $judul = trim($in['judul_modul'] ?? '');
        if ($judul === '') {
            throw new \InvalidArgumentException('Judul modul wajib diisi.');
        }
        $videoUrl = self::normalisasiVideoUrl($in['video_url'] ?? '');
        $stmt = $this->pdo->prepare("
            UPDATE modul
            SET urutan = ?, judul_modul = ?, estimasi_menit = ?, video_url = ?, konten = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            max(1, (int)($in['urutan'] ?? 1)),
            $judul,
            max(1, (int)($in['estimasi_menit'] ?? 20)),
            $videoUrl,
            trim($in['konten'] ?? ''),
            $idModul,
        ]);
    }

    public function hapus(int $idModul): bool {
        $stmt = $this->pdo->prepare("DELETE FROM modul WHERE id = ?");
        return $stmt->execute([$idModul]);
    }

    public function simpanRating(int $idPengguna, int $idModul, int $rating): array {
        if ($idPengguna <= 0 || $idModul <= 0) {
            return ['ok' => false, 'pesan' => 'Data tidak valid.'];
        }
        $rating = max(1, min(5, $rating));

        try {
            $this->pdo->exec("
                CREATE TABLE IF NOT EXISTS `rating_modul` (
                    `id` INT AUTO_INCREMENT PRIMARY KEY,
                    `pengguna_id` INT NOT NULL,
                    `modul_id` INT NOT NULL,
                    `rating` TINYINT NOT NULL DEFAULT 5,
                    `dibuat_pada` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    `diperbarui_pada` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    UNIQUE KEY `unik_pengguna_modul_rating` (`pengguna_id`, `modul_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ");

            $stmt = $this->pdo->prepare("
                INSERT INTO rating_modul (pengguna_id, modul_id, rating)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE rating = VALUES(rating), diperbarui_pada = CURRENT_TIMESTAMP
            ");
            $stmt->execute([$idPengguna, $idModul, $rating]);

            $info = $this->ambilRatingModul($idModul, $idPengguna);
            return [
                'ok' => true,
                'rating' => $rating,
                'pesan' => 'Rating berhasil disimpan.',
                'data' => $info['data'] ?? []
            ];
        } catch (\PDOException $e) {
            return ['ok' => false, 'pesan' => 'Gagal menyimpan rating: ' . $e->getMessage()];
        }
    }

    public function ambilRatingModul(int $idModul, ?int $idPengguna = null): array {
        if ($idModul <= 0) {
            return ['ok' => false, 'pesan' => 'ID modul tidak valid.'];
        }

        try {
            $stmt = $this->pdo->prepare("
                SELECT ROUND(COALESCE(AVG(rating), 5.0), 1) as rata_rata, COUNT(*) as total_ulasan
                FROM rating_modul
                WHERE modul_id = ?
            ");
            $stmt->execute([$idModul]);
            $res = $stmt->fetch() ?: ['rata_rata' => 5.0, 'total_ulasan' => 0];

            $ratingPengguna = null;
            if ($idPengguna && $idPengguna > 0) {
                $stmtUser = $this->pdo->prepare("SELECT rating FROM rating_modul WHERE modul_id = ? AND pengguna_id = ?");
                $stmtUser->execute([$idModul, $idPengguna]);
                $userRow = $stmtUser->fetch();
                if ($userRow) {
                    $ratingPengguna = (int)$userRow['rating'];
                }
            }

            return [
                'ok' => true,
                'data' => [
                    'rata_rata' => (float)($res['rata_rata'] ?? 5.0),
                    'total_ulasan' => (int)($res['total_ulasan'] ?? 0),
                    'rating_pengguna' => $ratingPengguna
                ]
            ];
        } catch (\PDOException $e) {
            return [
                'ok' => true,
                'data' => [
                    'rata_rata' => 5.0,
                    'total_ulasan' => 0,
                    'rating_pengguna' => null
                ]
            ];
        }
    }

    public function toggleBookmark(int $idPengguna, int $idModul): array {
        if ($idPengguna <= 0 || $idModul <= 0) {
            return ['ok' => false, 'pesan' => 'Data tidak valid.'];
        }

        try {
            $this->pdo->exec("
                CREATE TABLE IF NOT EXISTS `bookmark_modul` (
                    `id` INT AUTO_INCREMENT PRIMARY KEY,
                    `pengguna_id` INT NOT NULL,
                    `modul_id` INT NOT NULL,
                    `dibuat_pada` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    UNIQUE KEY `unik_pengguna_modul_bookmark` (`pengguna_id`, `modul_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ");

            $stmt = $this->pdo->prepare("SELECT id FROM bookmark_modul WHERE pengguna_id = ? AND modul_id = ?");
            $stmt->execute([$idPengguna, $idModul]);
            $ada = $stmt->fetch();

            if ($ada) {
                $stmtDel = $this->pdo->prepare("DELETE FROM bookmark_modul WHERE pengguna_id = ? AND modul_id = ?");
                $stmtDel->execute([$idPengguna, $idModul]);
                return [
                    'ok' => true,
                    'dibookmark' => false,
                    'pesan' => 'Video materi dihapus dari simpanan.'
                ];
            } else {
                $stmtIns = $this->pdo->prepare("INSERT INTO bookmark_modul (pengguna_id, modul_id) VALUES (?, ?)");
                $stmtIns->execute([$idPengguna, $idModul]);
                return [
                    'ok' => true,
                    'dibookmark' => true,
                    'pesan' => 'Video materi berhasil disimpan ke Aktivitas Saya.'
                ];
            }
        } catch (\PDOException $e) {
            return ['ok' => false, 'pesan' => 'Gagal mengubah bookmark: ' . $e->getMessage()];
        }
    }

    public function statusBookmark(int $idPengguna, int $idModul): array {
        if ($idPengguna <= 0 || $idModul <= 0) {
            return ['ok' => true, 'dibookmark' => false];
        }

        try {
            $stmt = $this->pdo->prepare("SELECT id FROM bookmark_modul WHERE pengguna_id = ? AND modul_id = ?");
            $stmt->execute([$idPengguna, $idModul]);
            return ['ok' => true, 'dibookmark' => (bool)$stmt->fetch()];
        } catch (\PDOException $e) {
            return ['ok' => true, 'dibookmark' => false];
        }
    }

    public function ambilAktivitasPengguna(int $idPengguna): array {
        if ($idPengguna <= 0) {
            return ['ok' => true, 'data' => ['bookmark' => [], 'rating' => []]];
        }

        $bookmarks = [];
        $ratings = [];

        try {
            $stmtB = $this->pdo->prepare("
                SELECT b.id as bookmark_id, b.dibuat_pada,
                       m.id as modul_id, m.judul_modul, m.urutan, m.estimasi_menit, m.video_url,
                       k.id as kursus_id, k.judul as kursus_judul, k.slug as kursus_slug
                FROM bookmark_modul b
                JOIN modul m ON b.modul_id = m.id
                JOIN kursus k ON m.kursus_id = k.id
                WHERE b.pengguna_id = ?
                ORDER BY b.dibuat_pada DESC
            ");
            $stmtB->execute([$idPengguna]);
            $bookmarks = $stmtB->fetchAll();

            $stmtR = $this->pdo->prepare("
                SELECT r.id as rating_id, r.rating, r.diperbarui_pada,
                       m.id as modul_id, m.judul_modul, m.urutan, m.estimasi_menit, m.video_url,
                       k.id as kursus_id, k.judul as kursus_judul, k.slug as kursus_slug
                FROM rating_modul r
                JOIN modul m ON r.modul_id = m.id
                JOIN kursus k ON m.kursus_id = k.id
                WHERE r.pengguna_id = ?
                ORDER BY r.diperbarui_pada DESC
            ");
            $stmtR->execute([$idPengguna]);
            $ratings = $stmtR->fetchAll();
        } catch (\PDOException $e) {
            // Abaikan jika tabel belum ada
        }

        return [
            'ok' => true,
            'data' => [
                'bookmark' => $bookmarks,
                'rating' => $ratings
            ]
        ];
    }
}
