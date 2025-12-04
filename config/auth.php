<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'models/UserModel.php';

class Auth {
    public static function login($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in'] = true;
        
        // Update last login
        $userModel = new UserModel();
        $userModel->updateLastLogin($user['id']);
    }

    public static function logout() {
        $_SESSION = array();
        session_destroy();
    }

    public static function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public static function isAdmin() {
        return self::isLoggedIn() && $_SESSION['role'] === 'admin';
    }

    public static function isOperator() {
        return self::isLoggedIn() && $_SESSION['role'] === 'operator';
    }

    public static function getUser() {
        if (self::isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'email' => $_SESSION['email'],
                'nama_lengkap' => $_SESSION['nama_lengkap'],
                'role' => $_SESSION['role']
            ];
        }
        return null;
    }

    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: login.php');
            exit;
        }
    }

    public static function requireAdmin() {
        self::requireLogin();
        if (!self::isAdmin()) {
            header('Location: unauthorized.php');
            exit;
        }
    }

    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    // Redirect jika sudah login (untuk login/register pages)
    public static function redirectIfLoggedIn() {
        if (self::isLoggedIn()) {
            header('Location: index.php');
            exit;
        }
    }
}
?>