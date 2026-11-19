# -*- coding: utf-8 -*-
import os

courses_data = [
    {
        "id": 1,
        "title": "Microsoft Excel Dasar",
        "modules": [
            {
                "title": "Pengenalan Antarmuka Excel & Navigasi Lembar Kerja",
                "duration": 20,
                "video": "https://www.youtube.com/embed/RDX3AUhZ30s",
                "content": """<h3>Mengenal Jendela Kerja Microsoft Excel</h3>
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
</div>"""
            },
            {
                "title": "Input Data, Tipe Data & Format Sel (Number, Currency, Date)",
                "duration": 25,
                "video": "https://www.youtube.com/embed/k1VUZEVuDJ8",
                "content": """<h3>Tipe Data dalam Excel & Pemformatan yang Tepat</h3>
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
<p>Pastikan pengaturan regional di komputer Anda sesuai. Format tanggal Indonesia umumnya adalah <code>DD/MM/YYYY</code> (Hari/Bulan/Tahun). Jika ingin menampilkan tanggal lengkap seperti <em>17 Agustus 2026</em>, klik kanan sel &gt; <strong>Format Cells &gt; Date &gt; Pilih format tanggal panjang</strong>.</p>"""
            },
            {
                "title": "Rumus Aritmatika & Fungsi Statistik Esensial (SUM, AVERAGE, MIN, MAX, COUNT)",
                "duration": 30,
                "video": "https://www.youtube.com/embed/8L1OVkw2ZQ8",
                "content": """<h3>Menguasai Rumus Matematika dan Fungsi Dasar Excel</h3>
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
</div>"""
            },
            {
                "title": "Membuat Tabel Rapi, Freeze Panes & Grafik Visual",
                "duration": 25,
                "video": "https://www.youtube.com/embed/rwbho0CgEAE",
                "content": """<h3>Menata Data Profesional dengan Tabel dan Grafik</h3>
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
</ol>"""
            }
        ]
    },
    {
        "id": 2,
        "title": "Microsoft Excel Lanjutan",
        "modules": [
            {
                "title": "Fungsi Logika: IF Tunggal, IF Bersarang (Nested IF) & IFS",
                "duration": 25,
                "video": "https://www.youtube.com/embed/eI_72-zJ1eA",
                "content": """<h3>Otomasi Keputusan dengan Fungsi Logika IF di Excel</h3>
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
</div>"""
            },
            {
                "title": "Relasi Data Cepat dengan VLOOKUP & XLOOKUP",
                "duration": 35,
                "video": "https://www.youtube.com/embed/d3BYV4SmV94",
                "content": """<h3>Mencari Data Antar Tabel dengan VLOOKUP dan XLOOKUP</h3>
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
<p>Kelebihan XLOOKUP: bisa mencari ke kiri maupun ke kanan, tidak memerlukan penghitungan nomor kolom manual, dan menyediakan opsi pesan bawaan jika data tidak ditemukan (misal: <code>"Barang Tidak Terdaftar"</code>).</p>"""
            },
            {
                "title": "Meringkas Ribuan Data Seketika dengan Pivot Table",
                "duration": 30,
                "video": "https://www.youtube.com/embed/m0wI61ahfLc",
                "content": """<h3>Analisis Data Tanpa Rumus Menggunakan Pivot Table</h3>
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
</div>"""
            },
            {
                "title": "Pembersihan Data (Data Cleansing) & Validasi Input",
                "duration": 25,
                "video": "https://www.youtube.com/embed/jZ_v_6p9oJg",
                "content": """<h3>Menjaga Akurasi Data Perusahaan</h3>
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
</ol>"""
            }
        ]
    },
    {
        "id": 3,
        "title": "Microsoft Word untuk Surat & Dokumen Resmi",
        "modules": [
            {
                "title": "Standar Dokumen Formal, Margin, Kop Surat & Font Resmi",
                "duration": 20,
                "video": "https://www.youtube.com/embed/S-nHYzK-BVg",
                "content": """<h3>Mengenal Format Standar Dokumen Administrasi Perkantoran</h3>
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
<p>Gunakan fitur <em>Insert &gt; Header</em>. Trik profesional: masukkan tabel 2 kolom tanpa garis (No Border) di dalam Header. Kolom kiri untuk logo organisasi, dan kolom kanan untuk nama instansi, alamat lengkap, kontak telepon, dan email resmi. Tambahkan garis batas bawah kop surat dengan fitur <em>Borders and Shading</em>.</p>"""
            },
            {
                "title": "Tata Letak Paragraf, Tab Stop & Penomoran Otomatis",
                "duration": 25,
                "video": "https://www.youtube.com/embed/O7K3K1qK0Uo",
                "content": """<h3>Membuat Dokumen Rapi Tanpa Menekan Tombol Spasi Berkali-kali</h3>
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
<p>Untuk menyusun laporan atau proposal yang memiliki bab dan sub-bab (contoh: 1.1, 1.2, 1.2.1), gunakan fitur <strong>Multilevel List</strong> di tab Home. Jangan pernah mengetik nomor bab secara manual agar urutan nomor tidak rusak saat ada pasal atau bab baru yang ditambahkan di tengah.</p>"""
            },
            {
                "title": "Penomoran Halaman Berbeda (Page Numbering & Section Breaks)",
                "duration": 30,
                "video": "https://www.youtube.com/embed/n4_wO0BqCqo",
                "content": """<h3>Kunci Menulis Laporan Resmi & Skripsi: Section Breaks</h3>
<p>Sering kali dalam dokumen formal, halaman Cover tidak boleh memiliki nomor halaman, halaman Kata Pengantar dan Daftar Isi memakai angka romawi kecil (i, ii, iii), sedangkan Bab Isi memakai angka latin (1, 2, 3). Kuncinya adalah menggunakan <strong>Section Break</strong>.</p>

<h4>Langkah-Langkah Mengatur Penomoran Halaman Berbeda:</h4>
<ol>
  <li><strong>Bagi Dokumen Menjadi Bagian Terpisah:</strong> Letakkan kursor di akhir halaman kata pengantar. Buka tab <strong>Layout &gt; Breaks &gt; Next Page</strong>. Ini akan membagi dokumen menjadi Section 1 dan Section 2.</li>
  <li><strong>Putus Tautan Antar Section (Unlink):</strong> Klik dua kali pada bagian Footer di Section 2. Di menu Ribbon Header &amp; Footer, matikan tombol <strong>Link to Previous</strong>. Langkah ini penting agar pengaturan footer di Section 2 tidak meniru Section 1!</li>
  <li><strong>Atur Format Angka:</strong> Klik <em>Page Number &gt; Format Page Numbers</em>. Pilih format angka latin <code>1, 2, 3</code> dan tentukan <strong>Start at: 1</strong>.</li>
</ol>

<div class="alert-box alert-success">
  Dengan trik ini, Anda bisa mengontrol nomor halaman pada dokumen setebal apa pun secara profesional tanpa perlu memecah file Word menjadi beberapa dokumen terpisah.
</div>"""
            },
            {
                "title": "Mail Merge Otomatis & Ekspor PDF Berkualitas Tinggi",
                "duration": 25,
                "video": "https://www.youtube.com/embed/fWzY_L7J4Qc",
                "content": """<h3>Mengirim Ratusan Surat Sekali Klik dengan Mail Merge</h3>
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
<p>Sebelum mengirim dokumen ke atasan atau klien via WhatsApp/Email, selalu konversi ke format PDF agar tata letak tidak bergeser di perangkat penerima. Caranya: <strong>File &gt; Save As &gt; PDF (*.pdf)</strong> atau gunakan menu <strong>Export &gt; Create PDF/XPS</strong>.</p>"""
            }
        ]
    },
    {
        "id": 4,
        "title": "Microsoft PowerPoint untuk Presentasi Efektif",
        "modules": [
            {
                "title": "Prinsip Desain Slide Modern: Less is More & Hierarki Visual",
                "duration": 20,
                "video": "https://www.youtube.com/embed/lwpeqflhyEE",
                "content": """<h3>Prinsip Desain Slide yang Disukai Audiens dan Profesional</h3>
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
</div>"""
            },
            {
                "title": "Mengubah Paragraf Membosankan Menjadi Visual & SmartArt",
                "duration": 25,
                "video": "https://www.youtube.com/embed/Q43eJg3iXis",
                "content": """<h3>Visual Storytelling: Ganti Teks dengan Infografis</h3>
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
<p>Ikon mempercepat pemahaman audiens. Buka menu <strong>Insert &gt; Icons</strong>. Cari kata kunci seperti "target", "waktu", "uang", "pertumbuhan". Ikon di PowerPoint berbasis vektor, sehingga warnanya bisa diganti sesuai tema dan ukurannya tidak akan pecah saat diperbesar.</p>"""
            },
            {
                "title": "Animasi Halus & Transisi Efektif (Morph Transition)",
                "duration": 25,
                "video": "https://www.youtube.com/embed/xLzYhM9J81Q",
                "content": """<h3>Kapan dan Bagaimana Menggunakan Efek Animasi</h3>
<p>Efek animasi yang berlebihan (tulisan berputar-putar, suara tepuk tangan otomatis) akan menurunkan derajat profesionalisme presentasi Anda dan mengalihkan perhatian audiens. Gunakan animasi hanya untuk mengendalikan alur perhatian.</p>

<h4>Prinsip Penggunaan Animasi:</h4>
<ul>
  <li>Gunakan animasi <strong>Fade</strong> atau <strong>Wipe</strong> sederhana untuk memunculkan poin satu per satu saat Anda menjelaskannya, agar audiens tidak membaca slide lebih cepat daripada apa yang sedang Anda ucapkan.</li>
  <li>Atur durasi animasi yang singkat (0.3 sampai 0.5 detik). Animasi yang lambat membuat audiens merasa bosan menunggu.</li>
</ul>

<h4>Keajaiban Efek Transisi MORPH</h4>
<p>Di PowerPoint versi terbaru, fitur transisi <strong>Morph</strong> memungkinkan objek bergerak secara mulus dari satu posisi ke posisi lain antar dua slide berturut-turut. Ini memberi kesan presentasi Anda tampak seperti video animasi profesional buatan desainer grafis handal.</p>"""
            },
            {
                "title": "Persiapan Teknis & Menghadapi Sesi Tanya Jawab (Q&A)",
                "duration": 20,
                "video": "https://www.youtube.com/embed/bX_9kP9k9Xw",
                "content": """<h3>Etika & Kesiapan Mental Presenter Profesional</h3>
<p>Bahkan slide terindah sekalipun tidak akan berdampak tanpa persiapan eksekusi yang matang di hari H.</p>

<h4>1. Menggunakan Fitur Presenter View</h4>
<p>Saat laptop Anda tersambung ke proyektor atau TV display, aktifkan mode <strong>Presenter View</strong> (tekan <code>Alt + F5</code>). Di layar Anda akan tampil catatan contekan poin bicara, timer waktu berjalan, dan preview slide berikutnya, sementara audiens hanya melihat slide utama Anda secara bersih.</p>

<h4>2. Menjawab Pertanyaan Sulit dengan Anggun:</h4>
<ul>
  <li>Dengarkan pertanyaan sampai selesai tanpa memotong kalimat penanya.</li>
  <li>Ulangi inti pertanyaan secara ringkas untuk memastikan Anda dan seluruh hadirin memahami konteksnya sama.</li>
  <li>Jika Anda belum mengetahui data persisnya, jangan berbohong atau mengarang! Katakan dengan jujur dan tawarkan tindak lanjut: <em>"Pertanyaan yang sangat tajam. Saya tidak memegang angka rincian untuk kuartal tersebut saat ini, namun saya akan mencatat kontak Bapak/Ibu dan mengirimkan laporannya sore ini."</em></li>
</ul>"""
            }
        ]
    },
    {
        "id": 5,
        "title": "Menulis CV & Surat Lamaran Kerja ATS Friendly",
        "modules": [
            {
                "title": "Mengenal Sistem ATS (Applicant Tracking System) & Format Resume Standar",
                "duration": 25,
                "video": "https://www.youtube.com/embed/2_x90K0K001",
                "content": """<h3>Bagaimana Robot ATS Menyaring Lamaran Anda</h3>
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
</ol>"""
            },
            {
                "title": "Merumuskan Pengalaman Kerja Berbasis Dampak (Formula XYZ Google)",
                "duration": 30,
                "video": "https://www.youtube.com/embed/3_x90K0K002",
                "content": """<h3>Tinggalkan Deskripsi Tugas Membosankan, Tampilkan Prestasi Nyata!</h3>
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
<p>Awali setiap poin pengalaman dengan kata kerja aktif: <em>Mengembangkan, Mengoptimalkan, Menginisiasi, Mengkoordinasikan, Memangkas biaya, Memimpin, Merancang.</em></p>"""
            },
            {
                "title": "Menulis Surat Lamaran (Cover Letter) yang Menggugah HRD",
                "duration": 25,
                "video": "https://www.youtube.com/embed/4_x90K0K003",
                "content": """<h3>Surat Lamaran Bukan Salinan CV, Tapi Cerita Motivasi Anda</h3>
<p>Surat lamaran kerja (Cover Letter) adalah kesempatan Anda menunjukkan kepribadian, antusiasme terhadap perusahaan yang dilamar, dan alasan mengapa latar belakang Anda adalah solusi untuk kebutuhan posisi tersebut.</p>

<h4>Struktur Surat Lamaran 3 Paragraf yang Terbukti Efektif:</h4>
<ol>
  <li><strong>Paragraf Pembuka:</strong> Sebutkan secara spesifik posisi yang dilamar, dari mana Anda mengetahui lowongan tersebut, dan satu kalimat hook tentang keahlian utama Anda yang paling relevan. Hindari pembuka kuno seperti <em>"Melalui surat ini saya yang bertanda tangan di bawah ini..."</em>.</li>
  <li><strong>Paragraf Isi (Koneksi Masalah &amp; Solusi):</strong> Tunjukkan bahwa Anda telah meriset perusahaan tersebut. Jelaskan satu atau dua pencapaian terbesar Anda di masa lalu dan bagaimana keahlian itu langsung bisa diterapkan untuk menyelesaikan tantangan pekerjaan di sana.</li>
  <li><strong>Paragraf Penutup (Call to Action):</strong> Nyatakan kesiapan Anda untuk berdiskusi lebih mendalam dalam sesi wawancara, sampaikan apresiasi atas waktu rekruter, dan cantumkan kontak aktif Anda secara sopan.</li>
</ol>

<div class="alert-box alert-warning">
  <strong>Peringatan Penting:</strong> Jangan pernah mengirim satu surat lamaran yang sama untuk 10 perusahaan berbeda tanpa mengubah nama perusahaan dan kebutuhan posisi. HRD yang berpengalaman dapat mencium surat lamaran 'copy-paste' dalam 5 detik pertama!
</div>"""
            },
            {
                "title": "Optimasi Portofolio Digital & Checklist Final Sebelum Mengirim",
                "duration": 20,
                "video": "https://www.youtube.com/embed/5_x90K0K004",
                "content": """<h3>Bukti Nyata Karya: Bangun Portofolio Sederhana tapi Meyakinkan</h3>
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
</ul>"""
            }
        ]
    },
    {
        "id": 6,
        "title": "Persiapan Wawancara Kerja & Komunikasi Profesional",
        "modules": [
            {
                "title": "Bedah Pertanyaan Pembuka: 'Ceritakan Tentang Diri Anda'",
                "duration": 25,
                "video": "https://www.youtube.com/embed/6_x90K0K005",
                "content": """<h3>Mengawali Wawancara dengan Percaya Diri dan Memikat</h3>
<p>Hampir 95% sesi wawancara kerja selalu diawali dengan pertanyaan: <em>"Silakan perkenalkan diri Anda"</em> atau <em>"Ceritakan tentang diri Anda"</em>. Ini bukan berarti pewawancara ingin mendengar riwayat masa kecil atau hobi pribadi Anda yang tidak ada hubungannya dengan pekerjaan.</p>

<h4>Gunakan Rumus Waktu: Masa Lalu - Masa Kini - Masa Depan (Past - Present - Future)</h4>
<ol>
  <li><strong>Masa Kini (Present - 40% durasi):</strong> Mulai dengan posisi Anda saat ini, keahlian utama yang Anda miliki, dan satu pencapaian terkini. <em>"Saat ini saya aktif memperdalam keterampilan administrasi data dan pengolahan spreadsheet di Skill4Life, di mana saya terbiasa mengolah database ratusan baris secara teratur..."</em></li>
  <li><strong>Masa Lalu (Past - 30% durasi):</strong> Latar belakang pendidikan atau pengalaman relevan sebelumnya yang membentuk keahlian kerja Anda saat ini.</li>
  <li><strong>Masa Depan (Future - 30% durasi):</strong> Alasan mengapa posisi di perusahaan ini adalah langkah karir berikutnya yang sangat tepat untuk Anda dan bagaimana Anda bisa berkontribusi.</li>
</ol>

<div class="alert-box alert-info">
  <strong>Durasi Ideal:</strong> Jaga jawaban perkenalan Anda antara <strong>1.5 hingga 2 menit</strong>. Jangan terlalu singkat (di bawah 30 detik) dan jangan terlalu bertele-tele hingga membosankan pewawancara.
</div>"""
            },
            {
                "title": "Menjawab Pertanyaan Behavioral dengan Metode STAR",
                "duration": 30,
                "video": "https://www.youtube.com/embed/7_x90K0K006",
                "content": """<h3>Rahasia Menjawab Pertanyaan Studi Kasus Perilaku HRD</h3>
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
</div>"""
            },
            {
                "title": "Bahasa Tubuh, Etika Interview Daring/Luring & Kontak Mata",
                "duration": 20,
                "video": "https://www.youtube.com/embed/8_x90K0K007",
                "content": """<h3>Kesan Pertama (First Impression) Terbentuk dalam 7 Detik Pertama</h3>
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
</ul>"""
            },
            {
                "title": "Pertanyaan Balik untuk HRD, Negosiasi Gaji & Email Ucapan Terima Kasih",
                "duration": 25,
                "video": "https://www.youtube.com/embed/9_x90K0K008",
                "content": """<h3>Menutup Sesi Wawancara dengan Kesan Luar Biasa</h3>
<p>Di akhir wawancara, pewawancara hampir selalu bertanya: <em>"Apakah ada pertanyaan yang ingin Anda tanyakan kepada kami?"</em>. Jika Anda menjawab <em>"Tidak ada, sudah cukup jelas"</em>, Anda melewatkan kesempatan emas untuk menunjukkan bahwa Anda orang yang bersemangat dan kritis!</p>

<h4>3 Pertanyaan Berbobot untuk Anda Tanyakan ke HRD:</h4>
<ol>
  <li><em>"Bagi kandidat yang berhasil menempati posisi ini, apa tolok ukur kesuksesan utama dalam 3 bulan pertama masa kerja?"</em></li>
  <li><em>"Bagaimana budaya kerja di tim ini dalam menghadapi tantangan baru atau perubahan prioritas kerja?"</em></li>
  <li><em>"Apa yang paling Bapak/Ibu sukai dari pengalaman bekerja di perusahaan ini?"</em></li>
</ol>

<h4>Kirim Email Ucapan Terima Kasih (Thank You Note)</h4>
<p>Kirimkan email singkat dalam kurun waktu maksimal 24 jam setelah sesi interview. Ucapkan terima kasih atas waktu mereka, sebutkan secara singkat satu poin menarik yang sempat dibahas saat wawancara, dan tegaskan kembali antusiasme Anda untuk bergabung. Tindakan sederhana ini membedakan Anda dari 90% pelamar lainnya.</p>"""
            }
        ]
    },
    {
        "id": 7,
        "title": "Literasi Keuangan Dasar & Perencanaan Anggaran",
        "modules": [
            {
                "title": "Pola Pikir Keuangan & Alokasi Anggaran Sederhana (Formula 50/30/20)",
                "duration": 20,
                "video": "https://www.youtube.com/embed/1_fin_001",
                "content": """<h3>Mengubah Hubungan Anda dengan Uang</h3>
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
</div>"""
            },
            {
                "title": "Membangun Dana Darurat dari Nol & Catatan Kas Harian",
                "duration": 25,
                "video": "https://www.youtube.com/embed/2_fin_002",
                "content": """<h3>Penyelamat dari Badai Kehidupan: Dana Darurat</h3>
<p>Banyak keluarga yang tadinya berkecukupan tiba-tiba jatuh miskin hanya karena satu musibah: anggota keluarga sakit keras, motor satu-satunya untuk ngojek mogok, atau pemutusan hubungan kerja (PHK) mendadak. Tanpa dana darurat, satu-satunya jalan keluar yang diambil sering kali adalah berhutang dengan bunga tinggi.</p>

<h4>Berapa Jumlah Dana Darurat yang Ideal?</h4>
<ul>
  <li>Lajang / Belum Berkeluarga: Minimal <strong>3 kali pengeluaran bulanan</strong>.</li>
  <li>Sudah Menikah: Minimal <strong>6 kali pengeluaran bulanan</strong>.</li>
  <li>Pekerja Lepas / Wirausaha: Minimal <strong>9 - 12 kali pengeluaran bulanan</strong> karena penghasilan tidak tentu.</li>
</ul>

<h4>Cara Mulai Mencatat Kas Tanpa Ribet:</h4>
<p>Gunakan aplikasi gratis di HP atau buku tulis saku. Catat setiap pengeluaran sekecil apa pun (termasuk uang parkir Rp 2.000 atau air mineral). Di akhir minggu, evaluasi: Anda akan terkejut melihat betapa banyak uang yang bocor halus pada pengeluaran-pengeluaran kecil yang sebenarnya tidak penting!</p>"""
            },
            {
                "title": "Mengenali Jebakan Pinjol Ilegal & Menghindari Jerat Hutang Konsumtif",
                "duration": 25,
                "video": "https://www.youtube.com/embed/3_fin_003",
                "content": """<h3>Waspada Predator Finansial yang Menghancurkan Masa Depan</h3>
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
</div>"""
            }
        ]
    },
    {
        "id": 8,
        "title": "Memulai Usaha Kecil Modal Minim",
        "modules": [
            {
                "title": "Validasi Ide Bisnis dari Masalah Nyata di Sekitar",
                "duration": 25,
                "video": "https://www.youtube.com/embed/1_biz_001",
                "content": """<h3>Bisnis yang Sukses Berawal dari Solusi Masalah Nyata</h3>
<p>Banyak pemula gagal karena membuat produk yang mereka sukai sendiri, tanpa pernah mengecek apakah ada orang yang mau membayar produk tersebut. Bisnis adalah pertukaran nilai: Anda menyelesaikan masalah orang lain, dan orang lain dengan senang hati membayar Anda.</p>

<h4>Cara Menemukan Ide Usaha Bermodal Minim:</h4>
<ol>
  <li><strong>Amati Keluhan di Lingkungan Anda:</strong> Apakah tetangga Anda kesulitan mencari sarapan bergizi yang bersih dan cepat di pagi hari? Apakah banyak kantor sekitar yang butuh jasa laundry kilat atau snack sore?</li>
  <li><strong>Kombinasikan dengan Keterampilan yang Anda Miliki:</strong> Jika Anda pandai memasak, merapikan dokumen, mencuci motor, atau merawat tanaman, jadikan itu sebagai modal awal jasa atau produk Anda.</li>
  <li><strong>Mulai dengan Model Pre-Order (PO):</strong> Jangan menyewa toko mahal atau memproduksi barang dalam jumlah ratusan unit di awal. Tawarkan sistem pesan terlebih dahulu (PO) ke lingkaran teman dan keluarga. Gunakan uang muka (DP) pelanggan untuk membeli bahan baku. Dengan cara ini, Anda tidak menanggung risiko barang sisa atau modal macet!</li>
</ol>"""
            },
            {
                "title": "Menghitung HPP (Harga Pokok Penjualan) & Menentukan Untung",
                "duration": 30,
                "video": "https://www.youtube.com/embed/2_biz_002",
                "content": """<h3>Jangan Sampai Terlihat Ramai Tapi Sebenarnya Boncos/Rugi!</h3>
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

<p>Contoh: Total belanja bahan dan operasional untuk 50 porsi makanan adalah Rp 250.000. Maka HPP per porsi = Rp 5.000. Jika Anda ingin keuntungan bersih 40% (Rp 2.000), maka jual dengan harga Rp 7.000 per porsi.</p>"""
            },
            {
                "title": "Promosi Gratis & Efektif dengan WhatsApp Business",
                "duration": 25,
                "video": "https://www.youtube.com/embed/3_biz_003",
                "content": """<h3>Maksimalkan WhatsApp di HP Anda Menjadi Toko Otomatis</h3>
<p>Hampir seluruh masyarakat Indonesia menggunakan aplikasi WhatsApp setiap hari. Daripada sekadar memakai WhatsApp pribadi biasa, beralihlah ke <strong>WhatsApp Business</strong> yang 100% gratis di Google Play Store.</p>

<h4>Fitur Sakti WhatsApp Business untuk UMKM:</h4>
<ol>
  <li><strong>Profil Bisnis Profesional:</strong> Pasang foto profil logo/produk yang jelas, jam operasional buka-tutup toko, alamat lokasi, dan email resmi.</li>
  <li><strong>Fitur Katalog Produk:</strong> Anda bisa mengunggah foto produk lengkap dengan judul, deskripsi bahan/ukuran, dan harga. Pelanggan bisa melihat menu atau produk Anda kapan saja tanpa perlu Anda ketik berulang-ulang!</li>
  <li><strong>Pesan Otomatis (Greeting &amp; Away Message):</strong> Balas sapaan pelanggan baru secara instan dalam hitungan detik meski Anda sedang sibuk di dapur.</li>
  <li><strong>Label Obrolan (Chat Labels):</strong> Kelompokkan kontak pelanggan dengan warna berbeda: <em>Pesanan Baru, Menunggu Pembayaran, Sudah Lunas, Siap Dikirim</em>. Pengelolaan pesanan Anda menjadi sangat rapi!</li>
</ol>"""
            },
            {
                "title": "Teknik Foto Produk Menarik dengan Kamera HP & Pencahayaan Alami",
                "duration": 20,
                "video": "https://www.youtube.com/embed/4_biz_004",
                "content": """<h3>Foto yang Menggugah Selera Menjual Lebih Cepat</h3>
<p>Di dunia online, pembeli membeli dengan mata sebelum membeli dengan lidah atau logika. Anda tidak membutuhkan kamera DSLR mahal seharga puluhan juta untuk menghasilkan foto produk yang memikat.</p>

<h4>Tips Fotografi Produk Hanya dengan HP Sederhana:</h4>
<ul>
  <li><strong>Manfaatkan Cahaya Alami Matahari (Window Light):</strong> Foto produk di samping jendela rumah pada jam 8-10 pagi atau 3-4 sore. Cahaya matahari pagi memberikan pencahayaan yang lembut, alami, dan tidak menghasilkan bayangan kasar. Hindari menggunakan lampu flash bawaan HP yang membuat foto tampak pucat dan berminyak.</li>
  <li><strong>Gunakan Background Bersih:</strong> Gunakan kertas karton putih polos seharga Rp 3.000 atau papan kayu bersih sebagai alas foto. Latar belakang yang bersih membuat produk Anda menjadi bintang utama.</li>
  <li><strong>Bersihkan Lensa Kamera:</strong> Sebelum memotret, selalu lap lensa kamera ponsel Anda dengan kain kaos lembut atau tisu kacamata. Sidik jari atau minyak di lensa adalah penyebab nomor satu foto terlihat buram dan berkabut!</li>
</ul>"""
            }
        ]
    }
]

