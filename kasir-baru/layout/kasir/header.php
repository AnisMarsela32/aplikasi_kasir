<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- link css -->
    <link rel="stylesheet" href="http://localhost/kasir-baru/assets/css/style.css">
    <link rel="stylesheet" href="http://localhost/kasir-baru/assets/bootstrap/css/bootstrap.min.css">

    <title>Aplikasi Anis</title>
</head>

<body>

<div class="sidebar">
    <div class="d-flex justify-content-center p-3">
        <img src="http://localhost/kasir-baru/img/user.png" class="mx-auto img-fluid" style="width: 70px;">
    </div>
    <a <?php if(strpos($_SERVER['REQUEST_URI'], '/kasir/index.php') !== false) echo 'class="active"'; ?> href="http://localhost/kasir-baru/kasir/index.php"><i class="fa-solid fa-house-chimney"></i> Dashboard</a>
    <a <?php if(strpos($_SERVER['REQUEST_URI'], '/kasir/pengguna/index.php') !== false) echo 'class="active"'; ?> href="http://localhost/kasir-baru/kasir/pengguna/index.php"><i class="fa-solid fa-users"></i> Pengguna</a>
    <a <?php if(strpos($_SERVER['REQUEST_URI'], '/kasir/pelanggan/index.php') !== false) echo 'class="active"'; ?> href="http://localhost/kasir-baru/kasir/pelanggan/index.php"><i class="fa-solid fa-user"></i> Pelanggan</a>
    <a <?php if(strpos($_SERVER['REQUEST_URI'], '/kasir/produk/index.php') !== false) echo 'class="active"'; ?> href="http://localhost/kasir-baru/kasir/produk/index.php"><i class="fa-solid fa-store"></i> Produk</a>
    <a <?php if(strpos($_SERVER['REQUEST_URI'], '/kasir/penjualan/index.php') !== false) echo 'class="active"'; ?> href="http://localhost/kasir-baru/kasir/penjualan/index.php"><i class="fa-solid fa-money-bill-transfer"></i> Penjualan</a>
    <a href="http://localhost/kasir-baru/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>



    <div class="content mt-3">

        <nav class="navbar navbar-expand-lg mb-5 sticky-top" style="top: 2rem;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
            </div>
        </nav>