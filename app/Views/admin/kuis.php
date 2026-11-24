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

  .adm-kuis-page,
  .adm-kuis-page *,
  .adm-modal-backdrop,
  .adm-modal-backdrop * {
    box-sizing: border-box;
  }

  .adm-kuis-page {
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

  /* Tombol Utama & Sekunder */
  .adm-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 40px;
    padding: 0 16px;
    border-radius: 10px;
    border: 1px solid #1DB954;
    background-color: #0D3820;
    color: #FFFFFF !important; font-weight: 700; border: 1px solid #1DB954;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: background-color 140ms ease;
  }

  .adm-btn-primary:hover {
    background-color: #154D2E;
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
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF !important;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 500;
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

  /* Kartu Filter Pemilih Kursus */
  .adm-filter-card {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
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
    color: #E0E0E0;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .adm-select {
    width: 100%;
    min-width: 0;
    height: 40px;
    padding: 0 36px 0 13px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF;
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
    border-color: #1DB954;
    background-color: #181818;
  }

  .adm-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 32px;
    padding: 0 12px;
    border-radius: 9px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #E0E0E0;
    white-space: nowrap;
  }

  /* Kartu Tabel Bank Soal */
  .adm-table-card {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
  }

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
    padding: 15px 16px;
    border-bottom: 1px solid #242424;
    color: #FFFFFF;
    vertical-align: top;
  }

  .adm-table tbody tr:last-child td {
    border-bottom: none;
  }

  .adm-table tbody tr:hover {
    background-color: #181818;
  }

  .adm-num-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 28px;
    height: 28px;
    padding: 0 7px;
    border-radius: 8px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #B3B3B3;
  }

  .adm-question-text {
    font-size: 14px;
    font-weight: 600;
    line-height: 1.5;
    color: #FFFFFF;
    max-width: 460px;
  }

  .adm-key-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 34px;
    height: 28px;
    padding: 0 10px;
    border-radius: 8px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: #1DB954;
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 700;
  }

  .adm-explanation-text {
    font-size: 13px;
    line-height: 1.55;
    color: #B3B3B3;
    max-width: 340px;
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
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #E0E0E0;
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
    border-color: #1DB954;
    color: #1DB954;
    background-color: #181818;
  }

  .adm-icon-btn.is-danger:hover {
    border-color: #D6A8A3;
    color: #F15E6C;
    background-color: rgba(241, 94, 108, 0.15);
  }

  .adm-empty-cell {
    text-align: center !important;
    padding: 36px 20px !important;
    color: #B3B3B3;
    font-size: 13.5px;
  }

  /* Dialog Modal Tambah / Edit Soal */
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
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    box-shadow: 0 18px 40px rgba(28, 26, 23, 0.14);
  }

  .adm-modal-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    padding: 20px 24px 16px;
    border-bottom: 1px solid #242424;
  }

  .adm-modal-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: 17px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0 0 3px;
  }

  .adm-modal-sub {
    font-size: 12.5px;
    color: #B3B3B3;
    margin: 0;
  }

  .adm-modal-close {
    width: 32px;
    height: 32px;
    border-radius: 9px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #B3B3B3;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    transition: border-color 140ms ease, color 140ms ease;
  }

  .adm-modal-close:hover {
    border-color: #FFFFFF;
    color: #FFFFFF;
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
    color: #E0E0E0;
  }

  .adm-input,
  .adm-textarea {
    width: 100%;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF;
    font-family: var(--font-ui);
    font-size: 13.5px;
    line-height: 1.5;
    padding: 10px 13px;
    transition: border-color 140ms ease, background-color 140ms ease;
  }

  .adm-input {
    height: 40px;
    padding: 0 13px;
  }

  .adm-textarea {
    min-height: 82px;
    resize: vertical;
  }

  .adm-input:focus,
  .adm-textarea:focus {
    outline: none;
    border-color: #1DB954;
    background-color: #181818;
  }

  .adm-options-grid {
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
    border-top: 1px solid #242424;
    background-color: #181818;
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

    /* Ubah Tabel Soal Menjadi Kartu Rapi di Layar HP */
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
      display: block;
      padding: 0;
      border-bottom: none;
    }

    .adm-table td[data-col="no"] {
      display: inline-flex;
      align-items: center;
      padding-right: 120px;
      min-height: 32px;
    }

    .adm-table td[data-col="no"]::before {
      content: "Soal #";
      font-family: var(--font-mono, monospace);
      font-size: 11px;
      font-weight: 600;
      color: #B3B3B3;
      margin-right: 6px;
    }

    .adm-table td[data-col="kunci"] {
      position: absolute;
      top: 15px;
      right: 88px;
    }

    .adm-table td[data-col="aksi"] {
      position: absolute;
      top: 13px;
      right: 14px;
    }

    .adm-table td[data-col="pertanyaan"] {
      padding-top: 8px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .adm-question-text {
      max-width: 100%;
      font-size: 14px;
    }

    .adm-table td[data-col="pembahasan"] {
      background-color: #181818;
      border: 1px solid #242424;
      border-radius: 10px;
      padding: 10px 12px;
    }

    .adm-table td[data-col="pembahasan"]::before {
      content: "Pembahasan";
      display: block;
      font-family: var(--font-mono, monospace);
      font-size: 10.5px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      color: #B3B3B3;
      margin-bottom: 4px;
    }

    .adm-explanation-text {
      max-width: 100%;
      font-size: 12.5px;
    }
  }

  @media (max-width: 560px) {
    .adm-options-grid {
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

<div class="adm-kuis-page">
  <!-- Header Halaman -->
  <div class="adm-header">
    <div class="adm-header-info">
      <div class="adm-kicker">Panel Administrator &middot; Evaluasi</div>
      <h1 class="adm-title">Kelola soal kuis</h1>
      <p class="adm-subtitle">
        Bank soal evaluasi akhir kursus pilihan ganda lengkap dengan kunci jawaban dan pembahasan.
      </p>
    </div>

    <button type="button" id="btn-tambah-kuis" class="adm-btn-primary">
      <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
      <span>Tambah butir soal</span>
    </button>
  </div>

  <!-- Pemilih Kursus Dinamis -->
  <div class="adm-filter-card">
    <div class="adm-filter-group">
      <label for="pilih-kursus-kuis" class="adm-filter-label">
        <i data-lucide="book-open" style="width: 15px; height: 15px; color: #1DB954;"></i>
        <span>Pilih kursus:</span>
      </label>
      <select id="pilih-kursus-kuis" class="adm-select">
        <!-- Diisi dinamis -->
      </select>
    </div>
    <span class="adm-count-badge" id="badge-total-soal">0 butir soal</span>
  </div>

  <!-- Tabel Butir Soal -->
  <div class="adm-table-card">
    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th style="width: 64px;">No</th>
            <th>Pertanyaan kuis</th>
            <th style="width: 90px;">Kunci</th>
            <th>Pembahasan jawaban</th>
            <th style="width: 110px; text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody id="tabel-kuis-body">
          <tr>
            <td colspan="5" class="adm-empty-cell">Memuat bank soal kuis...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Dialog Modal Tambah / Ubah Soal Kuis -->
<div class="adm-modal-backdrop" id="dialog-kuis">
  <div class="adm-modal-card">
    <div class="adm-modal-head">
      <div>
        <h2 class="adm-modal-title" id="dialog-kuis-judul">Tambah butir soal kuis</h2>
        <p class="adm-modal-sub">Masukkan pertanyaan pilihan ganda beserta kunci jawaban dan pembahasan</p>
      </div>
      <button type="button" id="btn-tutup-kuis-x" class="adm-modal-close" aria-label="Tutup dialog">
        <i data-lucide="x" style="width: 16px; height: 16px;"></i>
      </button>
    </div>

    <form id="form-modal-kuis">
      <div class="adm-modal-body">
        <input type="hidden" id="modal-kuis-id" value="">

        <div class="adm-field">
          <label class="adm-label" for="modal-pertanyaan">Kalimat pertanyaan</label>
          <textarea id="modal-pertanyaan" class="adm-textarea" placeholder="Tuliskan pertanyaan di sini..." required></textarea>
        </div>

        <div class="adm-options-grid">
          <div class="adm-field">
            <label class="adm-label" for="modal-opsi-a">Pilihan A</label>
            <input type="text" id="modal-opsi-a" class="adm-input" placeholder="Teks opsi A" required>
          </div>
          <div class="adm-field">
            <label class="adm-label" for="modal-opsi-b">Pilihan B</label>
            <input type="text" id="modal-opsi-b" class="adm-input" placeholder="Teks opsi B" required>
          </div>
          <div class="adm-field">
            <label class="adm-label" for="modal-opsi-c">Pilihan C</label>
            <input type="text" id="modal-opsi-c" class="adm-input" placeholder="Teks opsi C" required>
          </div>
          <div class="adm-field">
            <label class="adm-label" for="modal-opsi-d">Pilihan D</label>
            <input type="text" id="modal-opsi-d" class="adm-input" placeholder="Teks opsi D" required>
          </div>
        </div>

        <div class="adm-field">
          <label class="adm-label" for="modal-kunci">Kunci jawaban benar</label>
          <select id="modal-kunci" class="adm-select" required>
            <option value="A">Pilihan A</option>
            <option value="B">Pilihan B</option>
            <option value="C">Pilihan C</option>
            <option value="D">Pilihan D</option>
          </select>
        </div>

        <div class="adm-field">
          <label class="adm-label" for="modal-pembahasan">Penjelasan pembahasan singkat</label>
          <textarea id="modal-pembahasan" class="adm-textarea" placeholder="Jelaskan alasan kunci jawaban benar..." required></textarea>
        </div>
      </div>

      <div class="adm-modal-foot">
        <button type="button" id="btn-batal-kuis" class="adm-btn-secondary" style="height: 38px;">Batal</button>
        <button type="submit" class="adm-btn-primary" style="height: 38px;">Simpan butir soal</button>
      </div>
    </form>
  </div>
</div>

<script type="module">
  import {
    ambilDaftarKursus,
    ambilSoalKuisAdmin,
    tambahSoalKuis,
    ubahSoalKuis,
    hapusSoalKuis
  } from '../assets/js/api.js';

  let soalListAktif = [];
  let kuisSlugAktif = '';
  const selectKursus = document.getElementById('pilih-kursus-kuis');
  const dialog = document.getElementById('dialog-kuis');

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
      kuisSlugAktif = kursusList[0].slug;
      await muatTabelKuis();
    } else {
      document.getElementById('tabel-kuis-body').innerHTML = `
        <tr><td colspan="5" class="adm-empty-cell">Belum ada data kursus tersedia.</td></tr>
      `;
    }

    if (window.lucide) lucide.createIcons();
  }

  async function muatTabelKuis() {
    soalListAktif = await ambilSoalKuisAdmin(kuisSlugAktif);
    const tbody = document.getElementById('tabel-kuis-body');
    document.getElementById('badge-total-soal').textContent = `${soalListAktif.length} butir soal`;

    if (!soalListAktif.length) {
      tbody.innerHTML = `<tr><td colspan="5" class="adm-empty-cell">Belum ada butir soal untuk kursus ini.</td></tr>`;
      return;
    }

    tbody.innerHTML = soalListAktif.map((s, idx) => `
      <tr>
        <td data-col="no">
          <span class="adm-num-pill">${idx + 1}</span>
        </td>
        <td data-col="pertanyaan">
          <div class="adm-question-text">${s.pertanyaan}</div>
        </td>
        <td data-col="kunci">
          <span class="adm-key-badge" title="Kunci jawaban: ${s.jawaban_benar}">${s.jawaban_benar}</span>
        </td>
        <td data-col="pembahasan">
          <div class="adm-explanation-text">${s.pembahasan || '-'}</div>
        </td>
        <td data-col="aksi" style="text-align: right;">
          <div class="adm-row-actions">
            <button type="button" data-edit-id="${s.id}" class="adm-icon-btn btn-edit-kuis" title="Ubah butir soal" aria-label="Ubah butir soal">
              <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
            </button>
            <button type="button" data-hapus-id="${s.id}" class="adm-icon-btn is-danger btn-hapus-kuis" title="Hapus butir soal" aria-label="Hapus butir soal">
              <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
            </button>
          </div>
        </td>
      </tr>
    `).join('');

    if (window.lucide) lucide.createIcons();

    tbody.querySelectorAll('.btn-edit-kuis').forEach(btn => {
      btn.addEventListener('click', () => bukaEditKuis(Number(btn.dataset.editId)));
    });
    tbody.querySelectorAll('.btn-hapus-kuis').forEach(btn => {
      btn.addEventListener('click', () => prosesHapusKuis(Number(btn.dataset.hapusId)));
    });
  }

  function bukaTambahKuis() {
    document.getElementById('dialog-kuis-judul').textContent = 'Tambah butir soal kuis';
    document.getElementById('modal-kuis-id').value = '';
    document.getElementById('modal-pertanyaan').value = '';
    document.getElementById('modal-opsi-a').value = '';
    document.getElementById('modal-opsi-b').value = '';
    document.getElementById('modal-opsi-c').value = '';
    document.getElementById('modal-opsi-d').value = '';
    document.getElementById('modal-kunci').value = 'A';
    document.getElementById('modal-pembahasan').value = '';
    dialog.classList.add('terbuka');
  }

  function bukaEditKuis(id) {
    const s = soalListAktif.find(item => item.id === id);
    if (!s) return;
    document.getElementById('dialog-kuis-judul').textContent = 'Ubah butir soal kuis';
    document.getElementById('modal-kuis-id').value = s.id;
    document.getElementById('modal-pertanyaan').value = s.pertanyaan;
    document.getElementById('modal-opsi-a').value = s.pilihan ? s.pilihan.A : '';
    document.getElementById('modal-opsi-b').value = s.pilihan ? s.pilihan.B : '';
    document.getElementById('modal-opsi-c').value = s.pilihan ? s.pilihan.C : '';
    document.getElementById('modal-opsi-d').value = s.pilihan ? s.pilihan.D : '';
    document.getElementById('modal-kunci').value = s.jawaban_benar;
    document.getElementById('modal-pembahasan').value = s.pembahasan || '';
    dialog.classList.add('terbuka');
  }

  function tutupModal() {
    dialog.classList.remove('terbuka');
  }

  async function prosesHapusKuis(id) {
    if (!confirm('Hapus butir soal ini dari evaluasi kursus?')) return;
    await hapusSoalKuis(id);
    await muatTabelKuis();
    if (typeof tampilkanToast === 'function') tampilkanToast('Butir soal berhasil dihapus', 'sukses');
  }

  selectKursus.addEventListener('change', async () => {
    kuisSlugAktif = selectKursus.value;
    await muatTabelKuis();
  });

  document.getElementById('btn-tambah-kuis').addEventListener('click', bukaTambahKuis);
  document.getElementById('btn-tutup-kuis-x').addEventListener('click', tutupModal);
  document.getElementById('btn-batal-kuis').addEventListener('click', tutupModal);
  dialog.addEventListener('click', e => { if (e.target === dialog) tutupModal(); });

  document.getElementById('form-modal-kuis').addEventListener('submit', async (e) => {
    e.preventDefault();
    const idEdit = document.getElementById('modal-kuis-id').value;
    const payload = {
      kursus_slug: kuisSlugAktif,
      pertanyaan: document.getElementById('modal-pertanyaan').value.trim(),
      opsi_a: document.getElementById('modal-opsi-a').value.trim(),
      opsi_b: document.getElementById('modal-opsi-b').value.trim(),
      opsi_c: document.getElementById('modal-opsi-c').value.trim(),
      opsi_d: document.getElementById('modal-opsi-d').value.trim(),
      jawaban_benar: document.getElementById('modal-kunci').value,
      pembahasan: document.getElementById('modal-pembahasan').value.trim()
    };

    if (idEdit) {
      await ubahSoalKuis(Number(idEdit), payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Butir soal berhasil diperbarui', 'sukses');
    } else {
      await tambahSoalKuis(payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Butir soal baru berhasil ditambahkan', 'sukses');
    }
    tutupModal();
    await muatTabelKuis();
  });

  document.addEventListener('DOMContentLoaded', inisialisasiKursus);
</script>