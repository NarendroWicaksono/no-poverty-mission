<?php
$baseUrl = '..';
$judulHalaman = 'Pengaturan Profil - Skill4Life';
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
        <a href="index.php" class="sidebar-item">
          <i data-lucide="book-open" class="ikon-16"></i>
          <span>Kursus saya</span>
        </a>
      </li>
      <li>
        <a href="profil.php" class="sidebar-item aktif">
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

  <!-- Konten Pengaturan Profil -->
  <main class="konten-aplikasi">
    <div class="wadah-baca">
      <div style="margin-bottom: var(--spasi-32);">
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Akun peserta</div>
        <h1 style="font-size: var(--teks-28); font-family: var(--font-serif); color: var(--teks); margin-bottom: var(--spasi-8);">
          Pengaturan profil
        </h1>
        <p style="font-size: var(--teks-14); color: var(--teks-2);">
          Perbarui nama lengkap untuk pencantuman pada sertifikat dan ubah kata sandi akses akun.
        </p>
      </div>

      <div id="profil-pesan-status" style="display: none;"></div>

      <!-- Formulir 1: Data Identitas -->
      <div class="kartu" style="margin-bottom: var(--spasi-24);">
        <h2 style="font-size: var(--teks-16); font-weight: 500; margin-bottom: var(--spasi-16);">
          Data identitas
        </h2>

        <form id="form-edit-identitas">
          <div class="bidang-grup">
            <label class="bidang-label" for="profil-nama">Nama lengkap</label>
            <input type="text" id="profil-nama" class="bidang-input" value="Budi Santoso" required>
            <div class="bidang-bantuan">Nama ini yang akan tercetak pada lembar sertifikat kelulusan resmi.</div>
          </div>

          <div class="bidang-grup">
            <label class="bidang-label" for="profil-email">Alamat email</label>
            <input type="email" id="profil-email" class="bidang-input" value="budi@gmail.com" disabled style="background-color: var(--permukaan-2); cursor: not-allowed;">
            <div class="bidang-bantuan">Alamat email digunakan sebagai tanda pengenal akun utama.</div>
          </div>

          <div class="bidang-grup">
            <label class="bidang-label" for="profil-telepon">Nomor telepon / WhatsApp</label>
            <input type="text" id="profil-telepon" class="bidang-input" value="085712345678">
          </div>

          <div class="bidang-grup">
            <label class="bidang-label" for="profil-pekerjaan">Status pekerjaan saat ini</label>
            <input type="text" id="profil-pekerjaan" class="bidang-input" value="Pencari kerja">
          </div>

          <button type="submit" class="tombol tombol-utama tombol-kecil">
            Simpan data identitas
          </button>
        </form>
      </div>

      <!-- Formulir 2: Ubah Kata Sandi -->
      <div class="kartu">
        <h2 style="font-size: var(--teks-16); font-weight: 500; margin-bottom: var(--spasi-16);">
          Ubah kata sandi
        </h2>

        <form id="form-ubah-sandi">
          <div class="bidang-grup">
            <label class="bidang-label" for="sandi-lama">Kata sandi saat ini</label>
            <input type="password" id="sandi-lama" class="bidang-input" placeholder="Masukkan kata sandi lama">
          </div>

          <div class="bidang-grup">
            <label class="bidang-label" for="sandi-baru">Kata sandi baru</label>
            <input type="password" id="sandi-baru" class="bidang-input" placeholder="Minimal 8 karakter" minlength="8">
          </div>

          <div class="bidang-grup">
            <label class="bidang-label" for="sandi-konfirmasi">Ulangi kata sandi baru</label>
            <input type="password" id="sandi-konfirmasi" class="bidang-input" placeholder="Ketik ulang kata sandi baru" minlength="8">
          </div>

          <button type="submit" class="tombol tombol-sekunder tombol-kecil">
            Perbarui kata sandi
          </button>
        </form>
      </div>
    </div>
  </main>
</div>

<script>
  const pesanBox = document.getElementById('profil-pesan-status');

  document.getElementById('form-edit-identitas').addEventListener('submit', (e) => {
    e.preventDefault();
    pesanBox.className = 'pesan-status pesan-status-sukses';
    pesanBox.textContent = 'Perubahan data identitas profil berhasil disimpan (mode demo).';
    pesanBox.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  document.getElementById('form-ubah-sandi').addEventListener('submit', (e) => {
    e.preventDefault();
    const baru = document.getElementById('sandi-baru').value;
    const konfirmasi = document.getElementById('sandi-konfirmasi').value;

    if (baru.length < 8) {
      pesanBox.className = 'pesan-status pesan-status-galat';
      pesanBox.textContent = 'Kata sandi baru minimal 8 karakter.';
      pesanBox.style.display = 'block';
      return;
    }

    if (baru !== konfirmasi) {
      pesanBox.className = 'pesan-status pesan-status-galat';
      pesanBox.textContent = 'Konfirmasi kata sandi tidak cocok.';
      pesanBox.style.display = 'block';
      return;
    }

    pesanBox.className = 'pesan-status pesan-status-sukses';
    pesanBox.textContent = 'Kata sandi berhasil diperbarui (mode demo).';
    pesanBox.style.display = 'block';
    document.getElementById('form-ubah-sandi').reset();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
