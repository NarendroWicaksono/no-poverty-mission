# Skill4Life — Belajar Gratis, Raih Masa Depan
> **Tema: SDG 1 "No Poverty" (Tanpa Kemiskinan)**  
> Platform Kursus Keterampilan Kerja & Kesiapan Karir 100% Gratis Tanpa Pungutan Biaya.

---

## 1. Konsep Proyek
**Skill4Life** dibangun untuk mendukung pencapaian Tujuan Pembangunan Berkelanjutan (SDG) 1: Tanpa Kemiskinan. Kemiskinan kerap berakar dari keterbatasan akses ke keahlian kerja nyata dan dokumen pembuktian kompetensi. Skill4Life membuka akses seluas-luasnya bagi pelajar, pencari kerja, lulusan baru, dan masyarakat umum untuk mempelajari keterampilan kerja perkantoran serta kesiapan karir, lengkap dengan penerbitan sertifikat resmi yang dapat diverifikasi secara publik.

---

## 2. Arah Desain & Aturan Anti-Slop
Antarmuka Skill4Life dirancang dengan pendekatan humanis, bersahaja, dan fungsional:
- **Karakter Visual**: Hangat, lugas, dan tepercaya. Mengusung metafora meja kerja kantor, kertas dokumen resmi, buku catatan, dan cap pengesahan.
- **Palet Warna**:
  - Latar halaman: `#F7F5F0` (krem netral hangat)
  - Kartu & bidang input: `#FFFFFF`
  - Area sekunder & selang-seling baris: `#EFEDE7`
  - Batas hairline: `rgba(28, 26, 23, 0.10)`
  - Warna aksen: `#1F6F4A` (hijau tua berwibawa, rasio kontras teks putih ≥ 4.5:1)
  - Aksen lembut: `#E6F0EA`
- **Tipografi**:
  - Antarmuka (UI): *Public Sans*
  - Judul besar & nama penerima sertifikat: *Source Serif 4*
  - Angka, kode verifikasi, & tabular data: *JetBrains Mono*
- **Sistem Ikon**: Ikon seragam berbasis Lucide Icons (garis stroke 1.5, warna mengikuti teks `currentColor`, tanpa ikon warna-warni berlebihan).
- **Segel Resmi Bulat (SVG)**: Elemen pengesahan visual khusus yang hanya tampil pada tiga titik bermakna: (1) lembar sertifikat, (2) tanda kursus tuntas di dashboard, dan (3) hasil verifikasi sertifikat publik.
- **Copywriting**: Menggunakan kalimat bersahaja tanpa tanda seru beruntun, tanpa sapaan artifisial, dan tanpa klaim tanpa bukti.

---

## 3. Tech Stack & Arsitektur Frontend
- **Frontend Murni**: HTML5, CSS3 terstruktur (`variabel.css`, `global.css`, `komponen.css`), JavaScript Vanilla modern (ES6 Modules).
- **Backend PHP**: Ekstensi `.php` **hanya dipakai untuk templating modular** (`include 'includes/header.php'` dan `include 'includes/footer.php'`). Tidak ada query database, session ketat, atau logika server tersembunyi.
- **Kontrak API & Data Dummy**:
  - Seluruh modul data dinamis dipusatkan pada `assets/js/api.js` dengan penanda jelas `// TODO-BACKEND:` untuk memudahkan pengembang backend mengintegrasikan REST API.
  - Dokumentasi endpoint dan schema request/response tercatat lengkap di berkas `API-KONTRAK.md`.
  - Berkas data dummy JSON tersimpan rapi di `assets/data/`:
    - `statistik.json` — Capaian kumulatif peserta, kursus, modul, dan mitra.
    - `kategori.json` — Kategori bidang keahlian kerja.
    - `kursus.json` — Daftar kurikulum keterampilan kerja nyata.
    - `modul.json` — 31 modul pembelajaran terstruktur (teks dinas + video embed).
    - `kuis.json` — 80 butir soal kuis pilihan ganda beserta kunci & pembahasan.
    - `sertifikat.json` — Data nomor sertifikat resmi terdaftar.
    - `pengguna.json` — Profil demo peserta & administrator.

---

