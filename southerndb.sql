-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2023 at 03:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `southerndb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `admin_type`) VALUES
(1, 'Southern Admin', '$2y$10$CNhISFkMS3bFikAiJyGs7uZ.VNZYdfnANAe7ydaWh6IMdYH.3/uI.', 0),
(2, 'Southern Super Admin', '$2y$10$mp6qphgPZsahekZLnYG.3O3RmSyb0PLdvS7/SWfbpul8U19TrZAVm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `applicantdb`
--

CREATE TABLE `applicantdb` (
  `Timestamp` date NOT NULL DEFAULT current_timestamp(),
  `Email` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `streetname` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zip` int(255) NOT NULL,
  `sss` int(255) NOT NULL,
  `tin` int(255) NOT NULL,
  `pluk` varchar(255) NOT NULL,
  `plukapplication_id` int(11) NOT NULL,
  `plukpass` varchar(255) NOT NULL,
  `recruiter_name` varchar(255) NOT NULL,
  `recruiter_code` int(11) NOT NULL,
  `e_last` varchar(255) NOT NULL,
  `e_first` varchar(255) NOT NULL,
  `e_middle` varchar(255) NOT NULL,
  `applicant_rel` varchar(255) NOT NULL,
  `agent_contact` varchar(255) NOT NULL,
  `agent_address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `if_maiden` varchar(255) NOT NULL,
  `gov_employ` varchar(255) NOT NULL,
  `if_spouse` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `unit_team` varchar(255) NOT NULL,
  `application_id` int(255) NOT NULL,
  `official_reciept` varchar(255) NOT NULL,
  `date_payment` date NOT NULL,
  `type_exam` varchar(255) NOT NULL,
  `on_off1` int(11) NOT NULL,
  `on_off2` int(11) NOT NULL,
  `date_exam1` date NOT NULL,
  `date_exam2` date NOT NULL,
  `exam_result1` text NOT NULL,
  `exam_result2` varchar(255) NOT NULL,
  `byb` text NOT NULL,
  `join_pru` varchar(255) NOT NULL,
  `pruexpert` text NOT NULL,
  `rop_training` text NOT NULL,
  `documents` text NOT NULL,
  `e_licensing` text NOT NULL,
  `date_submitted` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `has_pruaccount` int(11) NOT NULL,
  `applicant_status` varchar(255) NOT NULL,
  `confirmed_rop` int(11) NOT NULL,
  `confirmed_documents` int(11) NOT NULL,
  `confirmed_elicense` int(11) NOT NULL,
  `is_completed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bybattendees`
--

CREATE TABLE `bybattendees` (
  `attendee_num` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `byb_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bybattendees`
--

INSERT INTO `bybattendees` (`attendee_num`, `fullname`, `email`, `byb_id`) VALUES
(1, 'philip magsino', 'philipmagsino@gmail.com', 1),
(2, 'Marco Luis Hernandez', 'marcoluis.hernandez@gmail.com', 1),
(3, 'Allysa Jane Catibog', 'allysajanecatibog@gmail.com', 1),
(4, 'philip', 'philipmagsino@gmail.com', 9);

-- --------------------------------------------------------

--
-- Table structure for table `bybevents`
--

CREATE TABLE `bybevents` (
  `byb_id` int(11) NOT NULL,
  `byb_title` varchar(255) NOT NULL,
  `byb_date` date NOT NULL,
  `emailed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bybevents`
--

INSERT INTO `bybevents` (`byb_id`, `byb_title`, `byb_date`, `emailed`) VALUES
(1, 'BYB1: How to be Successful', '2023-10-04', 1),
(9, 'BYB2: Sample Title', '2023-10-06', 0),
(10, 'BYB3: Title Sample 3', '2023-10-19', 0),
(11, 'BYB4: Titlee', '2023-10-06', 0),
(12, 'BYB5: The importance of you', '2023-09-23', 0),
(13, 'BYB6: The importance of you', '2023-10-04', 0),
(14, 'BYB7: The importance of you', '2023-10-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bybpreregistration`
--

CREATE TABLE `bybpreregistration` (
  `register_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `recruited_by` varchar(255) NOT NULL,
  `byb_date` date NOT NULL,
  `preregister_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bybpreregistration`
--

INSERT INTO `bybpreregistration` (`register_id`, `fullname`, `email`, `contact`, `recruited_by`, `byb_date`, `preregister_date`) VALUES
(1, 'Marco Luis Hernandez', 'marcoluis.hernandez@gmail.com', '09865236445', 'Alexxiess ', '2023-11-10', '2023-11-03 09:30:00'),
(2, 'Allysa Jane Catibog', 'allysajanecatibog@gmail.com', '09865236445', 'Alexxiess ', '2023-11-18', '2023-11-03 16:15:40'),
(3, 'Deslie Nicole Badillo', 'deslienicole@gmail.com', '09865236445', 'Alexxiess ', '2023-11-10', '2023-11-03 20:45:59'),
(4, 'Allysa Jane Catibog', 'allysajanecatibog@gmail.com', '09519295689', 'Alexxiess ', '2023-11-24', '2023-11-03 20:57:52'),
(5, 'Allysa Jane Catibog', 'allysajanecatibog@gmail.com', '09865236445', 'Alexxiess ', '2023-12-25', '2023-11-06 00:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `application_id` int(11) NOT NULL,
  `sss` varchar(255) NOT NULL,
  `tin` varchar(255) NOT NULL,
  `gov_id` varchar(255) NOT NULL,
  `1x1` varchar(255) NOT NULL,
  `rop_cert` varchar(255) NOT NULL,
  `confirm_sss` int(11) NOT NULL,
  `confirm_tin` int(11) NOT NULL,
  `confirm_gov` int(11) NOT NULL,
  `confirm_1x1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `is_read` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_team`
--

CREATE TABLE `unit_team` (
  `team_id` int(11) NOT NULL,
  `uniteam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_team`
--

INSERT INTO `unit_team` (`team_id`, `uniteam`) VALUES
(2, 'Ubuntu Jade'),
(3, 'Harmon Jade'),
(4, 'Sentry Jade'),
(5, 'Chacha Team'),
(7, 'haha team');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `applicantdb`
--
ALTER TABLE `applicantdb`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `sss` (`sss`),
  ADD UNIQUE KEY `application_id` (`application_id`);

--
-- Indexes for table `bybattendees`
--
ALTER TABLE `bybattendees`
  ADD PRIMARY KEY (`attendee_num`),
  ADD KEY `byb_id` (`byb_id`);

--
-- Indexes for table `bybevents`
--
ALTER TABLE `bybevents`
  ADD PRIMARY KEY (`byb_id`);

--
-- Indexes for table `bybpreregistration`
--
ALTER TABLE `bybpreregistration`
  ADD PRIMARY KEY (`register_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `unit_team`
--
ALTER TABLE `unit_team`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `applicantdb`
--
ALTER TABLE `applicantdb`
  MODIFY `application_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bybattendees`
--
ALTER TABLE `bybattendees`
  MODIFY `attendee_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bybevents`
--
ALTER TABLE `bybevents`
  MODIFY `byb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bybpreregistration`
--
ALTER TABLE `bybpreregistration`
  MODIFY `register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_team`
--
ALTER TABLE `unit_team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
