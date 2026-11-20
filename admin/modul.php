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

      <button type="button" id="btn-tambah-modul" class="tombol tombol-utama tombol-kecil">
        <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Tambah modul baru
      </button>
    </div>

    <!-- Pemilih Kursus Dinamis -->
    <div class="kartu" style="padding: var(--spasi-16); margin-bottom: var(--spasi-20);">
      <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--spasi-12);">
        <div style="display: flex; align-items: center; gap: var(--spasi-12); flex: 1; min-width: 280px;">
          <label for="pilih-kursus" style="font-size: var(--teks-12); font-weight: 500; color: var(--teks-2); white-space: nowrap;">
            Pilih kursus:
          </label>
          <select id="pilih-kursus" class="bidang-pilihan" style="height: 36px; font-size: var(--teks-14); flex: 1;">
            <!-- Diisi dinamis -->
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
<div class="dialog-latar" id="dialog-modul">
  <div class="dialog-kartu">
    <div class="dialog-kepala">
      <div>
        <div style="font-size: var(--teks-16); font-weight: 500; color: var(--teks);" id="dialog-modul-judul">Tambah modul materi</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3);">Masukkan detail bacaan dan tautan video pembelajaran</div>
      </div>
      <button type="button" id="btn-tutup-modul-x" style="background:none; border:none; color:var(--teks-3); cursor:pointer;">
        <i data-lucide="x" style="width: 18px; height: 18px;"></i>
      </button>
    </div>

    <form id="form-modal-modul">
      <input type="hidden" id="modal-modul-id" value="">
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
        <button type="button" id="btn-batal-modul" class="tombol tombol-sekunder tombol-kecil">Batal</button>
        <button type="submit" class="tombol tombol-utama tombol-kecil">Simpan modul</button>
      </div>
    </form>
  </div>
</div>

