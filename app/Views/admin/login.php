<style>
  html,
  body {
    max-width: 100%;
    overflow-x: hidden;
    background-color: #F7F5F0;
  }

  footer,
  .kaki-halaman {
    display: none !important;
  }

  .adm-login-wrap,
  .adm-login-wrap * {
    box-sizing: border-box;
  }

  .adm-login-wrap {
    min-height: calc(100vh - 64px);
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 36px 16px 48px;
    font-family: var(--font-ui);
    color: #1C1A17;
  }

  .adm-login-card {
    width: 100%;
    max-width: 440px;
    background-color: #FFFFFF;
    border: 1px solid #E6E2D8;
    border-radius: 16px;
    padding: 32px 30px 26px;
    box-shadow: 0 2px 10px rgba(28, 26, 23, 0.025);
  }

  /* Header Kartu Login */
  .adm-login-head {
    margin-bottom: 22px;
  }

  .adm-login-brand {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
  }

  .adm-brand-mark {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background-color: #1F6F4A;
    color: #FFFFFF;
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    letter-spacing: -0.02em;
  }

  .adm-login-kicker {
    font-family: var(--font-mono, monospace);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #1F6F4A;
  }

  .adm-login-title {
    font-family: var(--font-judul, var(--font-ui));
    font-size: 24px;
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1.25;
    color: #1C1A17;
    margin: 0 0 6px;
  }

  .adm-login-subtitle {
    font-size: 13.5px;
    line-height: 1.55;
    color: #5C5750;
    margin: 0;
  }

  /* Kotak Isi Cepat Akun Demo */
  .adm-demo-box {
    background-color: #FAF9F6;
    border: 1px solid #E6E2D8;
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 20px;
  }

  .adm-demo-btn {
    width: 100%;
    height: 38px;
    padding: 0 14px;
    border-radius: 10px;
    border: 1px solid #DCD6C8;
    background-color: #FFFFFF;
    color: #1C1A17;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    cursor: pointer;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .adm-demo-btn:hover {
    border-color: #1F6F4A;
    color: #1F6F4A;
    background-color: #FAF9F6;
  }

  /* Pesan Error Login */
  .adm-login-alert {
    display: none;
    align-items: flex-start;
    gap: 9px;
    padding: 11px 14px;
    border-radius: 10px;
    background-color: #FBF4F3;
    border: 1px solid #E3C5C1;
    color: #9E3B33;
    font-size: 13px;
    line-height: 1.45;
    margin-bottom: 18px;
  }

  /* Form & Input */
  .adm-login-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .adm-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .adm-label {
    font-size: 13px;
    font-weight: 600;
    color: #3E3A34;
  }

  .adm-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
  }

  .adm-input-icon {
    position: absolute;
    left: 13px;
    color: #7A746B;
    display: inline-flex;
    align-items: center;
    pointer-events: none;
  }

  .adm-input {
    width: 100%;
    height: 42px;
    padding: 0 14px 0 38px;
    border-radius: 10px;
    border: 1px solid #DCD6C8;
    background-color: #FAF9F6;
    color: #1C1A17;
    font-family: var(--font-ui);
    font-size: 14px;
    transition: border-color 140ms ease, background-color 140ms ease;
  }

  .adm-input.has-toggle {
    padding-right: 42px;
  }

  .adm-input:focus {
    outline: none;
    border-color: #1F6F4A;
    background-color: #FFFFFF;
  }

  .adm-pass-toggle {
    position: absolute;
    right: 8px;
    width: 30px;
    height: 30px;
    border-radius: 8px;
    border: none;
    background: transparent;
    color: #7A746B;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: color 140ms ease, background-color 140ms ease;
  }

  .adm-pass-toggle:hover {
    color: #1C1A17;
    background-color: #EFECE4;
  }

  /* Tombol Submit */
  .adm-submit-btn {
    width: 100%;
    height: 42px;
    margin-top: 6px;
    padding: 0 18px;
    border-radius: 10px;
    border: 1px solid #1F6F4A;
    background-color: #1F6F4A;
    color: #FFFFFF;
    font-family: var(--font-ui);
    font-size: 14px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    cursor: pointer;
    transition: background-color 140ms ease;
  }

  .adm-submit-btn:hover {
    background-color: #18583B;
  }

  .adm-submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
  }

  /* Tautan Kembali */
  .adm-login-foot {
    margin-top: 22px;
    padding-top: 16px;
    border-top: 1px solid #EFECE4;
    text-align: center;
  }

  .adm-back-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: #5C5750;
    text-decoration: none;
    transition: color 140ms ease;
  }

  .adm-back-link:hover {
    color: #1F6F4A;
  }

  @media (max-width: 480px) {
    .adm-login-wrap {
      padding: 24px 14px 36px;
      align-items: flex-start;
    }

    .adm-login-card {
      padding: 24px 20px 22px;
      border-radius: 14px;
    }

    .adm-login-title {
      font-size: 22px;
    }
  }
