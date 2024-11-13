<?php
session_start();
$id_produk = $_GET['id'] ?? null;
if ($id_produk) {
    $_SESSION['keranjang'][$id_produk] = ($_SESSION['keranjang'][$id_produk] ?? 0) + 1;
    header('Location: search.php');
} else {
    echo "Produk tidak valid.";
}
?>
