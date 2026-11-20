<?php
// Konfigurasi koneksi database Skill4Life
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_skill4life');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');
define('SITE_URL', 'http://localhost:8080/no-poverty-mission');
define('SITE_NAME', 'Skill4Life');

/**
 * Buat koneksi PDO ke database MySQL.
 * Jika database belum ada, otomatis jalankan inisialisasi dari database.sql.
 * Mengembalikan null secara aman apabila layanan MySQL sedang tidak aktif.
 */
function buatKoneksi(): ?PDO {
    static $pdo = null;
    static $sudahDicoba = false;

    if ($sudahDicoba) {
        return $pdo;
    }
    $sudahDicoba = true;

    $opsi = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $opsi);
        return $pdo;
    } catch (PDOException $e) {
        // Jika database belum dibuat (error code 1049), coba inisialisasi otomatis
        if ((int)$e->getCode() === 1049) {
            try {
                $pdoServer = new PDO("mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET, DB_USER, DB_PASS, $opsi);
                $sqlFile = __DIR__ . '/../database.sql';
                if (file_exists($sqlFile)) {
                    $sql = file_get_contents($sqlFile);
                    $pdoServer->exec($sql);
                } else {
                    $pdoServer->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                }
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
                $pdo = new PDO($dsn, DB_USER, DB_PASS, $opsi);
                return $pdo;
            } catch (PDOException $ex) {
                return null;
            }
        }
        return null;
    }
}

// Generate CSRF token
function buatTokenCSRF(): string {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verifikasi CSRF token
function verifikasiCSRF(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
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

// Escape output
function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
