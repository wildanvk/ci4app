<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-center" id="logo">
      <a href="index.html" class="text-nowrap logo-img">
        <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/logos/logo.png" class="dark-logo" width="120" alt="" />
        <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/logos/logo.png" class="light-logo" width="120" alt="" />
      </a>
      <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-10"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <!-- =================== -->
        <!-- Dashboard -->
        <!-- =================== -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="/dashboard" aria-expanded="false">
            <span>
              <i class="ti ti-home"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-category-2"></i>
            </span>
            <span class="hide-menu">Data Master</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <?php if (session()->get('role') === 'Gudang' || session()->get('role') === 'Superadmin') { ?>
              <li class="sidebar-item">
                <a href="/gudang/supplier" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-users"></i>
                  </div>
                  <span class="hide-menu">Supplier</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="/gudang/barangmentah" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-assembly"></i>
                  </div>
                  <span class="hide-menu">Barang Mentah</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="/gudang/barangjadi" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-box-seam"></i>
                  </div>
                  <span class="hide-menu">Barang Jadi</span>
                </a>
              </li>
            <?php } ?>
            <?php if (session()->get('role') === 'Produksi' || session()->get('role') === 'Superadmin') { ?>
              <li class="sidebar-item">
                <a href="/produksi/datakaryawan" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-assembly"></i>
                  </div>
                  <span class="hide-menu">Data Karyawan</span>
                </a>
              </li>
              <?php if (session()->get('role') === 'Produksi' || session()->get('role') === 'Superadmin') { ?>
                <li class="sidebar-item">
                  <a href="/produksi/divisi" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-box-seam"></i>
                    </div>
                    <span class="hide-menu">Divisi</span>
                  </a>
                </li>
              <?php } ?>
            <?php } ?>
            <?php if (session()->get('role') === 'Penggajian' || session()->get('role') === 'Superadmin') { ?>
              <li class="sidebar-item">
                <a href="/penggajian/datakaryawan" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-assembly"></i>
                  </div>
                  <span class="hide-menu">Data Karyawan</span>
                </a>
              </li>
            <?php } ?>
            <?php if (session()->get('role') === 'Penjualan' || session()->get('role') === 'Superadmin') { ?>
              <li class="sidebar-item">
                <a href="/penjualan/pengiriman" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-users"></i>
                  </div>
                  <span class="hide-menu">Pengiriman</span>
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
        <?php if (session()->get('role') === 'Gudang' || session()->get('role') === 'Superadmin') { ?>
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
              <span>
                <i class="ti ti-building-warehouse"></i>
              </span>
              <span class="hide-menu">Stok</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="/gudang/stokbarangmentah" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-assembly"></i>
                  </div>
                  <span class="hide-menu">Barang Mentah</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="/gudang/stokbarangjadi" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-box-seam"></i>
                  </div>
                  <span class="hide-menu">Barang Jadi</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/gudang/barangmasukmentah" aria-expanded="false">
              <span>
                <i class="ti ti-package-import"></i>
              </span>
              <span class="hide-menu">Barang Masuk</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/gudang/barangkeluarjadi" aria-expanded="false">
              <span>
                <i class="ti ti-package-export"></i>
              </span>
              <span class="hide-menu">Barang Keluar</span>
            </a>
          </li>
        <?php  } ?>
        <?php if (session()->get('role') === 'Produksi' || session()->get('role') === 'Superadmin') { ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/produksi/permintaanproduksi" aria-expanded="false">
              <span>
                <i class="ti ti-building-warehouse"></i>
              </span>
              <span class="hide-menu">Permintaan Produksi</span>
            </a>
          </li>
          <!-- <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
              <span>
                <i class="ti ti-building-warehouse"></i>
              </span>
              <span class="hide-menu">Pembagian Produksi</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="/produksi/pembagianproduksi/pemolaanpemotongan" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-assembly"></i>
                  </div>
                  <span class="hide-menu text-wrap">Pemolaan & Pemotongan</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="/produksi/pembagianproduksi/penjahitan" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-box-seam"></i>
                  </div>
                  <span class="hide-menu">Penjahitan</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="/produksi/pembagianproduksi/finishing" class="sidebar-link">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-box-seam"></i>
                  </div>
                  <span class="hide-menu">Finishing</span>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="sidebar-item">
            <a class="sidebar-link" href="/produksi/progresproduksi" aria-expanded="false">
              <span>
                <i class="ti ti-building-warehouse"></i>
              </span>
              <span class="hide-menu">Progres Produksi</span>
            </a>
          </li>
        <?php } ?>
        <?php if (session()->get('role') === "Penggajian" || session()->get('role') === 'Superadmin') { ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/penggajian/penggajian" aria-expanded="false">
              <span>
                <i class="ti ti-brand-cashapp"></i>
              </span>
              <span class="hide-menu">Penggajian</span>
            </a>
          </li>
        <?php } ?>
        <?php if (session()->get('role') === 'Penjualan' || session()->get('role') === 'Superadmin') { ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/penjualan/transaksi" aria-expanded="false">
              <span>
                <i class="ti ti-package-import"></i>
              </span>
              <span class="hide-menu">Transaksi</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/penjualan/request" aria-expanded="false">
              <span>
                <i class="ti ti-package-import"></i>
              </span>
              <span class="hide-menu">Request</span>
            </a>
          </li>
        <?php } ?>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Laporan</span>
        </li>
        <?php if (session()->get('role') === 'Gudang' || session()->get('role') === 'Superadmin') { ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/gudang/laporan/barangmasuk" aria-expanded="false">
              <span>
                <i class="ti ti-package-import"></i>
              </span>
              <span class="hide-menu">Barang Masuk</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/gudang/laporan/barangkeluar" aria-expanded="false">
              <span>
                <i class="ti ti-package-export"></i>
              </span>
              <span class="hide-menu">Barang Keluar</span>
            </a>
          </li>
        <?php } ?>
        <?php if (session()->get('role') === 'Produksi' || session()->get('role') === 'Superadmin') { ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/produksi/riwayatproduksi" aria-expanded="false">
              <span>
                <i class="ti ti-package-import"></i>
              </span>
              <span class="hide-menu">Riwayat Produksi</span>
            </a>
          </li>
        <?php } ?>
        <?php if (session()->get('role') === 'Penggajian' || session()->get('role') === 'Superadmin') { ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/penggajian/laporan" aria-expanded="false">
              <span>
                <i class="ti ti-report"></i>
              </span>
              <span class="hide-menu">Penggajian</span>
            </a>
          </li>
        <?php } ?>
        <?php if (session()->get('role') === 'Penjualan' || session()->get('role') === 'Superadmin') { ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/penjualan/laporan" aria-expanded="false">
              <span>
                <i class="ti ti-package-import"></i>
              </span>
              <span class="hide-menu">Pengiriman</span>
            </a>
          </li>
        <?php } ?>

      </ul>
      <div>
        <a href="/logout" class="btn btn-outline-primary w-100" id="logoutButton">
          Logout
        </a>
      </div>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>