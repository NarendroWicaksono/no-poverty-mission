<?php
$baseUrl = '.';
$judulHalaman = 'Skill4Life - Kursus Keterampilan Kerja Gratis dan Bersertifikat';
include __DIR__ . '/includes/header.php';
?>

<!-- 1. Hero Asimetris (Teks di kiri, Pratinjau Produk Nyata Berbasis Kode di kanan) -->
<section style="background-color: var(--latar); border-bottom: 1px solid var(--garis); padding: var(--spasi-64) 0 var(--spasi-80);">
  <div class="wadah" style="display: grid; grid-template-columns: 1fr 1.05fr; gap: var(--spasi-64); align-items: center;">
    <!-- Kolom Kiri: Teks Rata Kiri Tenang -->
    <div>
      <div style="font-size: var(--teks-12); font-weight: 500; color: var(--aksen); margin-bottom: var(--spasi-12); text-transform: none;">
        Prakarsa SDG 1: Tanpa kemiskinan
      </div>
      <h1 class="hero-judul" style="font-size: var(--teks-56); line-height: 1.1; margin-bottom: var(--spasi-20); color: var(--teks);">
        Belajar skill kerja, gratis dan bersertifikat
      </h1>
      <p style="font-size: var(--teks-16); color: var(--teks-2); line-height: var(--jarak-baris-baca); margin-bottom: var(--spasi-32); max-width: 480px;">
        Pelatihan daring terstruktur untuk pencari kerja, pelajar, dan pelaku usaha kecil. Seluruh modul dapat dipelajari secara mandiri tanpa pungutan biaya.
      </p>

      <!-- Tepat Dua Tombol: Satu Utama dan Satu Sekunder -->
      <div style="display: flex; gap: var(--spasi-16); align-items: center; flex-wrap: wrap;">
        <a href="<?= $baseUrl ?>/kursus/katalog.php" class="tombol tombol-utama">
          Lihat daftar kursus
        </a>
        <a href="<?= $baseUrl ?>/auth/daftar.php" class="tombol tombol-sekunder">
          Daftar akun gratis
        </a>
      </div>
    </div>

    <!-- Kolom Kanan: Pratinjau Produk Kode Murni (Bukan Gambar Dekoratif) -->
    <div style="position: relative; padding: var(--spasi-24) 0;">
      <!-- Elemen Sertifikat Nyata yang Menyembul dari Belakang -->
      <div style="background: #FCFBF9; border: 1px solid #D6D2C4; border-radius: 4px; padding: var(--spasi-20); margin-bottom: -40px; margin-left: var(--spasi-32); box-shadow: 0 4px 12px rgba(28,26,23,0.04); position: relative; z-index: 1;">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(28,26,23,0.08); padding-bottom: var(--spasi-8); margin-bottom: var(--spasi-12);">
          <span style="font-family: var(--font-mono); font-size: var(--teks-12); color: var(--teks-3);">S4L-2026-000123</span>
          <!-- Segel Bulat Khas SVG -->
          <img src="<?= $baseUrl ?>/assets/img/segel-resmi.svg" alt="Segel resmi" class="segel-s4l" style="width: 32px; height: 32px;">
        </div>
        <div style="font-family: var(--font-serif); font-size: var(--teks-14); color: var(--teks-2); margin-bottom: var(--spasi-4);">Sertifikat kelulusan</div>
        <div style="font-family: var(--font-serif); font-size: var(--teks-20); font-weight: 600; color: var(--aksen); margin-bottom: var(--spasi-4);">Budi Santoso</div>
        <div style="font-size: var(--teks-12); color: var(--teks-2);">Menulis CV dan surat lamaran kerja</div>
      </div>

      <!-- Kartu Kursus Nyata Berjalan di Depan -->
      <div class="kartu" style="position: relative; z-index: 2; box-shadow: 0 8px 24px rgba(28,26,23,0.06); max-width: 440px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spasi-12);">
          <span style="font-size: var(--teks-12); color: var(--teks-3);">Aplikasi perkantoran</span>
          <span class="angka-mono" style="font-size: var(--teks-12); color: var(--aksen);">75% tuntas</span>
        </div>
        <div style="font-weight: 500; font-size: var(--teks-16); color: var(--teks); margin-bottom: var(--spasi-8);">
          Microsoft Excel dasar
        </div>
        <p style="font-size: var(--teks-14); color: var(--teks-2); margin-bottom: var(--spasi-16); line-height: 1.5;">
          Navigasi lembar sebar, input data angka dan teks, serta perhitungan rumus matematika dasar.
        </p>

        <!-- Bilah Progres Nyata -->
        <div class="bilah-progres" style="margin-bottom: var(--spasi-12);">
          <div class="bilah-progres-isi" style="width: 75%;"></div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; font-size: var(--teks-12); color: var(--teks-3);">
          <span>3 dari 4 modul selesai</span>
          <span class="angka-mono">2.5 jam total</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 2. Statistik Singkat (Angka besar label kecil, tanpa ikon, tanpa sparkline) -->
