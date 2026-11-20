<?php
$baseUrl = '..';
$judulHalaman = 'Sertifikat Kelulusan Resmi - Skill4Life';
include __DIR__ . '/../includes/header.php';
?>

<div style="background-color: var(--latar); padding: var(--spasi-32) 0 var(--spasi-64);">
  <div class="wadah">
    <!-- Bar Aksi Atas (Tersembunyi saat Cetak) -->
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 900px; margin: 0 auto var(--spasi-20); flex-wrap: wrap; gap: var(--spasi-12);" class="tidak-dicetak">
      <a href="<?= $baseUrl ?>/dashboard/index.php" style="font-size: var(--teks-12); color: var(--teks-3);">
        &larr; Kembali ke dashboard
      </a>
      <div style="display: flex; gap: var(--spasi-8);">
        <a href="#" id="btn-cek-verifikasi-sert" class="tombol tombol-sekunder tombol-kecil">
          Verifikasi publik
        </a>
        <button type="button" id="btn-cetak-sertifikat" class="tombol tombol-utama tombol-kecil">
          Cetak / Simpan PDF
        </button>
      </div>
    </div>

    <!-- Lembar Fisik Sertifikat Kertas (Landscape A4) -->
    <div id="area-cetak-sertifikat">
      <div class="lembar-sertifikat">
        <div class="sertifikat-garis-dalam">
          <!-- Kepala Sertifikat -->
          <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(28, 26, 23, 0.12); padding-bottom: var(--spasi-16); margin-bottom: var(--spasi-32);">
            <div style="text-align: left;">
              <div style="font-family: var(--font-ui); font-size: var(--teks-16); font-weight: 600; color: var(--teks);">
                Skill<span style="color: var(--aksen);">4</span>Life
              </div>
              <div style="font-size: var(--teks-12); color: var(--teks-3);">
                Prakarsa pelatihan kerja SDG 1 No Poverty
              </div>
            </div>

            <!-- Cap Segel Bulat Resmi Khas S4L -->
            <img src="<?= $baseUrl ?>/assets/img/segel-resmi.svg" alt="Segel resmi kelulusan" class="segel-s4l" style="width: 52px; height: 52px;">
          </div>

          <!-- Judul Lembar Sertifikat -->
          <div style="margin-bottom: var(--spasi-24);">
            <div style="font-size: var(--teks-12); color: var(--teks-3); letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: var(--spasi-4);">
              Surat keterangan kelulusan
            </div>
            <h1 style="font-family: var(--font-serif); font-size: var(--teks-28); font-weight: 600; color: var(--teks);">
              Sertifikat kompetensi
            </h1>
          </div>

          <!-- Pernyataan & Nama Penerima (Font Serif Besar) -->
          <div style="margin-bottom: var(--spasi-32);">
            <p style="font-size: var(--teks-14); color: var(--teks-2); margin-bottom: var(--spasi-12);">
              Diberikan secara sah kepada:
            </p>
            <div class="sertifikat-penerima" style="font-size: var(--teks-40); color: var(--aksen); margin-bottom: var(--spasi-12);" id="sert-nama-peserta">
              Memuat...
            </div>
            <p style="font-size: var(--teks-14); color: var(--teks-2); max-width: 620px; margin: 0 auto; line-height: var(--jarak-baris-baca);">
              Telah menuntaskan seluruh modul pembelajaran mandiri dan dinyatakan lulus ujian akhir kompetensi pada kursus:
            </p>
            <div style="font-size: var(--teks-20); font-weight: 500; color: var(--teks); margin-top: var(--spasi-8);" id="sert-nama-kursus">
              Memuat kursus...
            </div>
          </div>

          <!-- Kaki Sertifikat: Tanda Tangan, QR SVG Native, Nomor Mono -->
          <div style="display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid rgba(28, 26, 23, 0.12); padding-top: var(--spasi-24); margin-top: var(--spasi-32); text-align: left;">
            <!-- Informasi Nomor & Verifikasi -->
            <div>
              <div style="font-size: var(--teks-12); color: var(--teks-3);">Nomor sertifikat:</div>
              <div class="nomor-sertifikat" style="font-size: var(--teks-14); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-8);" id="sert-nomor">
                S4L-2026-000123
              </div>
              <div style="font-size: var(--teks-12); color: var(--teks-3);">
                Tanggal terbit: <span id="sert-tanggal" class="angka-mono">15 November 2026</span>
              </div>
              <div style="font-size: var(--teks-12); color: var(--teks-3); margin-top: var(--spasi-4);">
                Nilai evaluasi: <span id="sert-nilai" class="angka-mono">90 / 100</span>
              </div>
            </div>

            <!-- QR Vector SVG Native (Tautan ke halaman verifikasi) -->
            <a href="#" id="sert-qr-link" title="Klik untuk verifikasi keaslian sertifikat" style="display: inline-block; border: 1px solid var(--garis); padding: 4px; background: #FFFFFF;">
              <svg width="56" height="56" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg" shape-rendering="crispEdges">
                <rect width="21" height="21" fill="#FFFFFF"/>
                <path fill="#1C1A17" d="M1 1h7v7H1V1zm1 1v5h5V2H2zm1 1h3v3H3V3zm10-2h7v7h-7V1zm1 1v5h5V2h-5zm1 1h3v3h-3V3zM1 13h7v7H1v-7zm1 1v5h5v-5H2zm1 1h3v3H3v-3zm6-14h1v2H9V1zm2 0h1v1h-1V1zm-1 3h2v1h-2V4zm-1 2h1v3H9V6zm2 2h1v2h-1V8zM1 9h2v1H1V9zm3 0h2v2H4V9zm3 1h1v2H7v-2zm2 1h3v1H9v-1zm4-2h2v1h-2V9zm3 0h4v1h-4V9zm-2 2h2v2h-2v-2zm3 1h3v2h-3v-2zm-7 1h2v3h-2v-3zm3 2h1v2h-1v-2zm2 1h2v2h-2v-2zm-5 2h2v2H9v-2zm4 0h1v2h-1v-2zm3 0h4v2h-4v-2z"/>
              </svg>
            </a>

            <!-- Tanda Tangan Pejabat Pengesah -->
            <div style="text-align: right;">
              <div style="font-family: var(--font-serif); font-size: var(--teks-20); color: var(--teks); font-style: italic; margin-bottom: var(--spasi-8);">
                Hendra Gunawan
              </div>
              <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);" id="sert-signer-name">
                Dr. Ir. Hendra Gunawan, M.T.
              </div>
              <div style="font-size: var(--teks-12); color: var(--teks-3);" id="sert-signer-title">
                Direktur Pembina Skill4Life
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
@page {
  size: A4 landscape;
  margin: 10mm;
}

@media print {
  body {
    background: #FFFFFF !important;
  }
  body * {
    visibility: hidden;
  }
  #area-cetak-sertifikat, #area-cetak-sertifikat * {
    visibility: visible;
  }
  #area-cetak-sertifikat {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    margin: 0;
    padding: 0;
  }
  .lembar-sertifikat {
    box-shadow: inset 0 0 0 8px #FCFBF9, inset 0 0 0 9px #C7C2B2 !important;
    border: 1px solid #999 !important;
    max-width: 100% !important;
  }
  .tidak-dicetak, .nav-utama, .kaki-halaman {
    display: none !important;
  }
}
</style>

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

    document.getElementById('btn-cetak-sertifikat').addEventListener('click', () => {
      window.print();
    });
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
