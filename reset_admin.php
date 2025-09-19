<?php
// File ini hanya untuk sekali pakai, untuk memastikan user admin ada dan passwordnya benar.
// Setelah berhasil, file ini sebaiknya dihapus.

include 'koneksi.php';

// --- KONFIGURASI ---
$username_admin = 'admin';
$password_polos = 'admin123'; // Password yang kita inginkan

// --- PROSES ---
echo "<h1>Memulai Proses Reset Password Admin...</h1>";

// 1. Buat hash yang baru dan aman dari password di atas
$password_hash = password_hash($password_polos, PASSWORD_DEFAULT);
echo "<p>Password baru ('admin123') telah di-hash menjadi: " . htmlspecialchars($password_hash) . "</p>";

// 2. Cek apakah username 'admin' sudah ada
$sql_cek = "SELECT id FROM admin_users WHERE username = ?";
$stmt_cek = mysqli_prepare($koneksi, $sql_cek);
mysqli_stmt_bind_param($stmt_cek, "s", $username_admin);
mysqli_stmt_execute($stmt_cek);
mysqli_stmt_store_result($stmt_cek);

if (mysqli_stmt_num_rows($stmt_cek) > 0) {
    // Jika user ada, UPDATE passwordnya
    echo "<p>Username 'admin' ditemukan. Memperbarui password...</p>";
    $sql_update = "UPDATE admin_users SET password = ? WHERE username = ?";
    $stmt_update = mysqli_prepare($koneksi, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "ss", $password_hash, $username_admin);
    if (mysqli_stmt_execute($stmt_update)) {
        echo "<h2>BERHASIL! Password untuk username 'admin' telah di-reset.</h2>";
    } else {
        echo "<h2>GAGAL memperbarui password. Error: " . mysqli_error($koneksi) . "</h2>";
    }
} else {
    // Jika user tidak ada, INSERT user baru
    echo "<p>Username 'admin' tidak ditemukan. Membuat user baru...</p>";
    $sql_insert = "INSERT INTO admin_users (username, password) VALUES (?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "ss", $username_admin, $password_hash);
    if (mysqli_stmt_execute($stmt_insert)) {
        echo "<h2>BERHASIL! User 'admin' baru dengan password 'admin123' telah dibuat.</h2>";
    } else {
        echo "<h2>GAGAL membuat user baru. Error: " . mysqli_error($koneksi) . "</h2>";
    }
}

echo "<hr>";
echo "<h3>Silakan coba login kembali di halaman <a href='login.php'>login.php</a></h3>";
echo "<p><b>PENTING:</b> Setelah Anda berhasil login, hapus file 'reset_admin.php' ini dari server Anda.</p>";
?>