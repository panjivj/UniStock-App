<?php

declare(strict_types=1);

// ============================================================
// UNISTOCK – Application Bootstrap
// Salin file ini menjadi bootstrap.php lalu isi kredensial Anda
// ============================================================

define('APP_ROOT', dirname(__FILE__));

// Auto-detect APP_URL based on current folder name (portable across machines)
if (PHP_SAPI !== 'cli' && isset($_SERVER['HTTP_HOST'])) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $folder   = basename(dirname(__FILE__));
    define('APP_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . $folder);
} else {
    define('APP_URL', 'http://localhost/' . basename(dirname(__FILE__)));
}

define('UPLOAD_PATH', APP_ROOT . '/assets/img/uploads/');
define('UPLOAD_URL',  APP_URL  . '/assets/img/uploads/');

// Database credentials — ganti dengan kredensial Anda
define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_db_password');
define('DB_NAME', 'your_db_name');

// Runtime settings
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);
ini_set('display_errors', '0');

// ── PSR-4 Autoloader ────────────────────────────────────────
spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }
    $relative = substr($class, strlen($prefix));
    $file     = APP_ROOT . '/app/' . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// ── Boot session ─────────────────────────────────────────────
App\Core\Session::start();
