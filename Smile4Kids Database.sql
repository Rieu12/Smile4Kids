-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2025 at 04:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smile4kids`
--
CREATE DATABASE IF NOT EXISTS `smile4kids` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `smile4kids`;

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `childID` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `level_of_learning` enum('Primary','High School','University') NOT NULL,
  `academic_progress` text DEFAULT NULL,
  `annual_fees` decimal(10,2) NOT NULL,
  `health_status` text DEFAULT NULL,
  `is_disabled` tinyint(1) DEFAULT 0,
  `hobbies` text DEFAULT NULL,
  `background` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `birthdate` date DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `is_funded` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`childID`, `fullName`, `level_of_learning`, `academic_progress`, `annual_fees`, `health_status`, `is_disabled`, `hobbies`, `background`, `created_at`, `birthdate`, `image_path`, `document_path`, `is_funded`) VALUES
(1, 'Kevin Hurst', 'Primary', 'Grade 1: B+, Grade 2: A-', 48118.00, 'Chest Problems', 0, 'Football, Dancing', 'Brought in by Childcare Services from Rongai Police Station.', '2025-06-11 02:29:08', '2016-02-08', NULL, NULL, 1),
(2, 'Shannon Smith', 'University', '1st Year', 28031.00, 'Healthy', 1, 'Drawing', 'Orphaned', '2025-06-11 02:29:08', '2015-12-24', NULL, NULL, 0),
(3, 'Ashley Garrett', 'Primary', 'Grade 1', 10039.00, 'Healthy', 1, 'Reading', 'Abandoned ', '2025-05-11 02:29:08', '2022-07-21', NULL, NULL, 0),
(4, 'Vanessa Patel', 'Primary', 'Grade 2', 64729.00, 'Healthy', 0, 'Playing Chess', 'Orphaned', '2025-06-11 02:29:08', '2017-03-15', NULL, NULL, 0),
(5, 'Peter Karis', 'University', '4th Year', 42696.00, 'Paralysed', 1, 'Drawing', 'Orphaned at Rongai Hospital', '2025-06-14 04:30:08', '2015-02-19', NULL, NULL, 0),
(6, 'Brent Jordan', 'High School', 'Grade 10', 25189.00, 'Healthy', 0, 'Basketball, Cooking', 'Orphaned', '2025-06-11 02:29:08', '2018-01-22', NULL, NULL, 0),
(7, 'Annette Pearson', 'High School', 'Grade 11', 21698.00, 'Healthy', 0, 'Baking', 'Orphaned', '2025-06-11 02:29:09', '2019-09-18', NULL, NULL, 0),
(8, 'Daniel Brown', 'High School', 'Grade 10', 21338.00, 'Healthy', 1, 'art, Watching movies', 'Brought in from the Police Station', '2025-06-11 02:29:09', '2019-10-25', NULL, NULL, 0),
(9, 'Amanda Miller', 'High School', 'Grade 9', 54565.00, 'Paralysed', 1, 'Reading', 'Orphaned', '2025-06-11 02:29:09', '2020-05-21', NULL, NULL, 1),
(10, 'Gregory Jones', 'Primary', 'Grade 4', 62823.00, 'Paralysed', 1, 'Drawing', 'Brought in from Rongai Hospital', '2025-06-11 02:29:09', '2021-04-28', NULL, NULL, 0),
(11, 'Mark Baker', 'University', '3rd Year', 23180.00, 'Healthy', 1, 'Watching Films', 'Orphaned', '2025-06-11 02:29:09', '2015-07-31', NULL, NULL, 0),
(12, 'Stephanie Gardner', 'Primary', 'Grade 5', 51178.00, 'Healthy', 0, 'styling', 'Abandoned', '2025-06-27 04:50:09', '2017-05-31', NULL, NULL, 0),
(13, 'Marc Moore', 'University', '2nd year', 55535.00, 'Healthy', 0, 'Running', 'Abandoned', '2025-06-17 06:29:09', '2021-09-30', NULL, NULL, 0),
(14, 'Thomas Bailey', 'University', '3rd year', 27601.00, 'Asthmatic', 0, 'Preaching', 'Orphaned', '2025-06-19 00:29:09', '2015-02-10', NULL, NULL, 0),
(15, 'Mrs. Linda Reed', 'Primary', 'Grade 1', 58336.00, 'Heathy', 0, 'Writing stories', 'Abandoned', '2025-06-18 08:29:09', '2020-09-01', NULL, NULL, 0),
(16, 'Michelle Evans', 'High School', 'Grade 9', 79567.00, 'Deaf', 1, '', 'Abandoned', '2025-06-18 05:00:09', '2015-09-06', NULL, NULL, 0),
(17, 'Jeremy Lewis', 'Primary', 'Grade 5', 71785.00, 'Blind', 1, '', 'Abandoned', '2025-06-18 04:02:15', '2016-11-10', NULL, NULL, 0),
(18, 'Samuel Jones', 'High School', 'Grade 10', 33217.00, 'Paralysed', 1, 'Watching films', 'Orphaned', '2025-06-17 04:02:09', '2017-10-27', NULL, NULL, 0),
(21, 'Purity Adosi', 'Primary', 'Grade 10', 40721.00, 'Healthy', 0, 'Cooking', 'Orphaned', '2025-07-27 11:57:31', '2017-07-03', '1753617451_GIRL.jpeg', '1753617451_receipt_641ae2b9-0064-4cba-b247-d34824f11f70.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contactmessages`
--

