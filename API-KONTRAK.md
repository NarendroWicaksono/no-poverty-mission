# Kontrak Antarmuka Pemrograman Aplikasi (API Contract)
> **Skill4Life — Platform Kursus Keterampilan Kerja Gratis (SDG 1 No Poverty)**  
> Dokumen acuan integrasi antara frontend UI dan backend developer.

---

## 1. Standar Respons Umum

Seluruh respons API mengembalikan format JSON standar dengan status HTTP semantik (200, 201, 400, 401, 404, 500).

```json
{
  "sukses": true,
  "pesan": "Operasi berhasil dilakukan",
  "data": {}
}
```

Jika terjadi kesalahan (galat):
```json
{
  "sukses": false,
  "pesan": "Deskripsi kendala yang terjadi",
  "galat": [
    { "bidang": "email", "pesan": "Format email tidak valid" }
  ]
}
```

---

## 2. Daftar Titik Akhir (Endpoints)

### A. Publik & Katalog Kursus

#### 1. Ringkasan Statistik
- **Metode**: `GET`
- **URL**: `/api/v1/statistik`
- **Respons 200 OK**:
```json
{
  "sukses": true,
  "data": {
    "total_kursus": 6,
    "total_modul": 24,
    "total_sertifikat": 840,
    "mitra_komunitas": 32
  }
}
```

#### 2. Kategori Kursus
- **Metode**: `GET`
- **URL**: `/api/v1/kategori`
- **Respons 200 OK**:
```json
{
  "sukses": true,
  "data": [
    {
      "id_kategori": 1,
      "nama": "Aplikasi perkantoran",
      "slug": "aplikasi-perkantoran",
      "deskripsi": "Pengolahan spreadsheet, surat dinas, dan presentasi kerja.",
      "jumlah_kursus": 4
    }
  ]
}
```

#### 3. Daftar Kursus
- **Metode**: `GET`
- **URL**: `/api/v1/kursus?kategori={slug}&level={level}&cari={kata_kunci}`
- **Respons 200 OK**:
```json
{
  "sukses": true,
  "data": [
    {
      "id_kursus": 1,
      "judul": "Microsoft Excel dasar",
      "slug": "microsoft-excel-dasar",
      "kategori": "Aplikasi perkantoran",
      "kategori_slug": "aplikasi-perkantoran",
      "level": "Pemula",
      "estimasi_waktu": "2.5 jam",
      "jumlah_modul": 4,
      "ringkasan": "Navigasi lembar kerja, input data, format sel, dan rumus matematika dasar."
    }
  ]
}
```

#### 4. Detail Kursus & Silabus
- **Metode**: `GET`
- **URL**: `/api/v1/kursus/{slug}`
- **Respons 200 OK**:
```json
{
  "sukses": true,
  "data": {
    "id_kursus": 1,
    "judul": "Microsoft Excel dasar",
    "slug": "microsoft-excel-dasar",
    "level": "Pemula",
    "estimasi_waktu": "2.5 jam",
    "deskripsi": "Penjelasan menyeluruh mengenai fungsi administratif...",
    "tujuan_belajar": [
      "Memahami koordinat baris dan kolom sel",
      "Menguasai rumus dasar SUM, AVERAGE, MIN, MAX"
    ],
    "daftar_modul": [
      {
        "id_modul": 1,
        "urutan": 1,
        "judul_modul": "Antarmuka dan navigasi dasar",
        "estimasi_menit": 20
      }
    ]
  }
}
```

---

### B. Pembelajaran & Kuis Akhir

#### 5. Konten Modul
- **Metode**: `GET`
- **URL**: `/api/v1/kursus/{slug}/modul/{id_modul}`
- **Respons 200 OK**:
```json
{
  "sukses": true,
  "data": {
    "id_modul": 1,
    "kursus_slug": "microsoft-excel-dasar",
    "urutan": 1,
    "judul_modul": "Antarmuka dan navigasi dasar",
    "video_url": "https://www.youtube.com/embed/RDX3AUhZ30s",
    "konten_html": "<h3>Navigasi lembar sebar</h3><p>Materi teks...</p>"
  }
}
```

