<?php
// Detail koneksi database
$host = "localhost";
$user = "root"; // Default username untuk XAMPP
$pass = "";     // Default password untuk XAMPP (kosong)
$db   = "db_pln_profile";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>