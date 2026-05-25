<?php
require_once 'Koneksi.php';
require_once 'Model.php';
$model = new PeminjamanModel(getConnection());
if (isset($_GET['delete'])) {
    $model->deletePeminjaman($_GET['delete']);
    $model->resetAutoIncrement();
    header("Location: Peminjaman.php");
    exit;
}
$peminjaman = $model->getAllPeminjaman();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <button onclick="location.href='index.php'">Home</button>
        <button onclick="location.href='FormPeminjaman.php'">Tambah Peminjaman</button>
    </nav>
    <h1>Data Peminjaman</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Member</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
        <?php if (!empty($peminjaman)): ?>
            <?php foreach ($peminjaman as $p): ?>
                <tr>
                    <td><?php echo $p['id_peminjaman']; ?></td>
                    <td><?php echo $p['nama_member']; ?></td>
                    <td><?php echo $p['judul_buku']; ?></td>
                    <td><?php echo $p['tgl_pinjam']; ?></td>
                    <td><?php echo $p['tgl_kembali']; ?></td>
                    <td>
                        <a href="FormPeminjaman.php?id=<?php echo $p['id_peminjaman']; ?>">Edit</a><br>
                        <a href="Peminjaman.php?delete=<?php echo $p['id_peminjaman']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data peminjaman.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>