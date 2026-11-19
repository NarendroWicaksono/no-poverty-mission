<?php
$baseUrl = '..';
$judulHalaman = 'Kuis Akhir Kelulusan - Skill4Life';
include __DIR__ . '/../includes/header.php';
?>

<div class="wadah-baca" style="padding-top: var(--spasi-48); padding-bottom: var(--spasi-64);">
  <!-- Header Kuis Tenang -->
  <div style="margin-bottom: var(--spasi-24); border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-16);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spasi-8);">
      <a href="javascript:history.back()" style="font-size: var(--teks-12); color: var(--teks-3);">&larr; Kembali ke materi</a>
      <span class="angka-mono" style="font-size: var(--teks-12); color: var(--teks-3);" id="indikator-langkah">Soal 1 dari 10</span>
    </div>

    <h1 style="font-size: var(--teks-28); font-family: var(--font-serif); color: var(--teks);" id="judul-kuis-kursus">
      Kuis akhir kelulusan
    </h1>
    <p style="font-size: var(--teks-14); color: var(--teks-2); margin-top: var(--spasi-4);">
      Jawab 10 butir pertanyaan berikut. Nilai kelulusan minimal 70 untuk menerbitkan sertifikat.
    </p>

    <!-- Bilah Progres Pengerjaan Soal -->
    <div class="bilah-progres" style="margin-top: var(--spasi-16);">
      <div class="bilah-progres-isi" id="bilah-progres-kuis" style="width: 10%;"></div>
    </div>
  </div>

  <!-- Tampilan Fokus Satu Soal Per Layar -->
  <div id="wadah-kartu-soal" class="kartu">
    <!-- Konten Soal Aktif Dimuat via JS -->
    <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-8);" id="label-nomor-soal">
      Nomor 1
    </div>
    <div style="font-size: var(--teks-16); font-weight: 500; color: var(--teks); line-height: 1.5; margin-bottom: var(--spasi-20);" id="teks-pertanyaan-aktif">
      Memuat pertanyaan...
    </div>

    <!-- Pilihan Jawaban A, B, C, D -->
    <div style="display: flex; flex-direction: column; gap: var(--spasi-8);" id="daftar-opsi-jawaban">
      <!-- Opsi radio dimuat dinamis -->
    </div>

    <!-- Tombol Navigasi Soal -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: var(--spasi-32); padding-top: var(--spasi-16); border-top: 1px solid var(--garis);">
      <button id="btn-soal-sebelumnya" class="tombol tombol-sekunder tombol-kecil" style="visibility: hidden;">
        &larr; Soal sebelumnya
      </button>

      <button id="btn-soal-selanjutnya" class="tombol tombol-utama tombol-kecil">
        Soal selanjutnya &rarr;
      </button>
    </div>
  </div>

  <!-- Hasil Evaluasi Kuis (Tampil setelah submit) -->
  <div id="wadah-hasil-kuis" class="kartu" style="display: none; padding: var(--spasi-32);">
    <div style="text-align: center; margin-bottom: var(--spasi-24);">
      <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">Hasil evaluasi kuis</div>
      <div class="angka-mono" style="font-size: var(--teks-56); font-weight: 500; color: var(--aksen); line-height: 1.1;" id="hasil-nilai-angka">
        0
      </div>
      <div style="font-size: var(--teks-14); color: var(--teks-2); margin-top: var(--spasi-8);" id="hasil-keterangan">
        Evaluasi kelulusan
      </div>
    </div>

    <div id="hasil-aksi-area" style="text-align: center; margin-bottom: var(--spasi-32);">
      <!-- Tombol sertifikat atau coba lagi -->
    </div>

    <div style="border-top: 1px solid var(--garis); padding-top: var(--spasi-20);">
      <h3 style="font-size: var(--teks-16); font-weight: 500; margin-bottom: var(--spasi-16);">
        Pembahasan jawaban
      </h3>
      <div id="daftar-pembahasan-soal" style="display: flex; flex-direction: column; gap: var(--spasi-16);">
        <!-- Dimuat dinamis -->
      </div>
    </div>
  </div>
</div>

