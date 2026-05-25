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
        max-width: 600px;
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

    input[type="text"],
    input[type="number"],
    input[type="date"],
    input[type="datetime-local"],
    textarea {
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

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="date"]:focus,
    input[type="datetime-local"]:focus,
    textarea:focus {
        outline: none;
        border-color: #3b82f6;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    textarea {
        resize: vertical;
        min-height: 100px;
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