<?php
require_once 'config/auth.php';
Auth::redirectIfLoggedIn();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($nama_lengkap)) {
        $error = 'Semua field harus diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } elseif (strlen($password) < 6) {
        $error = 'Password harus minimal 6 karakter!';
    } elseif ($password !== $confirm_password) {
        $error = 'Konfirmasi password tidak cocok!';
    } else {
        $userModel = new UserModel();

        // Check if username exists
        if ($userModel->isUsernameExists($username)) {
            $error = 'Username sudah digunakan!';
        }
        // Check if email exists
        elseif ($userModel->isEmailExists($email)) {
            $error = 'Email sudah terdaftar!';
        } else {
            // Create new user
            $userData = [
                'username' => $username,
                'email' => $email,
                'password_hash' => Auth::hashPassword($password),
                'nama_lengkap' => $nama_lengkap,
                'role' => 'user'
            ];

            if ($userModel->createUser($userData)) {
                header('Location: login.php?success=registered');
                exit;
            } else {
                $error = 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DemografiKu</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .register-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #c7f3ff 0%, #ffe1f0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }

        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .register-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e3e6f0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .register-logo {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .login-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link:hover {
            color: #764ba2;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
        }

        .password-input {
            position: relative;
        }

        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }

        .strength-weak {
            background: #e74a3b;
            width: 25%;
        }

        .strength-medium {
            background: #f6c23e;
            width: 50%;
        }

        .strength-strong {
            background: #1cc88a;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h3 class="mb-2">DemografiKu</h3>
                <p class="mb-0 opacity-90">Buat akun baru</p>
            </div>
            <div class="register-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-user text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="nama_lengkap" name="nama_lengkap"
                                value="<?php echo htmlspecialchars($_POST['nama_lengkap'] ?? ''); ?>"
                                placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-at text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="username" name="username"
                                value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                                placeholder="Masukkan username" required>
                        </div>
                        <small class="text-muted">Username harus unik dan tidak mengandung spasi</small>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" class="form-control border-start-0" id="email" name="email"
                                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                placeholder="Masukkan email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-input">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control border-start-0" id="password" name="password"
                                    placeholder="Masukkan password (min. 6 karakter)" required
                                    oninput="checkPasswordStrength(this.value)">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength" id="passwordStrength"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                        <div class="password-input">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control border-start-0" id="confirm_password" name="confirm_password"
                                    placeholder="Konfirmasi password" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-register w-100 mb-3">
                        <i class="fas fa-user-plus me-2"></i>Daftar
                    </button>
                    <div class="text-center">
                        <p class="mb-0">
                            Sudah punya akun?
                            <a href="login.php" class="login-link">Login di sini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = passwordInput.parentElement.querySelector('.password-toggle i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('passwordStrength');
            let strength = 0;

            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            strengthBar.className = 'password-strength';
            if (password.length === 0) {
                strengthBar.style.width = '0';
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 4) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        }

        // Real-time password confirmation check
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;

            if (confirmPassword && password !== confirmPassword) {
                this.style.borderColor = '#e74a3b';
            } else {
                this.style.borderColor = '#1cc88a';
            }
        });

        // Enter key support
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nama_lengkap').focus();
        });
    </script>
</body>

</html>