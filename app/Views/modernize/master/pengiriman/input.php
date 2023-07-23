<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Input Pengiriman</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted">Pengiriman</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/pengiriman"> Pengiriman</a></li>
                        <li class="breadcrumb-item" aria-current="page">Input Pengiriman</li>
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
<?php $errors = session()->getFlashdata('errors');
if (!empty($errors)) { ?>
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Whoops! Ada kesalahan saat input data, yaitu:</strong>
        <ol class="list-group list-group-numbered">
            <?php foreach ($errors as $error) : ?>
                <li class="list-group-items m-0"><?= esc($error) ?></li>
            <?php endforeach ?>
        </ol>
    </div>
<?php } ?>
<div class="card w-100 position-relative overflow-hidden">
    <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center bg-primary">
        <h5 class="card-title fw-semibold mb-0 lh-sm text-white">Input Data Pengiriman</h5>
    </div>
    <form action="/pengiriman/store" method="post">
        <?= csrf_field() ?>
        <div class="card-body p-4">
            <div class="mb-4 row align-items-center">
                <label for="tgl_pengiriman" class="form-label fw-semibold col-sm-2 col-form-label">Tanggal Pengiriman</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tgl_pengiriman" placeholder="Masukkan Tanggal Pengiriman" name="tgl_pengiriman" value="<?= date("Y-m-d") ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="id_pengiriman" class="form-label fw-semibold col-sm-2 col-form-label">ID Pengiriman</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="id_pengiriman" placeholder="Masukkan ID Pengiriman" name="id_pengiriman" value="<?= $id_pengiriman ?>" readonly>
                </div>
            </div>
            <!-- <div class="mb-4 row align-items-center">
                <label for="id_transaksi" class="form-label fw-semibold col-sm-2 col-form-label">ID Transaksi</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="id_transaksi" placeholder="Masukkan ID Pesanan" name="id_transaksi" value="" readonly>
                </div>
            </div> -->
            <div class="mb-4 row align-items-center">
                <label for="id_transaksi" class="form-label fw-semibold col-sm-2 col-form-label">ID Transaksi</label>
                <div class="col-sm-6">
                    <select class="form-select" name="id_transaksi" id="id_transaksi">
                        <option value="">Pilih ID Transaksi</option>
                        <?php foreach ($data_transaksi as $key) { ?>
                            <option value="<?= $key['id_transaksi'] ?>">
                                <?= $key['id_transaksi'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="resi" class="form-label fw-semibold col-sm-2 col-form-label">Resi</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="resi" placeholder="Masukkan Resi" name="resi" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6 d-flex justify-content-between">
                    <a href="/supplier" class="justify-content-center btn btn-rounded btn-outline-danger d-flex align-items-center font-medium">
                        <i class="ti ti-arrow-left me-2 fs-4"></i>
                        <span>Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-primary font-medium">
                        <i class="ti ti-plus me-2 fs-4"></i>
                        <span>Tambah Data</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>