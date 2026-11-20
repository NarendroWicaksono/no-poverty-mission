</main>

<!-- Kaki Halaman Bersama -->
<footer class="kaki-halaman">
  <div class="wadah">
    <div class="kaki-grid">
      <!-- Kolom 1: Misi Latar Belakang -->
      <div>
        <div style="font-weight: 600; color: var(--teks); margin-bottom: var(--spasi-12); font-size: var(--teks-16);">
          Skill4Life
        </div>
        <p style="line-height: var(--jarak-baris-baca); margin-bottom: var(--spasi-16); max-width: 440px;">
          Prakarsa pembelajaran keterampilan kerja gratis untuk mendukung Tujuan Pembangunan Berkelanjutan (SDG) 1: Tanpa Kemiskinan. Seluruh modul dan sertifikat dapat diakses masyarakat tanpa biaya pendaftaran maupun langganan.
        </p>
        <div style="font-size: var(--teks-12); color: var(--teks-3);">
          Surat elektronik: <a href="mailto:kontak@skill4life.id" style="text-decoration: underline;">kontak@skill4life.id</a>
        </div>
      </div>

      <!-- Kolom 2: Tautan Halaman -->
      <div>
        <div style="font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-12);">
          Navigasi
        </div>
        <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--spasi-8); font-size: var(--teks-14);">
          <li><a href="<?= $baseUrl ?>/index.php">Beranda</a></li>
          <li><a href="<?= $baseUrl ?>/kursus/katalog.php">Katalog kursus</a></li>
          <li><a href="<?= $baseUrl ?>/sertifikat/verifikasi.php">Verifikasi sertifikat</a></li>
          <li><a href="<?= $baseUrl ?>/dashboard/index.php">Dashboard belajar</a></li>
          <li><a href="<?= $baseUrl ?>/admin/login.php">Panel pengelola</a></li>
        </ul>
      </div>

      <!-- Kolom 3: Komitmen Akses -->
      <div>
        <div style="font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-12);">
          Komitmen akses
        </div>
        <p style="font-size: var(--teks-14); line-height: var(--jarak-baris-baca); color: var(--teks-2);">
          Semua kursus terbuka penuh. Tidak ada materi yang dikunci, uji coba berbatas waktu, maupun jalur berbayar.
        </p>
      </div>
    </div>

    <!-- Garis Hak Cipta -->
    <div style="border-top: 1px solid var(--garis); padding-top: var(--spasi-20); display: flex; justify-content: space-between; align-items: center; font-size: var(--teks-12); color: var(--teks-3); flex-wrap: wrap; gap: var(--spasi-12);">
      <div>&copy; 2026 Skill4Life. Dibangun untuk gerakan keterampilan kerja mandiri.</div>
      <div class="angka-mono">SDG 1 · No Poverty</div>
    </div>
  </div>
</footer>

<!-- Inisialisasi Ikon, Toast Global, & Sinkronisasi Navbar Sesi -->
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

  // Sinkronisasi Navbar Berdasarkan Sesi Pengguna Aktif
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

    let user = null;
    try {
      user = JSON.parse(localStorage.getItem('s4l_user') || 'null');
    } catch (e) {}

    window.keluarSesiGlobal = function() {
      localStorage.removeItem('s4l_user');
      window.location.href = `${baseUrl}/index.php`;
    };

    if (user && user.nama_lengkap) {
      const targetDash = user.peran === 'admin' ? `${baseUrl}/admin/index.php` : `${baseUrl}/dashboard/index.php`;
      const labelDash = user.peran === 'admin' ? 'Panel admin' : user.nama_lengkap.split(' ')[0];

      if (navAksi) {
        navAksi.innerHTML = `
          <a href="${targetDash}" class="tombol tombol-tipis tombol-kecil" title="${user.nama_lengkap}">
            <i data-lucide="user" style="width: 14px; height: 14px;"></i>
            <span>${labelDash}</span>
          </a>
          <button type="button" onclick="keluarSesiGlobal()" class="tombol tombol-sekunder tombol-kecil" title="Keluar akun">
            Keluar
          </button>
        `;
      }
      if (navMobileAuth) {
        navMobileAuth.innerHTML = `
          <a href="${targetDash}" class="tombol tombol-utama tombol-kecil">${labelDash}</a>
          <button type="button" onclick="keluarSesiGlobal()" class="tombol tombol-sekunder tombol-kecil">Keluar</button>
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
