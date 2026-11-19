<?php
$baseUrl = '..';
$judulHalaman = 'Dashboard Peserta - Skill4Life';
include __DIR__ . '/../includes/header.php';
?>

<div class="tata-aplikasi">
  <!-- Sidebar Navigasi Peserta (Lebar 260px) -->
  <aside class="sidebar-aplikasi">
    <div style="padding-bottom: var(--spasi-16); border-bottom: 1px solid var(--garis); margin-bottom: var(--spasi-16);">
      <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);">
        Budi Santoso
      </div>
      <div style="font-size: var(--teks-12); color: var(--teks-3);">
        Peserta terdaftar
      </div>
    </div>

    <div class="sidebar-label">Menu utama</div>
    <ul class="sidebar-menu">
      <li>
        <a href="index.php" class="sidebar-item aktif">
          <i data-lucide="book-open" class="ikon-16"></i>
          <span>Kursus saya</span>
        </a>
      </li>
      <li>
        <a href="profil.php" class="sidebar-item">
          <i data-lucide="user" class="ikon-16"></i>
          <span>Pengaturan profil</span>
        </a>
      </li>
      <li>
        <a href="../kursus/katalog.php" class="sidebar-item">
          <i data-lucide="search" class="ikon-16"></i>
          <span>Katalog kursus</span>
        </a>
      </li>
      <li>
        <a href="../sertifikat/verifikasi.php" class="sidebar-item">
          <i data-lucide="check-circle" class="ikon-16"></i>
          <span>Verifikasi sertifikat</span>
        </a>
      </li>
    </ul>

    <div style="margin-top: auto; padding-top: var(--spasi-20); border-top: 1px solid var(--garis);">
      <a href="../auth/login.php" class="sidebar-item" style="color: var(--teks-3);">
        <i data-lucide="log-out" class="ikon-16"></i>
        <span>Keluar akun</span>
      </a>
    </div>
  </aside>

  <!-- Konten Utama Dashboard -->
  <main class="konten-aplikasi">
    <!-- Judul Konteks Sahaja (Tanpa sapaan artifisial) -->
    <div style="margin-bottom: var(--spasi-32);">
      <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Ruang belajar pribadi</div>
      <h1 style="font-size: var(--teks-28); font-family: var(--font-serif); color: var(--teks); margin-bottom: var(--spasi-8);">
        Kursus saya
      </h1>
      <p style="font-size: var(--teks-14); color: var(--teks-2);">
        Lanjutkan pembelajaran modul mandiri untuk mempersiapkan ujian akhir dan penerbitan sertifikat.
      </p>
    </div>

    <!-- Ringkasan Angka Singkat -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--spasi-16); margin-bottom: var(--spasi-32);">
      <div class="kartu kartu-padat">
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Kursus aktif</div>
        <div class="angka-mono" style="font-size: var(--teks-28); font-weight: 500; color: var(--teks);" id="dash-aktif-count">2</div>
      </div>
      <div class="kartu kartu-padat">
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Kursus selesai</div>
        <div class="angka-mono" style="font-size: var(--teks-28); font-weight: 500; color: var(--aksen);" id="dash-selesai-count">1</div>
      </div>
      <div class="kartu kartu-padat">
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Sertifikat dimiliki</div>
        <div class="angka-mono" style="font-size: var(--teks-28); font-weight: 500; color: var(--teks);" id="dash-sertifikat-count">1</div>
      </div>
    </div>

    <!-- Bagian 1: Daftar Kursus yang Sedang Berjalan & Selesai -->
    <section style="margin-bottom: var(--spasi-48);">
      <h2 style="font-size: var(--teks-20); font-weight: 500; margin-bottom: var(--spasi-16);">
        Daftar kursus aktif
      </h2>

      <div style="display: flex; flex-direction: column; gap: var(--spasi-16);" id="daftar-kursus-peserta">
        <!-- Dimuat dinamis via JS -->
      </div>
    </section>

    <!-- Bagian 2: Arsip Sertifikat Resmi -->
    <section>
      <h2 style="font-size: var(--teks-20); font-weight: 500; margin-bottom: var(--spasi-16);">
        Sertifikat kelulusan
      </h2>

      <div class="wadah-tabel">
        <table class="tabel-data">
          <thead>
            <tr>
              <th>Nomor sertifikat</th>
              <th>Nama kursus</th>
              <th>Tanggal terbit</th>
              <th>Nilai</th>
              <th style="width: 140px;">Dokumen</th>
            </tr>
          </thead>
          <tbody id="tabel-sertifikat-peserta">
            <!-- Dimuat dinamis -->
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>

