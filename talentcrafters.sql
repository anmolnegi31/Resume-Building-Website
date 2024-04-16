-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 06:28 PM
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
-- Database: `talentcrafters`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`message_id`, `user_id`, `username`, `email`, `message`, `created_at`) VALUES
(1, 1, 'Aayush Kukreja', 'aayushkukreja0104@gmail.com', 'Nice work guys', '2024-04-12 17:33:04'),
(2, 1, 'Aayush Kukreja', 'aayushkukreja0104@gmail.com', 'Ok Nice Chat bot', '2024-04-12 17:33:30'),
(6, 1, 'Aayush Kukreja', 'Modiji0104@gmail.com', 'hi\r\n', '2024-04-13 12:47:23'),
(7, 0, 'Karik', 'kartik@gmail.com', 'Nice guys\r\n', '2024-04-14 15:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'Aayush6377', 'aayushkukreja0104@gmail.com', '$2y$10$1tvaBVmOKkJbmd/msiGyHezHBKKXPnSpyVzzkY6MxCBYURraIEjKG');

-- --------------------------------------------------------

--
-- Table structure for table `user_resumes`
--

CREATE TABLE `user_resumes` (
  `resume_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `college_name` varchar(200) DEFAULT NULL,
  `college_location` varchar(200) DEFAULT NULL,
  `degree` varchar(100) DEFAULT NULL,
  `field_of_study` varchar(100) DEFAULT NULL,
  `graduation_year` varchar(20) DEFAULT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_city` varchar(50) NOT NULL,
  `Year_of_experience` int(11) NOT NULL,
  `Proficient_in` varchar(100) NOT NULL,
  `additional_details` text DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_resumes`
--

INSERT INTO `user_resumes` (`resume_id`, `user_id`, `first_name`, `last_name`, `city`, `country`, `pincode`, `phone`, `email`, `job_title`, `college_name`, `college_location`, `degree`, `field_of_study`, `graduation_year`, `company_name`, `company_city`, `Year_of_experience`, `Proficient_in`, `additional_details`, `photo`, `created_at`) VALUES
(2, 1, 'Aayush', 'Kukreja', 'Alwar', 'India', '301001', '6377266748', 'aayushkukreja0104@gmail.com', 'Web Developer', 'Manav Rachna International Institute of Research and Studies', 'Faridabad', 'BTech', 'Computer Science', '2025', 'Microsoft', 'Delhi', 2, 'HTML, CSS, Javascript', 'Certificate in python', 'uploads/2.jpg', '2024-04-16 10:29:44'),
(3, NULL, 'Isha', 'Negi', 'Haryana', 'India', '23', '9910740658', 'ishanegi811@gmail.com', 'dfg', 'Manav Rachna International Institute of Research and Studies', 'dfg', 'Graduation', 'fg', '2024', 'dfg', 'dfg', 0, 'fdg', 'dfg', 'uploads/3.jpg', '2024-04-16 14:03:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indexes for table `user_resumes`
--
ALTER TABLE `user_resumes`
  ADD PRIMARY KEY (`resume_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_resumes`
--
ALTER TABLE `user_resumes`
  MODIFY `resume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_resumes`
--
ALTER TABLE `user_resumes`
  ADD CONSTRAINT `user_resumes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
