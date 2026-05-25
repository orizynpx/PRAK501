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
        $model->updatePeminjaman($id, $tgl_pinjam, $tgl_kembali, $id_member, $id_buku);
    } else {
        $model->insertPeminjaman($tgl_pinjam, $tgl_kembali, $id_member, $id_buku);
    }
    header("Location: Peminjaman.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Edit' : 'Tambah' ?> Peminjaman - Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form-container">
        <div class="header-nav">
            <a href="Peminjaman.php" class="back-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Data Peminjaman
            </a>
        </div>

        <div class="card">
            <h1><?= $id ? 'Edit' : 'Tambah' ?> Peminjaman</h1>

            <form method="post">
                <div class="form-group">
                    <label for="id_member">Pilih Member</label>
                    <select id="id_member" name="id_member" required>
                        <option value="" disabled selected>-- Pilih Member --</option>
                        <?php foreach ($members as $member): ?>
                        <option value="<?= $member['id_member'] ?>"
                            <?= (isset($peminjam['id_member']) && $peminjam['id_member'] == $member['id_member']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($member['nama_member']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_buku">Pilih Buku</label>
                    <select id="id_buku" name="id_buku" required>
                        <option value="" disabled selected>-- Pilih Buku --</option>
                        <?php foreach ($buku as $b): ?>
                        <option value="<?= $b['id_buku'] ?>"
                            <?= (isset($peminjam['id_buku']) && $peminjam['id_buku'] == $b['id_buku']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($b['judul_buku']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                    <input type="date" id="tgl_pinjam" name="tgl_pinjam"
                        value="<?= htmlspecialchars($peminjam['tgl_pinjam'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="tgl_kembali">Tanggal Kembali</label>
                    <input type="date" id="tgl_kembali" name="tgl_kembali"
                        value="<?= htmlspecialchars($peminjam['tgl_kembali'] ?? '') ?>" required>
                </div>

                <div class="form-actions">
                    <a href="Peminjaman.php" class="btn btn-ghost">Batal</a>
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