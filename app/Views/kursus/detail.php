<div style="background-color: var(--latar); border-bottom: 1px solid var(--garis); padding: var(--spasi-40) 0;">
  <div class="wadah">
    <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-8);">
      <a href="katalog.php">&larr; Kembali ke katalog</a>
    </div>

    <div style="font-size: var(--teks-12); font-weight: 500; color: var(--aksen); margin-bottom: var(--spasi-4);" id="detail-kategori">
      Memuat kategori...
    </div>
    <h1 style="font-size: var(--teks-40); font-family: var(--font-serif); margin-bottom: var(--spasi-12);" id="detail-judul">
      Memuat rincian kursus...
    </h1>
    <p style="font-size: var(--teks-16); color: var(--teks-2); max-width: 680px; line-height: var(--jarak-baris-baca); margin-bottom: var(--spasi-24);" id="detail-ringkasan">
      Ringkasan materi kursus akan tampil di sini.
    </p>

    <div style="display: flex; gap: var(--spasi-24); align-items: center; font-size: var(--teks-14); color: var(--teks-3); flex-wrap: wrap;">
      <span id="detail-level">Tingkat: Pemula</span>
      <span id="detail-waktu" class="angka-mono">Estimasi: 2 jam</span>
      <span id="detail-jumlah-modul" class="angka-mono">Materi: 4 modul</span>
      <span>Sertifikat kelulusan resmi</span>
    </div>
  </div>
</div>

<div class="wadah" style="padding-top: var(--spasi-32); padding-bottom: var(--spasi-64);">
  <div style="display: grid; grid-template-columns: 1fr 320px; gap: var(--spasi-40); align-items: start;">
    <!-- Kolom Kiri: Deskripsi, Tujuan Belajar, dan Silabus -->
    <div>
      <!-- Deskripsi Kursus -->
      <section style="margin-bottom: var(--spasi-40);">
        <h2 style="font-size: var(--teks-20); font-weight: 500; margin-bottom: var(--spasi-12);">
          Tentang kursus ini
        </h2>
        <p style="font-size: var(--teks-16); color: var(--teks-2); line-height: var(--jarak-baris-baca);" id="detail-deskripsi">
          Memuat penjelasan kursus...
        </p>
      </section>

      <!-- Tujuan Belajar -->
      <section style="margin-bottom: var(--spasi-40);">
        <h2 style="font-size: var(--teks-20); font-weight: 500; margin-bottom: var(--spasi-16);">
          Tujuan pembelajaran
        </h2>
        <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--spasi-12);" id="detail-tujuan-list">
          <!-- Dimuat dinamis -->
        </ul>
      </section>

      <!-- Daftar Modul (Silabus) -->
      <section>
        <h2 style="font-size: var(--teks-20); font-weight: 500; margin-bottom: var(--spasi-16);">
          Daftar modul (klik untuk membuka)
        </h2>
        <div style="display: flex; flex-direction: column; gap: var(--spasi-8);" id="detail-modul-list">
          <!-- Dimuat dinamis -->
        </div>
      </section>
    </div>

    <!-- Kolom Kanan: Panel Aksi Pendaftaran -->
    <aside>
      <div class="kartu" style="position: sticky; top: 88px;">
        <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-8);" id="panel-akses-judul">
          Akses kursus
        </div>
        <p style="font-size: var(--teks-14); color: var(--teks-2); line-height: var(--jarak-baris-baca); margin-bottom: var(--spasi-20);" id="panel-akses-ket">
          Kursus ini dapat langsung dipelajari secara penuh. Selesaikan seluruh modul untuk membuka kuis akhir kelulusan.
        </p>

        <div id="panel-progres-wrap" style="display: none; margin-bottom: var(--spasi-16);">
          <div style="display: flex; justify-content: space-between; font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-4);">
            <span id="panel-progres-teks">0 dari 4 modul</span>
            <span class="angka-mono" id="panel-progres-persen">0%</span>
          </div>
          <div class="bilah-progres">
            <div class="bilah-progres-isi" id="panel-progres-bar" style="width: 0%;"></div>
          </div>
        </div>

        <a href="#" id="tombol-mulai-belajar" class="tombol tombol-utama tombol-lebar" style="margin-bottom: var(--spasi-12);">
          Mulai belajar
        </a>

        <a href="#" id="tombol-ke-kuis" class="tombol tombol-sekunder tombol-lebar" style="display: none; margin-bottom: var(--spasi-12);">
          Kerjakan kuis akhir &rarr;
        </a>

        <div style="font-size: var(--teks-12); color: var(--teks-3); border-top: 1px solid var(--garis); padding-top: var(--spasi-12);">
          <div>&bull; Akses mandiri tanpa batas waktu</div>
          <div style="margin-top: var(--spasi-4);">&bull; Kuis akhir 10 butir soal pilihan ganda</div>
          <div style="margin-top: var(--spasi-4);">&bull; Sertifikat kelulusan dengan nomor resmi</div>
        </div>
      </div>
    </aside>
  </div>
</div>

