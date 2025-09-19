-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Sep 2025 pada 05.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pln_profile`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$xWlZPtp.USNXYxdSLYUQZefFfbm7MQ2O8eTyT8soIcbfDkE308qh.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konten_halaman`
--

CREATE TABLE `konten_halaman` (
  `id` int(11) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `tugas_pokok` text NOT NULL,
  `nilai_akhlak` text NOT NULL,
  `layanan_judul_1` varchar(255) NOT NULL,
  `layanan_deskripsi_1` text NOT NULL,
  `layanan_judul_2` varchar(255) NOT NULL,
  `layanan_deskripsi_2` text NOT NULL,
  `layanan_judul_3` varchar(255) NOT NULL,
  `layanan_deskripsi_3` text NOT NULL,
  `layanan_judul_4` varchar(255) NOT NULL,
  `layanan_deskripsi_4` text NOT NULL,
  `hero_judul1` varchar(255) NOT NULL,
  `hero_deskripsi1` text NOT NULL,
  `hero_tombol1` varchar(100) NOT NULL,
  `hero_gambar1` varchar(255) NOT NULL,
  `hero_judul2` varchar(255) NOT NULL,
  `hero_deskripsi2` text NOT NULL,
  `hero_tombol2` varchar(100) NOT NULL,
  `hero_gambar2` varchar(255) NOT NULL,
  `tentang_judul` varchar(255) NOT NULL,
  `tentang_subjudul` text NOT NULL,
  `layanan_judul` varchar(255) NOT NULL,
  `layanan_subjudul` text NOT NULL,
  `proyek_judul` varchar(255) NOT NULL,
  `proyek_subjudul` text NOT NULL,
  `kontak_judul` varchar(255) NOT NULL,
  `kontak_subjudul` text NOT NULL,
  `kontak_alamat` text NOT NULL,
  `kontak_telepon` varchar(100) NOT NULL,
  `kontak_center` varchar(100) NOT NULL,
  `kontak_email` varchar(100) NOT NULL,
  `link_instagram` varchar(255) NOT NULL,
  `link_youtube` varchar(255) NOT NULL,
  `footer_deskripsi` text NOT NULL,
  `footer_copyright` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konten_halaman`
--

INSERT INTO `konten_halaman` (`id`, `visi`, `misi`, `tugas_pokok`, `nilai_akhlak`, `layanan_judul_1`, `layanan_deskripsi_1`, `layanan_judul_2`, `layanan_deskripsi_2`, `layanan_judul_3`, `layanan_deskripsi_3`, `layanan_judul_4`, `layanan_deskripsi_4`, `hero_judul1`, `hero_deskripsi1`, `hero_tombol1`, `hero_gambar1`, `hero_judul2`, `hero_deskripsi2`, `hero_tombol2`, `hero_gambar2`, `tentang_judul`, `tentang_subjudul`, `layanan_judul`, `layanan_subjudul`, `proyek_judul`, `proyek_subjudul`, `kontak_judul`, `kontak_subjudul`, `kontak_alamat`, `kontak_telepon`, `kontak_center`, `kontak_email`, `link_instagram`, `link_youtube`, `footer_deskripsi`, `footer_copyright`) VALUES
(1, 'Menjadi perusahaan hsdhgsh', 'Menjalankan bsdsdjsjd', 'dwwd', 'dwdw', 'dwddw', 'wdwd', 'dwdw', 'dwd', 'wdwd', 'dwdw', 'dwdw', 'dwdwd', 'Menjaga Keandalan Jaringan Transmisi Listrik Lampung', 'Memastikan setiap Gardu Induk dan Saluran Transmisi beroperasi dengan performa maksimal.', 'Lihat Layanan Kami', '1758082956_hero-bg-1.png', 'hshs', 'jsjsj', 'jsjs', '1758043154_Gambar 3. Confusion Matrix Setelah Oversampling ADASYN.png', 'wd', 'wsw', 'wwddw', 'wdw', 'dwd', 'wdwd', 'dwdw', 'wdwd', 'dwdw', 'dwdw', 'dwdw', 'dwdwdw', 'dwdw', 'dwdw', 'dwdwd', 'dwdw');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id`, `judul`, `deskripsi`, `gambar`) VALUES
(1, 'yayaya', 'jaajajja', '1758039564_Gambar 4. Perbandingan Akurasi Model Sebelum dan Sesudah ADASYN.png'),
(2, 'yananxa', 'mxanakjxka', '1758039941_Gambar 2. Confusion Matrix Sebelum Oversampling.png'),
(3, 'sjcnjscnjsc', 'cjsncjsc', '1758161078_Screenshot (1).png'),
(4, 'ijcicd', 'ajnscac', '1758161228_Screenshot (6).png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `konten_halaman`
--
ALTER TABLE `konten_halaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `konten_halaman`
--
ALTER TABLE `konten_halaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
