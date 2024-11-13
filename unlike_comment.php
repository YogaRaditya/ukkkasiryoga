<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $comment_id = intval($data['comment_id']);

    // Kurangi jumlah like
    $stmt = $koneksi->prepare("UPDATE komentar SET likes = GREATEST(likes - 1, 0) WHERE id = ?");
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
