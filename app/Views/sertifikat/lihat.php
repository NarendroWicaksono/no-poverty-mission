<style>
  .cert-viewer-wrap {
    background-color: #F7F5F0;
    padding: 32px 20px 72px;
    min-height: calc(100vh - 72px);
    font-family: var(--font-ui);
    color: #1C1A17;
  }

  .cert-container {
    max-width: 940px;
    margin: 0 auto;
  }

  /* Bar Aksi Atas */
  .cert-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 20px;
  }

  .cert-back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: #5C5750;
    text-decoration: none;
    transition: color 140ms ease;
  }

  .cert-back-link:hover {
    color: #1C1A17;
  }

  .cert-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }

  .cert-btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    height: 36px;
    padding: 0 14px;
    border-radius: 8px;
    border: 1px solid #D8D3C8;
    background-color: #FFFFFF;
    color: #1C1A17;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: border-color 140ms ease, color 140ms ease, background-color 140ms ease;
  }

  .cert-btn-secondary:hover {
    border-color: #1F6F4A;
    color: #1F6F4A;
    background-color: #FAF9F6;
  }

  .cert-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    height: 36px;
    padding: 0 16px;
    border-radius: 8px;
    border: 1px solid #1F6F4A;
    background-color: #1F6F4A;
    color: #FFFFFF;
    font-family: var(--font-ui);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 140ms ease;
  }

  .cert-btn-primary:hover {
    background-color: #18583B;
    color: #FFFFFF !important;
  }

  /* Lembar Fisik Sertifikat (Proporsi A4 Landscape) */
  .lembar-sertifikat {
    position: relative;
    background-color: #FCFBF8;
    border: 1.5px solid #2A2723;
    padding: 12px;
    box-shadow: 0 14px 36px rgba(28, 26, 23, 0.06);
    aspect-ratio: 297 / 210;
    display: flex;
    flex-direction: column;
    overflow: hidden;
  }

  .sertifikat-garis-dalam {
    position: relative;
    flex: 1;
    border: 1px solid #B9B19E;
    padding: 28px 44px 26px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
  }

  /* Ornamen Siku Sudut SVG Inline */
  .sertifikat-corner-svg {
    position: absolute;
    width: 34px;
    height: 34px;
    pointer-events: none;
    z-index: 2;
  }

  .sertifikat-corner-svg.tl { top: 6px; left: 6px; }
  .sertifikat-corner-svg.tr { top: 6px; right: 6px; transform: scaleX(-1); }
  .sertifikat-corner-svg.bl { bottom: 6px; left: 6px; transform: scaleY(-1); }
  .sertifikat-corner-svg.br { bottom: 6px; right: 6px; transform: scale(-1, -1); }

  /* Siluet Panorama & Laurel SVG Inline (Ikut Tercetak saat Save PDF) */
  .sertifikat-silhouette-svg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
  }

  /* Kepala Sertifikat */
  .sertifikat-head {
    position: relative;
    z-index: 2;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 14px;
    border-bottom: 1px solid #DDD7C7;
  }

  .sertifikat-issuer {
    display: flex;
    align-items: center;
    gap: 11px;
    text-align: left;
  }

  .sertifikat-issuer-mark {
    width: 30px;
    height: 30px;
    border-radius: 5px;
    background-color: #1F6F4A;
    color: #FFFFFF;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .sertifikat-issuer-name {
    font-family: var(--font-judul);
    font-size: 16px;
    font-weight: 700;
    letter-spacing: -0.02em;
    color: #1C1A17;
    line-height: 1.2;
  }

  .sertifikat-issuer-sub {
    font-size: 11px;
    color: #6B655C;
    margin-top: 2px;
  }

  .sertifikat-seal-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .sertifikat-seal-text {
    text-align: right;
  }

  .sertifikat-seal-kicker {
    display: block;
    font-family: var(--font-mono, monospace);
    font-size: 9.5px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #1F6F4A;
  }

  .sertifikat-seal-sub {
    display: block;
    font-size: 10.5px;
    color: #6B655C;
    margin-top: 1px;
  }

  /* Isi Tengah Sertifikat */
  .sertifikat-body {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 12px 12px;
  }

  .sertifikat-kicker {
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: #6B655C;
    margin-bottom: 5px;
  }

  .sertifikat-main-title {
    font-family: var(--font-serif);
    font-size: 32px;
    font-weight: 600;
    letter-spacing: -0.01em;
    color: #1C1A17;
    margin: 0;
    line-height: 1.18;
  }

  .sertifikat-ornament-line {
    display: flex;
    justify-content: center;
    margin: 10px auto 14px;
  }

  .sertifikat-intro {
    font-size: 13px;
    color: #5C5750;
    margin: 0 0 6px;
  }

  .sertifikat-penerima {
    display: inline-block;
    min-width: 360px;
    max-width: 100%;
    padding: 0 24px 7px;
    margin-bottom: 12px;
    border-bottom: 1.5px solid #2A2723;
    font-family: var(--font-serif);
    font-size: clamp(26px, 3.6vw, 39px);
    font-weight: 600;
    line-height: 1.18;
    color: #1F6F4A;
  }

  .sertifikat-desc {
    font-size: 13px;
    color: #5C5750;
    max-width: 570px;
    margin: 0 auto 7px;
    line-height: 1.55;
  }

  .sertifikat-kursus {
    font-family: var(--font-judul);
    font-size: 18.5px;
    font-weight: 600;
    color: #1C1A17;
    line-height: 1.35;
    max-width: 680px;
    margin: 0 auto;
  }

  /* Kaki Sertifikat */
  .sertifikat-foot {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: end;
    gap: 20px;
    padding-top: 16px;
    border-top: 1px solid #DDD7C7;
  }

  .sertifikat-meta-list {
    display: flex;
    flex-direction: column;
    gap: 4px;
    text-align: left;
  }

  .sertifikat-meta-row {
    font-size: 11.5px;
    color: #6B655C;
    display: flex;
    align-items: baseline;
    gap: 6px;
  }

  .sertifikat-meta-label {
    min-width: 102px;
    color: #6B655C;
  }

  .nomor-sertifikat {
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #1C1A17;
  }

  .sertifikat-meta-val {
    font-family: var(--font-mono, monospace);
    font-size: 11.5px;
    font-weight: 500;
    color: #1C1A17;
  }

  /* QR Verifikasi Tengah */
  .sertifikat-qr-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
  }

  .sertifikat-qr-link {
    display: inline-flex;
    padding: 4px;
    background-color: #FFFFFF;
    border: 1px solid #2A2723;
    transition: border-color 140ms ease;
  }

  .sertifikat-qr-link:hover {
    border-color: #1F6F4A;
  }

  .sertifikat-qr-caption {
    font-family: var(--font-mono, monospace);
    font-size: 9px;
    letter-spacing: 0.06em;
    color: #6B655C;
    text-transform: uppercase;
  }

  /* Blok Tanda Tangan Kanan */
  .sertifikat-sign-box {
    text-align: right;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
  }

  .sertifikat-signature-script {
    font-family: var(--font-serif);
    font-size: 21px;
    font-style: italic;
    color: #1C1A17;
    padding: 0 4px 5px;
    margin-bottom: 5px;
    border-bottom: 1px solid #2A2723;
    min-width: 195px;
    text-align: right;
  }

  .sertifikat-signer-name {
    font-size: 12.5px;
    font-weight: 600;
    color: #1C1A17;
  }

  .sertifikat-signer-title {
    font-size: 11px;
    color: #6B655C;
    margin-top: 1px;
  }

  @media (max-width: 820px) {
    .lembar-sertifikat {
      aspect-ratio: auto;
      padding: 8px;
    }

    .sertifikat-garis-dalam {
      padding: 24px 20px;
      gap: 24px;
    }

    .sertifikat-penerima {
      min-width: 0;
      width: 100%;
    }

    .sertifikat-seal-text {
      display: none;
    }

    .sertifikat-foot {
      grid-template-columns: 1fr;
      text-align: left;
      gap: 18px;
    }

    .sertifikat-qr-box {
      align-items: flex-start;
    }

    .sertifikat-sign-box {
      align-items: flex-start;
      text-align: left;
    }

    .sertifikat-signature-script {
      text-align: left;
    }
  }

  @page {
    size: A4 landscape;
    margin: 0;
  }

  @media print {
    html, body {
      background: #FFFFFF !important;
      margin: 0 !important;
      padding: 0 !important;
      width: 297mm;
      height: 210mm;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }

    body * {
      visibility: hidden;
    }

    #area-cetak-sertifikat,
    #area-cetak-sertifikat * {
      visibility: visible;
    }

    #area-cetak-sertifikat {
      position: fixed;
      inset: 0;
      width: 297mm;
      height: 210mm;
      margin: 0;
      padding: 8mm;
      box-sizing: border-box;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .lembar-sertifikat {
      width: 100%;
      height: 100%;
      max-width: 100% !important;
      background-color: #FCFBF8 !important;
      box-shadow: none !important;
      border: 1.5px solid #2A2723 !important;
      page-break-inside: avoid;
      break-inside: avoid;
    }

    .sertifikat-silhouette-svg,
    .sertifikat-corner-svg,
    .sertifikat-official-seal {
      display: block !important;
      visibility: visible !important;
    }

    .tidak-dicetak,
    .nav-utama,
    .kaki-halaman,
    header,
    nav,
    footer {
      display: none !important;
    }
  }
