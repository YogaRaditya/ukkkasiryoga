<?php
include 'db.php'; // Pastikan Anda memiliki koneksi database di sini

    if(isset($_POST['username'])) {

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $cek = mysqli_query($koneksi, "SELECT*FROM user WHERE username='$username' AND  password='$password'");

        if(mysqli_num_rows($cek) > 0 ) {
            $data = mysqli_fetch_array($cek);
            $_SESSION['user'] = $data;
            echo '<script>alert("Selamat Datang, jangan Lupa Logout"); location.href="index.php"</script>';
        }else{
            echo '<script>alert("Username/Password Salah.");</script>';
        }
    }
?>
<style>
  .body {
    background-color: white !important; /* Atau warna lain yang diinginkan */
}
</style>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/ww.css" rel="stylesheet">

    <link rel="css/stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="assets/img" href="assets/img/logo-bn666.png">
    <link href="css/comment.css" rel="stylesheet">
    
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

<!-- font awesome style -->
<link href="css/font-awesome.min.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="css/stylee.css" rel="stylesheet" />
<!-- responsive style -->
<link href="css/responsive.css" rel="stylesheet" />



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Aplikasi Kasir Baknus 666</title>
  </head>
  <body class="body">
    <div class="header">
    <header class="header  navbar navbar-dark bg-primary p-3 bg-primary text-center text-white">
    <div class="text-center"><br>
        <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-lg-0 text-white ">
                <img src="assets/img/bento.png" class="mt-start" width="300">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <div style="text-align: center;">
                <span class="fw-bold me-4 mb-4 fs-4">APLIKASI KASIR BAKTI NUSANTARA 666</span>
            </div>

            <form class="col-12 me-start col-lg-auto mx-5 me-4 md-4 mb-4 me-lg-3 ml-2">
                <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
            </form>

            <div class="md-4 mb-4">
                <form action="login.php" method="post">
                    <button type="submit" class="btn btn-outline-light ry me-2">Login</button>
                </form>
            </div>

            <div class=" mb-4">
                <form action="register.php" method="post">
                    <button type="submit" class="btn btn-outline-light ry me-2">Registrasi</button>
                </form>
            </div>
        </div>
        <hr class="text-light">
    </div>
</header>
 
  <div class="">
  <header class=" bg-light d-flex flex-wrap justify-content-center border-bottom border-primary">
      <a href="/" class="d-flex align-items-center mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="gedung.jpg" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="display-5 text-primary fw-bold me-4 fs-4">KASIR PINTAR 666</span>
        <!-- <span class="display-5 fw-bold fs-4">APLIKASI KASIR BAKNUS 666</span> -->
      </a>

      <div class=" text-center">
      <ul class="nav nav-pills text-primary">
        <li class="nav-item me-4"><a href="#" class="nav-link">Home</a></li>
        <li class="nav-item me-4"><a href="#" class="nav-link">Tentang Kami</a></li>
        <li class="nav-item me-4"><a href="#tentang-kami" class="nav-link">Fitur Website</a></li>
        <li class="nav-item me-4"><a href="#registrasi" class="nav-link">Registrasi</a></li>
        <li class="nav-item me-4"><a href="#komentar" class="nav-link">Komentar</a></li>
        <li class="nav-item me-4"><a href="#contact" class="nav-link">Kontak</a></li>
      </ul>
    </header>
  </div>
  </div>
    </div>
  

    <section id="home">
    <div class="">
  <div class="text-center">
    <img class="d-block mx-auto mb-4" src="assets/img/cashier.jpg">
    <h1 class="display-5 fw-bold">Aplikasi kasir Baknus 666</h1>
    <div class="col-lg-6 mb-4 mx-auto">
      <h6 class="lead mb-4">"Aplikasi Kasir Baknus 666 adalah solusi kasir terdepan yang menggabungkan kemudahan penggunaan, fitur lengkap, dan sistem yang aman untuk memudahkan manajemen transaksi bisnis Anda. aplikasi ini memungkinkan Anda untuk mengelola penjualan, stok barang, dan laporan keuangan secara real-time, menjadikannya alat yang sangat efektif dan efisien bagi bisnis dari berbagai skala. Dilengkapi dengan Baknus 666 siap mendukung kesuksesan bisnis Anda, memberikan pengalaman transaksi yang lancar dan terpercaya."</h6>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
      <form action="login.php" method="post">
        <button type="submit" class="btn btn-primary btn-lg px-4 gap-3">Coba Website Sekarang</button>
      </form>
      <form action="register.php" method="post">
        <button type="submit" class="btn btn-outline-secondary btn-lg px-4">Registrasi Dulu</button>
      </form>
      </div>
    </div>
  </div>
