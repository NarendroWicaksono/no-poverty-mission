<?php
$baseUrl = '..';
$judulHalaman = 'Kelola Modul Pembelajaran - Panel Pengelola Skill4Life';
$tanpaNavbar = true;
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/partials/topbar.php';
?>

<div class="tata-aplikasi">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>

  <main class="konten-aplikasi">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--spasi-24); flex-wrap: wrap; gap: var(--spasi-16);">
      <div>
        <h1 style="font-family: var(--font-judul); font-size: 26px; font-weight: 600; color: var(--teks); margin-bottom: var(--spasi-4);">
          Kelola modul pembelajaran
        </h1>
        <p style="font-size: var(--teks-14); color: var(--teks-2); margin: 0;">
          Atur silabus materi, video penjelasan, dan urutan bacaan per kursus.
        </p>
      </div>

      <button type="button" onclick="bukaModalModul()" class="tombol tombol-utama tombol-kecil">
        <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Tambah modul baru
      </button>
    </div>

    <!-- Pemilih Kursus Tenang -->
    <div class="kartu" style="padding: var(--spasi-16); margin-bottom: var(--spasi-20);">
      <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--spasi-12);">
        <div style="display: flex; align-items: center; gap: var(--spasi-12); flex: 1; min-width: 280px;">
          <label for="pilih-kursus" style="font-size: var(--teks-12); font-weight: 500; color: var(--teks-2); white-space: nowrap;">
            Pilih kursus:
          </label>
          <select id="pilih-kursus" class="bidang-pilihan" onchange="gantiPilihanKursus(this.value)" style="height: 36px; font-size: var(--teks-14);">
            <option value="microsoft-excel-dasar">Microsoft Excel Dasar</option>
            <option value="microsoft-excel-lanjutan">Microsoft Excel Lanjutan</option>
            <option value="microsoft-word-surat-dokumen">Microsoft Word untuk Dokumen Resmi</option>
            <option value="microsoft-powerpoint-presentasi">Microsoft PowerPoint untuk Presentasi</option>
            <option value="menulis-cv-surat-lamaran-ats">Menulis CV &amp; Surat Lamaran Kerja ATS</option>
            <option value="persiapan-wawancara-kerja">Persiapan Wawancara Kerja &amp; Komunikasi</option>
          </select>
        </div>
        <span class="lencana-status lencana-netral" id="badge-total-modul">0 modul terdaftar</span>
      </div>
    </div>

    <!-- Tabel Modul Terdaftar -->
    <div class="kartu" style="padding: 0;">
      <div class="wadah-tabel" style="border: none; border-radius: 0;">
        <table class="tabel-data">
          <thead>
            <tr>
              <th style="width: 60px;">Urutan</th>
              <th>Judul materi modul</th>
              <th>Estimasi waktu</th>
              <th>Video pendukung</th>
              <th style="width: 130px; text-align: right;">Aksi</th>
            </tr>
          </thead>
          <tbody id="tabel-modul-body">
            <tr>
              <td colspan="5" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Memuat silabus modul...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<!-- Dialog Modal Tambah / Ubah Modul -->
<div class="dialog-latar" id="dialog-modul" onclick="if(event.target===this) tutupModalModul()">
  <div class="dialog-kartu">
    <div class="dialog-kepala">
      <div>
        <div style="font-size: var(--teks-16); font-weight: 500; color: var(--teks);" id="dialog-modul-judul">Tambah modul materi</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3);">Masukkan detail bacaan dan tautan video pembelajaran</div>
      </div>
      <button type="button" onclick="tutupModalModul()" style="background:none; border:none; color:var(--teks-3); cursor:pointer;">
        <i data-lucide="x" style="width: 18px; height: 18px;"></i>
      </button>
    </div>

    <form onsubmit="simpanModul(event)">
      <div style="display: grid; grid-template-columns: 80px 1fr; gap: var(--spasi-16);">
        <div class="grup-input">
          <label class="label-bidang" for="modal-modul-urutan">Urutan</label>
          <input type="number" id="modal-modul-urutan" class="bidang-input" value="1" min="1" required>
        </div>
        <div class="grup-input">
          <label class="label-bidang" for="modal-modul-judul-teks">Judul modul</label>
          <input type="text" id="modal-modul-judul-teks" class="bidang-input" placeholder="Contoh: Pengenalan Rumus Excel" required>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spasi-16);">
        <div class="grup-input">
          <label class="label-bidang" for="modal-modul-durasi">Estimasi (menit)</label>
          <input type="number" id="modal-modul-durasi" class="bidang-input" value="25" min="5" required>
        </div>
        <div class="grup-input">
          <label class="label-bidang" for="modal-modul-video">URL video YouTube embed</label>
          <input type="url" id="modal-modul-video" class="bidang-input" placeholder="https://www.youtube.com/embed/...">
        </div>
      </div>

      <div class="grup-input">
        <label class="label-bidang" for="modal-modul-konten">Konten teks materi (HTML)</label>
        <textarea id="modal-modul-konten" class="bidang-teks" style="min-height: 120px;" placeholder="Tulis ringkasan atau teks bacaan di sini..." required></textarea>
      </div>

      <div class="dialog-kaki">
        <button type="button" onclick="tutupModalModul()" class="tombol tombol-sekunder tombol-kecil">Batal</button>
        <button type="submit" class="tombol tombol-utama tombol-kecil">Simpan modul</button>
      </div>
    </form>
  </div>
