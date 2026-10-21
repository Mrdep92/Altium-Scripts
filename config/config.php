<?php
declare(strict_types=1);

/* =========================================================
   KONFIGURASI DASAR APLIKASI
   ========================================================= */

define('APP_NAME', 'SMP Negeri 1 Nusantara');
define('APP_TAGLINE', 'Unggul dalam Prestasi, Berakhlak Mulia');

// --- Konfigurasi Database (ubah sesuai server Anda) ---
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'sekolah_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// --- Path & Upload ---
define('APP_ROOT', dirname(__DIR__));
define('UPLOAD_PATH', APP_ROOT . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'uploads');
define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024); // 2 MB
define('ALLOWED_MIME', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);

// --- Zona waktu ---
date_default_timezone_set('Asia/Jakarta');

// --- Base URL otomatis (mendukung subfolder) ---
$__docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', (string) realpath($_SERVER['DOCUMENT_ROOT'])) : '';
$__appRoot = str_replace('\\', '/', (string) realpath(APP_ROOT));
$__base    = '';
if ($__docRoot !== '' && strpos($__appRoot, $__docRoot) === 0) {
    $__base = substr($__appRoot, strlen($__docRoot));
}
define('BASE_URL', rtrim(str_replace('\\', '/', $__base), '/'));
unset($__docRoot, $__appRoot, $__base);

// --- Session ---
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

/* =========================================================
   KONEKSI DATABASE (PDO)
   ========================================================= */

function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            error_log('[DB] ' . $e->getMessage());
            http_response_code(500);
            exit('Koneksi database gagal. Silakan periksa konfigurasi pada <code>config/config.php</code>.');
        }
    }

    return $pdo;
}

function fetch_all(string $sql, array $params = []): array
{
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function fetch_one(string $sql, array $params = []): ?array
{
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    $row = $stmt->fetch();
    return $row === false ? null : $row;
}

function execute_sql(string $sql, array $params = []): bool
{
    $stmt = db()->prepare($sql);
    return $stmt->execute($params);
}

/* =========================================================
   HELPER UMUM
   ========================================================= */

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
   