</div><br><br><br><br><br><br>
    </section>
  

    
    <section id="tentang-kami">
<div class=" container d-block mx-auto mt-4 px-4 py-5" id="featured-3">
    <h2 class="pb-2 display-5 fw-bold border-bottom border-primary">Fitur Yang Anda Butuhkan</h2>
    <div class="row g-4 g-primary py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <button type="button" class="btn btn-primary me-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add me-2" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"></path>
  <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"></path>
</svg >      Pelanggan</button>
        <h2>Jadi Pelanggan Kami</h2>
        <p>"Pelanggan adalah individu atau pihak yang menggunakan produk atau layanan yang ditawarkan, yang berperan penting dalam kesuksesan dan pertumbuhan bisnis. Kepuasan pelanggan menjadi kunci utama dalam membangun hubungan jangka panjang dan menciptakan loyalitas."</p>
        <a href="login.php" class="icon-link">
          Call to action
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg>
        </a>
      </div>
      <div class="feature col">
      <button type="button" class="btn btn-primary mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill me-2" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"></path>
</svg>      Barang</button>
         <h2>Cek Stok Barang </h2>
        <p>"Mengajak cek stok barang berarti mengundang atau mendorong pihak terkait, seperti tim gudang atau staf toko, untuk memverifikasi jumlah persediaan barang guna memastikan akurasi, menghindari kekurangan atau kelebihan stok, dan menjaga kelancaran operasional bisnis."</p>
        <a href="login.php" class="icon-link"><br>
          Call to action
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg>
        </a>
      </div>
      <div class="feature col">
      <button type="button" class="btn btn-primary mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-check-fill me-2" viewBox="0 0 16 16">
  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708"></path>
</svg>      Pembelian</button>
        <h2>Lakukan Pembelian</h2>
        <p>"Ayo, belanja sekarang di kasir kami dan nikmati kemudahan transaksi yang cepat, aman, serta berbagai penawaran menarik untuk mempermudah kebutuhan Anda!"</p>
        <br><br>
        <a href="login.php" class="icon-link"><br>
          Call to action
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg>
        </a>
      </div>
    </div>
  </div>
</section><br><br><br><br><br><br>

 
<section id="registrasi">
<span class="border border-primary">
  <div class="b-example-divider"></div>

<div class="">
  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h3 class="display-4 fw-bold lh-1 mb-3"> Sebelum Masuk, Buat Akunmu Dengan Registrasi !</h3>
        <p class="col-lg-10 fs-4">"Untuk mengakses semua fitur dan layanan kami, Anda perlu membuat akun dengan proses registrasi yang cepat dan mudah. Daftar sekarang untuk menikmati pengalaman yang lebih personal dan aman di aplikasi kami."       </p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
      
      <form method="post">
        <form class="p-4 p-md-5 border-lg rounded-3 bg-light col-md-10 mx-auto col-lg-5">
          <div class="form-floating mb-3">
          <input class="form-control" id="inputEmail" type="text" name="username" placeholder="Masukan Username"  />
          <label for="inputEmail">Username</label>
          </div>
          <div class="form-floating mb-3">
          <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Masukan Password" />
          <label for="inputPassword">Password</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
              <button type="submit"class="btn btn-primary w-100">Login</button>
          </div>
          <hr class="my-4">
          <div class="card-footer text-center text-primary py-3">
              <div class="small"><a href="register.php">Belum Punya Akunmu? Register!</a></div>
          </div>  
        </form>
        </form>
      
      </div>
    </div>
  </div>
  </span>
