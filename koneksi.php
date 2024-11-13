<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "yoga_ukk_kasir");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
