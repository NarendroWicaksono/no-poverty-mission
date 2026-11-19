<?php
$baseUrl = '..';
$judulHalaman = 'Data Peserta & Sertifikat - Panel Pengelola Skill4Life';
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
          Data peserta &amp; sertifikat
        </h1>
        <p style="font-size: var(--teks-14); color: var(--teks-2); margin: 0;">
          Daftar penerima manfaat program keterampilan dan riwayat penerbitan sertifikat kelulusan.
        </p>
      </div>

      <div style="display: flex; gap: var(--spasi-8);">
        <button type="button" onclick="eksporDataDemo()" class="tombol tombol-sekunder tombol-kecil">
          <i data-lucide="download" style="width: 14px; height: 14px;"></i> Ekspor lembar kerja
        </button>
      </div>
    </div>

    <!-- Bagian 1: Tabel Peserta Terdaftar -->
    <div class="kartu" style="padding: 0; margin-bottom: var(--spasi-32);">
      <div style="padding: var(--spasi-16) var(--spasi-20); border-bottom: 1px solid var(--garis); display: flex; justify-content: space-between; align-items: center; gap: var(--spasi-16); flex-wrap: wrap;">
        <div>
          <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);">
            Peserta belajar terdaftar (<span id="total-peserta-badge" style="font-family: var(--font-angka);">0</span>)
          </div>
          <div style="font-size: var(--teks-12); color: var(--teks-3);">Masyarakat umum, pelajar, dan pencari kerja</div>
        </div>
        <div style="max-width: 280px; width: 100%;">
          <input type="search" id="cari-peserta" class="bidang-input" placeholder="Cari nama atau email..." oninput="saringPeserta(this.value)" style="height: 36px; font-size: var(--teks-12);">
        </div>
      </div>

      <div class="wadah-tabel" style="border: none; border-radius: 0;">
        <table class="tabel-data">
          <thead>
            <tr>
              <th>Nama lengkap</th>
              <th>Alamat email</th>
              <th>Pekerjaan &amp; domisili</th>
              <th>Tanggal gabung</th>
              <th>Status akun</th>
            </tr>
          </thead>
          <tbody id="tabel-peserta-body">
            <tr>
              <td colspan="5" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Memuat data peserta...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Bagian 2: Tabel Sertifikat Resmi Terbit -->
    <div class="kartu" style="padding: 0;">
      <div style="padding: var(--spasi-16) var(--spasi-20); border-bottom: 1px solid var(--garis); display: flex; justify-content: space-between; align-items: center; gap: var(--spasi-16); flex-wrap: wrap;">
        <div>
          <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);">
            Sertifikat kelulusan sah (<span id="total-sertifikat-badge" style="font-family: var(--font-angka);">0</span>)
          </div>
          <div style="font-size: var(--teks-12); color: var(--teks-3);">Terdaftar resmi dengan nomor kode unik verifikasi</div>
        </div>
      </div>

      <div class="wadah-tabel" style="border: none; border-radius: 0;">
        <table class="tabel-data">
          <thead>
            <tr>
              <th>Nomor sertifikat</th>
              <th>Penerima</th>
              <th>Kursus kelulusan</th>
              <th>Nilai kuis</th>
              <th>Tanggal terbit</th>
              <th style="width: 110px; text-align: right;">Dokumen</th>
            </tr>
          </thead>
          <tbody id="tabel-sertifikat-body">
            <tr>
              <td colspan="6" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Memuat data sertifikat...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<script>
let daftarPesertaGlobal = [];
let daftarSertifikatGlobal = [];

async function muatDataPesertaDanSertifikat() {
  try {
    // Muat peserta
    const resPeserta = await fetch('<?= $baseUrl ?>/assets/data/pengguna.json');
    if (resPeserta.ok) {
      const data = await resPeserta.json();
      daftarPesertaGlobal = data.daftar_peserta || [];
      tampilkanPeserta(daftarPesertaGlobal);
    }

    // Muat sertifikat
    const resSertifikat = await fetch('<?= $baseUrl ?>/assets/data/sertifikat.json');
    if (resSertifikat.ok) {
      daftarSertifikatGlobal = await resSertifikat.json();
      tampilkanSertifikat(daftarSertifikatGlobal);
    }
  } catch (err) {
    console.error('Gagal memuat data peserta/sertifikat:', err);
  }
}

function tampilkanPeserta(data) {
  const tbody = document.getElementById('tabel-peserta-body');
  const badge = document.getElementById('total-peserta-badge');
  if (badge) badge.textContent = data.length;

  if (!tbody) return;
  if (!data.length) {
    tbody.innerHTML = `<tr><td colspan="5" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Tidak ada peserta yang cocok.</td></tr>`;
    return;
  }

  tbody.innerHTML = data.map(p => `
    <tr>
      <td style="font-weight: 500; color: var(--teks);">${p.nama}</td>
      <td style="font-family: var(--font-angka); color: var(--teks-2);">${p.email}</td>
      <td style="color: var(--teks-2);">${p.pekerjaan} · ${p.kota}</td>
      <td style="font-family: var(--font-angka); color: var(--teks-3); font-size: var(--teks-12);">${p.tgl_daftar}</td>
      <td>
        <span class="lencana-status lencana-sukses">${p.status}</span>
      </td>
    </tr>
  `).join('');
}

function saringPeserta(q) {
  const keyword = q.toLowerCase().trim();
  const terfilter = daftarPesertaGlobal.filter(p =>
    p.nama.toLowerCase().includes(keyword) ||
    p.email.toLowerCase().includes(keyword) ||
    p.kota.toLowerCase().includes(keyword) ||
    p.pekerjaan.toLowerCase().includes(keyword)
  );
  tampilkanPeserta(terfilter);
}

function tampilkanSertifikat(data) {
  const tbody = document.getElementById('tabel-sertifikat-body');
  const badge = document.getElementById('total-sertifikat-badge');
  if (badge) badge.textContent = data.length;

  if (!tbody) return;
  if (!data.length) {
    tbody.innerHTML = `<tr><td colspan="6" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Belum ada sertifikat terbit.</td></tr>`;
    return;
  }

  tbody.innerHTML = data.map(c => `
    <tr>
      <td>
        <code style="font-family: var(--font-angka); font-size: var(--teks-12); color: var(--aksen); font-weight: 500;">
          ${c.nomor_sertifikat}
        </code>
      </td>
      <td style="font-weight: 500; color: var(--teks);">${c.nama_peserta}</td>
      <td style="color: var(--teks-2);">${c.nama_kursus}</td>
      <td>
        <span class="lencana-status lencana-netral" style="font-family: var(--font-angka);">${c.nilai_kuis} / 100</span>
      </td>
      <td style="font-family: var(--font-angka); font-size: var(--teks-12); color: var(--teks-3);">${c.tanggal_terbit}</td>
      <td style="text-align: right;">
        <a href="../sertifikat/lihat.php?nomor=${c.nomor_sertifikat}" target="_blank" class="tombol tombol-sekunder tombol-kecil" style="height: 28px; padding: 0 10px; font-size: var(--teks-12);">
          Buka <i data-lucide="arrow-up-right" style="width: 12px; height: 12px;"></i>
        </a>
      </td>
    </tr>
  `).join('');

  if (window.lucide) lucide.createIcons();
}

function eksporDataDemo() {
  if (typeof tampilkanToast === 'function') {
    tampilkanToast('Ekspor data penerima manfaat dimulai');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  muatDataPesertaDanSertifikat();
  if (window.lucide) lucide.createIcons();
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
