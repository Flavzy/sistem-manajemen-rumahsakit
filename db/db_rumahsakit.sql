-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2025 at 04:38 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rumahsakit`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `email`) VALUES
(1, 'Admin1', '$2y$10$ncb09cjhXZWMXOgZhOpuuui9DDhTMnQ1yUmPq05lM0uRzpZWHWrau', 'admin@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokter`
--

CREATE TABLE `tbl_dokter` (
  `id_dokter` int NOT NULL,
  `nama_dokter` varchar(100) DEFAULT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_dokter`
--

INSERT INTO `tbl_dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `no_hp`, `email`, `status`) VALUES
(1, 'jenyfer', 'Dokter Kelamin', '08123456789', 'jenyfer@example.com', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pasien`
--

CREATE TABLE `tbl_pasien` (
  `id_pasien` int NOT NULL,
  `nama_pasien` varchar(100) DEFAULT NULL,
  `umur` int DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `riwayat_penyakit` varchar(255) DEFAULT NULL,
  `penyakit_dialami` varchar(255) DEFAULT NULL,
  `id_dokter` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`id_pasien`, `nama_pasien`, `umur`, `alamat`, `email`, `riwayat_penyakit`, `penyakit_dialami`, `id_dokter`) VALUES
(1, 'Nabil', 19, 'surabaya', 'nabil@example.com', 'HIV', 'HIV', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perawat`
--

CREATE TABLE `tbl_perawat` (
  `id_perawat` int NOT NULL,
  `nama_perawat` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `shift` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `tbl_perawat`
--
ALTER TABLE `tbl_perawat`
  ADD PRIMARY KEY (`id_perawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  MODIFY `id_dokter` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  MODIFY `id_pasien` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_perawat`
--
ALTER TABLE `tbl_perawat`
  MODIFY `id_perawat` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  ADD CONSTRAINT `tbl_pasien_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `tbl_dokter` (`id_dokter`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
