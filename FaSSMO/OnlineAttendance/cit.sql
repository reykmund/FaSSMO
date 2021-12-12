-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2021 at 06:25 AM
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
-- Table structure for table `cmpt`
--

CREATE TABLE `cmpt` (
  `num` int(11) NOT NULL,
  `studID` varchar(16) NOT NULL,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cmpt`
--

INSERT INTO `cmpt` (`num`, `studID`, `fname`, `lname`) VALUES
(1, '18-070008', 'Kreymund', 'Galacgac'),
(2, '18-070191', 'Shane Kaye', 'Aguinaldo'),
(3, '18-070001', 'Mae Ann', 'Amihan'),
(4, '18-070042', 'Jhon Aldrin', 'Anday'),
(5, '18-070315', 'Marnel', 'Arculan'),
(6, '18-070265', 'Ryan Joshua', 'Bacud'),
(7, '18-070223', 'Charlene', 'Labiton');

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
(1, 'unknown', 'jguillen', '39b9fe5f4d8f80b9bdb06f0f5c17f8de2af3693a', 'Mr.', 'Jade', 'Guillen'),
(2, 'undetermined', 'rviloria', '5b931679d6d06a325a901d40bd1ecd01b329ad3c', 'Engr.', 'Rommel', 'Viloria');

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
(1, '18-070008', '2021-06-02', '02:06:57 PM', 'with Laptop', 'CMPT152', 'Mr. Jade Guillen', 'Room TB202'),
(3, '18-070223', '2021-06-02', '04:19:57 PM', '18', 'CMPT152', 'Mr. Jade Guillen', 'Room TB201'),
(4, '18-070223', '2021-06-02', '04:33:15 PM', '12', 'CMPT152', 'Mr. Jade Guillen', 'acads bldg 101');

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
(1, '18-070008', 'June 02, 2021', '02:29:54 PM'),
(3, '18-070223', 'June 02, 2021', '04:23:18 PM'),
(4, '18-070223', 'June 02, 2021', '04:37:27 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cmpt`
--
ALTER TABLE `cmpt`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cmpt`
--
ALTER TABLE `cmpt`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacherscmpt`
--
ALTER TABLE `teacherscmpt`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timeincmpt`
--
ALTER TABLE `timeincmpt`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timeoutcmpt`
--
ALTER TABLE `timeoutcmpt`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
