<?php
require_once 'Koneksi.php';
require_once 'Model.php';

$model = new BukuModel(getConnection());
if (isset($_GET['delete'])) {
    $model->deleteBuku($_GET['delete']);
    $model->resetAutoIncrement();
    header("Location: Buku.php");
    exit;
}
$buku = $model->getAllBuku();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Data Buku</h1>
            <div class="nav-actions">
                <a href="/" class="btn btn-secondary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Home
                </a>
                <a href="FormBuku.php" class="btn btn-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Buku
                </a>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($buku)): ?>
                    <?php foreach ($buku as $b): ?>
                    <tr>
                        <td style="color: #64748b; font-weight: 500;">#<?php echo $b['id_buku']; ?></td>
                        <td style="color: #0f172a; font-weight: 500;"><?php echo htmlspecialchars($b['judul_buku']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($b['penulis']); ?></td>
                        <td><?php echo htmlspecialchars($b['penerbit']); ?></td>
                        <td><?php echo htmlspecialchars($b['tahun_terbit']); ?></td>
                        <td>
                            <div class="action-cell">
                                <a href="FormBuku.php?id=<?php echo $b['id_buku']; ?>" class="btn btn-secondary btn-sm">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Edit
                                </a>
                                <a href="Buku.php?delete=<?php echo $b['id_buku']; ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-state">Tidak ada data buku saat ini.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>