-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 06:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpena`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `nama_brg` varchar(222) NOT NULL,
  `kode_brg` varchar(222) NOT NULL,
  `stock` int(4) NOT NULL,
  `harga` varchar(222) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `foto`, `nama_brg`, `kode_brg`, `stock`, `harga`, `created_at`) VALUES
(6, 'Screenshot 2023-11-21 at 21-01-21 @pen_storeee Profil Instagram.png', 'Pulpen Joyko', 'BP-338', 100, '3000', '2023-11-21 08:14:56'),
(7, 'Screenshot 2023-11-21 at 21-01-59 @pen_storeee Profil Instagram.png', 'Pulpen Snowman', 'BP-7', 100, '3000', '2023-11-21 08:17:22'),
(8, 'Screenshot 2023-11-21 at 21-02-18 @pen_storeee Profil Instagram.png', 'Pulpen Joyko Suma', 'BP-248', 100, '3000', '2023-11-21 08:19:09'),
(9, 'Screenshot 2023-11-21 at 21-02-33 @pen_storeee Profil Instagram.png', 'Pulpen Haris', 'H-803', 100, '3000', '2023-11-21 08:20:06'),
(10, 'Screenshot 2023-11-21 at 21-02-50 @pen_storeee Profil Instagram.png', 'Pulpen Snowman Medium Point', 'V-2', 100, '4000', '2023-11-21 08:20:31'),
(11, 'cctv 5.jpg', 'CCTV', 'CV', 100, '30000', '2023-11-26 00:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar`
--

CREATE TABLE `brg_keluar` (
  `id_brg_keluar` int(4) NOT NULL,
  `barang` varchar(222) NOT NULL,
  `jumlah` varchar(222) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_brg` varchar(222) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_keluar`
--

INSERT INTO `brg_keluar` (`id_brg_keluar`, `barang`, `jumlah`, `tanggal`, `kode_brg`, `created_at`) VALUES
(7, '6', '100', '2023-11-21', 'BP-338', '0000-00-00 00:00:00'),
(8, '11', '3', '2023-11-26', 'CV', '0000-00-00 00:00:00');

--
-- Triggers `brg_keluar`
--
DELIMITER $$
CREATE TRIGGER `ari` AFTER INSERT ON `brg_keluar` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock-new.jumlah WHERE kode_brg=new.kode_brg;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus` AFTER DELETE ON `brg_keluar` FOR EACH ROW BEGIN 
UPDATE barang set stock =stock+old.jumlah
where kode_brg=old.kode_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk`
--

CREATE TABLE `brg_masuk` (
  `id_brg_masuk` int(4) NOT NULL,
  `barang` varchar(222) NOT NULL,
  `jumlah` varchar(222) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_brg` varchar(222) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_masuk`
--

INSERT INTO `brg_masuk` (`id_brg_masuk`, `barang`, `jumlah`, `tanggal`, `kode_brg`, `created_at`) VALUES
(12, '6', '100', '2023-11-21', 'BP-338', '0000-00-00 00:00:00'),
(13, '11', '2', '2023-11-26', 'CV', '0000-00-00 00:00:00'),
(14, '11', '1', '2024-01-29', 'CV', '0000-00-00 00:00:00');

--
-- Triggers `brg_masuk`
--
DELIMITER $$
CREATE TRIGGER `hapusss` AFTER DELETE ON `brg_masuk` FOR EACH ROW BEGIN 
UPDATE barang set stock =stock-old.jumlah
where kode_brg=old.kode_brg;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah` AFTER INSERT ON `brg_masuk` FOR EACH ROW BEGIN
UPDATE barang SET stock = stock+new.jumlah WHERE kode_brg=new.kode_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(4) NOT NULL,
  `nama_level` varchar(222) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `created_at`) VALUES
(1, 'Admin', '2023-11-05 06:51:25'),
(2, 'Petugas', '2023-11-05 07:17:40'),
(3, 'Super Admin', '2023-11-21 15:42:28'),
(4, 'Penguna', '2024-01-29 03:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `penguna`
--

CREATE TABLE `penguna` (
  `id_penguna` int(4) NOT NULL,
  `nama` varchar(222) NOT NULL,
  `ttl` date NOT NULL,
  `jk` enum('Laki-laki','Perempuan','','') NOT NULL,
  `alamat` varchar(222) NOT NULL,
  `nohp` varchar(222) NOT NULL,
  `user` varchar(222) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penguna`
--

INSERT INTO `penguna` (`id_penguna`, `nama`, `ttl`, `jk`, `alamat`, `nohp`, `user`, `created_at`) VALUES
(1, 'sasa', '2024-01-29', 'Laki-laki', '1231', '6565', '6', '0000-00-00 00:00:00'),
(2, 'sasasasasasa', '2024-01-29', 'Laki-laki', 'sasa', '3232', '5', '0000-00-00 00:00:00'),
(3, 'sasa', '2024-01-29', 'Laki-laki', 'sasaas', '2121', '8', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(4) NOT NULL,
  `nama_petugas` varchar(222) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `ttl` date NOT NULL,
  `nohp` varchar(222) NOT NULL,
  `nik` int(111) NOT NULL,
  `user` int(222) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `jk`, `ttl`, `nohp`, `nik`, `user`, `created_at`) VALUES
(1, 'Ari Setia Firmasnyah', 'Laki-laki', '2006-01-13', '085640729174', 2121212121, 2, '2023-11-05 01:17:08'),
(3, 'Abi Anugrah', 'Laki-laki', '2023-10-30', '08937373', 311221, 5, '2023-11-26 00:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `level` varchar(222) NOT NULL,
  `foto` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `foto`, `created_at`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '1', 'img.JPG', '2023-11-05 06:50:52'),
(2, 'Ari', '827ccb0eea8a706c4c34a16891f84e7b', '2', 'riri.jpg', '2023-11-05 01:17:08'),
(4, 'Super Admin', '827ccb0eea8a706c4c34a16891f84e7b', '3', 'o.JPG', '2023-11-21 15:42:44'),
(5, 'Abi', '827ccb0eea8a706c4c34a16891f84e7b', '2', 'Ari2.jpg', '2023-11-26 00:50:59'),
(6, 'karyawan', '827ccb0eea8a706c4c34a16891f84e7b', '2', NULL, '0000-00-00 00:00:00'),
(7, 'Abi', '827ccb0eea8a706c4c34a16891f84e7b', '4', NULL, '0000-00-00 00:00:00'),
(8, 'sasa', '827ccb0eea8a706c4c34a16891f84e7b', '4', NULL, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
  ADD PRIMARY KEY (`id_brg_keluar`);

--
-- Indexes for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
  ADD PRIMARY KEY (`id_brg_masuk`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `penguna`
--
ALTER TABLE `penguna`
  ADD PRIMARY KEY (`id_penguna`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
  MODIFY `id_brg_keluar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
  MODIFY `id_brg_masuk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penguna`
--
ALTER TABLE `penguna`
  MODIFY `id_penguna` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
