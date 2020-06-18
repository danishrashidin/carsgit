-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2020 at 01:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tryguess_activity`
--

-- --------------------------------------------------------

--
-- Table structure for table `Activity`
--

CREATE TABLE `Activity` (
  `Activity_ID` int(11) NOT NULL,
  `Activity_Name` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `College` varchar(255) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Reg_Dead` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Activity`
--

INSERT INTO `Activity` (`Activity_ID`, `Activity_Name`, `Position`, `College`, `Status`, `Reg_Dead`) VALUES
(101, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK1', '', '2020-06-30'),
(102, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK2', '', '2020-06-30'),
(103, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK3', '', '2020-06-30'),
(104, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK4', '', '2020-06-30'),
(105, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK5', '', '2020-06-30'),
(106, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK6', '', '2020-06-30'),
(107, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK7', '', '2020-06-30'),
(108, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK8', '', '2020-06-30'),
(109, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK9', '', '2020-06-30'),
(110, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK10', '', '2020-06-30'),
(111, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK11', '', '2020-06-30'),
(112, 'Sukan Mahasiswa Universiti Malaya(SUKMUM)', '', 'KK12', '', '2020-06-30'),
(201, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK1', '', '2020-07-26'),
(202, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK2', '', '2020-07-26'),
(203, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK3', '', '2020-07-26'),
(204, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK4', '', '2020-07-26'),
(205, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK5', '', '2020-07-26'),
(206, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK6', '', '2020-07-26'),
(207, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK7', '', '2020-07-26'),
(208, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK8', '', '2020-07-26'),
(209, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK9', '', '2020-07-26'),
(210, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK10', '', '2020-07-26'),
(211, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK11', '', '2020-07-26'),
(212, 'Festival Seni Universiti Malaya(FESENI)', '', 'KK12', '', '2020-07-26'),
(301, 'College Dinner', '', 'KK1', '', '2020-08-12'),
(302, 'College Dinner', '', 'KK2', '', '2020-08-12'),
(303, 'College Dinner', '', 'KK3', '', '2020-08-12'),
(304, 'College Dinner', '', 'KK4', '', '2020-08-12'),
(305, 'College Dinner', '', 'KK5', '', '2020-08-12'),
(306, 'College Dinner', '', 'KK6', '', '2020-08-12'),
(307, 'College Dinner', '', 'KK7', '', '2020-08-12'),
(308, 'College Dinner', '', 'KK8', '', '2020-08-12'),
(309, 'College Dinner', '', 'KK9', '', '2020-08-12'),
(310, 'College Dinner', '', 'KK10', '', '2020-08-12'),
(311, 'College Dinner', '', 'KK11', '', '2020-08-12'),
(312, 'College Dinner', '', 'KK12', '', '2020-08-12'),
(401, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK1', '', '2020-09-15'),
(402, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK2', '', '2020-09-15'),
(403, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK3', '', '2020-09-15'),
(404, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK4', '', '2020-09-15'),
(405, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK5', '', '2020-09-15'),
(406, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK6', '', '2020-09-15'),
(407, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK7', '', '2020-09-15'),
(408, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK8', '', '2020-09-15'),
(409, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK9', '', '2020-09-15'),
(410, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK10', '', '2020-09-15'),
(411, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK11', '', '2020-09-15'),
(412, 'Karnival Teater Universiti Malaya(KARVITER)', '', 'KK12', '', '2020-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `Registration`
--

CREATE TABLE `Registration` (
  `Registration_ID` int(11) NOT NULL,
  `Activity_ID` int(11) NOT NULL,
  `Student_ID` int(10) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `Student_ID` int(10) NOT NULL,
  `First_Name` char(30) NOT NULL,
  `Last_Name` char(30) NOT NULL,
  `Password` char(20) NOT NULL,
  `Faculty` char(100) NOT NULL,
  `College` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Activity`
--
ALTER TABLE `Activity`
  ADD PRIMARY KEY (`Activity_ID`);

--
-- Indexes for table `Registration`
--
ALTER TABLE `Registration`
  ADD PRIMARY KEY (`Registration_ID`),
  ADD KEY `Activity_ID` (`Activity_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`Student_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Registration`
--
ALTER TABLE `Registration`
  MODIFY `Registration_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5678;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `Student_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Registration`
--
ALTER TABLE `Registration`
  ADD CONSTRAINT `Activity_ID` FOREIGN KEY (`Activity_ID`) REFERENCES `Activity` (`Activity_ID`),
  ADD CONSTRAINT `Student_ID` FOREIGN KEY (`Student_ID`) REFERENCES `Student` (`Student_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
