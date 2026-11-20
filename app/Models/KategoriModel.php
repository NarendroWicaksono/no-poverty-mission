<?php
namespace App\Models;

use PDO;

class KategoriModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function ambilSemua(): array {
        $rows = $this->pdo->query("
            SELECT kat.id, kat.nama_kategori, kat.slug, kat.ikon, kat.deskripsi,
                   (SELECT COUNT(*) FROM kursus k WHERE k.kategori_id = kat.id AND k.diterbitkan = 1) AS jumlah_kursus
            FROM kategori kat
            ORDER BY kat.id ASC
        ")->fetchAll();

        return array_map(fn($r) => [
            'id_kategori' => (int)$r['id'],
            'nama' => $r['nama_kategori'],
            'slug' => $r['slug'],
            'deskripsi' => $r['deskripsi'],
            'jumlah_kursus' => (int)$r['jumlah_kursus'],
            'warna' => '#1F6F4A',
            'ikon_lucide' => $r['ikon'] ?: 'folder',
        ], $rows);
    }

    public function cariId(string $kategoriInput): int {
        $stmt = $this->pdo->prepare("SELECT id FROM kategori WHERE LOWER(nama_kategori) = LOWER(?) OR slug = ? LIMIT 1");
        $stmt->execute([trim($kategoriInput), trim($kategoriInput)]);
        $id = $stmt->fetchColumn();
        if ($id) {
            return (int)$id;
        }
        $fallback = $this->pdo->query("SELECT id FROM kategori ORDER BY id ASC LIMIT 1")->fetchColumn();
        return $fallback ? (int)$fallback : 1;
    }
}
