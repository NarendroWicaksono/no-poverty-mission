# -*- coding: utf-8 -*-
import json
import os

data_dir = os.path.join("skill4life", "assets", "data")
os.makedirs(data_dir, exist_ok=True)

# 1. statistik.json
statistik = {
    "total_kursus": 8,
    "total_peserta": 14280,
    "total_sertifikat": 8945,
    "mitra_komunitas": 52,
    "rating_kepuasan": 4.9,
    "bebas_biaya": "100% Selamanya"
}
with open(os.path.join(data_dir, "statistik.json"), "w", encoding="utf-8") as f:
    json.dump(statistik, f, indent=2, ensure_ascii=False)

# 2. kategori.json
kategori = [
    {
        "id": 1,
        "nama": "Aplikasi Perkantoran",
        "slug": "aplikasi-perkantoran",
        "ikon": "fa-file-excel",
        "warna": "#10b981",
        "deskripsi": "Kuasai software administrasi dasar hingga mahir seperti Excel, Word, dan PowerPoint untuk meningkatkan produktivitas kerja kantor.",
        "jumlah_kursus": 4
    },
    {
        "id": 2,
        "nama": "Kesiapan Karir & Kerja",
        "slug": "kesiapan-karir-kerja",
        "ikon": "fa-user-tie",
        "warna": "#3b82f6",
        "deskripsi": "Panduan pembuatan resume lolos ATS modern, portofolio kerja, serta strategi menjawab interview HRD dengan metode STAR.",
        "jumlah_kursus": 2
    },
    {
        "id": 3,
        "nama": "Bisnis & UMKM",
        "slug": "bisnis-umkm",
        "ikon": "fa-store",
        "warna": "#f59e0b",
        "deskripsi": "Keterampilan mendirikan, menentukan HPP, arus kas, dan memasarkan produk usaha mikro modal minim lewat WhatsApp & medsos.",
        "jumlah_kursus": 1
    },
    {
        "id": 4,
        "nama": "Literasi Keuangan",
        "slug": "literasi-keuangan",
        "ikon": "fa-wallet",
        "warna": "#8b5cf6",
        "deskripsi": "Edukasi anggaran 50/30/20, pencatatan kas harian, pembentukan dana darurat keluarga, dan waspada jerat pinjol ilegal.",
        "jumlah_kursus": 1
    }
]
with open(os.path.join(data_dir, "kategori.json"), "w", encoding="utf-8") as f:
    json.dump(kategori, f, indent=2, ensure_ascii=False)

# 3. testimoni.json
testimoni = [
    {
        "id": 1,
        "nama": "Budi Santoso",
        "peran": "Admin Operasional di Logistik Nasional",
        "foto": "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&auto=format&fit=crop&q=80",
        "asal": "Surabaya, Jawa Timur",
        "kursus": "Microsoft Excel Lanjutan & Menulis CV ATS",
        "isi": "Setelah 7 bulan menganggur dan puluhan lamaran ditolak, saya belajar cara membuat CV ATS di Skill4Life dan menguasai VLOOKUP serta Pivot Table. Dalam 3 minggu setelah update CV, saya dipanggil 4 interview dan diterima kerja sebagai staf admin. Platform ini mengubah hidup saya tanpa bayar sepeser pun!",
        "bintang": 5
    },
    {
        "id": 2,
        "nama": "Siti Rahmawati",
        "peran": "Pemilik Usaha Sambal Rumahan 'Dapur Rahma'",
        "foto": "https://images.unsplash.com/photo-1580489944761-15a19d654956?w=150&auto=format&fit=crop&q=80",
        "asal": "Yogyakarta",
        "kursus": "Memulai Usaha Kecil Modal Minim & WhatsApp Business",
        "isi": "Dulu saya jualan asal-asalan tanpa tahu HPP sebenarnya, sering merasa ramai pembeli tapi uang modal malah berkurang. Lewat materi UMKM di Skill4Life, saya belajar menghitung biaya gas, kemasan, dan upah diri sendiri. Katalog WhatsApp Business juga membuat pembeli repeat order terus. Alhamdulillah omset naik 3 kali lipat!",
        "bintang": 5
    },
    {
        "id": 3,
        "nama": "Ahmad Fauzi",
        "peran": "Fresh Graduate SMK & Asisten Administrasi",
        "foto": "https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?w=150&auto=format&fit=crop&q=80",
        "asal": "Bandung, Jawa Barat",
        "kursus": "Microsoft Word untuk Surat & Dokumen Resmi",
        "isi": "Keluarga saya tidak mampu membiayai kursus komputer berbayar yang harganya ratusan ribu. Skill4Life memberi materi yang sangat terstruktur dari dasar. Sertifikatnya juga resmi dan ada QR verifikasi publik yang bisa saya cantumkan di portofolio magang saya.",
        "bintang": 5
    },
    {
        "id": 4,
        "nama": "Dewi Lestari",
        "peran": "Ibu Rumah Tangga & Pekerja Lepas",
        "foto": "https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80",
        "asal": "Semarang, Jawa Tengah",
        "kursus": "Literasi Keuangan Dasar & Perencanaan Anggaran",
        "isi": "Modul perencanaan keuangan 50/30/20 membuka mata saya. Kami sekeluarga sempat terlilit utang karena bocor halus belanja harian. Sekarang kami punya dana darurat kecil dan tenang tanpa teror pinjol. Terima kasih Skill4Life untuk ilmu yang sangat berdampak ini!",
        "bintang": 5
    }
]
with open(os.path.join(data_dir, "testimoni.json"), "w", encoding="utf-8") as f:
    json.dump(testimoni, f, indent=2, ensure_ascii=False)

