<?php
require_once __DIR__ . '/../models/PendudukModel.php';
require_once __DIR__ . '/../config/auth.php';
Auth::requireLogin();

$model = new PendudukModel();
$penduduk = $model->getAllPenduduk();
$success = isset($_GET['success']) ? $_GET['success'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';

// Hitung statistik
$totalPenduduk = count($penduduk);
$lakiLaki = count(array_filter($penduduk, function ($p) {
    return $p['jenis_kelamin'] === 'Laki-laki';
}));
$perempuan = count(array_filter($penduduk, function ($p) {
    return $p['jenis_kelamin'] === 'Perempuan';
}));
?>

<!-- Box Section -->
<div class="row mb-5">
    <div class="col-12">
        <div class="data-header-section bg-gradient-primary text-white rounded-4 p-5 position-relative overflow-hidden">
            <div class="position-absolute w-100 h-100 bg-pattern"></div>
            <div class="position-relative z-1">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold mb-3">
                            <i class="fas fa-users me-3"></i>Manajemen Data Penduduk
                        </h1>
                        <p class="lead mb-4 opacity-90">
                            Kelola data kependudukan dengan mudah dan efisien. Sistem terintegrasi untuk
                            <span class="fw-bold">input, edit, dan analisis</span> data penduduk.
                        </p>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="stat-badge">
                                <div class="stat-number"><?php echo $totalPenduduk; ?></div>
                                <div class="stat-label">Total Penduduk</div>
                            </div>
                            <div class="stat-badge">
                                <div class="stat-number"><?php echo $lakiLaki; ?></div>
                                <div class="stat-label">Laki-laki</div>
                            </div>
                            <div class="stat-badge">
                                <div class="stat-number"><?php echo $perempuan; ?></div>
                                <div class="stat-label">Perempuan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="floating-action">
                            <div class="action-card p-4 rounded-4 bg-dark bg-opacity-50">
                                <i class="fas fa-database fa-3x text-warning mb-3"></i>
                                <h5 class="text-white">Data Terkelola</h5>
                                <p class="text-white opacity-80 mb-0">Sistem database terintegrasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="quick-actions-container">
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="d-flex flex-wrap gap-3">
                        <button class="btn btn-primary btn-action" onclick="showAllData()">
                            <i class="fas fa-list me-2"></i>Semua Data
                        </button>
                        <button class="btn btn-outline-primary btn-action" onclick="filterByGender('Laki-laki')">
                            <i class="fas fa-mars me-2"></i>Laki-laki
                        </button>
                        <button class="btn btn-outline-primary btn-action" onclick="filterByGender('Perempuan')">
                            <i class="fas fa-venus me-2"></i>Perempuan
                        </button>
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="searchInput" class="form-control search-input" placeholder="Cari nama atau NIK...">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <a href="index.php?page=form" class="btn btn-success btn-lg px-4">
                        <i class="fas fa-user-plus me-2"></i>Tambah Penduduk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Messages -->
<?php if ($success): ?>
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3 fa-lg"></i>
                    <div>
                        <h6 class="alert-heading mb-1">Berhasil!</h6>
                        <?php
                        switch ($success) {
                            case '1':
                                echo 'Data penduduk berhasil ditambahkan!';
                                break;
                            case '2':
                                echo 'Data penduduk berhasil diupdate!';
                                break;
                            case '3':
                                echo 'Data penduduk berhasil dihapus!';
                                break;
                        }
                        ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                    <div>
                        <h6 class="alert-heading mb-1">Oops! Terjadi Kesalahan</h6>
                        <?php
                        switch ($error) {
                            case '1':
                                echo 'Gagal menambahkan data penduduk!';
                                break;
                            case '2':
                                echo 'Gagal mengupdate data penduduk!';
                                break;
                            case '3':
                                echo 'Gagal menghapus data penduduk!';
                                break;
                        }
                        ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Data Table -->
<div class="row" style="margin-bottom: 60px;">
    <div class="col-12">
        <div class="data-table-container">
            <div class="table-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="table-title mb-0">
                            <i class="fas fa-table me-2"></i>Daftar Penduduk
                        </h5>
                    </div>
                    <div class="col-auto">
                        <div class="table-actions">
                            <span class="badge bg-light text-dark" id="dataCount"><?php echo $totalPenduduk; ?> Data Penduduk</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="pendudukTable">
                    <thead class="table-light">
                        <tr>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Usia</th>
                            <th>Pekerjaan</th>
                            <th>Wilayah</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($penduduk as $p):
                            $usia = date_diff(date_create($p['tgl_lahir']), date_create('today'))->y;
                        ?>
                            <tr class="data-row" data-gender="<?php echo $p['jenis_kelamin']; ?>">
                                <td>
                                    <div class="nik-cell">
                                        <i class="fas fa-id-card me-2 text-muted"></i>
                                        <span class="nik-value"><?php echo $p['nik']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3">
                                            <?php echo strtoupper(substr($p['nama'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <div class="fw-semibold"><?php echo $p['nama']; ?></div>
                                            <small class="text-muted"><?php echo $p['nik']; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge gender-badge <?php echo $p['jenis_kelamin'] === 'Laki-laki' ? 'bg-primary' : 'bg-pink'; ?>">
                                        <i class="fas <?php echo $p['jenis_kelamin'] === 'Laki-laki' ? 'fa-mars' : 'fa-venus'; ?> me-1"></i>
                                        <?php echo $p['jenis_kelamin']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="date-cell">
                                        <i class="fas fa-calendar me-2 text-muted"></i>
                                        <?php echo date('d/m/Y', strtotime($p['tgl_lahir'])); ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="age-badge"><?php echo $usia; ?> tahun</span>
                                </td>
                                <td>
                                    <span class="job-tag"><?php echo $p['pekerjaan'] ?: '-'; ?></span>
                                </td>
                                <td>
                                    <div class="wilayah-cell">
                                        <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                        <?php echo $p['nama_wilayah']; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?page=form&nik=<?php echo $p['nik']; ?>"
                                            class="btn btn-sm btn-warning btn-action-edit"
                                            data-bs-toggle="tooltip"
                                            title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="controllers/process_penduduk.php?action=delete&nik=<?php echo $p['nik']; ?>"
                                            class="btn btn-sm btn-danger btn-action-delete"
                                            data-bs-toggle="tooltip"
                                            title="Hapus Data"
                                            onclick="return confirmDelete('<?php echo $p['nama']; ?>')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <?php if (empty($penduduk)): ?>
                <div class="empty-state text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum Ada Data Penduduk</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan data penduduk pertama Anda</p>
                    <a href="index.php?page=form" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Tambah Data Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Search function
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#pendudukTable tbody tr');
        let visibleCount = 0;

        rows.forEach(row => {
            const nama = row.querySelector('.fw-semibold').textContent.toLowerCase();
            const nik = row.querySelector('.nik-value').textContent.toLowerCase();
            const isVisible = nama.includes(searchTerm) || nik.includes(searchTerm);

            row.style.display = isVisible ? '' : 'none';
            if (isVisible) visibleCount++;
        });

        document.getElementById('dataCount').textContent = visibleCount + ' data';
    });

    // Filter by gender
    function filterByGender(gender) {
        const rows = document.querySelectorAll('#pendudukTable tbody tr');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowGender = row.getAttribute('data-gender');
            const isVisible = gender === 'all' || rowGender === gender;

            row.style.display = isVisible ? '' : 'none';
            if (isVisible) visibleCount++;
        });

        document.getElementById('dataCount').textContent = visibleCount + ' data';

        // Update button states
        document.querySelectorAll('.btn-action').forEach(btn => {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-outline-primary');
        });

        if (gender === 'all') {
            document.querySelector('.btn-action').classList.add('btn-primary');
            document.querySelector('.btn-action').classList.remove('btn-outline-primary');
        } else {
            event.target.classList.add('btn-primary');
            event.target.classList.remove('btn-outline-primary');
        }
    }

    function showAllData() {
        filterByGender('all');
    }

    // Select all functionality
    document.getElementById('selectAll').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });

    // Confirm delete
    function confirmDelete(nama) {
        return confirm(`Apakah Anda yakin ingin menghapus data ${nama}?`);
    }

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
    .data-header-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .bg-pattern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
    }

    .stat-badge {
        text-align: center;
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    /* .floating-action {
        animation: float 6s ease-in-out infinite;
    } */

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-15px);
        }
    }

    /* Quick Actions */
    .quick-actions-container {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e3e6f0;
    }

    .btn-action {
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .search-box {
        position: relative;
        min-width: 250px;
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        z-index: 2;
    }

    .search-input {
        padding-left: 45px;
        border-radius: 10px;
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    /* Alert Custom */
    .alert-custom {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
    }

    /* Data Table Container */
    .data-table-container {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e3e6f0;
    }

    .table-header {
        padding: 20px 25px;
        background: #f8f9fa;
        border-bottom: 1px solid #e3e6f0;
    }

    .table-title {
        color: #2e59d9;
        font-weight: 600;
    }

    .table-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Table Styles */
    .table {
        margin: 0;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #6e707e;
        padding: 15px 12px;
        background: #f8f9fa;
    }

    .table td {
        padding: 15px 12px;
        vertical-align: middle;
        border-color: #e3e6f0;
    }

    /* Custom Cells */
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .avatar-circle-lg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
        margin: 0 auto;
    }

    .nik-cell,
    .date-cell,
    .wilayah-cell {
        display: flex;
        align-items: center;
    }

    .gender-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .bg-pink {
        background: linear-gradient(135deg, #e83e8c, #d91a72) !important;
    }

    .age-badge {
        background: #e3f2fd;
        color: #1976d2;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .job-tag {
        background: #f3e5f5;
        color: #7b1fa2;
        padding: 4px 10px;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    .btn-action-edit,
    .btn-action-delete,
    .btn-action-view {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-action-edit:hover {
        background: #ffc107 !important;
        transform: translateY(-2px);
    }

    .btn-action-delete:hover {
        background: #dc3545 !important;
        transform: translateY(-2px);
    }

    .btn-action-view:hover {
        background: #0dcaf0 !important;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        padding: 60px 20px;
    }

    /* Detail Modal */
    .detail-info .info-item {
        display: flex;
        justify-content: between;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-info .info-item label {
        font-weight: 600;
        color: #6e707e;
        min-width: 120px;
    }

    .detail-info .info-item span {
        color: #2e59d9;
        font-weight: 500;
    }

    /* Hover Effects */
    .data-row {
        transition: all 0.3s ease;
    }

    .data-row:hover {
        background: #f8f9fa !important;
        transform: translateX(5px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .quick-actions-container .d-flex {
            flex-direction: column;
            gap: 10px !important;
        }

        .search-box {
            min-width: 100%;
        }

        .table-header {
            padding: 15px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 3px;
        }

        .btn-action-edit,
        .btn-action-delete,
        .btn-action-view {
            width: 30px;
            height: 30px;
        }
    }

    /* Custom Scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>