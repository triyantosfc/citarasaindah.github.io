<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db_name = "burjo_bs";

    // Koneksi ke MySQL
    $conn = mysqli_connect($server, $username, $password);

    // Periksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Pilih database
    $db_select = mysqli_select_db($conn, $db_name);
    if (!$db_select) {
        die("Koneksi ke database salah: " . mysqli_error($conn));
    }
?>
