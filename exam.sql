-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2024 at 10:24 AM
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
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_details`
--

CREATE TABLE `exam_details` (
  `ed_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `t_marks` int(11) NOT NULL,
  `no_of_s` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_details`
--

INSERT INTO `exam_details` (`ed_id`, `name`, `date`, `start_time`, `end_time`, `duration`, `t_marks`, `no_of_s`, `status`) VALUES
(1, 'Exam-1', '2024-03-03', '00:00:00', '13:00:00', '00:00:00', 90, 3, '0'),
(2, 'Examination-1', '2024-03-03', '14:00:00', '17:00:00', '00:00:00', 90, 3, '0'),
(3, 'Exam-1', '2024-03-03', '14:06:00', '16:06:00', '00:00:00', 90, 3, '0'),
(4, 'E-1', '2024-03-03', '15:24:00', '21:24:00', '00:00:00', 90, 3, '1'),
(14, 'Exam-1', '2024-03-13', '17:00:00', '21:00:00', '00:00:00', 100, NULL, '0'),
(17, 'a', '2024-03-12', '04:37:00', '06:37:00', '00:00:00', 100, NULL, '0'),
(18, 'Exam-2', '2024-03-05', '02:13:00', '03:14:00', '00:00:00', 50, NULL, '0'),
(19, 'Ethics', '2024-03-04', '10:00:00', '14:00:00', '00:00:00', 150, NULL, '0'),
(20, 'Maths', '2024-03-04', '09:00:00', '09:30:00', '00:00:00', 55, NULL, '0'),
(22, 'Social', '2024-03-07', '15:00:00', '17:00:00', '00:00:00', 80, NULL, '0'),
(24, 'EXAM', '2024-03-08', '17:23:00', '21:23:00', '00:00:00', 200, NULL, '0'),
(25, 'EXAM', '2024-03-08', '17:23:00', '21:23:00', '00:00:00', 200, NULL, '0'),
(26, 'Science Exam-1', '2024-03-07', '00:00:00', '15:00:00', '00:13:10', 50, NULL, '1'),
(27, 'Maths Exam-1', '2024-03-07', '00:00:00', '15:00:00', '03:00:00', 50, NULL, '1'),
(28, 'Social Exam-1', '2024-03-07', '12:43:00', '16:43:00', '00:00:00', 100, NULL, '1'),
(29, 'Exam-1', '2024-03-01', '10:48:00', '14:49:00', '00:00:00', 50, NULL, '1'),
(30, 'New', '2024-03-05', '16:57:00', '22:57:00', '00:00:00', 60, NULL, '1'),
(33, 'Trial', '2024-03-05', '19:57:00', '23:57:00', '03:59:00', 100, NULL, '1'),
(34, 'Trial-1', '2024-03-06', '00:00:00', '03:00:00', '03:00:00', 100, NULL, '1'),
(35, 'T', '2024-03-06', '00:06:00', '00:06:00', '01:00:00', 30, NULL, '1'),
(36, 'A', '2024-03-06', '00:10:00', '01:10:00', '01:00:00', 90, NULL, '1'),
(37, 'K', '2024-03-06', '02:19:00', '02:50:00', '00:30:00', 50, NULL, '1'),
(38, 'try', '2024-03-06', '02:37:00', '02:39:00', '00:02:00', 2, NULL, '1'),
(39, 'Vulcantechs', '2024-03-06', '12:38:00', '13:38:00', '01:00:00', 10, NULL, '1'),
(42, 'A', '2024-03-07', '11:48:00', '15:48:00', '03:00:00', 1, NULL, '1'),
(43, 'G', '2024-03-07', '12:15:00', '15:15:00', '03:00:00', 10, NULL, '1'),
(44, 'S', '2024-03-07', '12:17:00', '15:17:00', '03:00:00', 1, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `excel`
--

CREATE TABLE `excel` (
  `eeid` int(11) NOT NULL,
  `ename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `excel`
--

INSERT INTO `excel` (`eeid`, `ename`) VALUES
(1, 'A'),
(2, 'F'),
(3, 'B'),
(4, 'J'),
(1, 'A'),
(2, 'F'),
(3, 'B'),
(88888, 'jahdhkdjooeoe'),
(1, 'A'),
(2, 'F'),
(3, 'B'),
(88888, 'jahdhkdjooeoe'),
(1, 'A'),
(2, 'F'),
(3, 'B'),
(88888, 'jahdhkdjooeoe'),
(1, 'A'),
(2, 'F'),
(3, 'B'),
(88888, 'jahdhkdjooeoe'),
(1, 'A'),
(2, 'F'),
(3, 'B'),
(88888, 'jahdhkdjooeoe'),
(1, 'A'),
(2, 'F'),
(3, 'B'),
(88888, 'jahdhkdjooeoe'),
(1, 'A'),
(2, 'F'),
(3, 'B'),
(88888, 'jahdhkdjooeoe'),
(1, 'A'),
(2, 'F'),
(3, 'B'),
(88888, 'jahdhkdjooeoe'),
(1, 'A'),
(2, 'F'),
(3, 'B'),
(0, 'yy'),
(1, '44'),
(2, '44'),
(3, '44'),
(0, '44');

-- --------------------------------------------------------

--
-- Table structure for table `e_login`
--

