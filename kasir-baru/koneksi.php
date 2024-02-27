
<?php
class database
{

    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "database_kasir";
    var $koneksi = "";

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    public function cek_login($nama_pengguna, $kata_sandi)
    {
        $query = "SELECT * FROM pengguna WHERE nama_pengguna='$nama_pengguna' AND kata_sandi='$kata_sandi'";
        $result = mysqli_query($this->koneksi, $query);

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
    }


    public function tampil_pengguna()
    {
        // Mulai sesi jika belum dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Periksa apakah pengguna bukan admin dan bukan user
        if ($_SESSION['level'] != "admin" && $_SESSION['level'] != "user") {
            header("Location: ../../index.php");
            exit;
        }
        $data = mysqli_query($this->koneksi, "SELECT * from pengguna");
        $hasil = array(); // Inisialisasi array hasil
        // Periksa apakah ada hasil yang ditemukan
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tampil_produk()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Periksa apakah pengguna bukan admin dan bukan user
        if ($_SESSION['level'] != "admin" && $_SESSION['level'] != "user") {
            header("Location: ../../index.php");
            exit;
        }

        $data = mysqli_query($this->koneksi, "SELECT * from produk");
        $hasul = array();
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tampil_pelanggan()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Periksa apakah pengguna bukan admin dan bukan user
        if ($_SESSION['level'] != "admin" && $_SESSION['level'] != "user") {
            header("Location: ../../index.php");
            exit;
        }

        $data = mysqli_query($this->koneksi, "SELECT * from pelanggan");
        $hasul = array();
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }


    function tampil_penjualan()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Periksa apakah pengguna bukan admin dan bukan user
        if ($_SESSION['level'] != "admin" && $_SESSION['level'] != "user") {
            header("Location: ../../index.php");
            exit;
        }

        $sql = "SELECT p.id_penjualan, p.tanggal, p.total_harga,
        u.nama AS nama_kasir, pl.nama AS nama_pelanggan,
        pr.nama AS nama_produk, p.jumlah, p.harga_satuan
        FROM penjualan p
        INNER JOIN pengguna u ON p.id_kasir = u.id_pengguna
        INNER JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
        INNER JOIN produk pr ON p.id_produk = pr.id_produk";

