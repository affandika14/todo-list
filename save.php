<?php
// Memastikan file koneksi database ada
require_once 'connection.php';

// Memeriksa apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Mengambil data dari form
    $id = $_POST['id'] ?? null;
    $nama_job = $_POST['nama_job'];
    
    // [PERBAIKAN PENTING]
    // Ambil 'deskripsi' dari POST. 
    // Jika tidak ada atau kosong, kita set sebagai NULL agar konsisten di database.
    $deskripsi = !empty($_POST['deskripsi']) ? $_POST['deskripsi'] : null;
    
    $deadline = $_POST['deadline'];
    $prioritas = $_POST['prioritas'];
    
    // Ambil 'status'. Jika checkbox tidak dicentang, POST tidak akan mengirimkan nilainya,
    // jadi kita beri default 0 (Belum Selesai).
    $status = isset($_POST['status']) ? 1 : 0;

    try {
        if ($id) {
            // --- Logika UPDATE (Edit) ---
            // [PERBAIKAN] Tambahkan 'deskripsi = ?' ke query UPDATE
            $sql = "UPDATE tugas SET nama_job = ?, deskripsi = ?, deadline = ?, prioritas = ?, status = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            // [PERBAIKAN] Tambahkan $deskripsi ke array execute
            $stmt->execute([$nama_job, $deskripsi, $deadline, $prioritas, $status, $id]);
            
        } else {
            // --- Logika INSERT (Tambah Baru) ---
            // [PERBAIKAN] Tambahkan 'deskripsi' ke kolom dan '?' ke VALUES
            $sql = "INSERT INTO tugas (nama_job, deskripsi, deadline, prioritas, status, tanggal_dibuat) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $tanggal_dibuat = date('Y-m-d'); // Tanggal hari ini
            // [PERBAIKAN] Tambahkan $deskripsi ke array execute
            $stmt->execute([$nama_job, $deskripsi, $deadline, $prioritas, $status, $tanggal_dibuat]);
        }
        
        // Jika berhasil, redirect kembali ke halaman list
        header("Location: list_job.php");
        exit;
        
    } catch (PDOException $e) {
        // Jika ada error, tampilkan pesan (sebaiknya jangan di production)
        die("Error: Tidak bisa menyimpan data. " . $e->getMessage());
    }
    
} else {
    // Jika bukan POST, redirect ke index
    header("Location: index.php");
    exit;
}
?>

