-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2020 at 11:51 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcq_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(9) NOT NULL,
  `questionId` int(9) NOT NULL,
  `correctAnswer` int(9) NOT NULL DEFAULT '0',
  `answerText` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `questionId`, `correctAnswer`, `answerText`) VALUES
(17, 16, 0, 'red'),
(18, 16, 1, 'blue'),
(19, 16, 0, 'green'),
(20, 16, 0, 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `enrolment`
--

CREATE TABLE `enrolment` (
  `id` int(9) NOT NULL,
  `userId` int(9) NOT NULL,
  `quizId` int(9) NOT NULL,
  `enroledOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(9) NOT NULL,
  `number` int(9) NOT NULL,
  `quizId` int(9) NOT NULL,
  `questionText` varchar(999) NOT NULL,
  `mark` int(9) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `number`, `quizId`, `questionText`, `mark`, `createdAt`, `updatedAt`) VALUES
(16, 1, 13, 'Color of sky', 20, '2020-01-14', '2020-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `quizname`
--

CREATE TABLE `quizname` (
  `id` int(9) NOT NULL,
  `name` varchar(999) NOT NULL,
  `paymentRequired` int(9) NOT NULL DEFAULT '0',
  `cost` int(9) NOT NULL DEFAULT '0',
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizname`
--

INSERT INTO `quizname` (`id`, `name`, `paymentRequired`, `cost`, `createdAt`, `updatedAt`) VALUES
(13, 'Mockup 1', 0, 0, '2020-01-14', '2020-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `useranswer`
--

CREATE TABLE `useranswer` (
  `id` int(9) NOT NULL,
  `userId` int(9) NOT NULL,
  `quizId` int(9) NOT NULL,
  `questionId` int(9) NOT NULL,
  `answerId` int(9) NOT NULL,
  `score` int(9) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useranswer`
--

INSERT INTO `useranswer` (`id`, `userId`, `quizId`, `questionId`, `answerId`, `score`) VALUES
(1, 6, 13, 16, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(999) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('user','admin','','') NOT NULL,
  `number` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `number`) VALUES
(3, 'Testuser', 'testuser4@gmail.com', '$2y$10$EXMkY25zF4wfnDq59L5koux42tQbcsRBoHhKBU97EPuAA30serHFW', 'admin', 853325956),
(4, 'Rakesh Chandra Dash', 'testuser5@gmail.com', '$2y$10$CJzuMEa0wp7cqcCz8uENN.cMYdXamG9W5esROrEfX7devHZFm16b.', 'user', 2147483647),
(5, 'admin', 'admin@gmail.com', '$2y$10$Mk4K69SITULzlLzI8VBejuQlIQiwifPkh1cz9EAQF3fupA7qWqKJ.', 'admin', 2147483647),
(6, 'Rakesh', 'testuser6@gmail.com', '$2y$10$BmvIztvqgSRvqPppyMMuTejCJN9za5boaTQyjP1sPIPQc1nyUBqE2', 'user', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `enrolment`
--
ALTER TABLE `enrolment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizId` (`quizId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_ibfk_1` (`quizId`);

--
-- Indexes for table `quizname`
--
ALTER TABLE `quizname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useranswer`
--
ALTER TABLE `useranswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answerId` (`answerId`),
  ADD KEY `questionId` (`questionId`),
  ADD KEY `quizId` (`quizId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `enrolment`
--
ALTER TABLE `enrolment`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quizname`
--
ALTER TABLE `quizname`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `useranswer`
--
ALTER TABLE `useranswer`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrolment`
--
ALTER TABLE `enrolment`
  ADD CONSTRAINT `enrolment_ibfk_1` FOREIGN KEY (`quizId`) REFERENCES `quizname` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quizId`) REFERENCES `quizname` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useranswer`
--
ALTER TABLE `useranswer`
  ADD CONSTRAINT `useranswer_ibfk_1` FOREIGN KEY (`answerId`) REFERENCES `answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `useranswer_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `useranswer_ibfk_3` FOREIGN KEY (`quizId`) REFERENCES `quizname` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
