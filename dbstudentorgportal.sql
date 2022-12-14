-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2022 at 01:12 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbstudentorgportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `ADMIN_ID` int(2) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `MIDDLE_INITIAL` char(2) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(60) NOT NULL,
  `USERTYPE_ID` int(3) DEFAULT NULL,
  `ACCOUNT_CREATED` date DEFAULT NULL,
  `PROFILE_PIC` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`ADMIN_ID`, `FIRST_NAME`, `LAST_NAME`, `MIDDLE_INITIAL`, `EMAIL`, `PASSWORD`, `USERTYPE_ID`, `ACCOUNT_CREATED`, `PROFILE_PIC`) VALUES
(1, 'John', 'Doe', '', 'john.doe@jru.edu', '7c222fb2927d828af22f592134e8932480637c0d', NULL, NULL, 'img_avatar.png'),
(32323232, 'Michael', 'Scott', '', 'michael.scott@my.jru.edu', 'c5bcb280184841e400abbdc40cf83d9959cf7bc4', NULL, NULL, 'img_avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin_archive`
--

CREATE TABLE `tb_admin_archive` (
  `ADMIN_ID` int(2) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `MIDDLE_INITIAL` char(2) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(60) NOT NULL,
  `USERTYPE_ID` int(3) DEFAULT NULL,
  `ACCOUNT_CREATED` date DEFAULT NULL,
  `PROFILE_PIC` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin_archive`
--

INSERT INTO `tb_admin_archive` (`ADMIN_ID`, `FIRST_NAME`, `LAST_NAME`, `MIDDLE_INITIAL`, `EMAIL`, `PASSWORD`, `USERTYPE_ID`, `ACCOUNT_CREATED`, `PROFILE_PIC`) VALUES
(21212121, 'Joseph', 'Joestar', '', 'joseph.joestar@my.jru.edu', 'c5bcb280184841e400abbdc40cf83d9959cf7bc4', NULL, NULL, 'img_avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_approval_type`
--

CREATE TABLE `tb_approval_type` (
  `approval_id` int(2) NOT NULL,
  `approval_pos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_approval_type`
--

INSERT INTO `tb_approval_type` (`approval_id`, `approval_pos`) VALUES
(1, 'Adviser'),
(2, 'Chair'),
(3, 'Dean'),
(4, 'SDO'),
(5, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tb_budget_codes`
--

CREATE TABLE `tb_budget_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_budget_codes`
--

INSERT INTO `tb_budget_codes` (`id`, `code`, `description`) VALUES
(1, '01', 'Transporation'),
(2, '02', 'Utilities'),
(3, '03', 'Food and Beverage'),
(4, '04', 'Talent Fees'),
(5, '05', 'Miscellaneous');

-- --------------------------------------------------------

--
-- Table structure for table `tb_budget_codes_archive`
--

CREATE TABLE `tb_budget_codes_archive` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_candidate`
--

CREATE TABLE `tb_candidate` (
  `CANDIDATE_ID` int(11) NOT NULL,
  `ELECTION_ID` int(11) NOT NULL,
  `POSITION_ID` int(2) DEFAULT NULL,
  `STUDENT_NO` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_candidate`
--

INSERT INTO `tb_candidate` (`CANDIDATE_ID`, `ELECTION_ID`, `POSITION_ID`, `STUDENT_NO`) VALUES
(10, 3, 12, 19255532),
(17, 13, 2, 19255570),
(19, 11, 5, 19255570),
(26, 12, 3, 19255532),
(27, 12, 3, 19255570),
(32, 16, 2, 19255515),
(33, 16, 2, 19255570),
(34, 16, 4, 19255540),
(36, 17, 2, 19255531),
(37, 17, 3, 19255532),
(38, 17, 4, 19255533),
(39, 17, 5, 19255570),
(41, 18, 2, 19255533),
(42, 18, 3, 19255515),
(43, 18, 4, 19255570),
(44, 18, 5, 19255540),
(45, 19, 1, 19255532),
(46, 19, 1, 19255531),
(47, 19, 2, 19255533),
(48, 19, 2, 19255515);

-- --------------------------------------------------------

--
-- Table structure for table `tb_collegedept`
--

CREATE TABLE `tb_collegedept` (
  `college_id` int(11) NOT NULL,
  `college` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_collegedept`
--

INSERT INTO `tb_collegedept` (`college_id`, `college`) VALUES
(1, 'College of Liberal Arts, Education and Psychology'),
(2, 'College of Business Administration and Accountancy'),
(3, 'College of Computer Studies and Engineering'),
(4, 'College of Hospitality and Tourism Management'),
(5, 'College of Nursing and Health Sciences'),
(6, 'College of Criminal Justice Education');

-- --------------------------------------------------------

--
-- Table structure for table `tb_collegedept_archive`
--

CREATE TABLE `tb_collegedept_archive` (
  `college_id` int(11) DEFAULT NULL,
  `college` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_course`
--

CREATE TABLE `tb_course` (
  `course_id` int(2) NOT NULL,
  `course` varchar(150) NOT NULL,
  `college_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_course`
--

INSERT INTO `tb_course` (`course_id`, `course`, `college_id`) VALUES
(1, 'Bachelor of Arts (AB) Major in Economics', 1),
(2, 'Bachelor of Arts (AB) Major in English', 1),
(3, 'Bachelor of Arts (AB) Major in History', 1),
(4, 'Bachelor of Arts (AB) Major in Mathematics', 1),
(5, 'Bachelor of Arts in Psychology (ABPsy)', 1),
(6, 'Bachelor of Science in Psychology (BSPsy)', 1),
(7, 'Bachelor of Science in Criminology (BSCrim)', 6),
(8, 'Bachelor of Secondary Education (BSED) Major in English', 1),
(9, 'Bachelor of Secondary Education (BSED) Major in Mathematics', 1),
(10, 'Bachelor of Secondary Education (BSED) Major in Social Studies', 1),
(11, 'Bachelor of Elementary Education (BEED)', 1),
(12, 'Certificate in Teaching Education (CTE)', 1),
(13, 'Bachelor of Science in Accountancy (BSA)', 2),
(14, 'Bachelor of Science in Business Administration (BSBA) Major in Accounting', 2),
(15, 'Bachelor of Science in Business Administration (BSBA) Major in Banking and Finance', 2),
(16, 'Bachelor of Science in Business Administration (BSBA) Major in Computer Science', 2),
(17, 'Bachelor of Science in Business Administration (BSBA) Major in Economics', 2),
(18, 'Bachelor of Science in Business Administration (BSBA) Major in Management', 2),
(19, 'Bachelor of Science in Business Administration (BSBA) Major in Marketing', 2),
(20, 'Bachelor of Science in Business Administration (BSBA) Major in Supply Management', 2),
(21, 'Bachelor of Science in Legal Management (BSLgM)', 2),
(22, 'Bachelor of Science in Computer Engineering (BSCpE)', 3),
(23, 'Bachelor of Science in Electronics Engineering (BSEcE)', 3),
(24, 'Bachelor of Science in Information Technology (BSIT)', 3),
(25, 'Bachelor of Science in Information Technology (BSIT-BA) Major in Business Analytics', 3),
(26, 'Bachelor of Science in Entertainment and Multimedia Computing (BSEMC) Major in Digital Animation Technology', 3),
(27, 'Bachelor of Science in Information Technology (BSIT-AGD) Major in Animation and Game Development', 3),
(28, 'Bachelor of Science in Hospitality Management (BSHM)', 4),
(29, 'Bachelor of Science in Hospitality Management (BSHM – CM) Major in Cruise Management ', 4),
(30, 'Bachelor of Science in Tourism Management (BSTM)', 4),
(31, 'Bachelor of Science in Nursing (BSN)', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_course_archive`
--

CREATE TABLE `tb_course_archive` (
  `course_id` int(2) NOT NULL,
  `course` varchar(150) NOT NULL,
  `college_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc_groups`
--

CREATE TABLE `tb_disc_groups` (
  `group_id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `visibility` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_disc_groups`
--

INSERT INTO `tb_disc_groups` (`group_id`, `name`, `visibility`) VALUES
(1, 'General', 0),
(2, 'Discussions', 0),
(3, 'Officers Lounge', 2),
(4, 'Org Only', 5),
(5, 'Signatories', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc_replies`
--

CREATE TABLE `tb_disc_replies` (
  `reply_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(120) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `edited` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_disc_replies`
--

INSERT INTO `tb_disc_replies` (`reply_id`, `thread_id`, `user_type`, `user_id`, `user_name`, `message`, `status`, `edited`) VALUES
(1668058164, 1667473049, 2, 9, 'Trisha Pega', '<p>Sample replyssss</p>', 0, 1668058174),
(1668058191, 1667473049, 2, 9, 'Trisha Pega', '<p>Replyyyy</p>', -1, 0),
(1668605432, 1668419871, 1, 17401211, 'Bienvenido Legaspi', '<p>Test I\'m Yi Long Ma\'s</p>', 0, 1668606129),
(1668606515, 1668419871, 1, 17401211, 'Bienvenido Legaspi', '<p>I\'m Yi Long Ma\'s</p>', 0, 1668606563),
(1668668615, 1667467187, 0, 1, 'John Doe', '<p>Testing</p>', 1, 0),
(1669629646, 1669629640, 3, 19255562, 'Liza Reyes', '<p>Test reply</p>', 1, 1669629650);

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc_threads`
--

CREATE TABLE `tb_disc_threads` (
  `thread_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `views` int(11) NOT NULL,
  `replies` int(11) NOT NULL,
  `last_reply` int(11) NOT NULL,
  `last_reply_name` varchar(120) NOT NULL,
  `locked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_disc_threads`
--

INSERT INTO `tb_disc_threads` (`thread_id`, `topic_id`, `user_id`, `user_type`, `name`, `title`, `message`, `views`, `replies`, `last_reply`, `last_reply_name`, `locked`) VALUES
(1667467187, 1, 9, 2, 'Trisha Pega', 'Welcome to JRUSOP', '<p>Welcome to JRU Student Organizations Portal!</p>', 188, 2, 1668668615, 'John Doe', 0),
(1667472994, 2, 9, 2, 'Trisha Pega', 'Intro - Assistant Secretary', '<p>Hello my name is Trisha Pega, assistant secretary of JRU Computer Society</p>', 12, 0, 1667472994, 'Trisha Pega', 0),
(1667473049, 3, 9, 2, 'Trisha Pega', 'Does anyone like the new hyflex learning of JRU?', '<p>Personally, I like it</p>', 10, 3, 1668058191, 'Trisha Pega', 0),
(1667473091, 4, 9, 2, 'Trisha Pega', 'Activity Plans', '<p>Hello, I would like to ask the schedule of activity and plans on it</p>', 20, 0, 1667473091, 'Trisha Pega', 0),
(1667473129, 5, 9, 2, 'Trisha Pega', 'Meeting Schedule', '<p>May I know the next meeting schedule?</p>', 1, 0, 1667473129, 'Trisha Pega', 0),
(1667906308, 12, 13, 2, 'Candid Patrice Cataneda', 'Sample Title For the newly made New topic button', '<p>Sample Message below title</p>', 5, 1, 1667906358, 'Candid Patrice Cataneda', 0),
(1668419772, 0, 1, 0, 'John Doe', 'Sample', '<p>Test</p>', 1, 0, 1668419772, 'John Doe', 0),
(1668419871, 3, 1, 0, 'John Doe', 'Sample', '<p>Test</p>', 12, 2, 1668606515, 'Bienvenido Legaspi', 0),
(1669629640, 1, 19255562, 3, 'Liza Reyes', 'Test', '<p>Test Thread</p>', 23, 1, 1669629646, 'Liza Reyes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc_topics`
--

CREATE TABLE `tb_disc_topics` (
  `topic_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `org_id` int(11) NOT NULL,
  `visibility` int(11) NOT NULL,
  `icon` varchar(60) NOT NULL,
  `officers` text DEFAULT NULL,
  `members` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_disc_topics`
--

INSERT INTO `tb_disc_topics` (`topic_id`, `group_id`, `subject`, `description`, `org_id`, `visibility`, `icon`, `officers`, `members`) VALUES
(1, 1, 'Announcements', 'Latest announcements from JRU', 0, 0, 'bi bi-clipboard-fill', NULL, ''),
(2, 1, 'Introductions', 'New to the platform? Please stop by, say hi and tell us a bit about yourself.', 0, 0, 'bi bi-lightning-charge-fill', NULL, ''),
(3, 2, 'General Discussions', 'Talk about anything.', 0, 0, '', NULL, ''),
(4, 2, 'COMSOC Discussions only', 'COMSOC related discussions ', 12, 5, '', NULL, ''),
(5, 3, 'COMSOC Officers', 'For COMSOC Officers Only', 12, 2, '', NULL, ''),
(11, 4, 'Sample ComSoc Only', 'This thread is only available to ComSoc only!', 12, 5, 'bi bi-chat-square-dots-fill', NULL, ''),
(12, 1, 'Sample General Discussion ', 'New Topic Button testing!', 0, 0, 'bi bi-chat-square-dots-fill', NULL, ''),
(13, 2, 'Another Topic', 'asda sdasdsadsadsa', 12, 0, 'bi bi-megaphone-fill', '', ''),
(15, 1, 'Customized Topic Sample', 'safadssadsa', 12, 6, 'bi bi-chat-square-dots-fill', ';;5;;8;;9;;10;;11', ';;19255533;;19255570'),
(16, 4, 'Test', 'Test', 12, 0, 'bi bi-chat-square-dots-fill', NULL, NULL),
(17, 1, 'Test', 'Test', 12, 2, 'bi bi-chat-square-dots-fill', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_elections`
--

CREATE TABLE `tb_elections` (
  `ELECTION_ID` int(11) NOT NULL,
  `ELECTION_TYPE` int(11) NOT NULL,
  `ORG_ID` int(11) NOT NULL,
  `TITLE` varchar(120) NOT NULL,
  `DESCRIPTION` varchar(400) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_elections`
--

INSERT INTO `tb_elections` (`ELECTION_ID`, `ELECTION_TYPE`, `ORG_ID`, `TITLE`, `DESCRIPTION`, `START_DATE`, `END_DATE`) VALUES
(17, 1, 12, 'COMSOC Election Sample', 'A sample election', '2022-11-04', '2022-11-04'),
(18, 0, 0, 'CSC Elections', 'CSC elections', '2022-11-04', '2022-11-04'),
(19, 1, 12, 'asdzcvaxc', 'asdqweascaxc', '2022-11-15', '2022-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_elections_archive`
--

CREATE TABLE `tb_elections_archive` (
  `ELECTION_ID` int(11) NOT NULL,
  `ELECTION_TYPE` int(11) NOT NULL,
  `ORG_ID` int(11) NOT NULL,
  `TITLE` varchar(120) NOT NULL,
  `DESCRIPTION` varchar(400) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_elections_archive`
--

INSERT INTO `tb_elections_archive` (`ELECTION_ID`, `ELECTION_TYPE`, `ORG_ID`, `TITLE`, `DESCRIPTION`, `START_DATE`, `END_DATE`) VALUES
(8, 1, 12, 'rewrewrwe', 'werwererere', '2022-08-21', '2022-09-10'),
(9, 1, 12, 'asdsadsadsa', 'asdsadsadsa', '2022-10-31', '2022-11-10'),
(10, 1, 12, 'rewrewrwe', 'werwererere', '2022-08-21', '2022-09-10'),
(11, 0, 0, 'test soc', 'asdsadsa', '2022-10-23', '2022-11-02'),
(12, 1, 12, 'COMSOC Election', 'COMSOC Election asdsa dsadsa', '2022-10-26', '2022-11-11'),
(13, 1, 12, 'New Election Testing', 'sad sad asd saaaa', '2022-10-25', '2022-10-29'),
(14, 2, 16, 'Test', 'Test', '2022-10-27', '2022-10-28'),
(15, 2, 6, 'Test', 'Test', '2022-10-27', '2022-10-28'),
(16, 0, 0, 'SOC Election', 'asdasdsadsa', '2022-10-01', '2022-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notification`
--

CREATE TABLE `tb_notification` (
  `id` int(11) NOT NULL,
  `notif_id` int(11) NOT NULL,
  `receiver` varchar(30) NOT NULL,
  `direction` int(11) NOT NULL,
  `title` varchar(120) NOT NULL DEFAULT '',
  `message` varchar(255) NOT NULL DEFAULT '',
  `data` varchar(200) NOT NULL DEFAULT '',
  `is_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_notification`
--

INSERT INTO `tb_notification` (`id`, `notif_id`, `receiver`, `direction`, `title`, `message`, `data`, `is_read`) VALUES
(20, 1668061396, '19255532', 2, 'Feeding Program', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(21, 1668061396, '19255562', 1, 'Feeding Program', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(22, 1668061433, '19255532', 2, 'Feeding Program', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(23, 1668061433, '18202422', 1, 'Feeding Program', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(24, 1668061469, '19255532', 2, 'Feeding Program', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(25, 1668497781, '19255532', 2, 'COMSOC Esports Tryouts', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(26, 1668497781, '19255562', 1, 'COMSOC Esports Tryouts', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(27, 1668497821, '19255532', 2, 'COMSOC Esports Tryouts', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(28, 1668497821, '18202422', 1, 'COMSOC Esports Tryouts', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(29, 1668497886, '19255532', 2, 'COMSOC Esports Tryouts', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(31, 1668587725, '19255561', 1, 'Sample Proj 9', 'A new project has been created by Trisha Pega.', '', 0),
(32, 1668601710, '19255562', 1, 'Sample Proj 9', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(33, 1668601888, '19255532', 2, 'Sample Proj 9', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(34, 1668601888, '19255562', 1, 'Sample Proj 9', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(35, 1668602125, '19255532', 2, 'Sample Proj 9', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(36, 1668602125, '18202422', 1, 'Sample Proj 9', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(37, 1668602254, '19255532', 2, 'Sample Proj 9', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(38, 1669107524, '19255532', 2, 'COMSOC Esports Tryouts', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(39, 1669107524, '19255562', 1, 'COMSOC Esports Tryouts', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(40, 1669107854, '19255532', 2, 'COMSOC Esports Tryouts', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(41, 1669107854, '18202422', 1, 'COMSOC Esports Tryouts', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(42, 1669188154, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(43, 1669188154, '19255562', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(44, 1669215807, '19255532', 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(45, 1669215807, '19255562', 1, 'ComSoc Technology and Innovation Seminar Series', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(46, 1669216214, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(47, 1669216214, '19255562', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(48, 1669216501, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(49, 1669216501, '18202422', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(50, 1669216982, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(51, 1669216982, '19255562', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(52, 1669217623, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(53, 1669217623, '19255562', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(54, 1669217861, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(55, 1669217861, '18202422', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(56, 1669217920, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(57, 1669281996, '19255532', 2, 'COMSOC Esports Tryouts', 'Project has been rejected by the SDO.', 'officer-rejected.php', 1),
(58, 1669284233, '18202422', 1, 'ComSoc Technology and Innovation Seminar Series', 'Project is now requiring your approval.', 'signatory-rso-pending.php?=', 1),
(59, 1669284872, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(60, 1669284872, '18202422', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(61, 1669285435, '18202422', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=', 1),
(62, 1669285671, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(63, 1669285671, '19255562', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(64, 1669285766, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(65, 1669285766, '18202422', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(66, 1669285870, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(67, 1669286227, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(68, 1669286265, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(69, 1669286266, '18202422', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(70, 1669286298, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(71, 1669359982, '19255532', 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(72, 1669360351, '19255532', 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(73, 1669360367, '19255532', 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(74, 1669360367, '18202422', 1, 'ComSoc Technology and Innovation Seminar Series', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(75, 1669360395, '19255532', 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(76, 1669360715, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(77, 1669360715, '19202422', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(78, 1669360757, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(79, 1669360757, '19255562', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(80, 1669360785, '19255532', 2, 'COMSOC Acquaintance Event', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(81, 1669360785, '18202422', 1, 'COMSOC Acquaintance Event', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(84, 1669362665, '19255532', 2, 'Courtesy Call with VKF', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(85, 1669362665, '19202422', 1, 'Courtesy Call with VKF', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(86, 1669362685, '19255532', 2, 'Courtesy Call with VKF', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(87, 1669362685, '19255562', 1, 'Courtesy Call with VKF', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(88, 1669362704, '19255532', 2, 'Courtesy Call with VKF', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(89, 1669362704, '18202422', 1, 'Courtesy Call with VKF', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(90, 1669362765, '19255532', 2, 'Courtesy Call with VKF', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(91, 1669447960, '19123412', 1, 'Sample proj 11', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 1),
(92, 1669447960, '19255561', 1, 'Sample proj 11', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(93, 1669460355, '19255532', 2, 'Sample proj 11', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(94, 1669460355, '19202422', 1, 'Sample proj 11', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(95, 1669718277, '19255532', 2, 'Feeding Program', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(96, 1669718277, '19202422', 1, 'Feeding Program', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(97, 1669719672, '19255532', 2, 'Feeding Program', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(98, 1669719672, '19255562', 1, 'Feeding Program', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(99, 1669719709, '19255532', 2, 'Feeding Program', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(100, 1669719709, '18202422', 1, 'Feeding Program', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(101, 1669719740, '19255532', 2, 'Feeding Program', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(102, 1669720784, '19255532', 2, 'Sample proj 11', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(103, 1669720784, '19202422', 1, 'Sample proj 11', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(104, 1669860110, '19255532', 2, 'Sample proj 11', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(105, 1669860110, '19202422', 1, 'Sample proj 11', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(106, 1669860681, '19255532', 2, 'Sample proj 11', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(107, 1669860681, '19255562', 1, 'Sample proj 11', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(108, 1670416254, '19123412', 1, 'Sample 12', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 1),
(109, 1670416254, '19255561', 1, 'Sample 12', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(110, 1670416254, '17000000', 1, 'Sample 12', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_officers`
--

CREATE TABLE `tb_officers` (
  `student_id` int(255) DEFAULT NULL,
  `officer_id` int(2) NOT NULL,
  `position_id` int(2) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_initial` char(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `year_level` varchar(20) DEFAULT NULL,
  `college_dept` int(3) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(3000) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `user_type` int(3) DEFAULT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `account_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_officers`
--

INSERT INTO `tb_officers` (`student_id`, `officer_id`, `position_id`, `last_name`, `first_name`, `middle_initial`, `birthdate`, `age`, `gender`, `year_level`, `college_dept`, `course`, `section`, `email`, `password`, `org_id`, `user_type`, `profile_pic`, `bio`, `account_created`) VALUES
(17401211, 1, 1, 'Legaspi', 'Bienvenido', 'Argote', '2000-06-13', 22, 'Male', '4', NULL, 'Bachelor of Science in Information Technology (BSIT)', '402I', 'bienvenido.legaspiii@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 26, 2, 'img_avatar.png', NULL, '2022-11-10'),
(19255532, 9, 1, 'Pega', 'Trisha', '', '1999-07-09', 23, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'trisha.pega@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', 'COMSOC 2 years Assistant Secretary', '2022-10-13'),
(19255515, 11, 14, 'Ayala', 'Jose Ricardo', 'J', '1999-06-17', 23, 'Male', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'josericardo.ayala@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 22, 2, 'img_avatar.png', NULL, '2022-10-13'),
(19255570, 12, 13, 'Gabas', 'May Ann', 'G', '2000-06-05', 22, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'mayann.gabas@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 4, 2, 'img_avatar.png', NULL, '2022-10-13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_officers_archive`
--

CREATE TABLE `tb_officers_archive` (
  `student_id` int(255) DEFAULT NULL,
  `officer_id` int(2) NOT NULL,
  `position_id` int(2) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_initial` char(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `year_level` varchar(20) DEFAULT NULL,
  `college_dept` int(3) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(3000) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `user_type` int(3) DEFAULT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `account_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_orgs`
--

CREATE TABLE `tb_orgs` (
  `ORG_ID` int(2) NOT NULL,
  `ORG` varchar(100) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  `org_type_id` int(2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `school_year` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_orgs`
--

INSERT INTO `tb_orgs` (`ORG_ID`, `ORG`, `logo`, `college_id`, `org_type_id`, `status`, `school_year`) VALUES
(2, 'Criminal Justice Students Society (CJSS)', 'ACE(Crim).jpg', 1, 1, 'Active', '20222023'),
(4, 'Mathematics Society (MATHSOC)', 'ACE(Math).jpg', 1, 1, 'Active', '20222023'),
(5, 'Young Educators Society (YES)', 'ACE(Educ).jpg', 1, 1, 'Active', '20222023'),
(7, 'JRU Junior Philippine Institute of Accountants (JRUJPIA)', '25917-308840435_492133052957080_1473209234036732895_n.jpg', 2, 1, 'Active', '20222023'),
(8, 'Management Society (MANSOC)', 'BA(managemenrSoc).jpg', 2, 1, 'Active', '20222023'),
(9, 'Supply Management Society (SMS)', 'BA(supplyMan).jpg', 2, 1, 'Active', '20222023'),
(10, 'Young Marketers Association (YMA)', 'BA(YoungMarketers).jpg', 2, 1, 'Active', '20222023'),
(12, 'Computer Society (COMSOC)', 'COMSOC.png', 3, 1, 'Active', '20222023'),
(13, 'Electronics Engineering League (ECEL)', 'CSE(electronicEngLeague).jpg', 3, 1, 'Active', '20222023'),
(16, 'Nursing Society (NURSOC)', 'NursingSociety.jpg', 5, 1, 'Active', '20222023'),
(21, 'José Rizal University Chorale', '39594-69837-305286405_452918480192666_4126092082230211706_n.png', NULL, 2, 'Active', '20222023'),
(22, 'José Rizal University Dance Troupe', '38198-295836273_456060226528103_8150057512210938936_n.jpg', NULL, 2, 'Active', '20222023'),
(23, 'Teatro Rizal', '14253-6326-308524608_462635415908723_7930715657361904428_n.jpg', NULL, 2, 'Active', '20222023'),
(26, 'JRU Central Student Council (JRUCSC)', '78317-37120506_635634206821211_4687114667871436800_n.png', NULL, 2, 'Active', '20222023'),
(27, 'The Journal (JRUTJ)', '18274-55081-CSC(journal).jpg', NULL, 2, 'Active', '20222023'),
(28, 'Rizalian Psychological Society (JRURPS)', '13048-ACE(Psyc).jpg', 1, 1, 'Active', '20222023'),
(29, 'Institute of Computer Engineers of the Philippines Student Edition JRU Chapter (JRUICPEP)', '11287-CSE(InstituteComputerEng).jpg', 3, 1, 'Active', '20222023'),
(30, 'Pacific Asia Travel Association Philippines JRU Student Chapter (PATAPHJRUS)', '36453-41774-CHTM(PATA).jpg', 4, 1, 'Active', '20222023'),
(31, 'Hospitality Industry Future Professionals (JRUHTMHIFP)', '44899-66861-CHTM(hospitalityIndusaFutureProf).jpg', 4, 1, 'Active', '20222023'),
(32, 'JRU Every Nation Campus (JRUENC)', '35891-79972-306727765_466707115501723_4328831352481019239_n.png', NULL, 2, 'Active', '20222023'),
(33, 'Rizalian Esports League (REL)', '86633-19227-296848672_104341519044187_518183436891479407_n.png', NULL, 2, 'Active', '20222023'),
(34, 'Liberal Arts Society (LAS)', '18485-308840435_492133052957080_1473209234036732895_n.jpg', 1, 1, 'Active', '20222023'),
(35, 'Sample Acad', 'jrusop-logo2.png', NULL, 1, 'Active', '20222023'),
(36, 'Sample Non Acad', 'jrusop-logo2.png', NULL, 2, 'Active', '20222023');

-- --------------------------------------------------------

--
-- Table structure for table `tb_orgs_archive`
--

CREATE TABLE `tb_orgs_archive` (
  `ORG_ID` int(2) NOT NULL,
  `ORG` varchar(100) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  `org_type_id` int(2) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `school_year` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_org_application`
--

CREATE TABLE `tb_org_application` (
  `org_req_id` int(11) NOT NULL,
  `org_name` varchar(200) DEFAULT NULL,
  `org_type` int(50) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `school_year` varchar(20) DEFAULT NULL,
  `requirements` varchar(300) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `requested_by` varchar(100) DEFAULT NULL,
  `date_requested` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_org_application`
--

INSERT INTO `tb_org_application` (`org_req_id`, `org_name`, `org_type`, `state`, `school_year`, `requirements`, `status`, `requested_by`, `date_requested`) VALUES
(7, 'Sample Acad', 1, 'Renewal', '20222023', '60996-11250-eventproposalforms.rar', 'Approved', 'Bienvenido Legaspi', '2022-11-24'),
(8, 'Sample Non Acad', 2, 'New', '20222023', '69539-favicon_io (1).rar', 'Approved', 'Bienvenido Legaspi', '2022-11-24'),
(9, 'Officer Sample Acad', 1, 'New', '20222023', '40591-11250-eventproposalforms.rar', 'Pending', 'Trisha Pega', '2022-11-25'),
(10, 'Officer Sample Non Acad', 2, 'Renewal', '20222023', '45744-favicon_io (1).rar', 'Pending', 'Trisha Pega', '2022-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_org_type`
--

CREATE TABLE `tb_org_type` (
  `org_type_id` int(2) NOT NULL,
  `org_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_org_type`
--

INSERT INTO `tb_org_type` (`org_type_id`, `org_type`) VALUES
(1, 'Academic'),
(2, 'Non-Academic');

-- --------------------------------------------------------

--
-- Table structure for table `tb_position`
--

CREATE TABLE `tb_position` (
  `POSITION_ID` int(2) NOT NULL,
  `position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_position`
--

INSERT INTO `tb_position` (`POSITION_ID`, `position`) VALUES
(1, 'President'),
(2, 'Vice President - Internal'),
(3, 'Vice President - External'),
(4, 'Secretary'),
(5, 'Assistant Secretary'),
(6, 'Treasurer'),
(7, 'Auditor'),
(8, 'P.R.O'),
(9, 'P.R.O Internal'),
(10, 'P.R.O External'),
(11, 'Assistant P.R.O'),
(12, 'Business Manager'),
(13, 'Overall Chairman'),
(14, 'Overall Co-Chairman'),
(15, '1st Year Representative'),
(16, '2nd Year Representative'),
(17, '3rd Year Representative'),
(18, '4th Year Representative'),
(19, 'Musical Director/Conductor');

-- --------------------------------------------------------

--
-- Table structure for table `tb_position_archive`
--

CREATE TABLE `tb_position_archive` (
  `position_id` int(2) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_projectmonitoring`
--

CREATE TABLE `tb_projectmonitoring` (
  `project_id` varchar(500) NOT NULL,
  `position_id` int(3) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `requested_by` varchar(100) DEFAULT NULL,
  `organizer` varchar(200) DEFAULT NULL,
  `project_type` varchar(200) DEFAULT NULL,
  `project_category` varchar(200) DEFAULT NULL,
  `objectives` varchar(2000) DEFAULT NULL,
  `project_desc` varchar(500) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `venue` varchar(100) DEFAULT NULL,
  `participants` varchar(200) DEFAULT NULL,
  `no_of_participants` int(11) DEFAULT NULL,
  `beneficiary` varchar(200) DEFAULT NULL,
  `no_of_beneficiary` int(11) DEFAULT NULL,
  `budget_source` varchar(100) DEFAULT NULL,
  `estimated_budget` varchar(11) DEFAULT NULL,
  `budget_req` varchar(3000) DEFAULT NULL,
  `attachments` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `approval_id` int(2) DEFAULT NULL,
  `date_submitted` date DEFAULT NULL,
  `status_date` date DEFAULT NULL,
  `status_by` varchar(200) DEFAULT NULL,
  `remarks` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_projectmonitoring`
--

INSERT INTO `tb_projectmonitoring` (`project_id`, `position_id`, `org_id`, `college_id`, `project_name`, `requested_by`, `organizer`, `project_type`, `project_category`, `objectives`, `project_desc`, `start_date`, `end_date`, `venue`, `participants`, `no_of_participants`, `beneficiary`, `no_of_beneficiary`, `budget_source`, `estimated_budget`, `budget_req`, `attachments`, `status`, `approval_id`, `date_submitted`, `status_date`, `status_by`, `remarks`) VALUES
('1669447960-SY2022-2023', 1, 12, 3, 'Sample proj 11', 'Trisha Pega', 'ComSoc', 'Curricular', 'Onsite', 'Sample ', NULL, '2022-11-26 16:00:00', '2022-11-27 15:32:00', 'Quadrangle', 'Students', NULL, NULL, NULL, NULL, '100', 'Sample::100;;::', '28291-favicon_io (1).rar', 'Pending', 3, '2022-11-26', '2022-12-01', 'Chairperson Jane Doe', ''),
('1670416254-SY2022-2023', 1, 12, 3, 'Sample 12', 'Trisha Pega', 'Computer Society (COMSOC)', 'Extra Curricular', 'Onsite', 'Sample Obj', NULL, '2022-12-07 21:00:00', '2022-12-08 21:00:00', 'JRU Quadrangle', 'JRU Students', NULL, NULL, NULL, NULL, '3,000', '02::1000;;03::2000', '93980-favicon_io (1).rar', 'Pending', 1, '2022-12-07', '2022-12-07', NULL, NULL),
('54', 1, 12, 3, 'ESports', 'Trisha Pega', ' ', 'Extra Curricular', 'Onsite', 'For students to have fun', NULL, '2022-10-17 17:01:00', '2022-10-24 17:01:00', 'JRU Guadrangle ', 'Students', NULL, NULL, NULL, NULL, '2000', '1000 - cash prize\r\n1500 - Trophy\r\n500 - Banners', '13914-H_30908.pdf', 'Rejected', 1, '2022-10-13', '2022-11-03', NULL, 'Already been done.'),
('55', 1, 12, 3, 'CSE Week 2022', 'Trisha Pega', 'COMSOC', 'Curricular', 'Onsite', 'a fun week for students of Computer Science Engineering ', NULL, '2022-10-16 17:06:00', '2022-10-23 17:06:00', 'JRU Gymnasium ', 'All Students', NULL, NULL, NULL, NULL, '1500', '1000 - Decorations\r\n500 - Refreshments ', '13914-H_30908.pdf', 'Rejected', 1, '2022-10-13', '2022-11-03', NULL, 'Already been done'),
('56', 1, 12, 3, 'Feeding Program', 'Trisha Pega', 'COMSOC', 'Outreach', 'Onsite', 'To help malnourished kids', NULL, '2022-10-31 17:08:00', '2022-10-31 21:00:00', 'Kalentong St. ', 'Officers/Volunteer', NULL, NULL, NULL, NULL, '3300', 'food::3000;;fee::300', '10800-favicon_io (1).rar', 'Approved', 5, '2022-10-13', '2022-11-29', 'SDO John Doe', ''),
('60', 1, 12, 3, 'RSO Renewal', 'Trisha Pega', 'Comsoc officers', 'Other', 'Onsite', 'Application for RSO Renewal in coordination with SDO and CSC.', NULL, '2022-11-03 17:42:00', '2022-11-03 23:00:00', 'SDO Office', 'Comsoc officers', NULL, NULL, NULL, NULL, '1000', 'refreshments - 1000', '99172-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'Done', 5, '2022-11-03', '2022-11-03', NULL, 'approved'),
('61', 1, 12, 3, 'Mass Induction', 'Trisha Pega', 'JRU', 'Assembly', 'Onsite', 'Oath taking of all RSO officers', NULL, '2022-11-03 18:00:00', '2022-11-03 17:44:00', 'JRU Auditorium', 'RSO officers', NULL, NULL, NULL, NULL, '1000', '1000 - refreshments', '63785-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'Done', 5, '2022-11-03', '2022-11-03', NULL, 'approved'),
('62', 1, 12, 3, 'Freshmen Orientation and Pinning Ceremony', 'Trisha Pega', 'COMSOC', 'Assembly', 'Onsite', 'Face-to-Face and Back-to-Back Event', NULL, '2022-11-03 17:45:00', '2022-11-03 18:00:00', 'JRU Auditorium', 'freshmen and comsoc officers', NULL, NULL, NULL, NULL, '3000', '1000 - refreshments\r\n2000 - speaker', '28881-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'Done', 5, '2022-11-03', '2022-11-03', NULL, 'approved'),
('63', 1, 12, 3, 'ComSoc Technology and Innovation Seminar Series', 'Trisha Pega', 'COMSOC', 'Seminar', 'Onsite', 'Cyber Security Seminar', NULL, '2022-11-03 17:47:00', '2022-11-03 17:47:00', 'JRU Auditorium', 'COMSOC Members', NULL, NULL, NULL, NULL, '2500', '1000 - refreshments\r\n1500 - fees', '52619-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'Approved', 5, '2022-11-03', '2022-11-25', 'SDO John Doe', 'approved'),
('64', 1, 12, 3, 'ComSoc Rebranding: Logo Design Competition', 'Trisha Pega', 'COMSOC', 'Competition', 'Online', 'To promote ComSoc by rebranding the look and feel of the logo with a new visual identity', NULL, '2022-11-11 10:00:00', '2022-11-14 20:00:00', 'Zoom', 'Comsoc Members', NULL, NULL, NULL, NULL, '0', 'None', '29465-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'For Revision', 5, '2022-11-03', '2022-11-03', NULL, ''),
('68', 1, 12, 3, 'Courtesy Call with VKF', '', 'RSO Presidents with VKF', 'Assembly', 'Onsite', 'Courtesy Call of RSO Presidents with VKF to present the flagship activities.\r\n', NULL, '2022-11-10 18:02:00', '2022-11-20 18:02:00', 'JRU Quadrangle', ' RSO Presidents with VKF', NULL, NULL, NULL, NULL, '0', 'free ::0', '60343-11250-eventproposalforms.rar', 'Ongoing', 5, '2022-11-03', '2022-11-25', 'SDO John Doe', 'revise this'),
('69', 1, 12, 3, 'COMSOC Acquaintance Event', 'Trisha Pega', 'COMSOC', 'Socialization/Teambuilding', 'Online', 'Get to know comsoc officers and members', NULL, '2022-11-05 10:00:00', '2022-11-03 10:00:00', 'Zoom', 'Comsoc Members', NULL, NULL, NULL, NULL, '1500', 'online fees::1500', '26253-', 'Approved', 5, '2022-11-03', '2022-11-25', 'SDO John Doe', 'Revise date'),
('71', 1, 12, 3, 'COMSOC Coding Seminar', '', 'COMSOC and JPCS', 'Curricular', 'Online', 'Learn Coding with the help of the Junior Philippine Computer Society', NULL, '2022-11-08 10:00:00', '2022-11-09 18:00:00', 'Zoom', 'COMSOC members', NULL, NULL, NULL, NULL, '5000', '5000 - talent fee', '58412-', 'Reschedule', 1, '2022-11-03', '2022-11-08', NULL, 'Approved'),
('72', 5, 12, 3, 'COMSOC Esports Tryouts', 'Trisha Pega', 'COMSOC', 'Competition', 'Online', 'Tryout for esports comsoc edition', NULL, '2022-11-07 12:12:00', '2022-11-08 12:12:00', 'ZOOM', 'COMSOC Members', NULL, NULL, NULL, NULL, '5500', 'finance::5000;;Sample::500', '23659-11250-eventproposalforms.rar', 'Rejected', 1, '2022-11-04', '2022-11-24', 'SDO John Doe', ''),
('73', 5, 12, 3, 'Sample Proj 9', 'Trisha Pega', 'COMSOC', 'Assembly', 'Onsite', 'Sample obj proj 9', NULL, '2022-11-16 17:00:00', '2022-11-16 18:00:00', 'Quadrangle', 'Students', NULL, NULL, NULL, NULL, '2500', 'Snacks::500;;Umbrellas::2000', '32140-', 'Approved', 5, '2022-11-16', '2022-11-16', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project_logs`
--

CREATE TABLE `tb_project_logs` (
  `id` int(11) NOT NULL,
  `project_id` varchar(500) NOT NULL,
  `message` varchar(400) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_project_logs`
--

INSERT INTO `tb_project_logs` (`id`, `project_id`, `message`, `user_name`, `user_id`) VALUES
(1669719672, '56', '\'Feeding Program\' has been approved by the Chair.', 'Chairperson Jane Doe', 19202422),
(1669719709, '56', '\'Feeding Program\' has been approved by the Dean.', 'Dean Liza Reyes', 19255562),
(1669719740, '56', '\'Feeding Program\' has been approved by the SDO.', 'SDO John Doe', 18202422),
(1669720784, '1669447960', '\'Sample proj 11\' has been approved by the adviser.', 'Adviser Emerson Flores', 19123412),
(1669815328, '0', '\'Sample 123123\' has been created and submitted.', 'Bienvenido Legaspi', 1),
(1669860110, '1669447960', '\'Sample proj 11\' has been approved by an adviser.', 'Adviser Emerson Flores', 19123412),
(1669860681, '1669447960', '\'Sample proj 11\' has been approved by the Chair.', 'Chairperson Jane Doe', 19202422),
(1670416254, '1670416254-SY2022-2023', '\'Sample 12\' has been created and submitted.', 'Trisha Pega', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_requests`
--

CREATE TABLE `tb_requests` (
  `req_id` bigint(20) NOT NULL,
  `org_id` int(2) DEFAULT NULL,
  `student_id` int(9) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `req_status` varchar(20) DEFAULT NULL,
  `date_submitted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_requests`
--

INSERT INTO `tb_requests` (`req_id`, `org_id`, `student_id`, `name`, `reason`, `req_status`, `date_submitted`) VALUES
(1, 21, 19255532, 'Trisha Pega', 'Test123123 asdasdasd', 'Deny', NULL),
(2, 12, 17401211, 'Bienvenido Legaspi', 'Something something org', 'Pending', '2022-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_signatories`
--

CREATE TABLE `tb_signatories` (
  `id` int(255) NOT NULL,
  `school_id` int(11) NOT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(8000) DEFAULT NULL,
  `usertype_id` int(3) DEFAULT NULL,
  `signatorytype_id` int(3) DEFAULT NULL,
  `college_dept` int(3) DEFAULT NULL,
  `org_id` int(3) DEFAULT NULL,
  `account_created` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profile_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_signatories`
--

INSERT INTO `tb_signatories` (`id`, `school_id`, `first_name`, `last_name`, `email`, `password`, `usertype_id`, `signatorytype_id`, `college_dept`, `org_id`, `account_created`, `bio`, `profile_pic`) VALUES
(1, 18202422, 'John', 'Doe', 'john.doe@jru.edu', '7c222fb2927d828af22f592134e8932480637c0d', 3, 1, NULL, NULL, '2022-10-26', NULL, 'img_avatar.png'),
(2, 19123412, 'Emerson', 'Flores', 'emerson.flores@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 4, 3, 12, '2022-10-26', 'Somewhat skill diff', 'img_avatar.png'),
(3, 19202422, 'Jane', 'Doe', 'jane.doe@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 3, 3, NULL, '2022-11-25', NULL, 'img_avatar.png'),
(4, 19255561, 'Jyr Marie', 'Reyes', 'jyrmarie.reyes@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 4, 3, 12, '2022-10-26', NULL, 'img_avatar.png'),
(5, 19255562, 'Liza', 'Reyes', 'liza.reyes@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 2, 3, NULL, '2022-10-26', NULL, 'img_avatar.png'),
(7, 17000000, 'Joe', 'Doe', 'joe.doe@.jru.edu', 'e6ab6e76850b0bb42818c18ce8db42759610422b', 3, 4, 3, 12, '2022-12-01', NULL, 'avatar-default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_signatories_archive`
--

CREATE TABLE `tb_signatories_archive` (
  `school_id` int(11) NOT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(8000) DEFAULT NULL,
  `signatory_type` varchar(100) DEFAULT NULL,
  `usertype_id` int(3) DEFAULT NULL,
  `signatorytype_id` int(3) DEFAULT NULL,
  `college_dept` int(3) DEFAULT NULL,
  `org_id` int(3) DEFAULT NULL,
  `account_created` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profile_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_signatories_archive`
--

INSERT INTO `tb_signatories_archive` (`school_id`, `first_name`, `last_name`, `email`, `password`, `signatory_type`, `usertype_id`, `signatorytype_id`, `college_dept`, `org_id`, `account_created`, `bio`, `profile_pic`) VALUES
(18202422, 'Jane', 'Doe', 'janedoe@jru.edu', '9ad92c6b402eeb3332550ffe00f3970820847d92', 'Adviser', 3, 3, NULL, NULL, NULL, NULL, 'img_avatar.png'),
(32232313, 'Lebron', 'James', 'lebron.james@my.jru.edu', 'c5bcb280184841e400abbdc40cf83d9959cf7bc4', 'SDO', 3, 1, NULL, NULL, NULL, NULL, 'img_avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_signatory_type`
--

CREATE TABLE `tb_signatory_type` (
  `signatory_id` int(3) NOT NULL,
  `signatory` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_signatory_type`
--

INSERT INTO `tb_signatory_type` (`signatory_id`, `signatory`) VALUES
(1, 'SDO'),
(2, 'Dean'),
(3, 'Chairperson'),
(4, 'Adviser');

-- --------------------------------------------------------

--
-- Table structure for table `tb_students`
--

CREATE TABLE `tb_students` (
  `ID` int(255) NOT NULL,
  `STUDENT_ID` int(11) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `MIDDLE_NAME` varchar(30) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `AGE` int(3) NOT NULL,
  `GENDER` varchar(7) NOT NULL,
  `YEAR_LEVEL` varchar(20) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `COLLEGE_DEPT` int(3) DEFAULT NULL,
  `COURSE` varchar(100) DEFAULT NULL,
  `SECTION` varchar(10) DEFAULT NULL,
  `MORG_ID` int(2) DEFAULT NULL,
  `ORG_ID` int(2) DEFAULT NULL,
  `ORG_IDS` varchar(200) DEFAULT NULL,
  `USER_TYPE` int(2) DEFAULT NULL,
  `ACCOUNT_CREATED` date DEFAULT NULL,
  `PROFILE_PIC` varchar(8000) DEFAULT NULL,
  `BIO` text DEFAULT NULL,
  `VCODE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_students`
--

INSERT INTO `tb_students` (`ID`, `STUDENT_ID`, `LAST_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `BIRTHDATE`, `AGE`, `GENDER`, `YEAR_LEVEL`, `EMAIL`, `PASSWORD`, `COLLEGE_DEPT`, `COURSE`, `SECTION`, `MORG_ID`, `ORG_ID`, `ORG_IDS`, `USER_TYPE`, `ACCOUNT_CREATED`, `PROFILE_PIC`, `BIO`, `VCODE`) VALUES
(1, 17401211, 'Legaspi', 'Bienvenido', 'Argote', '2000-06-13', 22, 'Male', '4', 'bienvenido.legaspiii@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 8, NULL, ',[24]', 2, '2022-10-19', 'img_avatar.png', 'My name is Bien, I am a COMSOC Member', ''),
(2, 18255530, 'Morales', 'Karlo Redeemer', 'R', '1995-03-20', 27, 'Male', '4', 'karloredeemer.morales@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 2, 'Bachelor of Arts (AB) Major in Economics', '401I', 6, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(3, 19255515, 'Ayala', 'Jose Ricardo', 'J', '1999-06-17', 23, 'Male', '4', 'josericardo.ayala@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(4, 19255531, 'Saludo', 'Troy', '', '1999-08-09', 23, 'Male', '4', 'troy.saludo@my.jru.edu', '7c222fb2927d828af22f592134e8932480637c0d', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '[23],[24]', 1, '2022-10-13', '45391-JRU Virtual Background 22_23 (3).jpg', NULL, ''),
(5, 19255532, 'Pega', 'Trisha', '', '1999-07-09', 23, 'Female', '4', 'trisha.pega@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-10-13', '90883-309216109_802196107715395_8902535727642330451_n.png', NULL, ''),
(6, 19255533, 'Distajo', 'Mikka', '', '2000-12-07', 21, 'Female', '4', 'mikka.distajo@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(7, 19255540, 'Cataneda', 'Candid Patrice', 'C', '2000-03-25', 22, 'Female', '4', 'candidpatrice.cataneda@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 5, 'Bachelor of Science in Nursing (BSN)', '401I', 16, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(8, 19255561, 'Carreros', 'Kean', 'V', '1999-11-27', 22, 'Male', '4', 'kean.carreros@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 1, 'Bachelor of Arts in Psychology (ABPsy)', '401I', 3, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(9, 19255570, 'Gabas', 'May Ann', 'G', '2000-06-05', 22, 'Female', '4', 'mayann.gabas@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(10, 20255530, 'Vizcarra', 'Ericka', 'R', '2000-09-03', 22, 'Female', '3', 'ericka.vizcarra@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 4, 'Bachelor of Science in Hospitality Management (BSHM)', '302I', 15, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(11, 20259030, 'Salopaso', 'Justine', 'E', '1999-03-23', 23, 'Male', '4', 'justine.salopaso@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 2, 'Bachelor of Science in Business Administration (BSBA) Major in Banking and Finance', '401I', 7, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(132, 19000000, 'ABORDAJE', 'JET BOY', '', '2003-01-23', 19, 'Male', '2', 'jetboy.abordaje@my.jru.edu', 'f2d6f1c42115fd14f9472027335cac40c3f8f057', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(133, 19000001, 'ALEJANDRO JR', 'ROY ', 'OLESCO', '2004-10-24', 18, 'Male', '2', 'roy.alejandrojr@my.jru.edu', '0060f080c2f200c7720ddfc69de95882f6c06ce2', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(134, 19000002, 'AMPIL', 'JOSHUA CARL', 'BUMANGLAG', '2002-07-27', 20, 'Male', '2', 'joshuacarl.ampil@my.jru.edu', 'b85ccf7d0e7a7dbc4aa93ea418e641ca7a3cd2f8', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(135, 19000003, 'AQUINO', 'VINCE JERIEL', 'ANCHETA', '2003-07-03', 19, 'Male', '2', 'vincejeriel.aquino@my.jru.edu', 'b733b1d05ab85937a8a25c6aa42cdaa7b58d5deb', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(136, 19000004, 'BALBEO', 'DANIELLE', 'MARQUEZ', '2002-05-19', 20, 'Male', '2', 'danielle.balbeo@my.jru.edu', '1511ce97418578db083384d40a9eef65d5769043', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(137, 19000005, 'BELLO', 'JOHN PATRICK', 'CAMINADE', '2002-11-16', 20, 'Male', '2', 'johnpatrick.bello@my.jru.edu', '949e1f4c61cd827884cacecbfd8ab398cac0bf9f', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(138, 19000006, 'BETO', 'LENJUN ', 'LINAGA', '2003-02-09', 19, 'Male', '2', 'lenjun.beto@my.jru.edu', '29a3542ae5a8a03a091407f950afef38eb04b4fb', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(139, 19000007, 'BORRIS', 'SAIDELYN ', 'NORMAELO DIMADARA', '2004-01-20', 18, 'Male', '2', 'saidelynnormaelo.borris@my.jru.edu', '8540c8f98c12ed2fe4d497c7da5a5bdd74da0749', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(140, 19000008, 'CABATIC', 'GIAN CLYDE ', 'TANGONAN', '2001-12-23', 21, 'Male', '2', 'gian.cabatic@my.jru.edu', '8f587330e1a4d2018d404707897f7e4294cb0424', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(141, 19000009, 'CANUA', 'ANDRIE WENDELL', 'RUZGAL', '2003-07-03', 19, 'Male', '2', 'andreiwendell.canua@my.jru.edu', 'a9e34cba69899c943ce5e6fd205959f6830e0c70', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(142, 17000000, 'ABORDO', 'JOUAN ', 'ADVINCULA', '2003-02-27', 19, 'Male', '3', 'jouan.abordo@my.jru.edu', 'faf9d6968f71df7862fa9105607a26c9f3648103', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(143, 17000001, 'ADORABLE', 'JAYSON ', 'DOLIM', '2002-02-20', 20, 'Male', '3', 'jayson.adorable@my.jru.edu', '24fba1c119619a54d4cf19f04f01d180d9597d57', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(144, 17000002, 'ARANETA', 'JULIAN ', 'TAN', '2002-12-19', 20, 'Female', '3', 'julian.araneta@my.jru.edu', '00efa305a37b3097197e1c02d8f45aa52a3fe2c6', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(145, 17000003, 'LOPEZ', 'DENZEL', 'SILOSNZE', '2001-04-12', 21, 'Female', '3', 'denzel.lopez@my.jru.edu', '306d25404a0e3a40f858297b9f1b688b34f0a3ea', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(146, 17000004, 'CAROLINO', 'REYD ', 'DOLIM', '2003-05-26', 19, 'Male', '3', 'reyd.carolino@my.jru.edu', '2314a3dfe2847ed2bd2cd79f2b94f2b8f7f67ce1', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(147, 17000005, 'CASTRO', 'MATTHEW ', 'DERRICK', '2001-12-17', 21, 'Male', '3', 'matthew.castro@my.jru.edu', 'b2c43aac81b15d2965f15053e71cd86361202477', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(148, 17000006, 'CLEMENTE', 'RAINIER ', 'FRANCO', '2000-06-06', 22, 'Male', '3', 'rainier.clemente@my.jru.edu', '7616e76e636dd3b7d0a811bfb4672d76c00eb097', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(149, 17000007, 'COLLANTES', 'LORENZE IVAN ', 'HERRERA', '2002-05-30', 20, 'Male', '3', 'lorenze.collantes@my.jru.edu', '715cb58a364eda1cc8699154da03bf2da7ed1c4e', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(150, 17000008, 'CUYNO', 'CARL JEMUEL ', 'PARUNGAO', '2000-03-05', 22, 'Male', '3', 'carljemuel.cuyno@my.jru.edu', 'a337f5fd4b467998885ea4f6058b50c73338a796', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(151, 17000009, 'DE JESUS', 'JULIANNE ', 'ARAOS', '2001-08-05', 21, 'Female', '3', 'julianne.dejesus@my.jru.edu', '7dfb8eaeb476b511755599b1d044977cf161cc23', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(152, 18000000, 'MONTINOLA', 'ALJON ', 'MALANA', '2004-09-15', 18, 'Male', '3', 'aljon.montinola@my.jru.edu', '76953d1a4f61a18767954a034fa41925f94d8583', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(153, 18000001, 'MUNAR', 'JOERONEMO ', 'EBANO', '2000-06-01', 22, 'Male', '3', 'joeronemo.munar@my.jru.edu', 'ed2ddaadc62c7568bc95f8c890c372b6382a3cc0', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(154, 18000002, 'PALO', 'EDUARDO ', 'ORAYAN', '2002-04-04', 20, 'Male', '3', 'eduardo.palo@my.jru.edu', 'abedc093e20c36463d4af0f36b97e882f2f12c73', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(155, 18000003, 'PASCUA', 'JHAMIR ', 'AQUINO', '1999-06-30', 23, 'Male', '3', 'jhamir.pascua@my.jru.edu', '803c45b0222b2b5c46cca8b244737187887a6997', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(156, 18000004, 'RAMIRO', 'REGIS MIGUEL', 'CABRERA', '2001-04-23', 21, 'Male', '3', 'regismiguel.ramiro@my.jru.edu', '3e03b7eb54ed320505ddd5942ddb694834c95e9a', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(157, 18000005, 'RODILLO', 'BRYAN CHRISTOPHER', 'FIGUEROA', '2002-03-15', 20, 'Male', '3', 'bryanchristopher.rodillo@my.jru.edu', 'a6f01d0aa2abfc7079c150667d51823d17e334c5', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(158, 18000006, 'SANTOS', 'RANIEL SHEAN ', 'PAREDES', '2004-11-04', 18, 'Female', '3', 'ranielshean.santos@my.jru.edu', '4b602d06049405443f51e0ea8eeb3efad684d8d9', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(159, 18000007, 'STA. ANA', 'GABRIEL ', 'SERRANO', '2001-12-20', 21, 'Male', '3', 'gabriel.staana@my.jru.edu', '4204e1b54bf765e68115c7fcde73964a9bd3e027', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(160, 18000008, 'TAGARA', 'JOHN LUDWIG ', 'PLATON', '2003-01-26', 19, 'Male', '3', 'johnludwig.tagara@my.jru.edu', 'e07b2b79f6265f687d3d033fd67eb8d3a1690c41', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(161, 18000009, 'DIAZ', 'KRISTIAN NAGUIT', 'NAGUIT', '2001-12-09', 21, 'Male', '3', 'kristian.diaz@my.jru.edu', '78a471443cc5bd1a4d79bcb82cf822b07bc2e081', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(162, 20000000, 'BALATAR', 'PAOLO DE LIMA', 'DE LIMA', '1998-08-12', 24, 'Male', '4', 'paolo.balatar@my.jru.edu', 'e92a665fe6951c913ee862f7f7aa1b59c28b0d0d', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(163, 20000001, 'BORCES', 'MARK MANUEL ', 'SANDOVAL', '1997-10-25', 25, 'Male', '4', 'markmanuel.borces@my.jru.edu', '76121c03d2350dc0ce23f317a60130fa997cb65f', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(164, 20000002, 'CAADIANG', 'ALJEN KAEIRISH JEANINE ', 'DELA CRUZ', '1998-07-12', 24, 'Female', '4', 'aljenkaeirishjeanine.caadiang@my.jru.edu', '7458a9996091f29164a716cd4b5f71d76c80de15', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(165, 20000003, 'CARILLO', 'AARON JOSEPH ', 'NOCON', '1999-01-01', 23, 'Male', '4', 'aaronjoseph.carillo@my.jru.edu', '3cb8f0e739273e8bc5c09bfed6097d95cbc20085', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(166, 20000004, 'CASTOLO', 'JERALD ', 'VITALICIO', '1999-08-16', 23, 'Male', '4', 'jerald.castolo@my.jru.edu', '06c0ec5dfca3e202f572c27f7dc1e34d51cdc832', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(167, 20000005, 'CATINDIG JR.', 'ANTHONY ', 'MACAZO', '1997-10-25', 25, 'Male', '4', 'anthony.catindigjr@my.jru.edu', '1f7bfd762aceac5f4cb7371dc0835d252f3ac52a', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(168, 20000006, 'CHAN', 'JOEMARK LUIS ', 'SEGUI', '1994-02-13', 28, 'Male', '4', 'joemarkluis.chan@my.jru.edu', 'c524ee496dc1b245f63ed1bd9db6d5eb8f862e03', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(169, 20000007, 'CONCEPCION', 'ARTHUR ', 'REYES', '1997-01-04', 25, 'Male', '4', 'arthur.concepcion@my.jru.edu', 'a812d0be5e5d1fafeaf75b18c03fe35dfe7e0d00', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(170, 20000008, 'CORCEGA', 'LANCE JOSHUA ', 'CAMELO', '1999-03-30', 23, 'Male', '4', 'lancejoshua.corcega@my.jru.edu', '4204910a7ac30459539ae273c498667931ab9f04', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(171, 20000009, 'COSMOD', 'PATRICK ', 'SANSAN', '1999-01-08', 23, 'Male', '4', 'patrick.cosmod@my.jru.edu', 'fba05145859480c7cef3d03c78595a328525bdfd', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_students_archive`
--

CREATE TABLE `tb_students_archive` (
  `ID` int(255) NOT NULL,
  `STUDENT_ID` int(9) NOT NULL,
  `LAST_NAME` varchar(50) DEFAULT NULL,
  `FIRST_NAME` varchar(50) DEFAULT NULL,
  `MIDDLE_NAME` varchar(30) DEFAULT NULL,
  `BIRTHDATE` date DEFAULT NULL,
  `AGE` int(3) DEFAULT NULL,
  `GENDER` varchar(7) DEFAULT NULL,
  `YEAR_LEVEL` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `COLLEGE_DEPT` int(3) DEFAULT NULL,
  `COURSE` varchar(100) DEFAULT NULL,
  `SECTION` varchar(10) DEFAULT NULL,
  `MORG_ID` int(2) DEFAULT NULL,
  `ORG_ID` int(2) DEFAULT NULL,
  `ORG_IDS` varchar(1000) DEFAULT NULL,
  `USER_TYPE` int(2) DEFAULT NULL,
  `ACCOUNT_CREATED` date DEFAULT NULL,
  `PROFILE_PIC` varchar(8000) DEFAULT NULL,
  `BIO` text DEFAULT NULL,
  `VCODE` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_surveys`
--

CREATE TABLE `tb_surveys` (
  `survey_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_surveys`
--

INSERT INTO `tb_surveys` (`survey_id`, `title`, `description`, `start_date`, `end_date`, `org_id`) VALUES
(1667534650, 'JRU Election Survey', 'An evaluation survey regarding the recent elections', '2022-11-04', '2022-11-04', 12),
(1668664232, 'Test asdasd', 'asdasdasdasd', '2022-11-17', '2022-11-18', 12),
(1668664763, 'Test asdasd', 'asddfgfhjxc asdasd', '2022-11-18', '2022-11-19', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_surveys_archive`
--

CREATE TABLE `tb_surveys_archive` (
  `survey_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_surveys_archive`
--

INSERT INTO `tb_surveys_archive` (`survey_id`, `title`, `description`, `start_date`, `end_date`, `org_id`) VALUES
(1667349399, 'Test Survey', 'sadsma dlsmakdlksamdlksadsa', '2022-11-03', '2022-11-12', 12),
(1667469689, 'Another Survey Testing', 'All questions testing', '2022-11-03', '2022-11-05', 12),
(1667495089, 'Feedback for ComSoc Technology and Innovation Seminar Series	', 'Feedback for ComSoc Technology and Innovation Seminar Series	', '2022-11-03', '2022-11-04', 12),
(1667495356, 'ComSoc Technology and Innovation Seminar Series	', 'Feedback for ComSoc Technology and Innovation Seminar Series	', '2022-11-03', '2022-11-04', 12),
(1667529827, 'test', 'test', '2022-11-05', '2022-11-05', 12),
(1667529870, 'test', 'test', '2022-11-04', '2022-11-04', 12),
(1667531577, 'rtes', 'tes', '2022-11-04', '2022-11-05', 12),
(1667531711, 'test', 'test', '2022-11-04', '2022-11-04', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_survey_answers`
--

CREATE TABLE `tb_survey_answers` (
  `answer_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `student_no` int(11) NOT NULL,
  `answer` text NOT NULL,
  `submitted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_survey_answers`
--

INSERT INTO `tb_survey_answers` (`answer_id`, `survey_id`, `question_id`, `student_no`, `answer`, `submitted`) VALUES
(13, 1667349399, 22, 19255531, '[0],[1]', 1667467892),
(14, 1667349399, 23, 19255531, '3', 1667467892),
(15, 1667349399, 24, 19255531, 'answer to 3 text', 1667467892),
(16, 1667349399, 25, 19255531, 'answer to 4 mtext', 1667467892),
(17, 1667349399, 26, 19255531, '23', 1667467892),
(18, 1667469689, 27, 19255531, 'answer to q1', 1667471544),
(19, 1667469689, 28, 19255531, 'answer to q2', 1667471544),
(20, 1667469689, 29, 19255531, '23', 1667471544),
(21, 1667469689, 30, 19255531, '[0],[2],[3]', 1667471544),
(22, 1667469689, 31, 19255531, '[0]', 1667471544),
(23, 1667469689, 32, 19255531, '[0]', 1667471544),
(24, 1667469689, 33, 19255531, '2', 1667471544),
(25, 1667495356, 38, 19255532, '4', 1667495548),
(26, 1667495356, 39, 19255532, '[0]', 1667495548),
(27, 1667495356, 40, 19255532, 'None so far', 1667495548),
(28, 1667495356, 38, 19255532, '4', 1667495548),
(29, 1667495356, 39, 19255532, '[0]', 1667495548),
(30, 1667495356, 40, 19255532, 'None so far', 1667495548),
(31, 1667495356, 38, 19255532, '4', 1667495548),
(32, 1667495356, 39, 19255532, '[0]', 1667495548),
(33, 1667495356, 40, 19255532, 'None so far', 1667495548),
(34, 1667495356, 38, 19255532, '4', 1667495548),
(35, 1667495356, 39, 19255532, '[0]', 1667495548),
(36, 1667495356, 40, 19255532, 'None so far', 1667495548),
(37, 1667495356, 38, 19255532, '4', 1667495548),
(38, 1667495356, 39, 19255532, '[0]', 1667495548),
(39, 1667495356, 40, 19255532, 'None so far', 1667495548),
(40, 1667495356, 38, 19255532, '4', 1667495548),
(41, 1667495356, 39, 19255532, '[0]', 1667495548),
(42, 1667495356, 40, 19255532, 'None so far', 1667495548),
(43, 1668664232, 64, 19255532, '[3]', 1668664270),
(44, 1668664232, 65, 19255532, '[2]', 1668664270),
(45, 1668664232, 66, 19255532, 'teasdasdasd', 1668664270),
(46, 1668664232, 64, 19255515, '[3]', 1668664311),
(47, 1668664232, 65, 19255515, '[2]', 1668664311),
(48, 1668664232, 66, 19255515, 'asdasdsdfvsxc', 1668664311);

-- --------------------------------------------------------

--
-- Table structure for table `tb_survey_questions`
--

CREATE TABLE `tb_survey_questions` (
  `question_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  `choices` text NOT NULL,
  `optional` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_survey_questions`
--

INSERT INTO `tb_survey_questions` (`question_id`, `survey_id`, `question`, `type`, `choices`, `optional`) VALUES
(22, 1667349399, 'sadsad sadsadsadas', 4, 'cb1;;cb2;;cb3', 0),
(23, 1667349399, 'asdsadas dsad asda sda s q#2', 7, '', 0),
(24, 1667349399, 'a sdadasd sada sdsa  text', 1, '', 0),
(25, 1667349399, 'adasdlkmas ldkmaslkd m text', 2, '', 0),
(26, 1667349399, 'asakmdlkmsaldk sam numeric', 3, '', 0),
(27, 1667469689, 'question1 textbox', 1, '', 0),
(28, 1667469689, 'question 2 multiline textbox', 2, '', 0),
(29, 1667469689, 'question 3 numeric', 3, '', 0),
(30, 1667469689, 'question 4 checkboxes', 4, 'cb choice 1;;cb choice 2;;cb choice 3;;cb choice 4', 0),
(31, 1667469689, 'question 5 radio button', 5, 'radio 1;;radio 2', 0),
(32, 1667469689, 'question 6 dropdown', 6, 'drop 1;;drop 2;;drop 3', 0),
(33, 1667469689, 'question 7 rating', 7, '', 0),
(37, 1667495089, 'Other feedback:', 0, '', 0),
(38, 1667495356, 'How would you describe your experience with the event?', 7, '', 0),
(39, 1667495356, 'Where did you hear about the event', 5, 'JRU Student Organizations Portal;;JRU Website;;Social Media;;Other', 0),
(40, 1667495356, 'Any suggestions?', 2, '', 0),
(41, 1667529827, 'test', 1, '', 0),
(42, 1667529870, 'test', 1, '', 0),
(51, 1667531577, 'fsafsafsa', 0, '', 0),
(52, 1667531711, 'dsadsa', 1, '', 0),
(53, 1667531711, 'dsadad', 2, '', 0),
(54, 1667531711, 'sadsad', 3, '', 0),
(55, 1667531711, 'fsafaf', 4, 'fasfasf;;fsdafsadfdf;;fasfas', 0),
(56, 1667531711, 'fasfasf', 5, 'fasfsaf;;fasfasf;;fsafasfas', 0),
(57, 1667531711, 'fsafasf', 6, 'fasfsa;;fasfsa;;fassafsa', 0),
(58, 1667531711, 'asfsafasf', 7, '', 0),
(59, 1667534650, 'State your name:', 1, '', 0),
(60, 1667534650, 'How old are you?', 3, '', 0),
(61, 1667534650, 'What year level are you?', 5, '1st Year;;2nd Year;;3rd Year;;4th Year', 0),
(62, 1667534650, 'How would you describe your experience with the election held?', 7, '', 0),
(63, 1667534650, 'Any feedback or suggestions?', 2, '', 0),
(64, 1668664232, 'qwqqq', 6, 'qweqwe;;qweqwe;;qweqwe;;qwdqwee', 0),
(65, 1668664232, 'qweqweqwe', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(66, 1668664232, 'asdasdasd', 2, '', 0),
(70, 1668664763, 'asdasd', 6, 'sdfsdf;;xcvbcvb;;xzczxc;;qweqwe', 0),
(71, 1668664763, 'asdzxczxv', 5, '1231sdfvzxcv;;zxcsdfsfdg;;cb  zxczxc;;cvncvb', 0),
(72, 1668664763, 'asdzxx xbc', 3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_usertypes`
--

CREATE TABLE `tb_usertypes` (
  `usertype_id` int(2) NOT NULL,
  `user_type` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_usertypes`
--

INSERT INTO `tb_usertypes` (`usertype_id`, `user_type`) VALUES
(1, 'Student'),
(2, 'Officer'),
(3, 'Signatory'),
(4, 'Admin'),
(5, 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_votes`
--

CREATE TABLE `tb_votes` (
  `VOTE_ID` int(11) NOT NULL,
  `VOTER_ID` int(11) NOT NULL,
  `ELECTION_ID` int(11) NOT NULL,
  `POSITION_ID` int(11) NOT NULL,
  `CANDIDATE_ID` int(11) NOT NULL,
  `CAST_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_votes`
--

INSERT INTO `tb_votes` (`VOTE_ID`, `VOTER_ID`, `ELECTION_ID`, `POSITION_ID`, `CANDIDATE_ID`, `CAST_DATE`) VALUES
(1, 19255531, 13, 1, 15, '2022-10-26'),
(2, 19255531, 13, 2, -1, '2022-10-26'),
(3, 19255531, 13, 1, 16, '2022-10-26'),
(4, 19255531, 13, 2, 17, '2022-10-26'),
(5, 19255531, 13, 1, 16, '2022-10-26'),
(6, 19255531, 13, 2, 17, '2022-10-26'),
(9, 19255515, 13, 1, 16, '2022-10-26'),
(10, 19255515, 13, 2, 17, '2022-10-26'),
(11, 19255532, 13, 1, 16, '2022-10-27'),
(12, 19255532, 13, 2, 17, '2022-10-27'),
(16, 9, 16, 1, 30, '2022-10-30'),
(17, 9, 16, 2, 32, '2022-10-30'),
(18, 9, 16, 4, -1, '2022-10-30'),
(19, 19255531, 12, 1, 24, '2022-10-31'),
(20, 19255531, 12, 3, 26, '2022-10-31'),
(21, 19255532, 19, 1, 45, '2022-11-17'),
(22, 19255532, 19, 2, 48, '2022-11-17'),
(23, 19255531, 19, 1, 46, '2022-11-17'),
(24, 19255531, 19, 2, 47, '2022-11-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`ADMIN_ID`),
  ADD KEY `admin_usertype_id_fk` (`USERTYPE_ID`);

--
-- Indexes for table `tb_admin_archive`
--
ALTER TABLE `tb_admin_archive`
  ADD PRIMARY KEY (`ADMIN_ID`),
  ADD KEY `admin_usertype_id_fk` (`USERTYPE_ID`);

--
-- Indexes for table `tb_approval_type`
--
ALTER TABLE `tb_approval_type`
  ADD PRIMARY KEY (`approval_id`);

--
-- Indexes for table `tb_budget_codes`
--
ALTER TABLE `tb_budget_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_budget_codes_archive`
--
ALTER TABLE `tb_budget_codes_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_candidate`
--
ALTER TABLE `tb_candidate`
  ADD PRIMARY KEY (`CANDIDATE_ID`),
  ADD KEY `candidate_position_id_fk` (`POSITION_ID`),
  ADD KEY `candidate_studentid_fk` (`STUDENT_NO`),
  ADD KEY `ELECTION_ID` (`ELECTION_ID`);

--
-- Indexes for table `tb_collegedept`
--
ALTER TABLE `tb_collegedept`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `tb_course`
--
ALTER TABLE `tb_course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `course_college_id_fk` (`college_id`);

--
-- Indexes for table `tb_disc_groups`
--
ALTER TABLE `tb_disc_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `tb_disc_replies`
--
ALTER TABLE `tb_disc_replies`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `thread_id` (`thread_id`,`user_id`);

--
-- Indexes for table `tb_disc_threads`
--
ALTER TABLE `tb_disc_threads`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `topic_id` (`topic_id`,`user_id`,`last_reply`);

--
-- Indexes for table `tb_disc_topics`
--
ALTER TABLE `tb_disc_topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `group_id` (`group_id`,`org_id`,`visibility`);

--
-- Indexes for table `tb_elections`
--
ALTER TABLE `tb_elections`
  ADD PRIMARY KEY (`ELECTION_ID`);

--
-- Indexes for table `tb_elections_archive`
--
ALTER TABLE `tb_elections_archive`
  ADD PRIMARY KEY (`ELECTION_ID`);

--
-- Indexes for table `tb_notification`
--
ALTER TABLE `tb_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_officers`
--
ALTER TABLE `tb_officers`
  ADD PRIMARY KEY (`officer_id`),
  ADD KEY `officers_position_id_fk` (`position_id`),
  ADD KEY `officers_org_id_fk` (`org_id`),
  ADD KEY `officers_student_id_fk` (`student_id`),
  ADD KEY `officers_collegedept_id_fk` (`college_dept`),
  ADD KEY `officers_usertype_id_fk` (`user_type`);

--
-- Indexes for table `tb_officers_archive`
--
ALTER TABLE `tb_officers_archive`
  ADD PRIMARY KEY (`officer_id`),
  ADD KEY `officers_position_id_fk` (`position_id`),
  ADD KEY `officers_org_id_fk` (`org_id`),
  ADD KEY `officers_student_id_fk` (`student_id`),
  ADD KEY `officers_collegedept_id_fk` (`college_dept`),
  ADD KEY `officers_usertype_id_fk` (`user_type`);

--
-- Indexes for table `tb_orgs`
--
ALTER TABLE `tb_orgs`
  ADD PRIMARY KEY (`ORG_ID`),
  ADD KEY `orgs_college_id_fk` (`college_id`),
  ADD KEY `orgs_org_type_id_fk` (`org_type_id`);

--
-- Indexes for table `tb_orgs_archive`
--
ALTER TABLE `tb_orgs_archive`
  ADD PRIMARY KEY (`ORG_ID`),
  ADD KEY `orgs_college_id_fk` (`college_id`),
  ADD KEY `orgs_org_type_id_fk` (`org_type_id`);

--
-- Indexes for table `tb_org_application`
--
ALTER TABLE `tb_org_application`
  ADD PRIMARY KEY (`org_req_id`),
  ADD KEY `orgapp_type_id` (`org_type`);

--
-- Indexes for table `tb_org_type`
--
ALTER TABLE `tb_org_type`
  ADD PRIMARY KEY (`org_type_id`);

--
-- Indexes for table `tb_position`
--
ALTER TABLE `tb_position`
  ADD PRIMARY KEY (`POSITION_ID`);

--
-- Indexes for table `tb_projectmonitoring`
--
ALTER TABLE `tb_projectmonitoring`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_org_id` (`org_id`),
  ADD KEY `project_position_id` (`position_id`),
  ADD KEY `project_approval_id` (`approval_id`),
  ADD KEY `project_college_id` (`college_id`);

--
-- Indexes for table `tb_requests`
--
ALTER TABLE `tb_requests`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `req_org_id` (`org_id`),
  ADD KEY `req_student_id` (`student_id`);

--
-- Indexes for table `tb_signatories`
--
ALTER TABLE `tb_signatories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `signatories_collegedept_fk` (`college_dept`),
  ADD KEY `signatories_orgid_fk` (`org_id`),
  ADD KEY `signatories_type_fk` (`signatorytype_id`),
  ADD KEY `signatories_usertype_id_fk` (`usertype_id`);

--
-- Indexes for table `tb_signatories_archive`
--
ALTER TABLE `tb_signatories_archive`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `signatories_collegedept_fk` (`college_dept`),
  ADD KEY `signatories_orgid_fk` (`org_id`),
  ADD KEY `signatories_type_fk` (`signatorytype_id`),
  ADD KEY `signatories_usertype_id_fk` (`usertype_id`);

--
-- Indexes for table `tb_signatory_type`
--
ALTER TABLE `tb_signatory_type`
  ADD PRIMARY KEY (`signatory_id`);

--
-- Indexes for table `tb_students`
--
ALTER TABLE `tb_students`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `student_morg_id_fk` (`MORG_ID`),
  ADD KEY `student_org_id_fk` (`ORG_ID`),
  ADD KEY `student_usertype_id_fk` (`USER_TYPE`),
  ADD KEY `student_college_id_fk` (`COLLEGE_DEPT`);

--
-- Indexes for table `tb_students_archive`
--
ALTER TABLE `tb_students_archive`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_surveys`
--
ALTER TABLE `tb_surveys`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `tb_surveys_archive`
--
ALTER TABLE `tb_surveys_archive`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `tb_survey_answers`
--
ALTER TABLE `tb_survey_answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `tb_survey_questions`
--
ALTER TABLE `tb_survey_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `tb_usertypes`
--
ALTER TABLE `tb_usertypes`
  ADD PRIMARY KEY (`usertype_id`);

--
-- Indexes for table `tb_votes`
--
ALTER TABLE `tb_votes`
  ADD PRIMARY KEY (`VOTE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_approval_type`
--
ALTER TABLE `tb_approval_type`
  MODIFY `approval_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_budget_codes`
--
ALTER TABLE `tb_budget_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_budget_codes_archive`
--
ALTER TABLE `tb_budget_codes_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_candidate`
--
ALTER TABLE `tb_candidate`
  MODIFY `CANDIDATE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tb_collegedept`
--
ALTER TABLE `tb_collegedept`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_course`
--
ALTER TABLE `tb_course`
  MODIFY `course_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_disc_groups`
--
ALTER TABLE `tb_disc_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_disc_topics`
--
ALTER TABLE `tb_disc_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_elections`
--
ALTER TABLE `tb_elections`
  MODIFY `ELECTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_elections_archive`
--
ALTER TABLE `tb_elections_archive`
  MODIFY `ELECTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_notification`
--
ALTER TABLE `tb_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tb_officers`
--
ALTER TABLE `tb_officers`
  MODIFY `officer_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_officers_archive`
--
ALTER TABLE `tb_officers_archive`
  MODIFY `officer_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_orgs`
--
ALTER TABLE `tb_orgs`
  MODIFY `ORG_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_orgs_archive`
--
ALTER TABLE `tb_orgs_archive`
  MODIFY `ORG_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_org_application`
--
ALTER TABLE `tb_org_application`
  MODIFY `org_req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_position`
--
ALTER TABLE `tb_position`
  MODIFY `POSITION_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_requests`
--
ALTER TABLE `tb_requests`
  MODIFY `req_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_signatories`
--
ALTER TABLE `tb_signatories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_students`
--
ALTER TABLE `tb_students`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `tb_surveys`
--
ALTER TABLE `tb_surveys`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1668664764;

--
-- AUTO_INCREMENT for table `tb_surveys_archive`
--
ALTER TABLE `tb_surveys_archive`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1667531712;

--
-- AUTO_INCREMENT for table `tb_survey_answers`
--
ALTER TABLE `tb_survey_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tb_survey_questions`
--
ALTER TABLE `tb_survey_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tb_usertypes`
--
ALTER TABLE `tb_usertypes`
  MODIFY `usertype_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_votes`
--
ALTER TABLE `tb_votes`
  MODIFY `VOTE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `admin_usertype_id_fk` FOREIGN KEY (`USERTYPE_ID`) REFERENCES `tb_usertypes` (`usertype_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_candidate`
--
ALTER TABLE `tb_candidate`
  ADD CONSTRAINT `candidate_position_id_fk` FOREIGN KEY (`POSITION_ID`) REFERENCES `tb_position` (`POSITION_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_course`
--
ALTER TABLE `tb_course`
  ADD CONSTRAINT `course_college_id_fk` FOREIGN KEY (`college_id`) REFERENCES `tb_collegedept` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_officers`
--
ALTER TABLE `tb_officers`
  ADD CONSTRAINT `officers_collegedept_id_fk` FOREIGN KEY (`college_dept`) REFERENCES `tb_collegedept` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `officers_org_id_fk` FOREIGN KEY (`org_id`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `officers_position_id_fk` FOREIGN KEY (`position_id`) REFERENCES `tb_position` (`POSITION_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `officers_usertype_id_fk` FOREIGN KEY (`user_type`) REFERENCES `tb_usertypes` (`usertype_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_org_application`
--
ALTER TABLE `tb_org_application`
  ADD CONSTRAINT `orgapp_type_id` FOREIGN KEY (`org_type`) REFERENCES `tb_org_type` (`org_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_projectmonitoring`
--
ALTER TABLE `tb_projectmonitoring`
  ADD CONSTRAINT `project_approval_id` FOREIGN KEY (`approval_id`) REFERENCES `tb_approval_type` (`approval_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_college_id` FOREIGN KEY (`college_id`) REFERENCES `tb_collegedept` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_requests`
--
ALTER TABLE `tb_requests`
  ADD CONSTRAINT `req_org_id` FOREIGN KEY (`org_id`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