        $data = mysqli_query($this->koneksi, $sql);
        $hasul = array();
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }


    function tambah_pelanggan($nama, $alamat, $telepon)
    {

        // Query untuk menambahkan data pelanggan
        $query = "INSERT INTO pelanggan (nama, alamat, telepon) VALUES ('$nama', '$alamat', '$telepon')";

        // Eksekusi query
        if (mysqli_query($this->koneksi, $query)) {
            // Jika berhasil, alihkan ke halaman index.php
            header("Location: index.php");
            exit;
        } else {
            // Jika gagal, tampilkan pesan error atau lakukan penanganan yang sesuai
            echo "Error: " . $query . "<br>" . mysqli_error($this->koneksi);
        }
    }

    function tambah_pengguna($nama, $nama_pengguna, $kata_sandi, $level)
    {
        // Query untuk menambahkan data pengguna
        $query = "INSERT INTO pengguna (nama, nama_pengguna, kata_sandi, level) VALUES ('$nama', '$nama_pengguna', '$kata_sandi', '$level')";

        // Eksekusi query
        if (mysqli_query($this->koneksi, $query)) {
            // Jika berhasil, alihkan ke halaman index.php
            header("Location: index.php");
            exit;
        } else {
            // Jika gagal, tampilkan pesan error atau lakukan penanganan yang sesuai
            echo "Error: " . $query . "<br>" . mysqli_error($this->koneksi);
        }
    }

    function tambah_produk($nama, $harga, $stok)
    {
        // Query untuk menambahkan data produk
        $query = "INSERT INTO produk (nama, harga, stok) VALUES ('$nama', $harga, $stok)";

        // Eksekusi query
        if (mysqli_query($this->koneksi, $query)) {
            // Jika berhasil, alihkan ke halaman index.php
            header("Location: index.php");
            exit;
        } else {
            // Jika gagal, tampilkan pesan error atau lakukan penanganan yang sesuai
            echo "Error: " . $query . "<br>" . mysqli_error($this->koneksi);
        }
    }

    function tambah_penjualan($id_kasir, $id_pelanggan, $id_produk, $jumlah)
{
    try {
        // Mulai transaksi
        mysqli_begin_transaction($this->koneksi);

        $harga_satuan_query = "SELECT harga, stok FROM produk WHERE id_produk = '$id_produk' FOR UPDATE";
        $harga_satuan_result = mysqli_query($this->koneksi, $harga_satuan_query);

        if ($harga_satuan_result && mysqli_num_rows($harga_satuan_result) > 0) {
            $harga_satuan_row = mysqli_fetch_assoc($harga_satuan_result);
            $harga_satuan = $harga_satuan_row['harga'];
            $stok = $harga_satuan_row['stok'];
        } else {
            throw new Exception("Produk tidak ditemukan.");
        }

        if ($stok < $jumlah) {
            throw new Exception("Stok tidak mencukupi.");
        }

        $total_harga = $jumlah * $harga_satuan;

        $sql_penjualan =  "INSERT INTO penjualan(tanggal, id_kasir, id_pelanggan, id_produk, jumlah, harga_satuan, total_harga) VALUES (NOW(), '$id_kasir', '$id_pelanggan', '$id_produk', '$jumlah', '$harga_satuan', '$total_harga')";

        if (!mysqli_query($this->koneksi, $sql_penjualan)) {
            throw new Exception(mysqli_error($this->koneksi));
        }

        // Kurangi stok produk
        $stok_baru = $stok - $jumlah;
        $sql_update_stok = "UPDATE produk SET stok = '$stok_baru' WHERE id_produk = '$id_produk'";
        if (!mysqli_query($this->koneksi, $sql_update_stok)) {
            throw new Exception(mysqli_error($this->koneksi));
        }

        // Commit transaksi jika semua operasi berhasil
        mysqli_commit($this->koneksi);
        header("Location: index.php");
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        mysqli_rollback($this->koneksi);
        echo "Error: " . $e->getMessage();
    }
}




