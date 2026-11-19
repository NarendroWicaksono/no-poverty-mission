<?php
$baseUrl = '..';
$judulHalaman = 'Ruang Belajar - Skill4Life';
include __DIR__ . '/../includes/header.php';
?>

<div class="tata-aplikasi">
  <!-- Sidebar Navigasi Modul (Lebar 260px) -->
  <aside class="sidebar-aplikasi">
    <div style="margin-bottom: var(--spasi-16);">
      <a href="katalog.php" style="font-size: var(--teks-12); color: var(--teks-3); display: inline-flex; align-items: center; gap: var(--spasi-4);">
        &larr; Katalog kursus
      </a>
      <h2 style="font-size: var(--teks-16); font-weight: 500; color: var(--teks); margin-top: var(--spasi-8); line-height: 1.3;" id="judul-kursus-sidebar">
        Memuat judul kursus...
      </h2>
    </div>

    <!-- Bilah Progres Modul -->
    <div style="background-color: var(--permukaan-2); border-radius: var(--radius-kontrol); padding: var(--spasi-12); margin-bottom: var(--spasi-20);">
      <div style="display: flex; justify-content: space-between; align-items: center; font-size: var(--teks-12); margin-bottom: var(--spasi-8);">
        <span style="color: var(--teks-2);">Progres belajar</span>
        <span class="angka-mono" style="font-weight: 500; color: var(--aksen);" id="label-persen-progres">0%</span>
      </div>
      <div class="bilah-progres">
        <div class="bilah-progres-isi" id="bilah-progres-bar" style="width: 0%;"></div>
      </div>
    </div>

    <div class="sidebar-label">Daftar modul</div>
    <ul class="sidebar-menu" id="nav-modul-list">
      <!-- Dimuat dinamis via JS -->
    </ul>

    <!-- Menu Kuis Akhir di Bawah Sidebar -->
    <div style="margin-top: auto; padding-top: var(--spasi-20); border-top: 1px solid var(--garis);">
      <a href="#" id="tautan-ke-kuis" class="tombol tombol-sekunder tombol-kecil tombol-lebar">
        Kuis akhir kelulusan &rarr;
      </a>
    </div>
  </aside>

  <!-- Area Konten Materi (Lebar Baca Nyaman 720px) -->
  <main class="konten-aplikasi">
    <div class="wadah-baca">
      <div style="margin-bottom: var(--spasi-24); border-bottom: 1px solid var(--garis); padding-bottom: var(--spasi-16);">
        <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);" id="label-urutan-modul">
          Modul 1
        </div>
        <h1 style="font-size: var(--teks-28); font-family: var(--font-serif); color: var(--teks);" id="judul-materi-aktif">
          Memuat modul...
        </h1>
      </div>

      <!-- Pemutar Video YouTube Embed -->
      <div id="wadah-video-embed" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: var(--radius-kontrol); margin-bottom: var(--spasi-24); background-color: #000; border: 1px solid var(--garis);">
        <!-- Iframe dimuat dinamis -->
      </div>

      <!-- Teks Materi Nyata -->
      <article style="font-size: var(--teks-16); line-height: var(--jarak-baris-baca); color: var(--teks);" id="isi-teks-materi">
        <!-- Dimuat dinamis -->
      </article>

      <!-- Navigasi Bawah dan Tombol Tandai Selesai -->
      <div style="margin-top: var(--spasi-48); padding-top: var(--spasi-20); border-top: 1px solid var(--garis); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: var(--spasi-16);">
        <a href="#" id="btn-modul-sebelumnya" class="tombol tombol-sekunder tombol-kecil" style="display: none;">
          &larr; Modul sebelumnya
        </a>

        <div style="display: flex; gap: var(--spasi-12); align-items: center; margin-left: auto;">
          <button id="btn-tandai-selesai" class="tombol tombol-utama tombol-kecil">
            Tandai selesai
          </button>
          <a href="#" id="btn-modul-selanjutnya" class="tombol tombol-sekunder tombol-kecil">
            Modul selanjutnya &rarr;
          </a>
        </div>
      </div>
    </div>
  </main>
</div>

