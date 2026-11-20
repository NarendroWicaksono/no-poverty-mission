<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--spasi-24); flex-wrap: wrap; gap: var(--spasi-16);">
  <div>
    <h1 style="font-family: var(--font-judul); font-size: 26px; font-weight: 600; color: var(--teks); margin-bottom: var(--spasi-4);">
      Ringkasan statistik
    </h1>
    <p style="font-size: var(--teks-14); color: var(--teks-2); margin: 0;">
      Pantauan pertumbuhan peserta, penyelesaian modul, dan dampak program SDG 1.
    </p>
  </div>

  <div style="display: flex; gap: var(--spasi-8);">
    <a href="kursus.php" class="tombol tombol-utama tombol-kecil">
      <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Tambah kursus
    </a>
  </div>
</div>

<!-- 4 Kartu Metrik Tenang -->
<div class="grid-metrik">
  <div class="kartu-metrik">
    <div class="kartu-metrik-label">Total peserta terdaftar</div>
    <div class="kartu-metrik-angka" id="adm-stat-peserta">0</div>
    <div class="kartu-metrik-perbandingan">Peserta aktif di database</div>
  </div>

  <div class="kartu-metrik">
    <div class="kartu-metrik-label">Kursus aktif</div>
    <div class="kartu-metrik-angka" id="adm-stat-kursus">0</div>
    <div class="kartu-metrik-perbandingan" id="adm-stat-modul-sub">0 modul siap belajar</div>
  </div>

  <div class="kartu-metrik">
    <div class="kartu-metrik-label">Sertifikat diterbitkan</div>
    <div class="kartu-metrik-angka" id="adm-stat-sertifikat">0</div>
    <div class="kartu-metrik-perbandingan">Tersertifikasi resmi</div>
  </div>

  <div class="kartu-metrik">
    <div class="kartu-metrik-label">Biaya peserta</div>
    <div class="kartu-metrik-angka">Rp 0</div>
    <div class="kartu-metrik-perbandingan">100% subsidi SDG 1</div>
  </div>
</div>

<!-- Tata Letak Grafik Native SVG dan Daftar Kursus Terpopuler -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: var(--spasi-20); margin-bottom: var(--spasi-32);">
  <!-- Grafik Tren SVG Native -->
  <div class="kartu">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spasi-16); flex-wrap: wrap; gap: var(--spasi-8);">
      <div>
        <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);">Tren pendaftaran &amp; kelulusan</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3);">Enam bulan terakhir tahun 2026</div>
      </div>
      <div style="display: flex; gap: var(--spasi-16); font-size: var(--teks-12); color: var(--teks-2);">
        <span style="display: flex; align-items: center; gap: 6px;">
          <span style="display: inline-block; width: 10px; height: 2px; background-color: var(--aksen);"></span> Peserta baru
        </span>
        <span style="display: flex; align-items: center; gap: 6px;">
          <span style="display: inline-block; width: 10px; height: 2px; border-top: 2px dashed var(--teks-3);"></span> Kelulusan
        </span>
      </div>
    </div>
    <div id="native-trend-chart" style="width: 100%; min-height: 240px;"></div>
  </div>

  <!-- Kursus Terpopuler Dinamis dari Database -->
  <div class="kartu">
    <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks); margin-bottom: var(--spasi-4);">Kursus unggulan &amp; aktif</div>
    <div style="font-size: var(--teks-12); color: var(--teks-3); margin-bottom: var(--spasi-16);">Berdasarkan aktivitas peserta di database</div>

    <div style="display: flex; flex-direction: column; gap: var(--spasi-12);" id="adm-popular-list">
      <!-- Dimuat dinamis dari database -->
    </div>
  </div>
</div>

<!-- Tabel Peserta Terbaru yang Mendaftar -->
<div class="kartu">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spasi-16);">
    <div>
      <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);">Pendaftaran peserta terbaru</div>
      <div style="font-size: var(--teks-12); color: var(--teks-3);">Lima pendaftar terakhir dari data penerima manfaat</div>
    </div>
    <a href="peserta.php" class="tombol tombol-sekunder tombol-kecil">
      Lihat semua peserta <i data-lucide="chevron-right" style="width: 14px; height: 14px;"></i>
    </a>
  </div>

  <div class="wadah-tabel">
    <table class="tabel-data">
      <thead>
        <tr>
          <th>Nama lengkap</th>
          <th>Alamat email</th>
          <th>Pekerjaan &amp; domisili</th>
          <th>Status</th>
          <th>Tanggal daftar</th>
        </tr>
      </thead>
      <tbody id="adm-recent-table">
        <!-- Dimuat dinamis via JS -->
      </tbody>
    </table>
  </div>
</div>

