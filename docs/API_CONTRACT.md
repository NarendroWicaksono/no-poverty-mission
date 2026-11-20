# Kontrak API Backend Skill4Life (MVC PHP + MySQL)

**Base Endpoint:** `api/index.php?aksi=<nama_aksi>`  
**Format Payload:** JSON (`Content-Type: application/json`)  
**Autentikasi:** Cookie Session (`credentials: 'same-origin'`)  
**Keamanan POST:** Setiap request `POST` wajib menyertakan header `X-CSRF-Token` (tersedia di `window.__S4L_CSRF__` pada layout utama).

---

## Kode Status HTTP
| Kode | Arti |
| :--- | :--- |
| `200` | Permintaan berhasil |
| `201` | Data baru berhasil dibuat (`daftar`, `tambah_kursus`, `tambah_modul`, `tambah_soal`) |
| `400` | Parameter atau `aksi` tidak valid |
| `401` | Belum login / kredensial salah (`butuh_login: true` pada aksi peserta) |
| `403` | Akses ditolak (khusus admin atau token CSRF tidak valid) |
| `404` | Data tidak ditemukan (`detail_kursus`, `sertifikat`, dll.) |
| `422` | Validasi input gagal (field wajib kosong, format salah, dll.) |
| `500` | Kesalahan internal server |
| `503` | Koneksi database MySQL tidak tersedia |

---

## 1. Autentikasi & Profil

| Aksi | Method | Akses | Request Body / Query | Response Sukses |
| :--- | :--- | :--- | :--- | :--- |
| `cek_status` | `GET` | Publik | - | `{ ok: true, mode: "mysql_mvc", database }` |
| `login` | `POST` | Publik | `{ email, kata_sandi, peran }` (`peserta`/`admin`) | `{ ok: true, user }` |
| `daftar` | `POST` | Publik | `{ nama_lengkap, email, kata_sandi, pekerjaan?, kota? }` | `{ ok: true, user }` |
| `logout` | `POST` | Publik | - | `{ ok: true }` |
| `perbarui_profil` | `POST` | User | `{ nama_lengkap, nomor_telepon, pekerjaan, kota }` | `{ ok: true, user }` |
| `ubah_sandi` | `POST` | User | `{ sandi_lama, sandi_baru }` | `{ ok: true, pesan }` |

---

## 2. Data Publik (Katalog & Materi)

| Aksi | Method | Akses | Query Parameter | Response Sukses |
| :--- | :--- | :--- | :--- | :--- |
| `statistik` | `GET` | Publik | - | `{ ok: true, data: { total_kursus, total_modul, total_sertifikat, total_peserta, mitra_komunitas, tren_bulanan[], kursus_populer[] } }` |
| `kategori` | `GET` | Publik | - | `{ ok: true, data: [...] }` |
| `kursus` | `GET` | Publik | - | `{ ok: true, data: [...] }` |
| `detail_kursus` | `GET` | Publik | `slug` | `{ ok: true, data: { ... } }` (`404` jika tidak ada) |
| `modul` | `GET` | Publik | `slug` | `{ ok: true, data: [...] }` |

---

## 3. Progres Belajar Peserta

| Aksi | Method | Akses | Request Body / Query | Response Sukses |
| :--- | :--- | :--- | :--- | :--- |
| `progres_kursus` | `GET` | User (opsional) | `?slug=<slug>` | `{ ok: true, data: [id_modul, ...] }` |
| `simpan_progres` | `POST` | User | `{ slug, id_modul }` | `{ ok: true, modul_selesai: [...] }` |
| `hapus_progres` | `POST` | User | `{ slug, id_modul }` | `{ ok: true, modul_selesai: [...] }` |
| `ringkasan_peserta` | `GET` | User (opsional) | - | `{ ok: true, data: [...] }` |

---

## 4. Kuis Evaluasi & Sertifikat

| Aksi | Method | Akses | Request Body / Query | Response Sukses |
| :--- | :--- | :--- | :--- | :--- |
| `soal_kuis` | `GET` | Publik | `?slug=<slug>` | `{ ok: true, data: [...] }` *(tanpa `jawaban_benar` & `pembahasan`)* |
| `kirim_kuis` | `POST` | User | `{ slug, jawaban: { [id_soal]: "A"|"B"|"C"|"D" } }` | `{ ok: true, nilai, jawaban_benar, total_soal, lulus, nomor_sertifikat, evaluasi: [...] }` |
| `sertifikat` | `GET` | Publik | `?nomor=<nomor_sertifikat>` | `{ ok: true, data: { ... } }` *(tanpa `email`)* |
| `contoh_nomor_sertifikat` | `GET` | Publik | - | `{ ok: true, data: ["S4L-...", ...] }` |
| `sertifikat_pengguna` | `GET` | User (opsional) | - | `{ ok: true, data: [...] }` |

---

## 5. Panel Pengelola (Khusus Admin — `403` jika bukan admin)

| Aksi | Method | Request Body / Query | Response Sukses |
| :--- | :--- | :--- | :--- |
| `semua_peserta` | `GET` | - | `{ ok: true, data: [...] }` |
| `semua_sertifikat` | `GET` | - | `{ ok: true, data: [...] }` |
| `soal_kuis_admin` | `GET` | `?slug=<slug>` | `{ ok: true, data: [...] }` *(termasuk `jawaban_benar` & `pembahasan`)* |
| `tambah_kursus` | `POST` | `{ judul, kategori, level, estimasi_waktu, ringkasan, deskripsi?, tujuan_belajar? }` | `{ ok: true, data }` |
| `ubah_kursus` | `POST` | `{ id_kursus, judul, kategori, level, estimasi_waktu, ringkasan, deskripsi?, tujuan_belajar? }` | `{ ok: true, data }` |
| `hapus_kursus` | `POST` | `{ id_kursus }` | `{ ok: true }` |
| `tambah_modul` | `POST` | `{ kursus_slug, judul_modul, urutan, estimasi_menit, video_url?, konten }` | `{ ok: true, data }` |
| `ubah_modul` | `POST` | `{ id_modul, judul_modul, urutan, estimasi_menit, video_url?, konten }` | `{ ok: true }` |
| `hapus_modul` | `POST` | `{ id_modul }` | `{ ok: true }` |
| `tambah_soal` | `POST` | `{ kursus_slug, pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, jawaban_benar, pembahasan? }` | `{ ok: true, id }` |
| `ubah_soal` | `POST` | `{ id_soal, pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, jawaban_benar, pembahasan? }` | `{ ok: true }` |
| `hapus_soal` | `POST` | `{ id_soal }` | `{ ok: true }` |
| `reset_demo` | `POST` | - | `{ ok: true }` |