</style>

<div class="adm-login-wrap">
  <div class="adm-login-card">
    <div class="adm-login-head">
      <div class="adm-login-brand">
        <span class="adm-brand-mark">S4L</span>
        <span class="adm-login-kicker">Panel Administrator &middot; SDG 1</span>
      </div>
      <h1 class="adm-login-title">Masuk pengelola</h1>
      <p class="adm-login-subtitle">
        Panel administrasi kurikulum, modul, soal kuis, dan data peserta Skill4Life.
      </p>
    </div>

    <!-- Tombol isi cepat akun demo -->
    <div class="adm-demo-box">
      <button type="button" id="btn-demo-admin" class="adm-demo-btn">
        <i data-lucide="key-round" style="width: 15px; height: 15px; color: #1F6F4A;"></i>
        <span>Gunakan akun demo pengelola</span>
      </button>
    </div>

    <div id="pesan-admin-login" class="adm-login-alert" role="alert"></div>

    <form id="form-admin-login" class="adm-login-form">
      <div class="adm-field">
        <label class="adm-label" for="adm-email">Alamat email pengelola</label>
        <div class="adm-input-wrap">
          <span class="adm-input-icon">
            <i data-lucide="mail" style="width: 15px; height: 15px;"></i>
          </span>
          <input type="email" id="adm-email" class="adm-input" value="admin@skill4life.id" placeholder="admin@skill4life.id" required>
        </div>
      </div>

      <div class="adm-field">
        <label class="adm-label" for="adm-pass">Kata sandi</label>
        <div class="adm-input-wrap">
          <span class="adm-input-icon">
            <i data-lucide="lock" style="width: 15px; height: 15px;"></i>
          </span>
          <input type="password" id="adm-pass" class="adm-input has-toggle" value="admin1234" placeholder="Masukkan kata sandi" required>
          <button type="button" id="btn-toggle-pass" class="adm-pass-toggle" aria-label="Tampilkan atau sembunyikan kata sandi">
            <i data-lucide="eye" style="width: 15px; height: 15px;"></i>
          </button>
        </div>
      </div>

      <button type="submit" id="btn-submit-admin" class="adm-submit-btn">
        <span>Masuk ke panel pengelola</span>
        <i data-lucide="arrow-right" style="width: 15px; height: 15px;"></i>
      </button>
    </form>

    <div class="adm-login-foot">
      <a href="../index.php" class="adm-back-link">
        <i data-lucide="arrow-left" style="width: 14px; height: 14px;"></i>
        <span>Kembali ke beranda publik</span>
      </a>
    </div>
  </div>
</div>

<script type="module">
  import { masukAkun } from '../assets/js/api.js';

  const pesanBox = document.getElementById('pesan-admin-login');
  const inputEmail = document.getElementById('adm-email');
  const inputPass = document.getElementById('adm-pass');
  const btnTogglePass = document.getElementById('btn-toggle-pass');
  const btnSubmit = document.getElementById('btn-submit-admin');

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('footer, .kaki-halaman').forEach(el => el.remove());
    if (window.lucide) lucide.createIcons();
  });

  btnTogglePass.addEventListener('click', () => {
    const isHidden = inputPass.type === 'password';
    inputPass.type = isHidden ? 'text' : 'password';
    btnTogglePass.innerHTML = `<i data-lucide="${isHidden ? 'eye-off' : 'eye'}" style="width: 15px; height: 15px;"></i>`;
    if (window.lucide) lucide.createIcons();
  });

  document.getElementById('btn-demo-admin').addEventListener('click', () => {
    inputEmail.value = 'admin@skill4life.id';
    inputPass.value = 'admin1234';
    pesanBox.style.display = 'none';
    if (typeof tampilkanToast === 'function') {
      tampilkanToast('Kredensial demo pengelola terisi', 'info');
    }
  });

  document.getElementById('form-admin-login').addEventListener('submit', async (e) => {
    e.preventDefault();
    pesanBox.style.display = 'none';
    btnSubmit.disabled = true;

    const email = inputEmail.value.trim();
    const pass = inputPass.value;

    const hasil = await masukAkun(email, pass, 'admin');
    if (!hasil.ok) {
      btnSubmit.disabled = false;
      pesanBox.className = 'adm-login-alert';
      pesanBox.innerHTML = `
        <i data-lucide="alert-circle" style="width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px;"></i>
        <span>${hasil.pesan}</span>
      `;
      pesanBox.style.display = 'flex';
      if (window.lucide) lucide.createIcons();
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