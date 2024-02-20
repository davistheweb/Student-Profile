-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 09:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_student`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `math` varchar(255) NOT NULL,
  `fal` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `stu_img` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(70) DEFAULT NULL,
  `expire_reset_token` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `email`, `field`, `math`, `fal`, `dept`, `stu_img`, `password`, `reset_token`, `expire_reset_token`) VALUES
(38, 'Josiah Davis', 'hey@mail.com', 'jkds', 'scdds', 'vfd', 'f', 'Josiah Davis65d45d32388c18.66670380.png', '$2y$10$9azHJZ3NbvHzLjTBuqvMBufaHlNuynIPO8066ErO9FtQur9RuzDk.', NULL, NULL),
(39, 'Josiah Davis', 'hey@mail.com', 'jkds', 'scdds', 'vfd', 'f', 'Josiah Davis65d45d7f204794.66356297.png', '$2y$10$dBUnS6Mb/.UsCcHGwp6hgeDACAi69b3T8Xv67FyDl6plOwq/yRXRm', NULL, NULL),
(40, 'Josiah Davis', 'meme@mail.com', 'ehas', 'd', 'dsv', 'dsv', 'Josiah Davis65d45d9f925051.14484957.jpg', '$2y$10$UrA/bkM4JC8fxpXl7ujm1OwmR660cac8elsbRFj.JlYDVDk56Kpvm', NULL, NULL),
(41, 'Josiah Davis', 'meme@mail.com', 'ehas', 'd', 'dsv', 'dsv', 'Josiah Davis65d45e263b24f9.26045027.jpg', '$2y$10$daAdNdbsxeUtEY9bOG8O/OEKaB3kDnHGdP3DC12B7/hNwJDNXPN9C', NULL, NULL),
(42, 'Josiah Davis', 'hellome@mail.com', 'frcsdc', 'ssfdczxvdv', 'ssdv zxc', 'fcszxcsdbfx', 'Josiah Davis65d45e5623b2e2.56343741.jpg', '$2y$10$2a4hBfoVUH5lz8U19JuA8OdVE6Sr21rWdI1GISDUksH9RRNpP01oi', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token` (`reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
