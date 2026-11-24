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
      background-color: #242424 !important;
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

  .adm-peserta-page,
  .adm-peserta-page * {
    box-sizing: border-box;
  }

  .adm-peserta-page {
    font-family: var(--font-ui);
    color: #FFFFFF;
    padding-bottom: 48px;
    width: 100%;
    max-width: 100%;
  }

  /* Header Halaman */
  .adm-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 22px;
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
    color: #1DB954;
    margin-bottom: 6px;
  }

  .adm-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: clamp(22px, 3vw, 28px);
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1.25;
    color: #FFFFFF;
    margin: 0 0 6px;
  }

  .adm-subtitle {
    font-size: 14px;
    line-height: 1.55;
    color: #B3B3B3;
    margin: 0;
  }

  /* Tombol Sekunder */
  .adm-btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 40px;
    padding: 0 16px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF !important;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .adm-btn-secondary:hover {
    border-color: #1DB954;
    color: #1DB954 !important;
    background-color: #181818;
  }

  /* Kartu Bagian Tabel */
  .adm-section-card {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
    margin-bottom: 24px;
  }

  .adm-section-card:last-child {
    margin-bottom: 0;
  }

  .adm-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 18px;
  }

  .adm-toolbar-title-row {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 3px;
  }

  .adm-toolbar-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: 16px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0;
  }

  .adm-toolbar-sub {
    font-size: 12.5px;
    color: #B3B3B3;
    margin: 0;
  }

  .adm-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    height: 27px;
    padding: 0 10px;
    border-radius: 8px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 600;
    color: #E0E0E0;
    white-space: nowrap;
  }

  /* Kolom Pencarian */
  .adm-search-box {
    position: relative;
    width: 100%;
    max-width: 290px;
  }

  .adm-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #B3B3B3;
    pointer-events: none;
    display: inline-flex;
    align-items: center;
  }

  .adm-search-input {
    width: 100%;
    height: 38px;
    padding: 0 13px 0 36px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF;
    font-family: var(--font-ui);
    font-size: 13px;
    transition: border-color 140ms ease, background-color 140ms ease;
  }

  .adm-search-input::placeholder {
    color: #727272;
  }

  .adm-search-input:focus {
    outline: none;
    border-color: #1DB954;
    background-color: #181818;
  }

  /* Tabel Data */
  .adm-table-wrap {
    width: 100%;
    overflow-x: auto;
    border: 1px solid #242424;
    border-radius: 12px;
  }

  .adm-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    font-size: 13.5px;
  }

  .adm-table thead {
    background-color: #181818;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .adm-table th {
    padding: 12px 16px;
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: #B3B3B3;
    white-space: nowrap;
  }

  .adm-table td {
    padding: 14px 16px;
    border-bottom: 1px solid #242424;
    color: #FFFFFF;
    vertical-align: middle;
  }

  .adm-table tbody tr:last-child td {
    border-bottom: none;
  }

  .adm-table tbody tr:hover {
    background-color: #181818;
  }

  /* Sel Identitas Peserta */
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
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: #FFFFFF;
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
    color: #FFFFFF;
    word-break: break-word;
  }

  .adm-mono-cell {
    font-family: var(--font-mono, monospace);
    font-size: 12.5px;
    color: #B3B3B3;
  }

  /* Lencana Status & Kode Sertifikat */
  .adm-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 8px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: #1DB954;
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
  }

  .adm-cert-code {
    display: inline-flex;
    align-items: center;
    padding: 4px 9px;
    border-radius: 8px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #1DB954;
    white-space: nowrap;
  }

  .adm-score-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 9px;
    border-radius: 8px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #E0E0E0;
    white-space: nowrap;
  }

  .adm-doc-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    height: 32px;
    padding: 0 11px;
    border-radius: 9px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF !important;
    font-family: var(--font-ui);
    font-size: 12.5px;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .adm-doc-btn:hover {
    border-color: #1DB954;
    color: #1DB954 !important;
    background-color: #181818;
  }

  .adm-empty-cell {
    text-align: center !important;
    padding: 36px 20px !important;
    color: #B3B3B3;
    font-size: 13.5px;
  }

  /* Responsif Layar HP */
  @media (max-width: 720px) {
    .adm-header {
      align-items: stretch;
      margin-bottom: 18px;
    }

    .adm-header .adm-btn-secondary {
      width: 100%;
    }

    .adm-section-card {
      padding: 16px;
      border-radius: 14px;
      margin-bottom: 18px;
    }

    .adm-toolbar {
      align-items: stretch;
      gap: 12px;
    }

    .adm-search-box {
      max-width: 100%;
    }

    /* Ubah Tabel Menjadi Kartu Baris Rapi di Layar HP */
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
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 12px;
      background-color: #181818;
      margin-bottom: 12px;
      position: relative;
    }

    .adm-table tbody tr:last-child {
      margin-bottom: 0;
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

    /* Kartu Peserta di Layar HP */
    .adm-table td[data-col="peserta"] {
      padding-bottom: 10px;
      padding-right: 76px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      text-align: left;
    }

    .adm-table td[data-col="status"] {
      position: absolute;
      top: 16px;
      right: 14px;
    }

    .adm-table td[data-col="email"] {
      word-break: break-all;
    }

    /* Kartu Sertifikat di Layar HP */
    .adm-table td[data-col="nomor"] {
      padding-bottom: 10px;
      padding-right: 84px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      text-align: left;
    }

    .adm-table td[data-col="dokumen"] {
      position: absolute;
      top: 13px;
      right: 14px;
    }

    .adm-table td[data-col="kursus"] {
      align-items: flex-start;
    }

    .adm-table td[data-label]::before {
      content: attr(data-label);
      font-family: var(--font-mono, monospace);
      font-size: 11px;
      color: #B3B3B3;
      text-align: left;
      flex-shrink: 0;
    }
  }
