/**
 * Skill4Life - Unified State & API Engine (assets/js/api.js)
 * Mendukung penyimpanan persisten penuh (LocalStorage) dengan data awal JSON
 * serta sinkronisasi status ke endpoint PHP Native (api/index.php).
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

const KUNCI = {
  USER: 's4l_user',
  KURSUS: 's4l_data_kursus_v2',
  MODUL: 's4l_data_modul_v2',
  KUIS: 's4l_data_kuis_v2',
  SERTIFIKAT: 's4l_arsip_sertifikat_v2',
  PESERTA: 's4l_daftar_peserta_v2',
};

function bacaLS(kunci, fallback = null) {
  try {
    const raw = localStorage.getItem(kunci);
    return raw ? JSON.parse(raw) : fallback;
  } catch {
    return fallback;
  }
}

function tulisLS(kunci, nilai) {
  try {
    localStorage.setItem(kunci, JSON.stringify(nilai));
  } catch (e) {
    console.error('Gagal menyimpan state lokal:', e);
  }
}

async function muatAtauInisialisasi(kunciLS, pathJSON) {
  const tersimpan = bacaLS(kunciLS);
  if (Array.isArray(tersimpan) && tersimpan.length > 0) {
    return tersimpan;
  }
  try {
    const res = await fetch(`${BASIS_URL}${pathJSON}`);
    const data = await res.json();
    tulisLS(kunciLS, data);
    return data;
  } catch (e) {
    console.error(`Gagal memuat ${pathJSON}:`, e);
    return [];
  }
}

/* ========================================================
   1. MANAJEMEN SESI & AUTENTIKASI
   ======================================================== */

export function ambilSesiPengguna() {
  return bacaLS(KUNCI.USER, null);
}

export function keluarAkun() {
  localStorage.removeItem(KUNCI.USER);
}

export async function ambilSemuaPeserta() {
  const tersimpan = bacaLS(KUNCI.PESERTA);
  if (Array.isArray(tersimpan) && tersimpan.length > 0) {
    return tersimpan;
  }
  try {
    const res = await fetch(`${BASIS_URL}assets/data/pengguna.json`);
    const data = await res.json();
    const list = (data.daftar_peserta || []).map(p => ({
      ...p,
      kata_sandi: p.email === 'budi@gmail.com' ? 'budi1234' : 'peserta1234',
      nomor_telepon: p.nomor_telepon || '085712345678'
    }));
    tulisLS(KUNCI.PESERTA, list);
    return list;
  } catch {
    return [];
  }
}

export async function masukAkun(email, kataSandi, peranDiharapkan = 'peserta') {
  const emailBersih = (email || '').trim().toLowerCase();
  if (!emailBersih || !kataSandi || kataSandi.length < 8) {
    return { ok: false, pesan: 'Alamat email dan kata sandi (minimal 8 karakter) wajib diisi.' };
  }

  if (peranDiharapkan === 'admin') {
    if (emailBersih === 'admin@skill4life.id' && kataSandi === 'admin1234') {
      const sesiAdmin = {
        id: 1,
        nama_lengkap: 'Administrator Skill4Life',
        email: 'admin@skill4life.id',
        peran: 'admin'
      };
      tulisLS(KUNCI.USER, sesiAdmin);
      return { ok: true, user: sesiAdmin };
    }
    return { ok: false, pesan: 'Email atau kata sandi pengelola tidak cocok.' };
  }

  const pesertaList = await ambilSemuaPeserta();
  const ketemu = pesertaList.find(p => p.email.toLowerCase() === emailBersih);

  if (ketemu) {
    // Izinkan sandi default demo atau sandi yang didaftarkan
    const sandiValid = !ketemu.kata_sandi || ketemu.kata_sandi === kataSandi || kataSandi === 'budi1234';
    if (!sandiValid) {
      return { ok: false, pesan: 'Kata sandi yang Anda masukkan salah.' };
    }
    const sesi = {
      id: ketemu.id,
      nama_lengkap: ketemu.nama,
      email: ketemu.email,
      nomor_telepon: ketemu.nomor_telepon || '085712345678',
      pekerjaan: ketemu.pekerjaan || 'Pencari kerja',
      kota: ketemu.kota || 'Indonesia',
      peran: 'peserta'
    };
    tulisLS(KUNCI.USER, sesi);
    return { ok: true, user: sesi };
  }

  return { ok: false, pesan: 'Email belum terdaftar. Silakan buat akun gratis terlebih dahulu.' };
}

