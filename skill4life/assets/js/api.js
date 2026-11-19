/**
 * Skill4Life - Titik Integrasi API Backend (api.js)
 * Kumpulan pemanggilan data terpusat.
 * 
 * TODO-BACKEND:
 * Seluruh fungsi di bawah ini saat ini membaca berkas JSON dummy di assets/data/.
 * Ketika backend selesai dibuat, ubah isi fetch() agar mengarah ke endpoint REST API
 * sesuai spesifikasi pada berkas API-KONTRAK.md.
 */

// Tentukan basis path relatif secara aman
const dapatkanBasisPath = () => {
  const lokasi = window.location.pathname;
  if (lokasi.includes('/kursus/') || lokasi.includes('/dashboard/') || lokasi.includes('/admin/') || lokasi.includes('/auth/') || lokasi.includes('/sertifikat/')) {
    return '../';
  }
  return './';
};

const BASIS_URL = dapatkanBasisPath();

// 1. Ambil Ringkasan Statistik Beranda
export async function ambilStatistik() {
  // TODO-BACKEND: Ganti dengan GET /api/v1/statistik
  try {
    const respon = await fetch(`${BASIS_URL}assets/data/statistik.json`);
    return await respon.json();
  } catch (error) {
    console.error("Gagal memuat data statistik:", error);
    return { total_kursus: 6, total_modul: 24, total_sertifikat: 840 };
  }
}

// 2. Ambil Kategori Kursus
export async function ambilKategori() {
  // TODO-BACKEND: Ganti dengan GET /api/v1/kategori
  try {
    const respon = await fetch(`${BASIS_URL}assets/data/kategori.json`);
    return await respon.json();
  } catch (error) {
    console.error("Gagal memuat kategori:", error);
    return [];
  }
}

// 3. Ambil Daftar Semua Kursus
export async function ambilDaftarKursus() {
  // TODO-BACKEND: Ganti dengan GET /api/v1/kursus
  try {
    const respon = await fetch(`${BASIS_URL}assets/data/kursus.json`);
    return await respon.json();
  } catch (error) {
    console.error("Gagal memuat kursus:", error);
    return [];
  }
}

// 4. Ambil Rincian Satu Kursus Berdasarkan Slug atau ID
export async function ambilDetailKursus(slugKursus) {
  // TODO-BACKEND: Ganti dengan GET /api/v1/kursus/{slug}
  const daftar = await ambilDaftarKursus();
  return daftar.find(k => k.slug === slugKursus || String(k.id_kursus) === String(slugKursus)) || null;
}

// 5. Ambil Daftar Modul untuk Satu Kursus
export async function ambilDaftarModul(slugKursus) {
  // TODO-BACKEND: Ganti dengan GET /api/v1/kursus/{slug}/modul
  try {
    const respon = await fetch(`${BASIS_URL}assets/data/modul.json`);
    const modulSemua = await respon.json();
    return modulSemua.filter(m => m.kursus_slug === slugKursus).sort((a, b) => a.urutan - b.urutan);
  } catch (error) {
    console.error("Gagal memuat modul:", error);
    return [];
  }
}

// 6. Simpan Progres Penyelesaian Modul
export async function simpanProgres(slugKursus, idModul) {
  // TODO-BACKEND: Ganti dengan POST /api/v1/progres/selesai
  // Payload: { id_modul: idModul, kursus_slug: slugKursus }
  const kunciStorage = `s4l_progres_${slugKursus}`;
  let dataTersimpan = [];
  try {
    dataTersimpan = JSON.parse(localStorage.getItem(kunciStorage) || '[]');
  } catch (e) {}

  if (!dataTersimpan.includes(idModul)) {
    dataTersimpan.push(idModul);
    localStorage.setItem(kunciStorage, JSON.stringify(dataTersimpan));
  }
  return { sukses: true, modul_selesai: dataTersimpan };
}

// 7. Ambil Progres Kursus Peserta
export async function ambilProgresKursus(slugKursus) {
  // TODO-BACKEND: Ganti dengan GET /api/v1/progres/{slug}
  const kunciStorage = `s4l_progres_${slugKursus}`;
  try {
    return JSON.parse(localStorage.getItem(kunciStorage) || '[]');
  } catch (e) {
    return [];
  }
}

