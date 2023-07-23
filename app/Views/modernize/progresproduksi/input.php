<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Input Progres Produksi</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="/progresproduksi">Progres Produksi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Input Progres Produksi</li>
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
                <li class="list-group-items m-0">
                    <?= esc($error) ?>
                </li>
            <?php endforeach ?>
        </ol>
    </div>
<?php } ?>
<div class="card w-100 position-relative overflow-hidden">
    <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center bg-primary">
        <h5 class="card-title fw-semibold mb-0 lh-sm text-white">Input Progres Produksi</h5>
    </div>
    <form action="/progresproduksi/store" method="post">
        <?= csrf_field() ?>
        <div class="card-body p-4">
            <div class="mb-4 row align-items-center">
                <label for="id_progres" class="form-label fw-semibold col-sm-1 col-form-label">Id Progres</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="id_progres" placeholder="Masukkan ID Progres" name="id_progres" value="<?= $id_progres ?>" readonly>
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="id_produksi" class="form-label fw-semibold col-sm-1 col-form-label">Id Produksi</label>
                <div class="col-sm-6">
                    <select class="form-select" name="id_produksi" id="id_produksi">
                        <option value="">Pilih Id Produksi</option>
                        <?php foreach ($id_produksi as $key) : ?>
                            <option value="<?= $key['id_produksi'] ?>"><?= $key['id_produksi'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="tgl_produksi" class="form-label fw-semibold col-sm-1 col-form-label">Tanggal
                    Produksi</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tgl_produksi" placeholder="Masukkan ID Produksi" name="tgl_produksi" value="<?= date("Y-m-d") ?>">
                </div>
            </div>
            <div class="mb-4 row align-items-center">
                <label for="status_produksi" class="form-label fw-semibold col-sm-1 col-form-label">Status
                    Produksi</label>
                <div class="col-sm-6">
                    <select class="form-select" name="status_produksi" id="status_produksi">
                        <option value="">Pilih Status Produksi</option>
                        <option value="pemolaan&pemotongan" <?= old('pemolaan&pemotongan') == 'pemolaan&pemotongan' ? 'selected' : '' ?>>Pemolaan & Pemotongan</option>
                        <option value="penjahitan" <?= old('penjahitan') == 'penjahitan' ? 'selected' : '' ?>>Penjahitan
                        </option>
                        <option value="finishing" <?= old('finishing') == 'finishing' ? 'selected' : '' ?>>Finishing
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6 d-flex justify-content-between">
                    <a href="/progresproduksi" class="justify-content-center btn btn-rounded btn-outline-danger d-flex align-items-center font-medium">
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