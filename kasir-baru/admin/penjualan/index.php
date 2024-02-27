<?php
include "../../layout/header.php";
include "../../koneksi.php";
$db = new database();

// Fungsi untuk mencari penjualan berdasarkan kata kunci
function cari_penjualan($keyword)
{
    global $db;
    $penjualan = $db->cari_penjualan($keyword);
    return $penjualan;
}

// Ambil kata kunci pencarian dari URL jika ada
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Lakukan pencarian hanya jika kata kunci tidak kosong
if (!empty($keyword)) {
    $penjualan = cari_penjualan($keyword);
} else {
    // Jika kata kunci kosong, tampilkan semua data penjualan
    $penjualan = $db->tampil_penjualan();
}
?>

<div class="card card-body" style="margin-top: 3rem;">
    <h1>Data Penjualan</h1>

    <div class="row">
        <div class="col d-flex justify-content-start align-items-center">
            <form action="" method="get">
                <input type="search" name="keyword" class="ms-2 me-0" placeholder="Search here" value="<?php echo htmlspecialchars($keyword); ?>">
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
                    <th>ID Penjualan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Kasir</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Bayar</th>
                    <th><i class="fa-solid fa-gear"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($penjualan as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id_penjualan'] . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "<td>" . $row['nama_kasir'] . "</td>";
                    echo "<td>" . $row['nama_pelanggan'] . "</td>";
                    echo "<td>" . $row['nama_produk'] . "</td>";
                    echo "<td>" . $row['jumlah'] . "</td>";
                    echo "<td>" . $row['harga_satuan'] . "</td>";
                    echo "<td>" . $row['total_harga'] . "</td>";
                    echo '<td class="d-flex justify-content-center">';
                    echo "<a href='edit.php?id_penjualan=" . $row['id_penjualan'] . "' class='btn btn-primary aksi'><i class='fas fa-edit'></i></a>'";
                    echo "<a href='hapus.php?id_penjualan=" . $row['id_penjualan'] . "' class='btn btn-primary aksi'><i class='fas fa-trash-alt'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../../layout/footer.php"; ?>