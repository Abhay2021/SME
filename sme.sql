-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2019 at 04:56 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sme`
--

-- --------------------------------------------------------

--
-- Table structure for table `experts`
--

CREATE TABLE `experts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `industry_academia` int(11) NOT NULL COMMENT '1:Industry, 2:Academia',
  `availability` int(11) NOT NULL COMMENT '1:on call, 2:in-person',
  `country` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experts`
--

INSERT INTO `experts` (`id`, `name`, `sector`, `industry_academia`, `availability`, `country`, `active`) VALUES
(1, 'John Pierce', 'FMCG', 1, 1, 'USA', 1),
(2, 'Mary Mary', 'Telecom', 1, 1, 'Spain', 1),
(3, 'Tom Banks', 'Chemicals', 2, 2, 'India', 1),
(4, 'A Mathew', 'Chemicals', 2, 2, 'Italy', 1),
(5, 'Jack M.', 'Marketing', 1, 2, 'Germany', 1),
(6, 'Matt K.', 'IT', 2, 1, 'USA', 1),
(7, 'PerryT.', 'Pharma', 2, 1, 'India', 1),
(8, 'A.Banks', 'Research', 1, 1, 'India', 1),
(9, 'Simi N.', 'Pharma', 2, 1, 'USA', 1),
(10, 'Peter N.', 'FMCG', 2, 2, 'Italy', 1),
(11, 'Tim B.', 'Telecom', 1, 2, 'Germany', 1),
(12, 'KimT.', 'Chemicals', 2, 1, 'USA', 1),
(13, 'Mint L.', 'Chemicals', 2, 1, 'India', 1),
(14, 'A Peters', 'Marketing', 1, 1, 'India', 1),
(15, 'Jack L.', 'IT', 2, 1, 'USA', 1),
(16, 'J Pierce', 'Research', 2, 1, 'Italy', 1),
(17, 'M Mary', 'Pharma', 2, 2, 'Germany', 1),
(18, 'T Banks', 'FMCG', 1, 2, 'USA', 1),
(19, 'Mathew S.', 'Telecom', 2, 1, 'India', 1),
(20, 'Jack K.', 'Marketing', 1, 2, 'Germany', 1),
(21, 'Matty K.', 'IT', 2, 1, 'USA', 1),
(22, 'PertT.', 'Pharma', 2, 1, 'India', 1),
(23, 'S.Banks', 'Research', 1, 1, 'India', 1),
(24, 'Kimi N.', 'Pharma', 2, 1, 'USA', 1),
(25, 'Pete N.', 'FMCG', 2, 2, 'Italy', 1),
(26, 'Timmy B.', 'Telecom', 1, 2, 'Germany', 1),
(27, 'Katarina P.', 'Chemicals', 2, 1, 'USA', 1),
(28, 'Laurel L.', 'Chemicals', 2, 1, 'India', 1),
(29, 'A James', 'Marketing', 1, 1, 'India', 1),
(30, 'Tony L.', 'IT', 2, 1, 'USA', 1),
(31, 'Sam James', 'Research', 2, 1, 'Italy', 1),
(32, 'Meena Jain', 'Pharma', 2, 2, 'Germany', 1),
(33, 'Tommy H.', 'FMCG', 1, 2, 'USA', 1),
(34, 'Mona Jenson', 'Telecom', 2, 1, 'India', 1),
(35, 'Jackie P.', 'Marketing', 1, 2, 'Germany', 1),
(36, 'Ramona', 'IT', 2, 1, 'USA', 1),
(37, 'Jeet Singh', 'Pharma', 2, 1, 'India', 1),
(38, 'Garima Mittal', 'Research', 1, 1, 'India', 1),
(39, 'Nikky Singh', 'Telecom', 2, 1, 'USA', 1),
(40, 'Priyanka Singla', 'Marketing', 2, 2, 'India', 1),
(41, 'Tam Peters', 'IT', 1, 2, 'Germany', 1),
(42, 'Kat Jackson', 'Pharma', 2, 1, 'USA', 1),
(43, 'Sarita Jain', 'Research', 2, 1, 'India', 1),
(44, 'Andrew Peters', 'Marketing', 1, 1, 'India', 1),
(45, 'Samarth Bansal', 'IT', 2, 1, 'USA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quote_request`
--

CREATE TABLE `quote_request` (
  `id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `project_details` text NOT NULL,
  `quote_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0:pending,1:confirm'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quote_request`
--

INSERT INTO `quote_request` (`id`, `expert_id`, `client_name`, `email`, `project_details`, `quote_date`, `status`) VALUES
(1, 3, 'n', 'n', 'n', '2019-08-10 09:17:56', 0),
(2, 3, 'raj', 'raj@gmail.com', 'bbnb', '2019-08-10 10:33:11', 0),
(3, 3, 'raj', 'raj@gmail.com', 'bbnb', '2019-08-10 10:46:38', 0),
(4, 12, 'KimT', 'KimT@gmail.com', 'KimT', '2019-08-10 11:03:52', 0),
(5, 11, 'Tim ', 'Tim@gmail.com', 'Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim Tim ', '2019-08-10 11:54:29', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `experts`
--
ALTER TABLE `experts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_request`
--
ALTER TABLE `quote_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `experts`
--
ALTER TABLE `experts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `quote_request`
--
ALTER TABLE `quote_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