function edit_penjualan($penjualan_id, $id_pengguna, $id_pelanggan, $id_produk, $jumlah)
{
    // Start transaction
    mysqli_begin_transaction($this->koneksi);

    try {
        // Fetch data penjualan sebelumnya
        $penjualan_sebelumnya_query = "SELECT id_produk, jumlah FROM penjualan WHERE id_penjualan = '$penjualan_id'";
        $penjualan_sebelumnya_result = mysqli_query($this->koneksi, $penjualan_sebelumnya_query);
        if (!$penjualan_sebelumnya_result || mysqli_num_rows($penjualan_sebelumnya_result) == 0) {
            throw new Exception("Penjualan tidak ditemukan.");
        }
        $penjualan_sebelumnya_row = mysqli_fetch_assoc($penjualan_sebelumnya_result);
        $id_produk_sebelumnya = $penjualan_sebelumnya_row['id_produk'];
        $jumlah_sebelumnya = $penjualan_sebelumnya_row['jumlah'];

        // Fetch harga_satuan based on the selected product
        $harga_satuan_query = "SELECT harga FROM produk WHERE id_produk = '$id_produk'";
        $harga_satuan_result = mysqli_query($this->koneksi, $harga_satuan_query);
        if (!$harga_satuan_result || mysqli_num_rows($harga_satuan_result) == 0) {
            throw new Exception("Produk tidak ditemukan.");
        }
        $harga_satuan_row = mysqli_fetch_assoc($harga_satuan_result);
        $harga_satuan = $harga_satuan_row['harga'];

        // Calculate the total price
        $total_harga = $jumlah * $harga_satuan;

        // Update the data in the database
        $update_sql = "UPDATE penjualan SET id_kasir='$id_pengguna', id_pelanggan='$id_pelanggan', id_produk='$id_produk', jumlah='$jumlah', harga_satuan='$harga_satuan', total_harga='$total_harga' WHERE id_penjualan='$penjualan_id'";
        if (!mysqli_query($this->koneksi, $update_sql)) {
            throw new Exception("Error updating penjualan: " . mysqli_error($this->koneksi));
        }

        // Update stok barang
        if ($id_produk != $id_produk_sebelumnya) {
            // Jika produk berubah, kurangi stok produk sebelumnya dan tambahkan stok produk baru
            $update_stok_sebelumnya_sql = "UPDATE produk SET stok = stok + '$jumlah_sebelumnya' WHERE id_produk = '$id_produk_sebelumnya'";
            $update_stok_baru_sql = "UPDATE produk SET stok = stok - '$jumlah' WHERE id_produk = '$id_produk'";
            if (!mysqli_query($this->koneksi, $update_stok_sebelumnya_sql) || !mysqli_query($this->koneksi, $update_stok_baru_sql)) {
                throw new Exception("Error updating stok barang: " . mysqli_error($this->koneksi));
            }
        } else {
            // Jika produk tidak berubah, perhitungkan perubahan jumlah saja
            $selisih_jumlah = $jumlah_sebelumnya - $jumlah;
            $update_stok_sql = "UPDATE produk SET stok = stok + '$selisih_jumlah' WHERE id_produk = '$id_produk'";
            if (!mysqli_query($this->koneksi, $update_stok_sql)) {
                throw new Exception("Error updating stok barang: " . mysqli_error($this->koneksi));
            }
        }

        // Commit transaction
        mysqli_commit($this->koneksi);

        // Redirect to the data penjualan page
        header("Location: index.php");
    } catch (Exception $e) {
        // Rollback transaction if any error occurs
        mysqli_rollback($this->koneksi);
        echo $e->getMessage();
    }
}









    public function cari_penjualan($keyword)
    {
        // Melakukan query pencarian dengan menggunakan LIKE untuk mencocokkan kata kunci dengan kolom tertentu
        $query = "SELECT p.*, pg.nama AS nama_kasir, pl.nama AS nama_pelanggan, pr.nama AS nama_produk
          FROM penjualan p
          LEFT JOIN pengguna pg ON p.id_kasir = pg.id_pengguna
          LEFT JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
          LEFT JOIN produk pr ON p.id_produk = pr.id_produk
          WHERE p.id_penjualan LIKE '%$keyword%'
            OR p.tanggal LIKE '%$keyword%'
            OR pg.nama LIKE '%$keyword%'
            OR pl.nama LIKE '%$keyword%'
            OR pr.nama LIKE '%$keyword%'";
        $result = mysqli_query($this->koneksi, $query);


        // Memeriksa apakah query berhasil dieksekusi
        if ($result) {
            // Mengembalikan hasil query
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            // Menampilkan pesan error jika query gagal dieksekusi
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }

    public function cari_produk($keyword)
    {
        $query = "SELECT * FROM produk 
                  WHERE id_produk LIKE '%$keyword%' 
                  OR nama LIKE '%$keyword%' 
                  OR harga LIKE '%$keyword%' 
                  OR stok LIKE '%$keyword%'";
        $result = mysqli_query($this->koneksi, $query);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }


    // Fungsi untuk mengambil data produk berdasarkan ID
    public function ambil_produk_by_id($id_produk)
    {
        $query = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
        $result = $this->koneksi->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Fungsi untuk memperbarui data produk
    public function update_produk($id_produk, $nama, $harga, $stok)
    {
        $query = "UPDATE produk SET nama = '$nama', harga = '$harga', stok = '$stok' WHERE id_produk = '$id_produk'";
        if ($this->koneksi->query($query) === TRUE) {
            Header('Location: index.php');
        } else {
            echo "Error: " . $query . "<br>" . $this->koneksi->error;
        }
    }

    // Fungsi untuk menghapus data produk berdasarkan ID
    public function hapus_produk($id_produk)
    {
        $query = "DELETE FROM produk WHERE id_produk = '$id_produk'";
        if ($this->koneksi->query($query) === TRUE) {
            Header('Location: index.php');
        } else {
            echo "Error: " . $query . "<br>" . $this->koneksi->error;
        }
    }
}

?>