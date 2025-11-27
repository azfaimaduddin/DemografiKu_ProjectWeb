<?php
require_once __DIR__ . '/../models/PendudukModel.php';
require_once __DIR__ . '/../models/WilayahModel.php';
require_once __DIR__ . '/../config/auth.php';
Auth::requireLogin();

$pendudukModel = new PendudukModel();
$wilayahModel = new WilayahModel();
$wilayah = $wilayahModel->getAllWilayah();
$penduduk = null;
$isEdit = false;

if (isset($_GET['nik'])) {
    $penduduk = $pendudukModel->getPendudukByNIK($_GET['nik']);
    $isEdit = true;
}
?>

<div class="card">
    <div class="card-header">
        <h4><?php echo $isEdit ? 'Edit Data Penduduk' : 'Tambah Data Penduduk'; ?></h4>
    </div>
    <div class="card-body">
        <form action="controllers/process_penduduk.php" method="POST">
            <?php if ($isEdit): ?>
                <input type="hidden" name="nik_old" value="<?php echo $penduduk['nik']; ?>">
                <input type="hidden" name="action" value="edit">
            <?php else: ?>
                <input type="hidden" name="action" value="add">
            <?php endif; ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik"
                            value="<?php echo $isEdit ? $penduduk['nik'] : ''; ?>"
                            <?php echo $isEdit ? 'readonly' : 'required'; ?>>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="<?php echo $isEdit ? $penduduk['nama'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" <?php echo ($isEdit && $penduduk['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo ($isEdit && $penduduk['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                            value="<?php echo $isEdit ? $penduduk['tgl_lahir'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                            value="<?php echo $isEdit ? $penduduk['pekerjaan'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="id_wilayah" class="form-label">Wilayah</label>
                        <select class="form-select" id="id_wilayah" name="id_wilayah" required>
                            <option value="">Pilih Wilayah</option>
                            <?php foreach ($wilayah as $w): ?>
                                <option value="<?php echo $w['id_wilayah']; ?>"
                                    <?php echo ($isEdit && $penduduk['id_wilayah'] == $w['id_wilayah']) ? 'selected' : ''; ?>>
                                    <?php echo $w['nama_wilayah']; ?> (<?php echo $w['tingkat']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="index.php?page=list" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary"><?php echo $isEdit ? 'Update' : 'Simpan'; ?></button>
            </div>
        </form>
    </div>
</div>