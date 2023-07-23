<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Jun 2023 10:34:23 GMT -->

<head>
  <!--  Title -->
  <title>Sistem Informasi Gudang | Login</title>
  <!--  Required Meta Tag -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Mordenize" />
  <meta name="author" content="" />
  <meta name="keywords" content="Mordenize" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--  Favicon -->
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/logos/favicon.png" />
  <!-- Core Css -->
  <link id="themeColors" rel="stylesheet" href="<?php echo base_url('modernize-bootstrap'); ?>/dist/css/<?= session()->get('mode') == 'light' ? 'style.min.css' : 'style-dark.min.css' ?>" />
</head>

<body>
  <!-- Preloader -->
  <?= $this->include('modernize/_partials/preloader') ?>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="index.html" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                  <img src="<?php echo base_url('modernize-bootstrap'); ?>/dist/images/logos/logo.png" width="120" alt="">
                </a>
                <?php if (session()->getFlashdata('logout')) { ?>
                  <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong><?= session()->getFlashdata('logout') ?></strong>
                  </div>
                <?php } ?>
                <?php if (session()->getFlashdata('pesan')) { ?>
                  <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?= session()->getFlashdata('pesan') ?>
                  </div>
                <?php } ?>
                <form action="/auth" method="post">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked">
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Ingat Akun ini
                      </label>
                    </div>
                    <a class="text-primary fw-medium" href="authentication-forgot-password.html">Lupa Password?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Masuk</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-medium">Belum punya akun?</p>
                    <a class="text-primary fs-4 fw-medium ms-2" href="authentication-register.html">Daftar Akun</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--  Import Js Files -->
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--  core files -->
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/app.min.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/app.init.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/app-style-switcher.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/sidebarmenu.js"></script>

  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/custom.js"></script>
</body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Jun 2023 10:34:23 GMT -->

</html>