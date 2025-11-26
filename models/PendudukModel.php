<?php
require_once __DIR__ . '/../config/db_config.php';

class PendudukModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Mengambil semua data penduduk dengan JOIN ke wilayah
     */
    public function getAllPenduduk() {
        $query = "SELECT p.nik, p.nama, p.jenis_kelamin, p.tgl_lahir, p.pekerjaan, 
                         p.id_wilayah, w.nama_wilayah, w.tingkat
                  FROM penduduk p
                  JOIN wilayah w ON p.id_wilayah = w.id_wilayah
                  ORDER BY p.nama ASC";
        
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
     * Mengambil satu data penduduk berdasarkan NIK
     */
    public function getPendudukByNIK($nik) {
        $query = "SELECT p.nik, p.nama, p.jenis_kelamin, p.tgl_lahir, p.pekerjaan, 
                         p.id_wilayah, w.nama_wilayah
                  FROM penduduk p
                  JOIN wilayah w ON p.id_wilayah = w.id_wilayah
                  WHERE p.nik = ?";
        
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        
        $stmt->bind_param("s", $nik);
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
     * Menambah data penduduk
     */
    public function insertPenduduk($data) {
        $query = "INSERT INTO penduduk (nik, nama, jenis_kelamin, tgl_lahir, pekerjaan, id_wilayah) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        
        $stmt->bind_param("sssssi", 
            $data['nik'],
            $data['nama'],
            $data['jenis_kelamin'],
            $data['tgl_lahir'],
            $data['pekerjaan'],
            $data['id_wilayah']
        );
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Error: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }
    
    /**
     * Mengupdate data penduduk
     */
    public function updatePenduduk($nik, $data) {
        $query = "UPDATE penduduk SET nama = ?, jenis_kelamin = ?, tgl_lahir = ?, 
                         pekerjaan = ?, id_wilayah = ? WHERE nik = ?";
        
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        
        $stmt->bind_param("ssssii", 
            $data['nama'],
            $data['jenis_kelamin'],
            $data['tgl_lahir'],
            $data['pekerjaan'],
            $data['id_wilayah'],
            $nik
        );
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Error: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }
    
    /**
     * Menghapus data penduduk
     */
    public function deletePenduduk($nik) {
        $query = "DELETE FROM penduduk WHERE nik = ?";
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }
        
        $stmt->bind_param("s", $nik);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Error: " . $stmt->error;
            $stmt->close();
            return false;
        }
    }
    
    /**
     * Mengambil statistik dashboard
     */
    public function getDashboardStats() {
        $stats = [];
        
        // Total Penduduk
        $query = "SELECT COUNT(*) as total FROM penduduk";
        $result = $this->conn->query($query);
        $stats['total_penduduk'] = $result->fetch_assoc()['total'];
        
        // Total Wilayah
        $query = "SELECT COUNT(*) as total FROM wilayah";
        $result = $this->conn->query($query);
        $stats['total_wilayah'] = $result->fetch_assoc()['total'];
        
        // Kepadatan Rata-rata
        $query = "SELECT w.luas_area_km2, COUNT(p.nik) as jumlah
                  FROM wilayah w
                  LEFT JOIN penduduk p ON w.id_wilayah = p.id_wilayah
                  GROUP BY w.id_wilayah, w.luas_area_km2";
        
        $result = $this->conn->query($query);
        $total_kepadatan = 0;
        $count_wilayah = 0;
        
        while ($row = $result->fetch_assoc()) {
            if ($row['luas_area_km2'] > 0) {
                $total_kepadatan += ($row['jumlah'] / $row['luas_area_km2']);
                $count_wilayah++;
            }
        }
        
        $stats['kepadatan_rata_rata'] = $count_wilayah > 0 ? round($total_kepadatan / $count_wilayah, 2) : 0;
        
        // Data untuk Pie Chart (Jenis Kelamin)
        $query = "SELECT jenis_kelamin, COUNT(*) as count FROM penduduk GROUP BY jenis_kelamin";
        $result = $this->conn->query($query);
        $gender_data = [];
        
        while ($row = $result->fetch_assoc()) {
            $gender_data[] = $row;
        }
        
        $stats['gender_chart'] = json_encode($gender_data);
        
        // Data untuk Bar Chart (Distribusi Wilayah)
        $query = "SELECT w.nama_wilayah, COUNT(p.nik) as jumlah_penduduk
                  FROM wilayah w
                  LEFT JOIN penduduk p ON w.id_wilayah = p.id_wilayah
                  GROUP BY w.id_wilayah, w.nama_wilayah
                  ORDER BY w.nama_wilayah";
        
        $result = $this->conn->query($query);
        $wilayah_data = [];
        
        while ($row = $result->fetch_assoc()) {
            $wilayah_data[] = $row;
        }
        
        $stats['wilayah_chart'] = json_encode($wilayah_data);
        
        return $stats;
    }
}
?>