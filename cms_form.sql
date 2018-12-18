-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 18, 2018 at 08:45 AM
-- Server version: 10.3.8-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_form`
--

CREATE TABLE `cms_form` (
  `cms_form_id` int(11) NOT NULL,
  `originator_id` int(11) NOT NULL,
  `date_raised` date NOT NULL,
  `change_type` varchar(60) NOT NULL,
  `change_description` varchar(300) DEFAULT NULL,
  `advantages` varchar(300) DEFAULT NULL,
  `alternatives` varchar(300) DEFAULT NULL,
  `area_affected` varchar(100) DEFAULT NULL,
  `hod_id` int(11) DEFAULT NULL,
  `hod_approval` varchar(15) DEFAULT NULL,
  `hod_ref_num` varchar(20) DEFAULT NULL,
  `gm_id` int(11) DEFAULT NULL,
  `gm_approval` varchar(15) DEFAULT NULL,
  `gm_reasons` varchar(300) DEFAULT NULL,
  `hod_auth_change_implem` varchar(3) DEFAULT NULL,
  `proj_leader_id` int(11) DEFAULT NULL,
  `proj_leader_acceptance` varchar(3) DEFAULT NULL,
  `hod_close_change` varchar(3) DEFAULT NULL,
  `originator_close_change` varchar(3) DEFAULT NULL,
  `proj_leader_close_change` varchar(3) DEFAULT NULL,
  `closed` tinyint(4) DEFAULT 0,
  `next_action` varchar(32) DEFAULT NULL,
  `risk_level` varchar(10) DEFAULT NULL,
  `budget_level` varchar(10) DEFAULT NULL,
  `additional_info` varchar(10) DEFAULT NULL,
  `affected_dept` varchar(100) DEFAULT NULL,
  `hod_reasons` text DEFAULT NULL,
  `hod_approval_date` datetime DEFAULT NULL,
  `section_completed` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_form`
--

INSERT INTO `cms_form` (`cms_form_id`, `originator_id`, `date_raised`, `change_type`, `change_description`, `advantages`, `alternatives`, `area_affected`, `hod_id`, `hod_approval`, `hod_ref_num`, `gm_id`, `gm_approval`, `gm_reasons`, `hod_auth_change_implem`, `proj_leader_id`, `proj_leader_acceptance`, `hod_close_change`, `originator_close_change`, `proj_leader_close_change`, `closed`, `next_action`, `risk_level`, `budget_level`, `additional_info`, `affected_dept`, `hod_reasons`, `hod_approval_date`, `section_completed`) VALUES
(5, 3, '2018-12-17', 'Cyanide', 'dummy', 'dummy', 'dummy', 'dummy', 3, 'rejected', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'risk_assessment', NULL, NULL, NULL, NULL, 'dummy', NULL, 'section_start_change_process');

--
-- Triggers `cms_form`
--
DELIMITER $$
CREATE TRIGGER `cms_form_date_raised_bf` BEFORE INSERT ON `cms_form` FOR EACH ROW set New.date_raised = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_impact_question`
--

CREATE TABLE `cms_impact_question` (
  `cms_impact_question_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `cms_impact_response`
--

