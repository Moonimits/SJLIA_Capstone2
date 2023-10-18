-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 02:11 PM
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
  `plukpass` varchar(255) NOT NULL,
  `recruiter_name` varchar(255) NOT NULL,
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
  `on_off` text NOT NULL,
  `date_exam` date NOT NULL,
  `exam_result` text NOT NULL,
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

--
-- Dumping data for table `applicantdb`
--

INSERT INTO `applicantdb` (`Timestamp`, `Email`, `Lastname`, `Firstname`, `Middlename`, `birthdate`, `birthplace`, `gender`, `civil_status`, `contact_number`, `streetname`, `barangay`, `city`, `province`, `zip`, `sss`, `tin`, `pluk`, `plukpass`, `recruiter_name`, `e_last`, `e_first`, `e_middle`, `applicant_rel`, `agent_contact`, `agent_address`, `company_name`, `position`, `start_date`, `end_date`, `if_maiden`, `gov_employ`, `if_spouse`, `status`, `unit_team`, `application_id`, `official_reciept`, `date_payment`, `type_exam`, `on_off`, `date_exam`, `exam_result`, `byb`, `join_pru`, `pruexpert`, `rop_training`, `documents`, `e_licensing`, `date_submitted`, `password`, `profile_pic`, `has_pruaccount`, `applicant_status`, `confirmed_rop`, `confirmed_documents`, `confirmed_elicense`, `is_completed`) VALUES
('2023-10-08', 'allysajanecatibog@gmail.com', 'Catibog', 'Allysa Jane', 'Blanza', '2002-03-09', 'Batangas Hospital', 'female', 'single', '09561637899', 'Purok 3', 'Sinisian East', 'Lemery', 'Batangas', 4210, 7985, 46321, 'plukally@gmail.com', 'marcoluis', 'Alexxxies Gail', 'Catibog', 'Gemmalyn', 'Blanza ', 'Mother', '09519295689', 'Sinisian East, Lemery Batangas', '', '', '0000-00-00', '0000-00-00', '', 'no', '', '', '', 3, '', '0000-00-00', '', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 'Password12345', '65229cb398254.jpg', 1, 'Licensed Agent', 1, 1, 1, 1),
('2023-10-12', 'deslienicole@gmail.com\r\n', 'Badillo', 'Deslie', 'Castillo', '2002-12-01', 'Batangas Medical Hospital', 'female', 'single', '09865236445', 'Silangan', 'Luya', 'San Luis', 'Batangas', 4210, 4256, 12, '', '', 'Alexxiees', 'Badillo', 'Edilyn', 'Castillo', 'Mother', '09562345887', 'Luya, Sanluis, Batangas', 'N/A', 'N/A', '0000-00-00', '0000-00-00', 'N/A', '', 'N/A', '', '', 4, '', '0000-00-00', '', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 'password', '6527b19ddcbbb.png', 0, 'Licensed Agent', 1, 1, 1, 1),
('2023-09-25', 'moonimits@gmail.com', 'Hernandez', 'Luis', 'Salazar', '2001-11-05', 'SA TUBUHAN', 'male', ' single', '29832792', 'Purok 3', 'Aniban II', 'Bacoor City', 'Batangas', 9273, 2837827, 2147483647, 'plukmarco@gmail.com', 'allysajanemahalkoyiiee', 'Alexxxies Gail', 'Hernandez', 'Sunday', 'Salazar', 'Mother', '2147483647', 'Luya', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 1, '', '0000-00-00', '', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 'MarcoLuis52001', '652d59a96fdb3.jpg', 1, 'Licensed Agent', 1, 1, 1, 1),
('2023-09-26', 'moonimitseclipse@gmail.com', 'Hernandez', 'Marco Luis', 'Salazar', '2001-11-05', 'SA TUBUHAN', 'male', 'married', '29832792', 'Purok 3', 'Balagtas', 'Batangas City (Capital)', 'Batangas', 9273, 283, 26283, 'plukallysajane@gmail.com', 'password123', 'Alexxxies Gail', 'Hernandez', 'Sunday', 'Salazar', 'Mother', '2147483647', 'Luya', 'kaloka', 'ewan', '0000-00-00', '0000-00-00', '', 'yes', '', '', '', 2, '', '0000-00-00', '', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 'Passwordasoaso', '6522244617bae.jpg', 1, 'Licensed Agent', 1, 1, 1, 1);

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
(2, 'Marco Luis Hernandez', 'marcoluis@gmail.com', 1),
(3, 'Allysa Jane Catibog', 'allysajane@gmail.com', 1),
(4, 'philip', 'philipmagsino@gmail.com', 9);

