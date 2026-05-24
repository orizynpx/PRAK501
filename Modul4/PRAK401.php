<!DOCTYPE html>
<html>

<body>
    <?php
    $panjang = "";
    $lebar = "";
    $value = "";
    $value_arr = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $panjang = $_POST['panjang'] ?? "";
        $lebar = $_POST['lebar'] ?? "";
        $value = $_POST['value'] ?? "";
        $value_arr = explode(" ", trim($value));
    }
    ?>

    <form method="post" action="">
        <label for="panjang">Panjang:</label>
        <input type="text" name="panjang" value="<?php echo htmlspecialchars($panjang); ?>"><br>

        <label for="lebar">Lebar:</label>
        <input type="text" name="lebar" value="<?php echo htmlspecialchars($lebar); ?>"><br>

        <label for="value">Nilai:</label>
        <input type="text" name="value" value="<?php echo htmlspecialchars($value); ?>"><br>

        <input type="submit" name="submit" value="Cetak">
        <br><br>

        <?php
        if (!empty($value_arr)) {
            $panjang_int = intval($panjang);
            $lebar_int = intval($lebar);
            $index = 0;

            if (count($value_arr) > $panjang_int * $lebar_int) {
                echo "Jumlah nilai tidak mencukupi untuk ukuran matriks.";
            } else {
                echo "<table border='1' cellpadding='5' cellspacing='0'>";
                for ($i = 0; $i < $panjang_int; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j < $lebar_int; $j++) {
                        echo "<td>";
                        if ($index < count($value_arr)) {
                            echo htmlspecialchars($value_arr[$index]);
                            $index++;
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        ?>
    </form>
</body>

</html>