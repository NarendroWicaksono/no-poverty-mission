/**
 * Skill4Life - API Client Engine (assets/js/api.js)
 * Terhubung penuh ke backend PHP Native + MySQL melalui api/index.php.
 */

const dapatkanBasisPath = () => {
  const lokasi = window.location.pathname;
  if (
    lokasi.includes('/kursus/') ||
    lokasi.includes('/dashboard/') ||
    lokasi.includes('/admin/') ||
    lokasi.includes('/auth/') ||
    lokasi.includes('/sertifikat/')
  ) {
    return '../';
  }
  return './';
};

const BASIS_URL = dapatkanBasisPath();
const API_URL = `${BASIS_URL}api/index.php`;

async function requestGET(aksi, params = {}) {
  const qs = new URLSearchParams({ aksi, ...params });
  const res = await fetch(`${API_URL}?${qs.toString()}`, {
    credentials: 'same-origin',
  });
  return await res.json();
}

async function requestPOST(aksi, body = {}) {
  const res = await fetch(`${API_URL}?aksi=${encodeURIComponent(aksi)}`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'same-origin',
    body: JSON.stringify(body),
  });
  return await res.json();
}

/* ========================================================
   1. MANAJEMEN SESI & AUTENTIKASI
   ======================================================== */

export function ambilSesiPengguna() {
  return window.__S4L_USER__ || null;
}

export async function keluarAkun() {
  try {
    await requestPOST('logout');
  } catch (e) {
    console.error('Gagal logout:', e);
  }
  window.__S4L_USER__ = null;
}

export async function ambilSemuaPeserta() {
  try {
    const res = await requestGET('semua_peserta');
    return res.ok ? res.data : [];
  } catch {
    return [];
  }
}

export async function masukAkun(email, kataSandi, peranDiharapkan = 'peserta') {
  try {
    const res = await requestPOST('login', {
      email,
      kata_sandi: kataSandi,
      peran: peranDiharapkan,
    });
    if (res.ok && res.user) {
      window.__S4L_USER__ = res.user;
    }
    return res;
  } catch {
    return { ok: false, pesan: 'Gagal menghubungi server database.' };
  }
}

export async function daftarAkun({ nama_lengkap, email, kata_sandi, pekerjaan = 'Pencari kerja', kota = 'Indonesia' }) {
  try {
    const res = await requestPOST('daftar', {
      nama_lengkap,
      email,
      kata_sandi,
      pekerjaan,
      kota,
    });
    if (res.ok && res.user) {
      window.__S4L_USER__ = res.user;
    }
    return res;
  } catch {
    return { ok: false, pesan: 'Gagal menghubungi server database.' };
  }
}

export async function perbaruiProfilPengguna({ nama_lengkap, nomor_telepon, pekerjaan, kota }) {
  try {
    const res = await requestPOST('perbarui_profil', {
      nama_lengkap,
      nomor_telepon,
      pekerjaan,
      kota,
    });
    if (res.ok && res.user) {
      window.__S4L_USER__ = res.user;
    }
    return res;
  } catch {
    return { ok: false, pesan: 'Gagal memperbarui profil ke server.' };
  }
}

export async function ubahKataSandiPengguna({ sandi_lama, sandi_baru }) {
  try {
    return await requestPOST('ubah_sandi', { sandi_lama, sandi_baru });
  } catch {
    return { ok: false, pesan: 'Gagal memperbarui kata sandi ke server.' };
  }
}

export function normalisasiUrlYoutube(url) {
  const bersih = (url || '').trim();
  if (!bersih) return '';
  const m = bersih.match(/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/);
  return m ? `https://www.youtube.com/embed/${m[1]}` : bersih;
}

/* ========================================================
   2. DATA PUBLIK: STATISTIK, KATEGORI, KURSUS, MODUL
   ======================================================== */

export async function ambilStatistik() {
  try {
    const res = await requestGET('statistik');
    if (res.ok && res.data) {
      return res.data;
    }
  } catch (e) {
    console.error('Gagal memuat statistik:', e);
  }
  return {
    total_kursus: 0,
    total_modul: 0,
    total_sertifikat: 0,
    mitra_komunitas: 32,
  };
}

export async function ambilKategori() {
  try {
    const res = await requestGET('kategori');
    return res.ok ? res.data : [];
  } catch (error) {
    console.error('Gagal memuat kategori:', error);
    return [];
  }
}

export async function ambilDaftarKursus() {
  try {
    const res = await requestGET('kursus');
    return res.ok ? res.data : [];
  } catch {
    return [];
  }
}

