<?php 
include "../../layout/kasir/header.php";
include "../../koneksi.php";
$db = new database();
$penjualan = $db->tampil_penjualan();
 ?>


<div class="card card-body" style="margin-top: 3rem;">
    <h1>Data Penjualan</h1>

    <div class="row">
        <div class="col d-flex align-items-center">
            <input type="search" class="ms-2" placeholder="Search here">
            <i class="fas fa-search"></i>
        </div>
        <div class="col d-flex justify-content-end">
            <!-- <a href="" class="btn btn-primary aksi2">+ Tambah Data</a> -->
            <a href="cetak.php" class="btn btn-primary aksi2"><i class="fa-solid fa-cloud-arrow-up"></i> Cetak</a>
        </div>
    </div>

   

    <div class="table-container">
        <table class="table-columns" cellpadding="8">
            <thead>
                <tr class="table-atas">
                    <th>ID Penjualan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Kasir</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($penjualan as $row){
                        echo "<tr>";
                        echo "<td>" . $row['id_penjualan'] . "</td>";
                        echo "<td>" . $row['tanggal'] . "</td>";
                        echo "<td>" . $row['nama_kasir'] . "</td>";
                        echo "<td>" . $row['nama_pelanggan'] . "</td>";
                        echo "<td>" . $row['nama_produk'] . "</td>";
                        echo "<td>" . $row['jumlah'] . "</td>";
                        echo "<td>" . $row['harga_satuan'] . "</td>";
                        echo "<td>" . $row['total_harga'] . "</td>";
                        echo "</tr>";
                    }
                
                ?>
            </tbody>
        </table>
    </div>


</div>


<?php include "../../layout/kasir/footer.php"; ?>