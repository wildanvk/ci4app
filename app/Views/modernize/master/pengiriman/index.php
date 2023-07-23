<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Pengiriman</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">Pengiriman</li>
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
        <h5 class="card-title fw-semibold mb-0 lh-sm">Data Pengiriman</h5>
        <a href="/Pengiriman/input" class="btn btn-primary font-medium">
            <i class="ti ti-plus me-2 fs-4"></i>
            <span>Tambah Data</span>
            <br>
        </a>
        <a href="<?= base_url('pengiriman/printpdf') ?>" target="_blank" class="btn btn-primary">Cetak</a>
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
                <th class="text-center">Tanggal Pengiriman</th>
                <th class="text-center">ID Pengiriman</th>
                <th class="text-center">ID Transaksi</th>
                <th class="text-center">Resi</th>
                <th class="text-center">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php if (empty($Pengiriman)) { ?>
                <tr>
                    <td class="text-center" colspan="7">Tidak ada data</td>
                </tr>
            <?php } else { ?>
                <?php foreach ($Pengiriman as $key => $row) : ?>
                    <tr>
                        <td class="text-center"><?php echo $key + 1; ?></td>
                        <td class="text-center"><?php echo $row['tgl_pengiriman']; ?></td>
                        <td class="text-center"><?php echo $row['id_pengiriman']; ?></td>
                        <td class="text-center"><?php echo $row['id_transaksi']; ?></td>
                        <td class="text-center"><?php echo $row['resi']; ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="<?php echo base_url('Pengiriman/edit/' . $row['id_pengiriman']); ?>" class="btn btn-sm btn-info">
                                    <i class="ti ti-edit"></i>
                                    Update
                                </a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-<?= $row['id_pengiriman'] ?>">
                                    <i class="ti ti-trash"></i>
                                    Hapus
                                </button>
                            </div>

                            <!-- Vertically centered modal -->
                            <div class="modal fade" id="modal-<?= $row['id_pengiriman'] ?>" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger d-flex align-items-center">
                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                Hapus Data
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="fw-medium fs-4" style="text-align: left !important; line-height: 2em; !important">Apakah Anda yakin ingin menghapus data Pengiriman <span class="badge bg-primary"><?= $row['id_pengiriman'] ?></span> dengan nama Pengiriman <span class="badge bg-primary"><?= $row['id_pengiriman'] ?></span>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?php echo base_url('Pengiriman/delete/' . $row['id_pengiriman']); ?>" class="btn btn-light-danger text-danger font-medium">
                                                Hapus Data
                                            </a>
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
<?= $this->endSection() ?>