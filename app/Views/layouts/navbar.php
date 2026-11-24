<?php
$berkasAktif = basename($_SERVER['PHP_SELF']);
$sedangDiKursus = strpos($_SERVER['PHP_SELF'], 'katalog') !== false || strpos($_SERVER['PHP_SELF'], 'detail') !== false;
$sedangDiVerifikasi = strpos($_SERVER['PHP_SELF'], 'verifikasi') !== false;
$sedangDiProfil = strpos($_SERVER['PHP_SELF'], 'profil') !== false;
$sedangDiDashboard = strpos($_SERVER['PHP_SELF'], 'dashboard') !== false && !$sedangDiProfil;
?>

<style>
  .nav-utama {
    position: sticky;
    top: 0;
    z-index: 100;
    background-color: var(--permukaan);
    border-bottom: 1px solid var(--garis);
    font-family: var(--font-ui);
  }

  .nav-utama .wadah {
    padding-left: var(--spasi-24);
    padding-right: var(--spasi-24);
  }

  .nav-baris {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 72px;
    gap: var(--spasi-24);
  }

  .logo-s4l {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-family: var(--font-judul);
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -0.025em;
    color: var(--teks);
    text-decoration: none;
    flex-shrink: 0;
  }

  .nav-tautan-grup {
    list-style: none;
    display: flex;
    align-items: center;
    height: 100%;
    gap: 8px;
    margin: 0;
    padding: 0;
  }

  /* Tinggi 100% agar area hover menyambung sampai ke panel mega-menu */
  .nav-item-induk {
    position: static;
    height: 100%;
    display: flex;
    align-items: center;
  }

  .nav-tautan {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 16px;
    border-radius: 999px;
    font-family: var(--font-judul);
    font-size: var(--teks-14);
    font-weight: 600;
    letter-spacing: -0.01em;
    color: var(--teks-2);
    text-decoration: none;
    transition: var(--transisi-cepat);
  }

  .nav-tautan:hover,
  .nav-item-induk:hover .nav-tautan,
  .nav-tautan.aktif {
    color: var(--teks);
    background-color: var(--latar);
  }

  .nav-tautan .ikon-panah {
    width: 14px;
    height: 14px;
    color: var(--teks-3);
    transition: transform 180ms ease, color 180ms ease;
  }

  .nav-item-induk:hover .ikon-panah {
    transform: rotate(180deg);
    color: var(--aksen);
  }

  /* Panel Mega-Menu */
  .mega-menu-panel {
    position: absolute;
    left: 0;
    right: 0;
    top: 100%;
    background-color: var(--permukaan);
    border-top: 1px solid var(--garis);
    border-bottom: 1.5px solid var(--teks);
    box-shadow: 0 24px 48px rgba(28, 26, 23, 0.10);
    opacity: 0;
    visibility: hidden;
    transform: translateY(4px);
    transition: opacity 160ms ease, transform 160ms ease, visibility 160ms ease;
    pointer-events: none;
  }

  /* Jembatan transparan agar kursor tidak kehilangan fokus saat bergerak ke bawah */
  .mega-menu-panel::before {
    content: "";
    position: absolute;
    top: -18px;
    left: 0;
    right: 0;
    height: 18px;
    background: transparent;
  }

  .nav-item-induk:hover .mega-menu-panel,
  .nav-item-induk:focus-within .mega-menu-panel {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
  }

  .mega-menu-isi {
    padding: var(--spasi-32) 0;
    display: grid;
    grid-template-columns: 1.25fr 1.15fr 1.2fr;
    gap: 0;
  }

  .mega-kolom-kiri {
    padding-right: var(--spasi-32);
  }

  .mega-kolom-tengah {
    padding: 0 var(--spasi-32);
    border-left: 1px solid var(--garis);
  }

  .mega-kolom-kanan {
    padding-left: var(--spasi-32);
    border-left: 1px solid var(--garis);
  }

  .mega-kolom-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: var(--spasi-16);
    padding-bottom: 10px;
    border-bottom: 1px dashed var(--garis-tegas);
  }

  .mega-kolom-label {
    font-family: var(--font-judul);
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--teks-3);
  }

  .mega-daftar-2kolom {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px 12px;
  }

  .mega-link-item {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 10px 12px;
    border-radius: 10px;
    text-decoration: none;
    color: var(--teks);
    font-family: var(--font-ui);
    font-size: 13.5px;
    font-weight: 500;
    line-height: 1.4;
    border: 1px solid transparent;
    transition: var(--transisi-cepat);
  }

  .mega-link-item:hover {
    background-color: var(--latar);
    border-color: var(--garis);
    color: var(--aksen);
  }

  .mega-svg-badge {
    width: 28px;
    height: 28px;
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-top: 1px;
  }

  .mega-link-semua {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: var(--spasi-20);
    padding: 8px 14px;
    border-radius: 999px;
    background-color: var(--latar);
    font-family: var(--font-judul);
    font-size: var(--teks-12);
    font-weight: 700;
    color: var(--teks);
    text-decoration: none;
    transition: var(--transisi-cepat);
  }

  .mega-link-semua:hover {
    background-color: var(--aksen);
    color: var(--permukaan);
  }

  /* Kartu Kursus Populer di Kanan Mega-Menu */
  .mega-kursus-grup {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--spasi-16);
  }

  .mega-kursus-kartu {
    background-color: var(--latar);
    border: 1.5px solid var(--garis-tegas);
    border-radius: 14px;
    padding: 14px;
    text-decoration: none;
    color: var(--teks);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 160ms ease, border-color 160ms ease, box-shadow 160ms ease;
  }

  .mega-kursus-kartu:hover {
    transform: translateY(-2px);
    border-color: var(--teks);
    box-shadow: 3px 3px 0px var(--teks);
    background-color: var(--permukaan);
  }

  .mega-kursus-thumb {
    position: relative;
    border-radius: 9px;
    height: 92px;
    overflow: hidden;
    margin-bottom: 12px;
    border: 1px solid var(--garis);
  }

  .mega-kursus-tag {
    position: absolute;
    top: 8px;
    left: 8px;
    font-family: var(--font-judul);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.03em;
    padding: 3px 9px;
    border-radius: 999px;
    background-color: var(--teks);
    color: var(--permukaan);
  }

  .mega-kursus-judul {
    font-family: var(--font-judul);
    font-size: 13.5px;
    font-weight: 700;
    line-height: 1.4;
    letter-spacing: -0.01em;
    color: var(--teks);
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .mega-kursus-meta {
    font-family: var(--font-ui);
    font-size: 11.5px;
    font-weight: 500;
    color: var(--teks-2);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 8px;
    border-top: 1px solid var(--garis);
  }

  /* Bilah Bawah Mega-Menu */
  .mega-menu-bawah {
    background-color: var(--latar);
    border-top: 1px solid var(--garis);
    padding: 16px 0;
  }

  .mega-bawah-baris {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--spasi-16);
    flex-wrap: wrap;
  }

  .nav-aksi {
    display: flex;
    align-items: center;
    gap: var(--spasi-12);
  }

  /* Sembunyikan tombol keluar bila disisipkan skrip sesi eksternal */
  #nav-aksi-sesi button,
  #nav-mobile-auth button {
    display: none !important;
  }

  /* Pill Profil Peserta (Langsung ke Pengaturan Profil) */
  .nav-profil-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    height: 38px;
    padding: 0 15px;
    border-radius: 999px;
    background-color: rgba(29, 185, 84, 0.15);
    border: 1px solid rgba(29, 185, 84, 0.3);
    color: #1DB954 !important;
    font-family: var(--font-judul);
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 140ms ease, border-color 140ms ease;
  }

  .nav-profil-pill:hover,
  .nav-profil-pill.aktif {
    background-color: rgba(29, 185, 84, 0.25);
    border-color: #1DB954;
    color: #1ED760 !important;
  }

  .tautan-masuk {
    font-family: var(--font-judul);
    font-size: var(--teks-14);
    font-weight: 600;
    color: var(--teks);
    text-decoration: none;
    padding: 8px 14px;
    border-radius: 999px;
    transition: var(--transisi-cepat);
  }

  .tautan-masuk:hover {
    background-color: var(--latar);
    color: var(--aksen);
  }

  .nav-mobile-toggle {
    display: none;
    background: var(--permukaan);
    border: 1.5px solid var(--teks);
    border-radius: 10px;
    padding: 8px;
    color: var(--teks);
    cursor: pointer;
  }

  .nav-mobile-drawer {
    display: none;
    background-color: var(--permukaan);
    border-top: 1px solid var(--garis);
    padding: var(--spasi-24);
  }

  .nav-mobile-drawer.terbuka {
    display: block;
  }

  .mobile-sub-kategori {
    margin-top: var(--spasi-12);
    padding-left: var(--spasi-16);
    border-left: 2px solid var(--aksen);
    display: flex;
    flex-direction: column;
    gap: var(--spasi-8);
  }

  .mobile-sub-kategori a {
    font-size: 13px;
    color: var(--teks-2);
    text-decoration: none;
  }

  @media (max-width: 960px) {
    .nav-tautan-grup,
    .nav-aksi {
      display: none;
    }

    .nav-mobile-toggle {
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
  }
</style>

<header class="nav-utama">
  <div class="wadah nav-baris">
    <!-- Logo dengan Emblem Segel Kertas -->
    <a href="<?= $baseUrl ?>/index.php" class="logo-s4l" aria-label="Beranda Skill4Life">
      <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="2" y="2" width="28" height="28" rx="9" fill="#1DB954" stroke="#1C1A17" stroke-width="2"/>
        <path d="M9.5 16.5L13.8 20.5L22.5 11.5" stroke="#121212" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="24.5" cy="7.5" r="2.5" fill="#F3C669"/>
      </svg>
      <span>Skill4Life</span>
    </a>

    <!-- Navigasi Utama -->
    <nav aria-label="Navigasi situs" style="height: 100%;">
      <ul class="nav-tautan-grup">
        <li class="nav-item-induk">
          <a href="<?= $baseUrl ?>/kursus/katalog.php" class="nav-tautan <?= $sedangDiKursus ? 'aktif' : '' ?>">
            <span>Katalog kursus</span>
            <i data-lucide="chevron-down" class="ikon-panah"></i>
          </a>

          <!-- Mega-Menu -->
          <div class="mega-menu-panel">
            <div class="wadah">
              <div class="mega-menu-isi">
                <!-- Kolom 1: Kategori Kursus -->
                <div class="mega-kolom-kiri">
                  <div class="mega-kolom-header">
                    <span class="mega-kolom-label">Kategori Kursus</span>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 1L9.6 6.4L15 8L9.6 9.6L8 15L6.4 9.6L1 8L6.4 6.4L8 1Z" fill="#E8A838"/></svg>
                  </div>

                  <div class="mega-daftar-2kolom" id="mega-kategori-list">
                    <a href="<?= $baseUrl ?>/kursus/katalog.php?kategori=aplikasi-perkantoran" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><rect x="3" y="3" width="22" height="22" rx="6" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="1.6"/><rect x="3" y="3" width="22" height="7" rx="5" fill="#1DB954"/><line x1="11" y1="10" x2="11" y2="25" stroke="#1C1A17" stroke-width="1.4"/><line x1="3" y1="17" x2="25" y2="17" stroke="#1C1A17" stroke-width="1.4"/></svg>
                      </span>
                      <span>Aplikasi Perkantoran</span>
                    </a>

                    <a href="<?= $baseUrl ?>/kursus/katalog.php?kategori=kesiapan-karir" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><rect x="3" y="8" width="22" height="16" rx="5" fill="#FBE8C8" stroke="#1C1A17" stroke-width="1.6"/><path d="M10 8V6C10 4.9 10.9 4 12 4H16C17.1 4 18 4.9 18 6V8" stroke="#1C1A17" stroke-width="1.6"/><circle cx="14" cy="16" r="2.5" fill="#1DB954"/></svg>
                      </span>
                      <span>Kesiapan Karir</span>
                    </a>

                    <a href="<?= $baseUrl ?>/kursus/katalog.php?kategori=administrasi-dokumen" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><rect x="5" y="3" width="18" height="22" rx="4" fill="#FFFFFF" stroke="#1C1A17" stroke-width="1.6"/><line x1="9" y1="9" x2="19" y2="9" stroke="#1DB954" stroke-width="2" stroke-linecap="round"/><line x1="9" y1="14" x2="19" y2="14" stroke="#727272" stroke-width="1.6" stroke-linecap="round"/><circle cx="18" cy="20" r="3.5" fill="#E8A838" stroke="#1C1A17" stroke-width="1.2"/></svg>
                      </span>
                      <span>Surat & Dokumen</span>
                    </a>

                    <a href="<?= $baseUrl ?>/kursus/katalog.php?kategori=keuangan-usaha" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><rect x="4" y="3" width="20" height="22" rx="5" fill="#242424" stroke="#1C1A17" stroke-width="1.6"/><rect x="8" y="7" width="12" height="5" rx="1.5" fill="#1DB954"/><circle cx="9.5" cy="16" r="1.5" fill="#1C1A17"/><circle cx="14" cy="16" r="1.5" fill="#1C1A17"/><circle cx="18.5" cy="16" r="1.5" fill="#E8A838"/><circle cx="9.5" cy="20.5" r="1.5" fill="#1C1A17"/><circle cx="14" cy="20.5" r="1.5" fill="#1C1A17"/><circle cx="18.5" cy="20.5" r="1.5" fill="#1DB954"/></svg>
                      </span>
                      <span>Keuangan Usaha</span>
                    </a>
                  </div>

                  <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-link-semua">
                    <span>Lihat Semua Kategori</span>
                    <i data-lucide="arrow-up-right" style="width: 14px; height: 14px;"></i>
                  </a>
                </div>

                <!-- Kolom 2: Jalur Siap Kerja -->
                <div class="mega-kolom-tengah">
                  <div class="mega-kolom-header">
                    <span class="mega-kolom-label">Jalur Siap Kerja</span>
                  </div>

                  <div class="mega-daftar-2kolom">
                    <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><rect x="3" y="4" width="20" height="18" rx="4" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="1.5"/><path d="M8 17V13M13 17V9M18 17V11" stroke="#1DB954" stroke-width="2.2" stroke-linecap="round"/></svg>
                      </span>
                      <span>Operator Excel</span>
                    </a>

                    <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><path d="M3 8C3 6.3 4.3 5 6 5H10.5L12.5 7.5H20C21.7 7.5 23 8.8 23 10.5V18C23 19.7 21.7 21 20 21H6C4.3 21 3 19.7 3 18V8Z" fill="#FBE8C8" stroke="#1C1A17" stroke-width="1.5"/><path d="M10 14.5L12.2 16.5L16.5 12" stroke="#1DB954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                      </span>
                      <span>Staf Administrasi</span>
                    </a>

                    <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><circle cx="13" cy="13" r="10" fill="#FFFFFF" stroke="#1C1A17" stroke-width="1.5"/><circle cx="13" cy="10" r="3" fill="#1DB954"/><path d="M8 19C8 16.5 10.2 15 13 15C15.8 15 18 16.5 18 19" stroke="#1C1A17" stroke-width="1.6" stroke-linecap="round"/></svg>
                      </span>
                      <span>Pelamar Kerja Baru</span>
                    </a>

                    <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><path d="M4 10L6 5H20L22 10H4Z" fill="#1DB954" stroke="#1C1A17" stroke-width="1.5" stroke-linejoin="round"/><rect x="5" y="10" width="16" height="11" rx="2" fill="#121212" stroke="#1C1A17" stroke-width="1.5"/><rect x="10.5" y="14" width="5" height="7" fill="#E8A838"/></svg>
                      </span>
                      <span>Pelaku UMKM</span>
                    </a>

                    <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><rect x="3" y="6" width="20" height="14" rx="3.5" fill="#FFFFFF" stroke="#1C1A17" stroke-width="1.5"/><path d="M4 8L13 14.5L22 8" stroke="#1DB954" stroke-width="1.8" stroke-linecap="round"/></svg>
                      </span>
                      <span>Korespondensi</span>
                    </a>

                    <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-link-item">
                      <span class="mega-svg-badge">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><circle cx="13" cy="13" r="9.5" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="1.5"/><path d="M13 3.5V13H22.5" stroke="#1C1A17" stroke-width="1.5"/><path d="M13 13L19.5 6.5" stroke="#E8A838" stroke-width="2"/></svg>
                      </span>
                      <span>Olah Data Laporan</span>
                    </a>
                  </div>

                  <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-link-semua">
                    <span>Jelajahi Semua Jalur</span>
                    <i data-lucide="arrow-up-right" style="width: 14px; height: 14px;"></i>
                  </a>
                </div>

                <!-- Kolom 3: Kursus Populer -->
                <div class="mega-kolom-kanan">
                  <div class="mega-kolom-header">
                    <span class="mega-kolom-label">Kursus Populer</span>
                    <span style="font-family: var(--font-judul); font-size: 11.5px; font-weight: 700; color: var(--aksen);">Gratis Bersertifikat</span>
                  </div>

                  <div class="mega-kursus-grup" id="mega-kursus-populer">
                    <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-kursus-kartu">
                      <div>
                        <div class="mega-kursus-thumb" style="background-color: rgba(29, 185, 84, 0.15);">
                          <span class="mega-kursus-tag">POPULER</span>
                          <svg viewBox="0 0 200 92" fill="none" style="width: 100%; height: 100%;">
                            <rect x="28" y="18" width="144" height="64" rx="7" fill="#FFFFFF" stroke="#1C1A17" stroke-width="1.8"/>
                            <rect x="28" y="18" width="144" height="16" rx="6" fill="#1DB954"/>
                            <text x="38" y="29" fill="#FFFFFF" font-family="IBM Plex Mono, monospace" font-size="8" font-weight="600">=SUM(B2:B8)</text>
                            <line x1="76" y1="34" x2="76" y2="82" stroke="#1C1A17" stroke-opacity="0.15"/>
                            <line x1="124" y1="34" x2="124" y2="82" stroke="#1C1A17" stroke-opacity="0.15"/>
                            <line x1="28" y1="50" x2="172" y2="50" stroke="#1C1A17" stroke-opacity="0.15"/>
                            <line x1="28" y1="66" x2="172" y2="66" stroke="#1C1A17" stroke-opacity="0.15"/>
                            <rect x="84" y="39" width="32" height="6" rx="3" fill="#E8A838"/>
                            <rect x="132" y="55" width="30" height="6" rx="3" fill="#1DB954"/>
                          </svg>
                        </div>
                        <div class="mega-kursus-judul">Microsoft Excel Dasar: Olah Data & Rumus</div>
                      </div>
                      <div class="mega-kursus-meta">
                        <span>4 Modul</span>
                        <span style="color: var(--aksen); font-weight: 700;">2.5 Jam</span>
                      </div>
                    </a>

                    <a href="<?= $baseUrl ?>/kursus/katalog.php" class="mega-kursus-kartu">
                      <div>
                        <div class="mega-kursus-thumb" style="background-color: #FBE8C8;">
                          <span class="mega-kursus-tag" style="background-color: #1DB954;">BARU</span>
                          <svg viewBox="0 0 200 92" fill="none" style="width: 100%; height: 100%;">
                            <rect x="44" y="14" width="112" height="72" rx="7" fill="#FFFFFF" stroke="#1C1A17" stroke-width="1.8"/>
                            <rect x="56" y="24" width="44" height="7" rx="3" fill="#1DB954"/>
                            <rect x="56" y="37" width="88" height="5" rx="2.5" fill="#727272" opacity="0.5"/>
                            <rect x="56" y="46" width="76" height="5" rx="2.5" fill="#727272" opacity="0.5"/>
                            <rect x="56" y="55" width="60" height="5" rx="2.5" fill="#727272" opacity="0.5"/>
                            <circle cx="134" cy="67" r="11" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="1.5"/>
                            <path d="M130 67L133 70L139 64" stroke="#1DB954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                        </div>
                        <div class="mega-kursus-judul">Microsoft Word untuk Surat & Dokumen Resmi</div>
                      </div>
                      <div class="mega-kursus-meta">
                        <span>4 Modul</span>
                        <span style="color: var(--aksen); font-weight: 700;">2 Jam</span>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bilah Bawah Mega-Menu -->
            <div class="mega-menu-bawah">
              <div class="wadah mega-bawah-baris">
                <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                  <a href="<?= $baseUrl ?>/auth/daftar.php" class="tombol tombol-utama tombol-kecil" style="border-radius: 999px; display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px;">
                    <span>Mulai Belajar Gratis</span>
                  </a>
                  <span style="font-size: 13px; line-height: 1.5; color: var(--teks-2);">
                    Seluruh modul pelatihan dan sertifikat resmi terbuka gratis tanpa syarat.
                  </span>
                </div>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item-induk">
          <a href="<?= $baseUrl ?>/sertifikat/verifikasi.php" class="nav-tautan <?= $sedangDiVerifikasi ? 'aktif' : '' ?>">
            Verifikasi sertifikat
          </a>
        </li>

        <li class="nav-item-induk">
          <a href="<?= $baseUrl ?>/dashboard/index.php" class="nav-tautan <?= $sedangDiDashboard ? 'aktif' : '' ?>">
            Dashboard belajar
          </a>
        </li>
      </ul>
    </nav>

    <!-- Tombol Sesi -->
    <div style="display: flex; align-items: center; gap: var(--spasi-12);">
      <div class="nav-aksi" id="nav-aksi-sesi">
        <a href="<?= $baseUrl ?>/auth/login.php" class="tautan-masuk">Masuk</a>
        <a href="<?= $baseUrl ?>/auth/daftar.php" class="tombol tombol-utama tombol-kecil" style="border-radius: 999px; padding: 9px 18px;">Daftar</a>
      </div>

      <button type="button" class="nav-mobile-toggle" id="btn-nav-mobile" aria-label="Buka menu navigasi">
        <i data-lucide="menu" style="width: 18px; height: 18px;"></i>
      </button>
    </div>
  </div>

  <!-- Drawer Mobile -->
  <div class="nav-mobile-drawer" id="nav-mobile-drawer">
    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: var(--spasi-12); font-size: var(--teks-14);">
      <li><a href="<?= $baseUrl ?>/index.php" style="text-decoration: none; color: var(--teks); font-weight: 600;">Beranda</a></li>
      <li>
        <a href="<?= $baseUrl ?>/kursus/katalog.php" style="text-decoration: none; color: var(--teks); font-weight: 600;">Katalog kursus</a>
        <div class="mobile-sub-kategori" id="mobile-kategori-list">
          <a href="<?= $baseUrl ?>/kursus/katalog.php">Semua Katalog</a>
        </div>
      </li>
      <li><a href="<?= $baseUrl ?>/sertifikat/verifikasi.php" style="text-decoration: none; color: var(--teks); font-weight: 600;">Verifikasi sertifikat</a></li>
      <li><a href="<?= $baseUrl ?>/dashboard/index.php" style="text-decoration: none; color: var(--teks); font-weight: 600;">Dashboard belajar</a></li>
      <li id="nav-mobile-auth" style="padding-top: var(--spasi-12); border-top: 1px solid var(--garis); display: flex; gap: var(--spasi-12);">
        <a href="<?= $baseUrl ?>/auth/login.php" class="tombol tombol-sekunder tombol-kecil">Masuk</a>
        <a href="<?= $baseUrl ?>/auth/daftar.php" class="tombol tombol-utama tombol-kecil">Daftar</a>
      </li>
    </ul>
  </div>
</header>

<script type="module">
  import { ambilKategori, ambilDaftarKursus } from '<?= $baseUrl ?>/assets/js/api.js';

  const baseUrl = <?= json_encode($baseUrl ?? '.') ?>;
  const sedangDiProfil = <?= json_encode($sedangDiProfil) ?>;

  function pasangTautanProfilNavbar(wadah) {
    if (!wadah) return;
    if (wadah.querySelector('[data-profil-terpasang="1"]')) return;
    if (wadah.querySelector('a[href*="login.php"]')) return;

    const namaKandidat = Array.from(wadah.querySelectorAll('span, a, div'))
      .map(el => el.textContent.trim())
      .find(txt => txt && txt.toLowerCase() !== 'keluar' && txt.toLowerCase() !== 'masuk' && txt.toLowerCase() !== 'daftar');

    if (!namaKandidat) return;

    wadah.innerHTML = `
      <a href="${baseUrl}/dashboard/profil.php" class="nav-profil-pill ${sedangDiProfil ? 'aktif' : ''}" data-profil-terpasang="1" title="Pengaturan profil">
        <i data-lucide="user" style="width: 15px; height: 15px;"></i>
        <span>${namaKandidat}</span>
      </a>
    `;

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  }

  function pantauSesiNavbar() {
    ['nav-aksi-sesi', 'nav-mobile-auth'].forEach(id => {
      const el = document.getElementById(id);
      if (!el) return;

      pasangTautanProfilNavbar(el);

      const observer = new MutationObserver(() => {
        pasangTautanProfilNavbar(el);
      });
      observer.observe(el, { childList: true, subtree: true });
    });
  }

  const badgeSvgKategori = [
    `<svg width="28" height="28" viewBox="0 0 28 28" fill="none"><rect x="3" y="3" width="22" height="22" rx="6" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="1.6"/><rect x="3" y="3" width="22" height="7" rx="5" fill="#1DB954"/><line x1="11" y1="10" x2="11" y2="25" stroke="#1C1A17" stroke-width="1.4"/><line x1="3" y1="17" x2="25" y2="17" stroke="#1C1A17" stroke-width="1.4"/></svg>`,
    `<svg width="28" height="28" viewBox="0 0 28 28" fill="none"><rect x="3" y="8" width="22" height="16" rx="5" fill="#FBE8C8" stroke="#1C1A17" stroke-width="1.6"/><path d="M10 8V6C10 4.9 10.9 4 12 4H16C17.1 4 18 4.9 18 6V8" stroke="#1C1A17" stroke-width="1.6"/><circle cx="14" cy="16" r="2.5" fill="#1DB954"/></svg>`,
    `<svg width="28" height="28" viewBox="0 0 28 28" fill="none"><rect x="4" y="3" width="20" height="22" rx="5" fill="#242424" stroke="#1C1A17" stroke-width="1.6"/><rect x="8" y="7" width="12" height="5" rx="1.5" fill="#1DB954"/><circle cx="9.5" cy="16" r="1.5" fill="#1C1A17"/><circle cx="14" cy="16" r="1.5" fill="#1C1A17"/><circle cx="18.5" cy="16" r="1.5" fill="#E8A838"/><circle cx="9.5" cy="20.5" r="1.5" fill="#1C1A17"/><circle cx="14" cy="20.5" r="1.5" fill="#1C1A17"/><circle cx="18.5" cy="20.5" r="1.5" fill="#1DB954"/></svg>`,
    `<svg width="28" height="28" viewBox="0 0 28 28" fill="none"><rect x="5" y="3" width="18" height="22" rx="4" fill="#FFFFFF" stroke="#1C1A17" stroke-width="1.6"/><line x1="9" y1="9" x2="19" y2="9" stroke="#1DB954" stroke-width="2" stroke-linecap="round"/><line x1="9" y1="14" x2="19" y2="14" stroke="#727272" stroke-width="1.6" stroke-linecap="round"/><circle cx="18" cy="20" r="3.5" fill="#E8A838" stroke="#1C1A17" stroke-width="1.2"/></svg>`
  ];

  const sampulKursusMini = [
    {
      bg: 'rgba(29, 185, 84, 0.15)',
      tag: 'POPULER',
      tagBg: '#1C1A17',
      svg: `<svg viewBox="0 0 200 92" fill="none" style="width: 100%; height: 100%;">
        <rect x="28" y="18" width="144" height="64" rx="7" fill="#FFFFFF" stroke="#1C1A17" stroke-width="1.8"/>
        <rect x="28" y="18" width="144" height="16" rx="6" fill="#1DB954"/>
        <text x="38" y="29" fill="#FFFFFF" font-family="IBM Plex Mono, monospace" font-size="8" font-weight="600">=SUM(B2:B8)</text>
        <line x1="76" y1="34" x2="76" y2="82" stroke="#1C1A17" stroke-opacity="0.15"/>
        <line x1="124" y1="34" x2="124" y2="82" stroke="#1C1A17" stroke-opacity="0.15"/>
        <line x1="28" y1="50" x2="172" y2="50" stroke="#1C1A17" stroke-opacity="0.15"/>
        <line x1="28" y1="66" x2="172" y2="66" stroke="#1C1A17" stroke-opacity="0.15"/>
        <rect x="84" y="39" width="32" height="6" rx="3" fill="#E8A838"/>
        <rect x="132" y="55" width="30" height="6" rx="3" fill="#1DB954"/>
      </svg>`
    },
    {
      bg: '#FBE8C8',
      tag: 'UNGGULAN',
      tagBg: '#1DB954',
      svg: `<svg viewBox="0 0 200 92" fill="none" style="width: 100%; height: 100%;">
        <rect x="30" y="16" width="140" height="66" rx="7" fill="#FFFFFF" stroke="#1C1A17" stroke-width="1.8"/>
        <rect x="44" y="54" width="14" height="18" rx="3" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="1.4"/>
        <rect x="64" y="42" width="14" height="30" rx="3" fill="#E8A838" stroke="#1C1A17" stroke-width="1.4"/>
        <rect x="84" y="30" width="14" height="42" rx="3" fill="#1DB954" stroke="#1C1A17" stroke-width="1.4"/>
        <rect x="110" y="28" width="46" height="18" rx="5" fill="rgba(29, 185, 84, 0.15)"/>
        <path d="M118 39L126 33L134 37L146 30" stroke="#1DB954" stroke-width="2" stroke-linecap="round"/>
        <rect x="110" y="54" width="46" height="6" rx="3" fill="#1C1A17"/>
        <rect x="110" y="64" width="32" height="5" rx="2.5" fill="#727272"/>
      </svg>`
    }
  ];

  async function isiMegaMenuNavbar() {
    try {
      const [katList, kursusList] = await Promise.all([
        ambilKategori(),
        ambilDaftarKursus()
      ]);

      const megaKat = document.getElementById('mega-kategori-list');
      const mobileKat = document.getElementById('mobile-kategori-list');

      if (megaKat && Array.isArray(katList) && katList.length > 0) {
        megaKat.innerHTML = katList.map((k, idx) => {
          const svgBadge = badgeSvgKategori[idx % badgeSvgKategori.length];
          return `
            <a href="${baseUrl}/kursus/katalog.php?kategori=${k.slug}" class="mega-link-item">
              <span class="mega-svg-badge">${svgBadge}</span>
              <span>${k.nama}</span>
            </a>
          `;
        }).join('');
      }

      if (mobileKat && Array.isArray(katList) && katList.length > 0) {
        mobileKat.innerHTML = katList.map(k => `
          <a href="${baseUrl}/kursus/katalog.php?kategori=${k.slug}">${k.nama}</a>
        `).join('');
      }

      const megaKursus = document.getElementById('mega-kursus-populer');
      if (megaKursus && Array.isArray(kursusList) && kursusList.length > 0) {
        megaKursus.innerHTML = kursusList.slice(0, 2).map((kursus, idx) => {
          const sampul = sampulKursusMini[idx % sampulKursusMini.length];
          return `
            <a href="${baseUrl}/kursus/detail.php?slug=${kursus.slug}" class="mega-kursus-kartu">
              <div>
                <div class="mega-kursus-thumb" style="background-color: ${sampul.bg};">
                  <span class="mega-kursus-tag" style="background-color: ${sampul.tagBg};">${sampul.tag}</span>
                  ${sampul.svg}
                </div>
                <div class="mega-kursus-judul">${kursus.judul}</div>
              </div>
              <div class="mega-kursus-meta">
                <span>${kursus.jumlah_modul} Modul</span>
                <span style="color: var(--aksen); font-weight: 700;">${kursus.estimasi_waktu}</span>
              </div>
            </a>
          `;
        }).join('');
      }

      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    } catch (e) {}
  }

  pantauSesiNavbar();
  document.addEventListener('DOMContentLoaded', () => {
    pantauSesiNavbar();
    isiMegaMenuNavbar();
  });
</script>