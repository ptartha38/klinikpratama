-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jul 2021 pada 17.46
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinikpolres`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `registered_user`
--

CREATE TABLE `registered_user` (
  `id` int(11) NOT NULL,
  `NIK` text NOT NULL,
  `nama_lengkap` text NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tgl_lahir` varchar(100) NOT NULL,
  `pekerjaan` text NOT NULL,
  `agama` text NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `foto_ktp` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `status_akun` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `registered_user`
--

INSERT INTO `registered_user` (`id`, `NIK`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `pekerjaan`, `agama`, `alamat`, `email`, `password`, `foto_ktp`, `foto`, `status_akun`) VALUES
(8, '5271062905940001', 'PUTU ARTHA', '', '', '', '', '', '', 'pt.artha38@gmail.com', '$2y$10$sGwdB3cAEnlsfVCJcG1XwOq9s0F2Rzt2h.kYzMFJSIqFTi3h4iBiy', '', '', 'Belum Aktifasi'),
(9, '5271226992929292', '12332132131232132131', '', '', '', '', '', '', '2132131@gmail.com', '$2y$10$XkxrRThah40T6Za6DCgdIu8xctUBX.NJVYAevMXTrPT0OC1GBmCfi', '', '', 'Belum Aktifasi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `registered_user`
--
ALTER TABLE `registered_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `registered_user`
--
ALTER TABLE `registered_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
