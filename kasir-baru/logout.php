<?php
// Mulai session
session_start();

// Hancurkan semua data sesi
session_destroy();

// Alihkan ke halaman admin/index.php
header('Location: index.php');
exit;
?>
