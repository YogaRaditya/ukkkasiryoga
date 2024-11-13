<?php
include 'db.php';

$search_query = isset($_GET['query']) ? $_GET['query'] : '';
$results_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $results_per_page;

if (!empty($search_query)) {
    $sql = "
        SELECT 'detail_penjualan' AS source, id_produk AS info1, id_penjualan AS info2, jumlah_produk AS info3, sub_total AS info4, NULL AS info5, NULL AS info6
        FROM detail_penjualan
        WHERE LOWER(id_produk) LIKE LOWER(?) OR LOWER(id_penjualan) LIKE LOWER(?) OR LOWER(jumlah_produk) LIKE LOWER(?) OR LOWER(sub_total) LIKE LOWER(?)
        
        UNION ALL
        
        SELECT 'pelanggan' AS source, NULL AS info1, NULL AS info2, NULL AS info3, NULL AS info4, nama_pelanggan AS info5, NULL AS info6 
        FROM pelanggan 
        WHERE LOWER(nama_pelanggan) LIKE LOWER(?) OR LOWER(alamat) LIKE LOWER(?) OR LOWER(no_telepon) LIKE LOWER(?)
        
        UNION ALL
        
        SELECT 'produk' AS source, NULL AS info1, NULL AS info2, NULL AS info3, harga AS info4, stok AS info5, nama_produk AS info6
        FROM produk 
        WHERE LOWER(nama_produk) LIKE LOWER(?)
        
        LIMIT ? OFFSET ?";

    $stmt = $koneksi->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $koneksi->error);
    }

    $search_term = "%" . $search_query . "%";
    $stmt->bind_param("sssssssssi", 
        $search_term, $search_term, $search_term, $search_term, 
        $search_term, $search_term, $search_term, 
        $search_term, $results_per_page, $offset);
    
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='product-results'>";
        while ($row = $result->fetch_assoc()) {
            if ($row['source'] == 'produk') {
                echo "<div class='product-item'>";
                echo "<h3>" . htmlspecialchars($row['info6']) . "</h3>";
                echo "<p><strong>Harga:</strong> Rp " . number_format($row['info4'], 0, ',', '.') . "</p>";
                echo "<p><strong>Stok:</strong> " . htmlspecialchars($row['info5']) . "</p>";
                echo "</div>";
            }
        }
        echo "</div>";
    } else {
        echo "<p>Produk dengan kata kunci '$search_query' tidak ditemukan.</p>";
    }

    $stmt->close();
}

$koneksi->close();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/ww.css" rel="stylesheet">
    <link rel="icon" type="assets/img" href="assets/img/logo-bn666.png">

    <link rel="css/stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/styles.css" rel="stylesheet">
    
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

        <form action="index.php" method="post">
            <button type="submit" class="btn btn-primary ">Kembali</button>
        </form>

<!-- CSS untuk tampilan -->
<style>
    .product-results {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .product-item {
        background-color: #0d6efd;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        width: calc(33.333% - 20px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .product-item:hover {
        transform: scale(1.05);
    }

    .product-item h3 {
        margin: 0;
        font-size: 1.2em;
        color: #ffff;
    }

    .product-item p {
        margin: 5px 0;
        color: #fff;
    }

    @media (max-width: 768px) {
        .product-item {
            width: calc(50% - 20px);
        }
    }

    @media (max-width: 480px) {
        .product-item {
            width: 100%;
        }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
