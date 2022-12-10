-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2022 at 03:39 PM
-- Server version: 10.5.16-MariaDB-cll-lve
-- PHP Version: 7.2.34

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
  `ADMIN_ID` varchar(15) NOT NULL,
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
('17-401211', 'Bienvenido', 'Legaspi', '', 'bienvenido.legaspiii@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 4, '2022-11-16', 'img_avatar.png'),
('19-255322', 'Yancie Troy', 'Saludo', '', 'yancietroy.saludo@my.jru.edu', 'c5bcb280184841e400abbdc40cf83d9959cf7bc4', 4, '2022-11-08', '15071-1361802.png'),
('19-255515', 'Jose Ricardo', 'Ayala', '', 'josericardo.ayala@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 4, '2022-11-16', 'img_avatar.png'),
('19-255530', 'Ronalyn', 'Vizcarra', '', 'ronalyn.vizcarra@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 4, '2022-11-16', 'img_avatar.png');

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
(1, '01', 'Transportation'),
(2, '02', 'Utilities'),
(3, '03', 'Food and Beverage'),
(4, '04', 'Talent Fees'),
(5, '05', 'Miscellaneous'),
(6, '06', 'Testing - by ComSocVPE'),
(7, '005', 'Travel');

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
  `STUDENT_NO` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_candidate`
--

INSERT INTO `tb_candidate` (`CANDIDATE_ID`, `ELECTION_ID`, `POSITION_ID`, `STUDENT_NO`) VALUES
(10, 3, 12, '19-255532'),
(15, 13, 1, '19-255515'),
(16, 13, 1, '19-255531'),
(17, 13, 2, '19-255570'),
(24, 12, 1, '19-255515'),
(25, 12, 1, '19-255531'),
(26, 12, 3, '19-255532'),
(27, 12, 3, '19-255570'),
(28, 14, 1, '19-255540'),
(29, 15, 1, '18-255530'),
(30, 16, 1, '19-255532'),
(31, 16, 1, '19-255533'),
(32, 16, 2, '19-255515'),
(33, 16, 2, '19-255570'),
(34, 16, 4, '19-255540'),
(35, 17, 1, '19-255515'),
(36, 17, 2, '19-255531'),
(37, 17, 3, '19-255532'),
(38, 17, 4, '19-255533'),
(40, 18, 1, '19-255532'),
(41, 18, 2, '19-255533'),
(42, 18, 3, '19-255515'),
(43, 18, 4, '19-255570'),
(45, 19, 1, '14-363015'),
(46, 19, 2, '15-300166'),
(47, 19, 2, '17-253161'),
(48, 19, 3, '17-400377'),
(49, 19, 1, '17-401211'),
(51, 19, 4, '18-403234'),
(52, 19, 4, '19-254917'),
(55, 19, 8, '19-255322'),
(56, 19, 8, '19-255515'),
(61, 19, 2, '19-403314'),
(65, 20, 2, '19-255570'),
(66, 20, 1, '19-255322'),
(67, 20, 1, '21-258199'),
(68, 20, 4, '23-261387'),
(69, 20, 4, '22-258983'),
(70, 20, 2, '20-256477'),
(71, 20, 3, '20-257214'),
(72, 20, 6, '23-261983'),
(73, 20, 7, '23-260628'),
(101, 21, 2, '14-363015'),
(102, 21, 3, '17-253161'),
(103, 21, 3, '17-400377'),
(104, 21, 1, '17-401211'),
(105, 21, 4, '19-254917'),
(106, 21, 4, '19-255234'),
(107, 21, 6, '19-255322'),
(108, 21, 6, '19-403314'),
(109, 21, 7, '20-256280'),
(110, 21, 2, '20-257214'),
(111, 21, 7, '20-257791'),
(112, 21, 1, '21-258199'),
(113, 21, 8, '22-258983'),
(117, 23, 4, '19-255570'),
(118, 23, 2, '19-255322'),
(119, 23, 1, '21-258199'),
(120, 23, 3, '23-261387'),
(121, 23, 8, '22-258983'),
(122, 23, 1, '20-256477'),
(123, 23, 2, '20-257214'),
(124, 23, 4, '23-260628'),
(125, 23, 6, '19-255540'),
(126, 23, 7, '19-255561'),
(127, 24, 4, '14-363015'),
(128, 24, 8, '17-253161'),
(129, 24, 8, '17-400321'),
(130, 24, 7, '17-400377'),
(131, 24, 1, '17-401211'),
(132, 24, 7, '18-255530'),
(133, 24, 3, '19-255322'),
(134, 24, 1, '19-255533'),
(135, 24, 3, '20-256477'),
(136, 24, 2, '20-257214'),
(137, 24, 2, '20-257791'),
(138, 24, 4, '23-261983'),
(139, 24, 6, '23-260628'),
(140, 24, 6, '23-261387'),
(141, 25, 4, '14-363015'),
(142, 25, 7, '17-400321'),
(143, 25, 7, '17-400377'),
(144, 25, 8, '18-255530'),
(145, 25, 4, '19-254917'),
(146, 25, 3, '19-255234'),
(147, 25, 3, '19-255322'),
(148, 25, 2, '19-255515'),
(149, 25, 6, '19-255530'),
(150, 25, 2, '20-256280'),
(151, 25, 6, '20-256477'),
(152, 25, 2, '20-257214'),
(153, 25, 1, '20-257791'),
(154, 25, 1, '21-258199'),
(155, 26, 1, '19-255540'),
(156, 27, 4, '14-363015'),
(157, 27, 6, '17-400321'),
(158, 27, 6, '17-400377'),
(159, 27, 1, '17-401211'),
(160, 27, 7, '18-255530'),
(161, 27, 4, '19-254917'),
(162, 27, 7, '19-255234'),
(163, 27, 3, '19-255322'),
(164, 27, 2, '19-255515'),
(165, 27, 7, '19-255530'),
(166, 27, 2, '19-255532'),
(167, 27, 8, '19-255533'),
(168, 27, 8, '19-255567'),
(169, 27, 4, '20-256477'),
(170, 27, 3, '20-257214'),
(171, 27, 6, '20-257791'),
(172, 27, 1, '21-258199'),
(173, 28, 1, '19-255533'),
(174, 28, 2, '19-255515'),
(175, 28, 3, '19-255570'),
(176, 28, 4, '21-258199'),
(177, 28, 6, '23-261387'),
(178, 28, 7, '22-258983'),
(179, 28, 8, '20-256477'),
(180, 28, 1, '20-257214'),
(181, 28, 2, '23-260628'),
(182, 28, 3, '19-255540'),
(183, 28, 4, '19-255561'),
(184, 28, 6, '18-255530'),
(185, 28, 7, '20-259030'),
(186, 28, 8, '19-255532'),
(187, 29, 1, '19-255533'),
(188, 29, 1, '19-255515'),
(189, 29, 2, '19-255570'),
(190, 29, 2, '21-258199'),
(191, 29, 3, '23-261387'),
(192, 29, 3, '22-258983'),
(193, 29, 4, '20-257214'),
(194, 29, 6, '23-260628'),
(195, 29, 6, '19-255540'),
(196, 29, 7, '19-255561'),
(197, 29, 7, '18-255530'),
(198, 29, 8, '19-255532'),
(199, 29, 8, '19-255530'),
(200, 29, 20, '19-254353'),
(201, 29, 20, '15-300210'),
(202, 30, 1, '14-363015'),
(203, 30, 1, '15-300166'),
(204, 30, 2, '17-253161'),
(205, 30, 2, '17-400321'),
(206, 30, 3, '17-400377'),
(207, 30, 3, '17-401211'),
(208, 30, 4, '18-255530'),
(209, 30, 4, '18-403234'),
(210, 30, 7, '19-254559'),
(211, 30, 7, '19-254917'),
(212, 30, 6, '19-255234'),
(213, 30, 6, '19-255322'),
(214, 30, 8, '19-255515'),
(215, 30, 8, '19-255530'),
(216, 30, 20, '19-255532'),
(217, 30, 20, '19-255533');

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
  `status` int(11) DEFAULT 1,
  `edited` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_disc_replies`
--

INSERT INTO `tb_disc_replies` (`reply_id`, `thread_id`, `user_type`, `user_id`, `user_name`, `message`, `status`, `edited`) VALUES
(1667546735, 1667546703, 1, 17401211, 'Bienvenido Legaspi', '<p>Noted pi</p>', 1, 0),
(1667546746, 1667546703, 2, 14, 'Yancie Troy Saludo', '<p>very cool bien</p>', 1, 0),
(1667549564, 1667549518, 1, 20257214, 'Manuel Mark Idul', '<p>verifying - student account</p>', 1, 0),
(1667551126, 1667549518, 2, 11, 'Jose Ricardo Ayala', '<p>Reply sample</p>', 1, 0),
(1667557265, 1667549518, 1, 14363015, 'Aubrey Jane Jaucian', '<p>test</p>', 1, 0),
(1668598110, 1667546703, 1, 19255530, 'Ronalyn Vizcarra', '<p>Thank you for the announcement bien!&nbsp;</p>', 1, 0),
(1668606270, 1667546703, 1, 19255532, 'Trisha Pega', '<p>Thanks bien!</p>', 1, 0),
(1668606367, 1667546703, 1, 19255540, 'Candid Patrice Cataneda', '<p>Noted, bien! thank you!</p>', 1, 0),
(1668606559, 1667546703, 1, 19255561, 'Kean Carreros', '<p>Thanks! bien, I will keep that in mind</p>', 1, 0),
(1668668178, 1668668168, 0, 19255322, 'Yancie Troy Saludo', '<p>test</p>', 1, 0),
(1668668286, 1668668168, 0, 19255322, 'Yancie Troy Saludo', '<p>AAA</p>', 1, 0),
(1668668324, 1668668168, 0, 17401211, 'Bienvenido Legaspi', '<p>Testing</p>', 1, 0),
(1668668374, 1668668368, 0, 17401211, 'Bienvenido Legaspi', '<p>Testing reply</p>', 1, 0),
(1668668484, 1668668168, 1, 17401211, 'Bienvenido Legaspi', '<p>reeeee</p>', 1, 0),
(1668668580, 1668668368, 0, 17401211, 'Bienvenido Legaspi', '<p>Testing</p>', 1, 0),
(1668677458, 1668676693, 1, 18255530, 'Karlo Redeemer Morales', '<p>Hello Rona! I\'m Red short for Redeemer, this discussion forum is cool!&nbsp;</p>', 1, 0),
(1668677510, 1667546703, 1, 18255530, 'Karlo Redeemer Morales', '<p>Thanks! for the announcement Bien! I will keep that in mind.</p>', 1, 0),
(1668677925, 1668676693, 1, 19255561, 'Kean Carreros', '<p>Hello, I\'m Kean Carreros. Glad to be here</p>', 1, 0),
(1668678112, 1668676693, 1, 19255570, 'May Ann Gabas', '<p>Hi, I;m May. Nice to meet you.</p>', 1, 0),
(1668678288, 1668677984, 1, 19255540, 'Candid Patrice Cataneda', '<p>I already answered the survey. The election went smooth by the way.</p>', 1, 0),
(1668678412, 1668676693, 1, 19255540, 'Candid Patrice Cataneda', '<p>Hi everyone! I\'m candid but you can all me Pat! I agree to Red, this is a cool forum.</p>', 1, 0),
(1668678523, 1668676693, 1, 20255530, 'Ericka Vizcarra', '<p>Hello.&nbsp; Nice to meet you. I\'m Erricka Vizcarra</p>', 1, 0),
(1668678954, 1668678825, 1, 19255532, 'Trisha Pega', '<p>trisha.pega@my.jru.edu</p>', 1, 0),
(1668679000, 1668676693, 1, 19255532, 'Trisha Pega', '<p>Hi! My name is Trisha but my friends call me Trish</p>', 1, 0),
(1668679327, 1668676693, 1, 19255515, 'Jose Ricardo Ayala', '<p>Good day everyone. I\'m Jose Ricardo Ayala</p>', 1, 0),
(1668689458, 1668689398, 1, 19255530, 'Ronalyn Vizcarra', '<p>my name is rona</p>', 1, 0),
(1668692180, 1668655813, 2, 14, 'Yancie Troy Saludo', '<p>hello</p>', 1, 0),
(1669087440, 1668677797, 1, 19255322, 'Yancie Troy Saludo', '<p>it was great!</p>', 1, 0),
(1669090938, 1669090909, 1, 22260400, 'Jan Fernan Bondad', '<p>I labyu Stiben</p>', 1, 0),
(1669090951, 1669090909, 1, 22260400, 'Jan Fernan Bondad', '<p>I lab JRU</p>', 1, 0),
(1669090958, 1669090909, 1, 22260400, 'Jan Fernan Bondad', '<p>I labyu Stiben</p>', 1, 0),
(1669548176, 1668679256, 1, 19255322, 'Yancie Troy Saludo', '<p>I already applied thank you!</p>', 1, 0),
(1669548215, 1668678012, 1, 19255322, 'Yancie Troy Saludo', '<p>I suggest a comsoc fun run</p>', 1, 0),
(1669636688, 1667546703, 1, 20257214, 'Manuel Mark Idul', '<p>testing \" and \'</p>', 1, 0),
(1669640934, 1667818407, 1, 17401211, 'Bienvenido Legaspi', '<p>Really Good.<br><br>Edit: Really Good</p>', 1, 1669640947),
(1669804840, 1667902540, 1, 20257214, 'Manuel Mark Idul', '<p>testing \" ; \'</p>', 1, 0);

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
(1667538365, 1, 19255322, 1, 'Yancie Troy Saludo', 'Website Credits', '<p>Thank you for visiting JRUSOP website. This website is created for Jose Rizal University by the <strong>Modern Coders</strong> as part of fulfillments for the IT Project 2 Subject :)</p>\r\n<p>Developed By:</p>\r\n<blockquote>\r\n<p>Bienvenido Legaspi</p>\r\n<p>Yancie Troy Saludo</p>\r\n<p>Ronalyn Vizcarra</p>\r\n<p>Jose Ayala</p>\r\n</blockquote>', 13, 0, 1667538365, 'Yancie Troy Saludo', 1),
(1667546618, 2, 14, 2, 'Yancie Troy Saludo', 'My name is Troy', '<p>Hi my name is troy I am a commitee member in JRU computer society</p>', 10, 0, 1667546618, 'Yancie Troy Saludo', 0),
(1667546703, 1, 17401211, 1, 'Bienvenido Legaspi', 'Announcement', '<p>Announcement Message</p>', 39, 8, 1669636688, 'Manuel Mark Idul', 0),
(1667549518, 1, 21258199, 1, 'Sarah Mae Ong', 'Test General Announcement - SO', '<h1><strong>Title SO</strong></h1>\r\n<p><em>Body SO</em></p>', 22, 3, 1667557265, 'Aubrey Jane Jaucian', 1),
(1667818407, 3, 19255322, 1, 'Yancie Troy Saludo', 'I really like this website', '<p>I think it\'s important for JRU Student Organizations to have a dedicated platform</p>', 18, 1, 1669640934, 'Bienvenido Legaspi', 0),
(1667902540, 4, 19255322, 1, 'Yancie Troy Saludoo', 'Hello who is in charge for the logo rebranding?', '<p>im curious</p>', 8, 1, 1669804840, 'Manuel Mark Idul', 0),
(1668655813, 11, 14, 2, 'Yancie Troy Saludo', 'My name is Troy I am part of REL', '', 2, 1, 1668692180, 'Yancie Troy Saludo', 0),
(1668655839, 11, 14, 2, 'Yancie Troy Saludo', 'Let\'s have fun', '<p>let\'s do it!</p>', 1, 0, 1668655839, 'Yancie Troy Saludo', 0),
(1668669349, 4, 19255322, 0, 'Yancie Troy Saludo', 'Delete thread as example', '<p>demonstrate delete thread</p>', 3, 0, 1668669349, 'Yancie Troy Saludo', 1),
(1668669450, 5, 19255322, 0, 'Yancie Troy Saludo', 'Only COMSOC officers can see this thread', '<p>chat and talk here in real time</p>', 2, 0, 1668669450, 'Yancie Troy Saludo', 0),
(1668676693, 2, 19255530, 1, 'Ronalyn Vizcarra', 'Hello Everyone!', '<p>Hello Everyone! I\'m Rona short for Ronalyn, 23 years old and a BSIT student.&nbsp;</p>', 15, 7, 1668679327, 'Jose Ricardo Ayala', 0),
(1668677797, 2, 31, 2, 'Karlo Redeemer Morales', 'Tell us your experience about the pinning ceremony of the freshmen.', '<p>Hi everyone! how was the pinning ceremony, leave a thread about your experience!</p>', 12, 1, 1669087440, 'Yancie Troy Saludo', 0),
(1668677984, 3, 31, 2, 'Karlo Redeemer Morales', 'Reminders to the students of CSE', '<p>Please give us your feedback about the election held last wednesday.&nbsp;</p>', 10, 1, 1668678288, 'Candid Patrice Cataneda', 0),
(1668678012, 4, 19255561, 1, 'Kean Carreros', 'Upcoming Event Suggestions', '<p>Good day, everyone! Let\'s all suggest events we can hold this school year</p>', 2, 1, 1669548215, 'Yancie Troy Saludo', 0),
(1668678825, 4, 19255533, 1, 'Mikka Distajo', 'Looking For Research Resposndents', '<p>Hello, everyone! Our group is looking for research respondents from computer-related courses. Please reply to this thread with your email to receive access to our survey link. 5 of our respondents has a chance to win 100 peso worth of Gcash. Thank you</p>', 4, 1, 1668678954, 'Trisha Pega', 0),
(1668678942, 1, 19255322, 0, 'Yancie Troy Saludo', 'Welcome to JRUSOP website', '', 6, 0, 1668678942, 'Yancie Troy Saludo', 1),
(1668679256, 4, 20259030, 1, 'Justine Salopaso', 'Looking for MCs for an upcoming event', '<p>Hello everyone! We are looking for emcees for an upcoming ComSoc event. Click the link below to apply.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 4, 1, 1669548176, 'Yancie Troy Saludo', 0),
(1668689398, 12, 35, 2, 'Trisha Pega', 'Welcome my name is troy', '<p>Please introduce yourself in the replies</p>', 5, 1, 1668689458, 'Ronalyn Vizcarra', 0),
(1668692300, 14, 14, 2, 'Yancie Troy Saludo', 'What Esports do you like', '<p>I like Mobile Legends</p>', 1, 0, 1668692300, 'Yancie Troy Saludo', 0),
(1669090909, 2, 20406388, 1, 'Steven Tiu', 'Hello, everyone!', '<p>My name is Steven from BSIT 202I.</p>', 4, 3, 1669090958, 'Jan Fernan Bondad', 0);

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
(1, 1, 'Announcement', 'Latest announcements from JRU', 0, 0, 'bi bi-megaphone-fill\n', NULL, NULL),
(2, 1, 'Introductions', 'New to the platform? Please stop by, say hi and tell us a bit about yourself.', 0, 0, 'bi bi-lightning-charge-fill', NULL, NULL),
(3, 2, 'Reminders', 'Website Reminders', 0, 0, 'bi bi-clipboard-fill', NULL, NULL),
(4, 2, 'COMSOC Discussions only', 'COMSOC related discussions ', 12, 5, '', NULL, NULL),
(5, 3, 'COMSOC Officers', 'For COMSOC Officers Only', 12, 2, '', NULL, NULL),
(11, 3, 'Welcome to Rizalian Esports League', 'Hello welcome to REL', 33, 2, 'bi bi-megaphone-fill', NULL, NULL),
(12, 1, 'JRUSOP Website is up', 'the jrusop wesbite is now active', 12, 0, 'bi bi-megaphone-fill', NULL, NULL),
(13, 1, 'Questions', 'Any questions about the project proposal', 12, 0, 'bi bi-chat-square-dots-fill', NULL, NULL),
(14, 4, 'Officers and Members of REL', 'Only for REL org', 33, 5, 'bi bi-chat-square-dots-fill', NULL, NULL),
(15, 3, 'Proposal Planning', 'Lets talk about it', 33, 2, 'bi bi-chat-square-dots-fill', NULL, NULL),
(16, 1, 'WASSSSSUUUUUUP', 'ESPORTS LEAGUE OF JRU IS HERE!', 33, 0, 'bi bi-lightning-charge-fill', NULL, NULL),
(17, 1, 'Selected demo', 'test', 12, 1, 'bi bi-chat-square-dots-fill', NULL, NULL),
(18, 1, 'Test', 'Test', 12, 6, 'bi bi-chat-square-dots-fill', ';;1;;2;;3;;4', ';;14-363015;;15-300166;;17-401211');

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
(21, 1, 12, 'COMSOC 2022 ELECTIONS', 'The 2022 COMSOC Elections. Please vote wisely.', '2022-11-16', '2022-11-16'),
(23, 0, 0, 'JRU CSC Elections 2022', 'The annual elections of JRU Central Student Council', '2022-11-17', '2022-11-18'),
(24, 1, 12, 'JRU COMSOC Election Demo', 'Demonstrate JRU COMSOC Council Election', '2022-11-17', '2022-11-18'),
(25, 1, 12, 'Sample COMSOC Elections', 'A sample election for the alpha testing demo', '2022-11-22', '2022-11-23'),
(26, 1, 16, 'Test', 'Test Nursoc', '2022-11-22', '2022-11-23'),
(27, 1, 12, 'COMSOC Demo Elections', 'An election election for students side', '2022-11-28', '2022-11-30'),
(28, 0, 0, 'CSC Demo Election', 'Demo CSC Elections', '2022-11-28', '2022-11-28'),
(29, 0, 0, 'CSC Demo ', 'CSC', '2022-12-01', '2022-12-02'),
(30, 1, 12, 'COMSOC Redef', 'redef', '2022-12-01', '2022-12-02');

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
(17, 1, 12, 'COMSOC Election Sample', 'A sample election', '2022-11-04', '2022-11-04'),
(18, 0, 0, 'CSC Elections', 'CSC elections', '2022-11-04', '2022-11-04'),
(19, 1, 12, 'COMSOC Elections 2022', 'COMSOC elections 2022, please vote wisely.', '2022-11-16', '2022-11-16'),
(20, 0, 0, 'JRU CSC Elections 2022', 'JRU CSC Elections is now ongoing, please vote wisely', '2022-11-16', '2022-11-17'),
(22, 0, 0, 'ewe', 'ewew', '2022-11-17', '2022-11-17');

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
(38, 1668612265, 19123412, 1, 'COMSOC ESports ', 'A new project has been created by Trisha Pega.', '', 1),
(39, 1668612265, 19255561, 1, 'COMSOC ESports ', 'A new project has been created by Trisha Pega.', '', 0),
(40, 1668612543, 19123412, 1, 'JRU Cybersecurity Webinar', 'A new project has been created by Jose Ricardo Ayala.', '', 1),
(41, 1668612543, 19255561, 1, 'JRU Cybersecurity Webinar', 'A new project has been created by Jose Ricardo Ayala.', '', 0),
(42, 1668613087, 19123412, 1, 'PC Assembly and Disassembly Competition', 'A new project has been created by Jose Ricardo Ayala.', '', 1),
(43, 1668613087, 19255561, 1, 'PC Assembly and Disassembly Competition', 'A new project has been created by Jose Ricardo Ayala.', '', 0),
(44, 1668613341, 19123412, 1, 'Workstation Showcase', 'A new project has been created by Jose Ricardo Ayala.', '', 1),
(45, 1668613341, 19255561, 1, 'Workstation Showcase', 'A new project has been created by Jose Ricardo Ayala.', '', 0),
(46, 1668613646, 19123412, 1, 'Java Tutorial Webinar', 'A new project has been created by Jose Ricardo Ayala.', '', 1),
(47, 1668613646, 19255561, 1, 'Java Tutorial Webinar', 'A new project has been created by Jose Ricardo Ayala.', '', 0),
(48, 1668613661, 19123412, 1, 'Freshmen Orientation and Pinning Ceremony ', 'A new project has been created by Trisha Pega.', '', 1),
(49, 1668613661, 19255561, 1, 'Freshmen Orientation and Pinning Ceremony ', 'A new project has been created by Trisha Pega.', '', 0),
(50, 1668613885, 19255532, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(51, 1668613885, 19255515, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(52, 1668613885, 19255322, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(53, 1668613885, 21258199, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(54, 1668613885, 23261387, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(55, 1668613885, 20257214, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(56, 1668613885, 23261983, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(57, 1668613885, 19255562, 1, 'Freshmen Orientation and Pinning Ceremony ', 'Project is now requiring your approval.', 'signatory-pending.php', 0),
(58, 1668613896, 19255532, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(59, 1668613896, 19255515, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(60, 1668613896, 19255322, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(61, 1668613896, 21258199, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(62, 1668613896, 23261387, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(63, 1668613896, 20257214, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(64, 1668613896, 23261983, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(65, 1668613896, 19255562, 1, 'PC Assembly and Disassembly Competition', 'Project is now requiring your approval.', 'signatory-pending.php', 0),
(66, 1668613901, 19255532, 2, 'Java Tutorial Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(67, 1668613901, 19255515, 2, 'Java Tutorial Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(68, 1668613901, 19255322, 2, 'Java Tutorial Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(69, 1668613901, 21258199, 2, 'Java Tutorial Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(70, 1668613901, 23261387, 2, 'Java Tutorial Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(71, 1668613901, 20257214, 2, 'Java Tutorial Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(72, 1668613901, 23261983, 2, 'Java Tutorial Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(73, 1668613901, 19255562, 1, 'Java Tutorial Webinar', 'Project is now requiring your approval.', 'signatory-pending.php', 0),
(74, 1668613980, 19255532, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(75, 1668613980, 19255515, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(76, 1668613980, 19255322, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(77, 1668613980, 21258199, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(78, 1668613980, 23261387, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(79, 1668613980, 20257214, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(80, 1668613980, 23261983, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(81, 1668613980, 18202422, 1, 'PC Assembly and Disassembly Competition', 'Project is now requiring your approval.', 'signatory-pending.php', 0),
(82, 1668614025, 19123412, 1, '12th IT Skills Olympics ', 'A new project has been created by Trisha Pega.', '', 0),
(83, 1668614025, 19255561, 1, '12th IT Skills Olympics ', 'A new project has been created by Trisha Pega.', '', 0),
(84, 1668614041, 19255532, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by the Dean.', 'officer-revision.php', 1),
(85, 1668614041, 19255515, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by the Dean.', 'officer-revision.php', 0),
(86, 1668614041, 19255322, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by the Dean.', 'officer-revision.php', 0),
(87, 1668614041, 21258199, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by the Dean.', 'officer-revision.php', 0),
(88, 1668614041, 23261387, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by the Dean.', 'officer-revision.php', 0),
(89, 1668614041, 20257214, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by the Dean.', 'officer-revision.php', 1),
(90, 1668614041, 23261983, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by the Dean.', 'officer-revision.php', 0),
(91, 1668614088, 19255532, 2, '12th IT Skills Olympics ', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(92, 1668614088, 19255515, 2, '12th IT Skills Olympics ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(93, 1668614088, 19255322, 2, '12th IT Skills Olympics ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(94, 1668614088, 21258199, 2, '12th IT Skills Olympics ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(95, 1668614088, 23261387, 2, '12th IT Skills Olympics ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(96, 1668614088, 20257214, 2, '12th IT Skills Olympics ', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(97, 1668614088, 23261983, 2, '12th IT Skills Olympics ', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(98, 1668614088, 19255562, 1, '12th IT Skills Olympics ', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(99, 1668614125, 19255532, 2, '12th IT Skills Olympics ', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(100, 1668614125, 19255515, 2, '12th IT Skills Olympics ', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(101, 1668614125, 19255322, 2, '12th IT Skills Olympics ', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(102, 1668614125, 21258199, 2, '12th IT Skills Olympics ', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(103, 1668614125, 23261387, 2, '12th IT Skills Olympics ', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(104, 1668614125, 20257214, 2, '12th IT Skills Olympics ', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(105, 1668614125, 23261983, 2, '12th IT Skills Olympics ', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(106, 1668614125, 18202422, 1, '12th IT Skills Olympics ', 'Project is now requiring your approval.', 'signatory-pending.php', 0),
(107, 1668614275, 19255532, 2, 'Java Tutorial Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(108, 1668614275, 19255515, 2, 'Java Tutorial Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(109, 1668614275, 19255322, 2, 'Java Tutorial Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(110, 1668614275, 21258199, 2, 'Java Tutorial Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(111, 1668614275, 23261387, 2, 'Java Tutorial Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(112, 1668614275, 20257214, 2, 'Java Tutorial Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(113, 1668614275, 23261983, 2, 'Java Tutorial Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(114, 1668614275, 18202422, 1, 'Java Tutorial Webinar', 'Project is now requiring your approval.', 'signatory-pending.php', 0),
(115, 1668614343, 19123412, 1, 'ComSoc Technology and Innovation Seminar Series', 'A new project has been created by Trisha Pega.', '', 0),
(116, 1668614343, 19255561, 1, 'ComSoc Technology and Innovation Seminar Series', 'A new project has been created by Trisha Pega.', '', 0),
(117, 1668614367, 19255532, 2, '12th IT Skills Olympics ', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(118, 1668614367, 19255515, 2, '12th IT Skills Olympics ', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(119, 1668614367, 19255322, 2, '12th IT Skills Olympics ', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(120, 1668614367, 21258199, 2, '12th IT Skills Olympics ', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(121, 1668614367, 23261387, 2, '12th IT Skills Olympics ', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(122, 1668614367, 20257214, 2, '12th IT Skills Olympics ', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(123, 1668614367, 23261983, 2, '12th IT Skills Olympics ', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(124, 1668614373, 19255532, 2, 'Java Tutorial Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(125, 1668614373, 19255515, 2, 'Java Tutorial Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(126, 1668614373, 19255322, 2, 'Java Tutorial Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(127, 1668614373, 21258199, 2, 'Java Tutorial Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(128, 1668614373, 23261387, 2, 'Java Tutorial Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(129, 1668614373, 20257214, 2, 'Java Tutorial Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(130, 1668614373, 23261983, 2, 'Java Tutorial Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(131, 1668685153, 19123412, 1, 'CSE Week', 'A new project has been created by Trisha Pega.', '', 1),
(132, 1668685153, 19255561, 1, 'CSE Week', 'A new project has been created by Trisha Pega.', '', 0),
(133, 1668686462, 21258199, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(134, 1668686462, 23261387, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(135, 1668686462, 20257214, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(136, 1668686462, 19255540, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(137, 1668686462, 18255530, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(138, 1668686462, 20259030, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(139, 1668686462, 19255532, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(140, 1668686462, 19255530, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(141, 1668686462, 19255562, 1, 'CSE Week', 'Project is now requiring your approval.', 'signatory-pending.php', 0),
(142, 1668686494, 21258199, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(143, 1668686494, 23261387, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(144, 1668686494, 20257214, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(145, 1668686494, 19255540, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(146, 1668686494, 18255530, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(147, 1668686494, 20259030, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(148, 1668686494, 19255532, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(149, 1668686494, 19255530, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(150, 1668686494, 18202422, 1, 'CSE Week', 'Project is now requiring your approval.', 'signatory-pending.php', 0),
(151, 1668686647, 21258199, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(152, 1668686647, 23261387, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(153, 1668686647, 20257214, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(154, 1668686647, 19255540, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(155, 1668686647, 18255530, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(156, 1668686647, 20259030, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(157, 1668686647, 19255532, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(158, 1668686647, 19255530, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(159, 1668687457, 21258199, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(160, 1668687457, 23261387, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(161, 1668687457, 20257214, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(162, 1668687457, 19255540, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(163, 1668687457, 18255530, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(164, 1668687457, 20259030, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(165, 1668687457, 19255532, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(166, 1668687457, 19255530, 2, 'CSE Week', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(167, 1668687458, 19255562, 1, 'CSE Week', 'Project is now requiring your approval.', 'signatory-pending.php', 0),
(168, 1668687651, 21258199, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(169, 1668687651, 23261387, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(170, 1668687651, 20257214, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(171, 1668687651, 19255540, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(172, 1668687651, 18255530, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(173, 1668687651, 20259030, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(174, 1668687651, 19255532, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(175, 1668687651, 19255530, 2, 'CSE Week', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(176, 1668687651, 18202422, 1, 'CSE Week', 'Project is now requiring your approval.', 'signatory-pending.php', 1),
(177, 1668687705, 21258199, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(178, 1668687705, 23261387, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(179, 1668687705, 20257214, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(180, 1668687705, 19255540, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(181, 1668687705, 18255530, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(182, 1668687705, 20259030, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(183, 1668687705, 19255532, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(184, 1668687705, 19255530, 2, 'CSE Week', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(185, 1669632715, 19123412, 1, 'Test', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(186, 1669632715, 19255561, 1, 'Test', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(187, 1669633532, 19123412, 1, 'CSE Internship Orientation', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(188, 1669633532, 19255561, 1, 'CSE Internship Orientation', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(189, 1669633746, 19123412, 1, 'Comsoc Outreach Program', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(190, 1669633746, 19255561, 1, 'Comsoc Outreach Program', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(191, 1669634377, 19123412, 1, 'CSE Week - Esports Competition', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(192, 1669634377, 19255561, 1, 'CSE Week - Esports Competition', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(193, 1669635052, 19123412, 1, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(194, 1669635052, 19255561, 1, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(195, 1669635561, 21258199, 2, 'Comsoc Outreach Program', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(196, 1669635561, 23261387, 2, 'Comsoc Outreach Program', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(197, 1669635561, 20257214, 2, 'Comsoc Outreach Program', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(198, 1669635561, 19255540, 2, 'Comsoc Outreach Program', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(199, 1669635561, 18255530, 2, 'Comsoc Outreach Program', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(200, 1669635561, 20259030, 2, 'Comsoc Outreach Program', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(201, 1669635561, 19255532, 2, 'Comsoc Outreach Program', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(202, 1669635561, 19255530, 2, 'Comsoc Outreach Program', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(203, 1669635653, 21258199, 2, 'COMSOC ESports ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(204, 1669635653, 23261387, 2, 'COMSOC ESports ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(205, 1669635653, 20257214, 2, 'COMSOC ESports ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(206, 1669635653, 19255540, 2, 'COMSOC ESports ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(207, 1669635653, 18255530, 2, 'COMSOC ESports ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(208, 1669635653, 20259030, 2, 'COMSOC ESports ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(209, 1669635653, 19255532, 2, 'COMSOC ESports ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(210, 1669635653, 19255530, 2, 'COMSOC ESports ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(211, 1669635676, 21258199, 2, 'Workstation Showcase', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(212, 1669635676, 23261387, 2, 'Workstation Showcase', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(213, 1669635676, 20257214, 2, 'Workstation Showcase', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 1),
(214, 1669635676, 19255540, 2, 'Workstation Showcase', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(215, 1669635676, 18255530, 2, 'Workstation Showcase', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(216, 1669635676, 20259030, 2, 'Workstation Showcase', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(217, 1669635676, 19255532, 2, 'Workstation Showcase', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 1),
(218, 1669635676, 19255530, 2, 'Workstation Showcase', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 1),
(219, 1669637020, 21258199, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(220, 1669637020, 23261387, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(221, 1669637020, 20257214, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(222, 1669637020, 19255540, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(223, 1669637020, 18255530, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(224, 1669637020, 20259030, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(225, 1669637020, 19255532, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(226, 1669637020, 19255530, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(227, 1669637020, 15212212, 1, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(228, 1669637062, 21258199, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(229, 1669637062, 23261387, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(230, 1669637062, 20257214, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(231, 1669637062, 19255540, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(232, 1669637062, 18255530, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(233, 1669637062, 20259030, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(234, 1669637062, 19255532, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(235, 1669637062, 19255530, 2, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(236, 1669637062, 19255562, 1, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(237, 1669637081, 19123412, 1, 'test1', 'A new project has been created by Manuel Mark Idul.', 'signatory-rso-pending.php?id=12', 0),
(238, 1669637081, 19255561, 1, 'test1', 'A new project has been created by Manuel Mark Idul.', 'signatory-rso-pending.php?id=12', 0),
(239, 1669637092, 21258199, 2, 'CSE Week - Esports Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(240, 1669637092, 23261387, 2, 'CSE Week - Esports Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(241, 1669637092, 20257214, 2, 'CSE Week - Esports Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(242, 1669637092, 19255540, 2, 'CSE Week - Esports Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(243, 1669637092, 18255530, 2, 'CSE Week - Esports Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(244, 1669637092, 20259030, 2, 'CSE Week - Esports Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(245, 1669637092, 19255532, 2, 'CSE Week - Esports Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(246, 1669637092, 19255530, 2, 'CSE Week - Esports Competition', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(247, 1669637092, 15212212, 1, 'CSE Week - Esports Competition', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(248, 1669637115, 21258199, 2, 'CSE Internship Orientation', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(249, 1669637115, 23261387, 2, 'CSE Internship Orientation', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(250, 1669637115, 20257214, 2, 'CSE Internship Orientation', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(251, 1669637115, 19255540, 2, 'CSE Internship Orientation', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(252, 1669637115, 18255530, 2, 'CSE Internship Orientation', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(253, 1669637115, 20259030, 2, 'CSE Internship Orientation', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(254, 1669637115, 19255532, 2, 'CSE Internship Orientation', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(255, 1669637115, 19255530, 2, 'CSE Internship Orientation', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(256, 1669637115, 15212212, 1, 'CSE Internship Orientation', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(257, 1669637138, 21258199, 2, 'test1', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(258, 1669637138, 23261387, 2, 'test1', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(259, 1669637138, 20257214, 2, 'test1', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(260, 1669637138, 19255540, 2, 'test1', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(261, 1669637138, 18255530, 2, 'test1', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(262, 1669637138, 20259030, 2, 'test1', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(263, 1669637138, 19255532, 2, 'test1', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(264, 1669637138, 19255530, 2, 'test1', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(265, 1669637138, 15212212, 1, 'test1', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(266, 1669637176, 21258199, 2, 'test1', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(267, 1669637176, 23261387, 2, 'test1', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(268, 1669637176, 20257214, 2, 'test1', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(269, 1669637176, 19255540, 2, 'test1', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(270, 1669637176, 18255530, 2, 'test1', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(271, 1669637176, 20259030, 2, 'test1', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(272, 1669637176, 19255532, 2, 'test1', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(273, 1669637176, 19255530, 2, 'test1', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(274, 1669637176, 19255562, 1, 'test1', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(275, 1669637182, 21258199, 2, 'CSE Internship Orientation', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(276, 1669637182, 23261387, 2, 'CSE Internship Orientation', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(277, 1669637182, 20257214, 2, 'CSE Internship Orientation', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(278, 1669637182, 19255540, 2, 'CSE Internship Orientation', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(279, 1669637182, 18255530, 2, 'CSE Internship Orientation', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(280, 1669637182, 20259030, 2, 'CSE Internship Orientation', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(281, 1669637182, 19255532, 2, 'CSE Internship Orientation', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(282, 1669637182, 19255530, 2, 'CSE Internship Orientation', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(283, 1669637182, 19255562, 1, 'CSE Internship Orientation', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(284, 1669637246, 21258199, 2, 'test1', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(285, 1669637246, 23261387, 2, 'test1', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(286, 1669637246, 20257214, 2, 'test1', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(287, 1669637246, 19255540, 2, 'test1', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(288, 1669637246, 18255530, 2, 'test1', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(289, 1669637246, 20259030, 2, 'test1', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(290, 1669637246, 19255532, 2, 'test1', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(291, 1669637246, 19255530, 2, 'test1', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(292, 1669637246, 18202422, 1, 'test1', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(293, 1669637377, 21258199, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(294, 1669637377, 23261387, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(295, 1669637377, 20257214, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(296, 1669637377, 19255540, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(297, 1669637377, 18255530, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(298, 1669637377, 20259030, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(299, 1669637377, 19255532, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(300, 1669637377, 19255530, 2, 'PC Assembly and Disassembly Competition', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(301, 1669638989, 19123412, 1, 'Test - Alpha SO', 'A new project has been created by Sarah Mae Ong.', 'signatory-rso-pending.php?id=12', 0),
(302, 1669638989, 19255561, 1, 'Test - Alpha SO', 'A new project has been created by Sarah Mae Ong.', 'signatory-rso-pending.php?id=12', 0),
(303, 1669642658, 19123412, 1, 'Sample', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 1),
(304, 1669642658, 19255561, 1, 'Sample', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(305, 1669642775, 21258199, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(306, 1669642775, 23261387, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(307, 1669642775, 20257214, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(308, 1669642775, 19255540, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(309, 1669642775, 18255530, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(310, 1669642775, 19255532, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(311, 1669642775, 19255530, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(312, 1669642775, 15300210, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(313, 1669642775, 15212212, 1, 'Sample', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(314, 1669642814, 21258199, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(315, 1669642814, 23261387, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(316, 1669642814, 20257214, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(317, 1669642814, 19255540, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(318, 1669642814, 18255530, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(319, 1669642814, 19255532, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(320, 1669642814, 19255530, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(321, 1669642814, 15300210, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(322, 1669642814, 19255562, 1, 'Sample', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(323, 1669642917, 21258199, 2, 'Sample', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(324, 1669642917, 23261387, 2, 'Sample', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(325, 1669642917, 20257214, 2, 'Sample', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(326, 1669642917, 19255540, 2, 'Sample', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(327, 1669642917, 18255530, 2, 'Sample', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(328, 1669642917, 19255532, 2, 'Sample', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(329, 1669642917, 19255530, 2, 'Sample', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(330, 1669642917, 15300210, 2, 'Sample', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(331, 1669642917, 18202422, 1, 'Sample', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(332, 1669805994, 19123412, 1, 'test \' \"', 'A new project has been created by Manuel Mark Idul.', 'signatory-rso-pending.php?id=12', 1),
(333, 1669805994, 19255561, 1, 'test \' \"', 'A new project has been created by Manuel Mark Idul.', 'signatory-rso-pending.php?id=12', 0),
(334, 1669857311, 19123412, 1, 'wewqw', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 1),
(335, 1669857311, 19255561, 1, 'wewqw', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(336, 1669878163, 17211130, 1, 'CSE Webinar', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(337, 1669878163, 19123412, 1, 'CSE Webinar', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(338, 1669878163, 19255561, 1, 'CSE Webinar', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(339, 1669878163, 22121212, 1, 'CSE Webinar', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(340, 1669881685, 21258199, 2, 'CSE Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(341, 1669881685, 23261387, 2, 'CSE Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(342, 1669881685, 20257214, 2, 'CSE Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(343, 1669881685, 19255540, 2, 'CSE Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(344, 1669881685, 18255530, 2, 'CSE Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(345, 1669881685, 19255532, 2, 'CSE Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(346, 1669881685, 19255530, 2, 'CSE Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(347, 1669881685, 15300210, 2, 'CSE Webinar', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(348, 1669881685, 15212212, 1, 'CSE Webinar', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(349, 1669882736, 21258199, 2, 'CSE Webinar', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(350, 1669882736, 23261387, 2, 'CSE Webinar', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(351, 1669882736, 20257214, 2, 'CSE Webinar', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(352, 1669882736, 19255540, 2, 'CSE Webinar', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(353, 1669882736, 18255530, 2, 'CSE Webinar', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(354, 1669882736, 19255532, 2, 'CSE Webinar', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(355, 1669882736, 19255530, 2, 'CSE Webinar', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(356, 1669882736, 15300210, 2, 'CSE Webinar', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(357, 1669882736, 19255562, 1, 'CSE Webinar', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(358, 1669882782, 21258199, 2, 'CSE Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(359, 1669882782, 23261387, 2, 'CSE Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(360, 1669882782, 20257214, 2, 'CSE Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(361, 1669882782, 19255540, 2, 'CSE Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(362, 1669882782, 18255530, 2, 'CSE Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(363, 1669882782, 19255532, 2, 'CSE Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(364, 1669882782, 19255530, 2, 'CSE Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 1),
(365, 1669882782, 15300210, 2, 'CSE Webinar', 'Project has been approved by the Dean.', 'officer-pending.php', 0),
(366, 1669882782, 18202422, 1, 'CSE Webinar', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(367, 1669882919, 21258199, 2, 'CSE Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(368, 1669882919, 23261387, 2, 'CSE Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(369, 1669882919, 20257214, 2, 'CSE Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(370, 1669882919, 19255540, 2, 'CSE Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(371, 1669882919, 18255530, 2, 'CSE Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(372, 1669882919, 19255532, 2, 'CSE Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(373, 1669882919, 19255530, 2, 'CSE Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 1),
(374, 1669882919, 15300210, 2, 'CSE Webinar', 'Project has been approved by the SDO.', 'officer-approved.php', 0),
(375, 1670318756, 17211130, 1, 'test', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(376, 1670318756, 19123412, 1, 'test', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 1),
(377, 1670318756, 19255561, 1, 'test', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(378, 1670318756, 22121212, 1, 'test', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(379, 1670318756, 17000000, 1, 'test', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(380, 1670319786, 21258199, 2, 'test', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(381, 1670319786, 23261387, 2, 'test', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(382, 1670319786, 20257214, 2, 'test', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(383, 1670319786, 19255540, 2, 'test', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(384, 1670319786, 18255530, 2, 'test', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(385, 1670319786, 19255532, 2, 'test', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(386, 1670319786, 19255530, 2, 'test', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(387, 1670319786, 15300210, 2, 'test', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(388, 1670319786, 15212212, 1, 'test', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(389, 1670321717, 17211130, 1, 'Sample', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(390, 1670321717, 19123412, 1, 'Sample', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 1),
(391, 1670321717, 19255561, 1, 'Sample', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(392, 1670321717, 22121212, 1, 'Sample', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(393, 1670321717, 17000000, 1, 'Sample', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(394, 1670322482, 21258199, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(395, 1670322482, 23261387, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(396, 1670322482, 20257214, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(397, 1670322482, 19255540, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(398, 1670322482, 18255530, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(399, 1670322482, 19255532, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(400, 1670322482, 19255530, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(401, 1670322482, 15300210, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(402, 1670322482, 15212212, 1, 'Sample', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(403, 1670323086, 21258199, 2, 'Sample', 'Project has been moved for revision by the Chair.', 'officer-revision.php', 0),
(404, 1670323086, 23261387, 2, 'Sample', 'Project has been moved for revision by the Chair.', 'officer-revision.php', 0),
(405, 1670323086, 20257214, 2, 'Sample', 'Project has been moved for revision by the Chair.', 'officer-revision.php', 0),
(406, 1670323086, 19255540, 2, 'Sample', 'Project has been moved for revision by the Chair.', 'officer-revision.php', 0),
(407, 1670323086, 18255530, 2, 'Sample', 'Project has been moved for revision by the Chair.', 'officer-revision.php', 0),
(408, 1670323086, 19255532, 2, 'Sample', 'Project has been moved for revision by the Chair.', 'officer-revision.php', 1),
(409, 1670323086, 19255530, 2, 'Sample', 'Project has been moved for revision by the Chair.', 'officer-revision.php', 0),
(410, 1670323086, 15300210, 2, 'Sample', 'Project has been moved for revision by the Chair.', 'officer-revision.php', 0),
(411, 1670323318, 21258199, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(412, 1670323318, 23261387, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(413, 1670323318, 20257214, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(414, 1670323318, 19255540, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(415, 1670323318, 18255530, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(416, 1670323318, 19255532, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 1),
(417, 1670323318, 19255530, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(418, 1670323318, 15300210, 2, 'Sample', 'Project has been approved by your Adviser.', 'officer-pending.php', 0),
(419, 1670323318, 15212212, 1, 'Sample', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 0),
(420, 1670323359, 21258199, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(421, 1670323359, 23261387, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(422, 1670323359, 20257214, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(423, 1670323359, 19255540, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(424, 1670323359, 18255530, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(425, 1670323359, 19255532, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 1),
(426, 1670323359, 19255530, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(427, 1670323359, 15300210, 2, 'Sample', 'Project has been approved by the Chair.', 'officer-approved.php', 0),
(428, 1670323359, 19255562, 1, 'Sample', 'Project is now requiring your approval.', 'signatory-rso-pending.php?id=12', 1),
(429, 1670390985, 17211130, 1, 'tesy', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(430, 1670390985, 19123412, 1, 'tesy', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(431, 1670390985, 19255561, 1, 'tesy', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(432, 1670390985, 22121212, 1, 'tesy', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(433, 1670390985, 17000000, 1, 'tesy', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(434, 1670397443, 21258199, 2, 'Test - Alpha SO', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(435, 1670397443, 23261387, 2, 'Test - Alpha SO', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(436, 1670397443, 20257214, 2, 'Test - Alpha SO', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(437, 1670397443, 19255540, 2, 'Test - Alpha SO', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(438, 1670397443, 18255530, 2, 'Test - Alpha SO', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0);
INSERT INTO `tb_notification` (`id`, `notif_id`, `receiver`, `direction`, `title`, `message`, `data`, `is_read`) VALUES
(439, 1670397443, 19255532, 2, 'Test - Alpha SO', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 1),
(440, 1670397443, 19255530, 2, 'Test - Alpha SO', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(441, 1670397443, 15300210, 2, 'Test - Alpha SO', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(442, 1670397454, 21258199, 2, 'Comsoc Members Assembly', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(443, 1670397454, 23261387, 2, 'Comsoc Members Assembly', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(444, 1670397454, 20257214, 2, 'Comsoc Members Assembly', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(445, 1670397454, 19255540, 2, 'Comsoc Members Assembly', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(446, 1670397454, 18255530, 2, 'Comsoc Members Assembly', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(447, 1670397454, 19255532, 2, 'Comsoc Members Assembly', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 1),
(448, 1670397454, 19255530, 2, 'Comsoc Members Assembly', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(449, 1670397454, 15300210, 2, 'Comsoc Members Assembly', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(450, 1670397469, 21258199, 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(451, 1670397469, 23261387, 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(452, 1670397469, 20257214, 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(453, 1670397469, 19255540, 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(454, 1670397469, 18255530, 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(455, 1670397469, 19255532, 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(456, 1670397469, 19255530, 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(457, 1670397469, 15300210, 2, 'ComSoc Technology and Innovation Seminar Series', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(458, 1670397481, 21258199, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(459, 1670397481, 23261387, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(460, 1670397481, 20257214, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(461, 1670397481, 19255540, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(462, 1670397481, 18255530, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(463, 1670397481, 19255532, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(464, 1670397481, 19255530, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(465, 1670397481, 15300210, 2, 'Freshmen Orientation and Pinning Ceremony ', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(466, 1670397504, 21258199, 2, 'Comsoc TeamBuilding', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(467, 1670397504, 23261387, 2, 'Comsoc TeamBuilding', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(468, 1670397504, 20257214, 2, 'Comsoc TeamBuilding', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(469, 1670397504, 19255540, 2, 'Comsoc TeamBuilding', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(470, 1670397504, 18255530, 2, 'Comsoc TeamBuilding', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(471, 1670397504, 19255532, 2, 'Comsoc TeamBuilding', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(472, 1670397504, 19255530, 2, 'Comsoc TeamBuilding', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(473, 1670397504, 15300210, 2, 'Comsoc TeamBuilding', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(474, 1670397516, 21258199, 2, 'JRU Cybersecurity Webinar', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(475, 1670397516, 23261387, 2, 'JRU Cybersecurity Webinar', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(476, 1670397516, 20257214, 2, 'JRU Cybersecurity Webinar', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(477, 1670397516, 19255540, 2, 'JRU Cybersecurity Webinar', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(478, 1670397516, 18255530, 2, 'JRU Cybersecurity Webinar', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(479, 1670397516, 19255532, 2, 'JRU Cybersecurity Webinar', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 1),
(480, 1670397516, 19255530, 2, 'JRU Cybersecurity Webinar', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(481, 1670397516, 15300210, 2, 'JRU Cybersecurity Webinar', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(482, 1670397523, 21258199, 2, 'COMSOC Acquaintance Event', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(483, 1670397523, 23261387, 2, 'COMSOC Acquaintance Event', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(484, 1670397523, 20257214, 2, 'COMSOC Acquaintance Event', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(485, 1670397523, 19255540, 2, 'COMSOC Acquaintance Event', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(486, 1670397523, 18255530, 2, 'COMSOC Acquaintance Event', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(487, 1670397523, 19255532, 2, 'COMSOC Acquaintance Event', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 1),
(488, 1670397523, 19255530, 2, 'COMSOC Acquaintance Event', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(489, 1670397523, 15300210, 2, 'COMSOC Acquaintance Event', 'Project has been moved for revision by your Adviser.', 'officer-revision.php', 0),
(490, 1670397541, 21258199, 2, 'tesy', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(491, 1670397541, 23261387, 2, 'tesy', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(492, 1670397541, 20257214, 2, 'tesy', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(493, 1670397541, 19255540, 2, 'tesy', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(494, 1670397541, 18255530, 2, 'tesy', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(495, 1670397541, 19255532, 2, 'tesy', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 1),
(496, 1670397541, 19255530, 2, 'tesy', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(497, 1670397541, 15300210, 2, 'tesy', 'Project has been rejected by your Adviser.', 'officer-rejected.php', 0),
(498, 1670423794, 17, 1, 'Demo', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(499, 1670423794, 19, 1, 'Demo', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(500, 1670423794, 19, 1, 'Demo', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(501, 1670423794, 22, 1, 'Demo', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0),
(502, 1670423794, 17, 1, 'Demo', 'A new project has been created by Trisha Pega.', 'signatory-rso-pending.php?id=12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_officers`
--

CREATE TABLE `tb_officers` (
  `student_id` varchar(255) DEFAULT NULL,
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
('19-255540', 10, 6, 'Distajo', 'Mikka', '', '2000-12-07', 21, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'mikka.distajo@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', NULL, '2022-10-13'),
('19-255515', 11, 4, 'Ayala', 'Jose Ricardo', 'J', '1999-06-17', 23, 'Male', '4', 5, 'Bachelor of Science in Nursing and Health Sciences', '401N', 'josericardo.ayala@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 16, 2, 'img_avatar.png', NULL, '2022-10-13'),
('19-255570', 12, 13, 'Gabas', 'May Ann', 'G', '2000-06-05', 22, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'mayann.gabas@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', NULL, '2022-10-13'),
('21-258199', 15, 1, 'Ong', 'Sarah Mae', 'M', '1997-04-02', 25, 'Female', '3', 3, 'Bachelor of Science in Information Technology (BSIT-BA) Major in Business Analytics', '301B', 'sarahmae.ong@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, '36571-Ong - President.JPG', NULL, '2022-11-04'),
('23-261387', 16, 4, 'Romero', 'Sophia Marie', 'Marantal', '2004-06-12', 18, 'Female', '1', 3, '', '101D', 'sophiamarie.romero@my.jru.edu', '6a6646c12d9cca65657692bfc5a765d6b4241901', 12, 2, 'img_avatar.png', NULL, '2022-11-04'),
('22-258983', 17, 6, 'Barlos', 'Darwin', 'Samillano', '2003-03-21', 19, 'Male', '2', 3, 'Bachelor of Science in Information Technology (BSIT)', '204I', 'darwin.barlos@my.jru.edu', 'c2782a3cccf5330b06c1021b4b456cdfdcd28443', 12, 2, 'img_avatar.png', NULL, '2022-11-04'),
('20-256477', 18, 18, 'Tan', 'Sherrisse Myka', 'C', '2001-06-03', 21, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'sherrissemyka.tan@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', NULL, '2022-11-04'),
('20-257214', 19, 3, 'Idul', 'Manuel Mark', '', '1993-11-14', 28, 'Male', '4', 3, 'Bachelor of Science in Information Technology (BSIT-BA) Major in Business Analytics', '401B', 'manuelmark.idul@my.jru.edu', 'c67751ffa430e0e4dcb759b24db6f2bd971a3a97', 12, 2, 'img_avatar.png', NULL, '2022-11-04'),
('23-260628', 21, 15, 'Puyawan', 'Frederique', 'Angeles', '2004-06-03', 18, 'Male', '1', 3, '', '101D', 'frederique.puyawan@my.jru.edu', 'a468b2260e28a97f45af398aea1d1760edb1ef23', 12, 2, 'img_avatar.png', NULL, '2022-11-04'),
('19-255540', 24, 3, 'Cataneda', 'Candid Patrice', 'C', '2000-03-25', 22, 'Female', '4', 5, 'Bachelor of Science in Nursing (BSN)', '401I', 'candidpatrice.cataneda@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', NULL, '2022-11-04'),
('19-255561', 28, 7, 'Carreros', 'Kean', 'V', '1999-11-27', 22, 'Male', '4', 1, 'Bachelor of Arts in Psychology (ABPsy)', '401I', 'kean.carreros@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', NULL, '2022-11-16'),
('18-255530', 31, 4, 'Morales', 'Karlo Redeemer', 'R', '1995-03-20', 27, 'Male', '4', 2, 'Bachelor of Arts (AB) Major in Economics', '401I', 'karloredeemer.morales@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', NULL, '2022-11-16'),
('19-255532', 35, 4, 'Pega', 'Trisha', '', '1999-07-09', 23, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'trisha.pega@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, '61894-hangeme.jpg', 'PIO Officer - 2019-2020\r\nTreasurer - 2020-2021\r\nSecretary - 2021-2022(present)\r\n\r\nSkills \r\n- Organized\r\n- Strong Communication\r\n- Computer Literate\r\n\r\n\r\n', '2022-11-17'),
('19-255530', 36, 4, 'Vizcarra', 'Ronalyn', 'Reyes', '1999-08-09', 23, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'ronalyn.vizcarra@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, '2538-hangeme.jpg', 'I am good at being a Secretary ', '2022-11-17'),
('19-254353', 39, 1, 'Guanco', 'Kahlil', 'Atienza', '2000-03-30', 22, 'Male', '4', 3, 'Bachelor of Science in Information Technology (BSIT-AGD) Major in Animation and Game Development', '401GA', 'kahlil.guanco@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 33, 2, '', NULL, '2022-11-22'),
('15-300210', 41, 2, 'Madrio', 'Ailyn Joy', '', '2001-08-03', 21, 'Female', '3', 3, 'Bachelor of Science in Information Technology (BSIT-BA) Major in Business Analytics', '301BA', 'ailynjoy.madrio@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', NULL, '2022-11-28'),
('20-256477', 42, 20, 'Tan', 'Sherrisse Myka', 'C', '2001-06-03', 21, 'Female', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 'sherrissemyka.tan@my.jru.edu', '1bbd14a53dae200f0c9e33b515184a8f580e0aa4', 12, 2, 'img_avatar.png', NULL, '2022-11-30');

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

--
-- Dumping data for table `tb_officers_archive`
--

INSERT INTO `tb_officers_archive` (`student_id`, `officer_id`, `position_id`, `last_name`, `first_name`, `middle_initial`, `birthdate`, `age`, `gender`, `year_level`, `college_dept`, `course`, `section`, `email`, `password`, `org_id`, `user_type`, `profile_pic`, `bio`, `account_created`) VALUES
(19255540, 13, 5, 'Cataneda', 'Candid Patrice', 'C', '2000-03-25', 22, 'Female', '4', 5, 'Bachelor of Science in Nursing (BSN)', '401I', 'candidpatrice.cataneda@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 16, 2, 'img_avatar.png', NULL, '2022-10-13'),
(19255322, 14, 1, 'Saludo', 'Yancie Troy', 'Hernandez', '1999-11-14', 22, 'Male', '4', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 'yancietroy.saludo@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 33, 2, '42619-JRU Virtual Background 22_23 (3).jpg', NULL, '2022-11-04'),
(20259030, 34, 2, 'Salopaso', 'Justine', 'E', '1999-03-23', 23, 'Male', '4', 2, 'Bachelor of Science in Business Administration (BSBA) Major in Banking and Finance', '401I', 'justine.salopaso@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 12, 2, 'img_avatar.png', NULL, '2022-11-16');

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
(2, 'Criminal Justice Students Society (CJSS)', 'ACE(Crim).jpg', 1, 1, 'Active', '2022-2023'),
(4, 'Mathematics Society (MATHSOC)', 'ACE(Math).jpg', 1, 1, 'Active', '2022-2023'),
(5, 'Young Educators Society (YES)', 'ACE(Educ).jpg', 1, 1, 'Active', '2022-2023'),
(7, 'JRU Junior Philippine Institute of Accountants (JRUJPIA)', '25917-308840435_492133052957080_1473209234036732895_n.jpg', 2, 1, 'Active', '2022-2023'),
(8, 'Management Society (MANSOC)', 'BA(managemenrSoc).jpg', 2, 1, 'Active', '2022-2023'),
(9, 'Supply Management Society (SMS)', 'BA(supplyMan).jpg', 2, 1, 'Active', '2022-2023'),
(10, 'Young Marketers Association (YMA)', 'BA(YoungMarketers).jpg', 2, 1, 'Active', '2022-2023'),
(12, 'Computer Society (COMSOC)', 'COMSOC.png', 3, 1, 'Active', '2022-2023'),
(13, 'Electronics Engineering League (ECEL)', 'CSE(electronicEngLeague).jpg', 3, 1, 'Active', '2022-2023'),
(16, 'Nursing Society (NURSOC)', 'NursingSociety.jpg', 5, 1, 'Active', '2022-2023'),
(21, 'José Rizal University Chorale', '39594-69837-305286405_452918480192666_4126092082230211706_n.png', NULL, 2, 'Active', '2022-2023'),
(22, 'José Rizal University Dance Troupe', '38198-295836273_456060226528103_8150057512210938936_n.jpg', NULL, 2, 'Active', '2022-2023'),
(23, 'Teatro Rizal', '14253-6326-308524608_462635415908723_7930715657361904428_n.jpg', NULL, 2, 'Active', '2022-2023'),
(26, 'JRU Central Student Council (JRUCSC)', '78317-37120506_635634206821211_4687114667871436800_n.png', NULL, 2, 'Active', '2022-2023'),
(27, 'The Journal (JRUTJ)', '18274-55081-CSC(journal).jpg', NULL, 2, 'Active', '2022-2023'),
(28, 'Rizalian Psychological Society (JRURPS)', '13048-ACE(Psyc).jpg', 1, 1, 'Active', '2022-2023'),
(29, 'Institute of Computer Engineers of the Philippines Student Edition JRU Chapter (JRUICPEP)', '11287-CSE(InstituteComputerEng).jpg', 3, 1, 'Active', '2022-2023'),
(30, 'Pacific Asia Travel Association Philippines JRU Student Chapter (PATAPHJRUS)', '36453-41774-CHTM(PATA).jpg', 4, 1, 'Active', '2022-2023'),
(31, 'Hospitality Industry Future Professionals (JRUHTMHIFP)', '44899-66861-CHTM(hospitalityIndusaFutureProf).jpg', 4, 1, 'Active', '2022-2023'),
(32, 'JRU Every Nation Campus (JRUENC)', '35891-79972-306727765_466707115501723_4328831352481019239_n.png', NULL, 2, 'Active', '2022-2023'),
(33, 'Rizalian Esports League (REL)', '86633-19227-296848672_104341519044187_518183436891479407_n.png', NULL, 2, 'Active', '2022-2023'),
(34, 'Liberal Arts Society (LAS)', '18485-308840435_492133052957080_1473209234036732895_n.jpg', 1, 1, 'Active', '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `tb_orgs_archive`
--

CREATE TABLE `tb_orgs_archive` (
  `ORG_ID` int(2) NOT NULL,
  `ORG` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  `org_type_id` int(2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
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
(6, 'Treasurer'),
(7, 'Auditor'),
(8, 'P.R.O'),
(20, 'Fourth Year Representative');

-- --------------------------------------------------------

--
-- Table structure for table `tb_position_archive`
--

CREATE TABLE `tb_position_archive` (
  `position_id` int(2) DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_position_archive`
--

INSERT INTO `tb_position_archive` (`position_id`, `position`) VALUES
(20, 'test'),
(19, 'Musical Director/Conductor'),
(18, '4th Year Representative'),
(17, '3rd Year Representative'),
(16, '2nd Year Representative'),
(15, '1st Year Representative'),
(14, 'Overall Co-Chairman'),
(13, 'Overall Chairman'),
(12, 'Business Manager'),
(11, 'Assistant P.R.O'),
(5, 'Assistant Secretary'),
(9, 'P.R.O Internal'),
(10, 'P.R.O External');

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
  `estimated_budget` varchar(20) DEFAULT NULL,
  `budget_req` varchar(3000) DEFAULT NULL,
  `attachments` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
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
('1669633532-SY2022-2023', 4, 12, 3, 'CSE Internship Orientation', 'Trisha Pega', 'JRU Comsoc', 'Seminar', 'Online', 'CSE Internship Orientation aims to inform CSE students regarding OJT for the next semester', NULL, '2022-11-29 13:00:00', '2022-11-29 18:00:00', 'Zoom', 'CSE Students', NULL, NULL, NULL, NULL, '500', '02::500', '10923-11250-eventproposalforms.rar', 'Pending', 3, '2022-11-28', '2022-11-28', 'Chairperson Israel Carino', 'Approved'),
('1669633746-SY2022-2023', 4, 12, 3, 'Comsoc Outreach Program', 'Trisha Pega', 'Comsoc', 'Outreach', 'Onsite', 'Outreach program from the CSE to serve the community', NULL, '2023-01-09 07:00:00', '2023-01-09 15:00:00', 'Mandaluyong Elementary School', 'ComSoc', NULL, NULL, NULL, NULL, '2700', '01::500;;03::1000;;02::200;;05::1000', '10923-11250-eventproposalforms.rar', 'For Revision', 1, '2022-11-28', '2022-11-28', 'Adviser Emerson Flores', ''),
('1669634377-SY2022-2023', 4, 12, 3, 'CSE Week - Esports Competition', 'Trisha Pega', 'Comsoc', 'Competition', 'Online', 'CSE Week\'s Esports event part of JRU Comsoc\'s CSE week', NULL, '2022-11-30 08:00:00', '2022-12-07 18:00:00', 'Online', 'CSE Students', NULL, NULL, NULL, NULL, '1000', '02::500;;05::500', '10923-11250-eventproposalforms.rar', 'Pending', 2, '2022-11-28', '2022-11-28', 'Adviser Emerson Flores', 'Approved'),
('1669635052-SY2022-2023', 4, 12, 3, 'Data Analytics Webinar - Jupyter Notebook Tutorial', 'Trisha Pega', 'Comsoc', 'Seminar', 'Online', 'A virtual seminar to guide students interested in data analytics. The webinar will teach students how to use Jupyter Notebook on the fundamental level and help students think critically in interpreting the results.', NULL, '2022-12-03 09:00:00', '2022-12-03 12:00:00', 'Zoom ', 'CSE Students', NULL, NULL, NULL, NULL, '500', '02::500', '10923-11250-eventproposalforms.rar', 'Pending', 3, '2022-11-28', '2022-11-28', 'Chairperson Israel Carino', 'Approved'),
('1669638989-SY2022-2023', 1, 12, 3, 'Test - Alpha SO', 'Sarah Mae Ong', 'Sarah Ong', 'Seminar', 'Onsite', 'Sample objective', NULL, '2022-12-03 08:00:00', '2022-12-03 17:00:00', 'Auditorium', 'All of CSE', NULL, NULL, NULL, NULL, '10000', '03::2000;;02::3000;;05::5000', '10923-11250-eventproposalforms.rar', 'Rejected', 1, '2022-11-28', '2022-12-07', 'Adviser Emerson Flores', ''),
('1669642112-SY2022-2023', 4, 12, NULL, 'ESports', 'Trisha Pega', ' ', 'Extra Curricular', 'Onsite', 'For students to have fun', NULL, '2022-10-17 17:01:00', '2022-10-24 17:01:00', 'JRU Guadrangle ', 'Students', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Rejected', 1, '2022-10-13', '2022-11-03', NULL, 'Already been done.'),
('1669642221-SY2022-2023', 4, 12, NULL, 'CSE Week 2022', 'Trisha Pega', 'COMSOC', 'Curricular', 'Onsite', 'a fun week for students of Computer Science Engineering ', NULL, '2022-10-16 17:06:00', '2022-10-23 17:06:00', 'JRU Gymnasium ', 'All Students', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Rejected', 1, '2022-10-13', '2022-11-03', NULL, 'Already been done'),
('1669642342-SY2022-2023', 4, 12, NULL, 'Comsoc Outreach Program', 'Trisha Pega', 'COMSOC', 'Outreach', 'Onsite', 'To teach kids programming', NULL, '2022-10-31 17:08:00', '2022-10-31 21:00:00', 'Kalentong St. ', 'Officers/Volunteer', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Reschedule', 5, '2022-10-13', '2022-11-03', NULL, 'reschedule'),
('1669857000-SY2022-2023', 1, 12, NULL, 'COMSOC Coding Seminar', 'Sarah Mae Ong', 'COMSOC and JPCS', 'Curricular', 'Online', 'Learn Coding with the help of the Junior Philippine Computer Society', NULL, '2022-11-08 10:00:00', '2022-11-08 18:00:00', 'Zoom', 'COMSOC members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Reschedule', 5, '2022-11-03', '2022-11-22', NULL, 'Approved'),
('1669857001-SY2022-2023', 3, 12, NULL, 'Comsoc Members Assembly', 'Manuel Mark Idul', 'Comsoc members', 'Assembly', 'Online', 'Activity Preparation Assembly', NULL, '2022-11-11 08:00:00', '2022-11-11 18:00:00', 'Zoom', '20', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Rejected', 1, '2022-11-04', '2022-12-07', 'Adviser Emerson Flores', ''),
('1669857011-SY2022-2023', 4, 12, NULL, 'Freshmen Orientation and Pinning Ceremony', 'Trisha Pega', 'COMSOC', 'Assembly', 'Onsite', 'Face-to-Face and Back-to-Back Event', NULL, '2022-10-30 17:45:00', '2022-10-30 18:00:00', 'JRU Auditorium', 'freshmen and comsoc officers', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Done', 5, '2022-11-03', '2022-11-03', NULL, 'approved'),
('1669857058-SY2022-2023', 4, 12, NULL, 'ComSoc Technology and Innovation Seminar Series', 'Trisha Pega', 'COMSOC', 'Seminar', 'Onsite', 'Cyber Security Seminar', NULL, '2022-11-03 17:47:00', '2022-11-03 17:47:00', 'JRU Auditorium', 'COMSOC Members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Done', 5, '2022-11-03', '2022-11-03', NULL, 'approved'),
('1669857094-SY2022-2023', 4, 12, 3, 'ComSoc Technology and Innovation Seminar Series', 'Trisha Pega', 'ComSoc  Officers', 'Seminar', 'Online', 'To inspire students', NULL, '2022-12-01 14:00:00', '2022-12-01 16:00:00', 'Online', '200', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'For Revision', 1, '2022-11-16', '2022-12-07', 'Adviser Emerson Flores', ''),
('1669857111-SY2022-2023', 3, 12, NULL, 'Esports Competition', 'Manuel Mark Idul', 'COMSOC', 'Competition', 'Onsite', 'Have Esports Competition', NULL, '2022-11-25 18:07:00', '2022-11-04 21:00:00', 'H-405', 'Comsoc Members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Rejected', 1, '2022-11-04', '2022-11-04', NULL, 'this has already been done'),
('1669857120-SY2022-2023', 4, 12, NULL, 'COMSOC Esports Tryouts', 'Trisha Pega', 'COMSOC', 'Competition', 'Online', 'Tryout for esports comsoc edition', NULL, '2022-11-07 12:12:00', '2022-11-08 12:12:00', 'ZOOM', 'COMSOC Members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Done', 5, '2022-11-04', '2022-11-08', NULL, ''),
('1669857123-SY2022-2023', 3, 12, NULL, 'Programming Competition', 'Manuel Mark Idul', 'Comsoc', 'Competition', 'Onsite', 'to have a programming competition', NULL, '2022-11-25 18:07:00', '2022-11-04 21:00:00', 'JRU Quadrangle', 'Comsoc Members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'For Revision', 1, '2022-11-04', '2022-11-04', NULL, 'revise the budget request'),
('1669857123312-SY2022-2023', 1, 33, 3, 'CCE Season 2 Event', 'Kahlil Guanco', 'Rizalian Esports League', 'Competition', 'Onsite', 'Participate in the School parades, compete in Exhibition matches and awarding', NULL, '2022-11-26 12:32:00', '2022-11-26 20:00:00', 'SM Mall of Asia Music Hall', 'JRU ML Team', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Pending', 1, '2022-11-22', '2022-11-22', NULL, NULL),
('1669857135-SY2022-2023', 1, 12, NULL, 'CyberSecurity Seminar', 'Sarah Mae Ong', 'JRU ComSoc', 'Seminar', 'Hybrid', 'To learn about cybersecurity', NULL, '2022-11-17 19:30:00', '2022-11-17 20:00:00', 'Zoom and In Campus', 'All of CSE', NULL, NULL, NULL, NULL, '3000', '', '10923-11250-eventproposalforms.rar', 'Reschedule', 5, '2022-11-04', '2022-12-07', NULL, ''),
('1669857176-SY2022-2023', 1, 12, NULL, 'COMSOC meeting seminar', 'Sarah Mae Ong', 'COMSOC', 'Seminar', 'Online', 'to have meeting seminar', NULL, '2022-11-17 19:30:00', '2022-11-17 20:00:00', 'Zoom', 'comsoc members', NULL, NULL, NULL, NULL, '3000', '', '10923-11250-eventproposalforms.rar', 'Reschedule', 5, '2022-11-04', '2022-12-07', NULL, ''),
('1669857191-SY2022-2023', 4, 12, 3, 'Freshmen Orientation and Pinning Ceremony ', 'Trisha Pega', 'COMSOC Officers', 'Assembly', 'Hybrid', 'To welcome the freshmen students', NULL, '2022-11-22 13:00:00', '2022-11-16 16:00:00', 'Auditorium ', '100', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'For Revision', 1, '2022-11-16', '2022-12-07', 'Adviser Emerson Flores', 'Need to revise estimated budget'),
('1669857240-SY2022-2023', 4, 12, 3, 'Workstation Showcase', 'Jose Ricardo Ayala', 'Comsoc members', 'Competition', 'Online', 'Open to all ComSoc Members. Participants will show off the workstation they use for their online classes. Winners will receive cash prizes.', NULL, '2022-12-14 00:00:00', '2022-12-16 16:00:00', 'Online', 'Comsoc Members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Rejected', 1, '2022-11-16', '2022-11-28', 'Adviser Emerson Flores', 'Already been done'),
('1669857242-SY2022-2023', 4, 12, 3, 'Java Tutorial Webinar', 'Jose Ricardo Ayala', 'ComSoc Members', 'Seminar', 'Online', 'Java fundamentals and advanced tutorials intended for 1st Year ComSoc Members. Open to all ComSoc members who wish to attend.', NULL, '2023-01-20 14:00:00', '2023-01-20 16:00:00', 'Zoom', 'ComSoc Members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Approved', 5, '2022-11-16', '2022-11-16', NULL, ''),
('1669857256-SY2022-2023', 3, 16, NULL, 'SEMINAR', 'Candid Patrice Cataneda', 'NURSOC', 'Seminar', 'Online', 'Enlighten nursing peeps', NULL, '2022-11-06 17:54:00', '2022-11-06 17:54:00', 'Online', 'Students of nursing', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Pending', 1, '2022-11-04', '2022-11-04', NULL, NULL),
('1669857272-SY2022-2023', 3, 12, NULL, 'ComSoc Assembly', 'Manuel Mark Idul', 'test', 'Assembly', 'Online', 'Assembly', NULL, '2022-11-04 19:00:00', '2022-11-04 22:00:00', 'test', 'comsoc members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Approved', 5, '2022-11-04', '2022-11-04', NULL, 'approved'),
('1669857283-SY2022-2023', 3, 12, NULL, 'Comsoc TeamBuilding', 'Manuel Mark Idul', 'Comsoc Members', 'Teambuilding', 'Online', 'Comsoc teambuilding activity', NULL, '2022-11-11 08:00:00', '2022-11-11 18:00:00', 'Zoom', '20', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'For Revision', 1, '2022-11-04', '2022-12-07', 'Adviser Emerson Flores', ''),
('1669857304-SY2022-2023', 1, 12, NULL, 'Courtesy Call with VKF', 'Sarah Mae Ong', 'RSO Presidents with VKF', 'Assembly', 'Onsite', 'Courtesy Call of RSO Presidents with VKF to present the flagship activities.\r\n', NULL, '2022-11-10 18:02:00', '2022-11-20 18:02:00', 'JRU Quadrangle', ' RSO Presidents with VKF', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'For Revision', 1, '2022-11-03', '2022-11-03', NULL, 'revise this'),
('1669857348-SY2022-2023', 4, 12, 3, '12th IT Skills Olympics ', 'Trisha Pega', 'CSE/COMSOC Officer', 'Competition', 'Hybrid', 'For students to master their skills', NULL, '2022-11-16 19:30:00', '2022-11-17 16:00:00', 'H310', '20', NULL, NULL, NULL, NULL, '3000', '', '10923-11250-eventproposalforms.rar', 'Reschedule', 5, '2022-11-16', '2022-12-07', NULL, 'Approved'),
('1669857395-SY2022-2023', 4, 12, 3, 'COMSOC ESports ', 'Trisha Pega', 'COMSOC members', 'Competition', 'Online', 'For students to have fun', NULL, '2022-11-17 23:16:00', '2022-11-18 23:16:00', 'Online', '20', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'For Revision', 1, '2022-11-16', '2022-11-28', 'Adviser Emerson Flores', 'Revise date'),
('1669857411-SY2022-2023', 4, 12, NULL, 'RSO Renewal', 'Trisha Pega', 'Comsoc officers', 'Other', 'Onsite', 'Application for RSO Renewal in coordination with SDO and CSC.', NULL, '2022-10-29 17:42:00', '2022-09-29 23:00:00', 'SDO Office', 'Comsoc officers', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Done', 5, '2022-11-03', '2022-11-03', NULL, 'approved'),
('1669857458-SY2022-2023', 4, 12, NULL, 'ComSoc Rebranding: Logo Design Competition', 'Trisha Pega', 'COMSOC', 'Competition', 'Online', 'To promote ComSoc by rebranding the look and feel of the logo with a new visual identity', NULL, '2022-11-11 10:00:00', '2022-11-14 20:00:00', 'Zoom', 'Comsoc Members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Reschedule', 5, '2022-11-03', '2022-11-03', NULL, ''),
('1669857511-SY2022-2023', 4, 12, NULL, 'COMSOC Acquaintance Event', 'Trisha Pega', 'COMSOC', 'Socialization/Teambuilding', 'Online', 'Get to know comsoc officers and members', NULL, '2022-11-05 10:00:00', '2022-11-03 10:00:00', 'Zoom', 'Comsoc Members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'For Revision', 1, '2022-11-03', '2022-12-07', 'Adviser Emerson Flores', 'Revise date'),
('1669857568-SY2022-2023', 4, 12, 3, 'CSE Week', 'Trisha Pega', 'ComSoc', 'Assembly', 'Online', 'For students to have fun with the activities and prizes.', NULL, '2022-11-18 13:00:00', '2022-11-25 16:00:00', 'Online', '200', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Approved', 5, '2022-11-17', '2022-11-17', NULL, 'Approved.'),
('1669857726-SY2022-2023', 4, 12, 3, 'JRU Cybersecurity Webinar', 'Jose Ricardo Ayala', 'Comsoc members', 'Seminar', 'Online', 'The JRU ComSoc will host a Cybersecurity webinar for ComSoc members with guest speakers from a renowned tech company.', NULL, '2022-11-19 08:00:00', '2022-11-19 12:00:00', 'Zoom', 'Comsoc members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Rejected', 1, '2022-11-16', '2022-12-07', 'Adviser Emerson Flores', ''),
('1669857897-SY2022-2023', 4, 12, 3, 'PC Assembly and Disassembly Competition', 'Jose Ricardo Ayala', 'ComSoc', 'Competition', 'Onsite', 'A PC Assembly and Disassembly Competition hosted by comsoc is open to all ComSoc members. Participating members will form groups of 3 to compete with other groups. The groups must assemble and disassemble the system unit provided in the competition. The fastest one to finish the task with the most precision will win. The winners will receive a cash prize. ', NULL, '2022-12-07 13:00:00', '2022-12-07 15:00:00', 'JRU H311', 'ComSoc members', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Approved', 5, '2022-11-16', '2022-11-28', 'SDO John Doe', 'Project Approved'),
('1669857940-SY2022-2023', 4, 12, NULL, 'Mass Induction', 'Trisha Pega', 'JRU', 'Assembly', 'Onsite', 'Oath taking of all RSO officers', NULL, '2022-10-30 18:00:00', '2022-10-30 17:44:00', 'JRU Auditorium', 'RSO officers', NULL, NULL, NULL, NULL, '3000', '01::1000;;03::2000', '10923-11250-eventproposalforms.rar', 'Done', 5, '2022-11-03', '2022-11-03', NULL, 'approved'),
('1669878163-SY2022-2023', 4, 12, 3, 'CSE Webinar', 'Trisha Pega', 'ComSoc', 'Seminar', 'Online', 'A webinar for CSE students', NULL, '2022-12-02 07:00:00', '2022-12-03 16:00:00', 'Zoom', 'CSE Students', NULL, NULL, NULL, NULL, '500', '02::500', '33565-08983714.pdf', 'Approved', 5, '2022-12-01', '2022-12-01', 'SDO John Doe', ''),
('1670318756-SY2022-2023', 4, 12, 3, 'test', 'Trisha Pega', 'etst', 'Student Learning Circle', 'Onsite', 'tetete', NULL, '2022-12-17 17:24:00', '2022-12-29 17:24:00', 'tes', 'teee', NULL, NULL, NULL, NULL, '23333', '', '58447-bulk.zip', 'Reschedule', 2, '2022-12-06', '2022-12-07', 'Adviser Emerson Flores', ''),
('1670321717-SY2022-2023', 4, 12, 3, 'Sample', 'Trisha Pega', 'ComSoc', 'Extra Curricular', 'Onsite', 'Sample OBj', NULL, '2022-12-06 18:00:00', '2022-12-07 19:00:00', 'Quadrangle', 'JRU Students', NULL, NULL, NULL, NULL, '3250', '', '10883-favicon_io (1).rar', 'Reschedule', 3, '2022-12-06', '2022-12-07', 'Chairperson Israel Carino', 'CHange the budget 01 to 200'),
('1670390985-SY2022-2023', 4, 12, 3, 'tesy', 'Trisha Pega', 'test', 'Showcase', 'Onsite', '3213213', NULL, '2022-12-07 14:00:00', '2022-12-14 13:28:00', 'test', '31232', NULL, NULL, NULL, NULL, '42333', '01::21212;;01::21121', '3629-bulk.zip', 'Rejected', 1, '2022-12-07', '2022-12-07', 'Adviser Emerson Flores', ''),
('1670423794-SY2022-2023', 4, 12, 3, 'Demo', 'Trisha Pega', 'Computer Society (COMSOC)', 'Socialization/Teambuilding', 'Online', 'demo', NULL, '2022-12-08 22:34:00', '2022-12-10 22:34:00', 'JRU Quadrangle', 'Demo', NULL, NULL, NULL, NULL, '6,000.00', '01::2000;;03::4000', '66611-bulk.zip', 'Pending', 1, '2022-12-07', '2022-12-07', NULL, NULL);

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
(1669632715, '1669632715', '\'Test\' has been created and submitted.', 'Trisha Pega', 35),
(1669633532, '1669633532', '\'CSE Internship Orientation\' has been created and submitted.', 'Trisha Pega', 35),
(1669633746, '1669633746', '\'Comsoc Outreach Program\' has been created and submitted.', 'Trisha Pega', 35),
(1669634377, '1669634377', '\'CSE Week - Esports Competition\' has been created and submitted.', 'Trisha Pega', 35),
(1669635052, '1669635052', '\'Data Analytics Webinar - Jupyter Notebook Tutorial\' has been created and submitted.', 'Trisha Pega', 35),
(1669635561, '1669633746', '\'Comsoc Outreach Program\' has been moved for revision by the adviser.', 'Adviser Emerson Flores', 19123412),
(1669635653, '81', '\'COMSOC ESports \' has been moved for revision by the adviser.', 'Adviser Emerson Flores', 19123412),
(1669635676, '84', '\'Workstation Showcase\' has been rejected by the adviser.', 'Adviser Emerson Flores', 19123412),
(1669637020, '1669635052', '\'Data Analytics Webinar - Jupyter Notebook Tutorial\' has been approved by the adviser.', 'Adviser Emerson Flores', 19123412),
(1669637062, '1669635052', '\'Data Analytics Webinar - Jupyter Notebook Tutorial\' has been approved by the Chair.', 'Chairperson Israel Carino', 15212212),
(1669637081, '1669637081', '\'test1\' has been created and submitted.', 'Manuel Mark Idul', 19),
(1669637092, '1669634377', '\'CSE Week - Esports Competition\' has been approved by the adviser.', 'Adviser Emerson Flores', 19123412),
(1669637115, '1669633532', '\'CSE Internship Orientation\' has been approved by the adviser.', 'Adviser Emerson Flores', 19123412),
(1669637138, '1669637081', '\'test1\' has been approved by the adviser.', 'Adviser Emerson Flores', 19123412),
(1669637176, '1669637081', '\'test1\' has been approved by the Chair.', 'Chairperson Israel Carino', 15212212),
(1669637182, '1669633532', '\'CSE Internship Orientation\' has been approved by the Chair.', 'Chairperson Israel Carino', 15212212),
(1669637246, '1669637081', '\'test1\' has been approved by the Dean.', 'Dean Liza Reyes', 19255562),
(1669637377, '83', '\'PC Assembly and Disassembly Competition\' has been approved by the SDO.', 'SDO John Doe', 18202422),
(1669638989, '1669638989', '\'Test - Alpha SO\' has been created and submitted.', 'Sarah Mae Ong', 15),
(1669642658, '1669642658', '\'Sample\' has been created and submitted.', 'Trisha Pega', 35),
(1669642775, '1669642658', '\'Sample\' has been approved by the adviser.', 'Adviser Emerson Flores', 19123412),
(1669642814, '1669642658', '\'Sample\' has been approved by the Chair.', 'Chairperson Israel Carino', 15212212),
(1669642917, '1669642658', '\'Sample\' has been approved by the Dean.', 'Dean Liza Reyes', 19255562),
(1669805994, '0', '\'test \\\' \\\"\' has been created and submitted.', 'Manuel Mark Idul', 19),
(1669857311, '0', '\'wewqw\' has been created and submitted.', 'Trisha Pega', 35),
(1669878163, '0', '\'CSE Webinar\' has been created and submitted.', 'Trisha Pega', 35),
(1669881685, '1669878163-SY2022-2023', '\'CSE Webinar\' has been approved by an adviser.', 'Adviser Emerson Flores', 19123412),
(1669882736, '1669878163-SY2022-2023', '\'CSE Webinar\' has been approved by the Chair.', 'Chairperson Israel Carino', 15212212),
(1669882782, '1669878163-SY2022-2023', '\'CSE Webinar\' has been approved by the Dean.', 'Dean Liza Reyes', 19255562),
(1669882919, '1669878163-SY2022-2023', '\'CSE Webinar\' has been approved by the SDO.', 'SDO John Doe', 18202422),
(1670318756, '1670318756-SY2022-2023', '\'test\' has been created and submitted.', 'Trisha Pega', 35),
(1670319786, '1670318756-SY2022-2023', '\'test\' has been approved by an adviser.', 'Adviser Emerson Flores', 19123412),
(1670321717, '1670321717-SY2022-2023', '\'Sample\' has been created and submitted.', 'Trisha Pega', 35),
(1670322482, '1670321717-SY2022-2023', '\'Sample\' has been approved by an adviser.', 'Adviser Emerson Flores', 19123412),
(1670323086, '1670321717-SY2022-2023', '\'Sample\' has been subject for revision by the Chair.', 'Chairperson Israel Carino', 15212212),
(1670323318, '1670321717-SY2022-2023', '\'Sample\' has been approved by an adviser.', 'Adviser Emerson Flores', 19123412),
(1670323359, '1670321717-SY2022-2023', '\'Sample\' has been approved by the Chair.', 'Chairperson Israel Carino', 15212212),
(1670390985, '1670390985-SY2022-2023', '\'tesy\' has been created and submitted.', 'Trisha Pega', 35),
(1670397443, '1669638989-SY2022-2023', '\'Test - Alpha SO\' has been rejected by the adviser.', 'Adviser Emerson Flores', 19123412),
(1670397454, '1669857001-SY2022-2023', '\'Comsoc Members Assembly\' has been rejected by the adviser.', 'Adviser Emerson Flores', 19123412),
(1670397469, '1669857094-SY2022-2023', '\'ComSoc Technology and Innovation Seminar Series\' has been subject for revision by the adviser.', 'Adviser Emerson Flores', 19123412),
(1670397481, '1669857191-SY2022-2023', '\'Freshmen Orientation and Pinning Ceremony \' has been subject for revision by the adviser.', 'Adviser Emerson Flores', 19123412),
(1670397504, '1669857283-SY2022-2023', '\'Comsoc TeamBuilding\' has been subject for revision by the adviser.', 'Adviser Emerson Flores', 19123412),
(1670397516, '1669857726-SY2022-2023', '\'JRU Cybersecurity Webinar\' has been rejected by the adviser.', 'Adviser Emerson Flores', 19123412),
(1670397523, '1669857511-SY2022-2023', '\'COMSOC Acquaintance Event\' has been subject for revision by the adviser.', 'Adviser Emerson Flores', 19123412),
(1670397541, '1670390985-SY2022-2023', '\'tesy\' has been rejected by the adviser.', 'Adviser Emerson Flores', 19123412),
(1670423794, '1670423794-SY2022-2023', '\'Demo\' has been created and submitted.', 'Trisha Pega', 35);

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
(1, 33, 19255530, 'Ronalyn Vizcarra', 'Because I am a gamer and like Esports', 'Deny', '2022-11-16'),
(2, 33, 19255515, 'Jose Ricardo Ayala', 'I want to participate in Collegiate Level Esports', 'Approved', '2022-11-17'),
(3, 33, 19254353, 'Kahlil Guanco', 'PRESIDENT AKO EH', 'Approved', '2022-11-22'),
(4, 33, 20256253, 'Ahr Ben Eric Tiamzon', 'Sabi ng president', 'Approved', '2022-11-22'),
(5, 33, 19254559, 'Andy Jan Vicente', 'I want to be a player', 'Approved', '2022-11-22'),
(6, 33, 19255322, 'Yancie Troy Saludo', 'I wanna be a part of this org', 'Pending', '2022-11-27'),
(7, 32, 20257214, 'Manuel Mark Idul', 'Former member ENC-UPLB', 'Pending', '2022-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_signatories`
--

CREATE TABLE `tb_signatories` (
  `id` int(255) NOT NULL,
  `school_id` varchar(11) NOT NULL,
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
(1, '11-112122', 'Yves Saint', 'Laurent', 'yvessaint.laurent@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 2, 1, NULL, '2022-11-28', NULL, 'img_avatar.png'),
(2, '12-211212', 'Eddard', 'Stark', 'eddard.stark@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 3, 1, NULL, '2022-11-28', NULL, 'img_avatar.png'),
(3, '15-212212', 'Israel', 'Carino', 'israel.carino@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 3, 3, NULL, '2022-11-28', NULL, 'img_avatar.png'),
(4, '15-313123', 'John', 'Snow', 'john.snow@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 4, 1, 4, '2022-11-28', NULL, 'img_avatar.png'),
(5, '17-211130', 'Paul', 'Maglaya', 'paul.maglaya@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 4, 3, 12, '2022-12-01', NULL, 'img_avatar.png'),
(6, '18-202422', 'John', 'Doe', 'john.doe@jru.edu', '7c222fb2927d828af22f592134e8932480637c0d', 3, 1, NULL, NULL, '2022-10-26', NULL, 'img_avatar.png'),
(7, '19-123412', 'Emerson', 'Flores', 'emerson.flores@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 4, 3, 12, '2022-10-26', 'This is my bio\r\n', 'img_avatar.png'),
(8, '19-255561', 'Jyr Marie', 'Reyes', 'jyrmarie.reyes@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 4, 3, 12, '2022-10-26', NULL, 'img_avatar.png'),
(9, '19-255562', 'Liza', 'Reyes', 'liza.reyes@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 2, 3, NULL, '2022-10-26', NULL, 'img_avatar.png'),
(10, '22-121212', 'Edelita', 'Lorico', 'edelita.lorico@jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 4, 3, 12, '2022-12-01', '', 'img_avatar.png'),
(12, '17-000000', 'Joe', 'Doe', 'joe.doe@.jru.edu', 'e6ab6e76850b0bb42818c18ce8db42759610422b', 3, 4, 3, 12, '2022-12-07', NULL, 'avatar-default.png');

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
(11, '17-000000', 'Joe', 'Doe', 'joe.doe@.jru.edu', 'e6ab6e76850b0bb42818c18ce8db42759610422b', 3, 4, 3, 12, '2022-12-01', NULL, 'avatar-default.png');

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
  `STUDENT_ID` varchar(12) NOT NULL,
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
(2, '14-363015', 'Jaucian', 'Aubrey Jane', 'F', '2000-06-11', 22, 'Female', '4', 'aubreyjane.jaucian@my.jru.edu', '832e8aa564768a09f7de2e244e8bbfd08013ad0a', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-11-04', 'img_avatar.png', NULL, ''),
(3, '15-300166', 'Medina', 'Leah Abigail', 'Magpantay', '2001-06-16', 21, 'Female', '3', 'leahabigail.medina@my.jru.edu', 'd7dba4c56c98b058023cb01e3eee9d51072ecc48', 3, 'Bachelor of Science in Entertainment and Multimedia Computing (BSEMC) Major in Digital Animation Tec', '301D', 12, NULL, '', 1, '2022-11-04', '46197-2x2.png', NULL, ''),
(4, '17-253161', 'Castro', 'Jerodilyn', 'Cruz', '1992-02-15', 30, 'Female', '4', 'jerodilyn.castro@my.jru.edu', '87fecfdfbdafcc24620bcc6564a8b3295c78fb3a', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 12, NULL, '', 1, '2022-11-04', 'img_avatar.png', NULL, ''),
(5, '17-400321', 'De Leon', 'Paulo', '', '2000-07-07', 22, 'Male', '4', 'paulo.deleon@my.jru.edu', '9efceace4fc08a290ac0ef1564e58436ba02c564', 2, 'Bachelor of Science in Accountancy (BSA)', '401I', 12, NULL, '', 1, '2022-11-04', 'img_avatar.png', NULL, '7143402555'),
(6, '17-400377', 'Tayuni', 'Rodney', 'Ison', '2000-01-27', 22, 'Male', '4', 'rodney.tayuni@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-11-04', 'img_avatar.png', NULL, ''),
(7, '17-401211', 'Legaspi', 'Bienvenido', 'Argote', '2000-06-13', 22, 'Male', '4', 'bienvenido.legaspiii@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 12, NULL, '', 1, '2022-11-17', '56243-ZoomPic.jpg', 'Skill diff.', ''),
(8, '18-255530', 'Morales', 'Karlo Redeemer', 'R', '1995-03-20', 27, 'Male', '4', 'karloredeemer.morales@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 2, 'Bachelor of Arts (AB) Major in Economics', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(9, '18-403234', 'Andaya', 'Santiniel', 'Vargas', '2000-01-12', 22, 'Male', '4', 'santiniel.andaya@my.jru.edu', '67d807abb1f6cfe5967a2ff223f22a1dc11d61d7', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 12, NULL, '', 1, '2022-11-08', 'img_avatar.png', NULL, ''),
(10, '19-254353', 'Guanco', 'Kahlil', 'Atienza', '2000-03-30', 22, 'Male', '4', 'kahlil.guanco@my.jru.edu', 'f7e97f3360a80b06ab0305d2120d329b98166b08', 3, 'Bachelor of Science in Information Technology (BSIT-AGD) Major in Animation and Game Development', '401GA', 33, NULL, ',[33]', 1, '2022-11-22', 'img_avatar.png', NULL, ''),
(11, '19-254559', 'Vicente', 'Andy Jan', '', '1999-10-12', 23, 'Male', '4', 'andyjan.vicente@my.jru.edu', '4142625de7b1537ce75f0b5a842fada50924cee1', 3, 'Bachelor of Science in Entertainment and Multimedia Computing (BSEMC) Major in Digital Animation Tec', '401GA', 12, NULL, ',[33]', 1, '2022-11-22', '5855-sun-flower-3292932_1280-800x500.jpg', NULL, ''),
(12, '19-254917', 'Resumen', 'Rovie Ann', 'Mangampo', '1999-12-19', 22, 'Female', '4', 'rovieann.resumen@my.jru.edu', '880e67a49d27237176b3b951eeb11f8a319f9712', 3, 'Bachelor of Science in Information Technology (BSIT)', '302I', 12, NULL, '', 1, '2022-11-04', 'img_avatar.png', NULL, ''),
(13, '19-255234', 'CORCEGA', 'LANCE JOSHUA ', 'CAMELO', '1999-03-30', 23, 'Male', '4', 'lancejoshua.corcega@my.jru.edu', '3cfb439d7e56b3f1ad67934682317cb5bf6d014f', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-11-04', 'img_avatar.png', NULL, '3891734336'),
(14, '19-255322', 'Saludo', 'Yancie Troy', 'Hernandez', '1999-11-14', 22, 'Male', '4', 'yancietroy.saludo@my.jru.edu', 'c5bcb280184841e400abbdc40cf83d9959cf7bc4', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 12, NULL, '', 1, '2022-11-04', '75740-JRU Virtual Background 22_23 (3).jpg', '4th year as COMSOC Committee', ''),
(15, '19-255515', 'Ayala', 'Jose Ricardo', 'J', '1999-06-17', 23, 'Male', '4', 'josericardo.ayala@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, ',[33]', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(16, '19-255530', 'Vizcarra', 'Ronalyn', 'Reyes', '1999-08-09', 23, 'Female', '4', 'ronalyn.vizcarra@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, ',[]', 2, '2022-11-16', '88612-hihi.jpg', NULL, ''),
(17, '19-255532', 'Pega', 'Trisha', '', '1999-07-09', 23, 'Female', '4', 'trisha.pega@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 2, '2022-10-13', '61894-hangeme.jpg', '2 years as COMSOC secretary', ''),
(18, '19-255533', 'Distajo', 'Mikka', '', '2000-12-07', 21, 'Female', '4', 'mikka.distajo@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(19, '19-255540', 'Cataneda', 'Candid Patrice', 'C', '2000-03-25', 22, 'Female', '4', 'candidpatrice.cataneda@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 5, 'Bachelor of Science in Nursing (BSN)', '401I', 16, NULL, ',[]', 2, '2022-10-13', 'img_avatar.png', NULL, ''),
(20, '19-255561', 'Carreros', 'Kean', 'V', '1999-11-27', 22, 'Male', '4', 'kean.carreros@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 1, 'Bachelor of Arts in Psychology (ABPsy)', '401I', 12, NULL, '', 2, '2022-10-13', 'img_avatar.png', NULL, ''),
(21, '19-255567', 'Fernandez', 'Louise', 'Quizon', '2000-02-08', 22, 'Male', '4', 'louise.fernandez@my.jru.edu', '238ea999a3be3885f5ce9d7dd5c8a68c15703337', 3, 'Bachelor of Science in Information Technology (BSIT)', '401i', 12, NULL, '', 1, '2022-11-22', 'img_avatar.png', NULL, '3766404799'),
(22, '19-255570', 'Gabas', 'May Ann', 'G', '2000-06-05', 22, 'Female', '4', 'mayann.gabas@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(23, '19-403314', 'Reyes', 'Nimuel Vincent', 'Felicia', '2002-10-13', 20, 'Male', '3', 'nimuelvincent.reyes@my.jru.edu', 'c199c3dfe726c914dc2aa4572b95849e5a980626', 3, 'Bachelor of Science in Information Technology (BSIT)', '302I', 12, NULL, '', 1, '2022-11-04', '10370-1x1.png', NULL, ''),
(24, '19-870000', 'Padilla', 'Athena', 'Estrada', '2000-09-01', 22, 'Female', '4', 'athena.padilla@my.jru.edu', '6f55186a9fb8bb89faa01a193759126b2d26eb41', 5, 'Bachelor of Science in Nursing (BSN)', '01', 16, NULL, '', 1, '2022-11-23', 'img_avatar.png', NULL, '1981836144'),
(25, '20-255530', 'Vizcarra', 'Ericka', 'R', '2000-09-03', 22, 'Female', '3', 'ericka.vizcarra@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 4, 'Bachelor of Science in Hospitality Management (BSHM)', '302I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(26, '20-256253', 'Tiamzon', 'Ahr Ben Eric', 'Colegado', '2000-10-06', 22, 'Male', '4', 'ahrbeneric.tiamzon@my.jru.edu', '0d65618fb1a1c024b8e4d0eca2ad80b30e27aa64', 3, 'Bachelor of Science in Information Technology (BSIT-AGD) Major in Animation and Game Development', '401-GA', 12, NULL, ',[33]', 1, '2022-11-22', '20225-kahlil proxy.jfif', NULL, ''),
(27, '20-256280', 'Tonido', 'Kenneth Jay', 'M', '1999-07-02', 23, 'Male', '4', 'kennethjay.tonido@my.jru.edu', '2ba2b01444688ee88d982d75a4cebf8045eac5fa', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, '', 1, '2022-11-04', '9859-Picsart_22-08-15_10-32-09-256.jpg', 'Events and Logistics Officer', ''),
(28, '20-256477', 'Tan', 'Sherrisse Myka', 'C', '2001-06-03', 21, 'Female', '4', 'sherrissemyka.tan@my.jru.edu', '1bbd14a53dae200f0c9e33b515184a8f580e0aa4', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, ',[]', 2, '2022-11-04', 'img_avatar.png', NULL, ''),
(29, '20-257214', 'Idul', 'Manuel Mark', '', '1993-11-14', 28, 'Male', '4', 'manuelmark.idul@my.jru.edu', 'c67751ffa430e0e4dcb759b24db6f2bd971a3a97', 3, 'Bachelor of Science in Information Technology (BSIT-BA) Major in Business Analytics', '401B', 12, NULL, '', 2, '2022-11-04', 'img_avatar.png', NULL, ''),
(30, '20-257791', 'Dimamay', 'Roseann', 'Joy', '1998-11-22', 23, 'Female', '4', 'roseannjoy.dimamay@my.jru.edu', 'db72dd32effe4a754a7973b107e4fb0f51370fa2', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 12, NULL, '', 1, '2022-11-04', 'img_avatar.png', NULL, ''),
(31, '20-257813', 'Estrada', 'Francis Gerome', 'Faduga', '2000-09-02', 22, 'Male', '4', 'francisgerome.estrada@my.jru.edu', '6f55186a9fb8bb89faa01a193759126b2d26eb41', 5, 'Bachelor of Science in Nursing (BSN)', '01', 16, NULL, '', 1, '2022-11-23', 'img_avatar.png', NULL, ''),
(32, '20-259030', 'Salopaso', 'Justine', 'E', '1999-03-23', 23, 'Male', '4', 'justine.salopaso@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 2, 'Bachelor of Science in Business Administration (BSBA) Major in Banking and Finance', '401I', 12, NULL, '', 1, '2022-10-13', 'img_avatar.png', NULL, ''),
(33, '20-406388', 'Tiu', 'Steven', '', '2004-06-07', 18, 'Male', '2', 'steven.tiu@my.jru.edu', '3bbff9eb85e4dd80bbadbc8e0024de48302cf921', 3, 'Bachelor of Science in Information Technology (BSIT)', '202I', 12, NULL, '', 1, '2022-11-22', 'img_avatar.png', NULL, ''),
(34, '21-258199', 'Ong', 'Sarah Mae', 'M', '1997-04-02', 25, 'Female', '3', 'sarahmae.ong@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT-BA) Major in Business Analytics', '301B', 12, NULL, '', 2, '2022-11-04', '96450-Ong - President.JPG', NULL, ''),
(35, '21-407480', 'Bacho', 'Nichole Dominic', '', '2003-03-27', 19, 'Female', '1', 'nicholedominic.bacho@my.jru.edu', 'd4096393df316e4744b6aa3199df88223e5739b2', 3, '', '101D', 12, NULL, '', 1, '2022-11-04', 'img_avatar.png', NULL, ''),
(36, '22-258983', 'Barlos', 'Darwin', 'Samillano', '2003-03-21', 19, 'Male', '2', 'darwin.barlos@my.jru.edu', 'c2782a3cccf5330b06c1021b4b456cdfdcd28443', 3, 'Bachelor of Science in Information Technology (BSIT)', '204I', 12, NULL, '', 2, '2022-11-04', 'img_avatar.png', NULL, '7662019082'),
(37, '22-260400', 'Bondad', 'Jan Fernan', 'Ignacio', '2000-12-02', 21, 'Male', '2', 'janfernan.bondad@my.jru.edu', 'ac86e59aec395b2fef2ce982a7ef90ed4138b086', 3, 'Bachelor of Science in Information Technology (BSIT)', '202I', 12, NULL, '', 1, '2022-11-22', 'img_avatar.png', NULL, ''),
(38, '23-260628', 'Puyawan', 'Frederique', 'Angeles', '2004-06-03', 18, 'Male', '1', 'frederique.puyawan@my.jru.edu', 'a468b2260e28a97f45af398aea1d1760edb1ef23', 3, '', '101D', 12, NULL, '', 2, '2022-11-04', 'img_avatar.png', NULL, ''),
(39, '23-261387', 'Romero', 'Sophia Marie', 'Marantal', '2004-06-12', 18, 'Female', '1', 'sophiamarie.romero@my.jru.edu', '6a6646c12d9cca65657692bfc5a765d6b4241901', 3, '', '101D', 12, NULL, '', 2, '2022-11-04', 'img_avatar.png', NULL, ''),
(40, '23-261983', 'Lee', 'Tricia Mae', '', '2000-04-17', 23, 'Female', '1', 'triciamae.lee@my.jru.edu', 'a19839b443c94502935006036c48aecdcfebcda1', 3, 'Bachelor of Science in Information Technology (BSIT)', '105I', 12, NULL, '', 2, '2022-11-04', 'img_avatar.png', NULL, ''),
(160, '15-123456', 'Doe', 'Jane', '', '1988-03-22', 34, 'Female', '4', 'jane.doe@my.jru.edu', 'c67751ffa430e0e4dcb759b24db6f2bd971a3a97', 5, 'Bachelor of Science in Nursing (BSN)', '401ABCDF', 16, NULL, NULL, 1, '2022-11-28', 'img_avatar.png', NULL, '8322806882'),
(162, '15-300210', 'Madrio', 'Ailyn Joy', '', '2001-08-03', 21, 'Female', '3', 'ailynjoy.madrio@my.jru.edu', '451ec4a5690dac1660e20bc40126cd50506fec5e', 3, 'Bachelor of Science in Information Technology (BSIT-BA) Major in Business Analytics', '301BA', 12, NULL, ',[]', 2, '2022-11-28', 'img_avatar.png', NULL, ''),
(163, '18-401357', 'Tagapolot', 'Ronalyn', 'Faura', '2000-09-28', 22, 'Female', '4', 'ronalyn.tagapolot@my.jru.edu', '1bfc13ebfa0d2556ee5e84a682bef48ad17d753b', 3, 'Bachelor of Science in Information Technology (BSIT)', '401i', 12, NULL, NULL, 1, '2022-11-28', 'img_avatar.png', NULL, ''),
(164, '19-255609', 'Capatoy', 'Ina Isabel', '', '2000-04-27', 22, 'Female', '4', 'inaisabel.capatoy@my.jru.edu', '5509929d7744349c21ceb43b1d7f210d6fb2ebb2', 3, 'Bachelor of Science in Information Technology (BSIT)', '402i', 12, NULL, NULL, 1, '2022-11-29', 'img_avatar.png', NULL, ''),
(166, '14-363087', 'Dela Cruz', 'Johnvic', 'Daoang', '2001-05-21', 21, 'Male', '4', 'johnvic.delacruz@my.jru.edu', '16cfa560b1e3061f920f7aa454f8f09e55eac7aa', 3, 'Bachelor of Science in Information Technology (BSIT)', '402I', 12, NULL, NULL, 1, '2022-11-30', 'img_avatar.png', NULL, ''),
(207, '19-000000', 'ABORDAJE', 'JET BOY', '', '2003-01-23', 19, 'Male', '2', 'jetboy.abordaje@my.jru.edu', 'f2d6f1c42115fd14f9472027335cac40c3f8f057', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(208, '19-000001', 'ALEJANDRO JR', 'ROY ', 'OLESCO', '2004-10-24', 18, 'Male', '2', 'roy.alejandrojr@my.jru.edu', '0060f080c2f200c7720ddfc69de95882f6c06ce2', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(209, '19-000002', 'AMPIL', 'JOSHUA CARL', 'BUMANGLAG', '2002-07-27', 20, 'Male', '2', 'joshuacarl.ampil@my.jru.edu', 'b85ccf7d0e7a7dbc4aa93ea418e641ca7a3cd2f8', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(210, '19-000003', 'AQUINO', 'VINCE JERIEL', 'ANCHETA', '2003-07-03', 19, 'Male', '2', 'vincejeriel.aquino@my.jru.edu', 'b733b1d05ab85937a8a25c6aa42cdaa7b58d5deb', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(211, '19-000004', 'BALBEO', 'DANIELLE', 'MARQUEZ', '2002-05-19', 20, 'Male', '2', 'danielle.balbeo@my.jru.edu', '1511ce97418578db083384d40a9eef65d5769043', 3, 'Bachelor of Science in Information Technology (BSIT)', '201I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(212, '19-000005', 'BELLO', 'JOHN PATRICK', 'CAMINADE', '2002-11-16', 20, 'Male', '2', 'johnpatrick.bello@my.jru.edu', '949e1f4c61cd827884cacecbfd8ab398cac0bf9f', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(213, '19-000006', 'BETO', 'LENJUN ', 'LINAGA', '2003-02-09', 19, 'Male', '2', 'lenjun.beto@my.jru.edu', '29a3542ae5a8a03a091407f950afef38eb04b4fb', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(214, '19-000007', 'BORRIS', 'SAIDELYN ', 'NORMAELO DIMADARA', '2004-01-20', 18, 'Male', '2', 'saidelynnormaelo.borris@my.jru.edu', '8540c8f98c12ed2fe4d497c7da5a5bdd74da0749', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(215, '19-000008', 'CABATIC', 'GIAN CLYDE ', 'TANGONAN', '2001-12-23', 21, 'Male', '2', 'gian.cabatic@my.jru.edu', '8f587330e1a4d2018d404707897f7e4294cb0424', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(216, '19-000009', 'CANUA', 'ANDRIE WENDELL', 'RUZGAL', '2003-07-03', 19, 'Male', '2', 'andreiwendell.canua@my.jru.edu', 'a9e34cba69899c943ce5e6fd205959f6830e0c70', 5, 'Bachelor of Science in Nursing (BSN)', '201N', 16, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(217, '17-000000', 'ABORDO', 'JOUAN ', 'ADVINCULA', '2003-02-27', 19, 'Male', '3', 'jouan.abordo@my.jru.edu', 'faf9d6968f71df7862fa9105607a26c9f3648103', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(218, '17-000001', 'ADORABLE', 'JAYSON ', 'DOLIM', '2002-02-20', 20, 'Male', '3', 'jayson.adorable@my.jru.edu', '24fba1c119619a54d4cf19f04f01d180d9597d57', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(219, '17-000002', 'ARANETA', 'JULIAN ', 'TAN', '2002-12-19', 20, 'Female', '3', 'julian.araneta@my.jru.edu', '00efa305a37b3097197e1c02d8f45aa52a3fe2c6', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(220, '17-000003', 'LOPEZ', 'DENZEL', 'SILOSNZE', '2001-04-12', 21, 'Female', '3', 'denzel.lopez@my.jru.edu', '306d25404a0e3a40f858297b9f1b688b34f0a3ea', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(221, '17-000004', 'CAROLINO', 'REYD ', 'DOLIM', '2003-05-26', 19, 'Male', '3', 'reyd.carolino@my.jru.edu', '2314a3dfe2847ed2bd2cd79f2b94f2b8f7f67ce1', 2, 'Bachelor of Science in Accountancy (BSA)', '301A', 8, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(222, '17-000005', 'CASTRO', 'MATTHEW ', 'DERRICK', '2001-12-17', 21, 'Male', '3', 'matthew.castro@my.jru.edu', 'b2c43aac81b15d2965f15053e71cd86361202477', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(223, '17-000006', 'CLEMENTE', 'RAINIER ', 'FRANCO', '2000-06-06', 22, 'Male', '3', 'rainier.clemente@my.jru.edu', '7616e76e636dd3b7d0a811bfb4672d76c00eb097', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(224, '17-000007', 'COLLANTES', 'LORENZE IVAN ', 'HERRERA', '2002-05-30', 20, 'Male', '3', 'lorenze.collantes@my.jru.edu', '715cb58a364eda1cc8699154da03bf2da7ed1c4e', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(225, '17-000008', 'CUYNO', 'CARL JEMUEL ', 'PARUNGAO', '2000-03-05', 22, 'Male', '3', 'carljemuel.cuyno@my.jru.edu', 'a337f5fd4b467998885ea4f6058b50c73338a796', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(226, '17-000009', 'DE JESUS', 'JULIANNE ', 'ARAOS', '2001-08-05', 21, 'Female', '3', 'julianne.dejesus@my.jru.edu', '7dfb8eaeb476b511755599b1d044977cf161cc23', 4, 'Bachelor of Science in Tourism Management (BSTM)', '301TM', 31, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(227, '18-000000', 'MONTINOLA', 'ALJON ', 'MALANA', '2004-09-15', 18, 'Male', '3', 'aljon.montinola@my.jru.edu', '76953d1a4f61a18767954a034fa41925f94d8583', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(228, '18-000001', 'MUNAR', 'JOERONEMO ', 'EBANO', '2000-06-01', 22, 'Male', '3', 'joeronemo.munar@my.jru.edu', 'ed2ddaadc62c7568bc95f8c890c372b6382a3cc0', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(229, '18-000002', 'PALO', 'EDUARDO ', 'ORAYAN', '2002-04-04', 20, 'Male', '3', 'eduardo.palo@my.jru.edu', 'abedc093e20c36463d4af0f36b97e882f2f12c73', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(230, '18-000003', 'PASCUA', 'JHAMIR ', 'AQUINO', '1999-06-30', 23, 'Male', '3', 'jhamir.pascua@my.jru.edu', '803c45b0222b2b5c46cca8b244737187887a6997', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(231, '18-000004', 'RAMIRO', 'REGIS MIGUEL', 'CABRERA', '2001-04-23', 21, 'Male', '3', 'regismiguel.ramiro@my.jru.edu', '3e03b7eb54ed320505ddd5942ddb694834c95e9a', 6, 'Bachelor of Science in Criminology (BSCrim)', '301Crim', 2, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(232, '18-000005', 'RODILLO', 'BRYAN CHRISTOPHER', 'FIGUEROA', '2002-03-15', 20, 'Male', '3', 'bryanchristopher.rodillo@my.jru.edu', 'a6f01d0aa2abfc7079c150667d51823d17e334c5', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(233, '18-000006', 'SANTOS', 'RANIEL SHEAN ', 'PAREDES', '2004-11-04', 18, 'Female', '3', 'ranielshean.santos@my.jru.edu', '4b602d06049405443f51e0ea8eeb3efad684d8d9', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(234, '18-000007', 'STA. ANA', 'GABRIEL ', 'SERRANO', '2001-12-20', 21, 'Male', '3', 'gabriel.staana@my.jru.edu', '4204e1b54bf765e68115c7fcde73964a9bd3e027', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(235, '18-000008', 'TAGARA', 'JOHN LUDWIG ', 'PLATON', '2003-01-26', 19, 'Male', '3', 'johnludwig.tagara@my.jru.edu', 'e07b2b79f6265f687d3d033fd67eb8d3a1690c41', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(236, '18-000009', 'DIAZ', 'KRISTIAN NAGUIT', 'NAGUIT', '2001-12-09', 21, 'Male', '3', 'kristian.diaz@my.jru.edu', '78a471443cc5bd1a4d79bcb82cf822b07bc2e081', 3, 'Bachelor of Science in Computer Engineering (BSCpE)', '301CpE', 13, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(237, '20-000000', 'BALATAR', 'PAOLO DE LIMA', 'DE LIMA', '1998-08-12', 24, 'Male', '4', 'paolo.balatar@my.jru.edu', 'e92a665fe6951c913ee862f7f7aa1b59c28b0d0d', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(238, '20-000001', 'BORCES', 'MARK MANUEL ', 'SANDOVAL', '1997-10-25', 25, 'Male', '4', 'markmanuel.borces@my.jru.edu', '76121c03d2350dc0ce23f317a60130fa997cb65f', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(239, '20-000002', 'CAADIANG', 'ALJEN KAEIRISH JEANINE ', 'DELA CRUZ', '1998-07-12', 24, 'Female', '4', 'aljenkaeirishjeanine.caadiang@my.jru.edu', '7458a9996091f29164a716cd4b5f71d76c80de15', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(240, '20-000003', 'CARILLO', 'AARON JOSEPH ', 'NOCON', '1999-01-01', 23, 'Male', '4', 'aaronjoseph.carillo@my.jru.edu', '3cb8f0e739273e8bc5c09bfed6097d95cbc20085', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(241, '20-000004', 'CASTOLO', 'JERALD ', 'VITALICIO', '1999-08-16', 23, 'Male', '4', 'jerald.castolo@my.jru.edu', '06c0ec5dfca3e202f572c27f7dc1e34d51cdc832', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(242, '20-000005', 'CATINDIG JR.', 'ANTHONY ', 'MACAZO', '1997-10-25', 25, 'Male', '4', 'anthony.catindigjr@my.jru.edu', '1f7bfd762aceac5f4cb7371dc0835d252f3ac52a', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(243, '20-000006', 'CHAN', 'JOEMARK LUIS ', 'SEGUI', '1994-02-13', 28, 'Male', '4', 'joemarkluis.chan@my.jru.edu', 'c524ee496dc1b245f63ed1bd9db6d5eb8f862e03', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(244, '20-000007', 'CONCEPCION', 'ARTHUR ', 'REYES', '1997-01-04', 25, 'Male', '4', 'arthur.concepcion@my.jru.edu', 'a812d0be5e5d1fafeaf75b18c03fe35dfe7e0d00', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL),
(245, '20-000009', 'COSMOD', 'PATRICK ', 'SANSAN', '1999-01-08', 23, 'Male', '4', 'patrick.cosmod@my.jru.edu', 'fba05145859480c7cef3d03c78595a328525bdfd', 3, 'Bachelor of Science in Information Technology (BSIT)', '401I', 12, NULL, NULL, 1, '2022-12-07', 'avatar-default.png', NULL, NULL);

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

--
-- Dumping data for table `tb_students_archive`
--

INSERT INTO `tb_students_archive` (`ID`, `STUDENT_ID`, `LAST_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `BIRTHDATE`, `AGE`, `GENDER`, `YEAR_LEVEL`, `EMAIL`, `PASSWORD`, `COLLEGE_DEPT`, `COURSE`, `SECTION`, `MORG_ID`, `ORG_ID`, `ORG_IDS`, `USER_TYPE`, `ACCOUNT_CREATED`, `PROFILE_PIC`, `BIO`, `VCODE`) VALUES
(1, 0, 'Backi to in WLRISS16507WLRISS2 ggd85. NEARXDF misy', 'Backi to in WLRISS16507WLRISS2 ggd85. NEARXDF misy', 'Backi to in WLRISS16507WLRISS2', '0000-00-00', 31, 'Male', '4', 'retowan1986@mail.ru', '1ce936e211edee93b339f2e7f6e98b36f4c1e8ee', 4, 'Bachelor of Secondary Education (BSED) Major in Social Studies', '116 row a ', 13, NULL, '', 1, '2022-11-22', 'img_avatar.png', NULL, 2147483647),
(41, 0, ' TRICIA MAE CRUZ', 'triciamae.zantua@my.jru.edu', '', '0000-00-00', 0, '', '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 0, '', '', 0, NULL, NULL, 1, '2022-11-27', 'avatar-default.png', NULL, NULL),
(1, 0, 'Backi to in WLRISS16507WLRISS2 ggd85. NEARXDF misy', 'Backi to in WLRISS16507WLRISS2 ggd85. NEARXDF misy', 'Backi to in WLRISS16507WLRISS2', '0000-00-00', 31, 'Male', '4', 'retowan1986@mail.ru', '1ce936e211edee93b339f2e7f6e98b36f4c1e8ee', 4, 'Bachelor of Secondary Education (BSED) Major in Social Studies', '116 row a ', 13, NULL, '', 1, '2022-11-22', 'img_avatar.png', NULL, 2147483647),
(165, 0, 'Esx9gIGI4RU5e', 'baGaQQ1xk0vFGnLV', 'wB8N8ktFWExp', '2000-12-31', 0, 'Female', '5', '38fcvoish8q4cjtf5@hubmail.info', '8c84752153072bb8623245f4b5144eb768387ccc', 4, 'Bachelor of Arts (AB) Major in Economics', 'JUTilY291D', 34, NULL, NULL, 1, '2022-11-30', 'img_avatar.png', NULL, 2147483647);

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
(1667534650, 'JRU Election Survey', 'An evaluation survey regarding the recent elections', '2022-11-16', '2022-11-17', 12),
(1668591869, 'COMSOC E-Sports Survey', 'Please answer the feedback for the recent event held by COMSOC', '2022-11-16', '2022-11-17', 12),
(1668681933, 'JRUSOP Website Survey', 'Website Feedback', '2022-11-17', '2022-11-17', 12),
(1668688602, 'Feedback for CSE week', 'Feedback', '2022-11-17', '2022-11-17', 12),
(1669088261, 'Participant Outcome/Impact Evaluation', 'A demo survey for alpha testing', '2022-11-22', '2022-11-23', 12),
(1669092458, 'Ewan', 'IDK', '2022-11-22', '2022-11-23', 33),
(1669613562, 'ComSoc Esports', 'How was the event?', '2022-11-28', '2022-11-28', 12),
(1669635232, 'Standard Template', 'A standard template demo', '2022-11-28', '2022-11-30', 12),
(1669635279, 'Custom Survey Demo', 'With optional questions', '2022-11-28', '2022-11-30', 12),
(1669640085, 'Test Alpha SO', 'Test', '2022-11-28', '2022-12-02', 12),
(1669640124, 'Test Alpha', 'Test Alpha', '2022-11-28', '2022-11-28', 12),
(1669814438, 'dsad', 'dsd', '2022-11-30', '2022-11-30', 12),
(1669814979, 'test', 'test', '2022-11-30', '2022-11-30', 12),
(1669861118, 'JRUSOP Website Survey', 'eww', '2022-12-01', '2022-12-01', 12),
(1669875886, 'Custom Survey Redef', 'sample for redef', '2022-12-01', '2022-12-02', 12),
(1670424692, 'Demo', 'Demo', '2022-12-07', '2022-12-07', 12);

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
(1667495089, 'Feedback for ComSoc Technology and Innovation Seminar Series	', 'Feedback for ComSoc Technology and Innovation Seminar Series	', '2022-11-03', '2022-11-04', 12),
(1667495356, 'ComSoc Technology and Innovation Seminar Series	', 'Feedback for ComSoc Technology and Innovation Seminar Series	', '2022-11-03', '2022-11-04', 12),
(1667547268, 'COMSOC Event Survey', 'An evaluation survey regarding the recent event', '2022-11-05', '2022-11-05', 12),
(1667551122, 'Test Survey SO', 'Test', '2022-11-04', '2022-11-30', 12),
(1667902953, 'Coding Seminar Feedback', 'What did you think about the recent coding seminar event held?', '2022-11-10', '2022-11-12', 12),
(1668583755, 'COMSOC Event Survey', 'Please answer the feedback for the recent event held by COMSOC', '2022-11-16', '2022-11-16', 12),
(1668612420, 'Feedback on IT Project 2', 'Genuine survey about our proposed system in IT Project 2', '2022-11-16', '2022-11-17', 12),
(1668620966, 'TEST', 'TEST', '2022-11-16', '2022-11-17', 12),
(1668676275, 'JRUSOP Website Survey', 'Please answer a feedback form regarding the survey', '2022-11-17', '2022-11-17', 12),
(1668681917, 'test survey asdasdsadas', 'gsdfdsfds', '2022-11-17', '2022-11-18', 12),
(1668683706, 'GG Test', 'asdasdasdsa', '2022-11-17', '2022-11-18', 12),
(1669613851, 'Participant Outcome/Impact Evaluation', 'A demo survey for alpha testing', '2022-11-28', '2022-11-28', 12),
(1669615192, 'Alpha Testing: JRU Student Organization', 'We would like you input to our study. ', '2022-11-28', '2022-11-28', 12);

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
(43, 1667534650, 59, 17401211, 'Bien', 1667546973),
(44, 1667534650, 60, 17401211, '22', 1667546973),
(45, 1667534650, 61, 17401211, '[3]', 1667546973),
(46, 1667534650, 62, 17401211, '4', 1667546973),
(47, 1667534650, 63, 17401211, 'Good so far', 1667546973),
(48, 1667551122, 68, 21258199, 'asd123', 1667551469),
(49, 1667551122, 69, 21258199, 'asd\r\n123', 1667551469),
(50, 1667551122, 70, 21258199, '[0],[1]', 1667551469),
(51, 1667551122, 71, 21258199, '[1]', 1667551469),
(52, 1667551122, 72, 21258199, '[1]', 1667551469),
(53, 1667551122, 73, 21258199, '3', 1667551469),
(54, 1667551122, 74, 21258199, '123', 1667551469),
(55, 1668583755, 79, 19255532, 'Trisha', 1668583810),
(56, 1668583755, 80, 19255532, '23', 1668583810),
(57, 1668583755, 81, 19255532, '[0]', 1668583810),
(58, 1668583755, 82, 19255532, '4', 1668583810),
(59, 1668583755, 83, 19255532, 'Very Good ', 1668583810),
(60, 1668591869, 84, 19255532, 'Trisha Pega', 1668591930),
(61, 1668591869, 85, 19255532, 'BSIT', 1668591930),
(62, 1668591869, 86, 19255532, '[0]', 1668591930),
(63, 1668591869, 87, 19255532, '[0]', 1668591930),
(64, 1668591869, 88, 19255532, '4', 1668591930),
(65, 1668591869, 89, 19255532, 'Good and Fun', 1668591930),
(66, 1668612420, 90, 19255322, '3', 1668612487),
(67, 1668612420, 91, 19255322, '4', 1668612487),
(68, 1668620966, 92, 19255515, 'vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv\r\n', 1668621042),
(69, 1668620966, 92, 17401211, 'BSIT', 1668621070),
(70, 1667534650, 59, 19255322, 'Yancie Troy Saludo', 1668676022),
(71, 1667534650, 60, 19255322, '23', 1668676022),
(72, 1667534650, 61, 19255322, '[3]', 1668676022),
(73, 1667534650, 62, 19255322, '[4]', 1668676022),
(74, 1667534650, 63, 19255322, 'I like it', 1668676022),
(75, 1667534650, 59, 19255530, 'Ronalyn Vizcarra', 1668676045),
(76, 1667534650, 60, 19255530, '23', 1668676045),
(77, 1667534650, 61, 19255530, '[3]', 1668676045),
(78, 1667534650, 62, 19255530, '[4]', 1668676045),
(79, 1667534650, 63, 19255530, 'I am satisfied  to the result of the election', 1668676045),
(80, 1667534650, 59, 19255322, 'Yancie Troy Saludo', 1668676288),
(81, 1667534650, 60, 19255322, '23', 1668676288),
(82, 1667534650, 61, 19255322, '[3]', 1668676288),
(83, 1667534650, 62, 19255322, '[4]', 1668676288),
(84, 1667534650, 63, 19255322, 'I like it', 1668676288),
(85, 1667534650, 59, 19255570, 'May Ann Gabas', 1668676958),
(86, 1667534650, 60, 19255570, '22', 1668676958),
(87, 1667534650, 61, 19255570, '[3]', 1668676958),
(88, 1667534650, 62, 19255570, '[4]', 1668676958),
(89, 1667534650, 63, 19255570, 'The election results are good!', 1668676958),
(90, 1667534650, 59, 18255530, 'Karlo Redeemer Morales', 1668677235),
(91, 1667534650, 60, 18255530, '27', 1668677235),
(92, 1667534650, 61, 18255530, '[3]', 1668677235),
(93, 1667534650, 62, 18255530, '[4]', 1668677235),
(94, 1667534650, 63, 18255530, 'Satisfied with the results', 1668677235),
(95, 1667534650, 59, 19255561, 'Kean Carreros', 1668677816),
(96, 1667534650, 60, 19255561, '22', 1668677816),
(97, 1667534650, 61, 19255561, '[3]', 1668677816),
(98, 1667534650, 62, 19255561, '[3]', 1668677816),
(99, 1667534650, 63, 19255561, 'I reall liked the UI\r\n', 1668677816),
(100, 1667534650, 59, 19255540, 'Candid Patrice Castaneda', 1668678173),
(101, 1667534650, 60, 19255540, '22', 1668678173),
(102, 1667534650, 61, 19255540, '[3]', 1668678173),
(103, 1667534650, 62, 19255540, '[4]', 1668678173),
(104, 1667534650, 63, 19255540, 'The election went smooth!', 1668678173),
(105, 1667534650, 59, 20255530, 'Ericka Vizcarra', 1668678487),
(106, 1667534650, 60, 20255530, '22', 1668678487),
(107, 1667534650, 61, 20255530, '[2]', 1668678487),
(108, 1667534650, 62, 20255530, '[2]', 1668678487),
(109, 1667534650, 63, 20255530, 'none', 1668678487),
(110, 1667534650, 59, 19255533, ' Mikka Distajo', 1668678656),
(111, 1667534650, 60, 19255533, '21', 1668678656),
(112, 1667534650, 61, 19255533, '[3]', 1668678656),
(113, 1667534650, 62, 19255533, '[2]', 1668678656),
(114, 1667534650, 63, 19255533, 'no comment', 1668678656),
(115, 1667534650, 59, 19255532, ' Trisha Pega', 1668678934),
(116, 1667534650, 60, 19255532, '23', 1668678934),
(117, 1667534650, 61, 19255532, '[3]', 1668678934),
(118, 1667534650, 62, 19255532, '[1]', 1668678934),
(119, 1667534650, 63, 19255532, 'there should be more candida tes to choose from', 1668678934),
(120, 1667534650, 59, 20259030, ' Justine Salopaso', 1668679111),
(121, 1667534650, 60, 20259030, '23', 1668679111),
(122, 1667534650, 61, 20259030, '[3]', 1668679111),
(123, 1667534650, 62, 20259030, '[4]', 1668679111),
(124, 1667534650, 63, 20259030, 'no bugs found in the system', 1668679111),
(125, 1667534650, 59, 19255515, 'Jose Ricardo Ayala', 1668679303),
(126, 1667534650, 60, 19255515, '21', 1668679303),
(127, 1667534650, 61, 19255515, '[3]', 1668679303),
(128, 1667534650, 62, 19255515, '[4]', 1668679303),
(129, 1667534650, 63, 19255515, 'none', 1668679303),
(130, 1668591869, 84, 17401211, 'Bien', 1668682228),
(131, 1668591869, 85, 17401211, 'BSIT', 1668682228),
(132, 1668591869, 86, 17401211, '[0]', 1668682228),
(133, 1668591869, 87, 17401211, '[0]', 1668682228),
(134, 1668591869, 88, 17401211, '[4]', 1668682228),
(135, 1668591869, 89, 17401211, 'Better connection please.', 1668682228),
(136, 1668591869, 84, 18255530, 'Karlo Redeemer Morales', 1668682235),
(137, 1668591869, 85, 18255530, 'BSIT', 1668682235),
(138, 1668591869, 86, 18255530, '[0]', 1668682235),
(139, 1668591869, 87, 18255530, '[0]', 1668682235),
(140, 1668591869, 88, 18255530, '[4]', 1668682235),
(141, 1668591869, 89, 18255530, 'Good', 1668682235),
(142, 1668681917, 97, 17401211, '[4]', 1668682237),
(143, 1668681917, 98, 17401211, '[4]', 1668682237),
(144, 1668681917, 97, 18255530, '[4]', 1668682238),
(145, 1668681917, 98, 18255530, '[4]', 1668682238),
(146, 1668681933, 99, 18255530, '[4]', 1668682240),
(147, 1668591869, 84, 20255530, 'Ericka Vizcarra', 1668682240),
(148, 1668591869, 85, 20255530, 'BSHM', 1668682240),
(149, 1668591869, 86, 20255530, '[1]', 1668682240),
(150, 1668591869, 87, 20255530, '[2]', 1668682240),
(151, 1668591869, 88, 20255530, '[4]', 1668682240),
(152, 1668591869, 89, 20255530, 'make it open to more courses', 1668682240),
(153, 1668681933, 99, 17401211, '[4]', 1668682243),
(154, 1668681917, 97, 20255530, '[4]', 1668682244),
(155, 1668681917, 98, 20255530, '[4]', 1668682244),
(156, 1668681933, 99, 20255530, '[4]', 1668682245),
(157, 1668591869, 84, 19255561, 'Kean Carreos', 1668682304),
(158, 1668591869, 85, 19255561, 'BSIT', 1668682304),
(159, 1668591869, 86, 19255561, '[0]', 1668682304),
(160, 1668591869, 87, 19255561, '[0]', 1668682304),
(161, 1668591869, 88, 19255561, '[4]', 1668682304),
(162, 1668591869, 89, 19255561, 'Good ', 1668682304),
(163, 1668681917, 97, 19255561, '[4]', 1668682306),
(164, 1668681917, 98, 19255561, '[4]', 1668682306),
(165, 1668681933, 99, 19255561, '[4]', 1668682308),
(166, 1668681917, 97, 19255532, '[3]', 1668682933),
(167, 1668681917, 98, 19255532, '[2]', 1668682933),
(168, 1668681933, 99, 19255532, '[2]', 1668682948),
(169, 1668591869, 84, 19255322, 'Troy', 1668683155),
(170, 1668591869, 85, 19255322, 'BSIT', 1668683155),
(171, 1668591869, 86, 19255322, '[0]', 1668683155),
(172, 1668591869, 87, 19255322, '[0]', 1668683155),
(173, 1668591869, 88, 19255322, '[4]', 1668683155),
(174, 1668591869, 89, 19255322, 'I like it', 1668683155),
(175, 1668681917, 97, 19255322, '[4]', 1668683161),
(176, 1668681917, 98, 19255322, '[4]', 1668683161),
(177, 1668681933, 99, 19255322, '[4]', 1668683165),
(178, 1668683706, 100, 19255532, 'answer', 1668683729),
(179, 1668683706, 101, 19255532, '[1]', 1668683729),
(180, 1668591869, 84, 19255530, 'Rona', 1668688773),
(181, 1668591869, 85, 19255530, 'BSIT', 1668688773),
(182, 1668591869, 86, 19255530, '[0]', 1668688773),
(183, 1668591869, 87, 19255530, '[0]', 1668688773),
(184, 1668591869, 88, 19255530, '[4]', 1668688773),
(185, 1668591869, 89, 19255530, 'Nice event.', 1668688773),
(186, 1668681933, 99, 19255530, '[4]', 1668688781),
(187, 1668688602, 102, 19255530, 'Rona', 1668688800),
(188, 1668688602, 103, 19255530, '[2]', 1668688800),
(189, 1668688602, 104, 19255530, 'Nice', 1668688800),
(190, 1669088261, 105, 19255322, '[7]', 1669088508),
(191, 1669088261, 106, 19255322, '[0]', 1669088508),
(192, 1669088261, 107, 19255322, '[4]', 1669088508),
(193, 1669088261, 108, 19255322, 'It was very good!', 1669088508),
(194, 1669088261, 105, 19255515, '[7]', 1669088535),
(195, 1669088261, 106, 19255515, '[0]', 1669088535),
(196, 1669088261, 107, 19255515, '[4]', 1669088535),
(197, 1669088261, 108, 19255515, 'none', 1669088535),
(198, 1669088261, 105, 19255530, '[2]', 1669088596),
(199, 1669088261, 106, 19255530, '[0]', 1669088596),
(200, 1669088261, 107, 19255530, '[4]', 1669088596),
(201, 1669088261, 108, 19255530, 'good', 1669088596),
(202, 1669088261, 105, 22260400, '[2]', 1669090583),
(203, 1669088261, 106, 22260400, '[0]', 1669090583),
(204, 1669088261, 107, 22260400, '[3]', 1669090583),
(205, 1669088261, 108, 22260400, 'It is nice to be part of comsoc, Hello World!', 1669090583),
(206, 1669088261, 105, 20406388, '[2]', 1669090626),
(207, 1669088261, 106, 20406388, '[0]', 1669090626),
(208, 1669088261, 107, 20406388, '[4]', 1669090626),
(209, 1669088261, 108, 20406388, 'I am grateful to be part of COMSOC.', 1669090626),
(210, 1669088261, 105, 19254353, '[2]', 1669090880),
(211, 1669088261, 106, 19254353, '[0]', 1669090880),
(212, 1669088261, 107, 19254353, '[2]', 1669090880),
(213, 1669088261, 108, 19254353, 'All goods', 1669090880),
(214, 1669088261, 105, 20256253, '[7]', 1669091119),
(215, 1669088261, 106, 20256253, '[0]', 1669091119),
(216, 1669088261, 107, 20256253, '[4]', 1669091119),
(217, 1669088261, 108, 20256253, 'In participating for this program, I learned to be more productive.', 1669091119),
(218, 1669088261, 105, 19254559, '[7]', 1669091427),
(219, 1669088261, 106, 19254559, '[0]', 1669091427),
(220, 1669088261, 107, 19254559, '[4]', 1669091427),
(221, 1669088261, 108, 19254559, 'N/A', 1669091427),
(222, 1669613562, 112, 18255530, ' Karlo Redeemer Morales', 1669627535),
(223, 1669613562, 113, 18255530, '27', 1669627535),
(224, 1669613562, 114, 18255530, '[3]', 1669627535),
(225, 1669613562, 115, 18255530, '[1]', 1669627535),
(226, 1669613562, 116, 18255530, 'none\r\n', 1669627535),
(227, 1669613851, 117, 18255530, ' Karlo Redeemer Morales', 1669627715),
(228, 1669613851, 118, 18255530, '[7]', 1669627715),
(229, 1669613851, 119, 18255530, '[1]', 1669627715),
(230, 1669613851, 120, 18255530, '[2]', 1669627715),
(231, 1669613851, 121, 18255530, 'none', 1669627715),
(232, 1669615192, 122, 18255530, ' Karlo Redeemer Morales', 1669627728),
(233, 1669615192, 123, 18255530, '[2],[7]', 1669627728),
(234, 1669615192, 124, 18255530, '[1]', 1669627728),
(235, 1669615192, 125, 18255530, '[2]', 1669627728),
(236, 1669613562, 112, 20259030, ' Justine Salopaso', 1669628283),
(237, 1669613562, 113, 20259030, '23', 1669628283),
(238, 1669613562, 114, 20259030, '[3]', 1669628283),
(239, 1669613562, 115, 20259030, '[2]', 1669628283),
(240, 1669613562, 116, 20259030, 'yes', 1669628283),
(241, 1669613851, 117, 20259030, ' Justine Salopaso', 1669628296),
(242, 1669613851, 118, 20259030, '[7]', 1669628296),
(243, 1669613851, 119, 20259030, '[0]', 1669628296),
(244, 1669613851, 120, 20259030, '[4]', 1669628296),
(245, 1669613851, 121, 20259030, 'nn', 1669628296),
(246, 1669615192, 122, 20259030, ' Justine Salopaso', 1669628580),
(247, 1669615192, 123, 20259030, '[7]', 1669628580),
(248, 1669615192, 124, 20259030, '[0]', 1669628580),
(249, 1669615192, 125, 20259030, '[4]', 1669628580),
(250, 1669613562, 112, 19255561, ' Kean Carreros', 1669628892),
(251, 1669613562, 113, 19255561, '22', 1669628892),
(252, 1669613562, 114, 19255561, '[2]', 1669628892),
(253, 1669613562, 115, 19255561, '[4]', 1669628892),
(254, 1669613562, 116, 19255561, 'nn', 1669628892),
(255, 1669613851, 117, 19255561, ' Kean Carreros', 1669628911),
(256, 1669613851, 118, 19255561, '[8]', 1669628911),
(257, 1669613851, 119, 19255561, '[0]', 1669628911),
(258, 1669613851, 120, 19255561, '[4]', 1669628911),
(259, 1669613851, 121, 19255561, 'nn', 1669628911),
(260, 1669615192, 122, 19255561, ' Kean Carreros', 1669628916),
(261, 1669615192, 123, 19255561, '[8]', 1669628916),
(262, 1669615192, 124, 19255561, '[0]', 1669628916),
(263, 1669615192, 125, 19255561, '[4]', 1669628916),
(264, 1669613562, 112, 19255570, 'May Ann Gabas', 1669629204),
(265, 1669613562, 113, 19255570, '22', 1669629204),
(266, 1669613562, 114, 19255570, '[3]', 1669629204),
(267, 1669613562, 115, 19255570, '[4]', 1669629204),
(268, 1669613562, 116, 19255570, 'yes', 1669629204),
(269, 1669613851, 117, 19255570, 'May Ann Gabas', 1669629212),
(270, 1669613851, 118, 19255570, '[7]', 1669629212),
(271, 1669613851, 119, 19255570, '[0]', 1669629212),
(272, 1669613851, 120, 19255570, '[1]', 1669629212),
(273, 1669613851, 121, 19255570, 'nn', 1669629212),
(274, 1669615192, 122, 19255570, ' May Ann Gabas', 1669629269),
(275, 1669615192, 123, 19255570, '[7]', 1669629269),
(276, 1669615192, 124, 19255570, '[0]', 1669629269),
(277, 1669615192, 125, 19255570, '[2]', 1669629269),
(278, 1669613562, 112, 19255532, 'Trisha Pega', 1669629493),
(279, 1669613562, 113, 19255532, '23', 1669629493),
(280, 1669613562, 114, 19255532, '[3]', 1669629493),
(281, 1669613562, 115, 19255532, '[4]', 1669629493),
(282, 1669613562, 116, 19255532, 'nn', 1669629493),
(283, 1669613851, 117, 19255532, 'Trisha Pega', 1669629504),
(284, 1669613851, 118, 19255532, '[7]', 1669629504),
(285, 1669613851, 119, 19255532, '[0]', 1669629504),
(286, 1669613851, 120, 19255532, '[2]', 1669629504),
(287, 1669613851, 121, 19255532, 'yes', 1669629504),
(288, 1669615192, 122, 19255532, 'Trisha Pega', 1669629510),
(289, 1669615192, 123, 19255532, '[7]', 1669629510),
(290, 1669615192, 124, 19255532, '[0]', 1669629510),
(291, 1669615192, 125, 19255532, '[2]', 1669629510),
(292, 1669613562, 112, 20255530, 'Ericka Vizcarra', 1669629559),
(293, 1669613562, 113, 20255530, '22', 1669629559),
(294, 1669613562, 114, 20255530, '[2]', 1669629559),
(295, 1669613562, 115, 20255530, '[4]', 1669629559),
(296, 1669613562, 116, 20255530, 'nn', 1669629559),
(297, 1669613851, 117, 20255530, 'Ericka Vizcarra', 1669629565),
(298, 1669613851, 118, 20255530, '[7]', 1669629565),
(299, 1669613851, 119, 20255530, '[0]', 1669629565),
(300, 1669613851, 120, 20255530, '[4]', 1669629565),
(301, 1669613851, 121, 20255530, 'nn', 1669629565),
(302, 1669615192, 122, 20255530, 'Ericka Vizcarra', 1669629569),
(303, 1669615192, 123, 20255530, '[7]', 1669629569),
(304, 1669615192, 124, 20255530, '[0]', 1669629569),
(305, 1669615192, 125, 20255530, '[4]', 1669629569),
(306, 1669613562, 112, 19255322, 'Yancie Troy Saludo', 1669634850),
(307, 1669613562, 113, 19255322, '23', 1669634850),
(308, 1669613562, 114, 19255322, '[3]', 1669634850),
(309, 1669613562, 115, 19255322, '[2]', 1669634850),
(310, 1669613562, 116, 19255322, 'I lost the game', 1669634850),
(311, 1669635232, 126, 19255532, '[4]', 1669635512),
(312, 1669635232, 127, 19255532, '[4]', 1669635512),
(313, 1669635232, 128, 19255532, '[4]', 1669635512),
(314, 1669635232, 129, 19255532, '[4]', 1669635512),
(315, 1669635232, 130, 19255532, '[4]', 1669635512),
(316, 1669635232, 131, 19255532, '[4]', 1669635512),
(317, 1669635232, 132, 19255532, '[4]', 1669635512),
(318, 1669635232, 133, 19255532, '[4]', 1669635512),
(319, 1669635232, 134, 19255532, '[4]', 1669635512),
(320, 1669635232, 135, 19255532, '[3]', 1669635512),
(321, 1669635232, 136, 19255532, 'Good!', 1669635512),
(322, 1669635279, 137, 19255532, 'Trisha Pega', 1669635528),
(323, 1669635279, 138, 19255532, '[4]', 1669635528),
(324, 1669635232, 126, 18255530, '[4]', 1669635553),
(325, 1669635232, 127, 18255530, '[3]', 1669635553),
(326, 1669635232, 128, 18255530, '[4]', 1669635553),
(327, 1669635232, 129, 18255530, '[3]', 1669635553),
(328, 1669635232, 130, 18255530, '[3]', 1669635553),
(329, 1669635232, 131, 18255530, '[3]', 1669635553),
(330, 1669635232, 132, 18255530, '[4]', 1669635553),
(331, 1669635232, 133, 18255530, '[3]', 1669635553),
(332, 1669635232, 134, 18255530, '[4]', 1669635553),
(333, 1669635232, 135, 18255530, '[4]', 1669635553),
(334, 1669635232, 136, 18255530, 'standard temple ok', 1669635553),
(335, 1669635279, 137, 18255530, ' Karlo Redeemer Morales', 1669635565),
(336, 1669635279, 138, 18255530, '[3]', 1669635565),
(337, 1669635232, 126, 19255570, '[4]', 1669635566),
(338, 1669635232, 127, 19255570, '[4]', 1669635566),
(339, 1669635232, 128, 19255570, '[4]', 1669635566),
(340, 1669635232, 129, 19255570, '[4]', 1669635566),
(341, 1669635232, 130, 19255570, '[4]', 1669635566),
(342, 1669635232, 131, 19255570, '[4]', 1669635566),
(343, 1669635232, 132, 19255570, '[4]', 1669635566),
(344, 1669635232, 133, 19255570, '[4]', 1669635566),
(345, 1669635232, 134, 19255570, '[4]', 1669635566),
(346, 1669635232, 135, 19255570, '[4]', 1669635566),
(347, 1669635232, 136, 19255570, 'Very Good', 1669635566),
(348, 1669635279, 137, 19255570, 'May Ann  Gabas', 1669635578),
(349, 1669635279, 138, 19255570, '[4]', 1669635578),
(350, 1669635232, 126, 19255561, '[4]', 1669635667),
(351, 1669635232, 127, 19255561, '[4]', 1669635667),
(352, 1669635232, 128, 19255561, '[4]', 1669635667),
(353, 1669635232, 129, 19255561, '[3]', 1669635667),
(354, 1669635232, 130, 19255561, '[3]', 1669635667),
(355, 1669635232, 131, 19255561, '[3]', 1669635667),
(356, 1669635232, 132, 19255561, '[3]', 1669635667),
(357, 1669635232, 133, 19255561, '[4]', 1669635667),
(358, 1669635232, 134, 19255561, '[4]', 1669635667),
(359, 1669635232, 135, 19255561, '[3]', 1669635667),
(360, 1669635232, 136, 19255561, 'Nicely Done', 1669635667),
(361, 1669635232, 126, 20259030, '[4]', 1669635674),
(362, 1669635232, 127, 20259030, '[4]', 1669635674),
(363, 1669635232, 128, 20259030, '[3]', 1669635674),
(364, 1669635232, 129, 20259030, '[4]', 1669635674),
(365, 1669635232, 130, 20259030, '[4]', 1669635674),
(366, 1669635232, 131, 20259030, '[3]', 1669635674),
(367, 1669635232, 132, 20259030, '[4]', 1669635674),
(368, 1669635232, 133, 20259030, '[4]', 1669635674),
(369, 1669635232, 134, 20259030, '[4]', 1669635674),
(370, 1669635232, 135, 20259030, '[4]', 1669635674),
(371, 1669635232, 136, 20259030, 'nn', 1669635674),
(372, 1669635279, 137, 19255561, 'Kean Careos', 1669635680),
(373, 1669635279, 138, 19255561, '[4]', 1669635680),
(374, 1669635279, 137, 20259030, '', 1669635686),
(375, 1669635279, 138, 20259030, '[2]', 1669635686),
(376, 1669613562, 112, 17400377, 'Rodney tayuni', 1669636194),
(377, 1669613562, 113, 17400377, '22', 1669636194),
(378, 1669613562, 114, 17400377, '[3]', 1669636194),
(379, 1669613562, 115, 17400377, '[4]', 1669636194),
(380, 1669613562, 116, 17400377, 'Nothing', 1669636194),
(381, 1669635232, 126, 20255530, '[3]', 1669636480),
(382, 1669635232, 127, 20255530, '[4]', 1669636480),
(383, 1669635232, 128, 20255530, '[4]', 1669636480),
(384, 1669635232, 129, 20255530, '[4]', 1669636480),
(385, 1669635232, 130, 20255530, '[3]', 1669636480),
(386, 1669635232, 131, 20255530, '[4]', 1669636480),
(387, 1669635232, 132, 20255530, '[3]', 1669636480),
(388, 1669635232, 133, 20255530, '[4]', 1669636480),
(389, 1669635232, 134, 20255530, '[4]', 1669636480),
(390, 1669635232, 135, 20255530, '[4]', 1669636480),
(391, 1669635232, 136, 20255530, 'nn', 1669636480),
(392, 1669635279, 137, 20255530, ' Ericka Vizcarra', 1669636488),
(393, 1669635279, 138, 20255530, '[4]', 1669636488),
(394, 1669635232, 126, 17400377, '[4]', 1669636514),
(395, 1669635232, 127, 17400377, '[4]', 1669636514),
(396, 1669635232, 128, 17400377, '[4]', 1669636514),
(397, 1669635232, 129, 17400377, '[4]', 1669636514),
(398, 1669635232, 130, 17400377, '[4]', 1669636514),
(399, 1669635232, 131, 17400377, '[4]', 1669636514),
(400, 1669635232, 132, 17400377, '[4]', 1669636514),
(401, 1669635232, 133, 17400377, '[4]', 1669636514),
(402, 1669635232, 134, 17400377, '[4]', 1669636514),
(403, 1669635232, 135, 17400377, '[4]', 1669636514),
(404, 1669635232, 136, 17400377, 'Nothing', 1669636514),
(405, 1669635279, 137, 17400377, 'Rodney tayuni', 1669636529),
(406, 1669635279, 138, 17400377, '[4]', 1669636529),
(407, 1669613562, 112, 15300210, 'Ailyn Madrio ', 1669639548),
(408, 1669613562, 113, 15300210, '21', 1669639548),
(409, 1669613562, 114, 15300210, '[2]', 1669639548),
(410, 1669613562, 115, 15300210, '[3]', 1669639548),
(411, 1669613562, 116, 15300210, 'All goods', 1669639548),
(412, 1669635232, 126, 15300210, '[3]', 1669639570),
(413, 1669635232, 127, 15300210, '[3]', 1669639570),
(414, 1669635232, 128, 15300210, '[3]', 1669639570),
(415, 1669635232, 129, 15300210, '[3]', 1669639570),
(416, 1669635232, 130, 15300210, '[3]', 1669639570),
(417, 1669635232, 131, 15300210, '[3]', 1669639570),
(418, 1669635232, 132, 15300210, '[3]', 1669639570),
(419, 1669635232, 133, 15300210, '[3]', 1669639570),
(420, 1669635232, 134, 15300210, '[3]', 1669639570),
(421, 1669635232, 135, 15300210, '[3]', 1669639570),
(422, 1669635232, 136, 15300210, 'None ', 1669639570),
(423, 1669640085, 139, 19255532, '[4]', 1669640180),
(424, 1669640085, 140, 19255532, '[4]', 1669640180),
(425, 1669640085, 141, 19255532, '[4]', 1669640180),
(426, 1669640085, 142, 19255532, '[4]', 1669640180),
(427, 1669640085, 143, 19255532, '[4]', 1669640180),
(428, 1669640085, 144, 19255532, '[4]', 1669640180),
(429, 1669640085, 145, 19255532, '[4]', 1669640180),
(430, 1669640085, 146, 19255532, '[4]', 1669640180),
(431, 1669640085, 147, 19255532, '[4]', 1669640180),
(432, 1669640085, 148, 19255532, '[4]', 1669640180),
(433, 1669640085, 149, 19255532, 'Good', 1669640180),
(434, 1669613562, 112, 21258199, 'SO', 1669640193),
(435, 1669613562, 113, 21258199, '18', 1669640193),
(436, 1669613562, 114, 21258199, '[2]', 1669640193),
(437, 1669613562, 115, 21258199, '[4]', 1669640193),
(438, 1669613562, 116, 21258199, 'Sample', 1669640193),
(439, 1669640124, 150, 19255532, '[4]', 1669640219),
(440, 1669640124, 151, 19255532, '[4]', 1669640219),
(441, 1669640124, 152, 19255532, '[4]', 1669640219),
(442, 1669640124, 153, 19255532, '[4]', 1669640219),
(443, 1669640124, 154, 19255532, '[4]', 1669640219),
(444, 1669640124, 155, 19255532, '[4]', 1669640219),
(445, 1669640124, 156, 19255532, '[4]', 1669640219),
(446, 1669640124, 157, 19255532, '[4]', 1669640219),
(447, 1669640124, 158, 19255532, '[4]', 1669640219),
(448, 1669640124, 159, 19255532, '[4]', 1669640219),
(449, 1669640124, 160, 19255532, 'yess', 1669640219),
(450, 1669635232, 126, 21258199, '[4]', 1669640232),
(451, 1669635232, 127, 21258199, '[3]', 1669640232),
(452, 1669635232, 128, 21258199, '[2]', 1669640232),
(453, 1669635232, 129, 21258199, '[1]', 1669640232),
(454, 1669635232, 130, 21258199, '[0]', 1669640232),
(455, 1669635232, 131, 21258199, '[4]', 1669640232),
(456, 1669635232, 132, 21258199, '[3]', 1669640232),
(457, 1669635232, 133, 21258199, '[2]', 1669640232),
(458, 1669635232, 134, 21258199, '[1]', 1669640232),
(459, 1669635232, 135, 21258199, '[0]', 1669640232),
(460, 1669635232, 136, 21258199, 'Sample', 1669640232),
(461, 1669635232, 126, 19255322, '[4]', 1669640798),
(462, 1669635232, 127, 19255322, '[4]', 1669640798),
(463, 1669635232, 128, 19255322, '[4]', 1669640798),
(464, 1669635232, 129, 19255322, '[4]', 1669640798),
(465, 1669635232, 130, 19255322, '[4]', 1669640798),
(466, 1669635232, 131, 19255322, '[4]', 1669640798),
(467, 1669635232, 132, 19255322, '[4]', 1669640798),
(468, 1669635232, 133, 19255322, '[4]', 1669640798),
(469, 1669635232, 134, 19255322, '[4]', 1669640798),
(470, 1669635232, 135, 19255322, '[4]', 1669640798),
(471, 1669635232, 136, 19255322, 'dasdsa\'', 1669640798),
(472, 1669613562, 112, 17401211, 'Bien', 1669640799),
(473, 1669613562, 113, 17401211, '22', 1669640799),
(474, 1669613562, 114, 17401211, '[3]', 1669640799),
(475, 1669613562, 115, 17401211, '[4]', 1669640799),
(476, 1669613562, 116, 17401211, 'Testing \" and \'', 1669640799),
(477, 1669635232, 126, 17401211, '[4]', 1669640824),
(478, 1669635232, 127, 17401211, '[4]', 1669640824),
(479, 1669635232, 128, 17401211, '[4]', 1669640824),
(480, 1669635232, 129, 17401211, '[4]', 1669640824),
(481, 1669635232, 130, 17401211, '[4]', 1669640824),
(482, 1669635232, 131, 17401211, '[4]', 1669640824),
(483, 1669635232, 132, 17401211, '[4]', 1669640824),
(484, 1669635232, 133, 17401211, '[4]', 1669640824),
(485, 1669635232, 134, 17401211, '[4]', 1669640824),
(486, 1669635232, 135, 17401211, '[4]', 1669640824),
(487, 1669635232, 136, 17401211, 'Testing \" and \'', 1669640824),
(488, 1669635279, 137, 17401211, 'Bien', 1669640830),
(489, 1669635279, 138, 17401211, '[4]', 1669640830),
(490, 1669640085, 139, 17401211, '[4]', 1669640848),
(491, 1669640085, 140, 17401211, '[4]', 1669640848),
(492, 1669640085, 141, 17401211, '[4]', 1669640848),
(493, 1669640085, 142, 17401211, '[4]', 1669640848),
(494, 1669640085, 143, 17401211, '[4]', 1669640848),
(495, 1669640085, 144, 17401211, '[4]', 1669640848),
(496, 1669640085, 145, 17401211, '[4]', 1669640848),
(497, 1669640085, 146, 17401211, '[4]', 1669640848),
(498, 1669640085, 147, 17401211, '[4]', 1669640848),
(499, 1669640085, 148, 17401211, '[4]', 1669640848),
(500, 1669640085, 149, 17401211, 'Testing \' and \"', 1669640848),
(501, 1669635279, 137, 19255322, 'Troy', 1669642266),
(502, 1669635279, 138, 19255322, '[4]', 1669642266),
(503, 1669635232, 126, 14363087, '[4]', 1669788801),
(504, 1669635232, 127, 14363087, '[4]', 1669788801),
(505, 1669635232, 128, 14363087, '[4]', 1669788801),
(506, 1669635232, 129, 14363087, '[3]', 1669788801),
(507, 1669635232, 130, 14363087, '[4]', 1669788801),
(508, 1669635232, 131, 14363087, '[4]', 1669788801),
(509, 1669635232, 132, 14363087, '[3]', 1669788801),
(510, 1669635232, 133, 14363087, '[4]', 1669788801),
(511, 1669635232, 134, 14363087, '[3]', 1669788801),
(512, 1669635232, 135, 14363087, '[4]', 1669788801),
(513, 1669635232, 136, 14363087, 'None', 1669788801),
(514, 1669640085, 139, 19255322, '[4]', 1669814053),
(515, 1669640085, 140, 19255322, '[4]', 1669814053),
(516, 1669640085, 141, 19255322, '[4]', 1669814053),
(517, 1669640085, 142, 19255322, '[4]', 1669814053),
(518, 1669640085, 143, 19255322, '[4]', 1669814053),
(519, 1669640085, 144, 19255322, '[4]', 1669814053),
(520, 1669640085, 145, 19255322, '[4]', 1669814053),
(521, 1669640085, 146, 19255322, '[4]', 1669814053),
(522, 1669640085, 147, 19255322, '[4]', 1669814053),
(523, 1669640085, 148, 19255322, '[4]', 1669814053),
(524, 1669640085, 149, 19255322, 'wqwq', 1669814053),
(525, 1669814438, 161, 19255532, '[4]', 1669815014),
(526, 1669814438, 162, 19255532, '[4]', 1669815014),
(527, 1669814438, 163, 19255532, '[4]', 1669815014),
(528, 1669814438, 164, 19255532, '[4]', 1669815014),
(529, 1669814438, 165, 19255532, '[4]', 1669815014),
(530, 1669814438, 166, 19255532, '[4]', 1669815014),
(531, 1669814438, 167, 19255532, '[4]', 1669815014),
(532, 1669814438, 168, 19255532, '[4]', 1669815014),
(533, 1669814438, 169, 19255532, '[4]', 1669815014),
(534, 1669814438, 170, 19255532, '[4]', 1669815014),
(535, 1669814438, 171, 19255532, 'ee', 1669815014),
(536, 1669814979, 172, 19255532, '[4]', 1669815035),
(537, 1669814979, 173, 19255532, '[4]', 1669815035),
(538, 1669814979, 174, 19255532, '[3]', 1669815035),
(539, 1669814979, 175, 19255532, '[4]', 1669815035),
(540, 1669814979, 176, 19255532, '[3]', 1669815035),
(541, 1669814979, 177, 19255532, '[4]', 1669815035),
(542, 1669814979, 178, 19255532, '[3]', 1669815035),
(543, 1669814979, 179, 19255532, '[3]', 1669815035),
(544, 1669814979, 180, 19255532, '[3]', 1669815035),
(545, 1669814979, 181, 19255532, '[3]', 1669815035),
(546, 1669814979, 182, 19255532, 'ress', 1669815035),
(547, 1669861118, 183, 19255322, '[4]', 1669882042),
(548, 1669861118, 184, 19255322, '[3]', 1669882042),
(549, 1669861118, 185, 19255322, '[3]', 1669882042),
(550, 1669861118, 186, 19255322, '[2]', 1669882042),
(551, 1669861118, 187, 19255322, '[3]', 1669882042),
(552, 1669861118, 188, 19255322, '[3]', 1669882042),
(553, 1669861118, 189, 19255322, '[3]', 1669882042),
(554, 1669861118, 190, 19255322, '[3]', 1669882042),
(555, 1669861118, 191, 19255322, '[3]', 1669882042),
(556, 1669861118, 192, 19255322, '[3]', 1669882042),
(557, 1669861118, 193, 19255322, 'I like it', 1669882042),
(558, 1669875886, 194, 19255322, '', 1669882060),
(559, 1669875886, 195, 19255322, '[0],[1]', 1669882060),
(560, 1669875886, 196, 19255322, '[1]', 1669882060),
(561, 1670424692, 197, 19, '[4]', 1670424748),
(562, 1670424692, 198, 19, '[3]', 1670424748),
(563, 1670424692, 199, 19, '[3]', 1670424748),
(564, 1670424692, 200, 19, '[3]', 1670424748),
(565, 1670424692, 201, 19, '[4]', 1670424748),
(566, 1670424692, 202, 19, '[4]', 1670424748),
(567, 1670424692, 203, 19, '[3]', 1670424748),
(568, 1670424692, 204, 19, '[4]', 1670424748),
(569, 1670424692, 205, 19, '[3]', 1670424748),
(570, 1670424692, 206, 19, '[3]', 1670424748),
(571, 1670424692, 207, 19, 'VERY GOOD', 1670424748);

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
(59, 1667534650, 'State your name:', 1, '', 0),
(60, 1667534650, 'How old are you?', 3, '', 0),
(61, 1667534650, 'What year level are you?', 5, '1st Year;;2nd Year;;3rd Year;;4th Year', 0),
(62, 1667534650, 'How would you describe your experience with the election held?', 7, '', 0),
(63, 1667534650, 'Any feedback or suggestions?', 2, '', 0),
(64, 1667547268, 'Test question', 1, '', 0),
(65, 1667547268, 'Likert scale', 7, '', 0),
(66, 1667551012, 'Random checkboxes', 4, '1;;2;;3;;4', 0),
(67, 1667551012, 'radio choices', 5, '1;;2;;3;;4', 0),
(68, 1667551122, 'Text SO', 1, '', 0),
(69, 1667551122, 'Textbox SO', 2, '', 0),
(70, 1667551122, 'Check SO', 4, 'C1;;C2', 0),
(71, 1667551122, 'Radio SO', 5, 'R1;;R2', 0),
(72, 1667551122, 'Drop SO', 6, 'D1;;D2', 0),
(73, 1667551122, 'Rate SO', 7, '', 0),
(74, 1667551122, 'Numeric SO', 3, '', 0),
(75, 1667902953, 'Your Name:', 1, '', 0),
(76, 1667902953, 'How did you find out about the event?', 4, 'Referral;;JRU Website;;JRUSOP website;;Social Media;;Other', 0),
(77, 1667902953, 'How would you describe your experience to the event?', 7, '', 0),
(78, 1667902953, 'Is there any other feedback you would like to say?', 2, '', 0),
(79, 1668583755, 'Name', 1, '', 0),
(80, 1668583755, 'Age', 3, '', 0),
(81, 1668583755, 'How did you hear about the event?', 4, 'JRUSOP website;;JRU website;;Social Media', 0),
(82, 1668583755, 'How would you rate your experience with the event?', 7, '', 0),
(83, 1668583755, 'Please feel free to write your feedback/suggestion about the event', 2, '', 0),
(84, 1668591869, 'Name', 1, '', 0),
(85, 1668591869, 'Degree Program', 1, '', 0),
(86, 1668591869, '	Did you participate at the online event ESports?', 5, 'Yes;;No', 0),
(87, 1668591869, 'How did you hear about the event?', 5, 'JRUSOP website;;JRU website;;Social Media', 0),
(88, 1668591869, 'How would you rate your experience with the event?', 7, '', 0),
(89, 1668591869, 'Please feel free to write your feedback/suggestion about the event', 2, '', 0),
(90, 1668612420, 'Is our system running smoothly?', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(91, 1668612420, 'Does the interface look presentable?', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(92, 1668620966, 'SSAS', 2, '', 0),
(93, 1668676275, 'Name:', 1, '', 0),
(94, 1668676275, 'Age:', 3, '', 0),
(95, 1668676275, 'How did you hear about the website', 4, 'Referral;;Social Media;;Invitation', 0),
(96, 1668676275, 'How would you rate your experience with the website?', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(97, 1668681917, 'qqqqqqqqqqq', 7, 'Very Unsatisfied1;;Unsatisfied2;;Neutral3;;Satisfied4;;Very Satisfied5', 0),
(98, 1668681917, 'q2qweqwe sadsadsadsa', 7, 'Very Unsatisfied1;;Unsatisfied2;;Neutral3;;Satisfied4;;Very Satisfied5', 0),
(99, 1668681933, 'How satisfied are you with the website?', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(100, 1668683706, 'qqqqq1', 1, '', 0),
(101, 1668683706, 'qqqqqq2', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(102, 1668688602, 'Name:', 1, '', 0),
(103, 1668688602, 'How satisfied are you with the event that was held', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(104, 1668688602, 'Other feedback:', 2, '', 0),
(105, 1669088261, 'Participation in the Program/Subject', 4, ':Beneficiary/Program Participant;;Govt Official/Officer;;JRU Student;;JRU Faculty;;JRU Employee/Staff;;JRU Official/Officer;;JRU Alumni;;Member/Officer/Adviser of a JRU Organization;;Other', 0),
(106, 1669088261, 'Have you participated in the past in any JRU student organization activity?', 5, 'Yes;;No', 0),
(107, 1669088261, 'Rate the student project/activity that best describes the impact of the student activities had on you.', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(108, 1669088261, 'Comments/Suggestions:', 2, '', 0),
(109, 1669092458, 'Bakit?', 1, '', 0),
(110, 1669092458, 'pili ka lang number', 3, '', 0),
(111, 1669092458, 'rate mo pake mo?', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(112, 1669613562, '	State your name:', 1, '', 0),
(113, 1669613562, 'Age', 3, '', 0),
(114, 1669613562, 'What year level are you? ', 5, '1st Year;;2nd Year;;3rd Year;;4th Year', 0),
(115, 1669613562, 'How would you describe your experience with the ESports held?', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(116, 1669613562, 'Any feedback or suggestions?', 2, '', 0),
(117, 1669613851, 'Name', 1, '', 0),
(118, 1669613851, 'Participation in the Program/Subject', 4, 'Beneficiary/Program Participant;;Govt Official/Officer;;JRU Student;;JRU Faculty;;JRU Employee/Staff;;JRU Official/Officer;;JRU Alumni;;Member/Officer/Adviser of a JRU Organization;;Other', 0),
(119, 1669613851, 'Have you participated in the past in any JRU student organization activity?', 5, 'Yes;;No', 0),
(120, 1669613851, 'Rate the student project/activity that best describes the impact of the student activities had on you.', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(121, 1669613851, 'Comments/Suggestions:', 2, '', 0),
(122, 1669615192, 'Name', 1, '', 0),
(123, 1669615192, 'Participation in the Program/Subject', 4, 'Beneficiary/Program Participant;;Govt Official/Officer;;JRU Student;;JRU Faculty;;JRU Employee/Staff;;JRU Official/Officer;;JRU Alumni;;Member/Officer/Adviser of a JRU Organization;;Other', 0),
(124, 1669615192, 'Have you participated in the past in any JRU student organization activity?', 5, 'Yes;;No', 0),
(125, 1669615192, 'How was your experience using JRU Student Organization Portal?', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(126, 1669635232, 'Expand professional knowledge', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(127, 1669635232, 'Build networks/linkages in the profession', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(128, 1669635232, 'Opportunities to apply/enhance classroom learning', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(129, 1669635232, 'Communication skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(130, 1669635232, 'Human Relations skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(131, 1669635232, 'Organization skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(132, 1669635232, 'Problem-solving skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(133, 1669635232, 'Critical Thinking skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(134, 1669635232, 'Understanding values for professional advancement', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(135, 1669635232, 'Strengthening values for soceital/civic responsibility', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(136, 1669635232, 'Comments/Suggestions', 2, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(137, 1669635279, 'Name', 1, '', 1),
(138, 1669635279, 'How was this survey', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(139, 1669640085, 'Expand professional knowledge', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(140, 1669640085, 'Build networks/linkages in the profession', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(141, 1669640085, 'Opportunities to apply/enhance classroom learning', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(142, 1669640085, 'Communication skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(143, 1669640085, 'Human Relations skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(144, 1669640085, 'Organization skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(145, 1669640085, 'Problem-solving skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(146, 1669640085, 'Critical Thinking skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(147, 1669640085, 'Understanding values for professional advancement', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(148, 1669640085, 'Strengthening values for soceital/civic responsibility', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(149, 1669640085, 'Comments/Suggestions', 2, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(150, 1669640124, 'Expand professional knowledge', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(151, 1669640124, 'Build networks/linkages in the profession', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(152, 1669640124, 'Opportunities to apply/enhance classroom learning', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(153, 1669640124, 'Communication skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(154, 1669640124, 'Human Relations skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(155, 1669640124, 'Organization skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(156, 1669640124, 'Problem-solving skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(157, 1669640124, 'Critical Thinking skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(158, 1669640124, 'Understanding values for professional advancement', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(159, 1669640124, 'Strengthening values for soceital/civic responsibility', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(160, 1669640124, 'Comments/Suggestions', 2, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(161, 1669814438, 'Expand professional knowledge', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(162, 1669814438, 'Build networks/linkages in the profession', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(163, 1669814438, 'Opportunities to apply/enhance classroom learning', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(164, 1669814438, 'Communication skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(165, 1669814438, 'Human Relations skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(166, 1669814438, 'Organization skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(167, 1669814438, 'Problem-solving skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(168, 1669814438, 'Critical Thinking skills', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(169, 1669814438, 'Understanding values for professional advancement', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(170, 1669814438, 'Strengthening values for soceital/civic responsibility', 7, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(171, 1669814438, 'Comments/Suggestions', 2, 'None;;Minimal;;Moderate;;High;;Excellent', 0),
(172, 1669814979, 'Physical setting and arrangements', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(173, 1669814979, 'Adequate space and ventilation', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(174, 1669814979, 'Relevance of the topics discussed', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(175, 1669814979, 'Scope of the topics covered', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(176, 1669814979, 'Usefulness of activities', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(177, 1669814979, 'Effectiveness of the speaker', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(178, 1669814979, 'Mastery of the topic', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(179, 1669814979, 'Sound System', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(180, 1669814979, 'Use of computer and technology', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(181, 1669814979, 'Adequate seats', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(182, 1669814979, 'Remarks/Suggestions', 2, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(183, 1669861118, 'Physical setting and arrangements', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(184, 1669861118, 'Adequate space and ventilation', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(185, 1669861118, 'Relevance of the topics discussed', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(186, 1669861118, 'Scope of the topics covered', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(187, 1669861118, 'Usefulness of activities', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(188, 1669861118, 'Effectiveness of the speaker', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(189, 1669861118, 'Mastery of the topic', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(190, 1669861118, 'Sound System', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(191, 1669861118, 'Use of computer and technology', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(192, 1669861118, 'Adequate seats', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(193, 1669861118, 'Remarks/Suggestions', 2, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(194, 1669875886, 'Name', 1, '', 1),
(195, 1669875886, 'Question Checkmark', 4, 'Option 1;;Option 2', 0),
(196, 1669875886, 'Likert Scale', 7, 'Very Unsatisfied;;Unsatisfied;;Neutral;;Satisfied;;Very Satisfied', 0),
(197, 1670424692, 'Physical setting and arrangements', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(198, 1670424692, 'Adequate space and ventilation', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(199, 1670424692, 'Relevance of the topics discussed', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(200, 1670424692, 'Scope of the topics covered', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(201, 1670424692, 'Usefulness of activities', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(202, 1670424692, 'Effectiveness of the speaker', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(203, 1670424692, 'Mastery of the topic', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(204, 1670424692, 'Sound System', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(205, 1670424692, 'Use of computer and technology', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(206, 1670424692, 'Adequate seats', 7, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0),
(207, 1670424692, 'Remarks/Suggestions', 2, 'POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT', 0);

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
(21, 17401211, 17, 1, 35, '2022-11-04'),
(22, 17401211, 17, 2, 36, '2022-11-04'),
(23, 17401211, 17, 3, 37, '2022-11-04'),
(24, 17401211, 17, 4, 38, '2022-11-04'),
(25, 17401211, 17, 5, 39, '2022-11-04'),
(26, 20257791, 17, 1, 35, '2022-11-04'),
(27, 20257791, 17, 2, 36, '2022-11-04'),
(28, 20257791, 17, 3, 37, '2022-11-04'),
(29, 20257791, 17, 4, 38, '2022-11-04'),
(30, 20257791, 17, 5, 39, '2022-11-04'),
(31, 21258199, 17, 1, 35, '2022-11-04'),
(32, 21258199, 17, 2, 36, '2022-11-04'),
(33, 21258199, 17, 3, 37, '2022-11-04'),
(34, 21258199, 17, 4, -1, '2022-11-04'),
(35, 21258199, 17, 5, -1, '2022-11-04'),
(36, 20257214, 17, 1, -1, '2022-11-04'),
(37, 20257214, 17, 2, -1, '2022-11-04'),
(38, 20257214, 17, 3, -1, '2022-11-04'),
(39, 20257214, 17, 4, -1, '2022-11-04'),
(40, 20257214, 17, 5, -1, '2022-11-04'),
(41, 15300166, 17, 1, 35, '2022-11-04'),
(42, 15300166, 17, 2, 36, '2022-11-04'),
(43, 15300166, 17, 3, 37, '2022-11-04'),
(44, 15300166, 17, 4, 38, '2022-11-04'),
(45, 15300166, 17, 5, 39, '2022-11-04'),
(46, 19, 18, 1, 40, '2022-11-04'),
(47, 19, 18, 2, 41, '2022-11-04'),
(48, 19, 18, 3, 42, '2022-11-04'),
(49, 19, 18, 4, 43, '2022-11-04'),
(50, 19, 18, 5, -1, '2022-11-04'),
(51, 19255570, 19, 1, 49, '2022-11-16'),
(52, 19255570, 19, 2, 47, '2022-11-16'),
(53, 19255570, 19, 3, 48, '2022-11-16'),
(54, 19255570, 19, 4, 52, '2022-11-16'),
(55, 19255570, 19, 5, 53, '2022-11-16'),
(56, 19255570, 19, 8, 56, '2022-11-16'),
(57, 19255570, 19, 9, 50, '2022-11-16'),
(58, 19255570, 19, 10, 60, '2022-11-16'),
(59, 19255515, 19, 1, 49, '2022-11-16'),
(60, 19255515, 19, 2, 46, '2022-11-16'),
(61, 19255515, 19, 3, 48, '2022-11-16'),
(62, 19255515, 19, 4, 52, '2022-11-16'),
(63, 19255515, 19, 5, 53, '2022-11-16'),
(64, 19255515, 19, 8, 55, '2022-11-16'),
(65, 19255515, 19, 9, 57, '2022-11-16'),
(66, 19255515, 19, 10, 60, '2022-11-16'),
(67, 20259030, 19, 1, 49, '2022-11-16'),
(68, 20259030, 19, 2, 46, '2022-11-16'),
(69, 20259030, 19, 3, 48, '2022-11-16'),
(70, 20259030, 19, 4, 51, '2022-11-16'),
(71, 20259030, 19, 5, 54, '2022-11-16'),
(72, 20259030, 19, 8, 56, '2022-11-16'),
(73, 20259030, 19, 9, 58, '2022-11-16'),
(74, 20259030, 19, 10, 60, '2022-11-16'),
(75, 19255532, 19, 1, 45, '2022-11-16'),
(76, 19255532, 19, 2, 61, '2022-11-16'),
(77, 19255532, 19, 3, 48, '2022-11-16'),
(78, 19255532, 19, 4, 52, '2022-11-16'),
(79, 19255532, 19, 5, 53, '2022-11-16'),
(80, 19255532, 19, 8, 55, '2022-11-16'),
(81, 19255532, 19, 9, 50, '2022-11-16'),
(82, 19255532, 19, 10, 60, '2022-11-16'),
(83, 19255533, 19, 1, 49, '2022-11-16'),
(84, 19255533, 19, 2, 47, '2022-11-16'),
(85, 19255533, 19, 3, 48, '2022-11-16'),
(86, 19255533, 19, 4, 52, '2022-11-16'),
(87, 19255533, 19, 5, 53, '2022-11-16'),
(88, 19255533, 19, 8, 56, '2022-11-16'),
(89, 19255533, 19, 9, 58, '2022-11-16'),
(90, 19255533, 19, 10, 59, '2022-11-16'),
(91, 18255530, 19, 1, 49, '2022-11-16'),
(92, 18255530, 19, 2, 61, '2022-11-16'),
(93, 18255530, 19, 3, 48, '2022-11-16'),
(94, 18255530, 19, 4, 52, '2022-11-16'),
(95, 18255530, 19, 5, 53, '2022-11-16'),
(96, 18255530, 19, 8, 56, '2022-11-16'),
(97, 18255530, 19, 9, 58, '2022-11-16'),
(98, 18255530, 19, 10, 59, '2022-11-16'),
(99, 20255530, 19, 1, 49, '2022-11-16'),
(100, 20255530, 19, 2, 61, '2022-11-16'),
(101, 20255530, 19, 3, 48, '2022-11-16'),
(102, 20255530, 19, 4, 52, '2022-11-16'),
(103, 20255530, 19, 5, 54, '2022-11-16'),
(104, 20255530, 19, 8, 56, '2022-11-16'),
(105, 20255530, 19, 9, 57, '2022-11-16'),
(106, 20255530, 19, 10, 59, '2022-11-16'),
(107, 19255322, 19, 1, 49, '2022-11-16'),
(108, 19255322, 19, 2, 61, '2022-11-16'),
(109, 19255322, 19, 3, 48, '2022-11-16'),
(110, 19255322, 19, 4, 51, '2022-11-16'),
(111, 19255322, 19, 5, 54, '2022-11-16'),
(112, 19255322, 19, 8, 56, '2022-11-16'),
(113, 19255322, 19, 9, 58, '2022-11-16'),
(114, 19255322, 19, 10, 60, '2022-11-16'),
(115, 19255561, 19, 1, 49, '2022-11-16'),
(116, 19255561, 19, 2, 61, '2022-11-16'),
(117, 19255561, 19, 3, 48, '2022-11-16'),
(118, 19255561, 19, 4, 52, '2022-11-16'),
(119, 19255561, 19, 5, 54, '2022-11-16'),
(120, 19255561, 19, 8, 55, '2022-11-16'),
(121, 19255561, 19, 9, 50, '2022-11-16'),
(122, 19255561, 19, 10, 59, '2022-11-16'),
(123, 19255530, 19, 1, 49, '2022-11-16'),
(124, 19255530, 19, 2, 46, '2022-11-16'),
(125, 19255530, 19, 3, 48, '2022-11-16'),
(126, 19255530, 19, 4, 52, '2022-11-16'),
(127, 19255530, 19, 5, 53, '2022-11-16'),
(128, 19255530, 19, 8, 55, '2022-11-16'),
(129, 19255530, 19, 9, 57, '2022-11-16'),
(130, 19255530, 19, 10, 60, '2022-11-16'),
(131, 19255532, 21, 1, 91, '2022-11-16'),
(132, 19255532, 21, 2, 88, '2022-11-16'),
(133, 19255532, 21, 3, 89, '2022-11-16'),
(134, 19255532, 21, 4, 92, '2022-11-16'),
(135, 19255532, 21, 6, 94, '2022-11-16'),
(136, 19255532, 21, 7, 96, '2022-11-16'),
(137, 19255532, 21, 8, 100, '2022-11-16'),
(138, 19255515, 21, 1, 91, '2022-11-16'),
(139, 19255515, 21, 2, 88, '2022-11-16'),
(140, 19255515, 21, 3, 90, '2022-11-16'),
(141, 19255515, 21, 4, 92, '2022-11-16'),
(142, 19255515, 21, 6, 94, '2022-11-16'),
(143, 19255515, 21, 7, 98, '2022-11-16'),
(144, 19255515, 21, 8, 100, '2022-11-16'),
(145, 17401211, 21, 1, 91, '2022-11-16'),
(146, 17401211, 21, 2, 88, '2022-11-16'),
(147, 17401211, 21, 3, -1, '2022-11-16'),
(148, 17401211, 21, 4, 92, '2022-11-16'),
(149, 17401211, 21, 6, 94, '2022-11-16'),
(150, 17401211, 21, 7, 98, '2022-11-16'),
(151, 17401211, 21, 8, 100, '2022-11-16'),
(152, 19255322, 21, 1, 99, '2022-11-16'),
(153, 19255322, 21, 2, 97, '2022-11-16'),
(154, 19255322, 21, 3, 90, '2022-11-16'),
(155, 19255322, 21, 4, 93, '2022-11-16'),
(156, 19255322, 21, 6, 95, '2022-11-16'),
(157, 19255322, 21, 7, 98, '2022-11-16'),
(158, 19255322, 21, 8, -1, '2022-11-16'),
(159, 19255530, 21, 1, 104, '2022-11-16'),
(160, 19255530, 21, 2, 101, '2022-11-16'),
(161, 19255530, 21, 3, 103, '2022-11-16'),
(162, 19255530, 21, 4, 106, '2022-11-16'),
(163, 19255530, 21, 6, 107, '2022-11-16'),
(164, 19255530, 21, 7, 109, '2022-11-16'),
(165, 19255530, 21, 8, 113, '2022-11-16'),
(166, 35, 23, 1, 119, '2022-11-17'),
(167, 35, 23, 2, 123, '2022-11-17'),
(168, 35, 23, 3, 120, '2022-11-17'),
(169, 35, 23, 4, 117, '2022-11-17'),
(170, 35, 23, 6, 125, '2022-11-17'),
(171, 35, 23, 7, 126, '2022-11-17'),
(172, 35, 23, 8, 121, '2022-11-17'),
(173, 14, 23, 1, 119, '2022-11-17'),
(174, 14, 23, 2, 123, '2022-11-17'),
(175, 14, 23, 3, 120, '2022-11-17'),
(176, 14, 23, 4, 117, '2022-11-17'),
(177, 14, 23, 6, -1, '2022-11-17'),
(178, 14, 23, 7, 126, '2022-11-17'),
(179, 14, 23, 8, 121, '2022-11-17'),
(180, 31, 23, 1, 119, '2022-11-17'),
(181, 31, 23, 2, 118, '2022-11-17'),
(182, 31, 23, 3, 120, '2022-11-17'),
(183, 31, 23, 4, 117, '2022-11-17'),
(184, 31, 23, 6, 125, '2022-11-17'),
(185, 31, 23, 7, 126, '2022-11-17'),
(186, 31, 23, 8, 121, '2022-11-17'),
(187, 19255570, 24, 1, 131, '2022-11-17'),
(188, 19255570, 24, 2, 137, '2022-11-17'),
(189, 19255570, 24, 3, 133, '2022-11-17'),
(190, 19255570, 24, 4, 127, '2022-11-17'),
(191, 19255570, 24, 6, 140, '2022-11-17'),
(192, 19255570, 24, 7, 130, '2022-11-17'),
(193, 19255570, 24, 8, 128, '2022-11-17'),
(194, 20255530, 24, 1, 131, '2022-11-17'),
(195, 20255530, 24, 2, 136, '2022-11-17'),
(196, 20255530, 24, 3, 135, '2022-11-17'),
(197, 20255530, 24, 4, 127, '2022-11-17'),
(198, 20255530, 24, 6, 139, '2022-11-17'),
(199, 20255530, 24, 7, 132, '2022-11-17'),
(200, 20255530, 24, 8, 128, '2022-11-17'),
(201, 19255540, 24, 1, 131, '2022-11-17'),
(202, 19255540, 24, 2, 137, '2022-11-17'),
(203, 19255540, 24, 3, 133, '2022-11-17'),
(204, 19255540, 24, 4, 138, '2022-11-17'),
(205, 19255540, 24, 6, 140, '2022-11-17'),
(206, 19255540, 24, 7, 132, '2022-11-17'),
(207, 19255540, 24, 8, 128, '2022-11-17'),
(208, 36, 23, 1, 122, '2022-11-17'),
(209, 36, 23, 2, 118, '2022-11-17'),
(210, 36, 23, 3, 120, '2022-11-17'),
(211, 36, 23, 4, 117, '2022-11-17'),
(212, 36, 23, 6, 125, '2022-11-17'),
(213, 36, 23, 7, 126, '2022-11-17'),
(214, 36, 23, 8, 121, '2022-11-17'),
(215, 19255533, 24, 1, 131, '2022-11-17'),
(216, 19255533, 24, 2, 136, '2022-11-17'),
(217, 19255533, 24, 3, 135, '2022-11-17'),
(218, 19255533, 24, 4, 138, '2022-11-17'),
(219, 19255533, 24, 6, 140, '2022-11-17'),
(220, 19255533, 24, 7, 132, '2022-11-17'),
(221, 19255533, 24, 8, 129, '2022-11-17'),
(222, 19255532, 24, 1, 131, '2022-11-17'),
(223, 19255532, 24, 2, 136, '2022-11-17'),
(224, 19255532, 24, 3, 133, '2022-11-17'),
(225, 19255532, 24, 4, 127, '2022-11-17'),
(226, 19255532, 24, 6, 139, '2022-11-17'),
(227, 19255532, 24, 7, 130, '2022-11-17'),
(228, 19255532, 24, 8, 129, '2022-11-17'),
(229, 20259030, 24, 1, 131, '2022-11-17'),
(230, 20259030, 24, 2, 137, '2022-11-17'),
(231, 20259030, 24, 3, 133, '2022-11-17'),
(232, 20259030, 24, 4, 127, '2022-11-17'),
(233, 20259030, 24, 6, 140, '2022-11-17'),
(234, 20259030, 24, 7, 130, '2022-11-17'),
(235, 20259030, 24, 8, 129, '2022-11-17'),
(236, 19255515, 24, 1, 131, '2022-11-17'),
(237, 19255515, 24, 2, 137, '2022-11-17'),
(238, 19255515, 24, 3, 133, '2022-11-17'),
(239, 19255515, 24, 4, 138, '2022-11-17'),
(240, 19255515, 24, 6, 139, '2022-11-17'),
(241, 19255515, 24, 7, 130, '2022-11-17'),
(242, 19255515, 24, 8, 129, '2022-11-17'),
(243, 19255530, 24, 1, 131, '2022-11-17'),
(244, 19255530, 24, 2, 136, '2022-11-17'),
(245, 19255530, 24, 3, 133, '2022-11-17'),
(246, 19255530, 24, 4, 127, '2022-11-17'),
(247, 19255530, 24, 6, 139, '2022-11-17'),
(248, 19255530, 24, 7, 130, '2022-11-17'),
(249, 19255530, 24, 8, 128, '2022-11-17'),
(250, 19255561, 24, 1, 131, '2022-11-17'),
(251, 19255561, 24, 2, 136, '2022-11-17'),
(252, 19255561, 24, 3, 133, '2022-11-17'),
(253, 19255561, 24, 4, 127, '2022-11-17'),
(254, 19255561, 24, 6, 139, '2022-11-17'),
(255, 19255561, 24, 7, 130, '2022-11-17'),
(256, 19255561, 24, 8, 128, '2022-11-17'),
(257, 11, 23, 1, 119, '2022-11-17'),
(258, 11, 23, 2, 118, '2022-11-17'),
(259, 11, 23, 3, 120, '2022-11-17'),
(260, 11, 23, 4, 117, '2022-11-17'),
(261, 11, 23, 6, 125, '2022-11-17'),
(262, 11, 23, 7, 126, '2022-11-17'),
(263, 11, 23, 8, 121, '2022-11-17'),
(264, 38, 23, 1, 119, '2022-11-17'),
(265, 38, 23, 2, 118, '2022-11-17'),
(266, 38, 23, 3, 120, '2022-11-17'),
(267, 38, 23, 4, 117, '2022-11-17'),
(268, 38, 23, 6, 125, '2022-11-17'),
(269, 38, 23, 7, 126, '2022-11-17'),
(270, 38, 23, 8, 121, '2022-11-17'),
(271, 18255530, 24, 1, 131, '2022-11-17'),
(272, 18255530, 24, 2, 136, '2022-11-17'),
(273, 18255530, 24, 3, 133, '2022-11-17'),
(274, 18255530, 24, 4, 127, '2022-11-17'),
(275, 18255530, 24, 6, 139, '2022-11-17'),
(276, 18255530, 24, 7, 130, '2022-11-17'),
(277, 18255530, 24, 8, 128, '2022-11-17'),
(278, 19255322, 24, 1, 131, '2022-11-17'),
(279, 19255322, 24, 2, 136, '2022-11-17'),
(280, 19255322, 24, 3, 135, '2022-11-17'),
(281, 19255322, 24, 4, 138, '2022-11-17'),
(282, 19255322, 24, 6, 139, '2022-11-17'),
(283, 19255322, 24, 7, 132, '2022-11-17'),
(284, 19255322, 24, 8, 129, '2022-11-17'),
(285, 19255515, 25, 1, 154, '2022-11-22'),
(286, 19255515, 25, 2, 150, '2022-11-22'),
(287, 19255515, 25, 3, 147, '2022-11-22'),
(288, 19255515, 25, 4, 141, '2022-11-22'),
(289, 19255515, 25, 6, 149, '2022-11-22'),
(290, 19255515, 25, 7, 143, '2022-11-22'),
(291, 19255515, 25, 8, 144, '2022-11-22'),
(292, 19255530, 25, 1, 154, '2022-11-22'),
(293, 19255530, 25, 2, 152, '2022-11-22'),
(294, 19255530, 25, 3, 147, '2022-11-22'),
(295, 19255530, 25, 4, 141, '2022-11-22'),
(296, 19255530, 25, 6, 151, '2022-11-22'),
(297, 19255530, 25, 7, 142, '2022-11-22'),
(298, 19255530, 25, 8, 144, '2022-11-22'),
(299, 19255322, 25, 1, 154, '2022-11-22'),
(300, 19255322, 25, 2, 152, '2022-11-22'),
(301, 19255322, 25, 3, 146, '2022-11-22'),
(302, 19255322, 25, 4, 141, '2022-11-22'),
(303, 19255322, 25, 6, 151, '2022-11-22'),
(304, 19255322, 25, 7, 143, '2022-11-22'),
(305, 19255322, 25, 8, 144, '2022-11-22'),
(306, 17401211, 25, 1, 154, '2022-11-22'),
(307, 17401211, 25, 2, 152, '2022-11-22'),
(308, 17401211, 25, 3, 147, '2022-11-22'),
(309, 17401211, 25, 4, 141, '2022-11-22'),
(310, 17401211, 25, 6, 149, '2022-11-22'),
(311, 17401211, 25, 7, 142, '2022-11-22'),
(312, 17401211, 25, 8, 144, '2022-11-22'),
(313, 22260400, 25, 1, 154, '2022-11-22'),
(314, 22260400, 25, 2, 148, '2022-11-22'),
(315, 22260400, 25, 3, 147, '2022-11-22'),
(316, 22260400, 25, 4, 145, '2022-11-22'),
(317, 22260400, 25, 6, 151, '2022-11-22'),
(318, 22260400, 25, 7, 142, '2022-11-22'),
(319, 22260400, 25, 8, 144, '2022-11-22'),
(320, 20406388, 25, 1, 154, '2022-11-22'),
(321, 20406388, 25, 2, 152, '2022-11-22'),
(322, 20406388, 25, 3, 147, '2022-11-22'),
(323, 20406388, 25, 4, 141, '2022-11-22'),
(324, 20406388, 25, 6, 151, '2022-11-22'),
(325, 20406388, 25, 7, 142, '2022-11-22'),
(326, 20406388, 25, 8, 144, '2022-11-22'),
(327, 19254353, 25, 1, 154, '2022-11-22'),
(328, 19254353, 25, 2, 152, '2022-11-22'),
(329, 19254353, 25, 3, 146, '2022-11-22'),
(330, 19254353, 25, 4, 145, '2022-11-22'),
(331, 19254353, 25, 6, 149, '2022-11-22'),
(332, 19254353, 25, 7, 143, '2022-11-22'),
(333, 19254353, 25, 8, 144, '2022-11-22'),
(334, 19254559, 25, 1, 154, '2022-11-22'),
(335, 19254559, 25, 2, 152, '2022-11-22'),
(336, 19254559, 25, 3, 146, '2022-11-22'),
(337, 19254559, 25, 4, 145, '2022-11-22'),
(338, 19254559, 25, 6, 151, '2022-11-22'),
(339, 19254559, 25, 7, 142, '2022-11-22'),
(340, 19254559, 25, 8, 144, '2022-11-22'),
(341, 20256253, 25, 1, 153, '2022-11-22'),
(342, 20256253, 25, 2, 148, '2022-11-22'),
(343, 20256253, 25, 3, 146, '2022-11-22'),
(344, 20256253, 25, 4, 141, '2022-11-22'),
(345, 20256253, 25, 6, 151, '2022-11-22'),
(346, 20256253, 25, 7, 143, '2022-11-22'),
(347, 20256253, 25, 8, 144, '2022-11-22'),
(348, 18255530, 27, 1, 159, '2022-11-28'),
(349, 18255530, 27, 2, 164, '2022-11-28'),
(350, 18255530, 27, 3, 163, '2022-11-28'),
(351, 18255530, 27, 4, 156, '2022-11-28'),
(352, 18255530, 27, 6, 157, '2022-11-28'),
(353, 18255530, 27, 7, 165, '2022-11-28'),
(354, 18255530, 27, 8, 168, '2022-11-28'),
(355, 20259030, 27, 1, 172, '2022-11-28'),
(356, 20259030, 27, 2, 166, '2022-11-28'),
(357, 20259030, 27, 3, 170, '2022-11-28'),
(358, 20259030, 27, 4, 161, '2022-11-28'),
(359, 20259030, 27, 6, 171, '2022-11-28'),
(360, 20259030, 27, 7, 162, '2022-11-28'),
(361, 20259030, 27, 8, 168, '2022-11-28'),
(362, 19255561, 27, 1, 159, '2022-11-28'),
(363, 19255561, 27, 2, 166, '2022-11-28'),
(364, 19255561, 27, 3, 170, '2022-11-28'),
(365, 19255561, 27, 4, 169, '2022-11-28'),
(366, 19255561, 27, 6, 158, '2022-11-28'),
(367, 19255561, 27, 7, 162, '2022-11-28'),
(368, 19255561, 27, 8, 167, '2022-11-28'),
(369, 19255570, 27, 1, 159, '2022-11-28'),
(370, 19255570, 27, 2, 166, '2022-11-28'),
(371, 19255570, 27, 3, 163, '2022-11-28'),
(372, 19255570, 27, 4, 161, '2022-11-28'),
(373, 19255570, 27, 6, -1, '2022-11-28'),
(374, 19255570, 27, 7, 162, '2022-11-28'),
(375, 19255570, 27, 8, 167, '2022-11-28'),
(376, 19255532, 27, 1, 159, '2022-11-28'),
(377, 19255532, 27, 2, 166, '2022-11-28'),
(378, 19255532, 27, 3, 170, '2022-11-28'),
(379, 19255532, 27, 4, 161, '2022-11-28'),
(380, 19255532, 27, 6, 158, '2022-11-28'),
(381, 19255532, 27, 7, 162, '2022-11-28'),
(382, 19255532, 27, 8, 167, '2022-11-28'),
(383, 20255530, 27, 1, 159, '2022-11-28'),
(384, 20255530, 27, 2, 166, '2022-11-28'),
(385, 20255530, 27, 3, 163, '2022-11-28'),
(386, 20255530, 27, 4, 169, '2022-11-28'),
(387, 20255530, 27, 6, 158, '2022-11-28'),
(388, 20255530, 27, 7, 160, '2022-11-28'),
(389, 20255530, 27, 8, 168, '2022-11-28'),
(390, 35, 28, 1, 180, '2022-11-28'),
(391, 35, 28, 2, 174, '2022-11-28'),
(392, 35, 28, 3, 175, '2022-11-28'),
(393, 35, 28, 4, 176, '2022-11-28'),
(394, 35, 28, 6, 184, '2022-11-28'),
(395, 35, 28, 7, 185, '2022-11-28'),
(396, 35, 28, 8, 186, '2022-11-28'),
(397, 19255322, 27, 1, 172, '2022-11-28'),
(398, 19255322, 27, 2, 166, '2022-11-28'),
(399, 19255322, 27, 3, 170, '2022-11-28'),
(400, 19255322, 27, 4, 156, '2022-11-28'),
(401, 19255322, 27, 6, 158, '2022-11-28'),
(402, 19255322, 27, 7, 165, '2022-11-28'),
(403, 19255322, 27, 8, 168, '2022-11-28'),
(404, 31, 28, 1, 173, '2022-11-28'),
(405, 31, 28, 2, 174, '2022-11-28'),
(406, 31, 28, 3, 175, '2022-11-28'),
(407, 31, 28, 4, 176, '2022-11-28'),
(408, 31, 28, 6, 177, '2022-11-28'),
(409, 31, 28, 7, 178, '2022-11-28'),
(410, 31, 28, 8, 179, '2022-11-28'),
(411, 24, 28, 1, 173, '2022-11-28'),
(412, 24, 28, 2, 174, '2022-11-28'),
(413, 24, 28, 3, 175, '2022-11-28'),
(414, 24, 28, 4, 176, '2022-11-28'),
(415, 24, 28, 6, 184, '2022-11-28'),
(416, 24, 28, 7, 185, '2022-11-28'),
(417, 24, 28, 8, 179, '2022-11-28'),
(418, 28, 28, 1, 180, '2022-11-28'),
(419, 28, 28, 2, 181, '2022-11-28'),
(420, 28, 28, 3, 182, '2022-11-28'),
(421, 28, 28, 4, 183, '2022-11-28'),
(422, 28, 28, 6, 184, '2022-11-28'),
(423, 28, 28, 7, 178, '2022-11-28'),
(424, 28, 28, 8, 179, '2022-11-28'),
(425, 12, 28, 1, 173, '2022-11-28'),
(426, 12, 28, 2, 174, '2022-11-28'),
(427, 12, 28, 3, 175, '2022-11-28'),
(428, 12, 28, 4, 176, '2022-11-28'),
(429, 12, 28, 6, 177, '2022-11-28'),
(430, 12, 28, 7, 178, '2022-11-28'),
(431, 12, 28, 8, 186, '2022-11-28'),
(432, 17400377, 27, 1, 172, '2022-11-28'),
(433, 17400377, 27, 2, 166, '2022-11-28'),
(434, 17400377, 27, 3, 163, '2022-11-28'),
(435, 17400377, 27, 4, 169, '2022-11-28'),
(436, 17400377, 27, 6, 157, '2022-11-28'),
(437, 17400377, 27, 7, -1, '2022-11-28'),
(438, 17400377, 27, 8, 168, '2022-11-28'),
(439, 20257214, 27, 1, -1, '2022-11-28'),
(440, 20257214, 27, 2, -1, '2022-11-28'),
(441, 20257214, 27, 3, -1, '2022-11-28'),
(442, 20257214, 27, 4, -1, '2022-11-28'),
(443, 20257214, 27, 6, -1, '2022-11-28'),
(444, 20257214, 27, 7, -1, '2022-11-28'),
(445, 20257214, 27, 8, -1, '2022-11-28'),
(446, 19, 28, 1, 173, '2022-11-28'),
(447, 19, 28, 2, 181, '2022-11-28'),
(448, 19, 28, 3, 175, '2022-11-28'),
(449, 19, 28, 4, 176, '2022-11-28'),
(450, 19, 28, 6, 177, '2022-11-28'),
(451, 19, 28, 7, 178, '2022-11-28'),
(452, 19, 28, 8, 179, '2022-11-28'),
(453, 15300210, 27, 1, 172, '2022-11-28'),
(454, 15300210, 27, 2, 166, '2022-11-28'),
(455, 15300210, 27, 3, 170, '2022-11-28'),
(456, 15300210, 27, 4, 156, '2022-11-28'),
(457, 15300210, 27, 6, 157, '2022-11-28'),
(458, 15300210, 27, 7, 160, '2022-11-28'),
(459, 15300210, 27, 8, 168, '2022-11-28'),
(460, 14363087, 27, 1, 159, '2022-11-30'),
(461, 14363087, 27, 2, 164, '2022-11-30'),
(462, 14363087, 27, 3, 163, '2022-11-30'),
(463, 14363087, 27, 4, 156, '2022-11-30'),
(464, 14363087, 27, 6, 157, '2022-11-30'),
(465, 14363087, 27, 7, 160, '2022-11-30'),
(466, 14363087, 27, 8, 167, '2022-11-30'),
(467, 20256280, 27, 1, 172, '2022-11-30'),
(468, 20256280, 27, 2, 166, '2022-11-30'),
(469, 20256280, 27, 3, 163, '2022-11-30'),
(470, 20256280, 27, 4, 169, '2022-11-30'),
(471, 20256280, 27, 6, 157, '2022-11-30'),
(472, 20256280, 27, 7, 165, '2022-11-30'),
(473, 20256280, 27, 8, 168, '2022-11-30'),
(474, 19255322, 30, 1, 202, '2022-12-01'),
(475, 19255322, 30, 2, 204, '2022-12-01'),
(476, 19255322, 30, 3, 207, '2022-12-01'),
(477, 19255322, 30, 4, 209, '2022-12-01'),
(478, 19255322, 30, 6, 213, '2022-12-01'),
(479, 19255322, 30, 7, 211, '2022-12-01'),
(480, 19255322, 30, 8, 215, '2022-12-01'),
(481, 19255322, 30, 20, 217, '2022-12-01');

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
  ADD PRIMARY KEY (`req_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_budget_codes_archive`
--
ALTER TABLE `tb_budget_codes_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_candidate`
--
ALTER TABLE `tb_candidate`
  MODIFY `CANDIDATE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

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
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_elections`
--
ALTER TABLE `tb_elections`
  MODIFY `ELECTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_elections_archive`
--
ALTER TABLE `tb_elections_archive`
  MODIFY `ELECTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_notification`
--
ALTER TABLE `tb_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- AUTO_INCREMENT for table `tb_officers`
--
ALTER TABLE `tb_officers`
  MODIFY `officer_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_officers_archive`
--
ALTER TABLE `tb_officers_archive`
  MODIFY `officer_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_orgs`
--
ALTER TABLE `tb_orgs`
  MODIFY `ORG_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  MODIFY `POSITION_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_requests`
--
ALTER TABLE `tb_requests`
  MODIFY `req_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_signatories`
--
ALTER TABLE `tb_signatories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_students`
--
ALTER TABLE `tb_students`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `tb_surveys`
--
ALTER TABLE `tb_surveys`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1670424693;

--
-- AUTO_INCREMENT for table `tb_surveys_archive`
--
ALTER TABLE `tb_surveys_archive`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1669615193;

--
-- AUTO_INCREMENT for table `tb_survey_answers`
--
ALTER TABLE `tb_survey_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=572;

--
-- AUTO_INCREMENT for table `tb_survey_questions`
--
ALTER TABLE `tb_survey_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `tb_usertypes`
--
ALTER TABLE `tb_usertypes`
  MODIFY `usertype_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_votes`
--
ALTER TABLE `tb_votes`
  MODIFY `VOTE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=482;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
