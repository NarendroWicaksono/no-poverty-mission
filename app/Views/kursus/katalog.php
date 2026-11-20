<div style="background-color: var(--latar); border-bottom: 1px solid var(--garis); padding: var(--spasi-40) 0;">
  <div class="wadah">
    <div style="font-size: var(--teks-12); font-weight: 500; color: var(--aksen); margin-bottom: var(--spasi-4);">
      Pelatihan terbuka
    </div>
    <h1 style="font-size: var(--teks-40); font-family: var(--font-serif); margin-bottom: var(--spasi-8);">
      Katalog kursus
    </h1>
    <p style="font-size: var(--teks-16); color: var(--teks-2); max-width: 640px;">
      Seluruh materi disusun secara mandiri untuk persiapan kerja kantor, wawancara, serta pengelolaan keuangan dan usaha mikro. Pilih kursus untuk melihat daftar modul.
    </p>
  </div>
</div>

<div class="wadah" style="padding-top: var(--spasi-32); padding-bottom: var(--spasi-64);">
  <div style="display: grid; grid-template-columns: 240px 1fr; gap: var(--spasi-32); align-items: start;">
    <!-- Sidebar Filter Tenang -->
    <aside>
      <div class="kartu kartu-padat" style="position: sticky; top: 88px;">
        <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-16); border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-8);">
          Filter materi
        </div>

        <!-- Filter Kategori -->
        <div style="margin-bottom: var(--spasi-20);">
          <div style="font-size: var(--teks-12); font-weight: 500; color: var(--teks-3); margin-bottom: var(--spasi-8);">
            Kategori
          </div>
          <div style="display: flex; flex-direction: column; gap: var(--spasi-8); font-size: var(--teks-14);">
            <label style="display: flex; align-items: center; gap: var(--spasi-8); cursor: pointer;">
              <input type="radio" name="kategori-filter" value="all" checked style="accent-color: var(--aksen);">
              <span>Semua kategori</span>
            </label>
            <label style="display: flex; align-items: center; gap: var(--spasi-8); cursor: pointer;">
              <input type="radio" name="kategori-filter" value="aplikasi-perkantoran" style="accent-color: var(--aksen);">
              <span>Aplikasi perkantoran</span>
            </label>
            <label style="display: flex; align-items: center; gap: var(--spasi-8); cursor: pointer;">
              <input type="radio" name="kategori-filter" value="kesiapan-karir-kerja" style="accent-color: var(--aksen);">
              <span>Kesiapan karir</span>
            </label>
            <label style="display: flex; align-items: center; gap: var(--spasi-8); cursor: pointer;">
              <input type="radio" name="kategori-filter" value="kewirausahaan-literasi-keuangan" style="accent-color: var(--aksen);">
              <span>Keuangan &amp; usaha kecil</span>
            </label>
          </div>
        </div>

        <!-- Filter Level -->
        <div style="margin-bottom: var(--spasi-20);">
          <div style="font-size: var(--teks-12); font-weight: 500; color: var(--teks-3); margin-bottom: var(--spasi-8);">
            Tingkat kesulitan
          </div>
          <div style="display: flex; flex-direction: column; gap: var(--spasi-8); font-size: var(--teks-14);">
            <label style="display: flex; align-items: center; gap: var(--spasi-8); cursor: pointer;">
              <input type="radio" name="level-filter" value="all" checked style="accent-color: var(--aksen);">
              <span>Semua tingkat</span>
            </label>
            <label style="display: flex; align-items: center; gap: var(--spasi-8); cursor: pointer;">
              <input type="radio" name="level-filter" value="Pemula" style="accent-color: var(--aksen);">
              <span>Pemula</span>
            </label>
            <label style="display: flex; align-items: center; gap: var(--spasi-8); cursor: pointer;">
              <input type="radio" name="level-filter" value="Menengah" style="accent-color: var(--aksen);">
              <span>Menengah</span>
            </label>
            <label style="display: flex; align-items: center; gap: var(--spasi-8); cursor: pointer;">
              <input type="radio" name="level-filter" value="Lanjut" style="accent-color: var(--aksen);">
              <span>Lanjut</span>
            </label>
          </div>
        </div>

        <button id="btn-reset-filter" class="tombol tombol-sekunder tombol-kecil tombol-lebar">
          Atur ulang filter
        </button>
      </div>
    </aside>

    <!-- Konten Utama: Pencarian dan Kartu Kursus -->
    <div>
      <!-- Kolom Pencarian -->
      <div style="margin-bottom: var(--spasi-20);">
        <input
          type="search"
          id="pencarian-kursus"
          class="bidang-input"
          placeholder="Cari kursus (misal: Excel, CV, wawancara, keuangan, usaha)..."
          style="width: 100%;"
        >
      </div>

      <!-- Informasi Jumlah -->
      <div style="display: flex; justify-content: space-between; align-items: center; font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-16);">
        <span id="label-jumlah-kursus">Memuat daftar...</span>
        <span>Akses terbuka tanpa biaya</span>
      </div>

      <!-- Grid Daftar Kursus -->
      <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: var(--spasi-20);" id="katalog-kursus-grid">
        <!-- Dimuat dinamis via JS -->
      </div>

      <!-- Tampilan Kosong (Empty State) -->
      <div id="katalog-kosong" class="kartu" style="display: none; text-align: center; padding: var(--spasi-48) var(--spasi-24);">
        <div style="font-size: var(--teks-16); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-4);">
          Kursus tidak ditemukan
        </div>
        <p style="font-size: var(--teks-14); color: var(--teks-2); max-width: 400px; margin: 0 auto var(--spasi-16);">
          Tidak ada materi kursus yang cocok dengan kata kunci atau filter yang Anda pilih.
        </p>
        <button id="btn-kosong-reset" class="tombol tombol-sekunder tombol-kecil">
          Tampilkan semua kursus
        </button>
      </div>
    </div>
  </div>
