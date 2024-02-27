// script.js

// Fungsi untuk memperbarui harga satuan berdasarkan produk yang dipilih
function updateHargaSatuan() {
    var selectedProductId = document.getElementById("produk").value;

    // Ambil harga satuan produk yang dipilih dari objek hargaSatuanData
    var hargaSatuan = hargaSatuanData[selectedProductId];

    // Set nilai input harga_satuan dengan harga satuan yang diperoleh
    document.getElementById("harga_satuan").value = hargaSatuan || "";

    // Memperbarui total harga
    updateTotalHarga();
}

// Fungsi untuk memperbarui total harga berdasarkan jumlah dan harga satuan
function updateTotalHarga() {
    var jumlah = parseInt(document.getElementById("jumlah").value) || 0;
    var hargaSatuan = parseInt(document.getElementById("harga_satuan").value) || 0;

    var totalHarga = jumlah * hargaSatuan;

    // Set nilai input total_harga dengan total harga yang diperoleh
    document.getElementById("total_harga").value = totalHarga;
}