</div>
  <div class="b-example-divider"></div>
</section>
 





<section id="komentar">
      <div class="container section-title mt-4" data-aos="fade-up">
  <h2 class="text-dark">komentar</h2>
  <p class="text-dark">Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
</div><!-- End Section Title -->

      <div class="container border-center">
      <div class="col-lg-8">
            <form action="" method="post" class="php-email-form" data-aos="fade" data-aos-delay="100">
              <div class="row gy-4">

                <div class="col-md-6">
                <label for="exampleFormControlInput1" class="form-label">Masukan Nama</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="nama" placeholder="Nama Anda">
                </div>

                <div class="col-md-12">
                <label for="exampleFormControlInput1" class="form-label">Masukan Subject</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="subject" placeholder="Pelajar">
                </div>

                <div class="col-md-12">
                <label for="exampleFormControlInput1" class="form-label">Masukan Komentar</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="message" placeholder="Komentar Anda">
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <div class="d-flex mb-4">
                <button type="submit" class="btn btn-primary" >Kirim</button>
                <hr>
                <br class="mb-4">
                <br>
              </div>
                </div>
              </div>
            </form>
          </div>
      </div>     
    </section><br><br><br><br><br><br>
        <?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;

    // Validasi input
    if (empty($nama) || empty($subject) || empty($message)) {
        echo '<div class="alert alert-danger">Nama, subject, dan Pesan tidak boleh kosong.</div>';
    } else {
        // Mempersiapkan kueri
        $stmt = $koneksi->prepare("INSERT INTO komentar (nama, subject, message, parent_id) VALUES (?, ?, ?, ?)");
        
        // Cek jika prepare gagal
        if (!$stmt) {
            die("Prepare failed: " . $koneksi->error);
        }

        $stmt->bind_param("sssi", $nama, $subject, $message, $parent_id);

        // Eksekusi kueri
        if ($stmt->execute()) {
            echo '<div class="alert alert-success">Komentar berhasil ditambahkan.</div>';
        } else {
            echo '<div class="alert alert-danger">Gagal menambahkan komentar: ' . $stmt->error . '</div>';
        }

        // Menutup statement
        $stmt->close();
    }
}

// Fungsi untuk menampilkan komentar dan balasan
function display_comments($parent_id = null) {
    global $koneksi;

    $sql = "SELECT * FROM komentar WHERE parent_id " . ($parent_id === null ? "IS NULL" : "= $parent_id") . " ORDER BY sent_at";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='comments'>";
        while ($datas = $result->fetch_assoc()) {
            echo "<div class='container comment'>";
            echo "<div class='author'><strong>" . htmlspecialchars($datas["nama"]) . "</strong></div>";
            echo "<div class='subject'>" . htmlspecialchars($datas["subject"]) . "</div>";
            echo "<div class='message'>" . htmlspecialchars($datas["message"]) . "</div>";
            echo "<div class='timestamp'>" . htmlspecialchars($datas["sent_at"]) . "</div>";

            if ($parent_id === null) {
                echo "<a href='delete_comment.php?id=" . $datas['id'] . "' class='btn btn-primary mb-4 me-4'>Hapus</a>";
                echo "<button class='btn btn-secondary reply-btn mb-4' data-id='" . $datas['id'] . "'>Balas</button>";
            }

            echo "<div class='reply-form' id='reply-form-" . $datas['id'] . "' style='display:none;'>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='parent_id' value='" . $datas['id'] . "'>";
            echo "<input type='text' class='form-control mb-2' name='nama' placeholder='Nama Anda' required>";
            echo "<input type='text' class='form-control mb-2' name='subject' placeholder='subject Anda' required>";
            echo "<textarea class='form-control mb-2' name='message' placeholder='Balasan Anda' required></textarea>";
            echo "<button class='btn btn-primary' type='submit'>Kirim Balasan</button>";
            echo "</form></div>";

            display_comments($datas['id']);
            echo "</div>"; // Akhir dari comment container
        }
        echo "</div>"; // Akhir dari comments
    }
}

