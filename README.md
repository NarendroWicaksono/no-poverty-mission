# Skill4Life — Platform Kursus Keterampilan Kerja Gratis (SDG 1: No Poverty)

Platform pembelajaran daring gratis berbasis **PHP Native (Arsitektur MVC), MySQL, HTML5, CSS3, dan JavaScript ES Modules** untuk mendukung misi **SDG 1 (Tanpa Kemiskinan)**.

---

## Arsitektur Proyek (MVC)
* **`app/Core/`** — Kerangka dasar MVC ([Bootstrap.php](app/Core/Bootstrap.php), [Database.php](app/Core/Database.php), [Controller.php](app/Core/Controller.php), [Router.php](app/Core/Router.php)).
* **`app/Models/`** — Lapisan akses data & logika bisnis MySQL PDO ([PenggunaModel.php](app/Models/PenggunaModel.php), [KategoriModel.php](app/Models/KategoriModel.php), [KursusModel.php](app/Models/KursusModel.php), [ModulModel.php](app/Models/ModulModel.php), [KuisModel.php](app/Models/KuisModel.php), [SertifikatModel.php](app/Models/SertifikatModel.php)).
* **`app/Controllers/`** — Pengendali halaman & REST API ([HomeController.php](app/Controllers/HomeController.php), [AuthController.php](app/Controllers/AuthController.php), [KursusController.php](app/Controllers/KursusController.php), [DashboardController.php](app/Controllers/DashboardController.php), [SertifikatController.php](app/Controllers/SertifikatController.php), [AdminController.php](app/Controllers/AdminController.php), [ApiController.php](app/Controllers/ApiController.php)).
* **`app/Views/`** — Template antarmuka pengguna (`layouts/`, `home/`, `auth/`, `kursus/`, `dashboard/`, `sertifikat/`, `admin/`).
* **`config/koneksi.php`** & **`database.sql`** — Konfigurasi koneksi PDO MySQL (`db_skill4life`) beserta skema & seed data lengkap.

---

## Fitur Utama
* **Katalog & Pencarian Kursus**: 8 kursus terstruktur dalam 3 kategori dengan filter kategori, tingkat kesulitan, dan pencarian.
* **Ruang Belajar Mandiri**: Materi bacaan terstruktur, video tutorial YouTube yang relevan per modul, serta pencatatan progres penyelesaian modul ke database MySQL.
* **Kuis Evaluasi & Sertifikasi**: Kuis pilihan ganda (kelulusan nilai $\ge 70$), pembahasan soal, serta penerbitan sertifikat resmi otomatis yang dapat dicetak ke PDF.
* **Verifikasi Sertifikat Publik**: Pengecekan keaslian sertifikat berdasarkan nomor seri unik (`S4L-YYYY-NNNNNN`).
* **Dashboard Peserta & Panel Pengelola (Admin)**: Manajemen akun, ubah kata sandi, pemantauan progres, statistik real-time, ekspor CSV, serta CRUD kursus, modul, dan soal kuis.

---

## Cara Menjalankan (Laragon)
1. Letakkan proyek di dalam `C:\laragon\www\no-poverty-mission`.
2. Buka **Laragon**, klik **Start All** (pastikan Apache/Nginx dan MySQL berjalan).
3. Sesuaikan kredensial MySQL di [`config/koneksi.php`](config/koneksi.php) jika berbeda dari default (`localhost` / `root` / tanpa password).
4. Import [`database.sql`](database.sql) ke phpMyAdmin (atau biarkan sistem menginisialisasi database `db_skill4life` secara otomatis saat pertama kali diakses).
5. Akses di browser: `http://localhost:8080/no-poverty-mission/`

---

## Kredensial Demo
* **Peserta**: `budi@gmail.com` / `budi1234`
* **Admin**: `admin@skill4life.id` / `admin1234`
