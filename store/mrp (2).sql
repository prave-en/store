-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 09:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrp`
--

-- --------------------------------------------------------

--
-- Table structure for table `credit_sales`
--

CREATE TABLE `credit_sales` (
  `s_no` int(250) NOT NULL,
  `customers_id` varchar(250) NOT NULL,
  `customers_detail` varchar(250) NOT NULL,
  `customers_phone` varchar(250) NOT NULL,
  `customers_email` varchar(250) NOT NULL,
  `customers_discription` varchar(250) NOT NULL,
  `credit_amount` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE `entry` (
  `s_no` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `bill_date` varchar(250) NOT NULL,
  `bill_no` varchar(250) NOT NULL,
  `suppliers_id` varchar(250) NOT NULL,
  `suppliers_detail` varchar(250) NOT NULL,
  `product_id` varchar(250) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `unit` varchar(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `free` int(250) NOT NULL,
  `cost_price` varchar(250) NOT NULL,
  `discount_percentage` varchar(250) NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `s_no` int(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bill_no` varchar(250) NOT NULL,
  `bill_date` varchar(250) NOT NULL,
  `receipt_no` varchar(250) NOT NULL,
  `receipt_date` varchar(250) NOT NULL,
  `customers_id` varchar(250) NOT NULL,
  `customers_detail` varchar(250) NOT NULL,
  `suppliers_id` varchar(250) NOT NULL,
  `suppliers_detail` varchar(250) NOT NULL,
  `debit` varchar(250) NOT NULL,
  `credit` varchar(250) NOT NULL,
  `balance` varchar(250) NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `main_login`
--

CREATE TABLE `main_login` (
  `id` int(11) NOT NULL,
  `main_username` varchar(250) NOT NULL,
  `main_password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderr`
--

CREATE TABLE `orderr` (
  `s_no` int(250) NOT NULL,
  `order_no` int(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `customers_detail` varchar(250) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `unit` varchar(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `rate` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `sum_amount` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderr1`
--

CREATE TABLE `orderr1` (
  `s_no` int(250) NOT NULL,
  `order_no` int(250) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `customers_detail` varchar(250) NOT NULL,
  `product_count` int(250) NOT NULL,
  `sum_amount` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profit_loss`
--

CREATE TABLE `profit_loss` (
  `id` int(250) NOT NULL,
  `pl_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_name` varchar(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `unit_profit` int(250) NOT NULL,
  `total_profit` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(250) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bill_no` int(250) NOT NULL,
  `bill_date` varchar(250) NOT NULL,
  `customers_detail` varchar(250) NOT NULL,
  `product_id` varchar(250) NOT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `quantity` varchar(250) DEFAULT NULL,
  `unit` varchar(250) NOT NULL,
  `mrp` varchar(250) NOT NULL,
  `discount_percentage` int(250) NOT NULL,
  `after_discount` int(250) NOT NULL,
  `total_amount` varchar(250) NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(250) NOT NULL,
  `product_id` varchar(250) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `unit` varchar(250) NOT NULL,
  `store_quantity` int(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `cost_price` varchar(250) NOT NULL,
  `selling_price` varchar(250) NOT NULL,
  `mrp` varchar(250) NOT NULL,
  `product_discription` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `s_no` int(11) NOT NULL,
  `suppliers_id` varchar(250) NOT NULL,
  `suppliers_detail` varchar(250) NOT NULL,
  `suppliers_phone` varchar(250) NOT NULL,
  `suppliers_email` varchar(250) NOT NULL,
  `suppliers_discription` varchar(250) NOT NULL,
  `due_amount` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credit_sales`
--
ALTER TABLE `credit_sales`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `main_login`
--
ALTER TABLE `main_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `orderr1`
--
ALTER TABLE `orderr1`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `profit_loss`
--
ALTER TABLE `profit_loss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`s_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credit_sales`
--
ALTER TABLE `credit_sales`
  MODIFY `s_no` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `s_no` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_login`
--
ALTER TABLE `main_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderr`
--
ALTER TABLE `orderr`
  MODIFY `s_no` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderr1`
--
ALTER TABLE `orderr1`
  MODIFY `s_no` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profit_loss`
--
ALTER TABLE `profit_loss`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
