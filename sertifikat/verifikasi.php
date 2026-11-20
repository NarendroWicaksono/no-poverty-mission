<?php
$baseUrl = '..';
$judulHalaman = 'Verifikasi Sertifikat - Skill4Life';
include __DIR__ . '/../includes/header.php';
?>

<div style="background-color: var(--latar); border-bottom: 1px solid var(--garis); padding: var(--spasi-40) 0;">
  <div class="wadah wadah-baca">
    <div style="font-size: var(--teks-12); font-weight: 500; color: var(--aksen); margin-bottom: var(--spasi-4);">
      Layanan publik terbuka
    </div>
    <h1 style="font-size: var(--teks-40); font-family: var(--font-serif); margin-bottom: var(--spasi-8);">
      Verifikasi sertifikat
    </h1>
    <p style="font-size: var(--teks-16); color: var(--teks-2);">
      Periksa keabsahan surat keterangan kelulusan peserta Skill4Life menggunakan nomor unik sertifikat.
    </p>
  </div>
</div>

<div class="wadah wadah-baca" style="padding-top: var(--spasi-32); padding-bottom: var(--spasi-64);">
  <!-- Formulir Pencarian Nomor Sertifikat -->
  <div class="kartu" style="margin-bottom: var(--spasi-24);">
    <div class="bidang-grup" style="margin-bottom: var(--spasi-12);">
      <label class="bidang-label" for="input-cari-nomor">
        Nomor sertifikat
      </label>
      <div style="display: flex; gap: var(--spasi-8);">
        <input
          type="text"
          id="input-cari-nomor"
          class="bidang-input"
          placeholder="Contoh: S4L-2026-000123"
          style="flex: 1; font-family: var(--font-mono);"
        >
        <button type="button" id="btn-cek-verifikasi" class="tombol tombol-utama">
          Cek status
        </button>
      </div>
      <div class="bidang-bantuan">
        Format nomor berupa S4L diikuti tahun dan 6 digit nomor seri unik.
      </div>
    </div>

    <!-- Tautan Contoh Cepat (Termasuk sertifikat terbaru jika ada) -->
    <div id="daftar-contoh-nomor" style="font-size: var(--teks-12); color: var(--teks-3); display: flex; gap: var(--spasi-8); align-items: center; flex-wrap: wrap;">
      <span>Contoh nomor aktif:</span>
    </div>
  </div>

  <!-- Area Hasil Verifikasi -->
  <div id="hasil-verifikasi-container">
    <div class="kartu" style="background-color: var(--permukaan-2); border-style: dashed; text-align: center; padding: var(--spasi-32);">
      <div style="font-size: var(--teks-14); color: var(--teks-2);">
        Masukkan nomor sertifikat pada kolom di atas untuk menampilkan data kelulusan peserta.
      </div>
    </div>
  </div>
</div>

