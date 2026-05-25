<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    include 'Koneksi.php';
    
    $check_db = @$conn->query("SHOW TABLES");
    if ($check_db) {
        echo "<div style='background:#d4edda;color:#155724;padding:10px;'>";
        echo "<strong>DB Connected!</strong> Tables found: " . $check_db->num_rows;
        echo "</div>";
    } else {
        echo "<div style='background:#fff3cd;color:#856404;padding:10px;'>Connected, but table check failed.</div>";
    }
} catch (Exception $e) {
    echo "<div style='background:#f8d7da;color:#721c24;padding:15px;border:1px solid #f5c6cb;'>";
    echo "<h3>Database Connection Crashed!</h3>";
    echo "<p><strong>Error Message:</strong> " . $e->getMessage() . "</p>";
    echo "</div>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sistem Perpustakaan PRAK501</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Selamat datang di Sistem Perpustakaan PRAK501</h1>
    <div class="cards-container">
        <div class="card" onclick="location.href='Buku.php'">
            <div class="card-icon">📚</div>
            <h2>Data Buku</h2>
            <p>Kelola data buku di perpustakaan</p>
        </div>
        <div class="card" onclick="location.href='Member.php'">
            <div class="card-icon">👥</div>
            <h2>Data Member</h2>
            <p>Kelola data anggota perpustakaan</p>
        </div>
        <div class="card" onclick="location.href='Peminjaman.php'">
            <div class="card-icon">📋</div>
            <h2>Data Peminjaman</h2>
            <p>Kelola transaksi peminjaman buku</p>
        </div>
    </div>
</body>

</html>