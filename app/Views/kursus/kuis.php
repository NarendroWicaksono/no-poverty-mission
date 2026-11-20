<div class="wadah-baca" style="padding-top: var(--spasi-48); padding-bottom: var(--spasi-64);">
  <!-- Header Kuis Tenang -->
  <div style="margin-bottom: var(--spasi-24); border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-16);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spasi-8);">
      <a href="#" id="link-kembali-materi" style="font-size: var(--teks-12); color: var(--teks-3);">&larr; Kembali ke materi</a>
      <span class="angka-mono" style="font-size: var(--teks-12); color: var(--teks-3);" id="indikator-langkah">Soal 1 dari 10</span>
    </div>

    <h1 style="font-size: var(--teks-28); font-family: var(--font-serif); color: var(--teks);" id="judul-kuis-kursus">
      Kuis akhir kelulusan
    </h1>
    <p style="font-size: var(--teks-14); color: var(--teks-2); margin-top: var(--spasi-4);">
      Jawab seluruh pertanyaan berikut. Nilai kelulusan minimal 70 untuk menerbitkan sertifikat resmi.
    </p>

    <!-- Bilah Progres Pengerjaan Soal -->
    <div class="bilah-progres" style="margin-top: var(--spasi-16);">
      <div class="bilah-progres-isi" id="bilah-progres-kuis" style="width: 10%;"></div>
    </div>

    <!-- Kotak Navigasi Nomor Soal -->
    <div class="kuis-nav-grid" id="kuis-navigator-nomor" aria-label="Navigasi nomor soal">
      <!-- Diisi dinamis via JS -->
    </div>
  </div>

  <!-- Tampilan Fokus Satu Soal Per Layar -->
  <div id="wadah-kartu-soal" class="kartu">
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
      <button type="button" id="btn-soal-sebelumnya" class="tombol tombol-sekunder tombol-kecil" style="visibility: hidden;">
        &larr; Soal sebelumnya
      </button>

      <button type="button" id="btn-soal-selanjutnya" class="tombol tombol-utama tombol-kecil">
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

    <div id="hasil-aksi-area" style="text-align: center; margin-bottom: var(--spasi-32); display: flex; justify-content: center; gap: var(--spasi-12); flex-wrap: wrap;">
      <!-- Tombol sertifikat atau coba lagi -->
    </div>

    <div style="border-top: 1px solid var(--garis); padding-top: var(--spasi-20);">
      <h3 style="font-size: var(--teks-16); font-weight: 500; margin-bottom: var(--spasi-16);">
        Pembahasan jawaban lengkap
      </h3>
      <div id="daftar-pembahasan-soal" style="display: flex; flex-direction: column; gap: var(--spasi-16);">
        <!-- Dimuat dinamis -->
      </div>
    </div>
  </div>
</div>