<script type="module">
  import {
    ambilDaftarKursus,
    ambilDaftarModul,
    tambahModul,
    ubahModul,
    hapusModul
  } from '../assets/js/api.js';

  let modulListAktif = [];
  let slugKursusAktif = '';
  const selectKursus = document.getElementById('pilih-kursus');
  const dialog = document.getElementById('dialog-modul');

  async function inisialisasiKursus() {
    const kursusList = await ambilDaftarKursus();
    selectKursus.innerHTML = kursusList.map(k => `<option value="${k.slug}">${k.judul}</option>`).join('');
    if (kursusList.length > 0) {
      slugKursusAktif = kursusList[0].slug;
      await muatTabelModul();
    }
  }

  async function muatTabelModul() {
    modulListAktif = await ambilDaftarModul(slugKursusAktif);
    const tbody = document.getElementById('tabel-modul-body');
    document.getElementById('badge-total-modul').textContent = `${modulListAktif.length} modul terdaftar`;

    if (!modulListAktif.length) {
      tbody.innerHTML = `<tr><td colspan="5" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Belum ada modul untuk kursus ini.</td></tr>`;
      return;
    }

    tbody.innerHTML = modulListAktif.map(m => `
      <tr>
        <td style="font-family: var(--font-angka); color: var(--teks-3);">#${m.urutan}</td>
        <td><div style="font-weight: 500; color: var(--teks);">${m.judul_modul}</div></td>
        <td style="font-family: var(--font-angka); color: var(--teks-2); font-size: var(--teks-12);">${m.estimasi_menit} menit</td>
        <td>
          ${m.video_url
            ? '<span class="lencana-status lencana-aksen">Video + teks</span>'
            : '<span class="lencana-status lencana-netral">Teks bacaan</span>'}
        </td>
        <td style="text-align: right;">
          <div style="display: inline-flex; gap: var(--spasi-4);">
            <button type="button" data-edit-id="${m.id}" class="tombol tombol-sekunder tombol-kecil btn-edit-modul" style="height: 28px; padding: 0 8px;" title="Ubah modul">
              <i data-lucide="edit-3" style="width: 13px; height: 13px;"></i>
            </button>
            <button type="button" data-hapus-id="${m.id}" class="tombol tombol-sekunder tombol-kecil btn-hapus-modul" style="height: 28px; padding: 0 8px; color: var(--galat);" title="Hapus modul">
              <i data-lucide="trash-2" style="width: 13px; height: 13px;"></i>
            </button>
          </div>
        </td>
      </tr>
    `).join('');

    if (window.lucide) lucide.createIcons();

    tbody.querySelectorAll('.btn-edit-modul').forEach(btn => {
      btn.addEventListener('click', () => bukaEditModul(Number(btn.dataset.editId)));
    });
    tbody.querySelectorAll('.btn-hapus-modul').forEach(btn => {
      btn.addEventListener('click', () => prosesHapusModul(Number(btn.dataset.hapusId)));
    });
  }

  function bukaTambahModul() {
    document.getElementById('dialog-modul-judul').textContent = 'Tambah modul materi';
    document.getElementById('modal-modul-id').value = '';
    document.getElementById('modal-modul-urutan').value = modulListAktif.length + 1;
    document.getElementById('modal-modul-judul-teks').value = '';
    document.getElementById('modal-modul-durasi').value = 20;
    document.getElementById('modal-modul-video').value = '';
    document.getElementById('modal-modul-konten').value = '';
    dialog.classList.add('terbuka');
  }

  function bukaEditModul(id) {
    const m = modulListAktif.find(item => item.id === id);
    if (!m) return;
    document.getElementById('dialog-modul-judul').textContent = 'Ubah modul materi';
    document.getElementById('modal-modul-id').value = m.id;
    document.getElementById('modal-modul-urutan').value = m.urutan;
    document.getElementById('modal-modul-judul-teks').value = m.judul_modul;
    document.getElementById('modal-modul-durasi').value = m.estimasi_menit;
    document.getElementById('modal-modul-video').value = m.video_url || '';
    document.getElementById('modal-modul-konten').value = m.konten || '';
    dialog.classList.add('terbuka');
  }

  function tutupModal() {
    dialog.classList.remove('terbuka');
  }

  async function prosesHapusModul(id) {
    if (!confirm('Hapus modul ini dari silabus kursus?')) return;
    await hapusModul(id);
    await muatTabelModul();
    if (typeof tampilkanToast === 'function') tampilkanToast('Modul berhasil dihapus', 'sukses');
  }

  selectKursus.addEventListener('change', async () => {
    slugKursusAktif = selectKursus.value;
    await muatTabelModul();
  });

  document.getElementById('btn-tambah-modul').addEventListener('click', bukaTambahModul);
  document.getElementById('btn-tutup-modul-x').addEventListener('click', tutupModal);
  document.getElementById('btn-batal-modul').addEventListener('click', tutupModal);
  dialog.addEventListener('click', e => { if (e.target === dialog) tutupModal(); });

  document.getElementById('form-modal-modul').addEventListener('submit', async (e) => {
    e.preventDefault();
    const idEdit = document.getElementById('modal-modul-id').value;
    const payload = {
      kursus_slug: slugKursusAktif,
      urutan: document.getElementById('modal-modul-urutan').value,
      judul_modul: document.getElementById('modal-modul-judul-teks').value.trim(),
      estimasi_menit: document.getElementById('modal-modul-durasi').value,
      video_url: document.getElementById('modal-modul-video').value.trim(),
      konten: document.getElementById('modal-modul-konten').value.trim()
    };

    if (idEdit) {
      await ubahModul(Number(idEdit), payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Modul berhasil diperbarui', 'sukses');
    } else {
      await tambahModul(payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Modul baru berhasil ditambahkan', 'sukses');
    }
    tutupModal();
    await muatTabelModul();
  });

  document.addEventListener('DOMContentLoaded', inisialisasiKursus);
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
