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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman - Sistem Perpustakaan</title>
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
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    h1 {
        color: #0f172a;
        font-size: 1.75rem;
        font-weight: 700;
    }

    .nav-actions {
        display: flex;
        gap: 1rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
        border: 1px solid transparent;
    }

    .btn svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    .btn-secondary {
        background-color: #ffffff;
        color: #475569;
        border-color: #cbd5e1;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-secondary:hover {
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

    .btn-sm {
        padding: 0.4rem 0.75rem;
        font-size: 0.75rem;
    }

    .btn-danger {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    .btn-danger:hover {
        background-color: #fecaca;
    }

    .table-wrapper {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        overflow-x: auto;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        min-width: 800px;
    }

    th {
        background-color: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        font-size: 0.875rem;
        vertical-align: middle;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background-color: #f8fafc;
    }

    .action-cell {
        display: flex;
        gap: 0.5rem;
    }

    .empty-state {
        text-align: center;
        color: #94a3b8;
        padding: 2rem;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Data Peminjaman</h1>
            <div class="nav-actions">
                <a href="index.php" class="btn btn-secondary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Home
                </a>
                <a href="FormPeminjaman.php" class="btn btn-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Peminjaman
                </a>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Member</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($peminjaman)): ?>
                    <?php foreach ($peminjaman as $p): ?>
                    <tr>
                        <td style="color: #64748b; font-weight: 500;">#<?php echo $p['id_peminjaman']; ?></td>
                        <td style="color: #0f172a; font-weight: 500;"><?php echo htmlspecialchars($p['nama_member']); ?>
                        </td>
                        <td style="font-style: italic;"><?php echo htmlspecialchars($p['judul_buku']); ?></td>
                        <td><?php echo htmlspecialchars($p['tgl_pinjam']); ?></td>
                        <td><?php echo htmlspecialchars($p['tgl_kembali']); ?></td>
                        <td>
                            <div class="action-cell">
                                <a href="FormPeminjaman.php?id=<?php echo $p['id_peminjaman']; ?>"
                                    class="btn btn-secondary btn-sm">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Edit
                                </a>
                                <a href="Peminjaman.php?delete=<?php echo $p['id_peminjaman']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-state">Tidak ada data peminjaman saat ini.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>