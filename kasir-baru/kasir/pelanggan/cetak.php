<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pelanggan</title>
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
    $data_pelanggan = $database->tampil_pelanggan();

    if ($data_pelanggan) {
        echo '<h1>Data Pelanggan</h1>';
        echo '<table>';
        echo '<tr><th>ID Pelanggan</th><th>Nama</th><th>Alamat</th><th>Telepon</th></tr>';
        foreach ($data_pelanggan as $pelanggan) {
            echo '<tr>';
            echo '<td>' . $pelanggan['id_pelanggan'] . '</td>';
            echo '<td>' . $pelanggan['nama'] . '</td>';
            echo '<td>' . $pelanggan['alamat'] . '</td>';
            echo '<td>' . $pelanggan['telepon'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Tidak ada data pelanggan yang tersedia.</p>';
    }
    ?>


</body>
</html>

<script>
    window.print();
</script>