// Menampilkan komentar yang sudah ada dari database
display_comments();

// Tutup koneksi
$koneksi->close();
?>

<script>
  document.querySelectorAll('.unlike-btn').forEach(button => {
    button.addEventListener('click', function() {
        const commentId = this.getAttribute('data-id');

        fetch('unlike_comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ comment_id: commentId }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const likeCountSpan = this.previousElementSibling; // Assuming the like count is before the unlike button
                let currentCount = parseInt(likeCountSpan.textContent);
                likeCountSpan.textContent = (currentCount - 1) + " Likes"; // Decrement the count
            } else {
                alert('Gagal membatalkan like: ' + data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll('.reply-form form');

    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            const nama = form.querySelector('input[name="nama"]').value.trim();
            const email = form.querySelector('input[name="email"]').value.trim();
            const pesan = form.querySelector('input[name="pesan"]').value.trim();

            if (!nama || !email || !pesan) {
                event.preventDefault(); // Hentikan pengiriman form
                alert("Nama, Email, dan Pesan tidak boleh kosong.");
            }
        });
    });
});
</script>

<script>
document.querySelectorAll('.reply-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const replyForm = document.getElementById('reply-form-' + id);
        replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
    });
});
</script>



      </div>

    </section>

    <!-- <section class="contact_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 col-lg-4 offset-md-1">
          
              </div>
            </form>
           

          </div>
        </div>
        <div class="col-md-6 col-lg-7 px-0">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </section> -->

  <section id="contact">
  <div class="">
  <!-- Footer -->
  <footer
          class="text-center text-lg-start bg-primary text-white"
          style="background-color: "
          >
    <!-- Grid container -->
    <div class="bg-primary  p-4 pb-0">
      <!-- Section: Links -->
      <section class="bg-primary ">
        <!--Grid row-->
        <div class="row bg-primary ">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 bg-primary  mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">
             APLIKASI KASIR BAKTI NUSANTARA 666
            </h6>
            <p class="text-light">
            "Aplikasi Kasir Baknus 666 adalah solusi kasir terdepan yang menggabungkan kemudahan penggunaan, fitur lengkap, dan sistem yang aman untuk memudahkan manajemen transaksi bisnis Anda. aplikasi ini memungkinkan Anda untuk mengelola penjualan, stok barang, dan laporan keuangan secara real-time, menjadikannya alat yang sangat efektif dan efisien bagi bisnis dari berbagai skala. Dilengkapi dengan Baknus 666 siap mendukung kesuksesan bisnis Anda, memberikan pengalaman transaksi yang lancar dan terpercaya."
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix bg-primary d-md-none" />

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>
            <p>
              <a class="text-white">Pelanggan</a>
            </p>
            <p>
              <a class="text-white">Barang</a>
            </p>
            <p>
              <a class="text-white">Pembelian</a>
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">
              Useful links
            </h6>
            <p>
              <a class="text-white">Your Account</a>
            </p>
            <p>
              <a class="text-white">Become an Affiliate</a>
            </p>
            <p>
              <a class="text-white">Shipping Rates</a>
            </p>
            <p>
              <a class="text-white">Help</a>
            </p>
          </div>

          <!-- Grid column -->
          <hr class="w-100 clearfix bg-primary  d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
            <p><i class="fas fa-home mr-3"></i>Jl. Raya Percobaan No.65, Cileunyi Kulon, Kec. Cileunyi, Kabupaten Bandung, Jawa Barat 40622</p>
            <p><i class="fas fa-envelope mr-3"></i>ypdm.baknus666@gmail.com</p>
            <p><i class="fas fa-phone mr-3"></i> +62 888-9485-891</p>
            <p><i class="fas fa-print mr-3"></i> +62 868-9868-632</p>
          </div>
          <!-- Grid column -->
        </div>
        <!--Grid row-->
      </section>
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
  </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
