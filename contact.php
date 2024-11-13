<?php
include 'koneksi.php'; // Pastikan koneksi berhasil

$query = "SELECT * FROM komentar ORDER BY id DESC"; // Ambil pesan dari database
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($koneksi));
}

if (mysqli_num_rows($result) > 0) {
    echo "<div class='container mt-5'>";
    echo "<h3>Pesan yang Dikirim</h3>";
    echo "<ul class='list-group'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li class='list-group-item'>";
        echo "<strong>" . htmlspecialchars($row['nama']) . "</strong><br>";
        echo "<small>" . htmlspecialchars($row['email']) . "</small><br>";
        echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>"; // Menggunakan nl2br untuk menjaga format
        echo "</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "<p>Tidak ada pesan yang diterima.</p>";
}
?>