<script type="module">
  import { ambilSesiPengguna, ambilSoalKuis, ambilDetailKursus, kirimHasilKuis } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const sesi = ambilSesiPengguna();
    if (!sesi) {
      window.location.href = '../auth/login.php?pesan=harap_login';
      return;
    }

    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get('slug') || 'microsoft-excel-dasar';

    document.getElementById('link-kembali-materi').href = `belajar.php?slug=${slug}&modul=1`;

    const [kursus, daftarSoal] = await Promise.all([
      ambilDetailKursus(slug),
      ambilSoalKuis(slug)
    ]);

    if (!daftarSoal.length) {
      alert('Soal kuis untuk kursus ini belum tersedia.');
      window.location.href = `detail.php?slug=${slug}`;
      return;
    }

    if (kursus) {
      document.getElementById('judul-kuis-kursus').textContent = `Kuis akhir: ${kursus.judul}`;
    }

    let indeksAktif = 0;
    const jawabanTersimpan = {};

    const wadahSoal = document.getElementById('wadah-kartu-soal');
    const wadahHasil = document.getElementById('wadah-hasil-kuis');
    const labelLangkah = document.getElementById('indikator-langkah');
    const bilahProgres = document.getElementById('bilah-progres-kuis');
    const navNomorEl = document.getElementById('kuis-navigator-nomor');
    const labelNomor = document.getElementById('label-nomor-soal');
    const teksPertanyaan = document.getElementById('teks-pertanyaan-aktif');
    const containerOpsi = document.getElementById('daftar-opsi-jawaban');
    const btnPrev = document.getElementById('btn-soal-sebelumnya');
    const btnNext = document.getElementById('btn-soal-selanjutnya');

    function renderNavigator() {
      navNomorEl.innerHTML = daftarSoal.map((s, i) => {
        const isAktif = i === indeksAktif;
        const isTerjawab = Boolean(jawabanTersimpan[s.id]);
        const cls = isAktif ? 'aktif' : (isTerjawab ? 'terjawab' : '');
        return `<button type="button" class="kuis-nav-btn ${cls}" data-idx="${i}">${i + 1}</button>`;
      }).join('');

      navNomorEl.querySelectorAll('.kuis-nav-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          indeksAktif = Number(btn.dataset.idx);
          tampilkanSoal(indeksAktif);
        });
      });
    }

    function tampilkanSoal(idx) {
      indeksAktif = idx;
      const soal = daftarSoal[idx];
      const terjawabCount = Object.keys(jawabanTersimpan).length;

      labelLangkah.textContent = `Soal ${idx + 1} dari ${daftarSoal.length} (${terjawabCount} terjawab)`;
      bilahProgres.style.width = `${((idx + 1) / daftarSoal.length) * 100}%`;
      labelNomor.textContent = `Pertanyaan ${idx + 1}`;
      teksPertanyaan.textContent = soal.pertanyaan;

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

      containerOpsi.querySelectorAll('input').forEach(input => {
        input.addEventListener('change', (e) => {
          jawabanTersimpan[soal.id] = e.target.value;
          tampilkanSoal(idx);
        });
      });

      btnPrev.style.visibility = idx > 0 ? 'visible' : 'hidden';
      btnNext.textContent = idx === daftarSoal.length - 1
        ? 'Kirim jawaban & selesaikan kuis'
        : 'Soal selanjutnya \u2192';

      renderNavigator();
    }

    btnPrev.addEventListener('click', () => {
      if (indeksAktif > 0) {
        tampilkanSoal(indeksAktif - 1);
      }
    });

    btnNext.addEventListener('click', async () => {
      if (indeksAktif < daftarSoal.length - 1) {
        tampilkanSoal(indeksAktif + 1);
      } else {
        const jumlahDijawab = Object.keys(jawabanTersimpan).length;
        if (jumlahDijawab < daftarSoal.length) {
          if (!confirm(`Anda baru menjawab ${jumlahDijawab} dari ${daftarSoal.length} soal. Yakin ingin mengirim lembar jawaban?`)) {
            return;
          }
        }

        const hasil = await kirimHasilKuis(slug, jawabanTersimpan);
        if (hasil.butuh_login) {
          window.location.href = '../auth/login.php?pesan=harap_login';
          return;
        }

        wadahSoal.style.display = 'none';
        navNomorEl.style.display = 'none';
        wadahHasil.style.display = 'block';

        const angkaEl = document.getElementById('hasil-nilai-angka');
        angkaEl.textContent = hasil.nilai;
        angkaEl.style.color = hasil.lulus ? 'var(--aksen)' : 'var(--galat)';

        const ketEl = document.getElementById('hasil-keterangan');
        const aksiEl = document.getElementById('hasil-aksi-area');

        if (hasil.lulus && hasil.nomor_sertifikat) {
          ketEl.textContent = `Lulus (${hasil.jawaban_benar} dari ${hasil.total_soal} benar). Nilai minimal 70 terpenuhi.`;
          aksiEl.innerHTML = `
            <a href="../sertifikat/lihat.php?nomor=${hasil.nomor_sertifikat}" class="tombol tombol-utama">
              Buka sertifikat resmi (${hasil.nomor_sertifikat}) &rarr;
            </a>
            <a href="../dashboard/index.php" class="tombol tombol-sekunder">
              Ke dashboard saya
            </a>
          `;
        } else {
          ketEl.textContent = `Belum lulus (${hasil.jawaban_benar} dari ${hasil.total_soal} benar). Nilai minimal kelulusan adalah 70.`;
          aksiEl.innerHTML = `
            <button type="button" onclick="window.location.reload()" class="tombol tombol-utama">
              Ulangi pengerjaan kuis
            </button>
            <a href="belajar.php?slug=${slug}&modul=1" class="tombol tombol-sekunder">
              Pelajari ulang materi
            </a>
          `;
        }

        const pembEl = document.getElementById('daftar-pembahasan-soal');
        pembEl.innerHTML = (hasil.evaluasi || []).map(ev => `
          <div style="border: 1px solid var(--garis); border-left: 3px solid ${ev.is_benar ? 'var(--sukses)' : 'var(--galat)'}; border-radius: var(--radius-kontrol); padding: var(--spasi-16); background-color: var(--permukaan);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spasi-8); flex-wrap: wrap; gap: var(--spasi-8);">
              <span style="font-size: var(--teks-12); color: ${ev.is_benar ? 'var(--sukses)' : 'var(--galat)'}; font-weight: 600;">
                Soal ${ev.nomor}: ${ev.is_benar ? 'Jawaban benar' : 'Jawaban belum tepat'}
              </span>
              <span class="angka-mono" style="font-size: var(--teks-12); color: var(--teks-3);">
                Kunci: ${ev.kunci_benar}
              </span>
            </div>
            <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-8);">
              ${ev.pertanyaan}
            </div>
            <div style="font-size: var(--teks-12); color: var(--teks-2); margin-bottom: var(--spasi-8);">
              <div>Jawaban Anda: <strong>${ev.jawaban_peserta ? ev.jawaban_peserta + '. ' : ''}${ev.teks_jawaban_peserta}</strong></div>
              ${!ev.is_benar ? `<div style="color: var(--sukses);">Jawaban Benar: <strong>${ev.kunci_benar}. ${ev.teks_kunci_benar}</strong></div>` : ''}
            </div>
            <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: 1.5; background-color: var(--permukaan-2); padding: var(--spasi-8) var(--spasi-12); border-radius: var(--radius-dalam);">
              ${ev.pembahasan}
            </p>
          </div>
        `).join('');

        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    });

    tampilkanSoal(0);
  });
</script>
