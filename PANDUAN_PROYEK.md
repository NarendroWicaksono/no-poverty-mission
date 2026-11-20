# Panduan Pengembangan & Onboarding Proyek: Skill4Life

Selamat datang di proyek **Skill4Life**! Dokumen ini disusun agar siapa pun yang melanjutkan atau berkolaborasi dalam proyek ini memiliki **pemahaman, visi, dan standar teknis yang sama** dari hulu ke hilir.

---

## 1. Visi & Latar Belakang (The "Why")

### Mengapa Proyek Ini Ada?
Skill4Life dirancang untuk menjawab tantangan **Tujuan Pembangunan Berkelanjutan (SDG) 1: Tanpa Kemiskinan (No Poverty)**. Kemiskinan dan kesulitan ekonomi sering kali berakar dari:
1. Kurangnya keterampilan praktis yang siap pakai di dunia kerja modern (administrasi kantor, penulisan CV ATS, presentasi profesional).
2. Rendahnya literasi keuangan mandiri (terjebak pinjaman online ilegal, tidak punya dana darurat, arus kas bocor).
3. Hambatan biaya pendidikan kursus berbayar bagi masyarakat berpenghasilan rendah dan pencari kerja pemula.

### Siapa Target Pengguna Utama?
* **Pencari Kerja & Fresh Graduate**: Membutuhkan keterampilan dasar perkantoran (Excel, Word, PowerPoint) dan persiapan melamar kerja (CV ATS, teknik wawancara STAR).
* **Masyarakat Umum & Rumah Tangga**: Membutuhkan edukasi arus kas 50/30/20, dana darurat, dan cara terhindar dari jerat pinjol ilegal.
* **Calon Wirausaha / UMKM**: Membutuhkan panduan memulai bisnis bermodal minim, perhitungan HPP, dan promosi via WhatsApp Business.
* **Pemberi Kerja / HRD (Pihak Ketiga)**: Mengakses halaman publik untuk memverifikasi keabsahan sertifikat kompetensi yang dilampirkan pelamar.

### Filosofi Desain (Design Language)
* **Tenang, Elegan, dan Aksesibel**: Menghindari elemen visual mencolok yang berlebihan atau animasi yang lambat. Platform ini didesain seperti buku panduan kerja modern yang nyaman dibaca berlama-lama (lebar baca ideal ~720px).
* **Palet Warna Utama**:
  * Hijau Forest (`#1F6F4A`) sebagai warna aksen dan komitmen pertumbuhan ekonomi hijau.
  * Latar Netral Alami (`#FBF9F5` / `#F4F0E8`) untuk mengurangi kelelahan mata.
  * Tipografi: *Source Serif 4* untuk judul utama berwibawa, *Public Sans* untuk antarmuka yang bersih, dan *JetBrains Mono* untuk nomor sertifikat serta angka statistik.

---

## 2. Arsitektur & Teknologi (Tech Stack)

Proyek ini dibangun menggunakan **Native PHP dengan arsitektur MVC (Model-View-Controller) murni** tanpa ketergantungan framework berat (seperti Laravel) agar:
* Sangat ringan dan cepat dieksekusi di server/hosting mana pun.
* Mudah dipelajari dan tidak membutuhkan dependensi eksternal yang rumit (`composer`, `node_modules` backend).

### Komponen Teknologi:
* **Backend**: PHP 8.0+ Native, PDO MySQL (Singleton Connection, Prepared Statements).
* **Database**: MySQL 5.7+ / MariaDB 10.3+ (`db_skill4life`).
* **Frontend**: HTML5 Semantik, CSS3 Native Variables, Vanilla JavaScript ES Modules (`import`/`export`), Lucide Icons.
* **Keamanan**: Hash kata sandi `PASSWORD_BCRYPT`, proteksi CSRF berbasis Session Token, Sanitasi Input/Output (`ENT_QUOTES`), Role-based Access Control (RBAC).

---

## 3. Alur Kerja Aplikasi (Request Lifecycle)

