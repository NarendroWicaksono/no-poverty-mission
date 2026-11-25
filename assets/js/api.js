/**
 * Skill4Life - API Client Engine (assets/js/api.js)
 * Terhubung penuh ke backend PHP Native + MySQL melalui api/index.php.
 */

const dapatkanBasisPath = () => {
  const lokasi = window.location.pathname;
  if (
    lokasi.includes('/kursus/') ||
    lokasi.includes('/dashboard/') ||
    lokasi.includes('/pengelola/') ||
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
  const text = await res.text();
  try {
    return JSON.parse(text);
  } catch (err) {
    console.warn(`[API GET ${aksi}] Respon bukan format JSON:`, text.substring(0, 200));
    throw new Error('Respon server tidak valid.');
  }
}

async function requestPOST(aksi, body = {}) {
  const res = await fetch(`${API_URL}?aksi=${encodeURIComponent(aksi)}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': window.__S4L_CSRF__ || '',
    },
    credentials: 'same-origin',
    body: JSON.stringify(body),
  });
  const text = await res.text();
  try {
    return JSON.parse(text);
  } catch (err) {
    console.warn(`[API POST ${aksi}] Respon bukan format JSON:`, text.substring(0, 200));
    if (text.includes('aes.js') || text.includes('__test')) {
      throw new Error('Sistem keamanan InfinityFree memblokir request. Silakan muat ulang (refresh) halaman.');
    }
    throw new Error('Gagal menghubungi server database.');
  }
}

/* ========================================================
   1. MANAJEMEN SESI & AUTENTIKASI
   ======================================================== */

export function ambilSesiPengguna() {
  if (window.__S4L_USER__) {
    return window.__S4L_USER__;
  }
  const tersimpan = sessionStorage.getItem('s4l_demo_user');
  if (tersimpan) {
    try {
      window.__S4L_USER__ = JSON.parse(tersimpan);
      return window.__S4L_USER__;
    } catch {}
  }
  return null;
}

export async function keluarAkun() {
  try {
    await requestPOST('logout');
  } catch (e) {
    console.error('Gagal logout:', e);
  }
  window.__S4L_USER__ = null;
  sessionStorage.removeItem('s4l_demo_user');
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
  } catch (err) {
    console.error('Login request failed:', err);
    // Graceful fallback untuk akun demo jika database MySQL belum aktif/di-import
    if (email === 'budi@gmail.com' && kataSandi === 'budi1234') {
      const demoUser = {
        id: 1,
        nama_lengkap: 'Budi Santoso',
        email: 'budi@gmail.com',
        nomor_telepon: '081234567890',
        pekerjaan: 'Pencari kerja',
        kota: 'Jakarta',
        peran: 'peserta',
      };
      window.__S4L_USER__ = demoUser;
      sessionStorage.setItem('s4l_demo_user', JSON.stringify(demoUser));
      return { ok: true, user: demoUser, pesan: 'Masuk dengan mode demo.' };
    }
    if (email === 'admin@skill4life.id' && kataSandi === 'admin1234') {
      const demoAdmin = {
        id: 99,
        nama_lengkap: 'Pengelola Skill4Life',
        email: 'admin@skill4life.id',
        nomor_telepon: '081200000000',
        pekerjaan: 'Administrator',
        kota: 'Jakarta',
        peran: 'admin',
      };
      window.__S4L_USER__ = demoAdmin;
      sessionStorage.setItem('s4l_demo_user', JSON.stringify(demoAdmin));
      return { ok: true, user: demoAdmin, pesan: 'Masuk sebagai pengelola demo.' };
    }
    return { ok: false, pesan: err.message || 'Gagal menghubungi server database. Pastikan database MySQL aktif.' };
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
    return { ok: false, modul_selesai: [] };
  }
}

export async function hapusProgres(slugKursus, idModul) {
  try {
    return await requestPOST('hapus_progres', { slug: slugKursus, id_modul: idModul });
  } catch {
    return { ok: false, modul_selesai: [] };
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
   3B. RATING & BOOKMARK VIDEO MATERI
   ======================================================== */

const KEY_LOCAL_RATINGS = 's4l_local_ratings';
const KEY_LOCAL_BOOKMARKS = 's4l_local_bookmarks';

function bacaLocalRatings() {
  try {
    return JSON.parse(localStorage.getItem(KEY_LOCAL_RATINGS) || '{}');
  } catch {
    return {};
  }
}

function simpanLocalRatings(data) {
  try {
    localStorage.setItem(KEY_LOCAL_RATINGS, JSON.stringify(data));
  } catch {}
}

function bacaLocalBookmarks() {
  try {
    return JSON.parse(localStorage.getItem(KEY_LOCAL_BOOKMARKS) || '[]');
  } catch {
    return [];
  }
}

function simpanLocalBookmarks(data) {
  try {
    localStorage.setItem(KEY_LOCAL_BOOKMARKS, JSON.stringify(data));
  } catch {}
}

export async function ambilRatingModul(idModul) {
  try {
    const res = await requestGET('ambil_rating_modul', { id_modul: idModul });
    if (res.ok && res.data) {
      const local = bacaLocalRatings();
      const user = ambilSesiPengguna();
      const userKey = user ? `${user.id || user.email}_${idModul}` : `guest_${idModul}`;
      const entry = local[userKey];
      const ratingUser = (entry && typeof entry === 'object') ? entry.rating : entry;
      if (ratingUser && !res.data.rating_pengguna) {
        res.data.rating_pengguna = ratingUser;
      }
      return res.data;
    }
  } catch (err) {
    console.warn('[API ambilRatingModul fallback]', err);
  }

  // Fallback lokal
  const local = bacaLocalRatings();
  const user = ambilSesiPengguna();
  const userKey = user ? `${user.id || user.email}_${idModul}` : `guest_${idModul}`;
  const entry = local[userKey];
  const ratingUser = (entry && typeof entry === 'object') ? entry.rating : entry;
  return {
    rata_rata: ratingUser ? Number(ratingUser).toFixed(1) : 5.0,
    total_ulasan: ratingUser ? 1 : 0,
    rating_pengguna: ratingUser || null
  };
}

export async function simpanRatingModul(idModul, rating, metaInfo = {}) {
  const user = ambilSesiPengguna();
  const userKey = user ? `${user.id || user.email}_${idModul}` : `guest_${idModul}`;
  const localRatings = bacaLocalRatings();
  localRatings[userKey] = {
    rating: parseInt(rating, 10),
    modul_id: idModul,
    judul_modul: metaInfo.judul_modul || 'Video Materi',
    kursus_judul: metaInfo.kursus_judul || '',
    kursus_slug: metaInfo.kursus_slug || '',
    urutan: metaInfo.urutan || 1,
    diperbarui_pada: new Date().toISOString()
  };
  simpanLocalRatings(localRatings);

  try {
    const res = await requestPOST('simpan_rating', { id_modul: idModul, rating });
    if (res.ok) return res;
  } catch (err) {}

  return {
    ok: true,
    rating: parseInt(rating, 10),
    pesan: 'Rating video materi berhasil disimpan.',
    data: {
      rata_rata: Number(rating).toFixed(1),
      total_ulasan: 1,
      rating_pengguna: parseInt(rating, 10)
    }
  };
}

export async function ambilStatusBookmark(idModul) {
  const user = ambilSesiPengguna();
  const userKey = user ? (user.id || user.email) : 'guest';
  const bookmarks = bacaLocalBookmarks();
  const adaDiLokal = bookmarks.some(b => b.modul_id === idModul && b.user_id === userKey);

  try {
    const res = await requestGET('status_bookmark_modul', { id_modul: idModul });
    if (res && typeof res.dibookmark !== 'undefined') {
      return res.dibookmark || adaDiLokal;
    }
  } catch (err) {}

  return adaDiLokal;
}

export async function toggleBookmarkModul(idModul, metaInfo = {}) {
  const user = ambilSesiPengguna();
  const userKey = user ? (user.id || user.email) : 'guest';
  let bookmarks = bacaLocalBookmarks();
  const idx = bookmarks.findIndex(b => b.modul_id === idModul && b.user_id === userKey);
  let dibookmarkBaru = false;

  if (idx !== -1) {
    bookmarks.splice(idx, 1);
    dibookmarkBaru = false;
  } else {
    bookmarks.unshift({
      user_id: userKey,
      modul_id: idModul,
      judul_modul: metaInfo.judul_modul || 'Video Materi',
      kursus_judul: metaInfo.kursus_judul || '',
      kursus_slug: metaInfo.kursus_slug || '',
      urutan: metaInfo.urutan || 1,
      estimasi_menit: metaInfo.estimasi_menit || 15,
      video_url: metaInfo.video_url || '',
      dibuat_pada: new Date().toISOString()
    });
    dibookmarkBaru = true;
  }
  simpanLocalBookmarks(bookmarks);

  try {
    const res = await requestPOST('toggle_bookmark', { id_modul: idModul });
    if (res && res.ok) {
      return res;
    }
  } catch (err) {}

  return {
    ok: true,
    dibookmark: dibookmarkBaru,
    pesan: dibookmarkBaru
      ? 'Video materi berhasil disimpan ke Aktivitas Saya.'
      : 'Video materi dihapus dari simpanan.'
  };
}

export async function ambilAktivitasPengguna() {
  const user = ambilSesiPengguna();
  const userKey = user ? (user.id || user.email) : 'guest';

  let localBookmarks = bacaLocalBookmarks().filter(b => b.user_id === userKey);
  let localRatingsMap = bacaLocalRatings();
  let localRatings = [];
  for (const k in localRatingsMap) {
    if (k.startsWith(`${userKey}_`) || (typeof localRatingsMap[k] === 'object' && localRatingsMap[k] !== null)) {
      const item = localRatingsMap[k];
      if (typeof item === 'object') {
        localRatings.push(item);
      }
    }
  }

  try {
    const res = await requestGET('aktivitas_pengguna');
    if (res.ok && res.data) {
      const dbBookmarks = res.data.bookmark || [];
      const dbRatings = res.data.rating || [];

      const bookmarkIds = new Set(dbBookmarks.map(b => b.modul_id));
      for (const lb of localBookmarks) {
        if (!bookmarkIds.has(lb.modul_id)) {
          dbBookmarks.push(lb);
        }
      }

      const ratingIds = new Set(dbRatings.map(r => r.modul_id));
      for (const lr of localRatings) {
        if (!ratingIds.has(lr.modul_id)) {
          dbRatings.push(lr);
        }
      }

      return {
        bookmark: dbBookmarks,
        rating: dbRatings
      };
    }
  } catch (err) {
    console.warn('[API ambilAktivitasPengguna fallback]', err);
  }

  return {
    bookmark: localBookmarks,
    rating: localRatings
  };
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

export async function ambilSoalKuisAdmin(slugKursus) {
  try {
    const res = await requestGET('soal_kuis_admin', { slug: slugKursus });
    return res.ok ? res.data : [];
  } catch {
    return [];
  }
}

export async function ambilContohNomorSertifikat() {
  try {
    const res = await requestGET('contoh_nomor_sertifikat');
    return res.ok && Array.isArray(res.data) ? res.data : [];
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
