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
      <button type="button" onclick="isiAkunDemoAdmin()" class="tombol tombol-sekunder tombol-kecil tombol-lebar" style="background: #FFFFFF;">
        <i data-lucide="key-round" style="width: 14px; height: 14px;"></i> Gunakan akun demo pengelola
      </button>
    </div>

    <form id="form-admin-login" onsubmit="tanganiLoginAdmin(event)">
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

<script>
function isiAkunDemoAdmin() {
  document.getElementById('adm-email').value = 'admin@skill4life.id';
  document.getElementById('adm-pass').value = 'admin1234';
  if (typeof tampilkanToast === 'function') {
    tampilkanToast('Kredensial demo pengelola terisi');
  }
}

function tanganiLoginAdmin(e) {
  e.preventDefault();
  // TODO-BACKEND: Sambungkan dengan endpoint POST /api/admin/login
  const email = document.getElementById('adm-email').value;
  localStorage.setItem('s4l_user', JSON.stringify({
    id: 1,
    nama_lengkap: 'Pengelola Skill4Life',
    email: email,
    peran: 'admin'
  }));
  
  if (typeof tampilkanToast === 'function') {
    tampilkanToast('Sesi pengelola berhasil dibuka');
  }
  setTimeout(() => {
    window.location.href = 'index.php';
  }, 400);
}

document.addEventListener('DOMContentLoaded', () => {
  if (window.lucide) lucide.createIcons();
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
