<?php
require_once 'connection.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // 1. Ambil status saat ini
        $stmt_check = $pdo->prepare("SELECT status FROM tugas WHERE id = ?");
        $stmt_check->execute([$id]);
        $tugas = $stmt_check->fetch();

        if ($tugas) {
            // 2. Balik statusnya (0 jadi 1, 1 jadi 0)
            $newStatus = ($tugas['status'] == 1) ? 0 : 1;

            // 3. Update status baru ke database
            $stmt_update = $pdo->prepare("UPDATE tugas SET status = ? WHERE id = ?");
            $stmt_update->execute([$newStatus, $id]);
        }
    } catch (\PDOException $e) {
        die("Error mengubah status: " . $e->getMessage());
    }
}

// 4. Kembalikan pengguna ke halaman list
header("Location: list_job.php");
exit;
?>
