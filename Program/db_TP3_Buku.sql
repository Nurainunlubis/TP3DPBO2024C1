-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 01:59 PM
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
-- Database: `db_tp3_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tahun_terbit` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `tahun_terbit`, `gambar`, `id_penulis`, `id_kategori`) VALUES
(12, 'The Hurried Frog', '5 Mar 2024', 'anak1.png', 35163, 4),
(37, 'Soedradjad Djiwandono My Story as a Teacher and Educator', '18 Des 2023', 'biografi.png', 82191, 3),
(42, 'Expect the Unexpected', '22 Apr 2024', 'sastra.png', 2136, 8),
(62, 'Struktur Data', '5 jan 2018', 'strukdat.png', 10293, 2),
(93, 'Geez & Ann #1', '16 Nov 2020', 'geez&ann1.png', 90182, 9),
(124, 'Penidikan Agama Islam dan Budi Pekerti', '12 Feb 2023', 'agama.png', 11021, 1),
(203, 'Geez & Ann2 #2', '16 Nov 2020', 'geez&ann2.png', 90182, 9),
(204, 'MahaData', '15 Jun 2021', '1000-sains.jpg', 90183, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `book1` (`id_penulis`),
  ADD KEY `book2` (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `book1` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`) ON UPDATE CASCADE,
  ADD CONSTRAINT `book2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
