<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skill4Life</title>

  <!-- Font Sans-Serif Baru (Pengganti Source Serif 4) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- CSS Proyek -->
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/variabel.css?v=<?= time() ?>">
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/global.css?v=<?= time() ?>">
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/komponen.css?v=<?= time() ?>">

  <!-- Ikon Lucide -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<style>
  body {
    background-color: var(--latar, #121212);
    color: var(--teks, #FFFFFF);
    margin: 0;
    font-family: var(--font-ui);
  }
  /* Tipografi Responsif */
  .s4l-judul-besar {
    font-family: var(--font-judul);
    font-size: clamp(34px, 5vw, var(--teks-56));
    font-weight: 700;
    line-height: 1.14;
    letter-spacing: -0.03em;
    color: var(--teks);
  }

  .s4l-judul-seksi {
    font-family: var(--font-judul);
    font-size: clamp(26px, 3.6vw, var(--teks-40));
    font-weight: 700;
    line-height: 1.4;
    letter-spacing: -0.025em;
  }

  .s4l-deskripsi {
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    font-weight: 400;
    line-height: var(--jarak-baris-baca);
    color: var(--teks-2);
  }

  /* Sorotan Kapsul */
  .sorotan-gelap {
    display: inline-block;
    background-color: var(--teks);
    color: var(--latar);
    padding: 4px 18px 6px;
    border-radius: 999px;
    font-weight: 700;
    line-height: 1.15;
    margin-top: 4px;
  }

  .sorotan-garis {
    display: inline-block;
    border: 2px solid var(--aksen);
    color: var(--aksen);
    padding: 2px 16px 5px;
    border-radius: 999px;
    line-height: 1.15;
    margin-top: 4px;
  }

  .sorotan-garis-terang {
    display: inline-block;
    border: 2px solid var(--aksen-tipis);
    color: var(--aksen-tipis);
    padding: 2px 16px 5px;
    border-radius: 999px;
    line-height: 1.15;
    margin-top: 4px;
  }

  /* Tata Letak Seksi & Grid */
  .s4l-seksi {
    padding: var(--spasi-80) 0;
  }

  .hero-seksi {
    background-color: var(--aksen-terang, #1DB954);
    background: linear-gradient(135deg, #1DB954 0%, #179c45 100%);
    padding: var(--spasi-64) 0 0;
    overflow: hidden;
    color: #000000;
  }
  .hero-seksi .s4l-judul-besar {
    color: #000000 !important;
  }
  .hero-seksi .sorotan-gelap {
    background-color: #000000 !important;
    color: #1DB954 !important;
  }
  .hero-seksi .s4l-deskripsi {
    color: #0e2b19 !important;
  }
  .hero-seksi .tombol-utama {
    background-color: #0B2E17 !important;
    border: 1.5px solid #061c0e !important;
    color: #FFFFFF !important;
    font-weight: 700 !important;
  }
  .hero-seksi .tombol-utama:hover {
    background-color: #124222 !important;
    border-color: #0b2e17 !important;
  }
  .hero-seksi .tombol-sekunder {
    background-color: #FFFFFF !important;
    color: #000000 !important;
    border: none !important;
    font-weight: 600 !important;
  }
  .hero-seksi .tombol-sekunder:hover {
    background-color: #EFEFEF !important;
  }

  .hero-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: var(--spasi-48);
    align-items: center;
    margin-bottom: var(--spasi-48);
  }

  .hero-aksi {
    display: flex;
    gap: var(--spasi-12);
    align-items: center;
    flex-wrap: wrap;
  }

  /* Statistik 4 Kolom */
  .stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    text-align: center;
  }

  .stat-item {
    border-right: 1px solid var(--garis);
    padding: 0 var(--spasi-16);
  }

  .stat-item:last-child {
    border-right: none;
  }

  .stat-angka {
    font-family: var(--font-judul);
    font-size: clamp(28px, 3.5vw, var(--teks-40));
    font-weight: 700;
    color: var(--teks);
    line-height: 1.1;
  }

  /* Split Dua Kolom (Misi & Cara Kerja) */
  .split-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spasi-64);
    align-items: center;
  }

  /* Bento Grid Kategori */
  .bento-kategori {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--spasi-24);
  }

  .bento-kartu-utama {
    background-color: #FFFFFF;
    color: #181818;
    border-radius: var(--radius-panel);
    padding: var(--spasi-40);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: var(--spasi-24);
    width: 100%;
    box-sizing: border-box;
  }

  .bento-kartu-item {
    background-color: var(--permukaan);
    border: 1px solid var(--garis);
    border-radius: var(--radius-kartu);
    padding: var(--spasi-32);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: var(--transisi-cepat);
  }

  .bento-kartu-item:hover {
    border-color: var(--aksen);
  }

  .ikon-lingkaran {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background-color: #FFFFFF;
    color: var(--aksen);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: var(--spasi-20);
  }

  /* Grid Kursus Pilihan */
  .kursus-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--spasi-24);
  }

  /* Banner Ajakan Bawah */
  .cta-kartu {
    background-color: var(--aksen-tipis);
    border-radius: var(--radius-panel);
    padding: var(--spasi-48) var(--spasi-64);
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    gap: var(--spasi-40);
    align-items: center;
  }

  /* Breakpoint Tablet (<= 900px) */
  @media (max-width: 900px) {
    .s4l-seksi {
      padding: var(--spasi-64) 0;
    }

    .hero-seksi {
      padding-top: var(--spasi-48);
    }

    .hero-grid {
      grid-template-columns: 1fr;
      gap: var(--spasi-24);
      margin-bottom: var(--spasi-32);
    }

    .split-grid {
      grid-template-columns: 1fr;
      gap: var(--spasi-40);
    }

    .split-grid-balik .split-media {
      order: -1;
    }

    .bento-kategori {
      grid-template-columns: repeat(2, 1fr);
    }

    .bento-kartu-utama {
      flex-direction: column;
      align-items: flex-start;
      gap: var(--spasi-20);
      padding: var(--spasi-32);
    }

    .kursus-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .cta-kartu {
      grid-template-columns: 1fr;
      padding: var(--spasi-40) var(--spasi-32);
      gap: var(--spasi-24);
    }
  }

  /* Breakpoint Ponsel (<= 600px) */
  @media (max-width: 600px) {
    .s4l-seksi {
      padding: var(--spasi-48) 0;
    }

    .hero-seksi {
      padding-top: var(--spasi-32);
    }

    .sorotan-gelap {
      padding: 1px 14px 4px;
    }

    .sorotan-garis,
    .sorotan-garis-terang {
      padding: 0 12px 3px;
    }

    .hero-aksi {
      flex-direction: column;
      align-items: stretch;
    }

    .hero-aksi a {
      justify-content: center;
      text-align: center;
    }

    .stat-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .stat-item {
      padding: var(--spasi-16) var(--spasi-12);
    }

    .stat-item:nth-child(2) {
      border-right: none;
    }

    .stat-item:nth-child(1),
    .stat-item:nth-child(2) {
      border-bottom: 1px solid var(--garis);
    }

    .bento-kategori {
      grid-template-columns: 1fr;
      gap: var(--spasi-16);
    }

    .bento-kartu-utama {
      padding: var(--spasi-24);
    }

    .bento-kartu-item {
      padding: var(--spasi-24);
    }

    .kursus-grid {
      grid-template-columns: 1fr;
      gap: var(--spasi-20);
    }

    .cta-kartu {
      padding: var(--spasi-32) var(--spasi-20);
    }
  }
