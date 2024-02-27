<?php
include "../../layout/header.php";

$koneksi = mysqli_connect("localhost", "root", "", "database_kasir");

// Inisialisasi variabel pesan
$pesan = "";

// Cek apakah parameter id di-set pada URL
if (isset($_GET['id_pengguna'])) {
    // Ambil ID pengguna dari parameter URL
    $id_pengguna = $_GET['id_pengguna'];

    // Query untuk menghapus data pengguna dari database
    $query = "DELETE FROM pengguna WHERE id_pengguna='$id_pengguna'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika berhasil hapus data, arahkan ke halaman index.php
        header("Location: index.php");
        exit();
   
    }
}
?>



<?php include "../../layout/footer.php"; ?>
