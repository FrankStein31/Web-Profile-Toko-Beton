<?php
// models/AboutModel.php
// Model untuk tabel about_content

class AboutModel {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function getAll($status = null) {
        $sql = "SELECT * FROM about_content WHERE 1=1";
        $params = [];
        
        if ($status) {
            $sql .= " AND status = ?";
            $params[] = $status;
        }
        
        $sql .= " ORDER BY display_order ASC, created_at ASC";
        
        return $this->db->fetchAll($sql, $params);
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM about_content WHERE id = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    public function getBySection($section_name, $status = 'aktif') {
        $sql = "SELECT * FROM about_content WHERE section_name = ? AND status = ?";
        return $this->db->fetch($sql, [$section_name, $status]);
    }
    
    public function getActiveContent() {
        $sql = "SELECT * FROM about_content WHERE status = 'aktif' ORDER BY display_order ASC";
        return $this->db->fetchAll($sql);
    }
    
    public function create($data) {
        $sql = "INSERT INTO about_content (section_name, title, subtitle, content, image, display_order, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->query($sql, [
            $data['section_name'],
            $data['title'],
            $data['subtitle'],
            $data['content'],
            $data['image'] ?? null,
            $data['display_order'] ?? 0,
            $data['status'] ?? 'aktif'
        ]);
        
        return $this->db->lastInsertId();
    }
    
    public function update($id, $data) {
        $sql = "UPDATE about_content SET 
                section_name = ?, title = ?, subtitle = ?, content = ?, 
                image = ?, display_order = ?, status = ?
                WHERE id = ?";
        
        $stmt = $this->db->query($sql, [
            $data['section_name'],
            $data['title'],
            $data['subtitle'],
            $data['content'],
            $data['image'] ?? null,
            $data['display_order'] ?? 0,
            $data['status'] ?? 'aktif',
            $id
        ]);
        
        return $stmt->rowCount() > 0;
    }
    
    public function delete($id) {
        $sql = "DELETE FROM about_content WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        return $stmt->rowCount() > 0;
    }
    
    public function updateStatus($id, $status) {
        $sql = "UPDATE about_content SET status = ? WHERE id = ?";
        $stmt = $this->db->query($sql, [$status, $id]);
        return $stmt->rowCount() > 0;
    }
    
    public function sectionExists($section_name, $excludeId = null) {
        $sql = "SELECT id FROM about_content WHERE section_name = ?";
        $params = [$section_name];
        
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $result = $this->db->fetch($sql, $params);
        return $result !== false;
    }
    
    public function reorderSections($orders) {
        foreach ($orders as $id => $order) {
            $sql = "UPDATE about_content SET display_order = ? WHERE id = ?";
            $this->db->query($sql, [$order, $id]);
        }
        return true;
    }
    
    public function getStats() {
        $sql = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN status = 'aktif' THEN 1 ELSE 0 END) as aktif,
                    SUM(CASE WHEN status = 'nonaktif' THEN 1 ELSE 0 END) as nonaktif
                FROM about_content";
        
        return $this->db->fetch($sql);
    }
    
    public function generateSectionName($title) {
        $section = strtolower(trim($title));
        $section = preg_replace('/[^a-z0-9\s]/', '', $section);
        $section = preg_replace('/\s+/', '_', $section);
        $section = trim($section, '_');
        
        // Check if section exists
        $originalSection = $section;
        $counter = 1;
        
        while ($this->sectionExists($section)) {
            $section = $originalSection . '_' . $counter;
            $counter++;
        }
        
        return $section;
    }
}
?>