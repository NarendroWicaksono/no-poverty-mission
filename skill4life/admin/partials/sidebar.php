<?php
// Sidebar panel pengelola Skill4Life
$currentAdminPage = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar-aplikasi">
  <div style="padding-bottom: var(--spasi-16); margin-bottom: var(--spasi-16); border-bottom: 1px solid var(--garis);">
    <div style="font-size: var(--teks-12); font-weight: 500; color: var(--teks-3); letter-spacing: 0.5px;">Panel pengelola</div>
    <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks); margin-top: var(--spasi-2);">Skill4Life</div>
  </div>

  <div class="sidebar-label">Navigasi</div>
  <ul class="sidebar-menu">
    <li>
      <a href="index.php" class="sidebar-item <?= $currentAdminPage === 'index.php' ? 'aktif' : '' ?>">
        <i data-lucide="layout-dashboard" style="width: 16px; height: 16px;"></i> Ringkasan statistik
      </a>
    </li>
    <li>
      <a href="kursus.php" class="sidebar-item <?= $currentAdminPage === 'kursus.php' ? 'aktif' : '' ?>">
        <i data-lucide="book-open" style="width: 16px; height: 16px;"></i> Kelola kursus
      </a>
    </li>
    <li>
      <a href="modul.php" class="sidebar-item <?= $currentAdminPage === 'modul.php' ? 'aktif' : '' ?>">
        <i data-lucide="layers" style="width: 16px; height: 16px;"></i> Kelola modul
      </a>
    </li>
    <li>
      <a href="kuis.php" class="sidebar-item <?= $currentAdminPage === 'kuis.php' ? 'aktif' : '' ?>">
        <i data-lucide="help-circle" style="width: 16px; height: 16px;"></i> Kelola soal kuis
      </a>
    </li>
    <li>
      <a href="peserta.php" class="sidebar-item <?= $currentAdminPage === 'peserta.php' ? 'aktif' : '' ?>">
        <i data-lucide="users" style="width: 16px; height: 16px;"></i> Data peserta &amp; sertifikat
      </a>
    </li>
  </ul>

  <div style="margin-top: auto; padding-top: var(--spasi-24); border-top: 1px solid var(--garis); display: flex; flex-direction: column; gap: var(--spasi-8);">
    <a href="../index.php" class="sidebar-item">
      <i data-lucide="arrow-up-right" style="width: 16px; height: 16px;"></i> Buka situs publik
    </a>
    <a href="login.php" class="sidebar-item" style="color: var(--galat);">
      <i data-lucide="log-out" style="width: 16px; height: 16px;"></i> Keluar sesi
    </a>
  </div>
</aside>
