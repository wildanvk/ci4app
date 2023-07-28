<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Transaksi</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">Transaksi</li>
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
        <h5 class="card-title fw-semibold mb-0 lh-sm">Data Transaksi</h5>
        <a href="/penjualan/transaksi/input" class="btn btn-primary font-medium">
            <i class="ti ti-plus me-2 fs-4"></i>
            <span>Tambah Data</span>
        </a>
    </div>
    <div class="table-responsive" style="overflow-x: auto !important;">
        <table class="table">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">tgl_transaksi</th>
                    <th class="text-center">ID Transaksi</th>
                    <th>Nama Transaksi</th>
                    <th>Alamat</th>
                    <th class="text-center">No Hp</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Jumlah Barang</th>
                    <th class="text-center">Total Bayar</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($Transaksi)) { ?>
                    <tr>
                        <td class="text-center" colspan="7">Tidak ada data</td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($Transaksi as $key => $row) : ?>
                        <tr>
                            <td class="text-center"><?php echo $key + 1; ?></td>
                            <td class="text-center"><?php echo $row['tgl_transaksi']; ?></td>
                            <td class="text-center"><?php echo $row['id_transaksi']; ?></td>
                            <td><?php echo $row['nama_customer']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td class="text-center"><?php echo $row['no_hp']; ?></td>
                            <td class="text-center"><?php echo $row['nama_barang']; ?></td>
                            <td class="text-center"><?php echo $row['jumlah_barang']; ?></td>
                            <td class="text-center"><?php echo $row['total_bayar']; ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?php echo base_url('/penjualan/transaksi/edit/' . $row['id_transaksi']); ?>" class="btn btn-sm btn-info">
                                        <i class="ti ti-edit"></i>
                                        Update
                                    </a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-<?= $row['id_transaksi'] ?>">
                                        <i class="ti ti-trash"></i>
                                        Hapus
                                    </button>
                                </div>

                                <!-- Vertically centered modal -->
                                <div class="modal fade" id="modal-<?= $row['id_transaksi'] ?>" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header modal-colored-header bg-danger d-flex align-items-center">
                                                <h4 class="modal-title" id="myLargeModalLabel">
                                                    Hapus Data
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="fw-medium fs-4" style="text-align: left !important; line-height: 2em; !important">Apakah Anda yakin ingin menghapus data Transaksi <span class="badge bg-primary"><?= $row['id_transaksi'] ?></span> dengan nama Transaksi <span class="badge bg-primary"><?= $row['nama_customer'] ?></span>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?php echo base_url('/penjualan/transaksi/delete/' . $row['id_transaksi']); ?>" class="btn btn-light-danger text-danger font-medium">
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