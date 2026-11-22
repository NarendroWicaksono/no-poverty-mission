<style>
  html,
  body {
    max-width: 100%;
    overflow-x: hidden;
  }

  footer,
  .kaki-halaman {
    display: none !important;
  }

  .adm-topbar-break {
    display: none;
  }

  /* Penyesuaian Topbar Khusus Layar HP (Desktop Tetap Bawaan) */
  @media (max-width: 768px) {
    .adm-topbar-fixed {
      display: flex !important;
      flex-wrap: wrap !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 8px !important;
      width: 100% !important;
      max-width: 100% !important;
      height: auto !important;
      min-height: 0 !important;
      padding: 12px 16px !important;
      box-sizing: border-box !important;
    }

    .adm-topbar-brand {
      order: 1 !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      min-width: 0 !important;
      flex: 0 1 auto !important;
    }

    .adm-topbar-sub-hide {
      display: none !important;
    }

    .adm-topbar-right-wrap {
      display: contents !important;
    }

    .adm-topbar-user-box {
      order: 2 !important;
      margin-left: auto !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: flex-end !important;
      gap: 8px !important;
      min-width: 0 !important;
      max-width: 64% !important;
      font-size: 12px !important;
    }

    .adm-topbar-email-text {
      display: inline-block !important;
      min-width: 0 !important;
      max-width: 155px !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
      white-space: nowrap !important;
      font-size: 12px !important;
    }

    .adm-topbar-divider {
      display: none !important;
    }

    .adm-topbar-break {
      display: block !important;
      order: 3 !important;
      flex-basis: 100% !important;
      height: 1px !important;
      background-color: #EFECE4 !important;
      margin: 2px 0 !important;
    }

    .adm-topbar-action-btn {
      order: 4 !important;
      flex: 1 1 calc(50% - 6px) !important;
      min-width: 0 !important;
      justify-content: center !important;
      text-align: center !important;
      padding-left: 10px !important;
      padding-right: 10px !important;
      font-size: 12px !important;
      height: 36px !important;
    }
  }

  .adm-dashboard,
  .adm-dashboard * {
    box-sizing: border-box;
  }

  .adm-dashboard {
    font-family: var(--font-ui);
    color: #1C1A17;
    padding-bottom: 48px;
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
  }

  /* Header Dashboard */
  .adm-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 24px;
  }

  .adm-header-info {
    min-width: 0;
    flex: 1 1 320px;
  }

  .adm-kicker {
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #1F6F4A;
    margin-bottom: 6px;
  }

  .adm-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: clamp(22px, 3vw, 28px);
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1.25;
    color: #1C1A17;
    margin: 0 0 6px;
  }

  .adm-subtitle {
    font-size: 14px;
    line-height: 1.55;
    color: #5C5750;
    margin: 0;
  }

  .adm-header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  /* Tombol Solid dengan Radius Seimbang */
  .adm-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 40px;
    padding: 0 16px;
    border-radius: 10px;
    border: 1px solid #1F6F4A;
    background-color: #1F6F4A;
    color: #FFFFFF !important;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: background-color 140ms ease;
  }

  .adm-btn-primary:hover {
    background-color: #18583B;
    color: #FFFFFF !important;
  }

  .adm-btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 40px;
    padding: 0 15px;
    border-radius: 10px;
    border: 1px solid #DCD6C8;
    background-color: #FFFFFF;
    color: #1C1A17 !important;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .adm-btn-secondary:hover {
    border-color: #1F6F4A;
    color: #1F6F4A !important;
    background-color: #FAF9F6;
  }

  /* Grid 3 Kartu Metrik */
  .adm-metrics-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 24px;
  }

  .adm-metric-card {
    min-width: 0;
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 12px;
  }

  .adm-metric-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
  }

  .adm-metric-label {
    font-size: 13px;
    font-weight: 500;
    color: #5C5750;
  }

  .adm-metric-icon {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    background-color: #F5F3EE;
    border: 1px solid #E6E2D8;
    color: #1F6F4A;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .adm-metric-value {
    font-family: var(--font-mono, monospace);
    font-size: clamp(24px, 2.6vw, 30px);
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1.15;
    color: #1C1A17;
  }

  .adm-metric-sub {
    font-size: 12px;
    color: #7A746B;
  }

  /* Grid Grafik & Kursus Unggulan */
  .adm-analytics-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.85fr) minmax(0, 1fr);
    gap: 20px;
    margin-bottom: 24px;
    align-items: stretch;
  }

  .adm-card {
    min-width: 0;
    max-width: 100%;
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 16px;
    padding: 24px 26px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
  }

  .adm-card-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 18px;
  }

  .adm-card-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: 16px;
    font-weight: 600;
    color: #1C1A17;
    margin: 0 0 3px;
  }

  .adm-card-sub {
    font-size: 12.5px;
    color: #7A746B;
    margin: 0;
  }

  /* Legenda Grafik Solid */
  .adm-chart-legend {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    font-size: 12px;
    color: #5C5750;
  }

  .adm-legend-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .adm-legend-line-solid {
    width: 14px;
    height: 2.5px;
    border-radius: 2px;
    background-color: #1F6F4A;
    display: inline-block;
  }

  .adm-legend-line-dash {
    width: 14px;
    height: 0;
    border-top: 2px dashed #8A847A;
    display: inline-block;
  }

  .adm-chart-box {
    width: 100%;
    min-width: 0;
    overflow: hidden;
  }

  /* Daftar Kursus Unggulan */
  .adm-popular-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
    min-width: 0;
  }

  .adm-pop-item {
    display: flex;
    flex-direction: column;
    gap: 7px;
    min-width: 0;
  }

  .adm-pop-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    min-width: 0;
  }

  .adm-pop-title {
    flex: 1;
    min-width: 0;
    font-size: 13.5px;
    font-weight: 500;
    color: #1C1A17;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .adm-pop-badge {
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    color: #5C5750;
    background-color: #F5F3EE;
    border: 1px solid #E6E2D8;
    border-radius: 7px;
    padding: 2px 8px;
    flex-shrink: 0;
  }

  .adm-progress-track {
    width: 100%;
    height: 6px;
    background-color: #EFECE4;
    border-radius: 999px;
    overflow: hidden;
  }

  .adm-progress-fill {
    height: 100%;
    background-color: #1F6F4A;
    border-radius: 999px;
    transition: width 240ms ease;
  }

  /* Tabel Peserta Terbaru */
  .adm-table-card {
    min-width: 0;
    max-width: 100%;
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 16px;
    padding: 24px 26px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
  }

  .adm-table-wrap {
    width: 100%;
    min-width: 0;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border: 1px solid #EFECE4;
    border-radius: 12px;
  }

  .adm-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    font-size: 13.5px;
  }

  .adm-table thead {
    background-color: #FAF9F6;
    border-bottom: 1px solid #E6E2D8;
  }

  .adm-table th {
    padding: 12px 16px;
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: #7A746B;
    white-space: nowrap;
  }

  .adm-table td {
    padding: 13px 16px;
    border-bottom: 1px solid #EFECE4;
    color: #1C1A17;
    vertical-align: middle;
  }

  .adm-table tbody tr:last-child td {
    border-bottom: none;
  }

  .adm-table tbody tr:hover {
    background-color: #FAF9F6;
  }

  .adm-user-cell {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
  }

  .adm-avatar {
    width: 32px;
    height: 32px;
    border-radius: 9px;
    background-color: #F2EFE9;
    border: 1px solid #DFD9CC;
    color: #1C1A17;
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .adm-user-name {
    font-weight: 600;
    color: #1C1A17;
    word-break: break-word;
  }

  .adm-mono-cell {
    font-family: var(--font-mono, monospace);
    font-size: 12.5px;
    color: #5C5750;
  }

  /* Lencana Status Solid */
  .adm-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 8px;
    background-color: #F2EFE9;
    border: 1px solid #DFD9CC;
    color: #1F6F4A;
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
  }

  @media (max-width: 960px) {
    .adm-analytics-grid {
      grid-template-columns: minmax(0, 1fr);
    }
  }

  @media (max-width: 720px) {
    .adm-metrics-grid {
      grid-template-columns: minmax(0, 1fr);
      gap: 12px;
    }

    .adm-metric-card {
      flex-direction: row;
      align-items: center;
      padding: 16px 18px;
    }

    .adm-metric-top {
      flex-direction: row-reverse;
      justify-content: flex-end;
      gap: 12px;
      flex: 1;
      min-width: 0;
    }

    .adm-metric-body {
      text-align: right;
      flex-shrink: 0;
    }
  }

  @media (max-width: 640px) {
    .adm-header {
      align-items: stretch;
      margin-bottom: 18px;
    }

    .adm-header-actions {
      display: grid;
      grid-template-columns: 1fr 1fr;
      width: 100%;
      gap: 8px;
    }

    .adm-header-actions .adm-btn-primary,
    .adm-header-actions .adm-btn-secondary {
      width: 100%;
      padding: 0 12px;
    }

    .adm-card,
    .adm-table-card {
      padding: 18px 16px;
      border-radius: 14px;
    }

    .adm-table-card .adm-card-head .adm-btn-secondary {
      width: 100%;
    }

    /* Ubah Tabel Menjadi Daftar Kartu Rapi di Layar HP */
    .adm-table-wrap {
      border: none;
      border-radius: 0;
      overflow: visible;
    }

    .adm-table,
    .adm-table tbody {
      display: block;
      width: 100%;
    }

    .adm-table thead {
      display: none;
    }

    .adm-table tbody tr {
      display: flex;
      flex-direction: column;
      gap: 9px;
      padding: 14px;
      border: 1px solid #EFECE4;
      border-radius: 12px;
      background-color: #FAF9F6;
      margin-bottom: 10px;
    }

    .adm-table tbody tr:last-child {
      margin-bottom: 0;
    }

    .adm-table tbody tr:hover {
      background-color: #FAF9F6;
    }

    .adm-table td {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      padding: 0;
      border-bottom: none;
      font-size: 13px;
      text-align: right;
    }

    .adm-table td[data-col="peserta"] {
      padding-bottom: 10px;
      border-bottom: 1px solid #E6E2D8;
      text-align: left;
    }

    .adm-table td[data-col="peserta"]::before {
      display: none;
    }

    .adm-table td::before {
      content: attr(data-label);
      font-family: var(--font-mono, monospace);
      font-size: 11px;
      color: #7A746B;
      text-align: left;
      flex-shrink: 0;
    }

    .adm-table td[data-col="email"] {
      word-break: break-all;
    }
  }