</div>

<script>
let semuaModulGlobal = [];
let slugKursusAktif = 'microsoft-excel-dasar';

async function muatDataModul() {
  try {
    const res = await fetch('<?= $baseUrl ?>/assets/data/modul.json');
    if (res.ok) {
      semuaModulGlobal = await res.json();
      tampilkanModulPerKursus(slugKursusAktif);
    }
  } catch (err) {
    console.error('Gagal memuat modul:', err);
  }
}

function gantiPilihanKursus(slug) {
  slugKursusAktif = slug;
  tampilkanModulPerKursus(slug);
}

function tampilkanModulPerKursus(slug) {
  const modulList = semuaModulGlobal.filter(m => m.kursus_slug === slug);
  const tbody = document.getElementById('tabel-modul-body');
  const badge = document.getElementById('badge-total-modul');

  if (badge) badge.textContent = `${modulList.length} modul terdaftar`;

  if (!tbody) return;
  if (!modulList.length) {
    tbody.innerHTML = `<tr><td colspan="5" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Belum ada modul untuk kursus ini.</td></tr>`;
    return;
  }

  tbody.innerHTML = modulList.map(m => `
    <tr>
      <td style="font-family: var(--font-angka); color: var(--teks-3);">#${m.urutan}</td>
      <td>
        <div style="font-weight: 500; color: var(--teks);">${m.judul_modul}</div>
      </td>
      <td style="font-family: var(--font-angka); color: var(--teks-2); font-size: var(--teks-12);">
        ${m.estimasi_menit} menit
      </td>
      <td>
        ${m.video_url 
          ? '<span class="lencana-status lencana-aksen">Video + teks</span>' 
          : '<span class="lencana-status lencana-netral">Teks bacaan</span>'}
      </td>
      <td style="text-align: right;">
        <div style="display: inline-flex; gap: var(--spasi-4);">
          <button type="button" onclick="editModul(${m.id})" class="tombol tombol-sekunder tombol-kecil" style="height: 28px; padding: 0 8px;" title="Ubah modul">
            <i data-lucide="edit-3" style="width: 13px; height: 13px;"></i>
          </button>
          <button type="button" onclick="hapusModul(${m.id})" class="tombol tombol-sekunder tombol-kecil" style="height: 28px; padding: 0 8px; color: var(--galat);" title="Hapus modul">
            <i data-lucide="trash-2" style="width: 13px; height: 13px;"></i>
          </button>
        </div>
      </td>
    </tr>
  `).join('');

  if (window.lucide) lucide.createIcons();
}

function bukaModalModul() {
  document.getElementById('dialog-modul-judul').textContent = 'Tambah modul materi';
  document.getElementById('modal-modul-judul-teks').value = '';
  document.getElementById('modal-modul-konten').value = '';
  document.getElementById('dialog-modul').classList.add('terbuka');
}

function editModul(id) {
  const m = semuaModulGlobal.find(item => item.id === id);
  if (m) {
    document.getElementById('dialog-modul-judul').textContent = 'Ubah modul materi';
    document.getElementById('modal-modul-urutan').value = m.urutan;
    document.getElementById('modal-modul-judul-teks').value = m.judul_modul;
    document.getElementById('modal-modul-durasi').value = m.estimasi_menit;
    document.getElementById('modal-modul-video').value = m.video_url || '';
    document.getElementById('modal-modul-konten').value = m.konten || '';
    document.getElementById('dialog-modul').classList.add('terbuka');
  }
}

function tutupModalModul() {
  document.getElementById('dialog-modul').classList.remove('terbuka');
}

function simpanModul(e) {
  e.preventDefault();
  // TODO-BACKEND: Sambungkan dengan endpoint POST /api/admin/modul
  tutupModalModul();
  if (typeof tampilkanToast === 'function') {
    tampilkanToast('Data modul pembelajaran berhasil disimpan');
  }
}

function hapusModul(id) {
  // TODO-BACKEND: Sambungkan dengan endpoint DELETE /api/admin/modul/{id}
  if (confirm('Hapus modul ini dari silabus kursus?')) {
    if (typeof tampilkanToast === 'function') {
      tampilkanToast('Modul berhasil dihapus dari silabus');
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  muatDataModul();
  if (window.lucide) lucide.createIcons();
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
