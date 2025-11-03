<?php
include 'time.php';
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    if (empty($id)) {
        // Insert baru
        $stmt = $pdo->prepare("INSERT INTO catatan (judul, isi) VALUES (?, ?)");
        $stmt->execute([$judul, $isi]);
    } else {
        // Update
        $stmt = $pdo->prepare("UPDATE catatan SET judul = ?, isi = ? WHERE id = ?");
        $stmt->execute([$judul, $isi, $id]);
    }

    header("Location: note.php");
    exit;
}
?>
