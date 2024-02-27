<?php


// Connect to database
$conn = mysqli_connect("localhost", "root", "", "database_kasir");

// Check if ID is provided
if(isset($_GET['id_penjualan'])) {
    $id_penjualan = $_GET['id_penjualan'];

    // Delete data from the penjualan table
    $delete_sql = "DELETE FROM penjualan WHERE id_penjualan = '$id_penjualan'";
    
    if(mysqli_query($conn, $delete_sql)) {
        // Redirect to the data penjualan page after successful deletion
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "ID penjualan tidak valid.";
}

// Include footer file
?>
