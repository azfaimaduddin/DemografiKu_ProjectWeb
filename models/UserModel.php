<?php
require_once __DIR__ . '/../config/db_config.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ? AND is_active = TRUE";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ? AND is_active = TRUE";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createUser($data) {
        $sql = "INSERT INTO users (username, email, password_hash, nama_lengkap, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("sssss", 
            $data['username'],
            $data['email'],
            $data['password_hash'],
            $data['nama_lengkap'],
            $data['role']
        );
        return $stmt->execute();
    }

    public function updateLastLogin($userId) {
        $sql = "UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    public function isUsernameExists($username) {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function isEmailExists($email) {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>