</style>

<!-- 1. Hero Header Split + Ilustrasi Utama -->
<section class="hero-seksi">
  <div class="wadah">
    <div class="hero-grid">
      <div>
        <h1 class="s4l-judul-besar">
          Tingkatkan <span class="sorotan-gelap">Skill</span> Kerja Lebih Cepat
        </h1>
      </div>
      <div>
        <p class="s4l-deskripsi" style="margin-bottom: var(--spasi-24); max-width: 420px;">
          Pelatihan online terstruktur untuk pencari kerja, pelajar, dan pelaku usaha kecil. Pelajari materi praktis hingga meraih sertifikat resmi tanpa biaya.
        </p>
        <div class="hero-aksi">
          <a href="<?= $baseUrl ?>/kursus/katalog.php" class="tombol tombol-utama" style="border-radius: 999px; padding: 12px 24px; font-weight: 600; font-size: var(--teks-14); display: inline-flex; align-items: center; gap: 8px;">
            <span>Mulai Belajar</span>
            <i data-lucide="arrow-up-right" style="width: 16px; height: 16px;"></i>
          </a>
          <a href="<?= $baseUrl ?>/auth/daftar.php" class="tombol tombol-sekunder" style="border-radius: 999px; padding: 12px 24px; font-weight: 500; font-size: var(--teks-14); background-color: var(--permukaan);">
            Daftar Gratis
          </a>
        </div>
      </div>
    </div>

    <!-- Ilustrasi Vektor Lokal -->
    <div style="display: flex; justify-content: center; padding-top: var(--spasi-8);">
      <svg viewBox="0 0 760 280" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; max-width: 720px; height: auto; display: block;">
        <rect x="40" y="248" width="680" height="12" rx="6" fill="#1C1A17" />
        <rect x="110" y="260" width="16" height="20" fill="#1C1A17" />
        <rect x="634" y="260" width="16" height="20" fill="#1C1A17" />

        <rect x="210" y="48" width="340" height="200" rx="14" fill="#FFFFFF" stroke="#1C1A17" stroke-width="3" />
        <rect x="210" y="48" width="340" height="32" rx="12" fill="#242424" />
        <circle cx="232" cy="64" r="5" fill="#1DB954" />
        <circle cx="248" cy="64" r="5" fill="#727272" />
        <circle cx="264" cy="64" r="5" fill="#727272" />

        <rect x="236" y="100" width="130" height="14" rx="4" fill="#1C1A17" />
        <rect x="236" y="124" width="180" height="10" rx="4" fill="#727272" opacity="0.5" />
        <rect x="236" y="142" width="150" height="10" rx="4" fill="#727272" opacity="0.5" />
        <rect x="236" y="174" width="110" height="34" rx="17" fill="#1DB954" />
        <rect x="256" y="187" width="70" height="8" rx="4" fill="#FFFFFF" />

        <rect x="430" y="98" width="96" height="110" rx="10" fill="#121212" stroke="#1C1A17" stroke-width="2" />
        <circle cx="478" cy="140" r="24" stroke="rgba(29, 185, 84, 0.15)" stroke-width="7" />
        <path d="M478 116 A24 24 0 1 1 456 148" stroke="#1DB954" stroke-width="7" stroke-linecap="round" />
        <rect x="452" y="180" width="52" height="8" rx="4" fill="#1C1A17" />

        <rect x="76" y="110" width="164" height="106" rx="12" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2.5" />
        <circle cx="106" cy="142" r="14" fill="rgba(29, 185, 84, 0.15)" />
        <path d="M100 142 L104 146 L113 137" stroke="#1DB954" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
        <rect x="130" y="134" width="84" height="10" rx="4" fill="#1C1A17" />
        <rect x="130" y="150" width="60" height="8" rx="4" fill="#727272" />
        <rect x="92" y="176" width="132" height="22" rx="6" fill="rgba(29, 185, 84, 0.15)" />
        <rect x="114" y="184" width="88" height="6" rx="3" fill="#1DB954" />

        <path d="M615 248 L607 204 H649 L641 248 Z" fill="#1DB954" stroke="#1C1A17" stroke-width="2.5" />
        <path d="M628 204 C628 175 602 165 604 144 C622 146 628 168 628 204 Z" fill="#1DB954" stroke="#1C1A17" stroke-width="2" />
        <path d="M628 204 C628 170 656 158 654 136 C636 140 628 164 628 204 Z" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="2" />
      </svg>
    </div>
  </div>
