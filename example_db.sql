-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 05:11 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id_address` int(11) NOT NULL,
  `build` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'อาคาร/ห้อง',
  `home_number` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'บ้านเลขที่',
  `village` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หมู่ที่',
  `road` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ถนน',
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ตำบล',
  `amphur` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'อำเภอ',
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'จังหวัด',
  `zipcode` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสไปรษณีย์',
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id_address`, `build`, `home_number`, `village`, `road`, `district`, `amphur`, `province`, `zipcode`, `member_id`) VALUES
(1, 'ฟหก', '377/1-2', '12', 'kumlungek 2v', 'Tambon Amphoe Mueang', 'Amphoe Sung Noen', 'Nakhon Ratchasima', '30170', 8),
(4, 'aaaaa', 'ddd', 'asca', 'sasc', 'asca', 'asc', 'as', 'sss', 8);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อจริง',
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'นามสกุล',
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'อีเมล',
  `gender` int(11) DEFAULT NULL COMMENT 'เพศ [1: ชาย, 2: หญิง]',
  `birthday` date DEFAULT NULL COMMENT 'วันเกิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `lastname`, `phone`, `email`, `gender`, `birthday`) VALUES
(5, 'fdfgdfg', 'dffgdfg', '55555555', '0844726400', 1, '2020-01-01'),
(8, 'คณาพล', 'อมรรัตนเกศ', '844726400', 'kanaphol@sut.ac.th', 1, '2007-08-08'),
(9, 'Test2', 'ฟฟฟฟฟฟฟฟฟฟ', '844726400', '249016@sut.ac.th', 1, '1989-08-08'),
(10, 'คณาพล', 'อมรรัตนเกศ', '844726400', 'kanaphol@sut.ac.th', 2, '2018-08-06'),
(11, 'Test2', 'ฟฟฟฟฟฟฟฟฟฟ', '844726400', '249016@sut.ac.th', 1, '1989-08-08'),
(12, 'ssssss', 'dddddd', '555555', '249016@sut.ac.th', 2, '2018-08-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id_address`,`member_id`),
  ADD KEY `fk_address_member_idx` (`member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_member` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
