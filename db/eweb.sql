-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 08:16 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eweb`
--
CREATE DATABASE IF NOT EXISTS `eweb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `eweb`;

-- --------------------------------------------------------

--
-- Table structure for table `academicyear`
--

DROP TABLE IF EXISTS `academicyear`;
CREATE TABLE `academicyear` (
  `Id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `ClosureDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academicyear`
--

INSERT INTO `academicyear` (`Id`, `Title`, `ClosureDate`) VALUES
(7, 'Year of 20201', '2021-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `Id` int(11) NOT NULL,
  `Title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`Id`, `Title`) VALUES
(2, 'Sales'),
(3, 'Marketing'),
(4, 'Math Department');

-- --------------------------------------------------------

--
-- Table structure for table `ideacategory`
--

DROP TABLE IF EXISTS `ideacategory`;
CREATE TABLE `ideacategory` (
  `Id` int(11) NOT NULL,
  `Title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ideacategory`
--

INSERT INTO `ideacategory` (`Id`, `Title`) VALUES
(3, 'Current Affairs'),
(4, 'News');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

DROP TABLE IF EXISTS `ideas`;
CREATE TABLE `ideas` (
  `Id` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `IdeaCategoryId` int(11) NOT NULL,
  `UploaderId` int(11) NOT NULL,
  `Header` text DEFAULT NULL,
  `Description` text NOT NULL,
  `ImgPath` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`Id`, `SubjectId`, `IdeaCategoryId`, `UploaderId`, `Header`, `Description`, `ImgPath`) VALUES
(18, 7, 4, 1, '', 'h,h,', '1634675708151.jpg'),
(19, 7, 4, 1, '', 'kkkk', '1634675711351.'),
(20, 7, 4, 1, '', 'k.jk.j', '1634675716187.'),
(25, 14, 4, 1, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '1634925900713.'),
(26, 14, 4, 1, '', 'Lorem ipsum but with image', '1634925932466.jpg'),
(27, 14, 4, 1, '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', '1634926084145.'),
(28, 14, 4, 1, '', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ', '1634926140671.jpg'),
(29, 14, 4, 5, '', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', '1634926350917.');

-- --------------------------------------------------------

--
-- Table structure for table `ideastats`
--

DROP TABLE IF EXISTS `ideastats`;
CREATE TABLE `ideastats` (
  `Id` int(11) NOT NULL,
  `IdeaId` int(11) NOT NULL,
  `Likes` int(11) DEFAULT NULL,
  `Dislikes` int(11) DEFAULT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ideastats`
--

INSERT INTO `ideastats` (`Id`, `IdeaId`, `Likes`, `Dislikes`, `UserId`) VALUES
(41, 14, 0, 1, 1),
(42, 16, 1, 0, 1),
(43, 17, 0, 1, 1),
(44, 20, 1, 0, 1),
(48, 13, 1, 0, 1),
(49, 10, 1, 0, 1),
(54, 5, 1, 0, 1),
(58, 22, 1, 0, 1),
(61, 11, 1, 0, 1),
(63, 12, 0, 1, 1),
(64, 24, 1, 0, 1),
(65, 23, 0, 1, 1),
(67, 25, 0, 1, 1),
(69, 26, 1, 0, 1),
(70, 27, 0, 1, 1),
(71, 28, 0, 1, 1),
(73, 29, 1, 0, 1),
(74, 29, 1, 0, 13),
(75, 28, 0, 1, 13),
(76, 27, 1, 0, 13),
(77, 26, 1, 0, 13),
(78, 25, 1, 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `Id` int(11) NOT NULL,
  `Title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Id`, `Title`) VALUES
(2, 'Admin'),
(5, 'Quality Assurance Manager'),
(6, 'Quality Assurance Coordinator'),
(7, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `staffdepartment`
--

DROP TABLE IF EXISTS `staffdepartment`;
CREATE TABLE `staffdepartment` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `DepartmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffdepartment`
--

INSERT INTO `staffdepartment` (`Id`, `UserId`, `DepartmentId`) VALUES
(2, 1, 3),
(3, 5, 3),
(5, 7, 2),
(6, 8, 3),
(7, 9, 3),
(8, 10, 2),
(9, 11, 4),
(10, 12, 2),
(11, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `Id` int(11) NOT NULL,
  `Header` text NOT NULL,
  `Message` text NOT NULL,
  `ImgPath` text NOT NULL,
  `DepartmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`Id`, `Header`, `Message`, `ImgPath`, `DepartmentId`) VALUES
(6, 'qac@qac.com', 'qac@qac.com', '1634673854879.jpg', 2),
(7, 'Header', 'Lorem', '1634674038437.jpg', 2),
(8, 'Tech Forum', 'The technology section of The platform is a place to share and discuss the latest developments, happenings and curiosities in the world of technology, a broad spectrum of conversation as to the innovations, aspirations, applications and machinations that define our age and shape our future.', '1634924860871.jpg', 3),
(9, 'Relationships', 'A friendly, mature relationship forum dedicated to discussing all things relating to and about love, relationships, dating, marriage & more.', '1634925177787.jpg', 3),
(10, 'Coding', 'News about the dynamic, interpreted, interactive, object-oriented, extensible programming language Python.', '1634925268171.jpg', 3),
(11, 'SEO', 'This Subject was created with the intent to foster growth and knowledge about not just SEO but all disciplines of inbound marketing that get shuffled under the title, SEO.', '1634925323299.jpg', 3),
(12, 'Science', 'The Science Subject is a place to share new findings. Read about the latest advances in astronomy, biology, medicine, physics and the social sciences. Find and submit the best writeup on the web about a discovery, and make sure it cites its sources.', '1634925420964.jpg', 3),
(13, 'Beauty', 'Beauty forum and fashion forum to share makeup tips & tricks, product reviews, hair and skin care advice, and to discuss styles.', '1634925471268.jpg', 4),
(14, 'Beauty', 'Beauty forum and fashion forum to share makeup tips & tricks, product reviews, hair and skin care advice, and to discuss styles.', '1634925494412.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Names` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `PhoneNumber` text NOT NULL,
  `RoleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Names`, `Email`, `Password`, `PhoneNumber`, `RoleId`) VALUES
(1, 'Nina Simone', 'email@email.com', '1', '123456', 7),
(2, 'Admin Account', 'admin@admin.com', 'admin@admin.com', '0978095096', 2),
(5, 'Staff Account', 'staff@staff.com', 'staff@staff.com', '0978596263', 7),
(7, 'Nawa', 'email@email.com', 'email@email.com', '424234234', 6),
(8, 'qam@qam.com', 'qam@qam.com', 'qam@qam.com', '09789050652', 5),
(9, 'qac@qac.com', 'qac@qac.com', 'qac@qac.com', '0978965253', 6),
(10, 'Jizzy James', 'staff@staff.com2', 'staff@staff.com2', '0978905095', 7),
(11, 'Ghost Face James', 'staff@staff.com3', 'staff@staff.com3', '0978956285', 7),
(12, 'Kendrick Nalisa', 'staff@staff.com4', 'staff@staff.com4', '0978905096', 7),
(13, 'Anita Blake', 'an@email.com', 'an@email.com', '097859622', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicyear`
--
ALTER TABLE `academicyear`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `ideacategory`
--
ALTER TABLE `ideacategory`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdeaCategoryId` (`IdeaCategoryId`),
  ADD KEY `SubjectId` (`SubjectId`),
  ADD KEY `UploaderId` (`UploaderId`);

--
-- Indexes for table `ideastats`
--
ALTER TABLE `ideastats`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `staffdepartment`
--
ALTER TABLE `staffdepartment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `DepartmentId` (`DepartmentId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `DepartmentId` (`DepartmentId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `RoleId` (`RoleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicyear`
--
ALTER TABLE `academicyear`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ideacategory`
--
ALTER TABLE `ideacategory`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ideastats`
--
ALTER TABLE `ideastats`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staffdepartment`
--
ALTER TABLE `staffdepartment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_ibfk_1` FOREIGN KEY (`IdeaCategoryId`) REFERENCES `ideacategory` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ideas_ibfk_2` FOREIGN KEY (`SubjectId`) REFERENCES `subjects` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ideas_ibfk_3` FOREIGN KEY (`UploaderId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ideastats`
--
ALTER TABLE `ideastats`
  ADD CONSTRAINT `ideastats_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staffdepartment`
--
ALTER TABLE `staffdepartment`
  ADD CONSTRAINT `staffdepartment_ibfk_1` FOREIGN KEY (`DepartmentId`) REFERENCES `departments` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staffdepartment_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`DepartmentId`) REFERENCES `departments` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleId`) REFERENCES `roles` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