export async function daftarAkun({ nama_lengkap, email, kata_sandi, pekerjaan = 'Pencari kerja', kota = 'Indonesia' }) {
  const emailBersih = (email || '').trim().toLowerCase();
  const namaBersih = (nama_lengkap || '').trim();

  if (!namaBersih || !emailBersih || !kata_sandi || kata_sandi.length < 8) {
    return { ok: false, pesan: 'Lengkapi seluruh data formulir. Kata sandi minimal 8 karakter.' };
  }

  const pesertaList = await ambilSemuaPeserta();
  if (pesertaList.some(p => p.email.toLowerCase() === emailBersih)) {
    return { ok: false, pesan: 'Alamat email ini sudah terdaftar. Silakan masuk menggunakan email tersebut.' };
  }

  const idBaru = pesertaList.reduce((max, p) => Math.max(max, p.id || 0), 1) + 1;
  const pesertaBaru = {
    id: idBaru,
    nama: namaBersih,
    email: emailBersih,
    kata_sandi,
    nomor_telepon: '-',
    pekerjaan: pekerjaan.trim() || 'Pencari kerja',
    kota: kota.trim() || 'Indonesia',
    kursus_selesai: 0,
    sertifikat: 0,
    status: 'Aktif',
    tgl_daftar: new Date().toISOString().split('T')[0]
  };

  pesertaList.unshift(pesertaBaru);
  tulisLS(KUNCI.PESERTA, pesertaList);

  const sesi = {
    id: idBaru,
    nama_lengkap: namaBersih,
    email: emailBersih,
    nomor_telepon: '-',
    pekerjaan: pesertaBaru.pekerjaan,
    kota: pesertaBaru.kota,
    peran: 'peserta'
  };
  tulisLS(KUNCI.USER, sesi);
  return { ok: true, user: sesi };
}

export async function perbaruiProfilPengguna({ nama_lengkap, nomor_telepon, pekerjaan, kota }) {
  const sesi = ambilSesiPengguna();
  if (!sesi) {
    return { ok: false, pesan: 'Sesi tidak ditemukan. Silakan masuk kembali.' };
  }

  const namaBaru = (nama_lengkap || '').trim() || sesi.nama_lengkap;
  const sesiBaru = {
    ...sesi,
    nama_lengkap: namaBaru,
    nomor_telepon: (nomor_telepon || '').trim(),
    pekerjaan: (pekerjaan || '').trim(),
    kota: (kota || '').trim() || sesi.kota || 'Indonesia'
  };
  tulisLS(KUNCI.USER, sesiBaru);

  // Sinkronkan juga ke daftar peserta dan sertifikat milik pengguna ini
  const pesertaList = await ambilSemuaPeserta();
  const idx = pesertaList.findIndex(p => p.email.toLowerCase() === sesi.email.toLowerCase());
  if (idx !== -1) {
    pesertaList[idx] = {
      ...pesertaList[idx],
      nama: namaBaru,
      nomor_telepon: sesiBaru.nomor_telepon,
      pekerjaan: sesiBaru.pekerjaan,
      kota: sesiBaru.kota
    };
    tulisLS(KUNCI.PESERTA, pesertaList);
  }

  const sertifikatList = await ambilSemuaSertifikat();
  let sertUpdated = false;
  const sertBaru = sertifikatList.map(s => {
    if (s.email && s.email.toLowerCase() === sesi.email.toLowerCase()) {
      sertUpdated = true;
      return { ...s, nama_peserta: namaBaru };
    }
    return s;
  });
  if (sertUpdated) {
    tulisLS(KUNCI.SERTIFIKAT, sertBaru);
  }

  return { ok: true, user: sesiBaru };
}