<script type="module">
  import {
    ambilDetailKursus,
    ambilDaftarModul,
    ambilProgresKursus,
    ambilSertifikatPengguna
  } from '../assets/js/api.js';

  document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get('slug') || 'microsoft-excel-dasar';

    const kursus = await ambilDetailKursus(slug);
    if (!kursus) {
      document.getElementById('detail-judul').textContent = 'Kursus tidak ditemukan';
      return;
    }

    const [modulList, progresIds, sertifikatSaya] = await Promise.all([
      ambilDaftarModul(slug),
      ambilProgresKursus(slug),
      ambilSertifikatPengguna()
    ]);

    const sertifikatKursus = sertifikatSaya.find(s => s.kursus_slug === slug);

    document.title = `${kursus.judul} - Skill4Life`;
    document.getElementById('detail-kategori').textContent = kursus.kategori;
    document.getElementById('detail-judul').textContent = kursus.judul;
    document.getElementById('detail-ringkasan').textContent = kursus.ringkasan;
    document.getElementById('detail-level').textContent = `Tingkat: ${kursus.level}`;
    document.getElementById('detail-waktu').textContent = `Estimasi: ${kursus.estimasi_waktu}`;
    document.getElementById('detail-jumlah-modul').textContent = `Materi: ${modulList.length || kursus.jumlah_modul} modul`;
    document.getElementById('detail-deskripsi').textContent = kursus.deskripsi;

    // Tujuan Belajar
    const tujuanList = document.getElementById('detail-tujuan-list');
    if (tujuanList && kursus.tujuan_belajar) {
      tujuanList.innerHTML = kursus.tujuan_belajar.map(t => `
        <li style="display: flex; gap: var(--spasi-12); font-size: var(--teks-14); color: var(--teks-2); align-items: flex-start;">
          <span style="color: var(--aksen); font-weight: bold;">&check;</span>
          <span>${t}</span>
        </li>
      `).join('');
    }

    // Daftar Modul (dapat diklik)
    const modulContainer = document.getElementById('detail-modul-list');
    if (modulContainer) {
      modulContainer.innerHTML = modulList.map((m, idx) => {
        const isSelesai = progresIds.includes(m.id);
        return `
          <a href="belajar.php?slug=${kursus.slug}&modul=${m.urutan}" style="border: 1px solid ${isSelesai ? 'rgba(31,111,74,0.3)' : 'var(--garis)'}; border-radius: var(--radius-kontrol); padding: var(--spasi-12) var(--spasi-16); background-color: var(--permukaan); display: flex; justify-content: space-between; align-items: center; gap: var(--spasi-12);">
            <div style="display: flex; gap: var(--spasi-12); align-items: center;">
              <span class="angka-mono" style="font-size: var(--teks-12); color: ${isSelesai ? 'var(--aksen)' : 'var(--teks-3)'};">${String(idx + 1).padStart(2, '0')}</span>
              <span style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);">${m.judul_modul}</span>
            </div>
            <div style="display: flex; align-items: center; gap: var(--spasi-12);">
              ${isSelesai ? '<span class="lencana-status lencana-sukses">Selesai</span>' : ''}
              <span class="angka-mono" style="font-size: var(--teks-12); color: var(--teks-3);">${m.estimasi_menit} mnt</span>
            </div>
          </a>
        `;
      }).join('');
    }

    // Panel Aksi Cerdas
    const btnMulai = document.getElementById('tombol-mulai-belajar');
    const btnKuis = document.getElementById('tombol-ke-kuis');
    const total = modulList.length;
    const selesaiCount = modulList.filter(m => progresIds.includes(m.id)).length;

    if (selesaiCount > 0 && total > 0) {
      const persen = Math.round((selesaiCount / total) * 100);
      document.getElementById('panel-progres-wrap').style.display = 'block';
      document.getElementById('panel-progres-teks').textContent = `${selesaiCount} dari ${total} modul`;
      document.getElementById('panel-progres-persen').textContent = `${persen}%`;
      document.getElementById('panel-progres-bar').style.width = `${persen}%`;
    }

    if (sertifikatKursus) {
      document.getElementById('panel-akses-judul').textContent = 'Kursus telah dituntaskan';
      document.getElementById('panel-akses-ket').textContent = `Anda telah lulus kuis dengan nilai ${sertifikatKursus.nilai_kuis}/100 dan memiliki sertifikat resmi.`;
      btnMulai.textContent = `Lihat sertifikat (${sertifikatKursus.nomor_sertifikat})`;
      btnMulai.href = `../sertifikat/lihat.php?nomor=${sertifikatKursus.nomor_sertifikat}`;
      btnKuis.style.display = 'inline-flex';
      btnKuis.textContent = 'Pelajari ulang modul';
      btnKuis.href = `belajar.php?slug=${kursus.slug}&modul=1`;
    } else if (selesaiCount >= total && total > 0) {
      btnMulai.textContent = 'Kerjakan kuis akhir kelulusan →';
      btnMulai.href = `kuis.php?slug=${kursus.slug}`;
      btnKuis.style.display = 'inline-flex';
      btnKuis.textContent = 'Tinjau kembali materi';
      btnKuis.href = `belajar.php?slug=${kursus.slug}&modul=1`;
    } else if (selesaiCount > 0) {
      const modulBelum = modulList.find(m => !progresIds.includes(m.id)) || modulList[0];
      btnMulai.textContent = `Lanjutkan belajar (Modul ${modulBelum.urutan})`;
      btnMulai.href = `belajar.php?slug=${kursus.slug}&modul=${modulBelum.urutan}`;
      btnKuis.style.display = 'inline-flex';
      btnKuis.href = `kuis.php?slug=${kursus.slug}`;
    } else {
      btnMulai.textContent = 'Mulai belajar';
      btnMulai.href = `belajar.php?slug=${kursus.slug}&modul=1`;
    }
  });
</script>
