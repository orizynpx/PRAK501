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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Edit' : 'Tambah' ?> Buku - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form-container">
        <div class="header-nav">
            <a href="Buku.php" class="back-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Data Buku
            </a>
        </div>

        <div class="card">
            <h1><?= $id ? 'Edit' : 'Tambah' ?> Buku</h1>

            <form method="post">
                <div class="form-group">
                    <label for="judul_buku">Judul Buku</label>
                    <input type="text" id="judul_buku" name="judul_buku"
                        value="<?= htmlspecialchars($buku['judul_buku'] ?? '') ?>" placeholder="Masukkan judul buku"
                        required>
                </div>

                <div class="form-group">
                    <label for="penulis">Penulis / Pengarang</label>
                    <input type="text" id="penulis" name="penulis"
                        value="<?= htmlspecialchars($buku['penulis'] ?? '') ?>" placeholder="Nama penulis" required>
                </div>

                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit"
                        value="<?= htmlspecialchars($buku['penerbit'] ?? '') ?>" placeholder="Nama penerbit" required>
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun Terbit</label>
                    <input type="number" id="tahun" name="tahun"
                        value="<?= htmlspecialchars($buku['tahun_terbit'] ?? '') ?>" placeholder="Contoh: 2024"
                        required>
                </div>

                <div class="form-actions">
                    <a href="Buku.php" class="btn btn-ghost">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <?= $id ? 'Update' : 'Simpan' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>