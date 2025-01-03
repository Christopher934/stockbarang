-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 04:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `penerima` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `penerima`, `qty`, `tanggal`) VALUES
(1, 1, 'Jojo', 10, '2024-11-25 07:00:11'),
(2, 2, 'Jojo', 100, '2024-11-25 07:15:41'),
(5, 3, 'Hans', 14991, '2024-11-25 07:51:04'),
(8, 4, 'Hans', 80, '2024-11-25 07:58:00'),
(9, 5, 'Hans', 1, '2024-11-26 09:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(8, 'admin@gmail.com', 'password'),
(9, 'youandao1704@gmail.com', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `qty`, `keterangan`, `tanggal`) VALUES
(2, 2, 100, 'Jojo', '2024-11-25 07:14:56'),
(3, 3, 10000, 'hans', '2024-11-25 07:27:30'),
(4, 0, 100, 'hans', '2024-11-25 07:51:56'),
(5, 4, 9, 'hans', '2024-11-25 08:01:36'),
(7, 7, 12, 'a', '2024-11-26 08:24:59'),
(8, 6, 1, '1', '2024-11-26 08:25:17'),
(10, 6, 1, '1', '2024-11-26 08:25:45'),
(11, 6, 1, '1', '2024-11-26 08:25:49'),
(12, 6, 1, '1', '2024-11-26 08:25:52'),
(13, 6, 1, '1', '2024-11-26 08:25:56'),
(14, 6, 1, '1', '2024-11-26 08:25:59'),
(15, 6, 1, '1', '2024-11-26 08:26:03'),
(17, 6, 1, '1', '2024-11-26 08:26:14'),
(18, 6, 1, '1', '2024-11-26 08:26:26'),
(19, 6, 1, '1', '2024-11-26 08:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(25) NOT NULL,
  `deskripsi` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL,
  `hargabarang` decimal(10,2) NOT NULL,
  `nomorseri` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `deskripsi`, `stock`, `hargabarang`, `nomorseri`) VALUES
(5, 'Dummy', 'Buku', 11, 1.00, '123123'),
(6, 'Amplop', 'Buku', 11, 1.00, 'Dq123'),
(7, 'Dummy1', 'Buku', 24, 1.00, 'adasd'),
(8, 'Dummy2', 'Buku', 1, 1.00, ''),
(9, 'Dummy3', 'Buku', 12, 1.00, ''),
(10, 'Dummy4', 'Buku', 1, 1.00, ''),
(11, 'Dummy5', 'Buku', 1, 1.00, ''),
(14, 'Dummy8', '', 1, 1.00, 'asd'),
(19, 'Amplop', 'Buku', 88, 88000.00, 'bujy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

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
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
