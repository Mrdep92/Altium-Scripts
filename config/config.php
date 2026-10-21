<?php
/**
 * config/config.php
 * Konfigurasi utama Website Sekolah.
 * Semua pengaturan sensitif sebaiknya di-override via environment variable.
 */
declare(strict_types=1);

/* =========================================================
 | 1. MODE APLIKASI
 * ========================================================= */
define('APP_ENV', getenv('APP_ENV') ?: 'production'); // production | development
define('APP_DEBUG', APP_ENV === 'development');

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    ini_set('display_errors', '0');
}

date_default_timezone_set('Asia/Jakarta');

/* =========================================================
 | 2. IDENTITAS SEKOLAH (fallback bila data DB kosong)
 * ========================================================= */
define('APP_NAME', 'SD Negeri 1 Nusantara');
define('APP_SHORT_NAME', 'SDN 1 Nusantara');
define('APP_TAGLINE', 'Berprestasi, Berkarakter, Berbudaya');
define('APP_EMAIL', 'info@sdn1nusantara.sch.id');
define('APP_PHONE', '(021) 1234-5678');
define('APP_ADDRESS', 'Jl. Pendidikan No. 123, Kec. Nusantara, Kota Nusantara 12345');

/* =========================================================
 | 3. KONFIGURASI DATABASE (PDO / MySQL)
 * ========================================================= */
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'sekolah');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
define('DB_CHARSET', 'utf8mb4');

/* =========================================================
 | 4. BASE URL
 | Dihitung otomatis agar dapat berjalan di root domain
 | maupun di sub-folder (mis. http://localhost/sekolah).
 * ========================================================= */
if (!defined('BASE_URL')) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';

    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
    $dir        = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');

    // Jika file dijalankan dari dalam folder /admin, naik satu level.
    $dir = preg_replace('#/admin$#', '', $dir);
    // Jika file dijalankan dari dalam folder /includes, naik satu level.
    $dir = preg_replace('#/includes$#', '', $dir);

    define('BASE_URL', $scheme . '://' . $host . $dir);
}

/* =========================================================
 | 5. PATH & UPLOAD
 * ========================================================= */
define('ROOT_PATH', dirname(__DIR__));
define('UPLOAD_PATH', ROOT_PATH . '/assets/uploads');
define('UPLOAD_URL', BASE_URL . '/assets/uploads');
define('UPLOAD_MAX_BYTES', 2 * 1024 * 1024); // 2 MB
define('UPLOAD_ALLOWED_EXT', ['jpg', 'jpeg', 'png', 'webp', 'gif']);
define('UPLOAD_ALLOWED_MIME', ['image/jpeg', 'image/png', 'image/webp', 'image/gif']);

/* =========================================================
 | 6. PAGINATION
 * ========================================================= */
define('PER_PAGE_BERITA', 6);
define('PER_PAGE_ADMIN', 10);
