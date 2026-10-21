<?php
/**
 * config/config.php
 * ------------------------------------------------------------------
 * Konfigurasi utama Website Sekolah.
 * Semua konstanta global, path, dan kredensial database didefinisikan
 * di sini agar mudah dipindahkan antar environment.
 * ------------------------------------------------------------------
 */

declare(strict_types=1);

/* -----------------------------------------------------------------
 | 1. Environment
 * ----------------------------------------------------------------- */
define('APP_ENV', 'development');          // 'development' | 'production'
define('APP_NAME', 'Website Sekolah');

/* -----------------------------------------------------------------
 | 2. Path Aplikasi
 * ----------------------------------------------------------------- */
define('APP_ROOT', dirname(__DIR__));      // root folder project
define('APP_INCLUDES', APP_ROOT . '/includes');
define('APP_UPLOADS', APP_ROOT . '/uploads');
define('UPLOAD_PATH', APP_UPLOADS);        // path fisik
define('UPLOAD_URL', 'uploads');           // path relatif untuk URL
define('UPLOAD_MAX_SIZE', 2 * 1024 * 1024); // 2 MB
define('UPLOAD_ALLOWED_EXT', ['jpg', 'jpeg', 'png', 'webp']);
define('UPLOAD_ALLOWED_MIME', ['image/jpeg', 'image/png', 'image/webp']);

/* -----------------------------------------------------------------
 | 3. Base URL (auto-detect, bisa di-override manual)
 * ----------------------------------------------------------------- */
if (!defined('BASE_URL')) {
    $scheme = 'http';

    if (!empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off') {
        $scheme = 'https';
    } elseif (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https') {
        $scheme = 'https';
    } elseif (($_SERVER['SERVER_PORT'] ?? '') === '443') {
        $scheme = 'https';
    }

    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    $basePath = '';
    if (!empty($_SERVER['DOCUMENT_ROOT'])) {
        $docRoot = str_replace('\\', '/', rtrim((string) $_SERVER['DOCUMENT_ROOT'], '/'));
        $appRoot = str_replace('\\', '/', APP_ROOT);

        if ($docRoot !== '' && strpos($appRoot, $docRoot) === 0) {
            $basePath = substr($appRoot, strlen($docRoot));
        }
    }

    define('BASE_URL', $scheme . '://' . $host . rtrim($basePath, '/') . '/');
}

/* -----------------------------------------------------------------
 | 4. Identitas Situs
 * ----------------------------------------------------------------- */
define('SITE_NAME', 'SD Negeri 1 Nusantara');
define('SITE_TAGLINE', 'Berprestasi, Berkarakter, Berbudaya');
define('SITE_EMAIL',
