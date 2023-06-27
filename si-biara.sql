-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 05:18 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, '0000', '$2a$12$sNupbS0YRIgWdXIwaCRQ6OdCNWFxoYNwZYreolTHeav8AbSniBEVy');

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
  `berkasTerkait` text DEFAULT NULL,
  `foto` text NOT NULL,
  `meninggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `nomorBaju`, `password`, `tempatLahir`, `tanggalLahir`, `nomorTelepon`, `status`, `berkasTerkait`, `foto`, `meninggal`) VALUES
(2, 'Reyner Neo (hello)', '0001', '$2a$12$sNupbS0YRIgWdXIwaCRQ6OdCNWFxoYNwZYreolTHeav8AbSniBEVy', 'Oeba', '2023-02-06', '082117386878', 'aktif', '', 'foto-1675619711_30a0404248a4d173dd10.jpg', NULL),
(23, 'Janelita Doe asdasda', '0002', '$2a$12$sNupbS0YRIgWdXIwaCRQ6OdCNWFxoYNwZYreolTHeav8AbSniBEVy', 'Amnatun', '1991-02-06', '628119988231', 'aktif', '', 'foto-1687399259_2f9ff8cad3a1db7f6cb4.jpg', NULL),
(34, 'Hello world', '0003', '$2a$12$sNupbS0YRIgWdXIwaCRQ6OdCNWFxoYNwZYreolTHeav8AbSniBEVy', 'world', '2023-12-31', '123123', 'aktif', '', 'foto-1687403721_04047b794bac6e658092.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `arsipkomunitas`
--

CREATE TABLE `arsipkomunitas` (
  `id` int(11) NOT NULL,
  `idKomunitas` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenisFile` enum('tahunan','bulanan','surat_masuk','surat_keluar') DEFAULT NULL,
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `arsipkomunitas`
--

