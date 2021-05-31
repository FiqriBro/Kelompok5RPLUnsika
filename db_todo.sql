-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 05:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_activity`
--

CREATE TABLE `tb_activity` (
  `col_id_activity` int(11) NOT NULL,
  `col_name_activity` varchar(60) NOT NULL,
  `col_description_activity` text DEFAULT NULL,
  `col_username_user` varchar(25) NOT NULL,
  `col_date_activity` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `col_username_user` varchar(25) NOT NULL,
  `col_password_user` varchar(255) NOT NULL,
  `col_firstname_user` varchar(100) NOT NULL,
  `col_lastname_user` varchar(100) NOT NULL,
  `col_motto_user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`col_username_user`, `col_password_user`, `col_firstname_user`, `col_lastname_user`, `col_motto_user`) VALUES
('akujelek', '$2y$10$Jh4gYdpp0spflQJLCKanlutpGyAo/6QqVat9LCLgbwVpHTMg8/2Bi', 'Aku', 'Ganteng', ''),
('aysiaftmi', '$2y$10$GGAmlooDWJC.ui6jJFoUBuDLWmf5/MXTJxiKXvpyc.ct0Sp5pScjK', 'Aysia ', 'Fatmi yasmin', ''),
('fiqry', '$2y$10$Dpz7a7AOITaqL75wBvgFtenpZzoTguxb4UcRTITpD0tk9FGwCiK3O', 'Fiqri', 'Widyantoro', ''),
('kevin_zamzami', '$2y$10$L6PSPgVonNNyaiTV/53QwOGh/DnPN3YjP9VT/KdG3yp4F.62/oina', 'Kevin', 'Zamzami', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_activity`
--
ALTER TABLE `tb_activity`
  ADD PRIMARY KEY (`col_id_activity`),
  ADD KEY `col_username_user` (`col_username_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`col_username_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_activity`
--
ALTER TABLE `tb_activity`
  MODIFY `col_id_activity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_activity`
--
ALTER TABLE `tb_activity`
  ADD CONSTRAINT `tb_activity_ibfk_1` FOREIGN KEY (`col_username_user`) REFERENCES `tb_user` (`col_username_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