</div>

<script type="module">
  import {
    ambilDaftarKursus,
    ambilProgresKursus,
    ambilSertifikatPengguna
  } from '../assets/js/api.js';

  let semuaKursus = [];
  let progresPeta = {};
  let sertifikatSlug = new Set();

  const grid = document.getElementById('katalog-kursus-grid');
  const inputCari = document.getElementById('pencarian-kursus');
  const labelJumlah = document.getElementById('label-jumlah-kursus');
  const elKosong = document.getElementById('katalog-kosong');

  const urlParams = new URLSearchParams(window.location.search);
  const paramKategori = urlParams.get('kategori');
  if (paramKategori) {
    const radioTarget = document.querySelector(`input[name="kategori-filter"][value="${paramKategori}"]`);
    if (radioTarget) radioTarget.checked = true;
  }

  function filterDanTampilkan() {
    const kataKunci = inputCari.value.toLowerCase().trim();
    const radioKat = document.querySelector('input[name="kategori-filter"]:checked');
    const radioLev = document.querySelector('input[name="level-filter"]:checked');
    const kategori = radioKat ? radioKat.value : 'all';
    const level = radioLev ? radioLev.value : 'all';

    const hasil = semuaKursus.filter(k => {
      const cocokCari = k.judul.toLowerCase().includes(kataKunci) ||
                        k.ringkasan.toLowerCase().includes(kataKunci) ||
                        k.kategori.toLowerCase().includes(kataKunci);
      const cocokKat = kategori === 'all' || k.kategori_slug === kategori;
      const cocokLev = level === 'all' || k.level.toLowerCase() === level.toLowerCase();
      return cocokCari && cocokKat && cocokLev;
    });

    labelJumlah.textContent = `${hasil.length} kursus ditampilkan`;

    if (hasil.length === 0) {
      grid.style.display = 'none';
      elKosong.style.display = 'block';
    } else {
      grid.style.display = 'grid';
      elKosong.style.display = 'none';
      grid.innerHTML = hasil.map(k => {
        const selesai = progresPeta[k.slug] || 0;
        const total = k.jumlah_modul || 4;
        const isLulus = sertifikatSlug.has(k.slug);
        let lencanaProgres = '';
        if (isLulus) {
          lencanaProgres = `<span class="lencana-status lencana-sukses">Lulus &amp; bersertifikat</span>`;
        } else if (selesai > 0) {
          lencanaProgres = `<span class="lencana-status lencana-aksen">${selesai}/${total} modul</span>`;
        }

        return `
          <div class="kartu" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <div style="display: flex; justify-content: space-between; align-items: center; gap: var(--spasi-8); margin-bottom: var(--spasi-8);">
                <span style="font-size: var(--teks-12); color: var(--teks-3);">${k.kategori} &bull; ${k.level}</span>
                ${lencanaProgres}
              </div>
              <h3 style="font-size: var(--teks-16); font-weight: 500; margin-bottom: var(--spasi-8);">
                <a href="detail.php?slug=${k.slug}">${k.judul}</a>
              </h3>
              <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: 1.5; margin-bottom: var(--spasi-16);">
                ${k.ringkasan}
              </p>
            </div>

            <div style="border-top: 1px solid var(--garis); padding-top: var(--spasi-12); display: flex; justify-content: space-between; align-items: center;">
              <span style="font-size: var(--teks-12); color: var(--teks-3); font-family: var(--font-mono);">
                ${total} modul &bull; ${k.estimasi_waktu}
              </span>
              <a href="detail.php?slug=${k.slug}" class="tombol tombol-sekunder tombol-kecil">
                ${selesai > 0 || isLulus ? 'Lanjutkan' : 'Rincian'} &rarr;
              </a>
            </div>
          </div>
        `;
      }).join('');
    }
  }

  function resetFilter() {
    inputCari.value = '';
    const defKat = document.querySelector('input[name="kategori-filter"][value="all"]');
    const defLev = document.querySelector('input[name="level-filter"][value="all"]');
    if (defKat) defKat.checked = true;
    if (defLev) defLev.checked = true;
    filterDanTampilkan();
  }

  document.getElementById('btn-reset-filter').addEventListener('click', resetFilter);
  document.getElementById('btn-kosong-reset').addEventListener('click', resetFilter);
  inputCari.addEventListener('input', filterDanTampilkan);
  document.querySelectorAll('input[name="kategori-filter"]').forEach(r => r.addEventListener('change', filterDanTampilkan));
  document.querySelectorAll('input[name="level-filter"]').forEach(r => r.addEventListener('change', filterDanTampilkan));

  document.addEventListener('DOMContentLoaded', async () => {
    semuaKursus = await ambilDaftarKursus();
    const sertifikatSaya = await ambilSertifikatPengguna();
    sertifikatSlug = new Set(sertifikatSaya.map(s => s.kursus_slug));

    await Promise.all(
      semuaKursus.map(async k => {
        const prog = await ambilProgresKursus(k.slug);
        progresPeta[k.slug] = prog.length;
      })
    );

    filterDanTampilkan();
  });
</script>
