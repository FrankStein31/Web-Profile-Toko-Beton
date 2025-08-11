<?php
// models/Admin.php
// Model untuk tabel admin

class Admin {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function login($username, $password) {
        $sql = "SELECT * FROM admin WHERE username = ? OR email = ?";
        $admin = $this->db->fetch($sql, [$username, $username]);
        
        if ($admin && password_verify($password, $admin['password'])) {
            // Update last login
            $this->updateLastLogin($admin['id']);
            return $admin;
        }
        
        return false;
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM admin WHERE id = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    public function updateLastLogin($id) {
        $sql = "UPDATE admin SET last_login = NOW() WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }
    
    public function updateProfile($id, $data) {
        $sql = "UPDATE admin SET nama_lengkap = ?, email = ? WHERE id = ?";
        return $this->db->query($sql, [$data['nama_lengkap'], $data['email'], $id]);
    }
    
    public function changePassword($id, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE admin SET password = ? WHERE id = ?";
        return $this->db->query($sql, [$hashedPassword, $id]);
    }
    
    public function checkCurrentPassword($id, $currentPassword) {
        $sql = "SELECT password FROM admin WHERE id = ?";
        $admin = $this->db->fetch($sql, [$id]);
        
        if ($admin) {
            return password_verify($currentPassword, $admin['password']);
        }
        
        return false;
    }
}
?>
