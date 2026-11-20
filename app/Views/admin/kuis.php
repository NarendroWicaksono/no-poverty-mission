<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--spasi-24); flex-wrap: wrap; gap: var(--spasi-16);">
      <div>
        <h1 style="font-family: var(--font-judul); font-size: 26px; font-weight: 600; color: var(--teks); margin-bottom: var(--spasi-4);">
          Kelola soal kuis
        </h1>
        <p style="font-size: var(--teks-14); color: var(--teks-2); margin: 0;">
          Bank soal evaluasi akhir kursus (pilihan ganda dengan pembahasan).
        </p>
      </div>

      <button type="button" id="btn-tambah-kuis" class="tombol tombol-utama tombol-kecil">
        <i data-lucide="plus" style="width: 14px; height: 14px;"></i> Tambah butir soal
      </button>
    </div>

    <!-- Pemilih Kursus Dinamis -->
    <div class="kartu" style="padding: var(--spasi-16); margin-bottom: var(--spasi-20);">
      <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--spasi-12);">
        <div style="display: flex; align-items: center; gap: var(--spasi-12); flex: 1; min-width: 280px;">
          <label for="pilih-kursus-kuis" style="font-size: var(--teks-12); font-weight: 500; color: var(--teks-2); white-space: nowrap;">
            Pilih kursus:
          </label>
          <select id="pilih-kursus-kuis" class="bidang-pilihan" style="height: 36px; font-size: var(--teks-14); flex: 1;">
            <!-- Diisi dinamis -->
          </select>
        </div>
        <span class="lencana-status lencana-netral" id="badge-total-soal">0 butir soal</span>
      </div>
    </div>

    <!-- Tabel Butir Soal -->
    <div class="kartu" style="padding: 0;">
      <div class="wadah-tabel" style="border: none; border-radius: 0;">
        <table class="tabel-data">
          <thead>
            <tr>
              <th style="width: 50px;">No</th>
              <th>Pertanyaan kuis</th>
              <th style="width: 80px;">Kunci</th>
              <th>Pembahasan jawaban</th>
              <th style="width: 130px; text-align: right;">Aksi</th>
            </tr>
          </thead>
          <tbody id="tabel-kuis-body">
            <tr>
              <td colspan="5" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Memuat bank soal kuis...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

<!-- Dialog Modal Tambah / Ubah Soal Kuis -->
<div class="dialog-latar" id="dialog-kuis">
  <div class="dialog-kartu">
    <div class="dialog-kepala">
      <div>
        <div style="font-size: var(--teks-16); font-weight: 500; color: var(--teks);" id="dialog-kuis-judul">Tambah butir soal kuis</div>
        <div style="font-size: var(--teks-12); color: var(--teks-3);">Masukkan pertanyaan pilihan ganda dan kunci jawaban</div>
      </div>
      <button type="button" id="btn-tutup-kuis-x" style="background:none; border:none; color:var(--teks-3); cursor:pointer;">
        <i data-lucide="x" style="width: 18px; height: 18px;"></i>
      </button>
    </div>

    <form id="form-modal-kuis">
      <input type="hidden" id="modal-kuis-id" value="">

      <div class="grup-input">
        <label class="label-bidang" for="modal-pertanyaan">Kalimat pertanyaan</label>
        <textarea id="modal-pertanyaan" class="bidang-teks" style="min-height: 80px;" placeholder="Tuliskan pertanyaan di sini..." required></textarea>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spasi-12);">
        <div class="grup-input">
          <label class="label-bidang" for="modal-opsi-a">Pilihan A</label>
          <input type="text" id="modal-opsi-a" class="bidang-input" placeholder="Teks opsi A" required>
        </div>
        <div class="grup-input">
          <label class="label-bidang" for="modal-opsi-b">Pilihan B</label>
          <input type="text" id="modal-opsi-b" class="bidang-input" placeholder="Teks opsi B" required>
        </div>
        <div class="grup-input">
          <label class="label-bidang" for="modal-opsi-c">Pilihan C</label>
          <input type="text" id="modal-opsi-c" class="bidang-input" placeholder="Teks opsi C" required>
        </div>
        <div class="grup-input">
          <label class="label-bidang" for="modal-opsi-d">Pilihan D</label>
          <input type="text" id="modal-opsi-d" class="bidang-input" placeholder="Teks opsi D" required>
        </div>
      </div>

      <div class="grup-input">
        <label class="label-bidang" for="modal-kunci">Kunci jawaban benar</label>
        <select id="modal-kunci" class="bidang-pilihan" required>
          <option value="A">Pilihan A</option>
          <option value="B">Pilihan B</option>
          <option value="C">Pilihan C</option>
          <option value="D">Pilihan D</option>
        </select>
      </div>

      <div class="grup-input">
        <label class="label-bidang" for="modal-pembahasan">Penjelasan pembahasan singkat</label>
        <textarea id="modal-pembahasan" class="bidang-teks" style="min-height: 80px;" placeholder="Jelaskan alasan kunci jawaban benar..." required></textarea>
      </div>

      <div class="dialog-kaki">
        <button type="button" id="btn-batal-kuis" class="tombol tombol-sekunder tombol-kecil">Batal</button>
        <button type="submit" class="tombol tombol-utama tombol-kecil">Simpan butir soal</button>
      </div>
    </form>
  </div>
