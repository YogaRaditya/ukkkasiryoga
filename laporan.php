<?php
// Koneksi ke database
include 'koneksi.php';

// Fungsi untuk mengambil laporan penjualan
function getSalesReport($koneksi, $startDate, $endDate) {
    $query = "SELECT 
                DATE(p.tanggal_penjualan) AS tanggal, 
                SUM(dp.jumlah_produk) AS total_jumlah, 
                SUM(dp.sub_total) AS total_harga 
              FROM 
                detail_penjualan dp 
              JOIN 
                penjualan p ON dp.id_penjualan = p.id_penjualan 
              WHERE 
                p.tanggal_penjualan BETWEEN '$startDate' AND '$endDate' 
              GROUP BY 
                DATE(p.tanggal_penjualan) 
              ORDER BY 
                tanggal ASC";
    return mysqli_query($koneksi, $query);
}

// Ambil laporan harian
$dailyReport = getSalesReport($koneksi, date('Y-m-d'), date('Y-m-d'));

// Ambil laporan mingguan
$weeklyReport = getSalesReport($koneksi, date('Y-m-d', strtotime('-7 days')), date('Y-m-d'));

// Ambil laporan bulanan
$monthlyReport = getSalesReport($koneksi, date('Y-m-01'), date('Y-m-t'));

// Cek apakah ada kesalahan pada query
if (!$dailyReport || !$weeklyReport || !$monthlyReport) {
    die("Query failed: " . mysqli_error($koneksi));
}
?>

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo-bn666.png" type="image/png">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0d6efd;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1, h6 {
            text-align: center;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0d6efd;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ccc;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 50%;
                padding-left: 10px;
                text-align: left;
                font-weight: bold;
                color: #333;
            }
        }
    </style>
</head>
<body>

<h1 class="mb-4">Laporan Penjualan</h1>

<!-- Laporan Harian -->
<h6 class="mt-4">Laporan Harian</h6>

<form action="index.php" method="post" id="myForm">
                    <button class="btn btn-light" type="button" onclick="window.print()">Print Laporan</button> 
                </form>
    
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


<!-- Laporan Mingguan -->
<h6>Laporan Mingguan</h6>
<table>
    <tr>
        <th>Tanggal</th>
        <th>Total Jumlah</th>
        <th>Total Harga</th>
    </tr>
    <?php if (mysqli_num_rows($weeklyReport) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($weeklyReport)): ?>
            <tr>
                <td data-label="Tanggal"><?php echo $row['tanggal']; ?></td>
                <td data-label="Total Jumlah"><?php echo $row['total_jumlah']; ?></td>
                <td data-label="Total Harga"><?php echo number_format($row['total_harga'], 2, ',', '.'); ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="3">Tidak ada data untuk laporan mingguan.</td></tr>
    <?php endif; ?>
</table>

<!-- Laporan Bulanan -->
<h6>Laporan Bulanan</h6>
<table>
    <tr>
        <th>Tanggal</th>
        <th>Total Jumlah</th>
        <th>Total Harga</th>
    </tr>
    <?php if (mysqli_num_rows($monthlyReport) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($monthlyReport)): ?>
            <tr>
                <td data-label="Tanggal"><?php echo $row['tanggal']; ?></td>
                <td data-label="Total Jumlah"><?php echo $row['total_jumlah']; ?></td>
                <td data-label="Total Harga"><?php echo number_format($row['total_harga'], 2, ',', '.'); ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="3">Tidak ada data untuk laporan bulanan.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
