-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2024 at 05:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`) VALUES
(1, 1, '2024-11-25 01:57:07', 'hans', 30),
(8, 3, '2024-11-25 13:39:53', 'jos', 2),
(9, 3, '2024-11-25 15:44:15', '1', 1),
(10, 5, '2024-11-25 15:47:40', '1', 1),
(11, 4, '2024-11-25 15:47:51', '1', 1),
(12, 6, '2024-11-25 15:49:27', 'jojo', 9),
(15, 7, '2024-11-25 15:54:27', 'Hans', 200),
(16, 6, '2024-11-25 16:21:28', 'Hans', 200),
(17, 8, '2024-11-25 16:21:39', 'Hans', 300),
(18, 9, '2024-11-25 16:21:49', 'Buku', 200),
(19, 12, '2024-11-25 16:21:58', 'Hans', 90),
(20, 10, '2024-11-25 16:22:04', 'Hans', 200),
(21, 9, '2024-11-25 16:22:11', 'Hans', 300),
(22, 8, '2024-11-25 16:22:20', 'Hans', 200),
(23, 7, '2024-11-25 16:22:30', 'Hans', 200),
(24, 6, '2024-11-25 16:22:41', 'Hans', 300);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL,
  `deskripsi` varchar(25) NOT NULL,
  `hargabarang` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `stock`, `deskripsi`, `hargabarang`) VALUES
(6, 'Pulpen', 609, 'Alat Tulis', 5000.00),
(7, 'Buku', 500, 'Buku', 7000.00),
(8, 'Dummy', 600, 'testing', 15000.00),
(9, 'Dummy1', 501, 'testing', 1.00),
(10, 'Dummy2', 300, 'Buku', 1.00),
(11, 'Dummy3', 123, '1', 1.00),
(12, 'Dummy4', 190, 'Dummy', 1.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