<section style="border-bottom: 1px solid var(--garis); background-color: var(--permukaan);">
  <div class="wadah" style="display: grid; grid-template-columns: repeat(4, 1fr); padding-top: var(--spasi-32); padding-bottom: var(--spasi-32); gap: var(--spasi-24);">
    <div>
      <div class="angka-mono" style="font-size: var(--teks-40); font-weight: 500; color: var(--teks); line-height: 1.1;" id="stat-kursus-nilai">
        6
      </div>
      <div style="font-size: var(--teks-12); color: var(--teks-3); margin-top: var(--spasi-4);">
        Kursus siap kerja
      </div>
    </div>
    <div>
      <div class="angka-mono" style="font-size: var(--teks-40); font-weight: 500; color: var(--teks); line-height: 1.1;" id="stat-modul-nilai">
        24
      </div>
      <div style="font-size: var(--teks-12); color: var(--teks-3); margin-top: var(--spasi-4);">
        Modul terstruktur
      </div>
    </div>
    <div>
      <div class="angka-mono" style="font-size: var(--teks-40); font-weight: 500; color: var(--teks); line-height: 1.1;" id="stat-sertifikat-nilai">
        842
      </div>
      <div style="font-size: var(--teks-12); color: var(--teks-3); margin-top: var(--spasi-4);">
        Sertifikat diterbitkan
      </div>
    </div>
    <div>
      <div class="angka-mono" style="font-size: var(--teks-40); font-weight: 500; color: var(--aksen); line-height: 1.1;">
        Rp 0
      </div>
      <div style="font-size: var(--teks-12); color: var(--teks-3); margin-top: var(--spasi-4);">
        Biaya pendaftaran
      </div>
    </div>
  </div>
</section>

<!-- 3. Kategori Kursus -->
<section style="padding: var(--spasi-64) 0; border-bottom: 1px solid var(--garis);">
  <div class="wadah">
    <div style="margin-bottom: var(--spasi-32);">
      <h2 style="font-size: var(--teks-28); font-family: var(--font-serif); margin-bottom: var(--spasi-8);">
        Kategori kursus
      </h2>
      <p style="color: var(--teks-2); font-size: var(--teks-14);">
        Bidang keterampilan praktis yang dirancang langsung untuk kebutuhan kerja administratif dan persiapan seleksi.
      </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--spasi-24);" id="kategori-daftar">
      <!-- Dimuat dinamis via JS -->
    </div>
  </div>
</section>

<!-- 4. Kursus Unggulan (Ukuran kartu bervariasi: satu sorotan lebih lebar) -->
<section style="padding: var(--spasi-64) 0; border-bottom: 1px solid var(--garis); background-color: var(--permukaan);">
  <div class="wadah">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: var(--spasi-32); flex-wrap: wrap; gap: var(--spasi-16);">
      <div>
        <h2 style="font-size: var(--teks-28); font-family: var(--font-serif); margin-bottom: var(--spasi-8);">
          Kursus pilihan
        </h2>
        <p style="color: var(--teks-2); font-size: var(--teks-14);">
          Materi paling banyak diselesaikan peserta untuk persiapan melamar kerja kantor.
        </p>
      </div>
      <a href="<?= $baseUrl ?>/kursus/katalog.php" class="tombol tombol-sekunder tombol-kecil">
        Buka semua kursus
      </a>
    </div>

    <!-- Ritme Kartu Bervariasi: 1 kartu sorotan 2 kolom + kartu standar -->
    <div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: var(--spasi-24);" id="kursus-unggulan-grid">
      <!-- Dimuat dinamis via JS -->
    </div>
  </div>
