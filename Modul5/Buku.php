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
if (isset($_GET['truncate'])) {
    $model->truncateTable();
    header("Location: Buku.php");
    exit;
}
$buku = $model->getAllBuku();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <button onclick="location.href='index.php'">Home</button>
        <button onclick="location.href='FormBuku.php'">Tambah Buku</button>
        <button onclick="if(confirm('Apakah Anda yakin ingin menghapus semua data buku?')) location.href='Buku.php?truncate=1'">Clear Buku</button>
    </nav>
    <h1>Data Buku</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Aksi</th>
        </tr>
        <?php if (!empty($buku)): ?>
            <?php foreach ($buku as $b): ?>
                <tr>
                    <td><?php echo $b['id_buku']; ?></td>
                    <td><?php echo $b['judul_buku']; ?></td>
                    <td><?php echo $b['penulis']; ?></td>
                    <td><?php echo $b['penerbit']; ?></td>
                    <td><?php echo $b['tahun_terbit']; ?></td>
                    <td>
                        <a href="FormBuku.php?id=<?php echo $b['id_buku']; ?>">Edit</a><br>
                        <a href="Buku.php?delete=<?php echo $b['id_buku']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data buku.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>