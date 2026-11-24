<?php
/**
 * config/koneksi.php
 * Konstanta konfigurasi database MySQL dan identitas situs Skill4Life.
 */

// Deteksi otomatis jika berjalan di hosting InfinityFree atau lokal
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
