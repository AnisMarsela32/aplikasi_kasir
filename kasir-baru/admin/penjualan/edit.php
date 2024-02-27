<?php
include '../../layout/header.php';
include "../../koneksi.php";
$db = new database();


if (isset($_GET['id_penjualan'])) {
    $id_penjualan = $_GET['id_penjualan'];

    // Fetch the penjualan record from the database
    $penjualan_query = "SELECT * FROM penjualan WHERE id_penjualan = '$id_penjualan'";
    $penjualan_result = mysqli_query($db->koneksi, $penjualan_query);

    if ($penjualan_result && mysqli_num_rows($penjualan_result) > 0) {
        $penjualan_row = mysqli_fetch_assoc($penjualan_result);

        $produk = $db->tampil_produk();
        $pengguna = $db->tampil_pengguna();
        $pelanggan = $db->tampil_pelanggan();

        $hargaSatuanData = [];
        foreach ($produk as $produk_row) {
            $hargaSatuanData[$produk_row['id_produk']] = $produk_row['harga'];
        }

        // Initialize jumlah and harga_satuan
        $id_pengguna = $penjualan_row['id_kasir'];
        $id_pelanggan = $penjualan_row['id_pelanggan'];
        $id_produk = $penjualan_row['id_produk'];
        $jumlah = $penjualan_row['jumlah'];

        // Fetch harga_satuan based on the selected product
        $harga_satuan_query = "SELECT harga FROM produk WHERE id_produk = '$id_produk'";
        $harga_satuan_result = mysqli_query($db->koneksi, $harga_satuan_query);

        if ($harga_satuan_result && mysqli_num_rows($harga_satuan_result) > 0) {
            $harga_satuan_row = mysqli_fetch_assoc($harga_satuan_result);
            $harga_satuan = $harga_satuan_row['harga'];
        } else {
            $harga_satuan = 0; // Set a default value or handle the error accordingly
        }
    } else {
        echo "Penjualan not found.";
        exit;
    }
} else {
    echo "ID not provided in the URL.";
    exit;
}

// **Process form submission**
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $id_pengguna = $_POST['id_pengguna'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    $db->edit_penjualan($id_penjualan, $id_pengguna, $id_pelanggan, $id_produk, $jumlah);
}
?>

<div class="card card-body" style="margin-top: 3rem;">
    <h3>Data Penjualan >> Edit Data</h3>

    <form action="" method="post">
        <table class="mt-2">

            <tr>
                <th>Kasir</th>
                <td>
                    <select name="id_pengguna" id="kasir">
                        <?php
                        foreach ($pengguna as $row) {
                            $selected = ($row['id_kasir'] == $id_kasir) ? 'selected' : '';
                            echo "<option value='" . $row['id_pengguna'] . "' $selected>" . $row['nama'] . "</option>";
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
                        foreach ($pelanggan as $row) {
                            $selected = ($row['id_pelanggan'] == $id_pelanggan) ? 'selected' : '';
                            echo "<option value='" . $row['id_pelanggan'] . "' $selected>" . $row['nama'] . "</option>";
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

                        foreach ($produk as $row) {
                            $selected = ($row['id_produk'] == $id_produk) ? 'selected' : '';
                            echo "<option value='" . $row['id_produk'] . "' $selected>" . $row['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th>Jumlah</th>
                <td>
                    <input type="text" name="jumlah" id="jumlah" onkeyup="updateTotalHarga()" value="<?php echo $jumlah; ?>">
                </td>
            </tr>

            <tr>
                <th>Harga Satuan</th>
                <td>
                    <input type="text" name="harga_satuan" id="harga_satuan" readonly value="<?php echo $harga_satuan; ?>">
                </td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>
                    <input type="text" name="total_harga" id="total_harga" readonly value="<?php echo isset($total_harga) ? $total_harga : ''; ?>">
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-info text-white">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-info text-white">Batal</a>
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