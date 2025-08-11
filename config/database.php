<?php
// config/database.php
// Konfigurasi koneksi database

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Sesuaikan dengan password MySQL Anda
define('DB_NAME', 'beton_profile');
define('DB_CHARSET', 'utf8mb4');

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Base URL
define('BASE_URL', 'http://localhost/WebProfile/');
define('ADMIN_URL', BASE_URL . 'admin/');

// Upload paths
define('UPLOAD_PATH', 'assets/img/uploads/');
define('KATEGORI_IMG_PATH', UPLOAD_PATH . 'kategori/');
define('PRODUK_IMG_PATH', UPLOAD_PATH . 'produk/');

// Session settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 for HTTPS
session_start();

// Error reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
