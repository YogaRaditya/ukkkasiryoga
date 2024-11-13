<?php
include('koneksi.php');  // Pastikan koneksi sudah benar

// Query untuk mengambil data ID Penjualan
$query = mysqli_query($koneksi, "SELECT id_penjualan FROM penjualan");

if (mysqli_num_rows($query) > 0) {
    echo "<h2>Pilih ID Penjualan</h2>";
    echo "<form action='struk.php' method='GET' class='form-select'>";
    echo "<label for='id_penjualan' class='form-label'>Pilih ID Penjualan:</label>";
    echo "<select name='id' id='id_penjualan' class='form-control' onchange='this.form.submit()'>";

    while ($row = mysqli_fetch_assoc($query)) {
        echo "<option value='" . htmlspecialchars($row['id_penjualan']) . "'>" . htmlspecialchars($row['id_penjualan']) . "</option>";
    }

    echo "</select>";
    echo "</form>";
} else {
    echo "<div class='alert alert-warning'>Tidak ada ID penjualan ditemukan.</div>";
}
?>



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