</section>

<!-- 5. Bagian "Cara kerja" (Tiga langkah lugas pengganti testimoni) -->
<section style="padding: var(--spasi-64) 0; border-bottom: 1px solid var(--garis);">
  <div class="wadah">
    <div style="margin-bottom: var(--spasi-40);">
      <h2 style="font-size: var(--teks-28); font-family: var(--font-serif); margin-bottom: var(--spasi-8);">
        Cara kerja
      </h2>
      <p style="color: var(--teks-2); font-size: var(--teks-14);">
        Alur belajar mandiri dari awal hingga memperoleh sertifikat resmi.
      </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--spasi-24);">
      <div class="kartu">
        <div class="angka-mono" style="font-size: var(--teks-20); color: var(--aksen); margin-bottom: var(--spasi-12);">01</div>
        <h3 style="font-size: var(--teks-16); font-weight: 500; margin-bottom: var(--spasi-8);">Pilih kursus</h3>
        <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: var(--jarak-baris-baca);">
          Pilih materi keterampilan kerja yang sesuai dengan kebutuhan kerja Anda saat ini tanpa syarat apa pun.
        </p>
      </div>

      <div class="kartu">
        <div class="angka-mono" style="font-size: var(--teks-20); color: var(--aksen); margin-bottom: var(--spasi-12);">02</div>
        <h3 style="font-size: var(--teks-16); font-weight: 500; margin-bottom: var(--spasi-8);">Pelajari modul</h3>
        <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: var(--jarak-baris-baca);">
          Ikuti bacaan terstruktur dan video panduan langkah demi langkah. Tandai modul selesai saat Anda memahaminya.
        </p>
      </div>

      <div class="kartu">
        <div class="angka-mono" style="font-size: var(--teks-20); color: var(--aksen); margin-bottom: var(--spasi-12);">03</div>
        <h3 style="font-size: var(--teks-16); font-weight: 500; margin-bottom: var(--spasi-8);">Dapatkan sertifikat</h3>
        <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: var(--jarak-baris-baca);">
          Kerjakan kuis akhir 10 soal dengan nilai kelulusan minimal 70. Sertifikat dengan nomor verifikasi diterbitkan seketika.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- 6. Bagian "Mengapa gratis" (Latar belakang misi SDG 1) -->
<section style="padding: var(--spasi-64) 0; background-color: var(--permukaan);">
  <div class="wadah wadah-baca">
    <div style="font-size: var(--teks-12); font-weight: 500; color: var(--aksen); margin-bottom: var(--spasi-8);">
      Misi sosial
    </div>
    <h2 style="font-size: var(--teks-28); font-family: var(--font-serif); margin-bottom: var(--spasi-16);">
      Mengapa Skill4Life gratis
    </h2>
    <p style="font-size: var(--teks-16); color: var(--teks-2); line-height: var(--jarak-baris-baca); margin-bottom: var(--spasi-16);">
      Tujuan Pembangunan Berkelanjutan (SDG) 1 menargetkan penghapusan kemiskinan dalam segala bentuk. Salah satu penghalang utama pencari kerja berpenghasilan rendah adalah tingginya biaya kursus keahlian komputer dan sertifikasi resmi.
    </p>
    <p style="font-size: var(--teks-16); color: var(--teks-2); line-height: var(--jarak-baris-baca);">
      Skill4Life dibangun sebagai fasilitas terbuka. Tidak ada skema bayar di awal, langganan bulanan, maupun biaya tebus sertifikat di akhir. Siapa pun berhak menguasai keterampilan kerja yang layak.
    </p>
  </div>
