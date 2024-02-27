<?php

include "../../koneksi.php";
$db = new database();

// Proses penghapusan produk jika ID produk dikirimkan melalui parameter URL
$id_produk = $_GET['id_produk'];
$db->hapus_produk($id_produk);