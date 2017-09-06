create database IF NOT EXISTS sysco;
use sysco;
-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2017 at 01:22 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sysco`
--

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE `certification` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `applied` varchar(500) DEFAULT NULL,
  `booked` varchar(500) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `email` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`id`, `name`, `applied`, `booked`, `status`, `email`) VALUES
(1, 'certi1', '', 'monday', 'fail', 'arun.r01'),
(2, 'certi2', 'ys', 'no', 'q', 'arun.r01'),
(3, 'certi2', 'yska', 'no', 'q', 'arun.r01'),
(4, '', '', '', '', 'arun.r01'),
(5, '1', '', '', '', 'arun.r01'),
(5, 'afdf', 're', 'fwff', 'sdfsf', 'sanath_varanasi'),
(5, 'afdf', 're', 'fwff', 'sdfsf', 'Anshikha.Sinha');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comments` varchar(1000) NOT NULL,
  `thoughtId` int(11) NOT NULL,
  `email` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comments`, `thoughtId`, `email`) VALUES
(1, 'answer', 1, 'sekar'),
(2, 'answer2', 1, 'sekar'),
(3, 'answer3', 2, 'sekar');

-- --------------------------------------------------------

--
-- Table structure for table `employeeinfo`
--

CREATE TABLE `employeeinfo` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `reporting_to` int(11) DEFAULT NULL,
  `birthday` date NOT NULL,
  `account` varchar(20) NOT NULL,
  `team` varchar(50) NOT NULL,
  `project_code` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeeinfo`
--

INSERT INTO `employeeinfo` (`id`, `user_id`, `name`, `role_id`, `reporting_to`, `birthday`, `account`, `team`, `project_code`) VALUES
(1, 1, 'Jayaprakash', 3, 3, '1994-07-22', 'AIMIA', 'Musgrave CI', 'BBC'),
(2, 2, 'Sekar', 3, 3, '1991-03-23', 'AIMIA', 'Musgrave CI', 'BBC'),
(4, 4, 'Saravanan', 7, NULL, '1980-05-03', 'AIMIA', '', 'BBC'),
(3, 3, 'Somasundaram', 6, 4, '1984-07-09', 'AIMIA', 'ALP - CI', 'BBC');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'Systems Engineer Trainee'),
(2, 'Systems Engineer'),
(3, 'Senior Systems Engineer'),
(4, 'Technolegy Analyst'),
(5, 'Technology Lead'),
(6, 'Project Manager'),
(7, 'Senior Project Manager');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL COMMENT 'Task Id ',
  `task_name` varchar(500) NOT NULL COMMENT 'Name of the task',
  `task_desc` varchar(1000) DEFAULT NULL,
  `assigned_to` int(11) NOT NULL,
  `assigned_date` date DEFAULT NULL,
  `target_date` date DEFAULT NULL,
  `submit_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `task_name`, `task_desc`, `assigned_to`, `assigned_date`, `target_date`, `submit_date`) VALUES
(1, 'Task 1', 'asl;fa', 2, '2017-09-05', '2017-09-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taskownerupdate`
--

CREATE TABLE `taskownerupdate` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `feedback` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `taskuserupdate`
--

CREATE TABLE `taskuserupdate` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `comments` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `thoughts`
--

CREATE TABLE `thoughts` (
  `id` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `email` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thoughts`
--

INSERT INTO `thoughts` (`id`, `question`, `email`) VALUES
(1, 'question1', 'sekar'),
(2, 'question2', 'sekar');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `name`) VALUES
(2, 'fb (2).jpg'),
(3, 'fb (3).jpg'),
(4, 'sysco.sql'),
(5, 'aapl.csv');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT 'Account status(Active/Inactive/Locked)'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(1, 'jp', 'jp', 0),
(2, 'sekar', 'sekar', 0),
(3, 'som', 'som', 0),
(4, 'sara', 'sara', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeeinfo`
--
ALTER TABLE `employeeinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `fk_role_id` (`role_id`),
  ADD KEY `fk_reporting_to` (`reporting_to`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taskownerupdate`
--
ALTER TABLE `taskownerupdate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taskuserupdate`
--
ALTER TABLE `taskuserupdate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thoughts`
--
ALTER TABLE `thoughts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `employeeinfo`
--
ALTER TABLE `employeeinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Task Id ', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `taskownerupdate`
--
ALTER TABLE `taskownerupdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `taskuserupdate`
--
ALTER TABLE `taskuserupdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
