-- Database: beton_profile
-- Struktur database untuk toko beton

CREATE DATABASE IF NOT EXISTS beton_profile;
USE beton_profile;

-- Tabel kategori
CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255),
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel produk
CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_kategori INT NOT NULL,
    nama_produk VARCHAR(200) NOT NULL,
    deskripsi TEXT,
    deskripsi_tambahan TEXT,
    tags VARCHAR(500),
    harga DECIMAL(15,2) DEFAULT 0,
    stok INT DEFAULT 0,
    satuan VARCHAR(50) DEFAULT 'pcs',
    gambar_utama VARCHAR(255),
    galeri_gambar TEXT, -- JSON array untuk multiple images
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id) ON DELETE CASCADE
);

-- Tabel admin untuk login dashboard
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    level ENUM('super_admin', 'admin') DEFAULT 'admin',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert data default kategori
INSERT INTO kategori (nama_kategori, deskripsi) VALUES 
('Beton Ready Mix', 'Beton siap pakai dengan berbagai mutu dan kualitas terjamin'),
('Paving Block', 'Paving block berbagai ukuran dan motif untuk jalan dan taman'),
('Kanstin', 'Kanstin beton untuk pembatas jalan dan trotoar'),
('Buis Beton', 'Buis beton untuk drainase dan saluran air'),
('Panel Lantai', 'Panel lantai beton precast untuk konstruksi'),
('U-Ditch', 'Saluran beton precast berbagai ukuran');

-- Insert data default produk
INSERT INTO produk (id_kategori, nama_produk, deskripsi, deskripsi_tambahan, tags, harga, stok, satuan) VALUES 
(1, 'Beton Ready Mix K250', 'Beton ready mix mutu K250 untuk konstruksi ringan', 'Cocok untuk rumah tinggal, jalan lingkungan, dan konstruksi ringan lainnya', 'beton,ready mix,k250,konstruksi', 850000, 100, 'm3'),
(1, 'Beton Ready Mix K300', 'Beton ready mix mutu K300 untuk konstruksi sedang', 'Ideal untuk bangunan bertingkat rendah dan infrastruktur sedang', 'beton,ready mix,k300,konstruksi', 900000, 80, 'm3'),
(2, 'Paving Block Hexagon', 'Paving block motif hexagon 6cm', 'Paving block dengan motif hexagon, ketebalan 6cm, cocok untuk taman dan area parkir', 'paving,hexagon,taman,parkir', 85000, 500, 'm2'),
(3, 'Kanstin Tegak 15x25x100', 'Kanstin tegak ukuran 15x25x100cm', 'Kanstin beton untuk pembatas jalan dengan kualitas tinggi', 'kanstin,pembatas,jalan', 75000, 200, 'pcs'),
(4, 'Buis Beton Diameter 40cm', 'Buis beton diameter 40cm panjang 100cm', 'Buis beton berkualitas untuk sistem drainase', 'buis,drainase,saluran', 250000, 50, 'pcs'),
(5, 'Panel Lantai 120x60', 'Panel lantai beton precast 120x60cm', 'Panel lantai berkualitas tinggi untuk konstruksi cepat', 'panel,lantai,precast', 185000, 30, 'pcs');

-- Insert data admin default (password: admin123)
INSERT INTO admin (username, password, nama_lengkap, email, level) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@turenindahbangunan.com', 'super_admin');