<script type="module">
  import { ambilSoalKuis, ambilDetailKursus, kirimHasilKuis } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get('slug') || 'microsoft-excel-dasar';

    const kursus = await ambilDetailKursus(slug);
    const daftarSoal = await ambilSoalKuis(slug);

    if (!daftarSoal.length) {
      alert("Soal kuis tidak ditemukan.");
      window.location.href = `detail.php?slug=${slug}`;
      return;
    }

    if (kursus) {
      document.getElementById('judul-kuis-kursus').textContent = `Kuis akhir: ${kursus.judul}`;
    }

    let indeksAktif = 0;
    const jawabanTersimpan = {}; // { [id_soal]: "A" }

    const wadahSoal = document.getElementById('wadah-kartu-soal');
    const wadahHasil = document.getElementById('wadah-hasil-kuis');
    const labelLangkah = document.getElementById('indikator-langkah');
    const bilahProgres = document.getElementById('bilah-progres-kuis');
    const labelNomor = document.getElementById('label-nomor-soal');
    const teksPertanyaan = document.getElementById('teks-pertanyaan-aktif');
    const containerOpsi = document.getElementById('daftar-opsi-jawaban');
    const btnPrev = document.getElementById('btn-soal-sebelumnya');
    const btnNext = document.getElementById('btn-soal-selanjutnya');

    function tampilkanSoal(idx) {
      const soal = daftarSoal[idx];
      labelLangkah.textContent = `Soal ${idx + 1} dari ${daftarSoal.length}`;
      bilahProgres.style.width = `${((idx + 1) / daftarSoal.length) * 100}%`;
      labelNomor.textContent = `Pertanyaan ${idx + 1}`;
      teksPertanyaan.textContent = soal.pertanyaan;

      // Render 4 Opsi Jawaban
      containerOpsi.innerHTML = ['A', 'B', 'C', 'D'].map(kunci => {
        const terpilih = jawabanTersimpan[soal.id] === kunci;
        return `
          <label style="display: flex; align-items: center; gap: var(--spasi-12); padding: var(--spasi-12); border: 1px solid ${terpilih ? 'var(--aksen)' : 'var(--garis)'}; background-color: ${terpilih ? 'var(--aksen-tipis)' : 'var(--permukaan)'}; border-radius: var(--radius-kontrol); cursor: pointer; transition: var(--transisi-cepat);">
            <input type="radio" name="opsi_soal_${soal.id}" value="${kunci}" ${terpilih ? 'checked' : ''} style="accent-color: var(--aksen);">
            <span class="angka-mono" style="font-size: var(--teks-12); font-weight: 500; color: var(--teks);">${kunci}.</span>
            <span style="font-size: var(--teks-14); color: var(--teks);">${soal.pilihan[kunci]}</span>
          </label>
        `;
      }).join('');

      // Pasang event change
      containerOpsi.querySelectorAll('input').forEach(input => {
        input.addEventListener('change', (e) => {
          jawabanTersimpan[soal.id] = e.target.value;
          tampilkanSoal(idx);
        });
      });

      // Kontrol Tombol Sebelumnya
      if (idx > 0) {
        btnPrev.style.visibility = 'visible';
      } else {
        btnPrev.style.visibility = 'hidden';
      }

      // Kontrol Tombol Selanjutnya / Selesai
      if (idx === daftarSoal.length - 1) {
        btnNext.textContent = 'Kirim jawaban & selesaikan kuis';
      } else {
        btnNext.textContent = 'Soal selanjutnya \u2192';
      }
    }

    btnPrev.addEventListener('click', () => {
      if (indeksAktif > 0) {
        indeksAktif--;
        tampilkanSoal(indeksAktif);
      }
    });

    btnNext.addEventListener('click', async () => {
      if (indeksAktif < daftarSoal.length - 1) {
        indeksAktif++;
        tampilkanSoal(indeksAktif);
      } else {
        // Kirim evaluasi kuis
        const jumlahDijawab = Object.keys(jawabanTersimpan).length;
        if (jumlahDijawab < daftarSoal.length) {
          if (!confirm(`Anda baru menjawab ${jumlahDijawab} dari ${daftarSoal.length} soal. Yakin ingin mengirim lembar jawaban?`)) {
            return;
          }
        }

        const hasil = await kirimHasilKuis(slug, jawabanTersimpan);
        wadahSoal.style.display = 'none';
        wadahHasil.style.display = 'block';

        document.getElementById('hasil-nilai-angka').textContent = hasil.nilai;
        const ketEl = document.getElementById('hasil-keterangan');
        const aksiEl = document.getElementById('hasil-aksi-area');

        if (hasil.lulus) {
          ketEl.textContent = `Lulus (${hasil.jawaban_benar} dari ${hasil.total_soal} benar). Nilai minimal 70 terpenuhi.`;
          aksiEl.innerHTML = `
            <a href="../sertifikat/lihat.php?nomor=${hasil.nomor_sertifikat}" class="tombol tombol-utama">
              Buka sertifikat resmi (${hasil.nomor_sertifikat}) &rarr;
            </a>
          `;
        } else {
          ketEl.textContent = `Belum lulus (${hasil.jawaban_benar} dari ${hasil.total_soal} benar). Nilai minimal kelulusan adalah 70.`;
          aksiEl.innerHTML = `
            <button onclick="window.location.reload()" class="tombol tombol-sekunder">
              Ulangi pengerjaan kuis
            </button>
          `;
        }

        // Tampilkan Pembahasan Tiap Butir Soal
        const pembEl = document.getElementById('daftar-pembahasan-soal');
        pembEl.innerHTML = hasil.evaluasi.map((ev, i) => `
          <div style="border: 1px solid var(--garis); border-radius: var(--radius-kontrol); padding: var(--spasi-12) var(--spasi-16); background-color: ${ev.is_benar ? 'var(--permukaan)' : 'var(--permukaan-2)'};">
            <div style="font-size: var(--teks-12); color: ${ev.is_benar ? 'var(--sukses)' : 'var(--galat)'}; font-weight: 500; margin-bottom: var(--spasi-4);">
              Soal ${i + 1}: ${ev.is_benar ? 'Jawaban Anda benar' : 'Jawaban Anda belum tepat'} (Kunci: ${ev.kunci_benar})
            </div>
            <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: 1.5;">
              ${ev.pembahasan}
            </p>
          </div>
        `).join('');
      }
    });

    tampilkanSoal(0);
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
