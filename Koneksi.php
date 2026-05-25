<?php
function getConnection() {
    $host = getenv('DB_HOST') ?? 'localhost';
    $dbname = getenv('DB_NAME') ?? 'prak501_db';
    $username = getenv('DB_USER');
    $password = getenv('DB_PASS');

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>