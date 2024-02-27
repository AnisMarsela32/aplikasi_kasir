<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pengguna</title>
    <style>
        /* CSS untuk mencetak */
        @media print {
            body {
                font-family: Arial, sans-serif;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            h1 {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <?php
    require_once '../../koneksi.php'; 

    $database = new database();
    $data_pengguna = $database->tampil_pengguna();

    if ($data_pengguna) {
        echo '<h1>Data Pengguna</h1>';
        echo '<table>';
        echo '<tr><th>ID Pengguna</th><th>Nama</th><th>Nama Pengguna</th><th>Level</th></tr>';
        foreach ($data_pengguna as $pengguna) {
            echo '<tr>';
            echo '<td>' . $pengguna['id_pengguna'] . '</td>';
            echo '<td>' . $pengguna['nama'] . '</td>';
            echo '<td>' . $pengguna['nama_pengguna'] . '</td>';
            echo '<td>' . $pengguna['level'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Tidak ada data pengguna yang tersedia.</p>';
    }
    ?>

    <script>
        // Lakukan pencetakan secara otomatis ketika halaman selesai dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