# 4. kursus.json
kursus = [
    {
        "id": 1,
        "kategori_id": 1,
        "kategori_nama": "Aplikasi Perkantoran",
        "kategori_slug": "aplikasi-perkantoran",
        "judul": "Microsoft Excel Dasar: Olah Data & Rumus Esensial",
        "slug": "microsoft-excel-dasar",
        "ringkasan": "Pelajari navigasi lembar kerja, input data efisien, pemformatan sel, rumus matematika dasar, serta pembuatan tabel dan grafik visual.",
        "deskripsi": "Kursus Microsoft Excel Dasar ini dirancang khusus bagi siapa saja yang ingin memulai karir administratif atau mengelola catatan usaha sendiri. Anda akan belajar dari nol: memahami antarmuka lembar sebar, mengatur tata letak sel, menggunakan rumus dasar seperti SUM, AVERAGE, MIN, MAX, dan COUNT, serta mengubah data mentah menjadi grafik yang mudah dibaca.",
        "tujuan_belajar": [
            "Memahami antarmuka dan navigasi kerja Excel secara percaya diri",
            "Mengetahui cara menginput dan memformat angka, mata uang Rupiah, dan tanggal dengan benar",
            "Menguasai rumus-rumus aritmatika dan fungsi statistik dasar (SUM, AVERAGE, COUNT, MIN, MAX)",
            "Mampu membuat tabel data rapi dan menyajikannya dalam grafik visual yang informatif"
        ],
        "tingkat_kesulitan": "Pemula",
        "estimasi_waktu": "2.5 Jam",
        "jumlah_modul": 4,
        "gambar_sampul": "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&auto=format&fit=crop&q=80",
        "ikon_badge": "fa-table",
        "populer": True,
        "peserta": 4820,
        "rating": 4.9
    },
    {
        "id": 2,
        "kategori_id": 1,
        "kategori_nama": "Aplikasi Perkantoran",
        "kategori_slug": "aplikasi-perkantoran",
        "judul": "Microsoft Excel Lanjutan: Analisis Data & Otomasi Laporan",
        "slug": "microsoft-excel-lanjutan",
        "ringkasan": "Tingkatkan keahlian spreadsheet Anda dengan rumus pencarian VLOOKUP/XLOOKUP, logika IF bersarang, pengurutan, filter canggih, dan Pivot Table.",
        "deskripsi": "Dalam dunia kerja modern, keahlian analisis data Excel tingkat menengah-lanjut adalah nilai tambah yang sangat dihargai pemberi kerja. Kursus ini membahas secara tuntas pemanfaatan fungsi lookup seperti VLOOKUP dan fungsi modern XLOOKUP, kondisional IF dan IFS, pembuatan ringkasan otomatis dengan Pivot Table, serta visualisasi dashboard ringkas yang siap dipresentasikan ke atasan atau klien.",
        "tujuan_belajar": [
            "Menguasai fungsi relasi data menggunakan VLOOKUP dan XLOOKUP secara presisi",
            "Menerapkan logika bersyarat IF, AND, OR, dan IFS untuk otomatisasi status data",
            "Mampu mengolah ribuan baris data menjadi ringkasan interaktif dengan Pivot Table",
            "Mengenal dasar pembersihan data (data cleansing) dan validasi input sel"
        ],
        "tingkat_kesulitan": "Menengah",
        "estimasi_waktu": "3 Jam",
        "jumlah_modul": 4,
        "gambar_sampul": "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&auto=format&fit=crop&q=80",
        "ikon_badge": "fa-chart-pie",
        "populer": True,
        "peserta": 3710,
        "rating": 4.9
    },
    {
        "id": 3,
        "kategori_id": 1,
        "kategori_nama": "Aplikasi Perkantoran",
        "kategori_slug": "aplikasi-perkantoran",
        "judul": "Microsoft Word untuk Surat dan Dokumen Resmi",
        "slug": "microsoft-word-surat-dokumen",
        "ringkasan": "Kuasai pembuatan surat resmi, tata letak dokumen standar perkantoran, pengaturan margin, penomoran halaman dinamis, dan mail merge praktis.",
        "deskripsi": "Microsoft Word bukan sekadar tempat mengetik teks, melainkan sarana menghasilkan dokumen resmi berstandar profesional. Melalui modul ini, Anda akan dibimbing membuat surat niaga, surat dinas, laporan berkala, hingga undangan massal dengan Mail Merge. Anda juga akan mempelajari teknik styling paragraf, pembuatan daftar isi otomatis, dan konversi ke PDF siap kirim.",
        "tujuan_belajar": [
            "Mengetahui format baku surat dinas dan surat bisnis resmi di Indonesia",
            "Mengatur margin kertas, indentasi paragraf, tabulasi rapi, dan kop surat profesional",
            "Menggunakan fitur penomoran halaman berbeda pada halaman cover dan isi",
            "Memanfaatkan Mail Merge untuk mengirim ratusan surat atau sertifikat dalam hitungan menit"
        ],
        "tingkat_kesulitan": "Pemula",
        "estimasi_waktu": "2 Jam",
        "jumlah_modul": 4,
        "gambar_sampul": "https://images.unsplash.com/photo-1455390582262-044cdead277a?w=600&auto=format&fit=crop&q=80",
        "ikon_badge": "fa-file-alt",
        "populer": False,
        "peserta": 2150,
        "rating": 4.8
    },
    {
        "id": 4,
        "kategori_id": 1,
        "kategori_nama": "Aplikasi Perkantoran",
        "kategori_slug": "aplikasi-perkantoran",
        "judul": "Microsoft PowerPoint untuk Presentasi Efektif",
        "slug": "microsoft-powerpoint-presentasi",
        "ringkasan": "Pelajari teknik merancang slide presentasi yang bersih, visual storytelling, pemilihan warna kontras, serta penyampaian ide yang percaya diri.",
        "deskripsi": "Slide presentasi yang buruk dan penuh teks panjang sering kali membuat audiens bosan dan pesan penting Anda tidak tersampaikan. Kursus ini mengajarkan cara mengubah ide bisnis atau laporan kerja menjadi tayangan slide yang elegan dan berbobot. Anda akan belajar hierarki visual, penggunaan ikon, teknik animasi halus, dan tips berbicara di depan umum.",
        "tujuan_belajar": [
            "Memahami prinsip desain slide: kontras, keterbacaan, whitespace, dan tipografi",
            "Menggantikan paragraf panjang menjadi poin-poin visual dan SmartArt terstruktur",
            "Menggunakan animasi transisi yang halus dan profesional tanpa terkesan berlebihan",
            "Mempersiapkan presentasi proyek kerja atau pitch usaha di hadapan audiens nyata"
        ],
        "tingkat_kesulitan": "Pemula",
        "estimasi_waktu": "2 Jam",
        "jumlah_modul": 4,
        "gambar_sampul": "https://images.unsplash.com/photo-1557804506-669a67965ba0?w=600&auto=format&fit=crop&q=80",
        "ikon_badge": "fa-tv",
        "populer": False,
        "peserta": 1890,
        "rating": 4.8
    },
    {
        "id": 5,
        "kategori_id": 2,
        "kategori_nama": "Kesiapan Karir & Kerja",
        "kategori_slug": "kesiapan-karir-kerja",
        "judul": "Menulis CV & Surat Lamaran Kerja ATS Friendly",
        "slug": "menulis-cv-surat-lamaran-ats",
        "ringkasan": "Strategi merancang resume lolos sistem seleksi otomatis (ATS), menulis surat lamaran persuasif, dan menyusun portofolio kerja yang menonjol.",
        "deskripsi": "Banyak pencari kerja gagal di tahap administrasi bukan karena kurang berbakat, melainkan karena format CV mereka tidak dapat dibaca oleh Applicant Tracking System (ATS). Di kursus ini, Anda akan mempelajari anatomi CV ramah ATS, kata kunci industri yang tepat, perumusan pencapaian kerja berbasis angka, serta template surat lamaran yang memikat perhatian HRD.",
        "tujuan_belajar": [
            "Memahami cara kerja sistem ATS dalam menyaring berkas pelamar kerja",
            "Menyusun struktur CV yang bersih, terstandar, dan fokus pada dampak nyata (action verbs)",
            "Menulis surat lamaran (cover letter) yang spesifik dan menjawab kebutuhan perusahaan",
            "Menghindari 10 kesalahan fatal yang paling sering membuat CV langsung ditolak"
        ],
        "tingkat_kesulitan": "Pemula",
        "estimasi_waktu": "2.5 Jam",
        "jumlah_modul": 4,
        "gambar_sampul": "https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=600&auto=format&fit=crop&q=80",
        "ikon_badge": "fa-id-badge",
        "populer": True,
        "peserta": 5640,
        "rating": 4.95
    },
    {
        "id": 6,
        "kategori_id": 2,
        "kategori_nama": "Kesiapan Karir & Kerja",
        "kategori_slug": "kesiapan-karir-kerja",
        "judul": "Persiapan Wawancara Kerja & Komunikasi Profesional",
        "slug": "persiapan-wawancara-kerja",
        "ringkasan": "Kuasai teknik menjawab pertanyaan sulit HRD dengan metode STAR, etika komunikasi tatap muka & daring, serta trik negosiasi gaji awal.",
        "deskripsi": "Wawancara kerja adalah panggung utama Anda untuk membuktikan bahwa Anda adalah kandidat paling tepat. Kursus ini mengupas tuntas pertanyaan yang paling sering diajukan, mulai dari 'Ceritakan tentang diri Anda' hingga pertanyaan studi kasus perilaku. Anda akan mempraktikkan metode STAR (Situation, Task, Action, Result) dan membangun bahasa tubuh yang meyakinkan.",
        "tujuan_belajar": [
            "Menggunakan metode STAR untuk menjawab pertanyaan situasional dan perilaku",
            "Menjawab pertanyaan kelebihan, kekurangan diri, dan alasan keluar dari pekerjaan lama",
            "Menguasai etika berpakaian, kontak mata, dan komunikasi non-verbal saat interview",
            "Mengetahui cara menanyakan balik kepada pewawancara dan tindak lanjut (thank-you email)"
        ],
        "tingkat_kesulitan": "Menengah",
        "estimasi_waktu": "2.5 Jam",
        "jumlah_modul": 4,
        "gambar_sampul": "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&auto=format&fit=crop&q=80",
        "ikon_badge": "fa-comments",
        "populer": True,
        "peserta": 4120,
        "rating": 4.9
    },
    {
        "id": 7,
        "kategori_id": 4,
        "kategori_nama": "Literasi Keuangan",
        "kategori_slug": "literasi-keuangan",
        "judul": "Literasi Keuangan Dasar & Perencanaan Anggaran Mandiri",
        "slug": "literasi-keuangan-dasar",
        "ringkasan": "Kelola penghasilan keluarga dan pribadi dengan bijak: alokasi 50/30/20, dana darurat, tips menabung konsisten, dan waspada bahaya pinjol ilegal.",
        "deskripsi": "Bebas dari kemiskinan dimulai dengan keterampilan mengelola setiap rupiah yang diperoleh. Kursus ini memberikan edukasi keuangan dasar tanpa istilah perbankan yang rumit. Pelajari cara mencatat pengeluaran harian, memisahkan kebutuhan vs keinginan, membangun dana darurat sedikit demi sedikit, dan melindungi keluarga dari tawaran pinjaman online berbunga mencekik.",
        "tujuan_belajar": [
            "Memahami prinsip pembagian anggaran sederhana 50% kebutuhan, 30% keinginan, 20% tabungan",
            "Mampu membuat buku kas pencatatan pengeluaran harian yang disiplin",
            "Membangun dana cadangan darurat untuk mengantisipasi musibah atau masa menganggur",
            "Mengenali ciri-ciri pinjol ilegal dan investasi bodong yang merugikan masyarakat"
        ],
        "tingkat_kesulitan": "Pemula",
        "estimasi_waktu": "1.5 Jam",
        "jumlah_modul": 3,
        "gambar_sampul": "https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=600&auto=format&fit=crop&q=80",
        "ikon_badge": "fa-piggy-bank",
        "populer": False,
        "peserta": 2890,
        "rating": 4.85
    },
    {
        "id": 8,
        "kategori_id": 3,
        "kategori_nama": "Bisnis & UMKM",
        "kategori_slug": "bisnis-umkm",
        "judul": "Memulai Usaha Kecil Modal Minim & Pemasaran Gratis",
        "slug": "memulai-usaha-kecil-modal-minim",
        "ringkasan": "Panduan praktis membuka usaha rumahan dari hobi: riset pasar sederhana, kalkulasi HPP dan harga jual, serta promosi lewat WhatsApp & medsos.",
        "deskripsi": "Kewirausahaan adalah jalan tercepat membuka lapangan kerja mandiri. Kursus ini membimbing Anda memulai usaha dari skala kecil dengan modal yang Anda miliki saat ini. Anda akan mempelajari cara mencari ide produk yang diminati warga sekitar, menghitung Harga Pokok Penjualan (HPP) agar tidak rugi, serta memanfaatkan saluran gratis seperti WhatsApp Bisnis dan media sosial.",
        "tujuan_belajar": [
            "Menemukan peluang usaha dari masalah di lingkungan sekitar tanpa perlu modal besar",
            "Menghitung biaya bahan baku, operasional, dan menentukan harga jual yang menghasilkan untung",
            "Menggunakan WhatsApp Bisnis untuk katalog produk dan komunikasi pelanggan yang ramah",
            "Menerapkan teknik foto produk menarik hanya dengan kamera ponsel biasa"
        ],
        "tingkat_kesulitan": "Pemula",
        "estimasi_waktu": "2.5 Jam",
        "jumlah_modul": 4,
        "gambar_sampul": "https://images.unsplash.com/photo-1556742049-0a67c5574f73?w=600&auto=format&fit=crop&q=80",
        "ikon_badge": "fa-store-alt",
        "populer": True,
        "peserta": 4980,
        "rating": 4.95
    }
]
with open(os.path.join(data_dir, "kursus.json"), "w", encoding="utf-8") as f:
    json.dump(kursus, f, indent=2, ensure_ascii=False)

