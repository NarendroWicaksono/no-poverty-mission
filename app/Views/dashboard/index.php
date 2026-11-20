<div class="tata-aplikasi">
  <!-- Sidebar Navigasi Peserta (Lebar 260px) -->
  <aside class="sidebar-aplikasi">
    <div style="padding-bottom: var(--spasi-16); border-bottom: 1px solid var(--garis); margin-bottom: var(--spasi-16);">
      <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);" id="sidebar-nama-peserta">
        Memuat...
      </div>
      <div style="font-size: var(--teks-12); color: var(--teks-3);" id="sidebar-pekerjaan-peserta">
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
      <button type="button" id="btn-keluar-dashboard" class="sidebar-item" style="width: 100%; border: none; background: none; cursor: pointer; text-align: left; color: var(--galat);">
        <i data-lucide="log-out" class="ikon-16"></i>
        <span>Keluar akun</span>
      </button>
    </div>
  </aside>

  <!-- Konten Utama Dashboard -->
  <main class="konten-aplikasi">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: var(--spasi-32); flex-wrap: wrap; gap: var(--spasi-16);">
      <div>
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Ruang belajar pribadi</div>
        <h1 style="font-size: var(--teks-28); font-family: var(--font-serif); color: var(--teks); margin-bottom: var(--spasi-8);">
          Kursus saya
        </h1>
        <p style="font-size: var(--teks-14); color: var(--teks-2);">
          Lanjutkan pembelajaran modul mandiri untuk mempersiapkan ujian akhir dan penerbitan sertifikat.
        </p>
      </div>
      <a href="../kursus/katalog.php" class="tombol tombol-utama tombol-kecil">
        <i data-lucide="plus" class="ikon-16"></i> Jelajahi kursus
      </a>
    </div>

    <!-- Ringkasan Angka Singkat -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--spasi-16); margin-bottom: var(--spasi-32);">
      <div class="kartu kartu-padat">
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Kursus diikuti</div>
        <div class="angka-mono" style="font-size: var(--teks-28); font-weight: 500; color: var(--teks);" id="dash-aktif-count">0</div>
      </div>
      <div class="kartu kartu-padat">
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Kursus tuntas</div>
        <div class="angka-mono" style="font-size: var(--teks-28); font-weight: 500; color: var(--aksen);" id="dash-selesai-count">0</div>
      </div>
      <div class="kartu kartu-padat">
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Sertifikat dimiliki</div>
        <div class="angka-mono" style="font-size: var(--teks-28); font-weight: 500; color: var(--teks);" id="dash-sertifikat-count">0</div>
      </div>
    </div>

    <!-- Bagian 1: Daftar Kursus yang Sedang Berjalan & Selesai -->
    <section style="margin-bottom: var(--spasi-48);">
      <h2 style="font-size: var(--teks-20); font-weight: 500; margin-bottom: var(--spasi-16);">
        Daftar kursus aktif
      </h2>

      <div style="display: flex; flex-direction: column; gap: var(--spasi-16);" id="daftar-kursus-peserta">
        <div class="kartu" style="color: var(--teks-3); text-align: center; padding: var(--spasi-32);">Memuat daftar kursus...</div>
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
            <tr>
              <td colspan="5" style="text-align: center; color: var(--teks-3); padding: var(--spasi-24);">Memuat arsip sertifikat...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>

