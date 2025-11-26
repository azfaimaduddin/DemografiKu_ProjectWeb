<?php
require_once __DIR__ . '/../models/PendudukModel.php';

$model = new PendudukModel();
$penduduk = $model->getAllPenduduk();

// Handle success/error messages
$success = isset($_GET['success']) ? $_GET['success'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Penduduk</h2>
    <a href="index.php?page=form" class="btn btn-primary">Tambah Penduduk</a>
</div>

<?php if ($success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        switch ($success) {
            case '1': echo 'Data penduduk berhasil ditambahkan!'; break;
            case '2': echo 'Data penduduk berhasil diupdate!'; break;
            case '3': echo 'Data penduduk berhasil dihapus!'; break;
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php
        switch ($error) {
            case '1': echo 'Gagal menambahkan data penduduk!'; break;
            case '2': echo 'Gagal mengupdate data penduduk!'; break;
            case '3': echo 'Gagal menghapus data penduduk!'; break;
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
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
                    <?php foreach ($penduduk as $p): ?>
                    <tr>
                        <td><?php echo $p['nik']; ?></td>
                        <td><?php echo $p['nama']; ?></td>
                        <td><?php echo $p['jenis_kelamin']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($p['tgl_lahir'])); ?></td>
                        <td><?php echo $p['pekerjaan']; ?></td>
                        <td><?php echo $p['nama_wilayah']; ?></td>
                        <td>
                            <a href="index.php?page=form&nik=<?php echo $p['nik']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="controllers/process_penduduk.php?action=delete&nik=<?php echo $p['nik']; ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>