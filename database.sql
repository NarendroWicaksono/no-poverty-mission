-- ========================================================
-- Database: db_skill4life
-- Aplikasi Kursus Online Gratis Bertema SDG 1: No Poverty
-- ========================================================

-- CREATE DATABASE IF NOT EXISTS `db_skill4life` ...
-- USE `db_skill4life`;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `sertifikat`;
DROP TABLE IF EXISTS `hasil_kuis`;
DROP TABLE IF EXISTS `soal_kuis`;
DROP TABLE IF EXISTS `progres_modul`;
DROP TABLE IF EXISTS `modul`;
DROP TABLE IF EXISTS `kursus`;
DROP TABLE IF EXISTS `kategori`;
DROP TABLE IF EXISTS `pengguna`;
SET FOREIGN_KEY_CHECKS = 1;

-- --------------------------------------------------------
-- Tabel: pengguna
-- --------------------------------------------------------
CREATE TABLE `pengguna` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_lengkap` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `kata_sandi` VARCHAR(255) NOT NULL,
  `peran` ENUM('peserta', 'admin') DEFAULT 'peserta',
  `nomor_telepon` VARCHAR(25) NULL,
  `pekerjaan` VARCHAR(100) NULL,
  `kota` VARCHAR(100) DEFAULT 'Indonesia',
  `foto_profil` VARCHAR(255) NULL,
  `dibuat_pada` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_pengguna_email` (`email`),
  INDEX `idx_pengguna_peran` (`peran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: kategori
-- --------------------------------------------------------
CREATE TABLE `kategori` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_kategori` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `ikon` VARCHAR(50) DEFAULT 'fa-folder',
  `deskripsi` TEXT NULL,
  `dibuat_pada` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: kursus
-- --------------------------------------------------------
CREATE TABLE `kursus` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kategori_id` INT NOT NULL,
  `judul` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `ringkasan` VARCHAR(300) NOT NULL,
  `deskripsi` TEXT NOT NULL,
  `tujuan_belajar` TEXT NOT NULL,
  `tingkat_kesulitan` ENUM('Pemula', 'Menengah', 'Lanjut') DEFAULT 'Pemula',
  `estimasi_waktu` VARCHAR(50) DEFAULT '2 Jam',
  `gambar_sampul` VARCHAR(255) DEFAULT 'assets/img/kursus-default.svg',
  `populer` TINYINT(1) DEFAULT 0,
  `diterbitkan` TINYINT(1) DEFAULT 1,
  `dibuat_pada` DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_kursus_pencarian` (`judul`, `tingkat_kesulitan`),
  INDEX `idx_kursus_kategori` (`kategori_id`),
  CONSTRAINT `fk_kursus_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: modul
-- --------------------------------------------------------
CREATE TABLE `modul` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kursus_id` INT NOT NULL,
  `judul_modul` VARCHAR(200) NOT NULL,
  `urutan` INT NOT NULL DEFAULT 1,
  `estimasi_menit` INT DEFAULT 15,
  `konten` LONGTEXT NOT NULL,
  `video_url` VARCHAR(255) NULL,
  `dibuat_pada` DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_modul_kursus_urutan` (`kursus_id`, `urutan`),
  CONSTRAINT `fk_modul_kursus` FOREIGN KEY (`kursus_id`) REFERENCES `kursus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: progres_modul
-- --------------------------------------------------------
CREATE TABLE `progres_modul` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `pengguna_id` INT NOT NULL,
  `modul_id` INT NOT NULL,
  `kursus_id` INT NOT NULL,
  `selesai_pada` DATETIME DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `unik_pengguna_modul` (`pengguna_id`, `modul_id`),
  INDEX `idx_progres_pengguna_kursus` (`pengguna_id`, `kursus_id`),
  CONSTRAINT `fk_progres_pengguna` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_progres_modul` FOREIGN KEY (`modul_id`) REFERENCES `modul` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_progres_kursus` FOREIGN KEY (`kursus_id`) REFERENCES `kursus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: soal_kuis
-- --------------------------------------------------------
CREATE TABLE `soal_kuis` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kursus_id` INT NOT NULL,
  `pertanyaan` TEXT NOT NULL,
  `pilihan_a` TEXT NOT NULL,
  `pilihan_b` TEXT NOT NULL,
  `pilihan_c` TEXT NOT NULL,
  `pilihan_d` TEXT NOT NULL,
  `jawaban_benar` ENUM('A', 'B', 'C', 'D') NOT NULL,
  `pembahasan` TEXT NULL,
  `urutan` INT DEFAULT 1,
  INDEX `idx_soal_kursus` (`kursus_id`),
  CONSTRAINT `fk_soal_kursus` FOREIGN KEY (`kursus_id`) REFERENCES `kursus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: hasil_kuis
-- --------------------------------------------------------
CREATE TABLE `hasil_kuis` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `pengguna_id` INT NOT NULL,
  `kursus_id` INT NOT NULL,
  `total_soal` INT NOT NULL DEFAULT 10,
  `jawaban_benar` INT NOT NULL DEFAULT 0,
  `nilai` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
  `status_lulus` ENUM('Lulus', 'Tidak Lulus') NOT NULL,
  `dikerjakan_pada` DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_hasil_pengguna_kursus` (`pengguna_id`, `kursus_id`),
  CONSTRAINT `fk_hasil_pengguna` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_hasil_kursus` FOREIGN KEY (`kursus_id`) REFERENCES `kursus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: sertifikat
-- --------------------------------------------------------
CREATE TABLE `sertifikat` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nomor_sertifikat` VARCHAR(50) NOT NULL UNIQUE,
  `pengguna_id` INT NOT NULL,
  `kursus_id` INT NOT NULL,
  `tanggal_terbit` DATE NOT NULL,
  `nilai_kuis` DECIMAL(5,2) DEFAULT 100.00,
  `kode_verifikasi` VARCHAR(64) NOT NULL UNIQUE,
  `penandatangan_nama` VARCHAR(100) DEFAULT 'Dr. Ir. Hendra Gunawan, M.T.',
  `penandatangan_jabatan` VARCHAR(100) DEFAULT 'Direktur Pembina Skill4Life',
  `dibuat_pada` DATETIME DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `unik_pengguna_kursus_sertifikat` (`pengguna_id`, `kursus_id`),
  INDEX `idx_sertifikat_nomor` (`nomor_sertifikat`),
  INDEX `idx_sertifikat_kode` (`kode_verifikasi`),
  CONSTRAINT `fk_sertifikat_pengguna` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_sertifikat_kursus` FOREIGN KEY (`kursus_id`) REFERENCES `kursus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- DATA CONTOH (SEED DATA)
-- --------------------------------------------------------

-- 1. Pengguna
-- Akun Admin: admin@skill4life.id / admin1234
-- Akun Peserta: budi@gmail.com / budi1234
-- Akun Peserta: siti@gmail.com / budi1234
INSERT INTO `pengguna` (`id`, `nama_lengkap`, `email`, `kata_sandi`, `peran`, `nomor_telepon`, `pekerjaan`, `kota`) VALUES
(1, 'Administrator Skill4Life', 'admin@skill4life.id', '$2y$10$2w64FLM.Ls1LJ4EQEwNBHe7wos8Fez6b6ZFWX2cU7lSvbkqsNEdEW', 'admin', '081234567890', 'Tim Pengelola Skill4Life', 'Jakarta'),
(2, 'Budi Santoso', 'budi@gmail.com', '$2y$10$BBRzSv8pLGHkItXuMQHOw.uiLgnVec6Z7fPtUfIul2bBgc/reLCke', 'peserta', '085712345678', 'Pencari Kerja', 'Bandung'),
(3, 'Siti Rahmawati', 'siti@gmail.com', '$2y$10$BBRzSv8pLGHkItXuMQHOw.uiLgnVec6Z7fPtUfIul2bBgc/reLCke', 'peserta', '089876543210', 'Pelaku UMKM Kuliner', 'Surabaya');

-- 2. Kategori
INSERT INTO `kategori` (`id`, `nama_kategori`, `slug`, `ikon`, `deskripsi`) VALUES
(1, 'Aplikasi perkantoran', 'aplikasi-perkantoran', 'table-2', 'Pengolahan lembar kerja, penyusunan naskah dinas, dan pembuatan materi presentasi kerja.'),
(2, 'Kesiapan karir dan kerja', 'kesiapan-karir-kerja', 'briefcase', 'Format berkas lamaran kerja terstandar ATS dan persiapan komunikasi menghadapi wawancara seleksi.'),
(3, 'Kewirausahaan dan literasi keuangan', 'kewirausahaan-literasi-keuangan', 'wallet', 'Pengelolaan arus kas pribadi bebas jeratan utang serta panduan memulai usaha kecil modal minim.');

-- 3. Kursus
INSERT INTO `kursus` (`id`, `kategori_id`, `judul`, `slug`, `ringkasan`, `deskripsi`, `tujuan_belajar`, `tingkat_kesulitan`, `estimasi_waktu`, `gambar_sampul`, `populer`, `diterbitkan`) VALUES
(1, 1, 'Microsoft Excel Dasar: Olah Data & Rumus Esensial', 'microsoft-excel-dasar', 
 'Pelajari navigasi lembar kerja, input data efisien, pemformatan sel, rumus matematika dasar, serta pembuatan tabel dan grafik visual.',
 'Kursus Microsoft Excel Dasar ini dirancang khusus bagi siapa saja yang ingin memulai karir administratif atau mengelola catatan usaha sendiri. Anda akan belajar dari nol: memahami antarmuka lembar sebar (spreadsheet), mengatur tata letak sel, menggunakan rumus dasar seperti SUM, AVERAGE, MIN, MAX, dan COUNT, serta mengubah data mentah menjadi grafik yang mudah dibaca.',
 'Memahami antarmuka dan navigasi kerja Excel secara percaya diri\nMengetahui cara menginput dan memformat angka, mata uang, dan tanggal dengan benar\nMenguasai rumus-rumus aritmatika dan fungsi statistik dasar (SUM, AVERAGE, COUNT, MIN, MAX)\nMampu membuat tabel data rapi dan menyajikannya dalam grafik visual yang informatif',
 'Pemula', '2.5 Jam', 'assets/img/kursus-excel-dasar.svg', 1, 1),

(2, 1, 'Microsoft Excel Lanjutan: Analisis Data & Otomasi Laporan', 'microsoft-excel-lanjutan',
 'Tingkatkan keahlian spreadsheet Anda dengan rumus pencarian VLOOKUP/XLOOKUP, logika IF bersarang, pengurutan, filter canggih, dan Pivot Table.',
 'Dalam dunia kerja modern, keahlian analisis data Excel tingkat menengah-lanjut adalah nilai tambah yang sangat dihargai pemberi kerja. Kursus ini membahas secara tuntas pemanfaatan fungsi lookup seperti VLOOKUP dan fungsi modern XLOOKUP, kondisional IF dan IFS, pembuatan ringkasan otomatis dengan Pivot Table, serta visualisasi dashboard ringkas yang siap dipresentasikan ke atasan atau klien.',
 'Menguasai fungsi relasi data menggunakan VLOOKUP dan XLOOKUP secara presisi\nMenerapkan logika bersyarat IF, AND, OR, dan IFS untuk otomatisasi status data\nMampu mengolah ribuan baris data menjadi ringkasan interaktif dengan Pivot Table\nMengenal dasar pembersihan data (data cleansing) dan validasi input sel',
 'Menengah', '3 Jam', 'assets/img/kursus-excel-lanjut.svg', 1, 1),

(3, 1, 'Microsoft Word untuk Surat dan Dokumen Resmi', 'microsoft-word-surat-dokumen',
 'Kuasai pembuatan surat resmi, tata letak dokumen standar perkantoran, pengaturan margin, penomoran halaman dinamis, dan mail merge praktis.',
 'Microsoft Word bukan sekadar tempat mengetik teks, melainkan sarana menghasilkan dokumen resmi berstandar profesional. Melalui modul ini, Anda akan dibimbing membuat surat niaga, surat keputusan, laporan berkala, hingga undangan massal dengan Mail Merge. Anda juga akan mempelajari teknik styling paragraf, pembuatan daftar isi otomatis, dan konversi ke PDF siap kirim.',
 'Mengetahui format baku surat dinas dan surat bisnis resmi di Indonesia\nMengatur margin kertas, indentasi paragraf, tabulasi rapi, dan kop surat profesional\nMenggunakan fitur penomoran halaman berbeda pada halaman cover dan isi\nMemanfaatkan Mail Merge untuk mengirim ratusan surat atau sertifikat dalam hitungan menit',
 'Pemula', '2 Jam', 'assets/img/kursus-word.svg', 0, 1),

(4, 1, 'Microsoft PowerPoint untuk Presentasi Efektif & Memikat', 'microsoft-powerpoint-presentasi',
 'Pelajari teknik merancang slide presentasi yang bersih, visual storytelling, pemilihan warna kontras, serta penyampaian ide yang percaya diri.',
 'Slide presentasi yang buruk dan penuh teks panjang sering kali membuat audiens bosan dan pesan penting Anda tidak tersampaikan. Kursus ini mengajarkan cara mengubah ide bisnis atau laporan kerja menjadi tayangan slide yang elegan dan berbobot. Anda akan belajar hierarki visual, penggunaan ikon, teknik animasi halus, dan tips berbicara di depan umum.',
 'Memahami prinsip desain slide: kontras, keterbacaan, whitespace, dan tipografi\nMenggantikan paragraf panjang menjadi poin-poin visual dan diagram terstruktur\nMenggunakan animasi transisi yang halus dan profesional tanpa terkesan berlebihan\nMempersiapkan presentasi proyek kerja atau pitch usaha di hadapan audiens nyata',
 'Pemula', '2 Jam', 'assets/img/kursus-powerpoint.svg', 0, 1),

(5, 2, 'Menulis CV & Surat Lamaran Kerja ATS Friendly', 'menulis-cv-surat-lamaran-ats',
 'Strategi merancang resume lolos sistem seleksi otomatis (ATS), menulis surat lamaran persuasif, dan menyusun portofolio kerja yang menonjol.',
 'Banyak pencari kerja gagal di tahap administrasi bukan karena kurang berbakat, melainkan karena format CV mereka tidak dapat dibaca oleh Applicant Tracking System (ATS). Di kursus ini, Anda akan mempelajari anatomi CV ramah ATS, kata kunci industri yang tepat, perumusan pencapaian kerja berbasis angka, serta template surat lamaran yang memikat perhatian HRD.',
 'Memahami cara kerja sistem ATS dalam menyaring berkas pelamar kerja\nMenyusun struktur CV yang bersih, terstandar, dan fokus pada dampak nyata (action verbs)\nMenulis surat lamaran (cover letter) yang spesifik dan menjawab kebutuhan perusahaan\nMenghindari 10 kesalahan fatal yang paling sering membuat CV langsung ditolak',
 'Pemula', '2.5 Jam', 'assets/img/kursus-cv.svg', 1, 1),

(6, 2, 'Persiapan Wawancara Kerja & Komunikasi Profesional', 'persiapan-wawancara-kerja',
 'Kuasai teknik menjawab pertanyaan sulit HRD dengan metode STAR, etika komunikasi tatap muka & daring, serta trik negosiasi gaji awal.',
 'Wawancara kerja adalah panggung utama Anda untuk membuktikan bahwa Anda adalah kandidat paling tepat. Kursus ini mengupas tuntas pertanyaan yang paling sering diajukan, mulai dari "Ceritakan tentang diri Anda" hingga pertanyaan studi kasus perilaku. Anda akan mempraktikkan metode STAR (Situation, Task, Action, Result) dan membangun bahasa tubuh yang meyakinkan.',
 'Menggunakan metode STAR untuk menjawab pertanyaan situasional dan perilaku\nMenjawab pertanyaan kelebihan, kekurangan diri, dan alasan keluar dari pekerjaan lama\nMenguasai etika berpakaian, kontak mata, dan komunikasi non-verbal saat interview\nMengetahui cara menanyakan balik kepada pewawancara dan tindak lanjut (thank-you email)',
 'Menengah', '2.5 Jam', 'assets/img/kursus-interview.svg', 1, 1),

(7, 3, 'Literasi Keuangan Dasar & Perencanaan Anggaran Mandiri', 'literasi-keuangan-dasar',
 'Kelola penghasilan keluarga dan pribadi dengan bijak: alokasi 50/30/20, dana darurat, tips menabung konsisten, dan waspada bahaya pinjol ilegal.',
 'Bebas dari kemiskinan dimulai dengan keterampilan mengelola setiap rupiah yang diperoleh. Kursus ini memberikan edukasi keuangan dasar tanpa istilah perbankan yang rumit. Pelajari cara mencatat pengeluaran harian, memisahkan kebutuhan vs keinginan, membangun dana darurat sedikit demi sedikit, dan melindungi keluarga dari tawaran pinjaman online berbunga mencekik.',
 'Memahami prinsip pembagian anggaran sederhana 50% kebutuhan, 30% keinginan, 20% tabungan\nMampu membuat buku kas pencatatan pengeluaran harian yang disiplin\nMembangun dana cadangan darurat untuk mengantisipasi musibah atau masa menganggur\nMengenali ciri-ciri pinjol ilegal dan investasi bodong yang merugikan masyarakat',
 'Pemula', '1.5 Jam', 'assets/img/kursus-keuangan.svg', 0, 1),

(8, 3, 'Memulai Usaha Kecil Modal Minim & Pemasaran Gratis', 'memulai-usaha-kecil-modal-minim',
 'Panduan praktis membuka usaha rumahan dari hobi: riset pasar sederhana, kalkulasi HPP dan harga jual, serta promosi lewat WhatsApp & medsos.',
 'Kewirausahaan adalah jalan tercepat membuka lapangan kerja mandiri. Kursus ini membimbing Anda memulai usaha dari skala kecil dengan modal yang Anda miliki saat ini. Anda akan mempelajari cara mencari ide produk yang diminati warga sekitar, menghitung Harga Pokok Penjualan (HPP) agar tidak rugi, serta memanfaatkan saluran gratis seperti WhatsApp Bisnis dan media sosial.',
 'Menemukan peluang usaha dari masalah di lingkungan sekitar tanpa perlu modal besar\nMenghitung biaya bahan baku, operasional, dan menentukan harga jual yang menghasilkan untung\nMenggunakan WhatsApp Bisnis untuk katalog produk dan komunikasi pelanggan yang ramah\nMenerapkan teknik foto produk menarik hanya dengan kamera ponsel biasa',
 'Pemula', '2.5 Jam', 'assets/img/kursus-umkm.svg', 1, 1);


-- 4. Modul Pelajaran
INSERT INTO `modul` (`id`, `kursus_id`, `judul_modul`, `urutan`, `estimasi_menit`, `konten`, `video_url`) VALUES
(1, 1, 'Pengenalan Antarmuka Excel & Navigasi Lembar Kerja', 1, 20, '<h3>Mengenal Jendela Kerja Microsoft Excel</h3>
<p>Microsoft Excel adalah program spreadsheet (lembar sebar) yang sangat populer di seluruh dunia kerja perkantoran, perbankan, instansi pemerintah, hingga pelaku UMKM. Pada modul pertama ini, kita akan mempelajari bagian-bagian utama antarmuka Excel agar Anda merasa nyaman dan tidak takut saat membuka lembar kerja kosong.</p>

<div class="alert-box alert-info">
  <strong>Komponen Utama Excel:</strong>
  <ul>
    <li><strong>Ribbon:</strong> Deretan tab menu di bagian atas (Home, Insert, Page Layout, Formulas, Data, dll.) yang berisi kumpulan perintah.</li>
    <li><strong>Formula Bar (Bilah Rumus):</strong> Tempat Anda melihat, mengetik, atau mengedit teks, angka, maupun rumus yang terdapat dalam sel yang aktif.</li>
    <li><strong>Name Box (Kotak Nama):</strong> Menampilkan koordinat alamat sel yang sedang aktif, misalnya <code>A1</code>, <code>C15</code>, dll.</li>
    <li><strong>Kolom (Column):</strong> Bagian vertikal lembar kerja yang diidentifikasi dengan huruf abjad (A, B, C, ..., Z, AA, dst).</li>
    <li><strong>Baris (Row):</strong> Bagian horizontal lembar kerja yang diidentifikasi dengan angka (1, 2, 3, dst).</li>
    <li><strong>Sel (Cell):</strong> Pertemuan antara kolom dan baris. Contohnya, pertemuan Kolom B dan Baris 4 dinamakan sel <code>B4</code>.</li>
  </ul>
</div>

<h4>Shortcut Navigasi Cepat di Excel</h4>
<p>Untuk meningkatkan produktivitas kerja Anda, biasakan menggunakan tombol pintasan (keyboard shortcut) dasar berikut:</p>
<table class="table-custom">
  <thead>
    <tr>
      <th>Kombinasi Tombol</th>
      <th>Fungsi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>Ctrl + Panah (Arrow)</code></td>
      <td>Melompat ke sel paling tepi yang berisi data</td>
    </tr>
    <tr>
      <td><code>Ctrl + Home</code></td>
      <td>Kembali seketika ke sel paling awal (A1)</td>
    </tr>
    <tr>
      <td><code>Ctrl + S</code></td>
      <td>Menyimpan (Save) lembar kerja</td>
    </tr>
    <tr>
      <td><code>Ctrl + Z</code></td>
      <td>Membatalkan tindakan terakhir (Undo)</td>
    </tr>
    <tr>
      <td><code>F2</code></td>
      <td>Mengedit isi sel secara langsung tanpa menghapus isinya</td>
    </tr>
  </tbody>
</table>

<div class="alert-box alert-success">
  <strong>Latihan Mandiri 1:</strong> Buka program Microsoft Excel atau Google Spreadsheet. Cobalah ketik nama Anda di sel A1, alamat di A2, dan nomor telepon di A3. Gunakan tombol Tab untuk bergeser ke kolom kanan dan Enter untuk bergeser ke baris bawah.
</div>', 'https://www.youtube.com/embed/rwbho0CgEAE'),
(2, 1, 'Input Data, Tipe Data & Format Sel (Number, Currency, Date)', 2, 25, '<h3>Tipe Data dalam Excel & Pemformatan yang Tepat</h3>
<p>Salah satu kesalahan paling umum pemula adalah memperlakukan angka seperti teks. Di dalam Excel, setiap jenis data memiliki perlakuan yang berbeda. Memahami tipe data akan mencegah rumus Anda menghasilkan nilai error seperti <code>#VALUE!</code>.</p>

<h4>3 Jenis Data Utama di Excel:</h4>
<ol>
  <li><strong>Teks (Label):</strong> Berisi huruf, simbol, atau kombinasi teks-angka. Secara default, teks akan rata kiri di dalam sel.</li>
  <li><strong>Angka (Numeric):</strong> Berisi nilai bilangan bulat atau pecahan. Secara default, angka akan rata kanan. Angka inilah yang bisa dihitung dengan rumus matematika.</li>
  <li><strong>Tanggal dan Waktu (Date/Time):</strong> Format waktu yang sebenarnya disimpan oleh Excel sebagai nomor seri angka berurutan mulai dari 1 Januari 1900.</li>
</ol>

<div class="alert-box alert-warning">
  <strong>Penting: Format Mata Uang Rupiah (Rp)</strong><br>
  Jangan pernah mengetik manual tulisan "Rp" atau titik pemisah ribuan pada sel angka, misalnya: <code>Rp 50.000</code>. Jika Anda mengetik huruf "Rp", Excel akan menganggap sel tersebut sebagai <em>Teks</em> dan tidak bisa dijumlahkan!<br>
  <strong>Cara yang Benar:</strong> Cukup ketik angka aslinya <code>50000</code>, lalu klik menu <strong>Home &gt; Number Format &gt; Currency / Accounting &gt; Pilih Rupiah (Rp)</strong>.
</div>

<h4>Mengatur Format Tanggal (Date Format)</h4>
<p>Pastikan pengaturan regional di komputer Anda sesuai. Format tanggal Indonesia umumnya adalah <code>DD/MM/YYYY</code> (Hari/Bulan/Tahun). Jika ingin menampilkan tanggal lengkap seperti <em>17 Agustus 2026</em>, klik kanan sel &gt; <strong>Format Cells &gt; Date &gt; Pilih format tanggal panjang</strong>.</p>', 'https://www.youtube.com/embed/k1VUZEVuDJ8'),
(3, 1, 'Rumus Aritmatika & Fungsi Statistik Esensial (SUM, AVERAGE, MIN, MAX, COUNT)', 3, 30, '<h3>Menguasai Rumus Matematika dan Fungsi Dasar Excel</h3>
<p>Semua penulisan rumus (formula) atau fungsi di Excel <strong>WAJIB diawali dengan tanda sama dengan (=)</strong>. Jika tidak diawali tanda sama dengan, Excel hanya akan menampilkannya sebagai teks biasa.</p>

<h4>Operator Aritmatika Dasar:</h4>
<ul>
  <li>Penjumlahan: <code>=A1 + B1</code></li>
  <li>Pengurangan: <code>=A1 - B1</code></li>
  <li>Perkalian: gunakan tanda bintang <code>=A1 * B1</code></li>
  <li>Pembagian: gunakan tanda garis miring <code>=A1 / B1</code></li>
  <li>Pangkat: gunakan tanda sisip <code>=A1 ^ 2</code></li>
</ul>

<h4>5 Fungsi Statistik Paling Sering Digunakan di Tempat Kerja:</h4>
<table class="table-custom">
  <thead>
    <tr>
      <th>Fungsi</th>
      <th>Rumus Contoh</th>
      <th>Penjelasan &amp; Kegunaan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>SUM</strong></td>
      <td><code>=SUM(D2:D11)</code></td>
      <td>Menjumlahkan seluruh angka dari sel D2 sampai D11.</td>
    </tr>
    <tr>
      <td><strong>AVERAGE</strong></td>
      <td><code>=AVERAGE(D2:D11)</code></td>
      <td>Menghitung nilai rata-rata dari kumpulan angka tersebut.</td>
    </tr>
    <tr>
      <td><strong>COUNT</strong></td>
      <td><code>=COUNT(D2:D11)</code></td>
      <td>Menghitung jumlah sel yang terisi angka (bukan menghitung teks).</td>
    </tr>
    <tr>
      <td><strong>COUNTA</strong></td>
      <td><code>=COUNTA(A2:A11)</code></td>
      <td>Menghitung sel yang terisi data apa saja (baik teks maupun angka).</td>
    </tr>
    <tr>
      <td><strong>MAX</strong></td>
      <td><code>=MAX(D2:D11)</code></td>
      <td>Mencari nilai tertinggi atau angka terbesar.</td>
    </tr>
    <tr>
      <td><strong>MIN</strong></td>
      <td><code>=MIN(D2:D11)</code></td>
      <td>Mencari nilai terendah atau angka terkecil.</td>
    </tr>
  </tbody>
</table>

<div class="alert-box alert-info">
  <strong>Fitur AutoSum:</strong> Anda bisa menggunakan tombol cepat <code>Alt + =</code> di keyboard pada sel tepat di bawah deretan angka untuk menjumlahkan secara instan!
</div>', 'https://www.youtube.com/embed/8L1OVkw2ZQ8'),
(4, 1, 'Membuat Tabel Rapi, Freeze Panes & Grafik Visual', 4, 25, '<h3>Menata Data Profesional dengan Tabel dan Grafik</h3>
<p>Setelah Anda berhasil menginput dan menghitung data, langkah penting berikutnya adalah menyajikan data tersebut agar enak dilihat dan mudah dipahami oleh rekan kerja, pimpinan, atau klien.</p>

<h4>1. Menggunakan Fitur Format as Table (Ctrl + T)</h4>
<p>Mengubah rentang sel biasa menjadi Tabel Excel Resmi (Excel Table) memberikan banyak keunggulan otomatis:</p>
<ul>
  <li>Warna baris selang-seling (Zebra striping) secara otomatis untuk kenyamanan membaca.</li>
  <li>Tombol Filter otomatis muncul di setiap kepala kolom.</li>
  <li>Rumus akan otomatis terisi ke baris bawahnya tanpa perlu ditarik manual (Calculated Columns).</li>
  <li>Bisa menambahkan Total Row di baris terbawah hanya dengan satu centang.</li>
</ul>

<h4>2. Mengunci Baris Judul dengan Freeze Panes</h4>
<p>Ketika Anda memiliki ratusan baris data, saat menggeser kursor ke bawah, judul kolom sering kali hilang tertutup. Solusinya:</p>
<ol>
  <li>Klik menu <strong>View</strong> di Ribbon atas.</li>
  <li>Pilih ikon <strong>Freeze Panes</strong>.</li>
  <li>Pilih opsi <strong>Freeze Top Row</strong> untuk mengunci baris paling atas agar tetap terlihat saat di-scroll.</li>
</ol>

<h4>3. Membuat Grafik Visual (Chart)</h4>
<p>Grafik membantu melihat tren penjualan atau perbandingan performa dalam sekejap. Langkah membuat grafik:</p>
<ol>
  <li>Sorot (blok) kolom kategori dan kolom angka yang ingin dibuat grafik (misalnya Kolom Bulan dan Kolom Penjualan).</li>
  <li>Klik menu <strong>Insert</strong> &gt; pilih jenis grafik:
    <ul>
      <li><strong>Column / Bar Chart:</strong> Bagus untuk membandingkan nominal antar kategori.</li>
      <li><strong>Line Chart (Grafik Garis):</strong> Sangat ideal untuk melihat tren naik-turun dari waktu ke waktu.</li>
      <li><strong>Pie Chart (Diagram Lingkaran):</strong> Cocok untuk melihat persentase kontribusi dari total 100%.</li>
    </ul>
  </li>
  <li>Beri judul grafik yang jelas dan tambahkan Data Labels jika diperlukan.</li>
</ol>', 'https://www.youtube.com/embed/2kRF8zyy25U'),
(5, 2, 'Fungsi Logika: IF Tunggal, IF Bersarang (Nested IF) & IFS', 1, 25, '<h3>Otomasi Keputusan dengan Fungsi Logika IF di Excel</h3>
<p>Fungsi <code>IF</code> adalah salah satu fungsi paling kuat di Excel. Fungsi ini memungkinkan lembar kerja Anda melakukan evaluasi kondisi: jika kondisi terpenuhi (TRUE) lakukan tindakan A, jika tidak terpenuhi (FALSE) lakukan tindakan B.</p>

<h4>Struktur Sintaks Fungsi IF Tunggal:</h4>
<p><code>=IF(tes_logika, nilai_jika_benar, nilai_jika_salah)</code></p>
<p>Contoh nyata: Menentukan kelulusan nilai peserta kursus (KKM = 70):<br>
<code>=IF(C2 >= 70, "LULUS", "MENGULANG")</code></p>

<h4>IF Bersarang (Nested IF):</h4>
<p>Bagaimana jika opsinya lebih dari 2 kemungkinan? Misalnya sistem penilaian huruf mutu (A, B, C, D):</p>
<code>=IF(C2 >= 85, "A", IF(C2 >= 75, "B", IF(C2 >= 60, "C", "D")))</code>

<h4>Fungsi Modern: IFS (Excel 2019 / 365)</h4>
<p>Fungsi <code>IFS</code> jauh lebih bersih dan tidak memerlukan banyak tanda kurung bersarang:</p>
<code>=IFS(C2 >= 85, "A", C2 >= 75, "B", C2 >= 60, "C", TRUE, "D")</code>

<div class="alert-box alert-success">
  <strong>Tips Praktis:</strong> Teks hasil di dalam rumus Excel selalu harus diapit tanda petik ganda <code>"Teks"</code>. Namun jika hasilnya berupa angka, tidak perlu menggunakan tanda petik (misalnya: <code>=IF(A1="Member", 0.1, 0)</code>).
</div>', 'https://www.youtube.com/embed/iX6b58OlsGU'),
(6, 2, 'Relasi Data Cepat dengan VLOOKUP & XLOOKUP', 2, 35, '<h3>Mencari Data Antar Tabel dengan VLOOKUP dan XLOOKUP</h3>
<p>Di tempat kerja, data sering tersebar di beberapa tabel terpisah, misalnya: Tabel Transaksi Kasir hanya berisi Kode Barang, sedangkan Nama Barang dan Harga Satuan tersimpan di Tabel Master Barang. Di sinilah fungsi pencarian (Lookup) bekerja.</p>

<h4>1. Memahami Rumus VLOOKUP (Vertical Lookup)</h4>
<p>Sintaks VLOOKUP:<br>
<code>=VLOOKUP(lookup_value, table_array, col_index_num, [range_lookup])</code></p>
<ul>
  <li><code>lookup_value</code>: Nilai kunci yang dicari (misal: sel kode barang <code>B2</code>).</li>
  <li><code>table_array</code>: Rentang tabel referensi tempat data berada (misal: <code>$F$2:$H$50</code>). Wajib dikunci dengan tanda dollar <code>$</code> agar tidak bergeser saat disalin.</li>
  <li><code>col_index_num</code>: Nomor urutan kolom data yang ingin diambil (dihitung dari kolom kunci = 1).</li>
  <li><code>range_lookup</code>: Selalu isi dengan <code>FALSE</code> atau <code>0</code> untuk pencarian yang tepat sama (Exact Match).</li>
</ul>

<div class="alert-box alert-warning">
  <strong>Kelemahan VLOOKUP Tradisional:</strong> VLOOKUP hanya bisa mencari data ke arah kanan (kolom kunci harus berada di kolom paling kiri dari tabel referensi).
</div>

<h4>2. Revolusi XLOOKUP (Excel Modern)</h4>
<p>Jika Anda memakai Microsoft 365 atau Excel versi terbaru, <code>XLOOKUP</code> menggantikan fungsi VLOOKUP dengan jauh lebih fleksibel:</p>
<code>=XLOOKUP(lookup_value, lookup_array, return_array, [if_not_found])</code>
<p>Kelebihan XLOOKUP: bisa mencari ke kiri maupun ke kanan, tidak memerlukan penghitungan nomor kolom manual, dan menyediakan opsi pesan bawaan jika data tidak ditemukan (misal: <code>"Barang Tidak Terdaftar"</code>).</p>', 'https://www.youtube.com/embed/xIynD1gFOLo'),
(7, 2, 'Meringkas Ribuan Data Seketika dengan Pivot Table', 3, 30, '<h3>Analisis Data Tanpa Rumus Menggunakan Pivot Table</h3>
<p>Pivot Table adalah salah satu fitur paling disukai oleh analis data dan manajer di seluruh dunia. Tanpa perlu mengetik satu rumus pun, Anda dapat mengubah puluhan ribu baris transaksi menjadi ringkasan laporan keuangan atau kinerja penjualan dalam beberapa detik.</p>

<h4>Langkah-Langkah Membuat Pivot Table:</h4>
<ol>
  <li>Pastikan tabel data Anda bersih: setiap kolom wajib memiliki judul header yang jelas, tidak ada sel yang digabungkan (merge cells), dan tidak ada baris yang benar-benar kosong di tengah tabel.</li>
  <li>Klik salah satu sel di dalam area data Anda.</li>
  <li>Buka tab <strong>Insert</strong> &gt; klik <strong>PivotTable</strong> &gt; pilih <strong>New Worksheet</strong> lalu klik OK.</li>
  <li>Di sebelah kanan akan muncul panel <strong>PivotTable Fields</strong> dengan 4 area:
    <ul>
      <li><strong>Filters (Penyaring):</strong> Menyaring seluruh tabel berdasarkan parameter tertentu (misal: Tahun atau Wilayah).</li>
      <li><strong>Columns (Kolom):</strong> Meletakkan kategori secara horizontal di bagian atas.</li>
      <li><strong>Rows (Baris):</strong> Meletakkan kategori secara vertikal di sebelah kiri (misal: Nama Sales atau Kategori Produk).</li>
      <li><strong>Values (Nilai):</strong> Kolom angka yang ingin dihitung totalnya (SUM), dihitung jumlah transaksinya (COUNT), atau rata-ratanya (AVERAGE).</li>
    </ul>
  </li>
</ol>

<div class="alert-box alert-info">
  <strong>Tips: Slicer Interaktif</strong><br>
  Tambahkan <strong>Slicer</strong> pada Pivot Table Anda melalui menu <em>PivotTable Analyze &gt; Insert Slicer</em>. Slicer berfungsi sebagai tombol filter visual berdesain modern yang sangat menarik saat dipresentasikan ke pimpinan.
</div>', 'https://www.youtube.com/embed/m0wI61ahfLc'),
(8, 2, 'Pembersihan Data (Data Cleansing) & Validasi Input', 4, 25, '<h3>Menjaga Akurasi Data Perusahaan</h3>
<p>Prinsip utama data adalah <em>"Garbage In, Garbage Out"</em> (jika data yang diinput berantakan, maka laporan yang dihasilkan juga akan salah). Di modul ini, Anda akan mempelajari teknik membersihkan data yang kotor dari sumber eksternal.</p>

<h4>1. Fungsi Teks Pembersih:</h4>
<ul>
  <li><code>TRIM(teks)</code>: Menghapus spasi ganda yang tidak terlihat di awal, tengah, atau akhir kalimat.</li>
  <li><code>PROPER(teks)</code>: Mengubah format huruf kapital di setiap awal kata (misal: "budi santoso" menjadi "Budi Santoso").</li>
  <li><code>UPPER(teks)</code> dan <code>LOWER(teks)</code>: Mengubah seluruh teks menjadi huruf besar atau kecil.</li>
</ul>

<h4>2. Mencegah Kesalahan Input dengan Data Validation</h4>
<p>Daripada memperbaiki data yang salah, lebih baik mencegah pengguna mengetik data yang keliru. Gunakan fitur <strong>Data Validation</strong>:</p>
<ol>
  <li>Pilih kolom target yang ingin dibatasi (misal: Kolom Departemen).</li>
  <li>Buka tab <strong>Data &gt; Data Validation</strong>.</li>
  <li>Pada opsi <em>Allow</em>, pilih <strong>List</strong>.</li>
  <li>Pada kolom <em>Source</em>, ketik opsi yang diperbolehkan dipisahkan tanda koma: <code>Keuangan, Pemasaran, Operasional, HRD</code>.</li>
  <li>Hasilnya: Pengguna hanya bisa memilih opsi dari menu dropdown yang muncul di sel tersebut!</li>
</ol>', 'https://www.youtube.com/embed/ka09v8z_BN0'),
(9, 3, 'Standar Dokumen Formal, Margin, Kop Surat & Font Resmi', 1, 20, '<h3>Mengenal Format Standar Dokumen Administrasi Perkantoran</h3>
<p>Surat dan dokumen resmi mencerminkan kredibilitas institusi, perusahaan, maupun diri Anda sebagai profesional. Modul ini mengajarkan aturan tata letak yang berlaku umum di dunia kerja Indonesia.</p>

<h4>1. Standar Kertas dan Margin</h4>
<ul>
  <li><strong>Ukuran Kertas:</strong> Selalu gunakan ukuran <strong>A4</strong> (210 x 297 mm) untuk surat dinas dan dokumen bisnis, atau <strong>F4/Folio</strong> (215 x 330 mm) jika disyaratkan khusus. Hindari penggunaan ukuran <em>Letter</em> karena tidak standar di Indonesia.</li>
  <li><strong>Pengaturan Margin Resmi:</strong>
    <ul>
      <li>Margin Atas: 3 cm atau 2.54 cm (1 inch)</li>
      <li>Margin Bawah: 2.54 cm</li>
      <li>Margin Kiri: 3 cm atau 4 cm (jika dokumen akan dijilid)</li>
      <li>Margin Kanan: 2.54 cm atau 3 cm</li>
    </ul>
  </li>
</ul>

<h4>2. Pemilihan Jenis Huruf (Font) Profesional</h4>
<p>Gunakan jenis font yang mudah dibaca dengan ukuran standar perkantoran:</p>
<ul>
  <li>Modern &amp; Bersih: <strong>Calibri (11 pt)</strong> atau <strong>Arial (11 pt)</strong></li>
  <li>Formal Tradisional: <strong>Times New Roman (12 pt)</strong></li>
  <li>Spasi baris (Line Spacing): Umumnya <strong>1.15</strong> atau <strong>1.5 spasi</strong> dengan perataan teks <strong>Justify (Rata Kiri-Kanan)</strong>.</li>
</ul>

<h4>3. Merancang Kop Surat (Header) yang Rapi</h4>
<p>Gunakan fitur <em>Insert &gt; Header</em>. Trik profesional: masukkan tabel 2 kolom tanpa garis (No Border) di dalam Header. Kolom kiri untuk logo organisasi, dan kolom kanan untuk nama instansi, alamat lengkap, kontak telepon, dan email resmi. Tambahkan garis batas bawah kop surat dengan fitur <em>Borders and Shading</em>.</p>', 'https://www.youtube.com/embed/S-nHYzK-BVg'),
(10, 3, 'Tata Letak Paragraf, Tab Stop & Penomoran Otomatis', 2, 25, '<h3>Membuat Dokumen Rapi Tanpa Menekan Tombol Spasi Berkali-kali</h3>
<p>Kebiasaan buruk pemula adalah meratakan teks titik dua (:) atau tanda tangan dengan menekan tombol spasi berkali-kali. Cara tersebut akan membuat dokumen berantakan saat dibuka di komputer lain atau dicetak!</p>

<h4>Gunakan Tab Stop untuk Kerapian Sempurna</h4>
<p>Tab Stop pada Mistar (Ruler) Word memungkinkan kursor melompat ke posisi koordinat horizontal yang persis sama di setiap baris:</p>
<ol>
  <li>Aktifkan Ruler melalui menu <strong>View &gt; Ruler</strong>.</li>
  <li>Sorot baris yang berisi biodata (Nama, NIK, Tempat/Tgl Lahir, Alamat).</li>
  <li>Klik pada Ruler di angka 4 cm untuk posisi titik dua (:), dan di angka 4.5 cm untuk isi keterangan.</li>
  <li>Cukup tekan tombol <strong>Tab</strong> di keyboard satu kali sebelum titik dua, dan satu kali setelah titik dua. Seluruh titik dua Anda akan lurus rapi sempurna!</li>
</ol>

<h4>Penomoran Berjenjang (Multilevel List)</h4>
<p>Untuk menyusun laporan atau proposal yang memiliki bab dan sub-bab (contoh: 1.1, 1.2, 1.2.1), gunakan fitur <strong>Multilevel List</strong> di tab Home. Jangan pernah mengetik nomor bab secara manual agar urutan nomor tidak rusak saat ada pasal atau bab baru yang ditambahkan di tengah.</p>', 'https://www.youtube.com/embed/O7K3K1qK0Uo'),
(11, 3, 'Penomoran Halaman Berbeda (Page Numbering & Section Breaks)', 3, 30, '<h3>Kunci Menulis Laporan Resmi & Skripsi: Section Breaks</h3>
<p>Sering kali dalam dokumen formal, halaman Cover tidak boleh memiliki nomor halaman, halaman Kata Pengantar dan Daftar Isi memakai angka romawi kecil (i, ii, iii), sedangkan Bab Isi memakai angka latin (1, 2, 3). Kuncinya adalah menggunakan <strong>Section Break</strong>.</p>

<h4>Langkah-Langkah Mengatur Penomoran Halaman Berbeda:</h4>
<ol>
  <li><strong>Bagi Dokumen Menjadi Bagian Terpisah:</strong> Letakkan kursor di akhir halaman kata pengantar. Buka tab <strong>Layout &gt; Breaks &gt; Next Page</strong>. Ini akan membagi dokumen menjadi Section 1 dan Section 2.</li>
  <li><strong>Putus Tautan Antar Section (Unlink):</strong> Klik dua kali pada bagian Footer di Section 2. Di menu Ribbon Header &amp; Footer, matikan tombol <strong>Link to Previous</strong>. Langkah ini penting agar pengaturan footer di Section 2 tidak meniru Section 1!</li>
  <li><strong>Atur Format Angka:</strong> Klik <em>Page Number &gt; Format Page Numbers</em>. Pilih format angka latin <code>1, 2, 3</code> dan tentukan <strong>Start at: 1</strong>.</li>
</ol>

<div class="alert-box alert-success">
  Dengan trik ini, Anda bisa mengontrol nomor halaman pada dokumen setebal apa pun secara profesional tanpa perlu memecah file Word menjadi beberapa dokumen terpisah.
</div>', 'https://www.youtube.com/embed/n4_wO0BqCqo'),
(12, 3, 'Mail Merge Otomatis & Ekspor PDF Berkualitas Tinggi', 4, 25, '<h3>Mengirim Ratusan Surat Sekali Klik dengan Mail Merge</h3>
<p>Bayangkan Anda harus membuat 200 surat undangan atau sertifikat kegiatan dengan nama dan alamat penerima yang berbeda-beda. Mengetik satu per satu memakan waktu berjam-jam. Fitur <strong>Mail Merge</strong> menghubungkan dokumen Word Anda dengan data nama di file Excel!</p>

<h4>Cara Kerja Mail Merge:</h4>
<ol>
  <li>Siapkan file Excel sederhana berisi tabel: Kolom A (Nama Penerima), Kolom B (Jabatan), Kolom C (Alamat). Simpan file Excel tersebut.</li>
  <li>Di Word, buka surat template Anda. Buka menu <strong>Mailings &gt; Start Mail Merge &gt; Letters</strong>.</li>
  <li>Klik <strong>Select Recipients &gt; Use an Existing List</strong>, lalu pilih file Excel tadi.</li>
  <li>Letakkan kursor di tempat Anda ingin menyisipkan nama, lalu klik <strong>Insert Merge Field &gt; Nama</strong>.</li>
  <li>Klik <strong>Preview Results</strong> untuk melihat nama penerima berganti otomatis.</li>
  <li>Klik <strong>Finish &amp; Merge</strong> untuk mencetak langsung atau menyimpan ke dokumen terpisah!</li>
</ol>

<h4>Menyimpan ke Format PDF</h4>
<p>Sebelum mengirim dokumen ke atasan atau klien via WhatsApp/Email, selalu konversi ke format PDF agar tata letak tidak bergeser di perangkat penerima. Caranya: <strong>File &gt; Save As &gt; PDF (*.pdf)</strong> atau gunakan menu <strong>Export &gt; Create PDF/XPS</strong>.</p>', 'https://www.youtube.com/embed/rGG-In7PAEk'),
(13, 4, 'Prinsip Desain Slide Modern: Less is More & Hierarki Visual', 1, 20, '<h3>Prinsip Desain Slide yang Disukai Audiens dan Profesional</h3>
<p>Banyak presentasi gagal bukan karena pembicara tidak menguasai materi, melainkan karena slide yang ditampilkan seperti buku teks yang dipindahkan ke layar proyektor. Slide presentasi adalah alat bantu visual (visual aid), bukan naskah membaca untuk pembicara!</p>

<h4>4 Kaidah Emas Slide Presentasi Modern:</h4>
<ol>
  <li><strong>Satu Slide, Satu Pesan Utama:</strong> Jangan menumpuk 5 topik berbeda dalam satu slide. Lebih baik membuat 3 slide terpisah yang ringkas daripada 1 slide penuh sesak.</li>
  <li><strong>Aturan 6x6:</strong> Maksimal 6 baris poin dalam satu slide, dan maksimal 6 kata per baris. Biarkan penjelasan detail keluar dari lisan Anda.</li>
  <li><strong>Hierarki Visual yang Jelas:</strong> Judul harus paling menonjol (ukuran 32-40 pt bold), sub-judul lebih kecil (20-24 pt), dan teks penjelasan (16-18 pt). Jangan gunakan ukuran huruf di bawah 14 pt karena tidak terbaca oleh barisan belakang audiens.</li>
  <li><strong>Kekuatan Ruang Kosong (Whitespace):</strong> Jangan merasa bersalah membiarkan area kosong di slide Anda. Ruang kosong memberikan "ruang bernapas" bagi mata audiens untuk fokus pada poin inti.</li>
</ol>

<div class="alert-box alert-info">
  <strong>Gunakan Palet Warna Terbatas:</strong> Pilih maksimal 3 warna konsisten: 1 warna latar belakang (dominan putih atau abu-abu terang), 1 warna teks utama (hitam atau abu gelap), dan 1 warna aksen tegas (misal hijau teal atau kuning keemasan) untuk menyorot kata kunci penting.
</div>', 'https://www.youtube.com/embed/lwpeqflhyEE'),
(14, 4, 'Mengubah Paragraf Membosankan Menjadi Visual & SmartArt', 2, 25, '<h3>Visual Storytelling: Ganti Teks dengan Infografis</h3>
<p>Otak manusia memproses gambar 60.000 kali lebih cepat daripada teks tertulis. Jika Anda memiliki langkah-langkah kerja atau alur proses, jangan tuliskan dalam bentuk paragraf panjang.</p>

<h4>1. Memanfaatkan SmartArt Cerdas di PowerPoint</h4>
<p>PowerPoint memiliki fitur pengubah teks otomatis menjadi diagram visual:</p>
<ol>
  <li>Ketik poin-poin alur proses Anda seperti biasa.</li>
  <li>Sorot seluruh poin teks tersebut.</li>
  <li>Klik kanan &gt; pilih <strong>Convert to SmartArt</strong>.</li>
  <li>Pilih bentuk alur yang cocok (Process, Hierarchy, Cycle, atau List). Teks Anda seketika berubah menjadi diagram visual berkelas!</li>
</ol>

<h4>2. Menggunakan Ikon Vektor daripada Gambar Berat</h4>
<p>Ikon mempercepat pemahaman audiens. Buka menu <strong>Insert &gt; Icons</strong>. Cari kata kunci seperti "target", "waktu", "uang", "pertumbuhan". Ikon di PowerPoint berbasis vektor, sehingga warnanya bisa diganti sesuai tema dan ukurannya tidak akan pecah saat diperbesar.</p>', 'https://www.youtube.com/embed/Q43eJg3iXis'),
(15, 4, 'Animasi Halus & Transisi Efektif (Morph Transition)', 3, 25, '<h3>Kapan dan Bagaimana Menggunakan Efek Animasi</h3>
<p>Efek animasi yang berlebihan (tulisan berputar-putar, suara tepuk tangan otomatis) akan menurunkan derajat profesionalisme presentasi Anda dan mengalihkan perhatian audiens. Gunakan animasi hanya untuk mengendalikan alur perhatian.</p>

<h4>Prinsip Penggunaan Animasi:</h4>
<ul>
  <li>Gunakan animasi <strong>Fade</strong> atau <strong>Wipe</strong> sederhana untuk memunculkan poin satu per satu saat Anda menjelaskannya, agar audiens tidak membaca slide lebih cepat daripada apa yang sedang Anda ucapkan.</li>
  <li>Atur durasi animasi yang singkat (0.3 sampai 0.5 detik). Animasi yang lambat membuat audiens merasa bosan menunggu.</li>
</ul>

<h4>Keajaiban Efek Transisi MORPH</h4>
<p>Di PowerPoint versi terbaru, fitur transisi <strong>Morph</strong> memungkinkan objek bergerak secara mulus dari satu posisi ke posisi lain antar dua slide berturut-turut. Ini memberi kesan presentasi Anda tampak seperti video animasi profesional buatan desainer grafis handal.</p>', 'https://www.youtube.com/embed/7u5mQ6rfows'),
(16, 4, 'Persiapan Teknis & Menghadapi Sesi Tanya Jawab (Q&A)', 4, 20, '<h3>Etika & Kesiapan Mental Presenter Profesional</h3>
<p>Bahkan slide terindah sekalipun tidak akan berdampak tanpa persiapan eksekusi yang matang di hari H.</p>

<h4>1. Menggunakan Fitur Presenter View</h4>
<p>Saat laptop Anda tersambung ke proyektor atau TV display, aktifkan mode <strong>Presenter View</strong> (tekan <code>Alt + F5</code>). Di layar Anda akan tampil catatan contekan poin bicara, timer waktu berjalan, dan preview slide berikutnya, sementara audiens hanya melihat slide utama Anda secara bersih.</p>

<h4>2. Menjawab Pertanyaan Sulit dengan Anggun:</h4>
<ul>
  <li>Dengarkan pertanyaan sampai selesai tanpa memotong kalimat penanya.</li>
  <li>Ulangi inti pertanyaan secara ringkas untuk memastikan Anda dan seluruh hadirin memahami konteksnya sama.</li>
  <li>Jika Anda belum mengetahui data persisnya, jangan berbohong atau mengarang! Katakan dengan jujur dan tawarkan tindak lanjut: <em>"Pertanyaan yang sangat tajam. Saya tidak memegang angka rincian untuk kuartal tersebut saat ini, namun saya akan mencatat kontak Bapak/Ibu dan mengirimkan laporannya sore ini."</em></li>
</ul>', 'https://www.youtube.com/embed/D8JV3w4TOVw'),
(17, 5, 'Mengenal Sistem ATS (Applicant Tracking System) & Format Resume Standar', 1, 25, '<h3>Bagaimana Robot ATS Menyaring Lamaran Anda</h3>
<p>Perusahaan berskala menengah dan besar menerima ratusan hingga ribuan pelamar untuk satu posisi lowongan kerja. Mustahil bagi tim HRD membaca satu per satu resume secara manual di tahap awal. Mereka menggunakan software bernama <strong>Applicant Tracking System (ATS)</strong> untuk membaca teks CV dan memberi peringkat skor relevansi.</p>

<div class="alert-box alert-danger">
  <strong>Fakta Mengejutkan:</strong> Lebih dari 70% CV pelamar langsung gugur di filter awal ATS bukan karena pelamar tidak pintar, melainkan karena file CV memakai desain grafis Canva yang rumit, kolom tabel ganda yang membingungkan bot, atau teks yang diekspor sebagai gambar!
</div>

<h4>Ciri-Ciri Utama CV ATS-Friendly:</h4>
<ol>
  <li><strong>Tata Letak 1 Kolom (Single Column):</strong> Sangat direkomendasikan karena bot membaca dokumen dari kiri ke kanan dan atas ke bawah secara linear.</li>
  <li><strong>Font Standar yang Terbaca Mesin:</strong> Gunakan Arial, Calibri, Garamond, Georgia, atau Helvetica. Hindari font dekoratif atau kaligrafi.</li>
  <li><strong>Judul Bagian yang Baku:</strong> Gunakan istilah standar seperti <em>Ringkasan Profil (Professional Summary)</em>, <em>Pengalaman Kerja (Work Experience)</em>, <em>Pendidikan (Education)</em>, dan <em>Keterampilan (Skills)</em>. Jangan gunakan istilah puitis seperti "Jejak Langkahku".</li>
  <li><strong>Format File:</strong> Simpan dalam format <code>.PDF</code> berbasis teks (bisa di-blok/copy teksnya) atau <code>.DOCX</code>.</li>
</ol>', 'https://www.youtube.com/embed/ujPEb8f8huQ'),
(18, 5, 'Merumuskan Pengalaman Kerja Berbasis Dampak (Formula XYZ Google)', 2, 30, '<h3>Tinggalkan Deskripsi Tugas Membosankan, Tampilkan Prestasi Nyata!</h3>
<p>Banyak pencari kerja hanya menuliskan daftar tugas harian di CV, contohnya: <em>"Bertanggung jawab menginput data penjualan dan melayani pelanggan."</em> Kalimat ini pasif dan tidak membedakan Anda dari ratusan pelamar lainnya.</p>

<h4>Formula Prestasi Google (X-Y-Z Formula):</h4>
<div class="alert-box alert-success">
  <strong>"Mencapai [X], yang diukur dengan [Y], dengan melakukan [Z]."</strong>
</div>

<p>Mari kita bandingkan perbedaannya:</p>
<table class="table-custom">
  <thead>
    <tr>
      <th>Penulisan Biasa (Lemah)</th>
      <th>Penulisan Berdampak / ATS Kuat</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Mengelola media sosial toko.</td>
      <td>Meningkatkan interaksi media sosial sebesar 45% dalam 3 bulan melalui produksi 20 video konten tutorial produk yang konsisten.</td>
    </tr>
    <tr>
      <td>Membuat rekap laporan keuangan di Excel.</td>
      <td>Mengotomasi rekonsiliasi kas harian menggunakan rumus VLOOKUP dan Pivot Table, memangkas waktu pelaporan dari 4 jam menjadi 45 menit per hari.</td>
    </tr>
    <tr>
      <td>Melayani komplain pelanggan di toko.</td>
      <td>Menangani lebih dari 60 keluhan pelanggan per minggu dengan tingkat kepuasan layanan mencapai 94% berdasarkan survey kepuasan pelanggan.</td>
    </tr>
  </tbody>
</table>

<h4>Gunakan Kata Kerja Aksi (Action Verbs):</h4>
<p>Awali setiap poin pengalaman dengan kata kerja aktif: <em>Mengembangkan, Mengoptimalkan, Menginisiasi, Mengkoordinasikan, Memangkas biaya, Memimpin, Merancang.</em></p>', 'https://www.youtube.com/embed/Tt08KmFfIYQ'),
(19, 5, 'Menulis Surat Lamaran (Cover Letter) yang Menggugah HRD', 3, 25, '<h3>Surat Lamaran Bukan Salinan CV, Tapi Cerita Motivasi Anda</h3>
<p>Surat lamaran kerja (Cover Letter) adalah kesempatan Anda menunjukkan kepribadian, antusiasme terhadap perusahaan yang dilamar, dan alasan mengapa latar belakang Anda adalah solusi untuk kebutuhan posisi tersebut.</p>

<h4>Struktur Surat Lamaran 3 Paragraf yang Terbukti Efektif:</h4>
<ol>
  <li><strong>Paragraf Pembuka:</strong> Sebutkan secara spesifik posisi yang dilamar, dari mana Anda mengetahui lowongan tersebut, dan satu kalimat hook tentang keahlian utama Anda yang paling relevan. Hindari pembuka kuno seperti <em>"Melalui surat ini saya yang bertanda tangan di bawah ini..."</em>.</li>
  <li><strong>Paragraf Isi (Koneksi Masalah &amp; Solusi):</strong> Tunjukkan bahwa Anda telah meriset perusahaan tersebut. Jelaskan satu atau dua pencapaian terbesar Anda di masa lalu dan bagaimana keahlian itu langsung bisa diterapkan untuk menyelesaikan tantangan pekerjaan di sana.</li>
  <li><strong>Paragraf Penutup (Call to Action):</strong> Nyatakan kesiapan Anda untuk berdiskusi lebih mendalam dalam sesi wawancara, sampaikan apresiasi atas waktu rekruter, dan cantumkan kontak aktif Anda secara sopan.</li>
</ol>

<div class="alert-box alert-warning">
  <strong>Peringatan Penting:</strong> Jangan pernah mengirim satu surat lamaran yang sama untuk 10 perusahaan berbeda tanpa mengubah nama perusahaan dan kebutuhan posisi. HRD yang berpengalaman dapat mencium surat lamaran ''copy-paste'' dalam 5 detik pertama!
</div>', 'https://www.youtube.com/embed/Q7Vq1158bTQ'),
(20, 5, 'Optimasi Portofolio Digital & Checklist Final Sebelum Mengirim', 4, 20, '<h3>Bukti Nyata Karya: Bangun Portofolio Sederhana tapi Meyakinkan</h3>
<p>Di era digital, rekruter ingin melihat bukti kompetensi Anda (Proof of Work). Walaupun Anda belum memiliki pengalaman kerja formal kantor, Anda tetap bisa membuat portofolio dari tugas kursus atau proyek sukarela!</p>

<h4>Ide Portofolio Berdasarkan Bidang:</h4>
<ul>
  <li><strong>Administrasi / Data:</strong> Tautkan link Google Drive berisi file sampel spreadsheet Excel yang Anda buat (lengkap dengan formula, tabel, dan grafik otomatis).</li>
  <li><strong>Desain / Pemasaran:</strong> Tautkan link portofolio online (misal link PDF Google Drive atau akun Instagram proyek) berisi materi promosi yang pernah Anda rancang.</li>
  <li><strong>Penulisan:</strong> Kumpulan artikel, surat dinas, atau draf SOP yang pernah Anda susun secara rapi.</li>
</ul>

<h4>Checklist Sebelum Klik Kirim Lamaran:</h4>
<ul>
  <li>[ ] Format nama file dokumen sudah profesional, contoh: <code>CV_Budi_Santoso_Staff_Administrasi.pdf</code> (bukan sekadar <code>cv_terbaru_revisi2.pdf</code>).</li>
  <li>[ ] Bebas dari salah ketik (typo) dan tanda baca berantakan.</li>
  <li>[ ] Nomor telepon WhatsApp dan alamat email aktif dan bisa dihubungi kapan saja.</li>
  <li>[ ] Alamat email formal (misal: <code>budi.santoso@email.com</code>, bukan nama akun permainan atau alay).</li>
</ul>', 'https://www.youtube.com/embed/-Q1aIA1qMzs'),
(21, 6, 'Bedah Pertanyaan Pembuka: ''Ceritakan Tentang Diri Anda''', 1, 25, '<h3>Mengawali Wawancara dengan Percaya Diri dan Memikat</h3>
<p>Hampir 95% sesi wawancara kerja selalu diawali dengan pertanyaan: <em>"Silakan perkenalkan diri Anda"</em> atau <em>"Ceritakan tentang diri Anda"</em>. Ini bukan berarti pewawancara ingin mendengar riwayat masa kecil atau hobi pribadi Anda yang tidak ada hubungannya dengan pekerjaan.</p>

<h4>Gunakan Rumus Waktu: Masa Lalu - Masa Kini - Masa Depan (Past - Present - Future)</h4>
<ol>
  <li><strong>Masa Kini (Present - 40% durasi):</strong> Mulai dengan posisi Anda saat ini, keahlian utama yang Anda miliki, dan satu pencapaian terkini. <em>"Saat ini saya aktif memperdalam keterampilan administrasi data dan pengolahan spreadsheet di Skill4Life, di mana saya terbiasa mengolah database ratusan baris secara teratur..."</em></li>
  <li><strong>Masa Lalu (Past - 30% durasi):</strong> Latar belakang pendidikan atau pengalaman relevan sebelumnya yang membentuk keahlian kerja Anda saat ini.</li>
  <li><strong>Masa Depan (Future - 30% durasi):</strong> Alasan mengapa posisi di perusahaan ini adalah langkah karir berikutnya yang sangat tepat untuk Anda dan bagaimana Anda bisa berkontribusi.</li>
</ol>

<div class="alert-box alert-info">
  <strong>Durasi Ideal:</strong> Jaga jawaban perkenalan Anda antara <strong>1.5 hingga 2 menit</strong>. Jangan terlalu singkat (di bawah 30 detik) dan jangan terlalu bertele-tele hingga membosankan pewawancara.
</div>', 'https://www.youtube.com/embed/l_kJgyhbYio'),
(22, 6, 'Menjawab Pertanyaan Behavioral dengan Metode STAR', 2, 30, '<h3>Rahasia Menjawab Pertanyaan Studi Kasus Perilaku HRD</h3>
<p>Pewawancara sering mengajukan pertanyaan berbasis pengalaman masa lalu untuk memprediksi perilaku kerja Anda di masa mendatang, contoh: <em>"Ceritakan saat Anda menghadapi tenggat waktu (deadline) yang sangat sempit dan apa yang Anda lakukan?"</em></p>

<h4>Metode STAR (Situation, Task, Action, Result):</h4>
<ul>
  <li><strong>S - Situation (Situasi):</strong> Ceritakan latar belakang konteks masalah secara singkat dan jelas (kapan, di mana, situasinya seperti apa).</li>
  <li><strong>T - Task (Tugas):</strong> Jelaskan apa tanggung jawab atau tantangan spesifik yang harus diselesaikan pada situasi tersebut.</li>
  <li><strong>A - Action (Aksi):</strong> Bagian terpenting! Jelaskan langkah konkret yang <em>Anda sendiri</em> ambil untuk mengatasi masalah. Gunakan kata "Saya melakukan...", bukan hanya "Kami".</li>
  <li><strong>R - Result (Hasil):</strong> Akhiri dengan hasil positif yang terukur dari tindakan Anda. Apa dampak bagi tim atau pelanggan? Pelajaran apa yang Anda peroleh?</li>
</ul>

<div class="alert-box alert-success">
  <strong>Contoh Nyata Jawaban STAR:</strong><br>
  <em>"Pada proyek kegiatan sebelumnya (S), sistem pembukuan kas masih dicatat manual di buku tulis sehingga sering terjadi selisih pencatatan (T). Saya berinisiatif merancang template spreadsheet Excel otomatis lengkap dengan rumus validasi dan melatih rekan tim selama 2 hari (A). Hasilnya, selisih laporan kas berkurang hingga 100% dan waktu tutup buku bulanan menjadi 3 hari lebih cepat (R)."</em>
</div>', 'https://www.youtube.com/embed/gZ2354BH0a0'),
(23, 6, 'Bahasa Tubuh, Etika Interview Daring/Luring & Kontak Mata', 3, 20, '<h3>Kesan Pertama (First Impression) Terbentuk dalam 7 Detik Pertama</h3>
<p>Komunikasi bukan hanya tentang kata-kata yang diucapkan, melainkan juga sinyal non-verbal yang Anda pancarkan ke ruangan wawancara.</p>

<h4>Etika Interview Tatap Muka (Offline):</h4>
<ul>
  <li>Tiba di lokasi 15-20 menit lebih awal. Ini memberi Anda waktu untuk menenangkan nafas dan merapikan pakaian.</li>
  <li>Jabat tangan dengan tegas dan hangat (jika situasi memungkinkan), sertai senyuman tulus.</li>
  <li>Duduk tegak, jangan menyilangkan tangan di dada (terkesan defensif/tertutup), dan pertahankan kontak mata alami (tidak menatap tajam melotot, namun tidak membuang pandangan ke lantai).</li>
</ul>

<h4>Etika Interview Daring (Zoom / Google Meet):</h4>
<ul>
  <li>Uji mikrofon, kamera, dan kestabilan koneksi internet 30 menit sebelum jadwal.</li>
  <li>Pastikan pencahayaan datang dari depan wajah Anda (bukan membelakangi lampu/jendela yang membuat wajah gelap).</li>
  <li><strong>Trik Kontak Mata Daring:</strong> Saat berbicara, tatap langsung lubang lensa kamera web (webcam) Anda, bukan layar monitor, agar pewawancara merasa sedang ditatap matanya secara langsung!</li>
</ul>', 'https://www.youtube.com/embed/wX-yU1L5N-8'),
(24, 6, 'Pertanyaan Balik untuk HRD, Negosiasi Gaji & Email Ucapan Terima Kasih', 4, 25, '<h3>Menutup Sesi Wawancara dengan Kesan Luar Biasa</h3>
<p>Di akhir wawancara, pewawancara hampir selalu bertanya: <em>"Apakah ada pertanyaan yang ingin Anda tanyakan kepada kami?"</em>. Jika Anda menjawab <em>"Tidak ada, sudah cukup jelas"</em>, Anda melewatkan kesempatan emas untuk menunjukkan bahwa Anda orang yang bersemangat dan kritis!</p>

<h4>3 Pertanyaan Berbobot untuk Anda Tanyakan ke HRD:</h4>
<ol>
  <li><em>"Bagi kandidat yang berhasil menempati posisi ini, apa tolok ukur kesuksesan utama dalam 3 bulan pertama masa kerja?"</em></li>
  <li><em>"Bagaimana budaya kerja di tim ini dalam menghadapi tantangan baru atau perubahan prioritas kerja?"</em></li>
  <li><em>"Apa yang paling Bapak/Ibu sukai dari pengalaman bekerja di perusahaan ini?"</em></li>
</ol>

<h4>Kirim Email Ucapan Terima Kasih (Thank You Note)</h4>
<p>Kirimkan email singkat dalam kurun waktu maksimal 24 jam setelah sesi interview. Ucapkan terima kasih atas waktu mereka, sebutkan secara singkat satu poin menarik yang sempat dibahas saat wawancara, dan tegaskan kembali antusiasme Anda untuk bergabung. Tindakan sederhana ini membedakan Anda dari 90% pelamar lainnya.</p>', 'https://www.youtube.com/embed/qrLlE7AtrI8'),
(25, 7, 'Pola Pikir Keuangan & Alokasi Anggaran Sederhana (Formula 50/30/20)', 1, 20, '<h3>Mengubah Hubungan Anda dengan Uang</h3>
<p>Kemiskinan dan kesulitan finansial sering kali diperparah bukan hanya karena pendapatan yang terbatas, melainkan karena ketiadaan sistem pengelolaan arus kas (cash flow) yang terencana. Uang masuk langsung habis tanpa jejak.</p>

<h4>Metode Alokasi 50 / 30 / 20 untuk Pekerja &amp; Rumah Tangga:</h4>
<ul>
  <li><strong>50% - Kebutuhan Mutlak (Needs):</strong> Biaya hidup pokok yang wajib ada: beras, makanan pokok harian, sewa tempat tinggal/kontrakan, listrik, air, pulsa operasional, dan cicilan produktif yang sedang berjalan.</li>
  <li><strong>30% - Keinginan (Wants):</strong> Kesenangan hidup wajar: jajan kopi, pakaian baru yang belum mendesak, hiburan akhir pekan, langganan film. Bagian inilah yang paling pertama harus dipangkas saat kondisi mendesak.</li>
  <li><strong>20% - Masa Depan &amp; Tabungan (Savings/Debt):</strong> Membayar hutang pokok lebih cepat, membangun dana darurat, dan modal tabungan usaha mandiri.</li>
</ul>

<div class="alert-box alert-success">
  <strong>Prinsip Utama: Menabung di Awal, Bukan di Akhir!</strong><br>
  Begitu Anda menerima gaji atau penghasilan hasil penjualan hari ini, langsung sisihkan persentase tabungan ke rekening atau amplop terpisah. Jangan menunggu sisa uang di akhir bulan, karena uang tidak pernah bersisa jika tidak dialokasikan di awal!
</div>', 'https://www.youtube.com/embed/n4YoZDQs6VA'),
(26, 7, 'Membangun Dana Darurat dari Nol & Catatan Kas Harian', 2, 25, '<h3>Penyelamat dari Badai Kehidupan: Dana Darurat</h3>
<p>Banyak keluarga yang tadinya berkecukupan tiba-tiba jatuh miskin hanya karena satu musibah: anggota keluarga sakit keras, motor satu-satunya untuk ngojek mogok, atau pemutusan hubungan kerja (PHK) mendadak. Tanpa dana darurat, satu-satunya jalan keluar yang diambil sering kali adalah berhutang dengan bunga tinggi.</p>

<h4>Berapa Jumlah Dana Darurat yang Ideal?</h4>
<ul>
  <li>Lajang / Belum Berkeluarga: Minimal <strong>3 kali pengeluaran bulanan</strong>.</li>
  <li>Sudah Menikah: Minimal <strong>6 kali pengeluaran bulanan</strong>.</li>
  <li>Pekerja Lepas / Wirausaha: Minimal <strong>9 - 12 kali pengeluaran bulanan</strong> karena penghasilan tidak tentu.</li>
</ul>

<h4>Cara Mulai Mencatat Kas Tanpa Ribet:</h4>
<p>Gunakan aplikasi gratis di HP atau buku tulis saku. Catat setiap pengeluaran sekecil apa pun (termasuk uang parkir Rp 2.000 atau air mineral). Di akhir minggu, evaluasi: Anda akan terkejut melihat betapa banyak uang yang bocor halus pada pengeluaran-pengeluaran kecil yang sebenarnya tidak penting!</p>', 'https://www.youtube.com/embed/HQzoZfc3GwQ'),
(27, 7, 'Mengenali Jebakan Pinjol Ilegal & Menghindari Jerat Hutang Konsumtif', 3, 25, '<h3>Waspada Predator Finansial yang Menghancurkan Masa Depan</h3>
<p>Kemudahan teknologi membuat pinjaman online (pinjol) ilegal dan paylater merajalela menyasar masyarakat berpenghasilan rendah dengan iming-iming <em>"Cair 5 Menit Tanpa Jaminan"</em>. Dampaknya adalah teror penagihan kasar, bunga harian berlipat ganda, dan kepanikan keluarga.</p>

<h4>Perbedaan Tegas Pinjol Legal (OJK) vs Pinjol Ilegal:</h4>
<table class="table-custom">
  <thead>
    <tr>
      <th>Parameter</th>
      <th>Pinjol Legal Terdaftar OJK</th>
      <th>Pinjol Ilegal (Berbahaya)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Izin Resmi</td>
      <td>Terdaftar dan diawasi resmi oleh Otoritas Jasa Keuangan (OJK).</td>
      <td>Tidak memiliki izin resmi atau mencatut logo OJK secara palsu.</td>
    </tr>
    <tr>
      <td>Akses Data HP</td>
      <td>Hanya diizinkan mengakses 3 hal (Kamera, Mikrofon, Lokasi).</td>
      <td>Meminta akses seluruh kontak telepon, galeri foto pribadi, dan pesan SMS.</td>
    </tr>
    <tr>
      <td>Batas Bunga &amp; Denda</td>
      <td>Transparan dan dibatasi aturan AFPI/OJK.</td>
      <td>Bunga tidak masuk akal, bisa mencapai 1-2% per hari tanpa batasan total.</td>
    </tr>
    <tr>
      <td>Cara Penagihan</td>
      <td>Wajib bersertifikat penagihan, dilarang mengancam dan mempermalukan.</td>
      <td>Meneror seluruh kontak keluarga, teman kerja, dan memfitnah di media sosial.</td>
    </tr>
  </tbody>
</table>

<div class="alert-box alert-danger">
  <strong>Aturan Emas:</strong> Jangan pernah meminjam uang untuk kebutuhan konsumtif (membeli gadget baru, gaya hidup, atau gengsi). Hutang hanya boleh dipertimbangkan untuk aset produktif yang menghasilkan keuntungan lebih besar dari bunga pinjaman!
</div>', 'https://www.youtube.com/embed/fHhJ9J0z9nU'),
(28, 8, 'Validasi Ide Bisnis dari Masalah Nyata di Sekitar', 1, 25, '<h3>Bisnis yang Sukses Berawal dari Solusi Masalah Nyata</h3>
<p>Banyak pemula gagal karena membuat produk yang mereka sukai sendiri, tanpa pernah mengecek apakah ada orang yang mau membayar produk tersebut. Bisnis adalah pertukaran nilai: Anda menyelesaikan masalah orang lain, dan orang lain dengan senang hati membayar Anda.</p>

<h4>Cara Menemukan Ide Usaha Bermodal Minim:</h4>
<ol>
  <li><strong>Amati Keluhan di Lingkungan Anda:</strong> Apakah tetangga Anda kesulitan mencari sarapan bergizi yang bersih dan cepat di pagi hari? Apakah banyak kantor sekitar yang butuh jasa laundry kilat atau snack sore?</li>
  <li><strong>Kombinasikan dengan Keterampilan yang Anda Miliki:</strong> Jika Anda pandai memasak, merapikan dokumen, mencuci motor, atau merawat tanaman, jadikan itu sebagai modal awal jasa atau produk Anda.</li>
  <li><strong>Mulai dengan Model Pre-Order (PO):</strong> Jangan menyewa toko mahal atau memproduksi barang dalam jumlah ratusan unit di awal. Tawarkan sistem pesan terlebih dahulu (PO) ke lingkaran teman dan keluarga. Gunakan uang muka (DP) pelanggan untuk membeli bahan baku. Dengan cara ini, Anda tidak menanggung risiko barang sisa atau modal macet!</li>
</ol>', 'https://www.youtube.com/embed/PQbnT_ms_x8'),
(29, 8, 'Menghitung HPP (Harga Pokok Penjualan) & Menentukan Untung', 2, 30, '<h3>Jangan Sampai Terlihat Ramai Tapi Sebenarnya Boncos/Rugi!</h3>
<p>Kesalahan paling fatal pedagang kecil adalah menentukan harga jual hanya berdasarkan perkiraan atau meniru harga tetangga tanpa menghitung detail biaya produksi sendiri.</p>

<h4>Komponen Penghitungan HPP (Harga Pokok Penjualan):</h4>
<ul>
  <li><strong>Biaya Bahan Baku Langsung:</strong> Tepung, minyak, bumbu, kemasan plastik, stiker label, sedotan.</li>
  <li><strong>Biaya Operasional Langsung:</strong> Gas elpiji, listrik, bensin pengantaran.</li>
  <li><strong>Upah Tenaga Kerja Diri Sendiri:</strong> Sering dilupakan! Anda wajib memperhitungkan gaji untuk tenaga Anda sendiri sebagai pembuat produk agar usaha bisa mandiri.</li>
</ul>

<h4>Rumus Menentukan Harga Jual:</h4>
<div class="alert-box alert-info">
  <code>HPP per Porsi = Total Seluruh Biaya Produksi / Jumlah Porsi yang Dihasilkan</code><br>
  <code>Harga Jual = HPP per Porsi + Keuntungan yang Diinginkan (Markup Profit)</code>
</div>

<p>Contoh: Total belanja bahan dan operasional untuk 50 porsi makanan adalah Rp 250.000. Maka HPP per porsi = Rp 5.000. Jika Anda ingin keuntungan bersih 40% (Rp 2.000), maka jual dengan harga Rp 7.000 per porsi.</p>', 'https://www.youtube.com/embed/jwOkQr7xkug'),
(30, 8, 'Promosi Gratis & Efektif dengan WhatsApp Business', 3, 25, '<h3>Maksimalkan WhatsApp di HP Anda Menjadi Toko Otomatis</h3>
<p>Hampir seluruh masyarakat Indonesia menggunakan aplikasi WhatsApp setiap hari. Daripada sekadar memakai WhatsApp pribadi biasa, beralihlah ke <strong>WhatsApp Business</strong> yang 100% gratis di Google Play Store.</p>

<h4>Fitur Sakti WhatsApp Business untuk UMKM:</h4>
<ol>
  <li><strong>Profil Bisnis Profesional:</strong> Pasang foto profil logo/produk yang jelas, jam operasional buka-tutup toko, alamat lokasi, dan email resmi.</li>
  <li><strong>Fitur Katalog Produk:</strong> Anda bisa mengunggah foto produk lengkap dengan judul, deskripsi bahan/ukuran, dan harga. Pelanggan bisa melihat menu atau produk Anda kapan saja tanpa perlu Anda ketik berulang-ulang!</li>
  <li><strong>Pesan Otomatis (Greeting &amp; Away Message):</strong> Balas sapaan pelanggan baru secara instan dalam hitungan detik meski Anda sedang sibuk di dapur.</li>
  <li><strong>Label Obrolan (Chat Labels):</strong> Kelompokkan kontak pelanggan dengan warna berbeda: <em>Pesanan Baru, Menunggu Pembayaran, Sudah Lunas, Siap Dikirim</em>. Pengelolaan pesanan Anda menjadi sangat rapi!</li>
</ol>', 'https://www.youtube.com/embed/QjrLSSlEZ4k'),
(31, 8, 'Teknik Foto Produk Menarik dengan Kamera HP & Pencahayaan Alami', 4, 20, '<h3>Foto yang Menggugah Selera Menjual Lebih Cepat</h3>
<p>Di dunia online, pembeli membeli dengan mata sebelum membeli dengan lidah atau logika. Anda tidak membutuhkan kamera DSLR mahal seharga puluhan juta untuk menghasilkan foto produk yang memikat.</p>

<h4>Tips Fotografi Produk Hanya dengan HP Sederhana:</h4>
<ul>
  <li><strong>Manfaatkan Cahaya Alami Matahari (Window Light):</strong> Foto produk di samping jendela rumah pada jam 8-10 pagi atau 3-4 sore. Cahaya matahari pagi memberikan pencahayaan yang lembut, alami, dan tidak menghasilkan bayangan kasar. Hindari menggunakan lampu flash bawaan HP yang membuat foto tampak pucat dan berminyak.</li>
  <li><strong>Gunakan Background Bersih:</strong> Gunakan kertas karton putih polos seharga Rp 3.000 atau papan kayu bersih sebagai alas foto. Latar belakang yang bersih membuat produk Anda menjadi bintang utama.</li>
  <li><strong>Bersihkan Lensa Kamera:</strong> Sebelum memotret, selalu lap lensa kamera ponsel Anda dengan kain kaos lembut atau tisu kacamata. Sidik jari atau minyak di lensa adalah penyebab nomor satu foto terlihat buram dan berkabut!</li>
</ul>', 'https://www.youtube.com/embed/38yDSebWQEc');

-- 5. Soal Kuis Akhir Kursus (10 Soal per Kursus)
INSERT INTO `soal_kuis` (`id`, `kursus_id`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban_benar`, `pembahasan`, `urutan`) VALUES
(1, 1, 'Setiap penulisan rumus atau formula di dalam Microsoft Excel wajib diawali dengan karakter...', 'Tanda tambah (+)', 'Tanda sama dengan (=)', 'Tanda bintang (*)', 'Tanda seru (!)', 'B', 'Semua rumus atau fungsi di Excel wajib diawali tanda sama dengan (=) agar Excel mengeksekusinya sebagai perhitungan matematika.', 1),
(2, 1, 'Pertemuan antara kolom C dan baris nomor 8 di lembar kerja Excel dinamakan...', 'Range C8', 'Baris C8', 'Sel C8', 'Header C8', 'C', 'Pertemuan antara sebuah kolom dan baris disebut Sel (Cell), ditulis dengan huruf kolom diikuti nomor baris, contohnya Sel C8.', 2),
(3, 1, 'Fungsi yang digunakan untuk menjumlahkan seluruh angka dalam rentang sel tertentu adalah...', 'AVERAGE', 'SUM', 'COUNT', 'MAX', 'B', 'Fungsi SUM digunakan untuk menghitung total penjumlahan dari sekumpulan sel angka.', 3),
(4, 1, 'Untuk menghitung nilai rata-rata dari sekumpulan data angka, fungsi yang tepat adalah...', 'AVERAGE', 'MEDIAN', 'SUM', 'COUNT', 'A', 'Fungsi AVERAGE digunakan untuk mencari nilai rata-rata aritmatika dari rentang data yang dipilih.', 4),
(5, 1, 'Apa perbedaan mendasar antara fungsi COUNT dan COUNTA?', 'COUNT menghitung sel teks, COUNTA menghitung sel angka', 'COUNT hanya menghitung sel yang berisi angka, sedangkan COUNTA menghitung sel yang terisi data apa saja (teks maupun angka)', 'COUNT digunakan untuk pengurangan, COUNTA untuk penambahan', 'Tidak ada perbedaan, keduanya menghasilkan nilai yang sama persis', 'B', 'COUNT khusus menghitung sel berisi nilai numerik/angka, sedangkan COUNTA menghitung semua sel yang tidak kosong (non-empty).', 5),
(6, 1, 'Kombinasi tombol keyboard (shortcut) untuk menyimpan dokumen Excel dengan cepat adalah...', 'Ctrl + C', 'Ctrl + P', 'Ctrl + S', 'Ctrl + Z', 'C', 'Ctrl + S adalah shortcut standar di Windows untuk menyimpan file (Save).', 6),
(7, 1, 'Bagaimana cara yang benar untuk memformat angka 50000 agar memiliki lambang mata uang Rp di Excel?', 'Ketik manual ''Rp 50.000'' pada sel', 'Ketik angka 50000 lalu ubah format sel melalui menu Number Format menjadi Currency/Accounting', 'Menggunakan rumus =RP(50000)', 'Menambahkan spasi di depan angka 50000', 'B', 'Ketik angka murni tanpa teks, kemudian terapkan format sel Currency/Accounting agar nilai tetap dapat dihitung dengan rumus.', 7),
(8, 1, 'Fitur yang digunakan untuk mengunci baris judul paling atas agar tetap terlihat saat lembar kerja di-scroll ke bawah adalah...', 'Merge Cells', 'Wrap Text', 'Freeze Panes (Freeze Top Row)', 'Split Cells', 'C', 'Freeze Panes (khususnya Freeze Top Row) berguna mengunci baris judul agar tetap tampil saat navigasi data yang panjang.', 8),
(9, 1, 'Fungsi yang digunakan untuk mencari nilai tertinggi dalam suatu rentang data adalah...', 'MIN', 'MAX', 'TOP', 'HIGH', 'B', 'Fungsi MAX (Maximum) mengembalikan nilai numerik terbesar dari sekumpulan sel.', 9),
(10, 1, 'Jenis grafik yang paling tepat digunakan untuk melihat tren kenaikan atau penurunan data dari bulan ke bulan adalah...', 'Pie Chart (Diagram Lingkaran)', 'Line Chart (Grafik Garis)', 'Scatter Plot', 'Doughnut Chart', 'B', 'Line Chart (grafik garis) sangat efektif memperlihatkan pergerakan tren data dari waktu ke waktu (time series).', 10),
(11, 2, 'Pada penulisan rumus =IF(A1>=70, ''LULUS'', ''REMIDIAL''), apa hasil yang keluar jika sel A1 bernilai 82?', 'REMIDIAL', 'LULUS', '#VALUE!', 'FALSE', 'B', 'Karena nilai A1 (82) lebih besar atau sama dengan 70, maka kondisi bernilai TRUE dan menghasilkan teks ''LULUS''.', 1),
(12, 2, 'Apa arti huruf ''V'' pada nama fungsi VLOOKUP di Microsoft Excel?', 'Value', 'Virtual', 'Vertical', 'Variable', 'C', 'VLOOKUP singkatan dari Vertical Lookup, yaitu mencari data secara vertikal dari atas ke bawah pada kolom referensi.', 2),
(13, 2, 'Argumen terakhir pada rumus VLOOKUP biasanya diisi dengan angka 0 atau FALSE. Apa fungsi parameter tersebut?', 'Mencari kecocokan nilai yang mendekati (Approximate match)', 'Mencari kecocokan nilai yang tepat sama persis (Exact match)', 'Menyembunyikan pesan kesalahan', 'Mengurutkan data dari Z ke A', 'B', 'Nilai FALSE atau 0 menginstruksikan VLOOKUP untuk hanya mengambil data yang benar-benar cocok sama persis (Exact Match).', 3),
(14, 2, 'Simbol apa yang digunakan untuk mengunci alamat sel menjadi referensi absolut (agar tidak bergeser saat dicopy)?', 'Tanda pagar (#)', 'Tanda seru (!)', 'Tanda dollar ($)', 'Tanda persen (%)', 'C', 'Tanda dollar ($), misalnya $A$1, mengunci koordinat kolom dan baris sehingga alamat sel bersifat absolut.', 4),
(15, 2, 'Fitur Excel yang sangat andal untuk meringkas, mengelompokkan, dan menganalisis puluhan ribu baris data tanpa rumus adalah...', 'Goal Seek', 'Solver', 'Pivot Table', 'Data Validation', 'C', 'Pivot Table adalah alat analitik serbaguna untuk membuat rangkuman dan agregasi data secara dinamis tanpa mengetik rumus.', 5),
(16, 2, 'Manakah keunggulan utama fungsi modern XLOOKUP dibanding VLOOKUP tradisional?', 'XLOOKUP hanya bisa bekerja pada teks pendek', 'XLOOKUP bisa mencari data ke arah kiri maupun kanan, dan tidak terganggu oleh penambahan kolom baru', 'XLOOKUP membutuhkan koneksi internet', 'XLOOKUP tidak memerlukan argumen', 'B', 'XLOOKUP mengatasi keterbatasan VLOOKUP dengan fleksibilitas pencarian dua arah (kiri/kanan) serta penanganan error bawaan.', 6),
(17, 2, 'Fungsi teks yang digunakan untuk membuang spasi berlebih yang tidak sengaja terketik di awal atau akhir kata adalah...', 'CLEAN', 'TRIM', 'DELETE', 'ERASE', 'B', 'Fungsi TRIM membersihkan spasi ganda dan spasi di ujung awal/akhir string teks.', 7),
(18, 2, 'Untuk membatasi input pengguna agar hanya bisa memilih dari daftar pilihan dropdown, fitur yang digunakan adalah...', 'Data Validation dengan tipe List', 'Conditional Formatting', 'AutoFilter', 'Consolidate', 'A', 'Data Validation dengan kriteria List membuat dropdown menu yang membatasi input hanya pada item yang disetujui.', 8),
(19, 2, 'Fungsi teks untuk mengubah huruf pertama di setiap kata menjadi huruf kapital (contoh: ''budi santoso'' menjadi ''Budi Santoso'') adalah...', 'UPPER', 'LOWER', 'PROPER', 'CAPITALIZE', 'C', 'Fungsi PROPER mengubah huruf awal setiap kata menjadi huruf besar (Title Case).', 9),
(20, 2, 'Komponen visual interaktif yang berfungsi sebagai tombol penyaring cepat pada Pivot Table disebut...', 'Filter Bar', 'Slicer', 'Macro Button', 'Sparkline', 'B', 'Slicer menyediakan tombol antarmuka grafis yang ramah pengguna untuk memfilter data Pivot Table dalam satu klik.', 10),
(21, 3, 'Ukuran kertas standar internasional yang paling umum digunakan untuk surat dinas dan dokumen perkantoran di Indonesia adalah...', 'Letter', 'Legal', 'A4', 'A3', 'C', 'Kertas A4 (210 x 297 mm) adalah ukuran baku untuk surat dinas dan dokumen perkantoran di Indonesia.', 1),
(22, 3, 'Kombinasi tombol keyboard untuk mengatur perataan paragraf menjadi Rata Kiri-Kanan (Justify) adalah...', 'Ctrl + L', 'Ctrl + R', 'Ctrl + E', 'Ctrl + J', 'D', 'Ctrl + J adalah pintasan untuk perataan teks Justify (rata tepi kiri dan kanan).', 2),
(23, 3, 'Fitur di Microsoft Word yang digunakan untuk membuat ratusan surat atau sertifikat dengan nama berbeda secara otomatis dari data Excel adalah...', 'AutoText', 'Mail Merge', 'Macro Recorder', 'Track Changes', 'B', 'Mail Merge menggabungkan dokumen master Word dengan sumber data (misal Excel) untuk surat massal beridentitas unik.', 3),
(24, 3, 'Cara terbaik untuk meluruskan tanda titik dua (:) pada biodata surat tanpa membuat teks bergeser adalah...', 'Menekan tombol Spasi berulang kali sampai lurus', 'Mengatur Tab Stop pada mistar (Ruler) dan menekan tombol Tab', 'Mengetik titik dua di baris paling bawah lalu dicopy', 'Menggunakan font khusus titik dua', 'B', 'Tab Stop menetapkan koordinat horizontal tetap pada Ruler sehingga penekanan tombol Tab menghasilkan posisi yang selalu sejajar rapi.', 4),
(25, 3, 'Fitur yang wajib digunakan untuk membedakan format nomor halaman (misal Romawi i, ii pada cover dan angka 1, 2 pada bab isi) adalah...', 'Page Break', 'Line Break', 'Section Break (Next Page)', 'Column Break', 'C', 'Section Break memisahkan aturan tata letak dan penomoran header/footer antar bagian dokumen.', 5),
(26, 3, 'Format file dokumen yang paling disarankan saat mengirim surat atau CV via email agar formatnya tidak bergeser di perangkat penerima adalah...', '.TXT', '.PDF', '.DOC', '.RTF', 'B', 'PDF (Portable Document Format) mengunci tata letak, jenis font, dan format visual di semua perangkat dan sistem operasi.', 6),
(27, 3, 'Bagian atas dokumen yang biasanya memuat logo instansi, nama perusahaan, dan alamat resmi disebut...', 'Footer', 'Header (Kop Surat)', 'Watermark', 'Footnote', 'B', 'Header terletak di margin atas dokumen dan lazim dipakai menempatkan kop surat resmi.', 7),
(28, 3, 'Untuk membuat daftar isi otomatis yang dapat diperbarui saat nomor halaman berubah, teks judul bab harus diformat menggunakan...', 'Bold dan garis bawah', 'Heading Styles (Heading 1, Heading 2)', 'Font ukuran 20 pt', 'Warna teks merah', 'B', 'Word membaca struktur Heading Styles (Heading 1, Heading 2, dst) untuk merakit Daftar Isi Otomatis (Table of Contents).', 8),
(29, 3, 'Jarak antar baris kalimat dalam sebuah paragraf dokumen perkantoran umumnya diatur menggunakan fitur...', 'Character Spacing', 'Line Spacing (Spasi Baris)', 'Letter Width', 'Margin Top', 'B', 'Line Spacing mengatur kerapatan vertikal antar baris teks dalam satu paragraf (misal 1.15 atau 1.5 spasi).', 9),
(30, 3, 'Kombinasi tombol keyboard untuk membatalkan kesalahan tindakan pengetikan terakhir (Undo) adalah...', 'Ctrl + Y', 'Ctrl + U', 'Ctrl + Z', 'Ctrl + X', 'C', 'Ctrl + Z adalah perintah Undo universal untuk membatalkan perubahan atau kesalahan ketik sebelumnya.', 10),
(31, 4, 'Apa fungsi utama dari slide presentasi dalam sebuah pemaparan profesional?', 'Sebagai naskah lengkap yang dibacakan kata demi kata oleh pembicara', 'Sebagai alat bantu visual ringkas untuk memperkuat dan memperjelas pesan pembicara', 'Untuk memamerkan sebanyak mungkin efek suara dan animasi bergerak', 'Untuk menggantikan kehadiran pembicara sepenuhnya', 'B', 'Slide adalah alat bantu visual (visual aid) untuk mendukung pesan pembicara, bukan naskah membaca yang membosankan.', 1),
(32, 4, 'Apa yang dimaksud dengan prinsip ''Whitespace'' dalam desain slide presentasi?', 'Slide harus selalu menggunakan latar belakang warna putih polos', 'Area kosong di sekitar elemen desain yang memberi kenyamanan mata dan memfokuskan perhatian audiens', 'Menghapus semua gambar dari slide', 'Mengubah warna teks menjadi putih', 'B', 'Whitespace (ruang negatif/kosong) memberi ruang bernapas visual sehingga pesan penting tidak tertelan elemen yang berdesakan.', 2),
(33, 4, 'Fitur di PowerPoint yang dapat mengubah daftar poin teks biasa menjadi diagram visual yang terstruktur secara instan adalah...', 'WordArt', 'SmartArt', 'ClipArt', 'AutoShape', 'B', 'SmartArt mengonversi poin teks menjadi bagan alur proses, hierarki organisasi, atau matriks visual secara otomatis.', 3),
(34, 4, 'Berapa jumlah maksimal warna aksen yang disarankan untuk menjaga konsistensi tema slide profesional?', '10 warna pelangi', '1 sampai 2 warna aksen kontras yang harmonis', 'Semua warna harus berbeda di tiap slide', 'Tidak boleh memakai warna', 'B', 'Desain profesional membatasi palet warna pada 1-2 warna aksen kontras untuk menjaga konsistensi dan fokus perhatian.', 4),
(35, 4, 'Efek transisi modern di PowerPoint yang memindahkan objek secara mulus dan cair antar dua slide berturut-turut disebut...', 'Push', 'Morph', 'Dissolve', 'Wipe', 'B', 'Transisi Morph melacak perubahan posisi, ukuran, dan rotasi objek antar dua slide dan membuat animasi perpindahan yang mulus.', 5),
(36, 4, 'Fitur tampilan khusus yang memungkinkan presenter melihat contekan catatan dan slide berikutnya di laptop saat layar proyektor menampilkan slide utama adalah...', 'Slide Sorter View', 'Outline View', 'Presenter View', 'Reading View', 'C', 'Presenter View menampilkan slide aktif, catatan pembicara, pewaktu (timer), dan preview slide berikutnya di monitor presenter.', 6),
(37, 4, 'Berapa ukuran font minimum yang disarankan untuk teks isi penjelasan di slide agar terbaca oleh audiens di baris belakang?', '8 pt', '10 pt', 'Sekitar 16 - 18 pt', '36 pt', 'C', 'Ukuran font minimal 16-18 pt untuk body text memastikan keterbacaan yang layak di ruang pertemuan berukuran standar.', 7),
(38, 4, 'Kombinasi tombol keyboard untuk memulai penayangan slide presentasi (Slide Show) dari slide paling awal adalah...', 'F1', 'F5', 'F7', 'F12', 'B', 'Tombol F5 memulai Slide Show dari slide pertama (atau Shift + F5 dari slide yang sedang aktif).', 8),
(39, 4, 'Kapan sebaiknya animasi objek (Entrance Animation) digunakan dalam presentasi bisnis?', 'Setiap detik agar audiens tidak mengantuk', 'Secara selektif untuk memunculkan poin bertahap sesuai alur penjelasan lisan pembicara', 'Hanya dengan efek suara ledakan atau tepuk tangan', 'Tidak boleh digunakan sama sekali dalam kondisi apa pun', 'B', 'Animasi selektif membantu mengendalikan fokus audiens sehingga mereka tidak membaca poin akhir sebelum waktunya dijelaskan.', 9),
(40, 4, 'Sikap terbaik presenter saat menghadapi pertanyaan peserta yang belum diketahui jawabannya secara pasti adalah...', 'Mengarang jawaban meyakinkan agar tidak terlihat tidak tahu', 'Menyalahkan penanya karena pertanyaannya keluar topik', 'Mengakui secara jujur dan profesional bahwa data tersebut akan dicek kembali dan dikabari setelah sesi presentasi', 'Mengabaikan pertanyaan dan menutup presentasi', 'C', 'Integritas profesional dihargai dengan mengakui batas data saat ini dan menawarkan tindak lanjut (follow-up) konfirmasi.', 10),
(41, 5, 'Apa kepanjangan dari sistem ATS yang banyak digunakan perusahaan untuk menyaring berkas pelamar kerja?', 'Automatic Text Sorter', 'Applicant Tracking System', 'Application Technical Support', 'Advanced Talents System', 'B', 'ATS adalah singkatan dari Applicant Tracking System, perangkat lunak untuk mengelola proses seleksi dan penyaringan pelamar kerja.', 1),
(42, 5, 'Mengapa penggunaan format tabel ganda (multi-column) atau grafik kompleks pada CV sering kali berisiko gagal di ATS?', 'Karena ukuran file menjadi terlalu kecil', 'Karena sistem parser ATS sering kali membaca kolom secara bercampur aduk dari kiri ke kanan melintasi batas kolom', 'Karena ATS hanya bisa membaca gambar PNG', 'Karena HRD tidak suka melihat warna', 'B', 'Parser teks ATS memindai secara horizontal; tata letak tabel kompleks dapat mencampuradukkan kata dari kolom berbeda sehingga teks menjadi tidak bermakna.', 2),
(43, 5, 'Manakah cara penulisan pengalaman kerja yang paling mencerminkan pencapaian nyata (berorientasi dampak)?', '''Bertanggung jawab atas administrasi toko.''', '''Membantu bos membuat laporan setiap hari.''', '''Mengelola inventaris 300 jenis barang dan memangkas tingkat selisih stok sebesar 35% melalui sistem kontrol berkala.''', '''Bekerja keras dan datang tepat waktu ke kantor.''', 'C', 'Formula berbasis dampak memuat tindakan konkret, lingkup kerja terukur, dan hasil persentase keberhasilan nyata.', 3),
(44, 5, 'Informasi pribadi manakah yang TIDAK PERLU dicantumkan di CV profesional standar modern?', 'Nama lengkap dan nomor WhatsApp aktif', 'Alamat email profesional', 'Status pernikahan, suku bangsa, agama, dan makanan favorit', 'Tautan profil LinkedIn atau portofolio relevan', 'C', 'Data diskriminatif atau terlalu privat seperti agama, status pernikahan, atau hobi umum tidak relevan bagi kualifikasi profesional.', 4),
(45, 5, 'Berapa panjang halaman yang paling ideal untuk CV lulusan baru (fresh graduate) atau pemula karir?', '1 halaman (maksimal 2 halaman jika memiliki proyek substansial)', 'Minimal 5 halaman lengkap dengan sertifikat sekolah dasar', '10 halaman', 'Cukup setengah paragraf saja', 'A', 'Satu halaman padat dan terkurasi sangat ideal bagi rekruter yang rata-rata hanya meluangkan 6-10 detik saat seleksi cepat pertama.', 5),
(46, 5, 'Apa nama formula terkenal dari Google untuk menuliskan pencapaian pengalaman kerja di resume?', 'Formula ABC', 'Formula X-Y-Z (''Accomplished [X], as measured by [Y], by doing [Z]'')', 'Formula SWOT', 'Formula 5W1H', 'B', 'Formula X-Y-Z Google: Capaian [X], diukur dengan metrik [Y], melalui aksi konkret yang Anda lakukan [Z].', 6),
(47, 5, 'Apa kesalahan fatal dalam penulisan surat lamaran kerja (Cover Letter)?', 'Menyebutkan nama perusahaan yang dilamar', 'Menjelaskan kecocokan kualifikasi dengan kriteria lowongan', 'Mengirim surat lamaran hasil ''copy-paste'' massal tanpa menyesuaikan dengan nama dan posisi perusahaan yang dituju', 'Menyertakan nomor kontak aktif', 'C', 'Surat lamaran generik tanpa personalisasi memperlihatkan kurangnya minat serius pelamar terhadap perusahaan tersebut.', 7),
(48, 5, 'Nama file dokumen lamaran yang paling tepat dan profesional saat diunggah adalah...', 'cv_baru_fix_banget.pdf', 'Dokumen1.docx', 'CV_Budi_Santoso_Staff_Administrasi.pdf', 'Untitled.pdf', 'C', 'Nama file yang memuat jenis dokumen, nama lengkap pelamar, dan jabatan lowongan memudahkan arsip rekruter.', 8),
(49, 5, 'Manakah alamat email yang paling pantas digunakan untuk melamar pekerjaan formal?', 'si_ganteng_juara@yahoo.com', 'budi.santoso.work@gmail.com', 'naruto_gamer99@hotmail.com', 'anak.bunda.lucu@gmail.com', 'B', 'Email kerja harus menggunakan variasi nama asli yang bersih dan formal tanpa embel-embel nama panggilan santai.', 9),
(50, 5, 'Kata kerja pembuka (Action Verb) yang kuat untuk mengawali deskripsi tugas di resume adalah...', 'Mengembangkan', 'Mungkin', 'Biasanya', 'Mencoba-coba', 'A', 'Kata kerja aktif seperti ''Mengembangkan'', ''Memimpin'', ''Mengoptimalkan'' menunjukkan inisiatif dan kepemilikan tanggung jawab.', 10),
(51, 6, 'Metode terstruktur yang paling populer untuk menjawab pertanyaan wawancara berbasis perilaku adalah...', 'Metode ABCDE', 'Metode STAR (Situation, Task, Action, Result)', 'Metode SMART', 'Metode 5S', 'B', 'STAR (Situation, Task, Action, Result) adalah kerangka jawaban paling efektif untuk mendemonstrasikan kompetensi masa lalu.', 1),
(52, 6, 'Bagian manakah dalam metode STAR yang harus mendapatkan porsi penjelasan tindakan pribadi paling dominan?', 'Situation (Latar belakang situasi)', 'Action (Tindakan konkret yang Anda ambil)', 'Task (Tugas yang diberikan)', 'Semua porsinya 1 detik', 'B', 'Action adalah inti penilaian HRD karena memperlihatkan peran dan keputusan spesifik yang Anda ambil untuk mengatasi kendala.', 2),
(53, 6, 'Ketika pewawancara menanyakan: ''Apa kekurangan terbesar Anda?'', strategi jawaban yang paling bijak adalah...', 'Mengatakan bahwa Anda orang yang sempurna tanpa kekurangan', 'Menyebutkan kelemahan fatal yang membuat Anda tidak mampu bekerja sama sekali', 'Menyebutkan area yang sedang Anda kembangkan secara jujur disertai langkah nyata yang telah Anda ambil untuk memperbaikinya', 'Menolak menjawab pertanyaan tersebut', 'C', 'Sebutkan area perbaikan diri secara otentik serta tunjukkan ikhtiar nyata yang sedang dijalankan untuk mengatasinya.', 3),
(54, 6, 'Berapa lama sebelum jadwal wawancara tatap muka seorang kandidat disarankan sudah tiba di lokasi?', 'Persis pada menit yang dijadwalkan', '15 hingga 20 menit sebelumnya', '3 jam sebelumnya sampai mengganggu kantor', '10 menit setelah jadwal berlalu', 'B', 'Tiba 15-20 menit lebih awal memberi waktu beradaptasi dengan lingkungan, merapikan diri, dan menghindari kepanikan lalu lintas.', 4),
(55, 6, 'Trik terbaik untuk menjaga kontak mata yang tepat saat melakukan wawancara kerja daring (Zoom/Meet) adalah...', 'Menatap layar kaca laptop terus menerus', 'Menatap langsung ke lubang lensa kamera (webcam) saat Anda sedang berbicara', 'Melihat ke arah papan ketik (keyboard)', 'Mematikan kamera sepanjang sesi', 'B', 'Menatap lensa webcam menciptakan persepsi bagi lawan bicara di seberang bahwa Anda sedang menatap mata mereka secara langsung.', 5),
(56, 6, 'Ketika di akhir wawancara pewawancara bertanya: ''Apakah ada yang ingin ditanyakan?'', respons terbaik Anda adalah...', '''Tidak ada, saya ingin cepat pulang.''', 'Mengajukan pertanyaan terarah mengenai tantangan utama tim kerja atau tolok ukur keberhasilan posisi tersebut', 'Langsung menanyakan kapan bonus liburan tahunan dibagikan', 'Diam membisu tersenyum', 'B', 'Mengajukan pertanyaan berkualitas membuktikan bahwa Anda telah meriset perusahaan dan memiliki komitmen tinggi terhadap peran yang dilamar.', 6),
(57, 6, 'Apa tujuan utama pewawancara menanyakan: ''Mengapa Anda tertarik bekerja di perusahaan kami?''', 'Untuk mengecek apakah pelamar hafal alamat kantor', 'Untuk melihat apakah pelamar meriset nilai perusahaan dan memiliki motivasi kerja yang sejalan dengan visi bisnis', 'Hanya sekadar formalitas basa-basi pengisi waktu luang', 'Ingin meminta pujian berlebihan dari pelamar', 'B', 'Rekruter ingin mengetahui motivasi otentik dan keselarasan nilai budaya kandidat dengan tujuan organisasi.', 7),
(58, 6, 'Pesan ucapan terima kasih (Thank You Email) setelah wawancara sebaiknya dikirimkan dalam rentang waktu...', 'Maksimal 24 jam setelah sesi wawancara selesai', 'Satu bulan setelah wawancara', 'Setahun kemudian', 'Tidak perlu mengirim email apa pun', 'A', 'Thank-you note dalam waktu 24 jam memperkuat kesan positif, profesionalisme, dan keseriusan Anda di mata panitia seleksi.', 8),
(59, 6, 'Bahasa tubuh manakah yang mencerminkan sikap terbuka dan percaya diri dalam wawancara kerja?', 'Menyilangkan kedua tangan di depan dada', 'Duduk tegak rileks, menjaga kontak mata berkala, dan mengangguk saat menyimak', 'Menggoyangkan kaki terus-menerus karena cemas', 'Menundukkan kepala ke arah lantai', 'B', 'Postur tegak, kontak mata natural, dan anggukan aktif mencerminkan antusiasme serta kepercayaan diri yang sehat.', 9),
(60, 6, 'Ketika ditanya mengenai ekspektasi gaji di tahap wawancara awal, langkah bijak kandidat adalah...', 'Menyebutkan angka sembarangan tanpa riset', 'Menyampaikan rentang gaji realistis berdasarkan riset standar upah industri dan biaya hidup setempat', 'Menolak dibayar karena bersedia kerja bakti', 'Meminta gaji tertinggi tanpa dasar kualifikasi', 'B', 'Riset kisaran upah pasar untuk posisi dan kota tersebut menunjukkan kedewasaan kandidat dalam menegosiasikan nilai dirinya.', 10),
(61, 7, 'Menurut formula pembagian anggaran sederhana 50/30/20, persentase 50% dialokasikan untuk...', 'Liburan dan hiburan', 'Kebutuhan pokok hidup (makanan, sewa, listrik)', 'Investasi saham berisiko tinggi', 'Membeli pakaian pesta', 'B', '50% pendapatan diperuntukkan bagi kebutuhan hidup mutlak (Needs) yang tidak dapat ditunda pemenuhannya.', 1),
(62, 7, 'Apa definisi utama dari Dana Darurat dalam perencanaan keuangan keluarga?', 'Uang yang disiapkan khusus untuk berbelanja diskon akhir tahun', 'Simpanan likuid yang hanya boleh digunakan pada peristiwa mendesak dan tak terduga (seperti sakit atau kehilangan pekerjaan)', 'Uang yang dipinjamkan kepada tetangga', 'Uang tunai yang disimpan di bawah kasur untuk pamer', 'B', 'Dana darurat adalah bantalan finansial untuk menjaga kelangsungan hidup saat musibah atau krisis mendadak terjadi.', 2),
(63, 7, 'Manakah ciri utama dari layanan pinjaman online (pinjol) ilegal yang berbahaya?', 'Memiliki izin terdaftar resmi dari Otoritas Jasa Keuangan (OJK)', 'Meminta akses izin ke seluruh buku kontak telepon dan galeri pribadi ponsel peminjam', 'Memiliki kantor fisik yang jelas dan layanan bantuan pelanggan resmi', 'Membatasi suku bunga harian sesuai regulasi AFPI', 'B', 'Pinjol ilegal menyalahgunakan akses kontak dan galeri untuk menyebarkan ancaman serta mempermalukan korban penagihan.', 3),
(64, 7, 'Strategi menabung yang paling efektif dan terbukti berhasil adalah...', 'Menunggu sisa uang di akhir bulan baru ditabung jika ada', 'Langsung menyisihkan persentase tabungan di awal begitu menerima gaji/penghasilan', 'Tidak perlu menabung karena uang pasti akan habis juga', 'Meminjam uang ke bank untuk ditabung', 'B', 'Prinsip ''Pay Yourself First'': sisihkan tabungan di awal periode penerimaan gaji sebelum dipakai berbelanja keperluan lain.', 4),
(65, 7, 'Contoh pengeluaran yang tergolong sebagai ''Keinginan'' (Wants) dan bukan kebutuhan mutlak adalah...', 'Beras untuk makan sehari-hari', 'Air minum galon keluarga', 'Membeli minuman kopi kekinian di mall setiap sore', 'Obat resep dokter saat sakit', 'C', 'Kopi kafe kekinian adalah pengeluaran rekreasi/gaya hidup yang dapat dipangkas sewaktu-waktu tanpa mengancam keselamatan hidup.', 5),
(66, 7, 'Berapa cadangan dana darurat minimal yang disarankan untuk seseorang yang masih lajang?', '1 hari pengeluaran', '3 kali rata-rata pengeluaran bulanan', '100 kali gaji', 'Tidak perlu ada', 'B', 'Bagi individu lajang, tabungan setara 3 bulan pengeluaran rutin cukup memberikan ruang bernapas jika terjadi pemutusan kerja sementara.', 6),
(67, 7, 'Lembaga resmi pemerintah Indonesia yang bertugas mengawasi dan mengatur sektor jasa keuangan adalah...', 'OJK (Otoritas Jasa Keuangan)', 'KONI', 'BMKG', 'BNPB', 'A', 'OJK bertugas menyelenggarakan sistem pengaturan dan pengawasan terintegrasi terhadap keseluruhan kegiatan di sektor jasa keuangan.', 7),
(68, 7, 'Apa bahaya dari fenomena ''bocor halus'' dalam keuangan pribadi?', 'Pengeluaran besar yang langsung dicatat rapi', 'Pengeluaran nominal kecil yang sering dilakukan berulang tanpa terasa hingga menghabiskan sebagian besar penghasilan', 'Kebocoran pipa air di rumah', 'Menyimpan uang koin di celengan', 'B', 'Bocor halus (seperti parkir, rokok eceran, jajan kecil) yang tidak dicatat kerap menjadi penyebab utama lenyapnya gaji tanpa sisa.', 8),
(69, 7, 'Perilaku yang paling tepat sebelum memutuskan mengambil fasilitas cicilan Paylater atau pinjaman adalah...', 'Langsung klik setuju tanpa membaca suku bunga dan denda keterlambatan', 'Memastikan cicilan ditujukan untuk keperluan produktif dan total seluruh cicilan tidak melebihi 30% dari penghasilan bulanan', 'Mengajukan pinjaman di 10 aplikasi sekaligus untuk jalan-jalan', 'Menggunakan data KTP orang lain', 'B', 'Rasio total cicilan utang yang sehat adalah di bawah 30% dari total pendapatan bulanan agar arus kas rumah tangga tidak kolaps.', 9),
(70, 7, 'Langkah pertama yang harus dilakukan seseorang saat ingin memperbaiki kondisi keuangannya adalah...', 'Membeli buku mahal', 'Mencatat seluruh arus uang masuk dan uang keluar harian secara disiplin', 'Berhenti makan nasi sama sekali', 'Mengundurkan diri dari pekerjaan', 'B', 'Pencatatan kas harian memberikan visibilitas nyata ke mana uang mengalir sehingga langkah efisiensi dapat ditargetkan dengan tepat.', 10),
(71, 8, 'Metode penjualan terbaik bagi wirausaha pemula bermodal minim agar tidak menanggung risiko barang sisa atau modal mati adalah...', 'Menyewa ruko mahal di pusat perbelanjaan', 'Sistem Pre-Order (PO) dengan meminta uang muka (DP) terlebih dahulu kepada pemesan', 'Memproduksi 500 unit barang sekaligus lalu berharap ada pembeli', 'Membeli mesin pabrik skala industri', 'B', 'Sistem Pre-Order (PO) menjamin adanya pembeli pasti sebelum modal dibelanjakan untuk bahan baku, meminimalkan risiko kerugian.', 1),
(72, 8, 'Apa kepanjangan dari HPP dalam kalkulasi keuangan usaha dagang atau produksi makanan?', 'Harga Pembelian Pasar', 'Harga Pokok Penjualan', 'Hasil Penjualan Produk', 'Hak Paten Produk', 'B', 'HPP adalah Harga Pokok Penjualan, yaitu total seluruh pengeluaran langsung yang dikeluarkan untuk menghasilkan suatu produk.', 2),
(73, 8, 'Biaya manakah di bawah ini yang tergolong sebagai biaya operasional langsung dalam produksi kue rumahan?', 'Biaya gas elpiji dan plastik kemasan', 'Biaya liburan keluarga pemilik usaha', 'Pajak mobil pribadi', 'Uang jajan anak', 'A', 'Gas dan kemasan plastik langsung habis terpakai dalam proses pembuatan dan pengemasan produk kue yang dijual.', 3),
(74, 8, 'Aplikasi pesan instan gratis yang memiliki fitur katalog produk, profil bisnis, dan pesan sapaan otomatis untuk UMKM adalah...', 'WhatsApp Messenger biasa', 'WhatsApp Business', 'SMS konvensional', 'Twitter Web', 'B', 'WhatsApp Business dirancang khusus dengan fitur etalase katalog, jam buka toko, dan label chat untuk menunjang transaksi UMKM.', 4),
(75, 8, 'Sumber pencahayaan terbaik dan paling hemat biaya untuk memotret produk makanan menggunakan kamera HP adalah...', 'Lampu flash langsung dari kamera ponsel', 'Cahaya alami matahari di dekat jendela pada pagi atau sore hari (Window Light)', 'Lampu neon redup di kamar tidur', 'Senter dari HP lain', 'B', 'Cahaya alami dekat jendela menghasilkan pencahayaan merata yang lembut tanpa bayangan tajam yang merusak tampilan foto produk.', 5),
(76, 8, 'Mengapa pengusaha pemula wajib menganggarkan upah untuk tenaga kerjanya sendiri dalam perhitungan harga produk?', 'Hanya sekadar formalitas agar harga terlihat mahal', 'Agar usaha dapat berkembang secara mandiri dan pemilik mengetahui profit usaha sesungguhnya yang terpisah dari gaji kerja', 'Supaya tidak perlu membayar pajak', 'Agar uang usaha bisa dipakai foya-foya pribadi', 'B', 'Jika tenaga pemilik tidak dihargai, usaha tampak menguntungkan padahal kenyataannya pemilik hanya bekerja tanpa upah layak.', 6),
(77, 8, 'Tindakan pertama yang paling krusial sebelum memotret produk dengan kamera ponsel pintar adalah...', 'Memasang tripod termahal', 'Membersihkan kaca lensa kamera dengan kain lembut agar foto tidak buram terkena minyak', 'Menambahkan stiker animasi lucu di atas produk', 'Memperbesar zoom kamera hingga 10x', 'B', 'Lensa ponsel yang kotor oleh sidik jari adalah penyebab utama foto terlihat berkabut dan tidak tajam.', 7),
(78, 8, 'Bagaimana cara menentukan ide bisnis yang paling berpeluang diterima pasar lokal?', 'Memilih produk yang sedang viral di luar negeri meskipun tidak dibutuhkan warga sekitar', 'Mengamati masalah atau kesulitan yang sering dikeluhkan masyarakat sekitar dan menawarkan solusi praktis atas masalah itu', 'Menjual barang yang paling mahal agar cepat kaya', 'Meniru usaha tetangga persis tanpa ada nilai tambah apa pun', 'B', 'Bisnis yang berkelanjutan dibangun di atas pemecahan masalah riil yang dihadapi oleh konsumen di sekitarnya.', 8),
(79, 8, 'Apa fungsi fitur ''Label Chat'' pada WhatsApp Business?', 'Untuk menghapus pesan secara permanen', 'Untuk menandai dan mengelompokkan pesan pelanggan (misal: ''Belum Bayar'', ''Sudah Lunas'', ''Pesanan Siap Kirim'')', 'Untuk memblokir semua kontak pelanggan', 'Untuk mengirim pesan spam ke orang asing', 'B', 'Label Chat memudahkan pemilahan status pesanan sehingga penjual tidak melewatkan pelanggan yang belum dilayani.', 9),
(80, 8, 'Prinsip utama dalam menetapkan harga jual suatu produk adalah...', 'Harga jual harus berada di atas HPP agar menghasilkan margin keuntungan bersih yang sehat', 'Harga jual harus selalu lebih murah dari kompetitor meski menanggung kerugian', 'Harga ditentukan secara acak tanpa perlu menghitung biaya modal', 'Harga jual selalu disamakan dengan biaya bahan baku saja', 'A', 'Harga jual wajib menutup seluruh modal pokok (HPP) dan menyisakan margin laba agar bisnis dapat terus beroperasi dan berkembang.', 10);

