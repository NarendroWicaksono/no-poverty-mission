<?php
/**
 * api/index.php
 * Endpoint REST API PHP Native untuk Skill4Life.
 * Menghubungkan frontend dengan database MySQL apabila tersedia.
 */
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/koneksi.php';

$aksi = $_GET['aksi'] ?? '';
$pdo = buatKoneksi();

if (!$pdo) {
    echo json_encode([
        'ok' => false,
        'mode' => 'offline_json',
        'pesan' => 'Layanan database MySQL belum aktif, menggunakan mode penyimpanan lokal.'
    ]);
    exit;
}

try {
    switch ($aksi) {
        case 'cek_status':
            echo json_encode([
                'ok' => true,
                'mode' => 'mysql',
                'database' => DB_NAME
            ]);
            break;

        case 'statistik':
            $kursus = (int)$pdo->query("SELECT COUNT(*) FROM kursus WHERE diterbitkan = 1")->fetchColumn();
            $modul = (int)$pdo->query("SELECT COUNT(*) FROM modul")->fetchColumn();
            $sertifikat = (int)$pdo->query("SELECT COUNT(*) FROM sertifikat")->fetchColumn();
            $peserta = (int)$pdo->query("SELECT COUNT(*) FROM pengguna WHERE peran = 'peserta'")->fetchColumn();
            echo json_encode([
                'ok' => true,
                'data' => [
                    'total_kursus' => $kursus,
                    'total_modul' => $modul,
                    'total_sertifikat' => 841 + $sertifikat,
                    'total_peserta' => $peserta
                ]
            ]);
            break;

        default:
            echo json_encode(['ok' => true, 'pesan' => 'Endpoint API PHP Native Skill4Life aktif.']);
            break;
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'pesan' => $e->getMessage()]);
}
