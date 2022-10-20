-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 20, 2022 at 04:18 PM
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
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `Sample` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_action`
--

CREATE TABLE `tb_action` (
  `action_id` bigint(18) NOT NULL,
  `action_type` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Bien', 'Legaspi', '', 'bienlegaspi@jru.edu', '7c222fb2927d828af22f592134e8932480637c0d', NULL, NULL, 'img_avatar.png'),
(21212121, 'admin', '123', '', 'admin123@jru.edu', '7c222fb2927d828af22f592134e8932480637c0d', NULL, NULL, 'img_avatar.png'),
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
-- Table structure for table `tb_audit_trail`
--

CREATE TABLE `tb_audit_trail` (
  `audit_id` bigint(18) NOT NULL,
  `action_id` bigint(18) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_candidate`
--

CREATE TABLE `tb_candidate` (
  `CANDIDATE_ID` int(2) NOT NULL,
  `ORG_ID` int(2) DEFAULT NULL,
  `POSITION_ID` int(2) DEFAULT NULL,
  `STUDENT_NO` int(9) DEFAULT NULL,
  `LAST_NAME` varchar(50) DEFAULT NULL,
  `FIRST_NAME` varchar(50) DEFAULT NULL,
  `MIDDLE_INITIAL` varchar(2) DEFAULT NULL,
  `course` varchar(10) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_candidate`
--

INSERT INTO `tb_candidate` (`CANDIDATE_ID`, `ORG_ID`, `POSITION_ID`, `STUDENT_NO`, `LAST_NAME`, `FIRST_NAME`, `MIDDLE_INITIAL`, `course`, `section`) VALUES
(4, 12, 1, 17401211, 'Legaspi', 'Bienvenido', NULL, NULL, '402I');

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
(7, 'Bachelor of Science in Criminology (BSCrim)', 1),
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
(26, 'Bachelor of Science in Entertainment and Multimedia Computing (BSEMC) Major in Digital Animation Tech', 3),
(27, 'Bachelor of Science in Information Technology (BSIT-AGD) Major in Animation and Game Development', 3),
(28, 'Bachelor of Science in Hospitality Management (BSHM)', 4),
(29, 'Bachelor of Science in Hospitality Management (BSHM – CM) Major in Cruise Management ', 4),
(30, 'Bachelor of Science in Tourism Management (BSTM)', 4),
(31, 'Bachelor of Science in Nursing (BSN)', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc`
--

CREATE TABLE `tb_disc` (
  `disc_id` int(11) NOT NULL,
  `disc_topic_id` int(11) DEFAULT NULL,
  `ORG_ID` int(2) DEFAULT NULL,
  `officer_id` int(2) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `no_of_replies` int(11) DEFAULT NULL,
  `reply_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc_reply`
--

CREATE TABLE `tb_disc_reply` (
  `reply_id` int(11) NOT NULL,
  `reply` int(11) NOT NULL,
  `disc_id` int(11) NOT NULL,
  `disc_topic_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `subj_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc_subj`
--

CREATE TABLE `tb_disc_subj` (
  `subj_id` int(255) NOT NULL,
  `subject` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_disc_subj`
--

INSERT INTO `tb_disc_subj` (`subj_id`, `subject`) VALUES
(1, 'General Discussion'),
(2, 'Introductions'),
(3, 'Announcements'),
(4, 'Officers Discussion');

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc_topic`
--

CREATE TABLE `tb_disc_topic` (
  `disc_topic_id` int(11) NOT NULL,
  `org_id` int(2) NOT NULL,
  `subj_id` int(255) DEFAULT NULL,
  `topic_desc` varchar(9000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `event_id` int(10) NOT NULL,
  `ORG_ID` int(2) NOT NULL,
  `event` varchar(9000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_morg`
--

CREATE TABLE `tb_morg` (
  `MORG_ID` int(2) NOT NULL,
  `MOTHER_ORG` varchar(100) NOT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_morg`
--

INSERT INTO `tb_morg` (`MORG_ID`, `MOTHER_ORG`, `logo`, `college_id`, `course_id`) VALUES
(1, 'Association of Students of History (ASH)', 'jrusop-logo2.png', 1, NULL),
(2, 'Criminal Justice Students Society (CJSS)', 'ACE(Crim).jpg', 1, NULL),
(3, 'Liberal Arts Students Organization (LASO)', 'jrusop-logo2.png', 1, NULL),
(4, 'Mathematics Society (MATHSOC)', 'ACE(Math).jpg', 1, NULL),
(5, 'Young, Educators Society (YES)', 'ACE(Educ).jpg', 2, NULL),
(6, 'Junior Finance and Economics Society (JFINECS)', 'jrusop-logo2.png', 2, NULL),
(7, 'Junior Philippine Institute of Accountants (JPIA)', 'jrusop-logo2.png', 2, NULL),
(8, 'Management Society (MANSOC)', 'BA(managemenrSoc).jpg', 2, NULL),
(9, 'Supply Management Society (SMS)', 'BA(supplyMan).jpg', 2, NULL),
(10, 'Young Marketers Association (YMA)', 'BA(YoungMarketers).jpg', 2, NULL),
(11, 'Auxiliary of Computer Engineering Students (ACES)', 'jrusop-logo2.png', 3, NULL),
(12, 'Computer Society (COMSOC)', 'COMSOC.png', 3, NULL),
(13, 'Electronics Engineering League (ECEL)', 'CSE(electronicEngLeague).jpg', 3, NULL),
(14, 'Association of Tourism Management Students (ATOMS)', 'jrusop-logo2.png', 4, NULL),
(15, 'Hospitality, Hotelier and Restaurateur Society (HHRS)', 'CHTM(hospitalityIndusaFutureProf).jpg', 4, NULL),
(16, 'Nursing Society (NURSOC)', 'NursingSociety.jpg', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_msg`
--

CREATE TABLE `tb_msg` (
  `msg_id` bigint(18) NOT NULL,
  `Msg` varchar(9000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_msg_reply`
--

CREATE TABLE `tb_msg_reply` (
  `msg_reply_id` bigint(18) NOT NULL,
  `msg` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(19255532, 9, 1, 'Pega', 'Trisha', '', '1999-07-09', 23, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'trisha.pega@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, '62803-profile.jpg', '2022-10-13'),
(19255533, 10, 2, 'Distajo', 'Mikka', '', '2000-12-07', 21, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'mikka.distajo@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', '2022-10-13'),
(19255515, 11, 3, 'Ayala', 'Jose Ricardo', 'J', '1999-06-17', 23, 'Male', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'josericardo.ayala@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', '2022-10-13'),
(19255570, 12, 4, 'Gabas', 'May Ann', 'G', '2000-06-05', 22, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'mayann.gabas@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', '2022-10-13'),
(19255540, 13, 5, 'Cataneda', 'Candid Patrice', 'C', '2000-03-25', 22, 'Female', '4', 5, 'Bachelor of Science in Nursing (BSN)', '401I', 'candidpatrice.cataneda@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 16, 2, 'img_avatar.png', '2022-10-13');

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
  `college_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_orgs`
--

INSERT INTO `tb_orgs` (`ORG_ID`, `ORG`, `logo`, `college_id`) VALUES
(1, 'Association of Students of History (ASH)', 'jrusop-logo2.png', 1),
(2, 'Criminal Justice Students Society (CJSS)', 'ACE(Crim).jpg', 1),
(3, 'Liberal Arts Students Organization (LASO)', 'jrusop-logo2.png', 1),
(4, 'Mathematics Society (MATHSOC)', 'ACE(Math).jpg', 1),
(5, 'Young, Educators Society (YES)', 'ACE(Educ).jpg', 1),
(6, 'Junior Finance and Economics Society (JFINECS)', 'jrusop-logo2.png', 2),
(7, 'Junior Philippine Institute of Accountants (JPIA)', 'jrusop-logo2.png', 2),
(8, 'Management Society (MANSOC)', 'BA(managemenrSoc).jpg', 2),
(9, 'Supply Management Society (SMS)', 'BA(supplyMan).jpg', 2),
(10, 'Young Marketers Association (YMA)', 'BA(YoungMarketers).jpg', 2),
(11, 'Auxiliary of Computer Engineering Students (ACES)', 'jrusop-logo2.png', 3),
(12, 'Computer Society (COMSOC)', 'COMSOC.png', 3),
(13, 'Electronics Engineering League (ECEL)', 'CSE(electronicEngLeague).jpg', 3),
(14, 'Association of Tourism Management Students (ATOMS)', 'jrusop-logo2.png', 4),
(15, 'Hospitality, Hotelier and Restaurateur Society (HHRS)', 'CHTM(hospitalityIndusaFutureProf).jpg', 4),
(16, 'Nursing Society (NURSOC)', 'NursingSociety.jpg', 5),
(17, 'José Rizal University Book Buddies', 'jrusop-logo2.png', NULL),
(18, 'Young Rizalian Servant Leaders (YRSL)', 'jrusop-logo2.png', NULL),
(19, 'Golden Z Club', 'jrusop-logo2.png', NULL),
(20, 'International Students Association (ISA)', 'jrusop-logo2.png', NULL),
(21, 'José Rizal University Chorale', 'jrusop-logo2.png', NULL),
(22, 'José Rizal University Dance Troupe', 'jrusop-logo2.png', NULL),
(23, 'Teatro Rizal', 'jrusop-logo2.png', NULL),
(24, 'Junior Photographic Editors and Graphic Artists (JPEG)', 'jrusop-logo2.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_orgs_archive`
--

CREATE TABLE `tb_orgs_archive` (
  `ORG_ID` int(2) NOT NULL,
  `ORG` varchar(100) NOT NULL,
  `college_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pkanswerkey`
--

CREATE TABLE `tb_pkanswerkey` (
  `question_id` int(9) NOT NULL,
  `answer` varchar(8000) NOT NULL,
  `student_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pkapplykey`
--

CREATE TABLE `tb_pkapplykey` (
  `INTERVIEW` varchar(8000) NOT NULL,
  `STUDENT_ID` int(9) NOT NULL,
  `ORG_ID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pkcastkey`
--

CREATE TABLE `tb_pkcastkey` (
  `VOTE_ID` int(2) NOT NULL,
  `STUDENT_NO` int(9) NOT NULL,
  `POSITION_ID` int(2) NOT NULL,
  `CANDIDATE_VOTED` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `course_id` int(11) DEFAULT NULL,
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
  `status` varchar(100) DEFAULT NULL,
  `date_submitted` date DEFAULT NULL,
  `status_date` date DEFAULT NULL,
  `remarks` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_projectmonitoring`
--

INSERT INTO `tb_projectmonitoring` (`project_id`, `position_id`, `org_id`, `course_id`, `project_name`, `requested_by`, `organizer`, `project_type`, `project_category`, `objectives`, `project_desc`, `start_date`, `end_date`, `venue`, `participants`, `no_of_participants`, `beneficiary`, `no_of_beneficiary`, `budget_source`, `estimated_budget`, `budget_req`, `attachments`, `status`, `date_submitted`, `status_date`, `remarks`) VALUES
(54, 1, 12, NULL, 'ESports', 'Trisha Pega', ' ', 'Extra Curricular', 'Onsite', 'For students to have fun', NULL, '2022-10-17 17:01:00', '2022-10-24 17:01:00', 'JRU Guadrangle ', 'Students', NULL, NULL, NULL, NULL, 2000, '1000 - cash prize\r\n1500 - Trophy\r\n500 - Banners', '13914-H_30908.pdf', 'Pending', '2022-10-13', '2022-10-13', NULL),
(55, 1, 12, NULL, 'CSE Week 2022', 'Trisha Pega', 'COMSOC', 'Curricular', 'Onsite', 'a fun week for students of Computer Science Engineering ', NULL, '2022-10-16 17:06:00', '2022-10-23 17:06:00', 'JRU Gymnasium ', 'All Students', NULL, NULL, NULL, NULL, 1500, '1000 - Decorations\r\n500 - Refreshments ', '13914-H_30908.pdf', 'Pending', '2022-10-13', '2022-10-13', NULL),
(56, 1, 12, NULL, 'Feeding Program', 'Trisha Pega', 'COMSOC', 'Outreach', 'Onsite', 'To help malnourished kids', NULL, '2022-10-31 17:08:00', '2022-10-31 21:00:00', 'Kalentong St. ', 'Officers/Volunteer', NULL, NULL, NULL, NULL, 3000, '3000- food', '13914-H_30908.pdf', 'Pending', '2022-10-13', '2022-10-13', NULL),
(57, 5, 16, NULL, 'Sample Project 9', 'Candid Patrice Cataneda', 'NURSOC', 'Curricular', 'Onsite', 'Sample OBJ', NULL, '2022-10-20 22:06:00', '2022-10-21 22:00:00', 'JRU Quadrangle', 'JRU Students', NULL, NULL, NULL, NULL, 1500, '1500 - Food and bev', '66140-H_30908.pdf', 'Pending', '2022-10-20', '2022-10-20', NULL);

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
-- Table structure for table `tb_results`
--

CREATE TABLE `tb_results` (
  `RESULTS_ID` int(2) NOT NULL,
  `ORG_ID` int(2) NOT NULL,
  `RESULTS` int(3) NOT NULL,
  `CANDIDATE_ID` int(2) NOT NULL,
  `TOTAL_COUNT` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(19123412, 'Emerson', 'Flores', 'emerson.flores@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 'Student Adviser', NULL, NULL, NULL, NULL, NULL, NULL),
(19255561, 'Jyr Marie', 'Reyes', 'jyrmarie.reyes@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 'Student Adviser', NULL, NULL, NULL, NULL, NULL, NULL),
(19255562, 'Liza', 'Reyes', 'liza.reyes@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 'SDO', NULL, NULL, NULL, NULL, NULL, NULL);

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
  `USER_TYPE` int(2) DEFAULT NULL,
  `ACCOUNT_CREATED` date DEFAULT NULL,
  `PROFILE_PIC` varchar(8000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_students`
--

INSERT INTO `tb_students` (`STUDENT_ID`, `LAST_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `BIRTHDATE`, `AGE`, `GENDER`, `YEAR_LEVEL`, `EMAIL`, `PASSWORD`, `COLLEGE_DEPT`, `COURSE`, `SECTION`, `MORG_ID`, `ORG_ID`, `USER_TYPE`, `ACCOUNT_CREATED`, `PROFILE_PIC`) VALUES
(17401211, 'Legaspi', 'Bienvenido', 'Argote', '2000-06-13', 22, 'Male', '4', 'bienvenido.legaspiii@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 8, NULL, 1, '2022-10-19', 'img_avatar.png'),
(18255530, 'Morales', 'Karlo Redeemer', 'R', '1995-03-20', 27, 'Male', '4', 'karloredeemer.morales@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 2, 'Bachelor of Arts (AB) Major in Economics', '401I', 6, NULL, 1, '2022-10-13', 'img_avatar.png'),
(19255515, 'Ayala', 'Jose Ricardo', 'J', '1999-06-17', 23, 'Male', '4', 'josericardo.ayala@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, 1, '2022-10-13', 'img_avatar.png'),
(19255531, 'Saludo', 'Troy', '', '1999-08-09', 23, 'Male', '4', 'troy.saludo@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, 1, '2022-10-13', 'img_avatar.png'),
(19255532, 'Pega', 'Trisha', '', '1999-07-09', 23, 'Female', '4', 'trisha.pega@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, 1, '2022-10-13', '24690-profile.jpg'),
(19255533, 'Distajo', 'Mikka', '', '2000-12-07', 21, 'Female', '4', 'mikka.distajo@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, 1, '2022-10-13', 'img_avatar.png'),
(19255540, 'Cataneda', 'Candid Patrice', 'C', '2000-03-25', 22, 'Female', '4', 'candidpatrice.cataneda@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 5, 'Bachelor of Science in Nursing (BSN)', '401I', 16, NULL, 1, '2022-10-13', 'img_avatar.png'),
(19255561, 'Carreros', 'Kean', 'V', '1999-11-27', 22, 'Male', '4', 'kean.carreros@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 1, 'Bachelor of Arts in Psychology (ABPsy)', '401I', 3, NULL, 1, '2022-10-13', 'img_avatar.png'),
(19255570, 'Gabas', 'May Ann', 'G', '2000-06-05', 22, 'Female', '4', 'mayann.gabas@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, 1, '2022-10-13', 'img_avatar.png'),
(20255530, 'Vizcarra', 'Ericka', 'R', '2000-09-03', 22, 'Female', '3', 'ericka.vizcarra@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 4, 'Bachelor of Science in Hospitality Management (BSHM)', '302I', 15, NULL, 1, '2022-10-13', 'img_avatar.png'),
(20259030, 'Salopaso', 'Justine', 'E', '1999-03-23', 23, 'Male', '4', 'justine.salopaso@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 2, 'Bachelor of Science in Business Administration (BSBA) Major in Banking and Finance', '401I', 7, NULL, 1, '2022-10-13', 'img_avatar.png');

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
  `USER_TYPE` int(2) DEFAULT NULL,
  `ACCOUNT_CREATED` date DEFAULT NULL,
  `PROFILE_PIC` varchar(8000) DEFAULT NULL
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
-- Table structure for table `tb_vote`
--

CREATE TABLE `tb_vote` (
  `VOTE_ID` int(2) NOT NULL,
  `ORG_ID` int(2) NOT NULL,
  `POSITION_ID` int(2) NOT NULL,
  `CANDIDATE_ID` int(2) NOT NULL,
  `VOTE_COUNT` int(3) NOT NULL,
  `RESULTS` int(3) NOT NULL,
  `DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_action`
--
ALTER TABLE `tb_action`
  ADD PRIMARY KEY (`action_id`);

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
-- Indexes for table `tb_audit_trail`
--
ALTER TABLE `tb_audit_trail`
  ADD PRIMARY KEY (`audit_id`),
  ADD KEY `auditTrail_action_id_fk` (`action_id`);

--
-- Indexes for table `tb_candidate`
--
ALTER TABLE `tb_candidate`
  ADD PRIMARY KEY (`CANDIDATE_ID`),
  ADD KEY `candidate_org_id_fk` (`ORG_ID`),
  ADD KEY `candidate_position_id_fk` (`POSITION_ID`),
  ADD KEY `candidate_studentid_fk` (`STUDENT_NO`);

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
-- Indexes for table `tb_disc`
--
ALTER TABLE `tb_disc`
  ADD PRIMARY KEY (`disc_id`),
  ADD KEY `disc_discTopic_id_fk` (`disc_topic_id`),
  ADD KEY `disc_org_id_fk` (`ORG_ID`),
  ADD KEY `disc_officer_id_fk` (`officer_id`),
  ADD KEY `disc_reply_id_fk` (`reply_id`);

--
-- Indexes for table `tb_disc_reply`
--
ALTER TABLE `tb_disc_reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `discReply_disc_id_fk` (`disc_id`),
  ADD KEY `discReply_discTopic_id_fk` (`disc_topic_id`),
  ADD KEY `discReply_org_id_fk` (`org_id`),
  ADD KEY `discReply_subj_id_fk` (`subj_id`);

--
-- Indexes for table `tb_disc_subj`
--
ALTER TABLE `tb_disc_subj`
  ADD PRIMARY KEY (`subj_id`);

--
-- Indexes for table `tb_disc_topic`
--
ALTER TABLE `tb_disc_topic`
  ADD PRIMARY KEY (`disc_topic_id`),
  ADD KEY `discTopic_org_id_fk` (`org_id`),
  ADD KEY `discTopic_subj_id_fk` (`subj_id`);

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `event_org_id_fk` (`ORG_ID`);

--
-- Indexes for table `tb_morg`
--
ALTER TABLE `tb_morg`
  ADD PRIMARY KEY (`MORG_ID`),
  ADD KEY `morg_college_id_fk` (`college_id`),
  ADD KEY `morg_course_id_fk` (`course_id`);

--
-- Indexes for table `tb_msg`
--
ALTER TABLE `tb_msg`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `tb_msg_reply`
--
ALTER TABLE `tb_msg_reply`
  ADD PRIMARY KEY (`msg_reply_id`);

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
  ADD KEY `orgs_college_id_fk` (`college_id`);

--
-- Indexes for table `tb_orgs_archive`
--
ALTER TABLE `tb_orgs_archive`
  ADD PRIMARY KEY (`ORG_ID`),
  ADD KEY `orgs_college_id_fk` (`college_id`);

--
-- Indexes for table `tb_pkanswerkey`
--
ALTER TABLE `tb_pkanswerkey`
  ADD KEY `pkAnswerKey_studentID_fk` (`student_id`);

--
-- Indexes for table `tb_pkapplykey`
--
ALTER TABLE `tb_pkapplykey`
  ADD KEY `student_applyKeyStudentID_fk` (`STUDENT_ID`),
  ADD KEY `student_appleKeyOrgID_fk` (`ORG_ID`);

--
-- Indexes for table `tb_pkcastkey`
--
ALTER TABLE `tb_pkcastkey`
  ADD KEY `pkCastkey_voteID_fk` (`VOTE_ID`),
  ADD KEY `pkCastkey_studentNO_fk` (`STUDENT_NO`),
  ADD KEY `pkCastkey_positionID_fk` (`POSITION_ID`);

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
  ADD KEY `project_course_id` (`course_id`),
  ADD KEY `project_org_id` (`org_id`),
  ADD KEY `project_position_id` (`position_id`);

--
-- Indexes for table `tb_questions`
--
ALTER TABLE `tb_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_results`
--
ALTER TABLE `tb_results`
  ADD PRIMARY KEY (`RESULTS_ID`),
  ADD KEY `result_org_id_fk` (`ORG_ID`),
  ADD KEY `result_candidate_id_fk` (`CANDIDATE_ID`);

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
-- Indexes for table `tb_vote`
--
ALTER TABLE `tb_vote`
  ADD PRIMARY KEY (`VOTE_ID`),
  ADD KEY `vote_org_id_fk` (`ORG_ID`),
  ADD KEY `vote_position_id_fk` (`POSITION_ID`),
  ADD KEY `vote_candidate_id_fk` (`CANDIDATE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_answers`
--
ALTER TABLE `tb_answers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_candidate`
--
ALTER TABLE `tb_candidate`
  MODIFY `CANDIDATE_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_officers`
--
ALTER TABLE `tb_officers`
  MODIFY `officer_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_officers_archive`
--
ALTER TABLE `tb_officers_archive`
  MODIFY `officer_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_projectmonitoring`
--
ALTER TABLE `tb_projectmonitoring`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tb_questions`
--
ALTER TABLE `tb_questions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `admin_usertype_id_fk` FOREIGN KEY (`USERTYPE_ID`) REFERENCES `tb_usertypes` (`usertype_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_audit_trail`
--
ALTER TABLE `tb_audit_trail`
  ADD CONSTRAINT `auditTrail_action_id_fk` FOREIGN KEY (`action_id`) REFERENCES `tb_action` (`action_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_candidate`
--
ALTER TABLE `tb_candidate`
  ADD CONSTRAINT `candidate_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidate_position_id_fk` FOREIGN KEY (`POSITION_ID`) REFERENCES `tb_position` (`POSITION_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_course`
--
ALTER TABLE `tb_course`
  ADD CONSTRAINT `course_college_id_fk` FOREIGN KEY (`college_id`) REFERENCES `tb_collegedept` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_disc`
--
ALTER TABLE `tb_disc`
  ADD CONSTRAINT `disc_discTopic_id_fk` FOREIGN KEY (`disc_topic_id`) REFERENCES `tb_disc_topic` (`disc_topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disc_officer_id_fk` FOREIGN KEY (`officer_id`) REFERENCES `tb_officers` (`officer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disc_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disc_reply_id_fk` FOREIGN KEY (`reply_id`) REFERENCES `tb_disc_reply` (`reply_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_disc_reply`
--
ALTER TABLE `tb_disc_reply`
  ADD CONSTRAINT `discReply_discTopic_id_fk` FOREIGN KEY (`disc_topic_id`) REFERENCES `tb_disc_topic` (`disc_topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discReply_disc_id_fk` FOREIGN KEY (`disc_id`) REFERENCES `tb_disc` (`disc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discReply_org_id_fk` FOREIGN KEY (`org_id`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discReply_subj_id_fk` FOREIGN KEY (`subj_id`) REFERENCES `tb_disc_subj` (`subj_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_disc_topic`
--
ALTER TABLE `tb_disc_topic`
  ADD CONSTRAINT `discTopic_org_id_fk` FOREIGN KEY (`org_id`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discTopic_subj_id_fk` FOREIGN KEY (`subj_id`) REFERENCES `tb_disc_subj` (`subj_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_morg`
--
ALTER TABLE `tb_morg`
  ADD CONSTRAINT `morg_college_id_fk` FOREIGN KEY (`college_id`) REFERENCES `tb_collegedept` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `morg_course_id_fk` FOREIGN KEY (`course_id`) REFERENCES `tb_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tb_orgs`
--
ALTER TABLE `tb_orgs`
  ADD CONSTRAINT `orgs_college_id_fk` FOREIGN KEY (`college_id`) REFERENCES `tb_collegedept` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pkanswerkey`
--
ALTER TABLE `tb_pkanswerkey`
  ADD CONSTRAINT `pkAnswerKey_studentID_fk` FOREIGN KEY (`student_id`) REFERENCES `tb_students` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pkapplykey`
--
ALTER TABLE `tb_pkapplykey`
  ADD CONSTRAINT `student_appleKeyOrgID_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_applyKeyStudentID_fk` FOREIGN KEY (`STUDENT_ID`) REFERENCES `tb_students` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pkcastkey`
--
ALTER TABLE `tb_pkcastkey`
  ADD CONSTRAINT `pkCastkey_positionID_fk` FOREIGN KEY (`POSITION_ID`) REFERENCES `tb_position` (`POSITION_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkCastkey_studentNO_fk` FOREIGN KEY (`STUDENT_NO`) REFERENCES `tb_students` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkCastkey_voteID_fk` FOREIGN KEY (`VOTE_ID`) REFERENCES `tb_vote` (`VOTE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_projectmonitoring`
--
ALTER TABLE `tb_projectmonitoring`
  ADD CONSTRAINT `project_course_id` FOREIGN KEY (`course_id`) REFERENCES `tb_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_org_id` FOREIGN KEY (`org_id`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_position_id` FOREIGN KEY (`position_id`) REFERENCES `tb_position` (`POSITION_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_results`
--
ALTER TABLE `tb_results`
  ADD CONSTRAINT `result_candidate_id_fk` FOREIGN KEY (`CANDIDATE_ID`) REFERENCES `tb_candidate` (`CANDIDATE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_signatories`
--
ALTER TABLE `tb_signatories`
  ADD CONSTRAINT `signatories_collegedept_fk` FOREIGN KEY (`college_dept`) REFERENCES `tb_collegedept` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `signatories_orgid_fk` FOREIGN KEY (`org_id`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `signatories_type_fk` FOREIGN KEY (`signatorytype_id`) REFERENCES `tb_signatory_type` (`signatory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `signatories_usertype_id_fk` FOREIGN KEY (`usertype_id`) REFERENCES `tb_usertypes` (`usertype_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_students`
--
ALTER TABLE `tb_students`
  ADD CONSTRAINT `student_college_id_fk` FOREIGN KEY (`COLLEGE_DEPT`) REFERENCES `tb_collegedept` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_morg_id_fk` FOREIGN KEY (`MORG_ID`) REFERENCES `tb_morg` (`MORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_usertype_id_fk` FOREIGN KEY (`USER_TYPE`) REFERENCES `tb_usertypes` (`usertype_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_surveyresult`
--
ALTER TABLE `tb_surveyresult`
  ADD CONSTRAINT `suveyResult_event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `tb_event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suveyResult_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_thread`
--
ALTER TABLE `tb_thread`
  ADD CONSTRAINT `thread_msg_id_fk` FOREIGN KEY (`msg_id`) REFERENCES `tb_msg` (`msg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thread_reply_id_fk` FOREIGN KEY (`reply_id`) REFERENCES `tb_msg_reply` (`msg_reply_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_vote`
--
ALTER TABLE `tb_vote`
  ADD CONSTRAINT `vote_candidate_id_fk` FOREIGN KEY (`CANDIDATE_ID`) REFERENCES `tb_candidate` (`CANDIDATE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_position_id_fk` FOREIGN KEY (`POSITION_ID`) REFERENCES `tb_position` (`POSITION_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
