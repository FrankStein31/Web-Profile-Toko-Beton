<?php
require_once 'includes/init.php';

echo "<h2>Upload Path Debug</h2>";
echo "UPLOAD_PATH: " . UPLOAD_PATH . "<br>";
echo "PRODUK_IMG_PATH: " . PRODUK_IMG_PATH . "<br>";
echo "KATEGORI_IMG_PATH: " . KATEGORI_IMG_PATH . "<br>";
echo "<br>";

echo "Current working directory: " . getcwd() . "<br>";
echo "<br>";

echo "Full produk path: " . getcwd() . '/' . PRODUK_IMG_PATH . "<br>";
echo "Full kategori path: " . getcwd() . '/' . KATEGORI_IMG_PATH . "<br>";
echo "<br>";

echo "Produk directory exists: " . (is_dir(PRODUK_IMG_PATH) ? 'YES' : 'NO') . "<br>";
echo "Kategori directory exists: " . (is_dir(KATEGORI_IMG_PATH) ? 'YES' : 'NO') . "<br>";
echo "<br>";

echo "Produk directory writable: " . (is_writable(PRODUK_IMG_PATH) ? 'YES' : 'NO') . "<br>";
echo "Kategori directory writable: " . (is_writable(KATEGORI_IMG_PATH) ? 'YES' : 'NO') . "<br>";
echo "<br>";

// Test upload simulation
if ($_POST) {
    echo "<h3>Test Upload Simulation</h3>";
    
    // Simulate file array
    $testFile = [
        'name' => 'test.jpg',
        'tmp_name' => 'C:\\temp\\test.jpg', // This won't exist, but we can test the path logic
        'size' => 1000,
        'error' => UPLOAD_ERR_OK,
        'type' => 'image/jpeg'
    ];
    
    echo "Testing uploadImage function...<br>";
    try {
        $result = uploadImage($testFile, PRODUK_IMG_PATH);
        echo "Result: " . ($result ? $result : 'FALSE') . "<br>";
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage() . "<br>";
    }
}
?>

<form method="post">
    <button type="submit">Test Upload Path</button>
</form>

<hr>
<a href="<?= BASE_URL ?>">← Back to Home</a>
