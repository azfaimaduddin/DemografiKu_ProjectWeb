<?php
// Simple Router
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Include header
include 'includes/header.php';

// Route pages
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

// Include footer
include 'includes/footer.php';
?>