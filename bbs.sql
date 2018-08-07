-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2018 at 04:01 PM
-- Server version: 5.7.20-log
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_master`
--

CREATE TABLE `class_master` (
  `class_code` int(3) NOT NULL,
  `class_name` varchar(100) DEFAULT NULL,
  `sort` int(2) NOT NULL DEFAULT '0',
  `delete_flag` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_master`
--

INSERT INTO `class_master` (`class_code`, `class_name`, `sort`, `delete_flag`) VALUES
(1, 'stationary', 0, 0),
(2, 'drink', 0, 0),
(3, 'fruits', 0, 0),
(4, 'vegetables', 0, 0),
(5, 'meat', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `customer_id` int(3) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `tel` int(10) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `delete_flag` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`customer_id`, `customer_name`, `tel`, `address`, `delete_flag`) VALUES
(1, 'Yamada Taro', 11111111, 'abcdefgh', 0),
(2, 'Suzuki Ichiro', 2222222, 'ijklmnopqrs', 0),
(3, 'Sato Yoshio', 3333333, 'tuvwxyz', 0),
(4, 'Honda Yuichi', 4444444, 'Ohio ', 0),
(5, 'Yamamoto Kazuko', 555555, 'afdafsde', 0),
(6, 'Kojima Yoshio', 66666666, 'uieorewpuoewq', 0),
(7, 'hnin htet', 77777777, 'ashfoewhaoifse', 1),
(8, 'Mya', 73984, 'oiufyhoiewfn', 1);

-- --------------------------------------------------------

--
-- Table structure for table `db_bbs`
--

CREATE TABLE `db_bbs` (
  `sled_id` int(5) NOT NULL,
  `user_id` int(15) NOT NULL,
  `comment` text NOT NULL,
  `files` varchar(100) NOT NULL,
  `delete_flg` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_bbs`
--

INSERT INTO `db_bbs` (`sled_id`, `user_id`, `comment`, `files`, `delete_flg`) VALUES
(1, 2, 'hay', 'admin', 0),
(2, 3, 'delete this', 'hhhh', 0),
(3, 4, 'hello world', 'mama', 0),
(4, 2, 'hi', ' ', 0),
(5, 9, 'test1111', ' ', 1),
(6, 9, 'leader', ' ', 0),
(7, 9, 'hay', ' ', 0),
(8, 5, '', ' ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `db_group`
--

CREATE TABLE `db_group` (
  `group_id` int(2) NOT NULL,
  `group_name` varchar(20) NOT NULL,
  `delete_flg` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_group`
--

INSERT INTO `db_group` (`group_id`, `group_name`, `delete_flg`) VALUES
(1, 'training', 0),
(2, 'development', 1),
(3, 'interpreter', 1),
(4, 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `user_id` int(15) NOT NULL,
  `pw` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `admin` int(2) NOT NULL,
  `group_id` int(2) NOT NULL,
  `nyusha_date` date NOT NULL,
  `taisha_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`user_id`, `pw`, `username`, `admin`, `group_id`, `nyusha_date`, `taisha_date`) VALUES
(1, '12345', 'Su Su', 0, 1, '2016-09-16', '2016-10-31'),
(2, '12345', 'Mg Mg', 1, 2, '2016-09-16', '2016-10-31'),
(3, '12345', 'Ma Ma', 1, 3, '2016-09-16', '2016-10-31'),
(4, '6789', 'Aye Aye', 1, 2, '2016-09-16', '2016-10-31'),
(5, '12345', 'Phyu', 1, 3, '2016-08-16', '2016-10-31'),
(6, '1234', 'asdfgh', 0, 1, '2011-01-01', '2012-01-01'),
(7, '123456', 'qwety', 1, 2, '2010-01-01', '2011-01-01'),
(8, '12345', 'GGGG', 1, 3, '2011-01-01', '2012-01-01'),
(9, '123', 'ei ei', 0, 3, '2015-01-01', '2016-12-01'),
(10, '7777', 'hdhhhd', 0, 1, '2016-10-03', '2016-10-25');

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `item_code` int(3) NOT NULL,
  `class_code` int(3) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `purchase_price` int(5) NOT NULL DEFAULT '0',
  `sales_price` int(5) NOT NULL DEFAULT '0',
  `sort` int(2) NOT NULL DEFAULT '0',
  `delete_flag` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`item_code`, `class_code`, `item_name`, `purchase_price`, `sales_price`, `sort`, `delete_flag`) VALUES
(1, 1, 'pencil', 0, 50, 0, 0),
(2, 1, 'eraser', 0, 100, 0, 0),
(3, 1, 'eraser', 0, 150, 0, 0),
(4, 1, 'scissers', 0, 200, 0, 0),
(5, 3, 'mango', 0, 150, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE `sales_detail` (
  `sales_number` int(4) NOT NULL,
  `sub_number` int(2) NOT NULL,
  `item_code` int(3) NOT NULL,
  `price` int(5) DEFAULT NULL,
  `quantity` int(3) NOT NULL,
  `customer_id` int(3) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_list`
--

CREATE TABLE `sales_list` (
  `sales_number` int(4) NOT NULL,
  `customer_id` int(3) NOT NULL,
  `total_amount` int(6) NOT NULL,
  `sales_date` date NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_master`
--
ALTER TABLE `class_master`
  ADD PRIMARY KEY (`class_code`),
  ADD UNIQUE KEY `class_code` (`class_code`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `db_bbs`
--
ALTER TABLE `db_bbs`
  ADD PRIMARY KEY (`sled_id`);

--
-- Indexes for table `db_group`
--
ALTER TABLE `db_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`item_code`);

--
-- Indexes for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`sales_number`,`sub_number`);

--
-- Indexes for table `sales_list`
--
ALTER TABLE `sales_list`
  ADD PRIMARY KEY (`sales_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_master`
--
ALTER TABLE `class_master`
  MODIFY `class_code` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `customer_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `db_bbs`
--
ALTER TABLE `db_bbs`
  MODIFY `sled_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `item_code` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sales_list`
--
ALTER TABLE `sales_list`
  MODIFY `sales_number` int(4) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
