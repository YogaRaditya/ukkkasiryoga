<?php
include 'db.php'; // Pastikan untuk menyertakan file koneksi database

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus komentar berdasarkan ID
    $delete_query = "DELETE FROM komentar WHERE id = '$id'";

    if ($koneksi->query($delete_query) === TRUE) {
        echo "Komentar berhasil dihapus.";
    } else {
        echo "Error: " . $koneksi->error;
    }
}

// Redirect kembali ke halaman utama atau halaman yang sesuai setelah penghapusan
header("Location: welcome.php"); // Ganti dengan halaman yang sesuai
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kasir Baknus 666</title>
    <link href="css/ww.css" rel="stylesheet">
</head>
<body>
    
</body>
</html>