# Quiz Questions for all 8 courses (10 questions each = 80 questions total!)
quizzes_data = {
    1: [ # Microsoft Excel Dasar
        {
            "q": "Setiap penulisan rumus atau formula di dalam Microsoft Excel wajib diawali dengan karakter...",
            "a": "Tanda tambah (+)", "b": "Tanda sama dengan (=)", "c": "Tanda bintang (*)", "d": "Tanda seru (!)",
            "key": "B", "desc": "Semua rumus atau fungsi di Excel wajib diawali tanda sama dengan (=) agar Excel mengeksekusinya sebagai perhitungan matematika."
        },
        {
            "q": "Pertemuan antara kolom C dan baris nomor 8 di lembar kerja Excel dinamakan...",
            "a": "Range C8", "b": "Baris C8", "c": "Sel C8", "d": "Header C8",
            "key": "C", "desc": "Pertemuan antara sebuah kolom dan baris disebut Sel (Cell), ditulis dengan huruf kolom diikuti nomor baris, contohnya Sel C8."
        },
        {
            "q": "Fungsi yang digunakan untuk menjumlahkan seluruh angka dalam rentang sel tertentu adalah...",
            "a": "AVERAGE", "b": "SUM", "c": "COUNT", "d": "MAX",
            "key": "B", "desc": "Fungsi SUM digunakan untuk menghitung total penjumlahan dari sekumpulan sel angka."
        },
        {
            "q": "Untuk menghitung nilai rata-rata dari sekumpulan data angka, fungsi yang tepat adalah...",
            "a": "AVERAGE", "b": "MEDIAN", "c": "SUM", "d": "COUNT",
            "key": "A", "desc": "Fungsi AVERAGE digunakan untuk mencari nilai rata-rata aritmatika dari rentang data yang dipilih."
        },
        {
            "q": "Apa perbedaan mendasar antara fungsi COUNT dan COUNTA?",
            "a": "COUNT menghitung sel teks, COUNTA menghitung sel angka",
            "b": "COUNT hanya menghitung sel yang berisi angka, sedangkan COUNTA menghitung sel yang terisi data apa saja (teks maupun angka)",
            "c": "COUNT digunakan untuk pengurangan, COUNTA untuk penambahan",
            "d": "Tidak ada perbedaan, keduanya menghasilkan nilai yang sama persis",
            "key": "B", "desc": "COUNT khusus menghitung sel berisi nilai numerik/angka, sedangkan COUNTA menghitung semua sel yang tidak kosong (non-empty)."
        },
        {
            "q": "Kombinasi tombol keyboard (shortcut) untuk menyimpan dokumen Excel dengan cepat adalah...",
            "a": "Ctrl + C", "b": "Ctrl + P", "c": "Ctrl + S", "d": "Ctrl + Z",
            "key": "C", "desc": "Ctrl + S adalah shortcut standar di Windows untuk menyimpan file (Save)."
        },
        {
            "q": "Bagaimana cara yang benar untuk memformat angka 50000 agar memiliki lambang mata uang Rp di Excel?",
            "a": "Ketik manual 'Rp 50.000' pada sel",
            "b": "Ketik angka 50000 lalu ubah format sel melalui menu Number Format menjadi Currency/Accounting",
            "c": "Menggunakan rumus =RP(50000)",
            "d": "Menambahkan spasi di depan angka 50000",
            "key": "B", "desc": "Ketik angka murni tanpa teks, kemudian terapkan format sel Currency/Accounting agar nilai tetap dapat dihitung dengan rumus."
        },
        {
            "q": "Fitur yang digunakan untuk mengunci baris judul paling atas agar tetap terlihat saat lembar kerja di-scroll ke bawah adalah...",
            "a": "Merge Cells", "b": "Wrap Text", "c": "Freeze Panes (Freeze Top Row)", "d": "Split Cells",
            "key": "C", "desc": "Freeze Panes (khususnya Freeze Top Row) berguna mengunci baris judul agar tetap tampil saat navigasi data yang panjang."
        },
        {
            "q": "Fungsi yang digunakan untuk mencari nilai tertinggi dalam suatu rentang data adalah...",
            "a": "MIN", "b": "MAX", "c": "TOP", "d": "HIGH",
            "key": "B", "desc": "Fungsi MAX (Maximum) mengembalikan nilai numerik terbesar dari sekumpulan sel."
        },
        {
            "q": "Jenis grafik yang paling tepat digunakan untuk melihat tren kenaikan atau penurunan data dari bulan ke bulan adalah...",
            "a": "Pie Chart (Diagram Lingkaran)", "b": "Line Chart (Grafik Garis)", "c": "Scatter Plot", "d": "Doughnut Chart",
            "key": "B", "desc": "Line Chart (grafik garis) sangat efektif memperlihatkan pergerakan tren data dari waktu ke waktu (time series)."
        }
    ],
    2: [ # Microsoft Excel Lanjutan
        {
            "q": "Pada penulisan rumus =IF(A1>=70, 'LULUS', 'REMIDIAL'), apa hasil yang keluar jika sel A1 bernilai 82?",
            "a": "REMIDIAL", "b": "LULUS", "c": "#VALUE!", "d": "FALSE",
            "key": "B", "desc": "Karena nilai A1 (82) lebih besar atau sama dengan 70, maka kondisi bernilai TRUE dan menghasilkan teks 'LULUS'."
        },
        {
            "q": "Apa arti huruf 'V' pada nama fungsi VLOOKUP di Microsoft Excel?",
            "a": "Value", "b": "Virtual", "c": "Vertical", "d": "Variable",
            "key": "C", "desc": "VLOOKUP singkatan dari Vertical Lookup, yaitu mencari data secara vertikal dari atas ke bawah pada kolom referensi."
        },
        {
            "q": "Argumen terakhir pada rumus VLOOKUP biasanya diisi dengan angka 0 atau FALSE. Apa fungsi parameter tersebut?",
            "a": "Mencari kecocokan nilai yang mendekati (Approximate match)",
            "b": "Mencari kecocokan nilai yang tepat sama persis (Exact match)",
            "c": "Menyembunyikan pesan kesalahan",
            "d": "Mengurutkan data dari Z ke A",
            "key": "B", "desc": "Nilai FALSE atau 0 menginstruksikan VLOOKUP untuk hanya mengambil data yang benar-benar cocok sama persis (Exact Match)."
        },
        {
            "q": "Simbol apa yang digunakan untuk mengunci alamat sel menjadi referensi absolut (agar tidak bergeser saat dicopy)?",
            "a": "Tanda pagar (#)", "b": "Tanda seru (!)", "c": "Tanda dollar ($)", "d": "Tanda persen (%)",
            "key": "C", "desc": "Tanda dollar ($), misalnya $A$1, mengunci koordinat kolom dan baris sehingga alamat sel bersifat absolut."
        },
        {
            "q": "Fitur Excel yang sangat andal untuk meringkas, mengelompokkan, dan menganalisis puluhan ribu baris data tanpa rumus adalah...",
            "a": "Goal Seek", "b": "Solver", "c": "Pivot Table", "d": "Data Validation",
            "key": "C", "desc": "Pivot Table adalah alat analitik serbaguna untuk membuat rangkuman dan agregasi data secara dinamis tanpa mengetik rumus."
        },
        {
            "q": "Manakah keunggulan utama fungsi modern XLOOKUP dibanding VLOOKUP tradisional?",
            "a": "XLOOKUP hanya bisa bekerja pada teks pendek",
            "b": "XLOOKUP bisa mencari data ke arah kiri maupun kanan, dan tidak terganggu oleh penambahan kolom baru",
            "c": "XLOOKUP membutuhkan koneksi internet",
            "d": "XLOOKUP tidak memerlukan argumen",
            "key": "B", "desc": "XLOOKUP mengatasi keterbatasan VLOOKUP dengan fleksibilitas pencarian dua arah (kiri/kanan) serta penanganan error bawaan."
        },
        {
            "q": "Fungsi teks yang digunakan untuk membuang spasi berlebih yang tidak sengaja terketik di awal atau akhir kata adalah...",
            "a": "CLEAN", "b": "TRIM", "c": "DELETE", "d": "ERASE",
            "key": "B", "desc": "Fungsi TRIM membersihkan spasi ganda dan spasi di ujung awal/akhir string teks."
        },
        {
            "q": "Untuk membatasi input pengguna agar hanya bisa memilih dari daftar pilihan dropdown, fitur yang digunakan adalah...",
            "a": "Data Validation dengan tipe List", "b": "Conditional Formatting", "c": "AutoFilter", "d": "Consolidate",
            "key": "A", "desc": "Data Validation dengan kriteria List membuat dropdown menu yang membatasi input hanya pada item yang disetujui."
        },
        {
            "q": "Fungsi teks untuk mengubah huruf pertama di setiap kata menjadi huruf kapital (contoh: 'budi santoso' menjadi 'Budi Santoso') adalah...",
            "a": "UPPER", "b": "LOWER", "c": "PROPER", "d": "CAPITALIZE",
            "key": "C", "desc": "Fungsi PROPER mengubah huruf awal setiap kata menjadi huruf besar (Title Case)."
        },
        {
            "q": "Komponen visual interaktif yang berfungsi sebagai tombol penyaring cepat pada Pivot Table disebut...",
            "a": "Filter Bar", "b": "Slicer", "c": "Macro Button", "d": "Sparkline",
            "key": "B", "desc": "Slicer menyediakan tombol antarmuka grafis yang ramah pengguna untuk memfilter data Pivot Table dalam satu klik."
        }
    ],
    3: [ # Microsoft Word
        {
            "q": "Ukuran kertas standar internasional yang paling umum digunakan untuk surat dinas dan dokumen perkantoran di Indonesia adalah...",
            "a": "Letter", "b": "Legal", "c": "A4", "d": "A3",
            "key": "C", "desc": "Kertas A4 (210 x 297 mm) adalah ukuran baku untuk surat dinas dan dokumen perkantoran di Indonesia."
        },
        {
            "q": "Kombinasi tombol keyboard untuk mengatur perataan paragraf menjadi Rata Kiri-Kanan (Justify) adalah...",
            "a": "Ctrl + L", "b": "Ctrl + R", "c": "Ctrl + E", "d": "Ctrl + J",
            "key": "D", "desc": "Ctrl + J adalah pintasan untuk perataan teks Justify (rata tepi kiri dan kanan)."
        },
        {
            "q": "Fitur di Microsoft Word yang digunakan untuk membuat ratusan surat atau sertifikat dengan nama berbeda secara otomatis dari data Excel adalah...",
            "a": "AutoText", "b": "Mail Merge", "c": "Macro Recorder", "d": "Track Changes",
            "key": "B", "desc": "Mail Merge menggabungkan dokumen master Word dengan sumber data (misal Excel) untuk surat massal beridentitas unik."
        },
        {
            "q": "Cara terbaik untuk meluruskan tanda titik dua (:) pada biodata surat tanpa membuat teks bergeser adalah...",
            "a": "Menekan tombol Spasi berulang kali sampai lurus",
            "b": "Mengatur Tab Stop pada mistar (Ruler) dan menekan tombol Tab",
            "c": "Mengetik titik dua di baris paling bawah lalu dicopy",
            "d": "Menggunakan font khusus titik dua",
            "key": "B", "desc": "Tab Stop menetapkan koordinat horizontal tetap pada Ruler sehingga penekanan tombol Tab menghasilkan posisi yang selalu sejajar rapi."
        },
        {
            "q": "Fitur yang wajib digunakan untuk membedakan format nomor halaman (misal Romawi i, ii pada cover dan angka 1, 2 pada bab isi) adalah...",
            "a": "Page Break", "b": "Line Break", "c": "Section Break (Next Page)", "d": "Column Break",
            "key": "C", "desc": "Section Break memisahkan aturan tata letak dan penomoran header/footer antar bagian dokumen."
        },
        {
            "q": "Format file dokumen yang paling disarankan saat mengirim surat atau CV via email agar formatnya tidak bergeser di perangkat penerima adalah...",
            "a": ".TXT", "b": ".PDF", "c": ".DOC", "d": ".RTF",
            "key": "B", "desc": "PDF (Portable Document Format) mengunci tata letak, jenis font, dan format visual di semua perangkat dan sistem operasi."
        },
        {
            "q": "Bagian atas dokumen yang biasanya memuat logo instansi, nama perusahaan, dan alamat resmi disebut...",
            "a": "Footer", "b": "Header (Kop Surat)", "c": "Watermark", "d": "Footnote",
            "key": "B", "desc": "Header terletak di margin atas dokumen dan lazim dipakai menempatkan kop surat resmi."
        },
        {
            "q": "Untuk membuat daftar isi otomatis yang dapat diperbarui saat nomor halaman berubah, teks judul bab harus diformat menggunakan...",
            "a": "Bold dan garis bawah", "b": "Heading Styles (Heading 1, Heading 2)", "c": "Font ukuran 20 pt", "d": "Warna teks merah",
            "key": "B", "desc": "Word membaca struktur Heading Styles (Heading 1, Heading 2, dst) untuk merakit Daftar Isi Otomatis (Table of Contents)."
        },
        {
            "q": "Jarak antar baris kalimat dalam sebuah paragraf dokumen perkantoran umumnya diatur menggunakan fitur...",
            "a": "Character Spacing", "b": "Line Spacing (Spasi Baris)", "c": "Letter Width", "d": "Margin Top",
            "key": "B", "desc": "Line Spacing mengatur kerapatan vertikal antar baris teks dalam satu paragraf (misal 1.15 atau 1.5 spasi)."
        },
        {
            "q": "Kombinasi tombol keyboard untuk membatalkan kesalahan tindakan pengetikan terakhir (Undo) adalah...",
            "a": "Ctrl + Y", "b": "Ctrl + U", "c": "Ctrl + Z", "d": "Ctrl + X",
            "key": "C", "desc": "Ctrl + Z adalah perintah Undo universal untuk membatalkan perubahan atau kesalahan ketik sebelumnya."
        }
    ],
    4: [ # Microsoft PowerPoint
        {
            "q": "Apa fungsi utama dari slide presentasi dalam sebuah pemaparan profesional?",
            "a": "Sebagai naskah lengkap yang dibacakan kata demi kata oleh pembicara",
            "b": "Sebagai alat bantu visual ringkas untuk memperkuat dan memperjelas pesan pembicara",
            "c": "Untuk memamerkan sebanyak mungkin efek suara dan animasi bergerak",
            "d": "Untuk menggantikan kehadiran pembicara sepenuhnya",
            "key": "B", "desc": "Slide adalah alat bantu visual (visual aid) untuk mendukung pesan pembicara, bukan naskah membaca yang membosankan."
        },
        {
            "q": "Apa yang dimaksud dengan prinsip 'Whitespace' dalam desain slide presentasi?",
            "a": "Slide harus selalu menggunakan latar belakang warna putih polos",
            "b": "Area kosong di sekitar elemen desain yang memberi kenyamanan mata dan memfokuskan perhatian audiens",
            "c": "Menghapus semua gambar dari slide",
            "d": "Mengubah warna teks menjadi putih",
            "key": "B", "desc": "Whitespace (ruang negatif/kosong) memberi ruang bernapas visual sehingga pesan penting tidak tertelan elemen yang berdesakan."
        },
        {
            "q": "Fitur di PowerPoint yang dapat mengubah daftar poin teks biasa menjadi diagram visual yang terstruktur secara instan adalah...",
            "a": "WordArt", "b": "SmartArt", "c": "ClipArt", "d": "AutoShape",
            "key": "B", "desc": "SmartArt mengonversi poin teks menjadi bagan alur proses, hierarki organisasi, atau matriks visual secara otomatis."
        },
        {
            "q": "Berapa jumlah maksimal warna aksen yang disarankan untuk menjaga konsistensi tema slide profesional?",
            "a": "10 warna pelangi", "b": "1 sampai 2 warna aksen kontras yang harmonis", "c": "Semua warna harus berbeda di tiap slide", "d": "Tidak boleh memakai warna",
            "key": "B", "desc": "Desain profesional membatasi palet warna pada 1-2 warna aksen kontras untuk menjaga konsistensi dan fokus perhatian."
        },
        {
            "q": "Efek transisi modern di PowerPoint yang memindahkan objek secara mulus dan cair antar dua slide berturut-turut disebut...",
            "a": "Push", "b": "Morph", "c": "Dissolve", "d": "Wipe",
            "key": "B", "desc": "Transisi Morph melacak perubahan posisi, ukuran, dan rotasi objek antar dua slide dan membuat animasi perpindahan yang mulus."
        },
        {
            "q": "Fitur tampilan khusus yang memungkinkan presenter melihat contekan catatan dan slide berikutnya di laptop saat layar proyektor menampilkan slide utama adalah...",
            "a": "Slide Sorter View", "b": "Outline View", "c": "Presenter View", "d": "Reading View",
            "key": "C", "desc": "Presenter View menampilkan slide aktif, catatan pembicara, pewaktu (timer), dan preview slide berikutnya di monitor presenter."
        },
        {
            "q": "Berapa ukuran font minimum yang disarankan untuk teks isi penjelasan di slide agar terbaca oleh audiens di baris belakang?",
            "a": "8 pt", "b": "10 pt", "c": "Sekitar 16 - 18 pt", "d": "36 pt",
            "key": "C", "desc": "Ukuran font minimal 16-18 pt untuk body text memastikan keterbacaan yang layak di ruang pertemuan berukuran standar."
        },
        {
            "q": "Kombinasi tombol keyboard untuk memulai penayangan slide presentasi (Slide Show) dari slide paling awal adalah...",
            "a": "F1", "b": "F5", "c": "F7", "d": "F12",
            "key": "B", "desc": "Tombol F5 memulai Slide Show dari slide pertama (atau Shift + F5 dari slide yang sedang aktif)."
        },
        {
            "q": "Kapan sebaiknya animasi objek (Entrance Animation) digunakan dalam presentasi bisnis?",
            "a": "Setiap detik agar audiens tidak mengantuk",
            "b": "Secara selektif untuk memunculkan poin bertahap sesuai alur penjelasan lisan pembicara",
            "c": "Hanya dengan efek suara ledakan atau tepuk tangan",
            "d": "Tidak boleh digunakan sama sekali dalam kondisi apa pun",
            "key": "B", "desc": "Animasi selektif membantu mengendalikan fokus audiens sehingga mereka tidak membaca poin akhir sebelum waktunya dijelaskan."
        },
        {
            "q": "Sikap terbaik presenter saat menghadapi pertanyaan peserta yang belum diketahui jawabannya secara pasti adalah...",
            "a": "Mengarang jawaban meyakinkan agar tidak terlihat tidak tahu",
            "b": "Menyalahkan penanya karena pertanyaannya keluar topik",
            "c": "Mengakui secara jujur dan profesional bahwa data tersebut akan dicek kembali dan dikabari setelah sesi presentasi",
            "d": "Mengabaikan pertanyaan dan menutup presentasi",
            "key": "C", "desc": "Integritas profesional dihargai dengan mengakui batas data saat ini dan menawarkan tindak lanjut (follow-up) konfirmasi."
        }
    ],
    5: [ # Menulis CV & Surat Lamaran Kerja ATS
        {
            "q": "Apa kepanjangan dari sistem ATS yang banyak digunakan perusahaan untuk menyaring berkas pelamar kerja?",
            "a": "Automatic Text Sorter", "b": "Applicant Tracking System", "c": "Application Technical Support", "d": "Advanced Talents System",
            "key": "B", "desc": "ATS adalah singkatan dari Applicant Tracking System, perangkat lunak untuk mengelola proses seleksi dan penyaringan pelamar kerja."
        },
        {
            "q": "Mengapa penggunaan format tabel ganda (multi-column) atau grafik kompleks pada CV sering kali berisiko gagal di ATS?",
            "a": "Karena ukuran file menjadi terlalu kecil",
            "b": "Karena sistem parser ATS sering kali membaca kolom secara bercampur aduk dari kiri ke kanan melintasi batas kolom",
            "c": "Karena ATS hanya bisa membaca gambar PNG",
            "d": "Karena HRD tidak suka melihat warna",
            "key": "B", "desc": "Parser teks ATS memindai secara horizontal; tata letak tabel kompleks dapat mencampuradukkan kata dari kolom berbeda sehingga teks menjadi tidak bermakna."
        },
        {
            "q": "Manakah cara penulisan pengalaman kerja yang paling mencerminkan pencapaian nyata (berorientasi dampak)?",
            "a": "'Bertanggung jawab atas administrasi toko.'",
            "b": "'Membantu bos membuat laporan setiap hari.'",
            "c": "'Mengelola inventaris 300 jenis barang dan memangkas tingkat selisih stok sebesar 35% melalui sistem kontrol berkala.'",
            "d": "'Bekerja keras dan datang tepat waktu ke kantor.'",
            "key": "C", "desc": "Formula berbasis dampak memuat tindakan konkret, lingkup kerja terukur, dan hasil persentase keberhasilan nyata."
        },
        {
            "q": "Informasi pribadi manakah yang TIDAK PERLU dicantumkan di CV profesional standar modern?",
            "a": "Nama lengkap dan nomor WhatsApp aktif",
            "b": "Alamat email profesional",
            "c": "Status pernikahan, suku bangsa, agama, dan makanan favorit",
            "d": "Tautan profil LinkedIn atau portofolio relevan",
            "key": "C", "desc": "Data diskriminatif atau terlalu privat seperti agama, status pernikahan, atau hobi umum tidak relevan bagi kualifikasi profesional."
        },
        {
            "q": "Berapa panjang halaman yang paling ideal untuk CV lulusan baru (fresh graduate) atau pemula karir?",
            "a": "1 halaman (maksimal 2 halaman jika memiliki proyek substansial)",
            "b": "Minimal 5 halaman lengkap dengan sertifikat sekolah dasar",
            "c": "10 halaman",
            "d": "Cukup setengah paragraf saja",
            "key": "A", "desc": "Satu halaman padat dan terkurasi sangat ideal bagi rekruter yang rata-rata hanya meluangkan 6-10 detik saat seleksi cepat pertama."
        },
        {
            "q": "Apa nama formula terkenal dari Google untuk menuliskan pencapaian pengalaman kerja di resume?",
            "a": "Formula ABC", "b": "Formula X-Y-Z ('Accomplished [X], as measured by [Y], by doing [Z]')", "c": "Formula SWOT", "d": "Formula 5W1H",
            "key": "B", "desc": "Formula X-Y-Z Google: Capaian [X], diukur dengan metrik [Y], melalui aksi konkret yang Anda lakukan [Z]."
        },
        {
            "q": "Apa kesalahan fatal dalam penulisan surat lamaran kerja (Cover Letter)?",
            "a": "Menyebutkan nama perusahaan yang dilamar",
            "b": "Menjelaskan kecocokan kualifikasi dengan kriteria lowongan",
            "c": "Mengirim surat lamaran hasil 'copy-paste' massal tanpa menyesuaikan dengan nama dan posisi perusahaan yang dituju",
            "d": "Menyertakan nomor kontak aktif",
            "key": "C", "desc": "Surat lamaran generik tanpa personalisasi memperlihatkan kurangnya minat serius pelamar terhadap perusahaan tersebut."
        },
        {
            "q": "Nama file dokumen lamaran yang paling tepat dan profesional saat diunggah adalah...",
            "a": "cv_baru_fix_banget.pdf",
            "b": "Dokumen1.docx",
            "c": "CV_Budi_Santoso_Staff_Administrasi.pdf",
            "d": "Untitled.pdf",
            "key": "C", "desc": "Nama file yang memuat jenis dokumen, nama lengkap pelamar, dan jabatan lowongan memudahkan arsip rekruter."
        },
        {
            "q": "Manakah alamat email yang paling pantas digunakan untuk melamar pekerjaan formal?",
            "a": "si_ganteng_juara@yahoo.com", "b": "budi.santoso.work@gmail.com", "c": "naruto_gamer99@hotmail.com", "d": "anak.bunda.lucu@gmail.com",
            "key": "B", "desc": "Email kerja harus menggunakan variasi nama asli yang bersih dan formal tanpa embel-embel nama panggilan santai."
        },
        {
            "q": "Kata kerja pembuka (Action Verb) yang kuat untuk mengawali deskripsi tugas di resume adalah...",
            "a": "Mengembangkan", "b": "Mungkin", "c": "Biasanya", "d": "Mencoba-coba",
            "key": "A", "desc": "Kata kerja aktif seperti 'Mengembangkan', 'Memimpin', 'Mengoptimalkan' menunjukkan inisiatif dan kepemilikan tanggung jawab."
        }
    ],
    6: [ # Persiapan Wawancara Kerja
        {
            "q": "Metode terstruktur yang paling populer untuk menjawab pertanyaan wawancara berbasis perilaku adalah...",
            "a": "Metode ABCDE", "b": "Metode STAR (Situation, Task, Action, Result)", "c": "Metode SMART", "d": "Metode 5S",
            "key": "B", "desc": "STAR (Situation, Task, Action, Result) adalah kerangka jawaban paling efektif untuk mendemonstrasikan kompetensi masa lalu."
        },
        {
            "q": "Bagian manakah dalam metode STAR yang harus mendapatkan porsi penjelasan tindakan pribadi paling dominan?",
            "a": "Situation (Latar belakang situasi)", "b": "Action (Tindakan konkret yang Anda ambil)", "c": "Task (Tugas yang diberikan)", "d": "Semua porsinya 1 detik",
            "key": "B", "desc": "Action adalah inti penilaian HRD karena memperlihatkan peran dan keputusan spesifik yang Anda ambil untuk mengatasi kendala."
        },
        {
            "q": "Ketika pewawancara menanyakan: 'Apa kekurangan terbesar Anda?', strategi jawaban yang paling bijak adalah...",
            "a": "Mengatakan bahwa Anda orang yang sempurna tanpa kekurangan",
            "b": "Menyebutkan kelemahan fatal yang membuat Anda tidak mampu bekerja sama sekali",
            "c": "Menyebutkan area yang sedang Anda kembangkan secara jujur disertai langkah nyata yang telah Anda ambil untuk memperbaikinya",
            "d": "Menolak menjawab pertanyaan tersebut",
            "key": "C", "desc": "Sebutkan area perbaikan diri secara otentik serta tunjukkan ikhtiar nyata yang sedang dijalankan untuk mengatasinya."
        },
        {
            "q": "Berapa lama sebelum jadwal wawancara tatap muka seorang kandidat disarankan sudah tiba di lokasi?",
            "a": "Persis pada menit yang dijadwalkan", "b": "15 hingga 20 menit sebelumnya", "c": "3 jam sebelumnya sampai mengganggu kantor", "d": "10 menit setelah jadwal berlalu",
            "key": "B", "desc": "Tiba 15-20 menit lebih awal memberi waktu beradaptasi dengan lingkungan, merapikan diri, dan menghindari kepanikan lalu lintas."
        },
        {
            "q": "Trik terbaik untuk menjaga kontak mata yang tepat saat melakukan wawancara kerja daring (Zoom/Meet) adalah...",
            "a": "Menatap layar kaca laptop terus menerus", "b": "Menatap langsung ke lubang lensa kamera (webcam) saat Anda sedang berbicara", "c": "Melihat ke arah papan ketik (keyboard)", "d": "Mematikan kamera sepanjang sesi",
            "key": "B", "desc": "Menatap lensa webcam menciptakan persepsi bagi lawan bicara di seberang bahwa Anda sedang menatap mata mereka secara langsung."
        },
        {
            "q": "Ketika di akhir wawancara pewawancara bertanya: 'Apakah ada yang ingin ditanyakan?', respons terbaik Anda adalah...",
            "a": "'Tidak ada, saya ingin cepat pulang.'",
            "b": "Mengajukan pertanyaan terarah mengenai tantangan utama tim kerja atau tolok ukur keberhasilan posisi tersebut",
            "c": "Langsung menanyakan kapan bonus liburan tahunan dibagikan",
            "d": "Diam membisu tersenyum",
            "key": "B", "desc": "Mengajukan pertanyaan berkualitas membuktikan bahwa Anda telah meriset perusahaan dan memiliki komitmen tinggi terhadap peran yang dilamar."
        },
        {
            "q": "Apa tujuan utama pewawancara menanyakan: 'Mengapa Anda tertarik bekerja di perusahaan kami?'",
            "a": "Untuk mengecek apakah pelamar hafal alamat kantor",
            "b": "Untuk melihat apakah pelamar meriset nilai perusahaan dan memiliki motivasi kerja yang sejalan dengan visi bisnis",
            "c": "Hanya sekadar formalitas basa-basi pengisi waktu luang",
            "d": "Ingin meminta pujian berlebihan dari pelamar",
            "key": "B", "desc": "Rekruter ingin mengetahui motivasi otentik dan keselarasan nilai budaya kandidat dengan tujuan organisasi."
        },
        {
            "q": "Pesan ucapan terima kasih (Thank You Email) setelah wawancara sebaiknya dikirimkan dalam rentang waktu...",
            "a": "Maksimal 24 jam setelah sesi wawancara selesai", "b": "Satu bulan setelah wawancara", "c": "Setahun kemudian", "d": "Tidak perlu mengirim email apa pun",
            "key": "A", "desc": "Thank-you note dalam waktu 24 jam memperkuat kesan positif, profesionalisme, dan keseriusan Anda di mata panitia seleksi."
        },
        {
            "q": "Bahasa tubuh manakah yang mencerminkan sikap terbuka dan percaya diri dalam wawancara kerja?",
            "a": "Menyilangkan kedua tangan di depan dada", "b": "Duduk tegak rileks, menjaga kontak mata berkala, dan mengangguk saat menyimak", "c": "Menggoyangkan kaki terus-menerus karena cemas", "d": "Menundukkan kepala ke arah lantai",
            "key": "B", "desc": "Postur tegak, kontak mata natural, dan anggukan aktif mencerminkan antusiasme serta kepercayaan diri yang sehat."
        },
        {
            "q": "Ketika ditanya mengenai ekspektasi gaji di tahap wawancara awal, langkah bijak kandidat adalah...",
            "a": "Menyebutkan angka sembarangan tanpa riset", "b": "Menyampaikan rentang gaji realistis berdasarkan riset standar upah industri dan biaya hidup setempat", "c": "Menolak dibayar karena bersedia kerja bakti", "d": "Meminta gaji tertinggi tanpa dasar kualifikasi",
            "key": "B", "desc": "Riset kisaran upah pasar untuk posisi dan kota tersebut menunjukkan kedewasaan kandidat dalam menegosiasikan nilai dirinya."
        }
    ],
    7: [ # Literasi Keuangan Dasar
        {
            "q": "Menurut formula pembagian anggaran sederhana 50/30/20, persentase 50% dialokasikan untuk...",
            "a": "Liburan dan hiburan", "b": "Kebutuhan pokok hidup (makanan, sewa, listrik)", "c": "Investasi saham berisiko tinggi", "d": "Membeli pakaian pesta",
            "key": "B", "desc": "50% pendapatan diperuntukkan bagi kebutuhan hidup mutlak (Needs) yang tidak dapat ditunda pemenuhannya."
        },
        {
            "q": "Apa definisi utama dari Dana Darurat dalam perencanaan keuangan keluarga?",
            "a": "Uang yang disiapkan khusus untuk berbelanja diskon akhir tahun",
            "b": "Simpanan likuid yang hanya boleh digunakan pada peristiwa mendesak dan tak terduga (seperti sakit atau kehilangan pekerjaan)",
            "c": "Uang yang dipinjamkan kepada tetangga",
            "d": "Uang tunai yang disimpan di bawah kasur untuk pamer",
            "key": "B", "desc": "Dana darurat adalah bantalan finansial untuk menjaga kelangsungan hidup saat musibah atau krisis mendadak terjadi."
        },
        {
            "q": "Manakah ciri utama dari layanan pinjaman online (pinjol) ilegal yang berbahaya?",
            "a": "Memiliki izin terdaftar resmi dari Otoritas Jasa Keuangan (OJK)",
            "b": "Meminta akses izin ke seluruh buku kontak telepon dan galeri pribadi ponsel peminjam",
            "c": "Memiliki kantor fisik yang jelas dan layanan bantuan pelanggan resmi",
            "d": "Membatasi suku bunga harian sesuai regulasi AFPI",
            "key": "B", "desc": "Pinjol ilegal menyalahgunakan akses kontak dan galeri untuk menyebarkan ancaman serta mempermalukan korban penagihan."
        },
        {
            "q": "Strategi menabung yang paling efektif dan terbukti berhasil adalah...",
            "a": "Menunggu sisa uang di akhir bulan baru ditabung jika ada",
            "b": "Langsung menyisihkan persentase tabungan di awal begitu menerima gaji/penghasilan",
            "c": "Tidak perlu menabung karena uang pasti akan habis juga",
            "d": "Meminjam uang ke bank untuk ditabung",
            "key": "B", "desc": "Prinsip 'Pay Yourself First': sisihkan tabungan di awal periode penerimaan gaji sebelum dipakai berbelanja keperluan lain."
        },
        {
            "q": "Contoh pengeluaran yang tergolong sebagai 'Keinginan' (Wants) dan bukan kebutuhan mutlak adalah...",
            "a": "Beras untuk makan sehari-hari", "b": "Air minum galon keluarga", "c": "Membeli minuman kopi kekinian di mall setiap sore", "d": "Obat resep dokter saat sakit",
            "key": "C", "desc": "Kopi kafe kekinian adalah pengeluaran rekreasi/gaya hidup yang dapat dipangkas sewaktu-waktu tanpa mengancam keselamatan hidup."
        },
        {
            "q": "Berapa cadangan dana darurat minimal yang disarankan untuk seseorang yang masih lajang?",
            "a": "1 hari pengeluaran", "b": "3 kali rata-rata pengeluaran bulanan", "c": "100 kali gaji", "d": "Tidak perlu ada",
            "key": "B", "desc": "Bagi individu lajang, tabungan setara 3 bulan pengeluaran rutin cukup memberikan ruang bernapas jika terjadi pemutusan kerja sementara."
        },
        {
            "q": "Lembaga resmi pemerintah Indonesia yang bertugas mengawasi dan mengatur sektor jasa keuangan adalah...",
            "a": "OJK (Otoritas Jasa Keuangan)", "b": "KONI", "c": "BMKG", "d": "BNPB",
            "key": "A", "desc": "OJK bertugas menyelenggarakan sistem pengaturan dan pengawasan terintegrasi terhadap keseluruhan kegiatan di sektor jasa keuangan."
        },
        {
            "q": "Apa bahaya dari fenomena 'bocor halus' dalam keuangan pribadi?",
            "a": "Pengeluaran besar yang langsung dicatat rapi",
            "b": "Pengeluaran nominal kecil yang sering dilakukan berulang tanpa terasa hingga menghabiskan sebagian besar penghasilan",
            "c": "Kebocoran pipa air di rumah",
            "d": "Menyimpan uang koin di celengan",
            "key": "B", "desc": "Bocor halus (seperti parkir, rokok eceran, jajan kecil) yang tidak dicatat kerap menjadi penyebab utama lenyapnya gaji tanpa sisa."
        },
        {
            "q": "Perilaku yang paling tepat sebelum memutuskan mengambil fasilitas cicilan Paylater atau pinjaman adalah...",
            "a": "Langsung klik setuju tanpa membaca suku bunga dan denda keterlambatan",
            "b": "Memastikan cicilan ditujukan untuk keperluan produktif dan total seluruh cicilan tidak melebihi 30% dari penghasilan bulanan",
            "c": "Mengajukan pinjaman di 10 aplikasi sekaligus untuk jalan-jalan",
            "d": "Menggunakan data KTP orang lain",
            "key": "B", "desc": "Rasio total cicilan utang yang sehat adalah di bawah 30% dari total pendapatan bulanan agar arus kas rumah tangga tidak kolaps."
        },
        {
            "q": "Langkah pertama yang harus dilakukan seseorang saat ingin memperbaiki kondisi keuangannya adalah...",
            "a": "Membeli buku mahal", "b": "Mencatat seluruh arus uang masuk dan uang keluar harian secara disiplin", "c": "Berhenti makan nasi sama sekali", "d": "Mengundurkan diri dari pekerjaan",
            "key": "B", "desc": "Pencatatan kas harian memberikan visibilitas nyata ke mana uang mengalir sehingga langkah efisiensi dapat ditargetkan dengan tepat."
        }
    ],
    8: [ # Memulai Usaha Kecil Modal Minim
        {
            "q": "Metode penjualan terbaik bagi wirausaha pemula bermodal minim agar tidak menanggung risiko barang sisa atau modal mati adalah...",
            "a": "Menyewa ruko mahal di pusat perbelanjaan",
            "b": "Sistem Pre-Order (PO) dengan meminta uang muka (DP) terlebih dahulu kepada pemesan",
            "c": "Memproduksi 500 unit barang sekaligus lalu berharap ada pembeli",
            "d": "Membeli mesin pabrik skala industri",
            "key": "B", "desc": "Sistem Pre-Order (PO) menjamin adanya pembeli pasti sebelum modal dibelanjakan untuk bahan baku, meminimalkan risiko kerugian."
        },
        {
            "q": "Apa kepanjangan dari HPP dalam kalkulasi keuangan usaha dagang atau produksi makanan?",
            "a": "Harga Pembelian Pasar", "b": "Harga Pokok Penjualan", "c": "Hasil Penjualan Produk", "d": "Hak Paten Produk",
            "key": "B", "desc": "HPP adalah Harga Pokok Penjualan, yaitu total seluruh pengeluaran langsung yang dikeluarkan untuk menghasilkan suatu produk."
        },
        {
            "q": "Biaya manakah di bawah ini yang tergolong sebagai biaya operasional langsung dalam produksi kue rumahan?",
            "a": "Biaya gas elpiji dan plastik kemasan", "b": "Biaya liburan keluarga pemilik usaha", "c": "Pajak mobil pribadi", "d": "Uang jajan anak",
            "key": "A", "desc": "Gas dan kemasan plastik langsung habis terpakai dalam proses pembuatan dan pengemasan produk kue yang dijual."
        },
        {
            "q": "Aplikasi pesan instan gratis yang memiliki fitur katalog produk, profil bisnis, dan pesan sapaan otomatis untuk UMKM adalah...",
            "a": "WhatsApp Messenger biasa", "b": "WhatsApp Business", "c": "SMS konvensional", "d": "Twitter Web",
            "key": "B", "desc": "WhatsApp Business dirancang khusus dengan fitur etalase katalog, jam buka toko, dan label chat untuk menunjang transaksi UMKM."
        },
        {
            "q": "Sumber pencahayaan terbaik dan paling hemat biaya untuk memotret produk makanan menggunakan kamera HP adalah...",
            "a": "Lampu flash langsung dari kamera ponsel",
            "b": "Cahaya alami matahari di dekat jendela pada pagi atau sore hari (Window Light)",
            "c": "Lampu neon redup di kamar tidur",
            "d": "Senter dari HP lain",
            "key": "B", "desc": "Cahaya alami dekat jendela menghasilkan pencahayaan merata yang lembut tanpa bayangan tajam yang merusak tampilan foto produk."
        },
        {
            "q": "Mengapa pengusaha pemula wajib menganggarkan upah untuk tenaga kerjanya sendiri dalam perhitungan harga produk?",
            "a": "Hanya sekadar formalitas agar harga terlihat mahal",
            "b": "Agar usaha dapat berkembang secara mandiri dan pemilik mengetahui profit usaha sesungguhnya yang terpisah dari gaji kerja",
            "c": "Supaya tidak perlu membayar pajak",
            "d": "Agar uang usaha bisa dipakai foya-foya pribadi",
            "key": "B", "desc": "Jika tenaga pemilik tidak dihargai, usaha tampak menguntungkan padahal kenyataannya pemilik hanya bekerja tanpa upah layak."
        },
        {
            "q": "Tindakan pertama yang paling krusial sebelum memotret produk dengan kamera ponsel pintar adalah...",
            "a": "Memasang tripod termahal", "b": "Membersihkan kaca lensa kamera dengan kain lembut agar foto tidak buram terkena minyak", "c": "Menambahkan stiker animasi lucu di atas produk", "d": "Memperbesar zoom kamera hingga 10x",
            "key": "B", "desc": "Lensa ponsel yang kotor oleh sidik jari adalah penyebab utama foto terlihat berkabut dan tidak tajam."
        },
        {
            "q": "Bagaimana cara menentukan ide bisnis yang paling berpeluang diterima pasar lokal?",
            "a": "Memilih produk yang sedang viral di luar negeri meskipun tidak dibutuhkan warga sekitar",
            "b": "Mengamati masalah atau kesulitan yang sering dikeluhkan masyarakat sekitar dan menawarkan solusi praktis atas masalah itu",
            "c": "Menjual barang yang paling mahal agar cepat kaya",
            "d": "Meniru usaha tetangga persis tanpa ada nilai tambah apa pun",
            "key": "B", "desc": "Bisnis yang berkelanjutan dibangun di atas pemecahan masalah riil yang dihadapi oleh konsumen di sekitarnya."
        },
        {
            "q": "Apa fungsi fitur 'Label Chat' pada WhatsApp Business?",
            "a": "Untuk menghapus pesan secara permanen",
            "b": "Untuk menandai dan mengelompokkan pesan pelanggan (misal: 'Belum Bayar', 'Sudah Lunas', 'Pesanan Siap Kirim')",
            "c": "Untuk memblokir semua kontak pelanggan",
            "d": "Untuk mengirim pesan spam ke orang asing",
            "key": "B", "desc": "Label Chat memudahkan pemilahan status pesanan sehingga penjual tidak melewatkan pelanggan yang belum dilayani."
        },
        {
            "q": "Prinsip utama dalam menetapkan harga jual suatu produk adalah...",
            "a": "Harga jual harus berada di atas HPP agar menghasilkan margin keuntungan bersih yang sehat",
            "b": "Harga jual harus selalu lebih murah dari kompetitor meski menanggung kerugian",
            "c": "Harga ditentukan secara acak tanpa perlu menghitung biaya modal",
            "d": "Harga jual selalu disamakan dengan biaya bahan baku saja",
            "key": "A", "desc": "Harga jual wajib menutup seluruh modal pokok (HPP) dan menyisakan margin laba agar bisnis dapat terus beroperasi dan berkembang."
        }
    ]
}

