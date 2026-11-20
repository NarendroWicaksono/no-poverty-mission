# Skill4Life — Platform Kursus Keterampilan Kerja Gratis (SDG 1: No Poverty)

Platform pembelajaran daring gratis berbasis **PHP Native, MySQL, HTML5, CSS3, dan JavaScript Native** untuk mendukung misi **SDG 1 (Tanpa Kemiskinan)**.

---

## Fitur Utama
* **Katalog & Pencarian Kursus**: 8 kursus terstruktur dalam 3 kategori dengan filter kategori, tingkat kesulitan, dan pencarian.
* **Ruang Belajar Mandiri**: Materi bacaan terstruktur, video tutorial, serta pencatatan progres penyelesaian modul.
* **Kuis Evaluasi & Sertifikasi**: Kuis pilihan ganda (kelulusan nilai $\ge 70$), pembahasan soal, serta penerbitan sertifikat resmi yang dapat dicetak ke PDF.
* **Verifikasi Sertifikat Publik**: Pengecekan keaslian sertifikat berdasarkan nomor seri unik.
* **Dashboard Peserta & Panel Pengelola (Admin)**: Manajemen akun, pemantauan progres, statistik, ekspor CSV, serta pengelolaan kursus, modul, dan soal kuis.

---

## Cara Menjalankan (Laragon)
1. Letakkan proyek di dalam `C:\laragon\www\no-poverty-mission`.
2. Buka **Laragon**, klik **Start All** (pastikan Apache/Nginx dan MySQL berjalan).
3. Import [`database.sql`](database.sql) ke phpMyAdmin (atau biarkan koneksi otomatis membuatnya saat database pertama kali diakses).
4. Akses di browser: `http://localhost:8080/no-poverty-mission/`

---

## Kredensial Demo
* **Peserta**: `budi@gmail.com` / `budi1234`
* **Admin**: `admin@skill4life.id` / `admin1234`
