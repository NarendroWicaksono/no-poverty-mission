<style>
  header,
  nav,
  footer {
    display: none !important;
  }

  body {
    padding-top: 0 !important;
    margin-top: 0 !important;
    background-color: #121212;
  }

  .blj-layout {
    display: grid;
    grid-template-columns: 288px 1fr;
    min-height: 100vh;
    background-color: #121212;
    font-family: var(--font-ui);
    color: #FFFFFF;
  }

  /* Sidebar Kurikulum Kiri */
  .blj-sidebar {
    background-color: #181818;
    border-right: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    flex-direction: column;
    position: sticky;
    top: 0;
    height: 100vh;
    overflow: hidden;
  }

  .blj-sidebar-top {
    padding: 20px 20px 18px;
    border-bottom: 1px solid #242424;
  }

  .blj-nav-back-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 14px;
  }

  .blj-back-link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12.5px;
    font-weight: 500;
    color: #B3B3B3;
    text-decoration: none;
    transition: color 140ms ease;
  }

  .blj-back-link:hover {
    color: #FFFFFF !important;
  }

  .blj-course-title {
    font-family: var(--font-judul);
    font-size: 15.5px;
    font-weight: 600;
    line-height: 1.38;
    color: #FFFFFF;
    margin: 0 0 14px;
  }

  /* Kotak Progres Solid */
  .blj-progress-box {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 8px;
    padding: 11px 13px;
  }

  .blj-progress-meta {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    font-size: 12px;
    margin-bottom: 7px;
  }

  .blj-progress-label {
    color: #B3B3B3;
    font-weight: 500;
  }

  .blj-progress-num {
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #1DB954;
  }

  .blj-progress-track {
    width: 100%;
    height: 5px;
    background-color: rgba(255, 255, 255, 0.08);
    border-radius: 999px;
    overflow: hidden;
  }

  .blj-progress-fill {
    height: 100%;
    background-color: #1DB954;
    border-radius: 999px;
    transition: width 240ms ease;
  }

  /* Daftar Modul Scrollable */
  .blj-module-section {
    flex: 1;
    overflow-y: auto;
    padding: 16px 12px;
  }

  .blj-module-heading {
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #727272;
    padding: 0 10px;
    margin-bottom: 8px;
  }

  .blj-module-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 3px;
  }

  .blj-module-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 10px;
    border-radius: 8px;
    border: 1px solid transparent;
    text-decoration: none;
    color: #B3B3B3;
    font-size: 13px;
    line-height: 1.35;
    transition: background-color 140ms ease, color 140ms ease;
  }

  .blj-module-link:hover {
    background-color: #121212;
    color: #FFFFFF !important;
  }

  .blj-module-link.aktif {
    background-color: #181818;
    border-color: rgba(255, 255, 255, 0.08);
    color: #FFFFFF !important;
    font-weight: 600;
  }

  .blj-mod-num {
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 500;
    color: #727272;
    min-width: 20px;
    flex-shrink: 0;
  }

  .blj-module-link.aktif .blj-mod-num {
    color: #1DB954;
    font-weight: 600;
  }

  .blj-mod-name {
    flex: 1;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .blj-mod-check {
    width: 18px;
    height: 18px;
    border-radius: 999px;
    background-color: #0D3820;
    color: #FFFFFF; font-weight: 700; border: 1px solid #1DB954;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .blj-mod-dot {
    width: 18px;
    height: 18px;
    border-radius: 999px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    flex-shrink: 0;
  }

  .blj-sidebar-foot {
    padding: 16px 20px 20px;
    border-top: 1px solid #242424;
    background-color: #181818;
  }

  /* Tombol Utama & Sekunder (Kebal Override a:hover) */
  .blj-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 38px;
    padding: 0 16px;
    border-radius: 8px;
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

  .blj-btn-primary:hover {
    background-color: #154D2E;
    color: #FFFFFF !important;
  }

  .blj-btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 38px;
    padding: 0 16px;
    border-radius: 8px;
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

  .blj-btn-secondary:hover {
    border-color: #1DB954;
    color: #1DB954 !important;
    background-color: #181818;
  }

  .blj-btn-done {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 38px;
    padding: 0 16px;
    border-radius: 8px;
    border: 1px solid #1DB954;
    background-color: #181818;
    color: #1DB954 !important;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: background-color 140ms ease;
  }

  .blj-btn-done:hover {
    background-color: rgba(255, 255, 255, 0.08);
    color: #1ED760 !important;
  }

  .blj-btn-full {
    width: 100%;
  }

  /* Area Konten Utama */
  .blj-main {
    padding: 36px 40px 80px;
    min-width: 0;
  }

  .blj-reader-wrap {
    max-width: 780px;
    margin: 0 auto;
  }

  .blj-header {
    margin-bottom: 24px;
    padding-bottom: 18px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .blj-module-kicker {
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: #1DB954;
    margin-bottom: 6px;
  }

  .blj-module-title {
    font-family: var(--font-serif);
    font-size: clamp(24px, 3.2vw, 32px);
    font-weight: 600;
    line-height: 1.25;
    letter-spacing: -0.015em;
    color: #FFFFFF;
    margin: 0;
  }

  /* Banner Kesiapan Kuis (Solid Editorial Card, Tanpa Transparan Neon) */
  .blj-quiz-banner {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-left: 4px solid #1DB954;
    border-radius: 10px;
    padding: 16px 20px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
  }

  .blj-quiz-banner-text {
    font-size: 13.5px;
    line-height: 1.5;
    color: #B3B3B3;
  }

  .blj-quiz-banner-text strong {
    color: #FFFFFF;
    font-weight: 600;
  }

  /* Pemutar Video */
  .blj-video-box {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    border-radius: 10px;
    margin-bottom: 16px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
  }

  /* Toolbar Video: Rating Bintang & Bookmark */
  .blj-video-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    padding: 12px 20px;
    margin-bottom: 24px;
    gap: 16px;
    flex-wrap: wrap;
  }

  .blj-rating-box {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  .blj-rating-stars {
    display: inline-flex;
    align-items: center;
    gap: 2px;
  }

  .blj-star-btn {
    background: transparent;
    border: none;
    padding: 2px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #4A4A4A;
    transition: transform 120ms ease, color 120ms ease;
  }

  .blj-star-btn:hover {
    transform: scale(1.22);
  }

  .blj-star-btn svg {
    width: 20px;
    height: 20px;
    stroke: currentColor;
    fill: none;
    transition: fill 120ms ease, stroke 120ms ease;
  }

  .blj-star-btn.aktif,
  .blj-star-btn.hover {
    color: #FFB800;
  }

  .blj-star-btn.aktif svg,
  .blj-star-btn.hover svg {
    fill: #FFB800;
    stroke: #FFB800;
  }

  .blj-rating-meta {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #B3B3B3;
  }

  .blj-rating-nilai {
    font-weight: 700;
    font-size: 14.5px;
    color: #FFFFFF;
    font-family: var(--font-angka, var(--font-mono, monospace));
  }

  .blj-rating-status {
    font-size: 12.5px;
    color: #B3B3B3;
    font-weight: 500;
  }

  .blj-btn-bookmark {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background-color: #242424;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 999px;
    padding: 8px 18px;
    color: #FFFFFF;
    font-size: 13px;
    font-weight: 600;
    font-family: var(--font-ui);
    cursor: pointer;
    transition: background-color 140ms ease, border-color 140ms ease, color 140ms ease, transform 120ms ease;
  }

  .blj-btn-bookmark:hover {
    border-color: #1DB954;
    color: #1DB954;
    transform: translateY(-1px);
  }

  .blj-btn-bookmark.aktif {
    background-color: rgba(29, 185, 84, 0.14);
    border-color: #1DB954;
    color: #1DB954;
  }

  .blj-btn-bookmark.aktif svg {
    fill: #1DB954;
    stroke: #1DB954;
  }

  /* Lembar Baca Materi */
  .blj-article-sheet {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    padding: 32px 36px;
  }

  .blj-article-content {
    font-family: var(--font-ui);
    font-size: 15.5px;
    line-height: 1.75;
    color: #E0E0E0;
  }

  .blj-article-content h2 {
    font-family: var(--font-judul);
    font-size: 20px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 28px 0 12px;
    line-height: 1.35;
  }

  .blj-article-content h2:first-child,
  .blj-article-content h3:first-child,
  .blj-article-content p:first-child {
    margin-top: 0;
  }

  .blj-article-content h3 {
    font-family: var(--font-judul);
    font-size: 16.5px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 22px 0 8px;
    line-height: 1.4;
  }

  .blj-article-content p {
    margin: 0 0 16px;
  }

  .blj-article-content ul,
  .blj-article-content ol {
    margin: 0 0 18px;
    padding-left: 22px;
  }

  .blj-article-content li {
    margin-bottom: 8px;
  }

  .blj-article-content blockquote {
    margin: 20px 0;
    padding: 14px 18px;
    background-color: #181818;
    border-left: 3px solid #1DB954;
    color: #E0E0E0;
    font-size: 14.5px;
  }

  .blj-article-content code {
    font-family: var(--font-mono, monospace);
    font-size: 13.5px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 1px 5px;
    border-radius: 4px;
    color: #FFFFFF;
  }

  .blj-article-content pre {
    background-color: #181818;
    color: #121212;
    padding: 16px 18px;
    border-radius: 8px;
    overflow-x: auto;
    font-family: var(--font-mono, monospace);
    font-size: 13px;
    line-height: 1.6;
    margin: 18px 0;
  }

  .blj-article-content pre code {
    background: none;
    border: none;
    padding: 0;
    color: inherit;
  }

  /* Bar Navigasi Bawah */
  .blj-footer-nav {
    margin-top: 24px;
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
  }

  .blj-footer-right {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-left: auto;
    flex-wrap: wrap;
  }

  @media (max-width: 920px) {
    .blj-layout {
      grid-template-columns: 1fr;
    }

    .blj-sidebar {
      position: static;
      height: auto;
      border-right: none;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .blj-module-section {
      max-height: 240px;
    }

    .blj-main {
      padding: 24px 18px 56px;
    }

    .blj-article-sheet {
      padding: 24px 20px;
    }
  }
</style>

<div class="blj-layout">
  <!-- Sidebar Kurikulum -->
  <aside class="blj-sidebar">
    <div class="blj-sidebar-top">
      <div class="blj-nav-back-row">
        <a href="../dashboard/index.php" class="blj-back-link">
          <i data-lucide="arrow-left" style="width: 14px; height: 14px;"></i>
          <span>Dashboard</span>
        </a>
        <a href="katalog.php" class="blj-back-link">
          <span>Katalog kursus</span>
        </a>
      </div>

      <h2 class="blj-course-title" id="judul-kursus-sidebar">
        Memuat judul kursus...
      </h2>

      <!-- Bilah Progres Modul -->
      <div class="blj-progress-box">
        <div class="blj-progress-meta">
          <span class="blj-progress-label" id="label-jumlah-selesai">Progres belajar</span>
          <span class="blj-progress-num" id="label-persen-progres">0%</span>
        </div>
        <div class="blj-progress-track">
          <div class="blj-progress-fill" id="bilah-progres-bar" style="width: 0%;"></div>
        </div>
      </div>
    </div>

    <div class="blj-module-section">
      <div class="blj-module-heading">Daftar Modul</div>
      <ul class="blj-module-list" id="nav-modul-list">
        <!-- Dimuat dinamis via JS -->
      </ul>
    </div>

    <!-- Menu Kuis Akhir di Bawah Sidebar -->
    <div class="blj-sidebar-foot">
      <a href="#" id="tautan-ke-kuis" class="blj-btn-secondary blj-btn-full">
        <span>Kuis akhir kelulusan &rarr;</span>
      </a>
    </div>
  </aside>

  <!-- Area Konten Materi -->
  <main class="blj-main">
    <div class="blj-reader-wrap">
      <header class="blj-header">
        <div class="blj-module-kicker" id="label-urutan-modul">
          Modul 1
        </div>
        <h1 class="blj-module-title" id="judul-materi-aktif">
          Memuat modul...
        </h1>
      </header>

      <!-- Banner Kesiapan Kuis (Muncul saat semua modul selesai) -->
      <div id="banner-siap-kuis" class="blj-quiz-banner" style="display: none;">
        <div class="blj-quiz-banner-text">
          <strong>Seluruh modul telah diselesaikan.</strong> Anda siap mengerjakan kuis evaluasi akhir untuk memperoleh sertifikat.
        </div>
        <a href="#" id="btn-banner-kuis" class="blj-btn-primary">Mulai kuis akhir &rarr;</a>
      </div>

      <!-- Pemutar Video YouTube Embed -->
      <div id="wadah-video-embed" class="blj-video-box">
        <!-- Iframe dimuat dinamis -->
      </div>

      <!-- Toolbar Interaktif Video: Rating & Bookmark -->
      <div id="toolbar-video-materi" class="blj-video-toolbar">
        <div class="blj-rating-box">
          <div class="blj-rating-stars" id="wadah-bintang-rating" title="Beri rating video materi ini (1 - 5 bintang)">
            <button type="button" class="blj-star-btn" data-star="1" aria-label="1 Bintang"><i data-lucide="star"></i></button>
            <button type="button" class="blj-star-btn" data-star="2" aria-label="2 Bintang"><i data-lucide="star"></i></button>
            <button type="button" class="blj-star-btn" data-star="3" aria-label="3 Bintang"><i data-lucide="star"></i></button>
            <button type="button" class="blj-star-btn" data-star="4" aria-label="4 Bintang"><i data-lucide="star"></i></button>
            <button type="button" class="blj-star-btn" data-star="5" aria-label="5 Bintang"><i data-lucide="star"></i></button>
          </div>
          <div class="blj-rating-meta">
            <span class="blj-rating-nilai" id="label-rating-rata">5.0</span>
            <span id="label-rating-total" style="color: #888;">(0 ulasan)</span>
            <span class="blj-rating-status" id="label-rating-anda">&bull; Beri rating video</span>
          </div>
        </div>

        <div class="blj-video-actions">
          <button type="button" id="btn-bookmark-video" class="blj-btn-bookmark" title="Simpan video ini ke Aktivitas Saya di profil">
            <i data-lucide="bookmark" id="ikon-bookmark-video" style="width: 15px; height: 15px;"></i>
            <span id="teks-bookmark-video">Simpan Video</span>
          </button>
        </div>
      </div>

      <!-- Teks Materi Nyata -->
      <div class="blj-article-sheet">
        <article class="blj-article-content" id="isi-teks-materi">
          <!-- Dimuat dinamis -->
        </article>
      </div>

      <!-- Navigasi Bawah dan Tombol Tandai Selesai -->
      <div class="blj-footer-nav">
        <a href="#" id="btn-modul-sebelumnya" class="blj-btn-secondary" style="display: none;">
          &larr; Modul sebelumnya
        </a>

        <div class="blj-footer-right">
          <button type="button" id="btn-tandai-selesai" class="blj-btn-primary">
            Tandai selesai
          </button>
          <a href="#" id="btn-modul-selanjutnya" class="blj-btn-secondary">
            Modul selanjutnya &rarr;
          </a>
        </div>
      </div>
    </div>
  </main>
</div>

<script type="module">
  import {
    ambilSesiPengguna,
    ambilDetailKursus,
    ambilDaftarModul,
    simpanProgres,
    hapusProgres,
    ambilProgresKursus,
    normalisasiUrlYoutube,
    ambilRatingModul,
    simpanRatingModul,
    ambilStatusBookmark,
    toggleBookmarkModul
  } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get('slug') || 'microsoft-excel-dasar';
    const noModul = parseInt(urlParams.get('modul') || '1', 10);

    const [kursus, modulList] = await Promise.all([
      ambilDetailKursus(slug),
      ambilDaftarModul(slug)
    ]);

    if (!kursus || !modulList.length) {
      window.location.href = 'katalog.php';
      return;
    }

    let idxAktif = modulList.findIndex(m => m.urutan === noModul);
    if (idxAktif === -1) {
      idxAktif = 0;
    }
    const modulAktif = modulList[idxAktif];
    let progresList = await ambilProgresKursus(slug);

    document.title = `${modulAktif.judul_modul} - ${kursus.judul}`;
    document.getElementById('judul-kursus-sidebar').textContent = kursus.judul;
    document.getElementById('label-urutan-modul').textContent = `Modul ${idxAktif + 1} dari ${modulList.length}`;
    document.getElementById('judul-materi-aktif').textContent = modulAktif.judul_modul;

    // Embed Video dengan normalisasi URL YouTube
    const videoWrap = document.getElementById('wadah-video-embed');
    const urlEmbed = normalisasiUrlYoutube(modulAktif.video_url);
    if (urlEmbed) {
      const sep = urlEmbed.includes('?') ? '&' : '?';
      const srcBersih = `${urlEmbed}${sep}rel=0&modestbranding=1`;
      videoWrap.style.display = 'block';
      videoWrap.innerHTML = `<iframe src="${srcBersih}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy" title="${modulAktif.judul_modul}"></iframe>`;
    } else {
      videoWrap.style.display = 'none';
    }

    document.getElementById('isi-teks-materi').innerHTML = modulAktif.konten;

    // ==========================================
    // Fitur Rating & Bookmark Video Materi
    // ==========================================
    const metaModul = {
      judul_modul: modulAktif.judul_modul,
      kursus_judul: kursus.judul,
      kursus_slug: slug,
      urutan: modulAktif.urutan,
      estimasi_menit: modulAktif.estimasi_menit,
      video_url: modulAktif.video_url
    };

    // 1. Logika Bookmark Video
    const btnBookmark = document.getElementById('btn-bookmark-video');
    const ikonBookmark = document.getElementById('ikon-bookmark-video');
    const teksBookmark = document.getElementById('teks-bookmark-video');

    async function inisialisasiBookmark() {
      const isBookmarked = await ambilStatusBookmark(modulAktif.id);
      if (isBookmarked) {
        btnBookmark.classList.add('aktif');
        teksBookmark.textContent = 'Tersimpan';
        ikonBookmark.style.fill = '#1DB954';
        ikonBookmark.style.stroke = '#1DB954';
      } else {
        btnBookmark.classList.remove('aktif');
        teksBookmark.textContent = 'Simpan Video';
        ikonBookmark.style.fill = 'none';
        ikonBookmark.style.stroke = 'currentColor';
      }
      if (window.lucide) lucide.createIcons();
    }
    inisialisasiBookmark();

    btnBookmark.addEventListener('click', async () => {
      const res = await toggleBookmarkModul(modulAktif.id, metaModul);
      if (res && res.dibookmark) {
        btnBookmark.classList.add('aktif');
        teksBookmark.textContent = 'Tersimpan';
        ikonBookmark.style.fill = '#1DB954';
        ikonBookmark.style.stroke = '#1DB954';
        if (typeof tampilkanToast === 'function') {
          tampilkanToast('Video materi berhasil disimpan ke Aktivitas Saya di profil.', 'sukses');
        }
      } else {
        btnBookmark.classList.remove('aktif');
        teksBookmark.textContent = 'Simpan Video';
        ikonBookmark.style.fill = 'none';
        ikonBookmark.style.stroke = 'currentColor';
        if (typeof tampilkanToast === 'function') {
          tampilkanToast('Video materi dihapus dari simpanan.', 'info');
        }
      }
      if (window.lucide) lucide.createIcons();
    });

    // 2. Logika Rating Bintang Interaktif
    const wadahBintang = document.getElementById('wadah-bintang-rating');
    const starBtns = Array.from(wadahBintang.querySelectorAll('.blj-star-btn'));
    const labelRata = document.getElementById('label-rating-rata');
    const labelTotal = document.getElementById('label-rating-total');
    const labelAnda = document.getElementById('label-rating-anda');

    let ratingTersimpanPengguna = null;

    function renderBintang(nilaiVisual, isHover = false) {
      starBtns.forEach(btn => {
        const val = parseInt(btn.dataset.star, 10);
        if (val <= nilaiVisual) {
          btn.classList.add(isHover ? 'hover' : 'aktif');
        } else {
          btn.classList.remove('hover');
          if (isHover || !ratingTersimpanPengguna || val > ratingTersimpanPengguna) {
            btn.classList.remove('aktif');
          }
        }
      });
    }

    async function inisialisasiRating() {
      const dataRating = await ambilRatingModul(modulAktif.id);
      if (dataRating) {
        labelRata.textContent = dataRating.rata_rata ? Number(dataRating.rata_rata).toFixed(1) : '5.0';
        labelTotal.textContent = `(${dataRating.total_ulasan || 0} ulasan)`;
        if (dataRating.rating_pengguna) {
          ratingTersimpanPengguna = parseInt(dataRating.rating_pengguna, 10);
          renderBintang(ratingTersimpanPengguna, false);
          labelAnda.textContent = `\u2022 Rating Anda: ${ratingTersimpanPengguna}/5 \u2B50`;
          labelAnda.style.color = '#FFB800';
        } else {
          labelAnda.textContent = '\u2022 Beri rating video ini';
          labelAnda.style.color = '#B3B3B3';
        }
      }
      if (window.lucide) lucide.createIcons();
    }
    inisialisasiRating();

    starBtns.forEach(btn => {
      const val = parseInt(btn.dataset.star, 10);
      btn.addEventListener('mouseenter', () => {
        renderBintang(val, true);
      });

      btn.addEventListener('click', async () => {
        ratingTersimpanPengguna = val;
        renderBintang(val, false);
        labelAnda.textContent = `\u2022 Rating Anda: ${val}/5 \u2B50`;
        labelAnda.style.color = '#FFB800';

        const res = await simpanRatingModul(modulAktif.id, val, metaModul);
        if (res && res.data) {
          labelRata.textContent = Number(res.data.rata_rata).toFixed(1);
          labelTotal.textContent = `(${res.data.total_ulasan || 1} ulasan)`;
        }
        if (typeof tampilkanToast === 'function') {
          tampilkanToast(`Terima kasih! Anda memberi rating ${val} bintang untuk video ini.`, 'sukses');
        }
      });
    });

    wadahBintang.addEventListener('mouseleave', () => {
      starBtns.forEach(b => b.classList.remove('hover'));
      if (ratingTersimpanPengguna) {
        renderBintang(ratingTersimpanPengguna, false);
      } else {
        renderBintang(0, false);
      }
    });

    const btnPrev = document.getElementById('btn-modul-sebelumnya');
    const btnNext = document.getElementById('btn-modul-selanjutnya');
    const tautanKuis = document.getElementById('tautan-ke-kuis');
    const btnSelesai = document.getElementById('btn-tandai-selesai');
    const bannerKuis = document.getElementById('banner-siap-kuis');
    const btnBannerKuis = document.getElementById('btn-banner-kuis');

    tautanKuis.href = `kuis.php?slug=${slug}`;
    btnBannerKuis.href = `kuis.php?slug=${slug}`;

    // Navigasi berdasarkan indeks aktual di modulList
    if (idxAktif > 0) {
      btnPrev.style.display = 'inline-flex';
      btnPrev.href = `belajar.php?slug=${slug}&modul=${modulList[idxAktif - 1].urutan}`;
    } else {
      btnPrev.style.display = 'none';
    }

    if (idxAktif < modulList.length - 1) {
      btnNext.href = `belajar.php?slug=${slug}&modul=${modulList[idxAktif + 1].urutan}`;
    } else {
      btnNext.textContent = 'Lanjut ke kuis akhir \u2192';
      btnNext.href = `kuis.php?slug=${slug}`;
      btnNext.className = 'blj-btn-primary';
    }

    function perbaruiTampilanProgres() {
      const jumlahSelesai = modulList.filter(m => progresList.includes(m.id)).length;
      const persen = Math.round((jumlahSelesai / modulList.length) * 100);
      document.getElementById('label-jumlah-selesai').textContent = `${jumlahSelesai} dari ${modulList.length} modul`;
      document.getElementById('label-persen-progres').textContent = `${persen}%`;
      document.getElementById('bilah-progres-bar').style.width = `${persen}%`;

      if (jumlahSelesai >= modulList.length) {
        bannerKuis.style.display = 'flex';
        tautanKuis.className = 'blj-btn-primary blj-btn-full';
      } else {
        bannerKuis.style.display = 'none';
        tautanKuis.className = 'blj-btn-secondary blj-btn-full';
      }

      const navList = document.getElementById('nav-modul-list');
      navList.innerHTML = modulList.map((m, i) => {
        const isSelesai = progresList.includes(m.id);
        const isAktif = m.id === modulAktif.id;
        return `
          <li>
            <a href="belajar.php?slug=${slug}&modul=${m.urutan}" class="blj-module-link ${isAktif ? 'aktif' : ''}">
              <span class="blj-mod-num">${String(i + 1).padStart(2, '0')}</span>
              <span class="blj-mod-name">${m.judul_modul}</span>
              ${isSelesai
                ? `<span class="blj-mod-check" title="Selesai">
                     <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                       <path d="M2.5 6.2L5 8.7L9.5 3.8" stroke="#FFFFFF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                     </svg>
                   </span>`
                : '<span class="blj-mod-dot"></span>'}
            </a>
          </li>
        `;
      }).join('');

      const isSudahSelesai = progresList.includes(modulAktif.id);
      if (isSudahSelesai) {
        btnSelesai.innerHTML = '&check; Modul selesai';
        btnSelesai.className = 'blj-btn-done';
      } else {
        btnSelesai.textContent = 'Tandai selesai';
        btnSelesai.className = 'blj-btn-primary';
      }
    }

    btnSelesai.addEventListener('click', async () => {
      const sesi = ambilSesiPengguna();
      if (!sesi) {
        if (typeof tampilkanToast === 'function') {
          tampilkanToast('Silakan masuk akun terlebih dahulu untuk menyimpan progres modul.', 'peringatan');
        }
        setTimeout(() => {
          window.location.href = '../auth/login.php?pesan=harap_login';
        }, 900);
        return;
      }

      const isSudah = progresList.includes(modulAktif.id);
      if (isSudah) {
        const res = await hapusProgres(slug, modulAktif.id);
        if (res.ok || res.sukses) {
          progresList = res.modul_selesai;
          if (typeof tampilkanToast === 'function') tampilkanToast('Penanda selesai dibatalkan', 'info');
        }
      } else {
        const res = await simpanProgres(slug, modulAktif.id);
        if (res.ok || res.sukses) {
          progresList = res.modul_selesai;
          if (typeof tampilkanToast === 'function') tampilkanToast('Progres modul berhasil disimpan', 'sukses');
        }
      }
      perbaruiTampilanProgres();
    });

    perbaruiTampilanProgres();

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>