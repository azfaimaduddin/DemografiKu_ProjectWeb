<?php
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../models/PendudukModel.php';

$pendudukModel = new PendudukModel($conn);
$action = isset($_GET['action']) ? $_GET['action'] : '';
$nik = isset($_POST['nik']) ? $_POST['nik'] : '';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nik' => $_POST['nik'],
                'nama' => $_POST['nama'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'tgl_lahir' => $_POST['tgl_lahir'],
                'pekerjaan' => $_POST['pekerjaan'],
                'id_wilayah' => $_POST['id_wilayah']
            ];
            
            // Validasi NIK (harus unik)
            $existing = $pendudukModel->getPendudukByNIK($data['nik']);
            if ($existing) {
                $_SESSION['error'] = "NIK sudah terdaftar!";
                header("Location: ../index.php?page=form&action=add");
                exit;
            }
            
            if ($pendudukModel->insertPenduduk($data)) {
                $_SESSION['success'] = "Data penduduk berhasil ditambahkan!";
                header("Location: ../index.php?page=list");
                exit;
            } else {
                $_SESSION['error'] = "Gagal menambahkan data penduduk!";
                header("Location: ../index.php?page=form&action=add");
                exit;
            }
        }
        break;
    
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nik_lama = $_POST['nik_lama'];
            $data = [
                'nama' => $_POST['nama'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'tgl_lahir' => $_POST['tgl_lahir'],
                'pekerjaan' => $_POST['pekerjaan'],
                'id_wilayah' => $_POST['id_wilayah']
            ];
            
            if ($pendudukModel->updatePenduduk($nik_lama, $data)) {
                $_SESSION['success'] = "Data penduduk berhasil diperbarui!";
                header("Location: ../index.php?page=list");
                exit;
            } else {
                $_SESSION['error'] = "Gagal memperbarui data penduduk!";
                header("Location: ../index.php?page=form&nik=" . $nik_lama);
                exit;
            }
        }
        break;
    
    case 'delete':
        if (isset($_GET['nik'])) {
            if ($pendudukModel->deletePenduduk($_GET['nik'])) {
                $_SESSION['success'] = "Data penduduk berhasil dihapus!";
            } else {
                $_SESSION['error'] = "Gagal menghapus data penduduk!";
            }
        }
        header("Location: ../index.php?page=list");
        exit;
        break;
    
    default:
        header("Location: ../index.php?page=list");
        exit;
}
?>