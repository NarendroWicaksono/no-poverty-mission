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
            return ['sukses' => false, 'modul_selesai' => []];
        }

        // Pastikan modul tersebut benar milik kursus terkait
        $stmtCekM = $this->pdo->prepare("SELECT id FROM modul WHERE id = ? AND kursus_id = ? LIMIT 1");
        $stmtCekM->execute([$idModul, $kursusId]);
        if ($stmtCekM->fetchColumn()) {
            $stmtIns = $this->pdo->prepare("
                INSERT IGNORE INTO progres_modul (pengguna_id, modul_id, kursus_id)
                VALUES (?, ?, ?)
            ");
            $stmtIns->execute([$penggunaId, $idModul, $kursusId]);
        }

        return [
            'sukses' => true,
            'modul_selesai' => $this->ambilProgresByKursusId($penggunaId, $kursusId),
        ];
    }

    public function hapusProgres(int $penggunaId, string $slugKursus, int $idModul): array {
        $stmtK = $this->pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
        $stmtK->execute([$slugKursus]);
        $kursusId = (int)$stmtK->fetchColumn();

        if (!$kursusId || !$idModul) {
            return ['sukses' => false, 'modul_selesai' => []];
        }

        $stmtDel = $this->pdo->prepare("DELETE FROM progres_modul WHERE pengguna_id = ? AND modul_id = ?");
        $stmtDel->execute([$penggunaId, $idModul]);

        return [
            'sukses' => true,
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
        $stmtK = $this->pdo->prepare("SELECT id FROM kursus WHERE slug = ? LIMIT 1");
        $stmtK->execute([$in['kursus_slug'] ?? '']);
        $kursusId = (int)$stmtK->fetchColumn() ?: 1;

        $videoUrl = self::normalisasiVideoUrl($in['video_url'] ?? '');
        $judul = trim($in['judul_modul'] ?? 'Modul Baru');
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
            'kursus_slug' => $in['kursus_slug'] ?? '',
            'judul_modul' => $judul,
            'urutan' => $urutan,
            'estimasi_menit' => $estimasi,
            'video_url' => $videoUrl,
            'konten' => $konten,
        ];
    }

    public function ubah(int $idModul, array $in): bool {
        $videoUrl = self::normalisasiVideoUrl($in['video_url'] ?? '');
        $stmt = $this->pdo->prepare("
            UPDATE modul
            SET urutan = ?, judul_modul = ?, estimasi_menit = ?, video_url = ?, konten = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            max(1, (int)($in['urutan'] ?? 1)),
            trim($in['judul_modul'] ?? ''),
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
}
