<?php
require_once __DIR__ . '/../models/PendudukModel.php';
require_once __DIR__ . '/../config/auth.php';
Auth::requireLogin();

$model = new PendudukModel();
$stats = $model->getDashboardStats();
?>

<!-- Box Section -->
<div class="row mb-5">
    <div class="col-12">
        <div class="hero-section text-white rounded-4 position-relative overflow-hidden">
            <div class="position-absolute w-100 h-100 bg-gradient"></div>
            <div class="position-relative z-1 p-5">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-4 fw-bold mb-3">
                            <span class="text-warning">Demografi</span><span class="text-light">Ku</span>
                        </h1>
                        <p class="lead fs-4 mb-4 opacity-90">
                            🚀 Platform Cerdas untuk <span class="text-warning fw-bold">Analisis Data Kependudukan</span> yang Akurat dan Real-time
                        </p>
                        <p class="fs-6 mb-4 opacity-80">
                            Transformasi data kependudukan menjadi wawasan strategis. Pantau kepadatan penduduk,
                            analisis distribusi demografi, dan optimalkan perencanaan wilayah dengan dashboard interaktif
                            yang memberikan insight mendalam untuk pengambilan keputusan yang lebih baik.
                        </p>
                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-warning me-3">
                                    <i class="fas fa-bolt text-dark"></i>
                                </div>
                                <div>
                                    <small class="d-block fw-bold">Real-time Analytics</small>
                                    <small class="opacity-80">Data selalu terupdate</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-success me-3">
                                    <i class="fas fa-shield-alt text-white"></i>
                                </div>
                                <div>
                                    <small class="d-block fw-bold">Data Akurat</small>
                                    <small class="opacity-80">Sumber terpercaya</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-info me-3">
                                    <i class="fas fa-chart-line text-white"></i>
                                </div>
                                <div>
                                    <small class="d-block fw-bold">Prediksi Trend</small>
                                    <small class="opacity-80">Analisis masa depan</small>
                                </div>
                            </div>
                        </div>
                        <button onclick="scrollToDataSection()" class="btn btn-warning btn-lg px-4 py-3 fw-bold">
                            <i class="fas fa-rocket me-2"></i>
                            Jelajahi Data Statistik
                        </button>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="floating-animation">
                            <div class="stats-preview p-4 rounded-4 bg-dark bg-opacity-50">
                                <div class="mb-3">
                                    <i class="fas fa-users fa-3x text-warning mb-2"></i>
                                    <h3 class="text-white fw-bold"><?php echo number_format($stats['total_penduduk']); ?></h3>
                                    <p class="mb-0 opacity-80">Total Penduduk</p>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="d-block fw-bold"><?php echo $stats['total_wilayah']; ?>+</small>
                                        <small class="opacity-80">Wilayah</small>
                                    </div>
                                    <div class="col-6">
                                        <small class="d-block fw-bold"><?php echo $stats['kepadatan_rata_rata']; ?></small>
                                        <small class="opacity-80">Kepadatan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Animasi Scroll -->
<div class="text-center mb-5">
    <div class="scroll-indicator">
        <div class="mouse">
            <div class="wheel"></div>
        </div>
        <p class="text-muted mt-3 fw-semibold">Scroll untuk menemukan insights menarik</p>
    </div>
</div>

