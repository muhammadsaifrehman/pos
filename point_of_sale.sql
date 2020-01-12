-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2019 at 09:48 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `point_of_sale`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `phone_no` varchar(18) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `father_name`, `cnic`, `phone_no`, `address`, `created_at`, `created_by`) VALUES
(1, 'saif rehman ', 'Arshad', '31304-2076970-8', '+92(308)-3152046', 'Chack no 145 P Adam Sahabah Rahim Yar khan', '2019-06-28 13:28:28', 1),
(4, 'Nauman', 'Hashmi', '34567-8900987-6', '+65(789)-0876546', 'Rahim Yar khan', '2019-07-27 08:57:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `distributer`
--

CREATE TABLE `distributer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `phone_no` varchar(18) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributer`
--

INSERT INTO `distributer` (`id`, `name`, `father_name`, `cnic`, `phone_no`, `address`, `created_at`, `created_by`) VALUES
(3, 'saif', 'rehman', '31311-3131331-3', '+61(321)-31613__', 'chack no 145 ', '2019-06-29 03:30:38', 1),
(4, 'Nauman', 'Hashmi', '65435-6754324-5', '+33(234)-5345643', '32456432456', '2019-07-27 08:59:25', 1),
(5, 'saif rehman ', 'Arshad Iqbal', '3130420769710', '03083152045', 'Chack No 145 P Adam Sahaba', '2019-11-19 11:12:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(55) NOT NULL,
  `manufacturer` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `manufacturer`) VALUES
(1, 'Samsung On 5', 'SAMSUNG'),
(4, 'Hivaway', 'Chinasdfs'),
(6, 'C5', 'Samasung');

-- --------------------------------------------------------

--
-- Table structure for table `products_per_purchase_invoice`
--

CREATE TABLE `products_per_purchase_invoice` (
  `id` int(11) NOT NULL,
  `purchase_invoice_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `expiry_starting_date` date NOT NULL,
  `expiry_ending_date` date NOT NULL,
  `original_price` int(255) NOT NULL,
  `discount_per_item` int(255) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `status` enum('available','sold') NOT NULL,
  `imei` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_per_purchase_invoice`
--

INSERT INTO `products_per_purchase_invoice` (`id`, `purchase_invoice_id`, `product_id`, `expiry_starting_date`, `expiry_ending_date`, `original_price`, `discount_per_item`, `purchase_price`, `sale_price`, `status`, `imei`, `created_by`, `created_at`) VALUES
(73, 35, 4, '2019-11-14', '2019-11-14', 25000, 200, 24800, 28000, 'sold', '321', 1, '2019-11-14 04:12:21'),
(74, 35, 4, '2019-11-14', '2019-11-14', 25000, 200, 24800, 28000, 'available', '123', 1, '2019-11-14 04:12:21'),
(75, 35, 1, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'available', '321', 1, '2019-11-14 04:14:26'),
(76, 35, 1, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'sold', '987', 1, '2019-11-14 04:14:26'),
(77, 35, 1, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'available', '789', 1, '2019-11-14 04:14:26'),
(78, 35, 1, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'sold', '654', 1, '2019-11-14 04:14:26'),
(79, 35, 6, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'available', '963', 1, '2019-11-14 04:14:26'),
(80, 35, 6, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'available', '852', 1, '2019-11-14 04:14:26'),
(81, 35, 6, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'available', '741', 1, '2019-11-14 04:14:26'),
(82, 35, 6, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'available', '258', 1, '2019-11-14 04:14:26'),
(83, 35, 6, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'available', '369', 1, '2019-11-14 04:14:26'),
(84, 35, 6, '2019-11-14', '2020-04-17', 25000, 2000, 23000, 30000, 'available', '471', 1, '2019-11-14 04:14:26'),
(85, 36, 1, '2019-11-14', '2020-02-28', 15000, 1000, 14000, 25000, 'available', '345', 1, '2019-11-14 07:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice`
--

CREATE TABLE `purchase_invoice` (
  `id` int(11) NOT NULL,
  `distributer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` text NOT NULL,
  `product_discount` int(11) NOT NULL,
  `net_total_of_discount` int(11) NOT NULL,
  `discount_of_invoice` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `amount_payable` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_invoice`
--

INSERT INTO `purchase_invoice` (`id`, `distributer_id`, `date`, `comment`, `product_discount`, `net_total_of_discount`, `discount_of_invoice`, `amount_paid`, `amount_payable`, `created_by`, `created_at`) VALUES
(35, 4, '2019-11-14', 'This invoice is of the distributer Nauman Hashmi', 20400, 20400, 0, 279600, 0, 1, '2019-11-14 04:11:07'),
(36, 3, '2019-11-14', 'Nothing to show here something ', 1000, 1000, 0, 14000, 0, 1, '2019-11-14 06:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice`
--

CREATE TABLE `sale_invoice` (
  `sale_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `total_amount` int(11) NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `amount_paid` double NOT NULL,
  `remaining` double NOT NULL,
  `status` enum('Unpaid','Partially','Paid') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_invoice`
--

INSERT INTO `sale_invoice` (`sale_id`, `customer_id`, `invoice_date`, `total_amount`, `discount`, `net_total`, `amount_paid`, `remaining`, `status`, `created_by`, `created_at`) VALUES
(77, 1, '2019-11-18', 28000, 1000, 28000, 0, 27000, 'Unpaid', 1, '2019-11-18 04:15:11'),
(78, 1, '2019-11-18', 24000, 2000, 22000, 10000, 12000, 'Partially', 1, '2019-11-18 04:24:59'),
(79, 1, '2019-11-18', 27000, 1000, 26000, 2000, 24000, 'Partially', 1, '2019-11-18 04:26:56'),
(80, 1, '2019-11-18', 29000, 25000, 4000, 2000, 2000, 'Partially', 1, '2019-11-18 04:34:22'),
(81, 4, '2019-11-18', 29000, 0, 29000, 2000, 29000, 'Partially', 1, '2019-11-18 04:39:28'),
(82, 1, '2019-11-19', 30000, 3000, 27000, 27000, 0, 'Paid', 1, '2019-11-19 06:10:29'),
(83, 1, '2019-11-19', 88300, 4415, 83885, 83885, 0, 'Paid', 1, '2019-11-19 06:21:47'),
(84, 1, '2019-11-19', 56500, 1000, 55500, 55500, 0, 'Paid', 1, '2019-11-19 11:36:58'),
(85, 1, '2019-11-20', 30000, 1500, 28500, 28500, 0, 'Paid', 3, '2019-11-20 05:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice_product_details`
--

CREATE TABLE `sale_invoice_product_details` (
  `sale_invoice_detail_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `imei` int(11) NOT NULL,
  `discount_per_item` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_invoice_product_details`
--

INSERT INTO `sale_invoice_product_details` (`sale_invoice_detail_id`, `sale_id`, `product_id`, `sale_price`, `imei`, `discount_per_item`, `created_by`, `created_at`) VALUES
(97, 77, 4, 28000, 123, 0, 1, '2019-11-18 04:15:11'),
(98, 78, 1, 25000, 345, 1000, 1, '2019-11-18 04:24:59'),
(99, 79, 4, 28000, 321, 1000, 1, '2019-11-18 04:26:56'),
(100, 80, 1, 30000, 789, 1000, 1, '2019-11-18 04:34:22'),
(101, 81, 1, 30000, 987, 1000, 1, '2019-11-18 04:39:28'),
(102, 82, 1, 30000, 321, 0, 1, '2019-11-19 06:10:29'),
(103, 83, 6, 30000, 963, 200, 1, '2019-11-19 06:21:47'),
(104, 83, 6, 30000, 852, 500, 1, '2019-11-19 06:21:47'),
(105, 83, 1, 30000, 654, 1000, 1, '2019-11-19 06:21:47'),
(106, 84, 4, 28000, 321, 500, 1, '2019-11-19 11:36:58'),
(107, 84, 1, 30000, 654, 1000, 1, '2019-11-19 11:36:58'),
(108, 85, 1, 30000, 987, 0, 3, '2019-11-20 05:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `transection_details`
--

CREATE TABLE `transection_details` (
  `id` int(11) NOT NULL,
  `type` enum('sale','purchase') NOT NULL,
  `transection_date` date NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `paid_amount` double NOT NULL,
  `status` enum('Unpaid','Partially','Paid') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transection_details`
--

INSERT INTO `transection_details` (`id`, `type`, `transection_date`, `invoice_id`, `paid_amount`, `status`, `created_by`, `created_at`) VALUES
(14, 'sale', '2019-11-18', 77, 0, 'Unpaid', 1, '2019-11-18 04:15:11'),
(15, 'sale', '2019-11-18', 77, 14000, 'Partially', 1, '2019-11-18 04:15:59'),
(16, 'sale', '2019-11-18', 77, 12000, 'Partially', 1, '2019-11-18 04:16:32'),
(17, 'sale', '2019-11-18', 78, 0, 'Unpaid', 1, '2019-11-18 04:24:59'),
(18, 'sale', '2019-11-18', 78, 10000, 'Partially', 1, '2019-11-18 04:25:30'),
(19, 'sale', '2019-11-18', 79, 2000, 'Partially', 1, '2019-11-18 04:26:56'),
(20, 'sale', '2019-11-18', 80, 2000, 'Partially', 1, '2019-11-18 04:34:22'),
(21, 'sale', '2019-11-18', 80, 2000, 'Partially', 1, '2019-11-18 04:36:00'),
(22, 'sale', '2019-11-18', 81, 2000, 'Partially', 1, '2019-11-18 04:39:28'),
(23, 'sale', '2019-11-19', 82, 0, 'Unpaid', 1, '2019-11-19 06:10:29'),
(24, 'sale', '2019-11-19', 82, 2000, 'Partially', 1, '2019-11-19 06:10:59'),
(25, 'sale', '2019-11-19', 82, 10000, 'Partially', 1, '2019-11-19 06:11:32'),
(26, 'sale', '2019-11-19', 82, 10000, 'Partially', 1, '2019-11-19 06:11:50'),
(27, 'sale', '2019-11-19', 82, 5000, 'Paid', 1, '2019-11-19 06:12:01'),
(28, 'sale', '2019-11-19', 83, 5000, 'Partially', 1, '2019-11-19 06:21:47'),
(29, 'sale', '2019-11-19', 83, 20000, 'Partially', 1, '2019-11-19 06:23:08'),
(30, 'sale', '2019-11-19', 83, 30000, 'Partially', 1, '2019-11-19 06:23:19'),
(31, 'sale', '2019-11-19', 83, 28885, 'Paid', 1, '2019-11-19 06:23:31'),
(32, 'sale', '2019-11-19', 84, 20000, 'Partially', 1, '2019-11-19 11:36:58'),
(33, 'sale', '2019-11-19', 84, 10000, 'Partially', 1, '2019-11-19 11:37:27'),
(34, 'sale', '2019-11-19', 84, 25500, 'Paid', 1, '2019-11-19 11:37:37'),
(35, 'sale', '2019-11-20', 85, 0, 'Unpaid', 3, '2019-11-20 05:37:21'),
(36, 'sale', '2019-11-20', 85, 10000, 'Partially', 3, '2019-11-20 05:37:48'),
(37, 'sale', '2019-11-20', 85, 18500, 'Paid', 3, '2019-11-20 05:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `image` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `address`, `image`, `created_at`, `created_by`) VALUES
(1, 'saifrehman', 'saif', 'saifrehman.6987@gmail.com', 'army public school', 'uploads/Anas Shafqat_emp_photo.jpg', '2019-06-28 09:00:00', 1),
(2, 'saif', 'saif', 'saifrehman.6987@gmail.com', 'Chack no 145', 'uploads/pp.jpg', '2019-10-24 06:53:32', 1),
(3, 'sadaqat', 'admin', 'sadaqat@gmail.com', 'abc', 'uploads/Capture.PNG', '2019-11-11 05:42:13', 2),
(5, 'adeel', 'adeel', 'adeel@gmail.com', 'ryk', 'uploads/PicsArt_05-31-01.15.19.jpg', '2019-11-20 05:34:16', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `distributer`
--
ALTER TABLE `distributer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_per_purchase_invoice`
--
ALTER TABLE `products_per_purchase_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `purchase_invoice_id` (`purchase_invoice_id`);

--
-- Indexes for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distributer_id` (`distributer_id`);

--
-- Indexes for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sale_invoice_product_details`
--
ALTER TABLE `sale_invoice_product_details`
  ADD PRIMARY KEY (`sale_invoice_detail_id`);

--
-- Indexes for table `transection_details`
--
ALTER TABLE `transection_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `distributer`
--
ALTER TABLE `distributer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products_per_purchase_invoice`
--
ALTER TABLE `products_per_purchase_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `sale_invoice_product_details`
--
ALTER TABLE `sale_invoice_product_details`
  MODIFY `sale_invoice_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `transection_details`
--
ALTER TABLE `transection_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `distributer`
--
ALTER TABLE `distributer`
  ADD CONSTRAINT `distributer_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `products_per_purchase_invoice`
--
ALTER TABLE `products_per_purchase_invoice`
  ADD CONSTRAINT `products_per_purchase_invoice_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_per_purchase_invoice_ibfk_2` FOREIGN KEY (`purchase_invoice_id`) REFERENCES `purchase_invoice` (`id`);

--
-- Constraints for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  ADD CONSTRAINT `purchase_invoice_ibfk_1` FOREIGN KEY (`distributer_id`) REFERENCES `distributer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
