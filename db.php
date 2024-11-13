
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "yoga_ukk_kasir");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
