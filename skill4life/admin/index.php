<?php
$baseUrl = '..';
$judulHalaman = 'Ringkasan Statistik - Panel Pengelola Skill4Life';
$tanpaNavbar = true;
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/partials/topbar.php';
?>

<div class="tata-aplikasi">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>

  <main class="konten-aplikasi">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--spasi-24); flex-wrap: wrap; gap: var(--spasi-16);">
      <div>
        <h1 style="font-family: var(--font-judul); font-size: 26px; font-weight: 600; color: var(--teks); margin-bottom: var(--spasi-4);">
          Ringkasan statistik
        </h1>
        <p style="font-size: var(--teks-14); color: var(--teks-2); margin: 0;">
          Pantauan pertumbuhan peserta, penyelesaian modul, dan dampak program SDG 1.
        </p>
      </div>

      <div style="display: flex; gap: var(--spasi-8);">
        <a href="kursus.php" class="tombol tombol-utama tombol-kecil">
          <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Tambah kursus
        </a>
      </div>
    </div>

    <!-- 4 Kartu Metrik Tenang (Seragam, tanpa ikon warna-warni) -->
    <div class="grid-metrik">
      <div class="kartu-metrik">
        <div class="kartu-metrik-label">Total peserta terdaftar</div>
        <div class="kartu-metrik-angka" id="adm-stat-peserta">14.280</div>
        <div class="kartu-metrik-perbandingan">+12% dari bulan lalu</div>
      </div>

      <div class="kartu-metrik">
        <div class="kartu-metrik-label">Kursus aktif</div>
        <div class="kartu-metrik-angka" id="adm-stat-kursus">8</div>
        <div class="kartu-metrik-perbandingan">2 kategori kerja</div>
      </div>

      <div class="kartu-metrik">
        <div class="kartu-metrik-label">Sertifikat diterbitkan</div>
        <div class="kartu-metrik-angka" id="adm-stat-sertifikat">8.945</div>
        <div class="kartu-metrik-perbandingan">Tingkat kelulusan 78%</div>
      </div>

      <div class="kartu-metrik">
        <div class="kartu-metrik-label">Biaya peserta</div>
        <div class="kartu-metrik-angka">Rp 0</div>
        <div class="kartu-metrik-perbandingan">100% subsidi SDG 1</div>
      </div>
    </div>

    <!-- Tata Letak Grafik Utama dan Daftar Kursus Terpopuler -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: var(--spasi-20); margin-bottom: var(--spasi-32);">
      <!-- Grafik Utama (Chart.js tenang, garis tunggal aksen) -->
      <div class="kartu">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spasi-16);">
          <div>
            <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);">Tren pendaftaran &amp; kelulusan</div>
            <div style="font-size: var(--teks-12); color: var(--teks-3);">Enam bulan terakhir tahun 2026</div>
          </div>
          <div style="display: flex; gap: var(--spasi-16); font-size: var(--teks-12); color: var(--teks-2);">
            <span style="display: flex; align-items: center; gap: 6px;">
              <span style="display: inline-block; width: 10px; height: 2px; background-color: var(--aksen);"></span> Peserta baru
            </span>
            <span style="display: flex; align-items: center; gap: 6px;">
              <span style="display: inline-block; width: 10px; height: 2px; background-color: var(--teks-3); border-top: 1px dashed var(--teks-3);"></span> Kelulusan
            </span>
          </div>
        </div>
        <div style="height: 260px; width: 100%;">
          <canvas id="adminTrendChart"></canvas>
        </div>
      </div>

      <!-- Kursus Terpopuler dengan Batang Proporsional Tipis -->
      <div class="kartu">
        <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-4);">Kursus terbanyak diikuti</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-16);">Berdasarkan data peserta aktif</div>

        <div style="display: flex; flex-direction: column; gap: var(--spasi-12);" id="adm-popular-list">
          <div>
            <div style="display: flex; justify-content: space-between; font-size: var(--teks-12); margin-bottom: var(--spasi-4);">
              <span style="color: var(--teks);">Excel dasar</span>
              <span style="font-family: var(--font-angka); color: var(--teks-2);">3.420</span>
            </div>
            <div class="bilah-progres"><div class="bilah-progres-isi" style="width: 85%;"></div></div>
          </div>
          <div>
            <div style="display: flex; justify-content: space-between; font-size: var(--teks-12); margin-bottom: var(--spasi-4);">
              <span style="color: var(--teks);">CV &amp; surat lamaran ATS</span>
              <span style="font-family: var(--font-angka); color: var(--teks-2);">2.890</span>
            </div>
            <div class="bilah-progres"><div class="bilah-progres-isi" style="width: 72%;"></div></div>
          </div>
          <div>
            <div style="display: flex; justify-content: space-between; font-size: var(--teks-12); margin-bottom: var(--spasi-4);">
              <span style="color: var(--teks);">Excel lanjutan</span>
              <span style="font-family: var(--font-angka); color: var(--teks-2);">2.150</span>
            </div>
            <div class="bilah-progres"><div class="bilah-progres-isi" style="width: 54%;"></div></div>
          </div>
          <div>
            <div style="display: flex; justify-content: space-between; font-size: var(--teks-12); margin-bottom: var(--spasi-4);">
              <span style="color: var(--teks);">Wawancara kerja</span>
              <span style="font-family: var(--font-angka); color: var(--teks-2);">1.980</span>
            </div>
            <div class="bilah-progres"><div class="bilah-progres-isi" style="width: 48%;"></div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabel Peserta Terbaru yang Mendaftar -->
    <div class="kartu">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spasi-16);">
        <div>
          <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);">Pendaftaran peserta terbaru</div>
          <div style="font-size: var(--teks-12); color: var(--teks-3);">Lima pendaftar terakhir dari data penerima manfaat</div>
        </div>
        <a href="peserta.php" class="tombol tombol-sekunder tombol-kecil">
          Lihat semua peserta <i data-lucide="chevron-right" style="width: 14px; height: 14px;"></i>
        </a>
      </div>

      <div class="wadah-tabel">
        <table class="tabel-data">
          <thead>
            <tr>
              <th>Nama lengkap</th>
              <th>Alamat email</th>
              <th>Pekerjaan &amp; domisili</th>
              <th>Status</th>
              <th>Tanggal daftar</th>
            </tr>
          </thead>
          <tbody id="adm-recent-table">
            <!-- Dimuat dinamis via JS -->
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
  if (window.lucide) lucide.createIcons();

  // Inisialisasi Grafik Chart.js (gaya tenang, single accent #1F6F4A)
  const ctx = document.getElementById('adminTrendChart');
  if (ctx && window.Chart) {
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Jun 2026', 'Jul 2026', 'Agu 2026', 'Sep 2026', 'Okt 2026', 'Nov 2026'],
        datasets: [
          {
            label: 'Peserta baru',
            data: [1420, 1850, 2100, 2450, 2900, 3560],
            borderColor: '#1F6F4A',
            backgroundColor: 'rgba(31, 111, 74, 0.04)',
            borderWidth: 2,
            tension: 0.1,
            fill: true,
            pointRadius: 3,
            pointBackgroundColor: '#1F6F4A'
          },
          {
            label: 'Kelulusan kuis',
            data: [980, 1320, 1580, 1820, 2240, 2810],
            borderColor: '#8A847A',
            borderWidth: 1.5,
            borderDash: [4, 4],
            tension: 0.1,
            fill: false,
            pointRadius: 2,
            pointBackgroundColor: '#8A847A'
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: '#1C1A17',
            titleFont: { family: 'Public Sans', size: 12 },
            bodyFont: { family: 'JetBrains Mono', size: 12 },
            padding: 8,
            cornerRadius: 4
          }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: {
              color: '#8A847A',
              font: { family: 'Public Sans', size: 11 }
            }
          },
          y: {
            grid: { color: 'rgba(28, 26, 23, 0.06)' },
            ticks: {
              color: '#8A847A',
              font: { family: 'JetBrains Mono', size: 11 }
            }
          }
        }
      }
    });
  }

  // Muat data pendaftaran terbaru dari data pengguna
  try {
    const res = await fetch('<?= $baseUrl ?>/assets/data/pengguna.json');
    if (res.ok) {
      const data = await res.json();
      const recents = (data.daftar_peserta || []).slice(0, 5);
      const tbody = document.getElementById('adm-recent-table');
      if (tbody) {
        tbody.innerHTML = recents.map(p => `
          <tr>
            <td style="font-weight: 500;">${p.nama}</td>
            <td style="color: var(--teks-2); font-family: var(--font-angka);">${p.email}</td>
            <td style="color: var(--teks-2);">${p.pekerjaan} · ${p.kota}</td>
            <td><span class="lencana-status lencana-sukses">${p.status}</span></td>
            <td style="color: var(--teks-3); font-family: var(--font-angka);">${p.tgl_daftar}</td>
          </tr>
        `).join('');
      }
    }
  } catch (err) {
    console.error('Gagal memuat peserta terbaru:', err);
  }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
