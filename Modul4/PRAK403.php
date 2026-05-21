<!DOCTYPE html>
<html>

<head>
    <style>
        th {
            background-color: #d3d3d3;
        }

        .red {
            background-color: red;
        }

        .green {
            background-color: green;
        }
    </style>
</head>

<body>
    <?php
    $mahasiswa = [
        [
            "nama" => "Ridho",
            "mata_kuliah" => [
                ["mk" => "Pemrograman I", "sks" => "2"],
                ["mk" => "Praktikum Pemrograman I", "sks" => "1"],
                ["mk" => "Pengantar Lingkungan Lahan Basah", "sks" => "2"],
                ["mk" => "Arsitektur Komputer", "sks" => "3"]
            ]
        ],
        [
            "nama" => "Ratna",
            "mata_kuliah" => [
                ["mk" => "Basis Data I", "sks" => "2"],
                ["mk" => "Praktikum Basis Data I", "sks" => "1"],
                ["mk" => "Kalkulus", "sks" => "3"]
            ]
        ],
        [
            "nama" => "Tono",
            "mata_kuliah" => [
                ["mk" => "Rekayasa Perangkat Lunak", "sks" => "3"],
                ["mk" => "Analisis dan Perancangan Sistem", "sks" => "3"],
                ["mk" => "Komputasi Awan", "sks" => "3"],
                ["mk" => "Kecerdasan Bisnis", "sks" => "3"]
            ]
        ]
    ];

    foreach ($mahasiswa as $mhs => $data) {
        $total_sks = 0;
        foreach ($data['mata_kuliah'] as $mk) {
            $total_sks += intval($mk['sks']);
        }
        $mahasiswa[$mhs]['total_sks'] = $total_sks;
        $mahasiswa[$mhs]['status'] = ($total_sks > 7) ? "Tidak Revisi" : "Revisi KRS";
    }
    ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Total SKS</th>
            <th>Keterangan</th>
        </tr>

        <?php
        $no = 1;
        foreach ($mahasiswa as $data) {
            $total_sks = $data['total_sks'];
            $status = $data['status'];
            $class = ($status === "Tidak Revisi") ? "green" : "red";
            $is_first_line = true;

            foreach ($data['mata_kuliah'] as $mk) {
                echo "<tr>";
                if ($is_first_line) {
                    echo "<td>$no</td>";
                    echo "<td>{$data['nama']}</td>";
                    $no++;
                } else {
                    echo "<td></td><td></td>";
                }
                echo "<td>{$mk['mk']}</td>";
                echo "<td>{$mk['sks']}</td>";

                if ($is_first_line) {
                    echo "<td>$total_sks</td>";
                    echo "<td class='$class'>$status</td>";
                    $is_first_line = false;
                } else {
                    echo "<td></td><td></td>";
                }

                echo "</tr>";
            }
        }
        ?>
    </table>
</body>

</html>