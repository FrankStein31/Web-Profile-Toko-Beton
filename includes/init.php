<?php
// includes/init.php
// File bootstrap untuk memuat semua konfigurasi dan dependencies

// Load configuration
require_once __DIR__ . '/../config/database.php';

// Load autoloader
require_once __DIR__ . '/autoload.php';

// Load helper functions
require_once __DIR__ . '/functions.php';

// Initialize database connection
try {
    $database = new Database();
    $db = $database->getConnection();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Initialize models
$kategoriModel = new Kategori($database);
$produkModel = new Produk($database);
$adminModel = new Admin($database);
$beritaModel = new BeritaModel($database);

// Set error handling
set_error_handler(function($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
});
?>
