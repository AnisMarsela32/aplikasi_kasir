<?php 
include "../../layout/kasir/header.php"; 
include "../../koneksi.php";
$db = new database();
$produk = $db->tampil_produk();
?>


<div class="card card-body" style="margin-top: 3rem;">
    <h1>Data Produk</h1>

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
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                </tr>
            </thead>
            <tbody>
              <?php
              foreach($produk as $row) {
                  echo "<tr>";
                  echo "<td>" . $row['id_produk'] . "</td>";
                  echo "<td>" . $row['nama'] . "</td>";
                  echo "<td>" . $row['harga'] . "</td>";
                  echo "<td>" . $row['stok'] . "</td>";
                  echo "</tr>";
                }
             
              ?>
            </tbody>
        </table>
    </div>


</div>


<?php include "../../layout/kasir/footer.php"; ?>