CREATE TABLE `cms_impact_response` (
  `cms_impact_response_id` int(11) NOT NULL,
  `cms_form_id` int(11) NOT NULL,
  `cms_impact_question_id` int(11) NOT NULL,
  `response` varchar(3) DEFAULT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department`) VALUES
(1, 'Accra Office'),
(2, 'Admin-Site Mgt.'),
(3, 'Engineering'),
(4, 'Environmental'),
(5, 'Exploration'),
(6, 'Finance'),
(7, 'Geology'),
(8, 'HR'),
(9, 'IT'),
(10, 'Mining'),
(11, 'OHS'),
(13, 'Processing'),
(14, 'Security'),
(15, 'SRD'),
(16, 'Supply');


-- --------------------------------------------------------

--
-- Table structure for table `question_import`
--

CREATE TABLE `question_import` (
  `impact_question_id` int(11) NOT NULL,
  `department` text NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Triggers `question_import`
--
DELIMITER $$
CREATE TRIGGER `insert_trg_2` BEFORE INSERT ON `question_import` FOR EACH ROW BEGIN
SET @department_id = (SELECT departments.department_id FROM departments WHERE Lower(trim(departments.department)) = Lower(Trim(New.department )));
INSERT INTO cms_impact_question (department_id, question) VALUES (@department_id, New.question);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'N/A',
  `email` varchar(25) DEFAULT NULL,
  `profile_pic` varchar(25) NOT NULL DEFAULT 'no_profile.jpg',
  `job_title` varchar(50) DEFAULT NULL,
  `employment_date` date DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL,
  `staff_category` varchar(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `uuid` varchar(60) DEFAULT NULL,
  `short_leave_enabled` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `staff_id`, `first_name`, `last_name`, `password`, `role`, `email`, `profile_pic`, `job_title`, `employment_date`, `phone_number`, `contract_start`, `contract_end`, `staff_category`, `department_id`, `uuid`, `short_leave_enabled`) VALUES
(1, 'ss12', 'James', 'Sackey', '$2y$10$RdW/8Zq4j9E4fJT3wcgLm.FMRhbWvHLHcpV59gt.Ye3qducSHcblG', 'N/A', 'ecakubi@adamusgh.com', 'no_profile.jpg', 'IT Admin', '2018-07-10', '0547468603', NULL, NULL, 'Senior Staff', 9, 'A9882897F8BA27E81B277C634B413ED6', 1),
(2, 'ss13', 'eric', 'clinton appiah-kubi', '$2y$10$JRQN2swM7T.C4DCH47pa5uDqjYp/5ZgqyP3/qnavCKFRvDz8UXTgq', 'N/A', 'ecakubi@adamusghg.com', 'ss13.jpg', 'Staff', '2018-07-28', '0547468603', NULL, NULL, 'Junior Staff', 9, '7857097D731107155F6B40F80FFA093B', NULL),
(3, 'ss14', 'bernard', 'bimpong', '$2y$10$9V8lXDEjlCF4byUOKD2tSeH1dysSxqE8ye5qWbykHRK1PiOLn38ym', 'Manager', 'ecakubi@adamusgh.com', 'no_profile.jpg', 'IT Manager', '2018-07-10', '0544332764', NULL, NULL, 'Management', 9, '4B0E039E9A52B8A64A35DAE296949211', NULL),
(4, 'ss15', 'Philip', 'Nana Quainoo', '$2y$10$2hSYNATAFOT0df5apad.l.HVzqAbu9iv9R567lolQRdeRa3ZbUn9u', 'N/A', 'pnquainoo@adamusgh.com', 'no_profile.jpg', 'Staff', '2018-07-10', '0547468603', NULL, NULL, 'Junior Staff', 9, '378877E5E14435F6F242B041BA10067D', NULL),
(5, 'ss20', 'Lawrence', 'Lord Mochiah', '$2y$10$wNwUZekTrkXW85DbN4dvUO5GD6YDREHOkaHrEPHtozC8qEditmHzK', 'Manager', 'llmochiah@adamusgh.com', 'no_profile.jpg', 'HR Superintendent', '2018-07-14', '0231234231', NULL, NULL, 'Management', 8, '815AB013F6967479A17F9A02DD39AC1E', NULL),
(8, 'ss16', 'eric', 'akoto dompre', '$2y$10$GQSAV95HDHTzmY4DShrlqOngXXOGe7JLqSVdfKt9BXFs4b9e.3P2a', 'N/A', 'ead@adamusgh.com', 'no_profile.jpg', 'IT Admin', '2018-08-01', '0543213465', NULL, NULL, 'Senior Staff', 9, '7F9696570D56C3F2552296CEAD430E31', NULL),
(9, 'ss30', 'Halilu', 'Mohammed', '', 'Manager', 'hm@adamusgh.com', 'no_profile.jpg', 'Mining Manager', '2016-12-19', '0231234561', NULL, NULL, 'Management', 10, NULL, NULL),
(10, 'ss31', 'Peter', 'John Ahnnigan', '', 'Manager', 'pjhannigan@adamusgh.com', 'no_profile.jpg', 'General Manager', '2017-11-01', '0231234567', NULL, NULL, 'Management', NULL, NULL, NULL),
(11, 'ss32', 'Anthony', 'Nyamekye', '', 'Manager', 'anyamekye@adamusgh.com', 'no_profile.jpg', 'Process Manager', '2016-12-04', '0231234567', NULL, NULL, 'Management', 13, NULL, NULL);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `bf_user_uuid` BEFORE INSERT ON `users` FOR EACH ROW SET New.uuid = HEX(AES_ENCRYPT(New.user_id, MD5('my-private-key-daemon')))
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_form`
--
ALTER TABLE `cms_form`
  ADD PRIMARY KEY (`cms_form_id`);

--
-- Indexes for table `cms_impact_question`
--
ALTER TABLE `cms_impact_question`
  ADD PRIMARY KEY (`cms_impact_question_id`);

--
-- Indexes for table `cms_impact_response`
--
ALTER TABLE `cms_impact_response`
  ADD PRIMARY KEY (`cms_impact_response_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department` (`department`);

--
-- Indexes for table `question_import`
--
ALTER TABLE `question_import`
  ADD PRIMARY KEY (`impact_question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_form`
--
ALTER TABLE `cms_form`
  MODIFY `cms_form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cms_impact_question`
--
ALTER TABLE `cms_impact_question`
  MODIFY `cms_impact_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `cms_impact_response`
--
ALTER TABLE `cms_impact_response`
  MODIFY `cms_impact_response_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `question_import`
--
ALTER TABLE `question_import`
  MODIFY `impact_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
