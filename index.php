<!DOCTYPE html>
<html>

<head>
    <title>Sistem Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Sistem Perpustakaan</h1>
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