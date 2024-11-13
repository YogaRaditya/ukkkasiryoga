<!-- <div class="container-fluid px-4">
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="assets/img" href="assets/img/logo-bn666.png">
    <h1 class="mt-4">Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pembelian</li>
    </ol>
    <div class="row mb-4">
        <div class="col-auto">
            <a href="?page=pembelian_tambah" class="btn btn-primary">+ Tambah Pembelian</a>
        </div>
        <div class="col-auto">
            <form action="index.php" method="post">
                <button type="submit" class="btn btn-primary">Kembali</button>
            </form>
        </div>
    </div>
    <hr>
    
 Tabel Pembelian -->
    <!-- <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal Pembelian</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include('koneksi.php');
        if ($koneksi) {
            $query = mysqli_query($koneksi, "SELECT penjualan.*, pelanggan.nama_pelanggan FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan");

            if (!$query) {
                die("Query failed: " . mysqli_error($koneksi));
            }

            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo isset($data['tanggal_penjualan']) ? $data['tanggal_penjualan'] : 'Tidak ada'; ?></td>
                    <td><?php echo isset($data['nama_pelanggan']) ? $data['nama_pelanggan'] : 'Tidak ada'; ?></td>
                    <td><?php echo isset($data['total_harga']) ? number_format($data['total_harga'], 2, ',', '.') : 'Tidak ada'; ?></td>
                    <td>
                        <a href="?page=penjualan_ubah&id=<?php echo $data['id_penjualan']; ?>" class="btn btn-secondary">Detail</a>
                        <a href="?page=penjualan_hapus&id=<?php echo $data['id_penjualan']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="4">Gagal terhubung ke database.</td></tr>';
        }
        ?>
        </tbody>
    </table>
     -->
     <?php
include('koneksi.php');  // Pastikan koneksi sudah benar

// Proses penyimpanan pembelian
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $id_pelanggan = $_POST['id_pelanggan'];  // ID pelanggan
    $total_harga = $_POST['total_harga'];    // Total harga
    $tunai = $_POST['tunai'];                // Uang tunai
    $kembalian = $_POST['kembalian'];        // Kembalian

    // Debug: Pastikan data tunai dan kembalian benar
    var_dump($tunai, $kembalian);  // Cek nilai tunai dan kembalian

    // Cek apakah tunai dan kembalian terisi
    if ($tunai > 0) {
        // Hitung kembalian jika tunai lebih besar dari total harga
        $kembalian = $tunai - $total_harga;
    } else {
        $kembalian = 0;
    }

    // Query untuk menyimpan data pembelian
    $stmt = $koneksi->prepare("INSERT INTO penjualan (tanggal_penjualan, id_pelanggan, total_harga, tunai, kembalian) VALUES (NOW(), ?, ?, ?, ?)");
    $stmt->bind_param("iddd", $id_pelanggan, $total_harga, $tunai, $kembalian);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Pembelian berhasil!');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data pembelian: " . mysqli_error($koneksi) . "');</script>";
    }

    $stmt->close();
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>

    <div class="container-fluid mt-4 px-4">
        <!-- Form untuk input data pembelian -->
        <!-- <form action="pembelian.php" method="POST">
            <div class="form-group">
                <label for="id_pelanggan">Pelanggan:</label>
                <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                    <option value="">Pilih Pelanggan</option>
                    <?php while ($row = mysqli_fetch_assoc($pelanggan_query)): ?>
                        <option value="<?php echo $row['id_pelanggan']; ?>"><?php echo $row['nama_pelanggan']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="total_harga">Total Harga:</label>
                <input type="number" name="total_harga" id="total_harga" class="form-control" placeholder="Total Harga" required>
            </div>

            <div class="form-group">
                <label for="tunai">Tunai:</label>
                <input type="number" name="tunai" id="tunai" class="form-control" placeholder="Uang Tunai" required oninput="hitungKembalian()">
            </div>

            <div class="form-group">
                <label for="kembalian">Kembalian:</label>
                <input type="number" name="kembalian" id="kembalian" class="form-control" placeholder="Kembalian" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Pembelian</button>
        </form> -->



        <!-- Tabel Pembelian -->
        <h2>Data Pembelian</h2>
        <hr>
        <div class="row mb-4">
        <div class="col-auto">
            <a href="?page=pembelian_tambah" class="btn btn-primary">+ Tambah Pembelian</a>
        </div>
        <div class="col-auto">
            <form action="index.php" method="post">
                <button type="submit" class="btn btn-primary">Kembali</button>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th class="bg-primary text-light">Tanggal Pembelian</th>
            <th class="bg-primary text-light">Pelanggan</th>
            <th class="bg-primary text-light">Total Harga</th>
            <th class="bg-primary text-light">Tunai</th>
            <th class="bg-primary text-light">Kembalian</th>
            <th class="bg-primary text-light">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // Menampilkan data pembelian
    $query = mysqli_query($koneksi, "SELECT penjualan.*, pelanggan.nama_pelanggan FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan");

    while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?php echo $data['tanggal_penjualan']; ?></td>
            <td><?php echo $data['nama_pelanggan']; ?></td>
            <td><?php echo number_format($data['total_harga'], 2, ',', '.'); ?></td>
            <td><?php echo number_format($data['tunai'], 2, ',', '.'); ?></td>
            <td><?php echo number_format($data['kembalian'], 2, ',', '.'); ?></td>
            <td>
                <a href="?page=penjualan_ubah&id=<?php echo $data['id_penjualan']; ?>" class="btn btn-secondary">Detail</a>
                <a href="?page=penjualan_hapus&id=<?php echo $data['id_penjualan']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>


    </div>

    <script>
  function hitungKembalian() {
    var totalHarga = parseFloat(document.getElementById('total_harga').value) || 0;
    var tunai = parseFloat(document.getElementById('tunai').value) || 0;
    var kembalian = tunai - totalHarga;
    document.getElementById('kembalian').value = kembalian.toFixed(2);
}

    </script>

</body>
</html>
