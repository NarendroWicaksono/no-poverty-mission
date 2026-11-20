<?php
// Bilah Atas Khusus Panel Pengelola Skill4Life
?>
<header style="background-color: var(--permukaan); border-bottom: 1px solid var(--garis); padding: 0 var(--spasi-32); display: flex; align-items: center; justify-content: space-between; height: 56px; position: sticky; top: 0; z-index: 90;">
  <div style="display: flex; align-items: center; gap: var(--spasi-12);">
    <a href="index.php" style="display: flex; align-items: center; gap: var(--spasi-8); font-weight: 600; color: var(--teks); font-size: var(--teks-14);">
      <span class="cap-kecil" style="width: 22px; height: 22px; font-size: 10px;">S4L</span>
      <span>Skill4Life</span>
      <span style="color: var(--teks-3); font-weight: 400;">/</span>
      <span style="font-weight: 500; color: var(--teks-2);">Panel pengelola</span>
    </a>
  </div>

  <div style="display: flex; align-items: center; gap: var(--spasi-12); font-size: var(--teks-12);">
    <button type="button" id="btn-reset-demo-admin" class="tombol tombol-sekunder tombol-kecil" style="height: 30px; font-size: var(--teks-12); gap: 4px;" title="Kembalikan data ke pengaturan awal">
      <i data-lucide="rotate-ccw" style="width: 13px; height: 13px;"></i> Reset data
    </button>
    <a href="../index.php" target="_blank" class="tombol tombol-sekunder tombol-kecil" style="height: 30px; font-size: var(--teks-12); gap: 4px;">
      <i data-lucide="arrow-up-right" style="width: 13px; height: 13px;"></i> Buka situs publik
    </a>
    <div style="display: flex; align-items: center; gap: var(--spasi-8); color: var(--teks-2); padding-left: var(--spasi-12); border-left: 1px solid var(--garis);">
      <span style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--aksen);"></span>
      <span style="font-family: var(--font-angka);">admin@skill4life.id</span>
      <button type="button" id="btn-logout-topbar" class="tombol tombol-sekunder tombol-kecil" style="height: 30px; padding: 0 8px; color: var(--galat);" title="Keluar dari sesi pengelola">
        <i data-lucide="log-out" style="width: 13px; height: 13px;"></i>
      </button>
    </div>
  </div>
</header>

<script type="module">
  import { ambilSesiPengguna, keluarAkun, resetDataDemo } from '../assets/js/api.js';

  const sesi = ambilSesiPengguna();
  if (!sesi || sesi.peran !== 'admin') {
    window.location.href = 'login.php';
  }

  document.getElementById('btn-logout-topbar')?.addEventListener('click', () => {
    keluarAkun();
    window.location.href = 'login.php';
  });

  document.getElementById('btn-reset-demo-admin')?.addEventListener('click', () => {
    if (confirm('Kembalikan seluruh data kursus, modul, kuis, peserta, dan sertifikat ke data demo awal?')) {
      resetDataDemo();
      localStorage.setItem('s4l_user', JSON.stringify({
        id: 1,
        nama_lengkap: 'Administrator Skill4Life',
        email: 'admin@skill4life.id',
        peran: 'admin'
      }));
      window.location.reload();
    }
  });
</script>
