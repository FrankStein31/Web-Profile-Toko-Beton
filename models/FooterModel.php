<?php
// models/FooterModel.php
// Model untuk tabel footer_content

class FooterModel {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function getAll($status = null) {
        $sql = "SELECT * FROM footer_content WHERE 1=1";
        $params = [];
        
        if ($status) {
            $sql .= " AND status = ?";
            $params[] = $status;
        }
        
        $sql .= " ORDER BY display_order ASC, created_at ASC";
        
        return $this->db->fetchAll($sql, $params);
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM footer_content WHERE id = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    public function getBySectionName($section_name) {
        $sql = "SELECT * FROM footer_content WHERE section_name = ?";
        return $this->db->fetch($sql, [$section_name]);
    }
    
    public function getActiveContent() {
        $sql = "SELECT * FROM footer_content WHERE status = 'aktif' ORDER BY display_order ASC";
        return $this->db->fetchAll($sql);
    }
    
    public function getActiveBySection($section_name) {
        $sql = "SELECT * FROM footer_content WHERE section_name = ? AND status = 'aktif'";
        return $this->db->fetch($sql, [$section_name]);
    }
    
    public function create($data) {
        $sql = "INSERT INTO footer_content (section_name, title, content, links, display_order, status) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->query($sql, [
            $data['section_name'],
            $data['title'],
            $data['content'] ?? null,
            $data['links'] ?? null,
            $data['display_order'] ?? 0,
            $data['status'] ?? 'aktif'
        ]);
        
        return $this->db->lastInsertId();
    }
    
    public function update($id, $data) {
        $sql = "UPDATE footer_content SET 
                section_name = ?, title = ?, content = ?, links = ?, 
                display_order = ?, status = ?
                WHERE id = ?";
        
        $stmt = $this->db->query($sql, [
            $data['section_name'],
            $data['title'],
            $data['content'] ?? null,
            $data['links'] ?? null,
            $data['display_order'] ?? 0,
            $data['status'] ?? 'aktif',
            $id
        ]);
        
        return $stmt->rowCount() > 0;
    }
    
    public function updateBySectionName($section_name, $data) {
        $sql = "UPDATE footer_content SET 
                title = ?, content = ?, links = ?, status = ?
                WHERE section_name = ?";
        
        $stmt = $this->db->query($sql, [
            $data['title'],
            $data['content'] ?? null,
            $data['links'] ?? null,
            $data['status'] ?? 'aktif',
            $section_name
        ]);
        
        return $stmt->rowCount() > 0;
    }
    
    public function delete($id) {
        $sql = "DELETE FROM footer_content WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        return $stmt->rowCount() > 0;
    }
    
    public function updateStatus($id, $status) {
        $sql = "UPDATE footer_content SET status = ? WHERE id = ?";
        $stmt = $this->db->query($sql, [$status, $id]);
        return $stmt->rowCount() > 0;
    }
    
    public function sectionExists($section_name, $excludeId = null) {
        $sql = "SELECT id FROM footer_content WHERE section_name = ?";
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
            $sql = "UPDATE footer_content SET display_order = ? WHERE id = ?";
            $this->db->query($sql, [$order, $id]);
        }
        return true;
    }
    
    public function getStats() {
        $sql = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN status = 'aktif' THEN 1 ELSE 0 END) as aktif,
                    SUM(CASE WHEN status = 'nonaktif' THEN 1 ELSE 0 END) as nonaktif
                FROM footer_content";
        
        return $this->db->fetch($sql);
    }
    
    // Helper methods untuk parsing links JSON
    public function parseLinks($links) {
        if (empty($links)) return [];
        
        $decoded = json_decode($links, true);
        return $decoded ? $decoded : [];
    }
    
    public function encodeLinks($linksArray) {
        if (empty($linksArray)) return null;
        return json_encode($linksArray, JSON_UNESCAPED_SLASHES);
    }
    
    // Methods khusus untuk setiap section
    public function getAboutUsContent() {
        return $this->getActiveBySection('about_us');
    }
    
    public function getGetInTouchLinks() {
        $section = $this->getActiveBySection('get_in_touch');
        if ($section && $section['links']) {
            return $this->parseLinks($section['links']);
        }
        return [];
    }
    
    public function getPagesLinks() {
        $section = $this->getActiveBySection('pages');
        if ($section && $section['links']) {
            return $this->parseLinks($section['links']);
        }
        return [];
    }
    
    public function getSubscribeContent() {
        return $this->getActiveBySection('subscribe');
    }
    
    public function getCopyrightContent() {
        return $this->getActiveBySection('copyright');
    }
    
    public function getSocialMediaLinks() {
        $section = $this->getActiveBySection('social_media');
        if ($section && $section['links']) {
            return $this->parseLinks($section['links']);
        }
        return [];
    }
    
    // Method untuk update links secara khusus
    public function updateGetInTouchLinks($links) {
        $encodedLinks = $this->encodeLinks($links);
        return $this->updateBySectionName('get_in_touch', [
            'title' => 'Get in Touch',
            'content' => null,
            'links' => $encodedLinks
        ]);
    }
    
    public function updatePagesLinks($links) {
        $encodedLinks = $this->encodeLinks($links);
        return $this->updateBySectionName('pages', [
            'title' => 'Pages',
            'content' => null,
            'links' => $encodedLinks
        ]);
    }
    
    public function updateSocialMediaLinks($links) {
        $encodedLinks = $this->encodeLinks($links);
        return $this->updateBySectionName('social_media', [
            'title' => 'Social Media',
            'content' => null,
            'links' => $encodedLinks
        ]);
    }
}
?>