</style>

<div class="cert-viewer-wrap">
  <div class="cert-container">
    <!-- Bar Aksi Atas (Tersembunyi saat Cetak) -->
    <div class="cert-toolbar tidak-dicetak">
      <a href="<?= $baseUrl ?>/dashboard/index.php" class="cert-back-link">
        <i data-lucide="arrow-left" style="width: 15px; height: 15px;"></i>
        <span>Kembali ke dashboard</span>
      </a>

      <div class="cert-actions">
        <button type="button" id="btn-salin-tautan-sert" class="cert-btn-secondary">
          <i data-lucide="link" style="width: 14px; height: 14px;"></i>
          <span>Salin tautan</span>
        </button>
        <a href="#" id="btn-cek-verifikasi-sert" class="cert-btn-secondary">
          <i data-lucide="shield-check" style="width: 14px; height: 14px;"></i>
          <span>Verifikasi publik</span>
        </a>
        <button type="button" id="btn-cetak-sertifikat" class="cert-btn-primary">
          <i data-lucide="printer" style="width: 14px; height: 14px;"></i>
          <span>Cetak / Simpan PDF</span>
        </button>
      </div>
    </div>

    <!-- Lembar Fisik Sertifikat Kertas (Landscape A4) -->
    <div id="area-cetak-sertifikat">
      <div class="lembar-sertifikat">
        <div class="sertifikat-garis-dalam">
          <!-- Ornamen Siku 4 Sudut (Inline SVG) -->
          <svg class="sertifikat-corner-svg tl" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 34V2H34" stroke="#1F6F4A" stroke-width="1.6"/>
            <path d="M7 28V7H28" stroke="#8C7343" stroke-width="0.9"/>
            <rect x="2" y="2" width="5" height="5" fill="#1F6F4A"/>
          </svg>
          <svg class="sertifikat-corner-svg tr" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 34V2H34" stroke="#1F6F4A" stroke-width="1.6"/>
            <path d="M7 28V7H28" stroke="#8C7343" stroke-width="0.9"/>
            <rect x="2" y="2" width="5" height="5" fill="#1F6F4A"/>
          </svg>
          <svg class="sertifikat-corner-svg bl" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 34V2H34" stroke="#1F6F4A" stroke-width="1.6"/>
            <path d="M7 28V7H28" stroke="#8C7343" stroke-width="0.9"/>
            <rect x="2" y="2" width="5" height="5" fill="#1F6F4A"/>
          </svg>
          <svg class="sertifikat-corner-svg br" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 34V2H34" stroke="#1F6F4A" stroke-width="1.6"/>
            <path d="M7 28V7H28" stroke="#8C7343" stroke-width="0.9"/>
            <rect x="2" y="2" width="5" height="5" fill="#1F6F4A"/>
          </svg>

          <!-- Ilustrasi Siluet Latar Belakang (Inline Vector, Ikut Tercetak saat Download PDF) -->
          <svg class="sertifikat-silhouette-svg" viewBox="0 0 1122 794" preserveAspectRatio="xMidYMid slice" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Rosette Geometris & Busur Kompas Tengah -->
            <g opacity="0.055" stroke="#1F6F4A">
              <circle cx="561" cy="395" r="215" stroke-width="1.2"/>
              <circle cx="561" cy="395" r="196" stroke-width="0.8" stroke-dasharray="5 5"/>
              <circle cx="561" cy="395" r="154" stroke-width="1"/>
              <path d="M561 168V622M334 395H788" stroke-width="0.7" stroke-dasharray="3 6"/>
            </g>

            <!-- Siluet Ranting Laurel Kiri & Kanan -->
            <g opacity="0.065" fill="#1F6F4A">
              <!-- Ranting Kiri -->
              <path d="M365 510C332 465 322 405 338 345C341 334 345 324 350 315" stroke="#1F6F4A" stroke-width="2" fill="none" stroke-linecap="round"/>
              <path d="M352 485C332 478 320 462 324 445C338 452 348 467 352 485Z"/>
              <path d="M342 452C320 443 310 425 316 408C331 416 340 433 342 452Z"/>
              <path d="M337 416C316 405 309 385 317 369C331 379 338 397 337 416Z"/>
              <path d="M339 380C321 367 317 347 327 332C339 344 343 362 339 380Z"/>
              <path d="M346 345C332 330 332 311 344 298C353 312 353 329 346 345Z"/>
              <!-- Daun Sisi Dalam Kiri -->
              <path d="M356 472C372 460 378 441 370 426C358 437 353 454 356 472Z"/>
              <path d="M346 436C364 425 372 406 365 390C352 400 345 418 346 436Z"/>
              <path d="M342 398C361 388 371 370 366 353C352 362 343 379 342 398Z"/>
              <path d="M344 361C364 353 375 336 372 319C358 326 347 342 344 361Z"/>

              <!-- Ranting Kanan (Simetris) -->
              <path d="M757 510C790 465 800 405 784 345C781 334 777 324 772 315" stroke="#1F6F4A" stroke-width="2" fill="none" stroke-linecap="round"/>
              <path d="M770 485C790 478 802 462 798 445C784 452 774 467 770 485Z"/>
              <path d="M780 452C802 443 812 425 806 408C791 416 782 433 780 452Z"/>
              <path d="M785 416C806 405 813 385 805 369C791 379 784 397 785 416Z"/>
              <path d="M783 380C801 367 805 347 795 332C783 344 779 362 783 380Z"/>
              <path d="M776 345C790 330 790 311 778 298C769 312 769 329 776 345Z"/>
              <!-- Daun Sisi Dalam Kanan -->
              <path d="M766 472C750 460 744 441 752 426C764 437 769 454 766 472Z"/>
              <path d="M776 436C758 425 750 406 757 390C770 400 777 418 776 436Z"/>
              <path d="M780 398C761 388 751 370 756 353C770 362 779 379 780 398Z"/>
              <path d="M778 361C758 353 747 336 750 319C764 326 775 342 778 361Z"/>
            </g>

            <!-- Siluet Cakrawala & Arsitektur Kemajuan di Bagian Bawah -->
            <g opacity="0.045" fill="#1C1A17">
              <path d="M0 638H74V588H116V612H164V560H214V602H268V624H330V638H0Z"/>
              <path d="M1122 638H1048V582H1004V608H956V554H906V596H852V620H792V638H1122Z"/>
            </g>
            <path d="M0 638C220 612 390 604 561 604C732 604 902 612 1122 638V646H0V638Z" fill="#8C7343" opacity="0.055"/>
          </svg>

          <!-- Kepala Sertifikat -->
          <div class="sertifikat-head">
            <div class="sertifikat-issuer">
              <span class="sertifikat-issuer-mark">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.5 8.2L6.5 11.2L12.5 5.2" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <div>
                <div class="sertifikat-issuer-name">
                  Skill<span style="color: #1F6F4A;">4</span>Life
                </div>
                <div class="sertifikat-issuer-sub">
                  Prakarsa Pelatihan Kerja &middot; SDG 1 No Poverty
                </div>
              </div>
            </div>

            <!-- Stempel Resmi Inline SVG (Tanpa Pill Transparan) -->
            <div class="sertifikat-seal-wrap">
              <div class="sertifikat-seal-text">
                <span class="sertifikat-seal-kicker">Arsip Resmi Terdaftar</span>
                <span class="sertifikat-seal-sub">Standar Kompetensi Kerja</span>
              </div>

              <svg class="sertifikat-official-seal" width="54" height="54" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="Segel resmi Skill4Life">
                <circle cx="32" cy="32" r="29" stroke="#1F6F4A" stroke-width="1.6"/>
                <circle cx="32" cy="32" r="24.5" stroke="#8C7343" stroke-width="0.9" stroke-dasharray="2.5 2"/>
                <circle cx="32" cy="32" r="18" fill="#1F6F4A"/>
                <path d="M24.5 32.5L29.5 37.5L40 26.5" stroke="#FCFBF8" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="32" cy="8.5" r="1.3" fill="#1F6F4A"/>
                <circle cx="32" cy="55.5" r="1.3" fill="#1F6F4A"/>
                <circle cx="8.5" cy="32" r="1.3" fill="#1F6F4A"/>
                <circle cx="55.5" cy="32" r="1.3" fill="#1F6F4A"/>
              </svg>
            </div>
          </div>

          <!-- Judul & Nama Penerima -->
          <div class="sertifikat-body">
            <div class="sertifikat-kicker">Surat Keterangan Kelulusan</div>
            <h1 class="sertifikat-main-title">Sertifikat Kompetensi</h1>

            <div class="sertifikat-ornament-line">
              <svg width="140" height="12" viewBox="0 0 140 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="0" y1="6" x2="56" y2="6" stroke="#8C7343" stroke-width="1"/>
                <polygon points="70,1 75,6 70,11 65,6" fill="#1F6F4A"/>
                <line x1="84" y1="6" x2="140" y2="6" stroke="#8C7343" stroke-width="1"/>
              </svg>
            </div>

            <p class="sertifikat-intro">Diberikan secara sah kepada:</p>
            <div class="sertifikat-penerima" id="sert-nama-peserta">Memuat...</div>

            <p class="sertifikat-desc">
              Telah menuntaskan seluruh modul pembelajaran mandiri dan dinyatakan lulus ujian akhir kompetensi pada program kursus:
            </p>
            <div class="sertifikat-kursus" id="sert-nama-kursus">Memuat kursus...</div>
          </div>

          <!-- Kaki Sertifikat -->
          <div class="sertifikat-foot">
            <!-- Metadata Nomor, Tanggal, Nilai -->
            <div class="sertifikat-meta-list">
              <div class="sertifikat-meta-row">
                <span class="sertifikat-meta-label">Nomor sertifikat</span>
                <span class="nomor-sertifikat" id="sert-nomor">S4L-2026-000123</span>
              </div>
              <div class="sertifikat-meta-row">
                <span class="sertifikat-meta-label">Tanggal terbit</span>
                <span class="sertifikat-meta-val angka-mono" id="sert-tanggal">15 November 2026</span>
              </div>
              <div class="sertifikat-meta-row">
                <span class="sertifikat-meta-label">Nilai evaluasi</span>
                <span class="sertifikat-meta-val angka-mono" style="color: #1F6F4A; font-weight: 600;" id="sert-nilai">90 / 100</span>
              </div>
            </div>

            <!-- QR Vector SVG Native -->
            <div class="sertifikat-qr-box">
              <a href="#" id="sert-qr-link" class="sertifikat-qr-link" title="Klik untuk verifikasi keaslian sertifikat">
                <svg width="54" height="54" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg" shape-rendering="crispEdges">
                  <rect width="21" height="21" fill="#FFFFFF"/>
                  <path fill="#1C1A17" d="M1 1h7v7H1V1zm1 1v5h5V2H2zm1 1h3v3H3V3zm10-2h7v7h-7V1zm1 1v5h5V2h-5zm1 1h3v3h-3V3zM1 13h7v7H1v-7zm1 1v5h5v-5H2zm1 1h3v3H3v-3zm6-14h1v2H9V1zm2 0h1v1h-1V1zm-1 3h2v1h-2V4zm-1 2h1v3H9V6zm2 2h1v2h-1V8zM1 9h2v1H1V9zm3 0h2v2H4V9zm3 1h1v2H7v-2zm2 1h3v1H9v-1zm4-2h2v1h-2V9zm3 0h4v1h-4V9zm-2 2h2v2h-2v-2zm3 1h3v2h-3v-2zm-7 1h2v3h-2v-3zm3 2h1v2h-1v-2zm2 1h2v2h-2v-2zm-5 2h2v2H9v-2zm4 0h1v2h-1v-2zm3 0h4v2h-4v-2z"/>
                </svg>
              </a>
              <span class="sertifikat-qr-caption">Pindai Verifikasi</span>
            </div>

            <!-- Tanda Tangan Pejabat Pengesah -->
            <div class="sertifikat-sign-box">
              <div class="sertifikat-signature-script" id="sert-signature-mark">Hendra Gunawan</div>
              <div class="sertifikat-signer-name" id="sert-signer-name">Dr. Ir. Hendra Gunawan, M.T.</div>
              <div class="sertifikat-signer-title" id="sert-signer-title">Direktur Pembina Skill4Life</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="module">
  import { ambilSertifikat } from '../assets/js/api.js';

  function formatTanggalID(tglStr) {
    if (!tglStr) return '';
    const d = new Date(tglStr);
    if (isNaN(d.getTime())) return tglStr;
    return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
  }

  document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const nomor = urlParams.get('nomor') || 'S4L-2026-000123';

    const sertifikat = await ambilSertifikat(nomor);

    if (sertifikat) {
      document.title = `Sertifikat ${sertifikat.nomor_sertifikat} - Skill4Life`;
      document.getElementById('sert-nama-peserta').textContent = sertifikat.nama_peserta;
      document.getElementById('sert-nama-kursus').textContent = sertifikat.nama_kursus;
      document.getElementById('sert-nomor').textContent = sertifikat.nomor_sertifikat;
      document.getElementById('sert-tanggal').textContent = formatTanggalID(sertifikat.tanggal_terbit);
      document.getElementById('sert-nilai').textContent = `${sertifikat.nilai_kuis || 90} / 100`;
      document.getElementById('sert-signer-name').textContent = sertifikat.penyelenggara_nama || 'Dr. Ir. Hendra Gunawan, M.T.';
      document.getElementById('sert-signer-title').textContent = sertifikat.penyelenggara_jabatan || 'Direktur Pembina Skill4Life';

      const linkVerif = `verifikasi.php?nomor=${encodeURIComponent(sertifikat.nomor_sertifikat)}`;
      document.getElementById('btn-cek-verifikasi-sert').href = linkVerif;
      document.getElementById('sert-qr-link').href = linkVerif;
    } else {
      document.getElementById('sert-nama-peserta').textContent = 'Nomor Tidak Terdaftar';
      document.getElementById('sert-nama-kursus').textContent = `Sertifikat ${nomor} tidak ditemukan`;
    }

    document.getElementById('btn-salin-tautan-sert').addEventListener('click', async function () {
      const urlVerifikasi = new URL(
        document.getElementById('btn-cek-verifikasi-sert').getAttribute('href') || window.location.href,
        window.location.href
      ).href;

      try {
        await navigator.clipboard.writeText(urlVerifikasi);
        const label = this.querySelector('span');
        const teksAsli = label.textContent;
        label.textContent = 'Tautan tersalin';
        if (typeof tampilkanToast === 'function') tampilkanToast('Tautan verifikasi disalin', 'sukses');
        setTimeout(() => {
          label.textContent = teksAsli;
        }, 2000);
      } catch (e) {}
    });

    document.getElementById('btn-cetak-sertifikat').addEventListener('click', () => {
      window.print();
    });

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>