</style>

<div class="adm-dashboard">
  <!-- Header Halaman -->
  <div class="adm-header">
    <div class="adm-header-info">
      <div class="adm-kicker">Panel Administrator &middot; SDG 1</div>
      <h1 class="adm-title">Ringkasan statistik</h1>
      <p class="adm-subtitle">
        Pantauan pertumbuhan peserta, penyelesaian modul, dan dampak program pelatihan kerja terbuka.
      </p>
    </div>

    <div class="adm-header-actions">
      <a href="peserta.php" class="adm-btn-secondary">
        <i data-lucide="users" style="width: 15px; height: 15px;"></i>
        <span>Data peserta</span>
      </a>
      <a href="kursus.php" class="adm-btn-primary">
        <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
        <span>Tambah kursus</span>
      </a>
    </div>
  </div>

  <!-- 3 Kartu Metrik -->
  <div class="adm-metrics-grid">
    <div class="adm-metric-card">
      <div class="adm-metric-top">
        <span class="adm-metric-label">Total peserta terdaftar</span>
        <span class="adm-metric-icon">
          <i data-lucide="users" style="width: 16px; height: 16px;"></i>
        </span>
      </div>
      <div class="adm-metric-body">
        <div class="adm-metric-value" id="adm-stat-peserta">0</div>
        <div class="adm-metric-sub" style="margin-top: 4px;">Peserta aktif</div>
      </div>
    </div>

    <div class="adm-metric-card">
      <div class="adm-metric-top">
        <span class="adm-metric-label">Kursus aktif</span>
        <span class="adm-metric-icon">
          <i data-lucide="book-open" style="width: 16px; height: 16px;"></i>
        </span>
      </div>
      <div class="adm-metric-body">
        <div class="adm-metric-value" id="adm-stat-kursus">0</div>
        <div class="adm-metric-sub" id="adm-stat-modul-sub" style="margin-top: 4px;">0 modul siap belajar</div>
      </div>
    </div>

    <div class="adm-metric-card">
      <div class="adm-metric-top">
        <span class="adm-metric-label">Sertifikat diterbitkan</span>
        <span class="adm-metric-icon">
          <i data-lucide="award" style="width: 16px; height: 16px;"></i>
        </span>
      </div>
      <div class="adm-metric-body">
        <div class="adm-metric-value" id="adm-stat-sertifikat">0</div>
        <div class="adm-metric-sub" style="margin-top: 4px;">Tersertifikasi resmi</div>
      </div>
    </div>
  </div>

  <!-- Tata Letak Grafik Native SVG dan Daftar Kursus Terpopuler -->
  <div class="adm-analytics-grid">
    <!-- Grafik Tren SVG Native -->
    <div class="adm-card">
      <div class="adm-card-head">
        <div>
          <h2 class="adm-card-title">Tren pendaftaran &amp; kelulusan</h2>
          <p class="adm-card-sub">Enam bulan terakhir tahun 2026</p>
        </div>
        <div class="adm-chart-legend">
          <span class="adm-legend-item">
            <span class="adm-legend-line-solid"></span> Peserta baru
          </span>
          <span class="adm-legend-item">
            <span class="adm-legend-line-dash"></span> Kelulusan
          </span>
        </div>
      </div>
      <div id="native-trend-chart" class="adm-chart-box"></div>
    </div>

    <!-- Kursus Terpopuler Dinamis dari Database -->
    <div class="adm-card">
      <div class="adm-card-head">
        <div>
          <h2 class="adm-card-title">Kursus unggulan &amp; aktif</h2>
          <p class="adm-card-sub">Berdasarkan aktivitas peserta di database</p>
        </div>
      </div>

      <div class="adm-popular-list" id="adm-popular-list">
        <!-- Dimuat dinamis dari database -->
      </div>
    </div>
  </div>

  <!-- Tabel Peserta Terbaru yang Mendaftar -->
  <div class="adm-table-card">
    <div class="adm-card-head">
      <div>
        <h2 class="adm-card-title">Pendaftaran peserta terbaru</h2>
        <p class="adm-card-sub">Lima pendaftar terakhir dari data penerima manfaat</p>
      </div>
      <a href="peserta.php" class="adm-btn-secondary" style="height: 36px; padding: 0 13px; font-size: 12.5px;">
        <span>Lihat semua peserta</span>
        <i data-lucide="chevron-right" style="width: 14px; height: 14px;"></i>
      </a>
    </div>

    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th>Nama lengkap</th>
            <th>Alamat email</th>
            <th>Pekerjaan &amp; domisili</th>
            <th>Status</th>
            <th>Tanggal daftar</th>
          </tr>
        </thead>
        <tbody id="adm-recent-table">
          <!-- Dimuat dinamis via JS -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="module">
  import { ambilStatistik, ambilSemuaPeserta } from '../assets/js/api.js';

  let cacheTrenBulanan = [];

  function tandaiTopbarResponsif() {
    const topbar = document.querySelector('header, nav, .admin-topbar, .topbar');
    if (!topbar || !topbar.textContent.includes('@')) return;

    topbar.classList.add('adm-topbar-fixed');

    const anakLangsung = Array.from(topbar.children);
    if (anakLangsung.length < 2) return;

    anakLangsung[0].classList.add('adm-topbar-brand');
    anakLangsung[0].querySelectorAll('span, div').forEach(el => {
      const txt = el.textContent.trim();
      if (txt === '/' || txt === 'Panel pengelola') {
        el.classList.add('adm-topbar-sub-hide');
      }
    });

    const grupKanan = anakLangsung[anakLangsung.length - 1];
    grupKanan.classList.add('adm-topbar-right-wrap');

    const subKanan = Array.from(grupKanan.children);
    const idxEmail = subKanan.findIndex(el => el.textContent.includes('@'));
    if (idxEmail === -1) return;

    subKanan.forEach((el, idx) => {
      const txt = el.textContent.trim();
      if (idx < idxEmail) {
        if (txt === '' || txt === '|') {
          el.classList.add('adm-topbar-divider');
        } else {
          el.classList.add('adm-topbar-action-btn');
        }
      } else {
        el.classList.add('adm-topbar-user-box');
        el.querySelectorAll('span, div').forEach(sub => {
          if (sub.children.length === 0 && sub.textContent.includes('@')) {
            sub.classList.add('adm-topbar-email-text');
          }
        });
      }
    });

    if (!grupKanan.querySelector('.adm-topbar-break')) {
      const pemisahBaris = document.createElement('span');
      pemisahBaris.className = 'adm-topbar-break';
      grupKanan.insertBefore(pemisahBaris, subKanan[idxEmail]);
    }
  }

  function ambilInisial(nama) {
    if (!nama) return 'P';
    return nama
      .trim()
      .split(/\s+/)
      .slice(0, 2)
      .map(s => s[0].toUpperCase())
      .join('');
  }

  function renderNativeChart(trenBulanan = []) {
    const wadah = document.getElementById('native-trend-chart');
    if (!wadah) return;

    const sumber = Array.isArray(trenBulanan) && trenBulanan.length
      ? trenBulanan
      : [
          { label: 'Jun 2026', peserta: 0, lulus: 0 },
          { label: 'Jul 2026', peserta: 0, lulus: 0 },
          { label: 'Agu 2026', peserta: 0, lulus: 0 },
          { label: 'Sep 2026', peserta: 0, lulus: 0 },
          { label: 'Okt 2026', peserta: 0, lulus: 0 },
          { label: 'Nov 2026', peserta: 0, lulus: 0 },
        ];

    const isMobile = window.innerWidth <= 560;
    const labels = sumber.map(d => {
      if (!isMobile) return d.label;
      return String(d.label || '').split(' ')[0];
    });
    const peserta = sumber.map(d => Number(d.peserta || 0));
    const lulus = sumber.map(d => Number(d.lulus || 0));

    const W = isMobile ? 360 : 620;
    const H = isMobile ? 210 : 228;
    const padL = isMobile ? 34 : 42;
    const padR = isMobile ? 16 : 22;
    const padT = isMobile ? 24 : 22;
    const padB = isMobile ? 28 : 30;
    const chartW = W - padL - padR;
    const chartH = H - padT - padB;
    const maxData = Math.max(4, ...peserta, ...lulus);
    const maxVal = Math.ceil(maxData / 4) * 4;

    const getX = i => padL + (i / Math.max(1, labels.length - 1)) * chartW;
    const getY = v => padT + chartH - (v / maxVal) * chartH;

    const fontAxis = isMobile ? '11.5' : '10';
    const fontLabelX = isMobile ? '11.5' : '10.5';
    const fontVal = isMobile ? '11' : '10';

    const step = maxVal / 4;
    const gridLines = [0, step, step * 2, step * 3, maxVal].map(val => {
      const y = getY(val);
      return `
        <line x1="${padL}" y1="${y}" x2="${W - padR}" y2="${y}" stroke="#EFECE4" stroke-width="1" />
        <text x="${padL - 8}" y="${y + 4}" text-anchor="end" fill="#8A847A" font-size="${fontAxis}" font-family="var(--font-mono, monospace)">${val}</text>
      `;
    }).join('');

    const ptsPeserta = peserta.map((v, i) => `${getX(i)},${getY(v)}`).join(' ');
    const ptsLulus = lulus.map((v, i) => `${getX(i)},${getY(v)}`).join(' ');

    const dotsLulus = lulus.map((v, i) => `
      <circle cx="${getX(i)}" cy="${getY(v)}" r="3" fill="#FFFFFF" stroke="#8A847A" stroke-width="1.6" />
    `).join('');

    const dotsPeserta = peserta.map((v, i) => `
      <circle cx="${getX(i)}" cy="${getY(v)}" r="4" fill="#FFFFFF" stroke="#1F6F4A" stroke-width="2.2" />
      <text x="${getX(i)}" y="${getY(v) - 9}" text-anchor="middle" fill="#1F6F4A" font-size="${fontVal}" font-weight="600" font-family="var(--font-mono, monospace)">${v}</text>
    `).join('');

    const xLabels = labels.map((lbl, i) => `
      <text x="${getX(i)}" y="${H - 6}" text-anchor="middle" fill="#7A746B" font-size="${fontLabelX}" font-family="var(--font-ui, sans-serif)">${lbl}</text>
    `).join('');

    wadah.innerHTML = `
      <svg viewBox="0 0 ${W} ${H}" style="width: 100%; height: auto; display: block;">
        ${gridLines}
        <polyline points="${ptsLulus}" fill="none" stroke="#8A847A" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round" stroke-linejoin="round" />
        <polyline points="${ptsPeserta}" fill="none" stroke="#1F6F4A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
        ${dotsLulus}
        ${dotsPeserta}
        ${xLabels}
      </svg>
    `;
  }

  document.addEventListener('DOMContentLoaded', async () => {
    tandaiTopbarResponsif();
    document.querySelectorAll('footer, .kaki-halaman').forEach(el => el.remove());

    const [stat, pesertaList] = await Promise.all([
      ambilStatistik(),
      ambilSemuaPeserta()
    ]);

    cacheTrenBulanan = stat.tren_bulanan || [];
    renderNativeChart(cacheTrenBulanan);

    let resizeTimer;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => renderNativeChart(cacheTrenBulanan), 150);
    });

    document.getElementById('adm-stat-peserta').textContent = pesertaList.length.toLocaleString('id-ID');
    document.getElementById('adm-stat-kursus').textContent = stat.total_kursus;
    document.getElementById('adm-stat-modul-sub').textContent = `${stat.total_modul} modul siap belajar`;
    document.getElementById('adm-stat-sertifikat').textContent = stat.total_sertifikat.toLocaleString('id-ID');

    const popWrap = document.getElementById('adm-popular-list');
    if (popWrap && Array.isArray(stat.kursus_populer)) {
      const maxAktif = Math.max(1, ...stat.kursus_populer.map(k => k.peserta_aktif || 1));
      popWrap.innerHTML = stat.kursus_populer.map(k => {
        const persen = Math.max(20, Math.round(((k.peserta_aktif || 1) / maxAktif) * 100));
        return `
          <div class="adm-pop-item">
            <div class="adm-pop-row">
              <span class="adm-pop-title" title="${k.judul}">${k.judul}</span>
              <span class="adm-pop-badge">${k.total_modul} modul</span>
            </div>
            <div class="adm-progress-track">
              <div class="adm-progress-fill" style="width: ${persen}%;"></div>
            </div>
          </div>
        `;
      }).join('');
    }

    const tbody = document.getElementById('adm-recent-table');
    if (tbody) {
      const recents = pesertaList.slice(0, 5);
      tbody.innerHTML = recents.map(p => `
        <tr>
          <td data-col="peserta" data-label="Nama">
            <div class="adm-user-cell">
              <span class="adm-avatar">${ambilInisial(p.nama)}</span>
              <span class="adm-user-name">${p.nama}</span>
            </div>
          </td>
          <td data-col="email" data-label="Email" class="adm-mono-cell">${p.email}</td>
          <td data-label="Domisili" style="color: #5C5750;">${p.pekerjaan} &middot; ${p.kota}</td>
          <td data-label="Status"><span class="adm-status-badge">${p.status}</span></td>
          <td data-label="Terdaftar" class="adm-mono-cell" style="color: #7A746B;">${p.tgl_daftar}</td>
        </tr>
      `).join('');
    }

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>