/* ========================================================
   2. DATA PUBLIK: STATISTIK, KATEGORI, KURSUS, MODUL
   ======================================================== */

export async function ambilStatistik() {
  const [kursus, modul, sertifikat] = await Promise.all([
    ambilDaftarKursus(),
    muatAtauInisialisasi(KUNCI.MODUL, 'assets/data/modul.json'),
    ambilSemuaSertifikat()
  ]);

  return {
    total_kursus: kursus.length,
    total_modul: modul.length,
    total_sertifikat: 839 + sertifikat.length,
    mitra_komunitas: 32
  };
}

export async function ambilKategori() {
  try {
    const [res, kursus] = await Promise.all([
      fetch(`${BASIS_URL}assets/data/kategori.json`),
      ambilDaftarKursus()
    ]);
    const kategoriList = await res.json();
    return kategoriList.map(kat => ({
      ...kat,
      jumlah_kursus: kursus.filter(k => k.kategori_slug === kat.slug).length
    }));
  } catch (error) {
    console.error('Gagal memuat kategori:', error);
    return [];
  }
}

export async function ambilDaftarKursus() {
  return await muatAtauInisialisasi(KUNCI.KURSUS, 'assets/data/kursus.json');
}

export async function ambilDetailKursus(slugKursus) {
  const daftar = await ambilDaftarKursus();
  return daftar.find(k => k.slug === slugKursus || String(k.id_kursus) === String(slugKursus)) || null;
}

export async function ambilDaftarModul(slugKursus) {
  const modulSemua = await muatAtauInisialisasi(KUNCI.MODUL, 'assets/data/modul.json');
  return modulSemua
    .filter(m => m.kursus_slug === slugKursus)
    .sort((a, b) => a.urutan - b.urutan);
}

/* ========================================================
   3. PROGRES BELAJAR & RINGKASAN DASHBOARD
   ======================================================== */

function dapatkanKunciProgres(slugKursus) {
  const sesi = ambilSesiPengguna();
  const ident = sesi && sesi.email ? sesi.email.toLowerCase() : 'tamu';
  return `s4l_progres_${ident}_${slugKursus}`;
}

export async function ambilProgresKursus(slugKursus) {
  const kunci = dapatkanKunciProgres(slugKursus);
  let tersimpan = bacaLS(kunci, null);

  // Seed progres bawaan khusus akun demo Budi Santoso jika belum pernah diubah
  if (tersimpan === null) {
    const sesi = ambilSesiPengguna();
    if (sesi && sesi.email && sesi.email.toLowerCase() === 'budi@gmail.com') {
      if (slugKursus === 'menulis-cv-surat-lamaran-ats') {
        const modulList = await ambilDaftarModul(slugKursus);
        tersimpan = modulList.map(m => m.id);
        tulisLS(kunci, tersimpan);
      } else if (slugKursus === 'microsoft-excel-dasar') {
        const modulList = await ambilDaftarModul(slugKursus);
        tersimpan = modulList.slice(0, 2).map(m => m.id);
        tulisLS(kunci, tersimpan);
      } else if (slugKursus === 'persiapan-wawancara-kerja') {
        const modulList = await ambilDaftarModul(slugKursus);
        tersimpan = modulList.slice(0, 1).map(m => m.id);
        tulisLS(kunci, tersimpan);
      } else {
        tersimpan = [];
      }
    } else {
      tersimpan = [];
    }
  }
  return Array.isArray(tersimpan) ? tersimpan : [];
}

