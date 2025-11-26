<?php
session_start();

// Koneksi Database
require_once 'config/db_config.php';

// Sertakan Header
require_once 'includes/header.php';

// Router Sederhana
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

switch ($page) {
    case 'list':
        include 'pages/data_list.php';
        break;
    
    case 'form':
        include 'pages/form_penduduk.php';
        break;
    
    case 'wilayah':
        include 'pages/wilayah.php';
        break;
    
    case 'dashboard':
    default:
        include 'pages/dashboard.php';
        break;
}

// Sertakan Footer
require_once 'includes/footer.php';

// Tutup koneksi database
$conn->close();
?>