</section>

<!-- 2. Statistik 4 Kolom Bersih -->
<section style="background-color: var(--permukaan); border-bottom: 1px solid var(--garis); padding: var(--spasi-32) 0;">
  <div class="wadah">
    <div class="stat-grid">
      <div class="stat-item">
        <div class="stat-angka" id="stat-kursus-nilai">8</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-top: var(--spasi-8); font-weight: 500;">
          Kursus Siap Kerja
        </div>
      </div>

      <div class="stat-item">
        <div class="stat-angka" id="stat-modul-nilai">31</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-top: var(--spasi-8); font-weight: 500;">
          Modul Terstruktur
        </div>
      </div>

      <div class="stat-item">
        <div class="stat-angka" id="stat-sertifikat-nilai">842</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-top: var(--spasi-8); font-weight: 500;">
          Sertifikat Diterbitkan
        </div>
      </div>

      <div class="stat-item">
        <div class="stat-angka" style="color: var(--aksen);">Rp 0</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-top: var(--spasi-8); font-weight: 500;">
          Biaya Pendaftaran
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 3. Seksi Misi Sosial SDG 1 -->
<section class="s4l-seksi" style="background-color: var(--latar);">
  <div class="wadah">
    <div class="split-grid">
      <div style="display: flex; justify-content: center;">
        <svg viewBox="0 0 420 320" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; max-width: 400px; height: auto;">
          <rect x="24" y="24" width="372" height="272" rx="24" fill="rgba(29, 185, 84, 0.15)" />
          <rect x="74" y="54" width="272" height="196" rx="14" fill="#FFFFFF" stroke="#1C1A17" stroke-width="3" />
          <rect x="102" y="84" width="110" height="12" rx="4" fill="#1DB954" />
          <rect x="102" y="112" width="216" height="16" rx="4" fill="#1C1A17" />
          <rect x="102" y="140" width="180" height="10" rx="4" fill="#727272" opacity="0.6" />
          <rect x="102" y="158" width="150" height="10" rx="4" fill="#727272" opacity="0.6" />
          <circle cx="286" cy="196" r="28" fill="rgba(29, 185, 84, 0.15)" stroke="#1DB954" stroke-width="3" />
          <path d="M275 196 L283 204 L298 189" stroke="#1DB954" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
          <rect x="102" y="190" width="96" height="32" rx="16" fill="#1C1A17" />
          <text x="150" y="211" text-anchor="middle" fill="#FFFFFF" font-family="Plus Jakarta Sans, sans-serif" font-weight="700" font-size="11">GRATIS 100%</text>
        </svg>
      </div>

      <div>
        <h2 class="s4l-judul-seksi" style="margin-bottom: var(--spasi-20); color: var(--teks);">
          Pendidikan Kerja <span class="sorotan-garis">Gratis</span> untuk Semua
        </h2>
        <p class="s4l-deskripsi" style="margin-bottom: var(--spasi-16);">
          Salah satu penghalang utama pencari kerja berpenghasilan rendah adalah tingginya biaya kursus keahlian komputer dan sertifikasi resmi.
        </p>
        <p class="s4l-deskripsi">
          Skill4Life hadir sebagai fasilitas terbuka tanpa skema bayar di awal, langganan bulanan, maupun biaya tebus sertifikat di akhir. Siapa pun berhak menguasai keterampilan kerja yang layak.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- 4. Bento Grid Kategori & Keunggulan -->
