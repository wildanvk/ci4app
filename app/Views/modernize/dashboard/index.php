<?= $this->extend('modernize/_partials/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <!--  Owl carousel -->
  <div class="owl-carousel counter-carousel owl-theme">
    <div class="item">
      <div class="card border-0 zoom-in bg-light-primary shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/svgs/supplier.png" class="mb-3 mx-auto" alt="" style="width: 50px !important;" />
            <p class="fw-semibold fs-3 text-primary mb-1">Supplier</p>
            <h5 class="fw-semibold text-primary mb-0"><?= $supplier ?></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="card border-0 zoom-in bg-light-primary shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/svgs/barang.png" class="mb-3 mx-auto" alt="" style="width: 50px !important;" />
            <p class="fw-semibold fs-3 text-info mb-1">Barang Mentah</p>
            <h5 class="fw-semibold text-info mb-0"><?= $barangmentah ?></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="card border-0 zoom-in bg-light-primary shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/svgs/barang.png" class="mb-3 mx-auto" alt="" style="width: 50px !important;" />
            <p class="fw-semibold fs-3 text-info mb-1">Barang Jadi</p>
            <h5 class="fw-semibold text-info mb-0"><?= $barangjadi ?></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="card border-0 zoom-in bg-light-warning shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/svgs/stok.png" class="mb-3 mx-auto" alt="" style="width: 50px !important;" />
            <p class="fw-semibold fs-3 text-warning mb-1">Stok Barang Mentah</p>
            <h5 class="fw-semibold text-warning mb-0"><?= $stokbarangmentah['stok'] ?></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="card border-0 zoom-in bg-light-warning shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/svgs/stok.png" class="mb-3 mx-auto" alt="" style="width: 50px !important;" />
            <p class="fw-semibold fs-3 text-warning mb-1">Stok Barang Jadi</p>
            <h5 class="fw-semibold text-warning mb-0"><?= $stokbarangjadi['stok'] ?></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="card border-0 zoom-in bg-light-success shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/svgs/barang-keluar.png" class="mb-3 mx-auto" alt="" style="width: 50px !important;" />
            <p class="fw-semibold fs-3 text-success mb-1">Transaksi Masuk</p>
            <h5 class="fw-semibold text-success mb-0"><?= $barangmasukmentah ?></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="card border-0 zoom-in bg-light-danger shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/svgs/barang-masuk.png" class="mb-3 mx-auto" alt="" style="width: 50px !important;" />
            <p class="fw-semibold fs-3 text-danger mb-1">Transaksi Keluar</p>
            <h5 class="fw-semibold text-danger mb-0"><?= $barangkeluarjadi ?></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  Row 1 -->
  <div class="row">
    <div class="col-lg-4 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body">
          <div>
            <h5 class="card-title fw-semibold mb-1">Jumlah Transaksi</h5>
            <p class="card-subtitle mb-0">Per bulan</p>
            <div id="jumlahTransaksi" class="mb-7 pb-8"></div>
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="bg-light-primary rounded me-8 p-8 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-primary fs-6"></i>
                </div>
                <div>
                  <p class="fs-3 mb-0 fw-normal">Transaksi Masuk</p>
                  <h6 class="fw-semibold text-dark fs-4 mb-0">
                    <?= $barangmasukmentah ?>
                  </h6>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="bg-light-warning rounded me-8 p-8 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-warning fs-6"></i>
                </div>
                <div>
                  <p class="fs-3 mb-0 fw-normal">Transaksi Keluar</p>
                  <h6 class="fw-semibold text-dark fs-4 mb-0">
                    <?= $barangkeluarjadi ?>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body">
          <div>
            <h5 class="card-title fw-semibold mb-1">Jumlah Barang</h5>
            <p class="card-subtitle mb-0">Per bulan</p>
            <div id="jumlahBarang" class="mb-7 pb-8"></div>
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="bg-light-primary rounded me-8 p-8 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-primary fs-6"></i>
                </div>
                <div>
                  <p class="fs-3 mb-0 fw-normal">Barang Masuk</p>
                  <h6 class="fw-semibold text-dark fs-4 mb-0">
                    <?= $sumbarangmasuk['jumlah'] ?>
                  </h6>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="bg-light-warning rounded me-8 p-8 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-warning fs-6"></i>
                </div>
                <div>
                  <p class="fs-3 mb-0 fw-normal">Barang Keluar</p>
                  <h6 class="fw-semibold text-dark fs-4 mb-0">
                    <?= $sumbarangkeluar['jumlah'] ?>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-12">
          <!-- Stok Barang -->
          <div class="card overflow-hidden">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold">
                    Stok Barang
                  </h5>
                  <h4 class="fw-semibold mb-3"><?= $totalstok ?></h4>
                  <div class="d-flex align-items-center">
                    <div class="me-4">
                      <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                      <span class="fs-2">Barang Mentah</span>
                    </div>
                    <div>
                      <span class="round-8 bg-success rounded-circle me-2 d-inline-block"></span>
                      <span class="fs-2">Barang Jadi</span>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-center">
                    <div id="stok"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-6 col-sm-12">
          <!-- Pengeluaran -->
          <div class="card">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold">
                    Pengeluaran Bulan Ini
                  </h5>
                  <h4 class="fw-semibold mb-3"><?= $pengeluaranbulanini ?></h4>
                  <div class="d-flex align-items-center pb-5">
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-currency-dollar fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="pengeluaran"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection() ?>

  <?= $this->section('javascript') ?>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/MyDashboard.js"></script>
  <?= $this->endSection() ?>