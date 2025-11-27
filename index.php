<?php
require_once 'config/auth.php';
Auth::requireLogin();

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
include 'includes/header.php';
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
include 'includes/footer.php';
?>