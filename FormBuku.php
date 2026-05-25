<?php
require_once 'Koneksi.php';
require_once 'Model.php';
$id = $_GET['id'] ?? null;
$buku = null;
$model = new BukuModel(getConnection());

if ($id) {
    $buku = $model->getBukuById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];

    if ($id) {
        $model->updateBuku($id, $judul, $penulis, $penerbit, $tahun);
    } else {
        $model->insertBuku($judul, $penulis, $penerbit, $tahun);
    }
    header("Location: Buku.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $id ? 'Edit' : 'Tambah' ?> Buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <button onclick="location.href='index.php'">Home</button>
        <button onclick="location.href='Buku.php'">Kembali</button>
    </nav>
    <h1><?= $id ? 'Edit' : 'Tambah' ?> Buku</h1>
    <form method="post">
        <label for="judul_buku">Judul Buku:</label><br>
        <input type="text" name="judul_buku" value="<?= htmlspecialchars($buku['judul_buku'] ?? '') ?>" required><br>

        <label for="penulis">Penulis:</label><br>
        <input type="text" name="penulis" value="<?= htmlspecialchars($buku['penulis'] ?? '') ?>" required><br>

        <label for="penerbit">Penerbit:</label><br>
        <input type="text" name="penerbit" value="<?= htmlspecialchars($buku['penerbit'] ?? '') ?>" required><br>

        <label for="tahun">Tahun Terbit:</label><br>
        <input type="number" name="tahun" value="<?= htmlspecialchars($buku['tahun_terbit'] ?? '') ?>" required><br><br>

        <button type="submit">
            <?= $id ? 'Update' : 'Simpan' ?>
        </button>
        <a href="Buku.php">Batal</a>
    </form>
</body>

</html>