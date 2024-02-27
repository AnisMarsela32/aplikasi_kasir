<?php
include '../../layout/header.php';
// Connect to database
include "../../koneksi.php";
$db = new database();

$produk = $db->tampil_produk();
$pengguna = $db->tampil_pengguna();
$pelanggan = $db->tampil_pelanggan();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kasir = $_POST['id_kasir'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    $db->tambah_penjualan($id_kasir, $id_pelanggan, $id_produk, $jumlah);

}

$hargaSatuanData = [];
foreach ($produk as $row) {
    $hargaSatuanData[$row['id_produk']] = $row['harga'];
}

?>

<div class="card card-body" style="margin-top: 3rem;">
    <h3>Data Penjualan >> Tambah Data</h3>

    <form action="" method="post">
        <table class="mt-2">

            <tr>
                <th>Kasir</th>
                <td>
                    <select name="id_kasir" id="kasir">
                        <?php
                        foreach($pengguna as $row) {
                            echo "<option value='" . $row['id_pengguna'] . "'>" . $row['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <td>
                    <select name="id_pelanggan" id="pelanggan">
                        <?php
                        foreach($pelanggan as $row) {
                            echo "<option value='" . $row['id_pelanggan'] . "'>" . $row['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Produk</th>
                <td>
                    <select name="id_produk" id="produk" onchange="updateHargaSatuan()">
                        <?php
                        // Reset pointer result untuk iterasi ulang
                        reset($produk);

                        foreach($produk as $row) {
                            echo "<option value='" . $row['id_produk'] . "'>" . $row['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th>Jumlah</th>
                <td>
                    <input type="text" name="jumlah" id="jumlah" onkeyup="updateTotalHarga()">
                </td>
            </tr>

            <tr>
                <th>Harga Satuan</th>
                <td>
                    <input type="text" name="harga_satuan" id="harga_satuan" readonly>
                </td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>
                    <input type="text" name="total_harga" id="total_harga" readonly>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-info text-white">Tambah</button>
                    <button type="reset" class="btn btn-info text-white">Batal</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    // Inisialisasi hargaSatuanData dari PHP ke JavaScript
    var hargaSatuanData = <?php echo json_encode($hargaSatuanData); ?>;
</script>

<!-- Sertakan script.js di bawah ini -->
<script src="../../assets/js/script.js"></script>

<?php include "../../layout/footer.php"; ?>