-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2019 at 08:13 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loaning`
--

-- --------------------------------------------------------

--
-- Table structure for table `loan_data`
--

CREATE TABLE `loan_data` (
  `id` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_data`
--

INSERT INTO `loan_data` (`id`, `owner`, `target`, `amount`) VALUES
(5, 1, 3, 370),
(6, 5, 3, 10),
(7, 5, 7, 20),
(8, 5, 1, 10),
(9, 7, 3, 40),
(10, 7, 4, 10),
(11, 7, 1, 10),
(12, 4, 3, 10),
(13, 4, 1, 20),
(14, 4, 5, 10),
(15, 8, 4, 20),
(16, 8, 3, 10),
(17, 8, 1, 10),
(18, 8, 7, 50),
(19, 8, 5, 10),
(20, 9, 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `username`, `password`, `balance`) VALUES
(1, 'JohnDoe', 'password', 130),
(3, 'Varis', 'password', 540),
(4, 'Adam', 'password', 90),
(5, 'Jack', 'password', 80),
(6, 'Tommy', 'password', 100),
(7, 'Dave', 'password', 110),
(8, 'Daisy', 'password', 0),
(9, 'Trevor', 'password', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loan_data`
--
ALTER TABLE `loan_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loan_data`
--
ALTER TABLE `loan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