<script type="module">
  import { ambilStatistik, ambilSemuaPeserta } from '../assets/js/api.js';

  function renderNativeChart() {
    const wadah = document.getElementById('native-trend-chart');
    if (!wadah) return;

    const labels = ['Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov'];
    const peserta = [1420, 1850, 2100, 2450, 2900, 3560];
    const lulus = [980, 1320, 1580, 1820, 2240, 2810];

    const W = 600, H = 220;
    const padL = 44, padR = 20, padT = 16, padB = 28;
    const chartW = W - padL - padR;
    const chartH = H - padT - padB;
    const maxVal = 4000;

    const getX = i => padL + (i / (labels.length - 1)) * chartW;
    const getY = v => padT + chartH - (v / maxVal) * chartH;

    const gridLines = [0, 1000, 2000, 3000, 4000].map(val => {
      const y = getY(val);
      return `
        <line x1="${padL}" y1="${y}" x2="${W - padR}" y2="${y}" stroke="rgba(28,26,23,0.08)" stroke-width="1" />
        <text x="${padL - 8}" y="${y + 4}" text-anchor="end" fill="#8A847A" font-size="10" font-family="JetBrains Mono, monospace">${val}</text>
      `;
    }).join('');

    const ptsPeserta = peserta.map((v, i) => `${getX(i)},${getY(v)}`).join(' ');
    const areaPeserta = `${padL},${padT + chartH} ${ptsPeserta} ${getX(labels.length - 1)},${padT + chartH}`;
    const ptsLulus = lulus.map((v, i) => `${getX(i)},${getY(v)}`).join(' ');

    const dotsPeserta = peserta.map((v, i) => `
      <circle cx="${getX(i)}" cy="${getY(v)}" r="3.5" fill="#1F6F4A" />
      <text x="${getX(i)}" y="${getY(v) - 8}" text-anchor="middle" fill="#1F6F4A" font-size="9.5" font-family="JetBrains Mono, monospace">${v}</text>
    `).join('');

    const dotsLulus = lulus.map((v, i) => `
      <circle cx="${getX(i)}" cy="${getY(v)}" r="2.5" fill="#8A847A" />
    `).join('');

    const xLabels = labels.map((lbl, i) => `
      <text x="${getX(i)}" y="${H - 6}" text-anchor="middle" fill="#8A847A" font-size="10.5" font-family="Public Sans, sans-serif">${lbl} 2026</text>
    `).join('');

    wadah.innerHTML = `
      <svg viewBox="0 0 ${W} ${H}" style="width: 100%; height: auto; display: block;">
        ${gridLines}
        <polygon points="${areaPeserta}" fill="rgba(31, 111, 74, 0.06)" />
        <polyline points="${ptsPeserta}" fill="none" stroke="#1F6F4A" stroke-width="2" />
        <polyline points="${ptsLulus}" fill="none" stroke="#8A847A" stroke-width="1.5" stroke-dasharray="4 4" />
        ${dotsPeserta}
        ${dotsLulus}
        ${xLabels}
      </svg>
    `;
  }

  document.addEventListener('DOMContentLoaded', async () => {
    renderNativeChart();

    const [stat, pesertaList] = await Promise.all([
      ambilStatistik(),
      ambilSemuaPeserta()
    ]);

    document.getElementById('adm-stat-peserta').textContent = pesertaList.length.toLocaleString('id-ID');
    document.getElementById('adm-stat-kursus').textContent = stat.total_kursus;
    document.getElementById('adm-stat-modul-sub').textContent = `${stat.total_modul} modul siap belajar`;
    document.getElementById('adm-stat-sertifikat').textContent = stat.total_sertifikat.toLocaleString('id-ID');

    const popWrap = document.getElementById('adm-popular-list');
    if (popWrap && Array.isArray(stat.kursus_populer)) {
      const maxAktif = Math.max(1, ...stat.kursus_populer.map(k => k.peserta_aktif || 1));
      popWrap.innerHTML = stat.kursus_populer.map(k => {
        const persen = Math.max(20, Math.round(((k.peserta_aktif || 1) / maxAktif) * 100));
        return `
          <div>
            <div style="display: flex; justify-content: space-between; font-size: var(--teks-12); margin-bottom: var(--spasi-4); gap: var(--spasi-8);">
              <span style="color: var(--teks); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${k.judul}</span>
              <span style="font-family: var(--font-angka); color: var(--teks-2); flex-shrink: 0;">${k.total_modul} modul</span>
            </div>
            <div class="bilah-progres"><div class="bilah-progres-isi" style="width: ${persen}%;"></div></div>
          </div>
        `;
      }).join('');
    }

    const tbody = document.getElementById('adm-recent-table');
    if (tbody) {
      const recents = pesertaList.slice(0, 5);
      tbody.innerHTML = recents.map(p => `
        <tr>
          <td style="font-weight: 500;">${p.nama}</td>
          <td style="color: var(--teks-2); font-family: var(--font-angka);">${p.email}</td>
          <td style="color: var(--teks-2);">${p.pekerjaan} · ${p.kota}</td>
          <td><span class="lencana-status lencana-sukses">${p.status}</span></td>
          <td style="color: var(--teks-3); font-family: var(--font-angka);">${p.tgl_daftar}</td>
        </tr>
      `).join('');
    }
  });
</script>
