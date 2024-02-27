<?php 
include "../../layout/header.php"; 
include "../../koneksi.php";
$db = new database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    // Panggil fungsi tambah_pelanggan untuk memproses penambahan data
    $db->tambah_pelanggan($nama, $alamat, $telepon);
}
?>


<div class="card card-body" style="margin-top: 3rem;">


    <h3>Data Pelanggan >> Tambah Data</h3>

    <form action="" method="post">
    <table class="mt-2">
        <tr>
            <th>Nama</th>
            <td>
                <input type="text" name="nama">
            </td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>
                <input type="text" name="alamat">
            </td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>
                <input type="text" name="telepon">
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