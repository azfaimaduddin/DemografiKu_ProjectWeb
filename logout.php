<?php
require_once 'config/auth.php';

// Logout user
Auth::logout();

// Redirect ke login page dengan pesan sukses
header('Location: login.php?message=logged_out');
exit;
?>