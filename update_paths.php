<?php
// Script untuk update semua path display
$files = [
    'index.php',
    'shop.php', 
    'single-product.php',
    'admin/produk.php',
    'admin/kategori.php',
    'admin/dashboard.php'
];

foreach ($files as $file) {
    $filepath = "c:/laragon/www/WebProfile/$file";
    
    if (file_exists($filepath)) {
        $content = file_get_contents($filepath);
        
        // Replace PRODUK_IMG_PATH dengan PRODUK_IMG_URL untuk display
        $content = str_replace(
            'BASE_URL . PRODUK_IMG_PATH',
            'BASE_URL . PRODUK_IMG_URL',
            $content
        );
        
        // Replace KATEGORI_IMG_PATH dengan KATEGORI_IMG_URL untuk display  
        $content = str_replace(
            'BASE_URL . KATEGORI_IMG_PATH',
            'BASE_URL . KATEGORI_IMG_URL',
            $content
        );
        
        file_put_contents($filepath, $content);
        echo "Updated: $file\n";
    }
}

echo "All files updated!\n";
?>
