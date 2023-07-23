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
        <a href="/Transaksi/input" class="btn btn-primary font-medium">
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
                                    <a href="<?php echo base_url('Transaksi/edit/' . $row['id_transaksi']); ?>" class="btn btn-sm btn-info">
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
                                                <a href="<?php echo base_url('Transaksi/delete/' . $row['id_transaksi']); ?>" class="btn btn-light-danger text-danger font-medium">
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
<!-- <div class="card w-100 position-relative overflow-hidden">
    <div class="card-body p-4">
        <div class="table-responsive rounded-2 mb-4">
            <table class="table border text-nowrap customize-table mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">User</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Project Name</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Team</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Budget</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Sunil Joshi</h6>
                                    <span class="fw-normal">Web Designer</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">Elite Admin</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#" class="bg-secondary text-white fs-6 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center" style="width: 39px; height: 39px;">
                                    S
                                </a>
                                <a href="#" class="bg-danger text-white fs-6 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center" style="width: 39px; height: 39px;">
                                    D
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-success text-success fw-semibold fs-2">Active</span>
                        </td>
                        <td>
                            <h6 class="fs-4 fw-semibold mb-0">$3.9k</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-2.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Andrew McDownland</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">Real Homes WP Theme</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#" class="bg-primary text-white fs-6 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center" style="width: 39px; height: 39px;">
                                    A
                                </a>
                                <a href="#" class="bg-warning text-white fs-6 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center" style="width: 39px; height: 39px;">
                                    X
                                </a>
                                <a href="#" class="bg-secondary text-white fs-6 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center" style="width: 39px; height: 39px;">
                                    N
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-warning text-warning fw-semibold fs-2">Pending</span>
                        </td>
                        <td>
                            <h6 class="fs-4 fw-semibold mb-0">$24.5k</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-3.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Christopher Jamil</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">MedicalPro WP Theme</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#" class="bg-danger text-white fs-6 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center" style="width: 39px; height: 39px;">
                                    X
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-primary text-primary fw-semibold fs-2">Completed</span>
                        </td>
                        <td>
                            <h6 class="fs-4 fw-semibold mb-0">$12.8k</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-4.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Nirav Joshi</h6>
                                    <span class="fw-normal">Frontend Engineer</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">Hosting Press HTML</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#" class="bg-primary text-white fs-6 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center" style="width: 39px; height: 39px;">
                                    Y
                                </a>
                                <a href="#" class="bg-danger text-white fs-6 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center" style="width: 39px; height: 39px;">
                                    X
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-success text-success fw-semibold fs-2">Active</span>
                        </td>
                        <td>
                            <h6 class="fs-4 fw-semibold mb-0">$2.4k</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-5.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Micheal Doe</h6>
                                    <span class="fw-normal">Content Writer</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">Hosting Press HTML</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#" class="bg-secondary text-white fs-6 rounded-circle me-n2 card-hover border border-2 border-white d-flex align-items-center justify-content-center" style="width: 39px; height: 39px;">
                                    S
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-danger text-danger fw-semibold fs-2">Cancel</span>
                        </td>
                        <td>
                            <h6 class="fs-4 fw-semibold mb-0">$9.3k</h6>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive rounded-2 mb-4">
            <table class="table border text-nowrap customize-table mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">User</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Project Name</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Users</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Olivia Rhye</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">Xtreme admin</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-1.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-2.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-primary rounded-3 py-8 text-primary fw-semibold fs-2">active</span>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-2.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Barbara Steele</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">Adminpro admin</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-1.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-2.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-3.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-danger rounded-3 py-8 text-danger fw-semibold fs-2">cancel</span>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-3.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Leonard Gordon</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">Monster admin</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-3.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-2.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-primary rounded-3 py-8 text-primary fw-semibold fs-2">active</span>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-4.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Evelyn Pope</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">Materialpro admin</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-3.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-2.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-5.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-success rounded-3 py-8 text-success fw-semibold fs-2">pending</span>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-5.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Tommy Garza</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">Elegant admin</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-5.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-6.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-danger rounded-3 py-8 text-danger fw-semibold fs-2">cancel</span>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-6.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Isabel Vasquez</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">Modernize admin</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-2.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-4.jpg" class="rounded-circle me-n2 card-hover border border-2 border-white" width="39" height="39">
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-success rounded-3 py-8 text-success fw-semibold fs-2">pending</span>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive rounded-2 mb-4">
            <table class="table border text-nowrap customize-table mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Customer</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Email Address</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Teams</h6>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Olivia Rhye</h6>
                                    <span class="fw-normal">@rhye</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-success text-success fw-semibold fs-2 gap-1 d-inline-flex align-items-center"><i class="ti ti-circle fs-3"></i>active</span>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">olivia@ui.com</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary rounded-3 fw-semibold fs-2">Design</span>
                                <span class="badge bg-secondary rounded-3 fw-semibold fs-2">Product</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-2.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Barbara Steele</h6>
                                    <span class="fw-normal">@steele</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark fw-semibold fs-2 gap-1 d-inline-flex align-items-center"><i class="ti ti-clock-hour-4 fs-3"></i>offline</span>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">steele@ui.com</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-secondary rounded-3 fw-semibold fs-2">Product</span>
                                <span class="badge bg-danger rounded-3 fw-semibold fs-2">Operations</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-3.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Leonard Gordon</h6>
                                    <span class="fw-normal">@gordon</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-success text-success fw-semibold fs-2 gap-1 d-inline-flex align-items-center"><i class="ti ti-circle fs-3"></i>active</span>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">olivia@ui.com</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary rounded-3 fw-semibold fs-2">Finance</span>
                                <span class="badge bg-success rounded-3 fw-semibold fs-2">Customer Success</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-4.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Evelyn Pope</h6>
                                    <span class="fw-normal">@pope</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark fw-semibold fs-2 gap-1 d-inline-flex align-items-center"><i class="ti ti-clock-hour-4 fs-3"></i>offline</span>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">steele@ui.com</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-danger rounded-3 fw-semibold fs-2">Operations</span>
                                <span class="badge bg-primary rounded-3 fw-semibold fs-2">Design</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-5.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Tommy Garza</h6>
                                    <span class="fw-normal">@garza</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-success text-success fw-semibold fs-2 gap-1 d-inline-flex align-items-center"><i class="ti ti-circle fs-3"></i>active</span>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">olivia@ui.com</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-secondary rounded-3 fw-semibold fs-2">Product</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-6.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Isabel Vasquez</h6>
                                    <span class="fw-normal">@vasquez</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-success text-success fw-semibold fs-2 gap-1 d-inline-flex align-items-center"><i class="ti ti-circle fs-3"></i>active</span>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">steele@ui.com</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success rounded-3 fw-semibold fs-2">Customer Success</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive rounded-2 mb-4">
            <table class="table border text-nowrap customize-table mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Invoice</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Customer</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Progress</h6>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h6 class="fw-semibold mb-0">INV-3066</h6>
                        </td>
                        <td>
                            <span class="badge bg-light-primary rounded-3 py-2 text-primary fw-semibold fs-2 d-inline-flex align-items-center gap-1"><i class="ti ti-check fs-4"></i>paid</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Olivia Rhye</h6>
                                    <span class="fw-normal">olivia@ui.com</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="progress bg-light w-100" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" aria-label="Example 4px high" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-normal">60%</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 class="fw-semibold mb-0">INV-3067</h6>
                        </td>
                        <td>
                            <span class="badge bg-light-danger rounded-3 py-2 text-danger fw-semibold fs-2 d-inline-flex align-items-center gap-1"><i class="ti ti-x fs-4"></i>cancelled</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-2.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Barbara Steele</h6>
                                    <span class="fw-normal">steele@ui.com</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="progress bg-light w-100" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" aria-label="Example 4px high" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-normal">30%</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 class="fw-semibold mb-0">INV-3068</h6>
                        </td>
                        <td>
                            <span class="badge bg-light-primary rounded-3 py-2 text-primary fw-semibold fs-2 d-inline-flex align-items-center gap-1"><i class="ti ti-check fs-4"></i>paid</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-3.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Leonard Gordon</h6>
                                    <span class="fw-normal">olivia@ui.com</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="progress bg-light w-100" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" aria-label="Example 4px high" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-normal">45%</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 class="fw-semibold mb-0">INV-3069</h6>
                        </td>
                        <td>
                            <span class="badge bg-light-secondary rounded-3 py-2 text-secondary fw-semibold fs-2 d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-back-up fs-4"></i>refunded</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-4.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Evelyn Pope</h6>
                                    <span class="fw-normal">teele@ui.com</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="progress bg-light w-100" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" aria-label="Example 4px high" style="width: 37%;" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-normal">37%</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 class="fw-semibold mb-0">INV-3070</h6>
                        </td>
                        <td>
                            <span class="badge bg-light-danger rounded-3 py-2 text-danger fw-semibold fs-2 d-inline-flex align-items-center gap-1"><i class="ti ti-x fs-4"></i>cancelled</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-5.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Tommy Garza</h6>
                                    <span class="fw-normal">olivia@ui.com</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="progress bg-light w-100" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" aria-label="Example 4px high" style="width: 87%;" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-normal">87%</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 class="fw-semibold mb-0">INV-3071</h6>
                        </td>
                        <td>
                            <span class="badge bg-light-primary rounded-3 py-2 text-primary fw-semibold fs-2 d-inline-flex align-items-center gap-1"><i class="ti ti-check fs-4"></i>paid</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/profile/user-6.jpg" class="rounded-circle" width="40" height="40" />
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">Isabel Vasquez</h6>
                                    <span class="fw-normal">olivia@ui.com</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="progress bg-light w-100" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" aria-label="Example 4px high" style="width: 32%;" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-normal">32%</span>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive rounded-2">
            <table class="table border text-nowrap customize-table mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Authors</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Courses</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Users</h6>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/blog/blog-img1.jpg" class="rounded-2" width="42" height="42" />
                                <div class="ms-3">
                                    <h6 class="fw-semibold mb-1">Top Authors</h6>
                                    <span class="fw-normal">Successful Fellas</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-light-danger text-danger rounded-3 fw-semibold fs-2">Angular</span>
                                <span class="badge bg-light-primary text-primary rounded-3 fw-semibold fs-2">PHP</span>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">4300 Users</p>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/blog/blog-img2.jpg" class="rounded-2" width="42" height="42" />
                                <div class="ms-3">
                                    <h6 class="fw-semibold mb-1">Popular Authors</h6>
                                    <span class="fw-normal">Most Successful</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-light-primary text-primary rounded-3 fw-semibold fs-2">Bootstrap</span>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">1200 Users</p>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/blog/blog-img3.jpg" class="rounded-2" width="42" height="42" />
                                <div class="ms-3">
                                    <h6 class="fw-semibold mb-1">New Users</h6>
                                    <span class="fw-normal">Awesome Users</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-light-success text-success rounded-3 fw-semibold fs-2">Reactjs</span>
                                <span class="badge bg-light-danger text-danger rounded-3 fw-semibold fs-2">Angular</span>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">2000 Users</p>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/blog/blog-img4.jpg" class="rounded-2" width="42" height="42" />
                                <div class="ms-3">
                                    <h6 class="fw-semibold mb-1">Active Customers</h6>
                                    <span class="fw-normal">Best Customers</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-light-primary text-primary rounded-3 fw-semibold fs-2">Bootstrap</span>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">1500 Users</p>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/blog/blog-img5.jpg" class="rounded-2" width="42" height="42" />
                                <div class="ms-3">
                                    <h6 class="fw-semibold mb-1">Bestseller Theme</h6>
                                    <span class="fw-normal">Amazing Templates</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-light-danger text-danger rounded-3 fw-semibold fs-2">Angular</span>
                                <span class="badge bg-light-success text-success rounded-3 fw-semibold fs-2">Reactjs</span>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal">9500 Users</p>
                        </td>
                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> -->
<?= $this->endSection() ?>