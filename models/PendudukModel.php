<?php
require_once __DIR__ . '/../config/db_config.php';

class PendudukModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllPenduduk() {
        $sql = "SELECT p.*, w.nama_wilayah 
                FROM penduduk p 
                LEFT JOIN wilayah w ON p.id_wilayah = w.id_wilayah 
                ORDER BY p.nama";
        $result = $this->db->conn->query($sql);
        
        $penduduk = [];
        while ($row = $result->fetch_assoc()) {
            $penduduk[] = $row;
        }
        return $penduduk;
    }

    public function getPendudukByNIK($nik) {
        $sql = "SELECT p.*, w.nama_wilayah 
                FROM penduduk p 
                LEFT JOIN wilayah w ON p.id_wilayah = w.id_wilayah 
                WHERE p.nik = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("s", $nik);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function insertPenduduk($data) {
        $sql = "INSERT INTO penduduk (nik, nama, jenis_kelamin, tgl_lahir, pekerjaan, id_wilayah) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("sssssi", 
            $data['nik'], 
            $data['nama'], 
            $data['jenis_kelamin'], 
            $data['tgl_lahir'], 
            $data['pekerjaan'], 
            $data['id_wilayah']
        );
        return $stmt->execute();
    }

    public function updatePenduduk($nik, $data) {
        $sql = "UPDATE penduduk SET nama = ?, jenis_kelamin = ?, tgl_lahir = ?, 
                pekerjaan = ?, id_wilayah = ? WHERE nik = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("ssssis", 
            $data['nama'], 
            $data['jenis_kelamin'], 
            $data['tgl_lahir'], 
            $data['pekerjaan'], 
            $data['id_wilayah'],
            $nik
        );
        return $stmt->execute();
    }

    public function deletePenduduk($nik) {
        $sql = "DELETE FROM penduduk WHERE nik = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("s", $nik);
        return $stmt->execute();
    }

    public function getDashboardStats() {
        $stats = [];
        
        // Total penduduk
        $sql = "SELECT COUNT(*) as total FROM penduduk";
        $result = $this->db->conn->query($sql);
        $stats['total_penduduk'] = $result->fetch_assoc()['total'];
        
        // Total wilayah
        $sql = "SELECT COUNT(*) as total FROM wilayah";
        $result = $this->db->conn->query($sql);
        $stats['total_wilayah'] = $result->fetch_assoc()['total'];
        
        // Kepadatan rata-rata
        $sql = "SELECT AVG(jumlah_penduduk / luas_area_km2) as kepadatan_rata_rata 
                FROM (
                    SELECT w.id_wilayah, w.luas_area_km2, COUNT(p.nik) as jumlah_penduduk
                    FROM wilayah w
                    LEFT JOIN penduduk p ON w.id_wilayah = p.id_wilayah
                    GROUP BY w.id_wilayah, w.luas_area_km2
                ) as subquery";
        $result = $this->db->conn->query($sql);
        $stats['kepadatan_rata_rata'] = round($result->fetch_assoc()['kepadatan_rata_rata'], 2);
        
        // Distribusi jenis kelamin
        $sql = "SELECT jenis_kelamin, COUNT(*) as jumlah 
                FROM penduduk 
                GROUP BY jenis_kelamin";
        $result = $this->db->conn->query($sql);
        $stats['jenis_kelamin'] = [];
        while ($row = $result->fetch_assoc()) {
            $stats['jenis_kelamin'][] = $row;
        }
        
        // Distribusi wilayah
        $sql = "SELECT w.nama_wilayah, COUNT(p.nik) as jumlah_penduduk
                FROM wilayah w
                LEFT JOIN penduduk p ON w.id_wilayah = p.id_wilayah
                GROUP BY w.id_wilayah, w.nama_wilayah
                ORDER BY jumlah_penduduk DESC";
        $result = $this->db->conn->query($sql);
        $stats['distribusi_wilayah'] = [];
        while ($row = $result->fetch_assoc()) {
            $stats['distribusi_wilayah'][] = $row;
        }
        
        return $stats;
    }
}
?>