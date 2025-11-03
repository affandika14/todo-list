<?php
include 'time.php';
include 'connection.php';

// Ambil semua catatan, urutkan dari yang terbaru
$stmt = $pdo->query("SELECT * FROM catatan ORDER BY tanggal_dibuat DESC");
$catatan_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>To Do List</h1>
            <nav>
                <a href="index.php">Beranda</a>
                <a href="list_job.php">List Job</a>
                <a href="note.php" class="active">Catatan</a>
            </nav>
        </header>
        
        <main>
        <h1>Note</h1>
        <a href="note_form.php" class="btn btn-primary">Tambah</a>
        <div class="card-container-notes">

            <?php foreach ($catatan_list as $catatan): ?>
                <div class="card card-note">
                    <h3><?php echo htmlspecialchars($catatan['judul']); ?></h3>
                    <p class="deskripsi">
                        <?php echo nl2br(htmlspecialchars($catatan['isi'])); ?>
                    </p>
                    <small>Dibuat: <?php echo date('d M Y, H:i', strtotime($catatan['tanggal_dibuat'])); ?></small>
                    <div class="card-actions">
                        <a href="note_form.php?id=<?php echo $catatan['id']; ?>" class="btn">Edit</a>
                        <a href="delete_note.php?id=<?php echo $catatan['id']; ?>" class="btn btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?');">Hapus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    </div>
</body>
</html>
