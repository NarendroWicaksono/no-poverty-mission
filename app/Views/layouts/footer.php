</main>

<style>
  .kaki-halaman {
    background-color: var(--permukaan);
    border-top: 1px solid var(--garis);
    padding: var(--spasi-64) 0 var(--spasi-32);
    font-family: var(--font-ui);
  }

  .kaki-brand-judul {
    font-family: var(--font-judul);
    font-size: var(--teks-20);
    font-weight: 700;
    letter-spacing: -0.02em;
    color: var(--teks);
    margin-bottom: var(--spasi-12);
  }

  .kaki-kolom-judul {
    font-family: var(--font-judul);
    font-size: var(--teks-14);
    font-weight: 700;
    letter-spacing: -0.01em;
    color: var(--teks);
    margin-bottom: var(--spasi-16);
  }

  .kaki-deskripsi {
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    font-weight: 400;
    line-height: var(--jarak-baris-baca);
    color: var(--teks-2);
    margin: 0;
  }

  .kaki-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: var(--spasi-12);
    font-size: var(--teks-14);
  }

  .kaki-nav-list a {
    color: var(--teks-2);
    text-decoration: none;
    transition: var(--transisi-cepat);
  }

  .kaki-nav-list a:hover {
    color: var(--aksen);
  }

  .kaki-email-link {
    color: var(--aksen);
    font-weight: 500;
    text-decoration: none;
  }

  .kaki-email-link:hover {
    text-decoration: underline;
  }
</style>

<footer class="kaki-halaman">
  <div class="wadah">
    <div class="kaki-grid">
      <div>
        <div class="kaki-brand-judul">
          Skill4Life
        </div>
        <p class="kaki-deskripsi" style="margin-bottom: var(--spasi-16); max-width: 440px;">
          Website pembelajaran keterampilan kerja gratis untuk mendukung Tujuan Pembangunan Berkelanjutan (SDG) 1: Tanpa Kemiskinan. Seluruh modul dan sertifikat dapat diakses masyarakat tanpa biaya pendaftaran maupun langganan.
        </p>
        <div style="font-size: var(--teks-12); color: var(--teks-3);">
          Email: <a href="mailto:kontak@skill4life.id" class="kaki-email-link">kontak@skill4life.id</a>
        </div>
      </div>

      <div>
        <div class="kaki-kolom-judul">
          Navigasi
        </div>
        <ul class="kaki-nav-list">
          <li><a href="<?= $baseUrl ?>/index.php">Beranda</a></li>
          <li><a href="<?= $baseUrl ?>/kursus/katalog.php">Katalog kursus</a></li>
          <li><a href="<?= $baseUrl ?>/sertifikat/verifikasi.php">Verifikasi sertifikat</a></li>
          <li><a href="<?= $baseUrl ?>/dashboard/index.php">Dashboard belajar</a></li>
          <li><a href="<?= $baseUrl ?>/admin/login.php">Panel pengelola</a></li>
        </ul>
      </div>

      <div>
        <div class="kaki-kolom-judul">
          Komitmen akses
        </div>
        <p class="kaki-deskripsi">
          Semua kursus terbuka penuh. Tidak ada materi yang dikunci, uji coba berbatas waktu, maupun jalur berbayar.
        </p>
      </div>
    </div>

    <div style="border-top: 1px solid var(--garis); padding-top: var(--spasi-20); margin-top: var(--spasi-40); display: flex; justify-content: space-between; align-items: center; font-size: var(--teks-12); color: var(--teks-3); flex-wrap: wrap; gap: var(--spasi-12);">
      <div>&copy; 2026 Skill4Life. Dibangun untuk menciptakan masyarakat terampil berdaya saing tinggi.</div>
    </div>
  </div>
</footer>

<script>
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  function tampilkanToast(pesan, jenis = 'info') {
    let wadah = document.querySelector('.toast-container');
    if (!wadah) {
      wadah = document.createElement('div');
      wadah.className = 'toast-container';
      document.body.appendChild(wadah);
    }

    const notif = document.createElement('div');
    notif.className = `toast-notif toast-notif--${jenis}`;

    const namaIkon = {
      sukses: 'check',
      success: 'check',
      galat: 'x-circle',
      error: 'x-circle',
      peringatan: 'alert-triangle',
      warning: 'alert-triangle',
      info: 'info'
    }[jenis] || 'info';

    notif.innerHTML = `
      <i data-lucide="${namaIkon}" style="width: 16px; height: 16px; flex-shrink: 0;"></i>
      <span style="flex: 1; font-size: var(--teks-14);">${pesan}</span>
      <button type="button" onclick="this.closest('.toast-notif').remove()" style="background: none; border: none; color: var(--teks-3); cursor: pointer; padding: 0; display: flex;">
        <i data-lucide="x" style="width: 14px; height: 14px;"></i>
      </button>
    `;

    wadah.appendChild(notif);
    if (typeof lucide !== 'undefined') {
      lucide.createIcons({ nodes: [notif] });
    }
    requestAnimationFrame(() => notif.classList.add('toast-notif--visibel'));

    const timer = setTimeout(() => {
      notif.classList.remove('toast-notif--visibel');
      setTimeout(() => notif.remove(), 200);
    }, 3500);

    const btn = notif.querySelector('button');
    if (btn) btn.addEventListener('click', () => clearTimeout(timer));
  }

  (function perbaruiNavbarSesi() {
    const baseUrl = <?= json_encode($baseUrl ?? '.') ?>;
    const navAksi = document.getElementById('nav-aksi-sesi');
    const navMobileAuth = document.getElementById('nav-mobile-auth');
    const btnMobile = document.getElementById('btn-nav-mobile');
    const drawerMobile = document.getElementById('nav-mobile-drawer');

    if (btnMobile && drawerMobile) {
      btnMobile.addEventListener('click', () => {
        drawerMobile.classList.toggle('terbuka');
      });
    }

    const user = window.__S4L_USER__ || null;
    const urlLogout = `${baseUrl}/auth/logout.php`;

    if (user && user.nama_lengkap) {
      const targetDash = user.peran === 'admin' ? `${baseUrl}/admin/index.php` : `${baseUrl}/dashboard/index.php`;
      const labelDash = user.peran === 'admin' ? 'Panel admin' : user.nama_lengkap.split(' ')[0];

      if (navAksi) {
        navAksi.innerHTML = `
          <a href="${targetDash}" class="tombol tombol-tipis tombol-kecil" style="border-radius: 999px; display: inline-flex; align-items: center; gap: 6px;" title="${user.nama_lengkap}">
            <i data-lucide="user" style="width: 14px; height: 14px;"></i>
            <span>${labelDash}</span>
          </a>
          <a href="${urlLogout}" class="tombol tombol-sekunder tombol-kecil" style="border-radius: 999px;" title="Keluar akun">
            Keluar
          </a>
        `;
      }
      if (navMobileAuth) {
        navMobileAuth.innerHTML = `
          <a href="${targetDash}" class="tombol tombol-utama tombol-kecil" style="border-radius: 999px;">${labelDash}</a>
          <a href="${urlLogout}" class="tombol tombol-sekunder tombol-kecil" style="border-radius: 999px;">Keluar</a>
        `;
      }
      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    }
  })();
</script>

</body>
</html>