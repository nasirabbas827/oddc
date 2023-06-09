-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 04:01 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oddc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `billing_invoices`
--

CREATE TABLE `billing_invoices` (
  `invoice_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_categories`
--

CREATE TABLE `diagnostic_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnostic_categories`
--

INSERT INTO `diagnostic_categories` (`category_id`, `category_name`) VALUES
(1, 'MRI Scan22'),
(10, 'New Category'),
(11, 'Blood test 1');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `patient_email` varchar(255) DEFAULT NULL,
  `test_name` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `date_requested` date DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `reporting_time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `request_id`, `patient_name`, `patient_email`, `test_name`, `category_name`, `date_requested`, `cost`, `reporting_time`) VALUES
(1, 6, 'Ahsan', 'ahsan@gmail.com', 'New test 1', 'MRI Scan22', '2023-06-03', '25.00', '00:00:35'),
(2, 7, 'Ahsan', 'ahsan@gmail.com', 'This is New Test', 'New Category', '2023-06-03', '25.00', '00:00:35'),
(3, 8, 'Ahsan', 'ahsan@gmail.com', 'This is New Test', 'New Category', '2023-06-03', '25.00', 'Rs 35'),
(4, 10, 'Ahsan', 'ahsan@gmail.com', 'New test 1', 'MRI Scan22', '2023-06-03', '25.00', '35');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `name`, `email`, `password`, `status`) VALUES
(4, 'NASIR ABBAS', 'manager@manager.com', '$2y$10$LcpZejPg3xzMQ1tpInzpCuDypsUsPP0uhGEqJjq.gwTrRoDV8aPVi', 'approved'),
(6, 'AAmir', 'ahsan@gmail.com', '$2y$10$Mwr3Y8EDr9H0q.q0XSNOnO5dHpPxfvihaPTNs16QjUSsbCxZKsOu6', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `contactno` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `Username`, `Email`, `contactno`, `Password`) VALUES
(5, 'Ahsan', 'ahsan@gmail.com', '343', '123'),
(6, 'nasir12', 'nasir12@gmail.com', '84653645', '123');

-- --------------------------------------------------------

--
-- Table structure for table `resets`
--

CREATE TABLE `resets` (
  `id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `Expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resets`
--

INSERT INTO `resets` (`id`, `Email`, `Code`, `Expire`) VALUES
(0, 'nasiryt.827@gmail.com', '57085', 1677995687),
(0, 'nasiryt.827@gmail.com', '81583', 1677999428),
(0, 'nasiryt.827@gmail.com', '21748', 1678006153),
(0, 'nasiryt.827@gmail.com', '65658', 1678006376);

-- --------------------------------------------------------

--
-- Table structure for table `test_details`
--

CREATE TABLE `test_details` (
  `test_id` int(11) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `reporting_time` varchar(50) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_details`
--

INSERT INTO `test_details` (`test_id`, `test_name`, `category_id`, `cost`, `reporting_time`, `category_name`) VALUES
(9, 'New test 1', 1, '25.00', '35 Hours', 'MRI Scan22'),
(10, 'New test 2', 1, '25.00', '35 Hours', 'MRI Scan22'),
(11, 'This is New Test', 10, '25.00', '35 Hours', 'New Category');

-- --------------------------------------------------------

--
-- Table structure for table `test_requests`
--

CREATE TABLE `test_requests` (
  `request_id` int(11) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `test_id` int(11) NOT NULL,
  `patient_email` varchar(100) NOT NULL,
  `patient_contactno` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_requested` date NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `reporting_time` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_requests`
--

INSERT INTO `test_requests` (`request_id`, `patient_name`, `test_id`, `patient_email`, `patient_contactno`, `status`, `date_requested`, `test_name`, `cost`, `reporting_time`, `category_id`, `category_name`) VALUES
(10, 'Ahsan', 9, 'ahsan@gmail.com', '343', 'Approved', '2023-06-03', 'New test 1', '25.00', 35, 1, 'MRI Scan22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_invoices`
--
ALTER TABLE `billing_invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `diagnostic_categories`
--
ALTER TABLE `diagnostic_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_details`
--
ALTER TABLE `test_details`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `test_requests`
--
ALTER TABLE `test_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_invoices`
--
ALTER TABLE `billing_invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `diagnostic_categories`
--
ALTER TABLE `diagnostic_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test_details`
--
ALTER TABLE `test_details`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `test_requests`
--
ALTER TABLE `test_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_invoices`
--
ALTER TABLE `billing_invoices`
  ADD CONSTRAINT `billing_invoices_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `billing_invoices_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `test_details` (`test_id`);

--
-- Constraints for table `test_details`
--
ALTER TABLE `test_details`
  ADD CONSTRAINT `test_details_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `diagnostic_categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
