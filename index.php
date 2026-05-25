<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

$db_status = "";
$is_connected = false;

try {
    require 'Koneksi.php';
    $conn = getConnection();
    
    $tables = $conn->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    $db_status = "DB Connected Successfully! (" . count($tables) . " tables found)";
    $is_connected = true;
} catch (PDOException $e) {
    $db_status = "Database Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
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
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
        padding: 3rem 1.5rem;
    }

    /* --- Header & Typography --- */
    .header {
        text-align: center;
        margin-bottom: 3rem;
    }

    h1 {
        color: #0f172a;
        font-size: 2.25rem;
        margin-bottom: 1rem;
        font-weight: 700;
        letter-spacing: -0.025em;
    }

    /* --- Status Badge --- */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .status-badge.success {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .status-badge.error {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    /* --- Grid & Cards --- */
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        width: 100%;
        max-width: 1000px;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
    }

    .card-icon {
        color: #3b82f6;
        /* Blue icon color */
        margin-bottom: 1.25rem;
        display: flex;
        justify-content: center;
    }

    .card-icon svg {
        width: 3.5rem;
        height: 3.5rem;
    }

    .card h2 {
        color: #1e293b;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .card p {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.5;
    }
    </style>
</head>

<body>

    <div class="header">
        <h1>Sistem Perpustakaan</h1>
        <div class="status-badge <?= $is_connected ? 'success' : 'error' ?>">
            <?= htmlspecialchars($db_status) ?>
        </div>
    </div>

    <div class="grid-container">
        <div class="card" onclick="location.href='Buku.php'">
            <div class="card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </div>
            <h2>Data Buku</h2>
            <p>Kelola data buku di perpustakaan</p>
        </div>

        <div class="card" onclick="location.href='Member.php'">
            <div class="card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <h2>Data Member</h2>
            <p>Kelola data anggota perpustakaan</p>
        </div>

        <div class="card" onclick="location.href='Peminjaman.php'">
            <div class="card-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
            </div>
            <h2>Data Peminjaman</h2>
            <p>Kelola transaksi peminjaman buku</p>
        </div>
    </div>

</body>

</html>