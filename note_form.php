<?php
include 'time.php';
include 'connection.php';

$catatan = [
    'id' => '',
    'judul' => '',
    'isi' => ''
];
$judul_halaman = 'Tambah Catatan Baru';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM catatan WHERE id = ?");
    $stmt->execute([$id]);
    $catatan = $stmt->fetch(PDO::FETCH_ASSOC);
    $judul_halaman = 'Edit Catatan';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $judul_halaman; ?></title>
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
        <h1><?php echo $judul_halaman; ?></h1>
        <form action="simpan_note.php" method="POST" class="form-card">
            <input type="hidden" name="id" value="<?php echo $catatan['id']; ?>">

            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($catatan['judul'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="isi">Isi Catatan</label>
                <textarea id="isi" name="isi" rows="10"><?php echo htmlspecialchars($catatan['isi'] ?? ''); ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Simpan Catatan</button>
                <a href="note.php" class="btn btn-batal">Batal</a>
            </div>
        </form>
    </main>
    </div>
</body>
</html>
