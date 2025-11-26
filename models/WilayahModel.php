<?php
require_once __DIR__ . '/../config/db_config.php';

class WilayahModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Mengambil semua data wilayah
     */
    public function getAllWilayah() {
        $query = "SELECT * FROM wilayah ORDER BY tingkat, nama_wilayah";
        $result = $this->conn->query($query);
        
        if (!$result) {
            die("Query Error: " . $this->conn->error);
        }
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        return $data;
    }
    
    /**
     * Mengambil satu data wilayah berdasarkan ID
     */
    public function getWilayahById($id) {
        $query = "SELECT * FROM wilayah WHERE id_wilayah = ?";
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $stmt->close();
            return $data;
        }
        
        $stmt->close();
        return null;
    }
    
    /**
     * Menghitung kepadatan penduduk per wilayah
     */
    public function getKepadatanByWilayah() {
        $query = "SELECT w.id_wilayah, w.nama_wilayah, w.luas_area_km2, 
                         COUNT(p.nik) as jumlah_penduduk,
                         ROUND(COUNT(p.nik) / w.luas_area_km2, 2) as kepadatan
                  FROM wilayah w
                  LEFT JOIN penduduk p ON w.id_wilayah = p.id_wilayah
                  GROUP BY w.id_wilayah, w.nama_wilayah, w.luas_area_km2
                  ORDER BY kepadatan DESC";
        
        $result = $this->conn->query($query);
        
        if (!$result) {
            die("Query Error: " . $this->conn->error);
        }
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        return $data;
    }
}
?>