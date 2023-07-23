-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2023 at 12:06 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangjadi`
--

CREATE TABLE `barangjadi` (
  `idBarangJadi` char(10) NOT NULL,
  `namaBarangJadi` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangjadi`
--

INSERT INTO `barangjadi` (`idBarangJadi`, `namaBarangJadi`, `status`) VALUES
('BJ001', 'Jeans Pendek', 'Active'),
('BJ002', 'Jeans Panjang', 'Active'),
('BJ003', 'Jeans Kulot', 'Active'),
('BJ004', 'Jeans Sobek', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluarjadi`
--

CREATE TABLE `barangkeluarjadi` (
  `idTransaksi` char(15) NOT NULL,
  `tanggal` date NOT NULL,
  `idBarangJadi` char(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangkeluarjadi`
--

INSERT INTO `barangkeluarjadi` (`idTransaksi`, `tanggal`, `idBarangJadi`, `jumlah`, `harga`, `keterangan`, `inserted_at`) VALUES
('TKBJ-160723-001', '2023-07-16', 'BJ001', 20, 2000000, '', '2023-07-16 15:30:52'),
('TKBJ-160723-002', '2023-07-16', 'BJ002', 20, 2000000, '', '2023-07-16 15:31:25'),
('TKBJ-210723-001', '2023-07-21', 'BJ002', 20, 1500000, '', '2023-07-21 14:32:11'),
('TKBJ-210723-002', '2023-07-21', 'BJ003', 20, 1500000, '', '2023-07-21 14:32:18'),
('TKBJ-210723-003', '2023-07-21', 'BJ003', 20, 2000000, '', '2023-07-21 14:32:27'),
('TKBJ-210723-004', '2023-07-21', 'BJ003', 20, 2000000, '', '2023-07-21 14:32:34'),
('TKBJ-210723-005', '2023-07-21', 'BJ004', 20, 2000000, '', '2023-07-21 14:32:52');

--
-- Triggers `barangkeluarjadi`
--
DELIMITER $$
CREATE TRIGGER `delete_transaksi_keluar_trigger` AFTER DELETE ON `barangkeluarjadi` FOR EACH ROW BEGIN
    UPDATE stokbarangjadi
    SET stok = stok + OLD.jumlah
    WHERE idBarangJadi = OLD.idBarangJadi;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_transaksi_keluar_trigger` AFTER INSERT ON `barangkeluarjadi` FOR EACH ROW BEGIN
    UPDATE stokbarangjadi
    SET stok = stok - NEW.jumlah
    WHERE idBarangJadi = NEW.idBarangJadi;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_transaksi_keluar_trigger` AFTER UPDATE ON `barangkeluarjadi` FOR EACH ROW BEGIN
    DECLARE selisih INT;
    SET selisih = NEW.jumlah - OLD.jumlah;
    UPDATE stokbarangjadi
    SET stok = stok - selisih
    WHERE idBarangJadi = NEW.idBarangJadi;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barangmasukmentah`
--

CREATE TABLE `barangmasukmentah` (
  `idTransaksi` char(15) NOT NULL,
  `tanggal` date NOT NULL,
  `idBarangMentah` char(10) NOT NULL,
  `idSupplier` char(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangmasukmentah`
--

INSERT INTO `barangmasukmentah` (`idTransaksi`, `tanggal`, `idBarangMentah`, `idSupplier`, `jumlah`, `harga`, `keterangan`, `inserted_at`) VALUES
('TMBM-120723-001', '2023-07-12', 'BM002', 'S001', 20, 2000000, '', '2023-07-12 17:24:32'),
('TMBM-120723-002', '2023-07-12', 'BM002', 'S002', 25, 2000000, '', '2023-07-12 17:27:06'),
('TMBM-120723-003', '2023-07-12', 'BM003', 'S001', 20, 2000000, '', '2023-07-12 17:33:41'),
('TMBM-120723-004', '2023-07-12', 'BM005', 'S003', 20, 2000000, '', '2023-07-12 17:36:46'),
('TMBM-130723-001', '2023-07-13', 'BM004', 'S005', 20, 2000000, '', '2023-07-13 08:32:51'),
('TMBM-140723-001', '2023-07-14', 'BM003', 'S002', 20, 2000000, '', '2023-07-14 14:11:45'),
('TMBM-200623-001', '2023-06-20', 'BM002', 'S001', 15, 1500000, 'Pembelian bahan mentah awal', '2023-07-12 16:42:07'),
('TMBM-210723-001', '2023-07-21', 'BM002', 'S001', 15, 1500000, '', '2023-07-21 14:33:13'),
('TMBM-210723-002', '2023-07-21', 'BM004', 'S002', 20, 2000000, '', '2023-07-21 14:55:26'),
('TMBM-210723-003', '2023-07-21', 'BM001', 'S002', 20, 123123, '', '2023-07-21 14:56:20'),
('TMBM-210723-004', '2023-07-21', 'BM002', 'S002', 123, 123123, '', '2023-07-21 15:49:09'),
('TMBM-220723-001', '2023-08-03', 'BM002', 'S003', 20, 2000000, '', '2023-07-22 13:25:26');

--
-- Triggers `barangmasukmentah`
--
DELIMITER $$
CREATE TRIGGER `delete_transaksi_masuk_trigger` AFTER DELETE ON `barangmasukmentah` FOR EACH ROW BEGIN
    UPDATE stokbarangmentah
    SET stok = stok - OLD.jumlah
    WHERE idBarangMentah = OLD.idBarangMentah;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_transaksi_masuk_trigger` AFTER INSERT ON `barangmasukmentah` FOR EACH ROW BEGIN
    UPDATE stokbarangmentah
    SET stok = stok + NEW.jumlah
    WHERE idBarangMentah = NEW.idBarangMentah;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_transaksi_masuk_trigger` AFTER UPDATE ON `barangmasukmentah` FOR EACH ROW BEGIN
    DECLARE selisih INT;
    SET selisih = NEW.jumlah - OLD.jumlah;
    UPDATE stokbarangmentah
    SET stok = stok + selisih
    WHERE idBarangMentah = NEW.idBarangMentah;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barangmentah`
--

CREATE TABLE `barangmentah` (
  `idBarangMentah` char(10) NOT NULL,
  `namaBarangMentah` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangmentah`
--

INSERT INTO `barangmentah` (`idBarangMentah`, `namaBarangMentah`, `status`) VALUES
('BM001', 'Kain', 'Active'),
('BM002', 'Benang Jahit', 'Active'),
('BM003', 'Kancing', 'Active'),
('BM004', 'Resleting', 'Active'),
('BM005', 'Tali', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `stokbarangjadi`
--

CREATE TABLE `stokbarangjadi` (
  `idStokBarangJadi` char(10) NOT NULL,
  `idBarangJadi` char(10) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokbarangjadi`
--

INSERT INTO `stokbarangjadi` (`idStokBarangJadi`, `idBarangJadi`, `stok`) VALUES
('SBJ001', 'BJ001', 200),
('SBJ002', 'BJ002', 280),
('SBJ003', 'BJ003', 440),
('SBJ004', 'BJ004', 180);

-- --------------------------------------------------------

--
-- Table structure for table `stokbarangmentah`
--

CREATE TABLE `stokbarangmentah` (
  `idStokBarangMentah` char(10) NOT NULL,
  `idBarangMentah` char(10) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokbarangmentah`
--

INSERT INTO `stokbarangmentah` (`idStokBarangMentah`, `idBarangMentah`, `stok`) VALUES
('SBM001', 'BM001', 90),
('SBM002', 'BM002', 261),
('SBM003', 'BM003', 54),
('SBM004', 'BM004', 163);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idSupplier` char(10) NOT NULL,
  `namaSupplier` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idSupplier`, `namaSupplier`, `alamat`, `kontak`, `status`) VALUES
('S001', 'PT Gutex', 'Pekalongan', 'cs.gutex@gutex.co.id', 'Active'),
('S002', 'PT Jayatex', 'Pekalongan', 'cs.jayatex@jayatex.co.id', 'Active'),
('S003', 'PT Garment', 'Jl. MT. Haryono No.11 – 12, Wonodri, Semarang Selatan, Semarang City, Central Java 50242', '(024) 8314517', 'Active'),
('S004', 'CV ABC', 'Jl. MT. Haryono No.11 – 12, Wonodri, Semarang Selatan, Semarang City, Central Java 50242', '(031) 3538135', 'Active'),
('S005', 'PT Ajiwijayatex', 'Jl. MT. Haryono No.11 – 12, Wonodri, Semarang Selatan, Semarang City, Central Java 50242', 'ajiwijayatex_order@ajiwijayatex.co.id', 'Active'),
('S006', 'PT Dutatex', 'Pekajangan', 'dutatex_order@dutatex.co.id', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_created_at`) VALUES
(1, 'admin', 'admin', '2023-05-11 07:50:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangjadi`
--
ALTER TABLE `barangjadi`
  ADD PRIMARY KEY (`idBarangJadi`);

--
-- Indexes for table `barangkeluarjadi`
--
ALTER TABLE `barangkeluarjadi`
  ADD PRIMARY KEY (`idTransaksi`),
  ADD KEY `idBarangMentah` (`idBarangJadi`);

--
-- Indexes for table `barangmasukmentah`
--
ALTER TABLE `barangmasukmentah`
  ADD PRIMARY KEY (`idTransaksi`),
  ADD KEY `idBarangMentah` (`idBarangMentah`),
  ADD KEY `idSupplier` (`idSupplier`);

--
-- Indexes for table `barangmentah`
--
ALTER TABLE `barangmentah`
  ADD PRIMARY KEY (`idBarangMentah`);

--
-- Indexes for table `stokbarangjadi`
--
ALTER TABLE `stokbarangjadi`
  ADD PRIMARY KEY (`idStokBarangJadi`),
  ADD KEY `idBarangJadi` (`idBarangJadi`);

--
-- Indexes for table `stokbarangmentah`
--
ALTER TABLE `stokbarangmentah`
  ADD PRIMARY KEY (`idStokBarangMentah`),
  ADD KEY `stokbarangmentah_ibfk_1` (`idBarangMentah`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idSupplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangkeluarjadi`
--
ALTER TABLE `barangkeluarjadi`
  ADD CONSTRAINT `barangkeluarjadi_ibfk_1` FOREIGN KEY (`idBarangJadi`) REFERENCES `barangjadi` (`idBarangJadi`);

--
-- Constraints for table `barangmasukmentah`
--
ALTER TABLE `barangmasukmentah`
  ADD CONSTRAINT `barangmasukmentah_ibfk_1` FOREIGN KEY (`idBarangMentah`) REFERENCES `barangmentah` (`idBarangMentah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barangmasukmentah_ibfk_2` FOREIGN KEY (`idSupplier`) REFERENCES `supplier` (`idSupplier`);

--
-- Constraints for table `stokbarangjadi`
--
ALTER TABLE `stokbarangjadi`
  ADD CONSTRAINT `stokbarangjadi_ibfk_1` FOREIGN KEY (`idBarangJadi`) REFERENCES `barangjadi` (`idBarangJadi`);

--
-- Constraints for table `stokbarangmentah`
--
ALTER TABLE `stokbarangmentah`
  ADD CONSTRAINT `stokbarangmentah_ibfk_1` FOREIGN KEY (`idBarangMentah`) REFERENCES `barangmentah` (`idBarangMentah`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
