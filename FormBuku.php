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
    <style>
    /* --- Reset & Base Styles --- */
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

    /* --- Container & Card --- */
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

    /* --- Form Elements --- */
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
    input[type="number"] {
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
    input[type="number"]:focus {
        outline: none;
        border-color: #3b82f6;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* --- Actions --- */
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