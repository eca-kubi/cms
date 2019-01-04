-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2019 at 04:29 PM
-- Server version: 10.3.8-MariaDB
-- PHP Version: 7.2.7

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
-- Table structure for table `affected_dept`
--

CREATE TABLE `affected_dept` (
  `affected_dept_id` int(11) NOT NULL,
  `cms_form_id` int(11) NOT NULL,
  `impact_ass_completed` tinyint(4) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `completed_by` int(11) DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `autdit_id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `action` text NOT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`autdit_id`, `user_id`, `action`, `time`) VALUES
(6, '2', 'Submitted leave application', '2018-11-05 11:49:27'),
(7, '1', 'Submitted leave application', '2018-11-06 12:05:08'),
(8, '3', 'Approved leave application', '2018-11-06 12:09:48'),
(9, '1', 'Submitted leave application', '2018-11-16 10:20:54'),
(10, '1', 'Submitted leave application', '2018-11-16 11:36:33'),
(11, '1', 'Leave application cancelled.', '2018-11-17 11:53:31'),
(12, '1', 'Leave application cancelled.', '2018-11-17 11:54:32'),
(13, '1', 'Leave application cancelled.', '2018-11-17 11:56:07'),
(14, '1', 'Leave application cancelled.', '2018-11-17 11:58:13'),
(15, '1', 'Leave application cancelled.', '2018-11-17 12:00:25'),
(16, '1', 'Leave application cancelled.', '2018-11-17 12:00:43'),
(17, '1', 'Submitted leave application', '2018-11-20 16:51:59'),
(18, '1', 'Leave application cancelled.', '2018-11-26 15:35:34');

--
-- Triggers `audit`
--
DELIMITER $$
CREATE TRIGGER `bf_audit_time` BEFORE INSERT ON `audit` FOR EACH ROW SET New.`time` = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_action_list`
--

CREATE TABLE `cms_action_list` (
  `cms_action_list_id` int(11) NOT NULL,
  `cms_form_id` int(11) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `person_responsible` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_email`
--

CREATE TABLE `cms_email` (
  `email_id` int(11) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `body` text NOT NULL,
  `recipient_address` varchar(300) NOT NULL,
  `recipient_name` varchar(300) DEFAULT NULL,
  `sent` tinyint(4) DEFAULT 0,
  `sender_user_id` int(11) DEFAULT NULL,
  `follow_up` tinyint(4) DEFAULT 0,
  `thread_id` varchar(200) DEFAULT NULL,
  `parent` tinyint(4) DEFAULT 0,
  `cms_form_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_email`
--

INSERT INTO `cms_email` (`email_id`, `subject`, `body`, `recipient_address`, `recipient_name`, `sent`, `sender_user_id`, `follow_up`, `thread_id`, `parent`, `cms_form_id`) VALUES
(57, 'Change Proposal, Assessment and Implementation Form #33', 'Hi Bernard Bimpong, <br/>A Change Proposal application has been raised by James Sackey. Kindly use the link below to approve it.<br/><a href=\"http://sms2.arlgh.com/cms/cms-forms/hod-assessment/33\" >http://sms2.arlgh.com/cms/cms-forms/hod-assessment/33</a>', 'ecakubi@adamusgh.com', 'bernard bimpong', 1, 1, 0, NULL, 1, 33),
(58, 'Change Proposal, Assessment and Implementation Form #33', 'Hi, James Sackey, the Change Process Application you raised has been submitted to your \r\n                    HOD for review. You will be notified accordingly.', 'ecakubi@adamusgh.com', 'James Sackey', 1, 1, 0, NULL, 1, 33),
(59, 'Change Proposal, Assessment and Implementation Form #33', 'Hi, James Sackey<br/>Your Change Process Applicaton has been reviewed by Bernard Bimpong.<br/>Use the link below to continue the process.<br/><a href=\"http://sms2.arlgh.com/cms/cms-forms/risk-assessment/33\" />http://sms2.arlgh.com/cms/cms-forms/risk-assessment/33</a>', 'ecakubi@adamusgh.com', 'James Sackey', 1, 3, 1, NULL, 0, 33),
(60, 'Change Proposal, Assessment and Implementation Form #33', 'Hi Bernard Bimpong, <br/>Risk Assessment for this Change Process has been performed by James  Sackey. <br/>Use this link to view it: <a href=\"http://sms2.arlgh.com/cms/cms-forms/view-change-process/33\" >http://sms2.arlgh.com/cms/cms-forms/view-change-process/33</a>', 'ecakubi@adamusgh.com', 'Bernard Bimpong', 1, 1, 1, NULL, 0, 33);

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
  `additional_info` varchar(100) DEFAULT NULL,
  `affected_dept` varchar(100) DEFAULT NULL,
  `hod_reasons` text DEFAULT NULL,
  `hod_approval_date` datetime DEFAULT NULL,
  `section_completed` varchar(100) DEFAULT NULL,
  `email_subject` varchar(300) DEFAULT NULL,
  `risk_attachment` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_form`
--

INSERT INTO `cms_form` (`cms_form_id`, `originator_id`, `date_raised`, `change_type`, `change_description`, `advantages`, `alternatives`, `area_affected`, `hod_id`, `hod_approval`, `hod_ref_num`, `gm_id`, `gm_approval`, `gm_reasons`, `hod_auth_change_implem`, `proj_leader_id`, `proj_leader_acceptance`, `hod_close_change`, `originator_close_change`, `proj_leader_close_change`, `closed`, `next_action`, `risk_level`, `budget_level`, `additional_info`, `affected_dept`, `hod_reasons`, `hod_approval_date`, `section_completed`, `email_subject`, `risk_attachment`) VALUES
(33, 1, '2019-01-04', 'Cyanide', 'dummy', 'dummy', 'dummy', 'dummy', 3, 'approved', 'dummy-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'risk-assessment', NULL, NULL, 'c_33_u_1.xlsx', '9', 'dummy', '2019-01-04 04:09:13', 'hod-assessment', NULL, 'c_33_u_1.xlsx');

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

--
-- Dumping data for table `cms_impact_question`
--

INSERT INTO `cms_impact_question` (`cms_impact_question_id`, `department_id`, `question`) VALUES
(1, 11, '1.     Require development of an inspection routine?'),
(2, 11, '2.     Affect Health and/ or Safety regulatory commitments?'),
(3, 11, '3.     Require an increase in or the introduction of a dangerous or hazardous substances?'),
(4, 11, '4.     Affect current emergency response/ contingency plans?'),
(5, 11, '5.     Affect current training modules?'),
(6, 11, '6.     Affect current induction module?'),
(7, 11, '7.     Affect industrial hygiene management?'),
(8, 11, '8.     Affect chemical management?'),
(9, 11, '9.     Affect cyanide management?'),
(10, 11, '10.   Require an update or reinforcement of contractor safety?'),
(11, 11, '11.   Affect fire prevention and control management?'),
(12, 11, '12.   Require alteration or impairment to any fire detection or suppression system?'),
(13, 11, '13.   Require alteration or need for additional safety showers, emergency alarms?'),
(14, 11, '14.   Affect energy isolation management?'),
(15, 11, '15.   Affect electrical safety management?'),
(16, 11, '16.   Affect work permit systems?'),
(17, 11, '17.   Affect machine guarding management?'),
(18, 11, '18.   Affect explosives storage or transportation management?'),
(19, 11, '19.   Affect road safety management?'),
(20, 11, '20.   Affect working at heights?'),
(21, 11, '21.   Affect boiler/ pressure vessel/ compressed gas systems management?'),
(22, 11, '22.   Affect noise and vibration management?'),
(23, 11, '23.   Affect dust management?'),
(24, 11, '24.   Affect working alone management?'),
(25, 11, '25.   Affect any other safety and/ or health management issues on site?'),
(26, 4, '1.     Require development of an inspection routine?'),
(27, 4, '2.     Affect Environmental regulatory commitments?'),
(28, 4, '3.     Require an increase in or the introduction of a dangerous or hazardous substances?'),
(29, 4, '4.     Affect current emergency response/ contingency plans?'),
(30, 4, '5.     Affect current training modules?'),
(31, 4, '6.     Affect current induction module?'),
(32, 4, '7.     Require waste minimization to be considered and implemented where appropriate?'),
(33, 4, '8.     Involve any potential hazardous waste?'),
(34, 4, '9.     Affect hydrocarbon management?'),
(35, 4, '10.   Affect chemical management?'),
(36, 4, '11.   Affect cyanide management?'),
(37, 4, '12.   Affect waste rock management?'),
(38, 4, '13.   Affect tailings management?'),
(39, 4, '14.   Affect process waste management?'),
(40, 4, '15.   Affect closure planning and provisioning?'),
(41, 4, '16.   Affect water management?'),
(42, 4, '17.   Affect noise and vibration external to site management?'),
(43, 4, '18.   Affect dust management?'),
(44, 4, '19.   Affect air emission management?'),
(45, 4, '20.   Require new or amendments to existing permits, licenses, or other regulatory approvals?'),
(46, 16, '1.     Require removal item in current stock requirements?'),
(47, 16, '2.     Affect current catalog of MSDS sheets?'),
(48, 16, '3.     Affect any current contractual agreements?'),
(49, 16, '4.     Require requisitions for this change to occur?'),
(50, 16, '5.     Require major equipment purchase?'),
(51, 16, '6.     Has a cost analysis been completed?'),
(52, 16, '7.     Require any new stock to be included in the store inventory?'),
(53, 15, '1.     Influence future Social Impact Assessments?'),
(54, 15, '2.     Affect Human Rights awareness?'),
(55, 15, '3.     Affect local community investment?'),
(56, 15, '4.     Affect local employment and business support?'),
(57, 15, '5.     Affect indigenous employment and business support?'),
(58, 15, '6.     Affect management of culturally significant and religious sites?'),
(59, 15, '7.     Affect external permitting and permissions?'),
(60, 15, '8.     Affect Government relations?'),
(61, 15, '9.     Be a concern to the community?'),
(62, 15, '10.   Impact negatively on the community?'),
(63, 15, '11.   Affect media relations?'),
(64, 15, '12.   Create potential opportunity for activist critics?'),
(65, 15, '13.   Affect investor relations (non-media)?'),
(66, 10, '1.     Affect digger availability, productivity and/ or performance?'),
(67, 10, '2.     Affect truck availability, productivity and/ or performance?'),
(68, 10, '3.     Affect drill availability, productivity and/ or performance?'),
(69, 10, '4.     Affect personnel availability and/ or productivity?'),
(70, 10, '5.     Affect equipment/ vehicle interaction?'),
(71, 10, '6.     Affect part or equipment longevity?'),
(72, 10, '7.     Cause an increase in consumable use and/ or costs?'),
(73, 10, '8.     Affect overall daily production in terms of tonnes, mine grade and/ or development?'),
(74, 10, '9.     Affect shifts and/ or shift time management?'),
(75, 10, '10.   Affect use of major equipment?'),
(76, 10, '11.   Affect drill and blast?'),
(77, 10, '12.   Affect pit wall control and/ or pit wall control management?'),
(78, 10, '13.   Affect void control and/ or void control management?'),
(79, 10, '14.   Affect short, mid and/ or long term planning?'),
(80, 10, '15.   Affect cycle time and/ or cycle time management?'),
(81, 10, '16.   Affect or require update of any measurement or tracking systems?'),
(82, 3, '1.     Affect any engineering specifications?'),
(83, 3, '2.     Affect other maintenance objectives?'),
(84, 3, '3.     Affect current strategic maintenance plans including KPIs?'),
(85, 3, '4.     Affect processes in place to monitor the maintenance plan and associated KPIs?'),
(86, 3, '5.     Affect individual responsibilities within the maintenance plan?'),
(87, 3, '6.     Affect recording and tracking of total direct and indirect cost of maintenance?'),
(88, 3, '7.     Affect scheduling/ implementation/ recording/ tracking of maintenance activities?'),
(89, 3, '8.     Affect equipment performance or reliability?'),
(90, 3, '9.     Affect formal periodic equipment inspection system currently in place?'),
(91, 3, '10.   Affect routine lubrication program in place?'),
(92, 3, '11.   Require the establishment of alert and danger limits for equipment operating parameters (e.g bearing vibration alerts?'),
(93, 3, '12.   Affect equipment specifications or service manuals?'),
(94, 3, '13.   Affect parts and resource needs?'),
(95, 3, '14.   Affect code requirements and standards?'),
(96, 3, '15.   Affect agreements with the parts or equipment supplier or dealer?'),
(97, 3, '16.   Require spare parts to be regularly maintained?'),
(98, 3, '17.   Require a rebuilding program to be scheduled?'),
(99, 3, '18.   Require additional supervision when carrying out tasks associated with change?'),
(100, 3, '19.   Affect a current documented job analyses or similar administrative procedure?'),
(101, 3, '20.   Require the organization of training of personnel who will be carrying out associated tasks?'),
(102, 3, '21.   Require any training conducted be recorded and tracked?'),
(103, 3, '22.   Affect current audit systems to monitor safety, quality, productivity or reliability?'),
(104, 3, '23.   Affect the computerized maintenance management system?'),
(105, 3, '24.   Require maintenance plan to be updated?'),
(106, 3, '25.   Require isolation permit requirements or any other workplace interruptions?'),
(107, 3, '26.   Affect or require updates to any drawings and/ or plans or other controlled documents?'),
(108, 3, '27.   Affect contracted personnel currently employed?'),
(109, 3, '28.   Affect our energy and greenhouse gas emission targets or commitments?'),
(110, 3, '29.   Require an energy assessment to identify opportunities for associated energy savings?'),
(111, 3, '30.   Create or deny opportunities for energy savings?'),
(112, 3, '31.   Affect our energy assessment (budget)?'),
(113, 3, '32.   Require power factors to be known?'),
(114, 3, '33.   Include considerations of peak load times?'),
(115, 13, '1.     Include consideration of optimization of cost and availability of spare parts?'),
(116, 13, '2.     Influence metallurgical tracking, balancing and/ or accounting, including reconciliation?'),
(117, 13, '3.     Affect processing KPIs?'),
(118, 13, '4.     Decrease the maintainability of existing plant, equipment and/ or infrastructure?'),
(119, 13, '5.     Decrease the operability of existing plant, equipment and/ or infrastructure?'),
(120, 13, '6.     Influence and/ or need to be considered in production planning?'),
(121, 13, '7.     Include a post commissioning review planned after implementation?'),
(122, 13, '8.     Require setting of associated operational boundaries and/ or limits and can they be easily adhered to?'),
(123, 13, '9.     Affect tailing storage facility management?'),
(124, 13, '10.   Affect cyanide management, including transport, storage and/ or use?'),
(125, 13, '11.   Affect the availability of overhead crane and/ or other specialty equipment?'),
(126, 13, '12.   Affect mill circuit power and/ throughput?'),
(127, 13, '13.   Affect mill circuit configuration including optimizations of mine to mill processes?'),
(128, 13, '14.   Affect mineralogy control including grind, recovery and feed relationships?'),
(129, 13, '15.   Affect process control including equipment/ plant failure minimizations?'),
(130, 13, '16.   Affect isolation permit requirements or any other workplace interruptions?'),
(131, 8, '1.     Affect employee moral and morale?'),
(132, 8, '2.     Affect employee welfare?'),
(133, 8, '3.     Require employee consultation and cooperation?'),
(134, 8, '4.     Affect the implementation of the labour and/ or other laws/ regulations?'),
(135, 8, '5.     Affect current documented policies and procedures?'),
(136, 8, '6.     Affect current budget/ resources available for managing the human resource?'),
(137, 14, '1.     Affects compliance with the Nzema Gold Operations Gold Security Standards?'),
(138, 14, '2.     Affects compliance with the Nzema Gold Operations Fuel Security Standards?'),
(139, 14, '3.     Affects compliance with the Nzema Gold Operations Explosives Security Standards?'),
(140, 14, '4.     Affects compliance with the Nzema Gold Operations Security Policies?'),
(141, 14, '5.     Affects compliance with the voluntary principles of security and human rights?'),
(142, 14, '6.     Create opportunities for illegal mining?'),
(143, 14, '7.     Create opportunities for trespassing?'),
(144, 14, '8.     Facilitate theft?'),
(145, 14, '9.     Create opportunities for fraud?'),
(146, 14, '10.   Require exemption from any Nzema Gold Operations Security Standard?'),
(147, 14, '11.   Require changes to any existing security process?'),
(148, 14, '12.   Require changes to any existing security procedure?'),
(149, 14, '13.   Require changes to any existing security plan?'),
(150, 14, '14.   Require additional security staff?'),
(151, 14, '15.   Require additional security equipment?'),
(152, 14, '16.   Require changes to security perimeter fencing?'),
(153, 14, '17.   Require new fencing?'),
(154, 14, '18.   Require changes to or a new access gates?'),
(155, 14, '19.   Require additional CCTV monitoring equipment?'),
(156, 14, '20.   Require additional Access Control equipment?'),
(157, 14, '21.   Require additional Intrusion Alarm equipment?'),
(158, 14, '22.   Require additional lighting?'),
(159, 6, '1.     Affect any general ledger accounts?'),
(160, 6, '2.     Affect IT financial systems i.e. SUN, PRONTO etc?'),
(161, 6, '3.     Be driven by an external financial regulation?'),
(162, 6, '4.     Affects compliance with Persol requirements?'),
(163, 6, '5.     Affects internal controls over financial reporting?'),
(164, 6, '6.     Affects finance business process standards?'),
(165, 6, '7.     Affects budgets, forecasts or life of mine plan?'),
(166, 6, '8.     Require additional financial/ accounting resources or relocation of existing financial/ accounting resources?'),
(167, 6, '9.     Affects financial KPIs such as cash cost, profit-before- tax, etc?'),
(168, 6, '10.   Affect key external/ internal financial reporting dates and milestones?'),
(169, 6, '11.   Lead to risk of fraud or error in financial statements, amounts and assumptions?'),
(170, 6, '12.   Require additional/ new training on financial/ accounting concepts?'),
(171, 6, '13.   Be driven by a recent financial audit (internal/ external)'),
(172, 6, '14.   Affect finance/ accounting roles and responsibilities, job descriptions, etc.?'),
(173, 6, '15.   Lead to changes in chart of accounts mapping?'),
(174, 6, '16.   Require reporting change to insurer?'),
(175, 6, '17.   Affect property insurance coverage?'),
(176, 6, '18.   Affect policy limits/ sub-limits?'),
(177, 6, '19.   Affect deductibles/ retentions?'),
(178, 6, '20.   Affect insurance premiums?'),
(179, 6, '21.   Affect regional insurance cost?'),
(180, 6, '22.   Affect global insurance cost?'),
(181, 6, '23.   Require follow-up with mine site?'),
(182, 6, '24.   Affect fire protection equipment/ overall system?'),
(183, 6, '25.   Affect corporate/ regional/ mine site liability?'),
(184, 6, '26.   Affect any global insurance policy (crime, liability, marine cargo, etc)'),
(185, 9, '1.     Require additional IT software?'),
(186, 9, '2.     Require additional IT hardware?'),
(187, 9, '3.     Affect network transmission?'),
(188, 9, '4.     Require additional backup system?'),
(189, 9, '5.     Affect the server capacity?'),
(190, 9, '6.     Affect any external licensing?'),
(191, 9, '7.     Require training of personnel?'),
(192, 9, '8.     Affect the transmitting bandwidth?'),
(193, 7, '1.     Affect vehicle availability, productivity and/ or performance?'),
(194, 7, '2.     Affect drill availability, productivity and/ or performance?'),
(195, 7, '3.     Affect personnel availability and/ or productivity?'),
(196, 7, '4.     Affect equipment/ vehicle interaction?'),
(197, 7, '5.     Affect part of equipment longevity?'),
(198, 7, '6.     Cause an increase in consumable use and/ or costs?'),
(199, 7, '7.     Affect current emergency response/ contingency plan?'),
(200, 7, '8.     Affect drill pad construction or design?'),
(201, 7, '9.     Affect use of major equipment?'),
(202, 7, '10.   Affect core logging activities?'),
(203, 7, '11.   Affect mapping activities?'),
(204, 7, '12.   Affect or require updates to any drawings and/ or plans or other controlled documents?'),
(205, 7, '13.   Require added training of affected personnel?'),
(206, 7, '14.   Require isolation permit requirements or any other workplace interruptions?'),
(207, 7, '15.   Affect contracted personnel currently employed?');

-- --------------------------------------------------------

--
-- Table structure for table `cms_impact_response`
--

CREATE TABLE `cms_impact_response` (
  `cms_impact_response_id` int(11) NOT NULL,
  `cms_form_id` int(11) NOT NULL,
  `cms_impact_question_id` int(11) NOT NULL,
  `response` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_impact_response`
--

INSERT INTO `cms_impact_response` (`cms_impact_response_id`, `cms_form_id`, `cms_impact_question_id`, `response`) VALUES
(26, 25, 107, NULL),
(27, 25, 108, NULL),
(28, 25, 109, NULL),
(29, 25, 110, NULL),
(30, 25, 111, NULL),
(31, 25, 112, NULL),
(32, 25, 113, NULL),
(33, 25, 114, NULL),
(34, 25, 185, NULL),
(35, 25, 186, NULL),
(36, 25, 187, NULL),
(37, 25, 188, NULL),
(38, 25, 189, NULL),
(39, 25, 190, NULL),
(40, 25, 191, NULL),
(41, 25, 192, NULL),
(42, 27, 185, NULL),
(43, 27, 186, NULL),
(44, 27, 187, NULL),
(45, 27, 188, NULL),
(46, 27, 189, NULL),
(47, 27, 190, NULL),
(48, 27, 191, NULL),
(49, 27, 192, NULL),
(50, 27, 66, NULL),
(51, 27, 67, NULL),
(52, 27, 68, NULL),
(53, 27, 69, NULL),
(54, 27, 70, NULL),
(55, 27, 71, NULL),
(56, 27, 72, NULL),
(57, 27, 73, NULL),
(58, 27, 74, NULL),
(59, 27, 75, NULL),
(60, 27, 76, NULL),
(61, 27, 77, NULL),
(62, 27, 78, NULL),
(63, 27, 79, NULL),
(64, 27, 80, NULL),
(65, 27, 81, NULL),
(66, 30, 82, NULL),
(67, 30, 83, NULL),
(68, 30, 84, NULL),
(69, 30, 85, NULL),
(70, 30, 86, NULL),
(71, 30, 87, NULL),
(72, 30, 88, NULL),
(73, 30, 89, NULL),
(74, 30, 90, NULL),
(75, 30, 91, NULL),
(76, 30, 92, NULL),
(77, 30, 93, NULL),
(78, 30, 94, NULL),
(79, 30, 95, NULL),
(80, 30, 96, NULL),
(81, 30, 97, NULL),
(82, 30, 98, NULL),
(83, 30, 99, NULL),
(84, 30, 100, NULL),
(85, 30, 101, NULL),
(86, 30, 102, NULL),
(87, 30, 103, NULL),
(88, 30, 104, NULL),
(89, 30, 105, NULL),
(90, 30, 106, NULL),
(91, 30, 107, NULL),
(92, 30, 108, NULL),
(93, 30, 109, NULL),
(94, 30, 110, NULL),
(95, 30, 111, NULL),
(96, 30, 112, NULL),
(97, 30, 113, NULL),
(98, 30, 114, NULL),
(99, 30, 185, NULL),
(100, 30, 186, NULL),
(101, 30, 187, NULL),
(102, 30, 188, NULL),
(103, 30, 189, NULL),
(104, 30, 190, NULL),
(105, 30, 191, NULL),
(106, 30, 192, NULL),
(107, 32, 185, 'Yes'),
(108, 32, 186, 'No'),
(109, 32, 187, 'Yes'),
(110, 32, 188, 'Yes'),
(111, 32, 189, 'No'),
(112, 32, 190, 'Yes'),
(113, 32, 191, 'Yes'),
(114, 32, 192, 'Yes'),
(115, 33, 185, NULL),
(116, 33, 186, NULL),
(117, 33, 187, NULL),
(118, 33, 188, NULL),
(119, 33, 189, NULL),
(120, 33, 190, NULL),
(121, 33, 191, NULL),
(122, 33, 192, NULL);

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
-- Table structure for table `department_approvers`
--

CREATE TABLE `department_approvers` (
  `department_approver_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_approvers`
--

INSERT INTO `department_approvers` (`department_approver_id`, `user_id`, `department_id`) VALUES
(57, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `earning_policy`
--

CREATE TABLE `earning_policy` (
  `id_` int(11) NOT NULL,
  `earning_policy_name` varchar(30) NOT NULL,
  `earning_policy_code` varchar(15) NOT NULL,
  `description` text DEFAULT NULL,
  `accrual_period` varchar(50) NOT NULL,
  `earn_at` varchar(10) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `earning_policy`
--

INSERT INTO `earning_policy` (`id_`, `earning_policy_name`, `earning_policy_code`, `description`, `accrual_period`, `earn_at`, `active`, `created_on`) VALUES
(1, 'Every 1 Month', 'E1M', 'Monthly accrual', 'every_1_month', 'end', 1, '2018-09-16 11:09:59'),
(2, 'Earn at Once', 'EAO', 'Earn leave days at once without accruing', 'earn_at_once', NULL, 1, '2018-09-25 04:22:48');

--
-- Triggers `earning_policy`
--
DELIMITER $$
CREATE TRIGGER `earnining_policy_created_on` BEFORE INSERT ON `earning_policy` FOR EACH ROW set new.`created_on` = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `email_id` int(11) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `body` text NOT NULL,
  `recipient` varchar(50) NOT NULL,
  `recipient_user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created` date NOT NULL,
  `sender_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `emails`
--
DELIMITER $$
CREATE TRIGGER `bf_emails_created` BEFORE INSERT ON `emails` FOR EACH ROW SET New.created= now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id_` int(11) NOT NULL,
  `summary` varchar(50) NOT NULL,
  `dtstart` date DEFAULT NULL,
  `dtend` date DEFAULT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id_`, `summary`, `dtstart`, `dtend`, `created_on`) VALUES
(1, 'New Year\'s Day', '2017-01-01', '2017-01-02', '0000-00-00 00:00:00'),
(2, 'New Year\'s Day observed', '2017-01-02', '2017-01-03', '0000-00-00 00:00:00'),
(3, 'Independence Day', '2017-03-06', '2017-03-07', '0000-00-00 00:00:00'),
(4, 'Good Friday', '2017-04-14', '2017-04-15', '0000-00-00 00:00:00'),
(5, 'Holy Saturday', '2017-04-15', '2017-04-16', '0000-00-00 00:00:00'),
(6, 'Easter Day', '2017-04-16', '2017-04-17', '0000-00-00 00:00:00'),
(7, 'Easter Monday', '2017-04-17', '2017-04-18', '0000-00-00 00:00:00'),
(8, 'May Day', '2017-05-01', '2017-05-02', '0000-00-00 00:00:00'),
(9, 'Mothers\' Day', '2017-05-14', '2017-05-15', '0000-00-00 00:00:00'),
(10, 'African Union Day', '2017-05-25', '2017-05-26', '0000-00-00 00:00:00'),
(11, 'Fathers\' Day', '2017-06-18', '2017-06-19', '0000-00-00 00:00:00'),
(12, 'Id ul Fitr', '2017-06-26', '2017-06-27', '0000-00-00 00:00:00'),
(13, 'Republic Day', '2017-07-01', '2017-07-02', '0000-00-00 00:00:00'),
(14, 'Republic Day observed', '2017-07-03', '2017-07-04', '0000-00-00 00:00:00'),
(15, 'Eid al-Adha', '2017-09-02', '2017-09-03', '0000-00-00 00:00:00'),
(16, 'Founder\'s Day', '2017-09-21', '2017-09-22', '0000-00-00 00:00:00'),
(17, 'Farmer\'s Day', '2017-12-01', '2017-12-02', '0000-00-00 00:00:00'),
(18, 'Christmas Eve', '2017-12-24', '2017-12-25', '0000-00-00 00:00:00'),
(19, 'Christmas Day', '2017-12-25', '2017-12-26', '0000-00-00 00:00:00'),
(20, 'Boxing Day', '2017-12-26', '2017-12-27', '0000-00-00 00:00:00'),
(21, 'New Year\'s Eve', '2017-12-31', '2018-01-01', '0000-00-00 00:00:00'),
(22, 'New Year\'s Day', '2018-01-01', '2018-01-02', '0000-00-00 00:00:00'),
(23, 'Independence Day', '2018-03-06', '2018-03-07', '0000-00-00 00:00:00'),
(24, 'Good Friday', '2018-03-30', '2018-03-31', '0000-00-00 00:00:00'),
(25, 'Holy Saturday', '2018-03-31', '2018-04-01', '0000-00-00 00:00:00'),
(26, 'Easter Day', '2018-04-01', '2018-04-02', '0000-00-00 00:00:00'),
(27, 'Easter Monday', '2018-04-02', '2018-04-03', '0000-00-00 00:00:00'),
(28, 'May Day', '2018-05-01', '2018-05-02', '0000-00-00 00:00:00'),
(29, 'Mothers\' Day', '2018-05-13', '2018-05-14', '0000-00-00 00:00:00'),
(30, 'African Union Day', '2018-05-25', '2018-05-26', '0000-00-00 00:00:00'),
(31, 'Id ul Fitr', '2018-06-15', '2018-06-16', '0000-00-00 00:00:00'),
(32, 'Fathers\' Day', '2018-06-17', '2018-06-18', '0000-00-00 00:00:00'),
(33, 'Republic Day', '2018-07-01', '2018-07-02', '0000-00-00 00:00:00'),
(34, 'Republic Day observed', '2018-07-02', '2018-07-03', '0000-00-00 00:00:00'),
(35, 'Eid al-Adha', '2018-08-22', '2018-08-23', '0000-00-00 00:00:00'),
(36, 'Founder\'s Day', '2018-09-21', '2018-09-22', '0000-00-00 00:00:00'),
(37, 'Farmer\'s Day', '2018-12-07', '2018-12-08', '0000-00-00 00:00:00'),
(38, 'Christmas Eve', '2018-12-24', '2018-12-25', '0000-00-00 00:00:00'),
(39, 'Christmas Day', '2018-12-25', '2018-12-26', '0000-00-00 00:00:00'),
(40, 'Boxing Day', '2018-12-26', '2018-12-27', '0000-00-00 00:00:00'),
(41, 'New Year\'s Eve', '2018-12-31', '2019-01-01', '0000-00-00 00:00:00'),
(42, 'New Year\'s Day', '2019-01-01', '2019-01-02', '0000-00-00 00:00:00'),
(43, 'Independence Day', '2019-03-06', '2019-03-07', '0000-00-00 00:00:00'),
(44, 'Good Friday', '2019-04-19', '2019-04-20', '0000-00-00 00:00:00'),
(45, 'Holy Saturday', '2019-04-20', '2019-04-21', '0000-00-00 00:00:00'),
(46, 'Easter Day', '2019-04-21', '2019-04-22', '0000-00-00 00:00:00'),
(47, 'Easter Monday', '2019-04-22', '2019-04-23', '0000-00-00 00:00:00'),
(48, 'May Day', '2019-05-01', '2019-05-02', '0000-00-00 00:00:00'),
(49, 'Mothers\' Day', '2019-05-12', '2019-05-13', '0000-00-00 00:00:00'),
(50, 'African Union Day', '2019-05-25', '2019-05-26', '0000-00-00 00:00:00'),
(51, 'African Union Day observed', '2019-05-27', '2019-05-28', '0000-00-00 00:00:00'),
(52, 'Id ul Fitr', '2019-06-05', '2019-06-06', '0000-00-00 00:00:00'),
(53, 'Fathers\' Day', '2019-06-16', '2019-06-17', '0000-00-00 00:00:00'),
(54, 'Republic Day', '2019-07-01', '2019-07-02', '0000-00-00 00:00:00'),
(55, 'Eid al-Adha', '2019-08-12', '2019-08-13', '0000-00-00 00:00:00'),
(56, 'Founder\'s Day', '2019-09-21', '2019-09-22', '0000-00-00 00:00:00'),
(57, 'Founder\'s Day observed', '2019-09-23', '2019-09-24', '0000-00-00 00:00:00'),
(58, 'Farmer\'s Day', '2019-12-06', '2019-12-07', '0000-00-00 00:00:00'),
(59, 'Christmas Eve', '2019-12-24', '2019-12-25', '0000-00-00 00:00:00'),
(60, 'Christmas Day', '2019-12-25', '2019-12-26', '0000-00-00 00:00:00'),
(61, 'Boxing Day', '2019-12-26', '2019-12-27', '0000-00-00 00:00:00'),
(62, 'New Year\'s Eve', '2019-12-31', '2020-01-01', '0000-00-00 00:00:00');

--
-- Triggers `holidays`
--
DELIMITER $$
CREATE TRIGGER `holidays_created_on` BEFORE INSERT ON `holidays` FOR EACH ROW set new.`created_on` = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hr_approvers`
--

CREATE TABLE `hr_approvers` (
  `hr_approver_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `impact_assessment`
--

CREATE TABLE `impact_assessment` (
  `impact_assessment_id` int(11) NOT NULL,
  `date_completed` datetime DEFAULT NULL,
  `completed_by` int(11) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `cms_form_id` int(11) DEFAULT NULL,
  `complete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_approval_status`
--

CREATE TABLE `leave_approval_status` (
  `leave_approval_status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_transaction_id` int(11) NOT NULL,
  `approved` tinyint(4) DEFAULT NULL,
  `rejected` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_entitlements`
--

CREATE TABLE `leave_entitlements` (
  `leave_entitlement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `outstanding` float DEFAULT NULL,
  `days_taken` int(11) DEFAULT 0,
  `accrued` float DEFAULT 0,
  `end_of_contract_or_expiry` date DEFAULT NULL,
  `start_accruing_from` date DEFAULT NULL,
  `convert_to_paid_leave` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `leave_entitlements`
--

INSERT INTO `leave_entitlements` (`leave_entitlement_id`, `user_id`, `leave_type_id`, `outstanding`, `days_taken`, `accrued`, `end_of_contract_or_expiry`, `start_accruing_from`, `convert_to_paid_leave`) VALUES
(1, 1, 1, NULL, 14, 0, '2018-12-31', NULL, NULL),
(2, 1, 5, NULL, 0, 0, '2018-12-31', NULL, NULL),
(3, 1, 3, NULL, 0, 0, '2018-12-31', NULL, NULL),
(4, 1, 7, NULL, 0, 0, '2018-12-31', NULL, NULL),
(5, 2, 1, NULL, 10, 0, '2018-12-31', NULL, NULL),
(6, 2, 5, NULL, 0, 0, '2018-12-31', NULL, NULL),
(7, 2, 3, NULL, 0, 0, '2018-12-31', NULL, NULL),
(8, 2, 7, NULL, 1, 0, '2018-12-31', NULL, NULL);

--
-- Triggers `leave_entitlements`
--
DELIMITER $$
CREATE TRIGGER `insert_trg_leave_entitlements` BEFORE INSERT ON `leave_entitlements` FOR EACH ROW BEGIN
	IF (New.end_of_contract_or_expiry = '0000-00-00' OR New.end_of_contract_or_expiry IS NULL) THEN
      SET New.end_of_contract_or_expiry = CONCAT(EXTRACT(YEAR FROM now()),'-12-31');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_entitlements_import`
--

CREATE TABLE `leave_entitlements_import` (
  `staff_id` varchar(15) DEFAULT NULL,
  `leave_type` varchar(30) DEFAULT NULL,
  `days_taken` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `leave_entitlements_import`
--

INSERT INTO `leave_entitlements_import` (`staff_id`, `leave_type`, `days_taken`) VALUES
('ss12', 'Annual', 4),
('ss12', 'Paternity', 0),
('ss12', 'Bereavement', 0),
('ss12', 'Sick', 0),
('ss13', 'Annual', 10),
('ss13', 'Paternity', 0),
('ss13', 'Bereavement', 0),
('ss13', 'Sick', 1);

--
-- Triggers `leave_entitlements_import`
--
DELIMITER $$
CREATE TRIGGER `insert_trg` BEFORE INSERT ON `leave_entitlements_import` FOR EACH ROW BEGIN
SET sql_mode = 'NO_ZERO_IN_DATE';
#SET New.end_of_contract_or_expiry = STR_To_DATE(New.end_of_contract_or_expiry, '%e-%b-%y');
SET @user_id = (SELECT user_id FROM users WHERE staff_id=New.staff_id);
SET @leave_type_id = (SELECT leave_type.leave_type_id FROM leave_type where LOWER(leave_type.leave_type_name) = LOWER(TRIM(New.leave_type)));

INSERT IGNORE INTO `leave_entitlements` (`user_id`, `leave_type_id`, `days_taken`)  VALUES (@user_id, @leave_type_id, New.days_taken );

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_entitlements_old`
--

CREATE TABLE `leave_entitlements_old` (
  `id_` int(11) NOT NULL,
  `leave_type_id` varchar(30) NOT NULL,
  `unit_leave_credit` float DEFAULT NULL,
  `total_days_taken` int(11) NOT NULL DEFAULT 0,
  `total_credits_earned` int(11) DEFAULT 0,
  `carry_forward` tinyint(4) DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `earning_start` date DEFAULT NULL,
  `staff_id` varchar(15) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `earning_policy_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `leave_entitlements_old`
--

INSERT INTO `leave_entitlements_old` (`id_`, `leave_type_id`, `unit_leave_credit`, `total_days_taken`, `total_credits_earned`, `carry_forward`, `expiry`, `earning_start`, `staff_id`, `created_on`, `earning_policy_id`) VALUES
(9, 'an', NULL, 0, 0, NULL, NULL, NULL, 'ss12', '2018-10-12 05:21:56', NULL);

--
-- Triggers `leave_entitlements_old`
--
DELIMITER $$
CREATE TRIGGER `leave_entitlements_created_on_tbf` BEFORE INSERT ON `leave_entitlements_old` FOR EACH ROW set New.created_on = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_remarks`
--

CREATE TABLE `leave_remarks` (
  `leave_remarks_id` int(11) NOT NULL,
  `leave_transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `attachment` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_review_history`
--

CREATE TABLE `leave_review_history` (
  `leave_review_history_id` int(11) NOT NULL,
  `action` varchar(30) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_transaction_id` int(11) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `leave_review_history`
--
DELIMITER $$
CREATE TRIGGER `leave_review_history_date_tbf` BEFORE INSERT ON `leave_review_history` FOR EACH ROW set New.date = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_transaction`
--

CREATE TABLE `leave_transaction` (
  `leave_transaction_id` int(11) NOT NULL,
  `leave_entitlement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `resume_date` date DEFAULT NULL,
  `leave_reason` text NOT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `vac_address` varchar(50) DEFAULT NULL,
  `vac_phone_no` varchar(20) DEFAULT NULL,
  `days_applied_for` int(11) NOT NULL,
  `relieved_by_id` int(11) DEFAULT NULL,
  `application_date` date NOT NULL,
  `attachment` varchar(50) DEFAULT NULL,
  `company_email` varchar(50) DEFAULT NULL,
  `personal_email` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `transaction_number` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `leave_transaction`
--

INSERT INTO `leave_transaction` (`leave_transaction_id`, `leave_entitlement_id`, `user_id`, `start_date`, `end_date`, `resume_date`, `leave_reason`, `relationship`, `vac_address`, `vac_phone_no`, `days_applied_for`, `relieved_by_id`, `application_date`, `attachment`, `company_email`, `personal_email`, `status`, `transaction_number`) VALUES
(6, 1, 1, '2018-11-21', '2018-12-04', '2018-11-20', 'family issue', NULL, '', '', 10, NULL, '2018-11-20', NULL, 'ecakubi@adamusgh.com', '', 'cancelled', 'a0bac');

--
-- Triggers `leave_transaction`
--
DELIMITER $$
CREATE TRIGGER `leave_application_date` BEFORE INSERT ON `leave_transaction` FOR EACH ROW set new.`application_date` = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `leave_resume_date` BEFORE INSERT ON `leave_transaction` FOR EACH ROW set new.`resume_date` = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `leave_resume_date2` BEFORE INSERT ON `leave_transaction` FOR EACH ROW set new.`resume_date` = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_transaction_summary`
--

CREATE TABLE `leave_transaction_summary` (
  `leave_transaction_summary_id` int(11) NOT NULL,
  `leave_entitlement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `resume_date` date DEFAULT NULL,
  `leave_reason` text NOT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `vac_address` varchar(50) DEFAULT NULL,
  `vac_phone_no` varchar(20) DEFAULT NULL,
  `days_applied_for` int(11) NOT NULL,
  `relieved_by_id` int(11) DEFAULT NULL,
  `application_date` date NOT NULL,
  `attachment` varchar(50) DEFAULT NULL,
  `company_email` varchar(50) DEFAULT NULL,
  `personal_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Triggers `leave_transaction_summary`
--
DELIMITER $$
CREATE TRIGGER `bf_leave_transaction_summary_application_date` BEFORE INSERT ON `leave_transaction_summary` FOR EACH ROW SET New.application_date=now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `leave_type_id` int(11) NOT NULL,
  `leave_type_name` varchar(30) NOT NULL,
  `description` text DEFAULT NULL,
  `allow_negative` tinyint(4) DEFAULT NULL,
  `paid_leave` tinyint(4) DEFAULT NULL,
  `enable` tinyint(4) NOT NULL DEFAULT 1,
  `carry_forward` int(11) DEFAULT NULL,
  `annual_earning` int(11) DEFAULT NULL,
  `leave_unit` varchar(15) DEFAULT 'day',
  `accruable` tinyint(4) DEFAULT NULL,
  `accrual_interval` int(11) DEFAULT NULL,
  `expires` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`leave_type_id`, `leave_type_name`, `description`, `allow_negative`, `paid_leave`, `enable`, `carry_forward`, `annual_earning`, `leave_unit`, `accruable`, `accrual_interval`, `expires`) VALUES
(1, 'Annual', '', 1, 1, 1, 1, 30, 'day', 1, 1, 1),
(2, 'Casual', '', 0, 0, 1, NULL, 2, 'day', 0, NULL, 1),
(3, 'Bereavement', '', 0, 0, 1, NULL, 10, 'day', 0, NULL, 1),
(4, 'Maternity', '', 0, 0, 1, 0, 90, 'day', 0, NULL, 1),
(5, 'Paternity', NULL, 0, 0, 1, NULL, 5, 'day', 0, NULL, 1),
(7, 'Sick', NULL, 0, 0, 1, NULL, NULL, 'day', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `manager_id` int(11) NOT NULL,
  `section_managed` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `managers_import`
--

CREATE TABLE `managers_import` (
  `staff_id` varchar(10) NOT NULL,
  `department_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `managers_import`
--

INSERT INTO `managers_import` (`staff_id`, `department_id`) VALUES
('ss12', 'OHS'),
('ss13', 'IT');

--
-- Triggers `managers_import`
--
DELIMITER $$
CREATE TRIGGER `insert_trg_managers_import` BEFORE INSERT ON `managers_import` FOR EACH ROW BEGIN
SET @department_id = (SELECT departments.department_id FROM departments WHERE departments.department = New.department_id);
SET @user_id = (SELECT users.user_id FROM users WHERE users.staff_id = New.staff_id);
INSERT IGNORE INTO `managers` (`user_id`, `department_id`)  VALUES (@department_id, @user_id) ON DUPLICATE KEY UPDATE managers.`user_id` = VALUES(`user_id`), managers.`department_id` = VALUES(`department_id`);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_trg_managers_import` BEFORE UPDATE ON `managers_import` FOR EACH ROW BEGIN
SET @department_id = (SELECT departments.department_id FROM departments WHERE departments.department = New.department_id);
SET @user_id = (SELECT users.user_id FROM users WHERE users.staff_id = New.staff_id);
INSERT IGNORE INTO `managers` (`user_id`, `department_id`)  VALUES (@department_id, @user_id) ON DUPLICATE KEY UPDATE managers.`user_id` = VALUES(`user_id`), managers.`department_id` = VALUES(`department_id`);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `password_reset_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `secret_token` varchar(250) NOT NULL,
  `expiry` date NOT NULL,
  `email_hashed` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`password_reset_id`, `email`, `secret_token`, `expiry`, `email_hashed`) VALUES
(5, 'ecakubi@adamusgh.com', 'a17e8a08222d0020a509b2472d597ffb', '2018-10-27', '03cdf95ad9d87a4e81ee164132ca6a3c');

--
-- Triggers `password_reset`
--
DELIMITER $$
CREATE TRIGGER `password_reset_expiry_bt` BEFORE INSERT ON `password_reset` FOR EACH ROW SET new.expiry = CURDATE() + INTERVAL 1 DAY
$$
DELIMITER ;

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
-- Dumping data for table `question_import`
--

INSERT INTO `question_import` (`impact_question_id`, `department`, `question`) VALUES
(1, 'ohs', '1.     Require development of an inspection routine?'),
(2, 'ohs', '2.     Affect Health and/ or Safety regulatory commitments?'),
(3, 'ohs', '3.     Require an increase in or the introduction of a dangerous or hazardous substances?'),
(4, 'ohs', '4.     Affect current emergency response/ contingency plans?'),
(5, 'ohs', '5.     Affect current training modules?'),
(6, 'ohs', '6.     Affect current induction module?'),
(7, 'ohs', '7.     Affect industrial hygiene management?'),
(8, 'ohs', '8.     Affect chemical management?'),
(9, 'ohs', '9.     Affect cyanide management?'),
(10, 'ohs', '10.   Require an update or reinforcement of contractor safety?'),
(11, 'ohs', '11.   Affect fire prevention and control management?'),
(12, 'ohs', '12.   Require alteration or impairment to any fire detection or suppression system?'),
(13, 'ohs', '13.   Require alteration or need for additional safety showers, emergency alarms?'),
(14, 'ohs', '14.   Affect energy isolation management?'),
(15, 'ohs', '15.   Affect electrical safety management?'),
(16, 'ohs', '16.   Affect work permit systems?'),
(17, 'ohs', '17.   Affect machine guarding management?'),
(18, 'ohs', '18.   Affect explosives storage or transportation management?'),
(19, 'ohs', '19.   Affect road safety management?'),
(20, 'ohs', '20.   Affect working at heights?'),
(21, 'ohs', '21.   Affect boiler/ pressure vessel/ compressed gas systems management?'),
(22, 'ohs', '22.   Affect noise and vibration management?'),
(23, 'ohs', '23.   Affect dust management?'),
(24, 'ohs', '24.   Affect working alone management?'),
(25, 'ohs', '25.   Affect any other safety and/ or health management issues on site?'),
(26, 'environmental', '1.     Require development of an inspection routine?'),
(27, 'environmental', '2.     Affect Environmental regulatory commitments?'),
(28, 'environmental', '3.     Require an increase in or the introduction of a dangerous or hazardous substances?'),
(29, 'environmental', '4.     Affect current emergency response/ contingency plans?'),
(30, 'environmental', '5.     Affect current training modules?'),
(31, 'environmental', '6.     Affect current induction module?'),
(32, 'environmental', '7.     Require waste minimization to be considered and implemented where appropriate?'),
(33, 'environmental', '8.     Involve any potential hazardous waste?'),
(34, 'environmental', '9.     Affect hydrocarbon management?'),
(35, 'environmental', '10.   Affect chemical management?'),
(36, 'environmental', '11.   Affect cyanide management?'),
(37, 'environmental', '12.   Affect waste rock management?'),
(38, 'environmental', '13.   Affect tailings management?'),
(39, 'environmental', '14.   Affect process waste management?'),
(40, 'environmental', '15.   Affect closure planning and provisioning?'),
(41, 'environmental', '16.   Affect water management?'),
(42, 'environmental', '17.   Affect noise and vibration external to site management?'),
(43, 'environmental', '18.   Affect dust management?'),
(44, 'environmental', '19.   Affect air emission management?'),
(45, 'environmental', '20.   Require new or amendments to existing permits, licenses, or other regulatory approvals?'),
(46, 'supply', '1.     Require removal item in current stock requirements?'),
(47, 'supply', '2.     Affect current catalog of MSDS sheets?'),
(48, 'supply', '3.     Affect any current contractual agreements?'),
(49, 'supply', '4.     Require requisitions for this change to occur?'),
(50, 'supply', '5.     Require major equipment purchase?'),
(51, 'supply', '6.     Has a cost analysis been completed?'),
(52, 'supply', '7.     Require any new stock to be included in the store inventory?'),
(53, 'srd', '1.     Influence future Social Impact Assessments?'),
(54, 'srd', '2.     Affect Human Rights awareness?'),
(55, 'srd', '3.     Affect local community investment?'),
(56, 'srd', '4.     Affect local employment and business support?'),
(57, 'srd', '5.     Affect indigenous employment and business support?'),
(58, 'srd', '6.     Affect management of culturally significant and religious sites?'),
(59, 'srd', '7.     Affect external permitting and permissions?'),
(60, 'srd', '8.     Affect Government relations?'),
(61, 'srd', '9.     Be a concern to the community?'),
(62, 'srd', '10.   Impact negatively on the community?'),
(63, 'srd', '11.   Affect media relations?'),
(64, 'srd', '12.   Create potential opportunity for activist critics?'),
(65, 'srd', '13.   Affect investor relations (non-media)?'),
(66, 'mining', '1.     Affect digger availability, productivity and/ or performance?'),
(67, 'mining', '2.     Affect truck availability, productivity and/ or performance?'),
(68, 'mining', '3.     Affect drill availability, productivity and/ or performance?'),
(69, 'mining', '4.     Affect personnel availability and/ or productivity?'),
(70, 'mining', '5.     Affect equipment/ vehicle interaction?'),
(71, 'mining', '6.     Affect part or equipment longevity?'),
(72, 'mining', '7.     Cause an increase in consumable use and/ or costs?'),
(73, 'mining', '8.     Affect overall daily production in terms of tonnes, mine grade and/ or development?'),
(74, 'mining', '9.     Affect shifts and/ or shift time management?'),
(75, 'mining', '10.   Affect use of major equipment?'),
(76, 'mining', '11.   Affect drill and blast?'),
(77, 'mining', '12.   Affect pit wall control and/ or pit wall control management?'),
(78, 'mining', '13.   Affect void control and/ or void control management?'),
(79, 'mining', '14.   Affect short, mid and/ or long term planning?'),
(80, 'mining', '15.   Affect cycle time and/ or cycle time management?'),
(81, 'mining', '16.   Affect or require update of any measurement or tracking systems?'),
(82, 'engineering', '1.     Affect any engineering specifications?'),
(83, 'engineering', '2.     Affect other maintenance objectives?'),
(84, 'engineering', '3.     Affect current strategic maintenance plans including KPIs?'),
(85, 'engineering', '4.     Affect processes in place to monitor the maintenance plan and associated KPIs?'),
(86, 'engineering', '5.     Affect individual responsibilities within the maintenance plan?'),
(87, 'engineering', '6.     Affect recording and tracking of total direct and indirect cost of maintenance?'),
(88, 'engineering', '7.     Affect scheduling/ implementation/ recording/ tracking of maintenance activities?'),
(89, 'engineering', '8.     Affect equipment performance or reliability?'),
(90, 'engineering', '9.     Affect formal periodic equipment inspection system currently in place?'),
(91, 'engineering', '10.   Affect routine lubrication program in place?'),
(92, 'engineering', '11.   Require the establishment of alert and danger limits for equipment operating parameters (e.g bearing vibration alerts?'),
(93, 'engineering', '12.   Affect equipment specifications or service manuals?'),
(94, 'engineering', '13.   Affect parts and resource needs?'),
(95, 'engineering', '14.   Affect code requirements and standards?'),
(96, 'engineering', '15.   Affect agreements with the parts or equipment supplier or dealer?'),
(97, 'engineering', '16.   Require spare parts to be regularly maintained?'),
(98, 'engineering', '17.   Require a rebuilding program to be scheduled?'),
(99, 'engineering', '18.   Require additional supervision when carrying out tasks associated with change?'),
(100, 'engineering', '19.   Affect a current documented job analyses or similar administrative procedure?'),
(101, 'engineering', '20.   Require the organization of training of personnel who will be carrying out associated tasks?'),
(102, 'engineering', '21.   Require any training conducted be recorded and tracked?'),
(103, 'engineering', '22.   Affect current audit systems to monitor safety, quality, productivity or reliability?'),
(104, 'engineering', '23.   Affect the computerized maintenance management system?'),
(105, 'engineering', '24.   Require maintenance plan to be updated?'),
(106, 'engineering', '25.   Require isolation permit requirements or any other workplace interruptions?'),
(107, 'engineering', '26.   Affect or require updates to any drawings and/ or plans or other controlled documents?'),
(108, 'engineering', '27.   Affect contracted personnel currently employed?'),
(109, 'engineering', '28.   Affect our energy and greenhouse gas emission targets or commitments?'),
(110, 'engineering', '29.   Require an energy assessment to identify opportunities for associated energy savings?'),
(111, 'engineering', '30.   Create or deny opportunities for energy savings?'),
(112, 'engineering', '31.   Affect our energy assessment (budget)?'),
(113, 'engineering', '32.   Require power factors to be known?'),
(114, 'engineering', '33.   Include considerations of peak load times?'),
(115, 'processing', '1.     Include consideration of optimization of cost and availability of spare parts?'),
(116, 'processing', '2.     Influence metallurgical tracking, balancing and/ or accounting, including reconciliation?'),
(117, 'processing', '3.     Affect processing KPIs?'),
(118, 'processing', '4.     Decrease the maintainability of existing plant, equipment and/ or infrastructure?'),
(119, 'processing', '5.     Decrease the operability of existing plant, equipment and/ or infrastructure?'),
(120, 'processing', '6.     Influence and/ or need to be considered in production planning?'),
(121, 'processing', '7.     Include a post commissioning review planned after implementation?'),
(122, 'processing', '8.     Require setting of associated operational boundaries and/ or limits and can they be easily adhered to?'),
(123, 'processing', '9.     Affect tailing storage facility management?'),
(124, 'processing', '10.   Affect cyanide management, including transport, storage and/ or use?'),
(125, 'processing', '11.   Affect the availability of overhead crane and/ or other specialty equipment?'),
(126, 'processing', '12.   Affect mill circuit power and/ throughput?'),
(127, 'processing', '13.   Affect mill circuit configuration including optimizations of mine to mill processes?'),
(128, 'processing', '14.   Affect mineralogy control including grind, recovery and feed relationships?'),
(129, 'processing', '15.   Affect process control including equipment/ plant failure minimizations?'),
(130, 'processing', '16.   Affect isolation permit requirements or any other workplace interruptions?'),
(131, 'hr', '1.     Affect employee moral and morale?'),
(132, 'hr', '2.     Affect employee welfare?'),
(133, 'hr', '3.     Require employee consultation and cooperation?'),
(134, 'hr', '4.     Affect the implementation of the labour and/ or other laws/ regulations?'),
(135, 'hr', '5.     Affect current documented policies and procedures?'),
(136, 'hr', '6.     Affect current budget/ resources available for managing the human resource?'),
(137, 'security', '1.     Affects compliance with the Nzema Gold Operations Gold Security Standards?'),
(138, 'security', '2.     Affects compliance with the Nzema Gold Operations Fuel Security Standards?'),
(139, 'security', '3.     Affects compliance with the Nzema Gold Operations Explosives Security Standards?'),
(140, 'security', '4.     Affects compliance with the Nzema Gold Operations Security Policies?'),
(141, 'security', '5.     Affects compliance with the voluntary principles of security and human rights?'),
(142, 'security', '6.     Create opportunities for illegal mining?'),
(143, 'security', '7.     Create opportunities for trespassing?'),
(144, 'security', '8.     Facilitate theft?'),
(145, 'security', '9.     Create opportunities for fraud?'),
(146, 'security', '10.   Require exemption from any Nzema Gold Operations Security Standard?'),
(147, 'security', '11.   Require changes to any existing security process?'),
(148, 'security', '12.   Require changes to any existing security procedure?'),
(149, 'security', '13.   Require changes to any existing security plan?'),
(150, 'security', '14.   Require additional security staff?'),
(151, 'security', '15.   Require additional security equipment?'),
(152, 'security', '16.   Require changes to security perimeter fencing?'),
(153, 'security', '17.   Require new fencing?'),
(154, 'security', '18.   Require changes to or a new access gates?'),
(155, 'security', '19.   Require additional CCTV monitoring equipment?'),
(156, 'security', '20.   Require additional Access Control equipment?'),
(157, 'security', '21.   Require additional Intrusion Alarm equipment?'),
(158, 'security', '22.   Require additional lighting?'),
(159, 'finance', '1.     Affect any general ledger accounts?'),
(160, 'finance', '2.     Affect IT financial systems i.e. SUN, PRONTO etc?'),
(161, 'finance', '3.     Be driven by an external financial regulation?'),
(162, 'finance', '4.     Affects compliance with Persol requirements?'),
(163, 'finance', '5.     Affects internal controls over financial reporting?'),
(164, 'finance', '6.     Affects finance business process standards?'),
(165, 'finance', '7.     Affects budgets, forecasts or life of mine plan?'),
(166, 'finance', '8.     Require additional financial/ accounting resources or relocation of existing financial/ accounting resources?'),
(167, 'finance', '9.     Affects financial KPIs such as cash cost, profit-before- tax, etc?'),
(168, 'finance', '10.   Affect key external/ internal financial reporting dates and milestones?'),
(169, 'finance', '11.   Lead to risk of fraud or error in financial statements, amounts and assumptions?'),
(170, 'finance', '12.   Require additional/ new training on financial/ accounting concepts?'),
(171, 'finance', '13.   Be driven by a recent financial audit (internal/ external)'),
(172, 'finance', '14.   Affect finance/ accounting roles and responsibilities, job descriptions, etc.?'),
(173, 'finance', '15.   Lead to changes in chart of accounts mapping?'),
(174, 'finance', '16.   Require reporting change to insurer?'),
(175, 'finance', '17.   Affect property insurance coverage?'),
(176, 'finance', '18.   Affect policy limits/ sub-limits?'),
(177, 'finance', '19.   Affect deductibles/ retentions?'),
(178, 'finance', '20.   Affect insurance premiums?'),
(179, 'finance', '21.   Affect regional insurance cost?'),
(180, 'finance', '22.   Affect global insurance cost?'),
(181, 'finance', '23.   Require follow-up with mine site?'),
(182, 'finance', '24.   Affect fire protection equipment/ overall system?'),
(183, 'finance', '25.   Affect corporate/ regional/ mine site liability?'),
(184, 'finance', '26.   Affect any global insurance policy (crime, liability, marine cargo, etc)'),
(185, 'it', '1.     Require additional IT software?'),
(186, 'it', '2.     Require additional IT hardware?'),
(187, 'it', '3.     Affect network transmission?'),
(188, 'it', '4.     Require additional backup system?'),
(189, 'it', '5.     Affect the server capacity?'),
(190, 'it', '6.     Affect any external licensing?'),
(191, 'it', '7.     Require training of personnel?'),
(192, 'it', '8.     Affect the transmitting bandwidth?'),
(193, 'geology', '1.     Affect vehicle availability, productivity and/ or performance?'),
(194, 'geology', '2.     Affect drill availability, productivity and/ or performance?'),
(195, 'geology', '3.     Affect personnel availability and/ or productivity?'),
(196, 'geology', '4.     Affect equipment/ vehicle interaction?'),
(197, 'geology', '5.     Affect part of equipment longevity?'),
(198, 'geology', '6.     Cause an increase in consumable use and/ or costs?'),
(199, 'geology', '7.     Affect current emergency response/ contingency plan?'),
(200, 'geology', '8.     Affect drill pad construction or design?'),
(201, 'geology', '9.     Affect use of major equipment?'),
(202, 'geology', '10.   Affect core logging activities?'),
(203, 'geology', '11.   Affect mapping activities?'),
(204, 'geology', '12.   Affect or require updates to any drawings and/ or plans or other controlled documents?'),
(205, 'geology', '13.   Require added training of affected personnel?'),
(206, 'geology', '14.   Require isolation permit requirements or any other workplace interruptions?'),
(207, 'geology', '15.   Affect contracted personnel currently employed?');

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
-- Table structure for table `review_group`
--

CREATE TABLE `review_group` (
  `review_group_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
(10, 'ss31', 'Peter', 'John Ahnnigan', '', 'General Manager', 'pjhannigan@adamusgh.com', 'no_profile.jpg', 'General Manager', '2017-11-01', '0231234567', NULL, NULL, 'Management', NULL, NULL, NULL),
(11, 'ss32', 'Anthony', 'Nyamekye', '', 'Manager', 'anyamekye@adamusgh.com', 'no_profile.jpg', 'Process Manager', '2016-12-04', '0231234567', NULL, NULL, 'Management', 13, NULL, NULL);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `bf_user_uuid` BEFORE INSERT ON `users` FOR EACH ROW SET New.uuid = HEX(AES_ENCRYPT(New.user_id, MD5('my-private-key-daemon')))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_leave_entitlements`
--

CREATE TABLE `users_leave_entitlements` (
  `id_` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `earning_policy_id` int(11) NOT NULL,
  `entitled` int(11) NOT NULL,
  `earned` int(11) NOT NULL DEFAULT 0,
  `taken` int(11) NOT NULL DEFAULT 0,
  `balance` int(11) NOT NULL DEFAULT 0,
  `applied` int(11) NOT NULL DEFAULT 0,
  `carried_forward` int(11) NOT NULL DEFAULT 0,
  `valid_until` date NOT NULL,
  `earning_start` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users_leave_entitlements`
--

INSERT INTO `users_leave_entitlements` (`id_`, `leave_type_id`, `earning_policy_id`, `entitled`, `earned`, `taken`, `balance`, `applied`, `carried_forward`, `valid_until`, `earning_start`, `user_id`) VALUES
(1, 1, 1, 12, 0, 0, 12, 1, 0, '2018-09-19', '2018-09-18', 16);

-- --------------------------------------------------------

--
-- Table structure for table `workday_scheme`
--

CREATE TABLE `workday_scheme` (
  `id_` int(11) NOT NULL,
  `workday_scheme_name` varchar(30) NOT NULL,
  `description` text DEFAULT NULL,
  `scheme` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workday_scheme`
--

INSERT INTO `workday_scheme` (`id_`, `workday_scheme_name`, `description`, `scheme`) VALUES
(1, 'five-two', 'Weekdays are workdays and weekends are off-days.', '0,1,1,1,1,1,0');

-- --------------------------------------------------------

--
-- Table structure for table `workflow`
--

CREATE TABLE `workflow` (
  `id_` int(11) NOT NULL,
  `workflow_name` varchar(30) NOT NULL,
  `workflow_code` varchar(15) NOT NULL,
  `created_on` datetime NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workflow`
--

INSERT INTO `workflow` (`id_`, `workflow_name`, `workflow_code`, `created_on`, `description`) VALUES
(1, 'Default', 'DEF', '2018-09-16 11:57:41', 'Default leave approval workflow. First approver: Head of Department. \r\nSecond approver: HR Manager');

--
-- Triggers `workflow`
--
DELIMITER $$
CREATE TRIGGER `workflow_created_on` BEFORE INSERT ON `workflow` FOR EACH ROW set new.`created_on` = now()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affected_dept`
--
ALTER TABLE `affected_dept`
  ADD PRIMARY KEY (`affected_dept_id`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`autdit_id`);

--
-- Indexes for table `cms_action_list`
--
ALTER TABLE `cms_action_list`
  ADD PRIMARY KEY (`cms_action_list_id`);

--
-- Indexes for table `cms_email`
--
ALTER TABLE `cms_email`
  ADD PRIMARY KEY (`email_id`);

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
  ADD PRIMARY KEY (`cms_impact_response_id`),
  ADD UNIQUE KEY `cms_impact_response_id` (`cms_impact_response_id`,`cms_form_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department` (`department`);

--
-- Indexes for table `department_approvers`
--
ALTER TABLE `department_approvers`
  ADD PRIMARY KEY (`department_approver_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`department_id`) USING BTREE;

--
-- Indexes for table `earning_policy`
--
ALTER TABLE `earning_policy`
  ADD PRIMARY KEY (`id_`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id_`);

--
-- Indexes for table `hr_approvers`
--
ALTER TABLE `hr_approvers`
  ADD PRIMARY KEY (`hr_approver_id`);

--
-- Indexes for table `impact_assessment`
--
ALTER TABLE `impact_assessment`
  ADD PRIMARY KEY (`impact_assessment_id`);

--
-- Indexes for table `leave_approval_status`
--
ALTER TABLE `leave_approval_status`
  ADD PRIMARY KEY (`leave_approval_status_id`);

--
-- Indexes for table `leave_entitlements`
--
ALTER TABLE `leave_entitlements`
  ADD PRIMARY KEY (`leave_entitlement_id`),
  ADD UNIQUE KEY `user_id_leave_type_id` (`user_id`,`leave_type_id`) USING BTREE;

--
-- Indexes for table `leave_entitlements_import`
--
ALTER TABLE `leave_entitlements_import`
  ADD UNIQUE KEY `staff_id` (`staff_id`,`leave_type`);

--
-- Indexes for table `leave_entitlements_old`
--
ALTER TABLE `leave_entitlements_old`
  ADD PRIMARY KEY (`id_`),
  ADD UNIQUE KEY `leave_type_id` (`leave_type_id`,`staff_id`) USING BTREE;

--
-- Indexes for table `leave_remarks`
--
ALTER TABLE `leave_remarks`
  ADD PRIMARY KEY (`leave_remarks_id`);

--
-- Indexes for table `leave_review_history`
--
ALTER TABLE `leave_review_history`
  ADD PRIMARY KEY (`leave_review_history_id`);

--
-- Indexes for table `leave_transaction`
--
ALTER TABLE `leave_transaction`
  ADD PRIMARY KEY (`leave_transaction_id`);

--
-- Indexes for table `leave_transaction_summary`
--
ALTER TABLE `leave_transaction_summary`
  ADD PRIMARY KEY (`leave_transaction_summary_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`leave_type_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`manager_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`password_reset_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `question_import`
--
ALTER TABLE `question_import`
  ADD PRIMARY KEY (`impact_question_id`);

--
-- Indexes for table `review_group`
--
ALTER TABLE `review_group`
  ADD PRIMARY KEY (`review_group_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- Indexes for table `users_leave_entitlements`
--
ALTER TABLE `users_leave_entitlements`
  ADD PRIMARY KEY (`id_`);

--
-- Indexes for table `workday_scheme`
--
ALTER TABLE `workday_scheme`
  ADD PRIMARY KEY (`id_`);

--
-- Indexes for table `workflow`
--
ALTER TABLE `workflow`
  ADD PRIMARY KEY (`id_`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affected_dept`
--
ALTER TABLE `affected_dept`
  MODIFY `affected_dept_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `autdit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cms_action_list`
--
ALTER TABLE `cms_action_list`
  MODIFY `cms_action_list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_email`
--
ALTER TABLE `cms_email`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `cms_form`
--
ALTER TABLE `cms_form`
  MODIFY `cms_form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cms_impact_question`
--
ALTER TABLE `cms_impact_question`
  MODIFY `cms_impact_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `cms_impact_response`
--
ALTER TABLE `cms_impact_response`
  MODIFY `cms_impact_response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `department_approvers`
--
ALTER TABLE `department_approvers`
  MODIFY `department_approver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `earning_policy`
--
ALTER TABLE `earning_policy`
  MODIFY `id_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `hr_approvers`
--
ALTER TABLE `hr_approvers`
  MODIFY `hr_approver_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `impact_assessment`
--
ALTER TABLE `impact_assessment`
  MODIFY `impact_assessment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_entitlements`
--
ALTER TABLE `leave_entitlements`
  MODIFY `leave_entitlement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `leave_entitlements_old`
--
ALTER TABLE `leave_entitlements_old`
  MODIFY `id_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leave_remarks`
--
ALTER TABLE `leave_remarks`
  MODIFY `leave_remarks_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_review_history`
--
ALTER TABLE `leave_review_history`
  MODIFY `leave_review_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leave_transaction`
--
ALTER TABLE `leave_transaction`
  MODIFY `leave_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leave_transaction_summary`
--
ALTER TABLE `leave_transaction_summary`
  MODIFY `leave_transaction_summary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `leave_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `password_reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `question_import`
--
ALTER TABLE `question_import`
  MODIFY `impact_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `review_group`
--
ALTER TABLE `review_group`
  MODIFY `review_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users_leave_entitlements`
--
ALTER TABLE `users_leave_entitlements`
  MODIFY `id_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `workday_scheme`
--
ALTER TABLE `workday_scheme`
  MODIFY `id_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `workflow`
--
ALTER TABLE `workflow`
  MODIFY `id_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
