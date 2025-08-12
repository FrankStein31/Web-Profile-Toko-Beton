<?php
class BeritaModel {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function getAll($status = null) {
        $sql = "SELECT b.*, DATE_FORMAT(b.tanggal_publikasi, '%d %M %Y') as tanggal_format 
                FROM berita b WHERE 1=1";
        $params = [];
        
        if ($status) {
            $sql .= " AND b.status = ?";
            $params[] = $status;
        }
        
        $sql .= " ORDER BY b.tanggal_publikasi DESC";
        
        return $this->db->fetchAll($sql, $params);
    }
    
    public function getById($id) {
        $sql = "SELECT b.*, DATE_FORMAT(b.tanggal_publikasi, '%d %M %Y') as tanggal_format 
                FROM berita b WHERE b.id = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    public function getBySlug($slug) {
        $sql = "SELECT b.*, DATE_FORMAT(b.tanggal_publikasi, '%d %M %Y') as tanggal_format 
                FROM berita b WHERE b.slug = ? AND b.status = 'aktif'";
        return $this->db->fetch($sql, [$slug]);
    }
    
    public function getRecent($limit = 5, $excludeId = null) {
        $sql = "SELECT b.*, DATE_FORMAT(b.tanggal_publikasi, '%d %M %Y') as tanggal_format 
                FROM berita b WHERE b.status = 'aktif'";
        $params = [];
        
        if ($excludeId) {
            $sql .= " AND b.id != ?";
            $params[] = $excludeId;
        }
        
        $sql .= " ORDER BY b.tanggal_publikasi DESC LIMIT ?";
        $params[] = $limit;
        
        return $this->db->fetchAll($sql, $params);
    }
    
    public function search($keyword) {
        $sql = "SELECT b.*, DATE_FORMAT(b.tanggal_publikasi, '%d %M %Y') as tanggal_format 
                FROM berita b 
                WHERE b.status = 'aktif' 
                AND (b.judul LIKE ? OR b.deskripsi LIKE ? OR b.tags LIKE ?)
                ORDER BY b.tanggal_publikasi DESC";
        
        $searchTerm = '%' . $keyword . '%';
        return $this->db->fetchAll($sql, [$searchTerm, $searchTerm, $searchTerm]);
    }
    
    public function create($data) {
        $sql = "INSERT INTO berita (judul, slug, deskripsi, konten, tags, gambar, link_website, status, tanggal_publikasi) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->query($sql, [
            $data['judul'],
            $data['slug'],
            $data['deskripsi'],
            $data['konten'],
            $data['tags'],
            $data['gambar'],
            $data['link_website'],
            $data['status'],
            $data['tanggal_publikasi']
        ]);
        
        return $stmt->rowCount() > 0;
    }
    
    public function update($id, $data) {
        $sql = "UPDATE berita SET 
                judul = ?, slug = ?, deskripsi = ?, konten = ?, tags = ?, 
                gambar = ?, link_website = ?, status = ?, tanggal_publikasi = ?
                WHERE id = ?";
        
        $stmt = $this->db->query($sql, [
            $data['judul'],
            $data['slug'],
            $data['deskripsi'],
            $data['konten'],
            $data['tags'],
            $data['gambar'],
            $data['link_website'],
            $data['status'],
            $data['tanggal_publikasi'],
            $id
        ]);
        
        return $stmt->rowCount() > 0;
    }
    
    public function delete($id) {
        $sql = "DELETE FROM berita WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        return $stmt->rowCount() > 0;
    }
    
    public function slugExists($slug, $excludeId = null) {
        $sql = "SELECT id FROM berita WHERE slug = ?";
        $params = [$slug];
        
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $result = $this->db->fetch($sql, $params);
        return $result !== false;
    }
    
    public function generateSlug($judul, $id = null) {
        // Convert to lowercase and replace spaces with hyphens
        $slug = strtolower(trim($judul));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        
        // Check if slug exists
        $originalSlug = $slug;
        $counter = 1;
        
        while ($this->slugExists($slug, $id)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
    
    public function getStats() {
        $sql = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN status = 'aktif' THEN 1 ELSE 0 END) as aktif,
                    SUM(CASE WHEN status = 'nonaktif' THEN 1 ELSE 0 END) as nonaktif
                FROM berita";
        
        return $this->db->fetch($sql);
    }
}
?>
