-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2021 at 02:05 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(255) NOT NULL,
  `regno` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `cert_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `register_start` datetime NOT NULL,
  `register_end` datetime NOT NULL,
  `max_participant` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `start_time`, `end_time`, `register_start`, `register_end`, `max_participant`, `user_id`) VALUES
(5, 'Event Kegiatan 1', '&#60;p&#62;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&#60;/p&#62;&#13;&#10;', '2021-04-10 07:00:00', '2021-04-11 12:00:00', '2021-03-23 00:00:00', '2021-04-09 23:59:00', 10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id_event` int(255) NOT NULL,
  `id_pendaftar` int(11) NOT NULL,
  `regno` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id_event`, `id_pendaftar`, `regno`) VALUES
(5, 9, '9202103235');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL COMMENT 'Hash of the Password',
  `password_hash` varchar(255) NOT NULL COMMENT 'Hash of the Password',
  `email` varchar(255) NOT NULL,
  `fullname` varchar(80) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL COMMENT 'Address',
  `phone` varchar(40) DEFAULT NULL COMMENT 'phone Number of User',
  `signature` varchar(255) DEFAULT NULL COMMENT 'Email Signature',
  `imgsrc` varchar(255) DEFAULT '../image2.png' COMMENT 'Profile Image URL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password_hash`, `email`, `fullname`, `address`, `phone`, `signature`, `imgsrc`) VALUES
(3, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'test@test.com', 'Mantap Admin', 'asdasdasd', NULL, NULL, '../image2.png'),
(7, 'user1', '36988d81163cc909325869489569d2cca5677d7a', 'wisselrecht@waroengdo.store', 'User 1', NULL, NULL, NULL, '../image2.png'),
(9, 'user2', '36988d81163cc909325869489569d2cca5677d7a', '221810354@stis.ac.id', 'User 2', NULL, NULL, NULL, '../image2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regno_fk` (`regno`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`regno`),
  ADD KEY `id_event_fk` (`id_event`),
  ADD KEY `id_pendaftar_fk` (`id_pendaftar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `LoginName` (`username`),
  ADD UNIQUE KEY `Email` (`email`),
  ADD UNIQUE KEY `FullName` (`fullname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `regno_fk` FOREIGN KEY (`regno`) REFERENCES `form` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `id_event_fk` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pendaftar_fk` FOREIGN KEY (`id_pendaftar`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
