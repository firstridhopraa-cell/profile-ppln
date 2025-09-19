<?php
// Langkah 1: Sertakan file koneksi ke database
include 'koneksi.php';

// Langkah 2: Siapkan sebuah array kosong untuk menampung semua data
$response = [];

// Langkah 3: Ambil SEMUA data profil dari tabel 'konten_halaman'
$query_profil = "SELECT * FROM konten_halaman WHERE id = 1";
$result_profil = mysqli_query($koneksi, $query_profil);
// Masukkan hasilnya ke dalam array response dengan key 'profil'
$response['profil'] = mysqli_fetch_assoc($result_profil);

// Langkah 4: Ambil semua data proyek dari tabel 'proyek'
$query_proyek = "SELECT * FROM proyek ORDER BY id DESC";
$result_proyek = mysqli_query($koneksi, $query_proyek);
// Siapkan array kosong khusus untuk proyek
$response['proyek'] = [];
// Looping untuk mengambil setiap baris data proyek
while ($row = mysqli_fetch_assoc($result_proyek)) {
    // Masukkan setiap baris ke dalam array 'proyek'
    $response['proyek'][] = $row;
}

// Langkah 5: Atur header agar outputnya berupa JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Izinkan akses dari mana saja (untuk development)

// Langkah 6: Tampilkan semua data yang sudah terkumpul dalam format JSON
echo json_encode($response);
?>