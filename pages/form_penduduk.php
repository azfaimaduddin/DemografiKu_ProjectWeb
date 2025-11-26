<?php
require_once __DIR__ . '/../models/PendudukModel.php';
require_once __DIR__ . '/../models/WilayahModel.php';

$pendudukModel = new PendudukModel($conn);
$wilayahModel = new WilayahModel($conn);

$wilayahList = $wilayahModel->getAllWilayah();
$formData = null;
$isEdit = false;

// Jika ada NIK di URL, ambil data untuk edit
if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];
    $formData = $pendudukModel->getPendudukByNIK($nik);
    $isEdit = true;
    
    if (!$formData) {
        $isEdit = false;
    }
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Header -->
            <div class="mb-4">
                <h2>
                    <i class="fas fa-<?= $isEdit ? 'edit' : 'plus' ?>"></i> 
                    <?= $isEdit ? 'Edit' : 'Tambah' ?> Data Penduduk
                </h2>
            </div>

            <!-- Alert Messages -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Form Card -->
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="controllers/process_penduduk.php?action=<?= $isEdit ? 'edit' : 'add' ?>" novalidate>
                        
                        <?php if ($isEdit): ?>
                            <input type="hidden" name="nik_lama" value="<?= htmlspecialchars($formData['nik']) ?>">
                        <?php endif; ?>

                        <!-- NIK -->
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nik" name="nik" 
                                   value="<?= htmlspecialchars($formData['nik'] ?? '') ?>" 
                                   placeholder="Masukkan NIK (16 digit)" 
                                   maxlength="16" 
                                   <?= $isEdit ? 'readonly' : 'required' ?>
                                   pattern="[0-9]{16}">
                            <small class="form-text text-muted">Format: 16 digit angka</small>
                        </div>

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                   value="<?= htmlspecialchars($formData['nama'] ?? '') ?>" 
                                   placeholder="Masukkan nama lengkap" 
                                   required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" <?= ($formData['jenis_kelamin'] ?? '') === 'Laki-laki' ? 'selected' : '' ?>>
                                    <i class="fas fa-mars"></i> Laki-laki
                                </option>
                                <option value="Perempuan" <?= ($formData['jenis_kelamin'] ?? '') === 'Perempuan' ? 'selected' : '' ?>>
                                    <i class="fas fa-venus"></i> Perempuan
                                </option>
                            </select>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" 
                                   value="<?= htmlspecialchars($formData['tgl_lahir'] ?? '') ?>" 
                                   required>
                        </div>

                        <!-- Pekerjaan -->
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" 
                                   value="<?= htmlspecialchars($formData['pekerjaan'] ?? '') ?>" 
                                   placeholder="Masukkan pekerjaan (opsional)">
                        </div>

                        <!-- Wilayah -->
                        <div class="mb-3">
                            <label for="id_wilayah" class="form-label">Wilayah <span class="text-danger">*</span></label>
                            <select class="form-select" id="id_wilayah" name="id_wilayah" required>
                                <option value="">-- Pilih Wilayah --</option>
                                <?php foreach ($wilayahList as $wilayah): ?>
                                    <option value="<?= $wilayah['id_wilayah'] ?>" 
                                            <?= ($formData['id_wilayah'] ?? '') == $wilayah['id_wilayah'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($wilayah['nama_wilayah']) ?> (<?= $wilayah['tingkat'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <?= $isEdit ? 'Perbarui' : 'Simpan' ?> Data
                            </button>
                            <a href="index.php?page=list" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>