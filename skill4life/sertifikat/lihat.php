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
        <button id="btn-cetak-sertifikat" class="tombol tombol-sekunder tombol-kecil">
          Cetak dokumen
        </button>
        <button id="btn-unduh-pdf" class="tombol tombol-utama tombol-kecil">
          Unduh berkas PDF
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
              Budi Santoso
            </div>
            <p style="font-size: var(--teks-14); color: var(--teks-2); max-width: 620px; margin: 0 auto; line-height: var(--jarak-baris-baca);">
              Telah menuntaskan seluruh modul pembelajaran mandiri dan dinyatakan lulus ujian akhir kompetensi pada kursus:
            </p>
            <div style="font-size: var(--teks-20); font-weight: 500; color: var(--teks); margin-top: var(--spasi-8);" id="sert-nama-kursus">
              Menulis CV dan surat lamaran kerja
            </div>
          </div>

          <!-- Kaki Sertifikat: Tanda Tangan, QR Dummy, Nomor Mono -->
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
                Verifikasi keaslian: <span class="angka-mono">skill4life.id/verifikasi</span>
              </div>
            </div>

            <!-- QR Code Dummy Kode Bersih -->
            <div style="width: 60px; height: 60px; border: 1px solid var(--garis); padding: 4px; background: white; display: flex; align-items: center; justify-content: center; font-family: var(--font-mono); font-size: 8px; text-align: center; color: var(--teks-3);">
              QR-S4L
            </div>

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
@media print {
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
    box-shadow: none !important;
    border: 1px solid #999 !important;
  }
  .tidak-dicetak, .nav-utama, .kaki-halaman {
    display: none !important;
  }
}
</style>

<script type="module">
  import { ambilSertifikat } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const nomor = urlParams.get('nomor') || 'S4L-2026-000123';

    const sertifikat = await ambilSertifikat(nomor);

    if (sertifikat) {
      document.title = `Sertifikat ${sertifikat.nomor_sertifikat} - Skill4Life`;
      document.getElementById('sert-nama-peserta').textContent = sertifikat.nama_peserta;
      document.getElementById('sert-nama-kursus').textContent = sertifikat.nama_kursus;
      document.getElementById('sert-nomor').textContent = sertifikat.nomor_sertifikat;
      document.getElementById('sert-tanggal').textContent = sertifikat.tanggal_terbit;
      document.getElementById('sert-signer-name').textContent = sertifikat.penyelenggara_nama || "Dr. Ir. Hendra Gunawan, M.T.";
      document.getElementById('sert-signer-title').textContent = sertifikat.penyelenggara_jabatan || "Direktur Pembina Skill4Life";
    }

    // Tombol Cetak
    document.getElementById('btn-cetak-sertifikat').addEventListener('click', () => {
      window.print();
    });

    // Tombol Unduh PDF via html2pdf
    document.getElementById('btn-unduh-pdf').addEventListener('click', () => {
      const elemen = document.querySelector('.lembar-sertifikat');
      if (typeof html2pdf !== 'undefined' && elemen) {
        const opsi = {
          margin: [10, 10, 10, 10],
          filename: `Sertifikat_${nomor}.pdf`,
          image: { type: 'jpeg', quality: 0.98 },
          html2canvas: { scale: 2, useCORS: true },
          jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };
        html2pdf().set(opsi).from(elemen).save();
      } else {
        window.print();
      }
    });
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
