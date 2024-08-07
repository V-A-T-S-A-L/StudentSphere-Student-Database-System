-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Aug 07, 2024 at 06:39 PM
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
-- Database: `vatstest`
--

-- --------------------------------------------------------

--
-- Table structure for table `cgpa`
--

CREATE TABLE `cgpa` (
  `roll_no` int(11) NOT NULL,
  `sem1` float NOT NULL,
  `sem2` float NOT NULL,
  `sem3` float NOT NULL,
  `sem4` float NOT NULL,
  `sem5` float NOT NULL,
  `sem6` float NOT NULL,
  `sem7` float NOT NULL,
  `sem8` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cgpa`
--

INSERT INTO `cgpa` (`roll_no`, `sem1`, `sem2`, `sem3`, `sem4`, `sem5`, `sem6`, `sem7`, `sem8`) VALUES
(10089, 7.5, 8.05, 9.04, 0, 0, 0, 0, 0),
(10090, 7.53, 8.33, 9, 0, 0, 0, 0, 0),
(10094, 8.22, 0, 0, 0, 0, 0, 0, 0),
(10088, 0, 0, 0, 0, 0, 0, 0, 0),
(10092, 0, 0, 0, 0, 0, 0, 0, 0),
(10059, 8.75, 9.06, 9.48, 0, 0, 0, 0, 0),
(10098, 7.5, 7.93, 0, 0, 0, 0, 0, 0),
(45, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `council`
--

CREATE TABLE `council` (
  `roll_no` int(11) NOT NULL,
  `council_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `council`
--

INSERT INTO `council` (`roll_no`, `council_name`, `position`) VALUES
(10089, 'mitCou1', 'mitpos1'),
(10090, 'vats council 1', 'vats pos 1'),
(10094, 'NSS', 'Volunteer'),
(10092, 'none', 'none'),
(10059, 'Rotaract', 'Social Media Manager'),
(10088, 'none', 'none'),
(10098, 'none', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `internship`
--

CREATE TABLE `internship` (
  `roll_no` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internship`
--

INSERT INTO `internship` (`roll_no`, `company_name`, `role`) VALUES
(10089, 'mitC1', 'mitR1'),
(10090, 'vatsal c1', 'vatsal r1'),
(10090, 'vatsal c2', 'vatsal r2'),
(10092, 'none', 'none'),
(10059, 'company c1', 'role r1'),
(10088, 'none', 'none'),
(10098, 'company c1', 'role r1'),
(10094, 'company c1', 'role r1');

-- --------------------------------------------------------

--
-- Table structure for table `internship_certificate`
--

CREATE TABLE `internship_certificate` (
  `roll_no` int(11) NOT NULL,
  `internship_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internship_certificate`
--

INSERT INTO `internship_certificate` (`roll_no`, `internship_pdf`) VALUES
(10090, 'ALGEBRA Question Paper Maharashtra SSC Class 10 Board Exam March 2018.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `patent`
--

CREATE TABLE `patent` (
  `roll_no` int(11) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patent`
--

INSERT INTO `patent` (`roll_no`, `description`) VALUES
(10089, 'mitpat1'),
(10094, 'samarth patent 1'),
(10090, 'vatsal patent 1'),
(10092, 'none'),
(10059, 'none'),
(10098, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE `personal_details` (
  `roll_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `github` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`roll_no`, `name`, `email`, `github`, `linkedin`, `contact`, `address`) VALUES
(10059, 'Mohammed Tufail', 'mohammed123@gmail.com', '123', '123', '8104576478', 'Chincholi, Malad W'),
(10088, 'Tejas Salvi', 'tejas007@gmail.com', '123', '123', '1239874560', 'Gandhi Road, Jogeshwari W'),
(10089, 'Mitesh Sawant', 'mitesh123@gmail.com', 'mitGit', 'mitLink', '1239874560', 'borivali'),
(10090, 'Vatsal Shah', 'vatsalshah004@gmail.com', 'link', 'link, '1234567890', 'Grant Road, Mumbai 400007'),
(10092, 'Raiyan Shaikh', 'sraiyan32@gmail.com', '123', '123', '1234567890', 'Naya Nagar, Mira Road-E'),
(10094, 'Samarth Shetty', 'samarthshetty04@gmail.com', 'ShettyGit', 'ShettyLink', '1234567890', 'Marol Pipeline Andheri(East) '),
(10098, 'Darshil Sonawane', 'darshil789@gmail.com', '123', '123', '1239874560', 'SV Road Vile Parle West');

-- --------------------------------------------------------

--
-- Table structure for table `profile_pic`
--

CREATE TABLE `profile_pic` (
  `roll_no` int(11) NOT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_pic`
--

INSERT INTO `profile_pic` (`roll_no`, `pic`) VALUES
(10090, 'IMG20220927212010.jpg'),
(10094, 'WhatsApp Image 2024-03-27 at 10.28.29_1820215a.jpg'),
(10059, 'WhatsApp Image 2024-05-04 at 09.10.14_02d5db33.jpg'),
(10092, 'WhatsApp Image 2024-05-04 at 09.10.14_910d027a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `roll_no` int(11) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`roll_no`, `description`) VALUES
(10094, 'STUDENT SPHERE(Student Database System)'),
(10090, 'vatsal project 1'),
(10090, 'vatsal project 2'),
(10089, 'mitesh proj 1'),
(10092, 'project 1'),
(10092, 'project 2'),
(10092, 'project 3'),
(10059, 'demo project 1'),
(10059, 'demo project 2'),
(10059, 'demo project 3'),
(10088, 'project 1'),
(10088, 'project 2'),
(10098, 'project 1'),
(10098, 'project 2');

-- --------------------------------------------------------

--
-- Table structure for table `research_paper`
--

CREATE TABLE `research_paper` (
  `roll_no` int(11) NOT NULL,
  `decription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `rollno` int(11) NOT NULL,
  `achievement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`rollno`, `achievement`) VALUES
(10089, 'mitsports1'),
(10094, '4x100mtrs Relay(1st) (FE)\r\n '),
(10094, '4x100mtrs Relay(1st) (SE)'),
(10090, 'vats sports 1\r\n'),
(10090, 'vats sports 2'),
(10092, 'sports achievement 1'),
(10092, 'sports achievement 2'),
(10059, 'none'),
(10088, 'demo achievement 1'),
(10098, 'sports achievement 1'),
(10098, 'sports achievement 2');

-- --------------------------------------------------------

--
-- Table structure for table `sports_certificates`
--

CREATE TABLE `sports_certificates` (
  `roll_no` int(11) NOT NULL,
  `sports_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports_certificates`
--

INSERT INTO `sports_certificates` (`roll_no`, `sports_pdf`) VALUES
(10090, 'Chp 3- Circles Extra Sums {Ans Key} (1).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `roll_no` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`roll_no`, `password`) VALUES
(10059, '123'),
(10088, '123'),
(10089, '456'),
(10090, '123'),
(10092, '123'),
(10094, '321'),
(10098, '123');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `password` char(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `password`, `admin`) VALUES
(1, 'Prof', '123', 0),
(2, 'subject', '456', 0),
(3, 'Demo 3', '123', 0),
(15, 'Admin 1', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tech_certificate`
--

CREATE TABLE `tech_certificate` (
  `roll_no` int(11) NOT NULL,
  `tech_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tech_certificate`
--

INSERT INTO `tech_certificate` (`roll_no`, `tech_pdf`) VALUES
(10090, 'virtualRealProtected.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tech_comp`
--

CREATE TABLE `tech_comp` (
  `roll_no` int(11) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tech_comp`
--

INSERT INTO `tech_comp` (`roll_no`, `description`) VALUES
(10089, 'mittech1'),
(10089, 'mitTech 2'),
(10090, 'vats tech 1'),
(10090, 'vats tech 2'),
(10094, 'samarth tech 1'),
(10094, 'samarth tech 2'),
(10090, 'vats tech 3'),
(10092, 'tech achievement 1'),
(10092, 'tech achievement 2'),
(10059, 'Demo achievement 1'),
(10059, 'Demo achievement 2'),
(10088, 'tech achievement 1'),
(10088, 'tech achievement 2'),
(10098, 'none');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`roll_no`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `roll_no_2` (`roll_no`),
  ADD KEY `roll_no` (`roll_no`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