INSERT INTO `arsipkomunitas` (`id`, `idKomunitas`, `nama`, `tanggal`, `jenisFile`, `file`) VALUES
(9, 1, 'asdasd', '2023-06-21', 'tahunan', 'arsip-1687340186_6dc32b22f9f3573f602a.pdf'),
(14, 3, 'asdasd', '2023-06-21', 'surat_keluar', 'arsip-1687403654_3821fc29922c6e4ab599.jpg'),
(15, 3, 'asdassssssssssssssssd', '2023-06-22', 'surat_masuk', 'arsip-1687403690_25e278761f32d9b7a761.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `idKegiatan` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `idKegiatan`, `foto`) VALUES
(24, 24, '1687370538_b10eeb7a90749b401ee0.jpg'),
(25, 24, '1687370918_12b83da5ddbdbda28456.jpg'),
(32, 27, '1687403609_fb3ab3368aa735118701.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hasilbelajar`
--

CREATE TABLE `hasilbelajar` (
  `id` int(11) NOT NULL,
  `idAnggota` int(11) NOT NULL,
  `universitas` varchar(250) NOT NULL,
  `fakultas` varchar(200) NOT NULL,
  `prodi` varchar(200) NOT NULL,
  `jenjang` enum('D3','D4','S1','S2','S3') NOT NULL,
  `semester` int(11) NOT NULL,
  `keterangan` enum('lulus','tidak-lulus') NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jeniskerasulan`
--

CREATE TABLE `jeniskerasulan` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jeniskerasulan`
--

INSERT INTO `jeniskerasulan` (`id`, `nama`, `keterangan`) VALUES
(1, 'Pendidikan', 'Test Keterangan baru'),
(2, 'Kesehatan', 'Membangun fasilitas kesehatan untuk mendukung wilayah yang membutuhkan bantuan kesehatan'),
(3, 'Sosial Pastoral', '-Sosial Pastoral');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `idKomunitas` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `thumbnail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `idKomunitas`, `judul`, `deskripsi`, `tanggal`, `thumbnail`) VALUES
(24, 5, 'asdasd', '<p>asdasd</p>', '2023-12-31', 'thumbnail-1687370524_c5aa1422636d4bf75a9d.jpg'),
(27, 1, 'sadasdas', '<p>adasdasd</p>', '2023-06-22', 'thumbnail-1687403592_1d68d53a64fe6685cafb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kerasulan`
--

CREATE TABLE `kerasulan` (
  `id` int(11) NOT NULL,
  `idKomunitas` int(11) NOT NULL,
  `idJenisKerasulan` int(11) NOT NULL,
  `namaLembaga` varchar(255) NOT NULL,
  `tanggalBerdiri` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kerasulan`
--

INSERT INTO `kerasulan` (`id`, `idKomunitas`, `idJenisKerasulan`, `namaLembaga`, `tanggalBerdiri`, `keterangan`) VALUES
(6, 5, 2, '  Testsdasd', '2023-12-31', '<p>Hello <strong>world</strong></p>');

-- --------------------------------------------------------

--
-- Table structure for table `komunitas`
--

CREATE TABLE `komunitas` (
  `id` int(11) NOT NULL,
  `idProvinsi` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `tanggalBerdiri` date NOT NULL,
  `status` enum('1','0') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id`, `idProvinsi`, `nama`, `alamat`, `tanggalBerdiri`, `status`) VALUES
(1, 1, 'Komunitas 1', 'Oeba', '2022-11-25', '1'),
(3, 1, 'Komunitas 2', 'kayu putih                                                                                                                                                             ', '2022-11-01', '1'),
(5, 1, 'Komunitas 3', 'alamat', '2022-11-01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pembinaan`
--

CREATE TABLE `pembinaan` (
  `id` int(11) NOT NULL,
  `idAnggota` int(11) NOT NULL,
  `idTahapPembinaan` int(11) NOT NULL,
  `tanggalPembinaan` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembinaan`
--

INSERT INTO `pembinaan` (`id`, `idAnggota`, `idTahapPembinaan`, `tanggalPembinaan`, `keterangan`, `status`, `file`) VALUES
(25, 23, 1, '2023-03-18', 'sd', 'N', NULL),
(26, 23, 2, '2023-03-28', '<p>qw</p>', 'Y', NULL),
(31, 34, 1, '2023-12-31', '-', 'Y', NULL),
(32, 35, 1, '2023-12-31', '123123', 'N', NULL),
(33, 36, 1, '2023-06-22', 'asdasda', 'Y', NULL),
(34, 37, 1, '2023-06-22', 'asd', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penugasan`
--

CREATE TABLE `penugasan` (
  `id` int(11) NOT NULL,
  `idKomunitas` int(11) NOT NULL,
  `idAnggota` int(11) NOT NULL,
  `tanggalPenugasan` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Y','T','M') NOT NULL DEFAULT 'M',
  `file` text DEFAULT NULL,
  `role` enum('superuser','superadmin','admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penugasan`
--

INSERT INTO `penugasan` (`id`, `idKomunitas`, `idAnggota`, `tanggalPenugasan`, `keterangan`, `status`, `file`, `role`) VALUES
(16, 1, 23, '2005-05-08', 'pembinaan awal', 'Y', NULL, 'superadmin'),
(25, 3, 23, '2012-05-08', '<p>pembinaan awal</p>', 'Y', NULL, 'superadmin'),
(40, 3, 34, '2023-12-31', '-', 'Y', NULL, 'admin'),
(41, 3, 35, '2023-12-31', '123123', 'M', NULL, 'user'),
(42, 1, 36, '2023-06-22', 'asd', 'Y', NULL, 'user'),
(43, 5, 36, '2023-06-22', NULL, 'Y', 'penugasan-1687365509_c98d57d9bf580833bc6b.pdf', 'admin'),
(44, 1, 37, '2023-06-22', 'asd', 'Y', 'foto-1687401430_6261e5f9f09cfdf2502f.jpg', 'user'),
(45, 3, 34, '2023-06-22', NULL, 'Y', 'penugasan-1687401696_09582330c129321527d4.pdf', 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `sejarahSingkat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`, `visi`, `misi`, `sejarahSingkat`) VALUES
(1, 'Provinsi', 'adsdasd', 'asdasd', 'asdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `tahappembinaan`
--

CREATE TABLE `tahappembinaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahappembinaan`
--

INSERT INTO `tahappembinaan` (`id`, `nama`, `keterangan`) VALUES
(1, 'Aspiran', 'Test Aspiran'),
(2, 'Postulan', 'hello world this is keterangan'),
(3, 'Novisiat', 'Novisiat'),
(4, 'Yuniorat', '-'),
(5, 'Karya', 'Tahap Final');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arsipkomunitas`
--
ALTER TABLE `arsipkomunitas`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idKomunitas` (`idKomunitas`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKegiatan` (`idKegiatan`);

--
-- Indexes for table `hasilbelajar`
--
ALTER TABLE `hasilbelajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAnggota` (`idAnggota`),
  ADD KEY `idAnggota_2` (`idAnggota`);

--
-- Indexes for table `jeniskerasulan`
--
ALTER TABLE `jeniskerasulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerasulan`
--
ALTER TABLE `kerasulan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKomunitas` (`idKomunitas`),
  ADD KEY `idJenisKerasulan` (`idJenisKerasulan`);

--
-- Indexes for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProvinsi` (`idProvinsi`);

--
-- Indexes for table `pembinaan`
--
ALTER TABLE `pembinaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAnggota` (`idAnggota`),
  ADD KEY `idTahapPembinaan` (`idTahapPembinaan`);

--
-- Indexes for table `penugasan`
--
ALTER TABLE `penugasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKomunitas` (`idKomunitas`,`idAnggota`),
  ADD KEY `idAnggota` (`idAnggota`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahappembinaan`
--
ALTER TABLE `tahappembinaan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `arsipkomunitas`
--
ALTER TABLE `arsipkomunitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `hasilbelajar`
--
ALTER TABLE `hasilbelajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jeniskerasulan`
--
ALTER TABLE `jeniskerasulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kerasulan`
--
ALTER TABLE `kerasulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembinaan`
--
ALTER TABLE `pembinaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `penugasan`
--
ALTER TABLE `penugasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tahappembinaan`
--
ALTER TABLE `tahappembinaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