CREATE TABLE `contactmessages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactmessages`
--

INSERT INTO `contactmessages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Emily Smith', 'emily@gmail.com', 'Child', 'Requesting to visit the children', '2025-06-10 05:39:26'),
(2, 'Kyle Francis', 'hill@morgan-french.com', 'Visit', 'Requesting to visit the children', '2025-06-11 02:46:26'),
(3, 'John Cook', 'mcantu@hotmail.com', 'Visit', 'Requesting to visit the children', '2025-06-11 02:45:26'),
(4, 'Rebecca Pearson MD', 'waynelawrence@sawyer.com', 'Children', 'Requesting to visit the children', '2025-06-11 02:44:26'),
(5, 'Shelia Johnson', 'crystalmccall@francis.com', 'Share Address', 'Requesting to visit the children', '2025-06-11 02:39:26'),
(6, 'David Jenkins', 'gregorylynch@harvey-allen.org', 'Visiting', 'Requesting to visit the children', '2025-06-11 02:42:26'),
(7, 'Megan Moore', 'vanessa46@hotmail.com', 'Visiting', 'Requesting to visit the children', '2025-06-11 02:42:26'),
(8, 'Elizabeth Spence DDS', 'knightgina@hotmail.com', 'Visit', 'Requesting to visit the children', '2025-06-11 02:39:26'),
(9, 'Perry Saunders', 'bergerdebbie@kramer-johnson.com', 'Visiting Date', 'Requesting to visit the children', '2025-06-11 02:44:27'),
(10, 'Sherri Diaz', 'jonathansummers@yahoo.com', 'Visit', 'Requesting to visit the children', '2025-06-11 02:44:27'),
(11, 'Jennifer Singleton', 'gibbsalexander@hotmail.com', 'Address', 'Requesting to visit the children', '2025-06-11 02:45:27');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `childID` int(11) DEFAULT NULL,
  `transaction_code` varchar(100) NOT NULL,
  `payment_method` enum('bank','paybill','paypal') DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Payment_Amount` text DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `userID`, `childID`, `transaction_code`, `payment_method`, `verified`, `payment_date`, `Payment_Amount`, `verified_by`, `verified_at`) VALUES
