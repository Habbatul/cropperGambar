-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 11:50 PM
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
-- Database: `jayadigital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `gambar` varchar(512) NOT NULL,
  `nama` text NOT NULL,
  `deskripsi` text NOT NULL,
  `jenis` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `gambar`, `nama`, `deskripsi`, `jenis`) VALUES
(1, 'Untitled.png', 'g', 'g', 'g'),
(2, '2000018240_nomor2_POST2.jpg', 'sdfsdf', 'sdfsdf', 'sdfsdfsdf'),
(3, 'xs1', 'xs2', 'xs3', 'xs4'),
(4, 'xs1', 'xs2', 'xs3', 'xs4'),
(5, '2000018240_POST7.jpg', 'asdasd', 'asdasd', 'asdasdasd'),
(15, '2000018240_POST7.jpg', 'asdasdasd', 'asdasdasd', 'asdasdasdasd'),
(17, '2.jpg', 'ghvghvgh', 'hbn bn ', 'yttyf'),
(19, 'dsr', 'wer', 'ewr', ''),
(22, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(23, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(24, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(25, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(26, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(27, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(28, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(29, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(30, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(31, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(32, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(33, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(34, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(35, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(36, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(37, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(38, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(39, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(40, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(41, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(42, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(43, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(44, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(45, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(46, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(47, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(48, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(49, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(50, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(51, '2.jpg', '2', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id` int(11) NOT NULL,
  `pemilik` varchar(512) NOT NULL,
  `status` varchar(512) NOT NULL,
  `resi` text NOT NULL,
  `nama_laptop` varchar(512) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id`, `pemilik`, `status`, `resi`, `nama_laptop`, `tanggal`) VALUES
(1, '1', '1', '1', '1', '2023-01-01'),
(2, 'pemilik2', 'terkirim', '3333', 'laptop2', '2023-05-02'),
(3, 'pemilik3', 'proses', '4444', 'laptop3', '2023-05-03'),
(4, 'pemilik4', 'selesai', '5555', 'laptop4', '2023-05-04'),
(5, 'pemilik5', 'proses', '6666', 'laptop5', '2023-05-05'),
(6, 'pemilik6', 'selesai', '7777', 'laptop6', '2023-05-06'),
(7, 'pemilik7', 'oke', '8888', 'laptop7', '2023-05-07'),
(8, 'pemilik8', 'terkirim', '9999', 'laptop8', '2023-05-08'),
(9, 'pemilik9', 'proses', '1010', 'laptop9', '2023-05-09'),
(10, 'pemilik10', 'selesai', '1111', 'laptop10', '2023-05-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