export async function simpanProgres(slugKursus, idModul) {
  const kunci = dapatkanKunciProgres(slugKursus);
  const data = await ambilProgresKursus(slugKursus);
  if (!data.includes(idModul)) {
    data.push(idModul);
    tulisLS(kunci, data);
  }
  return { sukses: true, modul_selesai: data };
}

export async function hapusProgres(slugKursus, idModul) {
  const kunci = dapatkanKunciProgres(slugKursus);
  const data = await ambilProgresKursus(slugKursus);
  const baru = data.filter(id => id !== idModul);
  tulisLS(kunci, baru);
  return { sukses: true, modul_selesai: baru };
}

export async function ambilRingkasanKursusPeserta() {
  const [semuaKursus, sertifikatSaya] = await Promise.all([
    ambilDaftarKursus(),
    ambilSertifikatPengguna()
  ]);

  const hasil = [];
  for (const k of semuaKursus) {
    const modulList = await ambilDaftarModul(k.slug);
    const selesaiIds = await ambilProgresKursus(k.slug);
    const sert = sertifikatSaya.find(s => s.kursus_slug === k.slug) || null;

    if (selesaiIds.length > 0 || sert) {
      const total = modulList.length || k.jumlah_modul || 4;
      const selesai = Math.min(selesaiIds.length, total);
      const persen = total > 0 ? Math.round((selesai / total) * 100) : 0;
      hasil.push({
        id_kursus: k.id_kursus,
        judul: k.judul,
        slug: k.slug,
        kategori: k.kategori,
        level: k.level,
        modul_selesai: selesai,
        total_modul: total,
        progress_persen: sert ? 100 : persen,
        lulus_kuis: Boolean(sert),
        nilai_kuis: sert ? sert.nilai_kuis : null,
        nomor_sertifikat: sert ? sert.nomor_sertifikat : null
      });
    }
  }
  return hasil;
}

/* ========================================================
   4. KUIS EVALUASI & PENERBITAN SERTIFIKAT
   ======================================================== */

export async function ambilSoalKuis(slugKursus) {
  const kuisSemua = await muatAtauInisialisasi(KUNCI.KUIS, 'assets/data/kuis.json');
  return kuisSemua
    .filter(q => q.kursus_slug === slugKursus)
    .sort((a, b) => (a.urutan || 0) - (b.urutan || 0));
}