<script type="module">
  import {
    ambilSesiPengguna,
    keluarAkun,
    ambilRingkasanKursusPeserta,
    ambilSertifikatPengguna
  } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const sesi = ambilSesiPengguna();
    if (!sesi || sesi.peran !== 'peserta') {
      window.location.href = '../auth/login.php?pesan=harap_login';
      return;
    }

    document.getElementById('sidebar-nama-peserta').textContent = sesi.nama_lengkap;
    document.getElementById('sidebar-pekerjaan-peserta').textContent = sesi.pekerjaan || 'Peserta terdaftar';

    document.getElementById('btn-keluar-dashboard').addEventListener('click', async () => {
      await keluarAkun();
      window.location.href = '../auth/login.php';
    });

    const [kursusList, sertifikatList] = await Promise.all([
      ambilRingkasanKursusPeserta(),
      ambilSertifikatPengguna()
    ]);

    const jumlahSelesai = kursusList.filter(k => k.progress_persen === 100 && k.lulus_kuis).length;
    document.getElementById('dash-aktif-count').textContent = kursusList.length;
    document.getElementById('dash-selesai-count').textContent = jumlahSelesai;
    document.getElementById('dash-sertifikat-count').textContent = sertifikatList.length;

    const container = document.getElementById('daftar-kursus-peserta');
    if (kursusList.length === 0) {
      container.innerHTML = `
        <div class="kartu" style="text-align: center; padding: var(--spasi-40);">
          <div style="font-size: var(--teks-16); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-8);">
            Anda belum memulai kursus apa pun
          </div>
          <p style="font-size: var(--teks-14); color: var(--teks-2); max-width: 440px; margin: 0 auto var(--spasi-20);">
            Pilih kursus keterampilan kerja gratis di katalog untuk mulai belajar dan meraih sertifikat resmi.
          </p>
          <a href="../kursus/katalog.php" class="tombol tombol-utama tombol-kecil">Buka katalog kursus</a>
        </div>
      `;
    } else {
      container.innerHTML = kursusList.map(k => {
        const isLulus = k.lulus_kuis;
        const modulBerikutnya = Math.min(k.modul_selesai + 1, k.total_modul);
        return `
          <div class="kartu" style="display: flex; justify-content: space-between; align-items: center; gap: var(--spasi-24); flex-wrap: wrap;">
            <div style="flex: 1; min-width: 260px;">
              <div style="display: flex; align-items: center; gap: var(--spasi-8); margin-bottom: var(--spasi-4);">
                <span style="font-size: var(--teks-12); color: var(--teks-3);">${k.kategori} &bull; ${k.level}</span>
                ${isLulus ? `
                  <img src="../assets/img/segel-resmi.svg" alt="Tuntas" class="segel-s4l" style="width: 20px; height: 20px;" title="Tuntas dan tersertifikasi">
                ` : ''}
              </div>
              <h3 style="font-size: var(--teks-16); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-8);">
                <a href="../kursus/detail.php?slug=${k.slug}">${k.judul}</a>
              </h3>

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

            <div style="display: flex; gap: var(--spasi-8); align-items: center; flex-wrap: wrap;">
              <a href="../kursus/belajar.php?slug=${k.slug}&modul=${isLulus ? 1 : modulBerikutnya}" class="tombol tombol-sekunder tombol-kecil">
                ${isLulus ? 'Pelajari ulang' : 'Lanjutkan belajar'}
              </a>
              ${k.progress_persen === 100 && !isLulus ? `
                <a href="../kursus/kuis.php?slug=${k.slug}" class="tombol tombol-utama tombol-kecil">
                  Kerjakan kuis akhir
                </a>
              ` : ''}
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

    const tbody = document.getElementById('tabel-sertifikat-peserta');
    if (sertifikatList.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="5" style="text-align: center; color: var(--teks-3); padding: var(--spasi-24);">
            Belum ada sertifikat diterbitkan. Selesaikan modul dan lulus kuis akhir (&ge; 70) untuk memperoleh sertifikat.
          </td>
        </tr>
      `;
    } else {
      tbody.innerHTML = sertifikatList.map(sert => `
        <tr>
          <td class="angka-mono" style="font-weight: 500; color: var(--aksen);">${sert.nomor_sertifikat}</td>
          <td>${sert.nama_kursus}</td>
          <td class="angka-mono">${sert.tanggal_terbit}</td>
          <td class="angka-mono">${sert.nilai_kuis || 90} / 100</td>
          <td>
            <a href="../sertifikat/lihat.php?nomor=${sert.nomor_sertifikat}" class="tombol tombol-sekunder tombol-kecil" style="height: 28px; padding: 0 10px;">
              Buka berkas
            </a>
          </td>
        </tr>
      `).join('');
    }
  });
</script>
