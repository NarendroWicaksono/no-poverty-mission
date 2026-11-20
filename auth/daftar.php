<?php
$baseUrl = '..';
$judulHalaman = 'Pendaftaran Akun - Skill4Life';
include __DIR__ . '/../includes/header.php';
?>

<div class="wadah" style="padding-top: var(--spasi-64); padding-bottom: var(--spasi-80); max-width: 480px;">
  <div class="kartu">
    <!-- Header Form Tenang -->
    <div style="margin-bottom: var(--spasi-24);">
      <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Akun baru</div>
      <h1 style="font-size: var(--teks-28); font-family: var(--font-serif); color: var(--teks); margin-bottom: var(--spasi-8);">
        Daftar akun gratis
      </h1>
      <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: 1.5;">
        Akses seluruh modul dan sertifikat resmi tanpa pungutan biaya.
      </p>
    </div>

    <!-- Pesan Status -->
    <div id="pesan-daftar-status" style="display: none;"></div>

    <form id="form-daftar-peserta">
      <div class="bidang-grup">
        <label class="bidang-label" for="daftar-nama">Nama lengkap</label>
        <input type="text" id="daftar-nama" class="bidang-input" placeholder="Nama sesuai tanda pengenal" required>
        <div class="bidang-bantuan">Nama ini akan tercetak pada lembar sertifikat resmi Anda.</div>
      </div>

      <div class="bidang-grup">
        <label class="bidang-label" for="daftar-email">Alamat email</label>
        <input type="email" id="daftar-email" class="bidang-input" placeholder="nama@domain.com" required>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spasi-12);">
        <div class="bidang-grup">
          <label class="bidang-label" for="daftar-pekerjaan">Status / pekerjaan</label>
          <input type="text" id="daftar-pekerjaan" class="bidang-input" placeholder="Misal: Mahasiswa" value="Pencari kerja">
        </div>
        <div class="bidang-grup">
          <label class="bidang-label" for="daftar-kota">Domisili (kota)</label>
          <input type="text" id="daftar-kota" class="bidang-input" placeholder="Misal: Purwokerto" value="Indonesia">
        </div>
      </div>

      <div class="bidang-grup">
        <label class="bidang-label" for="daftar-kata-sandi">Kata sandi</label>
        <input type="password" id="daftar-kata-sandi" class="bidang-input" placeholder="Minimal 8 karakter" minlength="8" required>
      </div>

      <div class="bidang-grup">
        <label class="bidang-label" for="daftar-konfirmasi">Konfirmasi kata sandi</label>
        <input type="password" id="daftar-konfirmasi" class="bidang-input" placeholder="Ulangi kata sandi" minlength="8" required>
      </div>

      <button type="submit" class="tombol tombol-utama tombol-lebar" style="margin-top: var(--spasi-8);">
        Buat akun gratis
      </button>
    </form>

    <div style="margin-top: var(--spasi-24); padding-top: var(--spasi-16); border-top: 1px solid var(--garis); font-size: var(--teks-14); color: var(--teks-2); text-align: center;">
      Sudah memiliki akun? <a href="login.php" style="color: var(--aksen); font-weight: 500;">Masuk di sini</a>
    </div>
  </div>
</div>

<script type="module">
  import { daftarAkun } from '../assets/js/api.js';

  document.getElementById('form-daftar-peserta').addEventListener('submit', async (e) => {
    e.preventDefault();
    const nama = document.getElementById('daftar-nama').value.trim();
    const email = document.getElementById('daftar-email').value.trim();
    const pekerjaan = document.getElementById('daftar-pekerjaan').value.trim();
    const kota = document.getElementById('daftar-kota').value.trim();
    const sandi = document.getElementById('daftar-kata-sandi').value;
    const konfirmasi = document.getElementById('daftar-konfirmasi').value;
    const pesanBox = document.getElementById('pesan-daftar-status');

    if (sandi !== konfirmasi) {
      pesanBox.className = 'pesan-status pesan-status-galat';
      pesanBox.textContent = 'Konfirmasi kata sandi tidak cocok.';
      pesanBox.style.display = 'flex';
      return;
    }

    const hasil = await daftarAkun({
      nama_lengkap: nama,
      email,
      kata_sandi: sandi,
      pekerjaan,
      kota
    });

    if (!hasil.ok) {
      pesanBox.className = 'pesan-status pesan-status-galat';
      pesanBox.textContent = hasil.pesan;
      pesanBox.style.display = 'flex';
      return;
    }

    pesanBox.className = 'pesan-status pesan-status-sukses';
    pesanBox.textContent = 'Pendaftaran akun berhasil. Mengalihkan ke dashboard belajar...';
    pesanBox.style.display = 'flex';

    setTimeout(() => {
      window.location.href = '../dashboard/index.php';
    }, 550);
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
