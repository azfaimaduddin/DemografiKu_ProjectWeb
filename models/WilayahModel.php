<?php
require_once __DIR__ . '/../config/db_config.php';

class WilayahModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllWilayah() {
        $sql = "SELECT * FROM wilayah ORDER BY nama_wilayah";
        $result = $this->db->conn->query($sql);
        
        $wilayah = [];
        while ($row = $result->fetch_assoc()) {
            $wilayah[] = $row;
        }
        return $wilayah;
    }

    public function getWilayahById($id) {
        $sql = "SELECT * FROM wilayah WHERE id_wilayah = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>