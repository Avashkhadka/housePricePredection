-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2026 at 06:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `housepred`
--

-- --------------------------------------------------------

--
-- Table structure for table `predictionhistory`
--

CREATE TABLE `predictionhistory` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `totalSquareft` int(11) NOT NULL,
  `bedroom` int(11) NOT NULL,
  `balconi` int(11) NOT NULL,
  `bathroom` int(11) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `predictionhistory`
--

INSERT INTO `predictionhistory` (`id`, `location`, `totalSquareft`, `bedroom`, `balconi`, `bathroom`, `price`) VALUES
(3, 'Electronic City Phase II', 2000, 3, 3, 3, 13100000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `predictionhistory`
--
ALTER TABLE `predictionhistory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `predictionhistory`
--
ALTER TABLE `predictionhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
