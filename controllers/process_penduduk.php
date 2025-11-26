<?php
require_once __DIR__ . '/../models/PendudukModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new PendudukModel();
    
    if ($_POST['action'] === 'add') {
        $data = [
            'nik' => $_POST['nik'],
            'nama' => $_POST['nama'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'tgl_lahir' => $_POST['tgl_lahir'],
            'pekerjaan' => $_POST['pekerjaan'],
            'id_wilayah' => $_POST['id_wilayah']
        ];
        
        if ($model->insertPenduduk($data)) {
            header("Location: ../index.php?page=list&success=1");
        } else {
            header("Location: ../index.php?page=form&error=1");
        }
    }
    elseif ($_POST['action'] === 'edit') {
        $nik = $_POST['nik_old'];
        $data = [
            'nama' => $_POST['nama'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'tgl_lahir' => $_POST['tgl_lahir'],
            'pekerjaan' => $_POST['pekerjaan'],
            'id_wilayah' => $_POST['id_wilayah']
        ];
        
        if ($model->updatePenduduk($nik, $data)) {
            header("Location: ../index.php?page=list&success=2");
        } else {
            header("Location: ../index.php?page=form&error=2");
        }
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $model = new PendudukModel();
    $nik = $_GET['nik'];
    
    if ($model->deletePenduduk($nik)) {
        header("Location: ../index.php?page=list&success=3");
    } else {
        header("Location: ../index.php?page=list&error=3");
    }
}
?>