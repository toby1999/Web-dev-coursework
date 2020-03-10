-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 10, 2018 at 09:44 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_database`
--
CREATE DATABASE IF NOT EXISTS `game_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `game_database`;

-- --------------------------------------------------------

--
-- Table structure for table `Games`
--

CREATE TABLE `Games` (
  `ID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Publisher` varchar(255) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Games`
--

INSERT INTO `Games` (`ID`, `Title`, `Publisher`, `Stock`, `Price`) VALUES
(1, 'Grand Theft Auto V', 'Rockstar Games', 25, '29.99'),
(2, 'Call of Duty', 'Activision', 32, '39.99'),
(3, 'Battlefield 4', 'DICE Games', 30, '22.50'),
(4, 'Gran Turismo Sport', 'Polyphony Digital', 23, '24.99'),
(5, 'Titanfall 2', 'Respawn Entertainment', 46, '18.99'),
(6, 'Fortnite', 'Epic Games', 40, '28.99'),
(7, 'Far Cry 5', 'Ubisoft', 22, '44.99'),
(8, 'Unchartered 4', 'Sony Computer Entertainment', 17, '20.99'),
(9, 'Red Dead Redemption 2', 'Rockstar Games', 32, '42.99'),
(10, 'FIFA 18', 'EA Sports', 16, '28.99');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Username`, `Password`, `Salt`) VALUES
('test@test.com', '$6$sEAPd34hEVtjHNTK$5BtQIWiDvXKnklOyGOKUxcG7TLD.bM0YuzueEWK6h6G1mRhEs.TmgfSgaeCPLZbseTrW0TazF0VgKJj2aeY4K.', 'sEAPd34hEVtjHNTK0DttT6oFqpQT4Z');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Games`
--
ALTER TABLE `Games`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Games`
--
ALTER TABLE `Games`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
