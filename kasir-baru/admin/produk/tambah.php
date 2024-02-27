<?php 
include "../../layout/header.php"; 
include "../../koneksi.php";
$db = new database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Panggil fungsi tambah_produk untuk memproses penambahan data
    $db->tambah_produk($nama, $harga, $stok);
}
?>

<div class="card card-body" style="margin-top: 3rem;">
    <h3>Data Produk >> Tambah Data</h3>

    <form action="" method="post">
        <table class="mt-2">
            <tr>
                <th>Nama</th>
                <td>
                    <input type="text" name="nama">
                </td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>
                    <input type="number" name="harga">
                </td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>
                    <input type="number" name="stok">
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

<?php include "../../layout/footer.php"; ?>