# Generate SQL insert statements for modules
sql_modules = []
mod_id = 1
for c in courses_data:
    cid = c["id"]
    for idx, m in enumerate(c["modules"], 1):
        title = m["title"].replace("'", "''")
        dur = m["duration"]
        video = m["video"]
        content = m["content"].replace("'", "''")
        sql_modules.append(f"({mod_id}, {cid}, '{title}', {idx}, {dur}, '{content}', '{video}')")
        mod_id += 1

# Generate SQL insert statements for quiz questions
sql_questions = []
q_id = 1
for cid, qlist in quizzes_data.items():
    for idx, q in enumerate(qlist, 1):
        pertanyaan = q["q"].replace("'", "''")
        pa = q["a"].replace("'", "''")
        pb = q["b"].replace("'", "''")
        pc = q["c"].replace("'", "''")
        pd = q["d"].replace("'", "''")
        kunci = q["key"]
        pembahasan = q["desc"].replace("'", "''")
        sql_questions.append(f"({q_id}, {cid}, '{pertanyaan}', '{pa}', '{pb}', '{pc}', '{pd}', '{kunci}', '{pembahasan}', {idx})")
        q_id += 1

# Write to database.sql
full_sql = sql_content + "\n\n-- 4. Modul Pelajaran\nINSERT INTO `modul` (`id`, `kursus_id`, `judul_modul`, `urutan`, `estimasi_menit`, `konten`, `video_url`) VALUES\n" + ",\n".join(sql_modules) + ";\n\n"

