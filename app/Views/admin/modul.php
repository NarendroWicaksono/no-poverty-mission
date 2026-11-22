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

  .adm-modul-page,
  .adm-modul-page *,
  .adm-modal-backdrop,
  .adm-modal-backdrop * {
    box-sizing: border-box;
  }

  .adm-modul-page {
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

  /* Kartu Filter Pemilih Kursus */
  .adm-filter-card {
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 16px;
    padding: 16px 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    flex-wrap: wrap;
  }

  .adm-filter-group {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1 1 320px;
    min-width: 0;
  }

  .adm-filter-label {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    color: #3E3A34;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .adm-select {
    width: 100%;
    min-width: 0;
    height: 40px;
    padding: 0 36px 0 13px;
    border-radius: 10px;
    border: 1px solid #DCD6C8;
    background-color: #FAF9F6;
    color: #1C1A17;
    font-family: var(--font-ui);
    font-size: 13.5px;
    font-weight: 500;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235C5750' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 11px center;
    background-size: 15px;
    cursor: pointer;
    transition: border-color 140ms ease, background-color 140ms ease;
  }

  .adm-select:focus {
    outline: none;
    border-color: #1F6F4A;
    background-color: #FFFFFF;
  }

  .adm-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 32px;
    padding: 0 12px;
    border-radius: 9px;
    background-color: #F5F3EE;
    border: 1px solid #E6E2D8;
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #3E3A34;
    white-space: nowrap;
  }

  /* Kartu Tabel Modul */
  .adm-table-card {
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
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

  .adm-order-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 34px;
    height: 28px;
    padding: 0 8px;
    border-radius: 8px;
    background-color: #F5F3EE;
    border: 1px solid #E6E2D8;
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #5C5750;
  }

  .adm-modul-title {
    font-size: 14px;
    font-weight: 600;
    line-height: 1.45;
    color: #1C1A17;
  }

  .adm-duration-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    color: #5C5750;
    white-space: nowrap;
  }

  .adm-media-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 28px;
    padding: 0 10px;
    border-radius: 8px;
    background-color: #F5F3EE;
    border: 1px solid #E6E2D8;
    color: #5C5750;
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 600;
    white-space: nowrap;
  }

  .adm-media-badge.has-video {
    background-color: #F2EFE9;
    border-color: #DFD9CC;
    color: #1F6F4A;
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

  /* Dialog Modal Tambah / Edit Modul */
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
    max-width: 600px;
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

  .adm-textarea {
    min-height: 130px;
    padding: 11px 13px;
    resize: vertical;
  }

  .adm-textarea.is-code {
    font-family: var(--font-mono, monospace);
    font-size: 12.5px;
    line-height: 1.6;
  }

  .adm-input:focus,
  .adm-textarea:focus {
    outline: none;
    border-color: #1F6F4A;
    background-color: #FFFFFF;
  }

  .adm-order-title-grid {
    display: grid;
    grid-template-columns: 96px 1fr;
    gap: 12px;
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

    .adm-filter-card {
      padding: 14px 16px;
      border-radius: 14px;
    }

    .adm-filter-group {
      flex-direction: column;
      align-items: stretch;
      gap: 7px;
      flex: 1 1 100%;
    }

    .adm-count-badge {
      width: 100%;
      justify-content: center;
    }

    .adm-table-card {
      padding: 16px;
      border-radius: 14px;
    }

    /* Ubah Tabel Modul Menjadi Kartu Rapi di Layar HP */
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

    .adm-table td[data-col="urutan"] {
      display: inline-flex;
      align-items: center;
      padding-right: 210px;
      min-height: 32px;
    }

    .adm-table td[data-col="urutan"]::before {
      content: "Modul";
      font-family: var(--font-mono, monospace);
      font-size: 11px;
      font-weight: 600;
      color: #7A746B;
      margin-right: 6px;
    }

    .adm-table td[data-col="media"] {
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

    .adm-modul-title {
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
    .adm-order-title-grid,
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

<div class="adm-modul-page">
  <!-- Header Halaman -->
  <div class="adm-header">
    <div class="adm-header-info">
      <div class="adm-kicker">Panel Administrator &middot; Silabus</div>
      <h1 class="adm-title">Kelola modul pembelajaran</h1>
      <p class="adm-subtitle">
        Atur urutan materi, estimasi durasi belajar, dan tautan video penjelasan untuk setiap kursus.
      </p>
    </div>

    <button type="button" id="btn-tambah-modul" class="adm-btn-primary">
      <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
      <span>Tambah modul baru</span>
    </button>
  </div>

  <!-- Pemilih Kursus Dinamis -->
  <div class="adm-filter-card">
    <div class="adm-filter-group">
      <label for="pilih-kursus" class="adm-filter-label">
        <i data-lucide="book-open" style="width: 15px; height: 15px; color: #1F6F4A;"></i>
        <span>Pilih kursus:</span>
      </label>
      <select id="pilih-kursus" class="adm-select">
        <!-- Diisi dinamis -->
      </select>
    </div>
    <span class="adm-count-badge" id="badge-total-modul">0 modul terdaftar</span>
  </div>

  <!-- Tabel Modul Terdaftar -->
  <div class="adm-table-card">
    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th style="width: 82px;">Urutan</th>
            <th>Judul materi modul</th>
            <th style="width: 155px;">Estimasi waktu</th>
            <th style="width: 165px;">Format materi</th>
            <th style="width: 110px; text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody id="tabel-modul-body">
          <tr>
            <td colspan="5" class="adm-empty-cell">Memuat silabus modul...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Dialog Modal Tambah / Ubah Modul -->
<div class="adm-modal-backdrop" id="dialog-modul">
  <div class="adm-modal-card">
    <div class="adm-modal-head">
      <div>
        <h2 class="adm-modal-title" id="dialog-modul-judul">Tambah modul materi</h2>
        <p class="adm-modal-sub">Masukkan detail bacaan silabus dan tautan video pembelajaran</p>
      </div>
      <button type="button" id="btn-tutup-modul-x" class="adm-modal-close" aria-label="Tutup dialog">
        <i data-lucide="x" style="width: 16px; height: 16px;"></i>
      </button>
    </div>

    <form id="form-modal-modul">
      <div class="adm-modal-body">
        <input type="hidden" id="modal-modul-id" value="">

        <div class="adm-order-title-grid">
          <div class="adm-field">
            <label class="adm-label" for="modal-modul-urutan">Urutan</label>
            <input type="number" id="modal-modul-urutan" class="adm-input" value="1" min="1" required>
          </div>
          <div class="adm-field">
            <label class="adm-label" for="modal-modul-judul-teks">Judul modul</label>
            <input type="text" id="modal-modul-judul-teks" class="adm-input" placeholder="Contoh: Pengenalan Rumus Excel" required>
          </div>
        </div>

        <div class="adm-two-cols">
          <div class="adm-field">
            <label class="adm-label" for="modal-modul-durasi">Estimasi (menit)</label>
            <input type="number" id="modal-modul-durasi" class="adm-input" value="25" min="5" required>
          </div>
          <div class="adm-field">
            <label class="adm-label" for="modal-modul-video">URL video YouTube embed</label>
            <input type="url" id="modal-modul-video" class="adm-input" placeholder="https://www.youtube.com/embed/...">
          </div>
        </div>

        <div class="adm-field">
          <label class="adm-label" for="modal-modul-konten">Konten teks materi (HTML)</label>
          <textarea id="modal-modul-konten" class="adm-textarea is-code" placeholder="Tulis ringkasan atau teks bacaan materi di sini..." required></textarea>
        </div>
      </div>

      <div class="adm-modal-foot">
        <button type="button" id="btn-batal-modul" class="adm-btn-secondary" style="height: 38px;">Batal</button>
        <button type="submit" class="adm-btn-primary" style="height: 38px;">Simpan modul</button>
      </div>
    </form>
  </div>
</div>

<script type="module">
  import {
    ambilDaftarKursus,
    ambilDaftarModul,
    tambahModul,
    ubahModul,
    hapusModul
  } from '../assets/js/api.js';

  let modulListAktif = [];
  let slugKursusAktif = '';
  const selectKursus = document.getElementById('pilih-kursus');
  const dialog = document.getElementById('dialog-modul');

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

  async function inisialisasiKursus() {
    tandaiTopbarResponsif();
    document.querySelectorAll('footer, .kaki-halaman').forEach(el => el.remove());

    const kursusList = await ambilDaftarKursus();
    selectKursus.innerHTML = kursusList.map(k => `<option value="${k.slug}">${k.judul}</option>`).join('');
    if (kursusList.length > 0) {
      slugKursusAktif = kursusList[0].slug;
      await muatTabelModul();
    } else {
      document.getElementById('tabel-modul-body').innerHTML = `
        <tr><td colspan="5" class="adm-empty-cell">Belum ada data kursus tersedia.</td></tr>
      `;
    }

    if (window.lucide) lucide.createIcons();
  }

  async function muatTabelModul() {
    modulListAktif = await ambilDaftarModul(slugKursusAktif);
    const tbody = document.getElementById('tabel-modul-body');
    document.getElementById('badge-total-modul').textContent = `${modulListAktif.length} modul terdaftar`;

    if (!modulListAktif.length) {
      tbody.innerHTML = `<tr><td colspan="5" class="adm-empty-cell">Belum ada modul untuk kursus ini.</td></tr>`;
      return;
    }

    tbody.innerHTML = modulListAktif.map(m => `
      <tr>
        <td data-col="urutan">
          <span class="adm-order-pill">#${m.urutan}</span>
        </td>
        <td data-col="judul">
          <div class="adm-modul-title">${m.judul_modul}</div>
        </td>
        <td data-col="durasi">
          <span class="adm-duration-pill">
            <i data-lucide="clock" style="width: 13px; height: 13px; color: #1F6F4A;"></i>
            <span>${m.estimasi_menit} menit</span>
          </span>
        </td>
        <td data-col="media">
          ${m.video_url
            ? `<span class="adm-media-badge has-video"><i data-lucide="play-circle" style="width: 13px; height: 13px;"></i> Video + teks</span>`
            : `<span class="adm-media-badge"><i data-lucide="file-text" style="width: 13px; height: 13px;"></i> Teks bacaan</span>`}
        </td>
        <td data-col="aksi" style="text-align: right;">
          <div class="adm-row-actions">
            <button type="button" data-edit-id="${m.id}" class="adm-icon-btn btn-edit-modul" title="Ubah modul" aria-label="Ubah modul">
              <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
            </button>
            <button type="button" data-hapus-id="${m.id}" class="adm-icon-btn is-danger btn-hapus-modul" title="Hapus modul" aria-label="Hapus modul">
              <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
            </button>
          </div>
        </td>
      </tr>
    `).join('');

    if (window.lucide) lucide.createIcons();

    tbody.querySelectorAll('.btn-edit-modul').forEach(btn => {
      btn.addEventListener('click', () => bukaEditModul(Number(btn.dataset.editId)));
    });
    tbody.querySelectorAll('.btn-hapus-modul').forEach(btn => {
      btn.addEventListener('click', () => prosesHapusModul(Number(btn.dataset.hapusId)));
    });
  }

  function bukaTambahModul() {
    document.getElementById('dialog-modul-judul').textContent = 'Tambah modul materi';
    document.getElementById('modal-modul-id').value = '';
    document.getElementById('modal-modul-urutan').value = modulListAktif.length + 1;
    document.getElementById('modal-modul-judul-teks').value = '';
    document.getElementById('modal-modul-durasi').value = 20;
    document.getElementById('modal-modul-video').value = '';
    document.getElementById('modal-modul-konten').value = '';
    dialog.classList.add('terbuka');
  }

  function bukaEditModul(id) {
    const m = modulListAktif.find(item => item.id === id);
    if (!m) return;
    document.getElementById('dialog-modul-judul').textContent = 'Ubah modul materi';
    document.getElementById('modal-modul-id').value = m.id;
    document.getElementById('modal-modul-urutan').value = m.urutan;
    document.getElementById('modal-modul-judul-teks').value = m.judul_modul;
    document.getElementById('modal-modul-durasi').value = m.estimasi_menit;
    document.getElementById('modal-modul-video').value = m.video_url || '';
    document.getElementById('modal-modul-konten').value = m.konten || '';
    dialog.classList.add('terbuka');
  }

  function tutupModal() {
    dialog.classList.remove('terbuka');
  }

  async function prosesHapusModul(id) {
    if (!confirm('Hapus modul ini dari silabus kursus?')) return;
    await hapusModul(id);
    await muatTabelModul();
    if (typeof tampilkanToast === 'function') tampilkanToast('Modul berhasil dihapus', 'sukses');
  }

  selectKursus.addEventListener('change', async () => {
    slugKursusAktif = selectKursus.value;
    await muatTabelModul();
  });

  document.getElementById('btn-tambah-modul').addEventListener('click', bukaTambahModul);
  document.getElementById('btn-tutup-modul-x').addEventListener('click', tutupModal);
  document.getElementById('btn-batal-modul').addEventListener('click', tutupModal);
  dialog.addEventListener('click', e => { if (e.target === dialog) tutupModal(); });

  document.getElementById('form-modal-modul').addEventListener('submit', async (e) => {
    e.preventDefault();
    const idEdit = document.getElementById('modal-modul-id').value;
    const payload = {
      kursus_slug: slugKursusAktif,
      urutan: document.getElementById('modal-modul-urutan').value,
      judul_modul: document.getElementById('modal-modul-judul-teks').value.trim(),
      estimasi_menit: document.getElementById('modal-modul-durasi').value,
      video_url: document.getElementById('modal-modul-video').value.trim(),
      konten: document.getElementById('modal-modul-konten').value.trim()
    };

    if (idEdit) {
      await ubahModul(Number(idEdit), payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Modul berhasil diperbarui', 'sukses');
    } else {
      await tambahModul(payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Modul baru berhasil ditambahkan', 'sukses');
    }
    tutupModal();
    await muatTabelModul();
  });

  document.addEventListener('DOMContentLoaded', inisialisasiKursus);
</script>