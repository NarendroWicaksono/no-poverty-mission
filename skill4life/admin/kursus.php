<?php
$baseUrl = '..';
$judulHalaman = 'Kelola Kursus - Panel Pengelola Skill4Life';
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
          Kelola kursus
        </h1>
        <p style="font-size: var(--teks-14); color: var(--teks-2); margin: 0;">
          Daftar kurikulum keterampilan kerja aktif yang tersedia di katalog publik.
        </p>
      </div>

      <button type="button" onclick="bukaModalKursus()" class="tombol tombol-utama tombol-kecil">
        <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Tambah kursus baru
      </button>
    </div>

    <div class="kartu" style="padding: 0;">
      <div style="padding: var(--spasi-16) var(--spasi-20); border-bottom: 1px solid var(--garis); display: flex; justify-content: space-between; align-items: center; gap: var(--spasi-16); flex-wrap: wrap;">
        <div style="font-size: var(--teks-14); font-weight: 500; color: var(--teks);">
          Daftar kursus terdaftar (<span id="total-kursus-badge" style="font-family: var(--font-angka);">0</span>)
        </div>
        <div style="max-width: 280px; width: 100%;">
          <input type="search" id="cari-kursus" class="bidang-input" placeholder="Cari judul kursus..." oninput="saringTabelKursus(this.value)" style="height: 36px; font-size: var(--teks-12);">
        </div>
      </div>

      <div class="wadah-tabel" style="border: none; border-radius: 0;">
        <table class="tabel-data">
          <thead>
            <tr>
              <th style="width: 48px;">No</th>
              <th>Judul &amp; kategori</th>
              <th>Tingkat</th>
              <th>Durasi &amp; modul</th>
              <th>Peserta</th>
              <th style="width: 130px; text-align: right;">Aksi</th>
            </tr>
          </thead>
          <tbody id="tabel-kursus-body">
            <tr>
              <td colspan="6" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Memuat data kursus...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<!-- Dialog Modal Tambah / Ubah Kursus -->
<div class="dialog-latar" id="dialog-kursus" onclick="if(event.target===this) tutupModalKursus()">
  <div class="dialog-kartu">
    <div class="dialog-kepala">
      <div>
        <div style="font-size: var(--teks-16); font-weight: 500; color: var(--teks);" id="dialog-kursus-judul">Tambah kursus baru</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3);">Masukkan informasi kurikulum kerja</div>
      </div>
      <button type="button" onclick="tutupModalKursus()" style="background:none; border:none; color:var(--teks-3); cursor:pointer;">
        <i data-lucide="x" style="width: 18px; height: 18px;"></i>
      </button>
    </div>

    <form onsubmit="simpanKursus(event)">
      <div class="grup-input">
        <label class="label-bidang" for="modal-judul">Judul kursus</label>
        <input type="text" id="modal-judul" class="bidang-input" placeholder="Contoh: Microsoft Excel Dasar" required>
      </div>

      <div class="grup-input">
        <label class="label-bidang" for="modal-kategori">Kategori</label>
        <select id="modal-kategori" class="bidang-pilihan" required>
          <option value="Aplikasi perkantoran">Aplikasi perkantoran</option>
          <option value="Kesiapan karir dan kerja">Kesiapan karir dan kerja</option>
        </select>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spasi-16);">
        <div class="grup-input">
          <label class="label-bidang" for="modal-tingkat">Tingkat kesulitan</label>
          <select id="modal-tingkat" class="bidang-pilihan">
            <option value="Pemula">Pemula</option>
            <option value="Menengah">Menengah</option>
            <option value="Lanjut">Lanjut</option>
          </select>
        </div>
        <div class="grup-input">
          <label class="label-bidang" for="modal-durasi">Estimasi waktu</label>
          <input type="text" id="modal-durasi" class="bidang-input" value="2.5 jam" placeholder="Contoh: 2.5 jam">
        </div>
      </div>

      <div class="grup-input">
        <label class="label-bidang" for="modal-ringkasan">Ringkasan singkat</label>
        <textarea id="modal-ringkasan" class="bidang-teks" style="min-height: 80px;" placeholder="Penjelasan singkat kursus..." required></textarea>
      </div>

      <div class="dialog-kaki">
        <button type="button" onclick="tutupModalKursus()" class="tombol tombol-sekunder tombol-kecil">Batal</button>
        <button type="submit" class="tombol tombol-utama tombol-kecil">Simpan data kursus</button>
      </div>
    </form>
  </div>
