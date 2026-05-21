<?php
require_once 'Koneksi.php';
require_once 'Model.php';
$id = $_GET['id'] ?? null;
$member = null;
$model = new MemberModel(getConnection());

if ($id) {
    $member = $model->getMemberById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nomor = $_POST['nomor'];
    $alamat = $_POST['alamat'];
    $tgl_daftar = $_POST['tgl_daftar'];
    $tgl_bayar = $_POST['tgl_bayar'];

    if ($id) {
        $model->updateMember($id, $nama, $nomor, $alamat, $tgl_daftar, $tgl_bayar);
    } else {
        $model->insertMember($nama, $nomor, $alamat, $tgl_daftar, $tgl_bayar);
    }
    header("Location: Member.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $id ? 'Edit' : 'Tambah' ?> Member</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <button onclick="location.href='index.php'">Home</button>
        <button onclick="location.href='Member.php'">Kembali</button>
    </nav>
    <h1><?= $id ? 'Edit' : 'Tambah' ?> Member</h1>
    <form method="post">
        <label for="nama">Nama:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($member['nama_member'] ?? '') ?>" required><br>

        <label for="nomor">Nomor:</label><br>
        <input type="number" name="nomor" value="<?= htmlspecialchars($member['nomor_member'] ?? '') ?>" required><br>

        <label for="alamat">Alamat:</label><br>
        <textarea name="alamat" required><?= htmlspecialchars($member['alamat'] ?? '') ?></textarea><br>

        <label for="tgl_daftar">Tanggal Daftar:</label>
        <input type="datetime-local" name="tgl_daftar" value="<?= htmlspecialchars($member['tgl_mendaftar'] ?? '') ?>" required><br>

        <label for="tgl_bayar">Tanggal Terakhir Bayar:</label>
        <input type="date" name="tgl_bayar" value="<?= htmlspecialchars($member['tgl_terkahir_bayar'] ?? '') ?>" required><br><br>

        <button type="submit">
            <?= $id ? 'Update' : 'Simpan' ?>
        </button>
        <a href="Member.php">Batal</a>
    </form>

</html>