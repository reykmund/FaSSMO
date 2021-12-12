-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2021 at 07:10 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cit`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `pkey` int(11) NOT NULL,
  `idnumber` varchar(32) NOT NULL,
  `honorific` varchar(32) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`pkey`, `idnumber`, `honorific`, `firstname`, `lastname`) VALUES
(1, '287672', 'Mr.', 'Kreymund', 'Galacgac');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_timein`
--

CREATE TABLE `faculty_timein` (
  `num` int(32) NOT NULL,
  `idnumber` varchar(64) NOT NULL,
  `timein` varchar(64) NOT NULL,
  `datein` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_timein`
--

INSERT INTO `faculty_timein` (`num`, `idnumber`, `timein`, `datein`) VALUES
(1, '287672', '07:12:54 PM', '2021-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_timeout`
--

CREATE TABLE `faculty_timeout` (
  `pkey` int(11) NOT NULL,
  `idnumber` varchar(32) NOT NULL,
  `dateout` varchar(64) NOT NULL,
  `outtime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_timeout`
--

INSERT INTO `faculty_timeout` (`pkey`, `idnumber`, `dateout`, `outtime`) VALUES
(1, '287672', 'December 10, 2021', '07:13:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `num` int(11) NOT NULL,
  `studID` varchar(16) NOT NULL,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`num`, `studID`, `fname`, `lname`) VALUES
(2, '18-070191', 'Shane Kaye', 'Aguinaldo'),
(3, '18-070001', 'Mae Ann', 'Amihan'),
(4, '18-070042', 'Jhon Aldrin', 'Anday'),
(5, '18-070315', 'Marnel', 'Arculan'),
(6, '18-070265', 'Ryan Joshua', 'Bacud'),
(7, '18-070223', 'Charlene', 'Labiton'),
(8, '18-070323', 'Junry Rafael', 'Reyes'),
(9, '18-070008', 'Kreymund', 'Galacgac'),
(10, '18-070007', 'Hannah Angelica', 'Cac'),
(12, '18-070140', 'Cristel Dianne', 'Pambid'),
(13, '18-070139', 'Carla', 'Cabuntasan'),
(14, '18-070227', 'Gananiel', 'Magadia'),
(15, '18-070261', 'Dianne', 'Pasamonte'),
(16, '18-070257', 'Danielle Anne', 'Ribao'),
(17, '18-070039', 'Alvin James', 'Layaoen'),
(18, '18-070154', 'Nica', 'Agunoy'),
(19, '18-070334', 'Paulo', 'Gutierrez'),
(20, '18-070002', 'Ralf Jefferson', 'Corpuz'),
(21, '18-070143', 'Mark Deon', 'Duerme'),
(22, '18-070006', 'Meljon', 'Santos'),
(23, '18-070145', 'Jetlee', 'Palalay'),
(24, '18-070284', 'Christopher', 'Ricamora'),
(25, '18-070026', 'Angelica', 'Bulaun'),
(26, '18-070156', 'Elchris Michelle', 'Tungpalan');

-- --------------------------------------------------------

--
-- Table structure for table `teacherscmpt`
--

CREATE TABLE `teacherscmpt` (
  `num` int(11) NOT NULL,
  `teacher_id` varchar(16) NOT NULL,
  `user` varchar(32) NOT NULL,
  `pass` varchar(192) NOT NULL,
  `honorific` varchar(16) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacherscmpt`
--

INSERT INTO `teacherscmpt` (`num`, `teacher_id`, `user`, `pass`, `honorific`, `firstname`, `lastname`) VALUES
(1, 'unknown', 'rviloria', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Engr.', 'Rommel', 'Viloria');

-- --------------------------------------------------------

--
-- Table structure for table `timeincmpt`
--

CREATE TABLE `timeincmpt` (
  `num` int(11) NOT NULL,
  `studID` varchar(16) NOT NULL,
  `datein` date NOT NULL,
  `timein` varchar(32) NOT NULL,
  `PCNum` varchar(16) NOT NULL,
  `subj` varchar(32) NOT NULL,
  `teacher` varchar(64) NOT NULL,
  `room` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeincmpt`
--

INSERT INTO `timeincmpt` (`num`, `studID`, `datein`, `timein`, `PCNum`, `subj`, `teacher`, `room`) VALUES
(1, '18-070008', '2021-12-10', '02:59:55 PM', 'with Laptop', 'CMPT143', 'Engr. Rommel Viloria', 'TB202');

-- --------------------------------------------------------

--
-- Table structure for table `timeoutcmpt`
--

CREATE TABLE `timeoutcmpt` (
  `num` int(11) NOT NULL,
  `studID` varchar(16) NOT NULL,
  `dateout` varchar(32) NOT NULL,
  `outtime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeoutcmpt`
--

INSERT INTO `timeoutcmpt` (`num`, `studID`, `dateout`, `outtime`) VALUES
(1, '18-070008', 'December 10, 2021', '03:00:12 PM');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_log`
--

CREATE TABLE `visitor_log` (
  `primary_key` int(11) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `purpose` varchar(128) NOT NULL,
  `datein` varchar(64) NOT NULL,
  `timein` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor_log`
--

INSERT INTO `visitor_log` (`primary_key`, `fullname`, `purpose`, `datein`, `timein`) VALUES
(1, 'Hannah Cac', 'payment', 'December 10, 2021', '07:25:07 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`pkey`);

--
-- Indexes for table `faculty_timein`
--
ALTER TABLE `faculty_timein`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `faculty_timeout`
--
ALTER TABLE `faculty_timeout`
  ADD PRIMARY KEY (`pkey`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `teacherscmpt`
--
ALTER TABLE `teacherscmpt`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `timeincmpt`
--
ALTER TABLE `timeincmpt`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `timeoutcmpt`
--
ALTER TABLE `timeoutcmpt`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `visitor_log`
--
ALTER TABLE `visitor_log`
  ADD PRIMARY KEY (`primary_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculty_timein`
--
ALTER TABLE `faculty_timein`
  MODIFY `num` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculty_timeout`
--
ALTER TABLE `faculty_timeout`
  MODIFY `pkey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `teacherscmpt`
--
ALTER TABLE `teacherscmpt`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timeincmpt`
--
ALTER TABLE `timeincmpt`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timeoutcmpt`
--
ALTER TABLE `timeoutcmpt`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitor_log`
--
ALTER TABLE `visitor_log`
  MODIFY `primary_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
