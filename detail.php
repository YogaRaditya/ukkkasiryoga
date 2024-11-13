<?php
include 'db.php';
$id_produk = $_GET['id'] ?? null;
if ($id_produk) {
    $sql = "SELECT * FROM produk WHERE id_produk = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo '<h1>' . htmlspecialchars($row['nama_produk']) . '</h1>';
        echo '<p>Harga: Rp ' . number_format($row['harga'], 0, ',', '.') . '</p>';
        echo '<p>Stok: ' . $row['stok'] . '</p>';
        echo '<a href="add_to_cart.php?id=' . $row['id_produk'] . '" class="btn btn-success">Tambah ke Keranjang</a>';
    } else {
        echo "Produk tidak ditemukan.";
    }
    $stmt->close();
} else {
    echo "ID Produk tidak valid.";
}
$conn->close();
?>
