<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\PenggunaModel;
use App\Models\KategoriModel;
use App\Models\KursusModel;
use App\Models\ModulModel;
use App\Models\KuisModel;
use App\Models\SertifikatModel;
use Throwable;

class ApiController extends Controller {
    public function handle(): void {
        $pdo = Database::getConnection();
        if (!$pdo) {
            $this->json([
                'ok' => false,
                'pesan' => 'Koneksi database MySQL gagal. Pastikan layanan MySQL di Laragon aktif dan database db_skill4life tersedia.',
            ], 503);
        }

        $aksi = $_GET['aksi'] ?? '';
        $penggunaModel = new PenggunaModel($pdo);
        $kategoriModel = new KategoriModel($pdo);
        $kursusModel = new KursusModel($pdo);
        $modulModel = new ModulModel($pdo);
        $kuisModel = new KuisModel($pdo);
        $sertifikatModel = new SertifikatModel($pdo);

        try {
            switch ($aksi) {
                case 'cek_status':
                    $this->json([
                        'ok' => true,
                        'mode' => 'mysql_mvc',
                        'database' => DB_NAME,
                    ]);
                    break;

                /* 1. AUTENTIKASI & PROFIL */
                case 'login':
                    $in = $this->getJsonInput();
                    $res = $penggunaModel->autentikasi(
                        $in['email'] ?? '',
                        (string)($in['kata_sandi'] ?? ''),
                        $in['peran'] ?? 'peserta'
                    );
                    if ($res['ok']) {
                        $_SESSION['user'] = $res['user'];
                    }
                    $this->json($res);
                    break;

                case 'daftar':
                    $in = $this->getJsonInput();
                    $res = $penggunaModel->registrasi($in);
                    if ($res['ok']) {
                        $_SESSION['user'] = $res['user'];
                    }
                    $this->json($res);
                    break;

                case 'logout':
                    unset($_SESSION['user']);
                    $this->json(['ok' => true]);
                    break;

                case 'perbarui_profil':
                    $sesi = $this->currentUser();
                    if (!$sesi) {
                        $this->json(['ok' => false, 'pesan' => 'Sesi tidak ditemukan. Silakan masuk kembali.']);
                    }
                    $res = $penggunaModel->perbaruiProfil($sesi, $this->getJsonInput());
                    if ($res['ok']) {
                        $_SESSION['user'] = $res['user'];
                    }
                    $this->json($res);
                    break;

                case 'ubah_sandi':
                    $sesi = $this->currentUser();
                    if (!$sesi) {
                        $this->json(['ok' => false, 'pesan' => 'Sesi tidak ditemukan. Silakan masuk kembali.']);
                    }
                    $in = $this->getJsonInput();
                    $res = $penggunaModel->ubahKataSandi(
                        (int)$sesi['id'],
                        (string)($in['sandi_lama'] ?? ''),
                        (string)($in['sandi_baru'] ?? '')
                    );
                    $this->json($res);
                    break;

                /* 2. DATA PUBLIK */
                case 'statistik':
                    $this->json(['ok' => true, 'data' => $kursusModel->ambilStatistik()]);
                    break;

                case 'kategori':
                    $this->json(['ok' => true, 'data' => $kategoriModel->ambilSemua()]);
                    break;

                case 'kursus':
                    $this->json(['ok' => true, 'data' => $kursusModel->ambilSemua()]);
                    break;

                case 'detail_kursus':
                    $slug = $_GET['slug'] ?? '';
                    $this->json(['ok' => true, 'data' => $kursusModel->ambilDetail($slug)]);
                    break;

                case 'modul':
                    $slug = $_GET['slug'] ?? '';
                    $this->json(['ok' => true, 'data' => $modulModel->ambilBerdasarkanKursus($slug)]);
                    break;

                /* 3. PROGRES BELAJAR */
                case 'progres_kursus':
                    $sesi = $this->currentUser();
                    $slug = $_GET['slug'] ?? '';
                    if (!$sesi || !$slug) {
                        $this->json(['ok' => true, 'data' => []]);
                    }
                    $this->json(['ok' => true, 'data' => $modulModel->ambilProgresPeserta((int)$sesi['id'], $slug)]);
                    break;

                case 'simpan_progres':
                    $sesi = $this->currentUser();
                    if (!$sesi) {
                        $this->json(['sukses' => false, 'butuh_login' => true, 'pesan' => 'Silakan masuk terlebih dahulu untuk menyimpan progres modul.', 'modul_selesai' => []]);
                    }
                    $in = $this->getJsonInput();
                    $this->json($modulModel->simpanProgres(
                        (int)$sesi['id'],
                        $in['slug'] ?? '',
                        (int)($in['id_modul'] ?? 0)
                    ));
                    break;

                case 'hapus_progres':
                    $sesi = $this->currentUser();
                    if (!$sesi) {
                        $this->json(['sukses' => false, 'butuh_login' => true, 'modul_selesai' => []]);
                    }
                    $in = $this->getJsonInput();
                    $this->json($modulModel->hapusProgres(
                        (int)$sesi['id'],
                        $in['slug'] ?? '',
                        (int)($in['id_modul'] ?? 0)
                    ));
                    break;

                case 'ringkasan_peserta':
                    $sesi = $this->currentUser();
                    if (!$sesi) {
                        $this->json(['ok' => true, 'data' => []]);
                    }
                    $this->json(['ok' => true, 'data' => $kursusModel->ambilRingkasanPeserta((int)$sesi['id'])]);
                    break;

                /* 4. KUIS & SERTIFIKAT */
                case 'soal_kuis':
                    $slug = $_GET['slug'] ?? '';
                    $this->json(['ok' => true, 'data' => $kuisModel->ambilBerdasarkanKursus($slug)]);
                    break;

                case 'kirim_kuis':
                    $sesi = $this->currentUser();
                    if (!$sesi) {
                        $this->json(['ok' => false, 'butuh_login' => true, 'pesan' => 'Silakan masuk terlebih dahulu untuk mengikuti ujian akhir dan menerbitkan sertifikat.']);
                    }
                    $in = $this->getJsonInput();
                    $this->json($kuisModel->evaluasiDanSimpan(
                        $in['slug'] ?? '',
                        $in['jawaban'] ?? [],
                        $sesi,
                        $sertifikatModel,
                        $modulModel
                    ));
                    break;

                case 'semua_sertifikat':
                    $this->json(['ok' => true, 'data' => $sertifikatModel->ambilSemua()]);
                    break;

                case 'sertifikat':
                    $nomor = $_GET['nomor'] ?? '';
                    $this->json(['ok' => true, 'data' => $sertifikatModel->ambilBerdasarkanNomor($nomor)]);
                    break;

                case 'sertifikat_pengguna':
                    $sesi = $this->currentUser();
                    if (!$sesi) {
                        $this->json(['ok' => true, 'data' => []]);
                    }
                    $this->json(['ok' => true, 'data' => $sertifikatModel->ambilBerdasarkanPengguna((int)$sesi['id'])]);
                    break;

                case 'semua_peserta':
                    $this->json(['ok' => true, 'data' => $penggunaModel->ambilSemuaPeserta()]);
                    break;

                /* 5. CRUD ADMIN */
                case 'tambah_kursus':
                    $this->requireAdminJson();
                    $this->json(['ok' => true, 'data' => $kursusModel->tambah($this->getJsonInput(), $kategoriModel)]);
                    break;

                case 'ubah_kursus':
                    $this->requireAdminJson();
                    $in = $this->getJsonInput();
                    $this->json(['ok' => true, 'data' => $kursusModel->ubah((int)($in['id_kursus'] ?? 0), $in, $kategoriModel)]);
                    break;

                case 'hapus_kursus':
                    $this->requireAdminJson();
                    $in = $this->getJsonInput();
                    $this->json(['ok' => $kursusModel->hapus((int)($in['id_kursus'] ?? 0))]);
                    break;

                case 'tambah_modul':
                    $this->requireAdminJson();
                    $this->json(['ok' => true, 'data' => $modulModel->tambah($this->getJsonInput())]);
                    break;

                case 'ubah_modul':
                    $this->requireAdminJson();
                    $in = $this->getJsonInput();
                    $this->json(['ok' => $modulModel->ubah((int)($in['id_modul'] ?? 0), $in)]);
                    break;

                case 'hapus_modul':
                    $this->requireAdminJson();
                    $in = $this->getJsonInput();
                    $this->json(['ok' => $modulModel->hapus((int)($in['id_modul'] ?? 0))]);
                    break;

                case 'tambah_soal':
                    $this->requireAdminJson();
                    $this->json(['ok' => true, 'id' => $kuisModel->tambah($this->getJsonInput())]);
                    break;

                case 'ubah_soal':
                    $this->requireAdminJson();
                    $in = $this->getJsonInput();
                    $this->json(['ok' => $kuisModel->ubah((int)($in['id_soal'] ?? 0), $in)]);
                    break;

                case 'hapus_soal':
                    $this->requireAdminJson();
                    $in = $this->getJsonInput();
                    $this->json(['ok' => $kuisModel->hapus((int)($in['id_soal'] ?? 0))]);
                    break;

                case 'reset_demo':
                    $this->requireAdminJson();
                    $sqlFile = dirname(__DIR__, 2) . '/database.sql';
                    if (!file_exists($sqlFile)) {
                        $this->json(['ok' => false, 'pesan' => 'File database.sql tidak ditemukan.']);
                    }
                    $pdo->exec(file_get_contents($sqlFile));
                    $this->json(['ok' => true]);
                    break;

                default:
                    $this->json(['ok' => true, 'pesan' => 'Endpoint MVC API Skill4Life aktif.']);
                    break;
            }
        } catch (Throwable $e) {
            $this->json(['ok' => false, 'pesan' => $e->getMessage()], 500);
        }
    }
}