-- 6. Contoh Progres & Sertifikat Budi Santoso (Menulis CV & Surat Lamaran Kerja)
INSERT INTO `progres_modul` (`pengguna_id`, `modul_id`, `kursus_id`, `selesai_pada`) VALUES
(2, 17, 5, '2026-11-15 09:30:00'),
(2, 18, 5, '2026-11-15 10:15:00'),
(2, 19, 5, '2026-11-15 11:00:00'),
(2, 20, 5, '2026-11-15 11:45:00');

INSERT INTO `hasil_kuis` (`id`, `pengguna_id`, `kursus_id`, `total_soal`, `jawaban_benar`, `nilai`, `status_lulus`, `dikerjakan_pada`) VALUES
(1, 2, 5, 10, 9, 90.00, 'Lulus', '2026-11-15 12:15:00');

INSERT INTO `sertifikat` (`id`, `nomor_sertifikat`, `pengguna_id`, `kursus_id`, `tanggal_terbit`, `nilai_kuis`, `kode_verifikasi`, `penandatangan_nama`, `penandatangan_jabatan`) VALUES
(1, 'S4L-2026-000123', 2, 5, '2026-11-15', 90.00, 'a1b2c3d4e5f67890abcdef1234567890abcdef1234567890abcdef1234567890', 'Dr. Ir. Hendra Gunawan, M.T.', 'Direktur Pembina Skill4Life');
