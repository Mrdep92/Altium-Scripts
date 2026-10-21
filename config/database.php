<?php
/**
 * config/database.php
 * Koneksi database menggunakan PDO (single instance).
 */
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/**
 * Mengembalikan instance PDO (singleton).
 *
 * @throws PDOException
 */
function db(): PDO
{