<script type="module">
  import { ambilProfilPengguna, ambilSertifikat } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const data = await ambilProfilPengguna();
    const peserta = data.peserta_aktif || {};
    const kursusList = peserta.kursus_diikuti || [];

    // Render Kartu Kursus dengan Bilah Progres Tipis (Bukan Donut)
    const container = document.getElementById('daftar-kursus-peserta');
    if (container) {
      container.innerHTML = kursusList.map(k => {
        const isSelesai = k.progress_persen === 100;
        return `
          <div class="kartu" style="display: flex; justify-content: space-between; align-items: center; gap: var(--spasi-24); flex-wrap: wrap;">
            <div style="flex: 1; min-width: 260px;">
              <div style="display: flex; align-items: center; gap: var(--spasi-8); margin-bottom: var(--spasi-4);">
                <span style="font-size: var(--teks-12); color: var(--teks-3);">${k.kategori} &bull; ${k.level}</span>
                ${isSelesai ? `
                  <!-- Segel Bulat Kecil SVG untuk Kursus Selesai -->
                  <img src="../assets/img/segel-resmi.svg" alt="Tuntas" class="segel-s4l" style="width: 20px; height: 20px;" title="Tuntas dan tersertifikasi">
                ` : ''}
              </div>
              <h3 style="font-size: var(--teks-16); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-8);">
                <a href="../kursus/detail.php?slug=${k.slug}">${k.judul}</a>
              </h3>
              
              <!-- Bilah Progres Tipis -->
              <div style="max-width: 400px;">
                <div style="display: flex; justify-content: space-between; font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">
                  <span>${k.modul_selesai} dari ${k.total_modul} modul</span>
                  <span class="angka-mono">${k.progress_persen}%</span>
                </div>
                <div class="bilah-progres">
                  <div class="bilah-progres-isi" style="width: ${k.progress_persen}%;"></div>
                </div>
              </div>
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; gap: var(--spasi-8); align-items: center;">
              <a href="../kursus/belajar.php?slug=${k.slug}&modul=1" class="tombol tombol-sekunder tombol-kecil">
                ${isSelesai ? 'Pelajari ulang' : 'Lanjutkan belajar'}
              </a>
              ${k.nomor_sertifikat ? `
                <a href="../sertifikat/lihat.php?nomor=${k.nomor_sertifikat}" class="tombol tombol-utama tombol-kecil">
                  Lihat sertifikat
                </a>
              ` : ''}
            </div>
          </div>
        `;
      }).join('');
    }

    // Render Tabel Sertifikat
    const tbody = document.getElementById('tabel-sertifikat-peserta');
    const sertifikatSatu = await ambilSertifikat('S4L-2026-000123');
    if (tbody && sertifikatSatu) {
      tbody.innerHTML = `
        <tr>
          <td class="angka-mono" style="font-weight: 500; color: var(--teks);">${sertifikatSatu.nomor_sertifikat}</td>
          <td>${sertifikatSatu.nama_kursus}</td>
          <td class="angka-mono">${sertifikatSatu.tanggal_terbit}</td>
          <td class="angka-mono">${sertifikatSatu.nilai_kuis} / 100</td>
          <td>
            <a href="../sertifikat/lihat.php?nomor=${sertifikatSatu.nomor_sertifikat}" class="tombol tombol-sekunder tombol-kecil" style="height: 28px; padding: 0 8px;">
              Buka berkas
            </a>
          </td>
        </tr>
      `;
    }
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
