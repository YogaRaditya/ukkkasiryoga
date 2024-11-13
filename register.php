<?php
include 'koneksi.php';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $role = $_POST['role'];

    // Validasi input
    if (empty($username) || empty($password) || empty($nama) || empty($role)) {
        echo '<script>alert("Semua field harus diisi!");</script>';
    } else {
        // Gunakan prepared statement
        $stmt = $koneksi->prepare("INSERT INTO user (nama, username, password, role) VALUES (?, ?, ?, ?)");
        
        if (!$stmt) {
            die("Prepare failed: " . $koneksi->error); // Tampilkan pesan kesalahan
        }
        
        $stmt->bind_param("ssss", $nama, $username, $password, $role);
        
        // Eksekusi dan cek hasil
        if ($stmt->execute()) {
            echo '<script>alert("Registrasi Berhasil"); location.href="login.php";</script>';
        } else {
            echo '<script>alert("Registrasi Gagal: ' . $stmt->error . '");</script>';
        }

        $stmt->close(); // Tutup prepared statement
    }
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
    <title>Registrasi Aplikasi Kasir</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="assets/img" href="assets/img/logo-bn666.png">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container bg-primary">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Registrasi Aplikasi Kasir</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputName" type="text" name="nama" placeholder="Masukan Nama Lengkap" required />
                                            <label for="inputName">Nama Lengkap</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="text" name="username" placeholder="Masukan Username" required />
                                            <label for="inputEmail">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Masukan Password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputConfirmPassword" type="password" name="confirm_password" placeholder="Konfirmasi Password" required />
                                            <label for="inputConfirmPassword">Konfirmasi Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="role" aria-label="Default select example" required>
                                                <option value="" selected disabled>Pilih Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="petugas">Petugas</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary w-100">Registrasi</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Sudah Punya Akunmu? Login!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-primary mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-light">Copyright &copy; Your Website 2023</div>
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
