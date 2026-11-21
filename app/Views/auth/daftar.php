<style>
  .daftar-halaman {
    background-color: var(--latar);
    padding: var(--spasi-48) 0 var(--spasi-80);
    min-height: calc(100vh - 140px);
    display: flex;
    align-items: center;
  }

  .daftar-grid {
    display: grid;
    grid-template-columns: 1fr 1.05fr;
    gap: var(--spasi-64);
    align-items: center;
  }

  .daftar-judul-utama {
    font-family: var(--font-judul);
    font-size: clamp(30px, 3.8vw, 44px);
    font-weight: 700;
    line-height: 1.3;
    letter-spacing: -0.025em;
    color: var(--teks);
    margin-bottom: var(--spasi-16);
  }

  .daftar-sorotan {
    display: inline-block;
    border: 2px solid var(--aksen);
    color: var(--aksen);
    padding: 2px 16px 5px;
    border-radius: 999px;
    line-height: 1.15;
    margin-top: 4px;
  }

  .daftar-subjudul {
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    font-weight: 400;
    line-height: var(--jarak-baris-baca);
    color: var(--teks-2);
    margin-bottom: var(--spasi-28);
    max-width: 440px;
  }

  .daftar-poin-list {
    display: flex;
    flex-direction: column;
    gap: var(--spasi-12);
    margin-top: var(--spasi-28);
  }

  .daftar-poin-item {
    display: flex;
    align-items: center;
    gap: var(--spasi-12);
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    font-weight: 500;
    color: var(--teks);
  }

  .daftar-poin-ikon {
    width: 24px;
    height: 24px;
    border-radius: 999px;
    background-color: var(--aksen-tipis);
    color: var(--aksen);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  /* Kartu Formulir */
  .daftar-kartu {
    background-color: var(--permukaan);
    border: 1px solid var(--garis-tegas);
    border-radius: var(--radius-panel);
    padding: var(--spasi-40);
  }

  .daftar-kartu-header {
    margin-bottom: var(--spasi-24);
    padding-bottom: var(--spasi-16);
    border-bottom: 1px solid var(--garis);
  }

  .daftar-kartu-judul {
    font-family: var(--font-judul);
    font-size: var(--teks-28);
    font-weight: 700;
    letter-spacing: -0.02em;
    color: var(--teks);
    margin: 0 0 6px;
  }

  .daftar-kartu-ket {
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    color: var(--teks-2);
    margin: 0;
    line-height: 1.5;
  }

  .daftar-baris-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spasi-12);
  }

  /* Perbaikan lebar penuh input kata sandi */
  .sandi-bungkus {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
  }

  .sandi-bungkus .bidang-input {
    width: 100%;
    flex: 1;
    padding-right: 42px;
  }

  .tombol-intip-sandi {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    color: var(--teks-3);
    cursor: pointer;
    padding: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: var(--transisi-cepat);
  }

  .tombol-intip-sandi:hover {
    color: var(--teks);
  }

  .daftar-submit {
    width: 100%;
    margin-top: var(--spasi-12);
    padding: 13px 24px;
    border-radius: 999px;
    font-family: var(--font-judul);
    font-size: var(--teks-14);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    cursor: pointer;
  }

  .daftar-footer-link {
    margin-top: var(--spasi-24);
    padding-top: var(--spasi-16);
    border-top: 1px solid var(--garis);
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    color: var(--teks-2);
    text-align: center;
  }

  .daftar-footer-link a {
    color: var(--aksen);
    font-weight: 600;
    text-decoration: none;
  }

  .daftar-footer-link a:hover {
    text-decoration: underline;
  }

  @media (max-width: 900px) {
    .daftar-halaman {
      padding: var(--spasi-32) 0 var(--spasi-64);
    }

    .daftar-grid {
      grid-template-columns: 1fr;
      gap: var(--spasi-32);
    }

    .daftar-ilustrasi-svg {
      max-width: 340px !important;
    }
  }

  @media (max-width: 600px) {
    .daftar-kartu {
      padding: var(--spasi-24);
    }

    .daftar-baris-2 {
      grid-template-columns: 1fr;
      gap: 0;
    }

    .daftar-ilustrasi-svg,
    .daftar-poin-list {
      display: none;
    }

    .daftar-subjudul {
      margin-bottom: 0;
    }
  }
