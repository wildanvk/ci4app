<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Update Transaksi Masuk Barang Mentah</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted">Barang Masuk</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/barangmasukmentah">Barang Mentah</a></li>
                        <li class="breadcrumb-item" aria-current="page">Update Transaksi Masuk Barang Mentah</li>
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
        <h5 class="card-title fw-semibold mb-0 lh-sm text-white">Update Transaksi Masuk Barang Mentah</h5>
    </div>
    <form action="/barangmasukmentah/update" method="post">
        <?= csrf_field() ?>
        <div class="card-body p-4">
            <input type="hidden" name="oldIdTransaksi" value="<?= $barangmasukmentah['idTransaksi']; ?>">
            <div class="mb-4 row align-items-center">
                <label for="idTransaksi" class="form-label fw-semibold col-sm-1 col-form-label">ID Stok</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="idTransaksi" placeholder="Masukkan ID Stok" name="idTransaksi" value="<?= $barangmasukmentah['idTransaksi'] ?>" readonly>
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="tanggal" class="form-label fw-semibold col-sm-1 col-form-label">Tanggal Transaksi</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal" placeholder="Masukkan ID Transaksi" name="tanggal" value="<?= $barangmasukmentah['tanggal'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="idBarangMentah" class="form-label fw-semibold col-sm-1 col-form-label">Barang Mentah</label>
                <div class="col-sm-6">
                    <select class="form-select" name="idBarangMentah" id="idBarangMentah">
                        <option value="">Pilih Barang Mentah</option>
                        <?php foreach ($barangmentah as $key) { ?>
                            <option value="<?= $key['idBarangMentah'] ?>" <?= old('idBarangMentah') == $key['idBarangMentah'] || $barangmasukmentah['idBarangMentah'] == $key['idBarangMentah'] ? 'selected' : '' ?>><?= $key['idBarangMentah'] . ' - ' . $key['namaBarangMentah'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="idSupplier" class="form-label fw-semibold col-sm-1 col-form-label">Supplier</label>
                <div class="col-sm-6">
                    <select class="form-select" name="idSupplier" id="idSupplier">
                        <option value="">Pilih Supplier</option>
                        <?php foreach ($supplier as $key) { ?>
                            <option value="<?= $key['idSupplier'] ?>" <?= old('idSupplier') == $key['idSupplier'] || $barangmasukmentah['idSupplier'] == $key['idSupplier'] ? 'selected' : '' ?>><?= $key['idSupplier'] . ' - ' . $key['namaSupplier'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="jumlah" class="form-label fw-semibold col-sm-1 col-form-label">Jumlah</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="jumlah" placeholder="Masukkan Stok Barang" name="jumlah" value="<?= old('jumlah') ? old('jumlah') : $barangmasukmentah['jumlah'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="harga" class="form-label fw-semibold col-sm-1 col-form-label">Harga</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="harga" placeholder="Masukkan Stok Barang" name="harga" value="<?= old('harga') ? old('harga') : $barangmasukmentah['harga'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="keterangan" class="form-label fw-semibold col-sm-1 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Masukkan keterangan..."><?= old('keterangan') ? old('keterangan') : $barangmasukmentah['keterangan'] ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6 d-flex justify-content-between">
                    <a href="/barangmasukmentah" class="justify-content-center btn btn-rounded btn-outline-danger d-flex align-items-center font-medium">
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