## 4. Struktur Berkas
```text
skill4life/
├── index.php                      # Beranda publik (Hero, Statistik, Kategori, Kurikulum, SDG 1)
├── API-KONTRAK.md                 # Spesifikasi REST API untuk integrasi backend
├── README.md                      # Dokumentasi teknis proyek
├── includes/
│   ├── header.php                 # Header bersama, font Google, Lucide CDN, token CSS
│   ├── navbar.php                 # Navigasi utama tenang dengan logo S4L
│   └── footer.php                 # Footer bersama, komitmen SDG 1, sistem toast notifikasi
├── assets/
│   ├── css/
│   │   ├── variabel.css           # Design tokens (warna, font, spasi 4px, radius)
│   │   ├── global.css             # Reset dasar, cincin fokus, tabular-nums
│   │   └── komponen.css           # Tombol, kartu kertas, tabel data, sidebar 260px, sertifikat
│   ├── js/
│   │   └── api.js                 # Lapisan pemanggil data & titik integrasi backend
│   ├── img/
│   │   ├── logo.svg               # Logo lambang resmi Skill4Life
│   │   └── segel-resmi.svg        # Cap stempel bulat pengesahan SDG 1
│   └── data/                      # Kumpulan berkas data dummy JSON
│       ├── statistik.json
│       ├── kategori.json
│       ├── kursus.json
│       ├── modul.json
│       ├── kuis.json
│       ├── sertifikat.json
│       └── pengguna.json
├── kursus/
│   ├── katalog.php                # Katalog kursus dengan filter live kategori & level
│   ├── detail.php                 # Rincian kursus, tujuan belajar, & silabus modul
│   ├── belajar.php                # Antarmuka ruang baca materi (sidebar modul, video, progres)
│   └── kuis.php                   # Kuis evaluasi 10 butir, kalkulasi skor, kelulusan ≥ 70
├── sertifikat/
│   ├── lihat.php                  # Desain sertifikat landscape kertas fisik, unduh PDF & cetak
│   └── verifikasi.php             # Form pengecekan publik keabsahan nomor sertifikat
├── dashboard/
│   ├── index.php                  # Dashboard peserta (kursus diikuti, progres, sertifikat)
│   └── profil.php                 # Form pembaruan identitas dan kata sandi demo
└── admin/
    ├── login.php                  # Masuk panel pengelola dengan tombol akun demo
    ├── index.php                  # Ringkasan statistik & grafik tren garis tunggal Chart.js
    ├── kursus.php                 # Pengelolaan kurikulum kursus & dialog modal
    ├── modul.php                  # Pengelolaan modul pembelajaran per kursus
    ├── kuis.php                   # Pengelolaan bank soal evaluasi kuis
    ├── peserta.php                # Data peserta terdaftar & arsip sertifikat terbit
    └── partials/
        └── sidebar.php            # Navigasi samping panel pengelola 260px
```

---

## 5. Cara Menjalankan

### Pilihan A: Menggunakan XAMPP (Apache)
1. Salin seluruh isi folder proyek ke direktori `htdocs` XAMPP:
   ```text
   C:\xampp\htdocs\skill4life
   ```
2. Jalankan modul **Apache** pada panel kontrol XAMPP.
3. Buka peramban dan akses alamat:
   ```text
   http://localhost/skill4life/
   ```

### Pilihan B: Menggunakan PHP Development Server
Buka terminal PowerShell pada direktori proyek:
```powershell
Set-Location "c:\coding\no poverty\skill4life"
php -S 127.0.0.1:8088
```
Akses melalui peramban: `http://127.0.0.1:8088/`

---

## 6. Kredensial Demo

| Peran Akun | Alamat Email | Kata Sandi | Halaman Masuk |
| :--- | :--- | :--- | :--- |
| **Peserta Belajar** | `budi@gmail.com` | `budi1234` | `/auth/login.php` |
| **Pengelola / Admin** | `admin@skill4life.id` | `admin1234` | `/admin/login.php` |

*Tersedia tombol satu-klik "Gunakan akun demo" pada formulir login untuk pengujian cepat.*

---

## 7. Alur Pengujian Fitur Utama

1. **Eksplorasi Beranda (`/index.php`)**:
   - Tinjau metrik penerima manfaat, 2 rumpun kategori keterampilan, kartu kursus bertahap, dan komitmen akses terbuka bebas biaya SDG 1.
2. **Pencarian & Filter Katalog (`/kursus/katalog.php`)**:
   - Ketik kata kunci pada kolom cari dan pilih opsi level/kategori untuk penyaringan instan di sisi klien.
3. **Materi & Silabus Kursus (`/kursus/detail.php`)**:
   - Baca capaian kompetensi kerja dan silabus modul materi.
4. **Ruang Belajar Mandiri (`/kursus/belajar.php`)**:
   - Baca modul teks dan tonton video embed. Klik tombol **Tandai selesai** untuk mencatat progres ke bilah kemajuan visual.
5. **Kuis Evaluasi Akhir (`/kursus/kuis.php`)**:
   - Jawab 10 butir pertanyaan pilihan ganda secara bertahap. Sistem mengevaluasi skor; nilai ≥ 70 menerbitkan sertifikat resmi secara otomatis.
6. **Penerbitan & Unduh Sertifikat (`/sertifikat/lihat.php`)**:
   - Tampilan kertas fisik landscape berbingkai halus, tipografi serif, nomor registrasi berformat `S4L-2026-XXXXXX`, dan stempel segel resmi. Tersedia tombol cetak browser dan unduh PDF (`html2pdf.js`).
7. **Verifikasi Keabsahan Publik (`/sertifikat/verifikasi.php`)**:
   - Masukkan nomor contoh `S4L-2026-000123` untuk melihat data pengesahan resmi berstempel.
8. **Dashboard Pengelola (`/admin/index.php`)**:
   - Masuk ke portal pengelola untuk melihat metrik tabular-nums, grafik tren pendaftaran & kelulusan Chart.js dengan aksen hijau tua, serta pengelolaan tabel kursus, modul, soal kuis, dan peserta.
