-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 05:13 AM
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
-- Database: `ena_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_name`, `email`, `password`) VALUES
(1, 'Admin', 'Admin_2024@ena.uae', 'en2024@auae');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `event_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_event` date NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `url_location` varchar(255) DEFAULT NULL,
  `created_by` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `created_at`, `end_event`, `image_url`, `location`, `url_location`, `created_by`) VALUES
(4, 'start work', 'every day ', '2024-12-24', '2024-12-22 04:45:34', '2024-12-30', './site/uploads/event_6767996ec708b1.58990197.png', '', '', 'fade');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `uploadedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `uaeNational` tinyint(1) NOT NULL,
  `membershipType` enum('active','inactive') NOT NULL,
  `title` enum('Dr.','Prof.','Mr.','Mrs.','Ms.') NOT NULL,
  `type` enum('student','technician','worker','employee') NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `emirate` enum('Abu Dhabi','Dubai','Sharjah','Ajman','Fujairah','Ras Al Khaimah','Umm Al Quwain') NOT NULL,
  `po_box` varchar(50) NOT NULL,
  `requested_society` varchar(255) NOT NULL,
  `professional_title` varchar(255) NOT NULL,
  `level_of_education` enum('high_school','bachelor','master','phd') NOT NULL,
  `license_name` varchar(255) NOT NULL,
  `work_type` enum('worker','employee') NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `emirates_id_number` varchar(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `passportCopy` varchar(255) NOT NULL,
  `uaeId` varchar(255) NOT NULL,
  `medicalLicense` varchar(255) DEFAULT NULL,
  `resume` varchar(255) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fullName`, `email`, `password`, `uaeNational`, `membershipType`, `title`, `type`, `gender`, `emirate`, `po_box`, `requested_society`, `professional_title`, `level_of_education`, `license_name`, `work_type`, `nationality`, `emirates_id_number`, `phone_number`, `photo`, `passportCopy`, `uaeId`, `medicalLicense`, `resume`, `qualifications`, `registration_date`) VALUES
(1, 'fadi', '0937fade@gmail.com', '$2y$10$NXDXrHGIcjljngTHiVZsneIpN9MzfCk3Z/dLOvF8bSOneoEb/QQha', 1, 'active', 'Dr.', 'student', 'male', 'Dubai', '00000', '', '', '', '', '', '', '', '', 'ena_db_1726562109.sql', 'way-in-4-2-2_1726562109.apk', 'way-in-4-2-2_1726562109.apk', NULL, 'way-in-4-2-2_1726562109.apk', 'ena_db_1726562109.sql', '2024-09-17 08:35:09'),
(4, 'danny', 'danny@hotmail.com', '$2y$10$kNuFxGkMyxCSLhkJsmjZduz0edH0SAVTn7Q08otlpAnE5GgQaE7sq', 1, 'active', 'Dr.', 'student', 'male', 'Abu Dhabi', '0000', 'ghfhvfh', 'hgfhgfjhh', 'high_school', 'jlhgj', 'worker', 'Angola', '51698452244', '54537502', 'WhatsApp Image 2024-11-17 at 10.18.41 PM_1734847268.jpeg', 'NOC-Format-for-Employee_1734847268.pdf', 'ea553a9e7f00f42a557ad8a9cf9db9f1282741df_1734847268.jpg', '../uploads/Teilnahmebest__tigung_-_digital__2_.pdf', 'Teilnahmebestätigung - digital (4)_1734847268.pdf', 'Teilnahmebestätigung - digital (2)_1734847268.pdf', '2024-12-22 06:01:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
