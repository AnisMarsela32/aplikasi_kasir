<?php
include "koneksi.php";
$db = new database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_pengguna = $_POST['nama_pengguna'];
    $kata_sandi = $_POST['kata_sandi'];

    // Panggil fungsi tambah_produk untuk memproses penambahan data
    $db->cek_login($nama_pengguna, $kata_sandi);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/kasir-baru/assets/css/style.css">
    <link rel="stylesheet" href="http://localhost/kasir-baru/assets/bootstrap/css/bootstrap.min.css">

    <title>Document</title>
</head>
<style>
    body {
        background: url(img/endog.jpg);
        background-position: center;
        background-attachment: fixed;
        background-size: contain;
        background-repeat: no-repeat;
        background-color: #fff;
    }
</style>

<body>

    <div class="kotak-login">
        <div class="kotak2 pt-3">
            <form action="" method="post">
                <div class="mb-3 pt-4 px-3 mx-auto">
                    <!-- <label>Username</label> -->
                    <input type="text" name="nama_pengguna" placeholder="username">
                </div>
                <div class="mb-0 px-3">
                    <!-- <label>Password</label> -->
                    <input type="password" name="kata_sandi" placeholder="password">
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>






</body>

</html>