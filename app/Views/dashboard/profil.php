<style>
  header,
  nav,
  footer {
    display: none !important;
  }

  body {
    padding-top: 0 !important;
    margin-top: 0 !important;
  }

  .cp-layout {
    display: grid;
    grid-template-columns: 248px 1fr;
    min-height: 100vh;
    background-color: #121212;
    font-family: var(--font-ui);
    color: #FFFFFF;
  }

  /* Sidebar Kiri */
  .cp-sidebar {
    background-color: #181818;
    border-right: 1px solid rgba(255, 255, 255, 0.08);
    padding: 22px 16px 24px;
    display: flex;
    flex-direction: column;
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
  }

  .cp-brand {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 2px 6px 18px;
    margin-bottom: 16px;
    border-bottom: 1px solid #242424;
    text-decoration: none;
    color: #FFFFFF;
    font-family: var(--font-judul);
    font-size: 17px;
    font-weight: 700;
    letter-spacing: -0.02em;
  }

  .cp-brand:hover {
    color: #1DB954;
  }

  .cp-brand-mark {
    width: 28px;
    height: 28px;
    border-radius: 7px;
    background-color: #0D3820;
    color: #FFFFFF; font-weight: 700; border: 1px solid #1DB954;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .cp-user-bar {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 2px 6px 18px;
    margin-bottom: 18px;
    border-bottom: 1px solid #242424;
  }

  .cp-user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 999px;
    background-color: #0D3820;
    color: #FFFFFF; font-weight: 700; border: 1px solid #1DB954;
    font-family: var(--font-judul);
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .cp-user-nama {
    font-family: var(--font-judul);
    font-size: 14px;
    font-weight: 600;
    color: #FFFFFF;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .cp-user-sub {
    font-size: 12px;
    color: #B3B3B3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-top: 1px;
  }

  .cp-nav-grup {
    margin-bottom: 20px;
  }

  .cp-nav-judul {
    font-family: var(--font-ui);
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #727272;
    padding: 0 12px;
    margin-bottom: 6px;
  }

  .cp-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .cp-nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 8px;
    font-size: 13.5px;
    font-weight: 400;
    color: #B3B3B3;
    text-decoration: none;
    transition: background-color 140ms ease, color 140ms ease;
  }

  .cp-nav-link:hover {
    background-color: #121212;
    color: #FFFFFF;
  }

  .cp-nav-link.aktif {
    background-color: #181818;
    color: #1DB954;
    font-weight: 600;
  }

  .cp-nav-link.aktif svg,
  .cp-nav-link.aktif i {
    color: #1DB954;
  }

  .cp-sidebar-bawah {
    margin-top: auto;
    padding-top: 16px;
    border-top: 1px solid #242424;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .cp-btn-katalog-sidebar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 10px 14px;
    border-radius: 8px;
    background-color: #0D3820;
    color: #FFFFFF; font-weight: 700; border: 1px solid #1DB954;
    font-family: var(--font-judul);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: background-color 150ms ease;
  }

  .cp-btn-katalog-sidebar:hover {
    background-color: #154D2E;
    color: #FFFFFF !important;
  }

  .cp-btn-keluar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 8px 12px;
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

  /* Area Kerja Utama */
  .cp-main {
    padding: 32px 40px 72px;
    max-width: 100%;
    width: 100%;
    min-width: 0;
  }

  .cp-header-atas {
    padding-bottom: 18px;
    margin-bottom: 24px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .cp-page-title {
    font-family: var(--font-judul);
    font-size: 24px;
    font-weight: 600;
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

  /* Status Alert */
  #profil-pesan-status {
    margin-bottom: 20px;
    border-radius: 10px;
  }

  /* Grid 2 Kolom Pengaturan Profil */
  .cp-profil-grid {
    display: grid;
    grid-template-columns: 1.35fr 1fr;
    gap: 24px;
    align-items: start;
  }

  .cp-panel {
    background-color: #181818;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    overflow: hidden;
  }

  .cp-panel-header {
    padding: 18px 24px;
    border-bottom: 1px solid #242424;
  }

  .cp-panel-title {
    font-family: var(--font-judul);
    font-size: 16px;
    font-weight: 600;
    color: #FFFFFF;
    margin: 0 0 3px;
  }

  .cp-panel-desc {
    font-size: 12.5px;
    color: #B3B3B3;
    margin: 0;
  }

  .cp-panel-body {
    padding: 22px 24px 24px;
  }

  .cp-field-group {
    margin-bottom: 18px;
  }

  .cp-field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }

  .cp-label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    color: #FFFFFF;
    margin-bottom: 6px;
  }

  .cp-input {
    width: 100%;
    height: 40px;
    padding: 0 13px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    font-family: var(--font-ui);
    font-size: 13.5px;
    color: #FFFFFF;
    transition: border-color 140ms ease, box-shadow 140ms ease;
  }

  .cp-input:focus {
    outline: none;
    border-color: #1DB954;
    box-shadow: 0 0 0 3px rgba(31, 111, 74, 0.1);
  }

  .cp-input:disabled {
    background-color: #121212;
    color: #B3B3B3;
    border-color: rgba(255, 255, 255, 0.08);
    cursor: not-allowed;
  }

  .cp-help {
    font-size: 12px;
    color: #727272;
    margin-top: 5px;
    line-height: 1.45;
  }

  /* Input Kata Sandi dengan Toggle Intip */
  .cp-pass-wrap {
    position: relative;
    display: flex;
    align-items: center;
  }

  .cp-pass-wrap .cp-input {
    padding-right: 40px;
  }

  .cp-pass-toggle {
    position: absolute;
    right: 10px;
    background: none;
    border: none;
    color: #727272;
    cursor: pointer;
    padding: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: color 140ms ease;
  }

  .cp-pass-toggle:hover {
    color: #FFFFFF;
  }

  .cp-panel-footer {
    padding-top: 6px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
  }

  .cp-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 38px;
    padding: 0 18px;
    border-radius: 8px;
    border: 1px solid #1DB954;
    background-color: #0D3820;
    color: #FFFFFF; font-weight: 700; border: 1px solid #1DB954;
    font-family: var(--font-ui);
    font-size: 13.5px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 140ms ease;
  }

  .cp-btn-primary:hover {
    background-color: #154D2E;
    color: #FFFFFF !important;
  }

  .cp-btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 38px;
    padding: 0 18px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background-color: #181818;
    color: #FFFFFF;
    font-family: var(--font-ui);
    font-size: 13.5px;
    font-weight: 500;
    cursor: pointer;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .cp-btn-secondary:hover {
    border-color: #1DB954;
    color: #1DB954;
    background-color: #181818;
  }

  @media (max-width: 1040px) {
    .cp-profil-grid {
      grid-template-columns: 1fr;
    }
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

  @media (max-width: 600px) {
    .cp-field-row {
      grid-template-columns: 1fr;
      gap: 0;
    }

    .cp-panel-header,
    .cp-panel-body {
      padding-left: 18px;
      padding-right: 18px;
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
          <a href="profil.php" class="cp-nav-link aktif">
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

  <!-- Konten Pengaturan Profil -->
  <main class="cp-main">
    <div class="cp-header-atas">
      <h1 class="cp-page-title">Pengaturan Profil</h1>
      <p class="cp-page-sub">
        Perbarui nama lengkap untuk pencantuman pada sertifikat dan kelola keamanan kata sandi akun Anda.
      </p>
    </div>

    <div id="profil-pesan-status" style="display: none;"></div>

    <div class="cp-profil-grid">
      <!-- Panel 1: Data Identitas -->
      <section class="cp-panel">
        <div class="cp-panel-header">
          <h2 class="cp-panel-title">Data Identitas</h2>
          <p class="cp-panel-desc">Informasi dasar peserta yang terhubung dengan riwayat belajar dan sertifikat.</p>
        </div>

        <div class="cp-panel-body">
          <form id="form-edit-identitas">
            <div class="cp-field-group">
              <label class="cp-label" for="profil-nama">Nama lengkap</label>
              <input type="text" id="profil-nama" class="cp-input" placeholder="Masukkan nama lengkap sesuai identitas" required>
              <div class="cp-help">Nama ini akan tercetak langsung pada lembar sertifikat kelulusan resmi Anda.</div>
            </div>

            <div class="cp-field-group">
              <label class="cp-label" for="profil-email">Alamat email</label>
              <input type="email" id="profil-email" class="cp-input" disabled>
              <div class="cp-help">Alamat email digunakan sebagai identitas login utama dan tidak dapat diubah.</div>
            </div>

            <div class="cp-field-row">
              <div class="cp-field-group">
                <label class="cp-label" for="profil-telepon">Nomor telepon / WhatsApp</label>
                <input type="text" id="profil-telepon" class="cp-input" placeholder="Contoh: 081234567890">
              </div>

              <div class="cp-field-group">
                <label class="cp-label" for="profil-kota">Kota domisili</label>
                <input type="text" id="profil-kota" class="cp-input" placeholder="Contoh: Bandung">
              </div>
            </div>

            <div class="cp-field-group">
              <label class="cp-label" for="profil-pekerjaan">Status pekerjaan saat ini</label>
              <input type="text" id="profil-pekerjaan" class="cp-input" placeholder="Contoh: Pencari Kerja, Mahasiswa, Pelaku UMKM">
            </div>

            <div class="cp-panel-footer">
              <button type="submit" class="cp-btn-primary">
                Simpan perubahan
              </button>
            </div>
          </form>
        </div>
      </section>

      <!-- Panel 2: Keamanan & Kata Sandi -->
      <section class="cp-panel">
        <div class="cp-panel-header">
          <h2 class="cp-panel-title">Ubah Kata Sandi</h2>
          <p class="cp-panel-desc">Gunakan kombinasi minimal 8 karakter untuk menjaga keamanan akun.</p>
        </div>

        <div class="cp-panel-body">
          <form id="form-ubah-sandi">
            <div class="cp-field-group">
              <label class="cp-label" for="sandi-lama">Kata sandi saat ini</label>
              <div class="cp-pass-wrap">
                <input type="password" id="sandi-lama" class="cp-input" placeholder="Masukkan kata sandi lama" required>
                <button type="button" class="cp-pass-toggle" data-target="sandi-lama" aria-label="Tampilkan kata sandi">
                  <i data-lucide="eye" style="width: 16px; height: 16px;"></i>
                </button>
              </div>
            </div>

            <div class="cp-field-group">
              <label class="cp-label" for="sandi-baru">Kata sandi baru</label>
              <div class="cp-pass-wrap">
                <input type="password" id="sandi-baru" class="cp-input" placeholder="Minimal 8 karakter" minlength="8" required>
                <button type="button" class="cp-pass-toggle" data-target="sandi-baru" aria-label="Tampilkan kata sandi">
                  <i data-lucide="eye" style="width: 16px; height: 16px;"></i>
                </button>
              </div>
            </div>

            <div class="cp-field-group">
              <label class="cp-label" for="sandi-konfirmasi">Ulangi kata sandi baru</label>
              <div class="cp-pass-wrap">
                <input type="password" id="sandi-konfirmasi" class="cp-input" placeholder="Ketik ulang kata sandi baru" minlength="8" required>
                <button type="button" class="cp-pass-toggle" data-target="sandi-konfirmasi" aria-label="Tampilkan kata sandi">
                  <i data-lucide="eye" style="width: 16px; height: 16px;"></i>
                </button>
              </div>
            </div>

            <div class="cp-panel-footer">
              <button type="submit" class="cp-btn-secondary">
                Perbarui kata sandi
              </button>
            </div>
          </form>
        </div>
      </section>
    </div>
  </main>
</div>

<script type="module">
  import { ambilSesiPengguna, keluarAkun, perbaruiProfilPengguna, ubahKataSandiPengguna } from '../assets/js/api.js';

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

    document.getElementById('profil-nama').value = sesi.nama_lengkap || '';
    document.getElementById('profil-email').value = sesi.email || '';
    document.getElementById('profil-telepon').value = sesi.nomor_telepon || '';
    document.getElementById('profil-kota').value = sesi.kota || '';
    document.getElementById('profil-pekerjaan').value = sesi.pekerjaan || '';

    // Toggle lihat/sembunyikan kata sandi
    document.querySelectorAll('.cp-pass-toggle').forEach(btn => {
      btn.addEventListener('click', () => {
        const targetId = btn.getAttribute('data-target');
        const input = document.getElementById(targetId);
        if (!input) return;

        const tersembunyi = input.type === 'password';
        input.type = tersembunyi ? 'text' : 'password';
        btn.innerHTML = `<i data-lucide="${tersembunyi ? 'eye-off' : 'eye'}" style="width: 16px; height: 16px;"></i>`;
        if (typeof lucide !== 'undefined') {
          lucide.createIcons({ nodes: [btn] });
        }
      });
    });

    document.getElementById('btn-keluar-profil').addEventListener('click', async () => {
      await keluarAkun();
      window.location.href = '../auth/login.php';
    });

    const pesanBox = document.getElementById('profil-pesan-status');

    document.getElementById('form-edit-identitas').addEventListener('submit', async (e) => {
      e.preventDefault();
      const res = await perbaruiProfilPengguna({
        nama_lengkap: document.getElementById('profil-nama').value,
        nomor_telepon: document.getElementById('profil-telepon').value,
        pekerjaan: document.getElementById('profil-pekerjaan').value,
        kota: document.getElementById('profil-kota').value
      });

      if (res.ok) {
        perbaruiHeaderSidebar(res.user.nama_lengkap, res.user.pekerjaan);
        pesanBox.className = 'pesan-status pesan-status-sukses';
        pesanBox.textContent = 'Perubahan data identitas profil berhasil disimpan dan disinkronkan ke sertifikat.';
        pesanBox.style.display = 'flex';
        if (typeof tampilkanToast === 'function') tampilkanToast('Profil berhasil diperbarui', 'sukses');
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } else {
        pesanBox.className = 'pesan-status pesan-status-galat';
        pesanBox.textContent = res.pesan || 'Gagal memperbarui profil.';
        pesanBox.style.display = 'flex';
      }
    });

    document.getElementById('form-ubah-sandi').addEventListener('submit', async (e) => {
      e.preventDefault();
      const lama = document.getElementById('sandi-lama').value;
      const baru = document.getElementById('sandi-baru').value;
      const konfirmasi = document.getElementById('sandi-konfirmasi').value;

      if (baru.length < 8) {
        pesanBox.className = 'pesan-status pesan-status-galat';
        pesanBox.textContent = 'Kata sandi baru minimal 8 karakter.';
        pesanBox.style.display = 'flex';
        return;
      }

      if (baru !== konfirmasi) {
        pesanBox.className = 'pesan-status pesan-status-galat';
        pesanBox.textContent = 'Konfirmasi kata sandi tidak cocok.';
        pesanBox.style.display = 'flex';
        return;
      }

      const res = await ubahKataSandiPengguna({ sandi_lama: lama, sandi_baru: baru });
      if (!res.ok) {
        pesanBox.className = 'pesan-status pesan-status-galat';
        pesanBox.textContent = res.pesan || 'Gagal memperbarui kata sandi.';
        pesanBox.style.display = 'flex';
        if (typeof tampilkanToast === 'function') tampilkanToast(res.pesan || 'Kata sandi lama salah', 'galat');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
      }

      pesanBox.className = 'pesan-status pesan-status-sukses';
      pesanBox.textContent = res.pesan || 'Kata sandi akun berhasil diperbarui di database.';
      pesanBox.style.display = 'flex';
      document.getElementById('form-ubah-sandi').reset();
      if (typeof tampilkanToast === 'function') tampilkanToast('Kata sandi diperbarui', 'sukses');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>