export async function kirimHasilKuis(slugKursus, lembarJawaban) {
  const soalList = await ambilSoalKuis(slugKursus);
  let benar = 0;

  const evaluasi = soalList.map((s, idx) => {
    const jawabanPeserta = lembarJawaban[s.id] || null;
    const isBenar = jawabanPeserta === s.jawaban_benar;
    if (isBenar) benar++;
    return {
      nomor: idx + 1,
      id_soal: s.id,
      pertanyaan: s.pertanyaan,
      pilihan: s.pilihan,
      jawaban_peserta: jawabanPeserta,
      teks_jawaban_peserta: jawabanPeserta && s.pilihan ? s.pilihan[jawabanPeserta] : 'Tidak dijawab',
      kunci_benar: s.jawaban_benar,
      teks_kunci_benar: s.pilihan ? s.pilihan[s.jawaban_benar] : '',
      is_benar: isBenar,
      pembahasan: s.pembahasan || ''
    };
  });

  const nilai = soalList.length > 0 ? Math.round((benar / soalList.length) * 100) : 0;
  const isLulus = nilai >= 70;

  let nomorSertifikat = null;
  if (isLulus) {
    const sesi = ambilSesiPengguna();
    const namaPenerima = sesi && sesi.nama_lengkap ? sesi.nama_lengkap : 'Peserta Skill4Life';
    const emailPenerima = sesi && sesi.email ? sesi.email : 'peserta@skill4life.id';

    const kursus = await ambilDetailKursus(slugKursus);
    const semuaSertifikat = await ambilSemuaSertifikat();

    // Cek apakah peserta sudah punya sertifikat untuk kursus ini
    const sudahPunya = semuaSertifikat.find(
      s => s.kursus_slug === slugKursus && s.email && s.email.toLowerCase() === emailPenerima.toLowerCase()
    );

    if (sudahPunya) {
      nomorSertifikat = sudahPunya.nomor_sertifikat;
      if (nilai > (sudahPunya.nilai_kuis || 0)) {
        sudahPunya.nilai_kuis = nilai;
        tulisLS(KUNCI.SERTIFIKAT, semuaSertifikat);
      }
    } else {
      const tahun = new Date().getFullYear();
      const urut = String(126 + semuaSertifikat.length).padStart(6, '0');
      nomorSertifikat = `S4L-${tahun}-${urut}`;

      const hashBytes = new Uint8Array(20);
      crypto.getRandomValues(hashBytes);
      const kodeVerifikasi = Array.from(hashBytes).map(b => b.toString(16).padStart(2, '0')).join('');

      const sertifikatBaru = {
        nomor_sertifikat: nomorSertifikat,
        nama_peserta: namaPenerima,
        email: emailPenerima,
        nama_kursus: kursus ? kursus.judul : slugKursus,
        kursus_slug: slugKursus,
        tanggal_terbit: new Date().toISOString().split('T')[0],
        nilai_kuis: nilai,
        penyelenggara_nama: 'Dr. Ir. Hendra Gunawan, M.T.',
        penyelenggara_jabatan: 'Direktur Pembina Skill4Life',
        kode_verifikasi: kodeVerifikasi,
        status: 'Terdaftar sah'
      };

      semuaSertifikat.unshift(sertifikatBaru);
      tulisLS(KUNCI.SERTIFIKAT, semuaSertifikat);

      // Update statistik peserta di daftar peserta
      const pesertaList = await ambilSemuaPeserta();
      const idxP = pesertaList.findIndex(p => p.email.toLowerCase() === emailPenerima.toLowerCase());
      if (idxP !== -1) {
        pesertaList[idxP].kursus_selesai = (pesertaList[idxP].kursus_selesai || 0) + 1;
        pesertaList[idxP].sertifikat = (pesertaList[idxP].sertifikat || 0) + 1;
        tulisLS(KUNCI.PESERTA, pesertaList);
      }
    }
  }

  return {
    nilai,
    jawaban_benar: benar,
    total_soal: soalList.length,
    lulus: isLulus,
    nomor_sertifikat: nomorSertifikat,
    evaluasi
  };
}

export async function ambilSemuaSertifikat() {
  return await muatAtauInisialisasi(KUNCI.SERTIFIKAT, 'assets/data/sertifikat.json');
}

export async function ambilSertifikat(nomorSertifikat) {
  const daftar = await ambilSemuaSertifikat();
  return daftar.find(s => s.nomor_sertifikat.toLowerCase() === (nomorSertifikat || '').toLowerCase()) || null;
}

export async function ambilSertifikatPengguna() {
  const sesi = ambilSesiPengguna();
  const semua = await ambilSemuaSertifikat();
  if (!sesi || !sesi.email) {
    return [];
  }
  return semua.filter(s => s.email && s.email.toLowerCase() === sesi.email.toLowerCase());
}

export async function ambilProfilPengguna() {
  const sesi = ambilSesiPengguna();
  const pesertaList = await ambilSemuaPeserta();
  return {
    peserta_aktif: sesi || {},
    daftar_peserta: pesertaList
  };
}

/* ========================================================
   5. CRUD PANEL PENGELOLA (ADMIN) & RESET DEMO
   ======================================================== */

