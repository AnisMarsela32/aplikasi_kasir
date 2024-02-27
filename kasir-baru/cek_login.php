<?php

$koneksi = mysqli_connect("localhost", "root", "", "database_kasir");

$nama_pengguna = $_POST['nama_pengguna'];
$kata_sandi= $_POST['kata_sandi'];

$query = "SELECT * FROM pengguna WHERE nama_pengguna='$nama_pengguna' AND kata_sandi='$kata_sandi'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    session_start();
    $_SESSION['level'] = $data['level'];
    $_SESSION['id_pengguna'] = $data['id_pengguna'];

    if ($data['level'] == "admin") {
        header("Location: admin/index.php");
    } else {
        header("Location: kasir/index.php");
    }
} else {
    echo "Username atau password salah!";
}

?>