-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2024 at 02:35 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flexiheng`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

DROP TABLE IF EXISTS `apply`;
CREATE TABLE IF NOT EXISTS `apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_username` varchar(200) NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `bid` int(11) NOT NULL,
  `cover_letter` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `f_username` (`f_username`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

DROP TABLE IF EXISTS `employer`;
CREATE TABLE IF NOT EXISTS `employer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `company` varchar(200) DEFAULT NULL,
  `profile_sum` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `freelancer`
--

DROP TABLE IF EXISTS `freelancer`;
CREATE TABLE IF NOT EXISTS `freelancer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `prof_title` varchar(200) DEFAULT NULL,
  `profile_sum` varchar(1000) DEFAULT NULL,
  `education` varchar(200) DEFAULT NULL,
  `experience` varchar(200) DEFAULT NULL,
  `skills` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `job_offer`
--

DROP TABLE IF EXISTS `job_offer`;
CREATE TABLE IF NOT EXISTS `job_offer` (
  `job_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `budget` int(11) NOT NULL,
  `skills` varchar(200) NOT NULL,
  `special_skill` varchar(200) DEFAULT NULL,
  `e_username` varchar(200) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(200) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender` (`sender`),
  KEY `receiver` (`receiver`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `selected`
--

DROP TABLE IF EXISTS `selected`;
CREATE TABLE IF NOT EXISTS `selected` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_username` varchar(200) NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `e_username` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `f_username` (`f_username`),
  KEY `job_id` (`job_id`),
  KEY `e_username` (`e_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_ibfk_1` FOREIGN KEY (`f_username`) REFERENCES `freelancer` (`username`),
  ADD CONSTRAINT `apply_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_offer` (`job_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `freelancer` (`username`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `employer` (`username`);

--
-- Constraints for table `selected`
--
ALTER TABLE `selected`
  ADD CONSTRAINT `selected_ibfk_1` FOREIGN KEY (`f_username`) REFERENCES `freelancer` (`username`),
  ADD CONSTRAINT `selected_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_offer` (`job_id`),
  ADD CONSTRAINT `selected_ibfk_3` FOREIGN KEY (`e_username`) REFERENCES `employer` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
