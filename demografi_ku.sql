-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 03:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demografi_ku`
--

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `id_wilayah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`nik`, `nama`, `jenis_kelamin`, `tgl_lahir`, `pekerjaan`, `id_wilayah`) VALUES
('3273010101010001', 'Ahmad Santoso', 'Laki-laki', '1985-05-15', 'Wiraswasta', 1),
('3273010101010002', 'Siti Rahayu', 'Perempuan', '1990-08-20', 'Guru', 1),
('3273010101010003', 'Budi Prasetyo', 'Laki-laki', '1992-12-10', 'Programmer', 2),
('3273010101010004', 'Dewi Lestari', 'Perempuan', '1988-03-25', 'Perawat', 2),
('3273010101010005', 'Rudi Hermawan', 'Laki-laki', '1995-07-30', 'Mahasiswa', 3),
('3273010101010006', 'Maya Sari', 'Perempuan', '1993-11-05', 'Akuntan', 3),
('3273010101010007', 'Joko Widodo', 'Laki-laki', '1980-01-15', 'PNS', 4),
('3273010101010008', 'Ani Susanti', 'Perempuan', '1987-09-12', 'Dokter', 4),
('3273010101010009', 'Rina Wati', 'Perempuan', '1991-06-18', 'Desainer', 5),
('3273010101010010', 'Hendra Gunawan', 'Laki-laki', '1983-04-22', 'Pengusaha', 6),
('3275011204980001', 'Ahmad Fauzan', 'Laki-laki', '1998-04-12', 'Karyawan Swasta', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `nama_wilayah` varchar(100) NOT NULL,
  `tingkat` enum('Desa','RW','RT') NOT NULL,
  `luas_area_km2` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `nama_wilayah`, `tingkat`, `luas_area_km2`) VALUES
(1, 'Sukamaju', 'Desa', 15.50),
(2, 'RW 01', 'RW', 3.20),
(3, 'RW 02', 'RW', 2.80),
(4, 'RT 01', 'RT', 0.85),
(5, 'RT 02', 'RT', 0.75),
(6, 'RT 03', 'RT', 0.90);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