-- --------------------------------------------------------

--
-- Table structure for table `bybevents`
--

CREATE TABLE `bybevents` (
  `byb_id` int(11) NOT NULL,
  `byb_title` varchar(255) NOT NULL,
  `byb_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bybevents`
--

INSERT INTO `bybevents` (`byb_id`, `byb_title`, `byb_date`) VALUES
(1, 'BYB1: How to be Successful', '2023-10-04'),
(9, 'BYB2: Sample Title', '2023-10-06'),
(10, 'BYB3: Title Sample 3', '2023-10-19'),
(11, 'BYB4: Titlee', '2023-10-06'),
(12, 'BYB5: The importance of you', '2023-09-23'),
(13, 'BYB6: The importance of you', '2023-10-04'),
(14, 'BYB7: The importance of you', '2023-10-12');

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

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `application_id`, `fullname`, `email`, `contact_no`) VALUES
(1, 1, 'Marco Luis Hernandez', 'marcoluishernandez@gmail.com', '09283862691'),
(2, 1, 'Allysa Jane Catibog', 'allysajane@gmail.com', '09563549987');

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
  `confirm_sss` int(11) NOT NULL,
  `confirm_tin` int(11) NOT NULL,
  `confirm_gov` int(11) NOT NULL,
  `confirm_1x1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`application_id`, `sss`, `tin`, `gov_id`, `1x1`, `confirm_sss`, `confirm_tin`, `confirm_gov`, `confirm_1x1`) VALUES
(1, '652bb98817e72.jpg', '652bb9914f576.jpg', '652bba0c6c3d1.jpg', '652bc051a7ee0.png', 0, 0, 0, 0),
(2, '6527a6562d277.jpg', '6527adcbbeb92.jpg', '6527a99f124e8.png', '6527aa715bac0.jpg', 0, 0, 0, 0),
(3, '6527ae39903dc.jpg', '', '', '', 1, 0, 0, 0),
(4, '6527ea9fda7e7.jpg', '6527eab9f3927.jpg', '6527f10a46a28.png', '6527ef72490da.jpg', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notif_id`, `application_id`, `message`) VALUES
(1, 3, 'Great news! Your uploaded SSS document have been approved successfully. Thank you for your submission!'),
(2, 4, 'Great news! Your uploaded SSS document have been approved successfully. Thank you for your submission!'),
(3, 4, 'Great news! Your uploaded TIN document have been approved successfully. Thank you for your submission!'),
(4, 1, 'Great news! Your uploaded 1x1 Picture have been approved successfully. Thank you for your submission!'),
(5, 1, 'We regret to inform you that the uploaded SSS document did not meet our approval criteria.  \r\n                Kindly resubmit the document for further review. If you have any questions or need assistance, \r\n                please do not hesitate to contact our support team. Thank you for your understanding.');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`attendee_num`);

--
-- Indexes for table `bybevents`
--
ALTER TABLE `bybevents`
  ADD PRIMARY KEY (`byb_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicantdb`
--
ALTER TABLE `applicantdb`
  MODIFY `application_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bybattendees`
--
ALTER TABLE `bybattendees`
  MODIFY `attendee_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bybevents`
--
ALTER TABLE `bybevents`
  MODIFY `byb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
