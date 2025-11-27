<?php
require_once __DIR__ . '/../models/WilayahModel.php';
require_once __DIR__ . '/../models/PendudukModel.php';
require_once __DIR__ . '/../config/auth.php';
Auth::requireLogin();

$wilayahModel = new WilayahModel();
$pendudukModel = new PendudukModel();
$wilayah = $wilayahModel->getAllWilayah();
$stats = $pendudukModel->getDashboardStats();

// Hitung statistik
$totalWilayah = count($wilayah);
$totalPenduduk = $stats['total_penduduk'];
$desaCount = count(array_filter($wilayah, function ($w) {
    return $w['tingkat'] === 'Desa';
}));
$rwCount = count(array_filter($wilayah, function ($w) {
    return $w['tingkat'] === 'RW';
}));
$rtCount = count(array_filter($wilayah, function ($w) {
    return $w['tingkat'] === 'RT';
}));

// Hitung kepadatan per wilayah
$wilayahWithDensity = [];
foreach ($wilayah as $w) {
    $jumlahPenduduk = 0;
    foreach ($stats['distribusi_wilayah'] as $dist) {
        if ($dist['nama_wilayah'] === $w['nama_wilayah']) {
            $jumlahPenduduk = $dist['jumlah_penduduk'];
            break;
        }
    }
    $kepadatan = $w['luas_area_km2'] > 0 ? round($jumlahPenduduk / $w['luas_area_km2'], 2) : 0;
    $wilayahWithDensity[] = [
        ...$w,
        'jumlah_penduduk' => $jumlahPenduduk,
        'kepadatan' => $kepadatan
    ];
}
?>

<!-- Box Section -->
<div class="row mb-5">
    <div class="col-12">
        <div class="wilayah-header-section bg-gradient-success text-white rounded-4 p-5 position-relative overflow-hidden">
            <div class="position-absolute w-100 h-100 bg-pattern-wilayah"></div>
            <div class="position-relative z-1">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold mb-3">
                            <i class="fas fa-map-marked-alt me-3"></i>Manajemen Data Wilayah
                        </h1>
                        <p class="lead mb-4 opacity-90">
                            Kelola struktur wilayah dengan sistem hierarki terintegrasi.
                            <span class="fw-bold">Pantau kepadatan penduduk</span> dan optimalkan pembagian wilayah.
                        </p>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="wilayah-stat-badge">
                                <div class="stat-number"><?php echo $totalWilayah; ?></div>
                                <div class="stat-label">Total Wilayah</div>
                            </div>
                            <div class="wilayah-stat-badge">
                                <div class="stat-number"><?php echo $desaCount; ?></div>
                                <div class="stat-label">Desa</div>
                            </div>
                            <div class="wilayah-stat-badge">
                                <div class="stat-number"><?php echo $rwCount; ?></div>
                                <div class="stat-label">RW</div>
                            </div>
                            <div class="wilayah-stat-badge">
                                <div class="stat-number"><?php echo $rtCount; ?></div>
                                <div class="stat-label">RT</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="floating-map">
                            <div class="map-card p-4 rounded-4 bg-dark bg-opacity-50">
                                <i class="fas fa-globe-asia fa-3x text-warning mb-3"></i>
                                <h5 class="text-white">Sistem Hierarki</h5>
                                <p class="text-white opacity-80 mb-0">Struktur wilayah terorganisir</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-12">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="stats-card card-densa">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-content">
                        <h3><?php echo number_format($totalPenduduk); ?></h3>
                        <p>Total Penduduk</p>
                        <div class="stats-trend up">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card card-densb">
                    <div class="stats-icon">
                        <i class="fas fa-map"></i>
                    </div>
                    <div class="stats-content">
                        <h3><?php echo $totalWilayah; ?></h3>
                        <p>Wilayah Terdaftar</p>
                        <div class="stats-trend up">
                            <i class="fas fa-arrow-up"></i>
                            <span>+5%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card card-densc">
                    <div class="stats-icon">
                        <i class="fas fa-chart-area"></i>
                    </div>
                    <div class="stats-content">
                        <h3><?php echo $stats['kepadatan_rata_rata']; ?></h3>
                        <p>Kepadatan Rata-rata</p>
                        <div class="stats-trend neutral">
                            <i class="fas fa-minus"></i>
                            <span>±0%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card card-densd">
                    <div class="stats-icon">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </div>
                    <div class="stats-content">
                        <h3><?php echo array_sum(array_column($wilayah, 'luas_area_km2')); ?> km²</h3>
                        <p>Total Luas Area</p>
                        <div class="stats-trend down">
                            <i class="fas fa-arrow-down"></i>
                            <span>-2%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="row mb-4">
    <div class="col-12">
        <div class="action-container-wilayah">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-filter me-2"></i>Filter Data
                        </h5>
                        <div class="filter-buttons">
                            <button class="btn btn-outline-primary btn-filter active" data-filter="all">
                                Semua Wilayah
                            </button>
                            <button class="btn btn-outline-primary btn-filter" data-filter="Desa">
                                <i class="fas fa-city me-1"></i>Desa
                            </button>
                            <button class="btn btn-outline-primary btn-filter" data-filter="RW">
                                <i class="fas fa-road me-1"></i>RW
                            </button>
                            <button class="btn btn-outline-primary btn-filter" data-filter="RT">
                                <i class="fas fa-home me-1"></i>RT
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="d-flex gap-2 justify-content-end">
                        <div class="search-box-wilayah">
                            <input type="text" id="searchWilayah" class="form-control search-input" placeholder="Cari nama wilayah...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cards View -->
