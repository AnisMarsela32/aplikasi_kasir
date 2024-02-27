<?php
include "../../layout/kasir/header.php";
include '../../koneksi.php';
$db = new database();
$pengguna = $db->tampil_pengguna();
?>


<div class="card card-body" style="margin-top: 3rem;">
    <h1>Data Pengguna</h1>

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
                    <th>Nama Pengguna</th>
                    <th>Kata Sandi</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pengguna as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id_pengguna'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['nama_pengguna'] . "</td>";
                    echo "<td>" . $row['kata_sandi'] . "</td>";
                    echo "<td>" . $row['level'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


</div>


<?php include "../../layout/kasir/footer.php"; ?>