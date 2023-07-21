<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Barang Jadi</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted">Master</a></li>
                        <li class="breadcrumb-item" aria-current="page">Barang Jadi</li>
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0 lh-sm">Data Barang Jadi</h5>
                <button id="tambahDataModalButton" type="button" class="btn btn-primary font-medium" data-bs-toggle="modal" data-bs-target="#inputModal">
                    <i class="ti ti-plus me-2 fs-4"></i>
                    <span>Tambah Data</span>
                </button>
                <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form id="inputForm" action="" method="post">
                                <?= csrf_field() ?>
                                <div class="modal-header modal-colored-header bg-primary d-flex align-items-center">
                                    <h4 class="modal-title" id="myLargeModalLabel">
                                        Tambah Data
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="idBarangJadi" class="form-label fw-semibold col-form-label ms-1">ID Barang Jadi :</label>
                                                <input type="text" class="form-control" id="idBarangJadi" placeholder="Masukkan ID Barang Jadi" name="idBarangJadi" value="" readonly>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="namaBarangJadi" class="form-label fw-semibold col-form-label ms-1">Nama Barang Jadi :</label>
                                                <input type="text" class="form-control" id="namaBarangJadi" placeholder="Masukkan Nama Barang Jadi" name="namaBarangJadi" value="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label fw-semibold col-form-label ms-1">Status :</label>
                                                <select class="form-select" name="status" id="status">
                                                    <option value="">Pilih Status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-light-primary font-medium">
                                        Tambah Data
                                    </button>
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-3" style="overflow-x: auto !important;">
                <table id="barangJadiTable" class="table border table-striped display text-nowrap">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="">No</th>
                            <th class="">ID Barang Jadi</th>
                            <th class="">Nama Barang Jadi</th>
                            <th class="">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <!-- Modal Update -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form id="updateForm">
                                <input type="hidden" value="" id="rowIndex">
                                <?= csrf_field() ?>
                                <div class="modal-header modal-colored-header bg-info d-flex align-items-center">
                                    <h4 class="modal-title" id="myLargeModalLabel">
                                        Update Data
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="text-align: left !important;">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="idBarangJadi" class="form-label fw-semibold col-form-label ms-1">ID Barang Jadi :</label>
                                                <input type="text" class="form-control" id="idBarangJadi" placeholder="Masukkan ID Barang Jadi" name="idBarangJadi" value="" readonly>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="namaBarangJadi" class="form-label fw-semibold col-form-label ms-1">Nama Barang Jadi :</label>
                                                <input type="text" class="form-control" id="namaBarangJadi" placeholder="Masukkan Nama Barang Jadi" name="namaBarangJadi" value="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label fw-semibold col-form-label ms-1">Status :</label>
                                                <select class="form-select" name="status" id="status">
                                                    <option value="">Pilih Status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="submit" class="btn btn-light-info text-info font-medium">
                                        Update Data
                                    </button>
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form id="deleteForm">
                                <div class="modal-header modal-colored-header bg-danger d-flex align-items-center">
                                    <h4 class="modal-title" id="myLargeModalLabel">
                                        Hapus Data
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-wrap">
                                    <input type="hidden" id="rowIndex" value="">
                                    <input type="hidden" id="idBarangJadi" name="idBarangJadi" value="">
                                    <p class="fw-medium fs-4" style="text-align: left !important; line-height: 2em !important; ">Apakah Anda yakin ingin menghapus data barang jadi <span class="badge bg-primary" id="spanIdBarangJadi"></span> dengan nama barang jadi <span class="badge bg-primary" id="spanNamaBarangJadi"></span>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-light-danger text-danger font-medium">
                                        Hapus Data
                                    </button>
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/myjs/BarangJadiTable.js"></script>
<?= $this->endSection() ?>