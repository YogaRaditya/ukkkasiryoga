<div class="container-fluid px-4">
<link href="css/styles.css" rel="stylesheet" />
    <h1 class="mt-4">Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <div class="row mb-4">
    
    <div class="col-auto">
        <form action="user.php" method="post">
            <button type="submit" class="btn btn-primary">Kembali</button>
        </form>
    </div>
</div>
<hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="bg-primary text-light">Nama Produk</th>
                <th class="bg-primary text-light">Harga</th>
                <th class="bg-primary text-light">Stok</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Pastikan koneksi sudah benar
        include('koneksi.php'); // atau sesuaikan dengan lokasi koneksi Anda

        // Query untuk mengambil data pelanggan
        $query = "SELECT * FROM produk";
        $result = mysqli_query($koneksi, $query);

        // Cek apakah query berhasil
        if ($result) {
            // Loop untuk menampilkan data pelanggan
            while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo htmlspecialchars($data['nama_produk']); ?></td>
                <td><?php echo htmlspecialchars($data['harga']); ?></td>
                <td><?php echo htmlspecialchars($data['stok']); ?></td>
            </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='4'>Data tidak ditemukan</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
