<?php
require_once __DIR__ . '/../models/WilayahModel.php';

$wilayahModel = new WilayahModel($conn);
$dataWilayah = $wilayahModel->getAllWilayah();
$kepadatanData = $wilayahModel->getKepadatanByWilayah();
?>

<div class="container">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>
                <i class="fas fa-map"></i> Data Wilayah
            </h2>
        </div>
    </div>

    <!-- Wilayah Info Table -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-list"></i> Daftar Wilayah
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Wilayah</th>
                            <th>Tingkat</th>
                            <th>Luas Area (km²)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataWilayah as $index => $row): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($row['nama_wilayah']) ?></td>
                                <td>
                                    <?php 
                                        $badge_color = $row['tingkat'] === 'Desa' ? 'success' : ($row['tingkat'] === 'RW' ? 'info' : 'warning');
                                    ?>
                                    <span class="badge bg-<?= $badge_color ?>">
                                        <?= $row['tingkat'] ?>
                                    </span>
                                </td>
                                <td><?= number_format($row['luas_area_km2'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Kepadatan Penduduk per Wilayah -->
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                <i class="fas fa-chart-line"></i> Kepadatan Penduduk per Wilayah
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Wilayah</th>
                            <th>Luas (km²)</th>
                            <th>Jumlah Penduduk</th>
                            <th>Kepadatan (per km²)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kepadatanData as $index => $row): 
                            $kepadatan = $row['kepadatan'];
                            if ($kepadatan > 100) {
                                $status = '<span class="badge bg-danger">Sangat Padat</span>';
                            } elseif ($kepadatan > 50) {
                                $status = '<span class="badge bg-warning text-dark">Padat</span>';
                            } elseif ($kepadatan > 20) {
                                $status = '<span class="badge bg-info">Sedang</span>';
                            } else {
                                $status = '<span class="badge bg-success">Jarang</span>';
                            }
                        ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($row['nama_wilayah']) ?></strong>
                                </td>
                                <td><?= number_format($row['luas_area_km2'], 2, ',', '.') ?></td>
                                <td>
                                    <span class="badge bg-primary"><?= $row['jumlah_penduduk'] ?> orang</span>
                                </td>
                                <td>
                                    <strong><?= number_format($kepadatan, 2, ',', '.') ?></strong>
                                </td>
                                <td><?= $status ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Legend -->
    <div class="alert alert-info mt-4">
        <h6 class="alert-heading">
            <i class="fas fa-info-circle"></i> Kategori Kepadatan Penduduk
        </h6>
        <ul class="mb-0">
            <li><span class="badge bg-danger">Sangat Padat</span> &gt; 100 orang/km²</li>
            <li><span class="badge bg-warning text-dark">Padat</span> 50-100 orang/km²</li>
            <li><span class="badge bg-info">Sedang</span> 20-50 orang/km²</li>
            <li><span class="badge bg-success">Jarang</span> &lt; 20 orang/km²</li>
        </ul>
    </div>
</div>