<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $pdo = null;
    private static bool $initialized = false;

    public static function getConnection(): ?PDO {
        if (self::$initialized) {
            return self::$pdo;
        }
        self::$initialized = true;

        $opsi = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $opsi);
            self::sinkronisasiSkemaDanVideo(self::$pdo);
            return self::$pdo;
        } catch (PDOException $e) {
            if ((int)$e->getCode() === 1049) {
                try {
                    $pdoServer = new PDO('mysql:host=' . DB_HOST . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $opsi);
                    $sqlFile = dirname(__DIR__, 2) . '/database.sql';
                    if (file_exists($sqlFile)) {
                        self::executeSqlFile($pdoServer, $sqlFile);
                    } else {
                        $pdoServer->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
                    }
                    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
                    self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $opsi);
                    return self::$pdo;
                } catch (PDOException $ex) {
                    return null;
                }
            }
            return null;
        }
    }

    /**
     * Pastikan database lama yang sudah telanjur diimpor otomatis mendapat:
     * 1. Kolom `kota` di tabel `pengguna` dan `nilai_kuis` di tabel `sertifikat`.
     * 2. Perbaikan URL video YouTube per modul yang relevan dengan materi (jika masih memakai video placeholder lama).
     */
    private static function sinkronisasiSkemaDanVideo(PDO $pdo): void {
        try {
            $kolomKota = $pdo->query("SHOW COLUMNS FROM `pengguna` LIKE 'kota'")->fetch();
            if (!$kolomKota) {
                $pdo->exec("ALTER TABLE `pengguna` ADD COLUMN `kota` VARCHAR(100) DEFAULT 'Indonesia' AFTER `pekerjaan`");
            }

            $kolomNilai = $pdo->query("SHOW COLUMNS FROM `sertifikat` LIKE 'nilai_kuis'")->fetch();
            if (!$kolomNilai) {
                $pdo->exec("ALTER TABLE `sertifikat` ADD COLUMN `nilai_kuis` DECIMAL(5,2) DEFAULT 90.00 AFTER `tanggal_terbit`");
            }

            // Cek apakah banyak modul masih memakai satu URL placeholder yang sama (2kRF8zyy25U) atau duplikat di Kursus 7
            $jumlahPlaceholder = (int)$pdo->query("SELECT COUNT(*) FROM `modul` WHERE `video_url` LIKE '%2kRF8zyy25U%'")->fetchColumn();
            $duplikatKursus7 = (int)$pdo->query("SELECT COUNT(*) FROM `modul` WHERE `id` IN (26, 27) AND `video_url` LIKE '%n4YoZDQs6VA%'")->fetchColumn();
            if ($jumlahPlaceholder > 2 || $duplikatKursus7 > 0) {
                $videoMap = self::daftarVideoModulRelevan();
                $stmt = $pdo->prepare("UPDATE `modul` SET `video_url` = ? WHERE `id` = ?");
                foreach ($videoMap as $idModul => $urlVideo) {
                    $stmt->execute([$urlVideo, $idModul]);
                }
            }
        } catch (PDOException $e) {
            // Abaikan jika tabel belum lengkap
        }
    }

    /**
     * Eksekusi file .sql secara aman per statement (menghindari masalah multi-statement saat EMULATE_PREPARES=false).
     */
    public static function executeSqlFile(PDO $pdo, string $sqlFile): void {
        $sql = file_get_contents($sqlFile);
        if ($sql === false) {
            return;
        }

        $statements = [];
        $buffer = '';
        $inSingleQuote = false;
        $inDoubleQuote = false;
        $len = strlen($sql);

        for ($i = 0; $i < $len; $i++) {
            $ch = $sql[$i];
            $prev = $i > 0 ? $sql[$i - 1] : '';

            // Lewati komentar baris (-- ...) di luar string
            if (!$inSingleQuote && !$inDoubleQuote && $ch === '-' && ($i + 1 < $len) && $sql[$i + 1] === '-') {
                while ($i < $len && $sql[$i] !== "\n") {
                    $i++;
                }
                continue;
            }

            if ($ch === "'" && !$inDoubleQuote && $prev !== '\\') {
                $inSingleQuote = !$inSingleQuote;
            } elseif ($ch === '"' && !$inSingleQuote && $prev !== '\\') {
                $inDoubleQuote = !$inDoubleQuote;
            }

            if ($ch === ';' && !$inSingleQuote && !$inDoubleQuote) {
                $trimmed = trim($buffer);
                if ($trimmed !== '') {
                    $statements[] = $trimmed;
                }
                $buffer = '';
                continue;
            }

            $buffer .= $ch;
        }

        $trimmed = trim($buffer);
        if ($trimmed !== '') {
            $statements[] = $trimmed;
        }

        foreach ($statements as $stmt) {
            $pdo->exec($stmt);
        }
    }

    /**
     * Daftar URL embed YouTube edukasi yang relevan untuk masing-masing dari 31 modul.
     */
    public static function daftarVideoModulRelevan(): array {
        return [
            // Kursus 1: Microsoft Excel Dasar
            1  => 'https://www.youtube.com/embed/rwbho0CgEAE', // Pengenalan Antarmuka Excel & Navigasi
            2  => 'https://www.youtube.com/embed/k1VUZEVuDJ8', // Input Data, Tipe Data & Format Sel
            3  => 'https://www.youtube.com/embed/8L1OVkw2ZQ8', // Rumus Aritmatika & Fungsi Statistik (SUM, AVERAGE, MIN, MAX, COUNT)
            4  => 'https://www.youtube.com/embed/2kRF8zyy25U', // Membuat Tabel Rapi, Freeze Panes & Grafik Visual

            // Kursus 2: Microsoft Excel Lanjutan
            5  => 'https://www.youtube.com/embed/iX6b58OlsGU', // Fungsi Logika IF, Nested IF & IFS
            6  => 'https://www.youtube.com/embed/xIynD1gFOLo', // Relasi Data Cepat dengan VLOOKUP & XLOOKUP
            7  => 'https://www.youtube.com/embed/m0wI61ahfLc', // Meringkas Ribuan Data dengan Pivot Table
            8  => 'https://www.youtube.com/embed/ka09v8z_BN0', // Pembersihan Data & Validasi Input

            // Kursus 3: Microsoft Word untuk Surat & Dokumen Resmi
            9  => 'https://www.youtube.com/embed/S-nHYzK-BVg', // Standar Dokumen Formal, Margin & Kop Surat
            10 => 'https://www.youtube.com/embed/O7K3K1qK0Uo', // Tata Letak Paragraf, Tab Stop & Penomoran
            11 => 'https://www.youtube.com/embed/n4_wO0BqCqo', // Penomoran Halaman Berbeda & Daftar Isi Otomatis
            12 => 'https://www.youtube.com/embed/rGG-In7PAEk', // Mail Merge Otomatis & Ekspor PDF

            // Kursus 4: Microsoft PowerPoint untuk Presentasi Efektif
            13 => 'https://www.youtube.com/embed/lwpeqflhyEE', // Prinsip Desain Slide Modern & Hierarki Visual
            14 => 'https://www.youtube.com/embed/Q43eJg3iXis', // Mengubah Paragraf Menjadi Visual & SmartArt
            15 => 'https://www.youtube.com/embed/7u5mQ6rfows', // Animasi Halus & Transisi Morph
            16 => 'https://www.youtube.com/embed/D8JV3w4TOVw', // Persiapan Teknis Presentasi & Tanya Jawab

            // Kursus 5: Menulis CV & Surat Lamaran Kerja ATS Friendly
            17 => 'https://www.youtube.com/embed/ujPEb8f8huQ', // Mengenal Sistem ATS & Format Resume Standar
            18 => 'https://www.youtube.com/embed/Tt08KmFfIYQ', // Merumuskan Pengalaman Kerja Berbasis Dampak (Formula XYZ)
            19 => 'https://www.youtube.com/embed/Q7Vq1158bTQ', // Menulis Surat Lamaran (Cover Letter)
            20 => 'https://www.youtube.com/embed/-Q1aIA1qMzs', // Optimasi Portofolio Digital & Checklist Final

            // Kursus 6: Persiapan Wawancara Kerja & Komunikasi Profesional
            21 => 'https://www.youtube.com/embed/l_kJgyhbYio', // Bedah Pertanyaan Pembuka: Ceritakan Tentang Diri Anda
            22 => 'https://www.youtube.com/embed/gZ2354BH0a0', // Menjawab Pertanyaan Behavioral dengan Metode STAR
            23 => 'https://www.youtube.com/embed/wX-yU1L5N-8', // Bahasa Tubuh, Etika Interview Daring/Luring & Kontak Mata
            24 => 'https://www.youtube.com/embed/qrLlE7AtrI8', // Pertanyaan Balik untuk HRD, Negosiasi Gaji & Follow-up

            // Kursus 7: Literasi Keuangan Dasar & Perencanaan Anggaran Mandiri
            25 => 'https://www.youtube.com/embed/n4YoZDQs6VA', // Pola Pikir Keuangan & Alokasi Anggaran 50/30/20
            26 => 'https://www.youtube.com/embed/HQzoZfc3GwQ', // Membangun Dana Darurat & Catatan Kas Harian
            27 => 'https://www.youtube.com/embed/fHhJ9J0z9nU', // Mengenali Jebakan Pinjol Ilegal & Hutang Konsumtif

            // Kursus 8: Memulai Usaha Kecil Modal Minim & Pemasaran Gratis
            28 => 'https://www.youtube.com/embed/PQbnT_ms_x8', // Validasi Ide Bisnis & Strategi Produk UMKM
            29 => 'https://www.youtube.com/embed/jwOkQr7xkug', // Menghitung HPP (Harga Pokok Penjualan) & Menentukan Untung
            30 => 'https://www.youtube.com/embed/QjrLSSlEZ4k', // Promosi Gratis & Efektif dengan WhatsApp Business
            31 => 'https://www.youtube.com/embed/38yDSebWQEc', // Teknik Foto Produk Menarik dengan Kamera HP
        ];
    }
}
