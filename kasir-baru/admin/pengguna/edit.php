<?php
include "../../layout/header.php";

$koneksi = mysqli_connect("localhost", "root", "", "database_kasir");

// Inisialisasi variabel pesan
$pesan = "";

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_pengguna = $_POST['id_pengguna'];
    $nama = $_POST['nama'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $kata_sandi = $_POST['kata_sandi'];
    $level = $_POST['level'];

    // Query untuk mengupdate data pengguna ke database
    $query = "UPDATE pengguna SET nama='$nama', nama_pengguna='$nama_pengguna', kata_sandi='$kata_sandi', level='$level' WHERE id_pengguna='$id_pengguna'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika berhasil edit data, arahkan ke halaman index.php
        header("Location: index.php");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        $pesan = "Gagal mengedit data pengguna. Silakan coba lagi.";
    }
} else {
    // Ambil ID pengguna yang akan diedit dari parameter URL
    $id_pengguna = $_GET['id_pengguna'];

    // Query untuk mengambil data pengguna yang akan diedit
    $query_select = "SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna'";
    $result_select = mysqli_query($koneksi, $query_select);

    if (mysqli_num_rows($result_select) > 0) {
        $data_pengguna = mysqli_fetch_assoc($result_select);
    } else {
        // Jika tidak ada data pengguna dengan ID yang sesuai, arahkan ke halaman index.php
        header("Location: index.php");
        exit();
    }
}

?>

<div class="card card-body" style="margin-top: 3rem;">

    <h3>Data Pengguna >> Edit Data</h3>

    <!-- Tampilkan pesan error jika ada -->
    <?php if ($pesan != "") { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $pesan; ?>
        </div>
    <?php } ?>

    <!-- Form untuk mengedit data pengguna -->
    <form action="" method="POST">
        <input type="hidden" name="id_pengguna" value="<?php echo $data_pengguna['id_pengguna']; ?>">
        <table class="mt-2">
            <tr>
                <th>Nama</th>
                <td>
                    <input type="text" class="form-control" name="nama" value="<?php echo $data_pengguna['nama']; ?>" required>
                </td>
            </tr>
            <tr>
                <th>Nama Pengguna</th>
                <td>
                    <input type="text" class="form-control" name="nama_pengguna" value="<?php echo $data_pengguna['nama_pengguna']; ?>" required>
                </td>
            </tr>
            <tr>
                <th>Kata Sandi</th>
                <td>
                    <input type="text" class="form-control" name="kata_sandi" value="<?php echo $data_pengguna['kata_sandi']; ?>" required>
                </td>
            </tr>
            <tr>
                <th>Level</th>
                <td>
                    <select name="level" class="form-control" required>
                        <option value="admin" <?php echo ($data_pengguna['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="user" <?php echo ($data_pengguna['level'] == 'user') ? 'selected' : ''; ?>>User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-info text-white">Edit</button>
                    <a href="index.php" class="btn btn-info text-white">Batal</a>
                </td>
            </tr>
        </table>
    </form>

</div>

<?php include "../../layout/footer.php"; ?>
