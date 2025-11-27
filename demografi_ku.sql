-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 03:18 AM
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
('3273010101030001', 'Sari Indah', 'Perempuan', '1994-02-14', 'Apoteker', 3),
('3273010101030002', 'Fajar Nugroho', 'Laki-laki', '1989-07-08', 'Karyawan Swasta', 3),
('3273010101030003', 'Linda Permata', 'Perempuan', '1996-12-03', 'Dosen', 3),
('3273010101030004', 'Agus Salim', 'Laki-laki', '1982-10-19', 'Wiraswasta', 3),
('3273010101030005', 'Mira Handayani', 'Perempuan', '1997-04-27', 'Perawat', 3),
('3273010101040001', 'Rizki Pratama', 'Laki-laki', '1998-08-11', 'Mahasiswa', 4),
('3273010101040002', 'Diana Sari', 'Perempuan', '1995-01-23', 'Guru', 4),
('3273010101040003', 'Eko Prasetyo', 'Laki-laki', '1986-06-30', 'Teknisi', 4),
('3273010101040004', 'Fitri Anggraini', 'Perempuan', '1992-09-17', 'Bidan', 4),
('3273010101040005', 'Yudi Hartono', 'Laki-laki', '1984-03-08', 'Sopir', 4),
('3273010101050001', 'Nina Marlina', 'Perempuan', '1999-11-25', 'Pelajar', 5),
('3273010101050002', 'Ari Wibowo', 'Laki-laki', '1981-05-14', 'Pedagang', 5),
('3273010101050003', 'Rini Astuti', 'Perempuan', '1990-12-07', 'Perawat', 5),
('3273010101050004', 'Dodi Setiawan', 'Laki-laki', '1987-02-28', 'Karyawan', 5),
('3273010101050005', 'Siska Dewi', 'Perempuan', '1993-07-19', 'Akuntan', 5),
('3273010101060001', 'Rian Syahputra', 'Laki-laki', '1996-04-12', 'Mahasiswa', 6),
('3273010101060002', 'Melia Putri', 'Perempuan', '1994-10-05', 'Desainer', 6),
('3273010101060003', 'Firman Utama', 'Laki-laki', '1985-08-22', 'PNS', 6),
('3273010101060004', 'Tuti Alawiyah', 'Perempuan', '1989-01-16', 'Guru', 6),
('3273010101060005', 'Hadi Susilo', 'Laki-laki', '1983-06-09', 'Wiraswasta', 6),
('3273010101070001', 'Adi Saputra', 'Laki-laki', '1991-03-15', 'Programmer', 1),
('3273010101070002', 'Rina Marlina', 'Perempuan', '1988-07-22', 'Guru', 1),
('3273010101070003', 'Fajar Setiawan', 'Laki-laki', '1993-11-08', 'Karyawan', 1),
('3273010101070004', 'Sari Dewi', 'Perempuan', '1995-02-14', 'Perawat', 1),
('3273010101070005', 'Bambang Prasetyo', 'Laki-laki', '1987-09-30', 'Wiraswasta', 1),
('3273010101070006', 'Maya Sari', 'Perempuan', '1992-12-25', 'Akuntan', 1),
('3273010101070007', 'Dodi Kurniawan', 'Laki-laki', '1990-05-18', 'Teknisi', 1),
('3273010101070008', 'Lina Hartati', 'Perempuan', '1994-08-11', 'Bidan', 2),
('3273010101070009', 'Eko Prabowo', 'Laki-laki', '1989-01-27', 'Sopir', 2),
('3273010101070010', 'Dewi Anggraini', 'Perempuan', '1996-04-03', 'Apoteker', 2),
('3273010101070011', 'Rizki Ramadhan', 'Laki-laki', '1997-06-19', 'Mahasiswa', 1),
('3273010101070012', 'Nur Aini', 'Perempuan', '1993-10-22', 'Dosen', 2),
('3273010101070013', 'Arief Hidayat', 'Laki-laki', '1985-03-14', 'PNS', 2),
('3273010101070014', 'Siti Fatimah', 'Perempuan', '1991-07-08', 'Perawat', 2),
('3273010101070015', 'Hendra Wijaya', 'Laki-laki', '1988-12-31', 'Pengusaha', 1),
('3273010101070016', 'Mira Susanti', 'Perempuan', '1995-02-28', 'Desainer', 3),
('3273010101070017', 'Joko Santoso', 'Laki-laki', '1986-05-17', 'Karyawan Swasta', 1),
('3273010101070018', 'Anita Rahayu', 'Perempuan', '1992-09-23', 'Guru', 3),
('3273010101070019', 'Rudi Hartono', 'Laki-laki', '1994-11-11', 'Programmer', 3),
('3273010101070020', 'Linda Purnama', 'Perempuan', '1989-04-05', 'Akuntan', 3),
('3273010101070021', 'Firman Syah', 'Laki-laki', '1990-08-19', 'Teknisi', 3),
('3273010101070022', 'Yuni Astuti', 'Perempuan', '1996-01-12', 'Bidan', 4),
('3273010101070023', 'Agus Riyadi', 'Laki-laki', '1987-03-25', 'Sopir', 4),
('3273010101070024', 'Ratna Wulandari', 'Perempuan', '1993-06-30', 'Perawat', 4),
('3273010101070025', 'Dwi Cahyo', 'Laki-laki', '1995-10-15', 'Mahasiswa', 3),
('3273010101070026', 'Martha Sari', 'Perempuan', '1991-12-08', 'Dosen', 3),
('3273010101070027', 'Ryan Pratama', 'Laki-laki', '1988-02-14', 'PNS', 4),
('3273010101070028', 'Diana Putri', 'Perempuan', '1994-05-27', 'Apoteker', 4),
('3273010101070029', 'Ahmad Fauzi', 'Laki-laki', '1989-07-03', 'Wiraswasta', 5),
('3273010101070030', 'Nova Indah', 'Perempuan', '1992-09-18', 'Desainer', 2),
('3273010101070031', 'Rendi Saputra', 'Laki-laki', '1996-11-22', 'Karyawan', 2),
('3273010101070032', 'Wulan Sari', 'Perempuan', '1990-04-07', 'Guru', 5),
('3273010101070033', 'Bayu Kurniawan', 'Laki-laki', '1993-08-29', 'Programmer', 5),
('3273010101070034', 'Cindy Amelia', 'Perempuan', '1997-01-14', 'Perawat', 5),
('3273010101070035', 'Doni Prasetyo', 'Laki-laki', '1986-06-11', 'Teknisi', 5),
('3273010101070036', 'Eva Marlina', 'Perempuan', '1994-03-26', 'Bidan', 6),
('3273010101070037', 'Fadli Rahman', 'Laki-laki', '1991-10-09', 'Sopir', 6),
('3273010101070038', 'Gita Anggraini', 'Perempuan', '1989-12-31', 'Apoteker', 6),
('3273010101070039', 'Hadi Purnomo', 'Laki-laki', '1995-07-15', 'Mahasiswa', 4),
('3273010101070040', 'Indah Permata', 'Perempuan', '1992-02-28', 'Dosen', 4),
('3273010101070041', 'Jefri Gunawan', 'Laki-laki', '1988-05-19', 'PNS', 4),
('3273010101070042', 'Kartika Sari', 'Perempuan', '1993-09-12', 'Perawat', 5),
('3273010101070043', 'Lukman Hakim', 'Laki-laki', '1990-11-25', 'Pengusaha', 5),
('3273010101070044', 'Maya Handayani', 'Perempuan', '1996-04-08', 'Desainer', 4),
('3273010101070045', 'Nando Setiawan', 'Laki-laki', '1987-08-21', 'Karyawan Swasta', 2),
('3273010101070046', 'Oki Pratama', 'Laki-laki', '1994-01-13', 'Programmer', 2),
('3273010101070047', 'Putri Amelia', 'Perempuan', '1991-06-27', 'Akuntan', 2),
('3273010101070048', 'Rafi Firdaus', 'Laki-laki', '1995-03-10', 'Teknisi', 2),
('3273010101070049', 'Salsa Bila', 'Perempuan', '1992-12-04', 'Bidan', 6),
('3273010101070050', 'Toni Wijaya', 'Laki-laki', '1989-10-17', 'Sopir', 2),
('3273010101070051', 'Umi Kulsum', 'Perempuan', '1993-07-22', 'Perawat', 5),
('3273010101070052', 'Vino Ginting', 'Laki-laki', '1996-05-05', 'Mahasiswa', 3),
('3273010101070053', 'Winda Sari', 'Perempuan', '1990-09-30', 'Dosen', 3),
('3273010101070054', 'Yoga Maulana', 'Laki-laki', '1988-02-14', 'PNS', 6),
('3273010101070055', 'Zahra Fitri', 'Perempuan', '1994-11-08', 'Apoteker', 5),
('3273010101070056', 'Ade Irawan', 'Laki-laki', '1991-04-21', 'Wiraswasta', 4),
('3273010101070057', 'Bella Natasha', 'Perempuan', '1995-08-03', 'Desainer', 3),
('3273010101070058', 'Cakra Bumi', 'Laki-laki', '1987-12-16', 'Karyawan', 2),
('3273010101070059', 'Dina Marlina', 'Perempuan', '1992-06-29', 'Guru', 1),
('3273010101070060', 'Eko Yulianto', 'Laki-laki', '1993-03-12', 'Programmer', 6),
('3273010101070061', 'Fanny Putri', 'Perempuan', '1996-10-25', 'Perawat', 2),
('3273010101070062', 'Gilang Ramadhan', 'Laki-laki', '1989-01-18', 'Teknisi', 3),
('3273010101070063', 'Hesti Wulandari', 'Perempuan', '1994-07-11', 'Bidan', 6),
('3273010101070064', 'Irfan Maulana', 'Laki-laki', '1990-05-24', 'Sopir', 1),
('3273010101070065', 'Jihan Aulia', 'Perempuan', '1995-12-07', 'Apoteker', 5),
('3273010101070066', 'Kevin Ardian', 'Laki-laki', '1991-08-20', 'Mahasiswa', 4),
('3273010101070067', 'Lala Kurnia', 'Perempuan', '1988-04-13', 'Dosen', 3),
('3273010101070068', 'Maman Suherman', 'Laki-laki', '1993-11-26', 'PNS', 1),
('3273010101070069', 'Nia Ramadhani', 'Perempuan', '1996-02-09', 'Perawat', 6),
('3273010101070070', 'Oscar Wijaya', 'Laki-laki', '1989-09-02', 'Pengusaha', 6),
('3273010101080001', 'Rafi Maulana', 'Laki-laki', '1992-03-18', 'Programmer', 1),
('3273010101080002', 'Salsa Nabila', 'Perempuan', '1995-07-25', 'Guru SD', 1),
('3273010101080003', 'Dito Pratama', 'Laki-laki', '1989-11-12', 'Karyawan Bank', 1),
('3273010101080004', 'Melia Anggraini', 'Perempuan', '1993-02-28', 'Bidan', 1),
('3273010101080005', 'Rangga Saputra', 'Laki-laki', '1991-09-15', 'Wiraswasta', 1),
('3273010101080006', 'Nadia Putri', 'Perempuan', '1996-12-08', 'Akuntan', 1),
('3273010101080007', 'Aldi Setiawan', 'Laki-laki', '1988-05-22', 'Teknisi', 1),
('3273010101080008', 'Rini Hartati', 'Perempuan', '1994-08-14', 'Perawat', 1),
('3273010101080009', 'Fajar Nugroho', 'Laki-laki', '1990-01-30', 'Sopir', 1),
('3273010101080010', 'Diana Sari', 'Perempuan', '1997-04-05', 'Apoteker', 1),
('3273010101080011', 'Rizky Ramadhan', 'Laki-laki', '1998-06-20', 'Mahasiswa', 1),
('3273010101080012', 'Nina Marlina', 'Perempuan', '1992-10-15', 'Dosen', 1),
('3273010101080013', 'Ari Wibowo', 'Laki-laki', '1986-03-17', 'PNS', 1),
('3273010101080014', 'Siti Aisyah', 'Perempuan', '1991-07-11', 'Perawat', 1),
('3273010101080015', 'Hendri Wijaya', 'Laki-laki', '1989-12-25', 'Pengusaha', 1),
('3273010101080016', 'Maya Susanti', 'Perempuan', '1995-02-14', 'Desainer', 1),
('3273010101080017', 'Joni Santoso', 'Laki-laki', '1987-05-19', 'Karyawan Swasta', 1),
('3273010101080018', 'Ani Rahmawati', 'Perempuan', '1993-09-26', 'Guru TK', 1),
('3273010101080019', 'Rudi Hartono', 'Laki-laki', '1994-11-08', 'Programmer', 1),
('3273010101080020', 'Lina Permatasari', 'Perempuan', '1988-04-02', 'Akuntan', 1),
('3273010101080021', 'Firmansyah', 'Laki-laki', '1990-08-22', 'Teknisi', 1),
('3273010101080022', 'Yunita Astuti', 'Perempuan', '1996-01-15', 'Bidan', 1),
('3273010101080023', 'Agus Riyanto', 'Laki-laki', '1985-03-28', 'Sopir', 1),
('3273010101080024', 'Ratna Dewi', 'Perempuan', '1992-06-18', 'Perawat', 1),
('3273010101080025', 'Dwi Cahyono', 'Laki-laki', '1995-10-08', 'Mahasiswa', 1),
('3273010101080026', 'Martha Sari', 'Perempuan', '1991-12-03', 'Dosen', 1),
('3273010101080027', 'Ryan Pratama', 'Laki-laki', '1988-02-17', 'PNS', 1),
('3273010101080028', 'Dian Putri', 'Perempuan', '1994-05-30', 'Apoteker', 1),
('3273010101080029', 'Ahmad Fauzan', 'Laki-laki', '1989-07-07', 'Wiraswasta', 1),
('3273010101080030', 'Novi Indriani', 'Perempuan', '1993-09-21', 'Desainer', 1),
('3273010101080031', 'Rendy Saputra', 'Laki-laki', '1996-11-25', 'Karyawan', 1),
('3273010101080032', 'Wulan Sari', 'Perempuan', '1990-04-10', 'Guru', 1),
('3273010101080033', 'Bayu Kurniawan', 'Laki-laki', '1994-08-02', 'Programmer', 1),
('3273010101080034', 'Cindy Permatasari', 'Perempuan', '1997-01-18', 'Perawat', 1),
('3273010101080035', 'Doni Prasetyo', 'Laki-laki', '1986-06-14', 'Teknisi', 1),
('3273010101080036', 'Eva Marlina', 'Perempuan', '1993-03-29', 'Bidan', 1),
('3273010101080037', 'Fadli Ramadhan', 'Laki-laki', '1991-10-12', 'Sopir', 1),
('3273010101080038', 'Gita Anggraeni', 'Perempuan', '1989-12-28', 'Apoteker', 1),
('3273010101080039', 'Hadi Purnomo', 'Laki-laki', '1995-07-18', 'Mahasiswa', 1),
('3273010101080040', 'Indah Permatasari', 'Perempuan', '1992-02-22', 'Dosen', 1),
('3273010101080041', 'Jefri Gunawan', 'Laki-laki', '1988-05-22', 'PNS', 1),
('3273010101080042', 'Kartini Sari', 'Perempuan', '1994-09-15', 'Perawat', 1),
('3273010101080043', 'Lukman Hidayat', 'Laki-laki', '1990-11-28', 'Pengusaha', 1),
('3273010101080044', 'Maya Handayani', 'Perempuan', '1996-04-11', 'Desainer', 1),
('3273010101080045', 'Nando Setiawan', 'Laki-laki', '1987-08-24', 'Karyawan Swasta', 1),
('3273010101080046', 'Oki Pratama', 'Laki-laki', '1994-01-16', 'Programmer', 1),
('3273010101080047', 'Putri Anggraini', 'Perempuan', '1991-06-30', 'Akuntan', 1),
('3273010101080048', 'Rafi Firdaus', 'Laki-laki', '1995-03-13', 'Teknisi', 1),
('3273010101080049', 'Salsabila', 'Perempuan', '1992-12-07', 'Bidan', 1),
('3273010101080050', 'Toni Wijaya', 'Laki-laki', '1989-10-20', 'Sopir', 1),
('3273010101080051', 'Umi Kalsum', 'Perempuan', '1993-07-25', 'Perawat', 1),
('3273010101080052', 'Vino Ginting', 'Laki-laki', '1996-05-08', 'Mahasiswa', 1),
('3273010101080053', 'Winda Sari', 'Perempuan', '1990-09-02', 'Dosen', 1),
('3273010101080054', 'Yoga Maulana', 'Laki-laki', '1988-02-17', 'PNS', 1),
('3273010101080055', 'Zahra Fitriani', 'Perempuan', '1994-11-11', 'Apoteker', 1),
('3273010101080056', 'Ade Irawan', 'Laki-laki', '1991-04-24', 'Wiraswasta', 1),
('3273010101080057', 'Bella Natasya', 'Perempuan', '1995-08-06', 'Desainer', 1),
('3273010101090001', 'Cakra Bumi', 'Laki-laki', '1987-12-19', 'Karyawan', 2),
('3273010101090002', 'Dina Marlina', 'Perempuan', '1992-06-02', 'Guru', 2),
('3273010101090003', 'Eko Yulianto', 'Laki-laki', '1993-03-15', 'Programmer', 2),
('3273010101090004', 'Fanny Putri', 'Perempuan', '1996-10-28', 'Perawat', 2),
('3273010101090005', 'Gilang Ramadhan', 'Laki-laki', '1989-01-21', 'Teknisi', 2),
('3273010101090006', 'Hesti Wulandari', 'Perempuan', '1994-07-14', 'Bidan', 2),
('3273010101090007', 'Irfan Maulana', 'Laki-laki', '1990-05-27', 'Sopir', 2),
('3273010101090008', 'Jihan Aulia', 'Perempuan', '1995-12-10', 'Apoteker', 2),
('3273010101090009', 'Kevin Ardian', 'Laki-laki', '1991-08-23', 'Mahasiswa', 2),
('3273010101090010', 'Lala Kurnia', 'Perempuan', '1988-04-16', 'Dosen', 2),
('3273010101090011', 'Maman Suherman', 'Laki-laki', '1993-11-29', 'PNS', 2),
('3273010101090012', 'Nia Ramadhani', 'Perempuan', '1996-02-12', 'Perawat', 2),
('3273010101090013', 'Oscar Wijaya', 'Laki-laki', '1989-09-05', 'Pengusaha', 2),
('3273010101090014', 'Putra Mandala', 'Laki-laki', '1992-03-21', 'Programmer', 2),
('3273010101090015', 'Queen Amelia', 'Perempuan', '1995-07-28', 'Guru', 2),
('3273010101090016', 'Randy Saputra', 'Laki-laki', '1989-11-15', 'Karyawan', 2),
('3273010101090017', 'Santi Purnama', 'Perempuan', '1993-02-02', 'Bidan', 2),
('3273010101090018', 'Taufik Hidayat', 'Laki-laki', '1991-09-18', 'Wiraswasta', 2),
('3273010101090019', 'Ulya Nurul', 'Perempuan', '1996-12-11', 'Akuntan', 2),
('3273010101090020', 'Viktor Siregar', 'Laki-laki', '1988-05-25', 'Teknisi', 2),
('3273010101090021', 'Wulan Dari', 'Perempuan', '1994-08-17', 'Perawat', 2),
('3273010101090022', 'Xavier Tan', 'Laki-laki', '1990-01-02', 'Sopir', 2),
('3273010101090023', 'Yuni Anggraeni', 'Perempuan', '1997-04-08', 'Apoteker', 2),
('3273010101090024', 'Zaki Ramadhan', 'Laki-laki', '1998-06-23', 'Mahasiswa', 2),
('3273010101090025', 'Alya Putri', 'Perempuan', '1992-10-18', 'Dosen', 2),
('3273010101090026', 'Bimo Prakoso', 'Laki-laki', '1986-03-20', 'PNS', 2),
('3273010101090027', 'Cinta Kasih', 'Perempuan', '1991-07-14', 'Perawat', 2),
('3273010101090028', 'Dafa Arifin', 'Laki-laki', '1989-12-28', 'Pengusaha', 2),
('3273010101090029', 'Elsa Frozen', 'Perempuan', '1995-02-17', 'Desainer', 2),
('3273010101090030', 'Fahri Aziz', 'Laki-laki', '1987-05-22', 'Karyawan Swasta', 2),
('3273010101090031', 'Gita Gutawa', 'Perempuan', '1993-09-29', 'Guru', 2),
('3273010101090032', 'Hilman Hari', 'Laki-laki', '1994-11-11', 'Programmer', 2),
('3273010101090033', 'Intan Permata', 'Perempuan', '1988-04-05', 'Akuntan', 2),
('3273010101090034', 'Jaja Miharja', 'Laki-laki', '1990-08-25', 'Teknisi', 2),
('3273010101090035', 'Kania Larasati', 'Perempuan', '1996-01-18', 'Bidan', 2),
('3273010101090036', 'Lutfi Hakim', 'Laki-laki', '1985-03-31', 'Sopir', 2),
('3273010101090037', 'Manda Sari', 'Perempuan', '1992-06-21', 'Perawat', 2),
('3273010101090038', 'Naufal Rizki', 'Laki-laki', '1995-10-11', 'Mahasiswa', 2),
('3273010101090039', 'Olivia Wilde', 'Perempuan', '1991-12-06', 'Dosen', 2),
('3273010101090040', 'Pandu Winata', 'Laki-laki', '1988-02-20', 'PNS', 2),
('3273010101090041', 'Qory Sandioriva', 'Perempuan', '1994-05-03', 'Apoteker', 2),
('3273010101090042', 'Rangga Yudha', 'Laki-laki', '1989-07-10', 'Wiraswasta', 2),
('3273010101090043', 'Salsabilla', 'Perempuan', '1993-09-24', 'Desainer', 2),
('3273010101090044', 'Teguh Karya', 'Laki-laki', '1996-11-28', 'Karyawan', 2),
('3273010101090045', 'Umi Salamah', 'Perempuan', '1990-04-13', 'Guru', 2),
('3273010101090046', 'Vito Pratama', 'Laki-laki', '1994-08-05', 'Programmer', 2),
('3273010101090047', 'Widya Lestari', 'Perempuan', '1997-01-21', 'Perawat', 2),
('3273010101090048', 'Xena Putri', 'Perempuan', '1986-06-17', 'Teknisi', 2),
('3273010101090049', 'Yuda Perkasa', 'Laki-laki', '1993-03-02', 'Bidan', 2),
('3273010101090050', 'Zara Zettira', 'Perempuan', '1991-10-15', 'Sopir', 2),
('3273010101090051', 'Ade Firmansyah', 'Laki-laki', '1989-12-01', 'Apoteker', 2),
('3273010101090052', 'Bunga Mawar', 'Perempuan', '1995-07-21', 'Mahasiswa', 2),
('3273010101090053', 'Cakra Ningrat', 'Laki-laki', '1992-02-25', 'Dosen', 2),
('3273010101090054', 'Dewi Sartika', 'Perempuan', '1988-05-18', 'PNS', 2),
('3273010101090055', 'Eko Prasetyo', 'Laki-laki', '1994-09-11', 'Perawat', 2),
('3273010101090056', 'Fitri Handayani', 'Perempuan', '1990-11-01', 'Pengusaha', 2),
('3273010101090057', 'Guntur Bumi', 'Laki-laki', '1996-04-14', 'Desainer', 2),
('3273010101090058', 'Hani Lestari', 'Perempuan', '1987-08-27', 'Karyawan Swasta', 2),
('3273010101090059', 'Ivan Gunawan', 'Laki-laki', '1993-01-09', 'Programmer', 2),
('3273010101090060', 'Juli Anita', 'Perempuan', '1991-06-04', 'Akuntan', 2),
('3273010101100001', 'Kiki Amalia', 'Perempuan', '1996-10-01', 'Teknisi', 3),
('3273010101100002', 'Lutfi Hakim', 'Laki-laki', '1989-01-24', 'Bidan', 3),
('3273010101100003', 'Maya Sari', 'Perempuan', '1994-07-17', 'Sopir', 3),
('3273010101100004', 'Nando Pratama', 'Laki-laki', '1990-05-30', 'Apoteker', 3),
('3273010101100005', 'Olivia Sanjaya', 'Perempuan', '1995-12-13', 'Mahasiswa', 3),
('3273010101100006', 'Pandu Wijaya', 'Laki-laki', '1991-08-26', 'Dosen', 3),
('3273010101100007', 'Queen Victoria', 'Perempuan', '1988-02-23', 'PNS', 3),
('3273010101100008', 'Rangga Setiawan', 'Laki-laki', '1994-04-16', 'Perawat', 3),
('3273010101100009', 'Santi Purnami', 'Perempuan', '1990-09-09', 'Pengusaha', 3),
('3273010101100010', 'Taufik Rahman', 'Laki-laki', '1996-03-02', 'Desainer', 3),
('3273010101100011', 'Umi Khasanah', 'Perempuan', '1987-11-15', 'Karyawan Swasta', 3),
('3273010101100012', 'Viktor Siahaan', 'Laki-laki', '1993-06-28', 'Programmer', 3),
('3273010101100013', 'Wulan Dari', 'Perempuan', '1991-01-11', 'Akuntan', 3),
('3273010101100014', 'Xavier Tanoto', 'Laki-laki', '1995-04-24', 'Teknisi', 3),
('3273010101100015', 'Yuni Anggraini', 'Perempuan', '1989-07-07', 'Bidan', 3),
('3273010101100016', 'Zaki Firmansyah', 'Laki-laki', '1992-10-20', 'Sopir', 3),
('3273010101100017', 'Alya Maharani', 'Perempuan', '1996-02-13', 'Apoteker', 3),
('3273010101100018', 'Bimo Satria', 'Laki-laki', '1990-05-06', 'Mahasiswa', 3),
('3273010101100019', 'Cinta Laura', 'Perempuan', '1994-08-29', 'Dosen', 3),
('3273010101100020', 'Dafa Ramadhan', 'Laki-laki', '1988-11-12', 'PNS', 3),
('3273010101100021', 'Elsa Kristin', 'Perempuan', '1993-03-25', 'Perawat', 3),
('3273010101100022', 'Fahri Zulkarnain', 'Laki-laki', '1991-06-18', 'Pengusaha', 3),
('3273010101100023', 'Gita Maharani', 'Perempuan', '1995-09-01', 'Desainer', 3),
('3273010101100024', 'Hilman Syah', 'Laki-laki', '1987-12-14', 'Karyawan', 3),
('3273010101100025', 'Intan Permatasari', 'Perempuan', '1992-04-27', 'Guru', 3),
('3273010101100026', 'Jaja Suherman', 'Laki-laki', '1996-07-10', 'Programmer', 3),
('3273010101100027', 'Kania Dewi', 'Perempuan', '1990-10-03', 'Akuntan', 3),
('3273010101100028', 'Lutfi Andika', 'Laki-laki', '1994-01-16', 'Teknisi', 3),
('3273010101100029', 'Manda Putri', 'Perempuan', '1989-04-29', 'Bidan', 3),
('3273010101100030', 'Naufal Hidayat', 'Laki-laki', '1993-07-12', 'Sopir', 3),
('3273010101100031', 'Olivia Nasution', 'Perempuan', '1991-10-05', 'Apoteker', 3),
('3273010101100032', 'Pandu Sakti', 'Laki-laki', '1995-02-18', 'Mahasiswa', 3),
('3273010101100033', 'Qory Aurel', 'Perempuan', '1988-05-01', 'Dosen', 3),
('3273010101100034', 'Rangga Pradana', 'Laki-laki', '1992-08-14', 'PNS', 3),
('3273010101100035', 'Salsabila Putri', 'Perempuan', '1996-11-27', 'Perawat', 3),
('3273010101100036', 'Teguh Karyadi', 'Laki-laki', '1990-03-10', 'Pengusaha', 3),
('3273010101100037', 'Umi Rosidah', 'Perempuan', '1994-06-23', 'Desainer', 3),
('3273010101100038', 'Vito Pratama', 'Laki-laki', '1989-09-06', 'Karyawan Swasta', 3),
('3273010101100039', 'Widya Laksmi', 'Perempuan', '1993-12-19', 'Programmer', 3),
('3273010101100040', 'Xena Gabriella', 'Perempuan', '1991-04-02', 'Akuntan', 3),
('3273010101110001', 'Yuda Maulana', 'Laki-laki', '1995-07-15', 'Teknisi', 6),
('3273010101110002', 'Zara Zetira', 'Perempuan', '1992-10-28', 'Bidan', 6),
('3273010101110003', 'Ade Firmansyah', 'Laki-laki', '1989-01-11', 'Sopir', 6),
('3273010101110004', 'Bunga Melati', 'Perempuan', '1994-04-24', 'Apoteker', 6),
('3273010101110005', 'Cakra Bumi', 'Laki-laki', '1990-07-07', 'Mahasiswa', 6),
('3273010101110006', 'Dewi Anggraini', 'Perempuan', '1996-10-20', 'Dosen', 6),
('3273010101110007', 'Eko Kurniawan', 'Laki-laki', '1991-02-03', 'PNS', 6),
('3273010101110008', 'Fitriani', 'Perempuan', '1988-05-16', 'Perawat', 6),
('3273010101110009', 'Guntur Alam', 'Laki-laki', '1993-08-29', 'Pengusaha', 6),
('3273010101110010', 'Hani Permatasari', 'Perempuan', '1990-11-12', 'Desainer', 6),
('3273010101110011', 'Ivan Setiawan', 'Laki-laki', '1995-03-25', 'Karyawan Swasta', 6),
('3273010101110012', 'Juliastuti', 'Perempuan', '1992-06-08', 'Programmer', 6),
('3273010101110013', 'Kiki Harmoko', 'Laki-laki', '1989-09-21', 'Akuntan', 6),
('3273010101110014', 'Lutfi Andini', 'Perempuan', '1994-12-04', 'Teknisi', 6),
('3273010101110015', 'Maya Puspita', 'Perempuan', '1991-04-17', 'Bidan', 6),
('3273010101110016', 'Nando Siregar', 'Laki-laki', '1996-07-30', 'Sopir', 6),
('3273010101110017', 'Olivia Marpaung', 'Perempuan', '1990-10-13', 'Apoteker', 6),
('3273010101110018', 'Pandu Lesmana', 'Laki-laki', '1995-01-26', 'Mahasiswa', 6),
('3273010101110019', 'Queen Elizabeth', 'Perempuan', '1992-05-09', 'Dosen', 6),
('3273010101110020', 'Rangga Aditya', 'Laki-laki', '1988-08-22', 'PNS', 6),
('3273010101110021', 'Santi Mulyani', 'Perempuan', '1993-11-05', 'Perawat', 6),
('3273010101110022', 'Taufik Zaki', 'Laki-laki', '1991-03-18', 'Pengusaha', 6),
('3273010101110023', 'Umi Kalsum', 'Perempuan', '1996-06-01', 'Desainer', 6),
('3273010101110024', 'Viktor Sihombing', 'Laki-laki', '1990-09-14', 'Karyawan', 6),
('3273010101110025', 'Wulan Sari', 'Perempuan', '1995-12-27', 'Guru', 6),
('3273010101120001', 'Rizki Fauzan', 'Laki-laki', '1993-05-12', 'Programmer', 3),
('3273010101120002', 'Arif Budiman', 'Laki-laki', '1989-08-25', 'Teknisi', 3),
('3273010101120003', 'Doni Saputra', 'Laki-laki', '1995-11-18', 'Mahasiswa', 3),
('3273010101120004', 'Hendra Kurniawan', 'Laki-laki', '1991-02-07', 'Karyawan Swasta', 3),
('3273010101120005', 'Fajar Ramadan', 'Laki-laki', '1994-07-30', 'Wiraswasta', 3),
('3273010101121234', 'Suminten', 'Laki-laki', '1957-02-11', 'petani', 4),
('3275011204980001', 'Ahmad Fauzan', 'Laki-laki', '1998-04-12', 'Karyawan Swasta', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','operator') DEFAULT 'operator',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `nama_lengkap`, `role`, `created_at`, `last_login`, `is_active`) VALUES
(1, 'admin', 'admin@demografiku.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator System', 'admin', '2025-11-27 00:13:12', NULL, 1),
(2, 'operator1', 'operator1@demografiku.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Operator Pertama', 'operator', '2025-11-27 00:13:12', NULL, 1),
(3, 'fury', 'asdasd@gmail.com', '$2y$10$2CUqCjCBEpkwJNFxPA0TuuCmPPHTLccBOTvWRbyNlEubqzd3DDEWW', 'fury', 'operator', '2025-11-27 00:22:47', '2025-11-27 01:21:33', 1);

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
(2, 'Mekarjaya', 'Desa', 12.75),
(3, 'RW 01', 'RW', 2.80),
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
