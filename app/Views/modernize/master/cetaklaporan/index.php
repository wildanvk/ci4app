<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">penggajian</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted">Master</a></li>
                        <li class="breadcrumb-item" aria-current="page">penggajian</li>
                    </ol>
                </nav>
            </div>
            <div class="col-2">
                <div class="text-center mb-n5">
                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (session()->getFlashdata('input')) { ?>
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>

        <strong><?= session()->getFlashdata('input') ?></strong>
    </div>
<?php } ?>
<?php if (session()->getFlashdata('update')) { ?>
    <div class="alert alert-info alert-dismissible bg-info text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong><?= session()->getFlashdata('update') ?></strong>
    </div>
<?php } ?>
<?php if (session()->getFlashdata('delete')) { ?>
    <div class="alert alert-warning alert-dismissible border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong><?= session()->getFlashdata('delete') ?></strong>
    </div>
<?php } ?>
<div class="card w-100 position-relative overflow-hidden">
    <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-semibold mb-0 lh-sm">Data penggajian</h5>
        <div class="col-lg-2">
            <form class="d-flex" role="search" action="/laporan/detaillaporan" method="POST">
                <select name="bulan" class="form-select mx-3">
                    <option value="">--Pilih--</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <button class="btn btn-outline-success cari" type="submit">Cari</button>
            </form>
        </div>
    </div>
    <div class="table-responsive" style="overflow-x: auto !important;">
        <table class="table">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">ID penggajian</th>
                    <th class="text-center">ID Karyawan</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jumlah produksi</th>
                    <th class="text-center">Total gaji</th>

                </tr>
            </thead>
            <tbody>
                <?php if (empty($penggajian)) { ?>
                    <tr>
                        <td class="text-center" colspan="7">Tidak ada data</td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($penggajian as $key => $row) : ?>
                        <tr>
                            <td class="text-center"><?php echo $key + 1; ?></td>
                            <td class="text-center"><?php echo $row['idpenggajian']; ?></td>
                            <td class="text-center"><?php echo $row['idkaryawan']; ?></td>
                            <td class="text-center"><?php echo $row['nama']; ?></td>
                            <td class="text-center"><?php echo $row['jenis_kelamin']; ?></td>
                            <td class="text-center"><?php echo $row['tanggal']; ?></td>
                            <td class="text-center"><?php echo $row['jumlahproduksi']; ?></td>
                            <td class="text-center"><?php echo $row['totalgaji']; ?></td>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>