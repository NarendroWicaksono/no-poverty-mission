<style>
  .vf-page {
    background-color: #121212;
    min-height: calc(100vh - 72px);
    font-family: var(--font-ui);
    color: #FFFFFF;
  }

  /* Header Halaman */
  .vf-hero {
    background-color: #181818;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    padding: 40px 20px 36px;
  }

  .vf-container {
    max-width: 780px;
    margin: 0 auto;
  }

  .vf-kicker {
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #1DB954;
    margin-bottom: 8px;
  }

  .vf-title {
    font-family: var(--font-serif);
    font-size: clamp(28px, 4vw, 36px);
    font-weight: 600;
    letter-spacing: -0.02em;
    line-height: 1.2;
    color: #FFFFFF;
    margin: 0 0 10px;
  }

  .vf-subtitle {
    font-size: 15px;
    line-height: 1.6;
    color: #B3B3B3;
    max-width: 620px;
    margin: 0;
  }

  /* Konten Utama */
  .vf-main {
    padding: 32px 20px 72px;
  }

  /* Panel Pencarian */
  .vf-search-panel {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    padding: 24px;
    margin-bottom: 24px;
  }

  .vf-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #FFFFFF;
    margin-bottom: 8px;
  }

  .vf-search-row {
    display: flex;
    gap: 10px;
    align-items: stretch;
  }

  .vf-input-wrap {
    position: relative;
    flex: 1;
    display: flex;
    align-items: center;
  }

  .vf-input {
    width: 100%;
    height: 44px;
    padding: 0 38px 0 14px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    font-family: var(--font-mono, monospace);
    font-size: 14.5px;
    font-weight: 500;
    letter-spacing: 0.02em;
    color: #FFFFFF;
    transition: border-color 140ms ease, box-shadow 140ms ease;
  }

  .vf-input::placeholder {
    color: #727272;
    font-weight: 400;
  }

  .vf-input:focus {
    outline: none;
    border-color: #1DB954;
    box-shadow: 0 0 0 3px rgba(31, 111, 74, 0.1);
  }

  .vf-clear-btn {
    position: absolute;
    right: 10px;
    background: none;
    border: none;
    color: #727272;
    cursor: pointer;
    padding: 4px;
    display: none;
    align-items: center;
    justify-content: center;
    transition: color 140ms ease;
  }

  .vf-clear-btn:hover {
    color: #FFFFFF;
  }

  .vf-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 44px;
    padding: 0 20px;
    border-radius: 8px;
    border: 1px solid #1DB954;
    background-color: #0D3820;
    color: #FFFFFF; font-weight: 700; border: 1px solid #1DB954;
    font-family: var(--font-ui);
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: background-color 140ms ease;
  }

  .vf-btn-primary:hover {
    background-color: #154D2E;
    color: #FFFFFF !important;
  }

  .vf-btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    height: 36px;
    padding: 0 14px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .vf-btn-secondary:hover {
    border-color: #1DB954;
    color: #1DB954;
    background-color: #181818;
  }

  .vf-help {
    font-size: 12px;
    color: #B3B3B3;
    margin-top: 8px;
    line-height: 1.5;
  }

  /* Baris Contoh Nomor Aktif */
  .vf-samples {
    margin-top: 16px;
    padding-top: 14px;
    border-top: 1px solid #242424;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    font-size: 12px;
    color: #B3B3B3;
  }

  .btn-contoh-nomor {
    display: inline-flex;
    align-items: center;
    padding: 3px 9px;
    border-radius: 5px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF;
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 500;
    cursor: pointer;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .btn-contoh-nomor:hover {
    border-color: #1DB954;
    color: #1DB954;
    background-color: #181818;
  }

  /* Panduan Awal (Empty State Terstruktur) */
  .vf-guide-panel {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    padding: 24px;
  }

  .vf-guide-title {
    font-family: var(--font-judul);
    font-size: 14.5px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0 0 6px;
  }

  .vf-guide-desc {
    font-size: 13px;
    color: #B3B3B3;
    margin: 0 0 18px;
    line-height: 1.55;
  }

  .vf-anatomy-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 8px;
    background-color: #181818;
  }

  .vf-anatomy-item {
    padding: 12px 16px;
    border-right: 1px solid rgba(255, 255, 255, 0.08);
  }

  .vf-anatomy-item:last-child {
    border-right: none;
  }

  .vf-anatomy-code {
    font-family: var(--font-mono, monospace);
    font-size: 13.5px;
    font-weight: 600;
    color: #1DB954;
    margin-bottom: 3px;
  }

  .vf-anatomy-label {
    font-size: 11.5px;
    color: #B3B3B3;
  }

  /* Kartu Hasil Verifikasi Sah (Arsip Resmi) */
  .vf-result-valid {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-left: 4px solid #1DB954;
    border-radius: 10px;
    overflow: hidden;
  }

  .vf-result-head {
    padding: 20px 24px;
    border-bottom: 1px solid #242424;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
  }

  .vf-status-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 9px;
    border-radius: 4px;
    background-color: #0D3820;
    color: #FFFFFF; font-weight: 700; border: 1px solid #1DB954;
    font-family: var(--font-mono, monospace);
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 8px;
  }

  .vf-result-title {
    font-family: var(--font-judul);
    font-size: 18px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0;
  }

  .vf-result-body {
    padding: 8px 24px;
  }

  .vf-ledger-row {
    display: grid;
    grid-template-columns: 185px 1fr;
    gap: 16px;
    padding: 13px 0;
    border-bottom: 1px solid #242424;
    align-items: baseline;
  }

  .vf-ledger-row:last-child {
    border-bottom: none;
  }

  .vf-ledger-key {
    font-size: 13px;
    color: #B3B3B3;
  }

  .vf-ledger-val {
    font-size: 14px;
    font-weight: 500;
    color: #FFFFFF;
    text-align: right;
  }

  .vf-ledger-recipient {
    font-family: var(--font-serif);
    font-size: 21px;
    font-weight: 600;
    color: #FFFFFF;
  }

  .vf-hash-wrap {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
    flex-wrap: wrap;
  }

  .vf-hash-code {
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    color: #B3B3B3;
    word-break: break-all;
    text-align: right;
  }

  .vf-copy-mini {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 8px;
    border-radius: 5px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF;
    font-family: var(--font-ui);
    font-size: 11px;
    font-weight: 500;
    cursor: pointer;
    flex-shrink: 0;
    transition: border-color 140ms ease, color 140ms ease;
  }

  .vf-copy-mini:hover {
    border-color: #1DB954;
    color: #1DB954;
  }

  .vf-result-foot {
    padding: 16px 24px;
    background-color: #181818;
    border-top: 1px solid #242424;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  .vf-foot-note {
    font-size: 12px;
    color: #B3B3B3;
  }

  .vf-foot-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-left: auto;
  }

  /* Kartu Hasil Tidak Ditemukan */
  .vf-result-invalid {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-left: 4px solid #F15E6C;
    border-radius: 10px;
    padding: 24px;
  }

  .vf-status-tag-error {
    display: inline-flex;
    align-items: center;
    padding: 3px 9px;
    border-radius: 4px;
    background-color: #F15E6C;
    color: #FFFFFF;
    font-family: var(--font-mono, monospace);
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 8px;
  }

  .vf-invalid-desc {
    font-size: 13.5px;
    color: #B3B3B3;
    line-height: 1.6;
    margin: 8px 0 16px;
  }

  .vf-check-list {
    margin: 0 0 18px;
    padding-left: 18px;
    font-size: 13px;
    color: #B3B3B3;
    line-height: 1.6;
  }

  @media (max-width: 640px) {
    .vf-search-row {
      flex-direction: column;
    }

    .vf-anatomy-grid {
      grid-template-columns: 1fr;
    }

    .vf-anatomy-item {
      border-right: none;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .vf-anatomy-item:last-child {
      border-bottom: none;
    }

    .vf-ledger-row {
      grid-template-columns: 1fr;
      gap: 4px;
    }

    .vf-ledger-val,
    .vf-hash-code {
      text-align: left;
    }

    .vf-hash-wrap {
      justify-content: flex-start;
    }
  }
</style>

<div class="vf-page">
  <!-- Header Halaman -->
  <section class="vf-hero">
    <div class="vf-container">
      <div class="vf-kicker">Layanan Publik Terbuka</div>
      <h1 class="vf-title">Verifikasi Sertifikat</h1>
      <p class="vf-subtitle">
        Periksa keabsahan surat keterangan kelulusan peserta Skill4Life secara langsung menggunakan nomor seri sertifikat.
      </p>
    </div>
  </section>

  <!-- Konten Utama -->
  <main class="vf-main">
    <div class="vf-container">
      <!-- Formulir Pencarian Nomor Sertifikat -->
      <div class="vf-search-panel">
        <label class="vf-label" for="input-cari-nomor">
          Nomor sertifikat
        </label>
        <div class="vf-search-row">
          <div class="vf-input-wrap">
            <input
              type="text"
              id="input-cari-nomor"
              class="vf-input"
              placeholder="Contoh: S4L-2026-000123"
              autocomplete="off"
              spellcheck="false"
            >
            <button type="button" id="btn-bersihkan-nomor" class="vf-clear-btn" aria-label="Hapus teks">
              <i data-lucide="x" style="width: 15px; height: 15px;"></i>
            </button>
          </div>
          <button type="button" id="btn-cek-verifikasi" class="vf-btn-primary">
            <i data-lucide="search" style="width: 15px; height: 15px;"></i>
            <span>Cek keabsahan</span>
          </button>
        </div>
        <div class="vf-help">
          Format nomor berupa kode <strong>S4L</strong> diikuti tahun terbit dan 6 digit nomor seri unik.
        </div>

        <!-- Tautan Contoh Cepat -->
        <div id="daftar-contoh-nomor" class="vf-samples">
          <span>Contoh nomor aktif:</span>
        </div>
      </div>

      <!-- Area Hasil Verifikasi -->
      <div id="hasil-verifikasi-container">
        <div class="vf-guide-panel">
          <h2 class="vf-guide-title">Panduan Pengecekan Dokumen</h2>
          <p class="vf-guide-desc">
            Nomor seri tercetak pada bagian kiri bawah lembar sertifikat kompetensi Skill4Life atau dapat dipindai langsung melalui kode QR pada dokumen fisik maupun PDF.
          </p>
          <div class="vf-anatomy-grid">
            <div class="vf-anatomy-item">
              <div class="vf-anatomy-code">S4L</div>
              <div class="vf-anatomy-label">Kode penerbit resmi Skill4Life</div>
            </div>
            <div class="vf-anatomy-item">
              <div class="vf-anatomy-code">2026</div>
              <div class="vf-anatomy-label">Tahun penerbitan sertifikat</div>
            </div>
            <div class="vf-anatomy-item">
              <div class="vf-anatomy-code">000123</div>
              <div class="vf-anatomy-label">6 digit nomor registrasi lulusan</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<script type="module">
  import { ambilSertifikat, ambilContohNomorSertifikat } from '../assets/js/api.js';

  const inputNomor = document.getElementById('input-cari-nomor');
  const btnClear = document.getElementById('btn-bersihkan-nomor');
  const btnCek = document.getElementById('btn-cek-verifikasi');
  const hasilArea = document.getElementById('hasil-verifikasi-container');
  const contohWrap = document.getElementById('daftar-contoh-nomor');

  function formatTanggalID(tglStr) {
    if (!tglStr) return '-';
    const d = new Date(tglStr);
    if (isNaN(d.getTime())) return tglStr;
    return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
  }

  function perbaruiTombolClear() {
    btnClear.style.display = inputNomor.value.trim().length > 0 ? 'inline-flex' : 'none';
  }

  async function muatContohNomor() {
    const pilihan = await ambilContohNomorSertifikat();
    contohWrap.innerHTML = '<span>Contoh nomor aktif:</span>' + pilihan.map(nomor => `
      <button type="button" class="btn-contoh-nomor" data-nomor="${nomor}">
        ${nomor}
      </button>
    `).join('');

    contohWrap.querySelectorAll('.btn-contoh-nomor').forEach(b => {
      b.addEventListener('click', () => {
        inputNomor.value = b.dataset.nomor;
        perbaruiTombolClear();
        prosesVerifikasi(b.dataset.nomor);
      });
    });
  }

  async function prosesVerifikasi(nomor) {
    const bersih = nomor.trim().toUpperCase();
    inputNomor.value = bersih;
    perbaruiTombolClear();

    if (!bersih) {
      hasilArea.innerHTML = `
        <div class="pesan-status pesan-status-galat">
          Masukkan nomor sertifikat terlebih dahulu pada kolom pencarian di atas.
        </div>
      `;
      inputNomor.focus();
      return;
    }

    // Perbarui parameter URL agar mudah dibagikan
    const urlBaru = new URL(window.location.href);
    urlBaru.searchParams.set('nomor', bersih);
    window.history.replaceState({}, '', urlBaru);

    hasilArea.innerHTML = `
      <div class="vf-guide-panel" style="text-align: center; color: #B3B3B3; font-size: 13.5px;">
        Memeriksa nomor <span class="angka-mono" style="color: #FFFFFF; font-weight: 600;">${bersih}</span> pada pangkalan data...
      </div>
    `;

    const data = await ambilSertifikat(bersih);

    if (data) {
      hasilArea.innerHTML = `
        <article class="vf-result-valid">
          <div class="vf-result-head">
            <div>
              <span class="vf-status-tag">Status Verifikasi: Sah</span>
              <h2 class="vf-result-title">Sertifikat Terdaftar Resmi</h2>
            </div>

            <!-- Segel Resmi Inline SVG -->
            <svg width="50" height="50" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="Segel resmi kelulusan">
              <circle cx="32" cy="32" r="29" stroke="#1DB954" stroke-width="1.6"/>
              <circle cx="32" cy="32" r="24.5" stroke="#8C7343" stroke-width="0.9" stroke-dasharray="2.5 2"/>
              <circle cx="32" cy="32" r="18" fill="#1DB954"/>
              <path d="M24.5 32.5L29.5 37.5L40 26.5" stroke="#181818" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="32" cy="8.5" r="1.3" fill="#1DB954"/>
              <circle cx="32" cy="55.5" r="1.3" fill="#1DB954"/>
              <circle cx="8.5" cy="32" r="1.3" fill="#1DB954"/>
              <circle cx="55.5" cy="32" r="1.3" fill="#1DB954"/>
            </svg>
          </div>

          <div class="vf-result-body">
            <div class="vf-ledger-row">
              <span class="vf-ledger-key">Nama penerima</span>
              <span class="vf-ledger-val vf-ledger-recipient">${data.nama_peserta}</span>
            </div>

            <div class="vf-ledger-row">
              <span class="vf-ledger-key">Kursus kompetensi</span>
              <span class="vf-ledger-val">${data.nama_kursus}</span>
            </div>

            <div class="vf-ledger-row">
              <span class="vf-ledger-key">Nomor sertifikat</span>
              <span class="vf-ledger-val angka-mono" style="font-weight: 600;">${data.nomor_sertifikat}</span>
            </div>

            <div class="vf-ledger-row">
              <span class="vf-ledger-key">Tanggal terbit</span>
              <span class="vf-ledger-val angka-mono">${formatTanggalID(data.tanggal_terbit)}</span>
            </div>

            <div class="vf-ledger-row">
              <span class="vf-ledger-key">Nilai kelulusan</span>
              <span class="vf-ledger-val angka-mono" style="color: #1DB954; font-weight: 600;">${data.nilai_kuis || 90} / 100</span>
            </div>

            <div class="vf-ledger-row">
              <span class="vf-ledger-key">Kode verifikasi hash</span>
              <div class="vf-hash-wrap">
                <span class="vf-hash-code" id="vf-hash-text">${data.kode_verifikasi || '-'}</span>
                ${data.kode_verifikasi ? `
                  <button type="button" class="vf-copy-mini" id="btn-salin-hash">
                    <span>Salin hash</span>
                  </button>
                ` : ''}
              </div>
            </div>
          </div>

          <div class="vf-result-foot">
            <span class="vf-foot-note">Diterbitkan oleh Prakarsa Pelatihan Kerja Skill4Life</span>
            <div class="vf-foot-actions">
              <button type="button" id="btn-salin-link-verif" class="vf-btn-secondary">
                <span>Salin tautan</span>
              </button>
              <a href="lihat.php?nomor=${encodeURIComponent(data.nomor_sertifikat)}" class="vf-btn-primary" style="height: 36px; padding: 0 14px; font-size: 13px;">
                <span>Buka dokumen &rarr;</span>
              </a>
            </div>
          </div>
        </article>
      `;

      const btnSalinHash = document.getElementById('btn-salin-hash');
      if (btnSalinHash) {
        btnSalinHash.addEventListener('click', async () => {
          try {
            await navigator.clipboard.writeText(data.kode_verifikasi);
            btnSalinHash.querySelector('span').textContent = 'Tersalin';
            if (typeof tampilkanToast === 'function') tampilkanToast('Kode hash disalin', 'sukses');
            setTimeout(() => {
              btnSalinHash.querySelector('span').textContent = 'Salin hash';
            }, 1800);
          } catch (e) {}
        });
      }

      document.getElementById('btn-salin-link-verif').addEventListener('click', async function () {
        try {
          await navigator.clipboard.writeText(window.location.href);
          const span = this.querySelector('span');
          span.textContent = 'Tautan tersalin';
          if (typeof tampilkanToast === 'function') tampilkanToast('Tautan verifikasi disalin', 'sukses');
          setTimeout(() => {
            span.textContent = 'Salin tautan';
          }, 1800);
        } catch (e) {}
      });
    } else {
      hasilArea.innerHTML = `
        <div class="vf-result-invalid">
          <span class="vf-status-tag-error">Status Verifikasi: Tidak Ditemukan</span>
          <h2 class="vf-result-title">Nomor sertifikat tidak tercatat</h2>
          <p class="vf-invalid-desc">
            Nomor <strong class="angka-mono">${bersih}</strong> tidak ditemukan dalam pangkalan data kelulusan Skill4Life.
          </p>
          <ul class="vf-check-list">
            <li>Pastikan penulisan diawali kode <strong>S4L-</strong> diikuti tahun dan 6 digit angka (contoh: <span class="angka-mono">S4L-2026-000123</span>).</li>
            <li>Periksa kembali perbedaan antara angka nol (<strong>0</strong>) dan huruf kapital (<strong>O</strong>).</li>
          </ul>
          <button type="button" id="btn-reset-pencarian" class="vf-btn-secondary">
            Coba nomor lain
          </button>
        </div>
      `;

      document.getElementById('btn-reset-pencarian').addEventListener('click', () => {
        inputNomor.value = '';
        perbaruiTombolClear();
        inputNomor.focus();
      });
    }
  }

  inputNomor.addEventListener('input', perbaruiTombolClear);

  btnClear.addEventListener('click', () => {
    inputNomor.value = '';
    perbaruiTombolClear();
    inputNomor.focus();
  });

  btnCek.addEventListener('click', () => prosesVerifikasi(inputNomor.value));
  inputNomor.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') prosesVerifikasi(inputNomor.value);
  });

  document.addEventListener('DOMContentLoaded', async () => {
    await muatContohNomor();
    const urlParams = new URLSearchParams(window.location.search);
    const paramNomor = urlParams.get('nomor');
    if (paramNomor) {
      inputNomor.value = paramNomor;
      perbaruiTombolClear();
      prosesVerifikasi(paramNomor);
    }

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>