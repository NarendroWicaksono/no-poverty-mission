<?php
// Navigasi Atas Bersama Skill4Life
$berkasAktif = basename($_SERVER['PHP_SELF']);
?>
<header class="nav-utama">
  <div class="wadah nav-baris">
    <!-- Logo Brand -->
    <a href="<?= $baseUrl ?>/index.php" class="logo-s4l" aria-label="Beranda Skill4Life">
      <span class="cap-kecil">S4L</span>
      <span>Skill4Life</span>
    </a>

    <!-- Tautan Menu Utama -->
    <nav aria-label="Navigasi situs">
      <ul class="nav-tautan-grup">
        <li>
          <a href="<?= $baseUrl ?>/kursus/katalog.php" class="nav-tautan <?= strpos($_SERVER['PHP_SELF'], 'katalog') !== false ? 'aktif' : '' ?>">
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

    <!-- Aksi Masuk dan Daftar -->
    <div class="nav-aksi">
      <a href="<?= $baseUrl ?>/auth/login.php" class="tautan-masuk">
        Masuk
      </a>
      <a href="<?= $baseUrl ?>/auth/daftar.php" class="tombol tombol-utama tombol-kecil">
        Daftar
      </a>
    </div>
  </div>
</header>
