# Panduan Setup Database - Turen Indah Bangunan

## Langkah-langkah Setup Database

### 1. Import Database
1. Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`
2. Klik "Import" atau "Impor"
3. Pilih file `database/beton_profile.sql`
4. Klik "Go" atau "Kirim"

### 2. Atau Buat Database Manual
Jika ingin membuat manual, jalankan perintah SQL berikut di phpMyAdmin:

```sql
-- Buat database
CREATE DATABASE IF NOT EXISTS beton_profile;
USE beton_profile;

-- Copy dan paste semua SQL dari file database/beton_profile.sql
```

### 3. Konfigurasi Database
Edit file `config/database.php` sesuai setup MySQL Anda:

```php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Sesuaikan dengan password MySQL Anda
define('DB_NAME', 'beton_profile');
```

### 4. Login Admin Default
- URL Admin: `http://localhost/WebProfile/admin/`
- Username: `admin`
- Password: `admin123`

### 5. Struktur File Yang Dibuat

```
WebProfile/
├── config/
│   └── database.php                 # Konfigurasi database
├── includes/
│   ├── init.php                     # Bootstrap file
│   ├── autoload.php                 # Autoloader
│   └── functions.php                # Helper functions
├── classes/
│   └── Database.php                 # Database connection class
├── models/
│   ├── Kategori.php                 # Model kategori
│   ├── Produk.php                   # Model produk
│   └── Admin.php                    # Model admin
├── admin/
│   ├── login.php                    # Login admin
│   ├── dashboard.php                # Dashboard admin
│   ├── kategori.php                 # Kelola kategori
│   ├── produk.php                   # Kelola produk
│   ├── logout.php                   # Logout
│   └── includes/
│       ├── header.php               # Header admin
│       └── footer.php               # Footer admin
├── database/
│   └── beton_profile.sql            # Script database
├── shop.php                         # Halaman produk (menggantikan shop.html)
├── single-product.php               # Detail produk (menggantikan single-product.html)
└── assets/img/uploads/              # Direktori upload gambar
    ├── kategori/                    # Gambar kategori
    └── produk/                      # Gambar produk
```

### 6. Fitur Yang Tersedia

#### Admin Dashboard:
- ✅ Login/Logout admin
- ✅ Dashboard dengan statistik
- ✅ CRUD Kategori (Create, Read, Update, Delete)
- ✅ CRUD Produk dengan upload gambar
- ✅ Filter dan pencarian
- ✅ Status aktif/nonaktif
- ✅ Responsive design

#### Website Frontend:
- ✅ Halaman produk dinamis dari database
- ✅ Filter berdasarkan kategori
- ✅ Pencarian produk
- ✅ Detail produk
- ✅ Produk terkait
- ✅ Responsive design

### 7. File Yang Dihapus/Tidak Diperlukan Lagi

File HTML statis berikut bisa dihapus karena sudah diganti dengan versi PHP:
- `shop.html` → diganti dengan `shop.php`
- `shop1.html`, `shop2.html`, dst → tidak diperlukan
- `single-product.html` → diganti dengan `single-product.php`

### 8. Update Menu Navigation

Update semua file HTML untuk mengarah ke:
- `shop.html` → `shop.php`
- `single-product.html` → `single-product.php`

### 9. Test Website

1. Buka: `http://localhost/WebProfile/shop.php`
2. Buka: `http://localhost/WebProfile/admin/`
3. Login dengan admin/admin123
4. Tambah kategori dan produk
5. Test filter dan pencarian di frontend

### 10. Tips Penggunaan

1. **Upload Gambar**: Gambar akan disimpan di `assets/img/uploads/`
2. **Format Harga**: Gunakan angka saja, formatting otomatis
3. **Tags**: Pisahkan dengan koma untuk SEO yang lebih baik
4. **Stok**: Produk dengan stok ≤ 5 akan ditandai sebagai stok rendah
5. **Status**: Produk nonaktif tidak akan muncul di frontend

### 11. Keamanan

- ✅ Password di-hash dengan bcrypt
- ✅ SQL injection protection dengan prepared statements
- ✅ XSS protection dengan htmlspecialchars
- ✅ File upload validation
- ✅ Session security

### 12. Troubleshooting

**Jika error "Database connection failed":**
1. Pastikan MySQL/MariaDB sudah jalan
2. Periksa username/password di `config/database.php`
3. Pastikan database `beton_profile` sudah dibuat

**Jika error upload gambar:**
1. Pastikan folder `assets/img/uploads/` bisa ditulis (chmod 777)
2. Periksa size limit PHP (max_file_size)

**Jika halaman admin tidak bisa diakses:**
1. Pastikan file .htaccess tidak memblokir folder admin
2. Periksa URL: harus `http://localhost/WebProfile/admin/`
