-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 09:43 PM
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
-- Database: `csc257`
--

-- --------------------------------------------------------

--
-- Table structure for table `fxrates`
--

CREATE TABLE `fxrates` (
  `srcCucy` char(3) NOT NULL,
  `dstCucy` char(3) NOT NULL,
  `fxRate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fxrates`
--

INSERT INTO `fxrates` (`srcCucy`, `dstCucy`, `fxRate`) VALUES
('CAD', 'CAD', 1),
('CAD', 'EUR', 0.624514066),
('CAD', 'GBP', 0.588714763),
('CAD', 'USD', 0.810307),
('EUR', 'CAD', 1.601244959),
('EUR', 'EUR', 1),
('EUR', 'GBP', 0.942676548),
('EUR', 'USD', 1.2975),
('GBP', 'CAD', 1.698615463),
('GBP', 'EUR', 1.060809248),
('GBP', 'GBP', 1),
('GBP', 'USD', 1.3764),
('USD', 'CAD', 1.234100162),
('USD', 'EUR', 0.772200772),
('USD', 'GBP', 0.726532984),
('USD', 'USD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('santiago', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fxrates`
--
ALTER TABLE `fxrates`
  ADD PRIMARY KEY (`srcCucy`,`dstCucy`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