```
[Browser Pengguna]
       │
       ▼ (Permintaan Halaman: mis. kursus/katalog.php)
[Entrypoint Dispatcher]
       │
       ▼ memanggil Router::dispatch('kursus/katalog')
[App\Core\Router]
       │
       ▼ menginisialisasi
[App\Controllers\KursusController]
       │
       ▼ memanggil Model jika butuh data server-side
[App\Models\KursusModel] ──► [MySQL via PDO Database.php]
       │
       ▼ merender template
[App\Views\kursus\katalog.php] di dalam [App\Views\layouts\header.php & footer.php]
       │
       ▼ interaksi dinamis via REST API
[assets/js/api.js] ──HTTP POST/GET──► [api/index.php] ──► [App\Controllers\ApiController]
```

### Dua Cara Interaksi Data:
1. **Server-Side Rendered (Layout & Keamanan Sesi)**: Controller memeriksa peran pengguna (`requirePeserta()`, `requireAdmin()`) sebelum halaman dirender, mencegah bypass halaman.
2. **Client-Side API (AJAX/Fetch)**: Seluruh interaksi interaktif (simpan progres modul, pengerjaan kuis real-time, cetak sertifikat, CRUD admin) berkomunikasi dengan endpoint `api/index.php?aksi=...` menggunakan format JSON.

---

## 4. Struktur Folder & Tanggung Jawab Kode

```
no-poverty-mission/
│
├── app/                          # Core Logic Arsitektur MVC
│   ├── Core/
│   │   ├── Bootstrap.php         # Start session, inisialisasi CSRF, autoloader PSR-4
│   │   ├── Database.php          # Koneksi PDO singleton, sinkronisasi skema & video
│   │   ├── Controller.php        # Basis controller: render view, helper json, guard auth
│   │   └── Router.php            # Resolver URL ke Controller/Action
│   │
│   ├── Models/                   # Lapisan Akses Data (PDO Prepared Statements)
│   │   ├── PenggunaModel.php     # Autentikasi, pendaftaran, profil, data peserta
│   │   ├── KategoriModel.php     # Kategori kursus & relasi
│   │   ├── KursusModel.php       # Data kursus, statistik, tren 6 bulan, CRUD
│   │   ├── ModulModel.php        # Materi belajar, URL video embed, progres modul
│   │   ├── KuisModel.php         # Bank soal, evaluasi kuis kelulusan, CRUD soal
│   │   └── SertifikatModel.php   # Penomoran sertifikat resmi, verifikasi keaslian
│   │
│   ├── Controllers/              # Pengendali Logika Alur
│   │   ├── HomeController.php    # Halaman utama / landing page
│   │   ├── AuthController.php    # Alur masuk, daftar, keluar
│   │   ├── KursusController.php  # Katalog, detail kursus, ruang belajar, kuis
│   │   ├── DashboardController.php# Dashboard peserta, pengaturan profil
│   │   ├── SertifikatController.php# Cetak PDF sertifikat, verifikasi publik
│   │   ├── AdminController.php   # Panel pengelola kursus, modul, soal, peserta
│   │   └── ApiController.php     # Gerbang API RESTful terpusat
│   │
│   └── Views/                    # File Tampilan HTML + PHP Template
│       ├── layouts/              # header.php, navbar.php, footer.php, admin_sidebar.php
│       ├── home/                 # Tampilan beranda
│       ├── auth/                 # login.php, daftar.php
│       ├── kursus/               # katalog.php, detail.php, belajar.php, kuis.php
│       ├── dashboard/            # index.php, profil.php
│       ├── sertifikat/           # lihat.php, verifikasi.php
│       └── admin/                # index.php, kursus.php, modul.php, kuis.php, peserta.php
│
├── api/
│   └── index.php                 # Entrypoint endpoint API (mendelegasikan ke ApiController)
│
├── assets/
│   ├── css/
│   │   ├── variabel.css          # Token desain: warna, jarak, font, radius
│   │   ├── global.css            # Reset CSS, tipografi global, layout dasar
│   │   └── komponen.css          # Tombol, kartu, tabel, bilah progres, modal
│   ├── js/
│   │   └── api.js                # Klien API JavaScript ES Modules resmi
│   └── img/                      # Logo, segel resmi SVG, ilustrasi
│
├── config/
│   └── koneksi.php               # Konstanta host, user, password, dan nama DB
│
├── docs/
│   ├── API_CONTRACT.md           # Spesifikasi detail setiap endpoint API JSON
│   └── PANDUAN_PROYEK.md         # (Dokumen ini)
│
├── database.sql                  # Skema database MySQL + 8 Kursus + 31 Modul Lengkap
├── index.php                     # Entrypoint beranda utama
└── README.md                     # Ringkasan proyek cepat untuk publik
```