</style>

<section class="daftar-halaman">
  <div class="wadah">
    <div class="daftar-grid">
      <!-- Kolom Kiri: Konteks & Ilustrasi SVG Minimalis -->
      <div>
        <div style="display: inline-flex; align-items: center; gap: 8px; background-color: var(--aksen-tipis); color: var(--aksen); font-family: var(--font-judul); font-size: var(--teks-12); font-weight: 700; padding: 5px 14px; border-radius: 999px; margin-bottom: var(--spasi-16);">
          <span>AKSES TERBUKA</span>
          <span>&bull;</span>
          <span>100% GRATIS</span>
        </div>

        <h1 class="daftar-judul-utama">
          Mulai Langkah Karir <span class="daftar-sorotan">Bersertifikat</span>
        </h1>

        <p class="daftar-subjudul">
          Satu akun untuk mengakses seluruh materi keterampilan kerja, menyimpan progres belajar secara otomatis, dan menerbitkan sertifikat resmi.
        </p>

        <!-- Ilustrasi SVG Sederhana (Gaya Selaras index.php) -->
        <svg class="daftar-ilustrasi-svg" viewBox="0 0 440 225" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; max-width: 410px; height: auto; display: block;">
          <!-- Jendela Profil Utama -->
          <rect x="116" y="28" width="234" height="172" rx="12" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2"/>
          <path d="M117 40C117 33.9249 121.925 29 128 29H338C344.075 29 349 33.9249 349 40V54H117V40Z" fill="#EFEDE7"/>
          <line x1="116" y1="54" x2="350" y2="54" stroke="#1C1A17" stroke-width="1.5"/>
          <circle cx="132" cy="41.5" r="3.5" fill="#1F6F4A"/>
          <circle cx="144" cy="41.5" r="3.5" fill="#8A847A"/>
          <circle cx="156" cy="41.5" r="3.5" fill="#D6D2C4"/>

          <!-- Konten Abstrak Dalam Kartu Utama -->
          <circle cx="164" cy="96" r="20" fill="#E6F0EA"/>
          <circle cx="164" cy="91" r="6.5" fill="#1F6F4A"/>
          <path d="M153 107C153 101.5 157.8 98.5 164 98.5C170.2 98.5 175 101.5 175 107" stroke="#1F6F4A" stroke-width="2" stroke-linecap="round"/>

          <rect x="200" y="82" width="118" height="10" rx="5" fill="#1C1A17"/>
          <rect x="200" y="100" width="86" height="8" rx="4" fill="#B8B2A6"/>
          <rect x="200" y="114" width="64" height="8" rx="4" fill="#D6D2C4"/>

          <!-- Tombol Aksen Hijau Abstrak -->
          <rect x="144" y="144" width="178" height="32" rx="16" fill="#1F6F4A"/>
          <rect x="196" y="157" width="74" height="6" rx="3" fill="#FFFFFF"/>

          <!-- Kartu Kecil Melayang di Kiri (Lencana Verifikasi) -->
          <rect x="46" y="94" width="124" height="82" rx="10" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2"/>
          <circle cx="72" cy="120" r="11" fill="#E6F0EA"/>
          <path d="M67.5 120L70.5 123L76.5 117" stroke="#1F6F4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <rect x="92" y="113" width="56" height="6" rx="3" fill="#1C1A17"/>
          <rect x="92" y="124" width="40" height="5" rx="2.5" fill="#B8B2A6"/>
          <rect x="61" y="146" width="94" height="14" rx="7" fill="#E6F0EA"/>
          <rect x="75" y="151" width="66" height="4" rx="2" fill="#1F6F4A"/>

          <!-- Tanaman Meja Minimalis di Kanan -->
          <path d="M386 168C386 152 375 144 375 144C375 144 373 157 386 168Z" fill="#1F6F4A" stroke="#1C1A17" stroke-width="1.5"/>
          <path d="M386 168C386 149 398 140 398 140C398 140 399 155 386 168Z" fill="#E6F0EA" stroke="#1C1A17" stroke-width="1.5"/>
          <path d="M376 168H396L393 198H379L376 168Z" fill="#1F6F4A" stroke="#1C1A17" stroke-width="1.8" stroke-linejoin="round"/>

          <!-- Garis Meja & Kaki Meja -->
          <rect x="24" y="198" width="392" height="7" rx="3.5" fill="#1C1A17"/>
          <rect x="64" y="205" width="8" height="14" rx="2" fill="#1C1A17"/>
          <rect x="368" y="205" width="8" height="14" rx="2" fill="#1C1A17"/>
        </svg>

        <!-- Tiga Manfaat Utama -->
        <div class="daftar-poin-list">
          <div class="daftar-poin-item">
            <span class="daftar-poin-ikon"><i data-lucide="check" style="width: 14px; height: 14px;"></i></span>
            <span>Simpan riwayat modul dan progres kuis secara otomatis</span>
          </div>
          <div class="daftar-poin-item">
            <span class="daftar-poin-ikon"><i data-lucide="check" style="width: 14px; height: 14px;"></i></span>
            <span>Unduh sertifikat kelulusan dengan nomor verifikasi unik</span>
          </div>
          <div class="daftar-poin-item">
            <span class="daftar-poin-ikon"><i data-lucide="check" style="width: 14px; height: 14px;"></i></span>
            <span>Tanpa biaya pendaftaran, langganan, maupun syarat tersembunyi</span>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Kartu Form Pendaftaran -->
      <div class="daftar-kartu">
        <div class="daftar-kartu-header">
          <h2 class="daftar-kartu-judul">Daftar akun baru</h2>
          <p class="daftar-kartu-ket">
            Lengkapi data diri singkat di bawah ini untuk mulai belajar.
          </p>
        </div>

        <!-- Pesan Status -->
        <div id="pesan-daftar-status" style="display: none; margin-bottom: var(--spasi-16);"></div>

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

          <div class="daftar-baris-2">
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
            <div class="sandi-bungkus">
              <input type="password" id="daftar-kata-sandi" class="bidang-input" placeholder="Minimal 8 karakter" minlength="8" required>
              <button type="button" class="tombol-intip-sandi" data-target="daftar-kata-sandi" aria-label="Tampilkan kata sandi">
                <i data-lucide="eye" style="width: 17px; height: 17px;"></i>
              </button>
            </div>
          </div>

          <div class="bidang-grup">
            <label class="bidang-label" for="daftar-konfirmasi">Konfirmasi kata sandi</label>
            <div class="sandi-bungkus">
              <input type="password" id="daftar-konfirmasi" class="bidang-input" placeholder="Ulangi kata sandi" minlength="8" required>
              <button type="button" class="tombol-intip-sandi" data-target="daftar-konfirmasi" aria-label="Tampilkan konfirmasi kata sandi">
                <i data-lucide="eye" style="width: 17px; height: 17px;"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="tombol tombol-utama daftar-submit">
            <span>Buat akun gratis</span>
            <i data-lucide="arrow-up-right" style="width: 16px; height: 16px;"></i>
          </button>
        </form>

        <div class="daftar-footer-link">
          Sudah memiliki akun? <a href="login.php">Masuk di sini</a>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="module">
  import { daftarAkun } from '../assets/js/api.js';

  document.querySelectorAll('.tombol-intip-sandi').forEach((btn) => {
    btn.addEventListener('click', () => {
      const targetId = btn.getAttribute('data-target');
      const input = document.getElementById(targetId);
      if (!input) return;

      const sedangTersembunyi = input.type === 'password';
      input.type = sedangTersembunyi ? 'text' : 'password';
      btn.innerHTML = `<i data-lucide="${sedangTersembunyi ? 'eye-off' : 'eye'}" style="width: 17px; height: 17px;"></i>`;
      if (typeof lucide !== 'undefined') {
        lucide.createIcons({ nodes: [btn] });
      }
    });
  });

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