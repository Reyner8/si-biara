-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 08:34 AM
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
  `berkasTerkait` text DEFAULT NULL,
  `role` enum('superuser','superadmin','admin','user') NOT NULL DEFAULT 'user',
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `nomorBaju`, `password`, `tempatLahir`, `tanggalLahir`, `nomorTelepon`, `status`, `berkasTerkait`, `role`, `foto`) VALUES
(1, 'Administrator', 'B-000', '$2a$12$sNupbS0YRIgWdXIwaCRQ6OdCNWFxoYNwZYreolTHeav8AbSniBEVy', 'admin', '0000-00-00', '0', 'aktif', '', 'superuser', 'default.png'),
(2, 'Reyner Neo (hello)', 'B-001', '$2a$12$sNupbS0YRIgWdXIwaCRQ6OdCNWFxoYNwZYreolTHeav8AbSniBEVy', 'Oeba', '2023-02-06', '082117386878', 'aktif', '', 'superadmin', 'foto-1675619711_30a0404248a4d173dd10.jpg'),
(23, 'Janelita Doe', 'B-002', '$2y$10$Jp9cieprwUdE7EA93PmxF.U/whYbXbDU.gr2PEVi/fEIl6T389QvO', 'Amnatun', '1991-02-06', '628119988231', 'eksklaustrasi', '', 'admin', 'foto-1686809116_a3f85406a539359f054d.jpeg'),
(25, 'test foto', 'B-003', '$2y$10$nnrdkY1QFxZp4BoB8wb9eOCRRgW9kJbV6jvwMwYd8Q4uCak2fLbzO', 'test', '2023-01-01', '00000', 'aktif', '', 'user', 'foto-1676699409_a942fef6518b7c40d9af.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id` int(11) NOT NULL,
  `idProvinsi` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenisFile` enum('tahunan','bulanan','surat_masuk','surat_keluar') DEFAULT NULL,
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id`, `idProvinsi`, `nama`, `tanggal`, `jenisFile`, `file`) VALUES
(11, 3, 'asdasd', '2023-06-12', 'surat_masuk', 'arsip-1686549972_9229e84d963cc327b2c4.xlsx'),
(12, 4, 'asdasdasdasdasdas', '2023-05-29', 'tahunan', 'arsip-1686550680_8a2c526585109a4e702a.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `idKegiatan` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `idKegiatan`, `foto`) VALUES
(10, 11, '1673528324_64f0ba8aad76df73e23b.png'),
(12, 11, '1673528324_64f0ba8aad76df73e23b.png'),
(13, 17, '1673877435_15d138ebaf312dfba98e.png'),
(14, 17, '1673877435_b848615006401edbca1b.png'),
(15, 17, '1673877435_02671b96cc1c413fdd69.png'),
(16, 18, '1676006787_786ce3fba930706efc26.png'),
(18, 18, '1678019997_b3c8bcb7666cb593f9bb.png'),
(19, 18, '1678019997_4ead0c6878d160ce2377.png'),
(20, 18, '1678019997_adfd4ba4edbb9b9b6cff.png'),
(21, 18, '1678019997_859903ee1f5112782835.png'),
(22, 18, '1678019997_8e4110848fa56d97219f.png'),
(25, 19, '1686552098_f945832a68ffd1e95ca0.jpeg');

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
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jeniskerasulan`
--

CREATE TABLE `jeniskerasulan` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `idAnggota` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `thumbnail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `idAnggota`, `judul`, `deskripsi`, `tanggal`, `thumbnail`) VALUES
(17, 2, 'sfwe', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis nam quam sunt impedit corrupti tenetur praesentium! At quo nihil cum quisquam, enim voluptatem corrupti veniam soluta, quaerat placeat accusamus nemo!', '2023-01-17', 'thumbnail-1674273787_88f74c97a8adc8ed63ed.png'),
(18, 1, 'Kegiatan', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis nam quam sunt impedit corrupti tenetur praesentium! At quo nihil cum quisquam, enim voluptatem corrupti veniam soluta, quaerat placeat accusamus nemo!', '2023-12-31', 'thumbnail-1676006772_caefa50088dd81007a4e.png'),
(19, 1, 'asdasdasd', '<p>asdasdasdas</p>', '2023-07-02', 'thumbnail-1686557711_607aaebe69dc8d45aa3b.jpeg');

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
  `keterangan` text NOT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kerasulan`
--

INSERT INTO `kerasulan` (`id`, `idKomunitas`, `idJenisKerasulan`, `namaLembaga`, `tanggalBerdiri`, `keterangan`, `foto`) VALUES
(6, 1, 2, 'Test', '2023-12-31', '<p>Hello <strong>world</strong></p>', 'foto-1677984044_aeaca1c66ae207400cfb.png');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id`, `idProvinsi`, `nama`, `alamat`, `tanggalBerdiri`, `status`) VALUES
(1, 3, 'Komunitas 1', 'Oeba', '2022-11-25', '1'),
(3, 4, 'Komunitas 2', 'kayu putih                                                                                                                                                             ', '2022-11-01', '1'),
(5, 4, 'Komunitas 3', 'alamat', '2022-11-01', '1');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembinaan`
--

INSERT INTO `pembinaan` (`id`, `idAnggota`, `idTahapPembinaan`, `tanggalPembinaan`, `keterangan`, `status`, `file`) VALUES
(24, 2, 1, '2023-03-18', 'sd', 'N', NULL),
(25, 23, 1, '2023-03-18', 'sd', 'N', NULL),
(26, 23, 2, '2023-03-28', '<p>qw</p>', '', NULL);

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
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penugasan`
--

INSERT INTO `penugasan` (`id`, `idKomunitas`, `idAnggota`, `tanggalPenugasan`, `keterangan`, `status`, `file`) VALUES
(16, 1, 23, '2005-05-08', 'pembinaan awal', 'Y', NULL),
(17, 1, 2, '2005-05-08', 'Tugas 1', 'Y', NULL),
(23, 3, 2, '2023-05-08', 'Tugas 1', 'M', NULL),
(25, 3, 23, '2012-05-08', 'pembinaan awal', 'M', NULL),
(27, 1, 25, '2023-01-02', 'asdwqe', 'Y', NULL),
(28, 5, 28, '2023-02-08', 'as', 'Y', NULL),
(31, 5, 2, '2023-03-16', '<p>jjjjj</p>', 'Y', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`, `visi`, `misi`, `sejarahSingkat`) VALUES
(3, ' Provinsi 2 test', '<p>Visi <strong>Provinsi</strong></p>', '<p>Misi <i>Provinsi</i></p>', '<p>Sejarah Singkat <i><strong>Provinsi</strong></i></p>'),
(4, 'Provinsi 3', '<p>asdasd</p>', '<p>asdasd</p>', '<p>aswdas</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tahappembinaan`
--

CREATE TABLE `tahappembinaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahappembinaan`
--

INSERT INTO `tahappembinaan` (`id`, `nama`, `keterangan`) VALUES
(1, 'Aspiran', 'Test Aspiran'),
(2, 'Postulan', 'hello world this is keterangan'),
(3, 'Novisiat', 'Novisiat'),
(4, 'Yuniorat', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasilbelajar`
--
ALTER TABLE `hasilbelajar`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembinaan`
--
ALTER TABLE `pembinaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penugasan`
--
ALTER TABLE `penugasan`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hasilbelajar`
--
ALTER TABLE `hasilbelajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jeniskerasulan`
--
ALTER TABLE `jeniskerasulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kerasulan`
--
ALTER TABLE `kerasulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembinaan`
--
ALTER TABLE `pembinaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `penugasan`
--
ALTER TABLE `penugasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tahappembinaan`
--
ALTER TABLE `tahappembinaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
