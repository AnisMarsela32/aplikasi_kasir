<?php 
include "../../layout/header.php"; 
include "../../koneksi.php";
$db = new database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $kata_sandi = $_POST['kata_sandi'];
    $level = $_POST['level'];

    // Panggil fungsi tambah_pengguna untuk memproses penambahan data
    $db->tambah_pengguna($nama, $nama_pengguna, $kata_sandi, $level);
}
?>

<div class="card card-body" style="margin-top: 3rem;">
    <h3>Data Pengguna >> Tambah Data</h3>

    <form action="" method="post">
        <table class="mt-2">
            <tr>
                <th>Nama</th>
                <td>
                    <input type="text" name="nama">
                </td>
            </tr>
            <tr>
                <th>Nama Pengguna</th>
                <td>
                    <input type="text" name="nama_pengguna">
                </td>
            </tr>
            <tr>
                <th>Kata Sandi</th>
                <td>
                    <input type="password" name="kata_sandi">
                </td>
            </tr>
            <tr>
                <th>Level</th>
                <td>
                    <select name="level">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
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
