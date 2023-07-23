<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Update penggajian</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted">Master</a></li>
                        <li class="breadcrumb-item" aria-current="page">penggajian</li>
                        <li class="breadcrumb-item" aria-current="page">Update Penggajian</li>
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
        <h5 class="card-title fw-semibold mb-0 lh-sm text-white">Update Data penggajian</h5>
    </div>
    <form action="/penggajian/update" method="post">
        <?= csrf_field() ?>
        <div class="card-body p-4">
            <input type="hidden" name="oldidpenggajian" value="<?= $penggajian['idpenggajian']; ?>">
            <div class="mb-4 row align-items-center">
                <label for="idpenggajian"class="form-label fw-semibold col-sm-2 col-form-label">ID Penggajian</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="idpenggajian placeholder="Masukkan ID penggajian" name="idpenggajian" value="<?= $penggajian['idpenggajian'] ?>" readonly>
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="idkaryawan" class="form-label fw-semibold col-sm-2 col-form-label">ID Karyawan</label>
            <div class="col-sm-6">
                    <select class="form-select" name="idkaryawan" id="idkaryawan">
                        <option value="">Pilih Karyawan</option>
                        <?php foreach($karyawan as $key) : ?>
                        <option value="<?= $key['idkaryawan']  ?>" <?= $penggajian['idkaryawan'] == $key['idkaryawan'] ? 'selected' : '' ?>><?= $key['idkaryawan']  ?> - <?= $key['nama']  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="tanggal" class="form-label fw-semibold col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal" placeholder="" name="tanggal" value="<?= old('tanggal') ? old('tanggal') : $penggajian['tanggal'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="jumlahproduksi" class="form-label fw-semibold col-sm-2 col-form-label">Jumlah produksi</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="jumlahproduksi" placeholder="" name="jumlahproduksi" value="<?= old('jumlahproduksi') ? old('jumlahproduksi') : $penggajian['jumlahproduksi'] ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="totalgaji" class="form-label fw-semibold col-sm-2 col-form-label">Total gaji</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="totalgaji" placeholder="" name="totalgaji" value="<?= old('totalgajii') ? old('totalgaji') : $penggajian['totalgaji'] ?>">
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6 d-flex justify-content-between">
                    <a href="/penggajian" class="justify-content-center btn btn-rounded btn-outline-danger d-flex align-items-center font-medium">
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