// 8. Ambil 10 Soal Kuis untuk Kursus Tertentu
export async function ambilSoalKuis(slugKursus) {
  // TODO-BACKEND: Ganti dengan GET /api/v1/kursus/{slug}/kuis
  try {
    const respon = await fetch(`${BASIS_URL}assets/data/kuis.json`);
    const kuisSemua = await respon.json();
    return kuisSemua.filter(q => q.kursus_slug === slugKursus).sort((a, b) => a.urutan - b.urutan);
  } catch (error) {
    console.error("Gagal memuat kuis:", error);
    return [];
  }
}

// 9. Kirim Jawaban Kuis dan Dapatkan Hasil
export async function kirimHasilKuis(slugKursus, lembarJawaban) {
  // TODO-BACKEND: Ganti dengan POST /api/v1/kursus/{slug}/kuis/evaluasi
  // Payload: { jawaban: { [id_soal]: "A" } }
  const soalList = await ambilSoalKuis(slugKursus);
  let benar = 0;
  const evaluasi = soalList.map(s => {
    const jawabanPeserta = lembarJawaban[s.id];
    const isBenar = jawabanPeserta === s.jawaban_benar;
    if (isBenar) benar++;
    return {
      id_soal: s.id,
      jawaban_peserta: jawabanPeserta || null,
      kunci_benar: s.jawaban_benar,
      is_benar: isBenar,
      pembahasan: s.pembahasan
    };
  });

  const nilai = Math.round((benar / soalList.length) * 100);
  const isLulus = nilai >= 70;

  let nomorSertifikat = null;
  if (isLulus) {
    // Generate nomor sertifikat dummy unik
    const tahun = new Date().getFullYear();
    const acak = Math.floor(100000 + Math.random() * 900000);
    nomorSertifikat = `S4L-${tahun}-${acak}`;

    const kursus = await ambilDetailKursus(slugKursus);
    const sertifikatBaru = {
      nomor_sertifikat: nomorSertifikat,
      nama_peserta: "Budi Santoso",
      nama_kursus: kursus ? kursus.judul : slugKursus,
      kursus_slug: slugKursus,
      tanggal_terbit: new Date().toISOString().split('T')[0],
      penyelenggara_nama: "Dr. Ir. Hendra Gunawan, M.T.",
      penyelenggara_jabatan: "Direktur Pembina Skill4Life",
      kode_verifikasi: Array.from(crypto.getRandomValues(new Uint8Array(16))).map(b => b.toString(16).padStart(2, '0')).join('')
    };

    // Simpan ke riwayat sertifikat lokal
    try {
      const daftar = JSON.parse(localStorage.getItem('s4l_arsip_sertifikat') || '[]');
      daftar.unshift(sertifikatBaru);
      localStorage.setItem('s4l_arsip_sertifikat', JSON.stringify(daftar));
    } catch (e) {}
  }

  return {
    nilai: nilai,
    jawaban_benar: benar,
    total_soal: soalList.length,
    lulus: isLulus,
    nomor_sertifikat: nomorSertifikat,
    evaluasi: evaluasi
  };
}

// 10. Ambil Data Sertifikat Berdasarkan Nomor
export async function ambilSertifikat(nomorSertifikat) {
  // TODO-BACKEND: Ganti dengan GET /api/v1/sertifikat/{nomor}
  // 1. Cek riwayat sertifikat yang baru diraih di localStorage
  try {
    const lokal = JSON.parse(localStorage.getItem('s4l_arsip_sertifikat') || '[]');
    const ketemuLokal = lokal.find(s => s.nomor_sertifikat.toLowerCase() === nomorSertifikat.toLowerCase());
    if (ketemuLokal) return ketemuLokal;
  } catch (e) {}

  // 2. Cek berkas data sertifikat dummy bawaan
  try {
    const respon = await fetch(`${BASIS_URL}assets/data/sertifikat.json`);
    const daftar = await respon.json();
    return daftar.find(s => s.nomor_sertifikat.toLowerCase() === nomorSertifikat.toLowerCase()) || null;
  } catch (error) {
    console.error("Gagal memuat sertifikat:", error);
    return null;
  }
}

// 11. Ambil Profil Pengguna
export async function ambilProfilPengguna() {
  // TODO-BACKEND: Ganti dengan GET /api/v1/pengguna/profil
  try {
    const respon = await fetch(`${BASIS_URL}assets/data/pengguna.json`);
    return await respon.json();
  } catch (error) {
    return { peserta_aktif: {}, daftar_peserta: [] };
  }
}
