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

  .adm-kursus-page,
  .adm-kursus-page *,
  .adm-modal-backdrop,
  .adm-modal-backdrop * {
    box-sizing: border-box;
  }

  .adm-kursus-page {
    font-family: var(--font-ui);
    color: #1C1A17;
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

  /* Tombol Utama & Sekunder */
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

  /* Kartu Tabel Daftar Kursus */
  .adm-table-card {
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
  }

  .adm-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 18px;
  }

  .adm-toolbar-left {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  .adm-toolbar-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: 16px;
    font-weight: 600;
    color: #1C1A17;
    margin: 0;
  }

  .adm-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    height: 28px;
    padding: 0 10px;
    border-radius: 8px;
    background-color: #F5F3EE;
    border: 1px solid #E6E2D8;
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 600;
    color: #3E3A34;
    white-space: nowrap;
  }

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
    color: #7A746B;
    pointer-events: none;
    display: inline-flex;
    align-items: center;
  }

  .adm-search-input {
    width: 100%;
    height: 38px;
    padding: 0 13px 0 36px;
    border-radius: 10px;
    border: 1px solid #DCD6C8;
    background-color: #FAF9F6;
    color: #1C1A17;
    font-family: var(--font-ui);
    font-size: 13px;
    transition: border-color 140ms ease, background-color 140ms ease;
  }

  .adm-search-input::placeholder {
    color: #8A847A;
  }

  .adm-search-input:focus {
    outline: none;
    border-color: #1F6F4A;
    background-color: #FFFFFF;
  }

  .adm-table-wrap {
    width: 100%;
    overflow-x: auto;
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
    padding: 15px 16px;
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

  .adm-num-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 28px;
    height: 28px;
    padding: 0 7px;
    border-radius: 8px;
    background-color: #F5F3EE;
    border: 1px solid #E6E2D8;
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #5C5750;
  }

  .adm-course-title {
    font-size: 14px;
    font-weight: 600;
    line-height: 1.45;
    color: #1C1A17;
    margin-bottom: 3px;
  }

  .adm-course-cat {
    font-size: 12.5px;
    color: #7A746B;
  }

  .adm-level-badge {
    display: inline-flex;
    align-items: center;
    height: 27px;
    padding: 0 10px;
    border-radius: 8px;
    background-color: #F2EFE9;
    border: 1px solid #DFD9CC;
    color: #1F6F4A;
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 600;
    white-space: nowrap;
  }

  .adm-meta-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    color: #5C5750;
    white-space: nowrap;
  }

  .adm-row-actions {
    display: inline-flex;
    align-items: center;
    justify-content: flex-end;
    gap: 6px;
  }

  .adm-icon-btn {
    width: 32px;
    height: 32px;
    border-radius: 9px;
    border: 1px solid #DCD6C8;
    background-color: #FFFFFF;
    color: #3E3A34;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .adm-icon-btn svg,
  .adm-icon-btn i {
    pointer-events: none;
  }

  .adm-icon-btn:hover {
    border-color: #1F6F4A;
    color: #1F6F4A;
    background-color: #FAF9F6;
  }

  .adm-icon-btn.is-danger:hover {
    border-color: #D6A8A3;
    color: #9E3B33;
    background-color: #FBF4F3;
  }

  .adm-empty-cell {
    text-align: center !important;
    padding: 36px 20px !important;
    color: #7A746B;
    font-size: 13.5px;
  }

  /* Dialog Modal Tambah / Edit Kursus */
  .adm-modal-backdrop {
    position: fixed;
    inset: 0;
    z-index: 999;
    background-color: rgba(28, 26, 23, 0.45);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 16px;
    overflow-y: auto;
  }

  .adm-modal-backdrop.terbuka {
    display: flex;
  }

  .adm-modal-card {
    width: 100%;
    max-width: 580px;
    max-height: calc(100vh - 32px);
    overflow-y: auto;
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 16px;
    box-shadow: 0 18px 40px rgba(28, 26, 23, 0.14);
  }

  .adm-modal-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    padding: 20px 24px 16px;
    border-bottom: 1px solid #EFECE4;
  }

  .adm-modal-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: 17px;
    font-weight: 700;
    color: #1C1A17;
    margin: 0 0 3px;
  }

  .adm-modal-sub {
    font-size: 12.5px;
    color: #7A746B;
    margin: 0;
  }

  .adm-modal-close {
    width: 32px;
    height: 32px;
    border-radius: 9px;
    border: 1px solid #E6E2D8;
    background-color: #FAF9F6;
    color: #5C5750;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    transition: border-color 140ms ease, color 140ms ease;
  }

  .adm-modal-close:hover {
    border-color: #1C1A17;
    color: #1C1A17;
  }

  .adm-modal-body {
    padding: 20px 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .adm-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .adm-label {
    font-size: 12.5px;
    font-weight: 600;
    color: #3E3A34;
  }

  .adm-input,
  .adm-select,
  .adm-textarea {
    width: 100%;
    border-radius: 10px;
    border: 1px solid #DCD6C8;
    background-color: #FAF9F6;
    color: #1C1A17;
    font-family: var(--font-ui);
    font-size: 13.5px;
    line-height: 1.5;
    transition: border-color 140ms ease, background-color 140ms ease;
  }

  .adm-input {
    height: 40px;
    padding: 0 13px;
  }

  .adm-select {
    height: 40px;
    padding: 0 36px 0 13px;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235C5750' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 11px center;
    background-size: 15px;
    cursor: pointer;
  }

  .adm-textarea {
    min-height: 86px;
    padding: 10px 13px;
    resize: vertical;
  }

  .adm-input:focus,
  .adm-select:focus,
  .adm-textarea:focus {
    outline: none;
    border-color: #1F6F4A;
    background-color: #FFFFFF;
  }

  .adm-two-cols {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .adm-modal-foot {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    padding: 16px 24px 20px;
    border-top: 1px solid #EFECE4;
    background-color: #FAF9F6;
    border-bottom-left-radius: 16px;
    border-bottom-right-radius: 16px;
  }

  /* Responsif Layar HP */
  @media (max-width: 720px) {
    .adm-header {
      align-items: stretch;
      margin-bottom: 18px;
    }

    .adm-header .adm-btn-primary {
      width: 100%;
    }

    .adm-table-card {
      padding: 16px;
      border-radius: 14px;
    }

    .adm-toolbar {
      align-items: stretch;
      gap: 12px;
    }

    .adm-toolbar-left {
      justify-content: space-between;
    }

    .adm-search-box {
      max-width: 100%;
    }

    /* Ubah Tabel Kursus Menjadi Kartu Rapi di Layar HP */
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
      gap: 10px;
      padding: 15px;
      border: 1px solid #E6E2D8;
      border-radius: 12px;
      background-color: #FAF9F6;
      margin-bottom: 12px;
      position: relative;
    }

    .adm-table tbody tr:last-child {
      margin-bottom: 0;
    }

    .adm-table td {
      display: block;
      padding: 0;
      border-bottom: none;
    }

    .adm-table td[data-col="no"] {
      display: inline-flex;
      align-items: center;
      padding-right: 170px;
      min-height: 32px;
    }

    .adm-table td[data-col="no"]::before {
      content: "Kursus #";
      font-family: var(--font-mono, monospace);
      font-size: 11px;
      font-weight: 600;
      color: #7A746B;
      margin-right: 6px;
    }

    .adm-table td[data-col="tingkat"] {
      position: absolute;
      top: 15px;
      right: 88px;
    }

    .adm-table td[data-col="aksi"] {
      position: absolute;
      top: 13px;
      right: 14px;
    }

    .adm-table td[data-col="judul"] {
      padding-top: 9px;
      border-top: 1px solid #E6E2D8;
    }

    .adm-course-title {
      font-size: 14.5px;
    }

    .adm-table td[data-col="durasi"] {
      background-color: #FFFFFF;
      border: 1px solid #EAE6DC;
      border-radius: 10px;
      padding: 9px 12px;
    }
  }

  @media (max-width: 560px) {
    .adm-two-cols {
      grid-template-columns: 1fr;
    }

    .adm-modal-head,
    .adm-modal-body,
    .adm-modal-foot {
      padding-left: 18px;
      padding-right: 18px;
    }

    .adm-modal-foot {
      display: grid;
      grid-template-columns: 1fr 1fr;
    }

    .adm-modal-foot button {
      width: 100%;
    }
  }
</style>

<div class="adm-kursus-page">
  <!-- Header Halaman -->
  <div class="adm-header">
    <div class="adm-header-info">
      <div class="adm-kicker">Panel Administrator &middot; Kurikulum</div>
      <h1 class="adm-title">Kelola kursus</h1>
      <p class="adm-subtitle">
        Daftar kurikulum keterampilan kerja aktif yang tersedia di katalog publik Skill4Life.
      </p>
    </div>

    <button type="button" id="btn-tambah-kursus" class="adm-btn-primary">
      <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
      <span>Tambah kursus baru</span>
    </button>
  </div>

  <!-- Kartu Daftar Kursus -->
  <div class="adm-table-card">
    <div class="adm-toolbar">
      <div class="adm-toolbar-left">
        <h2 class="adm-toolbar-title">Daftar kursus terdaftar</h2>
        <span class="adm-count-badge"><span id="total-kursus-badge">0</span> kursus</span>
      </div>

      <div class="adm-search-box">
        <span class="adm-search-icon">
          <i data-lucide="search" style="width: 15px; height: 15px;"></i>
        </span>
        <input type="search" id="cari-kursus" class="adm-search-input" placeholder="Cari judul atau kategori...">
      </div>
    </div>

    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th style="width: 64px;">No</th>
            <th>Judul &amp; kategori</th>
            <th style="width: 130px;">Tingkat</th>
            <th style="width: 190px;">Durasi &amp; modul</th>
            <th style="width: 110px; text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody id="tabel-kursus-body">
          <tr>
            <td colspan="5" class="adm-empty-cell">Memuat data kursus...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Dialog Modal Tambah / Ubah Kursus -->
<div class="adm-modal-backdrop" id="dialog-kursus">
  <div class="adm-modal-card">
    <div class="adm-modal-head">
      <div>
        <h2 class="adm-modal-title" id="dialog-kursus-judul">Tambah kursus baru</h2>
        <p class="adm-modal-sub">Masukkan informasi kurikulum keterampilan kerja untuk katalog peserta</p>
      </div>
      <button type="button" id="btn-tutup-modal-x" class="adm-modal-close" aria-label="Tutup dialog">
        <i data-lucide="x" style="width: 16px; height: 16px;"></i>
      </button>
    </div>

    <form id="form-modal-kursus">
      <div class="adm-modal-body">
        <input type="hidden" id="modal-kursus-id" value="">

        <div class="adm-field">
          <label class="adm-label" for="modal-judul">Judul kursus</label>
          <input type="text" id="modal-judul" class="adm-input" placeholder="Contoh: Microsoft Excel Dasar" required>
        </div>

        <div class="adm-field">
          <label class="adm-label" for="modal-kategori">Kategori</label>
          <select id="modal-kategori" class="adm-select" required>
            <option value="Aplikasi perkantoran">Aplikasi perkantoran</option>
            <option value="Kesiapan karir dan kerja">Kesiapan karir dan kerja</option>
            <option value="Kewirausahaan dan literasi keuangan">Kewirausahaan dan literasi keuangan</option>
          </select>
        </div>

        <div class="adm-two-cols">
          <div class="adm-field">
            <label class="adm-label" for="modal-tingkat">Tingkat kesulitan</label>
            <select id="modal-tingkat" class="adm-select">
              <option value="Pemula">Pemula</option>
              <option value="Menengah">Menengah</option>
              <option value="Lanjut">Lanjut</option>
            </select>
          </div>
          <div class="adm-field">
            <label class="adm-label" for="modal-durasi">Estimasi waktu</label>
            <input type="text" id="modal-durasi" class="adm-input" value="2 jam" placeholder="Contoh: 2.5 jam" required>
          </div>
        </div>

        <div class="adm-field">
          <label class="adm-label" for="modal-ringkasan">Ringkasan singkat</label>
          <textarea id="modal-ringkasan" class="adm-textarea" placeholder="Penjelasan singkat mengenai materi dan manfaat kursus..." required></textarea>
        </div>
      </div>

      <div class="adm-modal-foot">
        <button type="button" id="btn-batal-modal" class="adm-btn-secondary" style="height: 38px;">Batal</button>
        <button type="submit" class="adm-btn-primary" style="height: 38px;">Simpan data kursus</button>
      </div>
    </form>
  </div>
</div>

<script type="module">
  import {
    ambilDaftarKursus,
    tambahKursus,
    ubahKursus,
    hapusKursus
  } from '../assets/js/api.js';

  let daftarKursusGlobal = [];
  const dialog = document.getElementById('dialog-kursus');

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

  async function muatTabelKursus() {
    daftarKursusGlobal = await ambilDaftarKursus();
    saringDanRender();
  }

  function saringDanRender() {
    const q = document.getElementById('cari-kursus').value.toLowerCase().trim();
    const terfilter = daftarKursusGlobal.filter(k =>
      k.judul.toLowerCase().includes(q) ||
      (k.kategori && k.kategori.toLowerCase().includes(q))
    );
    tampilkanTabelKursus(terfilter);
  }

  function tampilkanTabelKursus(data) {
    const tbody = document.getElementById('tabel-kursus-body');
    document.getElementById('total-kursus-badge').textContent = data.length;

    if (!data.length) {
      tbody.innerHTML = `<tr><td colspan="5" class="adm-empty-cell">Tidak ada data kursus yang cocok.</td></tr>`;
      return;
    }

    tbody.innerHTML = data.map((k, idx) => `
      <tr>
        <td data-col="no">
          <span class="adm-num-pill">${idx + 1}</span>
        </td>
        <td data-col="judul">
          <div class="adm-course-title">${k.judul}</div>
          <div class="adm-course-cat">${k.kategori || 'Keterampilan kerja'}</div>
        </td>
        <td data-col="tingkat">
          <span class="adm-level-badge">${k.level || 'Pemula'}</span>
        </td>
        <td data-col="durasi">
          <span class="adm-meta-pill">
            <i data-lucide="layers" style="width: 13px; height: 13px; color: #1F6F4A;"></i>
            <span>${k.jumlah_modul || 0} modul &middot; ${k.estimasi_waktu || '2 jam'}</span>
          </span>
        </td>
        <td data-col="aksi" style="text-align: right;">
          <div class="adm-row-actions">
            <button type="button" data-edit-id="${k.id_kursus}" class="adm-icon-btn btn-edit-kursus" title="Ubah data" aria-label="Ubah data kursus">
              <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
            </button>
            <button type="button" data-hapus-id="${k.id_kursus}" class="adm-icon-btn is-danger btn-hapus-kursus" title="Hapus kursus" aria-label="Hapus kursus">
              <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
            </button>
          </div>
        </td>
      </tr>
    `).join('');

    if (window.lucide) lucide.createIcons();

    tbody.querySelectorAll('.btn-edit-kursus').forEach(btn => {
      btn.addEventListener('click', () => bukaEditKursus(Number(btn.dataset.editId)));
    });
    tbody.querySelectorAll('.btn-hapus-kursus').forEach(btn => {
      btn.addEventListener('click', () => prosesHapusKursus(Number(btn.dataset.hapusId)));
    });
  }

  function bukaTambahKursus() {
    document.getElementById('dialog-kursus-judul').textContent = 'Tambah kursus baru';
    document.getElementById('modal-kursus-id').value = '';
    document.getElementById('modal-judul').value = '';
    document.getElementById('modal-kategori').value = 'Aplikasi perkantoran';
    document.getElementById('modal-tingkat').value = 'Pemula';
    document.getElementById('modal-durasi').value = '2 jam';
    document.getElementById('modal-ringkasan').value = '';
    dialog.classList.add('terbuka');
  }

  function bukaEditKursus(id) {
    const k = daftarKursusGlobal.find(item => item.id_kursus === id);
    if (!k) return;
    document.getElementById('dialog-kursus-judul').textContent = 'Ubah data kursus';
    document.getElementById('modal-kursus-id').value = k.id_kursus;
    document.getElementById('modal-judul').value = k.judul;
    document.getElementById('modal-kategori').value = k.kategori;
    document.getElementById('modal-tingkat').value = k.level || 'Pemula';
    document.getElementById('modal-durasi').value = k.estimasi_waktu || '2 jam';
    document.getElementById('modal-ringkasan').value = k.ringkasan || '';
    dialog.classList.add('terbuka');
  }

  function tutupModal() {
    dialog.classList.remove('terbuka');
  }

  async function prosesHapusKursus(id) {
    if (!confirm('Hapus kursus ini beserta modul dan soal kuisnya?')) return;
    await hapusKursus(id);
    await muatTabelKursus();
    if (typeof tampilkanToast === 'function') tampilkanToast('Kursus berhasil dihapus', 'sukses');
  }

  document.getElementById('btn-tambah-kursus').addEventListener('click', bukaTambahKursus);
  document.getElementById('btn-tutup-modal-x').addEventListener('click', tutupModal);
  document.getElementById('btn-batal-modal').addEventListener('click', tutupModal);
  dialog.addEventListener('click', e => { if (e.target === dialog) tutupModal(); });
  document.getElementById('cari-kursus').addEventListener('input', saringDanRender);

  document.getElementById('form-modal-kursus').addEventListener('submit', async (e) => {
    e.preventDefault();
    const idEdit = document.getElementById('modal-kursus-id').value;
    const payload = {
      judul: document.getElementById('modal-judul').value.trim(),
      kategori: document.getElementById('modal-kategori').value,
      level: document.getElementById('modal-tingkat').value,
      estimasi_waktu: document.getElementById('modal-durasi').value.trim(),
      ringkasan: document.getElementById('modal-ringkasan').value.trim()
    };

    if (idEdit) {
      await ubahKursus(Number(idEdit), payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Perubahan kursus berhasil disimpan', 'sukses');
    } else {
      await tambahKursus(payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Kursus baru berhasil ditambahkan ke katalog', 'sukses');
    }
    tutupModal();
    await muatTabelKursus();
  });

  document.addEventListener('DOMContentLoaded', async () => {
    tandaiTopbarResponsif();
    document.querySelectorAll('footer, .kaki-halaman').forEach(el => el.remove());
    if (window.lucide) lucide.createIcons();
    await muatTabelKursus();
  });
</script>