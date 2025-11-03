<?php
// ----- PENGATURAN KONEKSI DATABASE -----

// Ganti pengaturan ini sesuai dengan server database Anda
$host = '127.0.0.1'; // atau 'localhost'
$db   = 'to_do_app';  // Nama database yang Anda buat
$user = 'root';      // Username database Anda (default XAMPP/WAMP adalah 'root')
$pass = '';          // Password database Anda (default XAMPP/WAMP adalah kosong)
$charset = 'utf8mb4';

// ---------------------------------------

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     // Membuat objek PDO untuk koneksi
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // Jika koneksi gagal, tampilkan pesan error
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

/**
 * Fungsi helper untuk mengubah level prioritas menjadi teks.
 * Kita letakkan di sini agar bisa dipakai di file lain.
 */
function getPrioritasText($level) {
    switch ($level) {
        case 3:
            return 'Tinggi';
        case 2:
            return 'Sedang';
        case 1:
        default:
            return 'Rendah';
    }
}
?>
