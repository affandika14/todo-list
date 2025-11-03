<?php
// Muat konfigurasi zona waktu
include 'time.php'; 

// Sertakan file koneksi database
include 'connection.php';

// --- Logika Tugas Harian (Update Poster) ---
$statusFile = 'poster_status.txt';
$tanggalHariIni = date('Y-m-d');
$statusPoster = 'Belum Selesai'; // Default
$linkAksiPoster = 'poster.php?aksi=selesai';
$teksTombolPoster = 'Tandai Selesai';
$classTombolPoster = 'btn-selesai';

// Cek status dari file
if (file_exists($statusFile)) {
    $tanggalTersimpan = file_get_contents($statusFile);
    // Jika tanggal di file sama dengan hari ini, berarti sudah selesai
    if ($tanggalTersimpan == $tanggalHariIni) {
        $statusPoster = 'Selesai';
        $linkAksiPoster = 'poster.php?aksi=batal';
        $teksTombolPoster = 'Batal';
        $classTombolPoster = 'btn-batal';
    }
}
// --- Selesai Logika Tugas Harian ---


$query = "
    SELECT * FROM tugas 
    WHERE deadline >= CURDATE() 
    ORDER BY prioritas DESC, deadline ASC 
    LIMIT 1
";
$stmt = $pdo->query($query);
$jobPenting = $stmt->fetch(); // Ambil 1 data

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - To Do List App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>To Do List</h1>
            <nav>
                <a href="index.php" class="active">Beranda</a>
                <a href="list_job.php">List Job</a>
                <a href="note.php">Catatan</a>
            </nav>
        </header>
        
        <main>
            <h2>BEKERJA BEKERJA BEKERJA!!!</h2>
            <p>KERJO COK!!!</p>

            <div class="card prioritas">
                <h3>Job Prioritas Tertinggi & Terdekat</h3>
                <?php if ($jobPenting): ?>
                    <!-- Jika data job penting ditemukan -->
                    <h4><?php echo htmlspecialchars($jobPenting['nama_job']); ?></h4>
                    
                    <!-- [PERUBAHAN] Menampilkan deskripsi jika ada -->
                    <?php if (!empty($jobPenting['deskripsi'])): ?>
                        <p class="card-description"><?php echo htmlspecialchars($jobPenting['deskripsi']); ?></p>
                    <?php endif; ?>
                    
                    <p>
                        <strong>Deadline:</strong> 
                        <?php echo date('d F Y', strtotime($jobPenting['deadline'])); ?>
                    </p>
                    <p>
                        <strong>Prioritas:</strong> 
                        <span class="prioritas-<?php echo $jobPenting['prioritas']; ?>">
                            <?php echo getPrioritasText($jobPenting['prioritas']); ?>
                        </span>
                    </p>
                <?php else: ?>
                    <!-- Jika tidak ada data -->
                    <p>Tidak ada job penting yang akan datang. Saatnya bersantai!</p>
                <?php endif; ?>
            </div>

            <!-- Bagian Tugas Harian -->
        <section class="card-container">
            <h2>Tugas Harian</h2>
            <div class="card card-daily">
                <h3>Update Poster</h3>
                <p>Status: 
                    <span class="<?php echo ($statusPoster == 'Selesai') ? 'status-selesai' : 'status-belum'; ?>">
                        <?php echo htmlspecialchars($statusPoster); ?>
                    </span>
                </p>
                <div class="card-actions">
                    <a href="<?php echo $linkAksiPoster; ?>" class="btn <?php echo $classTombolPoster; ?>">
                        <?php echo $teksTombolPoster; ?>
                    </a>
                </div>
            </div>
        </section>
        
        </main>
    </div>
</body>
</html>

