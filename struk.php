<?php

include('koneksi.php');  // Pastikan koneksi sudah benar

// Query untuk mengambil data ID Penjualan
$query = mysqli_query($koneksi, "SELECT id_penjualan FROM penjualan");
// Jika ada ID yang dipilih
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Query untuk mendapatkan detail pembelian
    $query = mysqli_query($koneksi, "SELECT penjualan.*, pelanggan.nama_pelanggan 
                                      FROM penjualan 
                                      LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan 
                                      WHERE id_penjualan = $id");

    if (!$query) {
        echo "Query Error: " . mysqli_error($koneksi);
        exit();
    }

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);

        // Query untuk mendapatkan detail produk
        $detailQuery = mysqli_query($koneksi, "SELECT detail_penjualan.*, produk.nama_produk, produk.harga 
                                                FROM detail_penjualan 
                                                LEFT JOIN produk ON produk.id_produk = detail_penjualan.id_produk 
                                                WHERE detail_penjualan.id_penjualan = $id");

        if (!$detailQuery) {
            echo "Query Error: " . mysqli_error($koneksi);
            exit();
        }

        ?>
        
        <?php
    } else {
        echo "Detail tidak ditemukan untuk ID: $id";
    }
}
?>

<!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="assets/img" href="assets/img/logo-bn666.png">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Aplikasi Kasir Baknus 666</title>
            <style>
                body {
                    font-family: Tahoma, sans-serif;
                    font-size: 10pt;
                }
                #tabel {
                    font-size: 15px;
                    border-collapse: collapse;
                    width: 350px;
                    margin: 0 auto;
                }
                #tabel td {
                    padding: 5px;
                    border: 1px solid black;
                }
                hr {
                    display: block;
                    margin: 10px 0;
                    border-style: inset;
                    border-width: 1px;
                }
                .total {
                    font-size: 16pt;
                    font-weight: bold;
                }
                .thank-you {
                    text-align: center;
                    font-size: 12pt;
                    margin-top: 20px;
                }
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        padding: 20px;
    }

    h2 {
        color: #007bff;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-select {
        max-width: 400px;
        margin: 0 auto;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .alert {
        background-color: #ffeb3b;
        color: #856404;
        padding: 15px;
        border-radius: 5px;
        text-align: center;
    }

            </style>
        </head>
        <body>
            <center>
                <table class="mt-4" id="tabel" border="0">
                    <tr>
                        <td colspan="3" align="center">
                            <img src="assets/img/logo-bn666.png" alt="" width="100" class="mb-4">
                            <p>APLIKASI KASIR BAKTI NUSANTARA 666</p>
                            <p>________________________________________________________________</p>
                            <p>Jl. Raya Percobaan No.65, Cileunyi Kulon, Kec. Cileunyi, Kabupaten Bandung, Jawa Barat 40622</p>
                            <span style="font-size: 12pt">No. : <?php echo htmlspecialchars($data['id_penjualan']); ?>, <?php echo htmlspecialchars($data['tanggal_penjualan']); ?></span><br>
                            <p><strong>Nama Pelanggan: </strong><?php echo htmlspecialchars($data['nama_pelanggan']); ?></p> <!-- Nama pelanggan -->
                        </td>
                    </tr>
                    <tr align='center'>
                        <td width='50%'>Produk</td>
                        <td width='25%'>Harga</td>
                        <td width='25%'>Jumlah</td>
                    </tr>
                    <tr><td colspan='3'><hr></td></tr>
                    <?php
                    $totalHarga = 0;
                    while ($detail = mysqli_fetch_array($detailQuery)) {
                        $subtotal = $detail['harga'] * $detail['jumlah_produk'];
                        $totalHarga += $subtotal;
                    ?>
                    <tr>
                        <td style='vertical-align:top'><?php echo htmlspecialchars($detail['nama_produk']); ?></td>
                        <td style='vertical-align:top; text-align:right;'>Rp <?php echo number_format($detail['harga'], 2, ',', '.'); ?></td>
                        <td style='vertical-align:top; text-align:right;'><?php echo htmlspecialchars($detail['jumlah_produk']); ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr><td colspan='3'><hr></td></tr>
                    <tr>
                        <td colspan='2' style='text-align:right'>Total:</td>
                        <td class="total" style='text-align:right;'>Rp <?php echo number_format($totalHarga, 2, ',', '.'); ?></td>
                    </tr>
                </table>
                <div class="thank-you">===================== TERIMAKASIH =====================</div>
                <div class="thank-you">====== SUDAH BELANJA DI TOKO KAMI ======</div><br>
                <form action="index.php" method="post" id="myForm">
                    <button class="btn btn-primary" type="button" onclick="window.print()">Print</button> 
                </form>
            </center>
        </body>
        </html>