export async function ambilDetailKursus(slugKursus) {
  try {
    const res = await requestGET('detail_kursus', { slug: slugKursus });
    return res.ok ? res.data : null;
  } catch {
    return null;
  }
}

export async function ambilDaftarModul(slugKursus) {
  try {
    const res = await requestGET('modul', { slug: slugKursus });
    return res.ok ? res.data : [];
  } catch {
    return [];
  }
}

/* ========================================================
   3. PROGRES BELAJAR & RINGKASAN DASHBOARD
   ======================================================== */

export async function ambilProgresKursus(slugKursus) {
  try {
    const res = await requestGET('progres_kursus', { slug: slugKursus });
    return res.ok && Array.isArray(res.data) ? res.data : [];
  } catch {
    return [];
  }
}

export async function simpanProgres(slugKursus, idModul) {
  try {
    return await requestPOST('simpan_progres', { slug: slugKursus, id_modul: idModul });
  } catch {
    return { sukses: false, modul_selesai: [] };
  }
}

export async function hapusProgres(slugKursus, idModul) {
  try {
    return await requestPOST('hapus_progres', { slug: slugKursus, id_modul: idModul });
  } catch {
    return { sukses: false, modul_selesai: [] };
  }
}

export async function ambilRingkasanKursusPeserta() {
  try {
    const res = await requestGET('ringkasan_peserta');
    return res.ok ? res.data : [];
  } catch {
    return [];
  }
}

/* ========================================================
   4. KUIS EVALUASI & PENERBITAN SERTIFIKAT
   ======================================================== */

export async function ambilSoalKuis(slugKursus) {
  try {
    const res = await requestGET('soal_kuis', { slug: slugKursus });
    return res.ok ? res.data : [];
  } catch {
    return [];
  }
}

export async function kirimHasilKuis(slugKursus, lembarJawaban) {
  return await requestPOST('kirim_kuis', {
    slug: slugKursus,
    jawaban: lembarJawaban,
  });
}

export async function ambilSemuaSertifikat() {
  try {
    const res = await requestGET('semua_sertifikat');
    return res.ok ? res.data : [];
  } catch {
    return [];
  }
}

export async function ambilSertifikat(nomorSertifikat) {
  try {
    const res = await requestGET('sertifikat', { nomor: nomorSertifikat });
    return res.ok ? res.data : null;
  } catch {
    return null;
  }
}

export async function ambilSertifikatPengguna() {
  try {
    const res = await requestGET('sertifikat_pengguna');
    return res.ok ? res.data : [];
  } catch {
    return [];
  }
}

export async function ambilProfilPengguna() {
  const sesi = ambilSesiPengguna();
  const pesertaList = await ambilSemuaPeserta();
  return {
    peserta_aktif: sesi || {},
    daftar_peserta: pesertaList,
  };
}

/* ========================================================
   5. CRUD PANEL PENGELOLA (ADMIN) & RESET DEMO
   ======================================================== */

export async function tambahKursus(data) {
  const res = await requestPOST('tambah_kursus', data);
  return res.ok ? res.data : null;
}

export async function ubahKursus(idKursus, data) {
  const res = await requestPOST('ubah_kursus', { id_kursus: idKursus, ...data });
  return res.ok ? res.data : null;
}

export async function hapusKursus(idKursus) {
  const res = await requestPOST('hapus_kursus', { id_kursus: idKursus });
  return Boolean(res.ok);
}

export async function tambahModul(data) {
  const res = await requestPOST('tambah_modul', data);
  return res.ok ? res.data : null;
}

export async function ubahModul(idModul, data) {
  const res = await requestPOST('ubah_modul', { id_modul: idModul, ...data });
  return Boolean(res.ok);
}

export async function hapusModul(idModul) {
  const res = await requestPOST('hapus_modul', { id_modul: idModul });
  return Boolean(res.ok);
}

export async function tambahSoalKuis(data) {
  const res = await requestPOST('tambah_soal', data);
  return Boolean(res.ok);
}

export async function ubahSoalKuis(idSoal, data) {
  const res = await requestPOST('ubah_soal', { id_soal: idSoal, ...data });
  return Boolean(res.ok);
}

export async function hapusSoalKuis(idSoal) {
  const res = await requestPOST('hapus_soal', { id_soal: idSoal });
  return Boolean(res.ok);
}

export async function resetDataDemo() {
  return await requestPOST('reset_demo');
}