<section class="s4l-seksi" style="background-color: var(--permukaan);">
  <div class="wadah">
    <!-- Kartu utama full width -->
    <div class="bento-kartu-utama" style="margin-bottom: var(--spasi-24);">
      <div>
        <h2 class="s4l-judul-seksi" style="color: #181818; margin-bottom: var(--spasi-12); max-width: 640px;">
          Bidang <span class="sorotan-garis" style="border-color: #1DB954; color: #1DB954;">Keahlian</span> Siap Pakai
        </h2>
        <p style="font-size: var(--teks-14); color: #5C5750; line-height: var(--jarak-baris-baca); max-width: 680px; margin-bottom: 0;">
          Pilih jalur belajar praktis yang disusun langsung untuk kebutuhan administrasi perkantoran dan seleksi kerja.
        </p>
      </div>
      <a href="<?= $baseUrl ?>/kursus/katalog.php" style="background-color: #1DB954; color: #FFFFFF; padding: 12px 24px; border-radius: 999px; font-size: var(--teks-14); font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; white-space: nowrap; flex-shrink: 0;">
        <span>Lihat Semua Kategori</span>
        <i data-lucide="chevron-right" style="width: 16px; height: 16px;"></i>
      </a>
    </div>
    <!-- 3 kartu kategori sejajar di bawah kartu utama -->
    <div class="bento-kategori" id="kategori-bento-grid">
    </div>
  </div>
</section>

