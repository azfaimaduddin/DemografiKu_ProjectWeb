<?php
require_once __DIR__ . '/../models/PendudukModel.php';

$model = new PendudukModel();
$stats = $model->getDashboardStats();
?>

<!-- Header Section dengan Judul dan Deskripsi -->
<div class="row mb-5">
    <div class="col-12">
        <div class="jumbotron bg-light p-5 rounded">
            <h1 class="display-4">DemografiKu</h1>
            <p class="lead">Dashboard Kepadatan Penduduk - Sistem Monitoring Data Kependudukan Terintegrasi</p>
            <hr class="my-4">
            <p>
                Selamat datang di <strong>DemografiKu</strong>, platform untuk memantau dan menganalisis data kepadatan penduduk 
                di berbagai wilayah. Dashboard ini menyajikan informasi statistik penting, distribusi penduduk, 
                dan visualisasi data yang interaktif untuk membantu dalam pengambilan keputusan.
            </p>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary rounded-circle p-3 me-3">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Real-time Data</h5>
                            <p class="mb-0 text-muted">Data terupdate secara real-time</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success rounded-circle p-3 me-3">
                            <i class="fas fa-map-marked-alt text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Multi Wilayah</h5>
                            <p class="mb-0 text-muted">Coverage Desa, RW, dan RT</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning rounded-circle p-3 me-3">
                            <i class="fas fa-chart-pie text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Analytics</h5>
                            <p class="mb-0 text-muted">Visualisasi data interaktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scroll Indicator -->
<div class="text-center mb-4">
    <p class="text-muted">Scroll ke bawah untuk melihat data statistik</p>
    <i class="fas fa-chevron-down text-primary" style="font-size: 1.5rem;"></i>
</div>

<!-- Section Statistik dan Grafik -->
<div id="data-section">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="border-bottom pb-2">📊 Statistik Utama</h2>
            <p class="text-muted">Ringkasan data kependudukan dan kepadatan wilayah</p>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row">
        <div class="col-md-4">
            <div class="card kpi-card border-primary">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                    <h5 class="card-title">Total Penduduk</h5>
                    <div class="kpi-value"><?php echo number_format($stats['total_penduduk']); ?></div>
                    <p class="card-text text-muted">Jiwa Terdaftar</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card kpi-card border-success">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-chart-area fa-2x text-success"></i>
                    </div>
                    <h5 class="card-title">Kepadatan Rata-rata</h5>
                    <div class="kpi-value"><?php echo $stats['kepadatan_rata_rata']; ?></div>
                    <p class="card-text text-muted">Jiwa per km²</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card kpi-card border-warning">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt fa-2x text-warning"></i>
                    </div>
                    <h5 class="card-title">Jumlah Wilayah</h5>
                    <div class="kpi-value"><?php echo $stats['total_wilayah']; ?></div>
                    <p class="card-text text-muted">Unit Wilayah</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Visualisasi Data -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="border-bottom pb-2">📈 Visualisasi Data</h2>
            <p class="text-muted">Grafik dan chart interaktif untuk analisis data</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-venus-mars me-2"></i>
                        Distribusi Jenis Kelamin
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="jenisKelaminChart" width="400" height="300"></canvas>
                    <div class="mt-3">
                        <?php foreach ($stats['jenis_kelamin'] as $jk): ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><?php echo $jk['jenis_kelamin']; ?></span>
                                <span class="badge bg-primary"><?php echo $jk['jumlah']; ?> orang</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-map-marked-alt me-2"></i>
                        Distribusi Penduduk per Wilayah
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="wilayahChart" width="400" height="300"></canvas>
                    <div class="mt-3">
                        <?php foreach ($stats['distribusi_wilayah'] as $wil): ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><?php echo $wil['nama_wilayah']; ?></span>
                                <span class="badge bg-success"><?php echo $wil['jumlah_penduduk']; ?> orang</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="border-bottom pb-2">⚡ Akses Cepat</h2>
            <p class="text-muted">Navigasi cepat ke fitur utama aplikasi</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-list fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Data Penduduk</h5>
                    <p class="card-text">Kelola data penduduk secara lengkap</p>
                    <a href="index.php?page=list" class="btn btn-primary">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-plus-circle fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Tambah Data</h5>
                    <p class="card-text">Input data penduduk baru</p>
                    <a href="index.php?page=form" class="btn btn-success">Tambah</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-map fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Data Wilayah</h5>
                    <p class="card-text">Lihat daftar wilayah terdaftar</p>
                    <a href="index.php?page=wilayah" class="btn btn-warning">Lihat Wilayah</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<button onclick="scrollToTop()" id="backToTop" class="btn btn-primary position-fixed" 
        style="bottom: 20px; right: 20px; display: none;">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
// Data dari PHP
const jenisKelaminData = <?php echo json_encode($stats['jenis_kelamin']); ?>;
const wilayahData = <?php echo json_encode($stats['distribusi_wilayah']); ?>;

// Chart Distribusi Jenis Kelamin
const ctx1 = document.getElementById('jenisKelaminChart').getContext('2d');
new Chart(ctx1, {
    type: 'pie',
    data: {
        labels: jenisKelaminData.map(item => item.jenis_kelamin),
        datasets: [{
            data: jenisKelaminData.map(item => item.jumlah),
            backgroundColor: ['#36a2eb', '#ff6384', '#ffcd56', '#4bc0c0'],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
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
        }
    }
});

// Chart Distribusi Wilayah
const ctx2 = document.getElementById('wilayahChart').getContext('2d');
new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: wilayahData.map(item => item.nama_wilayah),
        datasets: [{
            label: 'Jumlah Penduduk',
            data: wilayahData.map(item => item.jumlah_penduduk),
            backgroundColor: '#4bc0c0',
            borderColor: '#2a8f8f',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Jumlah Penduduk'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Nama Wilayah'
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
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        backToTop.style.display = 'block';
    } else {
        backToTop.style.display = 'none';
    }
};

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Smooth scroll to data section
function scrollToData() {
    document.getElementById('data-section').scrollIntoView({ 
        behavior: 'smooth' 
    });
}
</script>

<style>
.jumbotron {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.jumbotron h1 {
    font-weight: 700;
}

.kpi-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-left: 4px solid;
}

.kpi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.kpi-value {
    font-size: 2.5rem;
    font-weight: bold;
    margin: 10px 0;
}

.card {
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

#backToTop {
    z-index: 1000;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>