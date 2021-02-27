-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2020 at 02:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakphones`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submission`
--

CREATE TABLE `assignment_submission` (
  `submission_id` int(20) NOT NULL,
  `submission_name` varchar(255) NOT NULL,
  `assignment_id` int(20) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(20) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `class_teacher` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `class`
--
DELIMITER $$
CREATE TRIGGER `enrol_teacher` AFTER INSERT ON `class` FOR EACH ROW INSERT INTO enrolment (class_id, user_id) VALUES(new.class_id, new.class_teacher)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `enrolment`
--

CREATE TABLE `enrolment` (
  `enrolment_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(20) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` int(20) DEFAULT NULL,
  `author` int(20) DEFAULT NULL,
  `class_id` int(20) DEFAULT NULL,
  `date` date DEFAULT curdate(),
  `time` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `file_type`
--

CREATE TABLE `file_type` (
  `type_id` int(20) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_type`
--

INSERT INTO `file_type` (`type_id`, `type_name`) VALUES
(1, 'Lectures'),
(2, 'Assignments');

-- --------------------------------------------------------

--
-- Stand-in structure for view `file_users`
-- (See below for the actual view)
--
CREATE TABLE `file_users` (
`file_id` int(20)
,`file_name` varchar(255)
,`file_type` int(20)
,`author` int(20)
,`class_id` int(20)
,`date` date
,`time` time
,`type_id` int(20)
,`type_name` varchar(255)
,`user_id` int(20)
,`user_name` varchar(255)
,`user_email` varchar(255)
,`user_password` varchar(255)
,`token` varchar(255)
,`pic` varchar(255)
,`user_type` int(20)
,`register_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `submission_users`
-- (See below for the actual view)
--
CREATE TABLE `submission_users` (
`submission_id` int(20)
,`submission_name` varchar(255)
,`assignment_id` int(20)
,`user_id` int(20)
,`user_name` varchar(255)
,`user_type` int(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT 'default.jpg',
  `user_type` int(20) DEFAULT NULL,
  `register_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `count_users` AFTER INSERT ON `users` FOR EACH ROW UPDATE user_types set type_count = type_count + 1 where type_id = new.user_type
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `count_users_del` AFTER DELETE ON `users` FOR EACH ROW UPDATE user_types set type_count = type_count - 1 where type_id = old.user_type
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `users_class`
-- (See below for the actual view)
--
CREATE TABLE `users_class` (
`user_id` int(20)
,`enrolment_id` int(20)
,`user_name` varchar(255)
,`class_id` int(20)
,`class_name` varchar(255)
,`user_type` int(20)
,`class_teacher` int(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `type_id` int(20) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_count` int(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`type_id`, `type_name`, `type_count`) VALUES
(1, 'Student', 0),
(2, 'Teacher', 0);

-- --------------------------------------------------------

--
-- Structure for view `file_users`
--
DROP TABLE IF EXISTS `file_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `file_users`  AS  select `file`.`file_id` AS `file_id`,`file`.`file_name` AS `file_name`,`file`.`file_type` AS `file_type`,`file`.`author` AS `author`,`file`.`class_id` AS `class_id`,`file`.`date` AS `date`,`file`.`time` AS `time`,`file_type`.`type_id` AS `type_id`,`file_type`.`type_name` AS `type_name`,`users`.`user_id` AS `user_id`,`users`.`user_name` AS `user_name`,`users`.`user_email` AS `user_email`,`users`.`user_password` AS `user_password`,`users`.`token` AS `token`,`users`.`pic` AS `pic`,`users`.`user_type` AS `user_type`,`users`.`register_date` AS `register_date` from ((`file` join `file_type` on(`file`.`file_type` = `file_type`.`type_id`)) join `users` on(`users`.`user_id` = `file`.`author`)) ;

-- --------------------------------------------------------

--
-- Structure for view `submission_users`
--
DROP TABLE IF EXISTS `submission_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `submission_users`  AS  select `assignment_submission`.`submission_id` AS `submission_id`,`assignment_submission`.`submission_name` AS `submission_name`,`assignment_submission`.`assignment_id` AS `assignment_id`,`users`.`user_id` AS `user_id`,`users`.`user_name` AS `user_name`,`users`.`user_type` AS `user_type` from (`assignment_submission` join `users` on(`users`.`user_id` = `assignment_submission`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `users_class`
--
DROP TABLE IF EXISTS `users_class`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users_class`  AS  select `users`.`user_id` AS `user_id`,`enrolment`.`enrolment_id` AS `enrolment_id`,`users`.`user_name` AS `user_name`,`class`.`class_id` AS `class_id`,`class`.`class_name` AS `class_name`,`users`.`user_type` AS `user_type`,`class`.`class_teacher` AS `class_teacher` from ((`users` join `enrolment`) join `class` on(`users`.`user_id` = `enrolment`.`user_id` and `class`.`class_id` = `enrolment`.`class_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  ADD PRIMARY KEY (`submission_id`),
  ADD UNIQUE KEY `unique_index` (`assignment_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_name` (`class_name`),
  ADD KEY `class_teacher` (`class_teacher`);

--
-- Indexes for table `enrolment`
--
ALTER TABLE `enrolment`
  ADD PRIMARY KEY (`enrolment_id`),
  ADD UNIQUE KEY `unique_index` (`class_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`),
  ADD UNIQUE KEY `file_name` (`file_name`),
  ADD KEY `file_type` (`file_type`),
  ADD KEY `author` (`author`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `file_type`
--
ALTER TABLE `file_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  MODIFY `submission_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enrolment`
--
ALTER TABLE `enrolment`
  MODIFY `enrolment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `file_type`
--
ALTER TABLE `file_type`
  MODIFY `type_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `type_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  ADD CONSTRAINT `assignment_submission_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `file` (`file_id`),
  ADD CONSTRAINT `assignment_submission_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`class_teacher`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `enrolment`
--
ALTER TABLE `enrolment`
  ADD CONSTRAINT `enrolment_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `enrolment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`file_type`) REFERENCES `file_type` (`type_id`),
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`author`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `file_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