<!-- 5. Seksi Gelap: Kursus Pilihan -->
<section class="s4l-seksi" style="background-color: #181818; color: #FFFFFF;">
  <div class="wadah">
    <div style="text-align: center; margin-bottom: var(--spasi-48);">
      <h2 class="s4l-judul-seksi" style="color: #FFFFFF; margin-bottom: var(--spasi-12);">
        Kursus <span class="sorotan-garis-terang">Pilihan</span>
      </h2>
      <p style="font-size: var(--teks-14); color: #B3B3B3; max-width: 500px; margin: 0 auto;">
        Materi paling banyak diselesaikan peserta untuk persiapan melamar kerja kantor dan administrasi.
      </p>
    </div>

    <div class="kursus-grid" id="kursus-unggulan-grid">
      <!-- Dimuat dinamis via JS -->
    </div>
  </div>
</section>

<!-- 6. Cara Kerja -->
<section class="s4l-seksi" style="background-color: var(--permukaan);">
  <div class="wadah">
    <div class="split-grid split-grid-balik">
      <div>
        <h2 class="s4l-judul-seksi" style="margin-bottom: var(--spasi-16); color: var(--teks);">
          Langkah Mudah Mulai <span class="sorotan-garis">Belajar</span>
        </h2>
        <p class="s4l-deskripsi" style="margin-bottom: var(--spasi-32);">
          Alur belajar mandiri yang dirancang ringkas dari pemilihan materi hingga penerbitan sertifikat terverifikasi.
        </p>

        <div style="display: flex; flex-direction: column; gap: var(--spasi-20);">
          <div style="display: flex; align-items: flex-start; gap: var(--spasi-16);">
            <div style="width: 28px; height: 28px; border-radius: 999px; background-color: var(--aksen-tipis); color: var(--aksen); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
              <i data-lucide="check" style="width: 16px; height: 16px;"></i>
            </div>
            <div>
              <div style="font-family: var(--font-judul); font-size: var(--teks-16); font-weight: 700; color: var(--teks); margin-bottom: 4px;">
                1. Pilih Kursus Tanpa Syarat
              </div>
              <div class="s4l-deskripsi">
                Tentukan materi keterampilan kerja yang sesuai kebutuhan Anda saat ini dan langsung akses modulnya.
              </div>
            </div>
          </div>

          <div style="display: flex; align-items: flex-start; gap: var(--spasi-16);">
            <div style="width: 28px; height: 28px; border-radius: 999px; background-color: var(--aksen-tipis); color: var(--aksen); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
              <i data-lucide="check" style="width: 16px; height: 16px;"></i>
            </div>
            <div>
              <div style="font-family: var(--font-judul); font-size: var(--teks-16); font-weight: 700; color: var(--teks); margin-bottom: 4px;">
                2. Pelajari Modul Terstruktur
              </div>
              <div class="s4l-deskripsi">
                Ikuti bacaan ringkas dan video panduan langkah demi langkah. Tandai modul selesai setelah memahaminya.
              </div>
            </div>
          </div>

          <div style="display: flex; align-items: flex-start; gap: var(--spasi-16);">
            <div style="width: 28px; height: 28px; border-radius: 999px; background-color: var(--aksen-tipis); color: var(--aksen); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
              <i data-lucide="check" style="width: 16px; height: 16px;"></i>
            </div>
            <div>
              <div style="font-family: var(--font-judul); font-size: var(--teks-16); font-weight: 700; color: var(--teks); margin-bottom: 4px;">
                3. Lulus Kuis & Terbitkan Sertifikat
              </div>
              <div class="s4l-deskripsi">
                Selesaikan kuis akhir dengan skor minimal 70 untuk mendapatkan sertifikat dengan nomor verifikasi resmi.
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="split-media" style="display: flex; justify-content: center;">
        <svg viewBox="0 0 420 320" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; max-width: 420px; height: auto;">
          <circle cx="220" cy="160" r="132" fill="rgba(29, 185, 84, 0.15)" />

          <rect x="48" y="76" width="168" height="44" rx="10" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2.5" />
          <circle cx="74" cy="98" r="10" fill="#1DB954" />
          <path d="M70 98L73 101L79 95" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <rect x="94" y="93" width="96" height="10" rx="5" fill="#1C1A17" />

          <rect x="48" y="134" width="168" height="44" rx="10" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2.5" />
          <circle cx="74" cy="156" r="10" fill="#1DB954" />
          <path d="M70 156L73 159L79 153" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <rect x="94" y="151" width="84" height="10" rx="5" fill="#1C1A17" />

          <rect x="48" y="192" width="168" height="44" rx="10" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2.5" />
          <circle cx="74" cy="214" r="10" fill="#1DB954" />
          <path d="M70 214L73 217L79 211" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <rect x="94" y="209" width="102" height="10" rx="5" fill="#1DB954" />

          <rect x="196" y="54" width="176" height="212" rx="14" fill="#FFFFFF" stroke="#1C1A17" stroke-width="3" />
          <rect x="220" y="80" width="76" height="10" rx="5" fill="#1DB954" />
          <rect x="220" y="102" width="128" height="14" rx="4" fill="#1C1A17" />
          <rect x="220" y="126" width="108" height="8" rx="4" fill="#727272" opacity="0.6" />
          <rect x="220" y="142" width="92" height="8" rx="4" fill="#727272" opacity="0.6" />

          <path d="M272 212L264 246L284 236L304 246L296 212" fill="#1DB954" stroke="#1C1A17" stroke-width="2" stroke-linejoin="round" />
          <circle cx="284" cy="196" r="24" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="2.5" />
          <path d="M275 196L281 202L294 190" stroke="#1DB954" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
    </div>
  </div>