</div>

<script>
let daftarKursusGlobal = [];

async function muatTabelKursus() {
  try {
    const res = await fetch('<?= $baseUrl ?>/assets/data/kursus.json');
    if (res.ok) {
      daftarKursusGlobal = await res.json();
      tampilkanTabelKursus(daftarKursusGlobal);
    }
  } catch (err) {
    console.error('Gagal memuat kursus:', err);
  }
}

function tampilkanTabelKursus(data) {
  const tbody = document.getElementById('tabel-kursus-body');
  const badge = document.getElementById('total-kursus-badge');
  if (badge) badge.textContent = data.length;

  if (!tbody) return;
  if (!data.length) {
    tbody.innerHTML = `<tr><td colspan="6" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Tidak ada data kursus yang cocok.</td></tr>`;
    return;
  }

  tbody.innerHTML = data.map((k, idx) => `
    <tr>
      <td style="font-family: var(--font-angka); color: var(--teks-3);">${idx + 1}</td>
      <td>
        <div style="font-weight: 500; color: var(--teks);">${k.judul}</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3);">${k.kategori_nama || k.kategori || 'Keterampilan kerja'}</div>
      </td>
      <td>
        <span class="lencana-status lencana-netral">${k.tingkat_kesulitan || k.level || 'Pemula'}</span>
      </td>
      <td style="font-family: var(--font-angka); font-size: var(--teks-12); color: var(--teks-2);">
        ${k.jumlah_modul || 4} modul · ${k.estimasi_waktu || '2 jam'}
      </td>
      <td style="font-family: var(--font-angka); color: var(--teks-2);">
        ${(k.peserta || 1200).toLocaleString('id-ID')}
      </td>
      <td style="text-align: right;">
        <div style="display: inline-flex; gap: var(--spasi-4);">
          <button type="button" onclick="editKursus(${k.id || idx + 1})" class="tombol tombol-sekunder tombol-kecil" style="height: 28px; padding: 0 8px;" title="Ubah data">
            <i data-lucide="edit-3" style="width: 13px; height: 13px;"></i>
          </button>
          <button type="button" onclick="hapusKursus(${k.id || idx + 1})" class="tombol tombol-sekunder tombol-kecil" style="height: 28px; padding: 0 8px; color: var(--galat);" title="Hapus kursus">
            <i data-lucide="trash-2" style="width: 13px; height: 13px;"></i>
          </button>
        </div>
      </td>
    </tr>
  `).join('');

  if (window.lucide) lucide.createIcons();
}

function saringTabelKursus(kataKunci) {
  const q = kataKunci.toLowerCase().trim();
  const terfilter = daftarKursusGlobal.filter(k => 
    k.judul.toLowerCase().includes(q) || 
    (k.kategori_nama && k.kategori_nama.toLowerCase().includes(q))
  );
  tampilkanTabelKursus(terfilter);
}

function bukaModalKursus() {
  document.getElementById('dialog-kursus-judul').textContent = 'Tambah kursus baru';
  document.getElementById('modal-judul').value = '';
  document.getElementById('modal-ringkasan').value = '';
  document.getElementById('dialog-kursus').classList.add('terbuka');
}

function editKursus(id) {
  const k = daftarKursusGlobal.find(item => (item.id === id || item.id_kursus === id)) || daftarKursusGlobal[0];
  if (k) {
    document.getElementById('dialog-kursus-judul').textContent = 'Ubah data kursus';
    document.getElementById('modal-judul').value = k.judul;
    document.getElementById('modal-ringkasan').value = k.ringkasan || '';
    document.getElementById('dialog-kursus').classList.add('terbuka');
  }
}

function tutupModalKursus() {
  document.getElementById('dialog-kursus').classList.remove('terbuka');
}

function simpanKursus(e) {
  e.preventDefault();
  // TODO-BACKEND: Sambungkan dengan endpoint POST /api/admin/kursus
  tutupModalKursus();
  if (typeof tampilkanToast === 'function') {
    tampilkanToast('Perubahan data kursus berhasil disimpan');
  }
}

function hapusKursus(id) {
  // TODO-BACKEND: Sambungkan dengan endpoint DELETE /api/admin/kursus/{id}
  if (confirm('Hapus kursus ini dari kurikulum aktif?')) {
    if (typeof tampilkanToast === 'function') {
      tampilkanToast('Kursus berhasil dihapus dari daftar');
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  muatTabelKursus();
  if (window.lucide) lucide.createIcons();
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
