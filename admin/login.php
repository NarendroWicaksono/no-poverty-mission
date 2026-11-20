<?php
$baseUrl = '..';
$judulHalaman = 'Masuk Pengelola - Skill4Life';
$tanpaNavbar = true;
include __DIR__ . '/../includes/header.php';
?>

<div class="wadah" style="max-width: 440px; padding-top: var(--spasi-64); padding-bottom: var(--spasi-64);">
  <div class="kartu">
    <div style="margin-bottom: var(--spasi-24); text-align: left;">
      <h1 style="font-family: var(--font-judul); font-size: 24px; font-weight: 600; color: var(--teks); margin-bottom: var(--spasi-8);">
        Masuk pengelola
      </h1>
      <p style="font-size: var(--teks-14); color: var(--teks-2); margin: 0; line-height: 1.5;">
        Panel administrasi kurikulum, modul, soal kuis, dan data peserta Skill4Life.
      </p>
    </div>

    <!-- Tombol isi cepat akun demo -->
    <div style="margin-bottom: var(--spasi-20); padding: var(--spasi-12); background-color: var(--permukaan-2); border-radius: var(--radius-kontrol); border: 1px solid var(--garis);">
      <button type="button" id="btn-demo-admin" class="tombol tombol-sekunder tombol-kecil tombol-lebar" style="background: #FFFFFF;">
        <i data-lucide="key-round" style="width: 14px; height: 14px;"></i> Gunakan akun demo pengelola
      </button>
    </div>

    <div id="pesan-admin-login" style="display: none;"></div>

    <form id="form-admin-login">
      <div class="grup-input">
        <label class="label-bidang" for="adm-email">Alamat email pengelola</label>
        <input type="email" id="adm-email" class="bidang-input" value="admin@skill4life.id" required>
      </div>

      <div class="grup-input">
        <label class="label-bidang" for="adm-pass">Kata sandi</label>
        <input type="password" id="adm-pass" class="bidang-input" value="admin1234" required>
      </div>

      <div style="margin-top: var(--spasi-24);">
        <button type="submit" class="tombol tombol-utama tombol-lebar">
          Masuk ke panel pengelola
        </button>
      </div>
    </form>

    <div style="margin-top: var(--spasi-20); text-align: center;">
      <a href="../index.php" style="font-size: var(--teks-12); color: var(--teks-3); display: inline-flex; align-items: center; gap: var(--spasi-4);">
        <i data-lucide="arrow-left" style="width: 14px; height: 14px;"></i> Kembali ke beranda publik
      </a>
    </div>
  </div>
</div>

<script type="module">
  import { masukAkun } from '../assets/js/api.js';

  const pesanBox = document.getElementById('pesan-admin-login');

  document.getElementById('btn-demo-admin').addEventListener('click', () => {
    document.getElementById('adm-email').value = 'admin@skill4life.id';
    document.getElementById('adm-pass').value = 'admin1234';
    if (typeof tampilkanToast === 'function') {
      tampilkanToast('Kredensial demo pengelola terisi', 'info');
    }
  });

  document.getElementById('form-admin-login').addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('adm-email').value;
    const pass = document.getElementById('adm-pass').value;

    const hasil = await masukAkun(email, pass, 'admin');
    if (!hasil.ok) {
      pesanBox.className = 'pesan-status pesan-status-galat';
      pesanBox.textContent = hasil.pesan;
      pesanBox.style.display = 'flex';
      return;
    }

    if (typeof tampilkanToast === 'function') {
      tampilkanToast('Sesi pengelola berhasil dibuka', 'sukses');
    }
    setTimeout(() => {
      window.location.href = 'index.php';
    }, 350);
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
