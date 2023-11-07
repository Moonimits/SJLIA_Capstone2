-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 03:37 PM
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

--
-- Dumping data for table `applicantdb`
--

INSERT INTO `applicantdb` (`Timestamp`, `Email`, `Lastname`, `Firstname`, `Middlename`, `birthdate`, `birthplace`, `gender`, `civil_status`, `contact_number`, `streetname`, `barangay`, `city`, `province`, `zip`, `sss`, `tin`, `pluk`, `plukapplication_id`, `plukpass`, `recruiter_name`, `recruiter_code`, `e_last`, `e_first`, `e_middle`, `applicant_rel`, `agent_contact`, `agent_address`, `company_name`, `position`, `start_date`, `end_date`, `if_maiden`, `gov_employ`, `if_spouse`, `status`, `unit_team`, `application_id`, `official_reciept`, `date_payment`, `type_exam`, `on_off1`, `on_off2`, `date_exam1`, `date_exam2`, `exam_result1`, `exam_result2`, `byb`, `join_pru`, `pruexpert`, `rop_training`, `documents`, `e_licensing`, `date_submitted`, `password`, `profile_pic`, `has_pruaccount`, `applicant_status`, `confirmed_rop`, `confirmed_documents`, `confirmed_elicense`, `is_completed`) VALUES
('2023-10-08', 'allysajanecatibog@gmail.com', 'Catibog', 'Allysa Jane', 'Blanza', '2002-03-09', 'Batangas Hospital', 'female', 'single', '09561637899', 'Purok 3', 'Sinisian East', 'Lemery', 'Batangas', 4210, 7985, 46321, 'plukally@gmail.com', 986345, 'marcoluis', 'Alexxxies Gail', 45862, 'Catibog', 'Gemmalyn', 'Blanza ', 'Mother', '09519295689', 'Sinisian East, Lemery Batangas', '', '', '0000-00-00', '0000-00-00', '', 'no', '', '', 'Harmon Jade', 3, 'FF 036528966 ', '2023-10-17', 'Variable &#38; Traditional', 1, 2, '2023-10-11', '2023-11-04', 'FAILED', 'FAILED', '', '', '', '', '', '', '0000-00-00', 'MarcoLuis', '65229cb398254.jpg', 1, 'Temporary Agent', 1, 1, 1, 0),
('2023-10-23', 'deslienicole@gmail.com', 'Badillo', 'Deslie', 'Castillo', '2002-12-01', 'Batangas Medical Hospital', 'female', 'single', '09865236445', 'Silangan', 'Luya', 'San Luis', 'Batangas', 4210, 54462, 2598, '', 0, '', 'Alexxiees', 45862, 'Badillo', 'Edilyn', 'Castillo', 'Mother', '09562345887', 'Luya, Sanluis, Batangas', '', '', '0000-00-00', '0000-00-00', 'N/A', 'no', 'N/A', '', '', 6, '', '0000-00-00', '', 0, 0, '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', 'password', '6535e95616439.png', 0, 'Licensed Agent', 1, 1, 1, 1),
('2023-11-06', 'haha@mail.com', 'Badillo', 'Marco Luis', 'Castillo', '2023-11-01', 'Batangas Medical Hospital', '', 'married', '09865236445', 'Silangan', 'Galawan', 'Lumba-bayabao (Maguing)', 'Lanao Del Sur', 4210, 79865, 2522863, '', 0, '', 'Alexxiees', 45685, 'Boongaling', 'Gloria', 'Castillo', 'Mother', '09562345887', 'Luya, Sanluis, Batangas', '', '', '0000-00-00', '0000-00-00', 'N/A', 'yes', 'N/A', '', '', 17, '', '0000-00-00', '', 0, 0, '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', 'samplepassword', '6548f69a74f45.jpg', 0, 'New Applicant', 0, 0, 0, 0),
('2023-11-06', 'hehe@gmail.com', 'Badillo', 'Marco Luis', 'Castillo', '0000-00-00', 'Batangas Medical Hospital', 'male', 'married', '09865236445', 'Silangan', 'San Antonio', 'Cabiao', 'Nueva Ecija', 4210, 97865, 3366, '', 0, '', 'Alexxiees', 45685, 'Boongaling', 'Gloria', 'Castillo', 'Mother', '09562345887', 'Luya, Sanluis, Batangas', 'IMPA', 'Staff', '0000-00-00', '0000-00-00', 'N/A', 'yes', 'N/A', '', '', 18, '', '0000-00-00', '', 0, 0, '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', 'password', '6548f7355cc62.jpg', 0, 'New Applicant', 0, 0, 0, 0),
('2023-10-23', 'ianbongaling@gmail.com', 'Boongaling', 'Ian', 'Castillo', '2001-10-10', 'Batangas Medical Hospital', 'male', 'single', '09865236445', 'Silangan', 'Luya', 'San Luis', 'Batangas', 4210, 56333, 79879, '', 0, '', 'Alexxiees', 45862, 'Boongaling', 'Gloria', 'Castillo', 'Mother', '09562345887', 'Luya, Sanluis, Batangas', '', '', '0000-00-00', '0000-00-00', 'N/A', 'no', 'N/A', '', '', 5, '', '0000-00-00', '', 0, 0, '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', 'password', '6535e7e281435.jpg', 0, 'Temporary Agent', 1, 1, 0, 0),
('2023-11-06', 'krizia@gmail.com', 'Magsino', 'Krizia May ', 'Solazar', '2023-12-25', 'Batangas Medical Hospital', 'female', 'single', '09865236445', 'Silangan', 'D. L. Maglanoc Pob. (Bgy.III)', 'Carranglan', 'Nueva Ecija', 4210, 562322, 5699, '', 0, '', 'Alexxiees', 45685, 'Badillo', 'Gloria', 'Castillo', 'Mother', '09562345887', 'Luya, Sanluis, Batangas', 'IMPA', 'Staff', '0000-00-00', '0000-00-00', 'N/A', 'yes', 'N/A', '', '', 9, '', '0000-00-00', '', 0, 0, '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '1234', '6547c357d49bd.jpg', 0, 'New Applicant', 0, 0, 0, 0),
('2023-11-06', 'marcoluishernandez@gmail.com', 'Hernandez', 'Marco Luis', 'Solazar', '2023-12-25', 'Batangas Medical Hospital', 'male', 'married', '09865236445', 'Silangan', 'Capagaran (Brigida)', 'Allacapan', 'Cagayan', 4210, 9271, 3211, 'kel@gmail.com', 9732, '1234', 'Alexxiees', 45685, 'Badillo', 'Gloria', 'Castillo', 'Mother', '09562345887', 'Luya, Sanluis, Batangas', 'IMPA', 'Staff', '0000-00-00', '0000-00-00', 'N/A', 'yes', 'N/A', '', '', 8, '', '0000-00-00', '', 0, 0, '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '12345', '6547c219ba43b.jpg', 1, 'Temporary Agent', 1, 0, 0, 0),
('2023-09-25', 'moonimits@gmail.com', 'Hernandez', 'Luis', 'Salazar', '2001-11-05', 'SA TUBUHAN', 'male', ' single', '29832792', 'Purok 3', 'Aniban II', 'Bacoor City', 'Batangas', 9273, 2837827, 2147483647, 'plukmarco@gmail.com', 0, 'allysajanemahalkoyiiee', 'Alexxxies Gail', 45862, 'Hernandez', 'Sunday', 'Salazar', 'Mother', '2147483647', 'Luya', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 1, '', '0000-00-00', '', 0, 0, '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', 'MarcoLuis52001', '652d59a96fdb3.jpg', 1, 'Temporary Agent', 1, 1, 1, 0),
('2023-09-26', 'moonimitseclipse@gmail.com', 'Hernandez', 'Marco Luis', 'Salazar', '2001-11-05', 'SA TUBUHAN', 'male', 'married', '29832792', 'Purok 3', 'Balagtas', 'Batangas City (Capital)', 'Batangas', 9273, 283, 26283, 'plukallysajane@gmail.com', 0, 'password123', 'Alexxxies Gail', 45862, 'Hernandez', 'Sunday', 'Salazar', 'Mother', '2147483647', 'Luya', 'kaloka', 'ewan', '0000-00-00', '0000-00-00', '', 'yes', '', '', '', 2, '', '0000-00-00', '', 0, 0, '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', 'Passwordasoaso', '6522244617bae.jpg', 1, 'New Applicant', 0, 0, 0, 0);

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

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `application_id`, `fullname`, `email`, `contact_no`) VALUES
(1, 1, 'Marco Luis Hernandez', 'marcoluishernandez@gmail.com', '09283862691'),
(2, 1, 'Allysa Jane Catibog', 'allysajane@gmail.com', '09563549987'),
(4, 3, 'Marco Luis Hernandez', 'marcoluishernandez@gmail.com', '0956163789');

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

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`application_id`, `sss`, `tin`, `gov_id`, `1x1`, `rop_cert`, `confirm_sss`, `confirm_tin`, `confirm_gov`, `confirm_1x1`) VALUES
(1, '652bb98817e72.jpg', '652bb9914f576.jpg', '652bba0c6c3d1.jpg', '652bc051a7ee0.png', '6534db56f355a.jpg', 0, 0, 0, 0),
(2, '6527a6562d277.jpg', '6527adcbbeb92.jpg', '6527a99f124e8.png', '6527aa715bac0.jpg', '', 0, 0, 0, 0),
(3, '654663f8c76ce.png', '', '', '', '', 1, 0, 0, 0),
(5, '', '', '', '', '', 0, 0, 0, 0),
(6, '', '', '', '65364528ca465.jpg', '', 0, 0, 0, 0),
(8, '', '', '', '', '', 0, 0, 0, 0),
(9, '', '', '', '', '', 0, 0, 0, 0),
(10, '', '', '', '', '', 0, 0, 0, 0);

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

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notif_id`, `application_id`, `message`, `is_read`) VALUES
(1, 3, 'Great news! Your uploaded SSS document have been approved successfully. Thank you for your submission!', 1),
(4, 1, 'Great news! Your uploaded 1x1 Picture have been approved successfully. Thank you for your submission!', 1),
(5, 1, 'We regret to inform you that the uploaded SSS document did not meet our approval criteria.  \r\n                Kindly resubmit the document for further review. If you have any questions or need assistance, \r\n                please do not hesitate to contact our support team. Thank you for your understanding.', 1),
(6, 1, 'Great news! Your uploaded ROP certificate has been approved successfully. Thank you for your submission!', 1),
(7, 3, 'Congratulations! Are now a Licensed Agent! You are now capable of adding clients on your client menu.', 0),
(8, 8, 'Great news! Your uploaded ROP certificate has been approved. Thank you for your submission! You are now a Temporary (ROP) Agent!', 1),
(9, 3, 'Great news! Your uploaded ROP certificate has been approved. Thank you for your submission! You are now a Temporary (ROP) Agent!', 0),
(10, 3, 'Great news! Your uploaded ROP certificate has been approved. Thank you for your submission! You are now a Temporary (ROP) Agent!', 0);

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
  MODIFY `application_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `unit_team`
--
ALTER TABLE `unit_team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