#### 6. Simpan Status Modul Selesai
- **Metode**: `POST`
- **URL**: `/api/v1/progres/selesai`
- **Permintaan (Request)**:
```json
{
  "id_modul": 1,
  "kursus_slug": "microsoft-excel-dasar"
}
```
- **Respons 200 OK**:
```json
{
  "sukses": true,
  "data": {
    "persentase_selesai": 25,
    "modul_tuntas": [1],
    "total_modul": 4
  }
}
```

#### 7. Lembar Soal Kuis Akhir
- **Metode**: `GET`
- **URL**: `/api/v1/kursus/{slug}/kuis`
- **Respons 200 OK**:
```json
{
  "sukses": true,
  "data": [
    {
      "id_soal": 1,
      "urutan": 1,
      "pertanyaan": "Setiap penulisan rumus di Microsoft Excel diawali tanda...",
      "pilihan": {
        "A": "Tanda tambah (+)",
        "B": "Tanda sama dengan (=)",
        "C": "Tanda bintang (*)",
        "D": "Tanda seru (!)"
      }
    }
  ]
}
```

#### 8. Evaluasi & Pengesahan Kuis
- **Metode**: `POST`
- **URL**: `/api/v1/kursus/{slug}/kuis/evaluasi`
- **Permintaan (Request)**:
```json
{
  "jawaban": {
    "1": "B",
    "2": "C"
  }
}
```
- **Respons 200 OK**:
```json
{
  "sukses": true,
  "data": {
    "nilai": 90,
    "jawaban_benar": 9,
    "total_soal": 10,
    "lulus": true,
    "nomor_sertifikat": "S4L-2026-000123",
    "evaluasi": [
      {
        "id_soal": 1,
        "jawaban_peserta": "B",
        "kunci_benar": "B",
        "is_benar": true,
        "pembahasan": "Semua rumus Excel diawali tanda sama dengan (=)."
      }
    ]
  }
}
```

---

### C. Sertifikat & Verifikasi Publik

#### 9. Verifikasi Nomor Sertifikat
- **Metode**: `GET`
- **URL**: `/api/v1/sertifikat/{nomor_sertifikat}`
- **Respons 200 OK (Sertifikat Ditemukan)**:
```json
{
  "sukses": true,
  "data": {
    "nomor_sertifikat": "S4L-2026-000123",
    "nama_peserta": "Budi Santoso",
    "nama_kursus": "Menulis CV dan surat lamaran kerja",
    "tanggal_terbit": "2026-11-15",
    "status": "Terdaftar sah",
    "kode_verifikasi": "a1b2c3d4e5f67890abcdef1234567890"
  }
}
```
- **Respons 404 Not Found (Nomor Tidak Sah)**:
```json
{
  "sukses": false,
  "pesan": "Nomor sertifikat tidak ditemukan dalam pangkalan data publik."
}
```

---

### D. Autentikasi & Profil Peserta

#### 10. Pendaftaran Akun Peserta
- **Metode**: `POST`
- **URL**: `/api/v1/auth/daftar`
- **Permintaan (Request)**:
```json
{
  "nama_lengkap": "Budi Santoso",
  "email": "budi@gmail.com",
  "kata_sandi": "budi1234",
  "konfirmasi_sandi": "budi1234"
}
```

#### 11. Masuk Akun
- **Metode**: `POST`
- **URL**: `/api/v1/auth/masuk`
- **Permintaan (Request)**:
```json
{
  "email": "budi@gmail.com",
  "kata_sandi": "budi1234"
}
```
- **Respons 200 OK**:
```json
{
  "sukses": true,
  "data": {
    "token": "bearer_jwt_token_here",
    "pengguna": {
      "id": 2,
      "nama_lengkap": "Budi Santoso",
      "email": "budi@gmail.com",
      "peran": "peserta"
    }
  }
}
```
