<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DemografiKu - Dashboard Kepadatan Penduduk</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* Navbar Gradient Premium */
.navbar {
    background: linear-gradient(90deg, #0d6efd, #47a3ff, #63c5ff) !important;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    padding-top: 12px;
    padding-bottom: 12px;
}

.navbar-brand {
    font-weight: 700;
    font-size: 1.3rem;
    color: #ffffff !important;
}

.navbar .nav-link {
    color: #e8f4ff !important;
    font-weight: 500;
    transition: 0.25s ease;
}

.navbar .nav-link:hover {
    color: #ffffff !important;
    transform: translateY(-2px);
}

.navbar .nav-link i {
    opacity: 0.9;
    transition: 0.25s;
}

.navbar .nav-link:hover i {
    opacity: 1;
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

                <ul class="navbar-nav ms-auto">
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
            </div>
        </div>
    </nav>

    <div class="container mt-4">

<script>
// Fungsi untuk handle klik menu Dashboard
function handleDashboardClick(event) {
    // Cek apakah kita sudah berada di halaman dashboard
    const currentPage = window.location.href;
    
    if (currentPage.includes('index.php') && !currentPage.includes('?page=')) {
        // Jika sudah di halaman dashboard, scroll ke section data
        event.preventDefault();
        scrollToDataSection();
    }
    // Jika tidak di halaman dashboard, biarkan link bekerja normal (redirect ke index.php)
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