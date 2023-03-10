-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2022 at 01:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_identitas`
--

CREATE TABLE `tbl_identitas` (
  `id_identitas` int(5) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `media_sosial` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `no_fax` varchar(255) DEFAULT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `maps` text NOT NULL,
  `createdon` datetime DEFAULT NULL,
  `createdby` varchar(255) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `updatedby` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_identitas`
--

INSERT INTO `tbl_identitas` (`id_identitas`, `nama_website`, `email`, `url`, `media_sosial`, `alamat`, `no_telp`, `no_fax`, `meta_deskripsi`, `meta_keyword`, `favicon`, `logo`, `maps`, `createdon`, `createdby`, `updatedon`, `updatedby`) VALUES
(1, 'Sistem Pencatatan Keuangan Kas', 'admin@lawumedia.co.id', 'https://www.lawumedia.com', 'https://www.facebook.com/', 'Jl. Medan Perang, Indonesia Merdeka', '081234567890', '0987654321', 'News Tekno Menyajikan seputar informasi teknologi, gadget, komputer, games, tips dan trik, news', 'teknologi, games, komputer, tips dan trik, news, aplikasi', 'favicon.png', 'keuangan.png', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3989.3358607198243!2d100.35483479999999!3d-0.8910373999999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8aa1a4e0441%3A0x3f81ebb48d31a38b!2sTunggul+Hitam%2C+Padang+Utara%2C+Kota+Padang%2C+Sumatera+Barat+25173!5e0!3m2!1sid!2sid!4v1408275531365', NULL, NULL, '2022-10-18 18:01:01', 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keuangan`
--

CREATE TABLE `tbl_keuangan` (
  `id_keuangan` int(11) NOT NULL,
  `jenis` enum('masuk','keluar') NOT NULL,
  `tgl` date NOT NULL,
  `tujuan` text NOT NULL,
  `jumlah` text NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `createdby` varchar(255) NOT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedby` varchar(255) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_keuangan`
--

INSERT INTO `tbl_keuangan` (`id_keuangan`, `jenis`, `tgl`, `tujuan`, `jumlah`, `status`, `createdby`, `createdon`, `updatedby`, `updatedon`) VALUES
(1, 'masuk', '2018-05-08', 'aaaaa', '100000', 'Aktif', 'admin', NULL, 'ahmadadzan', '2022-07-24 21:15:53'),
(3, 'masuk', '2018-05-08', 'anu ku', '200000', 'Aktif', 'admin', NULL, 'ahmadadzan', '2022-07-24 21:14:12'),
(4, 'masuk', '2018-05-09', 'Aku', '2000000', 'Aktif', 'admin', NULL, 'ahmadadzan', '2022-07-24 21:24:40'),
(6, 'keluar', '2018-05-24', 'Beli Cat', '56000', 'Deleted', 'admin', NULL, 'demo', '2022-10-18 17:54:15'),
(7, 'masuk', '2022-07-13', 'Coba Test', '20000', 'Deleted', 'official.adzan@gmail.com', '2022-07-24 19:42:14', 'ahmadadzan', '2022-07-24 21:24:32'),
(8, 'masuk', '2022-10-18', 'Hamba Allah', '2000000', 'Aktif', 'demo@lawumedia.com', '2022-10-18 17:45:36', 'demo', '2022-10-18 17:46:08'),
(9, 'keluar', '2022-10-18', 'Beli Karpet', '200000', 'Deleted', 'demo@lawumedia.com', '2022-10-18 17:46:34', 'demo', '2022-10-18 17:46:52'),
(10, 'keluar', '2022-10-18', 'Beli Karpet', '1000000', 'Aktif', 'demo@lawumedia.com', '2022-10-18 17:49:18', NULL, NULL),
(11, 'masuk', '2022-10-18', 'Dari Pak Haji', '5000000', 'Aktif', 'demo@lawumedia.com', '2022-10-18 17:52:37', 'demo', '2022-10-18 17:53:03'),
(12, 'keluar', '2022-10-18', 'Beli Mainan Sepeda Motor Mio', '1200000', 'Aktif', 'demo@lawumedia.com', '2022-10-18 17:53:36', 'demo', '2022-10-18 17:54:08'),
(13, 'masuk', '2022-10-18', 'Coba 2', '340000', 'Aktif', 'demo@lawumedia.com', '2022-10-18 17:58:43', 'demo', '2022-10-18 17:58:58'),
(14, 'keluar', '2022-10-18', 'Beli Air Mineral 10', '20000', 'Deleted', 'demo@lawumedia.com', '2022-10-18 17:59:22', 'demo', '2022-10-18 17:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `users_id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `role` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `createdon` datetime DEFAULT NULL,
  `createdby` varchar(255) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `updatedby` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`users_id`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `foto`, `role`, `status`, `createdon`, `createdby`, `updatedon`, `updatedby`) VALUES
(4, 'demo', '13f330c1113c500570355d7f921a902cfb765249', 'Demo', 'demo@lawumedia.com', '1234567890', '', 'admin', 'Aktif', '2022-07-24 21:43:58', 'official.adzan@gmail.com', '2022-07-24 21:44:21', 'ahmadadzan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_identitas`
--
ALTER TABLE `tbl_identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `tbl_keuangan`
--
ALTER TABLE `tbl_keuangan`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`users_id`,`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_identitas`
--
ALTER TABLE `tbl_identitas`
  MODIFY `id_identitas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_keuangan`
--
ALTER TABLE `tbl_keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
