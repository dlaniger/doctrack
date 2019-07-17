-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 17, 2019 at 03:36 AM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_staff_remarks`
--

DROP TABLE IF EXISTS `admin_staff_remarks`;
CREATE TABLE IF NOT EXISTS `admin_staff_remarks` (
  `remarks_id` int(11) NOT NULL AUTO_INCREMENT,
  `tracking_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `before_after` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`remarks_id`),
  KEY `tracking_id` (`tracking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_staff_remarks`
--

INSERT INTO `admin_staff_remarks` (`remarks_id`, `tracking_id`, `remarks`, `date_created`, `user_id`, `before_after`) VALUES
(1, 1, 'test remarks', '2018-08-24 16:41:43', 19, 0),
(2, 1, 'test remarks 2', '2018-08-24 16:43:37', 19, 0),
(3, 1, 'test remarks 3', '2018-08-24 16:44:28', 19, 0),
(4, 2, 'start', '2018-08-26 13:49:06', 19, 0),
(5, 1, 'after test remarks', '2018-08-26 14:12:15', 19, 1),
(6, 3, 'on accounting', '2018-08-26 14:24:21', 19, 0),
(7, 3, 'on billing', '2018-08-26 14:24:33', 19, 0),
(8, 2, 'asdadasd', '2018-11-08 15:34:48', 19, 1),
(9, 2, 'sadsadasdasd', '2018-11-08 15:34:54', 19, 1),
(10, 11, 'asdadas', '2018-11-09 13:50:15', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assoc_of`
--

DROP TABLE IF EXISTS `assoc_of`;
CREATE TABLE IF NOT EXISTS `assoc_of` (
  `assoc_of_id` int(11) NOT NULL AUTO_INCREMENT,
  `assoc_of_desc` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`assoc_of_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assoc_of`
--

INSERT INTO `assoc_of` (`assoc_of_id`, `assoc_of_desc`, `date_created`, `is_active`, `created_by`) VALUES
(1, 'Office of the College Secretary', '2018-08-24 13:34:26', 1, NULL),
(2, 'Associate Dean for Mentoring Academic Progress and Advancement (ADMAPA)', '2018-08-24 13:35:05', 1, NULL),
(3, 'Associate Dean for Student & Public Affairs (ADSAPA)', '2018-08-24 13:35:44', 1, NULL),
(4, 'Associate Dean for Facilities and Resource Management (ADFARM)', '2018-08-24 13:36:33', 1, NULL),
(5, 'Associate Dean for Research, Innovation, Development and Enterprise (ADRIDE)', '2018-08-24 13:37:49', 1, NULL),
(6, 'Material Science Engineering Program (MSEP)', '2018-08-24 13:39:43', 1, NULL),
(7, 'Science Society Program (SSP)', '2018-08-24 13:40:13', 1, NULL),
(8, 'Computational Science Research Center (CSRC)', '2018-08-24 13:40:24', 1, NULL),
(9, 'National Science Research Institute (NSRI)', '2018-08-24 13:40:35', 1, NULL),
(10, 'College of Science Library', '2018-08-24 13:40:54', 1, NULL),
(11, 'Supervising Admin, Officer', '2018-08-24 13:50:20', 1, NULL),
(12, 'Accountant', '2018-08-24 13:50:57', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

DROP TABLE IF EXISTS `document_type`;
CREATE TABLE IF NOT EXISTS `document_type` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_desc` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`doc_id`, `doc_desc`, `date_created`, `created_by`, `is_active`) VALUES
(5, 'Disbursement Voucher - Honorarium', '2018-08-24 13:52:52', NULL, 1),
(6, 'Disbursement Voucher - Payment', '2018-08-24 13:53:47', NULL, 1),
(7, 'Disbursement Voucher - Reimbursement', '2018-08-24 13:55:04', NULL, 1),
(8, 'Facilities Request', '2018-08-24 13:59:44', NULL, 1),
(9, 'Technical Assistance', '2018-08-24 14:00:32', NULL, 1),
(10, 'Research', '2018-08-24 14:00:58', NULL, 1),
(11, 'Research Load Credit', '2018-08-24 14:01:31', NULL, 1),
(12, 'testing1', '2018-12-13 09:02:36', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `doc_process`
--

DROP TABLE IF EXISTS `doc_process`;
CREATE TABLE IF NOT EXISTS `doc_process` (
  `doc_proc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) DEFAULT NULL,
  `process_flow` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`doc_proc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_process`
--

INSERT INTO `doc_process` (`doc_proc_id`, `doc_id`, `process_flow`, `date_created`, `created_by`, `is_active`) VALUES
(6, 5, '[\"12\",\"11\"]', '2018-08-24 13:52:52', NULL, 1),
(7, 6, '[\"12\",\"11\"]', '2018-08-24 13:53:47', NULL, 1),
(8, 7, '[\"12\",\"11\"]', '2018-08-24 13:55:04', NULL, 1),
(9, 8, '[\"4\",\"11\"]', '2018-08-24 13:59:44', NULL, 1),
(10, 9, '[\"4\",\"11\"]', '2018-08-24 14:00:32', NULL, 1),
(11, 10, '[\"5\",\"11\"]', '2018-08-24 14:00:58', NULL, 1),
(12, 11, '[\"5\",\"11\"]', '2018-08-24 14:01:31', NULL, 1),
(13, 12, '[\"1\",\"2\",\"4\",\"11\"]', '2018-12-13 09:02:36', NULL, 0),
(14, 12, '[\"1\",\"2\",\"4\",\"11\"]', '2018-12-13 09:12:38', NULL, 0),
(15, 12, '[\"2\",\"4\",\"11\"]', '2018-12-13 09:12:52', NULL, 0),
(16, 12, '[\"2\",\"4\",\"11\"]', '2018-12-13 09:17:23', NULL, 0),
(17, 12, '[\"2\",\"4\",\"11\"]', '2018-12-13 09:18:19', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

DROP TABLE IF EXISTS `institutes`;
CREATE TABLE IF NOT EXISTS `institutes` (
  `institute_id` int(100) NOT NULL AUTO_INCREMENT,
  `institute_name` varchar(255) NOT NULL,
  `institute_code` varchar(255) NOT NULL,
  `institute_flag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`institute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`institute_id`, `institute_name`, `institute_code`, `institute_flag`) VALUES
(1, 'Institute of Biology', 'IB', 1),
(2, 'Institute of Chemistry', 'IC', 1),
(3, 'Institute of Environmental Science and Meteorology', 'IESM', 1),
(4, 'Institute of Mathematics', 'IM', 1),
(5, 'Marine Science Institute', 'MSI', 1),
(6, 'National Institute of Geological Sciences ', 'NIGS', 1),
(7, 'National Institute of Molecular Biology and Biotechnology', 'NIMBB', 1),
(8, 'National Institute of Physics', 'NIP', 1),
(9, 'Material Science and Engineering Program', 'MSEP', 1),
(10, 'College of Science Library', 'CSLIB', 1),
(11, 'Test Institute', 'TI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
CREATE TABLE IF NOT EXISTS `series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastvalue` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `lastvalue`) VALUES
(1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

DROP TABLE IF EXISTS `tracking`;
CREATE TABLE IF NOT EXISTS `tracking` (
  `tracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `tracking_number` int(255) DEFAULT NULL,
  `tracking_barcode` varchar(255) DEFAULT NULL,
  `institute_id` int(10) DEFAULT NULL,
  `doc_type_id` int(10) DEFAULT NULL,
  `doc_proc_id` int(10) DEFAULT NULL,
  `doc_title` varchar(255) DEFAULT NULL,
  `doc_desc` text,
  `doc_keywords` text,
  `doc_remarks` text,
  `tracking_attachment` varchar(255) NOT NULL,
  `doc_current_status` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `finished_date` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`tracking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`tracking_id`, `tracking_number`, `tracking_barcode`, `institute_id`, `doc_type_id`, `doc_proc_id`, `doc_title`, `doc_desc`, `doc_keywords`, `doc_remarks`, `tracking_attachment`, `doc_current_status`, `date_created`, `finished_date`, `created_by`) VALUES
(1, NULL, '1108242018', 1, 5, NULL, 'my test', 'asd', NULL, 'asd', '1108242018.pdf', 'Closed', '2018-08-24 14:50:55', NULL, 19),
(2, NULL, '1208262018', 1, 8, NULL, 'other test', 'asdasd', NULL, 'sadsadasd', '1208262018.pdf', 'Closed', '2018-08-26 13:48:48', NULL, 19),
(3, NULL, '1308262018', 1, 7, NULL, 'test reimbursment', 'asdasdasda', NULL, 'sadasd', '1308262018.pdf', 'On-going', '2018-08-26 14:23:45', NULL, 19),
(9, NULL, '1911082018', 1, 6, NULL, 'asdas', 'asdasdas', NULL, 'asdasdasd', '1911082018.pdf', 'On-going', '2018-11-08 16:13:43', NULL, 19),
(10, NULL, '2011092018', 1, 5, NULL, 'asdasd', 'asdasd', NULL, 'asdasdasd', '2011092018.pdf', 'Cancelled', '2018-11-09 11:13:27', NULL, 19),
(11, NULL, '2111092018', 1, 8, NULL, 'asdasd', 'sadasd', NULL, 'asdasd', '2111092018.pdf', 'On-going', '2018-11-09 11:13:55', NULL, 19),
(12, NULL, '2212132018', 1, 5, NULL, 'Test Honorarium', 'test', NULL, 'test', '2212132018.pdf', 'On-going', '2018-12-13 14:08:47', NULL, 19),
(13, NULL, '2312132018', 1, 5, NULL, 'testnew', 'disbustment', NULL, 'test', '2312132018.pdf', 'Closed', '2018-12-13 15:26:05', '2019-01-25 15:53:31', 19),
(14, NULL, '2401142019', 1, 5, NULL, 'adsasd', 'sdasdas', NULL, 'asdasdasd', '2401142019.pdf', 'On-going', '2019-01-14 14:31:44', NULL, 19),
(15, NULL, '2501142019', 1, 5, NULL, 'asdasd', 'asdsad', NULL, 'asdasdasdasd', '2501142019.pdf', NULL, '2019-01-14 15:45:44', NULL, 19),
(16, NULL, '2601312019', 1, 5, NULL, 'ddsdsds', 'asdasd', NULL, 'sdadasd', '2601312019.pdf', NULL, '2019-01-31 10:08:00', NULL, 19),
(17, NULL, '2701312019', 1, 6, NULL, 'dsaaasasa', 'sadasda', 'dog cat', 'sadasdsad', '2701312019.pdf', NULL, '2019-01-31 10:11:22', NULL, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tracking_process`
--

DROP TABLE IF EXISTS `tracking_process`;
CREATE TABLE IF NOT EXISTS `tracking_process` (
  `track_proc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tracking_id` int(10) DEFAULT NULL,
  `process_step` int(10) DEFAULT NULL,
  `assoc_id` int(10) DEFAULT NULL,
  `recieve_datetime` datetime DEFAULT NULL,
  `release_datetime` datetime DEFAULT NULL,
  `remarks` text,
  `recieve_by` int(10) DEFAULT NULL,
  `release_by` int(10) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`track_proc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking_process`
--

INSERT INTO `tracking_process` (`track_proc_id`, `tracking_id`, `process_step`, `assoc_id`, `recieve_datetime`, `release_datetime`, `remarks`, `recieve_by`, `release_by`, `flag`) VALUES
(1, 1, 1, 12, '2018-08-24 18:25:12', '2018-08-24 18:49:56', 'accountant release', 20, 20, 0),
(2, 1, 2, 11, '2018-08-24 19:26:45', '2018-08-26 13:38:02', 'asdasasdasd', 21, 21, 0),
(3, 1, 3, NULL, '2018-08-24 19:31:59', '2018-08-26 13:38:46', 'dean release', 22, 22, 0),
(4, 2, 1, 4, '2018-11-05 16:49:04', '2018-11-08 15:25:27', 'released', 23, 23, 0),
(5, 2, 2, 11, '2018-11-08 15:33:23', '2018-11-08 15:33:32', 'release', 21, 21, 0),
(6, 2, 3, NULL, '2018-11-08 15:33:55', '2018-11-08 15:34:03', 'release', 22, 22, 0),
(7, 3, 1, 12, '2019-01-11 10:11:23', NULL, NULL, 20, NULL, 1),
(8, 3, 2, 11, NULL, NULL, NULL, NULL, NULL, 0),
(9, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(25, 9, 1, 12, NULL, NULL, NULL, NULL, NULL, 1),
(26, 9, 2, 11, NULL, NULL, NULL, NULL, NULL, 0),
(27, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(28, 10, 1, 12, NULL, NULL, NULL, NULL, NULL, 1),
(29, 10, 2, 11, NULL, NULL, NULL, NULL, NULL, 0),
(30, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(31, 11, 1, 4, '2018-11-09 11:29:26', '2018-11-09 13:22:17', NULL, 23, 23, 1),
(32, 11, 2, 11, '2018-11-09 13:25:41', '2018-11-09 13:26:17', NULL, 21, 21, 0),
(33, 11, 3, NULL, '2018-11-09 13:35:17', '2018-11-09 13:47:23', NULL, 22, 22, 0),
(34, 12, 1, 12, '2018-12-13 14:56:17', '2018-12-13 15:40:47', 'release', 20, 20, 0),
(35, 12, 2, 11, '2019-01-14 15:57:00', '2019-01-14 15:57:22', 'release', 21, 21, 0),
(36, 12, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(37, 13, 1, 12, '2018-12-13 15:39:15', '2018-12-13 15:43:03', NULL, 20, 20, 0),
(38, 13, 2, 11, '2018-12-13 15:47:25', '2018-12-13 15:48:28', 'recieved with smudges', 21, 21, 0),
(39, 13, 3, NULL, '2018-12-13 15:49:23', '2018-12-13 15:49:44', NULL, 22, 22, 0),
(40, 14, 1, 12, '2019-01-14 14:54:10', '2019-01-14 14:56:27', NULL, 20, 20, 0),
(41, 14, 2, 11, '2019-01-30 14:37:19', NULL, 'asda\nasdasdasdasd\n\nasdasd', 21, NULL, 1),
(42, 14, 3, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(43, 15, 1, 12, NULL, NULL, NULL, NULL, NULL, 0),
(44, 15, 2, 11, NULL, NULL, NULL, NULL, NULL, 0),
(45, 15, 3, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(46, 16, 1, 12, NULL, NULL, NULL, NULL, NULL, 0),
(47, 16, 2, 11, NULL, NULL, NULL, NULL, NULL, 0),
(48, 16, 3, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(49, 17, 1, 12, NULL, NULL, NULL, NULL, NULL, 0),
(50, 17, 2, 11, NULL, NULL, NULL, NULL, NULL, 0),
(51, 17, 3, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tracking_update_attachments`
--

DROP TABLE IF EXISTS `tracking_update_attachments`;
CREATE TABLE IF NOT EXISTS `tracking_update_attachments` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `tracking_id` int(11) NOT NULL,
  `attachment_name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`attachment_id`),
  KEY `tracking_id` (`tracking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking_update_attachments`
--

INSERT INTO `tracking_update_attachments` (`attachment_id`, `tracking_id`, `attachment_name`, `date_created`) VALUES
(1, 2, '1208262019.pdf', '2018-11-08 15:12:36'),
(2, 2, '1208262019.pdf', '2018-11-08 15:13:12'),
(3, 2, '1208262018-3.pdf', '2018-11-08 15:19:09'),
(4, 2, '1208262018-4.pdf', '2018-11-08 15:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$Det.EhjKUEx7N.8cZ0WeU.Arh9sosimhez6TjIXUxv/Fz6NU5KKQe', '0a5VMxGfEBhU0cnZjJbGf6e1Ou2XdeSbpbZKY1BEy1PgLqUufUXFdVk7qUHk', '2018-04-25 16:00:00', '2018-04-25 16:00:00'),
(18, 'super AO', 'sa0@sa0.com', '$2y$10$JRSEa2DeDf2wskwTn1AK7uw8BXLCAx4RLr8cDZPymMYQ9/7oCEThe', 'gekcrkAhYWjARAT1mfx7Zg5wa28nsZIOwelEikgLTy9m4367JTMxXWNuviZY', NULL, NULL),
(19, 'testbio', 'instituebio@instituebio', '$2y$10$P0UN5tUnPPcoPzIM29Ky3eJ.w9JqrH3uF32n4KyI3G9LlGoJTtOxG', 'N89HGJezW4f3RCrryjmtAWWuPT8Q7BBrxx40emB5sdF44FRl5rjo8tmLOFsG', NULL, NULL),
(20, 'accountant', 'accountant@accountant.com', '$2y$10$rLeuZNqyAVXznf3kj9Y96uf45sjcuIpZgwvWe5v/i1ZO1sSGnKfaC', 'jVFzORSZolutCNT7S09TxLfBuxAteqd4mn3Kh8ITXwjieKDWSiwGjFIYmw4G', NULL, NULL),
(21, 'supervising ao', 'superao@ssuperao.com', '$2y$10$6e1p4Y1CXfnyMQO7p3i.r.2VCp5QKc9EMVRYPgMxJKG/H3Z5B9xFy', '1OHZMqn4Vk7AuYNT8cT0iwutzG3yea4EVx92MSaqOk4bC3QBde2nyKcGoSsy', NULL, NULL),
(22, 'deans office', 'dean@dean.com', '$2y$10$mK87gfotZ69sLT7VDsWjt.z2srlDQOmMv465KXKIjh1R.en6iJEtW', '126Rao0DKvUvOqXxVy07OLaaqutB3dYHAy2SK0FRKSEMie46M5ayKy8YTwC9', NULL, NULL),
(23, 'adfarmuser', 'adfarm@adfarm.com', '$2y$10$1Sjh3bXsi.Ll9TzyAbjYV.U7xZT4npEW71DW2ydW93d8rZjGFPYdW', '8TlcoTssuxzWKs8nxSsBiUVTTNurgXD2zd5mCqCRWkMiQ8hfSi2nSvBJn7w7', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `userdetails_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `assoc_id` int(11) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userdetails_id`),
  KEY `user_id` (`user_id`),
  KEY `usertype_id` (`usertype_id`),
  KEY `institute_id` (`institute_id`),
  KEY `assoc_id` (`assoc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`userdetails_id`, `user_id`, `usertype_id`, `institute_id`, `assoc_id`, `datecreated`, `is_active`) VALUES
(1, 1, 1, NULL, NULL, '2018-07-10 15:35:12', 1),
(16, 18, 4, NULL, 8, '2018-07-25 10:32:40', 1),
(17, 19, 3, 1, NULL, '2018-08-24 14:45:24', 1),
(18, 20, 4, NULL, 12, '2018-08-24 14:53:50', 1),
(19, 21, 4, NULL, 11, '2018-08-24 18:51:26', 1),
(20, 22, 2, NULL, NULL, '2018-08-24 19:31:27', 1),
(21, 23, 4, NULL, 4, '2018-11-05 16:47:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `usertype_id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype_desc` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`usertype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`usertype_id`, `usertype_desc`, `date_created`, `is_active`, `created_by`) VALUES
(1, 'Superadmin User', '2018-05-10 13:45:44', 1, 1),
(2, ' EO User', '2018-05-10 13:45:44', 1, 1),
(3, 'Institute User', '2018-05-10 13:46:11', 1, 1),
(4, ' Associate Office User', '2018-05-10 13:46:11', 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
