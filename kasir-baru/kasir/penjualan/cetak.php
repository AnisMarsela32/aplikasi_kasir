<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Penjualan</title>
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
    $data_penjualan = $database->tampil_penjualan();

    if ($data_penjualan) {
        echo '<h1>Data Penjualan</h1>';
        echo '<table>';
        echo '<tr><th>ID Penjualan</th><th>Tanggal</th><th>Total Harga</th><th>Nama Kasir</th><th>Nama Pelanggan</th><th>Nama Produk</th><th>Jumlah</th><th>Harga Satuan</th></tr>';
        foreach ($data_penjualan as $penjualan) {
            echo '<tr>';
            echo '<td>' . $penjualan['id_penjualan'] . '</td>';
            echo '<td>' . $penjualan['tanggal'] . '</td>';
            echo '<td>' . $penjualan['total_harga'] . '</td>';
            echo '<td>' . $penjualan['nama_kasir'] . '</td>';
            echo '<td>' . $penjualan['nama_pelanggan'] . '</td>';
            echo '<td>' . $penjualan['nama_produk'] . '</td>';
            echo '<td>' . $penjualan['jumlah'] . '</td>';
            echo '<td>' . $penjualan['harga_satuan'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Tidak ada data penjualan yang tersedia.</p>';
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
