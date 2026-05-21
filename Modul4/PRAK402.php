<!DOCTYPE html>
<html>

<head>
    <style>
        th {
            background-color: #d3d3d3;
        }
    </style>
</head>

<body>
    <?php
    $mahasiswa = [
        [
            "nama" => "Andi",
            "nim" => "2101001",
            "uts" => "87",
            "uas" => "65"
        ],
        [
            "nama" => "Budi",
            "nim" => "2101002",
            "uts" => "76",
            "uas" => "79"
        ],
        [
            "nama" => "Tono",
            "nim" => "2101003",
            "uts" => "50",
            "uas" => "41"
        ],
        [
            "nama" => "Jessica",
            "nim" => "2101004",
            "uts" => "60",
            "uas" => "75"
        ]
    ];

    function finalScore(int $uts, int $uas): float
    {
        return (0.4 * $uts) + (0.6 * $uas);
    }

    function finalScoreHuruf(int $nilaiAkhir): string
    {
        if ($nilaiAkhir >= 80 && $nilaiAkhir <= 100) {
            return "A";
        } elseif ($nilaiAkhir >= 70 && $nilaiAkhir < 80) {
            return "B";
        } elseif ($nilaiAkhir >= 60 && $nilaiAkhir < 70) {
            return "C";
        } elseif ($nilaiAkhir >= 50 && $nilaiAkhir < 60) {
            return "D";
        } elseif ($nilaiAkhir >= 0 && $nilaiAkhir < 50) {
            return "E";
        } else {
            return "Nilai tidak valid";
        }
    }

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>UTS</th>
            <th>UAS</th>
            <th>Nilai Akhir</th>
            <th>Nilai Huruf</th>
            </tr>";
    foreach ($mahasiswa as $mhs) {
        $nilaiAkhir = finalScore($mhs["uts"], $mhs["uas"]);
        $nilaiHuruf = finalScoreHuruf($nilaiAkhir);
        echo "<tr>
                <td>{$mhs['nama']}</td>
                <td>{$mhs['nim']}</td>
                <td>{$mhs['uts']}</td>
                <td>{$mhs['uas']}</td>
                <td>{$nilaiAkhir}</td>
                <td>{$nilaiHuruf}</td>
                </tr>";
    }
    echo "</table>";
    ?>
</body>

</html>