<style>
  .kuis-page {
    background-color: #121212;
    min-height: calc(100vh - 72px);
    font-family: var(--font-ui);
    color: #FFFFFF;
  }

  /* Header Halaman Kuis */
  .kuis-hero {
    background-color: #181818;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    padding: 32px 20px 30px;
  }

  .kuis-container {
    max-width: 1020px;
    margin: 0 auto;
  }

  .kuis-nav-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 16px;
  }

  .kuis-back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: #B3B3B3;
    text-decoration: none;
    transition: color 140ms ease;
  }

  .kuis-back-link:hover {
    color: #FFFFFF !important;
  }

  .kuis-kicker {
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #1DB954;
    margin-bottom: 6px;
  }

  .kuis-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: clamp(24px, 3.4vw, 32px);
    font-weight: 700;
    line-height: 1.25;
    letter-spacing: -0.025em;
    color: #FFFFFF;
    margin: 0 0 8px;
  }

  .kuis-subtitle {
    font-size: 14.5px;
    line-height: 1.6;
    color: #B3B3B3;
    max-width: 680px;
    margin: 0 0 18px;
  }

  /* Info Aturan Kuis (Chip Terpisah, Tidak Kaku) */
  .kuis-rules-bar {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
  }

  .kuis-rule-item {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 13px;
    border-radius: 10px;
    background-color: #121212;
    border: 1px solid rgba(255, 255, 255, 0.08);
    font-size: 12.5px;
    font-weight: 500;
    color: #E0E0E0;
  }

  .kuis-rule-item i {
    color: #1DB954;
    flex-shrink: 0;
  }

  /* Area Kerja Kuis */
  .kuis-main {
    padding: 32px 20px 80px;
  }

  .kuis-workspace {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 24px;
    align-items: start;
  }

  /* Kartu Soal Aktif (Border Netral Seragam, Radius Seimbang) */
  .kuis-question-card {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 30px 32px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
  }

  .kuis-q-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding-bottom: 16px;
    margin-bottom: 22px;
    border-bottom: 1px solid #242424;
  }

  .kuis-q-badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 11px;
    border-radius: 8px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 600;
    color: #FFFFFF;
  }

  .kuis-q-step-text {
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    color: #B3B3B3;
  }

  .kuis-q-text {
    font-family: var(--font-ui);
    font-size: 16.5px;
    font-weight: 600;
    line-height: 1.65;
    color: #FFFFFF;
    margin-bottom: 24px;
  }

  /* Daftar Opsi Jawaban A, B, C, D */
  .kuis-options-list {
    display: flex;
    flex-direction: column;
    gap: 11px;
  }

  .kuis-option-label {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 14px 16px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    cursor: pointer;
    transition: border-color 140ms ease, background-color 140ms ease;
    user-select: none;
  }

  .kuis-option-label:hover {
    border-color: #BDB6A6;
    background-color: #181818;
  }

  .kuis-option-label.is-selected {
    border-color: #1DB954;
    background-color: #181818;
  }

  .kuis-option-radio {
    position: absolute;
    opacity: 0;
    pointer-events: none;
  }

  .kuis-option-key {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #E0E0E0;
    font-family: var(--font-mono, monospace);
    font-size: 12.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background-color 140ms ease, border-color 140ms ease, color 140ms ease;
  }

  .kuis-option-label.is-selected .kuis-option-key {
    background-color: #0D3820;
    border-color: #1DB954;
    color: #FFFFFF; font-weight: 700; border: 1px solid #1DB954;
  }

  .kuis-option-text {
    font-size: 14.5px;
    line-height: 1.55;
    color: #FFFFFF;
    padding-top: 4px;
  }

  /* Peringatan Inline Sebelum Kirim (Tanpa Garis Tebal Samping) */
  .kuis-confirm-box {
    margin-top: 22px;
    padding: 15px 18px;
    border-radius: 12px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    display: none;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
  }

  .kuis-confirm-text {
    font-size: 13px;
    line-height: 1.5;
    color: #E0E0E0;
  }

  .kuis-confirm-actions {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  /* Footer Navigasi Soal */
  .kuis-q-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 28px;
    padding-top: 18px;
    border-top: 1px solid #242424;
  }

  /* Panel Navigasi Nomor Soal (Kanan) */
  .kuis-nav-panel {
    position: sticky;
    top: 88px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
  }

  .kuis-nav-head {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    margin-bottom: 10px;
  }

  .kuis-nav-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: 14.5px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0;
  }

  .kuis-nav-counter {
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 600;
    color: #1DB954;
  }

  .kuis-progress-track {
    width: 100%;
    height: 6px;
    background-color: #242424;
    border-radius: 999px;
    overflow: hidden;
    margin-bottom: 18px;
  }

  .kuis-progress-fill {
    height: 100%;
    background-color: #1DB954;
    border-radius: 999px;
    transition: width 220ms ease;
  }

  .kuis-nav-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 8px;
    margin-bottom: 16px;
  }

  .kuis-nav-btn {
    height: 38px;
    border-radius: 9px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #E0E0E0;
    font-family: var(--font-mono, monospace);
    font-size: 12.5px;
    font-weight: 500;
    cursor: pointer;
    transition: border-color 140ms ease, background-color 140ms ease, color 140ms ease;
  }

  .kuis-nav-btn:hover {
    border-color: #1DB954;
    color: #1DB954;
  }

  .kuis-nav-btn.terjawab {
    background-color: #181818;
    border-color: rgba(255, 255, 255, 0.12);
    color: #1DB954;
    font-weight: 600;
  }

  .kuis-nav-btn.aktif {
    background-color: #0D3820;
    border-color: #1DB954;
    color: #FFFFFF; font-weight: 700; border: 1px solid #1DB954;
    font-weight: 600;
  }

  .kuis-legend {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    padding-top: 14px;
    border-top: 1px solid #242424;
    font-size: 11px;
    color: #B3B3B3;
  }

  .kuis-legend-item {
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  .kuis-dot {
    width: 10px;
    height: 10px;
    border-radius: 3px;
    display: inline-block;
  }

  .kuis-dot.aktif {
    background-color: #1DB954;
  }

  .kuis-dot.terjawab {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.12);
  }

  .kuis-dot.kosong {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
  }

  /* Tombol Solid dengan Radius Seimbang */
  .kuis-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 42px;
    padding: 0 20px;
    border-radius: 10px;
    border: 1px solid #1DB954;
    background-color: #0D3820;
    color: #FFFFFF !important; font-weight: 700; border: 1px solid #1DB954;
    font-family: var(--font-ui);
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: background-color 140ms ease;
  }

  .kuis-btn-primary:hover {
    background-color: #154D2E;
    color: #FFFFFF !important;
  }

  .kuis-btn-primary:disabled {
    opacity: 0.65;
    cursor: not-allowed;
  }

  .kuis-btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 42px;
    padding: 0 18px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF !important;
    font-family: var(--font-ui);
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .kuis-btn-secondary:hover {
    border-color: #1DB954;
    color: #1DB954 !important;
    background-color: #181818;
  }

  /* Tampilan Hasil Evaluasi Kuis */
  .kuis-result-wrap {
    max-width: 820px;
    margin: 0 auto;
    display: none;
  }

  .kuis-score-card {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 36px 32px;
    text-align: center;
    margin-bottom: 24px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
  }

  .kuis-result-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 10px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: #1DB954;
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 16px;
  }

  .kuis-result-badge.is-failed {
    background-color: rgba(241, 94, 108, 0.15);
    border-color: #E3D2CE;
    color: #F15E6C;
  }

  .kuis-score-number {
    font-family: var(--font-mono, monospace);
    font-size: clamp(48px, 6vw, 64px);
    font-weight: 700;
    line-height: 1.05;
    color: #1DB954;
    margin-bottom: 10px;
  }

  .kuis-score-card.is-failed .kuis-score-number {
    color: #F15E6C;
  }

  .kuis-score-desc {
    font-size: 14.5px;
    line-height: 1.6;
    color: #B3B3B3;
    max-width: 520px;
    margin: 0 auto 24px;
  }

  /* 3 Tile Metrik Terpisah yang Rapi */
  .kuis-stats-strip {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    max-width: 480px;
    margin: 0 auto 26px;
  }

  .kuis-stat-cell {
    padding: 14px 12px;
    border-radius: 12px;
    background-color: #181818;
    border: 1px solid #242424;
  }

  .kuis-stat-val {
    font-family: var(--font-mono, monospace);
    font-size: 17px;
    font-weight: 700;
    color: #FFFFFF;
  }

  .kuis-stat-lbl {
    font-size: 12px;
    color: #B3B3B3;
    margin-top: 3px;
  }

  .kuis-result-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  /* Pembahasan Jawaban (Tanpa Garis Tebal Hijau/Merah di Pinggir Card) */
  .kuis-review-section {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
  }

  .kuis-review-head {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    gap: 12px;
    flex-wrap: wrap;
    padding-bottom: 16px;
    margin-bottom: 20px;
    border-bottom: 1px solid #242424;
  }

  .kuis-review-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: 17px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0;
  }

  .kuis-review-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .kuis-review-item {
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    padding: 20px 22px;
    background-color: #181818;
  }

  .kuis-review-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 10px;
  }

  .kuis-review-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 600;
    color: #1DB954;
  }

  .kuis-review-item.is-wrong .kuis-review-status {
    color: #F15E6C;
  }

  .kuis-review-key {
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    color: #B3B3B3;
  }

  .kuis-review-question {
    font-size: 15px;
    font-weight: 600;
    line-height: 1.55;
    color: #FFFFFF;
    margin-bottom: 12px;
  }

  .kuis-review-answers {
    display: flex;
    flex-direction: column;
    gap: 6px;
    font-size: 13.5px;
    color: #E0E0E0;
    margin-bottom: 14px;
  }

  .kuis-review-explanation {
    background-color: #181818;
    border: 1px solid #242424;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 13.5px;
    line-height: 1.6;
    color: #E0E0E0;
    margin: 0;
  }

  @media (max-width: 860px) {
    .kuis-workspace {
      grid-template-columns: 1fr;
    }

    .kuis-nav-panel {
      position: static;
    }
  }

  @media (max-width: 580px) {
    .kuis-question-card,
    .kuis-review-section,
    .kuis-score-card {
      padding: 22px 18px;
    }

    .kuis-stats-strip {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="kuis-page">
  <!-- Header Kuis -->
  <section class="kuis-hero">
    <div class="kuis-container">
      <div class="kuis-nav-top">
        <a href="#" id="link-kembali-materi" class="kuis-back-link">
          <i data-lucide="arrow-left" style="width: 15px; height: 15px;"></i>
          <span>Kembali ke materi modul</span>
        </a>
        <a href="#" id="link-rincian-kursus" class="kuis-back-link">
          <span>Rincian kursus</span>
        </a>
      </div>

      <div class="kuis-kicker">Evaluasi Akhir Kompetensi</div>
      <h1 class="kuis-title" id="judul-kuis-kursus">Kuis akhir kelulusan</h1>
      <p class="kuis-subtitle">
        Jawab seluruh pertanyaan dengan cermat. Nilai kelulusan minimal 70 diperlukan untuk menerbitkan sertifikat kompetensi resmi.
      </p>

      <div class="kuis-rules-bar">
        <div class="kuis-rule-item">
          <i data-lucide="list-checks" style="width: 15px; height: 15px;"></i>
          <span id="info-jumlah-soal">10 butir soal pilihan ganda</span>
        </div>
        <div class="kuis-rule-item">
          <i data-lucide="target" style="width: 15px; height: 15px;"></i>
          <span>Syarat lulus: minimal nilai 70</span>
        </div>
        <div class="kuis-rule-item">
          <i data-lucide="award" style="width: 15px; height: 15px;"></i>
          <span>Sertifikat terbit otomatis saat lulus</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Konten Utama -->
  <main class="kuis-main">
    <div class="kuis-container">
      <!-- Area Pengerjaan Soal 2 Kolom -->
      <div id="area-pengerjaan-kuis" class="kuis-workspace">
        <!-- Kartu Soal Fokus -->
        <div id="wadah-kartu-soal" class="kuis-question-card">
          <div class="kuis-q-header">
            <span class="kuis-q-badge" id="label-nomor-soal">Pertanyaan 1</span>
            <span class="kuis-q-step-text" id="indikator-langkah">Soal 1 dari 10</span>
          </div>

          <div class="kuis-q-text" id="teks-pertanyaan-aktif">
            Memuat pertanyaan...
          </div>

          <!-- Pilihan Jawaban A, B, C, D -->
          <div class="kuis-options-list" id="daftar-opsi-jawaban">
            <!-- Opsi radio dimuat dinamis -->
          </div>

          <!-- Konfirmasi Inline Jika Belum Semua Dijawab -->
          <div id="kotak-konfirmasi-kirim" class="kuis-confirm-box">
            <div class="kuis-confirm-text" id="teks-konfirmasi-kirim">
              Masih ada soal yang belum dijawab. Yakin ingin mengirim sekarang?
            </div>
            <div class="kuis-confirm-actions">
              <button type="button" id="btn-batal-kirim" class="kuis-btn-secondary" style="height: 36px; padding: 0 14px; font-size: 12.5px;">
                Periksa lagi
              </button>
              <button type="button" id="btn-paksa-kirim" class="kuis-btn-primary" style="height: 36px; padding: 0 14px; font-size: 12.5px;">
                Tetap kirim
              </button>
            </div>
          </div>

          <!-- Tombol Navigasi Soal -->
          <div class="kuis-q-footer">
            <button type="button" id="btn-soal-sebelumnya" class="kuis-btn-secondary" style="visibility: hidden;">
              &larr; Soal sebelumnya
            </button>

            <button type="button" id="btn-soal-selanjutnya" class="kuis-btn-primary">
              Soal selanjutnya &rarr;
            </button>
          </div>
        </div>

        <!-- Sidebar Navigator Nomor Soal -->
        <aside id="panel-navigasi-kuis" class="kuis-nav-panel">
          <div class="kuis-nav-head">
            <h2 class="kuis-nav-title">Navigasi soal</h2>
            <span class="kuis-nav-counter" id="label-terjawab-nav">0 / 10 dijawab</span>
          </div>

          <div class="kuis-progress-track">
            <div class="kuis-progress-fill" id="bilah-progres-kuis" style="width: 0%;"></div>
          </div>

          <div class="kuis-nav-grid" id="kuis-navigator-nomor" aria-label="Navigasi nomor soal">
            <!-- Diisi dinamis via JS -->
          </div>

          <div class="kuis-legend">
            <span class="kuis-legend-item"><i class="kuis-dot aktif"></i> Aktif</span>
            <span class="kuis-legend-item"><i class="kuis-dot terjawab"></i> Terjawab</span>
            <span class="kuis-legend-item"><i class="kuis-dot kosong"></i> Belum</span>
          </div>
        </aside>
      </div>

      <!-- Hasil Evaluasi Kuis (Tampil setelah submit) -->
      <div id="wadah-hasil-kuis" class="kuis-result-wrap">
        <div id="kartu-skor-utama" class="kuis-score-card">
          <span id="hasil-badge-status" class="kuis-result-badge">Evaluasi Selesai</span>
          <div class="kuis-score-number" id="hasil-nilai-angka">0</div>
          <p class="kuis-score-desc" id="hasil-keterangan">Evaluasi kelulusan</p>

          <div class="kuis-stats-strip">
            <div class="kuis-stat-cell">
              <div class="kuis-stat-val" id="stat-benar" style="color: #1DB954;">0</div>
              <div class="kuis-stat-lbl">Jawaban benar</div>
            </div>
            <div class="kuis-stat-cell">
              <div class="kuis-stat-val" id="stat-salah" style="color: #F15E6C;">0</div>
              <div class="kuis-stat-lbl">Kurang tepat</div>
            </div>
            <div class="kuis-stat-cell">
              <div class="kuis-stat-val">70</div>
              <div class="kuis-stat-lbl">Ambang lulus</div>
            </div>
          </div>

          <div id="hasil-aksi-area" class="kuis-result-actions">
            <!-- Tombol sertifikat atau coba lagi -->
          </div>
        </div>

        <section class="kuis-review-section">
          <div class="kuis-review-head">
            <h2 class="kuis-review-title">Pembahasan jawaban lengkap</h2>
            <span class="kuis-q-step-text">Tinjauan per butir soal</span>
          </div>
          <div id="daftar-pembahasan-soal" class="kuis-review-list">
            <!-- Dimuat dinamis -->
          </div>
        </section>
      </div>
    </div>
  </main>
</div>

<script type="module">
  import { ambilSesiPengguna, ambilSoalKuis, ambilDetailKursus, kirimHasilKuis } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const sesi = ambilSesiPengguna();
    if (!sesi) {
      window.location.href = '../auth/login.php?pesan=harap_login';
      return;
    }

    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get('slug') || 'microsoft-excel-dasar';

    document.getElementById('link-kembali-materi').href = `belajar.php?slug=${slug}&modul=1`;
    document.getElementById('link-rincian-kursus').href = `detail.php?slug=${slug}`;

    const [kursus, daftarSoal] = await Promise.all([
      ambilDetailKursus(slug),
      ambilSoalKuis(slug)
    ]);

    if (!daftarSoal.length) {
      document.getElementById('area-pengerjaan-kuis').style.display = 'block';
      document.getElementById('area-pengerjaan-kuis').innerHTML = `
        <div class="kuis-question-card" style="max-width: 560px; margin: 0 auto; text-align: center; padding: 40px 24px;">
          <h2 class="kuis-review-title" style="margin-bottom: 8px;">Soal evaluasi belum tersedia</h2>
          <p class="kuis-subtitle" style="margin: 0 auto 20px;">Perangkat kuis untuk kursus ini sedang disiapkan. Silakan kembali ke halaman rincian kursus.</p>
          <a href="detail.php?slug=${slug}" class="kuis-btn-primary">Kembali ke rincian kursus</a>
        </div>
      `;
      return;
    }

    if (kursus) {
      document.title = `Kuis Akhir: ${kursus.judul} - Skill4Life`;
      document.getElementById('judul-kuis-kursus').textContent = `Kuis akhir: ${kursus.judul}`;
    }
    document.getElementById('info-jumlah-soal').textContent = `${daftarSoal.length} butir soal pilihan ganda`;

    let indeksAktif = 0;
    let sudahDikirim = false;
    const jawabanTersimpan = {};

    const areaPengerjaan = document.getElementById('area-pengerjaan-kuis');
    const wadahHasil = document.getElementById('wadah-hasil-kuis');
    const labelLangkah = document.getElementById('indikator-langkah');
    const labelTerjawabNav = document.getElementById('label-terjawab-nav');
    const bilahProgres = document.getElementById('bilah-progres-kuis');
    const navNomorEl = document.getElementById('kuis-navigator-nomor');
    const labelNomor = document.getElementById('label-nomor-soal');
    const teksPertanyaan = document.getElementById('teks-pertanyaan-aktif');
    const containerOpsi = document.getElementById('daftar-opsi-jawaban');
    const btnPrev = document.getElementById('btn-soal-sebelumnya');
    const btnNext = document.getElementById('btn-soal-selanjutnya');
    const kotakKonfirmasi = document.getElementById('kotak-konfirmasi-kirim');
    const teksKonfirmasi = document.getElementById('teks-konfirmasi-kirim');

    function renderNavigator() {
      navNomorEl.innerHTML = daftarSoal.map((s, i) => {
        const isAktif = i === indeksAktif;
        const isTerjawab = Boolean(jawabanTersimpan[s.id]);
        const cls = isAktif ? 'aktif' : (isTerjawab ? 'terjawab' : '');
        return `<button type="button" class="kuis-nav-btn ${cls}" data-idx="${i}">${i + 1}</button>`;
      }).join('');

      navNomorEl.querySelectorAll('.kuis-nav-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          kotakKonfirmasi.style.display = 'none';
          tampilkanSoal(Number(btn.dataset.idx));
        });
      });
    }

    function tampilkanSoal(idx) {
      indeksAktif = idx;
      const soal = daftarSoal[idx];
      const terjawabCount = Object.keys(jawabanTersimpan).length;

      labelLangkah.textContent = `Soal ${idx + 1} dari ${daftarSoal.length}`;
      labelTerjawabNav.textContent = `${terjawabCount} / ${daftarSoal.length} dijawab`;
      bilahProgres.style.width = `${Math.round((terjawabCount / daftarSoal.length) * 100)}%`;
      labelNomor.textContent = `Pertanyaan ${idx + 1}`;
      teksPertanyaan.textContent = soal.pertanyaan;

      containerOpsi.innerHTML = ['A', 'B', 'C', 'D'].map(kunci => {
        const terpilih = jawabanTersimpan[soal.id] === kunci;
        return `
          <label class="kuis-option-label ${terpilih ? 'is-selected' : ''}">
            <input type="radio" class="kuis-option-radio" name="opsi_soal_${soal.id}" value="${kunci}" ${terpilih ? 'checked' : ''}>
            <span class="kuis-option-key">${kunci}</span>
            <span class="kuis-option-text">${soal.pilihan[kunci]}</span>
          </label>
        `;
      }).join('');

      containerOpsi.querySelectorAll('input').forEach(input => {
        input.addEventListener('change', (e) => {
          jawabanTersimpan[soal.id] = e.target.value;
          kotakKonfirmasi.style.display = 'none';
          tampilkanSoal(idx);
        });
      });

      btnPrev.style.visibility = idx > 0 ? 'visible' : 'hidden';
      btnNext.textContent = idx === daftarSoal.length - 1
        ? 'Kirim jawaban & selesaikan kuis'
        : 'Soal selanjutnya \u2192';

      renderNavigator();
    }

    async function selesaikanDanKirim() {
      btnNext.disabled = true;
      btnNext.textContent = 'Memeriksa jawaban...';

      const hasil = await kirimHasilKuis(slug, jawabanTersimpan);
      if (hasil.butuh_login) {
        window.location.href = '../auth/login.php?pesan=harap_login';
        return;
      }

      sudahDikirim = true;
      areaPengerjaan.style.display = 'none';
      wadahHasil.style.display = 'block';

      const kartuSkor = document.getElementById('kartu-skor-utama');
      const badgeStatus = document.getElementById('hasil-badge-status');
      const angkaEl = document.getElementById('hasil-nilai-angka');
      const ketEl = document.getElementById('hasil-keterangan');
      const aksiEl = document.getElementById('hasil-aksi-area');

      angkaEl.textContent = hasil.nilai;
      document.getElementById('stat-benar').textContent = hasil.jawaban_benar;
      document.getElementById('stat-salah').textContent = Math.max(0, hasil.total_soal - hasil.jawaban_benar);

      if (hasil.lulus && hasil.nomor_sertifikat) {
        kartuSkor.classList.remove('is-failed');
        badgeStatus.classList.remove('is-failed');
        badgeStatus.textContent = 'Lulus Evaluasi Kompetensi';
        ketEl.textContent = `Selamat, Anda menjawab benar ${hasil.jawaban_benar} dari ${hasil.total_soal} soal dan memenuhi nilai kelulusan minimal 70.`;
        aksiEl.innerHTML = `
          <a href="../sertifikat/lihat.php?nomor=${encodeURIComponent(hasil.nomor_sertifikat)}" class="kuis-btn-primary">
            Buka sertifikat resmi (${hasil.nomor_sertifikat}) &rarr;
          </a>
          <a href="../dashboard/index.php" class="kuis-btn-secondary">
            Ke dashboard saya
          </a>
        `;
      } else {
        kartuSkor.classList.add('is-failed');
        badgeStatus.classList.add('is-failed');
        badgeStatus.textContent = 'Belum Memenuhi Nilai Minimal';
        ketEl.textContent = `Anda menjawab benar ${hasil.jawaban_benar} dari ${hasil.total_soal} soal. Pelajari kembali materi modul untuk mencapai nilai minimal 70.`;
        aksiEl.innerHTML = `
          <button type="button" onclick="window.location.reload()" class="kuis-btn-primary">
            Ulangi pengerjaan kuis
          </button>
          <a href="belajar.php?slug=${slug}&modul=1" class="kuis-btn-secondary">
            Pelajari ulang materi
          </a>
        `;
      }

      const pembEl = document.getElementById('daftar-pembahasan-soal');
      pembEl.innerHTML = (hasil.evaluasi || []).map(ev => `
        <article class="kuis-review-item ${ev.is_benar ? '' : 'is-wrong'}">
          <div class="kuis-review-meta">
            <span class="kuis-review-status">
              <i data-lucide="${ev.is_benar ? 'check-circle-2' : 'x-circle'}" style="width: 14px; height: 14px;"></i>
              <span>Soal ${ev.nomor} &middot; ${ev.is_benar ? 'Jawaban benar' : 'Jawaban belum tepat'}</span>
            </span>
            <span class="kuis-review-key">Kunci: ${ev.kunci_benar}</span>
          </div>
          <div class="kuis-review-question">${ev.pertanyaan}</div>
          <div class="kuis-review-answers">
            <div>Jawaban Anda: <strong>${ev.jawaban_peserta ? ev.jawaban_peserta + '. ' : ''}${ev.teks_jawaban_peserta}</strong></div>
            ${!ev.is_benar ? `<div style="color: #1DB954;">Jawaban Benar: <strong>${ev.kunci_benar}. ${ev.teks_kunci_benar}</strong></div>` : ''}
          </div>
          <p class="kuis-review-explanation">${ev.pembahasan}</p>
        </article>
      `).join('');

      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }

      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    btnPrev.addEventListener('click', () => {
      if (indeksAktif > 0) {
        kotakKonfirmasi.style.display = 'none';
        tampilkanSoal(indeksAktif - 1);
      }
    });

    btnNext.addEventListener('click', async () => {
      if (indeksAktif < daftarSoal.length - 1) {
        kotakKonfirmasi.style.display = 'none';
        tampilkanSoal(indeksAktif + 1);
      } else {
        const jumlahDijawab = Object.keys(jawabanTersimpan).length;
        if (jumlahDijawab < daftarSoal.length) {
          const sisa = daftarSoal.length - jumlahDijawab;
          teksKonfirmasi.textContent = `Anda baru menjawab ${jumlahDijawab} dari ${daftarSoal.length} soal (${sisa} soal masih kosong). Yakin ingin mengirim jawaban sekarang?`;
          kotakKonfirmasi.style.display = 'flex';
          return;
        }
        await selesaikanDanKirim();
      }
    });

    document.getElementById('btn-batal-kirim').addEventListener('click', () => {
      kotakKonfirmasi.style.display = 'none';
      const idxKosong = daftarSoal.findIndex(s => !jawabanTersimpan[s.id]);
      if (idxKosong !== -1) {
        tampilkanSoal(idxKosong);
      }
    });

    document.getElementById('btn-paksa-kirim').addEventListener('click', async () => {
      kotakKonfirmasi.style.display = 'none';
      await selesaikanDanKirim();
    });

    document.addEventListener('keydown', (e) => {
      if (sudahDikirim) return;
      const key = e.key.toUpperCase();
      if (['A', 'B', 'C', 'D'].includes(key)) {
        const soal = daftarSoal[indeksAktif];
        if (soal) {
          jawabanTersimpan[soal.id] = key;
          kotakKonfirmasi.style.display = 'none';
          tampilkanSoal(indeksAktif);
        }
      } else if (e.key === 'ArrowLeft' && indeksAktif > 0) {
        kotakKonfirmasi.style.display = 'none';
        tampilkanSoal(indeksAktif - 1);
      } else if (e.key === 'ArrowRight' && indeksAktif < daftarSoal.length - 1) {
        kotakKonfirmasi.style.display = 'none';
        tampilkanSoal(indeksAktif + 1);
      }
    });

    tampilkanSoal(0);

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>