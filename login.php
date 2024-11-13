<?php
session_start(); // Pastikan session dimulai
include 'koneksi.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    // Gunakan prepared statement untuk menghindari SQL Injection
    $stmt = $koneksi->prepare("SELECT * FROM user WHERE username=? AND password=? AND role=?");
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION['user'] = $data;
        $_SESSION['role'] = $data['role'];

        // Kode alert dan redirect setelah login berhasil
        echo '<script>alert("Anda memiliki akses ke halaman ini, Jangan Lupa Logout");';
        
        // Redirect berdasarkan role
        if ($_SESSION['role'] == 'admin') {
            echo 'location.href="index.php";';
        } elseif ($_SESSION['role'] == 'petugas') {
            echo 'location.href="index.php";';
        } else {
            echo 'location.href="user.php";';
        }
        echo '</script>';
        exit(); // Keluar setelah menampilkan alert dan redirect
    } else {
        echo '<script>alert("Username/Password Salah.");</script>';
    }

    $stmt->close(); // Tutup prepared statement
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Aplikasi Kasir</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="assets/img" href="assets/img/logo-bn666.png">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container bg-primary shadow-lg ">
                        <div class="row justify-content-center">
                        <div class="col-lg-7 mt-start text-center text-primary text-lg-start">
                            <h1 class="display-4 fw-bold lh-1 mt-5 text-light mb-4"> Sebelum Masuk, Login Terlebih Dahulu </h1>
                            <p class="col-lg-10 text-light fs-4">Untuk memaksimalkan pengalaman Anda, ayo segera login ke akun Anda dan nikmati berbagai fitur serta layanan eksklusif yang kami tawarkan!       </p>
                            <form action="welcome.php" method="post">
        <button type="submit" class="btn btn-outline-light btn-lg px-4">Kembali</button>
      </form>
                        </div>
                            <div class="col-lg-5 mb-6">
                                
                            <div class="card shadow-lg border-0 rounded-lg shadow-lg mt-5">
    <div class="card-body">
        <form method="post" action="login.php"> <!-- Pastikan action menuju ke file login -->
            <div class="form-floating mb-3">
                <input class="form-control" id="inputEmail" type="text" name="username" placeholder="Masukan Username" required />
                <label for="inputEmail">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Masukan Password" required />
                <label for="inputPassword">Password</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="role" aria-label="Default select example" required>
                    <option value="" selected disabled>Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
            </div>
            
            <div class="d-flex align-items-center justify-content-between mt-4 mb-4">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
            <a href="index.html" class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Login with Google
            </a>
            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
            </a>
        </form>
    </div>
    <div class="card-footer text-center py-3">
        <div class="small"><a href="register.php">Belum Punya Akunmu? Register!</a></div>
    </div>
</div>


            <div id="layoutAuthentication_footer bg-primary">
                <footer class="py-4 bg-primary mt-auto">
                    <div class="container-fluid  px-4">
                        <div class="d-flex align-items-center justify-content-between bg-primary small">
                            <div class="text">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