</style>

<div class="adm-peserta-page">
  <!-- Header Halaman -->
  <div class="adm-header">
    <div class="adm-header-info">
      <div class="adm-kicker">Panel Administrator &middot; Penerima Manfaat</div>
      <h1 class="adm-title">Data peserta &amp; sertifikat</h1>
      <p class="adm-subtitle">
        Daftar penerima manfaat program keterampilan dan riwayat penerbitan sertifikat kelulusan resmi.
      </p>
    </div>

    <button type="button" id="btn-ekspor-csv" class="adm-btn-secondary">
      <i data-lucide="download" style="width: 15px; height: 15px;"></i>
      <span>Ekspor lembar kerja (CSV)</span>
    </button>
  </div>

  <!-- Bagian 1: Tabel Peserta Terdaftar -->
  <section class="adm-section-card">
    <div class="adm-toolbar">
      <div>
        <div class="adm-toolbar-title-row">
          <h2 class="adm-toolbar-title">Peserta belajar terdaftar</h2>
          <span class="adm-count-badge"><span id="total-peserta-badge">0</span> peserta</span>
        </div>
        <p class="adm-toolbar-sub">Masyarakat umum, pelajar, dan pencari kerja</p>
      </div>

      <div class="adm-search-box">
        <span class="adm-search-icon">
          <i data-lucide="search" style="width: 15px; height: 15px;"></i>
        </span>
        <input type="search" id="cari-peserta" class="adm-search-input" placeholder="Cari nama, email, atau kota...">
      </div>
    </div>

    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th>Nama lengkap</th>
            <th>Alamat email</th>
            <th>Pekerjaan &amp; domisili</th>
            <th>Tanggal gabung</th>
            <th>Status akun</th>
          </tr>
        </thead>
        <tbody id="tabel-peserta-body">
          <tr>
            <td colspan="5" class="adm-empty-cell">Memuat data peserta...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Bagian 2: Tabel Sertifikat Resmi Terbit -->
  <section class="adm-section-card">
    <div class="adm-toolbar">
      <div>
        <div class="adm-toolbar-title-row">
          <h2 class="adm-toolbar-title">Sertifikat kelulusan sah</h2>
          <span class="adm-count-badge"><span id="total-sertifikat-badge">0</span> sertifikat</span>
        </div>
        <p class="adm-toolbar-sub">Terdaftar resmi dengan nomor kode unik verifikasi</p>
      </div>
    </div>

    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th>Nomor sertifikat</th>
            <th>Penerima</th>
            <th>Kursus kelulusan</th>
            <th>Nilai kuis</th>
            <th>Tanggal terbit</th>
            <th style="width: 110px; text-align: right;">Dokumen</th>
          </tr>
        </thead>
        <tbody id="tabel-sertifikat-body">
          <tr>
            <td colspan="6" class="adm-empty-cell">Memuat data sertifikat...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</div>