export async function tambahKursus(data) {
  const daftar = await ambilDaftarKursus();
  const idBaru = daftar.reduce((max, k) => Math.max(max, k.id_kursus || 0), 0) + 1;
  const slugDasar = (data.judul || 'kursus-baru')
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-|-$/g, '');
  const slugUnik = daftar.some(k => k.slug === slugDasar) ? `${slugDasar}-${idBaru}` : slugDasar;

  const katSlugMap = {
    'Aplikasi perkantoran': 'aplikasi-perkantoran',
    'Kesiapan karir dan kerja': 'kesiapan-karir-kerja',
    'Kewirausahaan dan literasi keuangan': 'kewirausahaan-literasi-keuangan'
  };

  const baru = {
    id_kursus: idBaru,
    judul: data.judul,
    slug: slugUnik,
    kategori: data.kategori,
    kategori_slug: katSlugMap[data.kategori] || 'aplikasi-perkantoran',
    level: data.level || 'Pemula',
    estimasi_waktu: data.estimasi_waktu || '2 jam',
    jumlah_modul: 0,
    ringkasan: data.ringkasan,
    deskripsi: data.deskripsi || data.ringkasan,
    tujuan_belajar: data.tujuan_belajar || [
      'Memahami konsep dasar materi secara terstruktur',
      'Menerapkan keterampilan kerja secara mandiri'
    ]
  };

  daftar.push(baru);
  tulisLS(KUNCI.KURSUS, daftar);
  return baru;
}

export async function ubahKursus(idKursus, data) {
  const daftar = await ambilDaftarKursus();
  const katSlugMap = {
    'Aplikasi perkantoran': 'aplikasi-perkantoran',
    'Kesiapan karir dan kerja': 'kesiapan-karir-kerja',
    'Kewirausahaan dan literasi keuangan': 'kewirausahaan-literasi-keuangan'
  };

  const idx = daftar.findIndex(k => k.id_kursus === idKursus);
  if (idx === -1) return null;

  daftar[idx] = {
    ...daftar[idx],
    judul: data.judul,
    kategori: data.kategori,
    kategori_slug: katSlugMap[data.kategori] || daftar[idx].kategori_slug,
    level: data.level,
    estimasi_waktu: data.estimasi_waktu,
    ringkasan: data.ringkasan,
    deskripsi: data.deskripsi || data.ringkasan
  };
  tulisLS(KUNCI.KURSUS, daftar);
  return daftar[idx];
}

export async function hapusKursus(idKursus) {
  const daftar = await ambilDaftarKursus();
  const target = daftar.find(k => k.id_kursus === idKursus);
  const baru = daftar.filter(k => k.id_kursus !== idKursus);
  tulisLS(KUNCI.KURSUS, baru);

  if (target) {
    const modulSemua = await muatAtauInisialisasi(KUNCI.MODUL, 'assets/data/modul.json');
    tulisLS(KUNCI.MODUL, modulSemua.filter(m => m.kursus_slug !== target.slug));

    const kuisSemua = await muatAtauInisialisasi(KUNCI.KUIS, 'assets/data/kuis.json');
    tulisLS(KUNCI.KUIS, kuisSemua.filter(q => q.kursus_slug !== target.slug));
  }
  return true;
}

export async function tambahModul(data) {
  const modulSemua = await muatAtauInisialisasi(KUNCI.MODUL, 'assets/data/modul.json');
  const kursus = await ambilDetailKursus(data.kursus_slug);
  const idBaru = modulSemua.reduce((max, m) => Math.max(max, m.id || 0), 0) + 1;

  const modulBaru = {
    id: idBaru,
    kursus_id: kursus ? kursus.id_kursus : 1,
    kursus_slug: data.kursus_slug,
    judul_modul: data.judul_modul,
    urutan: Number(data.urutan) || 1,
    estimasi_menit: Number(data.estimasi_menit) || 20,
    video_url: data.video_url || '',
    konten: data.konten || '<p>Materi pembelajaran.</p>'
  };

  modulSemua.push(modulBaru);
  tulisLS(KUNCI.MODUL, modulSemua);

  // Perbarui jumlah modul di daftar kursus
  await sinkronJumlahModulKursus(data.kursus_slug, modulSemua);
  return modulBaru;
}

