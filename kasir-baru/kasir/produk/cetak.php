<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Produk</title>
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
    $data_produk = $database->tampil_produk();

    if ($data_produk) {
        echo '<h1>Data Produk</h1>';
        echo '<table>';
        echo '<tr><th>ID Produk</th><th>Nama</th><th>Harga</th><th>Stok</th></tr>';
        foreach ($data_produk as $produk) {
            echo '<tr>';
            echo '<td>' . $produk['id_produk'] . '</td>';
            echo '<td>' . $produk['nama'] . '</td>';
            echo '<td>' . $produk['harga'] . '</td>';
            echo '<td>' . $produk['stok'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Tidak ada data produk yang tersedia.</p>';
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
