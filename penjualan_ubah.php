<?php 
// Ambil koneksi ke database
include 'koneksi.php'; // Pastikan Anda memiliki file ini untuk koneksi

// Ambil id dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mendapatkan detail pembelian
$query = mysqli_query($koneksi, "SELECT penjualan.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan 
                                FROM penjualan 
                                LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan 
                                WHERE id_penjualan = $id");

if ($data = mysqli_fetch_array($query)) {
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Detail Pembelian</li>
    </ol>
    <div class="row">
        <div class="col mb-4">
            <form action="print.php" method="post">
                <button class="btn btn-primary" type="submit">Print Penjualan</button> 
            </form>
            <div class="col mt-4">
            <a href="?page=pembelian" class="btn btn-danger">Kembali</a>
        </div>
        </div>
        
    </div>
    <hr>

    <!-- Tabel Detail Pembelian -->
    <table class="table table-bordered">
        <tr>
            <td width="200">ID Penjualan</td>
            <td width="1">:</td>
            <td><?php echo htmlspecialchars($data['id_penjualan']); ?></td>
        </tr>
        <tr>
            <td>ID Pelanggan</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['id_pelanggan']); ?></td>
        </tr>
        <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['nama_pelanggan']); ?></td>
        </tr>
        <tr>
            <td>Tanggal Pembelian</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($data['tanggal_penjualan']); ?></td>
        </tr>
        <tr>
            <td>Total Harga</td>
            <td>:</td>
            <td><?php echo htmlspecialchars(number_format($data['total_harga'], 0, ',', '.')); ?></td>
        </tr>
    </table>

    <h5>Detail Produk</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ambil detail produk
            $detailQuery = mysqli_query($koneksi, "SELECT detail_penjualan.*, produk.nama_produk FROM detail_penjualan LEFT JOIN produk ON produk.id_produk = detail_penjualan.id_produk WHERE id_penjualan = $id");
            while ($detail = mysqli_fetch_array($detailQuery)) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($detail['nama_produk']); ?></td>
                <td><?php echo htmlspecialchars($detail['jumlah_produk']); ?></td>
                <td><?php echo htmlspecialchars(number_format($detail['sub_total'], 0, ',', '.')); ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
} else {
    echo '<div class="alert alert-danger">Detail tidak ditemukan.</div>';
}
?>
