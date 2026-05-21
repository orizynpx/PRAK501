<?php
require_once 'Koneksi.php';
require_once 'Model.php';
$id = $_GET['id'] ?? null;
$peminjam = null;
$model = new PeminjamanModel(getConnection());

$memberModel = new MemberModel(getConnection());
$members = $memberModel->getAllMember();

$bukuModel = new BukuModel(getConnection());
$buku = $bukuModel->getAllBuku();
if ($id) {
    $peminjam = $model->getPeminjamanById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_member = $_POST['id_member'];
    $id_buku = $_POST['id_buku'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    if ($id) {
        $model->updatePeminjaman($id, $id_member, $id_buku, $tgl_pinjam, $tgl_kembali);
    } else {
        $model->insertPeminjaman($id_member, $id_buku, $tgl_pinjam, $tgl_kembali);
    }
    header("Location: Peminjaman.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $id ? 'Edit' : 'Tambah' ?> Peminjaman</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <button onclick="location.href='index.php'">Home</button>
        <button onclick="location.href='Peminjaman.php'">Kembali</button>
    </nav>
    <h1><?= $id ? 'Edit' : 'Tambah' ?> Peminjaman</h1>
    <form method="post">
        <select name="id_member" required>
            <option value="">Pilih Member</option>
            <?php foreach ($members as $member): ?>
                <option value="<?= $member['id_member'] ?>" <?= (isset($peminjam['id_member']) && $peminjam['id_member'] == $member['id_member']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($member['nama_member']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <select name="id_buku" required>
            <option value="">Pilih Buku</option>
            <?php foreach ($buku as $b): ?>
                <option value="<?= $b['id'] ?>" <?= (isset($peminjam['id_buku']) && $peminjam['id_buku'] == $b['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($b['judul_buku']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="tgl_pinjam">Tanggal Pinjam:</label><br>
        <input type="date" name="tgl_pinjam" value="<?= htmlspecialchars($peminjam['tgl_pinjam'] ?? '') ?>" required><br>

        <label for="tgl_kembali">Tanggal Kembali:</label><br>
        <input type="date" name="tgl_kembali" value="<?= htmlspecialchars($peminjam['tgl_kembali'] ?? '') ?>" required><br><br>

        <button type="submit">
            <?= $id ? 'Update' : 'Simpan' ?>
        </button>
        <a href="Peminjaman.php">Batal</a>
    </form>
</body>