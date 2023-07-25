<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Jun 2023 10:34:23 GMT -->

<head>
  <!--  Title -->
  <title>Sistem Enterprise | Login</title>
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

  <!-- Tabler Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

  <!-- Prism Js -->
  <link rel="stylesheet" href="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/prismjs/themes/prism.min.css">

  <!-- Datatable -->
  <link rel="stylesheet" href="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">

  <!-- SweetAlet2 Dark -->
  <!-- <?= session()->get('mode') == 'dark' ?  '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />' : '' ?> -->

  <!-- DateRangePicker -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  <!-- Owl Carousel  -->
  <link rel="stylesheet" href="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/owl.carousel/dist/assets/owl.carousel.min.css" />

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
                <form action="/auth" method="post">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Masuk</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-medium">Belum punya akun?</p>
                    <a class="text-primary fs-4 fw-medium ms-2" href="/register">Daftar Akun</a>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--  core files -->
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/app.min.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/app.init.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/app-style-switcher.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/sidebarmenu.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/custom.js"></script>
  <!--  page js files -->
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="<?php echo base_url('modernize-bootstrap'); ?>/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('modernize-bootstrap'); ?>/dist/js/myjs/myJS.js"></script>

  <script>
    <?php if (session()->getFlashdata('access_forbidden')) : ?>
      Swal.fire({
        title: 'Access Forbidden',
        text: 'Harap lakukan login terlebih dahulu!',
        icon: 'error',
        confirmButtonText: 'Ok'
      });
    <?php endif; ?>

    <?php if (session()->getFlashdata('logout')) : ?>
      const Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
      });

      Toast.fire({
        icon: "success",
        title: "Anda berhasil logout!",
      });
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan')) { ?>
      Swal.fire({
        title: 'Login Gagal',
        text: '<?= session()->getFlashdata('pesan') ?>',
        icon: 'error',
        confirmButtonText: 'Ok'
      })
    <?php } ?>
  </script>
</body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Jun 2023 10:34:23 GMT -->

</html>