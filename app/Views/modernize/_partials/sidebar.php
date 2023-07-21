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
            <li class="sidebar-item">
              <a href="/supplier" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-users"></i>
                </div>
                <span class="hide-menu">Supplier</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/barangmentah" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-assembly"></i>
                </div>
                <span class="hide-menu">Barang Mentah</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/barangjadi" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-box-seam"></i>
                </div>
                <span class="hide-menu">Barang Jadi</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span>
              <i class="ti ti-building-warehouse"></i>
            </span>
            <span class="hide-menu">Stok</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="/stokbarangmentah" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-assembly"></i>
                </div>
                <span class="hide-menu">Barang Mentah</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/stokbarangjadi" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-box-seam"></i>
                </div>
                <span class="hide-menu">Barang Jadi</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- <li class="sidebar-item">
          <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
            <span>
              <i class="ti ti-packages"></i>
            </span>
            <span class="hide-menu">Transaksi</span>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="/produksi" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-assembly"></i>
                </div>
                <span class="hide-menu">Produksi</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/permintaan" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                  <i class="ti ti-box-seam"></i>
                </div>
                <span class="hide-menu">Permintaan</span>
              </a>
            </li>
          </ul>
        </li> -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="/barangmasukmentah" aria-expanded="false">
            <span>
              <i class="ti ti-package-import"></i>
            </span>
            <span class="hide-menu">Barang Masuk</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/barangkeluarjadi" aria-expanded="false">
            <span>
              <i class="ti ti-package-export"></i>
            </span>
            <span class="hide-menu">Barang Keluar</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Laporan</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/laporan/barangmasuk" aria-expanded="false">
            <span>
              <i class="ti ti-package-import"></i>
            </span>
            <span class="hide-menu">Barang Masuk</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/laporan/barangkeluar" aria-expanded="false">
            <span>
              <i class="ti ti-package-export"></i>
            </span>
            <span class="hide-menu">Barang Keluar</span>
          </a>
        </li>
      </ul>
      <div>
        <a href="/auth/logout" class="btn btn-outline-primary w-100" id="logoutButton">
          Logout
        </a>
      </div>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>