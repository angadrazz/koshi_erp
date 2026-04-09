-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2026 at 11:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koshi_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `reg_id` varchar(50) NOT NULL,
  `certificate_no` varchar(100) NOT NULL,
  `issue_date` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'Generated',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `category` varchar(50) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `fees` int(11) DEFAULT 0,
  `eligibility` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `course_interest` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `franchise`
--

CREATE TABLE `franchise` (
  `id` int(11) NOT NULL,
  `franchise_id` varchar(50) NOT NULL,
  `institute_reg_id` varchar(100) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `space` varchar(100) DEFAULT NULL,
  `investment` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `commission_percent` int(11) DEFAULT 20,
  `certificate_no` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `franchise`
--

INSERT INTO `franchise` (`id`, `franchise_id`, `institute_reg_id`, `name`, `mobile`, `email`, `city`, `district`, `state`, `space`, `investment`, `message`, `password`, `status`, `commission_percent`, `certificate_no`, `created_at`, `pdf`) VALUES
(1, 'FRAN20263949', NULL, 'BELTRON Bihar State Wide Area Network 2.0', '9709461947', 'angad.bswan@gmail.com', 'Saharsa', 'saharsa', 'bihar', '500', '5000', 'i want to take franchise', '$2y$10$nNy0Y/dJPRSSnIFr95nCruknsSe417gPqYhBOdT7zkFM1iiHc5ZL.', 'Pending', 20, NULL, '2026-04-09 07:26:07', NULL),
(2, 'FRAN20269811', NULL, 'Raja Ram Paswan', '7631458214', 'rajakumarmish06@gmail.com', 'Saharsa', 'saharsa', 'BIHAR', '500', '5000', 'TAKE FRANCHISE', '$2y$10$f5oqRI85.W6WLMObe0sQn.7Lbrr611M28SFJHUJbzW5JK2jJ0Hm0q', 'Pending', 20, NULL, '2026-04-09 08:20:12', NULL),
(3, 'FRAN20265209', 'Koshi Group Of Education Saharsa', 'RITESH KUMAR', '9534538562', 'RITESH.KUMAR@GMAIL.COM', 'BACHHWARA ', 'BEGUSARAI', 'BIHAR', '200SQ', '50000', 'i want to take franchise ', '$2y$10$C741O2y.VrdxNRypdx7rSeQG5ZM3pfsuGp6sw6rHJ4.To79kOhTbu', 'Pending', 20, NULL, '2026-04-09 09:18:11', 'EWSCO_2026_204337.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `marksheets`
--

CREATE TABLE `marksheets` (
  `id` int(11) NOT NULL,
  `reg_id` varchar(50) NOT NULL,
  `subject1` varchar(200) NOT NULL,
  `marks1` int(11) NOT NULL,
  `subject2` varchar(200) NOT NULL,
  `marks2` int(11) NOT NULL,
  `subject3` varchar(200) NOT NULL,
  `marks3` int(11) NOT NULL,
  `subject4` varchar(200) NOT NULL,
  `marks4` int(11) NOT NULL,
  `subject5` varchar(200) NOT NULL,
  `marks5` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `obtained_marks` int(11) NOT NULL,
  `result_status` varchar(20) DEFAULT 'Pass',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `reg_id` varchar(50) NOT NULL,
  `franchise_id` varchar(50) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `father_name` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `university_code` varchar(50) DEFAULT NULL,
  `course_code` varchar(50) DEFAULT NULL,
  `admission_status` varchar(20) DEFAULT 'Pending',
  `payment_status` varchar(20) DEFAULT 'Pending',
  `course_status` varchar(20) DEFAULT 'Running',
  `fee_paid` int(11) DEFAULT 0,
  `receipt_no` varchar(100) DEFAULT NULL,
  `receipt_date` varchar(50) DEFAULT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `idcard_status` varchar(20) DEFAULT 'Pending',
  `certificate_no` varchar(100) DEFAULT NULL,
  `razorpay_payment_id` varchar(200) DEFAULT NULL,
  `razorpay_order_id` varchar(200) DEFAULT NULL,
  `razorpay_signature` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `reg_id`, `franchise_id`, `name`, `father_name`, `mobile`, `email`, `address`, `photo`, `university_code`, `course_code`, `admission_status`, `payment_status`, `course_status`, `fee_paid`, `receipt_no`, `receipt_date`, `student_id`, `idcard_status`, `certificate_no`, `razorpay_payment_id`, `razorpay_order_id`, `razorpay_signature`, `created_at`) VALUES
(1, 'KOSHI202611664', NULL, 'BELTRON Bihar State Wide Area Network 2.0', 'Visho Sah  ', '09006128862', 'angad.bswan@gmail.com', 'Begusarai bihar', '1775719467_image-removebg-preview.png', 'UNI20260001', 'ADCA', 'Pending', 'Pending', 'Running', 0, NULL, NULL, NULL, 'Pending', NULL, NULL, NULL, NULL, '2026-04-09 07:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` int(11) NOT NULL,
  `uni_code` varchar(50) NOT NULL,
  `university_name` varchar(200) NOT NULL,
  `address` text DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `uni_code`, `university_name`, `address`, `state`, `district`, `contact`, `email`, `status`, `created_at`) VALUES
(1, 'UNI20260001', 'Koshi University Partner', 'India', 'Bihar', 'Patna', '9999999999', 'info@koshiinstitute.org', 'Active', '2026-04-09 07:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT 'Active',
  `university_code` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`, `university_code`, `created_at`) VALUES
(1, 'superadmin', '$2y$10$e0NRmA9Z0dT6O3uH6a7GxeQm7l2U4D2n4yNf5cP2d0VhHh7Zg7k4W', 'superadmin', 'Active', NULL, '2026-04-09 07:23:17'),
(2, 'admin', '$2y$10$e0NRmA9Z0dT6O3uH6a7GxeQm7l2U4D2n4yNf5cP2d0VhHh7Zg7k4W', 'admin', 'Active', NULL, '2026-04-09 07:23:17'),
(3, 'coursemanager', '$2y$10$e0NRmA9Z0dT6O3uH6a7GxeQm7l2U4D2n4yNf5cP2d0VhHh7Zg7k4W', 'coursemanager', 'Active', NULL, '2026-04-09 07:23:17'),
(4, 'uniadmin', '$2y$10$e0NRmA9Z0dT6O3uH6a7GxeQm7l2U4D2n4yNf5cP2d0VhHh7Zg7k4W', 'university', 'Active', 'UNI20260001', '2026-04-09 07:23:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `franchise`
--
ALTER TABLE `franchise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `franchise_id` (`franchise_id`);

--
-- Indexes for table `marksheets`
--
ALTER TABLE `marksheets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_id` (`reg_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_id` (`reg_id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uni_code` (`uni_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `franchise`
--
ALTER TABLE `franchise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marksheets`
--
ALTER TABLE `marksheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
