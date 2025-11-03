<?php
// Memasukkan file koneksi database
require_once 'connection.php';

// Query untuk mengambil SEMUA data tugas
// [PERUBAHAN] Urutkan berdasarkan status (belum selesai dulu), lalu deadline
$stmt = $pdo->query("SELECT * FROM tugas ORDER BY status ASC, deadline ASC");
$list_tugas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Job - To Do List App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>To-Do List App</h1>
            <nav>
                <a href="index.php">Beranda</a>
                <a href="list_job.php" class="active">List Job</a>
                <a href="note.php">Catatan</a>
            </nav>
        </header>
        
        <main>
            <div class="header-list">
                <h2>Daftar Semua Job</h2>
                <a href="form.php" class="btn btn-primary">Tambah Job Baru</a>
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Job</th>
                            <th>Tanggal Dibuat</th>
                            <th>Deadline</th>
                            <th>Prioritas</th>
                            <!-- [PERUBAHAN] Tambah kolom Status -->
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($list_tugas) > 0): ?>
                            <?php foreach ($list_tugas as $tugas): ?>
                                <!-- [PERUBAHAN] Tambahkan class jika job sudah selesai -->
                                <tr class="<?php echo ($tugas['status'] == 1) ? 'job-selesai' : ''; ?>">
                                    <td>
                                        <strong><?php echo htmlspecialchars($tugas['nama_job']); ?></strong>
                                        <?php if (!empty($tugas['deskripsi'])): ?>
                                            <span class="job-description">
                                                <?php echo htmlspecialchars($tugas['deskripsi']); ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('d M Y', strtotime($tugas['tanggal_dibuat'])); ?></td>
                                    <td><?php echo date('d M Y', strtotime($tugas['deadline'])); ?></td>
                                    <td>
                                        <span class="prioritas-<?php echo $tugas['prioritas']; ?>">
                                            <?php echo getPrioritasText($tugas['prioritas']); ?>
                                        </span>
                                    </td>
                                    <!-- [PERUBAHAN] Tampilkan status dan tombol toggle -->
                                    <td>
                                        <?php if ($tugas['status'] == 1): ?>
                                            <span class="status-selesai">Selesai</span>
                                        <?php else: ?>
                                            <span class="status-belum">Belum Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="aksi">
                                        <!-- 
                                          [PERUBAHAN] Tombol Cepat untuk Selesai/Batal
                                          Tombol ini akan memanggil 'toggle_status.php'
                                        -->
                                        <?php if ($tugas['status'] == 0): ?>
                                            <a href="status.php?id=<?php echo $tugas['id']; ?>" class="btn btn-selesai">Selesai</a>
                                        <?php else: ?>
                                            <a href="status.php?id=<?php echo $tugas['id']; ?>" class="btn btn-batal">Batal</a>
                                        <?php endif; ?>
                                        
                                        <a href="form.php?id=<?php echo $tugas['id']; ?>" class="btn btn-edit">Edit</a>
                                        <a href="delete.php?id=<?php echo $tugas['id']; ?>" class="btn btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus job ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <!-- [PERUBAHAN] Update colspan jadi 6 -->
                                <td colspan="6">Belum ada data tugas. Silakan tambahkan job baru.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>