CREATE TABLE `e_login` (
  `id` int(11) NOT NULL,
  `u_id` varchar(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` bigint(32) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_login`
--

INSERT INTO `e_login` (`id`, `u_id`, `pass`, `name`, `email`, `number`, `dob`, `gender`, `status`) VALUES
(1, 'AD123', 'pass123', 'Admin', 'admin@gmail.com', 1234567890, '1995-01-02', 'M', '1'),
(22, 'US01', 'pass1', 'Ravi Kumar', 'ravi.kumar@gmail.com', 1234567890, '2006-01-02', 'M', '1'),
(23, 'US02', 'pass2', 'Priya Sharma', 'priya.sharma@gmail.com', 2345678901, '2006-02-03', 'F', '1'),
(24, 'US03', 'pass3', 'Rahul Singh', 'rahul.singh@gmail.com', 3456789012, '2006-03-04', 'M', '1'),
(25, 'US04', 'pass4', 'Sneha Patel', 'sneha.patel@gmail.com', 4567890123, '2006-04-05', 'F', '1'),
(26, 'US05', 'pass5', 'Amit Tiwari', 'amit.tiwari@gmail.com', 5678901234, '2006-05-06', 'M', '1'),
(27, 'US06', 'pass6', 'Neha Gupta', 'neha.gupta@gmail.com', 6789012345, '2006-06-07', 'F', '1'),
(28, 'US07', 'pass7', 'Vishal Reddy', 'vishal.reddy@gmail.com', 7890123456, '2006-07-08', 'M', '1'),
(29, 'US08', 'pass8', 'Kiran Mishra', 'kiran.mishra@gmail.com', 8901234567, '2006-08-09', 'F', '1'),
(30, 'US09', 'pass9', 'Anjali Yadav', 'anjali.yadav@gmail.com', 9012345678, '2006-09-10', 'F', '1'),
(31, 'US10', 'pass10', 'Sunil Verma', 'sunil.verma@gmail.com', 1123456789, '2006-10-11', 'M', '1'),
(34, 'US11', 'pass098', 'Hello', 'hello@gmail.com', 987234567, '2024-02-02', 'M', '1'),
(35, 'US12', 'passs', 'hi', 'hi@gmail.com', 987623456, '2024-02-06', 'M', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ques`
--

CREATE TABLE `ques` (
  `q_id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `question` varchar(255) NOT NULL,
  `a` varchar(255) NOT NULL,
  `b` varchar(255) NOT NULL,
  `c` varchar(255) NOT NULL,
  `d` varchar(255) NOT NULL,
  `ans` varchar(255) NOT NULL,
  `u_ans` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ques`
--

INSERT INTO `ques` (`q_id`, `exam_id`, `question`, `a`, `b`, `c`, `d`, `ans`, `u_ans`, `status`) VALUES
(1, 27, '1+2', '1', '2', '3', '4', '3', NULL, '1'),
(2, 27, '2+3', '23', '5', '8', '10', '5', NULL, '1'),
(3, 27, '9+1', '10', '100', '91', '55', '10', NULL, '1'),
(4, 27, '0+0', '1000', '9', '4', '0', '0', NULL, '1'),
(5, 26, 'What is H?', 'Hydrogen', 'Hi', 'Hello', 'Hat', 'Hydrogen', 'B', '1'),
(6, 26, 'What is C?', 'Carbon', 'Cat', 'Car', 'Call', 'Carbon', 'A', '1'),
(7, 26, 'What is Li?', 'Lithium', 'List', 'Laugh', 'Learn', 'Lithium', 'A', '1'),
(9, 28, 'Capital of Telangana', 'Hyderabad', 'Delhi', 'Mumbai', 'Vizag', 'Hyderabad', NULL, '1'),
(10, 29, 'Hi', 'a', 'b', 'c', 'd', 'a', NULL, '1'),
(11, 30, 'Hi', 'h', 'e', 'l', 'o', 'h', NULL, '1'),
(12, 33, 'Hello', 'Hi', 'No', 'Bye', '...', 'Hi', NULL, '1'),
(13, 34, 'Hi', 'Hello', 'Bye', 'Nice', '...', 'Hello', NULL, '1'),
(14, 35, 'HI', '1', '2', '3', '4', '1', NULL, '1'),
(15, 36, 'a', '1', '2', '3', '4', '1', NULL, '1'),
(16, 37, 'Hello', 'World', 'Earth', 'You', 'Me', 'World', NULL, '1'),
(17, 37, 'h', 'H', 'A', 'T', 'G', 'H', NULL, '1'),
(18, 37, 'A', 'B', 'C', 'D', 'E', 'B', NULL, '1'),
(19, 37, 'E', 'F', 'G', 'H', 'I', 'F', NULL, '1'),
(20, 38, 'a', 'b', 'c', 'd', 'e', 'b', NULL, '1'),
(21, 38, 'e', 'f', 'g', 'h', 'i', 'f', NULL, '1'),
(22, 38, 'q', 'r', 's', 't', 'u', 'v', NULL, '1'),
(23, 39, 'A', 'B', 'C', 'D', 'E', 'B', NULL, '1'),
(24, 39, '1', '2', '3', '4', '5', '5', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `exam_id` int(11) NOT NULL,
  `u_ans` int(11) DEFAULT NULL,
  `ans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_details`
--
ALTER TABLE `exam_details`
  ADD PRIMARY KEY (`ed_id`);

--
-- Indexes for table `e_login`
--
ALTER TABLE `e_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ques`
--
ALTER TABLE `ques`
  ADD PRIMARY KEY (`q_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_details`
--
ALTER TABLE `exam_details`
  MODIFY `ed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `e_login`
--
ALTER TABLE `e_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ques`
--
ALTER TABLE `ques`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
