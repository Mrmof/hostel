-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 07:02 AM
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
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocation`
--

CREATE TABLE `allocation` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `matNo` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `hostel` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allocation`
--

INSERT INTO `allocation` (`id`, `fullname`, `matNo`, `department`, `level`, `room`, `hostel`, `user_id`) VALUES
(8, 'Student', 'ecu/2024/csit/202', 'Computer Science', '100', 'Room 300', 'Ambassador', 2),
(9, 'Rukky James', 'ecu/2024/200/2929', 'Computer Science', '100', 'room 2', 'Sharon', 3);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `matNo` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `schoolfees` varchar(255) NOT NULL,
  `hostelfees` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `allocation` varchar(255) NOT NULL,
  `createdAt` date NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `fullname`, `matNo`, `department`, `level`, `schoolfees`, `hostelfees`, `status`, `allocation`, `createdAt`, `user_id`) VALUES
(3, 'Student', 'ecu/2024/csit/202', 'Computer Science', '100', 'Studentschoolfeeselctric.jpeg', 'Studenthostelfeesbitumen.jpeg', 'approved', 'true', '2024-06-27', 2),
(4, 'Student', 'ecu/2024/csit/202', 'Computer Science', '100', 'Studentschoolfeeselctric.jpeg', 'Studenthostelfeesbitumen.jpeg', 'approved', '', '2024-06-27', 2),
(5, 'Rukky James', 'ecu/2024/200/2929', 'Computer Science', '100', 'Rukky JamesschoolfeesAkpevwe Mike2 (1).pdf', 'Rukky JameshostelfeesOnline_Performance_Tracking.pdf', 'approved', 'true', '2024-07-01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `complians`
--

CREATE TABLE `complians` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `roomNo` varchar(255) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `status` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complians`
--

INSERT INTO `complians` (`id`, `fullname`, `roomNo`, `message`, `status`, `action`) VALUES
(1, 'John Mike', 'room 303', 'The room net is very bad', 'pending', 'resolved'),
(2, 'Rukky James', 'room 100', 'Electric shock in socket', 'pending', 'resolved');

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `genderset` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`id`, `name`, `genderset`) VALUES
(3, 'Ambassador', 'male'),
(4, 'Noble', 'female'),
(5, 'Boss', 'male'),
(6, 'Sharon', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `hostelspace`
--

CREATE TABLE `hostelspace` (
  `id` int(255) NOT NULL,
  `roomNo` varchar(255) NOT NULL,
  `hostelName` varchar(255) NOT NULL,
  `hostelId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostelspace`
--

INSERT INTO `hostelspace` (`id`, `roomNo`, `hostelName`, `hostelId`) VALUES
(3, 'R00m 202', 'Ambassador', 3),
(4, 'Room 300', 'Ambassador', 3),
(6, 'N101', 'Noble', 4),
(7, 'N102', 'Noble', 4),
(8, 'room 1', 'Sharon', 6),
(9, 'room 2', 'Sharon', 6),
(10, 'room 66', 'Ambassador', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `matNo` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `matNo`, `gender`, `password`, `cpassword`, `status`) VALUES
(1, 'admin', 'admin@ecu.com', '', '', 'password', 'passowrd', 'approved'),
(2, 'Student', 'student@gmail.com', 'ecu/2024/csit/202', 'male', 'password', 'password', 'pending'),
(3, 'Rukky James', 'rukkyjames@gmail.com', 'ecu/2024/200/2929', 'female', 'pass', 'pass', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocation`
--
ALTER TABLE `allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complians`
--
ALTER TABLE `complians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostelspace`
--
ALTER TABLE `hostelspace`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocation`
--
ALTER TABLE `allocation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `complians`
--
ALTER TABLE `complians`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hostelspace`
--
ALTER TABLE `hostelspace`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
