<?php
session_start();
$id_produk = $_GET['id'] ?? null;
if ($id_produk && isset($_SESSION['keranjang'][$id_produk])) {
    unset($_SESSION['keranjang'][$id_produk]);
    header('Location: search.php');
} else {
    echo "Produk tidak valid.";
}
?>
