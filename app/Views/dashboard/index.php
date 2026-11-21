<style>
  header,
  nav,
  footer {
    display: none !important;
  }

  body {
    padding-top: 0 !important;
    margin-top: 0 !important;
  }

  .cp-layout {
    display: grid;
    grid-template-columns: 248px 1fr;
    min-height: 100vh;
    background-color: #F7F5F0;
    font-family: var(--font-ui);
    color: #1C1A17;
  }

  /* Sidebar Kiri */
  .cp-sidebar {
    background-color: #FFFFFF;
    border-right: 1px solid #E6E2D8;
    padding: 22px 16px 24px;
    display: flex;
    flex-direction: column;
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
  }

  .cp-brand {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 2px 6px 18px;
    margin-bottom: 16px;
    border-bottom: 1px solid #EFECE4;
    text-decoration: none;
    color: #1C1A17;
    font-family: var(--font-judul);
    font-size: 17px;
    font-weight: 700;
    letter-spacing: -0.02em;
  }

  .cp-brand:hover {
    color: #1F6F4A;
  }

  .cp-brand-mark {
    width: 28px;
    height: 28px;
    border-radius: 7px;
    background-color: #1F6F4A;
    color: #FFFFFF;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .cp-user-bar {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 2px 6px 18px;
    margin-bottom: 18px;
    border-bottom: 1px solid #EFECE4;
  }

  .cp-user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 999px;
    background-color: #1F6F4A;
    color: #FFFFFF;
    font-family: var(--font-judul);
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .cp-user-nama {
    font-family: var(--font-judul);
    font-size: 14px;
    font-weight: 600;
    color: #1C1A17;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .cp-user-sub {
    font-size: 12px;
    color: #7A746B;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-top: 1px;
  }

  .cp-nav-grup {
    margin-bottom: 20px;
  }

  .cp-nav-judul {
    font-family: var(--font-ui);
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #9A948A;
    padding: 0 12px;
    margin-bottom: 6px;
  }

  .cp-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .cp-nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 8px;
    font-size: 13.5px;
    font-weight: 400;
    color: #5C5750;
    text-decoration: none;
    transition: background-color 140ms ease, color 140ms ease;
  }

  .cp-nav-link:hover {
    background-color: #F7F5F0;
    color: #1C1A17;
  }

  .cp-nav-link.aktif {
    background-color: #F2EFE9;
    color: #1F6F4A;
    font-weight: 600;
  }

  .cp-nav-link.aktif svg,
  .cp-nav-link.aktif i {
    color: #1F6F4A;
  }

  .cp-sidebar-bawah {
    margin-top: auto;
    padding-top: 16px;
    border-top: 1px solid #EFECE4;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .cp-btn-katalog-sidebar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 10px 14px;
    border-radius: 8px;
    background-color: #1F6F4A;
    color: #FFFFFF;
    font-family: var(--font-judul);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: background-color 150ms ease;
  }

  .cp-btn-katalog-sidebar:hover {
    background-color: #18583B;
    color: #FFFFFF !important;
  }

  .cp-btn-keluar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #E6E2D8;
    background-color: #FFFFFF;
    color: #5C5750;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 140ms ease;
  }

  .cp-btn-keluar:hover {
    border-color: #D9A7A2;
    color: #9E3B33;
    background-color: #FDF8F7;
  }

  /* Konten Utama */
  .cp-main {
    padding: 32px 40px 72px;
    max-width: 100%;
    width: 100%;
    min-width: 0;
  }

  .cp-header-atas {
    margin-bottom: 14px;
  }

  .cp-page-title {
    font-family: var(--font-judul);
    font-size: 24px;
    font-weight: 600;
    letter-spacing: -0.02em;
    color: #1C1A17;
    margin: 0;
  }

  /* Tab Navigasi */
  .cp-tabs {
    display: flex;
    align-items: center;
    gap: 24px;
    border-bottom: 1px solid #E6E2D8;
    margin-bottom: 28px;
    overflow-x: auto;
  }

  .cp-tab-btn {
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    padding: 10px 2px 12px;
    margin-bottom: -1px;
    font-family: var(--font-ui);
    font-size: 14px;
    font-weight: 500;
    color: #7A746B;
    cursor: pointer;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: color 140ms ease, border-color 140ms ease;
  }

  .cp-tab-btn:hover {
    color: #1C1A17;
  }

  .cp-tab-btn.aktif {
    color: #1F6F4A;
    border-bottom-color: #1F6F4A;
    font-weight: 600;
  }

  .cp-tab-count {
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 500;
    color: #8C857B;
  }

  .cp-tab-btn.aktif .cp-tab-count {
    color: #1F6F4A;
  }

  .cp-section-title {
    font-family: var(--font-judul);
    font-size: 16px;
    font-weight: 600;
    color: #1C1A17;
    margin: 0 0 14px;
  }

  /* Kartu Horizontal: Terakhir Dipelajari */
  .cp-last-card {
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 10px;
    padding: 16px 20px;
    margin-bottom: 32px;
    display: grid;
    grid-template-columns: 176px 1fr auto;
    align-items: center;
    gap: 22px;
  }

  .cp-last-thumb {
    width: 176px;
    height: 100px;
    border-radius: 7px;
    overflow: hidden;
    background-color: #EAE6DD;
    border: 1px solid #E6E2D8;
    flex-shrink: 0;
  }

  .cp-last-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .cp-last-meta {
    font-size: 12.5px;
    color: #7A746B;
    margin-bottom: 4px;
  }

  .cp-last-judul {
    font-family: var(--font-judul);
    font-size: 16.5px;
    font-weight: 600;
    color: #1C1A17;
    margin: 0 0 14px;
    line-height: 1.35;
  }

  .cp-last-judul a {
    color: inherit;
    text-decoration: none;
  }

  .cp-last-judul a:hover {
    color: #1F6F4A;
  }

  .cp-progres-baris {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .cp-progres-track {
    flex: 1;
    height: 5px;
    background-color: #EAE6DD;
    border-radius: 999px;
    overflow: hidden;
  }

  .cp-progres-fill {
    height: 100%;
    background-color: #1F6F4A;
    border-radius: 999px;
    transition: width 260ms ease;
  }

  .cp-progres-persen {
    font-family: var(--font-mono, monospace);
    font-size: 12.5px;
    font-weight: 500;
    color: #5C5750;
    white-space: nowrap;
  }

  .cp-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    border-radius: 8px;
    background-color: #1F6F4A;
    color: #FFFFFF;
    font-family: var(--font-ui);
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
    transition: background-color 140ms ease;
  }

  .cp-btn-primary:hover {
    background-color: #18583B;
    color: #FFFFFF !important;
  }

  /* Grid Kartu Kursus */
  .cp-course-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 44px;
  }

  .cp-course-card {
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: border-color 150ms ease, transform 150ms ease;
  }

  .cp-course-card:hover {
    border-color: #C7C1B5;
    transform: translateY(-2px);
  }

  .cp-card-cover {
    position: relative;
    height: 152px;
    background-color: #EAE6DD;
    border-bottom: 1px solid #EFECE4;
    overflow: hidden;
  }

  .cp-card-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 240ms ease;
  }

  .cp-course-card:hover .cp-card-cover img {
    transform: scale(1.03);
  }

  .cp-card-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 2;
    background-color: #1F6F4A;
    color: #FFFFFF;
    font-family: var(--font-ui);
    font-size: 11px;
    font-weight: 600;
    padding: 3px 9px;
    border-radius: 5px;
  }

  .cp-card-badge.badge-netral {
    background-color: #262930;
  }

  .cp-card-body {
    padding: 16px 18px 14px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .cp-card-title {
    font-family: var(--font-judul);
    font-size: 14.5px;
    font-weight: 600;
    line-height: 1.4;
    color: #1C1A17;
    margin: 0 0 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .cp-card-title a {
    color: inherit;
    text-decoration: none;
  }

  .cp-card-title a:hover {
    color: #1F6F4A;
  }

  .cp-card-info {
    font-size: 12px;
    color: #7A746B;
    margin-bottom: 16px;
  }

  .cp-card-progres {
    margin-top: auto;
  }

  .cp-card-progres-angka {
    text-align: right;
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    color: #7A746B;
    margin-top: 6px;
  }

  .cp-card-footer {
    padding: 12px 18px;
    border-top: 1px solid #EFECE4;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
  }

  .cp-link-sekunder {
    font-size: 12.5px;
    font-weight: 500;
    color: #7A746B;
    text-decoration: none;
  }

  .cp-link-sekunder:hover {
    color: #1C1A17;
  }

  .cp-link-lanjut {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-left: auto;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 600;
    color: #1F6F4A;
    text-decoration: none;
  }

  .cp-link-lanjut:hover {
    text-decoration: underline;
  }

  /* Tabel Sertifikat Kelulusan */
  .cp-table-box {
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 10px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .cp-table {
    width: 100%;
    min-width: 680px;
    border-collapse: collapse;
  }

  .cp-table th {
    background-color: #FAF9F6;
    font-size: 12px;
    font-weight: 600;
    color: #7A746B;
    padding: 13px 18px;
    text-align: left;
    white-space: nowrap;
    border-bottom: 1px solid #E6E2D8;
  }

  .cp-table td {
    padding: 14px 18px;
    font-size: 13.5px;
    color: #1C1A17;
    border-bottom: 1px solid #EFECE4;
    vertical-align: middle;
  }

  .cp-table tbody tr:last-child td {
    border-bottom: none;
  }

  .cp-nowrap {
    white-space: nowrap;
  }

  .cp-btn-berkas {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 6px;
    border: 1px solid #D8D3C8;
    background-color: #FFFFFF;
    color: #1C1A17;
    font-size: 12.5px;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
    transition: border-color 140ms ease, color 140ms ease;
  }

  .cp-btn-berkas:hover {
    border-color: #1F6F4A;
    color: #1F6F4A;
  }

  @media (max-width: 1040px) {
    .cp-course-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .cp-last-card {
      grid-template-columns: 1fr;
    }

    .cp-last-thumb {
      width: 100%;
      height: 150px;
    }
  }

  @media (max-width: 860px) {
    .cp-layout {
      grid-template-columns: 1fr;
    }

    .cp-sidebar {
      position: static;
      height: auto;
      border-right: none;
      border-bottom: 1px solid #E6E2D8;
      padding: 18px 20px;
    }

    .cp-nav-list {
      flex-direction: row;
      flex-wrap: wrap;
      gap: 6px;
    }

    .cp-sidebar-bawah {
      flex-direction: row;
      margin-top: 12px;
    }

    .cp-main {
      padding: 24px 20px 56px;
    }
  }

  @media (max-width: 600px) {
    .cp-course-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="cp-layout">
  <!-- Sidebar Kiri -->
  <aside class="cp-sidebar">
    <a href="../index.php" class="cp-brand">
      <span class="cp-brand-mark">
        <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
          <path d="M3.5 8.2L6.5 11.2L12.5 5.2" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </span>
      <span>Skill4Life</span>
    </a>

    <div class="cp-user-bar">
      <div class="cp-user-avatar" id="sidebar-avatar-inisial">BS</div>
      <div style="min-width: 0;">
        <div class="cp-user-nama" id="sidebar-nama-peserta">Memuat...</div>
        <div class="cp-user-sub" id="sidebar-pekerjaan-peserta">Peserta terdaftar</div>
      </div>
    </div>

    <div class="cp-nav-grup">
      <div class="cp-nav-judul">Aktivitas Saya</div>
      <ul class="cp-nav-list">
        <li>
          <a href="index.php" class="cp-nav-link aktif">
            <i data-lucide="book-open" class="ikon-16"></i>
            <span>Kursus Saya</span>
          </a>
        </li>
        <li>
          <a href="#seksi-sertifikat" class="cp-nav-link">
            <i data-lucide="award" class="ikon-16"></i>
            <span>Sertifikat Saya</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="cp-nav-grup">
      <div class="cp-nav-judul">Belajar &amp; Eksplorasi</div>
      <ul class="cp-nav-list">
        <li>
          <a href="../kursus/katalog.php" class="cp-nav-link">
            <i data-lucide="layout-grid" class="ikon-16"></i>
            <span>Katalog Kursus</span>
          </a>
        </li>
        <li>
          <a href="../sertifikat/verifikasi.php" class="cp-nav-link">
            <i data-lucide="shield-check" class="ikon-16"></i>
            <span>Verifikasi Sertifikat</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="cp-nav-grup">
      <div class="cp-nav-judul">Akun</div>
      <ul class="cp-nav-list">
        <li>
          <a href="profil.php" class="cp-nav-link">
            <i data-lucide="user" class="ikon-16"></i>
            <span>Pengaturan Profil</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="cp-sidebar-bawah">
      <a href="../kursus/katalog.php" class="cp-btn-katalog-sidebar">
        <span>Jelajahi Kursus</span>
      </a>
      <button type="button" id="btn-keluar-dashboard" class="cp-btn-keluar">
        <span>Keluar akun</span>
      </button>
    </div>
  </aside>

  <!-- Konten Utama -->
  <main class="cp-main">
    <div class="cp-header-atas">
      <h1 class="cp-page-title">Kursus Saya</h1>
    </div>

    <!-- Tab Navigasi -->
    <div class="cp-tabs" role="tablist">
      <button type="button" class="cp-tab-btn aktif" data-filter="semua">
        <span>Semua Kursus</span>
        <span class="cp-tab-count" id="tab-count-semua"></span>
      </button>
      <button type="button" class="cp-tab-btn" data-filter="berjalan">
        <span>Sedang Dipelajari</span>
        <span class="cp-tab-count" id="tab-count-berjalan"></span>
      </button>
      <button type="button" class="cp-tab-btn" data-filter="selesai">
        <span>Selesai</span>
        <span class="cp-tab-count" id="tab-count-selesai"></span>
      </button>
    </div>

    <!-- Seksi 1: Terakhir Dipelajari -->
    <section id="wadah-terakhir-dipelajari" style="display: none;">
      <h2 class="cp-section-title">Terakhir Dipelajari</h2>
      <div id="kartu-terakhir-dipelajari"></div>
    </section>

    <!-- Seksi 2: Grid Kartu Kursus -->
    <section>
      <h2 class="cp-section-title" id="judul-grid-kursus">Kursus Aktif</h2>
      <div class="cp-course-grid" id="daftar-kursus-peserta">
        <div style="grid-column: 1 / -1; background: #FFFFFF; border: 1px solid #E6E2D8; border-radius: 10px; padding: 32px; text-align: center; color: #7A746B; font-size: 14px;">
          Memuat daftar kursus...
        </div>
      </div>
    </section>

    <!-- Seksi 3: Tabel Sertifikat Kelulusan -->
    <section id="seksi-sertifikat">
      <h2 class="cp-section-title">Sertifikat Kelulusan</h2>
      <div class="cp-table-box">
        <table class="cp-table">
          <thead>
            <tr>
              <th>Nomor Sertifikat</th>
              <th>Nama Kursus</th>
              <th>Tanggal Terbit</th>
              <th>Nilai</th>
              <th style="width: 135px;">Dokumen</th>
            </tr>
          </thead>
          <tbody id="tabel-sertifikat-peserta">
            <tr>
              <td colspan="5" style="text-align: center; color: #7A746B; padding: 28px;">Memuat arsip sertifikat...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>

<script type="module">
  import {
    ambilSesiPengguna,
    keluarAkun,
    ambilRingkasanKursusPeserta,
    ambilSertifikatPengguna
  } from '../assets/js/api.js';

  const FOTO_KURSUS = {
    excel: 'https://images.unsplash.com/photo-1666875753105-c63a6f3bdc86?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZGF0YSUyMHNjaWVuY2V8ZW58MHx8MHx8fDA%3D',
    presentasi: 'https://images.pexels.com/photos/4348404/pexels-photo-4348404.jpeg',
    karir: 'https://images.pexels.com/photos/39284/macbook-apple-imac-computer-39284.jpeg',
    produktivitas: 'https://images.unsplash.com/photo-1632239776255-0a7f24814df2?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2071'
  };

  function ambilFotoKursus(kursus, index = 0) {
    if (kursus.thumbnail || kursus.gambar) {
      return kursus.thumbnail || kursus.gambar;
    }

    const judul = (kursus.judul || '').toLowerCase();
    if (judul.includes('excel') || judul.includes('data') || judul.includes('rumus')) {
      return FOTO_KURSUS.excel;
    }
    if (judul.includes('powerpoint') || judul.includes('presentasi') || judul.includes('slide')) {
      return FOTO_KURSUS.presentasi;
    }
    if (judul.includes('cv') || judul.includes('lamaran') || judul.includes('karir') || judul.includes('kerja')) {
      return FOTO_KURSUS.karir;
    }

    const daftarFoto = [
      FOTO_KURSUS.excel,
      FOTO_KURSUS.presentasi,
      FOTO_KURSUS.karir,
      FOTO_KURSUS.produktivitas
    ];
    return daftarFoto[index % daftarFoto.length];
  }

  document.addEventListener('DOMContentLoaded', async () => {
    const sesi = ambilSesiPengguna();
    if (!sesi || sesi.peran !== 'peserta') {
      window.location.href = '../auth/login.php?pesan=harap_login';
      return;
    }

    const namaLengkap = sesi.nama_lengkap || 'Peserta';
    document.getElementById('sidebar-nama-peserta').textContent = namaLengkap;
    document.getElementById('sidebar-pekerjaan-peserta').textContent = sesi.pekerjaan || 'Peserta terdaftar';

    const inisial = namaLengkap
      .split(' ')
      .filter(Boolean)
      .slice(0, 2)
      .map(k => k[0].toUpperCase())
      .join('');
    document.getElementById('sidebar-avatar-inisial').textContent = inisial || 'S4';

    document.getElementById('btn-keluar-dashboard').addEventListener('click', async () => {
      try {
        await keluarAkun();
      } catch (e) {}
      window.location.href = '../auth/logout.php';
    });

    const [kursusList, sertifikatList] = await Promise.all([
      ambilRingkasanKursusPeserta(),
      ambilSertifikatPengguna()
    ]);

    const jumlahSelesai = kursusList.filter(k => k.progress_persen === 100 && k.lulus_kuis).length;
    const jumlahBerjalan = kursusList.length - jumlahSelesai;

    document.getElementById('tab-count-semua').textContent = `(${kursusList.length})`;
    document.getElementById('tab-count-berjalan').textContent = `(${jumlahBerjalan})`;
    document.getElementById('tab-count-selesai').textContent = `(${jumlahSelesai})`;

    // Render Kartu Horizontal "Terakhir Dipelajari"
    const wadahTerakhir = document.getElementById('wadah-terakhir-dipelajari');
    const kartuTerakhir = document.getElementById('kartu-terakhir-dipelajari');

    if (kursusList.length > 0) {
      const kUtama = kursusList.find(k => !k.lulus_kuis) || kursusList[0];
      const modulNext = Math.min(kUtama.modul_selesai + 1, kUtama.total_modul);
      const urlAksi = kUtama.lulus_kuis && kUtama.nomor_sertifikat
        ? `../sertifikat/lihat.php?nomor=${kUtama.nomor_sertifikat}`
        : `../kursus/belajar.php?slug=${kUtama.slug}&modul=${modulNext}`;
      const labelAksi = kUtama.lulus_kuis ? 'Lihat Sertifikat' : 'Lanjutkan Belajar';

      wadahTerakhir.style.display = 'block';
      kartuTerakhir.innerHTML = `
        <div class="cp-last-card">
          <div class="cp-last-thumb">
            <img src="${ambilFotoKursus(kUtama, 0)}" alt="${kUtama.judul}" loading="lazy" onerror="this.style.display='none'">
          </div>
          <div style="min-width: 0;">
            <div class="cp-last-meta">${kUtama.kategori} &bull; ${kUtama.modul_selesai} dari ${kUtama.total_modul} modul</div>
            <h3 class="cp-last-judul">
              <a href="../kursus/detail.php?slug=${kUtama.slug}">${kUtama.judul}</a>
            </h3>
            <div class="cp-progres-baris">
              <div class="cp-progres-track">
                <div class="cp-progres-fill" style="width: ${kUtama.progress_persen}%;"></div>
              </div>
              <span class="cp-progres-persen">${kUtama.progress_persen}%</span>
            </div>
          </div>
          <a href="${urlAksi}" class="cp-btn-primary">${labelAksi}</a>
        </div>
      `;
    }

    // Render Grid Kursus
    function renderGridKursus(filter = 'semua') {
      const container = document.getElementById('daftar-kursus-peserta');
      const judulGrid = document.getElementById('judul-grid-kursus');

      let daftarTampil = kursusList;
      if (filter === 'berjalan') {
        daftarTampil = kursusList.filter(k => !k.lulus_kuis);
        judulGrid.textContent = 'Sedang Dipelajari';
      } else if (filter === 'selesai') {
        daftarTampil = kursusList.filter(k => k.lulus_kuis);
        judulGrid.textContent = 'Kursus Selesai';
      } else {
        judulGrid.textContent = 'Kursus Aktif';
      }

      if (daftarTampil.length === 0) {
        container.innerHTML = `
          <div style="grid-column: 1 / -1; background-color: #FFFFFF; border: 1px solid #E6E2D8; border-radius: 10px; text-align: center; padding: 44px 24px;">
            <div style="font-family: var(--font-judul); font-size: 16px; font-weight: 600; color: #1C1A17; margin-bottom: 6px;">
              Tidak ada kursus pada kategori ini
            </div>
            <p style="font-size: 13.5px; color: #7A746B; max-width: 400px; margin: 0 auto 18px; line-height: 1.55;">
              Jelajahi katalog kursus keterampilan kerja gratis untuk menambah daftar belajar Anda.
            </p>
            <a href="../kursus/katalog.php" class="cp-btn-primary">Buka Katalog Kursus</a>
          </div>
        `;
        return;
      }

      container.innerHTML = daftarTampil.map((k, idx) => {
        const isLulus = k.lulus_kuis;
        const modulBerikutnya = Math.min(k.modul_selesai + 1, k.total_modul);

        let tautanUtama = `
          <a href="../kursus/belajar.php?slug=${k.slug}&modul=${modulBerikutnya}" class="cp-link-lanjut">
            <span>Lanjut Belajar &rarr;</span>
          </a>
        `;

        if (k.progress_persen === 100 && !isLulus) {
          tautanUtama = `
            <a href="../kursus/kuis.php?slug=${k.slug}" class="cp-link-lanjut">
              <span>Kerjakan Kuis &rarr;</span>
            </a>
          `;
        } else if (isLulus && k.nomor_sertifikat) {
          tautanUtama = `
            <a href="../kursus/belajar.php?slug=${k.slug}&modul=1" class="cp-link-sekunder">Pelajari ulang</a>
            <a href="../sertifikat/lihat.php?nomor=${k.nomor_sertifikat}" class="cp-link-lanjut">
              <span>Lihat Sertifikat &rarr;</span>
            </a>
          `;
        }

        return `
          <article class="cp-course-card">
            <div>
              <div class="cp-card-cover">
                <span class="cp-card-badge ${isLulus ? '' : 'badge-netral'}">
                  ${isLulus ? 'Tuntas' : k.level}
                </span>
                <img src="${ambilFotoKursus(k, idx)}" alt="${k.judul}" loading="lazy" onerror="this.style.display='none'">
              </div>

              <div class="cp-card-body">
                <h3 class="cp-card-title">
                  <a href="../kursus/detail.php?slug=${k.slug}">${k.judul}</a>
                </h3>

                <div class="cp-card-info">
                  ${k.total_modul} modul &middot; ${k.kategori}
                </div>

                <div class="cp-card-progres">
                  <div class="cp-progres-track">
                    <div class="cp-progres-fill" style="width: ${k.progress_persen}%;"></div>
                  </div>
                  <div class="cp-card-progres-angka">${k.progress_persen}%</div>
                </div>
              </div>
            </div>

            <div class="cp-card-footer">
              ${tautanUtama}
            </div>
          </article>
        `;
      }).join('');
    }

    renderGridKursus('semua');

    document.querySelectorAll('.cp-tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.cp-tab-btn').forEach(b => b.classList.remove('aktif'));
        btn.classList.add('aktif');
        renderGridKursus(btn.getAttribute('data-filter'));
      });
    });

    const tbody = document.getElementById('tabel-sertifikat-peserta');
    if (sertifikatList.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="5" style="text-align: center; color: #7A746B; padding: 28px;">
            Belum ada sertifikat diterbitkan. Selesaikan seluruh modul dan lulus kuis akhir (&ge; 70) untuk memperoleh sertifikat.
          </td>
        </tr>
      `;
    } else {
      tbody.innerHTML = sertifikatList.map(sert => `
        <tr>
          <td class="angka-mono cp-nowrap" style="font-weight: 600; color: #1F6F4A;">${sert.nomor_sertifikat}</td>
          <td style="font-weight: 500;">${sert.nama_kursus}</td>
          <td class="angka-mono cp-nowrap" style="color: #5C5750;">${sert.tanggal_terbit}</td>
          <td class="angka-mono cp-nowrap" style="font-weight: 600;">${sert.nilai_kuis || 90} / 100</td>
          <td class="cp-nowrap">
            <a href="../sertifikat/lihat.php?nomor=${sert.nomor_sertifikat}" class="cp-btn-berkas">
              Buka berkas
            </a>
          </td>
        </tr>
      `).join('');
    }

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>