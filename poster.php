<?php
// File ini menangani logika untuk tugas harian "Update Poster"

// Tentukan nama file status
$statusFile = 'poster_status.txt';
$tanggalHariIni = date('Y-m-d');

// Ambil aksi dari URL (selesai atau batal)
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($aksi == 'selesai') {
    // Jika aksinya 'selesai', tulis tanggal hari ini ke file
    // Ini menandakan tugas sudah selesai HARI INI
    file_put_contents($statusFile, $tanggalHariIni);

} elseif ($aksi == 'batal') {
    // Jika aksinya 'batal', hapus isi file
    // Ini me-reset statusnya menjadi "Belum Selesai"
    file_put_contents($statusFile, '');
}

// Setelah selesai memproses, kembalikan pengguna ke halaman beranda
// header() digunakan untuk melakukan redirect (pengalihan) halaman
header('Location: index.php');
exit; // Pastikan skrip berhenti setelah redirect
?>