export async function ubahModul(idModul, data) {
  const modulSemua = await muatAtauInisialisasi(KUNCI.MODUL, 'assets/data/modul.json');
  const idx = modulSemua.findIndex(m => m.id === idModul);
  if (idx === -1) return null;

  modulSemua[idx] = {
    ...modulSemua[idx],
    urutan: Number(data.urutan) || modulSemua[idx].urutan,
    judul_modul: data.judul_modul,
    estimasi_menit: Number(data.estimasi_menit) || modulSemua[idx].estimasi_menit,
    video_url: data.video_url || '',
    konten: data.konten
  };
  tulisLS(KUNCI.MODUL, modulSemua);
  return modulSemua[idx];
}

export async function hapusModul(idModul) {
  const modulSemua = await muatAtauInisialisasi(KUNCI.MODUL, 'assets/data/modul.json');
  const target = modulSemua.find(m => m.id === idModul);
  const baru = modulSemua.filter(m => m.id !== idModul);
  tulisLS(KUNCI.MODUL, baru);
  if (target) {
    await sinkronJumlahModulKursus(target.kursus_slug, baru);
  }
  return true;
}

async function sinkronJumlahModulKursus(slugKursus, modulSemua) {
  const daftar = await ambilDaftarKursus();
  const idx = daftar.findIndex(k => k.slug === slugKursus);
  if (idx !== -1) {
    daftar[idx].jumlah_modul = modulSemua.filter(m => m.kursus_slug === slugKursus).length;
    tulisLS(KUNCI.KURSUS, daftar);
  }
}

export async function tambahSoalKuis(data) {
  const kuisSemua = await muatAtauInisialisasi(KUNCI.KUIS, 'assets/data/kuis.json');
  const kursus = await ambilDetailKursus(data.kursus_slug);
  const idBaru = kuisSemua.reduce((max, q) => Math.max(max, q.id || 0), 0) + 1;
  const jumlahSekarang = kuisSemua.filter(q => q.kursus_slug === data.kursus_slug).length;

  const soalBaru = {
    id: idBaru,
    kursus_id: kursus ? kursus.id_kursus : 1,
    kursus_slug: data.kursus_slug,
    urutan: jumlahSekarang + 1,
    pertanyaan: data.pertanyaan,
    pilihan: {
      A: data.opsi_a,
      B: data.opsi_b,
      C: data.opsi_c,
      D: data.opsi_d
    },
    jawaban_benar: data.jawaban_benar,
    pembahasan: data.pembahasan
  };

  kuisSemua.push(soalBaru);
  tulisLS(KUNCI.KUIS, kuisSemua);
  return soalBaru;
}

export async function ubahSoalKuis(idSoal, data) {
  const kuisSemua = await muatAtauInisialisasi(KUNCI.KUIS, 'assets/data/kuis.json');
  const idx = kuisSemua.findIndex(q => q.id === idSoal);
  if (idx === -1) return null;

  kuisSemua[idx] = {
    ...kuisSemua[idx],
    pertanyaan: data.pertanyaan,
    pilihan: {
      A: data.opsi_a,
      B: data.opsi_b,
      C: data.opsi_c,
      D: data.opsi_d
    },
    jawaban_benar: data.jawaban_benar,
    pembahasan: data.pembahasan
  };
  tulisLS(KUNCI.KUIS, kuisSemua);
  return kuisSemua[idx];
}

export async function hapusSoalKuis(idSoal) {
  const kuisSemua = await muatAtauInisialisasi(KUNCI.KUIS, 'assets/data/kuis.json');
  tulisLS(KUNCI.KUIS, kuisSemua.filter(q => q.id !== idSoal));
  return true;
}

export function resetDataDemo() {
  Object.keys(localStorage).forEach(k => {
    if (k.startsWith('s4l_')) {
      localStorage.removeItem(k);
    }
  });
}
