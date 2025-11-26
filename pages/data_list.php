<?php
require_once __DIR__ . '/../models/PendudukModel.php';

$pendudukModel = new PendudukModel($conn);
$dataPenduduk = $pendudukModel->getAllPenduduk();
?>

<div class="container">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>
                <i class="fas fa-list"></i> Data Penduduk
            </h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="index.php?page=form&action=add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Penduduk
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Table -->
    <div class="card">
        <div class="card-body">
            <?php if (count($dataPenduduk) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Pekerjaan</th>
                                <th>Wilayah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataPenduduk as $index => $row): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><code><?= htmlspecialchars($row['nik']) ?></code></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td>
                                        <?php if ($row['jenis_kelamin'] == 'Laki-laki'): ?>
                                            <span class="badge bg-primary">
                                                <i class="fas fa-mars"></i> Laki-laki
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">
                                                <i class="fas fa-venus"></i> Perempuan
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_lahir'])) ?></td>
                                    <td><?= htmlspecialchars($row['pekerjaan']) ?></td>
                                    <td>
                                        <small class="badge bg-info">
                                            <?= htmlspecialchars($row['nama_wilayah']) ?>
                                        </small>
                                    </td>
                                    <td>
                                        <a href="index.php?page=form&nik=<?= urlencode($row['nik']) ?>" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="controllers/process_penduduk.php?action=delete&nik=<?= urlencode($row['nik']) ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Yakin ingin menghapus data ini?');" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> Belum ada data penduduk. 
                    <a href="index.php?page=form&action=add">Tambah data sekarang</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>