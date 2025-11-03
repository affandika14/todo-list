<?php
require_once 'connection.php';

// Inisialisasi variabel
$id = $_GET['id'] ?? null;
$tugas = [
    'nama_job' => '',
    'deskripsi' => '', // Default string kosong
    'deadline' => '',
    'prioritas' => 1,
    'status' => 0 
];
$pageTitle = "Tambah Job Baru";

// --- Logika Mode Edit ---
if ($id) {
    $pageTitle = "Edit Job";
    $stmt = $pdo->prepare("SELECT * FROM tugas WHERE id = ?");
    $stmt->execute([$id]);
    $tugas = $stmt->fetch();
    
    if (!$tugas) {
        header("Location: list.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - To Do List App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>To-Do List App</h1>
            <nav>
                <a href="index.php">Beranda</a>
                <a href="list.php">List Job</a>
            </nav>
        </header>
        
        <main>
            <h2><?php echo $pageTitle; ?></h2>
            
            <form action="save.php" method="POST" class="form-card">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
                <div class="form-group">
                    <label for="nama_job">Nama Job</label>
                    <input type="text" id="nama_job" name="nama_job" value="<?php echo htmlspecialchars($tugas['nama_job']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi">Deskripsi (Opsional)</label>
                    <!-- 
                      [PERBAIKAN] Tambahkan '?? ""' 
                      Ini adalah "null coalescing operator". 
                      Jika $tugas['deskripsi'] adalah NULL, ia akan menggunakan string kosong '' sebagai gantinya.
                    -->
                    <textarea id="deskripsi" name="deskripsi"><?php echo htmlspecialchars($tugas['deskripsi'] ?? ''); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline" value="<?php echo htmlspecialchars($tugas['deadline']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="prioritas">Prioritas</label>
                    <select id="prioritas" name="prioritas">
                        <option value="1" <?php echo ($tugas['prioritas'] == 1) ? 'selected' : ''; ?>>Rendah</option>
                        <option value="2" <?php echo ($tugas['prioritas'] == 2) ? 'selected' : ''; ?>>Sedang</option>
                        <option value="3" <?php echo ($tugas['prioritas'] == 3) ? 'selected' : ''; ?>>Tinggi</option>
                    </select>
                </div>

                <div class="form-group form-group-checkbox">
                    <input type="checkbox" id="status" name="status" value="1" <?php echo ($tugas['status'] == 1) ? 'checked' : ''; ?>>
                    <label for="status">Sudah Selesai</label>
                </div>
                
                <div class="form-actions">
                    <a href="list.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>