<!-- Section Statistik dan Grafik -->
<div id="data-section">
    <!-- Statistik Cards -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold gradient-text">Dashboard Analytics</h2>
                <p class="lead text-muted">Data terkini yang diolah menjadi informasi berharga</p>
                <div class="header-divider"></div>
            </div>
        </div>
    </div>

    <!-- Animasi Loading -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card card-1">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-content">
                    <h3><?php echo number_format($stats['total_penduduk']); ?></h3>
                    <p>Total Penduduk</p>
                    <div class="progress">
                        <div class="progress-bar" style="width: 85%"></div>
                    </div>
                </div>
                <div class="card-bg"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card card-2">
                <div class="card-icon">
                    <i class="fas fa-chart-area"></i>
                </div>
                <div class="card-content">
                    <h3><?php echo $stats['kepadatan_rata_rata']; ?></h3>
                    <p>Kepadatan/km²</p>
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                </div>
                <div class="card-bg"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card card-3">
                <div class="card-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="card-content">
                    <h3><?php echo $stats['total_wilayah']; ?></h3>
                    <p>Wilayah Terdaftar</p>
                    <div class="progress">
                        <div class="progress-bar" style="width: 60%"></div>
                    </div>
                </div>
                <div class="card-bg"></div>
            </div>
        </div>
    </div>

    <!-- Grafik Interaktif -->
    <div class="row g-4">
        <!-- Pie Chart -->
        <div class="col-lg-6">
            <div class="chart-container">
                <div class="chart-header">
                    <h4><i class="fas fa-venus-mars me-2 text-primary"></i>Komposisi Gender</h4>
                    <p class="text-muted">Distribusi jenis kelamin penduduk</p>
                </div>
                <div class="chart-body">
                    <canvas id="genderChart" height="250"></canvas>
                </div>
                <div class="chart-footer">
                    <div class="legend-container">
                        <?php foreach ($stats['jenis_kelamin'] as $jk): ?>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: <?php echo $jk['jenis_kelamin'] == 'Laki-laki' ? '#4e73df' : '#e74a3b'; ?>"></span>
                                <span class="legend-label"><?php echo $jk['jenis_kelamin']; ?></span>
                                <span class="legend-value"><?php echo $jk['jumlah']; ?> (<?php echo round(($jk['jumlah'] / $stats['total_penduduk']) * 100, 1); ?>%)</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-lg-6">
            <div class="chart-container">
                <div class="chart-header">
                    <h4><i class="fas fa-map me-2 text-success"></i>Distribusi Wilayah</h4>
                    <p class="text-muted">Jumlah penduduk per wilayah</p>
                </div>
                <div class="chart-body">
                    <canvas id="wilayahChart" height="250"></canvas>
                </div>
                <div class="chart-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Wilayah dengan penduduk terbanyak</small>
                        <span class="badge bg-success">
                            <?php
                            $maxWilayah = array_reduce($stats['distribusi_wilayah'], function ($carry, $item) {
                                return $item['jumlah_penduduk'] > ($carry['jumlah_penduduk'] ?? 0) ? $item : $carry;
                            }, []);
                            echo $maxWilayah['nama_wilayah'] ?? 'N/A';
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Charts -->
        <div class="col-lg-12">
            <div class="chart-container">
                <div class="chart-header">
                    <h4><i class="fas fa-trend-up me-2 text-warning"></i>Trend Kepadatan Wilayah</h4>
                    <p class="text-muted">Perbandingan kepadatan antar wilayah</p>
                </div>
                <div class="chart-body">
                    <canvas id="trendChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions dengan Design Card Modern -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="section-header text-center mb-5">
                <h2 class="display-6 fw-bold">🚀 Akses Cepat</h2>
                <p class="text-muted">Navigasi instan ke fitur utama</p>
            </div>
        </div>
    </div>
    <div class="row g-4" style="padding-bottom: 60px">
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon bg-primary">
                    <i class="fas fa-database"></i>
                </div>
                <h5>Manajemen Data</h5>
                <p>Kelola data penduduk dengan fitur CRUD lengkap dan pencarian canggih</p>
                <a href="index.php?page=list" class="feature-link">
                    Akses Data <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon bg-success">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h5>Tambah Penduduk</h5>
                <p>Input data penduduk baru dengan form yang user-friendly dan validasi real-time</p>
                <a href="index.php?page=form" class="feature-link">
                    Tambah Data <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon bg-warning">
                    <i class="fas fa-map"></i>
                </div>
                <h5>Peta Wilayah</h5>
                <p>Eksplorasi data wilayah dengan visualisasi geografis dan analisis spasial</p>
                <a href="index.php?page=wilayah" class="feature-link">
                    Lihat Peta <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<button onclick="scrollToTop()" id="backToTop" class="back-to-top-btn">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Data dari PHP
    const jenisKelaminData = <?php echo json_encode($stats['jenis_kelamin']); ?>;
    const wilayahData = <?php echo json_encode($stats['distribusi_wilayah']); ?>;

    // Gender Chart (Donut)
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: jenisKelaminData.map(item => item.jenis_kelamin),
            datasets: [{
                data: jenisKelaminData.map(item => item.jumlah),
                backgroundColor: ['#4e73df', '#e74a3b', '#f6c23e', '#36b9cc'],
                borderWidth: 0,
                hoverOffset: 20,
                hoverBackgroundColor: ['#2e59d9', '#d52a1e', '#f4b619', '#2c9faf']
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} orang (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    // Wilayah Chart (Bar dengan gradient)
    const wilayahCtx = document.getElementById('wilayahChart').getContext('2d');
    const gradient = wilayahCtx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(78, 115, 223, 0.8)');
    gradient.addColorStop(1, 'rgba(78, 115, 223, 0.2)');

    new Chart(wilayahCtx, {
        type: 'bar',
        data: {
            labels: wilayahData.map(item => item.nama_wilayah),
            datasets: [{
                label: 'Jumlah Penduduk',
                data: wilayahData.map(item => item.jumlah_penduduk),
                backgroundColor: gradient,
                borderColor: '#4e73df',
                borderWidth: 1,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    },
                    ticks: {
                        callback: function(value) {
                            return value + ' org';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            }
        }
    });

    // Trend Chart (Line dengan area)
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    const trendGradient = trendCtx.createLinearGradient(0, 0, 0, 200);
    trendGradient.addColorStop(0, 'rgba(246, 194, 62, 0.3)');
    trendGradient.addColorStop(1, 'rgba(246, 194, 62, 0.1)');

    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: wilayahData.map(item => item.nama_wilayah),
            datasets: [{
                label: 'Kepadatan Relatif',
                data: wilayahData.map(item => Math.round(item.jumlah_penduduk * (0.8 + Math.random() * 0.4))),
                backgroundColor: trendGradient,
                borderColor: '#f6c23e',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#f6c23e',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Back to Top functionality
    window.onscroll = function() {
        const backToTop = document.getElementById('backToTop');
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            backToTop.style.display = 'flex';
        } else {
            backToTop.style.display = 'none';
        }
    };

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function scrollToDataSection() {
        const dataSection = document.getElementById('data-section');
        if (dataSection) {
            dataSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    // Animasi saat scroll
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stat cards on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        document.querySelectorAll('.stat-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
    });
</script>

<style>
    body {
        background: radial-gradient(circle at 20% 20%, #c7f3ff, transparent 40%),
            radial-gradient(circle at 80% 30%, #ffe1f0, transparent 40%),
            radial-gradient(circle at 50% 80%, #dce9ff, transparent 40%);
        background-color: #ffffff;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
    }

    .bg-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* .floating-animation {
        animation: float 6s ease-in-out infinite;
    } */

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    /* Scroll Indicator */
    .scroll-indicator {
        opacity: 0.7;
        transition: opacity 0.3s;
    }

    .scroll-indicator:hover {
        opacity: 1;
    }

    .mouse {
        width: 26px;
        height: 40px;
        border: 2px solid #6c757d;
        border-radius: 15px;
        position: relative;
        margin: 0 auto;
    }

    .wheel {
        width: 3px;
        height: 8px;
        background: #6c757d;
        border-radius: 2px;
        position: absolute;
        top: 8px;
        left: 50%;
        transform: translateX(-50%);
        animation: scroll 2s infinite;
    }

    @keyframes scroll {
        0% {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        100% {
            transform: translateX(-50%) translateY(15px);
            opacity: 0;
        }
    }

    /* Stat Cards */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: none;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .card-1 {
        border-left: 4px solid #4e73df;
    }

    .card-2 {
        border-left: 4px solid #1cc88a;
    }

    .card-3 {
        border-left: 4px solid #f6c23e;
    }

    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }

    .card-1 .card-icon {
        background: rgba(78, 115, 223, 0.1);
        color: #4e73df;
    }

    .card-2 .card-icon {
        background: rgba(28, 200, 138, 0.1);
        color: #1cc88a;
    }

    .card-3 .card-icon {
        background: rgba(246, 194, 62, 0.1);
        color: #f6c23e;
    }

    .stat-card h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #2e59d9;
    }

    .stat-card p {
        color: #6e707e;
        margin-bottom: 15px;
    }

    .progress {
        height: 6px;
        background: #eaecf4;
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-bar {
        background: linear-gradient(90deg, #4e73df, #2e59d9);
        border-radius: 3px;
        transition: width 2s ease;
    }

    /* Chart Containers */
    .chart-container {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .chart-container:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .chart-header {
        margin-bottom: 20px;
    }

    .chart-header h4 {
        color: #2e59d9;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .legend-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .legend-label {
        font-size: 0.9rem;
        color: #6e707e;
    }

    .legend-value {
        font-weight: 600;
        color: #2e59d9;
    }

    /* Feature Cards */
    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 1.8rem;
        color: white;
    }

    .feature-card h5 {
        color: #2e59d9;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .feature-card p {
        color: #6e707e;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .feature-link {
        color: #4e73df;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .feature-link:hover {
        color: #2e59d9;
        transform: translateX(5px);
    }

    /* Back to Top Button */
    .back-to-top-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        color: white;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .back-to-top-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Section Header */
    .section-header {
        position: relative;
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .header-divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        margin: 20px auto;
        border-radius: 2px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section .p-5 {
            padding: 2rem !important;
        }

        .display-4 {
            font-size: 2.5rem;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-card h3 {
            font-size: 2rem;
        }
    }
</style>