---

## 5. Panduan Instalasi Cepat (Local Environment)

### Menggunakan Laragon (Sangat Direkomendasikan di Windows)
1. Letakkan folder proyek di `C:\laragon\www\no-poverty-mission`.
2. Buka Laragon dan klik **Start All**.
3. Buka **phpMyAdmin** (`http://localhost/phpmyadmin/`).
4. Buat database baru bernama `db_skill4life` dan impor file `database.sql`.
   *(Catatan: Jika lupa mengimpor, sistem memiliki mekanisme auto-initialize saat file pertama kali dibuka).*
5. Buka browser ke alamat: `http://localhost:8080/no-poverty-mission/` (atau `http://localhost/no-poverty-mission/` tergantung port Apache Anda).

### Akun Uji Coba:
| Peran | Alamat Email | Kata Sandi | Kegunaan |
| :--- | :--- | :--- | :--- |
| **Peserta** | `budi@gmail.com` | `budi1234` | Menguji alur belajar, kuis, dashboard, profil, dan sertifikat |
| **Admin** | `admin@skill4life.id` | `admin1234` | Menguji panel pengelola, statistik tren, CRUD kursus/modul/soal |

---

## 6. Panduan Khusus untuk Pengembang Frontend

Bagi tim frontend yang akan menyempurnakan tampilan atau membuat fitur UI baru:

1. **Gunakan Klien API Resmi ([`assets/js/api.js`](file:///c:/laragon/www/no-poverty-mission/assets/js/api.js))**:
   Hindari menulis `fetch()` manual. Seluruh method API seperti `ambilDaftarKursus()`, `simpanProgres()`, `kirimHasilKuis()`, dan fungsi admin sudah tersedia dalam bentuk modular.
   ```javascript
   import { ambilDaftarKursus, ambilStatistik } from '../assets/js/api.js';
   ```
2. **Kepatuhan Terhadap Kontrak API ([`docs/API_CONTRACT.md`](file:///c:/laragon/www/no-poverty-mission/docs/API_CONTRACT.md))**:
   Periksa dokumen kontrak sebelum mengubah atau menambah form. Seluruh respons sukses memiliki format `{ ok: true, data: ... }` dan respons galat berformat `{ ok: false, pesan: "..." }`.
3. **Desain Berbasis Token CSS ([`assets/css/variabel.css`](file:///c:/laragon/www/no-poverty-mission/assets/css/variabel.css))**:
   Gunakan variabel CSS yang sudah ada:
   * Warna teks: `var(--teks)`, `var(--teks-2)`, `var(--teks-3)`
   * Latar: `var(--latar)`, `var(--permukaan)`, `var(--permukaan-2)`
   * Aksen: `var(--aksen)` (`#1F6F4A`)
   * Spacing: `var(--spasi-8)`, `var(--spasi-16)`, `var(--spasi-24)`, dst.
4. **Responsivitas & Aksesibilitas**:
   Pastikan tabel menggunakan pembungkus `<div class="wadah-tabel">`, form memiliki `<label>` yang tepat, dan video embed tetap rasio 16:9 di perangkat ponsel.

---

## 7. Prinsip Utama & Aturan Baku (Do's & Don'ts)

* ✅ **Do**: Selalu masukkan query database ke dalam kelas **Model** (`app/Models/`), jangan menulis query SQL di file View atau Controller.
* ✅ **Do**: Gunakan method `normalisasiUrlYoutube()` jika menambahkan modul video agar format link YouTube apa pun otomatis menjadi embed resmi.
* ❌ **Don't**: Jangan pernah mengirimkan kunci jawaban kuis (`jawaban_benar`) ke browser peserta sebelum ujian selesai.
* ❌ **Don't**: Jangan bypass validasi sesi di sisi klien; controller harus selalu memverifikasi status login (`requirePeserta` atau `requireAdmin`).
* ❌ **Don't**: Jangan mengubah konfigurasi database menjadi data hardcoded di dalam script; selalu gunakan `config/koneksi.php`.

---

*Semoga panduan ini membantu Anda mengembangkan Skill4Life menjadi platform pelatihan kerja yang berdampak nyata bagi pengentasan kemiskinan di Indonesia!*
