<?php
// models/Kategori.php
// Model untuk tabel kategori

class Kategori {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function getAll() {
        $sql = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
        return $this->db->fetchAll($sql);
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM kategori WHERE id = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    public function getByStatus($status = 'aktif') {
        $sql = "SELECT * FROM kategori WHERE status = ? ORDER BY nama_kategori ASC";
        return $this->db->fetchAll($sql, [$status]);
    }
    
    public function create($data) {
        $sql = "INSERT INTO kategori (nama_kategori, deskripsi, gambar, status) VALUES (?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['nama_kategori'],
            $data['deskripsi'] ?? null,
            $data['gambar'] ?? null,
            $data['status'] ?? 'aktif'
        ]);
        return $this->db->lastInsertId();
    }
    
    public function update($id, $data) {
        $sql = "UPDATE kategori SET nama_kategori = ?, deskripsi = ?, gambar = ?, status = ? WHERE id = ?";
        return $this->db->query($sql, [
            $data['nama_kategori'],
            $data['deskripsi'] ?? null,
            $data['gambar'] ?? null,
            $data['status'] ?? 'aktif',
            $id
        ]);
    }
    
    public function delete($id) {
        // Check if kategori has products
        $checkSql = "SELECT COUNT(*) as count FROM produk WHERE id_kategori = ?";
        $result = $this->db->fetch($checkSql, [$id]);
        
        if ($result['count'] > 0) {
            throw new Exception("Kategori tidak bisa dihapus karena masih memiliki produk");
        }
        
        $sql = "DELETE FROM kategori WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }
    
    public function updateStatus($id, $status) {
        $sql = "UPDATE kategori SET status = ? WHERE id = ?";
        return $this->db->query($sql, [$status, $id]);
    }
    
    public function search($keyword) {
        $sql = "SELECT * FROM kategori WHERE nama_kategori LIKE ? OR deskripsi LIKE ? ORDER BY nama_kategori ASC";
        $searchTerm = "%{$keyword}%";
        return $this->db->fetchAll($sql, [$searchTerm, $searchTerm]);
    }
    
    public function getProductCount($id) {
        $sql = "SELECT COUNT(*) as count FROM produk WHERE id_kategori = ?";
        $result = $this->db->fetch($sql, [$id]);
        return $result['count'];
    }
}
?>