# 5. sertifikat.json (sample verified certificates)
sertifikat = [
    {
        "nomor_sertifikat": "S4L-2026-000123",
        "nama_lengkap": "Budi Santoso",
        "email": "budi@gmail.com",
        "kursus_id": 5,
        "kursus_judul": "Menulis CV & Surat Lamaran Kerja ATS Friendly",
        "kursus_slug": "menulis-cv-surat-lamaran-ats",
        "kategori_nama": "Kesiapan Karir & Kerja",
        "tanggal_terbit": "2026-11-15",
        "nilai_kuis": 90,
        "kode_verifikasi": "a1b2c3d4e5f67890abcdef1234567890abcdef1234567890abcdef1234567890",
        "penandatangan_nama": "Dr. Ir. Hendra Gunawan, M.T.",
        "penandatangan_jabatan": "Direktur Pembina Skill4Life",
        "status": "Valid & Terdaftar Resmi"
    },
    {
        "nomor_sertifikat": "S4L-2026-000124",
        "nama_lengkap": "Siti Rahmawati",
        "email": "siti@gmail.com",
        "kursus_id": 8,
        "kursus_judul": "Memulai Usaha Kecil Modal Minim & Pemasaran Gratis",
        "kursus_slug": "memulai-usaha-kecil-modal-minim",
        "kategori_nama": "Bisnis & UMKM",
        "tanggal_terbit": "2026-11-18",
        "nilai_kuis": 100,
        "kode_verifikasi": "b2c3d4e5f6a17890abcdef1234567890abcdef1234567890abcdef1234567891",
        "penandatangan_nama": "Dr. Ir. Hendra Gunawan, M.T.",
        "penandatangan_jabatan": "Direktur Pembina Skill4Life",
        "status": "Valid & Terdaftar Resmi"
    },
    {
        "nomor_sertifikat": "S4L-2026-000125",
        "nama_lengkap": "Ahmad Fauzi",
        "email": "ahmad.fauzi@gmail.com",
        "kursus_id": 1,
        "kursus_judul": "Microsoft Excel Dasar: Olah Data & Rumus Esensial",
        "kursus_slug": "microsoft-excel-dasar",
        "kategori_nama": "Aplikasi Perkantoran",
        "tanggal_terbit": "2026-11-10",
        "nilai_kuis": 80,
        "kode_verifikasi": "c3d4e5f6a1b27890abcdef1234567890abcdef1234567890abcdef1234567892",
        "penandatangan_nama": "Dr. Ir. Hendra Gunawan, M.T.",
        "penandatangan_jabatan": "Direktur Pembina Skill4Life",
        "status": "Valid & Terdaftar Resmi"
    },
    {
        "nomor_sertifikat": "S4L-2026-000126",
        "nama_lengkap": "Dewi Lestari",
        "email": "dewi.lestari@gmail.com",
        "kursus_id": 7,
        "kursus_judul": "Literasi Keuangan Dasar & Perencanaan Anggaran Mandiri",
        "kursus_slug": "literasi-keuangan-dasar",
        "kategori_nama": "Literasi Keuangan",
        "tanggal_terbit": "2026-11-05",
        "nilai_kuis": 90,
        "kode_verifikasi": "d4e5f6a1b2c37890abcdef1234567890abcdef1234567890abcdef1234567893",
        "penandatangan_nama": "Dr. Ir. Hendra Gunawan, M.T.",
        "penandatangan_jabatan": "Direktur Pembina Skill4Life",
        "status": "Valid & Terdaftar Resmi"
    }
]
with open(os.path.join(data_dir, "sertifikat.json"), "w", encoding="utf-8") as f:
    json.dump(sertifikat, f, indent=2, ensure_ascii=False)

