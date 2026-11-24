<style>
  .masuk-halaman {
    background-color: var(--latar);
    padding: var(--spasi-48) 0 var(--spasi-80);
    min-height: calc(100vh - 140px);
    display: flex;
    align-items: center;
  }

  .masuk-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spasi-64);
    align-items: center;
  }

  .masuk-judul-utama {
    font-family: var(--font-judul);
    font-size: clamp(30px, 3.8vw, 44px);
    font-weight: 700;
    line-height: 1.3;
    letter-spacing: -0.025em;
    color: var(--teks);
    margin-bottom: var(--spasi-16);
  }

  .masuk-sorotan {
    display: inline-block;
    border: 2px solid var(--aksen);
    color: var(--aksen);
    padding: 2px 16px 5px;
    border-radius: 999px;
    line-height: 1.15;
    margin-top: 4px;
  }

  .masuk-subjudul {
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    font-weight: 400;
    line-height: var(--jarak-baris-baca);
    color: var(--teks-2);
    margin-bottom: var(--spasi-28);
    max-width: 440px;
  }

  .masuk-poin-list {
    display: flex;
    flex-direction: column;
    gap: var(--spasi-12);
    margin-top: var(--spasi-28);
  }

  .masuk-poin-item {
    display: flex;
    align-items: center;
    gap: var(--spasi-12);
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    font-weight: 500;
    color: var(--teks);
  }

  .masuk-poin-ikon {
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

  /* Kartu Formulir Masuk */
  .masuk-kartu {
    background-color: var(--permukaan);
    border: 1px solid var(--garis-tegas);
    border-radius: var(--radius-panel);
    padding: var(--spasi-40);
  }

  .masuk-kartu-header {
    margin-bottom: var(--spasi-20);
    padding-bottom: var(--spasi-16);
    border-bottom: 1px solid var(--garis);
  }

  .masuk-kartu-judul {
    font-family: var(--font-judul);
    font-size: var(--teks-28);
    font-weight: 700;
    letter-spacing: -0.02em;
    color: var(--teks);
    margin: 0 0 6px;
  }

  .masuk-kartu-ket {
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    color: var(--teks-2);
    margin: 0;
    line-height: 1.5;
  }

  .demo-kotak {
    margin-bottom: var(--spasi-20);
    padding: var(--spasi-12);
    background-color: var(--latar);
    border-radius: var(--radius-dalam);
    border: 1px solid var(--garis);
  }

  .demo-tombol {
    width: 100%;
    background-color: var(--permukaan);
    border-radius: 999px;
    font-family: var(--font-judul);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    cursor: pointer;
  }

  .sandi-label-baris {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
  }

  .sandi-label-baris .bidang-label {
    margin-bottom: 0;
  }

  .tautan-lupa {
    font-family: var(--font-ui);
    font-size: var(--teks-12);
    color: var(--teks-3);
    text-decoration: none;
    transition: var(--transisi-cepat);
  }

  .tautan-lupa:hover {
    color: var(--aksen);
    text-decoration: underline;
  }

  /* Input Kata Sandi Lebar Penuh */
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

  .masuk-submit {
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

  .masuk-footer-link {
    margin-top: var(--spasi-24);
    padding-top: var(--spasi-16);
    border-top: 1px solid var(--garis);
    font-family: var(--font-ui);
    font-size: var(--teks-14);
    color: var(--teks-2);
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: var(--spasi-8);
  }

  .masuk-footer-link a.tautan-daftar {
    color: var(--aksen);
    font-weight: 600;
    text-decoration: none;
  }

  .masuk-footer-link a.tautan-daftar:hover {
    text-decoration: underline;
  }

  .masuk-footer-admin {
    font-size: var(--teks-12);
    color: var(--teks-3);
  }

  .masuk-footer-admin a {
    color: var(--teks-2);
    text-decoration: underline;
    transition: var(--transisi-cepat);
  }

  .masuk-footer-admin a:hover {
    color: var(--aksen);
  }

  @media (max-width: 900px) {
    .masuk-halaman {
      padding: var(--spasi-32) 0 var(--spasi-64);
    }

    .masuk-grid {
      grid-template-columns: 1fr;
      gap: var(--spasi-32);
    }

    .masuk-ilustrasi-svg {
      max-width: 340px !important;
    }
  }

  @media (max-width: 600px) {
    .masuk-kartu {
      padding: var(--spasi-24);
    }

    .masuk-ilustrasi-svg,
    .masuk-poin-list {
      display: none;
    }

    .masuk-subjudul {
      margin-bottom: 0;
    }
  }
</style>

<section class="masuk-halaman">
  <div class="wadah">
    <div class="masuk-grid">
      <!-- Kolom Kiri: Konteks & Ilustrasi SVG Sederhana -->
      <div>
        <div style="display: inline-flex; align-items: center; gap: 8px; background-color: var(--aksen-tipis); color: var(--aksen); font-family: var(--font-judul); font-size: var(--teks-12); font-weight: 700; padding: 5px 14px; border-radius: 999px; margin-bottom: var(--spasi-16);">
          <span>AKSES AKUN PESERTA</span>
          <span>&bull;</span>
          <span>SKILL4LIFE</span>
        </div>

        <h1 class="masuk-judul-utama">
          Lanjutkan Progres <span class="masuk-sorotan">Belajar</span> Anda
        </h1>

        <p class="masuk-subjudul">
          Masuk untuk membuka kembali modul terakhir yang dipelajari, mengerjakan kuis kelulusan, dan mengunduh sertifikat resmi.
        </p>

        <!-- Ilustrasi SVG Sederhana (Selaras index.php & daftar.php) -->
        <svg class="masuk-ilustrasi-svg" viewBox="0 0 440 225" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; max-width: 410px; height: auto; display: block;">
          <!-- Jendela Dashboard Utama -->
          <rect x="116" y="28" width="234" height="172" rx="12" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2"/>
          <path d="M117 40C117 33.9249 121.925 29 128 29H338C344.075 29 349 33.9249 349 40V54H117V40Z" fill="#242424"/>
          <line x1="116" y1="54" x2="350" y2="54" stroke="#1C1A17" stroke-width="1.5"/>
          <circle cx="132" cy="41.5" r="3.5" fill="#1DB954"/>
          <circle cx="144" cy="41.5" r="3.5" fill="#727272"/>
          <circle cx="156" cy="41.5" r="3.5" fill="rgba(255, 255, 255, 0.08)"/>

          <!-- Konten Progres Modul Dalam Layar -->
          <rect x="138" y="74" width="110" height="10" rx="5" fill="#1C1A17"/>
          <rect x="138" y="92" width="84" height="7" rx="3.5" fill="rgba(255, 255, 255, 0.15)"/>
          <rect x="138" y="105" width="96" height="7" rx="3.5" fill="rgba(255, 255, 255, 0.08)"/>

          <!-- Lingkaran Progres Kanan -->
          <rect x="262" y="72" width="66" height="72" rx="10" fill="#121212" stroke="#1C1A17" stroke-width="1.5"/>
          <circle cx="295" cy="102" r="17" stroke="rgba(29, 185, 84, 0.15)" stroke-width="5"/>
          <path d="M295 85 A17 17 0 1 1 280 110" stroke="#1DB954" stroke-width="5" stroke-linecap="round"/>
          <rect x="277" y="128" width="36" height="5" rx="2.5" fill="#1C1A17"/>

          <!-- Tombol Lanjutkan -->
          <rect x="138" y="128" width="106" height="24" rx="12" fill="#1DB954"/>
          <rect x="164" y="137" width="54" height="6" rx="3" fill="#FFFFFF"/>

          <!-- Baris Riwayat Bawah -->
          <rect x="138" y="166" width="190" height="16" rx="6" fill="rgba(29, 185, 84, 0.15)"/>
          <rect x="150" y="172" width="88" height="4" rx="2" fill="#1DB954"/>

          <!-- Kartu Kecil Melayang di Kiri (Status Terverifikasi) -->
          <rect x="46" y="94" width="124" height="82" rx="10" fill="#FFFFFF" stroke="#1C1A17" stroke-width="2"/>
          <circle cx="72" cy="120" r="11" fill="rgba(29, 185, 84, 0.15)"/>
          <path d="M67.5 120L70.5 123L76.5 117" stroke="#1DB954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <rect x="92" y="113" width="56" height="6" rx="3" fill="#1C1A17"/>
          <rect x="92" y="124" width="40" height="5" rx="2.5" fill="rgba(255, 255, 255, 0.15)"/>
          <rect x="61" y="146" width="94" height="14" rx="7" fill="rgba(29, 185, 84, 0.15)"/>
          <rect x="75" y="151" width="66" height="4" rx="2" fill="#1DB954"/>

          <!-- Tanaman Meja Minimalis di Kanan -->
          <path d="M386 168C386 152 375 144 375 144C375 144 373 157 386 168Z" fill="#1DB954" stroke="#1C1A17" stroke-width="1.5"/>
          <path d="M386 168C386 149 398 140 398 140C398 140 399 155 386 168Z" fill="rgba(29, 185, 84, 0.15)" stroke="#1C1A17" stroke-width="1.5"/>
          <path d="M376 168H396L393 198H379L376 168Z" fill="#1DB954" stroke="#1C1A17" stroke-width="1.8" stroke-linejoin="round"/>

          <!-- Garis Meja & Kaki Meja -->
          <rect x="24" y="198" width="392" height="7" rx="3.5" fill="#1C1A17"/>
          <rect x="64" y="205" width="8" height="14" rx="2" fill="#1C1A17"/>
          <rect x="368" y="205" width="8" height="14" rx="2" fill="#1C1A17"/>
        </svg>

        <!-- Tiga Poin Ringkas -->
        <div class="masuk-poin-list">
          <div class="masuk-poin-item">
            <span class="masuk-poin-ikon"><i data-lucide="check" style="width: 14px; height: 14px;"></i></span>
            <span>Lanjutkan bacaan dan video materi dari titik terakhir</span>
          </div>
          <div class="masuk-poin-item">
            <span class="masuk-poin-ikon"><i data-lucide="check" style="width: 14px; height: 14px;"></i></span>
            <span>Pantau skor kuis kelulusan di setiap kursus</span>
          </div>
          <div class="masuk-poin-item">
            <span class="masuk-poin-ikon"><i data-lucide="check" style="width: 14px; height: 14px;"></i></span>
            <span>Akses ulang seluruh sertifikat yang sudah diterbitkan</span>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Kartu Form Masuk -->
      <div class="masuk-kartu">
        <div class="masuk-kartu-header">
          <h2 class="masuk-kartu-judul">Masuk</h2>
          <p class="masuk-kartu-ket">
            Gunakan email dan kata sandi akun peserta Anda.
          </p>
        </div>

        <!-- Tombol Cepat Demo -->
        <div class="demo-kotak">
          <button type="button" id="btn-isi-demo-peserta" class="tombol tombol-sekunder tombol-kecil demo-tombol">
            <i data-lucide="key-round" style="width: 14px; height: 14px; color: var(--aksen);"></i>
            <span>Gunakan akun demo (Budi Santoso)</span>
          </button>
        </div>

        <!-- Kotak Pesan Status -->
        <div id="pesan-login-status" style="display: none; margin-bottom: var(--spasi-16);"></div>

        <form id="form-masuk-peserta">
          <div class="bidang-grup">
            <label class="bidang-label" for="masuk-email">Alamat email</label>
            <input type="email" id="masuk-email" class="bidang-input" placeholder="nama@domain.com" required value="budi@gmail.com">
          </div>

          <div class="bidang-grup">
            <div class="sandi-label-baris">
              <label class="bidang-label" for="masuk-kata-sandi">Kata sandi</label>
              <a href="javascript:void(0)" id="link-lupa-sandi" class="tautan-lupa">Lupa kata sandi?</a>
            </div>
            <div class="sandi-bungkus">
              <input type="password" id="masuk-kata-sandi" class="bidang-input" placeholder="Minimal 8 karakter" minlength="8" required value="budi1234">
              <button type="button" class="tombol-intip-sandi" data-target="masuk-kata-sandi" aria-label="Tampilkan kata sandi">
                <i data-lucide="eye" style="width: 17px; height: 17px;"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="tombol tombol-utama masuk-submit">
            <span>Masuk ke dashboard</span>
            <i data-lucide="arrow-up-right" style="width: 16px; height: 16px;"></i>
          </button>
        </form>

        <div class="masuk-footer-link">
          <div>Belum memiliki akun? <a href="daftar.php" class="tautan-daftar">Daftar gratis</a></div>
          <div class="masuk-footer-admin">
            Masuk sebagai pengelola? <a href="../pengelola/login.php">Panel pengelola</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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

  // Fitur intip/sembunyikan kata sandi
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