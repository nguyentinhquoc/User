-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 04:20 AM
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
-- Database: `du_an_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `phanloaidh`
--

CREATE TABLE `phanloaidh` (
  `iduser` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `idtrangthai` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `madh` varchar(225) DEFAULT NULL,
  `bienthe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phanloaidh`
--

INSERT INTO `phanloaidh` (`iduser`, `soluong`, `idtrangthai`, `id`, `madh`, `bienthe`) VALUES
(17, 0, 3, 264, NULL, '11'),
(17, 1, 5, 265, '20231201113609', '24'),
(17, 1, 6, 266, '20231201130708', '14'),
(17, 2, 6, 267, '20231201130708', '25'),
(17, 6, 3, 268, NULL, '24'),
(17, 3, 2, 269, NULL, '16'),
(17, 1, 5, 270, '20231203100646', '18'),
(17, 3, 5, 272, '20231203100646', '7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phanloaidh`
--
ALTER TABLE `phanloaidh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idtrangthai` (`idtrangthai`),
  ADD KEY `madh` (`madh`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phanloaidh`
--
ALTER TABLE `phanloaidh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `phanloaidh`
--
ALTER TABLE `phanloaidh`
  ADD CONSTRAINT `phanloaidh_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `taikhoan` (`id`),
  ADD CONSTRAINT `phanloaidh_ibfk_3` FOREIGN KEY (`idtrangthai`) REFERENCES `trangthai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
