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
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: system-ui, -apple-system, sans-serif;
        background-color: #f8fafc;
        color: #334155;
        padding: 2rem;
        display: flex;
        justify-content: center;
    }

    .form-container {
        width: 100%;
        max-width: 500px;
    }

    .header-nav {
        margin-bottom: 1.5rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #0f172a;
    }

    .back-link svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    h1 {
        color: #0f172a;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    select,
    input[type="date"] {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        font-family: inherit;
        color: #0f172a;
        background-color: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    select:focus,
    input[type="date"]:focus {
        outline: none;
        border-color: #3b82f6;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s;
    }

    .btn svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    .btn-ghost {
        background-color: transparent;
        color: #64748b;
    }

    .btn-ghost:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    .btn-primary {
        background-color: #2563eb;
        color: #ffffff;
        box-shadow: 0 1px 2px rgba(37, 99, 235, 0.1);
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }
    </style>
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