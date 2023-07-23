<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Update Transaksi</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">Transaksi</li>
                        <li class="breadcrumb-item" aria-current="page">Update Transaksi</li>
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
    <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center bg-info">
        <h5 class="card-title fw-semibold mb-0 lh-sm text-white">Update Transaksi</h5>
    </div>
    <form action="/Transaksi/update" method="post">
        <?= csrf_field() ?>
        <div class="card-body p-4">
            <input type="hidden" name="oldid_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
            <div class="mb-4 row align-items-center">
                <label for="id_transaksi" class="form-label fw-semibold col-sm-1 col-form-label">ID Transaksi</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="id_transaksi" placeholder="Masukkan Tanggal Transaksi" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>" readonly>
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="tgl_transaksi" class="form-label fw-semibold col-sm-1 col-form-label">Tanggal Transaksi</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tgl_transaksi" placeholder="Masukkan ID Transaksi" name="tgl_transaksi" value="<?= old('tgl_transaksi') ? old('tgl_transaksi') : $transaksi['tgl_transaksi'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="nama_customer" class="form-label fw-semibold col-sm-1 col-form-label">Nama Customer</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama_customer" placeholder="Masukkan Nama Customer" name="nama_customer" value="<?= old('nama_customer') ? old('nama_customer') : $transaksi['nama_customer'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="alamat" class="form-label fw-semibold col-sm-1 col-form-label">Alamat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat" name="alamat" value="<?= old('alamat') ? old('alamat') : $transaksi['alamat'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="no_hp" class="form-label fw-semibold col-sm-1 col-form-label">NO HP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama_barang" placeholder="Masukkan NO HP" name="no_hp" value="<?= old('no_hp') ? old('no_hp') : $transaksi['no_hp'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="nama_barang" class="form-label fw-semibold col-sm-1 col-form-label">Nama Barang</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama_barang" placeholder="Masukkan Nama Barang" name="nama_barang" value="<?= old('nama_barang') ? old('nama_barang') : $transaksi['nama_barang'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="jumlah_barang" class="form-label fw-semibold col-sm-1 col-form-label">Jumlah Barang</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="jumlah_barang" placeholder="Masukkan Jumlah Barang" name="jumlah_barang" value="<?= old('jumlah_barang') ? old('jumlah_barang') : $transaksi['jumlah_barang'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="total_bayar" class="form-label fw-semibold col-sm-1 col-form-label">Total Bayar</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="total_bayar" placeholder="Masukkan NO HP" name="total_bayar" value="<?= old('total_bayar') ? old('total_bayar') : $transaksi['total_bayar'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6 d-flex justify-content-between">
                        <a href="/transaksi" class="justify-content-center btn btn-rounded btn-outline-danger d-flex align-items-center font-medium">
                            <i class="ti ti-arrow-left me-2 fs-4"></i>
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-info font-medium">
                            <i class="ti ti-plus me-2 fs-4"></i>
                            <span>Update Data</span>
                        </button>
                    </div>
                </div>
            </div>
    </form>
</div>
<?= $this->endSection() ?>