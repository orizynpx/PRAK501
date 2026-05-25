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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Edit' : 'Tambah' ?> Member - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form-container">
        <div class="header-nav">
            <a href="Member.php" class="back-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Data Member
            </a>
        </div>

        <div class="card">
            <h1><?= $id ? 'Edit' : 'Tambah' ?> Member</h1>

            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama"
                        value="<?= htmlspecialchars($member['nama_member'] ?? '') ?>" placeholder="Masukkan nama member"
                        required>
                </div>

                <div class="form-group">
                    <label for="nomor">Nomor Member / HP</label>
                    <input type="number" id="nomor" name="nomor"
                        value="<?= htmlspecialchars($member['nomor_member'] ?? '') ?>"
                        placeholder="Masukkan nomor identitas" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap"
                        required><?= htmlspecialchars($member['alamat'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="tgl_daftar">Tanggal Daftar</label>
                    <input type="datetime-local" id="tgl_daftar" name="tgl_daftar"
                        value="<?= htmlspecialchars($member['tgl_mendaftar'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="tgl_bayar">Tanggal Terakhir Bayar</label>
                    <!-- Fixed typo in key from tgl_terkahir_bayar to tgl_terakhir_bayar -->
                    <input type="date" id="tgl_bayar" name="tgl_bayar"
                        value="<?= htmlspecialchars($member['tgl_terakhir_bayar'] ?? '') ?>" required>
                </div>

                <div class="form-actions">
                    <a href="Member.php" class="btn btn-ghost">Batal</a>
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