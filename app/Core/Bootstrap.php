<?php
/**
 * app/Core/Bootstrap.php
 * Inisialisasi session, konfigurasi database, dan PSR-4 style autoloader untuk arsitektur MVC Skill4Life.
 */
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$configFile = dirname(__DIR__, 2) . '/config/koneksi.php';
if (file_exists($configFile)) {
    require_once $configFile;
} else {
    // Fallback otomatis jika folder config belum terunggah ke hosting
    if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'infinityfree') !== false) {
        define('DB_HOST', 'sql300.infinityfree.com');
        define('DB_NAME', 'if0_43502800_skill4life');
        define('DB_USER', 'if0_43502800');
        define('DB_PASS', 'DAULE89JBC');
        define('SITE_URL', 'http://skill4life.infinityfree.me');
    } else {
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'db_skill4life');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('SITE_URL', 'http://localhost/skill4life');
    }
    define('DB_CHARSET', 'utf8mb4');
    define('SITE_NAME', 'Skill4Life');
}

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = dirname(__DIR__) . '/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
