<?php
// includes/functions.php
// Helper functions

function formatRupiah($number) {
    return 'Rp ' . number_format($number, 0, ',', '.');
}

function formatTanggal($date) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    $timestamp = strtotime($date);
    $day = date('d', $timestamp);
    $month = $bulan[(int)date('m', $timestamp)];
    $year = date('Y', $timestamp);
    
    return $day . ' ' . $month . ' ' . $year;
}

function uploadImage($file, $targetDir, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        error_log("Upload error: File not set or error occurred. Error code: " . ($file['error'] ?? 'undefined'));
        return false;
    }
    
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    if (!in_array($fileExt, $allowedTypes)) {
        throw new Exception('Tipe file tidak diizinkan. Hanya: ' . implode(', ', $allowedTypes));
    }
    
    if ($fileSize > 5000000) { // 5MB
        throw new Exception('Ukuran file terlalu besar. Maksimal 5MB');
    }
    
    // Create directory if not exists
    if (!is_dir($targetDir)) {
        error_log("Creating directory: " . $targetDir);
        mkdir($targetDir, 0777, true);
    }
    
    $newFileName = time() . '_' . uniqid() . '.' . $fileExt;
    $targetPath = $targetDir . $newFileName;
    
    error_log("Attempting to upload file:");
    error_log("- Source: " . $fileTmpName);
    error_log("- Target: " . $targetPath);
    error_log("- Directory exists: " . (is_dir($targetDir) ? 'YES' : 'NO'));
    error_log("- Directory writable: " . (is_writable($targetDir) ? 'YES' : 'NO'));
    
    if (move_uploaded_file($fileTmpName, $targetPath)) {
        error_log("Upload successful: " . $targetPath);
        return $newFileName;
    }
    
    error_log("Upload failed for: " . $targetPath);
    return false;
}

function deleteFile($filePath) {
    if (file_exists($filePath)) {
        return unlink($filePath);
    }
    return false;
}

function generateSlug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', '-', $string);
    return trim($string, '-');
}

function isLoggedIn() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . ADMIN_URL . 'login.php');
        exit();
    }
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function setFlashMessage($type, $message) {
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message
    ];
}

function getFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $message;
    }
    return null;
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function paginate($totalItems, $itemsPerPage, $currentPage) {
    $totalPages = ceil($totalItems / $itemsPerPage);
    $offset = ($currentPage - 1) * $itemsPerPage;
    
    return [
        'total_pages' => $totalPages,
        'current_page' => $currentPage,
        'offset' => $offset,
        'limit' => $itemsPerPage,
        'has_prev' => $currentPage > 1,
        'has_next' => $currentPage < $totalPages,
        'prev_page' => $currentPage - 1,
        'next_page' => $currentPage + 1
    ];
}
?>
