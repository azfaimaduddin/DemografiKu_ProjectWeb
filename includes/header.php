<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/auth.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DemografiKu - Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .navbar-brand {
            font-weight: bold;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .kpi-card {
            text-align: center;
            padding: 20px;
        }

        .kpi-value {
            font-size: 2rem;
            font-weight: bold;
            color: #0d6efd;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* User dropdown styles */
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .dropdown-user {
            min-width: 200px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                DemografiKu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if (Auth::isLoggedIn()): ?>
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link dashboard-link" href="index.php" onclick="handleDashboardClick(event)">
                                <i class="fas fa-chart-bar me-2"></i>
                                Statistik
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=list">
                                <i class="fas fa-users me-1"></i>
                                Data Penduduk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=wilayah">
                                <i class="fas fa-map me-1"></i>
                                Data Wilayah
                            </a>
                        </li>
                    </ul>

                    <!-- User Dropdown -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar me-2">
                                    <?php
                                    $user = Auth::getUser();
                                    if ($user) {
                                        echo strtoupper(substr($user['nama_lengkap'], 0, 1));
                                    }
                                    ?>
                                </div>
                                <span><?php echo $user ? htmlspecialchars($user['nama_lengkap']) : 'User'; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="dropdown-header">
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-3">
                                                <?php
                                                if ($user) {
                                                    echo strtoupper(substr($user['nama_lengkap'], 0, 1));
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <div class="fw-bold"><?php echo $user ? htmlspecialchars($user['nama_lengkap']) : 'User'; ?></div>
                                                <small class="text-muted"><?php echo $user ? htmlspecialchars($user['role']) : 'Role'; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="logout.php">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        <script>
            // Fungsi untuk handle klik menu Dashboard
            function handleDashboardClick(event) {
                const currentPage = window.location.href;
                if (currentPage.includes('index.php') && !currentPage.includes('?page=')) {
                    event.preventDefault();
                    scrollToDataSection();
                }
            }

            // Fungsi untuk scroll ke section data
            function scrollToDataSection() {
                const dataSection = document.getElementById('data-section');
                if (dataSection) {
                    dataSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }

            // Cek saat halaman dimuat, jika ada hash #data-section, scroll ke sana
            document.addEventListener('DOMContentLoaded', function() {
                if (window.location.hash === '#data-section') {
                    setTimeout(() => {
                        scrollToDataSection();
                    }, 100);
                }
            });
        </script>