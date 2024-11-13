<div class="body">
<div class="container-fluid px-4">
<link href="css/ww.css" rel="stylesheet" />
                        <h1 style="mt-6">Selamat datang, <?php echo $_SESSION['user']['username']; ?>!</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk")); ?> Total Produk</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="produk_user.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM penjualan")); ?> Pembelian</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="pembelian_user.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<style>
body {
  background-image: url('assets/img/gedung.jpg'); /* Ganti dengan path gambar Anda */
  background-size: cover; /* Menutupi seluruh area dengan gambar */
  background-position: center; /* Menempatkan gambar di tengah */
  background-repeat: no-repeat; /* Menghindari pengulangan gambar */
  height: 100vh; /* Memastikan body mengambil seluruh tinggi layar */
  margin: 0; /* Menghilangkan margin default */
}

</style>