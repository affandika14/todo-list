<?php
// Hanya jalankan skrip jika ada parameter 'id' di URL
if (isset($_GET['id'])) {
    
    require_once 'connection.php';
    
    $id = $_GET['id'];
    
    try {
        // Gunakan prepared statement untuk menghapus data dengan aman
        $sql = "DELETE FROM tugas WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        // Setelah berhasil hapus, redirect kembali ke halaman list
        header("Location: list_job.php");
        exit;
        
    } catch (\PDOException $e) {
        die("Error saat menghapus data: " . $e->getMessage());
    }
    
} else {
    // Jika tidak ada 'id', redirect ke beranda
    header("Location: index.php");
    exit;
}
?>
