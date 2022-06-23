-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 09:59 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

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
  `PASSWORD` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `ORG_ID` int(2) NOT NULL,
  `POSITION_ID` int(2) NOT NULL,
  `STUDENT_NO` int(9) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `MIDDLE_INITIAL` varchar(2) NOT NULL,
  `course` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_course`
--

CREATE TABLE `tb_course` (
  `course_id` int(2) NOT NULL,
  `course` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc`
--

CREATE TABLE `tb_disc` (
  `disc_id` int(11) NOT NULL,
  `disc_topic_id` int(11) NOT NULL,
  `ORG_ID` int(2) NOT NULL,
  `officer_id` int(2) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `no_of_replies` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL
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
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_disc_topic`
--

CREATE TABLE `tb_disc_topic` (
  `disc_topic_id` int(11) NOT NULL,
  `ORG_ID` int(2) NOT NULL,
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
  `MOTHER_ORGS` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `officer_id` int(2) NOT NULL,
  `position_id` int(2) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_initial` char(50) NOT NULL,
  `course` varchar(20) NOT NULL,
  `section` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_orgs`
--

CREATE TABLE `tb_orgs` (
  `ORG_ID` int(2) NOT NULL,
  `ORG` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pkanswerkey`
--

CREATE TABLE `tb_pkanswerkey` (
  `question_id` int(9) NOT NULL,
  `answer` varchar(8000) NOT NULL,
  `student_id` int(2) NOT NULL,
  `survey_id` int(2) NOT NULL
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
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `tb_students`
--

CREATE TABLE `tb_students` (
  `STUDENT_ID` int(9) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `MIDDLE_NAME` varchar(30) NOT NULL,
  `AGE` int(3) NOT NULL,
  `GENDER` varchar(7) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `COURSE` varchar(10) NOT NULL,
  `SECTION` varchar(10) DEFAULT NULL,
  `MORG_ID` int(2) DEFAULT NULL,
  `ORG_ID` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_survey`
--

CREATE TABLE `tb_survey` (
  `survey_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `question` varchar(8000) NOT NULL,
  `response` varchar(8000) NOT NULL
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
-- Table structure for table `tb_thread`
--

CREATE TABLE `tb_thread` (
  `thread_id` bigint(18) NOT NULL,
  `msg_id` bigint(18) NOT NULL,
  `reply_id` bigint(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`ADMIN_ID`);

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
  ADD KEY `candidate_position_id_fk` (`POSITION_ID`);

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
  ADD KEY `discReply_org_id_fk` (`org_id`);

--
-- Indexes for table `tb_disc_topic`
--
ALTER TABLE `tb_disc_topic`
  ADD PRIMARY KEY (`disc_topic_id`),
  ADD KEY `discTopic_org_id_fk` (`ORG_ID`);

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
  ADD PRIMARY KEY (`MORG_ID`);

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
  ADD KEY `officers_position_id_fk` (`position_id`);

--
-- Indexes for table `tb_orgs`
--
ALTER TABLE `tb_orgs`
  ADD PRIMARY KEY (`ORG_ID`);

--
-- Indexes for table `tb_pkanswerkey`
--
ALTER TABLE `tb_pkanswerkey`
  ADD KEY `pkAnswerKey_studentID_fk` (`student_id`),
  ADD KEY `pkAnswerKey_surveyID_fk` (`survey_id`);

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
-- Indexes for table `tb_results`
--
ALTER TABLE `tb_results`
  ADD PRIMARY KEY (`RESULTS_ID`),
  ADD KEY `result_org_id_fk` (`ORG_ID`),
  ADD KEY `result_candidate_id_fk` (`CANDIDATE_ID`);

--
-- Indexes for table `tb_students`
--
ALTER TABLE `tb_students`
  ADD PRIMARY KEY (`STUDENT_ID`),
  ADD KEY `student_morg_id_fk` (`MORG_ID`),
  ADD KEY `student_org_id_fk` (`ORG_ID`);

--
-- Indexes for table `tb_survey`
--
ALTER TABLE `tb_survey`
  ADD PRIMARY KEY (`survey_id`),
  ADD KEY `survey_event_id_fk` (`event_id`);

--
-- Indexes for table `tb_surveyresult`
--
ALTER TABLE `tb_surveyresult`
  ADD PRIMARY KEY (`RESULTS_ID`),
  ADD KEY `suveyResult_org_id_fk` (`ORG_ID`),
  ADD KEY `suveyResult_event_id_fk` (`event_id`);

--
-- Indexes for table `tb_thread`
--
ALTER TABLE `tb_thread`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `thread_msg_id_fk` (`msg_id`),
  ADD KEY `thread_reply_id_fk` (`reply_id`);

--
-- Indexes for table `tb_vote`
--
ALTER TABLE `tb_vote`
  ADD PRIMARY KEY (`VOTE_ID`),
  ADD KEY `vote_org_id_fk` (`ORG_ID`),
  ADD KEY `vote_position_id_fk` (`POSITION_ID`),
  ADD KEY `vote_candidate_id_fk` (`CANDIDATE_ID`);

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `candidate_position_id_fk` FOREIGN KEY (`POSITION_ID`) REFERENCES `tb_position` (`POSITION_ID`);

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
  ADD CONSTRAINT `discReply_org_id_fk` FOREIGN KEY (`org_id`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_disc_topic`
--
ALTER TABLE `tb_disc_topic`
  ADD CONSTRAINT `discTopic_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD CONSTRAINT `event_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_officers`
--
ALTER TABLE `tb_officers`
  ADD CONSTRAINT `officers_position_id_fk` FOREIGN KEY (`position_id`) REFERENCES `tb_position` (`POSITION_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pkanswerkey`
--
ALTER TABLE `tb_pkanswerkey`
  ADD CONSTRAINT `pkAnswerKey_studentID_fk` FOREIGN KEY (`student_id`) REFERENCES `tb_students` (`STUDENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pkAnswerKey_surveyID_fk` FOREIGN KEY (`survey_id`) REFERENCES `tb_survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tb_results`
--
ALTER TABLE `tb_results`
  ADD CONSTRAINT `result_candidate_id_fk` FOREIGN KEY (`CANDIDATE_ID`) REFERENCES `tb_candidate` (`CANDIDATE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_students`
--
ALTER TABLE `tb_students`
  ADD CONSTRAINT `student_morg_id_fk` FOREIGN KEY (`MORG_ID`) REFERENCES `tb_morg` (`MORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_org_id_fk` FOREIGN KEY (`ORG_ID`) REFERENCES `tb_orgs` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_survey`
--
ALTER TABLE `tb_survey`
  ADD CONSTRAINT `survey_event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `tb_event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