full_sql += "-- 5. Soal Kuis Akhir Kursus (10 Soal per Kursus)\nINSERT INTO `soal_kuis` (`id`, `kursus_id`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban_benar`, `pembahasan`, `urutan`) VALUES\n" + ",\n".join(sql_questions) + ";\n\n"

# Seed 1 completed course with certificate for Budi Santoso on Course 5 (Menulis CV)
# modules for course 5: IDs 17, 18, 19, 20
full_sql += """-- 6. Contoh Progres & Sertifikat Budi Santoso (Menulis CV & Surat Lamaran Kerja)
INSERT INTO `progres_modul` (`pengguna_id`, `modul_id`, `kursus_id`, `selesai_pada`) VALUES
(2, 17, 5, '2026-11-15 09:30:00'),
(2, 18, 5, '2026-11-15 10:15:00'),
(2, 19, 5, '2026-11-15 11:00:00'),
(2, 20, 5, '2026-11-15 11:45:00');

INSERT INTO `hasil_kuis` (`id`, `pengguna_id`, `kursus_id`, `total_soal`, `jawaban_benar`, `nilai`, `status_lulus`, `dikerjakan_pada`) VALUES
(1, 2, 5, 10, 9, 90.00, 'Lulus', '2026-11-15 12:15:00');

INSERT INTO `sertifikat` (`id`, `nomor_sertifikat`, `pengguna_id`, `kursus_id`, `tanggal_terbit`, `kode_verifikasi`, `penandatangan_nama`, `penandatangan_jabatan`) VALUES
(1, 'S4L-2026-000123', 2, 5, '2026-11-15', 'a1b2c3d4e5f67890abcdef1234567890abcdef1234567890abcdef1234567890', 'Dr. Ir. Hendra Gunawan, M.T.', 'Direktur Pembina Skill4Life');
"""

with open("database.sql", "w", encoding="utf-8") as out_f:
    out_f.write(full_sql)

with open(os.path.join("skill4life", "database.sql"), "w", encoding="utf-8") as out_f2:
    out_f2.write(full_sql)

print(f"Generated {len(sql_modules)} modules and {len(sql_questions)} quiz questions successfully!")
