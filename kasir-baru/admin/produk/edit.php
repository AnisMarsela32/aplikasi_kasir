<?php 
include "../../layout/header.php"; 
include "../../koneksi.php";
$db = new database();

// Ambil ID produk yang akan diedit dari parameter URL
if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];
    
    // Ambil data produk berdasarkan ID
    $produk = $db->ambil_produk_by_id($id_produk);
    
    // Jika produk tidak ditemukan, redirect ke halaman lain atau tampilkan pesan error
    if (!$produk) {
        echo "Produk tidak ditemukan.";
        exit;
    }
} else {
    echo "ID produk tidak diberikan dalam URL.";
    exit;
}

// Proses update produk jika ada data yang dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Panggil fungsi update_produk untuk memproses pembaruan data
    $db->update_produk($id_produk, $nama, $harga, $stok);
}
?>

<div class="card card-body" style="margin-top: 3rem;">
    <h3>Data Produk >> Edit Data</h3>

    <form action="" method="post">
        <table class="mt-2">
            <tr>
                <th>Nama</th>
                <td>
                    <input type="text" name="nama" value="<?php echo htmlspecialchars($produk['nama']); ?>">
                </td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>
                    <input type="number" name="harga" value="<?php echo htmlspecialchars($produk['harga']); ?>">
                </td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>
                    <input type="number" name="stok" value="<?php echo htmlspecialchars($produk['stok']); ?>">
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

<?php include "../../layout/footer.php"; ?>
