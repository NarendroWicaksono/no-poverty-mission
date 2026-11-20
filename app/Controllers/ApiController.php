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
use InvalidArgumentException;
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
        $in = ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' ? $this->getJsonInput() : [];
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $this->verifyCsrfJson($in);
        }

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
                    $res = $penggunaModel->autentikasi(
                        $in['email'] ?? '',
                        (string)($in['kata_sandi'] ?? ''),
                        $in['peran'] ?? 'peserta'
                    );
                    if ($res['ok']) {
                        session_regenerate_id(true);
                        $_SESSION['user'] = $res['user'];
                        $this->json($res);
                    }
                    $this->json($res, 401);
                    break;

                case 'daftar':
                    $res = $penggunaModel->registrasi($in);
                    if ($res['ok']) {
                        session_regenerate_id(true);
                        $_SESSION['user'] = $res['user'];
                        $this->json($res, 201);
                    }
                    $this->json($res, 422);
                    break;

                case 'logout':
                    $_SESSION = [];
                    if (session_status() === PHP_SESSION_ACTIVE) {
                        session_regenerate_id(true);
                    }
                    $this->json(['ok' => true]);
                    break;

                case 'perbarui_profil':
                    $sesi = $this->requireUserJson();
                    $res = $penggunaModel->perbaruiProfil($sesi, $in);
                    if ($res['ok']) {
                        $_SESSION['user'] = $res['user'];
                    }
                    $this->json($res);
                    break;

                case 'ubah_sandi':
                    $sesi = $this->requireUserJson();
                    $res = $penggunaModel->ubahKataSandi(
                        (int)$sesi['id'],
                        (string)($in['sandi_lama'] ?? ''),
                        (string)($in['sandi_baru'] ?? '')
                    );
                    $this->json($res, $res['ok'] ? 200 : 422);
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
                    $slug = trim($_GET['slug'] ?? '');
                    $detail = $kursusModel->ambilDetail($slug);
                    if (!$detail) {
                        $this->json(['ok' => false, 'data' => null, 'pesan' => 'Kursus tidak ditemukan.'], 404);
                    }
                    $this->json(['ok' => true, 'data' => $detail]);
                    break;

                case 'modul':
                    $slug = trim($_GET['slug'] ?? '');
                    $this->json(['ok' => true, 'data' => $modulModel->ambilBerdasarkanKursus($slug)]);
                    break;

                /* 3. PROGRES BELAJAR */
                case 'progres_kursus':
                    $sesi = $this->currentUser();
                    $slug = trim($_GET['slug'] ?? '');
                    if (!$sesi || !$slug) {
                        $this->json(['ok' => true, 'data' => []]);
                    }
                    $this->json(['ok' => true, 'data' => $modulModel->ambilProgresPeserta((int)$sesi['id'], $slug)]);
                    break;

                case 'simpan_progres':
                    $sesi = $this->requireUserJson();
                    $res = $modulModel->simpanProgres(
                        (int)$sesi['id'],
                        $in['slug'] ?? '',
                        (int)($in['id_modul'] ?? 0)
                    );
                    $this->json($res, $res['ok'] ? 200 : 422);
                    break;

                case 'hapus_progres':
                    $sesi = $this->requireUserJson();
                    $res = $modulModel->hapusProgres(
                        (int)$sesi['id'],
                        $in['slug'] ?? '',
                        (int)($in['id_modul'] ?? 0)
                    );
                    $this->json($res, $res['ok'] ? 200 : 422);
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
                    $slug = trim($_GET['slug'] ?? '');
                    $this->json(['ok' => true, 'data' => $kuisModel->ambilBerdasarkanKursus($slug, false)]);
                    break;

                case 'soal_kuis_admin':
                    $this->requireAdminJson();
                    $slug = trim($_GET['slug'] ?? '');
                    $this->json(['ok' => true, 'data' => $kuisModel->ambilBerdasarkanKursus($slug, true)]);
                    break;

                case 'kirim_kuis':
                    $sesi = $this->requireUserJson();
                    $res = $kuisModel->evaluasiDanSimpan(
                        $in['slug'] ?? '',
                        is_array($in['jawaban'] ?? null) ? $in['jawaban'] : [],
                        $sesi,
                        $sertifikatModel,
                        $modulModel
                    );
                    $this->json($res, $res['ok'] ? 200 : 404);
                    break;

                case 'contoh_nomor_sertifikat':
                    $this->json(['ok' => true, 'data' => $sertifikatModel->ambilContohNomor(4)]);
                    break;

                case 'semua_sertifikat':
                    $this->requireAdminJson();
                    $this->json(['ok' => true, 'data' => $sertifikatModel->ambilSemua()]);
                    break;

                case 'sertifikat':
                    $nomor = trim($_GET['nomor'] ?? '');
                    $sertifikat = $sertifikatModel->ambilBerdasarkanNomor($nomor);
                    if (!$sertifikat) {
                        $this->json(['ok' => false, 'data' => null, 'pesan' => 'Sertifikat tidak ditemukan.'], 404);
                    }
                    $this->json(['ok' => true, 'data' => $sertifikat]);
                    break;

                case 'sertifikat_pengguna':
                    $sesi = $this->currentUser();
                    if (!$sesi) {
                        $this->json(['ok' => true, 'data' => []]);
                    }
                    $this->json(['ok' => true, 'data' => $sertifikatModel->ambilBerdasarkanPengguna((int)$sesi['id'])]);
                    break;

                case 'semua_peserta':
                    $this->requireAdminJson();
                    $this->json(['ok' => true, 'data' => $penggunaModel->ambilSemuaPeserta()]);
                    break;

                /* 5. CRUD ADMIN */
                case 'tambah_kursus':
                    $this->requireAdminJson();
                    $this->json(['ok' => true, 'data' => $kursusModel->tambah($in, $kategoriModel)], 201);
                    break;

                case 'ubah_kursus':
                    $this->requireAdminJson();
                    $this->json(['ok' => true, 'data' => $kursusModel->ubah((int)($in['id_kursus'] ?? 0), $in, $kategoriModel)]);
                    break;

                case 'hapus_kursus':
                    $this->requireAdminJson();
                    $this->json(['ok' => $kursusModel->hapus((int)($in['id_kursus'] ?? 0))]);
                    break;

                case 'tambah_modul':
                    $this->requireAdminJson();
                    $this->json(['ok' => true, 'data' => $modulModel->tambah($in)], 201);
                    break;

                case 'ubah_modul':
                    $this->requireAdminJson();
                    $this->json(['ok' => $modulModel->ubah((int)($in['id_modul'] ?? 0), $in)]);
                    break;

                case 'hapus_modul':
                    $this->requireAdminJson();
                    $this->json(['ok' => $modulModel->hapus((int)($in['id_modul'] ?? 0))]);
                    break;

                case 'tambah_soal':
                    $this->requireAdminJson();
                    $this->json(['ok' => true, 'id' => $kuisModel->tambah($in)], 201);
                    break;

                case 'ubah_soal':
                    $this->requireAdminJson();
                    $this->json(['ok' => $kuisModel->ubah((int)($in['id_soal'] ?? 0), $in)]);
                    break;

                case 'hapus_soal':
                    $this->requireAdminJson();
                    $this->json(['ok' => $kuisModel->hapus((int)($in['id_soal'] ?? 0))]);
                    break;

                case 'reset_demo':
                    $this->requireAdminJson();
                    $sqlFile = dirname(__DIR__, 2) . '/database.sql';
                    if (!file_exists($sqlFile)) {
                        $this->json(['ok' => false, 'pesan' => 'File database.sql tidak ditemukan.'], 404);
                    }
                    Database::executeSqlFile($pdo, $sqlFile);
                    $this->json(['ok' => true]);
                    break;

                default:
                    $this->json(['ok' => false, 'pesan' => 'Endpoint aksi tidak dikenali.'], 400);
                    break;
            }
        } catch (InvalidArgumentException $e) {
            $this->json(['ok' => false, 'pesan' => $e->getMessage()], 422);
        } catch (Throwable $e) {
            $this->json(['ok' => false, 'pesan' => 'Terjadi kesalahan pada server.'], 500);
        }
    }
}