<div id="cardsView" class="view-content" style="padding-bottom: 60px;">
    <div class="row g-4">
        <?php foreach ($wilayahWithDensity as $w):
            $tingkatColor = [
                'Desa' => 'primary',
                'RW' => 'success',
                'RT' => 'warning'
            ][$w['tingkat']];
            $kepadatanLevel = $w['kepadatan'] > 100 ? 'high' : ($w['kepadatan'] > 50 ? 'medium' : 'low');
        ?>
            <div class="col-xl-4 col-lg-6 col-md-6 wilayah-card-container" data-tingkat="<?php echo $w['tingkat']; ?>">
                <div class="wilayah-card">
                    <div class="card-header-wilayah">
                        <div class="tingkat-badge badge-<?php echo $tingkatColor; ?>">
                            <i class="fas <?php echo $w['tingkat'] === 'Desa' ? 'fa-city' : ($w['tingkat'] === 'RW' ? 'fa-road' : 'fa-home'); ?> me-2"></i>
                            <?php echo $w['tingkat']; ?>
                        </div>
                    </div>
                    <div class="card-body-wilayah">
                        <h5 class="wilayah-name"><?php echo $w['nama_wilayah']; ?></h5>
                        <p class="wilayah-id">ID: <?php echo $w['id_wilayah']; ?></p>
                        <div class="wilayah-stats">
                            <div class="stat-item ">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value"><?php echo $w['jumlah_penduduk']; ?></div>
                                    <div class="stat-label">Penduduk</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value"><?php echo $w['luas_area_km2']; ?> km²</div>
                                    <div class="stat-label">Luas Area</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value"><?php echo $w['kepadatan']; ?></div>
                                    <div class="stat-label">Kepadatan</div>
                                </div>
                            </div>
                        </div>
                        <div class="kepadatan-indicator">
                            <div class="progress">
                                <div class="progress-bar kepadatan-<?php echo $kepadatanLevel; ?>"
                                    style="width: <?php echo min($w['kepadatan'] * 0.5, 100); ?>%">
                                </div>
                            </div>
                            <small class="text-muted">Tingkat Kepadatan:
                                <span class="fw-bold text-<?php echo $kepadatanLevel === 'high' ? 'danger' : ($kepadatanLevel === 'medium' ? 'warning' : 'success'); ?>">
                                    <?php echo $kepadatanLevel === 'high' ? 'Tinggi' : ($kepadatanLevel === 'medium' ? 'Sedang' : 'Rendah'); ?>
                                </span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Empty State -->
<?php if (empty($wilayah)): ?>
    <div class="row">
        <div class="col-12">
            <div class="empty-state-wilayah text-center py-5">
                <i class="fas fa-map-marked-alt fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Data Wilayah</h4>
                <p class="text-muted mb-4">Mulai dengan menambahkan data wilayah pertama Anda</p>
                <button class="btn btn-primary btn-lg" onclick="addNewWilayah()">
                    <i class="fas fa-plus me-2"></i>Tambah Wilayah Pertama
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>


