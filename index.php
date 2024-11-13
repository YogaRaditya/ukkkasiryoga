<?php
    // include "koneksi.php";
    // if(!isset($_SESSION['user'])) {
    //     header('location:login.php');
    // }
    // // Contoh untuk admin_dashboard.php
    session_start(); // Pastikan sesi dimulai
    include "koneksi.php";
    
    // Cek apakah pengguna terdaftar dan role adalah 'admin', 'petugas', atau 'user'
    if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'petugas', 'user'])) {
        header("location: login.php"); // Redirect jika bukan admin, petugas, atau user
        exit();
    }
    
    // Konten halaman admin, petugas, atau user
    ?>
    
  


    



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Aplikasi Kasir Baknus 666</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="assets/img" href="assets/img/logo-bn666.png">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark shadow-lg bg-primary">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-1" href="">Aplikasi Kasir Baknus 666  </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-2 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="search.php" method="GET">
    <div class="input-group">
        <input class="form-control" type="text" name="query" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
    </div>
</form>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 shadow-lg bg-primary me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="welcome.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark shadow-lg bg-primary" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <h1 class="sb-sidenav-menu-heading text-center text-light custom-spacing fs-5">N A V I G A S I</h1>
                            <hr class="text-light">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-house-door-fill text-light"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="?page=pelanggan">
                                <div class="sb-nav-link-icon"><i class="fas fa-users  text-light"></i></div>
                                Pelanggan
                            </a>
                            <a class="nav-link" href="?page=produk">
                                <div class="sb-nav-link-icon"><i class="bi bi-bag-check-fill  text-light"></i></div>
                                Barang
                            </a>
                            <!-- <a class="nav-link" href="?page=pembelian">
                                <div class="sb-nav-link-icon"><i class="bi bi-cart-check-fill  text-light"></i></div>
                                Pembelian
                            </a> -->
                            <a class="nav-link" href="?page=laporan">
                                <div class="sb-nav-link-icon"><i class="bi bi-clipboard2-data-fill  text-light"></i></div>
                                Laporan
                            </a>
                            <a class="nav-link" href="welcome.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-left  text-light"></i></div>
                                Logout
                            </a>
                        

                        </div>
                    </div>
                    <div class="sb-sidenav-footer bg-primary">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['user']['nama']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <?php
                        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                        include $page . '.php';
                    ?>

                </main>
                <div class="">
  <!-- Footer -->
  <footer
          class="text-center text-lg-start bg- text-white"
          style="background-color: #0d6efd"
          >
    <!-- Grid container -->
    
      <!-- Section: Links -->

      <hr class="my-3">

      <!-- Section: Copyright -->
      <section class="p-3 bg-primary  pt-0">
        <div class="row d-flex align-items-center">
          <!-- Grid column -->
          <div class="col-md-7 col-lg-8 text-center text-md-start">
            <!-- Copyright -->
            <div class="p-3">
              © 2024 Copyright:
              <a class="text-white" href="https://github.com/baknus666"
                 >YogaWebsite.com and github.com/YogaRaditya</a
                >
            </div>
            <!-- Copyright -->
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
          <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
        <!-- Facebook -->
        <a href="https://www.facebook.com/Smkbn666/?locale=id_ID" class="btn btn-outline-light btn-floating m-1" role="button">
            <i class="fab fa-facebook-f"></i>
        </a>

        <!-- Twitter -->
        <a href="https://www.tiktok.com/@smkbaktinusantara666" class="btn btn-outline-light btn-floating m-1" role="button">
        <i class="bi bi-tiktok"></i>
        </a>

        <!-- Google -->
        <a href="https://smkbn666.sch.id/" class="btn btn-outline-light btn-floating m-1" role="button">
            <i class="fab fa-google"></i>
        </a>

        <!-- Instagram -->
        <a href="https://www.instagram.com/smkbaktinusantara666/" class="btn btn-outline-light btn-floating m-1" role="button">
    <i class="fab fa-instagram"></i>
        </a>

    </div>
          <!-- Grid column -->
        </div>
      </section>
      <!-- Section: Copyright -->
    </div>
    <!-- Grid container -->
  </footer>
  <!-- Footer -->
</div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
