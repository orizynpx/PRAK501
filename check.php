<?php
include 'Koneksi.php';

$result = $conn->query("SHOW TABLES");

if ($result && $result->num_rows > 0) {
    echo "<h2>Tables found in the database:</h2><ul>";
    while($row = $result->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<h2>The database is completely empty (0 tables).</h2>";
}
?>