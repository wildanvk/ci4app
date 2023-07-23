<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Input Riwayat Produksi</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="/riwayatproduksi">Riwayat Produksi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Input Riwayat Produksi</li>
                    </ol>
                </nav>
            </div>
            <div class="col-2">
                <div class="text-center mb-n5">
                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/breadcrumb/ChatBc.png" alt=""
                        class="img-fluid mb-n4">
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
            <?php foreach ($errors as $error): ?>
                <li class="list-group-items m-0">
                    <?= esc($error) ?>
                </li>
            <?php endforeach ?>
        </ol>
    </div>
<?php } ?>
<div class="card w-100 position-relative overflow-hidden">
    <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center bg-primary">
        <h5 class="card-title fw-semibold mb-0 lh-sm text-white">Input Riwayat Produksi</h5>
    </div>
    <form action="/riwayatproduksi/store" method="post">
        <?= csrf_field() ?>
        <div class="card-body p-4">
            <div class="card-body p-4">
                <div class="mb-4 row align-items-center">
                    <label for="id_riwayat_produksi" class="form-label fw-semibold col-sm-2 col-form-label">Id Riwayat
                        Produksi</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="id_riwayat_produksi"
                            placeholder="Masukkan Id Riwayat Produksi" name="id_riwayat_produksi"
                            value="<?= $id_riwayat_produksi ?>" readonly>
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <label for="id_riwayat_produksi" class="form-label fw-semibold col-sm-2 col-form-label">Id
                        Produksi</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="id_produksi" placeholder="Masukkan Id Produksi"
                            name="id_produksi" value="<?= $id_riwayat_produksi ?>" readonly>
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <label for="nama_barang" class="form-label fw-semibold col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nama_barang" placeholder="Masukkan Nama Karyawan"
                            name="nama_barang" value="<?= old('nama_barang') ? old('nama_barang') : '' ?>">
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <label for="nama_barang" class="form-label fw-semibold col-sm-2 col-form-label">Jumlah
                        Barang</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="jumlah" placeholder="Masukkan Jumlah Barang"
                            name="jumlah" value="<?= old('jumlah') ? old('jumlah') : '' ?>">
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <label for="tgl_produksi" class="form-label fw-semibold col-sm-2 col-form-label">Tanggal
                        Produksi</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" id="tgl_produksi"
                            placeholder="Masukkan Tanggal Produksi" name="tgl_produksi" value="<?= date("Y-m-d") ?>">
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <label for="tgl_selesai" class="form-label fw-semibold col-sm-2 col-form-label">Tanggal
                        Selesai</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" id="tgl_selesai" placeholder="Masukkan Tanggal Selesai"
                            name="tgl_selesai" value="<?= date("Y-m-d") ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6 d-flex justify-content-between">
                        <a href="/riwayatproduksi"
                            class="justify-content-center btn btn-rounded btn-outline-danger d-flex align-items-center font-medium">
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