<style>
  .dtl-page {
    background-color: #F7F5F0;
    min-height: calc(100vh - 72px);
    font-family: var(--font-ui);
    color: #1C1A17;
  }

  /* Header Kursus */
  .dtl-hero {
    background-color: #FFFFFF;
    border-bottom: 1px solid #E6E2D8;
    padding: 36px 20px 36px;
  }

  .dtl-container {
    max-width: 1080px;
    margin: 0 auto;
  }

  .dtl-back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: #5C5750;
    text-decoration: none;
    margin-bottom: 20px;
    transition: color 140ms ease;
  }

  .dtl-back-link:hover {
    color: #1C1A17 !important;
  }

  .dtl-kicker {
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #1F6F4A;
    margin-bottom: 8px;
  }

  .dtl-title {
    font-family: var(--font-serif);
    font-size: clamp(28px, 4vw, 38px);
    font-weight: 600;
    line-height: 1.2;
    letter-spacing: -0.02em;
    color: #1C1A17;
    max-width: 820px;
    margin: 0 0 12px;
  }

  .dtl-summary {
    font-size: 15.5px;
    line-height: 1.65;
    color: #5C5750;
    max-width: 720px;
    margin: 0 0 24px;
  }

  /* Strip Metadata Kursus */
  .dtl-meta-bar {
    display: inline-flex;
    align-items: center;
    flex-wrap: wrap;
    background-color: #FAF9F6;
    border: 1px solid #E6E2D8;
    border-radius: 8px;
    overflow: hidden;
  }

  .dtl-meta-item {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 15px;
    font-size: 13px;
    color: #3E3A34;
    border-right: 1px solid #E6E2D8;
  }

  .dtl-meta-item:last-child {
    border-right: none;
  }

  .dtl-meta-item i {
    color: #1F6F4A;
    flex-shrink: 0;
  }

  /* Tata Letak Utama 2 Kolom */
  .dtl-main {
    padding: 32px 20px 76px;
  }

  .dtl-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 32px;
    align-items: start;
  }

  .dtl-left-col {
    display: flex;
    flex-direction: column;
    gap: 24px;
    min-width: 0;
  }

  /* Kartu Bagian Konten Solid */
  .dtl-card {
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 10px;
    padding: 28px 30px;
  }

  .dtl-card-head {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid #EFECE4;
  }

  .dtl-section-title {
    font-family: var(--font-judul);
    font-size: 17.5px;
    font-weight: 600;
    color: #1C1A17;
    margin: 0;
  }

  .dtl-section-sub {
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    color: #7A746B;
  }

  .dtl-description {
    font-size: 15px;
    line-height: 1.75;
    color: #3E3A34;
    margin: 0;
  }

  /* Daftar Tujuan Pembelajaran */
  .dtl-goals-grid {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px 22px;
  }

  .dtl-goal-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 14px;
    line-height: 1.55;
    color: #26231F;
  }

  .dtl-goal-check {
    width: 19px;
    height: 19px;
    border-radius: 5px;
    background-color: #F2EFE9;
    border: 1px solid #D8D3C8;
    color: #1F6F4A;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
  }

  /* Daftar Silabus Modul */
  .dtl-syllabus-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .dtl-module-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    padding: 13px 16px;
    border-radius: 8px;
    border: 1px solid #E6E2D8;
    background-color: #FAF9F6;
    text-decoration: none;
    color: #1C1A17;
    transition: border-color 140ms ease, background-color 140ms ease;
  }

  .dtl-module-row:hover {
    border-color: #1F6F4A;
    background-color: #FFFFFF;
    color: #1C1A17 !important;
  }

  .dtl-module-row.is-done {
    background-color: #FFFFFF;
    border-color: #CFC9B8;
    border-left: 3px solid #1F6F4A;
  }

  .dtl-module-left {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
  }

  .dtl-module-num {
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #7A746B;
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 6px;
    width: 30px;
    height: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .dtl-module-row.is-done .dtl-module-num {
    background-color: #1F6F4A;
    border-color: #1F6F4A;
    color: #FFFFFF;
  }

  .dtl-module-name {
    font-size: 14px;
    font-weight: 500;
    color: #1C1A17;
    line-height: 1.4;
  }

  .dtl-module-right {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
  }

  .dtl-module-done-label {
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    color: #1F6F4A;
    letter-spacing: 0.02em;
  }

  .dtl-module-time {
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    color: #7A746B;
  }

  .dtl-module-arrow {
    color: #8C857B;
    transition: transform 140ms ease, color 140ms ease;
  }

  .dtl-module-row:hover .dtl-module-arrow {
    color: #1F6F4A;
    transform: translateX(2px);
  }

  /* Panel Aksi Sticky Kanan */
  .dtl-sidebar-card {
    position: sticky;
    top: 88px;
    background-color: #FFFFFF;
    border: 1px solid #CFC9B8;
    border-radius: 10px;
    padding: 24px;
  }

  .dtl-sidebar-card.is-certified {
    border-top: 4px solid #1F6F4A;
  }

  .dtl-panel-title {
    font-family: var(--font-judul);
    font-size: 16.5px;
    font-weight: 600;
    color: #1C1A17;
    margin: 0 0 8px;
  }

  .dtl-panel-desc {
    font-size: 13.5px;
    line-height: 1.6;
    color: #5C5750;
    margin: 0 0 20px;
  }

  /* Kotak Progres Solid */
  .dtl-progress-box {
    background-color: #FAF9F6;
    border: 1px solid #E6E2D8;
    border-radius: 8px;
    padding: 12px 14px;
    margin-bottom: 18px;
  }

  .dtl-progress-meta {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    font-size: 12px;
    margin-bottom: 7px;
  }

  .dtl-progress-text {
    color: #5C5750;
    font-weight: 500;
  }

  .dtl-progress-pct {
    font-family: var(--font-mono, monospace);
    font-weight: 600;
    color: #1F6F4A;
  }

  .dtl-progress-track {
    width: 100%;
    height: 6px;
    background-color: #E6E2D8;
    border-radius: 999px;
    overflow: hidden;
  }

  .dtl-progress-bar {
    height: 100%;
    background-color: #1F6F4A;
    border-radius: 999px;
    transition: width 240ms ease;
  }

  /* Tombol Aksi */
  .dtl-btn-primary {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    height: 42px;
    padding: 0 16px;
    border-radius: 8px;
    border: 1px solid #1F6F4A;
    background-color: #1F6F4A;
    color: #FFFFFF !important;
    font-family: var(--font-ui);
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    margin-bottom: 10px;
    transition: background-color 140ms ease;
  }

  .dtl-btn-primary:hover {
    background-color: #18583B;
    color: #FFFFFF !important;
  }

  .dtl-btn-secondary {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    width: 100%;
    height: 40px;
    padding: 0 16px;
    border-radius: 8px;
    border: 1px solid #D8D3C8;
    background-color: #FFFFFF;
    color: #1C1A17 !important;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    margin-bottom: 14px;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .dtl-btn-secondary:hover {
    border-color: #1F6F4A;
    color: #1F6F4A !important;
    background-color: #FAF9F6;
  }

  /* Daftar Kelengkapan Program */
  .dtl-inclusions {
    border-top: 1px solid #EFECE4;
    padding-top: 16px;
    margin-top: 6px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .dtl-inclusion-item {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    font-size: 12.5px;
    line-height: 1.45;
    color: #5C5750;
  }

  .dtl-inclusion-item i {
    color: #1F6F4A;
    flex-shrink: 0;
    margin-top: 2px;
  }

  /* State Kursus Tidak Ditemukan */
  .dtl-empty-state {
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 10px;
    padding: 40px 28px;
    text-align: center;
    max-width: 540px;
    margin: 20px auto;
  }

  @media (max-width: 900px) {
    .dtl-grid {
      grid-template-columns: 1fr;
    }

    .dtl-sidebar-card {
      position: static;
    }
  }

  @media (max-width: 640px) {
    .dtl-card {
      padding: 22px 20px;
    }

    .dtl-goals-grid {
      grid-template-columns: 1fr;
    }

    .dtl-meta-bar {
      display: flex;
      flex-direction: column;
      align-items: stretch;
    }

    .dtl-meta-item {
      border-right: none;
      border-bottom: 1px solid #E6E2D8;
    }

    .dtl-meta-item:last-child {
      border-bottom: none;
    }

    .dtl-module-row {
      flex-direction: column;
      align-items: flex-start;
      gap: 8px;
    }

    .dtl-module-right {
      padding-left: 42px;
    }
  }
</style>

<div class="dtl-page">
  <!-- Header Kursus -->
  <section class="dtl-hero">
    <div class="dtl-container">
      <a href="katalog.php" class="dtl-back-link">
        <i data-lucide="arrow-left" style="width: 15px; height: 15px;"></i>
        <span>Kembali ke katalog kursus</span>
      </a>

      <div class="dtl-kicker" id="detail-kategori">Memuat kategori...</div>
      <h1 class="dtl-title" id="detail-judul">Memuat rincian kursus...</h1>
      <p class="dtl-summary" id="detail-ringkasan">
        Ringkasan materi kursus akan tampil di sini.
      </p>

      <div class="dtl-meta-bar" id="detail-meta-bar">
        <div class="dtl-meta-item">
          <i data-lucide="bar-chart-2" style="width: 15px; height: 15px;"></i>
          <span id="detail-level">Tingkat: Pemula</span>
        </div>
        <div class="dtl-meta-item">
          <i data-lucide="clock" style="width: 15px; height: 15px;"></i>
          <span id="detail-waktu" class="angka-mono">Estimasi: 2 jam</span>
        </div>
        <div class="dtl-meta-item">
          <i data-lucide="book-open" style="width: 15px; height: 15px;"></i>
          <span id="detail-jumlah-modul" class="angka-mono">Materi: 4 modul</span>
        </div>
        <div class="dtl-meta-item">
          <i data-lucide="award" style="width: 15px; height: 15px;"></i>
          <span>Sertifikat kelulusan resmi</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Konten Utama -->
  <main class="dtl-main">
    <div class="dtl-container" id="detail-main-container">
      <div class="dtl-grid">
        <!-- Kolom Kiri: Deskripsi, Tujuan Belajar, dan Silabus -->
        <div class="dtl-left-col">
          <!-- Deskripsi Kursus -->
          <section class="dtl-card">
            <div class="dtl-card-head">
              <h2 class="dtl-section-title">Tentang kursus ini</h2>
            </div>
            <p class="dtl-description" id="detail-deskripsi">
              Memuat penjelasan kursus...
            </p>
          </section>

          <!-- Tujuan Belajar -->
          <section class="dtl-card" id="section-tujuan-belajar">
            <div class="dtl-card-head">
              <h2 class="dtl-section-title">Tujuan pembelajaran</h2>
              <span class="dtl-section-sub">Kompetensi target</span>
            </div>
            <ul class="dtl-goals-grid" id="detail-tujuan-list">
              <!-- Dimuat dinamis -->
            </ul>
          </section>

          <!-- Daftar Modul (Silabus) -->
          <section class="dtl-card">
            <div class="dtl-card-head">
              <h2 class="dtl-section-title">Silabus &amp; daftar modul</h2>
              <span class="dtl-section-sub" id="detail-silabus-ringkas">Pilih modul untuk mulai belajar</span>
            </div>
            <div class="dtl-syllabus-list" id="detail-modul-list">
              <!-- Dimuat dinamis -->
            </div>
          </section>
        </div>

        <!-- Kolom Kanan: Panel Aksi Pendaftaran -->
        <aside>
          <div class="dtl-sidebar-card" id="panel-aksi-card">
            <h2 class="dtl-panel-title" id="panel-akses-judul">Akses kursus</h2>
            <p class="dtl-panel-desc" id="panel-akses-ket">
              Kursus ini dapat langsung dipelajari secara penuh. Selesaikan seluruh modul untuk membuka kuis akhir kelulusan.
            </p>

            <div id="panel-progres-wrap" class="dtl-progress-box" style="display: none;">
              <div class="dtl-progress-meta">
                <span class="dtl-progress-text" id="panel-progres-teks">0 dari 4 modul</span>
                <span class="dtl-progress-pct" id="panel-progres-persen">0%</span>
              </div>
              <div class="dtl-progress-track">
                <div class="dtl-progress-bar" id="panel-progres-bar" style="width: 0%;"></div>
              </div>
            </div>

            <a href="#" id="tombol-mulai-belajar" class="dtl-btn-primary">
              Mulai belajar
            </a>

            <a href="#" id="tombol-ke-kuis" class="dtl-btn-secondary" style="display: none;">
              Kerjakan kuis akhir &rarr;
            </a>

            <div class="dtl-inclusions">
              <div class="dtl-inclusion-item">
                <i data-lucide="infinity" style="width: 15px; height: 15px;"></i>
                <span>Akses belajar mandiri tanpa batas waktu</span>
              </div>
              <div class="dtl-inclusion-item">
                <i data-lucide="file-check-2" style="width: 15px; height: 15px;"></i>
                <span>Kuis evaluasi akhir 10 butir soal pilihan ganda</span>
              </div>
              <div class="dtl-inclusion-item">
                <i data-lucide="shield-check" style="width: 15px; height: 15px;"></i>
                <span>Sertifikat kelulusan resmi dengan nomor verifikasi</span>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </main>
</div>

<script type="module">
  import {
    ambilDetailKursus,
    ambilDaftarModul,
    ambilProgresKursus,
    ambilSertifikatPengguna
  } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get('slug') || 'microsoft-excel-dasar';

    const kursus = await ambilDetailKursus(slug);
    if (!kursus) {
      document.getElementById('detail-kategori').textContent = 'Pemberitahuan';
      document.getElementById('detail-judul').textContent = 'Kursus tidak ditemukan';
      document.getElementById('detail-ringkasan').textContent = 'Materi kursus yang Anda cari tidak tersedia atau tautan sudah diperbarui.';
      document.getElementById('detail-meta-bar').style.display = 'none';
      document.getElementById('detail-main-container').innerHTML = `
        <div class="dtl-empty-state">
          <h2 class="dtl-section-title" style="margin-bottom: 8px;">Halaman kursus tidak tersedia</h2>
          <p class="dtl-panel-desc" style="margin-bottom: 20px;">Silakan kembali ke katalog untuk memilih program pelatihan kerja yang tersedia.</p>
          <a href="katalog.php" class="dtl-btn-primary" style="max-width: 240px; margin: 0 auto;">Lihat katalog kursus</a>
        </div>
      `;
      if (typeof lucide !== 'undefined') lucide.createIcons();
      return;
    }

    const [modulList, progresIds, sertifikatSaya] = await Promise.all([
      ambilDaftarModul(slug),
      ambilProgresKursus(slug),
      ambilSertifikatPengguna()
    ]);

    const sertifikatKursus = Array.isArray(sertifikatSaya)
      ? sertifikatSaya.find(s => s.kursus_slug === slug)
      : null;

    const totalModul = modulList.length || kursus.jumlah_modul || 0;
    const totalMenit = modulList.reduce((acc, m) => acc + (parseInt(m.estimasi_menit, 10) || 0), 0);

    document.title = `${kursus.judul} - Skill4Life`;
    document.getElementById('detail-kategori').textContent = kursus.kategori;
    document.getElementById('detail-judul').textContent = kursus.judul;
    document.getElementById('detail-ringkasan').textContent = kursus.ringkasan;
    document.getElementById('detail-level').textContent = `Tingkat: ${kursus.level}`;
    document.getElementById('detail-waktu').textContent = `Estimasi: ${kursus.estimasi_waktu}`;
    document.getElementById('detail-jumlah-modul').textContent = `Materi: ${totalModul} modul`;
    document.getElementById('detail-deskripsi').textContent = kursus.deskripsi;

    if (totalModul > 0) {
      document.getElementById('detail-silabus-ringkas').textContent =
        totalMenit > 0 ? `${totalModul} modul · Total ${totalMenit} menit` : `${totalModul} modul terstruktur`;
    }

    // Tujuan Belajar
    const tujuanList = document.getElementById('detail-tujuan-list');
    const tujuanItems = Array.isArray(kursus.tujuan_belajar) ? kursus.tujuan_belajar : [];
    if (tujuanList && tujuanItems.length > 0) {
      tujuanList.innerHTML = tujuanItems.map(t => `
        <li class="dtl-goal-item">
          <span class="dtl-goal-check" aria-hidden="true">
            <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
              <path d="M2.5 6.2L5 8.7L9.5 3.8" stroke="#1F6F4A" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span>${t}</span>
        </li>
      `).join('');
    } else {
      document.getElementById('section-tujuan-belajar').style.display = 'none';
    }

    // Daftar Modul (dapat diklik)
    const modulContainer = document.getElementById('detail-modul-list');
    if (modulContainer) {
      modulContainer.innerHTML = modulList.map((m, idx) => {
        const isSelesai = progresIds.includes(m.id);
        return `
          <a href="belajar.php?slug=${kursus.slug}&modul=${m.urutan}" class="dtl-module-row ${isSelesai ? 'is-done' : ''}">
            <div class="dtl-module-left">
              <span class="dtl-module-num">${String(idx + 1).padStart(2, '0')}</span>
              <span class="dtl-module-name">${m.judul_modul}</span>
            </div>
            <div class="dtl-module-right">
              ${isSelesai ? '<span class="dtl-module-done-label">Selesai</span>' : ''}
              <span class="dtl-module-time">${m.estimasi_menit} mnt</span>
              <i data-lucide="chevron-right" class="dtl-module-arrow" style="width: 15px; height: 15px;"></i>
            </div>
          </a>
        `;
      }).join('');
    }

    // Panel Aksi Cerdas
    const panelCard = document.getElementById('panel-aksi-card');
    const btnMulai = document.getElementById('tombol-mulai-belajar');
    const btnKuis = document.getElementById('tombol-ke-kuis');
    const total = modulList.length;
    const selesaiCount = modulList.filter(m => progresIds.includes(m.id)).length;

    if (selesaiCount > 0 && total > 0) {
      const persen = Math.round((selesaiCount / total) * 100);
      document.getElementById('panel-progres-wrap').style.display = 'block';
      document.getElementById('panel-progres-teks').textContent = `${selesaiCount} dari ${total} modul`;
      document.getElementById('panel-progres-persen').textContent = `${persen}%`;
      document.getElementById('panel-progres-bar').style.width = `${persen}%`;
    }

    if (sertifikatKursus) {
      panelCard.classList.add('is-certified');
      document.getElementById('panel-akses-judul').textContent = 'Kursus telah dituntaskan';
      document.getElementById('panel-akses-ket').textContent = `Anda telah lulus ujian akhir dengan nilai ${sertifikatKursus.nilai_kuis}/100 dan memiliki sertifikat resmi.`;
      btnMulai.textContent = `Lihat sertifikat (${sertifikatKursus.nomor_sertifikat})`;
      btnMulai.href = `../sertifikat/lihat.php?nomor=${encodeURIComponent(sertifikatKursus.nomor_sertifikat)}`;
      btnKuis.style.display = 'flex';
      btnKuis.textContent = 'Pelajari ulang modul';
      btnKuis.href = `belajar.php?slug=${kursus.slug}&modul=1`;
    } else if (selesaiCount >= total && total > 0) {
      document.getElementById('panel-akses-judul').textContent = 'Siap mengikuti evaluasi akhir';
      document.getElementById('panel-akses-ket').textContent = 'Seluruh modul pembelajaran telah selesai. Kerjakan kuis akhir untuk mendapatkan sertifikat kelulusan.';
      btnMulai.textContent = 'Kerjakan kuis akhir kelulusan \u2192';
      btnMulai.href = `kuis.php?slug=${kursus.slug}`;
      btnKuis.style.display = 'flex';
      btnKuis.textContent = 'Tinjau kembali materi';
      btnKuis.href = `belajar.php?slug=${kursus.slug}&modul=1`;
    } else if (selesaiCount > 0) {
      const modulBelum = modulList.find(m => !progresIds.includes(m.id)) || modulList[0];
      document.getElementById('panel-akses-judul').textContent = 'Lanjutkan pembelajaran';
      btnMulai.textContent = `Lanjutkan belajar (Modul ${modulBelum.urutan})`;
      btnMulai.href = `belajar.php?slug=${kursus.slug}&modul=${modulBelum.urutan}`;
      btnKuis.style.display = 'flex';
      btnKuis.textContent = 'Kerjakan kuis akhir \u2192';
      btnKuis.href = `kuis.php?slug=${kursus.slug}`;
    } else {
      btnMulai.textContent = 'Mulai belajar';
      btnMulai.href = `belajar.php?slug=${kursus.slug}&modul=1`;
    }

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>