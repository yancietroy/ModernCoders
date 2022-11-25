-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 04:03 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
(1, 'John', 'Doe', '', 'john.doe@jru.edu', '7c222fb2927d828af22f592134e8932480637c0d', NULL, NULL, '66528-1.png'),
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
-- Table structure for table `tb_answers`
--

CREATE TABLE `tb_answers` (
  `id` int(30) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `answer` text NOT NULL,
  `question_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_answers`
--

INSERT INTO `tb_answers` (`id`, `survey_id`, `user_id`, `answer`, `question_id`, `date_created`) VALUES
(1, 1, 2, 'Sample Only', 4, '2020-11-10 14:46:07'),
(2, 1, 2, '[JNmhW],[zZpTE]', 2, '2020-11-10 14:46:07'),
(3, 1, 2, 'dAWTD', 1, '2020-11-10 14:46:07'),
(4, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in tempus turpis, sed fermentum risus. Praesent vitae velit rutrum, dictum massa nec, pharetra felis. Phasellus enim augue, laoreet in accumsan dictum, mollis nec lectus. Aliquam id viverra nisl. Proin quis posuere nulla. Nullam suscipit eget leo ut suscipit.', 4, '2020-11-10 15:59:43'),
(5, 1, 3, '[qCMGO],[JNmhW]', 2, '2020-11-10 15:59:43'),
(6, 1, 3, 'esNuP', 1, '2020-11-10 15:59:43');

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
(2, 'Dean'),
(3, 'SDO'),
(4, 'Approved');

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
(15, 13, 1, 19255515),
(16, 13, 1, 19255531),
(17, 13, 2, 19255570),
(19, 11, 5, 19255570),
(24, 12, 1, 19255515),
(25, 12, 1, 19255531),
(26, 12, 3, 19255532),
(27, 12, 3, 19255570),
(28, 14, 1, 19255540),
(29, 15, 1, 18255530),
(30, 16, 1, 19255532),
(31, 16, 1, 19255533),
(32, 16, 2, 19255515),
(33, 16, 2, 19255570),
(34, 16, 4, 19255540),
(35, 17, 1, 19255515),
(36, 17, 2, 19255531),
(37, 17, 3, 19255532),
(38, 17, 4, 19255533),
(39, 17, 5, 19255570),
(40, 18, 1, 19255532),
(41, 18, 2, 19255533),
(42, 18, 3, 19255515),
(43, 18, 4, 19255570),
(44, 18, 5, 19255540);

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
(1, 'College of Liberal Arts, Criminology and Education'),
(2, 'College of Business Administration'),
(3, 'College of Computer Studies and Engineering'),
(4, 'College of Hospitality and Tourism Management'),
(5, 'College of Nursing and Health Sciences');

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
(26, 'Bachelor of Science in Entertainment and Multimedia Computing (BSEMC) Major in Digital Animation Tech', 3),
(27, 'Bachelor of Science in Information Technology (BSIT-AGD) Major in Animation and Game Development', 3),
(28, 'Bachelor of Science in Hospitality Management (BSHM)', 4),
(29, 'Bachelor of Science in Hospitality Management (BSHM – CM) Major in Cruise Management ', 4),
(30, 'Bachelor of Science in Tourism Management (BSTM)', 4);

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
(4, 'Org Only', 5);

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
(1669362348, 1669362169, 3, 19123412, 'Emerson Flores', '<p>asd asdas</p>', 1, 0);

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
(1667467187, 1, 9, 2, 'Trisha Pega', 'Welcome to JRUSOP', '<p>Welcome to JRU Student Organizations Portal!</p>', 153, 1, 1667467278, 'Trisha Pega', 1),
(1667472994, 2, 9, 2, 'Trisha Pega', 'Intro - Assistant Secretary', '<p>Hello my name is Trisha Pega, assistant secretary of JRU Computer Society</p>', 6, 0, 1667472994, 'Trisha Pega', 0),
(1667473049, 3, 9, 2, 'Trisha Pega', 'Does anyone like the new hyflex learning of JRU?', '<p>Personally, I like it</p>', 8, 3, 1668058191, 'Trisha Pega', 0),
(1667473091, 4, 9, 2, 'Trisha Pega', 'Activity Plans', '<p>Hello, I would like to ask the schedule of activity and plans on it</p>', 19, 0, 1667473091, 'Trisha Pega', 0),
(1667473129, 5, 9, 2, 'Trisha Pega', 'Meeting Schedule', '<p>May I know the next meeting schedule?</p>', 1, 0, 1667473129, 'Trisha Pega', 0),
(1667906308, 12, 13, 2, 'Candid Patrice Cataneda', 'Sample Title For the newly made New topic button', '<p>Sample Message below title</p>', 3, 1, 1667906358, 'Candid Patrice Cataneda', 0),
(1668419772, 0, 1, 0, 'John Doe', 'Sample', '<p>Test</p>', 1, 0, 1668419772, 'John Doe', 0),
(1668419871, 3, 1, 0, 'John Doe', 'Sample', '<p>Test</p>', 3, 0, 1668419871, 'John Doe', 0),
(1669362169, 1, 19123412, 3, 'Emerson Flores', 'Thread By Signatory', '<p>aasdasda sdas</p>', 7, 2, 1669362348, 'Emerson Flores', 0);

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
  `officers` text NOT NULL DEFAULT '',
  `members` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_disc_topics`
--

INSERT INTO `tb_disc_topics` (`topic_id`, `group_id`, `subject`, `description`, `org_id`, `visibility`, `icon`, `officers`, `members`) VALUES
(1, 1, 'Announcements', 'Latest announcements from JRU', 0, 0, 'bi bi-clipboard-fill', '', ''),
(2, 1, 'Introductions', 'New to the platform? Please stop by, say hi and tell us a bit about yourself.', 0, 0, 'bi bi-lightning-charge-fill', '', ''),
(3, 2, 'General Discussions', 'Talk about anything.', 0, 0, '', '', ''),
(4, 2, 'COMSOC Discussions only', 'COMSOC related discussions ', 12, 5, '', '', ''),
(5, 3, 'COMSOC Officers', 'For COMSOC Officers Only', 12, 2, '', '', ''),
(11, 4, 'Sample ComSoc Only', 'This thread is only available to ComSoc only!', 12, 5, 'bi bi-chat-square-dots-fill', '', ''),
(12, 1, 'Sample General Discussion ', 'New Topic Button testing!', 0, 0, 'bi bi-chat-square-dots-fill', '', ''),
(13, 2, 'Another Topic', 'asda sdasdsadsadsa', 12, 0, 'bi bi-megaphone-fill', '', ''),
(15, 1, 'Customized Topic Sample', 'safadssadsa', 12, 6, 'bi bi-chat-square-dots-fill', ';;5;;8;;9;;10;;11', ';;19255533;;19255570');

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
(17, 1, 12, 'COMSOC Election Sample', 'A sample election', '2022-11-04', '2022-11-24'),
(18, 0, 0, 'CSC Elections', 'CSC elections', '2022-11-04', '2022-11-04');

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
  `receiver` int(11) NOT NULL,
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
(20, 1668061396, 19255532, 2, 'Feeding Program', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(21, 1668061396, 19255562, 1, 'Feeding Program', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(22, 1668061433, 19255532, 2, 'Feeding Program', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(23, 1668061433, 18202422, 1, 'Feeding Program', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(24, 1668061469, 19255532, 2, 'Feeding Program', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(25, 1668497781, 19255532, 2, 'COMSOC Esports Tryouts', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(26, 1668497781, 19255562, 1, 'COMSOC Esports Tryouts', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(27, 1668497821, 19255532, 2, 'COMSOC Esports Tryouts', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(28, 1668497821, 18202422, 1, 'COMSOC Esports Tryouts', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(29, 1668497886, 19255532, 2, 'COMSOC Esports Tryouts', 'Project has been approved by the SDO.', 'officer-approved.php', 0);

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
  `account_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_officers`
--

INSERT INTO `tb_officers` (`student_id`, `officer_id`, `position_id`, `last_name`, `first_name`, `middle_initial`, `birthdate`, `age`, `gender`, `year_level`, `college_dept`, `course`, `section`, `email`, `password`, `org_id`, `user_type`, `profile_pic`, `account_created`) VALUES
(19255532, 9, 5, 'Pega', 'Trisha', '', '1999-07-09', 23, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'trisha.pega@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, '83683-Screenshot (138).png', '2022-10-13'),
(19255515, 11, 14, 'Ayala', 'Jose Ricardo', 'J', '1999-06-17', 23, 'Male', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'josericardo.ayala@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 2, 2, 'img_avatar.png', '2022-10-13'),
(19255570, 12, 13, 'Gabas', 'May Ann', 'G', '2000-06-05', 22, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'mayann.gabas@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 4, 2, 'img_avatar.png', '2022-10-13'),
(17401211, 14, 1, 'Legaspi', 'Bienvenido', 'Argote', '2000-06-13', 22, 'Male', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 'bienvenido.legaspiii@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 17, 2, 'img_avatar.png', '2022-11-10');

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
  `course_ids` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_orgs`
--

INSERT INTO `tb_orgs` (`ORG_ID`, `ORG`, `logo`, `college_id`, `org_type_id`, `course_ids`) VALUES
(1, 'Association of Students of History (ASH)', 'jrusop-logo2.png', 1, 1, '[1],[2],[3],[4]'),
(2, 'Criminal Justice Students Society (CJSS)', 'ACE(Crim).jpg', 1, 1, '[1],[2],[3]'),
(3, 'Liberal Arts Students Organization (LASO)', 'jrusop-logo2.png', 1, 1, '[1],[2],[3]'),
(4, 'Mathematics Society (MATHSOC)', 'ACE(Math).jpg', 1, 1, '[1],[2]'),
(5, 'Young, Educators Society (YES)', 'ACE(Educ).jpg', 1, 1, '[3],[4]'),
(6, 'Junior Finance and Economics Society (JFINECS)', 'jrusop-logo2.png', 2, 1, ''),
(7, 'Junior Philippine Institute of Accountants (JPIA)', 'jrusop-logo2.png', 2, 1, ''),
(8, 'Management Society (MANSOC)', 'BA(managemenrSoc).jpg', 2, 1, ''),
(9, 'Supply Management Society (SMS)', 'BA(supplyMan).jpg', 2, 1, ''),
(10, 'Young Marketers Association (YMA)', 'BA(YoungMarketers).jpg', 2, 1, ''),
(11, 'Auxiliary of Computer Engineering Students (ACES)', 'jrusop-logo2.png', 3, 1, ''),
(12, 'Computer Society (COMSOC)', 'COMSOC.png', 3, 1, ''),
(13, 'Electronics Engineering League (ECEL)', 'CSE(electronicEngLeague).jpg', 3, 1, ''),
(14, 'Association of Tourism Management Students (ATOMS)', 'jrusop-logo2.png', 4, 1, ''),
(15, 'Hospitality, Hotelier and Restaurateur Society (HHRS)', 'CHTM(hospitalityIndusaFutureProf).jpg', 4, 1, ''),
(16, 'Nursing Society (NURSOC)', 'NursingSociety.jpg', 5, 1, ''),
(17, 'José Rizal University Book Buddies', 'jrusop-logo2.png', NULL, 2, ''),
(18, 'Young Rizalian Servant Leaders (YRSL)', 'jrusop-logo2.png', NULL, 2, ''),
(19, 'Golden Z Club', 'jrusop-logo2.png', NULL, 2, ''),
(20, 'International Students Association (ISA)', 'jrusop-logo2.png', NULL, 2, ''),
(21, 'José Rizal University Chorale', 'jrusop-logo2.png', NULL, 2, ''),
(22, 'José Rizal University Dance Troupe', 'jrusop-logo2.png', NULL, 2, ''),
(23, 'Teatro Rizal', 'jrusop-logo2.png', NULL, 2, ''),
(24, 'Junior Photographic Editors and Graphic Artists (JPEG)', 'jrusop-logo2.png', NULL, 2, '');

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
  `course_ids` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `tb_projectmonitoring`
--

CREATE TABLE `tb_projectmonitoring` (
  `project_id` int(11) NOT NULL,
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
  `estimated_budget` int(11) DEFAULT NULL,
  `budget_req` varchar(3000) DEFAULT NULL,
  `attachments` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `approval_id` int(2) DEFAULT NULL,
  `date_submitted` date DEFAULT NULL,
  `status_date` date DEFAULT NULL,
  `remarks` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_projectmonitoring`
--

INSERT INTO `tb_projectmonitoring` (`project_id`, `position_id`, `org_id`, `college_id`, `project_name`, `requested_by`, `organizer`, `project_type`, `project_category`, `objectives`, `project_desc`, `start_date`, `end_date`, `venue`, `participants`, `no_of_participants`, `beneficiary`, `no_of_beneficiary`, `budget_source`, `estimated_budget`, `budget_req`, `attachments`, `status`, `approval_id`, `date_submitted`, `status_date`, `remarks`) VALUES
(54, 1, 12, 3, 'ESports', 'Trisha Pega', ' ', 'Extra Curricular', 'Onsite', 'For students to have fun', NULL, '2022-10-17 17:01:00', '2022-10-24 17:01:00', 'JRU Guadrangle ', 'Students', NULL, NULL, NULL, NULL, 2000, '1000 - cash prize\r\n1500 - Trophy\r\n500 - Banners', '13914-H_30908.pdf', 'Rejected', 1, '2022-10-13', '2022-11-03', 'Already been done.'),
(55, 1, 12, 3, 'CSE Week 2022', 'Trisha Pega', 'COMSOC', 'Curricular', 'Onsite', 'a fun week for students of Computer Science Engineering ', NULL, '2022-10-16 17:06:00', '2022-10-23 17:06:00', 'JRU Gymnasium ', 'All Students', NULL, NULL, NULL, NULL, 1500, '1000 - Decorations\r\n500 - Refreshments ', '13914-H_30908.pdf', 'Rejected', 1, '2022-10-13', '2022-11-03', 'Already been done'),
(56, 1, 12, 3, 'Feeding Program', 'Trisha Pega', 'COMSOC', 'Outreach', 'Onsite', 'To help malnourished kids', NULL, '2022-10-31 17:08:00', '2022-10-31 21:00:00', 'Kalentong St. ', 'Officers/Volunteer', NULL, NULL, NULL, NULL, 3000, '03::3000', '13914-H_30908.pdf', 'Reschedule', 4, '2022-10-13', '2022-11-10', ''),
(60, 1, 12, 3, 'RSO Renewal', 'Trisha Pega', 'Comsoc officers', 'Other', 'Onsite', 'Application for RSO Renewal in coordination with SDO and CSC.', NULL, '2022-11-03 17:42:00', '2022-11-03 23:00:00', 'SDO Office', 'Comsoc officers', NULL, NULL, NULL, NULL, 1000, 'refreshments - 1000', '99172-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'Done', 4, '2022-11-03', '2022-11-03', 'approved'),
(61, 1, 12, 3, 'Mass Induction', 'Trisha Pega', 'JRU', 'Assembly', 'Onsite', 'Oath taking of all RSO officers', NULL, '2022-11-03 18:00:00', '2022-11-03 17:44:00', 'JRU Auditorium', 'RSO officers', NULL, NULL, NULL, NULL, 1000, '1000 - refreshments', '63785-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'Done', 4, '2022-11-03', '2022-11-03', 'approved'),
(62, 1, 12, 3, 'Freshmen Orientation and Pinning Ceremony', 'Trisha Pega', 'COMSOC', 'Assembly', 'Onsite', 'Face-to-Face and Back-to-Back Event', NULL, '2022-11-03 17:45:00', '2022-11-03 18:00:00', 'JRU Auditorium', 'freshmen and comsoc officers', NULL, NULL, NULL, NULL, 3000, '1000 - refreshments\r\n2000 - speaker', '28881-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'Done', 4, '2022-11-03', '2022-11-03', 'approved'),
(63, 1, 12, 3, 'ComSoc Technology and Innovation Seminar Series', 'Trisha Pega', 'COMSOC', 'Seminar', 'Onsite', 'Cyber Security Seminar', NULL, '2022-11-03 17:47:00', '2022-11-03 17:47:00', 'JRU Auditorium', 'COMSOC Members', NULL, NULL, NULL, NULL, 2500, '1000 - refreshments\r\n1500 - fees', '52619-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'Done', 4, '2022-11-03', '2022-11-03', 'approved'),
(64, 1, 12, 3, 'ComSoc Rebranding: Logo Design Competition', 'Trisha Pega', 'COMSOC', 'Competition', 'Online', 'To promote ComSoc by rebranding the look and feel of the logo with a new visual identity', NULL, '2022-11-11 10:00:00', '2022-11-14 20:00:00', 'Zoom', 'Comsoc Members', NULL, NULL, NULL, NULL, 0, 'None', '29465-1A-ComSoc_Proposal-Assembly_GeneralAssembly.pdf', 'Reschedule', 4, '2022-11-03', '2022-11-03', ''),
(68, 1, 12, 3, 'Courtesy Call with VKF', '', 'RSO Presidents with VKF', 'Assembly', 'Onsite', 'Courtesy Call of RSO Presidents with VKF to present the flagship activities.\r\n', NULL, '2022-11-10 18:02:00', '2022-11-20 18:02:00', 'JRU Quadrangle', ' RSO Presidents with VKF', NULL, NULL, NULL, NULL, 7000, '01::3000;;03::4000', '48040-1D-F-ITO-001-ComSoc-General Assembly-IT Request Form.pdf', 'For Revision', 1, '2022-11-03', '2022-11-03', 'revise this'),
(69, 1, 12, 3, 'COMSOC Acquaintance Event', 'Trisha Pega', 'COMSOC', 'Socialization/Teambuilding', 'Online', 'Get to know comsoc officers and members', NULL, '2022-11-05 10:00:00', '2022-11-03 10:00:00', 'Zoom', 'Comsoc Members', NULL, NULL, NULL, NULL, 1500, '1500 - online fees', '90444-1D-F-ITO-001-ComSoc-General Assembly-IT Request Form.pdf', 'For Revision', 1, '2022-11-03', '2022-11-03', 'Revise date'),
(71, 1, 12, 3, 'COMSOC Coding Seminar', '', 'COMSOC and JPCS', 'Curricular', 'Online', 'Learn Coding with the help of the Junior Philippine Computer Society', NULL, '2022-11-08 10:00:00', '2022-11-09 18:00:00', 'Zoom', 'COMSOC members', NULL, NULL, NULL, NULL, 5000, '5000 - talent fee', '58412-', 'Reschedule', 1, '2022-11-03', '2022-11-08', 'Approved'),
(72, 5, 12, 3, 'COMSOC Esports Tryouts', 'Trisha Pega', 'COMSOC', 'Competition', 'Online', 'Tryout for esports comsoc edition', NULL, '2022-11-07 12:12:00', '2022-11-08 12:12:00', 'ZOOM', 'COMSOC Members', NULL, NULL, NULL, NULL, 5000, '02::5000', '62274-11250-eventproposalforms.rar', 'Approved', 4, '2022-11-04', '2022-11-15', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_questions`
--

CREATE TABLE `tb_questions` (
  `id` int(30) NOT NULL,
  `question` text NOT NULL,
  `frm_option` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `order_by` int(11) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_questions`
--

INSERT INTO `tb_questions` (`id`, `question`, `frm_option`, `type`, `order_by`, `survey_id`, `date_created`) VALUES
(1, 'Sample Survey Question using Radio Button', '{\"cKWLY\":\"Option 1\",\"esNuP\":\"Option 2\",\"dAWTD\":\"Option 3\",\"eZCpf\":\"Option 4\"}', 'radio_opt', 3, 1, '2020-11-10 12:04:46'),
(2, 'Question for Checkboxes', '{\"qCMGO\":\"Checkbox label 1\",\"JNmhW\":\"Checkbox label 2\",\"zZpTE\":\"Checkbox label 3\",\"dOeJi\":\"Checkbox label 4\"}', 'check_opt', 2, 1, '2020-11-10 12:25:13'),
(4, 'Sample question for the text field', '', 'textfield_s', 1, 1, '2020-11-10 13:34:21');

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
(1, 17, 19255532, 'Trisha Pega', 'Test123123 asdasdasd', 'Approved', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_signatories`
--

CREATE TABLE `tb_signatories` (
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
  `profile_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_signatories`
--

INSERT INTO `tb_signatories` (`school_id`, `first_name`, `last_name`, `email`, `password`, `signatory_type`, `usertype_id`, `signatorytype_id`, `college_dept`, `org_id`, `account_created`, `profile_pic`) VALUES
(18202422, 'John', 'Doe', 'john.doe@jru.edu', '7c222fb2927d828af22f592134e8932480637c0d', NULL, 3, 1, NULL, NULL, '2022-10-26', 'img_avatar.png'),
(19123412, 'Emerson', 'Flores', 'emerson.flores@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 'Student Adviser', 3, 3, 3, 12, '2022-10-26', 'img_avatar.png'),
(19255561, 'Jyr Marie', 'Reyes', 'jyrmarie.reyes@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 'Student Adviser', 3, 3, 3, 12, '2022-10-26', 'img_avatar.png'),
(19255562, 'Liza', 'Reyes', 'liza.reyes@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 'Dean', 3, 2, 3, NULL, '2022-10-26', 'img_avatar.png');

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
  `profile_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_signatories_archive`
--

INSERT INTO `tb_signatories_archive` (`school_id`, `first_name`, `last_name`, `email`, `password`, `signatory_type`, `usertype_id`, `signatorytype_id`, `college_dept`, `org_id`, `account_created`, `profile_pic`) VALUES
(18202422, 'Jane', 'Doe', 'janedoe@jru.edu', '9ad92c6b402eeb3332550ffe00f3970820847d92', 'Adviser', 3, 3, NULL, NULL, NULL, 'img_avatar.png'),
(32232313, 'Lebron', 'James', 'lebron.james@my.jru.edu', 'c5bcb280184841e400abbdc40cf83d9959cf7bc4', 'SDO', 3, 1, NULL, NULL, NULL, 'img_avatar.png');

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
(3, 'Adviser');

-- --------------------------------------------------------

--
-- Table structure for table `tb_students`
--

CREATE TABLE `tb_students` (
  `STUDENT_ID` int(9) NOT NULL,
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
  `VCODE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_students`
--

INSERT INTO `tb_students` (`STUDENT_ID`, `LAST_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `BIRTHDATE`, `AGE`, `GENDER`, `YEAR_LEVEL`, `EMAIL`, `PASSWORD`, `COLLEGE_DEPT`, `COURSE`, `SECTION`, `MORG_ID`, `ORG_ID`, `ORG_IDS`, `USER_TYPE`, `ACCOUNT_CREATED`, `PROFILE_PIC`, `VCODE`) VALUES
(17401211, 'Legaspi', 'Bienvenido', 'Argote', '2000-06-13', 22, 'Male', '4', 'bienvenido.legaspiii@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 17, NULL, '', 2, '2022-10-19', 'img_avatar.png', ''),
(18255530, 'Morales', 'Karlo Redeemer', 'R', '1995-03-20', 27, 'Male', '4', 'karloredeemer.morales@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 2, 'Bachelor of Arts (AB) Major in Economics', '401I', 6, NULL, '', 1, '2022-10-13', 'img_avatar.png', ''),
(19255515, 'Ayala', 'Jose Ricardo', 'J', '1999-06-17', 23, 'Male', '4', 'josericardo.ayala@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', ''),
(19255531, 'Saludo', 'Troy', '', '1999-08-09', 23, 'Male', '4', 'troy.saludo@my.jru.edu', '7c222fb2927d828af22f592134e8932480637c0d', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '[23],[24]', 1, '2022-10-13', '45391-JRU Virtual Background 22_23 (3).jpg', ''),
(19255532, 'Pega', 'Trisha', '', '1999-07-09', 23, 'Female', '4', 'trisha.pega@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, ',[17]', 1, '2022-10-13', '90883-309216109_802196107715395_8902535727642330451_n.png', ''),
(19255533, 'Distajo', 'Mikka', '', '2000-12-07', 21, 'Female', '4', 'mikka.distajo@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', ''),
(19255540, 'Cataneda', 'Candid Patrice', 'C', '2000-03-25', 22, 'Female', '4', 'candidpatrice.cataneda@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 5, 'Bachelor of Science in Nursing (BSN)', '401I', 16, NULL, '', 1, '2022-10-13', 'img_avatar.png', ''),
(19255561, 'Carreros', 'Kean', 'V', '1999-11-27', 22, 'Male', '4', 'kean.carreros@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 1, 'Bachelor of Arts in Psychology (ABPsy)', '401I', 3, NULL, '', 1, '2022-10-13', 'img_avatar.png', ''),
(19255570, 'Gabas', 'May Ann', 'G', '2000-06-05', 22, 'Female', '4', 'mayann.gabas@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', ''),
(20255530, 'Vizcarra', 'Ericka', 'R', '2000-09-03', 22, 'Female', '3', 'ericka.vizcarra@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 4, 'Bachelor of Science in Hospitality Management (BSHM)', '302I', 15, NULL, '', 1, '2022-10-13', 'img_avatar.png', ''),
(20259030, 'Salopaso', 'Justine', 'E', '1999-03-23', 23, 'Male', '4', 'justine.salopaso@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 2, 'Bachelor of Science in Business Administration (BSBA) Major in Banking and Finance', '401I', 7, NULL, '', 1, '2022-10-13', 'img_avatar.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_students_archive`
--

CREATE TABLE `tb_students_archive` (
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
  `VCODE` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_surveyresult`
--

CREATE TABLE `tb_surveyresult` (
  `RESULTS_ID` int(10) NOT NULL,
  `ORG_ID` int(2) NOT NULL,
  `event_id` int(9) NOT NULL,
  `response` varchar(8000) NOT NULL,
  `date` date NOT NULL
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
(1667534650, 'JRU Election Survey', 'An evaluation survey regarding the recent elections', '2022-11-04', '2022-11-04', 12);

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
(37, 1667534650, 62, 19255532, '[2]', 1667495548),
(38, 1667495356, 39, 19255532, '[0]', 1667495548),
(39, 1667495356, 40, 19255532, 'None so far', 1667495548),
(40, 1667495356, 38, 19255532, '4', 1667495548),
(41, 1667495356, 39, 19255532, '[0]', 1667495548),
(42, 1667495356, 40, 19255532, 'None so far', 1667495548);

-- --------------------------------------------------------

--
-- Table structure for table `tb_survey_questions`
--

CREATE TABLE `tb_survey_questions` (
  `question_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  `choices` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_survey_questions`
--

INSERT INTO `tb_survey_questions` (`question_id`, `survey_id`, `question`, `type`, `choices`) VALUES
(22, 1667349399, 'sadsad sadsadsadas', 4, 'cb1;;cb2;;cb3'),
(23, 1667349399, 'asdsadas dsad asda sda s q#2', 7, ''),
(24, 1667349399, 'a sdadasd sada sdsa  text', 1, ''),
(25, 1667349399, 'adasdlkmas ldkmaslkd m text', 2, ''),
(26, 1667349399, 'asakmdlkmsaldk sam numeric', 3, ''),
(27, 1667469689, 'question1 textbox', 1, ''),
(28, 1667469689, 'question 2 multiline textbox', 2, ''),
(29, 1667469689, 'question 3 numeric', 3, ''),
(30, 1667469689, 'question 4 checkboxes', 4, 'cb choice 1;;cb choice 2;;cb choice 3;;cb choice 4'),
(31, 1667469689, 'question 5 radio button', 5, 'radio 1;;radio 2'),
(32, 1667469689, 'question 6 dropdown', 6, 'drop 1;;drop 2;;drop 3'),
(33, 1667469689, 'question 7 rating', 7, ''),
(37, 1667495089, 'Other feedback:', 0, ''),
(38, 1667495356, 'How would you describe your experience with the event?', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied'),
(39, 1667495356, 'Where did you hear about the event', 5, 'JRU Student Organizations Portal;;JRU Website;;Social Media;;Other'),
(40, 1667495356, 'Any suggestions?', 2, ''),
(41, 1667529827, 'test', 1, ''),
(42, 1667529870, 'test', 1, ''),
(51, 1667531577, 'fsafsafsa', 0, ''),
(52, 1667531711, 'dsadsa', 1, ''),
(53, 1667531711, 'dsadad', 2, ''),
(54, 1667531711, 'sadsad', 3, ''),
(55, 1667531711, 'fsafaf', 4, 'fasfasf;;fsdafsadfdf;;fasfas'),
(56, 1667531711, 'fasfasf', 5, 'fasfsaf;;fasfasf;;fsafasfas'),
(57, 1667531711, 'fsafasf', 6, 'fasfsa;;fasfsa;;fassafsa'),
(58, 1667531711, 'asfsafasf', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied'),
(59, 1667534650, 'State your name:', 1, ''),
(60, 1667534650, 'How old are you?', 3, ''),
(61, 1667534650, 'What year level are you?', 5, '1st Year;;2nd Year;;3rd Year;;4th Year'),
(62, 1667534650, 'How would you describe your experience with the election held?', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied'),
(63, 1667534650, 'Any feedback or suggestions?', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_survey_set`
--

CREATE TABLE `tb_survey_set` (
  `id` int(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_survey_set`
--

INSERT INTO `tb_survey_set` (`id`, `title`, `description`, `user_id`, `start_date`, `end_date`, `date_created`) VALUES
(1, 'Sample Survey', 'Sample Only', 0, '2020-11-06', '2020-12-10', '2020-11-10 09:57:47'),
(2, 'Survey 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in tempus turpis, sed fermentum risus. Praesent vitae velit rutrum, dictum massa nec, pharetra felis. Phasellus enim augue, laoreet in accumsan dictum, mollis nec lectus. ', 0, '2020-10-15', '2020-12-30', '2020-11-10 14:12:09'),
(3, 'Survey 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in tempus turpis, sed fermentum risus. Praesent vitae velit rutrum, dictum massa nec, pharetra felis. ', 0, '2020-09-01', '2020-11-27', '2020-11-10 14:12:33'),
(4, 'Survey 23', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in tempus turpis, sed fermentum risus. Praesent vitae velit rutrum, dictum massa nec, pharetra felis. ', 0, '2020-09-10', '2020-11-27', '2020-11-10 14:14:03'),
(5, 'Sample Survey 101', 'Sample only', 0, '2020-10-01', '2020-11-23', '2020-11-10 14:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_thread`
--

CREATE TABLE `tb_thread` (
  `thread_id` bigint(18) NOT NULL,
  `msg_id` bigint(18) NOT NULL,
  `reply_id` bigint(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(21, 19255531, 17, 1, 35, '2022-11-25'),
(22, 19255531, 17, 2, 36, '2022-11-25'),
(23, 19255531, 17, 3, 37, '2022-11-25'),
(24, 19255531, 17, 4, -1, '2022-11-25'),
(25, 19255531, 17, 5, -1, '2022-11-25');

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
-- Indexes for table `tb_answers`
--
ALTER TABLE `tb_answers`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tb_questions`
--
ALTER TABLE `tb_questions`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`school_id`),
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
  ADD PRIMARY KEY (`STUDENT_ID`),
  ADD KEY `student_morg_id_fk` (`MORG_ID`),
  ADD KEY `student_org_id_fk` (`ORG_ID`),
  ADD KEY `student_usertype_id_fk` (`USER_TYPE`),
  ADD KEY `student_college_id_fk` (`COLLEGE_DEPT`);

--
-- Indexes for table `tb_students_archive`
--
ALTER TABLE `tb_students_archive`
  ADD PRIMARY KEY (`STUDENT_ID`);

--
-- Indexes for table `tb_surveyresult`
--
ALTER TABLE `tb_surveyresult`
  ADD PRIMARY KEY (`RESULTS_ID`),
  ADD KEY `suveyResult_org_id_fk` (`ORG_ID`),
  ADD KEY `suveyResult_event_id_fk` (`event_id`);

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
-- Indexes for table `tb_survey_set`
--
ALTER TABLE `tb_survey_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_thread`
--
ALTER TABLE `tb_thread`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `thread_msg_id_fk` (`msg_id`),
  ADD KEY `thread_reply_id_fk` (`reply_id`);

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
-- AUTO_INCREMENT for table `tb_answers`
--
ALTER TABLE `tb_answers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_approval_type`
--
ALTER TABLE `tb_approval_type`
  MODIFY `approval_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_budget_codes`
--
ALTER TABLE `tb_budget_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_candidate`
--
ALTER TABLE `tb_candidate`
  MODIFY `CANDIDATE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tb_collegedept`
--
ALTER TABLE `tb_collegedept`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_course`
--
ALTER TABLE `tb_course`
  MODIFY `course_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_disc_groups`
--
ALTER TABLE `tb_disc_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_disc_topics`
--
ALTER TABLE `tb_disc_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_elections`
--
ALTER TABLE `tb_elections`
  MODIFY `ELECTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_elections_archive`
--
ALTER TABLE `tb_elections_archive`
  MODIFY `ELECTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_notification`
--
ALTER TABLE `tb_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_officers`
--
ALTER TABLE `tb_officers`
  MODIFY `officer_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_officers_archive`
--
ALTER TABLE `tb_officers_archive`
  MODIFY `officer_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_orgs`
--
ALTER TABLE `tb_orgs`
  MODIFY `ORG_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_orgs_archive`
--
ALTER TABLE `tb_orgs_archive`
  MODIFY `ORG_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_position`
--
ALTER TABLE `tb_position`
  MODIFY `POSITION_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_projectmonitoring`
--
ALTER TABLE `tb_projectmonitoring`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tb_questions`
--
ALTER TABLE `tb_questions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_requests`
--
ALTER TABLE `tb_requests`
  MODIFY `req_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_surveys`
--
ALTER TABLE `tb_surveys`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1667534651;

--
-- AUTO_INCREMENT for table `tb_surveys_archive`
--
ALTER TABLE `tb_surveys_archive`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1667531712;

--
-- AUTO_INCREMENT for table `tb_survey_answers`
--
ALTER TABLE `tb_survey_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tb_survey_questions`
--
ALTER TABLE `tb_survey_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tb_survey_set`
--
ALTER TABLE `tb_survey_set`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_usertypes`
--
ALTER TABLE `tb_usertypes`
  MODIFY `usertype_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_votes`
--
ALTER TABLE `tb_votes`
  MODIFY `VOTE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  ADD CONSTRAINT `officers_student_id_fk` FOREIGN KEY (`student_id`) REFERENCES `tb_students` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `officers_usertype_id_fk` FOREIGN KEY (`user_type`) REFERENCES `tb_usertypes` (`usertype_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `req_org_id` FOREIGN KEY (`org_id`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `req_student_id` FOREIGN KEY (`student_id`) REFERENCES `tb_students` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