<script>
    document.querySelectorAll('input[name="viewMode"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const cardsView = document.getElementById('cardsView');
            const tableView = document.getElementById('tableView');
            if (this.id === 'cardView') {
                cardsView.style.display = 'block';
                tableView.style.display = 'none';
            } else {
                cardsView.style.display = 'none';
                tableView.style.display = 'block';
            }
        });
    });

    // Filter functionality
    document.querySelectorAll('.btn-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');

            document.querySelectorAll('.btn-filter').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Filter cards
            document.querySelectorAll('.wilayah-card-container').forEach(card => {
                if (filter === 'all' || card.getAttribute('data-tingkat') === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            // Filter table rows
            document.querySelectorAll('.wilayah-row').forEach(row => {
                if (filter === 'all' || row.getAttribute('data-tingkat') === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    // Search functionality
    document.getElementById('searchWilayah').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        // Search in cards
        document.querySelectorAll('.wilayah-card-container').forEach(card => {
            const namaWilayah = card.querySelector('.wilayah-name').textContent.toLowerCase();
            const isVisible = namaWilayah.includes(searchTerm);
            card.style.display = isVisible ? 'block' : 'none';
        });

        // Search in table
        document.querySelectorAll('.wilayah-row').forEach(row => {
            const namaWilayah = row.querySelector('.fw-semibold').textContent.toLowerCase();
            const isVisible = namaWilayah.includes(searchTerm);
            row.style.display = isVisible ? '' : 'none';
        });
    });

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
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

    /* Header Section */
    .wilayah-header-section {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
    }

    .bg-pattern-wilayah::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
    }

    .wilayah-stat-badge {
        text-align: center;
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }

    .floating-map {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-15px);
        }
    }

    /* Statistics Cards */
    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }

    .card-densa::before {
        background: linear-gradient(135deg, #4e73df, #2e59d9);
    }

    .card-densb::before {
        background: linear-gradient(135deg, #1cc88a, #13855c);
    }

    .card-densc::before {
        background: linear-gradient(135deg, #f6c23e, #dda20a);
    }

    .card-densd::before {
        background: linear-gradient(135deg, #e74a3b, #be2617);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        font-size: 1.5rem;
        color: white;
    }

    .card-densa .stats-icon {
        background: #4e73df;
    }

    .card-densb .stats-icon {
        background: #1cc88a;
    }

    .card-densc .stats-icon {
        background: #f6c23e;
    }

    .card-densd .stats-icon {
        background: #e74a3b;
    }

    .stats-content h3 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #2e59d9;
    }

    .stats-content p {
        color: #6e707e;
        margin-bottom: 10px;
    }

    .stats-trend {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .stats-trend.up {
        background: #d4edda;
        color: #155724;
    }

    .stats-trend.down {
        background: #f8d7da;
        color: #721c24;
    }

    .stats-trend.neutral {
        background: #e2e3e5;
        color: #383d41;
    }

    /* Action Container */
    .action-container-wilayah {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e3e6f0;
    }

    .filter-buttons .btn-filter {
        border-radius: 20px;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .filter-buttons .btn-filter.active {
        background: #4e73df;
        border-color: #4e73df;
        color: white;
    }

    .search-box-wilayah {
        position: relative;
        min-width: 250px;
    }

    /* Wilayah Cards */
    .wilayah-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
        height: 100%;
    }

    .wilayah-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .card-header-wilayah {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        display: flex;
        justify-content: between;
        align-items: center;
    }

    .tingkat-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .badge-primary {
        background: rgba(78, 115, 223, 0.9);
    }

    .badge-success {
        background: rgba(28, 200, 138, 0.9);
    }

    .badge-warning {
        background: rgba(246, 194, 62, 0.9);
    }

    .card-actions .btn-action {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-body-wilayah {
        padding: 25px;
    }

    .wilayah-name {
        color: #2e59d9;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .wilayah-id {
        color: #6e707e;
        font-size: 0.9rem;
        margin-bottom: 20px;
    }

    .wilayah-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #4e73df;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
    }

    .stat-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2e59d9;
        margin-bottom: 2px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #ffffffff;
    }

    .kepadatan-indicator {
        margin-top: 15px;
    }

    .progress {
        height: 8px;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .kepadatan-high {
        background: linear-gradient(135deg, #e74a3b, #be2617);
    }

    .kepadatan-medium {
        background: linear-gradient(135deg, #f6c23e, #dda20a);
    }

    .kepadatan-low {
        background: linear-gradient(135deg, #1cc88a, #13855c);
    }

    .card-footer-wilayah {
        padding: 20px;
        background: #f8f9fa;
        border-top: 1px solid #e3e6f0;
    }

    /* Empty State */
    .empty-state-wilayah {
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    /* Detail Modal */
    .detail-section {
        margin-bottom: 25px;
    }

    .section-title {
        color: #2e59d9;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e3e6f0;
    }

    .detail-item {
        display: flex;
        justify-content: between;
        margin-bottom: 12px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-item label {
        font-weight: 600;
        color: #6e707e;
        min-width: 140px;
    }

    .detail-item span {
        color: #2e59d9;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .wilayah-stats {
            grid-template-columns: 1fr;
        }

        .action-container-wilayah .d-flex {
            flex-direction: column;
            gap: 10px !important;
        }

        .search-box-wilayah {
            min-width: 100%;
        }

        .filter-buttons {
            flex-wrap: wrap;
            gap: 5px;
        }
    }
</style>