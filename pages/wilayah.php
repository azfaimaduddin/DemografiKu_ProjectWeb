<?php
require_once __DIR__ . '/../models/WilayahModel.php';

$model = new WilayahModel();
$wilayah = $model->getAllWilayah();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Wilayah</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Wilayah</th>
                        <th>Tingkat</th>
                        <th>Luas Area (km²)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($wilayah as $w): ?>
                    <tr>
                        <td><?php echo $w['id_wilayah']; ?></td>
                        <td><?php echo $w['nama_wilayah']; ?></td>
                        <td><?php echo $w['tingkat']; ?></td>
                        <td><?php echo $w['luas_area_km2']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>