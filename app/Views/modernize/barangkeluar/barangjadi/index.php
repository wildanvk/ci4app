<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Transaksi Keluar Barang Jadi</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted">Transaksi Keluar</a></li>
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
<?php if (session()->getFlashdata('info')) { ?>
    <div class="alert alert-info alert-dismissible border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong><?= session()->getFlashdata('info') ?></strong>
    </div>
<?php } ?>
<?php if (session()->getFlashdata('input')) { ?>
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong><?= session()->getFlashdata('input') ?></strong>
    </div>
<?php } ?>
<?php if (session()->getFlashdata('update')) { ?>
    <div class="alert alert-secondary alert-dismissible bg-secondary text-white border-0 fade show" role="alert">
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
                <div class="d-flex align-items-center">
                    <h5 class="card-title fw-semibold mb-0 lh-sm me-2">Data Transaksi Keluar Barang Jadi</h5>
                    <a href="/barangkeluarjadi" class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                        <i class="ti ti-reload fs-4"></i>
                    </a>
                </div>
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
                                                <label for="idTransaksi" class="form-label fw-semibold col-form-label ms-1">ID Transaksi :</label>
                                                <input type="text" class="form-control" id="idTransaksi" placeholder="Masukkan ID Transaksi" name="idTransaksi" value="" readonly>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="namaSupplier" class="form-label fw-semibold col-form-label ms-1">Tanggal Transaksi :</label>
                                                <input type="date" class="form-control" id="namaSupplier" placeholder="Masukkan Nama Supplier" name="namaSupplier" value="<?= date('Y-m-d') ?>">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="idBarangJadi" class="form-label fw-semibold col-form-label ms-1">Barang Jadi :</label>
                                                <select class="form-select" name="idBarangJadi" id="idBarangJadi">
                                                    <option value="">Pilih Barang Jadi</option>
                                                    <?php foreach ($barangjadi as $key) { ?>
                                                        <option value="<?= $key['idBarangJadi'] ?>"><?= $key['idBarangJadi'] . ' - ' . $key['namaBarangJadi'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah" class="form-label fw-semibold col-form-label ms-1">Jumlah :</label>
                                                <input type="number" class="form-control" id="jumlah" placeholder="Masukkan Jumlah" name="jumlah" value="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label fw-semibold col-form-label ms-1">Harga :</label>
                                                <input type="number" class="form-control" id="harga" placeholder="Masukkan Total Harga" name="harga" value="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label fw-semibold col-form-label ms-1">Keterangan :</label>
                                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5"></textarea>
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
                <table id="barangKeluarJadiTable" class="table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">ID Transaksi</th>
                            <th class="align-middle">Tanggal</th>
                            <th class="align-middle">ID Barang Jadi</th>
                            <th class="align-middle">Nama Barang Jadi</th>
                            <th class="align-middle">Jumlah</th>
                            <th class="align-middle">Harga</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barangkeluarjadi as $key => $row) : ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $row['idTransaksi']; ?></td>
                                <td><?php echo $row['tanggal']; ?></td>
                                <td><?php echo $row['idBarangJadi']; ?></td>
                                <td><?php echo $row['namaBarangJadi']; ?></td>
                                <td><?php echo $row['jumlah']; ?></td>
                                <td><?php echo format_rupiah($row['harga']); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-success btn-detail">
                                            <i class="ti ti-edit"></i>
                                            Detail
                                        </button>
                                        <button type="button" class="btn btn-sm btn-info btn-edit">
                                            <i class="ti ti-edit"></i>
                                            Update
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger btn-delete">
                                            <i class="ti ti-trash"></i>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
                                                <label for="idTransaksi" class="form-label fw-semibold col-form-label ms-1">ID Transaksi :</label>
                                                <input type="text" class="form-control" id="idTransaksi" placeholder="Masukkan ID Transaksi" name="idTransaksi" value="" readonly>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal" class="form-label fw-semibold col-form-label ms-1">Tanggal Transaksi :</label>
                                                <input type="date" class="form-control" id="tanggal" placeholder="Masukkan Nama Supplier" name="tanggal" value="<?= date('Y-m-d') ?>">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="idBarangJadi" class="form-label fw-semibold col-form-label ms-1">Barang Jadi :</label>
                                                <select class="form-select" name="idBarangJadi" id="idBarangJadi">
                                                    <option value="">Pilih Barang Jadi</option>
                                                    <?php foreach ($barangjadi as $key) { ?>
                                                        <option value="<?= $key['idBarangJadi'] ?>"><?= $key['idBarangJadi'] . ' - ' . $key['namaBarangJadi'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah" class="form-label fw-semibold col-form-label ms-1">Jumlah :</label>
                                                <input type="number" class="form-control" id="jumlah" placeholder="Masukkan Jumlah" name="jumlah" value="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label fw-semibold col-form-label ms-1">Harga :</label>
                                                <input type="number" class="form-control" id="harga" placeholder="Masukkan Jumlah" name="harga" value="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label fw-semibold col-form-label ms-1">Keterangan :</label>
                                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5"></textarea>
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
                                    <input type="hidden" id="idTransaksi" name="idTransaksi" value="">
                                    <p class="fw-medium fs-4" style="text-align: left !important; line-height: 2em !important; ">Apakah Anda yakin ingin menghapus data transaksi
                                        <span class="badge bg-primary" id="spanIdTransaksi"></span>
                                        ?
                                    </p>
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
<script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/myjs/BarangKeluarJadiTable.js"></script>
<?= $this->endSection() ?>