-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2023 at 02:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokokue`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `harga_barang` decimal(10,2) DEFAULT NULL,
  `stok_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `gambar`, `nama_barang`, `kode_barang`, `harga_barang`, `stok_barang`) VALUES
(1, 'public/cake1.jpeg', 'Strawberry Cake', 'K0001', 30000.00, 50),
(2, 'public/cake2.jpeg', 'Matcha Cake', 'K0002', 35000.00, 30),
(3, 'public/cake3.jpeg', 'Blackforest', 'K0003', 25000.00, 60),
(4, 'public/cake4.jpeg', 'Oreo Cake', 'K0004', 30000.00, 40),
(5, 'public/cake5.jpeg', 'Redvelvet Cake', 'K0005', 35000.00, 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
