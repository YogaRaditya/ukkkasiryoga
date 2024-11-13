<div class="container-fluid px-4">
    <link href="css/styles.css" rel="stylesheet" />
    <h1 class="mt-4">Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pembelian</li>
    </ol>
    <div class="row mb-4">
    <div class="col-auto">
        <a href="?page=pembelian_tambah_user" class="btn btn-primary">+ Tambah Pembelian</a>
    </div>
    <div class="col-auto">
        <form action="home_user.php" method="post">
            <button type="submit" class="btn btn-primary">Kembali</button>
        </form>
    </div>
    
</div>
<hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="bg-primary text-light">Tanggal Pembelian</th>
                <th class="bg-primary text-light">Pelanggan</th>
                <th class="bg-primary text-light">Total Harga</th>

            </tr>
        </thead>
        <tbody>
        <?php
        // Pastikan koneksi sudah ada
        include('koneksi.php');
        if ($koneksi) {
            $query = mysqli_query($koneksi, "SELECT penjualan.*, pelanggan.nama_pelanggan FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan");

            
            if (!$query) {
                die("Query failed: " . mysqli_error($koneksi));
            }

            // Loop untuk menampilkan data
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo isset($data['tanggal_penjualan']) ? $data['tanggal_penjualan'] : 'Tidak ada'; ?></td>
                    <td><?php echo isset($data['nama_pelanggan']) ? $data['nama_pelanggan'] : 'Tidak ada'; ?></td>
                    <td><?php echo isset($data['total_harga']) ? $data['total_harga'] : 'Tidak ada'; ?></td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="4">Gagal terhubung ke database.</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>