<script type="module">
  import { ambilDetailKursus, ambilDaftarModul, simpanProgres, ambilProgresKursus } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get('slug') || 'microsoft-excel-dasar';
    const noModul = parseInt(urlParams.get('modul') || '1', 10);

    const kursus = await ambilDetailKursus(slug);
    const modulList = await ambilDaftarModul(slug);

    if (!kursus || !modulList.length) {
      alert("Materi kursus tidak ditemukan.");
      window.location.href = 'katalog.php';
      return;
    }

    const modulAktif = modulList.find(m => m.urutan === noModul) || modulList[0];
    const progresList = await ambilProgresKursus(slug);

    // Update Elemen Teks
    document.title = `${modulAktif.judul_modul} - ${kursus.judul}`;
    document.getElementById('judul-kursus-sidebar').textContent = kursus.judul;
    document.getElementById('label-urutan-modul').textContent = `Modul ${modulAktif.urutan} dari ${modulList.length}`;
    document.getElementById('judul-materi-aktif').textContent = modulAktif.judul_modul;

    // Update Progres Bar
    const persen = Math.round((progresList.length / modulList.length) * 100);
    document.getElementById('label-persen-progres').textContent = `${persen}%`;
    document.getElementById('bilah-progres-bar').style.width = `${persen}%`;

    // Embed Video
    const videoWrap = document.getElementById('wadah-video-embed');
    if (modulAktif.video_url) {
      videoWrap.style.display = 'block';
      videoWrap.innerHTML = `<iframe src="${modulAktif.video_url}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allowfullscreen title="${modulAktif.judul_modul}"></iframe>`;
    } else {
      videoWrap.style.display = 'none';
    }

    // Isi Konten Materi
    document.getElementById('isi-teks-materi').innerHTML = modulAktif.konten;

    // Render Sidebar List
    const navList = document.getElementById('nav-modul-list');
    navList.innerHTML = modulList.map(m => {
      const isSelesai = progresList.includes(m.id);
      const isAktif = m.urutan === modulAktif.urutan;
      return `
        <li>
          <a href="belajar.php?slug=${slug}&modul=${m.urutan}" class="sidebar-item ${isAktif ? 'aktif' : ''}">
            <span class="angka-mono" style="font-size: var(--teks-12);">${String(m.urutan).padStart(2, '0')}</span>
            <span style="flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${m.judul_modul}</span>
            ${isSelesai ? '<span style="color: var(--aksen); font-size: 12px;">&check;</span>' : ''}
          </a>
        </li>
      `;
    }).join('');

    // Tombol Tandai Selesai
    const btnSelesai = document.getElementById('btn-tandai-selesai');
    const isSudahSelesai = progresList.includes(modulAktif.id);
    if (isSudahSelesai) {
      btnSelesai.textContent = 'Sudah selesai';
      btnSelesai.className = 'tombol tombol-sekunder tombol-kecil';
    } else {
      btnSelesai.textContent = 'Tandai selesai';
      btnSelesai.className = 'tombol tombol-utama tombol-kecil';
    }

    btnSelesai.onclick = async () => {
      await simpanProgres(slug, modulAktif.id);
      window.location.reload();
    };

    // Tombol Navigasi Sebelumnya / Selanjutnya
    const btnPrev = document.getElementById('btn-modul-sebelumnya');
    const btnNext = document.getElementById('btn-modul-selanjutnya');
    const tautanKuis = document.getElementById('tautan-ke-kuis');

    tautanKuis.href = `kuis.php?slug=${slug}`;

    if (modulAktif.urutan > 1) {
      btnPrev.style.display = 'inline-flex';
      btnPrev.href = `belajar.php?slug=${slug}&modul=${modulAktif.urutan - 1}`;
    }

    if (modulAktif.urutan < modulList.length) {
      btnNext.href = `belajar.php?slug=${slug}&modul=${modulAktif.urutan + 1}`;
    } else {
      btnNext.textContent = 'Lanjut ke kuis akhir &rarr;';
      btnNext.href = `kuis.php?slug=${slug}`;
      btnNext.className = 'tombol tombol-utama tombol-kecil';
    }
  });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
