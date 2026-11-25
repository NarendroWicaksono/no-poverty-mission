<style>
  html,
  body {
    max-width: 100%;
    overflow-x: hidden;
    background-color: var(--latar, #121212);
    color: var(--teks, #FFFFFF);
  }

  /* Struktur Tata Letak Dashboard */
  .cp-layout {
    display: grid;
    grid-template-columns: 260px 1fr;
    min-height: calc(100vh - 64px);
    background-color: var(--latar, #121212);
    color: var(--teks, #FFFFFF);
    font-family: var(--font-ui);
  }

  /* Sidebar Kiri */
  .cp-sidebar {
    background-color: #181818;
    border-right: 1px solid rgba(255, 255, 255, 0.08);
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    height: 100%;
    box-sizing: border-box;
    overflow-y: auto;
  }

  .cp-brand {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 700;
    font-size: 15px;
    letter-spacing: -0.02em;
    color: #FFFFFF;
    text-decoration: none;
    margin-bottom: 8px;
  }

  .cp-brand-mark {
    width: 26px;
    height: 26px;
    border-radius: 7px;
    background-color: #1DB954;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #FFFFFF;
  }

  /* Identitas Pengguna Sidebar */
  .cp-user-bar {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background-color: #242424;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    margin-bottom: 8px;
  }

  .cp-user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: #0D3820;
    border: 1px solid #1DB954;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
    font-family: var(--font-angka, var(--font-mono, monospace));
    flex-shrink: 0;
  }

  .cp-user-nama {
    font-size: 13.5px;
    font-weight: 600;
    color: #FFFFFF;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .cp-user-sub {
    font-size: 11.5px;
    color: #B3B3B3;
  }

  /* Menu Navigasi */
  .cp-nav-grup {
    margin-bottom: 18px;
  }

  .cp-nav-judul {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #888888;
    padding: 0 12px 6px;
  }

  .cp-nav-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 3px;
  }

  .cp-nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 8px;
    color: #B3B3B3;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 120ms ease;
  }

  .cp-nav-link:hover {
    color: #FFFFFF;
    background-color: #242424;
  }

  .cp-nav-link.aktif {
    background-color: #242424;
    color: #1DB954;
    font-weight: 600;
  }

  .cp-nav-link.aktif i,
  .cp-nav-link.aktif svg {
    color: #1DB954;
  }

  .cp-sidebar-bawah {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding-top: 14px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    margin-top: auto;
  }

  .cp-btn-katalog-sidebar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    height: 38px;
    border-radius: 8px;
    background-color: #0D3820;
    color: #FFFFFF;
    border: 1px solid #1DB954;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: background-color 140ms ease;
  }

  .cp-btn-katalog-sidebar:hover {
    background-color: #134e2c;
  }

  .cp-btn-keluar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    height: 36px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #B3B3B3;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 140ms ease;
  }

  .cp-btn-keluar:hover {
    border-color: #D9A7A2;
    color: #F15E6C;
    background-color: rgba(241, 94, 108, 0.15);
  }

  /* Area Utama */
  .cp-main {
    padding: 32px 40px 72px;
    max-width: 100%;
    width: 100%;
    min-width: 0;
    box-sizing: border-box;
  }

  .cp-header-atas {
    padding-bottom: 18px;
    margin-bottom: 24px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .cp-page-title {
    font-family: var(--font-judul);
    font-size: 24px;
    font-weight: 700;
    letter-spacing: -0.02em;
    color: #FFFFFF;
    margin: 0 0 6px;
  }

  .cp-page-sub {
    font-size: 13.5px;
    color: #B3B3B3;
    margin: 0;
    line-height: 1.55;
  }

  /* Kartu Video & Rating */
  .cp-activity-card {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: border-color 140ms ease, transform 120ms ease;
  }

  .cp-activity-card:hover {
    border-color: rgba(29, 185, 84, 0.4);
    transform: translateY(-2px);
  }

  .cp-activity-kicker {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #1DB954;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .cp-activity-title {
    font-size: 15.5px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0 0 10px;
    line-height: 1.35;
    font-family: var(--font-judul, var(--font-ui));
  }

  .cp-activity-meta {
    font-size: 12.5px;
    color: #B3B3B3;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
  }

  .cp-activity-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 12px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
  }

  .cp-btn-watch {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background-color: #0D3820;
    border: 1px solid #1DB954;
    color: #FFFFFF;
    border-radius: 999px;
    padding: 6px 14px;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
    transition: background-color 140ms ease;
  }

  .cp-btn-watch:hover {
    background-color: #134e2c;
    color: #FFFFFF;
  }

  .cp-btn-remove {
    background: transparent;
    border: none;
    color: #888888;
    cursor: pointer;
    padding: 6px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: color 120ms ease, background-color 120ms ease;
  }

  .cp-btn-remove:hover {
    color: #F15E6C;
    background-color: rgba(241, 94, 108, 0.15);
  }

  .cp-empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 48px 24px;
    background-color: #181818;
    border: 1px dashed rgba(255, 255, 255, 0.12);
    border-radius: 12px;
    color: #B3B3B3;
  }

  .cp-empty-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background-color: rgba(255, 255, 255, 0.05);
    color: #888888;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
  }

  .cp-empty-title {
    font-size: 16px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0 0 6px;
  }

  .cp-empty-desc {
    font-size: 13.5px;
    line-height: 1.5;
    margin: 0 0 18px;
    max-width: 420px;
    margin-left: auto;
    margin-right: auto;
  }

  @media (max-width: 860px) {
    .cp-layout {
      grid-template-columns: 1fr;
    }

    .cp-sidebar {
      position: static;
      height: auto;
      border-right: none;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
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
      <div class="cp-user-avatar" id="sidebar-avatar-inisial">S4</div>
      <div style="min-width: 0;">
        <div class="cp-user-nama" id="sidebar-nama-peserta">Memuat...</div>
        <div class="cp-user-sub" id="sidebar-pekerjaan-peserta">Peserta terdaftar</div>
      </div>
    </div>

    <div class="cp-nav-grup">
      <div class="cp-nav-judul">Aktivitas Saya</div>
      <ul class="cp-nav-list">
        <li>
          <a href="index.php" class="cp-nav-link">
            <i data-lucide="book-open" class="ikon-16"></i>
            <span>Kursus Saya</span>
          </a>
        </li>
        <li>
          <a href="index.php#seksi-sertifikat" class="cp-nav-link">
            <i data-lucide="award" class="ikon-16"></i>
            <span>Sertifikat Saya</span>
          </a>
        </li>
        <li>
          <a href="aktivitas.php" class="cp-nav-link aktif">
            <i data-lucide="bookmark" class="ikon-16"></i>
            <span>Video Disimpan &amp; Rating</span>
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
      <button type="button" id="btn-keluar-profil" class="cp-btn-keluar">
        <span>Keluar akun</span>
      </button>
    </div>
  </aside>

  <!-- Konten Utama Aktivitas -->
  <main class="cp-main">
    <div class="cp-header-atas">
      <h1 class="cp-page-title">Video Disimpan &amp; Rating</h1>
      <p class="cp-page-sub">
        Kelola daftar video materi pembelajaran yang Anda simpan (bookmark) untuk ditonton kembali dan riwayat rating yang telah Anda berikan.
      </p>
    </div>

    <!-- Tab Navigasi Aktivitas -->
    <div style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
      <button type="button" id="tab-btn-bookmark" class="cp-tab-btn" style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 999px; border: 1px solid #1DB954; background-color: rgba(29, 185, 84, 0.15); color: #1DB954; font-weight: 600; font-size: 13.5px; cursor: pointer; transition: all 140ms ease;">
        <i data-lucide="bookmark" style="width: 15px; height: 15px; fill: #1DB954;"></i>
        <span>Video Tersimpan</span>
        <span id="badge-count-bookmark" style="background-color: #1DB954; color: #121212; padding: 2px 7px; border-radius: 999px; font-size: 11px; font-weight: 700; margin-left: 2px;">0</span>
      </button>
      <button type="button" id="tab-btn-rating" class="cp-tab-btn" style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 999px; border: 1px solid rgba(255, 255, 255, 0.1); background-color: #181818; color: #B3B3B3; font-weight: 600; font-size: 13.5px; cursor: pointer; transition: all 140ms ease;">
        <i data-lucide="star" style="width: 15px; height: 15px;"></i>
        <span>Rating Materi Saya</span>
        <span id="badge-count-rating" style="background-color: rgba(255, 255, 255, 0.12); color: #FFFFFF; padding: 2px 7px; border-radius: 999px; font-size: 11px; font-weight: 700; margin-left: 2px;">0</span>
      </button>
    </div>

    <!-- Panel Konten 1: Video Tersimpan (Bookmarks) -->
    <div id="panel-tab-bookmark">
      <div id="kontainer-bookmark" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 16px;">
        <!-- Dimuat dinamis -->
      </div>
    </div>

    <!-- Panel Konten 2: Rating Video Materi -->
    <div id="panel-tab-rating" style="display: none;">
      <div id="kontainer-rating" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 16px;">
        <!-- Dimuat dinamis -->
      </div>
    </div>
  </main>
</div>

<script type="module">
  import {
    ambilSesiPengguna,
    keluarAkun,
    ambilAktivitasPengguna,
    toggleBookmarkModul
  } from '../assets/js/api.js';

  function perbaruiHeaderSidebar(namaLengkap, pekerjaan) {
    const nama = namaLengkap || 'Peserta';
    document.getElementById('sidebar-nama-peserta').textContent = nama;
    document.getElementById('sidebar-pekerjaan-peserta').textContent = pekerjaan || 'Peserta terdaftar';

    const inisial = nama
      .split(' ')
      .filter(Boolean)
      .slice(0, 2)
      .map(k => k[0].toUpperCase())
      .join('');
    document.getElementById('sidebar-avatar-inisial').textContent = inisial || 'S4';
  }

  document.addEventListener('DOMContentLoaded', () => {
    const sesi = ambilSesiPengguna();
    if (!sesi || sesi.peran !== 'peserta') {
      window.location.href = '../auth/login.php?pesan=harap_login';
      return;
    }

    perbaruiHeaderSidebar(sesi.nama_lengkap, sesi.pekerjaan);

    document.getElementById('btn-keluar-profil').addEventListener('click', async () => {
      await keluarAkun();
      window.location.href = '../auth/login.php';
    });

    const tabBtnBookmark = document.getElementById('tab-btn-bookmark');
    const tabBtnRating = document.getElementById('tab-btn-rating');
    const panelBookmark = document.getElementById('panel-tab-bookmark');
    const panelRating = document.getElementById('panel-tab-rating');
    const wadahBookmark = document.getElementById('kontainer-bookmark');
    const wadahRating = document.getElementById('kontainer-rating');
    const badgeBookmark = document.getElementById('badge-count-bookmark');
    const badgeRating = document.getElementById('badge-count-rating');

    function gantiTabAktivitas(tab) {
      if (tab === 'bookmark') {
        panelBookmark.style.display = 'block';
        panelRating.style.display = 'none';
        tabBtnBookmark.style.borderColor = '#1DB954';
        tabBtnBookmark.style.backgroundColor = 'rgba(29, 185, 84, 0.15)';
        tabBtnBookmark.style.color = '#1DB954';
        tabBtnRating.style.borderColor = 'rgba(255, 255, 255, 0.1)';
        tabBtnRating.style.backgroundColor = '#181818';
        tabBtnRating.style.color = '#B3B3B3';
      } else {
        panelBookmark.style.display = 'none';
        panelRating.style.display = 'block';
        tabBtnRating.style.borderColor = '#1DB954';
        tabBtnRating.style.backgroundColor = 'rgba(29, 185, 84, 0.15)';
        tabBtnRating.style.color = '#1DB954';
        tabBtnBookmark.style.borderColor = 'rgba(255, 255, 255, 0.1)';
        tabBtnBookmark.style.backgroundColor = '#181818';
        tabBtnBookmark.style.color = '#B3B3B3';
      }
      if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    tabBtnBookmark.addEventListener('click', () => gantiTabAktivitas('bookmark'));
    tabBtnRating.addEventListener('click', () => gantiTabAktivitas('rating'));

    async function muatDanTampilkanAktivitas() {
      const dataAktivitas = await ambilAktivitasPengguna();
      const bookmarks = dataAktivitas.bookmark || [];
      const ratings = dataAktivitas.rating || [];

      badgeBookmark.textContent = bookmarks.length;
      badgeRating.textContent = ratings.length;

      // Render Video Tersimpan (Bookmarks)
      if (bookmarks.length === 0) {
        wadahBookmark.innerHTML = `
          <div class="cp-empty-state">
            <div class="cp-empty-icon">
              <i data-lucide="bookmark" style="width: 22px; height: 22px;"></i>
            </div>
            <div class="cp-empty-title">Belum ada video materi yang disimpan</div>
            <p class="cp-empty-desc">
              Tandai video materi favorit Anda saat belajar dengan menekan tombol <strong>Simpan Video</strong> pada pemutar video materi.
            </p>
            <a href="../kursus/katalog.php" class="cp-btn-watch" style="margin: 0 auto;">
              <span>Jelajahi Katalog Kursus</span>
              <i data-lucide="arrow-right" style="width: 13px; height: 13px;"></i>
            </a>
          </div>
        `;
      } else {
        wadahBookmark.innerHTML = bookmarks.map(b => `
          <div class="cp-activity-card" id="card-bm-${b.modul_id}">
            <div>
              <div class="cp-activity-kicker">
                <i data-lucide="video" style="width: 13px; height: 13px;"></i>
                <span>Modul ${b.urutan || 1} &bull; ${b.kursus_judul || 'Kursus Keterampilan'}</span>
              </div>
              <h3 class="cp-activity-title">${b.judul_modul}</h3>
              <div class="cp-activity-meta">
                <i data-lucide="clock" style="width: 13px; height: 13px;"></i>
                <span>${b.estimasi_menit || 15} Menit</span>
                <span>&bull;</span>
                <span style="color: #1DB954;">Tersimpan</span>
              </div>
            </div>
            <div class="cp-activity-actions">
              <a href="../kursus/belajar.php?slug=${b.kursus_slug}&modul=${b.urutan || 1}" class="cp-btn-watch">
                <span>Tonton Video</span>
                <i data-lucide="play" style="width: 12px; height: 12px; fill: currentColor;"></i>
              </a>
              <button type="button" class="cp-btn-remove btn-hapus-bm" data-modul="${b.modul_id}" title="Hapus dari video tersimpan">
                <i data-lucide="trash-2" style="width: 15px; height: 15px;"></i>
              </button>
            </div>
          </div>
        `).join('');

        // Pasang listener hapus bookmark
        wadahBookmark.querySelectorAll('.btn-hapus-bm').forEach(btn => {
          btn.addEventListener('click', async () => {
            const idModul = parseInt(btn.dataset.modul, 10);
            await toggleBookmarkModul(idModul);
            if (typeof tampilkanToast === 'function') {
              tampilkanToast('Video materi dihapus dari simpanan.', 'info');
            }
            muatDanTampilkanAktivitas();
          });
        });
      }

      // Render Riwayat Rating Video Materi
      if (ratings.length === 0) {
        wadahRating.innerHTML = `
          <div class="cp-empty-state">
            <div class="cp-empty-icon">
              <i data-lucide="star" style="width: 22px; height: 22px;"></i>
            </div>
            <div class="cp-empty-title">Belum ada video materi yang diberi rating</div>
            <p class="cp-empty-desc">
              Beri rating 1–5 bintang pada video materi yang Anda pelajari untuk membantu menandai kualitas pembelajaran.
            </p>
            <a href="../kursus/katalog.php" class="cp-btn-watch" style="margin: 0 auto;">
              <span>Mulai Belajar Sekarang</span>
              <i data-lucide="arrow-right" style="width: 13px; height: 13px;"></i>
            </a>
          </div>
        `;
      } else {
        wadahRating.innerHTML = ratings.map(r => {
          const skor = parseInt(r.rating, 10) || 5;
          let bintangHTML = '';
          for (let s = 1; s <= 5; s++) {
            if (s <= skor) {
              bintangHTML += '<i data-lucide="star" style="width: 14px; height: 14px; fill: #FFB800; stroke: #FFB800;"></i>';
            } else {
              bintangHTML += '<i data-lucide="star" style="width: 14px; height: 14px; stroke: #4A4A4A; fill: none;"></i>';
            }
          }

          return `
            <div class="cp-activity-card">
              <div>
                <div class="cp-activity-kicker">
                  <i data-lucide="award" style="width: 13px; height: 13px;"></i>
                  <span>Modul ${r.urutan || 1} &bull; ${r.kursus_judul || 'Kursus Keterampilan'}</span>
                </div>
                <h3 class="cp-activity-title">${r.judul_modul}</h3>
                <div class="cp-activity-meta">
                  <div style="display: inline-flex; align-items: center; gap: 2px;">
                    ${bintangHTML}
                  </div>
                  <span style="font-weight: 700; color: #FFFFFF; font-size: 13px; margin-left: 4px;">${skor}/5</span>
                  <span style="color: #888;">&bull; Rating Anda</span>
                </div>
              </div>
              <div class="cp-activity-actions">
                <a href="../kursus/belajar.php?slug=${r.kursus_slug}&modul=${r.urutan || 1}" class="cp-btn-watch">
                  <span>Buka Video &amp; Ubah Rating</span>
                  <i data-lucide="arrow-right" style="width: 13px; height: 13px;"></i>
                </a>
              </div>
            </div>
          `;
        }).join('');
      }

      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    }

    muatDanTampilkanAktivitas();

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>
