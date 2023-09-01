-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2023 at 04:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_proyek`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int NOT NULL,
  `id_karyawan` varchar(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_karyawan`, `tanggal`) VALUES
(2, 'KR001', '2023-06-30'),
(3, 'KR002', '2023-06-30'),
(4, 'KR003', '2023-06-30'),
(5, 'KR004', '2023-06-30'),
(6, 'KR005', '2023-06-30'),
(7, 'KR006', '2023-06-30'),
(8, 'KR001', '2023-06-29'),
(9, 'KR002', '2023-06-29'),
(10, 'KR003', '2023-06-29'),
(11, 'KR004', '2023-06-29'),
(12, 'KR005', '2023-06-29'),
(13, 'KR006', '2023-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_alat` varchar(10) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `id_supplier` varchar(10) NOT NULL,
  `id_project` varchar(10) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `tgl_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id_alat`, `nama_alat`, `merk`, `id_supplier`, `id_project`, `harga`, `tgl_beli`) VALUES
('AL001', 'Palu', 'oke', 'SP001', 'PR001', '60000', '2023-07-03'),
('AL002', 'Sekop', 'oke', 'SP001', 'PR001', '300000', '2023-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` varchar(10) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `id_supplier` varchar(10) NOT NULL,
  `id_project` varchar(10) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `tgl_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `merk`, `id_supplier`, `id_project`, `harga`, `tgl_beli`) VALUES
('BH001', 'Semen', 'gunung putri', 'SP001', 'PR001', '70000', '2023-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(10) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `upah` varchar(10) NOT NULL,
  `id_project` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `jabatan`, `upah`, `id_project`) VALUES
('KR001', 'agus', 'tukang kayu', '1000000', 'PR001'),
('KR002', 'Bayu', 'tukang bangunan', '1000000', 'PR001'),
('KR003', 'candra', 'tukang las', '1000000', 'PR001'),
('KR004', 'deni', 'mandor', '3000000', 'PR001'),
('KR005', 'edi', 'tukang ledeng', '900000', 'PR001'),
('KR006', 'Rafi', 'tukang', '7897', 'PR001');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'agus', 'agus', 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `mobilisasi`
--

CREATE TABLE `mobilisasi` (
  `id_mobilisasi` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `keterangan` text NOT NULL,
  `harga` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mobilisasi`
--

INSERT INTO `mobilisasi` (`id_mobilisasi`, `tgl`, `keterangan`, `harga`) VALUES
('MB001', '2023-07-11', 'pickup angkut seng', '150000');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id_project` varchar(10) NOT NULL,
  `nama_project` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `deposit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `nama_project`, `alamat`, `deposit`) VALUES
('PR001', 'Cafe ', 'Batu', '199930000'),
('PR002', 'Hotel', 'Kepanjen', '100000000');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `alamat`) VALUES
('SP001', 'Empat Roda', '089628905746', 'Malang'),
('SP002', 'Pasiri', '089767856678', 'Jombang\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `upah`
--

CREATE TABLE `upah` (
  `id_upah` int NOT NULL,
  `id_karyawan` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `upah_add` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `upah_total` varchar(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `upah`
--

INSERT INTO `upah` (`id_upah`, `id_karyawan`, `tanggal`, `upah_add`, `upah_total`, `keterangan`) VALUES
(1, 'KR001', '2023-07-05', '100000', '1100000', 'abc'),
(2, 'KR002', '2023-07-05', '100000', '1100000', 'cor'),
(9, 'KR005', '2023-07-06', '1800000', '1815000', 'pokok (26 Juni - 30 Juni) + (cor x 1)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `FK_absensi_karyawan` (`id_karyawan`);

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `alat_ibfk_1` (`id_project`),
  ADD KEY `alat_ibfk_2` (`id_supplier`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`),
  ADD KEY `bahan_ibfk_1` (`id_project`),
  ADD KEY `bahan_ibfk_2` (`id_supplier`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `karyawan_ibfk_1` (`id_project`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `mobilisasi`
--
ALTER TABLE `mobilisasi`
  ADD PRIMARY KEY (`id_mobilisasi`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `upah`
--
ALTER TABLE `upah`
  ADD PRIMARY KEY (`id_upah`),
  ADD KEY `upah_ibfk_1` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upah`
--
ALTER TABLE `upah`
  MODIFY `id_upah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `FK_absensi_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `alat_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alat_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bahan`
--
ALTER TABLE `bahan`
  ADD CONSTRAINT `bahan_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bahan_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upah`
--
ALTER TABLE `upah`
  ADD CONSTRAINT `upah_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
