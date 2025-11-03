-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2025 at 10:17 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to_do_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id` int NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isi` text COLLATE utf8mb4_general_ci,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id`, `judul`, `isi`, `tanggal_dibuat`) VALUES
(2, 'List Kerjaan Hari ini 3 November', 'Las Bug Save\r\nCIF Teradata\r\nPindah data Hp mokas hp barat', '2025-11-03 03:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int NOT NULL,
  `nama_job` varchar(255) NOT NULL,
  `deskripsi` text,
  `tanggal_dibuat` date NOT NULL DEFAULT (curdate()),
  `deadline` date NOT NULL,
  `prioritas` int NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `nama_job`, `deskripsi`, `tanggal_dibuat`, `deadline`, `prioritas`, `status`) VALUES
(3, 'LAS', 'analis belum di update masih menggunakan gform, dicari bagaiimana integrasinya', '2025-11-03', '2025-11-07', 2, 0),
(4, 'LAS', 'kredit untuk pegawai layak tidak layak diambil berdasaran gaji dibuatkn dulu tempatnya kebijakannnya berapa persen nanti didiskusikan lagi', '2025-11-03', '2025-11-07', 1, 0),
(5, 'LAS', 'beberapakali pendapatan  save masuk ke pengeluaran', '2025-11-03', '2025-11-05', 2, 0),
(6, 'Aplikasi Absensi', 'Kamera untuk di aplikasi masih jelek mencari library untuk memperbaiki kualitas kamera agar similaritynya bagus seperti pada waktu testing di postman\r\nDeploy python ke VM ( vm masih belum bisa )\r\nFitur App tahap 1\r\n- Login / logout DONE\r\n- Upload base photo DONE\r\n- Absensi DONE\r\n- Koreksi\r\n- Cuti\r\n- Profil Pegawai', '2025-11-03', '2025-11-30', 1, 0),
(7, 'Teradata', 'COA', '2025-11-03', '2025-11-30', 2, 0),
(8, 'Teradata', 'Saldo COA', '2025-11-03', '2025-11-30', 1, 0),
(9, 'Teradata', 'CIF', '2025-11-03', '2025-11-05', 3, 0),
(10, 'Teradata', 'TAB', '2025-11-03', '2025-11-30', 1, 0),
(11, 'Teradata', 'TAB BERJANGKA', '2025-11-03', '2025-11-30', 1, 0),
(12, 'Teradata', 'DEPOSITO', '2025-11-03', '2025-11-30', 1, 0),
(13, 'Teradata', 'JADWAL DEPOSITO', '2025-11-03', '2025-11-30', 1, 0),
(14, 'Teradata', 'PINJAMAN', '2025-11-03', '2025-11-30', 1, 0),
(15, 'Teradata', 'BIAYA PINJAMAN', '2025-11-03', '2025-11-30', 1, 0),
(16, 'Teradata', 'JADWAL ANGSURAN', '2025-11-03', '2025-11-30', 1, 0),
(17, 'Teradata', 'RESTRUKTURISASI', '2025-11-03', '2025-11-30', 1, 0),
(18, 'Teradata', 'WRITEOFF', '2025-11-03', '2025-11-30', 1, 0),
(19, 'Teradata', 'PPAP', '2025-11-03', '2025-11-30', 1, 0),
(20, 'Teradata', 'JOIN ACCOUNT', '2025-11-03', '2025-11-30', 1, 0),
(21, 'Teradata', 'BLOKIR', '2025-11-03', '2025-11-30', 1, 0),
(22, 'Teradata', 'REKENING KORAN', '2025-11-03', '2025-11-30', 1, 0),
(23, 'Teradata', 'TEMPLATE ORDER TRANSFER', '2025-11-03', '2025-11-30', 1, 0),
(24, 'Teradata', 'ORANG NEGATIF', '2025-11-03', '2025-11-30', 1, 0),
(25, 'Teradata', 'ABA', '2025-11-03', '2025-11-30', 1, 0),
(26, 'Teradata', 'GROUP ARIRSAN', '2025-11-03', '2025-11-30', 1, 0),
(27, 'Teradata', 'GROUP ARISAN', '2025-11-03', '2025-11-30', 1, 0),
(28, 'Teradata', 'RELASI ARISAN', '2025-11-03', '2025-11-30', 1, 0),
(29, 'Teradata', 'ABP', '2025-11-03', '2025-11-30', 1, 0),
(30, 'Teradata', 'SALDO ABP', '2025-11-03', '2025-11-30', 1, 0),
(31, 'Teradata', 'BUNGA ABP', '2025-11-03', '2025-11-30', 1, 0),
(32, 'Teradata', 'ANGSURAN ABP', '2025-11-03', '2025-11-30', 1, 0),
(33, 'Teradata', 'PLATFOM ABP', '2025-11-03', '2025-11-30', 1, 0),
(34, 'Teradata', 'FIXED ASSET', '2025-11-03', '2025-11-30', 1, 0),
(35, 'Teradata', 'AO REKENING', '2025-11-03', '2025-11-30', 1, 0),
(36, 'Pindah Data hp kas barat ke mokas', NULL, '2025-11-03', '2025-11-03', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