</section>

<script type="module">
  import { ambilStatistik, ambilKategori, ambilDaftarKursus } from './assets/js/api.js';

  async function muatHalamanBeranda() {
    // 1. Muat Statistik
    const stat = await ambilStatistik();
    const elKursus = document.getElementById('stat-kursus-nilai');
    const elModul = document.getElementById('stat-modul-nilai');
    const elSert = document.getElementById('stat-sertifikat-nilai');
    if (elKursus) elKursus.textContent = stat.total_kursus;
    if (elModul) elModul.textContent = stat.total_modul;
    if (elSert) elSert.textContent = stat.total_sertifikat;

    // 2. Muat Kategori
    const katList = await ambilKategori();
    const katContainer = document.getElementById('kategori-daftar');
    if (katContainer) {
      katContainer.innerHTML = katList.map(k => `
        <div class="kartu">
          <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Kategori</div>
          <h3 style="font-size: var(--teks-20); font-weight: 500; margin-bottom: var(--spasi-8);">
            <a href="./kursus/katalog.php?kategori=${k.slug}">${k.nama}</a>
          </h3>
          <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: var(--jarak-baris-baca); margin-bottom: var(--spasi-16);">
            ${k.deskripsi}
          </p>
          <div style="display: flex; justify-content: space-between; align-items: center; font-size: var(--teks-12); color: var(--teks-3); border-top: 1px solid var(--garis); padding-top: var(--spasi-12);">
            <span>${k.jumlah_kursus} kursus</span>
            <a href="./kursus/katalog.php?kategori=${k.slug}" style="color: var(--aksen); font-weight: 500;">Buka kategori &rarr;</a>
          </div>
        </div>
      `).join('');
    }

    // 3. Muat Kursus Pilihan (Sorotan Bervariasi)
    const kursusList = await ambilDaftarKursus();
    const unggulanGrid = document.getElementById('kursus-unggulan-grid');
    if (unggulanGrid && kursusList.length >= 2) {
      const sorotanUtama = kursusList[0];
      const kursusDua = kursusList[1];

      unggulanGrid.innerHTML = `
        <div class="kartu" style="border-left: 3px solid var(--aksen);">
          <div style="font-size: var(--teks-12); color: var(--aksen); margin-bottom: var(--spasi-4);">Kursus sorotan</div>
          <h3 style="font-size: var(--teks-20); font-weight: 500; margin-bottom: var(--spasi-8);">
            <a href="./kursus/detail.php?slug=${sorotanUtama.slug}">${sorotanUtama.judul}</a>
          </h3>
          <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: var(--jarak-baris-baca); margin-bottom: var(--spasi-20);">
            ${sorotanUtama.deskripsi}
          </p>
          <div style="display: flex; gap: var(--spasi-16); font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-20);">
            <span>Level: ${sorotanUtama.level}</span>
            <span>Waktu: ${sorotanUtama.estimasi_waktu}</span>
            <span>Materi: ${sorotanUtama.jumlah_modul} modul</span>
          </div>
          <a href="./kursus/detail.php?slug=${sorotanUtama.slug}" class="tombol tombol-utama tombol-kecil">
            Mulai belajar
          </a>
        </div>

        <div class="kartu">
          <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">${kursusDua.kategori}</div>
          <h3 style="font-size: var(--teks-16); font-weight: 500; margin-bottom: var(--spasi-8);">
            <a href="./kursus/detail.php?slug=${kursusDua.slug}">${kursusDua.judul}</a>
          </h3>
          <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: var(--jarak-baris-baca); margin-bottom: var(--spasi-16);">
            ${kursusDua.ringkasan}
          </p>
          <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-16);">
            ${kursusDua.jumlah_modul} modul &bull; ${kursusDua.estimasi_waktu}
          </div>
          <a href="./kursus/detail.php?slug=${kursusDua.slug}" class="tombol tombol-sekunder tombol-kecil">
            Rincian kursus
          </a>
        </div>
      `;
    }
  }

  document.addEventListener('DOMContentLoaded', muatHalamanBeranda);
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