</section>

<!-- 7. Banner Ajakan Bawah -->
<section style="background-color: var(--permukaan); padding: 0 0 var(--spasi-80);">
  <div class="wadah">
    <div class="cta-kartu">
      <div style="display: flex; justify-content: center;">
        <svg viewBox="0 0 320 230" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; max-width: 300px; height: auto;">
          <rect x="44" y="24" width="232" height="164" rx="14" fill="#FFFFFF" stroke="#1C1A17" stroke-width="3" />
          <rect x="44" y="24" width="232" height="30" rx="12" fill="#1C1A17" />
          <circle cx="64" cy="39" r="4.5" fill="#1DB954" />
          <circle cx="78" cy="39" r="4.5" fill="rgba(29, 185, 84, 0.15)" />
          <circle cx="92" cy="39" r="4.5" fill="#727272" />

          <rect x="66" y="72" width="84" height="94" rx="10" fill="#121212" stroke="#1C1A17" stroke-width="2" />
          <circle cx="108" cy="102" r="16" fill="rgba(29, 185, 84, 0.15)" stroke="#1DB954" stroke-width="2" />
          <path d="M88 142C88 131 97 124 108 124C119 124 128 131 128 142" stroke="#1C1A17" stroke-width="2.5" stroke-linecap="round" />

          <rect x="166" y="76" width="88" height="12" rx="4" fill="#1C1A17" />
          <rect x="166" y="98" width="72" height="8" rx="4" fill="#727272" opacity="0.6" />
          <rect x="166" y="114" width="80" height="8" rx="4" fill="#727272" opacity="0.6" />
          <rect x="166" y="136" width="88" height="28" rx="14" fill="#1DB954" />
          <rect x="184" y="147" width="52" height="6" rx="3" fill="#FFFFFF" />

          <rect x="24" y="188" width="272" height="12" rx="6" fill="#1C1A17" />
        </svg>
      </div>
      <div>
        <h2 class="s4l-judul-seksi" style="margin-bottom: var(--spasi-12); color: var(--teks);">
          Siap Memulai <span class="sorotan-garis">Belajar?</span>
        </h2>
        <p class="s4l-deskripsi" style="margin-bottom: var(--spasi-24); max-width: 440px;">
          Buat akun gratis dalam hitungan detik, simpan progres belajar Anda, dan raih sertifikat keterampilan kerja pertama Anda hari ini.
        </p>
        <a href="<?= $baseUrl ?>/auth/daftar.php" style="background-color: var(--teks); color: var(--permukaan); padding: 14px 28px; border-radius: 999px; font-size: var(--teks-14); font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
          <span>Daftar Sekarang</span>
          <i data-lucide="arrow-up-right" style="width: 16px; height: 16px;"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<script type="module">
  import {
    ambilStatistik,
    ambilKategori,
    ambilDaftarKursus
  } from './assets/js/api.js';

  const ikonKategori = ['file-spreadsheet', 'briefcase', 'calculator', 'award', 'book-open'];

  const ilustrasiKursus = [
    `<svg viewBox="0 0 240 130" fill="none" xmlns="http://www.w3.org/2000/svg" style="height: 125px; width: auto; max-width: 100%;">
      <rect x="24" y="14" width="192" height="102" rx="10" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2.5"/>
      <rect x="24" y="14" width="192" height="24" rx="8" fill="#1DB954"/>
      <line x1="88" y1="38" x2="88" y2="116" stroke="#1C1A17" stroke-width="1.5" stroke-opacity="0.2"/>
      <line x1="152" y1="38" x2="152" y2="116" stroke="#1C1A17" stroke-width="1.5" stroke-opacity="0.2"/>
      <line x1="24" y1="64" x2="216" y2="64" stroke="#1C1A17" stroke-width="1.5" stroke-opacity="0.2"/>
      <line x1="24" y1="90" x2="216" y2="90" stroke="#1C1A17" stroke-width="1.5" stroke-opacity="0.2"/>
      <rect x="36" y="47" width="40" height="8" rx="4" fill="#1C1A17"/>
      <rect x="100" y="47" width="36" height="8" rx="4" fill="#1DB954"/>
      <rect x="36" y="73" width="32" height="8" rx="4" fill="#727272"/>
      <rect x="164" y="73" width="38" height="8" rx="4" fill="#1DB954"/>
      <rect x="100" y="99" width="42" height="8" rx="4" fill="#1C1A17"/>
    </svg>`,

    `<svg viewBox="0 0 240 130" fill="none" xmlns="http://www.w3.org/2000/svg" style="height: 125px; width: auto; max-width: 100%;">
      <rect x="24" y="14" width="192" height="102" rx="10" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2.5"/>
      <rect x="42" y="30" width="64" height="10" rx="5" fill="#1C1A17"/>
      <rect x="42" y="46" width="44" height="7" rx="3.5" fill="#727272"/>
      <rect x="46" y="82" width="18" height="20" rx="4" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="2"/>
      <rect x="74" y="68" width="18" height="34" rx="4" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="2"/>
      <rect x="102" y="54" width="18" height="48" rx="4" fill="#1DB954" stroke="#1C1A17" stroke-width="2"/>
      <rect x="138" y="32" width="60" height="32" rx="8" fill="rgba(29, 185, 84, 0.15)"/>
      <circle cx="154" cy="48" r="7" fill="#1DB954"/>
      <rect x="167" y="44" width="22" height="8" rx="4" fill="#1C1A17"/>
      <rect x="138" y="72" width="60" height="30" rx="8" fill="#121212" stroke="#1C1A17" stroke-width="1.5"/>
      <path d="M148 91L160 82L171 87L186 77" stroke="#1DB954" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>`,

    `<svg viewBox="0 0 240 130" fill="none" xmlns="http://www.w3.org/2000/svg" style="height: 125px; width: auto; max-width: 100%;">
      <rect x="56" y="12" width="128" height="106" rx="10" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2.5"/>
      <rect x="74" y="28" width="52" height="10" rx="4" fill="#1DB954"/>
      <line x1="74" y1="48" x2="166" y2="48" stroke="#1C1A17" stroke-width="2"/>
      <rect x="74" y="58" width="92" height="7" rx="3.5" fill="#727272" opacity="0.7"/>
      <rect x="74" y="71" width="84" height="7" rx="3.5" fill="#727272" opacity="0.7"/>
      <rect x="74" y="84" width="64" height="7" rx="3.5" fill="#727272" opacity="0.7"/>
      <circle cx="152" cy="96" r="13" fill="rgba(29, 185, 84, 0.15)" stroke="#1DB954" stroke-width="2"/>
      <path d="M147 96L150.5 99.5L157.5 92.5" stroke="#1DB954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>`
  ];

  async function muatHalamanBeranda() {
    const stat = await ambilStatistik();
    const elKursus = document.getElementById('stat-kursus-nilai');
    const elModul = document.getElementById('stat-modul-nilai');
    const elSert = document.getElementById('stat-sertifikat-nilai');
    if (elKursus) elKursus.textContent = stat.total_kursus;
    if (elModul) elModul.textContent = stat.total_modul;
    if (elSert) elSert.textContent = stat.total_sertifikat;

    let katList = await ambilKategori();
    if (!katList || katList.length === 0) {
      katList = [
        { nama: 'Aplikasi perkantoran', slug: 'aplikasi-perkantoran', deskripsi: 'Pengolahan lembar kerja, penyusunan naskah dinas, dan pembuatan materi presentasi kerja.', jumlah_kursus: 4 },
        { nama: 'Kesiapan karir dan kerja', slug: 'kesiapan-karir', deskripsi: 'Format berkas lamaran kerja terstandar ATS dan persiapan komunikasi menghadapi wawancara seleksi.', jumlah_kursus: 2 },
        { nama: 'Kewirausahaan dan literasi keuangan', slug: 'kewirausahaan', deskripsi: 'Pengelolaan arus kas pribadi bebas jeratan utang serta panduan memulai usaha kecil modal minim.', jumlah_kursus: 2 },
      ];
    }
    const bentoGrid = document.getElementById('kategori-bento-grid');
    if (bentoGrid && katList.length > 0) {
      const kartuKategoriHTML = katList.map((k, idx) => {
        const namaIkon = ikonKategori[idx % ikonKategori.length];
        return `
          <div class="bento-kartu-item">
            <div>
              <div class="ikon-lingkaran">
                <i data-lucide="${namaIkon}" style="width: 22px; height: 22px;"></i>
              </div>
              <h3 style="font-family: var(--font-judul); font-size: var(--teks-20); font-weight: 700; color: var(--teks); margin-bottom: var(--spasi-8);">
                <a href="./kursus/katalog.php?kategori=${k.slug}" style="text-decoration: none; color: inherit;">${k.nama}</a>
              </h3>
              <p class="s4l-deskripsi" style="margin-bottom: var(--spasi-20);">
                ${k.deskripsi}
              </p>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: var(--spasi-12); border-top: 1px solid var(--garis); font-size: var(--teks-12); font-weight: 600;">
              <span style="color: var(--teks-3);">${k.jumlah_kursus} Kursus</span>
              <a href="./kursus/katalog.php?kategori=${k.slug}" style="color: var(--aksen); text-decoration: none;">Buka &rarr;</a>
            </div>
          </div>
        `;
      }).join('');

      bentoGrid.insertAdjacentHTML('beforeend', kartuKategoriHTML);
    }

    const kursusList = await ambilDaftarKursus();
    const unggulanGrid = document.getElementById('kursus-unggulan-grid');
    if (unggulanGrid && kursusList.length > 0) {
      const daftarTampil = kursusList.slice(0, 3);
      unggulanGrid.innerHTML = daftarTampil.map((kursus, idx) => {
        const gambar = ilustrasiKursus[idx % ilustrasiKursus.length];
        const tombolUtama = idx === 1;
        return `
          <div style="background-color: var(--permukaan); color: var(--teks); border-radius: var(--radius-kartu); padding: var(--spasi-24); display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <div style="background-color: var(--latar); border-radius: var(--radius-dalam); padding: var(--spasi-16); display: flex; justify-content: center; align-items: center; height: 170px; margin-bottom: var(--spasi-20);">
                ${gambar}
              </div>

              <div style="display: flex; justify-content: space-between; align-items: center; font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-8); font-weight: 500;">
                <span>${kursus.jumlah_modul} Modul</span>
                <span>${kursus.estimasi_waktu}</span>
              </div>

              <h3 style="font-family: var(--font-judul); font-size: var(--teks-20); font-weight: 700; line-height: 1.3; margin-bottom: var(--spasi-8);">
                <a href="./kursus/detail.php?slug=${kursus.slug}" style="text-decoration: none; color: inherit;">${kursus.judul}</a>
              </h3>

              <p class="s4l-deskripsi" style="margin-bottom: var(--spasi-20);">
                ${kursus.ringkasan || kursus.deskripsi}
              </p>
            </div>

            <div>
              <a
                href="./kursus/detail.php?slug=${kursus.slug}"
                style="display: inline-block; padding: 10px 20px; border-radius: 999px; font-size: var(--teks-12); font-weight: 600; text-decoration: none; ${tombolUtama ? 'background-color: var(--aksen); color: var(--permukaan);' : 'border: 1px solid var(--garis-tegas); color: var(--teks); background-color: transparent;'}"
              >
                Lihat Kursus
              </a>
            </div>
          </div>
        `;
      }).join('');
    }

    if (window.lucide) {
      window.lucide.createIcons();
    }
  }

  document.addEventListener('DOMContentLoaded', muatHalamanBeranda);
</script>