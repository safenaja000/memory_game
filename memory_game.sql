-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 24, 2020 at 10:32 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_training`
--

-- --------------------------------------------------------

--
-- Table structure for table `memory_game`
--

CREATE TABLE `memory_game` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `point` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memory_game`
--

INSERT INTO `memory_game` (`id`, `name`, `point`) VALUES
(1, 'safe', 3),
(15, 'gg', 1),
(16, 'Mam', 2),
(17, 'ss', 6),
(18, 'Anonymous', 1),
(19, 'www', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `memory_game`
--
ALTER TABLE `memory_game`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memory_game`
--
ALTER TABLE `memory_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
