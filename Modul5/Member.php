<?php
require_once 'Koneksi.php';
require_once 'Model.php';

$model = new MemberModel(getConnection());
if (isset($_GET['delete'])) {
    $model->deleteMember($_GET['delete']);
    $model->resetAutoIncrement();
    header("Location: Member.php");
    exit;
}
if (isset($_GET['truncate'])) {
    $model->truncateTable();
    header("Location: Buku.php");
    exit;
}
$members = $model->getAllMember();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Member</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <button onclick="location.href='index.php'">Home</button>
        <button onclick="location.href='FormMember.php'">Tambah Member</button>
        <button onclick="if(confirm('Apakah Anda yakin ingin menghapus semua data member?')) location.href='Member.php?truncate=1'">Clear Member</button>
    </nav>
    <h1>Data Member</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Nomor</th>
            <th>Alamat</th>
            <th>Tanggal Daftar</th>
            <th>Tanggal Terakhir Bayar</th>
            <th>Aksi</th>
        </tr>
        <?php if (!empty($members)): ?>
            <?php foreach ($members as $member): ?>
                <tr>
                    <td><?php echo $member['id_member']; ?></td>
                    <td><?php echo $member['nama_member']; ?></td>
                    <td><?php echo $member['nomor_member']; ?></td>
                    <td><?php echo $member['alamat']; ?></td>
                    <td><?php echo $member['tgl_mendaftar']; ?></td>
                    <td><?php echo $member['tgl_terakhir_bayar']; ?></td>
                    <td>
                        <a href="FormMember.php?id=<?php echo $member['id_member']; ?>">Edit</a><br>
                        <a href="Member.php?delete=<?php echo $member['id_member']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus member ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data member.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>