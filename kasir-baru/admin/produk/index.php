<?php
include "../../layout/header.php";
include "../../koneksi.php";
$db = new database();

// Pencarian produk
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $produk = $db->cari_produk($keyword);
} else {
    $produk = $db->tampil_produk();
}
?>


<div class="card card-body" style="margin-top: 3rem;">
    <h1>Data Produk</h1>

    <div class="row">
        <div class="col d-flex align-items-center">
            <form action="" method="get">
                <input type="search" name="keyword" class="ms-2 me-0" placeholder="Search here" value="<?php echo isset($keyword) ? htmlspecialchars($keyword) : ''; ?>">
                <button type="submit" class="btn-search ms-0 border-0"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="col d-flex justify-content-end">
            <a href="tambah.php" class="btn btn-primary aksi2">+ Tambah Data</a>
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
                    <th><i class="fa-solid fa-gear"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($produk as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id_produk'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>" . $row['stok'] . "</td>";
                    echo '<td class="d-flex justify-content-center">';
                    echo "<a href='edit.php?id_produk=" . $row['id_produk'] . "' class='btn btn-primary aksi'><i class='fas fa-edit'></i></a>'";
                    echo "<a href='hapus.php?id_produk=" . $row['id_produk'] . "' class='btn btn-primary aksi'><i class='fas fa-trash-alt'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>


</div>


<?php include "../../layout/footer.php"; ?>