<?php
require_once __DIR__ . '/../models/PendudukModel.php';

$pendudukModel = new PendudukModel($conn);
$stats = $pendudukModel->getDashboardStats();

$gender_data = json_decode($stats['gender_chart'], true);
$wilayah_data = json_decode($stats['wilayah_chart'], true);
?>

<div class="container">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="mb-2">
                <i class="fas fa-chart-line"></i> Dashboard Kepadatan Penduduk
            </h1>
            <p class="text-muted">Selamat datang di DemografiKu - Sistem Monitoring Kepadatan Penduduk</p>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row mb-5">
        <!-- Total Penduduk -->
        <div class="col-md-4">
            <div class="card kpi-card" style="border-left: 5px solid #667eea;">
                <i class="fas fa-users" style="font-size: 2.5em; color: #667eea;"></i>
                <div class="kpi-value"><?= $stats['total_penduduk'] ?></div>
                <div class="kpi-label">Total Penduduk</div>
            </div>
        </div>

        <!-- Kepadatan Rata-rata -->
        <div class="col-md-4">
            <div class="card kpi-card" style="border-left: 5px solid #f39c12;">
                <i class="fas fa-chart-pie" style="font-size: 2.5em; color: #f39c12;"></i>
                <div class="kpi-value"><?= $stats['kepadatan_rata_rata'] ?></div>
                <div class="kpi-label">Kepadatan Rata-rata (per km²)</div>
            </div>
        </div>

        <!-- Total Wilayah -->
        <div class="col-md-4">
            <div class="card kpi-card" style="border-left: 5px solid #27ae60;">
                <i class="fas fa-map-marker-alt" style="font-size: 2.5em; color: #27ae60;"></i>
                <div class="kpi-value"><?= $stats['total_wilayah'] ?></div>
                <div class="kpi-label">Total Wilayah</div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Pie Chart: Jenis Kelamin -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-pie-chart"></i> Distribusi Jenis Kelamin
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bar Chart: Wilayah -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-bar-chart"></i> Distribusi Penduduk per Wilayah
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="wilayahChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Data untuk Chart
    const genderData = <?= $stats['gender_chart'] ?>;
    const wilayahData = <?= $stats['wilayah_chart'] ?>;

    // Pie Chart: Jenis Kelamin
    const genderLabels = genderData.map(item => item.jenis_kelamin);
    const genderCounts = genderData.map(item => item.count);
    
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: genderLabels,
            datasets: [{
                label: 'Jumlah',
                data: genderCounts,
                backgroundColor: ['#667eea', '#f39c12'],
                borderColor: ['#fff', '#fff'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 12 }
                    }
                }
            }
        }
    });

    // Bar Chart: Wilayah
    const wilayahLabels = wilayahData.map(item => item.nama_wilayah);
    const wilayahCounts = wilayahData.map(item => item.jumlah_penduduk);
    
    const wilayahCtx = document.getElementById('wilayahChart').getContext('2d');
    new Chart(wilayahCtx, {
        type: 'bar',
        data: {
            labels: wilayahLabels,
            datasets: [{
                label: 'Jumlah Penduduk',
                data: wilayahCounts,
                backgroundColor: '#27ae60',
                borderColor: '#27ae60',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: wilayahLabels.length > 5 ? 'y' : 'x',
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: { padding: 15 }
                }
            }
        }
    });
</script>