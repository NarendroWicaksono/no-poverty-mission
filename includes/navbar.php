<?php
// Navigasi Atas Bersama Skill4Life (Sadar-Sesi & Responsif Mobile)
$berkasAktif = basename($_SERVER['PHP_SELF']);
?>
<header class="nav-utama">
  <div class="wadah nav-baris">
    <!-- Logo Brand -->
    <a href="<?= $baseUrl ?>/index.php" class="logo-s4l" aria-label="Beranda Skill4Life">
      <span class="cap-kecil">S4L</span>
      <span>Skill4Life</span>
    </a>

    <!-- Tautan Menu Utama Desktop -->
    <nav aria-label="Navigasi situs">
      <ul class="nav-tautan-grup">
        <li>
          <a href="<?= $baseUrl ?>/kursus/katalog.php" class="nav-tautan <?= strpos($_SERVER['PHP_SELF'], 'katalog') !== false || strpos($_SERVER['PHP_SELF'], 'detail') !== false ? 'aktif' : '' ?>">
            Katalog kursus
          </a>
        </li>
        <li>
          <a href="<?= $baseUrl ?>/sertifikat/verifikasi.php" class="nav-tautan <?= strpos($_SERVER['PHP_SELF'], 'verifikasi') !== false ? 'aktif' : '' ?>">
            Verifikasi sertifikat
          </a>
        </li>
        <li>
          <a href="<?= $baseUrl ?>/dashboard/index.php" class="nav-tautan <?= strpos($_SERVER['PHP_SELF'], 'dashboard') !== false ? 'aktif' : '' ?>">
            Dashboard belajar
          </a>
        </li>
      </ul>
    </nav>

    <!-- Aksi Masuk/Daftar atau Profil Sesi Aktif + Toggle Mobile -->
    <div style="display: flex; align-items: center; gap: var(--spasi-12);">
      <div class="nav-aksi" id="nav-aksi-sesi">
        <a href="<?= $baseUrl ?>/auth/login.php" class="tautan-masuk">
          Masuk
        </a>
        <a href="<?= $baseUrl ?>/auth/daftar.php" class="tombol tombol-utama tombol-kecil">
          Daftar
        </a>
      </div>

      <button type="button" class="nav-mobile-toggle" id="btn-nav-mobile" aria-label="Buka menu navigasi">
        <i data-lucide="menu" style="width: 18px; height: 18px;"></i>
      </button>
    </div>
  </div>

  <!-- Drawer Navigasi Mobile -->
  <div class="nav-mobile-drawer" id="nav-mobile-drawer">
    <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--spasi-12); font-size: var(--teks-14);">
      <li><a href="<?= $baseUrl ?>/index.php">Beranda</a></li>
      <li><a href="<?= $baseUrl ?>/kursus/katalog.php">Katalog kursus</a></li>
      <li><a href="<?= $baseUrl ?>/sertifikat/verifikasi.php">Verifikasi sertifikat</a></li>
      <li><a href="<?= $baseUrl ?>/dashboard/index.php">Dashboard belajar</a></li>
      <li id="nav-mobile-auth" style="padding-top: var(--spasi-12); border-top: 1px solid var(--garis); display: flex; gap: var(--spasi-12);">
        <a href="<?= $baseUrl ?>/auth/login.php" class="tombol tombol-sekunder tombol-kecil">Masuk</a>
        <a href="<?= $baseUrl ?>/auth/daftar.php" class="tombol tombol-utama tombol-kecil">Daftar</a>
      </li>
    </ul>
  </div>
</header>