(1, 7, 9, 'D5385B0E', 'paypal', 1, '2025-06-11 02:30:08', '21,698', NULL, NULL),
(2, 20, 6, 'C51155FF', 'paypal', 1, '2025-06-11 02:30:08', '25,189', NULL, NULL),
(3, 6, 15, '05000BC6', 'paybill', 1, '2025-06-11 02:30:08', NULL, NULL, NULL),
(4, 18, 8, '9360715F', 'paypal', 1, '2025-06-11 02:30:08', NULL, NULL, NULL),
(7, 19, 11, 'D5F25073', 'bank', 1, '2025-06-11 02:30:08', NULL, NULL, NULL),
(10, 19, 14, '45DF16B6', 'paypal', 1, '2025-06-11 02:30:08', NULL, NULL, NULL),
(12, 3, 2, 'CC530E36', 'bank', 1, '2025-06-11 02:30:08', '28,031', NULL, NULL),
(14, 13, 13, 'FB10987F', 'paypal', 1, '2025-06-11 02:30:08', NULL, NULL, NULL),
(16, 4, 18, 'A9BA5A27', 'paybill', 1, '2025-06-11 02:30:08', NULL, NULL, NULL),
(17, 4, 10, '6DB99102', 'paybill', 1, '2025-06-11 02:30:09', NULL, NULL, NULL),
(18, 15, 1, '2E85CB21', 'paypal', 1, '2025-06-11 02:30:09', NULL, NULL, NULL),
(20, 10, 17, '56666F9F', 'paypal', 1, '2025-06-11 02:30:09', NULL, NULL, NULL),
(24, 24, 17, 'S3JD4893FJD', 'paybill', 1, '2025-07-27 10:21:57', NULL, NULL, NULL),
(25, 1, 17, 'S3JD4893FJD', 'bank', 1, '2025-07-27 10:24:05', NULL, NULL, NULL),
(26, 1, 16, 'qewrt46', 'paypal', 1, '2025-07-27 10:43:44', NULL, NULL, NULL),
(27, 24, 1, 'qewrkjh', 'bank', 1, '2025-07-27 11:20:49', NULL, NULL, NULL),
(28, 24, 1, 'qwertyuas', 'bank', 1, '2025-07-27 11:43:08', NULL, 1, '2025-07-27 17:13:47'),
(29, 25, 21, 'wertyua2432', 'bank', 1, '2025-07-27 12:46:52', NULL, 1, '2025-07-27 18:22:16'),
(30, 24, 3, 'awsertyuhij', 'bank', 0, '2025-07-27 15:14:26', NULL, NULL, NULL),
(31, 24, 2, 'qawserdtyuhio', 'paybill', 0, '2025-07-27 15:30:41', NULL, NULL, NULL),
(32, 27, 9, 'wyrejhgexxs', 'paybill', 1, '2025-07-28 06:50:44', NULL, 1, '2025-07-28 12:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `scholarshipopportunities`
--

CREATE TABLE `scholarshipopportunities` (
  `opportunityID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `eligibility` text NOT NULL,
  `deadline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `link` varchar(255) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','reviewed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarshipopportunities`
--

INSERT INTO `scholarshipopportunities` (`opportunityID`, `userID`, `title`, `description`, `eligibility`, `deadline`, `created_at`, `link`, `document_path`, `status`) VALUES
(38, 24, '', '', '', '0000-00-00', '2025-06-26 06:53:53', 'https://propartner.veeam.com/login/', '', 'pending'),
(39, 24, '', '', '', '0000-00-00', '2025-06-26 06:53:57', 'https://propartner.veeam.com/login/', '', 'pending'),
(40, 24, '', '', '', '0000-00-00', '2025-06-26 06:55:28', 'https://propartner.veeam.com/login/', '', 'pending'),
(41, 24, '', '', '', '0000-00-00', '2025-06-26 07:01:14', '', '1750921274_Smile4Kids_Receipt (6).pdf', 'pending'),
(42, 24, '', '', '', '0000-00-00', '2025-07-26 11:07:04', 'https://propartner.veeam.com/login/', '', 'pending'),
(43, 24, '', '', '', '0000-00-00', '2025-07-26 12:12:01', 'https://propartner.veeam.com/login/', '', 'pending'),
(44, 1, '', '', '', '0000-00-00', '2025-07-27 10:46:34', 'https://www.usiu.ac.ke/', '', 'pending'),
(45, 1, '', '', '', '0000-00-00', '2025-07-27 10:46:55', '', '1753613215_receipt_641ae2b9-0064-4cba-b247-d34824f11f70.pdf', 'pending'),
(46, 25, '', '', '', '0000-00-00', '2025-07-27 12:47:37', '', '1753620457_KTDA SEPARATORS[1].pdf', 'pending'),
(47, 27, '', '', '', '0000-00-00', '2025-07-28 06:53:07', 'https://www.usiu.ac.ke/', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `systemactivitylog`
--

CREATE TABLE `systemactivitylog` (
  `activityID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `systemactivitylog`
--

INSERT INTO `systemactivitylog` (`activityID`, `userID`, `action`, `timestamp`) VALUES
(1, 19, 'Southern suddenly window.', '2025-06-11 02:40:31'),
(2, 18, 'Party poor ago upon stop.', '2025-06-11 02:40:31'),
(3, 8, 'Ahead event several.', '2025-06-11 02:40:31'),
(4, 19, 'Go consider century price.', '2025-06-11 02:40:31'),
(5, 8, 'Center plan.', '2025-06-11 02:40:31'),
(6, 1, 'Begin most.', '2025-06-11 02:40:31'),
(7, 3, 'Information game have return.', '2025-06-11 02:40:31'),
(8, 2, 'Other third choose senior anyone.', '2025-06-11 02:40:31'),
(9, 8, 'Evening product.', '2025-06-11 02:40:31'),
(10, 3, 'Parent increase democratic mention.', '2025-06-11 02:40:32'),
(11, 2, 'Involve exist question main.', '2025-06-11 02:40:32'),
(12, 11, 'Animal house out.', '2025-06-11 02:40:32'),
(13, 3, 'Daughter war.', '2025-06-11 02:40:32'),
(14, 17, 'Share face build.', '2025-06-11 02:40:32'),
(15, 8, 'Section compare herself region.', '2025-06-11 02:40:32'),
(16, 9, 'Next property government however.', '2025-06-11 02:40:32'),
(17, 16, 'Job least.', '2025-06-11 02:40:32'),
(18, 7, 'Television office.', '2025-06-11 02:40:32'),
(19, 18, 'Identify policy face if whom.', '2025-06-11 02:40:32'),
(20, 5, 'Soon peace story.', '2025-06-11 02:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `role` enum('admin','donor') DEFAULT 'donor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fullName`, `email`, `passwordHash`, `role`, `created_at`) VALUES
(1, 'System Administrator', 'admin@smile4kids.org', '$2y$10$C290leyYUhI5gXLucKW2LeTxOkMai5MRJLnrAs4bE1nuzy3TFltH2', 'admin', '2025-06-11 00:47:04'),
(2, 'Fiona Rieu', 'rieufiona999@gmail.com', '$2y$10$LmPNYDZJA97qIbu1OQJA/eMUkd1ifh9OXFgyGYK6PQFW6EnDJc9ge', 'donor', '2025-06-11 01:09:35'),
(3, 'Allison Hill', 'user1@example.com', 'a400ff95eb15ea17c6e435e3a98f419c4fb96ee5e3fef5b4dc1d74f63d5948a2', '', '2025-06-11 02:27:37'),
(4, 'Megan Mcclain', 'user2@example.com', 'eff3cfda4c3ba15ea3e712126f43fe74f72330166e4d48e6a32e8f5523f8e016', 'admin', '2025-06-11 02:27:37'),
(5, 'Allen Robinson', 'user3@example.com', '358418a37e6ea7e726d8ae8655e1f81632bc9ffb2d756dae3eb22f51015c468b', 'admin', '2025-06-11 02:27:37'),
(6, 'Cristian Santos', 'user4@example.com', 'aa91bb1289552259250e1b2a3cc07a788779cc744490e7f50a6cba9cd8eb48b4', '', '2025-06-11 02:27:37'),
(7, 'Kevin Pacheco', 'user5@example.com', 'ad61d31be328fa6109ee9725067e200b126bcd098849e5e6fe4974322d410d99', 'donor', '2025-06-11 02:27:37'),
(8, 'Melissa Peterson', 'user6@example.com', 'b0fd4d943af457dd9981f7ae660bb6e8baf440d26b991cbc782e3928a7989467', 'admin', '2025-06-11 02:27:37'),
(9, 'Gabrielle Davis', 'user7@example.com', 'd246541e19cfec795a65143f6ab5a47d2b84e253b6be8df430a5a36f6859117d', 'admin', '2025-06-11 02:27:37'),
(10, 'Lindsey Roman', 'user8@example.com', '82f6a5dbff87da01f016e11ce370ae7eea2e1d53820cafa5b6ddd511cbdece9a', 'admin', '2025-06-11 02:27:37'),
(11, 'Valerie Gray', 'user9@example.com', 'aa5be5b724ef2c343d844d62bb4cb40617435537f196156ed200023ca8e4a24f', '', '2025-06-11 02:27:37'),
(12, 'Lisa Hensley', 'user10@example.com', '37d350f248e849518a2ac3f4e6ec3b4e37bd34edcaeabafbc668d1ce69fe78f2', 'admin', '2025-06-11 02:27:37'),
(13, 'Amber Perez', 'user11@example.com', 'c0838ccb7e3ba73d6cf2c6c992844b8df60275f9195273a3fb842025b333410d', '', '2025-06-11 02:27:37'),
(14, 'David Garcia', 'user12@example.com', 'f8dbd825b20141fd5d57991cd13592144920555487a56b3354ee2452bd77e4ea', '', '2025-06-11 02:27:37'),
(15, 'Holly Wood', 'user13@example.com', 'd9b9056f60a1aa6915854e7b5659b7ac09bcc3c307d7a466d08f7d05f977878f', '', '2025-06-11 02:27:37'),
(16, 'Timothy Wong', 'user14@example.com', 'b201c758275197b161a3b4978084d0e27dd7c475b3726471795913385783c88c', 'admin', '2025-06-11 02:27:37'),
(17, 'Nicholas Martin', 'user15@example.com', '4cbc791290affec0a98c477172f35395c5af7640abdffc8a0d8cd9627810b73d', '', '2025-06-11 02:27:37'),
(18, 'Margaret Hawkins DDS', 'user16@example.com', '9abb08b2f45a28dfa45524bc45d5ec303da9d6326e62a50677e55e715175e6dc', 'donor', '2025-06-11 02:27:37'),
(19, 'Crystal Johnson', 'user17@example.com', '2f6814daa41611d1e6c2fa789093b35b24440b208474c8b53780216cc5388d4f', 'admin', '2025-06-11 02:27:37'),
(20, 'Daniel Hahn', 'user18@example.com', '9837aca8b60ae094041068ce73e89bade5e3763eef992e6fa0db9c899246600f', 'admin', '2025-06-11 02:27:37'),
(21, 'Matthew Foster', 'user19@example.com', 'b0fdfa6891eca1120068d99253a98ecc6c6cf24bb0db4ced2617253b64d80d85', 'admin', '2025-06-11 02:27:38'),
(22, 'Derek Wright', 'user20@example.com', 'bca9384056691b07f0febad0e38f40ff1d24b5ccf0d2d19afc7e8a1823329ecc', 'admin', '2025-06-11 02:27:38'),
(23, 'Welson Tito', 'welson@gmail.com', '$2y$10$D1SHPUVUHumWBQMoEHX3luwGHV004rxuyyIHK8biJ0fJUSqS9V.oS', 'donor', '2025-06-17 22:12:40'),
(24, 'Willam Mirugi', 'william@gmail.com', '$2y$10$JzS3wXfxmtOrxqZh/lochu4o9V9jjKIf/qh7Vd3JQ8KA3nZ44c6yi', 'donor', '2025-06-18 05:34:51'),
(25, 'Samson Liam', 'samson@gmail.com', '$2y$10$IeZVXwUMd.Q1EbjVLh.szO7Nmflwc8igiaiP7./amzt6E5A0EBeFe', 'donor', '2025-07-27 12:45:56'),
(26, 'Kun JJ', 'kun@gmail.com', '$2y$10$bkXjAxlrxyGG4dIDac1Cp.8eE.B7SeiI5o4RnLCa8GybYE2WYTxJG', 'donor', '2025-07-28 05:37:54'),
(27, 'Moses Kim', 'moses@gmail.com', '$2y$10$uvObFBdbS8iaBJb1CL86W.LzGlWBRkoDNmiJZL6L.uoko9rPoYfSq', 'donor', '2025-07-28 06:49:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`childID`);

--
-- Indexes for table `contactmessages`
--
ALTER TABLE `contactmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `fk_payments_children` (`childID`),
  ADD KEY `fk_payments_users` (`userID`);

--
-- Indexes for table `scholarshipopportunities`
--
ALTER TABLE `scholarshipopportunities`
  ADD PRIMARY KEY (`opportunityID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `systemactivitylog`
--
ALTER TABLE `systemactivitylog`
  ADD PRIMARY KEY (`activityID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `childID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contactmessages`
--
ALTER TABLE `contactmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `scholarshipopportunities`
--
ALTER TABLE `scholarshipopportunities`
  MODIFY `opportunityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `systemactivitylog`
--
ALTER TABLE `systemactivitylog`
  MODIFY `activityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_children` FOREIGN KEY (`childID`) REFERENCES `children` (`childID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_payments_users` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`childID`) REFERENCES `children` (`childID`);

--
-- Constraints for table `scholarshipopportunities`
--
ALTER TABLE `scholarshipopportunities`
  ADD CONSTRAINT `scholarshipopportunities_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `systemactivitylog`
--
ALTER TABLE `systemactivitylog`
  ADD CONSTRAINT `systemactivitylog_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
