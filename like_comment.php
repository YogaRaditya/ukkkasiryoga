<?php
session_start();
include "db.php"; // Pastikan koneksi sudah terhubung

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $comment_id = intval($data['comment_id']); // Pastikan ini diambil dengan benar

    // Debug
    error_log("Received comment_id: " . $comment_id); // Cek ini di log PHP



    // Update jumlah likes
    $stmt = $koneksi->prepare("UPDATE komentar SET likes = likes + 1 WHERE id = ?");
    $stmt->bind_param("i", $comment_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
}
$koneksi->close();
?>
