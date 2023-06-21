-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 09:12 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si-biara`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nomorBaju` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tempatLahir` varchar(200) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `nomorTelepon` varchar(12) NOT NULL,
  `status` enum('aktif','non-aktif','eksklaustrasi','meninggal') NOT NULL DEFAULT 'non-aktif',
  `berkasTerkait` text NOT NULL,
  `foto` text NOT NULL,
  `meninggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `nomorBaju`, `password`, `tempatLahir`, `tanggalLahir`, `nomorTelepon`, `status`, `berkasTerkait`, `foto`, `meninggal`) VALUES
(2, 'Reyner Neo (hello)', '0001', '$2a$12$sNupbS0YRIgWdXIwaCRQ6OdCNWFxoYNwZYreolTHeav8AbSniBEVy', 'Oeba', '2023-02-06', '082117386878', 'aktif', '', 'foto-1675619711_30a0404248a4d173dd10.jpg', NULL),
(23, 'Janelita Doe', '0002', '$2a$12$sNupbS0YRIgWdXIwaCRQ6OdCNWFxoYNwZYreolTHeav8AbSniBEVy', 'Amnatun', '1991-02-06', '628119988231', 'aktif', '', 'foto-1674360963_aed06b10b29f9e0b0c9d.jpeg', NULL),
(34, 'Hello', '0003', '$2a$12$sNupbS0YRIgWdXIwaCRQ6OdCNWFxoYNwZYreolTHeav8AbSniBEVy', 'world', '2023-12-31', '123123', 'aktif', '', 'foto-1687308626_f8f36b528041b4b1c630.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