<script type="module">
  import { ambilSertifikat, ambilSemuaSertifikat } from '../assets/js/api.js';

  const inputNomor = document.getElementById('input-cari-nomor');
  const btnCek = document.getElementById('btn-cek-verifikasi');
  const hasilArea = document.getElementById('hasil-verifikasi-container');
  const contohWrap = document.getElementById('daftar-contoh-nomor');

  async function muatContohNomor() {
    const semua = await ambilSemuaSertifikat();
    const pilihan = semua.slice(0, 4);
    contohWrap.innerHTML = '<span>Contoh nomor aktif:</span>' + pilihan.map(s => `
      <button type="button" class="btn-contoh-nomor" data-nomor="${s.nomor_sertifikat}" style="background: none; border: 0; color: var(--aksen); text-decoration: underline; cursor: pointer; font-size: inherit; font-family: var(--font-mono);">
        ${s.nomor_sertifikat}
      </button>
    `).join('<span style="color: var(--garis-tegas);">·</span>');

    contohWrap.querySelectorAll('.btn-contoh-nomor').forEach(b => {
      b.addEventListener('click', () => {
        inputNomor.value = b.dataset.nomor;
        prosesVerifikasi(b.dataset.nomor);
      });
    });
  }

  async function prosesVerifikasi(nomor) {
    const bersih = nomor.trim();
    if (!bersih) {
      hasilArea.innerHTML = `
        <div class="pesan-status pesan-status-galat">
          Masukkan nomor sertifikat terlebih dahulu.
        </div>
      `;
      return;
    }

    const data = await ambilSertifikat(bersih);

    if (data) {
      hasilArea.innerHTML = `
        <div class="kartu" style="border-left: 3px solid var(--aksen);">
          <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-16); margin-bottom: var(--spasi-16);">
            <div>
              <div style="font-size: var(--teks-12); color: var(--aksen); font-weight: 500;">Status verifikasi: Sah</div>
              <h2 style="font-size: var(--teks-20); font-weight: 500; color: var(--teks); margin-top: var(--spasi-4);">
                Sertifikat terdaftar resmi
              </h2>
            </div>
            <img src="../assets/img/segel-resmi.svg" alt="Segel resmi kelulusan" class="segel-s4l" style="width: 44px; height: 44px;">
          </div>

          <div style="display: flex; flex-direction: column; gap: var(--spasi-12); font-size: var(--teks-14);">
            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-8);">
              <span style="color: var(--teks-3);">Nama penerima</span>
              <span style="font-weight: 500; color: var(--teks);">${data.nama_peserta}</span>
            </div>
            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-8);">
              <span style="color: var(--teks-3);">Kursus kompetensi</span>
              <span style="font-weight: 500; color: var(--teks);">${data.nama_kursus}</span>
            </div>
            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-8);">
              <span style="color: var(--teks-3);">Nomor sertifikat</span>
              <span class="angka-mono" style="font-weight: 500; color: var(--teks);">${data.nomor_sertifikat}</span>
            </div>
            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-8);">
              <span style="color: var(--teks-3);">Tanggal terbit</span>
              <span class="angka-mono">${data.tanggal_terbit}</span>
            </div>
            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-8);">
              <span style="color: var(--teks-3);">Nilai kelulusan</span>
              <span class="angka-mono">${data.nilai_kuis || 90} / 100</span>
            </div>
            <div style="display: flex; justify-content: space-between; gap: var(--spasi-16);">
              <span style="color: var(--teks-3); flex-shrink: 0;">Kode verifikasi hash</span>
              <span class="angka-mono" style="font-size: var(--teks-12); color: var(--teks-3); word-break: break-all; text-align: right;">${data.kode_verifikasi}</span>
            </div>
          </div>

          <div style="margin-top: var(--spasi-20); padding-top: var(--spasi-16); border-top: 1px solid var(--garis); text-align: right;">
            <a href="lihat.php?nomor=${data.nomor_sertifikat}" class="tombol tombol-sekunder tombol-kecil">
              Buka tampilan dokumen &rarr;
            </a>
          </div>
        </div>
      `;
    } else {
      hasilArea.innerHTML = `
        <div class="kartu" style="border-left: 3px solid var(--galat);">
          <div style="font-size: var(--teks-12); color: var(--galat); font-weight: 500; margin-bottom: var(--spasi-4);">Status verifikasi: Tidak ditemukan</div>
          <h2 style="font-size: var(--teks-20); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-8);">
            Nomor sertifikat tidak tercatat
          </h2>
          <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: 1.5;">
            Nomor "${bersih}" tidak ditemukan dalam pangkalan data Skill4Life. Mohon periksa kembali nomor yang tertera pada bagian sudut kiri bawah lembar sertifikat Anda.
          </p>
        </div>
      `;
    }
  }

  btnCek.addEventListener('click', () => prosesVerifikasi(inputNomor.value));
  inputNomor.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') prosesVerifikasi(inputNomor.value);
  });

  document.addEventListener('DOMContentLoaded', async () => {
    await muatContohNomor();
    const urlParams = new URLSearchParams(window.location.search);
    const paramNomor = urlParams.get('nomor');
    if (paramNomor) {
      inputNomor.value = paramNomor;
      prosesVerifikasi(paramNomor);
    }
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
