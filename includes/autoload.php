<?php
// includes/autoload.php
// Autoloader untuk memuat class secara otomatis

spl_autoload_register(function ($className) {
    $directories = [
        'classes/',
        'models/',
        'controllers/'
    ];
    
    foreach ($directories as $directory) {
        $file = __DIR__ . '/../' . $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
?>
