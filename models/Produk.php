<?php
// models/Produk.php
// Model untuk tabel produk

class Produk {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function getAll() {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM produk p 
                LEFT JOIN kategori k ON p.id_kategori = k.id 
                ORDER BY p.nama_produk ASC";
        return $this->db->fetchAll($sql);
    }
    
    public function getById($id) {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM produk p 
                LEFT JOIN kategori k ON p.id_kategori = k.id 
                WHERE p.id = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    public function getByKategori($id_kategori, $status = 'aktif') {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM produk p 
                LEFT JOIN kategori k ON p.id_kategori = k.id 
                WHERE p.id_kategori = ? AND p.status = ? 
                ORDER BY p.nama_produk ASC";
        return $this->db->fetchAll($sql, [$id_kategori, $status]);
    }
    
    public function getByStatus($status = 'aktif') {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM produk p 
                LEFT JOIN kategori k ON p.id_kategori = k.id 
                WHERE p.status = ? 
                ORDER BY p.nama_produk ASC";
        return $this->db->fetchAll($sql, [$status]);
    }
    
    public function create($data) {
        $sql = "INSERT INTO produk (id_kategori, nama_produk, deskripsi, deskripsi_tambahan, tags, harga, stok, satuan, gambar_utama, galeri_gambar, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['id_kategori'],
            $data['nama_produk'],
            $data['deskripsi'] ?? null,
            $data['deskripsi_tambahan'] ?? null,
            $data['tags'] ?? null,
            $data['harga'] ?? 0,
            $data['stok'] ?? 0,
            $data['satuan'] ?? 'pcs',
            $data['gambar_utama'] ?? null,
            $data['galeri_gambar'] ?? null,
            $data['status'] ?? 'aktif'
        ]);
        return $this->db->lastInsertId();
    }
    
    public function update($id, $data) {
        $sql = "UPDATE produk SET id_kategori = ?, nama_produk = ?, deskripsi = ?, deskripsi_tambahan = ?, tags = ?, harga = ?, stok = ?, satuan = ?, gambar_utama = ?, galeri_gambar = ?, status = ? WHERE id = ?";
        return $this->db->query($sql, [
            $data['id_kategori'],
            $data['nama_produk'],
            $data['deskripsi'] ?? null,
            $data['deskripsi_tambahan'] ?? null,
            $data['tags'] ?? null,
            $data['harga'] ?? 0,
            $data['stok'] ?? 0,
            $data['satuan'] ?? 'pcs',
            $data['gambar_utama'] ?? null,
            $data['galeri_gambar'] ?? null,
            $data['status'] ?? 'aktif',
            $id
        ]);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM produk WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }
    
    public function updateStatus($id, $status) {
        $sql = "UPDATE produk SET status = ? WHERE id = ?";
        return $this->db->query($sql, [$status, $id]);
    }
    
    public function updateStok($id, $stok) {
        $sql = "UPDATE produk SET stok = ? WHERE id = ?";
        return $this->db->query($sql, [$stok, $id]);
    }
    
    public function search($keyword) {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM produk p 
                LEFT JOIN kategori k ON p.id_kategori = k.id 
                WHERE p.nama_produk LIKE ? OR p.deskripsi LIKE ? OR p.tags LIKE ? OR k.nama_kategori LIKE ?
                ORDER BY p.nama_produk ASC";
        $searchTerm = "%{$keyword}%";
        return $this->db->fetchAll($sql, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    }
    
    public function getFeatured($limit = 6) {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM produk p 
                LEFT JOIN kategori k ON p.id_kategori = k.id 
                WHERE p.status = 'aktif' AND p.stok > 0
                ORDER BY p.created_at DESC 
                LIMIT ?";
        return $this->db->fetchAll($sql, [$limit]);
    }
    
    public function getLatest($limit = 8) {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM produk p 
                LEFT JOIN kategori k ON p.id_kategori = k.id 
                WHERE p.status = 'aktif'
                ORDER BY p.created_at DESC 
                LIMIT ?";
        return $this->db->fetchAll($sql, [$limit]);
    }
    
    public function getByPriceRange($min_price, $max_price) {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM produk p 
                LEFT JOIN kategori k ON p.id_kategori = k.id 
                WHERE p.harga BETWEEN ? AND ? AND p.status = 'aktif'
                ORDER BY p.harga ASC";
        return $this->db->fetchAll($sql, [$min_price, $max_price]);
    }
}
?>