# 6. pengguna.json (demo data for dashboard & admin)
pengguna = {
    "peserta_aktif": {
        "id": 2,
        "nama_lengkap": "Budi Santoso",
        "email": "budi@gmail.com",
        "nomor_telepon": "085712345678",
        "pekerjaan": "Pencari Kerja & Admin Pemula",
        "bergabung": "2026-10-12",
        "foto_profil": "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&auto=format&fit=crop&q=80",
        "kursus_diikuti": [
            {
                "kursus_id": 5,
                "kursus_slug": "menulis-cv-surat-lamaran-ats",
                "judul": "Menulis CV & Surat Lamaran Kerja ATS Friendly",
                "kategori": "Kesiapan Karir & Kerja",
                "tingkat_kesulitan": "Pemula",
                "estimasi_waktu": "2.5 Jam",
                "progress_persen": 100,
                "modul_selesai": 4,
                "total_modul": 4,
                "lulus_kuis": True,
                "nilai_kuis": 90,
                "nomor_sertifikat": "S4L-2026-000123"
            },
            {
                "kursus_id": 1,
                "kursus_slug": "microsoft-excel-dasar",
                "judul": "Microsoft Excel Dasar: Olah Data & Rumus Esensial",
                "kategori": "Aplikasi Perkantoran",
                "tingkat_kesulitan": "Pemula",
                "estimasi_waktu": "2.5 Jam",
                "progress_persen": 50,
                "modul_selesai": 2,
                "total_modul": 4,
                "lulus_kuis": False,
                "nilai_kuis": None,
                "nomor_sertifikat": None
            },
            {
                "kursus_id": 6,
                "kursus_slug": "persiapan-wawancara-kerja",
                "judul": "Persiapan Wawancara Kerja & Komunikasi Profesional",
                "kategori": "Kesiapan Karir & Kerja",
                "tingkat_kesulitan": "Menengah",
                "estimasi_waktu": "2.5 Jam",
                "progress_persen": 25,
                "modul_selesai": 1,
                "total_modul": 4,
                "lulus_kuis": False,
                "nilai_kuis": None,
                "nomor_sertifikat": None
            }
        ]
    },
    "daftar_peserta": [
        {"id": 2, "nama": "Budi Santoso", "email": "budi@gmail.com", "pekerjaan": "Pencari Kerja", "kota": "Surabaya", "kursus_selesai": 1, "sertifikat": 1, "status": "Aktif", "tgl_daftar": "2026-10-12"},
        {"id": 3, "nama": "Siti Rahmawati", "email": "siti@gmail.com", "pekerjaan": "Pelaku UMKM Kuliner", "kota": "Yogyakarta", "kursus_selesai": 1, "sertifikat": 1, "status": "Aktif", "tgl_daftar": "2026-10-15"},
        {"id": 4, "nama": "Ahmad Fauzi", "email": "ahmad.fauzi@gmail.com", "pekerjaan": "Lulusan SMK", "kota": "Bandung", "kursus_selesai": 1, "sertifikat": 1, "status": "Aktif", "tgl_daftar": "2026-10-18"},
        {"id": 5, "nama": "Dewi Lestari", "email": "dewi.lestari@gmail.com", "pekerjaan": "Ibu Rumah Tangga", "kota": "Semarang", "kursus_selesai": 1, "sertifikat": 1, "status": "Aktif", "tgl_daftar": "2026-10-20"},
        {"id": 6, "nama": "Rizky Pratama", "email": "rizky.p@gmail.com", "pekerjaan": "Mahasiswa", "kota": "Jakarta", "kursus_selesai": 2, "sertifikat": 2, "status": "Aktif", "tgl_daftar": "2026-10-25"},
        {"id": 7, "nama": "Nurul Hidayah", "email": "nurul.h@gmail.com", "pekerjaan": "Pekerja Lepas", "kota": "Malang", "kursus_selesai": 0, "sertifikat": 0, "status": "Aktif", "tgl_daftar": "2026-11-01"},
        {"id": 8, "nama": "Bayu Saputra", "email": "bayu.s@gmail.com", "pekerjaan": "Staff Toko", "kota": "Medan", "kursus_selesai": 1, "sertifikat": 1, "status": "Aktif", "tgl_daftar": "2026-11-03"},
        {"id": 9, "nama": "Intan Permata", "email": "intan.p@gmail.com", "pekerjaan": "Pencari Kerja", "kota": "Makassar", "kursus_selesai": 1, "sertifikat": 1, "status": "Aktif", "tgl_daftar": "2026-11-08"}
    ],
    "admin_demo": {
        "nama": "Administrator Skill4Life",
        "email": "admin@skill4life.id",
        "peran": "Super Admin SDG 1 Initiative"
    }
}
with open(os.path.join(data_dir, "pengguna.json"), "w", encoding="utf-8") as f:
    json.dump(pengguna, f, indent=2, ensure_ascii=False)

print("JSON files 1-6 generated successfully.")
