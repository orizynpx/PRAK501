<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

try {
    require 'Koneksi.php';
    
    $tables = $conn->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<strong>DB Connected Successfully!</strong><br>";
    echo "Tables found: " . count($tables);
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
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