<script type="module">
  import { ambilSemuaPeserta, ambilSemuaSertifikat } from '../assets/js/api.js';

  let daftarPesertaGlobal = [];
  let daftarSertifikatGlobal = [];

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

  function tampilkanPeserta(data) {
    const tbody = document.getElementById('tabel-peserta-body');
    document.getElementById('total-peserta-badge').textContent = data.length;

    if (!data.length) {
      tbody.innerHTML = `<tr><td colspan="5" class="adm-empty-cell">Tidak ada peserta yang cocok.</td></tr>`;
      return;
    }

    tbody.innerHTML = data.map(p => `
      <tr>
        <td data-col="peserta">
          <div class="adm-user-cell">
            <span class="adm-avatar">${ambilInisial(p.nama)}</span>
            <span class="adm-user-name">${p.nama}</span>
          </div>
        </td>
        <td data-col="email" data-label="Email" class="adm-mono-cell">${p.email}</td>
        <td data-label="Domisili" style="color: #B3B3B3;">${p.pekerjaan} &middot; ${p.kota}</td>
        <td data-label="Terdaftar" class="adm-mono-cell" style="color: #B3B3B3;">${p.tgl_daftar}</td>
        <td data-col="status"><span class="adm-status-badge">${p.status}</span></td>
      </tr>
    `).join('');
  }

  function tampilkanSertifikat(data) {
    const tbody = document.getElementById('tabel-sertifikat-body');
    document.getElementById('total-sertifikat-badge').textContent = data.length;

    if (!data.length) {
      tbody.innerHTML = `<tr><td colspan="6" class="adm-empty-cell">Belum ada sertifikat terbit.</td></tr>`;
      return;
    }

    tbody.innerHTML = data.map(c => `
      <tr>
        <td data-col="nomor">
          <code class="adm-cert-code">${c.nomor_sertifikat}</code>
        </td>
        <td data-label="Penerima" class="adm-user-name">${c.nama_peserta}</td>
        <td data-col="kursus" data-label="Kursus" style="color: #B3B3B3;">${c.nama_kursus}</td>
        <td data-label="Nilai kuis">
          <span class="adm-score-badge">${c.nilai_kuis || 90} / 100</span>
        </td>
        <td data-label="Terbit" class="adm-mono-cell" style="color: #B3B3B3;">${c.tanggal_terbit}</td>
        <td data-col="dokumen" style="text-align: right;">
          <a href="../sertifikat/lihat.php?nomor=${encodeURIComponent(c.nomor_sertifikat)}" target="_blank" class="adm-doc-btn">
            <span>Buka</span>
            <i data-lucide="arrow-up-right" style="width: 13px; height: 13px;"></i>
          </a>
        </td>
      </tr>
    `).join('');

    if (window.lucide) lucide.createIcons();
  }

  function eksporCSV() {
    const baris = [
      ['Tipe', 'Nama', 'Email', 'Detail / Kursus', 'Nomor Sertifikat / Kota', 'Tanggal']
    ];

    daftarPesertaGlobal.forEach(p => {
      baris.push(['Peserta', p.nama, p.email, p.pekerjaan, p.kota, p.tgl_daftar]);
    });

    daftarSertifikatGlobal.forEach(s => {
      baris.push(['Sertifikat', s.nama_peserta, s.email || '-', s.nama_kursus, s.nomor_sertifikat, s.tanggal_terbit]);
    });

    const csv = '\uFEFF' + baris.map(r => r.map(v => `"${String(v).replace(/"/g, '""')}"`).join(',')).join('\r\n');
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = 'Data_Peserta_dan_Sertifikat_Skill4Life.csv';
    document.body.appendChild(link);
    link.click();
    link.remove();
    URL.revokeObjectURL(url);

    if (typeof tampilkanToast === 'function') {
      tampilkanToast('Berkas CSV berhasil diunduh', 'sukses');
    }
  }

  document.getElementById('cari-peserta').addEventListener('input', (e) => {
    const keyword = e.target.value.toLowerCase().trim();
    const terfilter = daftarPesertaGlobal.filter(p =>
      p.nama.toLowerCase().includes(keyword) ||
      p.email.toLowerCase().includes(keyword) ||
      p.kota.toLowerCase().includes(keyword) ||
      p.pekerjaan.toLowerCase().includes(keyword)
    );
    tampilkanPeserta(terfilter);
  });

  document.getElementById('btn-ekspor-csv').addEventListener('click', eksporCSV);

  document.addEventListener('DOMContentLoaded', async () => {
    tandaiTopbarResponsif();
    document.querySelectorAll('footer, .kaki-halaman').forEach(el => el.remove());

    const [peserta, sertifikat] = await Promise.all([
      ambilSemuaPeserta(),
      ambilSemuaSertifikat()
    ]);
    daftarPesertaGlobal = peserta;
    daftarSertifikatGlobal = sertifikat;
    tampilkanPeserta(daftarPesertaGlobal);
    tampilkanSertifikat(daftarSertifikatGlobal);

    if (window.lucide) lucide.createIcons();
  });
</script>