<?php

include "../../layout/kasir/header.php";
include "../../koneksi.php";
$db = new database();
$pelanggan = $db->tampil_pelanggan();

?>


<div class="card card-body" style="margin-top: 3rem;">
    <h1>Data Pelanggan</h1>

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
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pelanggan as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id_pelanggan'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";
                    echo "<td>" . $row['telepon'] . "</td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>


</div>


<?php include "../../layout/kasir/footer.php"; ?>