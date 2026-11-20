<?php
$baseUrl = '..';
$judulHalaman = 'Masuk Akun - Skill4Life';
include __DIR__ . '/../includes/header.php';
?>

<div class="wadah" style="padding-top: var(--spasi-64); padding-bottom: var(--spasi-80); max-width: 440px;">
  <div class="kartu">
    <!-- Header Form Tenang -->
    <div style="margin-bottom: var(--spasi-20);">
      <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Akses akun peserta</div>
      <h1 style="font-size: var(--teks-28); font-family: var(--font-serif); color: var(--teks); margin-bottom: var(--spasi-8);">
        Masuk
      </h1>
      <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: 1.5;">
        Lanjutkan modul pembelajaran keterampilan kerja Anda dan pantau penerbitan sertifikat.
      </p>
    </div>

    <!-- Tombol Cepat Demo -->
    <div style="margin-bottom: var(--spasi-20); padding: var(--spasi-12); background-color: var(--permukaan-2); border-radius: var(--radius-kontrol); border: 1px solid var(--garis);">
      <button type="button" id="btn-isi-demo-peserta" class="tombol tombol-sekunder tombol-kecil tombol-lebar" style="background: #FFFFFF;">
        <i data-lucide="key-round" style="width: 14px; height: 14px;"></i> Gunakan akun demo (Budi Santoso)
      </button>
    </div>

    <!-- Kotak Pesan Status -->
    <div id="pesan-login-status" style="display: none;"></div>

    <form id="form-masuk-peserta">
      <div class="bidang-grup">
        <label class="bidang-label" for="masuk-email">Alamat email</label>
        <input type="email" id="masuk-email" class="bidang-input" placeholder="nama@domain.com" required value="budi@gmail.com">
      </div>

      <div class="bidang-grup">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <label class="bidang-label" for="masuk-kata-sandi">Kata sandi</label>
          <a href="javascript:void(0)" id="link-lupa-sandi" style="font-size: var(--teks-12); color: var(--teks-3);">Lupa kata sandi?</a>
        </div>
        <input type="password" id="masuk-kata-sandi" class="bidang-input" placeholder="Minimal 8 karakter" minlength="8" required value="budi1234">
      </div>

      <button type="submit" class="tombol tombol-utama tombol-lebar" style="margin-top: var(--spasi-8);">
        Masuk ke dashboard
      </button>
    </form>

    <div style="margin-top: var(--spasi-24); padding-top: var(--spasi-16); border-top: 1px solid var(--garis); font-size: var(--teks-14); color: var(--teks-2); text-align: center; display: flex; flex-direction: column; gap: var(--spasi-8);">
      <div>Belum memiliki akun? <a href="daftar.php" style="color: var(--aksen); font-weight: 500;">Daftar gratis</a></div>
      <div style="font-size: var(--teks-12); color: var(--teks-3);">
        Masuk sebagai pengelola? <a href="../admin/login.php" style="color: var(--teks-2); text-decoration: underline;">Panel pengelola</a>
      </div>
    </div>
  </div>
</div>

<script type="module">
  import { masukAkun, ambilSesiPengguna } from '../assets/js/api.js';

  const pesanBox = document.getElementById('pesan-login-status');
  const urlParams = new URLSearchParams(window.location.search);

  // Jika sudah login sebagai peserta, langsung arahkan ke dashboard
  const sesiAktif = ambilSesiPengguna();
  if (sesiAktif && sesiAktif.peran === 'peserta' && !urlParams.get('ganti')) {
    window.location.href = '../dashboard/index.php';
  }

  if (urlParams.get('pesan') === 'harap_login') {
    pesanBox.className = 'pesan-status pesan-status-info';
    pesanBox.textContent = 'Silakan masuk terlebih dahulu untuk mengakses dashboard belajar Anda.';
    pesanBox.style.display = 'flex';
  }

  document.getElementById('btn-isi-demo-peserta').addEventListener('click', () => {
    document.getElementById('masuk-email').value = 'budi@gmail.com';
    document.getElementById('masuk-kata-sandi').value = 'budi1234';
    if (typeof tampilkanToast === 'function') {
      tampilkanToast('Kredensial demo peserta terisi', 'info');
    }
  });

  document.getElementById('link-lupa-sandi').addEventListener('click', () => {
    if (typeof tampilkanToast === 'function') {
      tampilkanToast('Gunakan akun demo budi@gmail.com dengan sandi budi1234', 'info');
    }
  });

  document.getElementById('form-masuk-peserta').addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('masuk-email').value.trim();
    const sandi = document.getElementById('masuk-kata-sandi').value;

    const hasil = await masukAkun(email, sandi, 'peserta');
    if (!hasil.ok) {
      pesanBox.className = 'pesan-status pesan-status-galat';
      pesanBox.textContent = hasil.pesan;
      pesanBox.style.display = 'flex';
      return;
    }

    pesanBox.className = 'pesan-status pesan-status-sukses';
    pesanBox.textContent = `Selamat datang, ${hasil.user.nama_lengkap}. Mengalihkan ke dashboard...`;
    pesanBox.style.display = 'flex';

    setTimeout(() => {
      window.location.href = '../dashboard/index.php';
    }, 450);
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
