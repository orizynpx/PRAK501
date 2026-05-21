<?php
require_once 'Koneksi.php';
class MemberModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getAllMember() {
        $stmt = $this->conn->query("SELECT * FROM member ORDER BY id_member ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getMemberById($id_member) {
        $stmt = $this->conn->prepare("SELECT * FROM member WHERE id_member = :id_member");
        $stmt->bindParam(':id_member', $id_member);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertMember($nama_member, $nomor, $alamat, $tgl_daftar, $tgl_terakhir_bayar) {
        $stmt = $this->conn->prepare(
            "INSERT INTO member (nama_member, nomor_member, alamat, tgl_mendaftar, tgl_terakhir_bayar) 
            VALUES (:nama, :nomor, :alamat, :tgl_daftar, :tgl_terakhir_bayar)"
        );

        $stmt->bindParam(':nama', $nama_member);
        $stmt->bindParam(':nomor', $nomor);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':tgl_daftar', $tgl_daftar);
        $stmt->bindParam(':tgl_terakhir_bayar', $tgl_terakhir_bayar);
        return $stmt->execute();
    }

    public function updateMember($id_member, $nama_member, $nomor, $alamat, $tgl_daftar, $tgl_terakhir_bayar) {
        $stmt = $this->conn->prepare(
            "UPDATE member 
            SET nama_member = :nama, nomor_member = :nomor, alamat = :alamat, tgl_mendaftar = :tgl_daftar, tgl_terakhir_bayar = :tgl_terakhir_bayar 
            WHERE id_member = :id_member"
        );

        $stmt->bindParam(':id_member', $id_member);
        $stmt->bindParam(':nama', $nama_member);
        $stmt->bindParam(':nomor', $nomor);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':tgl_daftar', $tgl_daftar);
        $stmt->bindParam(':tgl_terakhir_bayar', $tgl_terakhir_bayar);
        return $stmt->execute();
    }

    public function deleteMember($id_member) {
        $stmt = $this->conn->prepare("DELETE FROM member WHERE id_member = :id_member");
        $stmt->bindParam(':id_member', $id_member);
        return $stmt->execute();
    }

    public function truncateTable() {
        $this->conn->query("SET FOREIGN_KEY_CHECKS=0");
        $this->conn->query("TRUNCATE TABLE member");
        $this->conn->query("SET FOREIGN_KEY_CHECKS=1");
        return true;
    }

    public function resetAutoIncrement() {
        $this->conn->query("ALTER TABLE member AUTO_INCREMENT = 1");
        return true;
    }
}

class BukuModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getAllBuku() {
        $stmt = $this->conn->query("SELECT * FROM buku ORDER BY id_buku ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBukuById($id_buku) {
        $stmt = $this->conn->prepare("SELECT * FROM buku WHERE id_buku = :id_buku");
        $stmt->bindParam(':id_buku', $id_buku);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertBuku($judul_buku, $penulis, $penerbit, $tahun_terbit) {
        $stmt = $this->conn->prepare(
            "INSERT INTO buku (judul_buku, penulis, penerbit, tahun_terbit) 
            VALUES (:judul_buku, :penulis, :penerbit, :tahun_terbit)"
        );

        $stmt->bindParam(':judul_buku', $judul_buku);
        $stmt->bindParam(':penulis', $penulis);
        $stmt->bindParam(':penerbit', $penerbit);
        $stmt->bindParam(':tahun_terbit', $tahun_terbit);
        return $stmt->execute();
    }

    public function updateBuku($id_buku, $judul_buku, $penulis, $penerbit, $tahun_terbit) {
        $stmt = $this->conn->prepare(
            "UPDATE buku 
            SET judul_buku = :judul_buku, penulis = :penulis, penerbit = :penerbit, tahun_terbit = :tahun_terbit 
            WHERE id_buku = :id_buku"
        );

        $stmt->bindParam(':id_buku', $id_buku);
        $stmt->bindParam(':judul_buku', $judul_buku);
        $stmt->bindParam(':penulis', $penulis);
        $stmt->bindParam(':penerbit', $penerbit);
        $stmt->bindParam(':tahun_terbit', $tahun_terbit);
        return $stmt->execute();
    }

    public function deleteBuku($id_buku) {
        $stmt = $this->conn->prepare("DELETE FROM buku WHERE id_buku = :id_buku");
        $stmt->bindParam(':id_buku', $id_buku);
        return $stmt->execute();
    }

    public function truncateTable() {
        $this->conn->query("SET FOREIGN_KEY_CHECKS=0");
        $this->conn->query("TRUNCATE TABLE buku");
        $this->conn->query("SET FOREIGN_KEY_CHECKS=1");
        return true;
    }

    public function resetAutoIncrement() {
        $this->conn->query("ALTER TABLE buku AUTO_INCREMENT = 1");
        return true;
    }
}

class PeminjamanModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getAllPeminjaman() {
        $stmt = $this->conn->query(
            "SELECT p.*, m.nama_member, b.judul_buku 
            FROM peminjaman p 
            JOIN member m ON p.id_member = m.id_member 
            JOIN buku b ON p.id_buku = b.id_buku 
            ORDER BY p.id_peminjaman ASC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPeminjamanById($id_peminjaman) {
        $stmt = $this->conn->prepare("SELECT * FROM peminjaman WHERE id_peminjaman = :id_peminjaman");
        $stmt->bindParam(':id_peminjaman', $id_peminjaman);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertPeminjaman($tgl_pinjam, $tgl_kembali, $id_member, $id_buku) {
        $stmt = $this->conn->prepare(
            "INSERT INTO peminjaman (tgl_pinjam, tgl_kembali, id_member, id_buku) 
            VALUES (:tgl_pinjam, :tgl_kembali, :id_member, :id_buku)"
        );

        $stmt->bindParam(':tgl_pinjam', $tgl_pinjam);
        $stmt->bindParam(':tgl_kembali', $tgl_kembali);
        $stmt->bindParam(':id_member', $id_member);
        $stmt->bindParam(':id_buku', $id_buku);
        return $stmt->execute();
    }

    public function updatePeminjaman($id_peminjaman, $tgl_pinjam, $tgl_kembali, $id_member, $id_buku) {
        $stmt = $this->conn->prepare(
            "UPDATE peminjaman 
            SET tgl_pinjam = :tgl_pinjam, tgl_kembali = :tgl_kembali, id_member = :id_member, id_buku = :id_buku 
            WHERE id_peminjaman = :id_peminjaman"
        );

        $stmt->bindParam(':id_peminjaman', $id_peminjaman);
        $stmt->bindParam(':tgl_pinjam', $tgl_pinjam);
        $stmt->bindParam(':tgl_kembali', $tgl_kembali);
        $stmt->bindParam(':id_member', $id_member);
        $stmt->bindParam(':id_buku', $id_buku);
        return $stmt->execute();
    }

    public function deletePeminjaman($id_peminjaman) {
        $stmt = $this->conn->prepare("DELETE FROM peminjaman WHERE id_peminjaman = :id_peminjaman");
        $stmt->bindParam(':id_peminjaman', $id_peminjaman);
        return $stmt->execute();
    }

    public function truncateTable() {
        $this->conn->query("SET FOREIGN_KEY_CHECKS=0");
        $this->conn->query("TRUNCATE TABLE peminjaman");
        $this->conn->query("SET FOREIGN_KEY_CHECKS=1");
        return true;
    }

    public function resetAutoIncrement() {
        $this->conn->query("ALTER TABLE peminjaman AUTO_INCREMENT = 1");
        return true;
    }
}
?>