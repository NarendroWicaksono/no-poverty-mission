<?php
$baseUrl = '..';
$judulHalaman = 'Masuk Akun - Skill4Life';
include __DIR__ . '/../includes/header.php';
?>

<div class="wadah" style="padding-top: var(--spasi-64); padding-bottom: var(--spasi-80); max-width: 440px;">
  <div class="kartu">
    <!-- Header Form Tenang -->
    <div style="margin-bottom: var(--spasi-24);">
      <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Akses akun</div>
      <h1 style="font-size: var(--teks-28); font-family: var(--font-serif); color: var(--teks); margin-bottom: var(--spasi-8);">
        Masuk
      </h1>
      <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: 1.5;">
        Lanjutkan modul pembelajaran keterampilan kerja Anda.
      </p>
    </div>

    <!-- Kotak Pesan Demo -->
    <div id="pesan-login-status" style="display: none;"></div>

    <form id="form-masuk-peserta">
      <div class="bidang-grup">
        <label class="bidang-label" for="masuk-email">Alamat email</label>
        <input type="email" id="masuk-email" class="bidang-input" placeholder="nama@domain.com" required value="budi@gmail.com">
      </div>

      <div class="bidang-grup">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <label class="bidang-label" for="masuk-kata-sandi">Kata sandi</label>
          <a href="#" onclick="alert('Pada mode demo, masukkan kata sandi apa saja minimal 8 karakter.')" style="font-size: var(--teks-12); color: var(--teks-3);">Lupa kata sandi?</a>
        </div>
        <input type="password" id="masuk-kata-sandi" class="bidang-input" placeholder="Minimal 8 karakter" minlength="8" required value="budi1234">
      </div>

      <button type="submit" class="tombol tombol-utama tombol-lebar" style="margin-top: var(--spasi-8);">
        Masuk ke dashboard
      </button>
    </form>

    <div style="margin-top: var(--spasi-24); padding-top: var(--spasi-16); border-top: 1px solid var(--garis); font-size: var(--teks-14); color: var(--teks-2); text-align: center;">
      Belum memiliki akun? <a href="daftar.php" style="color: var(--aksen); font-weight: 500;">Daftar gratis</a>
    </div>
  </div>
</div>

<script>
  document.getElementById('form-masuk-peserta').addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('masuk-email').value.trim();
    const sandi = document.getElementById('masuk-kata-sandi').value;
    const pesanBox = document.getElementById('pesan-login-status');

    if (!email || sandi.length < 8) {
      pesanBox.className = 'pesan-status pesan-status-galat';
      pesanBox.textContent = 'Harap masukkan alamat email valid dan kata sandi minimal 8 karakter.';
      pesanBox.style.display = 'block';
      return;
    }

    // Simulasi respons demo
    pesanBox.className = 'pesan-status pesan-status-sukses';
    pesanBox.textContent = 'Autentikasi demo berhasil. Mengalihkan ke dashboard...';
    pesanBox.style.display = 'block';

    setTimeout(() => {
      window.location.href = '../dashboard/index.php';
    }, 600);
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
