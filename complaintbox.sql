-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2022 at 05:43 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complaintbox`
--
CREATE DATABASE IF NOT EXISTS `complaintbox` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `complaintbox`;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `AID` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL DEFAULT 'ASSIGNED'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`AID`, `CID`, `UID`, `Status`) VALUES
(2, 21, 14, 'ASSIGNED'),
(3, 24, 13, 'ASSIGNED'),
(4, 22, 11, 'ASSIGNED');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL DEFAULT 'Admin',
  `timeDate` varchar(100) NOT NULL,
  `comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `CID`, `UID`, `Name`, `timeDate`, `comment`) VALUES
(16, 21, 14, 'Admin', 'Nov,02,2022 02:36:22 PM', 'Message From admin'),
(17, 24, 13, 'Admin', 'Nov,02,2022 02:49:14 PM', 'heyyyyy colll booyysss do this work'),
(18, 21, 0, 'Admin', 'Nov,02,2022 04:47:47 PM', 'heyyy userss'),
(19, 22, 11, 'Admin', 'Nov,02,2022 05:22:43 PM', 'Hiii this issue sooooooonnnnnnnn'),
(20, 22, 11, 'Mohd Monish', 'Nov,02,2022 06:30:01 PM', 'dfdfddf');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `CID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `cDate` varchar(100) NOT NULL,
  `cTime` varchar(50) NOT NULL,
  `cType` varchar(100) NOT NULL DEFAULT 'OTHERS',
  `subject` varchar(250) NOT NULL,
  `cDescription` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'UNSEEN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`CID`, `UID`, `cDate`, `cTime`, `cType`, `subject`, `cDescription`, `status`) VALUES
(21, 11, 'Nov 14, 2022', '08:17 PM', 'OTHERS', 'my cmplaint  subject ', 'description/199545862708:17 PM11.html', 'SOLVEDACTIVE'),
(22, 11, 'Nov 14, 2022', '02:15 AM', 'RESIDENT', 'second subject', 'description/64708022202:15 AM11.html', 'ACTIVE'),
(23, 11, 'Nov 24, 2022', '03:18 AM', 'OTHERS', 'fgfdfg', 'description/110186874903:18 AM11.html', 'PENDING'),
(24, 13, 'Nov 14, 2022', '12:48 AM', 'PLUMBER', 'this is my subject', 'description/158726778612:48 AM13.html', 'ACTIVE'),
(25, 18, 'Nov 15, 2022', '04:11 AM', 'ELECTRICIAN', 'this is complaint subject', 'description/151257660004:11 AM18.html', 'UNSEEN'),
(26, 11, 'Nov 15, 2022', '12:16 PM', 'PLUMBER', 'heyyy this is my complaint', 'description/71087256112:16 PM11.html', 'UNSEEN'),
(27, 13, 'Nov,02,2022', '09:42:22 PM', 'PLUMBER', 'complaint subjectc', 'description/638868049.html', 'UNSEEN'),
(28, 13, 'Nov,02,2022', '09:43:51 PM', ' RESIDENT', 'Heyyy Subject Anything that can cause harmful problems.', 'description/203897279813955948311684928866.html', 'UNSEEN'),
(29, 13, 'Nov,02,2022', '09:44:16 PM', ' OTHERS', 'Anything that can cause harmful problems.', 'description/8404478281948890720398322653.html', 'UNSEEN');

-- --------------------------------------------------------

--
-- Table structure for table `standardcomplaints`
--

CREATE TABLE `standardcomplaints` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `Description` varchar(750) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `standardcomplaints`
--

INSERT INTO `standardcomplaints` (`id`, `category`, `subject`, `Description`) VALUES
(1, 'RESIDENT', 'Heyyy Subject Anything that can cause harmful problems.', 'Request repairs. Of course, put in a repair request first. But if that gets ignored, send a complaint letter. Some examples of necessary repairs include leaky faucets, plumbing issues, broken appliances and leaks in the roof. Failure to complete regular maintenance outlined in the lease also qualifies.\nRepeated issues with neighbors, such as loud music, fighting or other disruptive behavior. However, if you suspect anything that\'s extremely dangerous and/or against the law, such as domestic abuse, call the police immediately.\nAnything that can cause health problems, like rodents, insects and mold. Problems like these are more likely to happen in a rental house'),
(2, 'OTHERS', 'Anything that can cause harmful problems.', 'Request repairs. Of course, put in a repair request first. But if that gets ignored, send a complaint letter. Some examples of necessary repairs include leaky faucets, plumbing issues, broken appliances and leaks in the roof. Failure to complete regular maintenance outlined in the lease also qualifies.\r\nRepeated issues with neighbors, such as loud music, fighting or other disruptive behavior. However, if you suspect anything that\'s extremely dangerous and/or against the law, such as domestic abuse, call the police immediately.\r\nAnything that can cause health problems, like rodents, insects and mold. Problems like these are more likely to happen in a rental house');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `workStatus` varchar(10) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `Name`, `Email`, `Password`, `Category`, `Mobile`, `Address`, `workStatus`) VALUES
(11, 'Mohd Monish', 'mohdmonishksg@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'RESIDENT', '09821446257', 'Mnnit Allahabad', 'YES'),
(12, 'Aancha Navlakha', 'aanchalnavlakha@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'ELECTRICIAN', '9174809521', 'Indore Madhya Pradesh ', 'NO'),
(13, 'sahil dikka', 'sahildikka2001@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'PLUMBER', '9821960098', 'Mnnit Allahabad', 'YES'),
(14, 'Mohd Danish', 'monishksg@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'OTHERS', '8742996850', 'Mnnit Allahabad Uttar Pradesh', 'YES'),
(15, 'Aman Mishra', 'monish2021.mca@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'PLUMBER', '9821446258', 'Mnnit Allahabad UP India', 'NO'),
(16, 'Chinglen  Khomba', 'cknaorem.kakching@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'RESIDENT', '7898653412', 'Manipur West Imphal', 'NO'),
(17, 'Kumari Aanchal', 'aanchalnav2512@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'ELECTRICIAN', '9821446257', 'Delhi India ', 'NO'),
(18, 'Pooja  Rani', 'aanchalnavlakha477@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'PLUMBER', '9821444356', 'Mnnit Allahabad INDIA', 'NO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`AID`),
  ADD KEY `CID` (`CID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `comments_ibfk_1` (`UID`),
  ADD KEY `CID` (`CID`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`CID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `standardcomplaints`
--
ALTER TABLE `standardcomplaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `standardcomplaints`
--
ALTER TABLE `standardcomplaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `complaints` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `complaints` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
