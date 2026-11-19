<?php
// Konfigurasi koneksi database Skill4Life
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_skill4life');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');
define('SITE_URL', 'http://localhost/skill4life');
define('SITE_NAME', 'Skill4Life');

function buatKoneksi(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
        $opsi = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $opsi);
        } catch (PDOException $e) {
            die('<h2 style="font-family:sans-serif;color:#c00;padding:2rem">Gagal konek database: ' . htmlspecialchars($e->getMessage()) . '</h2>');
        }
    }
    return $pdo;
}

// Generate CSRF token
function buatTokenCSRF(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verifikasi CSRF token
function verifikasiCSRF(): void {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])) {
        http_response_code(403);
        die('<h2 style="font-family:sans-serif;padding:2rem">Token keamanan tidak valid. Silakan refresh halaman.</h2>');
    }
}

// Redirect helper
function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

// Pastikan pengguna sudah login (peserta)
function wajibLogin(): void {
    if (empty($_SESSION['pengguna_id']) || $_SESSION['peran'] !== 'peserta') {
        redirect(SITE_URL . '/auth/login.php?pesan=harap_login');
    }
}

// Pastikan sudah login sebagai admin
function wajibAdmin(): void {
    if (empty($_SESSION['pengguna_id']) || $_SESSION['peran'] !== 'admin') {
        redirect(SITE_URL . '/admin/login.php?pesan=harap_login');
    }
}

// Escape output
function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Hitung progres modul kursus untuk pengguna
function hitungProgres(int $penggunaId, int $kursusId): array {
    $pdo = buatKoneksi();
    $totalStmt = $pdo->prepare("SELECT COUNT(*) FROM modul WHERE kursus_id = ?");
    $totalStmt->execute([$kursusId]);
    $total = (int)$totalStmt->fetchColumn();
    $selesaiStmt = $pdo->prepare("SELECT COUNT(*) FROM progres_modul WHERE pengguna_id = ? AND kursus_id = ?");
    $selesaiStmt->execute([$penggunaId, $kursusId]);
    $selesai = (int)$selesaiStmt->fetchColumn();
    $persen = $total > 0 ? round(($selesai / $total) * 100) : 0;
    return ['total' => $total, 'selesai' => $selesai, 'persen' => $persen];
}

// Ambil semua kursus yang diikuti pengguna
function ambilKursusAktif(int $penggunaId): array {
    $pdo = buatKoneksi();
    $stmt = $pdo->prepare("
        SELECT DISTINCT k.*, kat.nama_kategori 
        FROM kursus k 
        JOIN kategori kat ON k.kategori_id = kat.id
        JOIN progres_modul pm ON pm.kursus_id = k.id
        WHERE pm.pengguna_id = ?
        ORDER BY pm.selesai_pada DESC
    ");
    $stmt->execute([$penggunaId]);
    return $stmt->fetchAll();
}
