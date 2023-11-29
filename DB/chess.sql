-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 02:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chess`
--

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

CREATE TABLE `administration` (
  `id` int(111) NOT NULL,
  `role` varchar(150) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `mobile` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1->Active, 0->Inactive',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '1->Deleted, 0->not deleted',
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(250) DEFAULT NULL,
  `pwd` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`id`, `role`, `username`, `mobile`, `email`, `status`, `is_deleted`, `datetime`, `password`, `pwd`) VALUES
(1, 'super_admin', 'superadmin', '9010168865', 'superadmin@gmail.com', 1, 0, '2021-03-15 12:13:28', 'MTIzNDU2', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administration`
--
ALTER TABLE `administration`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
