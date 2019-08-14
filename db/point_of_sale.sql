-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2019 at 08:07 PM
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
(1, 'saifrehman ', 'Arshad', '31304-2076970-8', '+92(308)-3152046', 'Chack no 145 P Adam Sahabah Rahim Yar khan', '2019-06-28 13:28:28', 1),
(4, 'Nauman', 'Hashmi', '34567-8900987-6', '+65(789)-0876546', 'ertyuiop[', '2019-07-27 08:57:44', 1);

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
(4, 'Nauman', 'Hashmi', '65435-6754324-5', '+33(234)-5345643', '32456432456', '2019-07-27 08:59:25', 1);

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
(2, 'Hivaway', 'Chinaa'),
(3, 'Hivaway', 'China'),
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
  `status` varchar(255) NOT NULL,
  `imei` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_per_purchase_invoice`
--

INSERT INTO `products_per_purchase_invoice` (`id`, `purchase_invoice_id`, `product_id`, `expiry_starting_date`, `expiry_ending_date`, `original_price`, `discount_per_item`, `purchase_price`, `sale_price`, `status`, `imei`, `created_by`, `created_at`) VALUES
(1, 27, 1, '2019-08-04', '2019-08-22', 4000, 200, 3800, 5000, 'available', '1124', 1, '2019-08-05 00:00:00'),
(2, 29, 1, '2019-08-05', '2019-08-20', 2000, 100, 1900, 2500, 'available', '1122', 1, '2019-08-05 00:00:00'),
(3, 29, 1, '2019-08-05', '2019-08-20', 2000, 100, 1900, 2500, 'available', '1122', 1, '2019-08-05 00:00:00'),
(4, 29, 1, '2019-08-05', '2019-08-20', 2000, 100, 1900, 2500, 'available', '1122', 1, '2019-08-05 00:00:00'),
(5, 29, 4, '2019-08-05', '2019-08-20', 2000, 100, 1900, 2500, 'available', '1122', 1, '2019-08-05 00:00:00');

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
(27, 3, '2019-07-23', '  Something is better than nothing........\r\n', 0, 0, 0, 0, 0, 1, '2019-07-30 07:55:17'),
(28, 3, '2019-03-07', 'comment', 0, 0, 0, 0, 0, 1, '2019-03-07 00:00:00'),
(29, 3, '2019-03-07', 'comment.......', 0, 0, 0, 0, 0, 1, '2019-03-07 00:00:00');

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
(1, 'saifrehman', 'saif', 'saifarshad.6987@gmail.com', 'Gulshan Iqbal RYK', 'uploads/IMG_20181221_084657780.jpg', '2019-06-28 09:00:00', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `distributer`
--
ALTER TABLE `distributer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products_per_purchase_invoice`
--
ALTER TABLE `products_per_purchase_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