</div>

<script type="module">
  import {
    ambilDaftarKursus,
    ambilSoalKuisAdmin,
    tambahSoalKuis,
    ubahSoalKuis,
    hapusSoalKuis
  } from '../assets/js/api.js';

  let soalListAktif = [];
  let kuisSlugAktif = '';
  const selectKursus = document.getElementById('pilih-kursus-kuis');
  const dialog = document.getElementById('dialog-kuis');

  async function inisialisasiKursus() {
    const kursusList = await ambilDaftarKursus();
    selectKursus.innerHTML = kursusList.map(k => `<option value="${k.slug}">${k.judul}</option>`).join('');
    if (kursusList.length > 0) {
      kuisSlugAktif = kursusList[0].slug;
      await muatTabelKuis();
    }
  }

  async function muatTabelKuis() {
    soalListAktif = await ambilSoalKuisAdmin(kuisSlugAktif);
    const tbody = document.getElementById('tabel-kuis-body');
    document.getElementById('badge-total-soal').textContent = `${soalListAktif.length} butir soal`;

    if (!soalListAktif.length) {
      tbody.innerHTML = `<tr><td colspan="5" style="text-align: center; color: var(--teks-3); padding: var(--spasi-32);">Belum ada butir soal untuk kursus ini.</td></tr>`;
      return;
    }

    tbody.innerHTML = soalListAktif.map((s, idx) => `
      <tr>
        <td style="font-family: var(--font-angka); color: var(--teks-3);">${idx + 1}</td>
        <td>
          <div style="font-weight: 500; color: var(--teks); max-width: 480px; line-height: 1.4;">${s.pertanyaan}</div>
        </td>
        <td><span class="lencana-status lencana-aksen">${s.jawaban_benar}</span></td>
        <td style="font-size: var(--teks-12); color: var(--teks-2); max-width: 320px; line-height: 1.4;">
          ${s.pembahasan || '-'}
        </td>
        <td style="text-align: right;">
          <div style="display: inline-flex; gap: var(--spasi-4);">
            <button type="button" data-edit-id="${s.id}" class="tombol tombol-sekunder tombol-kecil btn-edit-kuis" style="height: 28px; padding: 0 8px;" title="Ubah butir soal">
              <i data-lucide="edit-3" style="width: 13px; height: 13px;"></i>
            </button>
            <button type="button" data-hapus-id="${s.id}" class="tombol tombol-sekunder tombol-kecil btn-hapus-kuis" style="height: 28px; padding: 0 8px; color: var(--galat);" title="Hapus butir soal">
              <i data-lucide="trash-2" style="width: 13px; height: 13px;"></i>
            </button>
          </div>
        </td>
      </tr>
    `).join('');

    if (window.lucide) lucide.createIcons();

    tbody.querySelectorAll('.btn-edit-kuis').forEach(btn => {
      btn.addEventListener('click', () => bukaEditKuis(Number(btn.dataset.editId)));
    });
    tbody.querySelectorAll('.btn-hapus-kuis').forEach(btn => {
      btn.addEventListener('click', () => prosesHapusKuis(Number(btn.dataset.hapusId)));
    });
  }

  function bukaTambahKuis() {
    document.getElementById('dialog-kuis-judul').textContent = 'Tambah butir soal kuis';
    document.getElementById('modal-kuis-id').value = '';
    document.getElementById('modal-pertanyaan').value = '';
    document.getElementById('modal-opsi-a').value = '';
    document.getElementById('modal-opsi-b').value = '';
    document.getElementById('modal-opsi-c').value = '';
    document.getElementById('modal-opsi-d').value = '';
    document.getElementById('modal-kunci').value = 'A';
    document.getElementById('modal-pembahasan').value = '';
    dialog.classList.add('terbuka');
  }

  function bukaEditKuis(id) {
    const s = soalListAktif.find(item => item.id === id);
    if (!s) return;
    document.getElementById('dialog-kuis-judul').textContent = 'Ubah butir soal kuis';
    document.getElementById('modal-kuis-id').value = s.id;
    document.getElementById('modal-pertanyaan').value = s.pertanyaan;
    document.getElementById('modal-opsi-a').value = s.pilihan ? s.pilihan.A : '';
    document.getElementById('modal-opsi-b').value = s.pilihan ? s.pilihan.B : '';
    document.getElementById('modal-opsi-c').value = s.pilihan ? s.pilihan.C : '';
    document.getElementById('modal-opsi-d').value = s.pilihan ? s.pilihan.D : '';
    document.getElementById('modal-kunci').value = s.jawaban_benar;
    document.getElementById('modal-pembahasan').value = s.pembahasan || '';
    dialog.classList.add('terbuka');
  }

  function tutupModal() {
    dialog.classList.remove('terbuka');
  }

  async function prosesHapusKuis(id) {
    if (!confirm('Hapus butir soal ini dari evaluasi kursus?')) return;
    await hapusSoalKuis(id);
    await muatTabelKuis();
    if (typeof tampilkanToast === 'function') tampilkanToast('Butir soal berhasil dihapus', 'sukses');
  }

  selectKursus.addEventListener('change', async () => {
    kuisSlugAktif = selectKursus.value;
    await muatTabelKuis();
  });

  document.getElementById('btn-tambah-kuis').addEventListener('click', bukaTambahKuis);
  document.getElementById('btn-tutup-kuis-x').addEventListener('click', tutupModal);
  document.getElementById('btn-batal-kuis').addEventListener('click', tutupModal);
  dialog.addEventListener('click', e => { if (e.target === dialog) tutupModal(); });

  document.getElementById('form-modal-kuis').addEventListener('submit', async (e) => {
    e.preventDefault();
    const idEdit = document.getElementById('modal-kuis-id').value;
    const payload = {
      kursus_slug: kuisSlugAktif,
      pertanyaan: document.getElementById('modal-pertanyaan').value.trim(),
      opsi_a: document.getElementById('modal-opsi-a').value.trim(),
      opsi_b: document.getElementById('modal-opsi-b').value.trim(),
      opsi_c: document.getElementById('modal-opsi-c').value.trim(),
      opsi_d: document.getElementById('modal-opsi-d').value.trim(),
      jawaban_benar: document.getElementById('modal-kunci').value,
      pembahasan: document.getElementById('modal-pembahasan').value.trim()
    };

    if (idEdit) {
      await ubahSoalKuis(Number(idEdit), payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Butir soal berhasil diperbarui', 'sukses');
    } else {
      await tambahSoalKuis(payload);
      if (typeof tampilkanToast === 'function') tampilkanToast('Butir soal baru berhasil ditambahkan', 'sukses');
    }
    tutupModal();
    await muatTabelKuis();
  });

  document.addEventListener('DOMContentLoaded', inisialisasiKursus);
</script>
