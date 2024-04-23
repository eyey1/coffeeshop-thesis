-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 09:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeeshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `cartID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_datetime` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `customerid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcartitem`
--

CREATE TABLE `tblcartitem` (
  `cartitemID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_datetime` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `cartid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory_inventory`
--

CREATE TABLE `tblcategory_inventory` (
  `categoryInventory_id` int(11) NOT NULL,
  `inventory_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory_inventory`
--

INSERT INTO `tblcategory_inventory` (`categoryInventory_id`, `inventory_category`) VALUES
(1, 'Sweetener'),
(2, 'Coffee Bean'),
(3, 'Milk'),
(4, 'Sinker'),
(5, 'Disposable'),
(6, 'Toppings'),
(7, 'Flavor');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory_product`
--

CREATE TABLE `tblcategory_product` (
  `categoryProduct_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory_product`
--

INSERT INTO `tblcategory_product` (`categoryProduct_id`, `category`) VALUES
(1, 'americano'),
(2, 'brewed'),
(3, 'frappe'),
(4, 'espresso'),
(5, 'latte'),
(6, 'cappuccino');

-- --------------------------------------------------------

--
-- Table structure for table `tblcoffeeshop`
--

CREATE TABLE `tblcoffeeshop` (
  `coffeeshopid` int(11) NOT NULL,
  `shopname` varchar(255) NOT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `employees_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcoffeeshop`
--

INSERT INTO `tblcoffeeshop` (`coffeeshopid`, `shopname`, `branch`, `address`, `contact_no`, `email`, `employees_id`) VALUES
(1, 'Only Coffee', 'Legarda Manila ', '2255 Legarda St, Sampaloc, 1008 Metro Manila', '09156351463', 'onlycoffee@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE `tblcustomers` (
  `customerid` int(11) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `contactnumber` varchar(13) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`customerid`, `customername`, `contactnumber`, `email`, `address`) VALUES
(2, 'Edie shing', '09123123123', 'edi@gmail.com', 'doon lang'),
(3, 'Mang kanor', '09222222222', 'Testemail@mailinator.com', 'testaddress'),
(4, 'Megan old', '09222222222', 'Testemail14@mailinator.com', 'testaddress'),
(5, 'Andrew E', '09222222222', 'Testemail@mailinator.com', 'testaddress');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `employeeID` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `position` varchar(255) NOT NULL DEFAULT 'guest',
  `hiredate` date NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`employeeID`, `firstname`, `lastname`, `email`, `position`, `hiredate`, `username`, `password`) VALUES
(2, 'Thomas', 'Gallardo', '', 'barista', '2023-09-12', 'samtim', 'test123'),
(7, '', '', '', '', '0000-00-00', '', ''),
(9, '', '', '', '', '0000-00-00', '', ''),
(12, '', '', '', '', '0000-00-00', '', ''),
(22, 'Sendo', 'Galang', 'sendo@gmail.com', 'admin', '2024-04-21', 'test', '$2y$10$vd6OH21OY7cDOiYQXIW0zevs7hDYGhmXnjMNP3ONyhO0I2yZNuDva'),
(23, 'test', 'test', 'test@gmail.com', 'guest', '2024-04-27', 'test', '$2y$10$dfYfuS8LfSpBLH/U2OpltumqdhwNayyijVffHKpl499lPXRM2WPve');

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `feedbackid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `feedback_desc` text DEFAULT NULL,
  `feedback_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `customerid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblfeedback`
--

INSERT INTO `tblfeedback` (`feedbackid`, `title`, `feedback_desc`, `feedback_datetime`, `customerid`) VALUES
(9, 'test', 'testttt', '2024-04-21 01:31:53', 22),
(10, 'test', 'testtt', '2024-04-21 01:32:32', 22),
(11, 'test', 'testtt', '2024-04-21 03:14:14', 22),
(12, 'test', 'testttttt', '2024-04-21 03:14:19', 22),
(13, 'test', 'testtt', '2024-04-21 03:14:23', 22),
(14, 'aws', 'aws', '2024-04-21 03:16:16', 23),
(15, 'aws', 'aws', '2024-04-21 03:16:20', 23);

-- --------------------------------------------------------

--
-- Table structure for table `tblinventory`
--

CREATE TABLE `tblinventory` (
  `inventory_id` int(11) NOT NULL,
  `inventory_item` varchar(255) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblinventory`
--

INSERT INTO `tblinventory` (`inventory_id`, `inventory_item`, `item_type`, `quantity`, `unit`) VALUES
(3, 'Powdered Sugar', 'Sweetener', 10, 'bags'),
(4, 'Arrabica Coffee Bean', 'Coffee Bean', 10, 'bags'),
(5, 'Liberica Coffee Bean', 'Coffee Bean', 10, 'bags'),
(6, 'Oat Milk', 'Milk', 10, 'Gallons'),
(7, 'Soy Milk', 'Milk', 10, 'Gallons'),
(8, 'Pearls', 'Sinker', 10, 'packs'),
(9, 'Nata De Coco', 'Sinker', 10, 'packs'),
(10, 'Small Cups', 'Disposable', 20, 'packs'),
(11, 'Straws', 'Disposable', 20, 'packs'),
(12, 'Cream', 'Toppings', 10, 'cans'),
(13, 'Marshmallows', 'Toppings', 10, 'packs'),
(14, 'Caramel', 'Flavor', 10, 'bottles'),
(15, 'Matcha', 'Flavor', 12, 'bottles'),
(16, 'Oreo', 'Flavor', 12, 'packs');

-- --------------------------------------------------------

--
-- Table structure for table `tblorderitem`
--

CREATE TABLE `tblorderitem` (
  `orderitem_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` enum('active','completed','ended') NOT NULL,
  `orderid` int(11) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorderitem`
--

INSERT INTO `tblorderitem` (`orderitem_id`, `quantity`, `status`, `orderid`, `productid`) VALUES
(1, 2, 'active', 1, 17),
(2, 1, 'active', 1, 7),
(3, 3, 'active', 1, 21),
(4, 5, 'completed', 2, 15),
(5, 2, 'completed', 2, 17),
(6, 1, 'completed', 5, 16),
(7, 2, 'completed', 5, 10),
(8, 2, 'completed', 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `order_id` int(11) NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `order_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `base_coffee_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`order_id`, `order_type`, `order_datetime`, `base_coffee_id`, `customer_id`) VALUES
(1, 'take-out', '2023-11-09 15:26:34', 0, 2),
(2, 'dine-in', '2023-11-09 15:26:34', 0, 3),
(5, 'take-out', '2023-11-09 16:43:45', 0, 5),
(8, 'take-out', '2023-11-09 15:28:03', 0, 2),
(10, 'dine-in', '2023-11-09 15:28:03', 0, 4),
(70, 'take-out', '2024-04-20 17:37:28', 11, 9),
(71, 'take-out', '2024-04-20 17:37:28', 17, 9),
(72, 'take-out', '2024-04-20 17:38:13', 11, 9),
(73, 'take-out', '2024-04-20 17:38:13', 16, 9),
(74, 'take-out', '2024-04-20 18:06:20', 7, 9),
(75, 'take-out', '2024-04-20 18:07:41', 11, 9),
(76, 'take-out', '2024-04-20 18:07:41', 11, 9),
(77, 'take-out', '2024-04-20 18:07:41', 17, 9),
(78, 'take-out', '2024-04-20 22:53:01', 69, 9),
(79, 'take-out', '2024-04-20 22:53:16', 69, 9),
(80, 'take-out', '2024-04-20 22:54:19', 69, 9),
(81, 'take-out', '2024-04-20 22:54:19', 16, 9),
(82, 'take-out', '2024-04-20 22:54:19', 16, 9),
(83, 'take-out', '2024-04-20 22:54:19', 21, 9),
(84, 'take-out', '2024-04-20 22:54:20', 69, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `paymentID` int(100) NOT NULL,
  `order_datetime` datetime NOT NULL,
  `amountpayed` decimal(10,2) NOT NULL,
  `paymenttype` varchar(50) NOT NULL,
  `customerid` int(11) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`paymentID`, `order_datetime`, `amountpayed`, `paymenttype`, `customerid`, `orderid`) VALUES
(2, '2023-11-09 16:39:07', '500.00', 'Cash', 2, 1),
(7, '2023-11-09 16:39:07', '500.00', 'Cash', 2, 1),
(9, '2023-11-09 16:37:27', '500.00', 'Cash', 2, 2),
(11, '2023-11-09 16:38:21', '500.00', 'Cash', 2, 2),
(76, '2023-11-10 11:26:03', '2500.00', 'Cash', 3, 5),
(99, '2023-11-10 11:26:03', '550.00', 'Cash', 2, 2),
(100, '2023-11-10 16:39:07', '500.00', 'Cash', NULL, NULL),
(101, '2023-11-10 16:39:07', '500.00', 'Cash', NULL, NULL),
(102, '2023-11-11 16:37:27', '500.00', 'Cash', NULL, NULL),
(103, '2023-11-11 16:38:21', '500.00', 'Cash', NULL, NULL),
(104, '2023-11-12 11:26:03', '2500.00', 'Cash', NULL, NULL),
(105, '2023-11-12 11:26:03', '550.00', 'Cash', NULL, NULL),
(106, '2023-11-13 16:39:07', '500.00', 'Cash', NULL, NULL),
(107, '2023-11-13 16:39:07', '500.00', 'Cash', NULL, NULL),
(108, '2023-11-14 16:37:27', '500.00', 'Cash', NULL, NULL),
(109, '2023-11-14 16:38:21', '500.00', 'Cash', NULL, NULL),
(110, '2023-11-15 11:26:03', '2500.00', 'Cash', NULL, NULL),
(111, '2023-11-15 11:26:03', '550.00', 'Cash', NULL, NULL),
(112, '2023-10-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(113, '2023-10-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(114, '2023-10-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(115, '2023-10-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(116, '2023-10-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(117, '2023-10-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(118, '2023-10-03 11:26:03', '550.00', 'Cash', NULL, NULL),
(119, '2023-10-03 11:26:03', '550.00', 'Cash', NULL, NULL),
(120, '2023-10-04 11:26:03', '550.00', 'Cash', NULL, NULL),
(121, '2023-10-04 11:26:03', '550.00', 'Cash', NULL, NULL),
(122, '2023-10-04 11:26:03', '550.00', 'Cash', NULL, NULL),
(123, '2023-09-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(124, '2023-09-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(125, '2023-09-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(126, '2023-09-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(127, '2023-09-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(128, '2023-09-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(129, '2023-09-03 11:26:03', '550.00', 'Cash', NULL, NULL),
(130, '2023-09-03 11:26:03', '550.00', 'Cash', NULL, NULL),
(131, '2023-09-04 11:26:03', '550.00', 'Cash', NULL, NULL),
(132, '2023-09-04 11:26:03', '550.00', 'Cash', NULL, NULL),
(133, '2023-09-05 11:26:03', '550.00', 'Cash', NULL, NULL),
(134, '2023-08-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(135, '2023-08-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(136, '2023-08-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(137, '2023-08-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(138, '2023-08-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(139, '2023-08-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(140, '2023-08-03 11:26:03', '550.00', 'Cash', NULL, NULL),
(141, '2023-08-03 11:26:03', '550.00', 'Cash', NULL, NULL),
(142, '2023-08-04 11:26:03', '550.00', 'Cash', NULL, NULL),
(143, '2023-08-04 11:26:03', '550.00', 'Cash', NULL, NULL),
(144, '2023-08-05 11:26:03', '550.00', 'Cash', NULL, NULL),
(145, '2023-07-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(146, '2023-07-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(147, '2023-07-01 11:26:03', '550.00', 'Cash', NULL, NULL),
(148, '2023-07-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(149, '2023-07-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(150, '2023-07-02 11:26:03', '550.00', 'Cash', NULL, NULL),
(151, '2023-07-03 11:26:03', '550.00', 'Cash', NULL, NULL),
(152, '2023-07-03 11:26:03', '550.00', 'Cash', NULL, NULL),
(153, '2023-07-04 11:26:03', '550.00', 'Cash', NULL, NULL),
(154, '2023-07-04 11:26:03', '550.00', 'Cash', NULL, NULL),
(155, '2023-07-05 11:26:03', '550.00', 'Cash', NULL, NULL),
(156, '2025-12-25 04:29:00', '10.00', 'Card', 2, 2),
(159, '2023-11-16 22:36:42', '130.00', 'Card', 3, 8),
(160, '2023-11-16 22:36:42', '111.11', 'Card', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`product_id`, `product_name`, `product_description`, `price`, `image`, `status`, `category`) VALUES
(7, 'Salted Caramel Cold Breww', 'a salted caramel coffee that is brewed colddss', '130.00', 'ss.jpg', NULL, 'brewed'),
(10, 'Vanilla Cream Frappe', 'A coffee that is frapped with vanilla cream', '200.00', NULL, NULL, 'frappe'),
(11, 'Iced Americano', 'A coffee that is americanized with ice', '100.00', NULL, NULL, 'frappe'),
(15, 'Iced White Chocolate mocha', 'A white chocolate flavored coffee with ice and mocha', '200.00', NULL, NULL, 'espresso'),
(16, 'Espresso Machiato', 'A expressed coffee with macchiato', '200.00', NULL, NULL, 'espresso'),
(17, 'Iced caffe latte', 'a coffee with ice and latted', '130.00', NULL, NULL, 'latte'),
(21, 'Iced Special Cappuccinoo', 'a coffee with ice and cappucinized but its special', '130.00', 'ss.jpg', NULL, 'cappuccino'),
(69, 'dawd', 'awdawdawd', '1111.00', '1x1 (Small).jpg', NULL, 'latte');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts_inventory`
--

CREATE TABLE `tblproducts_inventory` (
  `productsInventory_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpromo`
--

CREATE TABLE `tblpromo` (
  `promoid` int(11) NOT NULL,
  `promoname` varchar(255) NOT NULL,
  `promodesc` text DEFAULT NULL,
  `promocode` varchar(20) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpromo`
--

INSERT INTO `tblpromo` (`promoid`, `promoname`, `promodesc`, `promocode`, `value`, `startdate`, `enddate`) VALUES
(1, '50% off', 'minus 50% off purchases', 'SINKWENTY', '0.50', '2024-01-01', '2024-01-31'),
(2, 'Free Upsize', 'free upsize of minimum spent of 500 php', 'FREEUP', '0.00', '2024-02-11', '2024-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(11) NOT NULL DEFAULT 'guest',
  `date_of_registration` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `customer_name`, `email`, `username`, `password`, `role`, `date_of_registration`) VALUES
(9, 'Sendo', 'sendo@gmail.com', 'xdo123', '$2y$10$bUqmv08S7XMeHV4DZ2NSDuucG9p7BwM3RtCgpzyHHeC8vTx7dq2am', 'guest', '2024-03-29 12:44:03'),
(10, 'Sendo Galang', 'odnes@gmail.com', 'sendo123', '$2y$10$ks2bC7Ez3Oc1SqICfCbylu1gg/w28jWoNYnDfo0MYDTGpbYfrVjmO', 'admin', '2024-03-29 12:46:02'),
(11, 'Jeffel Madula', 'jeffel@example.com', 'jeffel123', '$2y$10$3CJVRwaRV8SJA5sSAd4gaOMmY9eTc4TP9n4pMh.fMhOmpcdABYHMa', 'admin', '2024-03-29 12:49:51'),
(12, 'Kurby', 'kurby@gmail.com', 'kurby', '$2y$10$68yUATYNr5N94obo7QyQleqhmQQFbP8tZDexM.V23uLfmYTA8QcAG', 'guest', '2024-03-29 12:53:59'),
(13, 'Test', 'test@gmail.com', 'test123', '$2y$10$qca.TQG9r3Swm1ukUB09i.rC5bD0nd8i4sTPuxsJolMMH2gXcijXe', 'guest', '2024-03-29 13:31:17'),
(14, 'Test', 'kurtdiestro@gmail.com', 'test', '$2y$10$sZa1.2aH0aCzEOJyctWICuKMuAEDgVN2Mhu/LHCqDgQdStm2Kwore', 'guest', '2024-03-29 13:32:07'),
(15, 'example', 'example@gmail.com', 'example', '$2y$10$1eMXin60acXoNAEjl4Jn2eCyCjTbXqgUb3f62fOvuScH83DVKWu0u', 'guest', '2024-04-07 14:26:29'),
(16, 'Test', 'sendo1111@gmail.com', 'test', '$2y$10$48rdsHHNsvQzm4oZQC7LrOOycyKfTTcMGCxnJdTsjRSIX6ghQx.i.', 'guest', '2024-04-20 11:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbluserlogs`
--

CREATE TABLE `tbluserlogs` (
  `logid` int(11) NOT NULL,
  `log_datetime` datetime NOT NULL,
  `loginfo` varchar(255) NOT NULL,
  `employeeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluserlogs`
--

INSERT INTO `tbluserlogs` (`logid`, `log_datetime`, `loginfo`, `employeeid`) VALUES
(1, '2024-01-11 18:17:02', 'testtest has logged in', 12),
(2, '2024-01-11 18:01:09', 'testtest has logged in', 12),
(3, '2024-01-11 18:21:33', 'testtest has logged in', 12),
(4, '2024-01-12 01:31:21', 'testtest has logged in', 12),
(5, '2024-01-12 01:32:07', 'samtim has logged in', 2),
(6, '2024-01-12 01:32:18', 'enrik has logged in', 7),
(7, '2024-01-12 01:40:38', 'test has logged in.', 9),
(8, '2024-01-12 01:43:24', 'testtest has logged in.', 12),
(9, '2024-01-12 01:44:41', 'testtest has logged out.', 12),
(10, '2024-01-12 01:45:04', 'enrik has logged in.', 7),
(11, '2024-01-12 01:45:08', 'enrik has logged out.', 7),
(12, '2024-01-12 01:46:39', 'testtest has logged in.', 12),
(13, '2024-01-12 01:48:15', 'testtest has edited coffeeshop information.', 12),
(14, '2024-01-12 02:08:18', 'testtest has added a new product.', 12),
(15, '2024-01-12 02:08:28', 'testtest has edited a product.', 12),
(16, '2024-01-12 02:08:37', 'testtest has inserted ingredients for a product.', 12),
(17, '2024-01-12 02:08:41', 'testtest has reset a product ingredients.', 12),
(18, '2024-01-12 02:09:05', 'testtest has added a new promo.', 12),
(19, '2024-01-12 02:09:12', 'testtest has edited a promo.', 12),
(20, '2024-01-12 02:09:15', 'testtest has deleted a promo.', 12),
(21, '2024-01-12 02:09:21', 'testtest has added a new product category.', 12),
(22, '2024-01-12 02:09:27', 'testtest has edited a product category.', 12),
(23, '2024-01-12 02:09:31', 'testtest has deleted a product category.', 12),
(24, '2024-01-12 09:51:55', 'testtest has added a new employee.', 12),
(25, '2024-01-12 09:52:14', 'testtest has edited an employee information.', 12),
(26, '2024-01-12 09:53:17', 'testtest has added a new employee.', 12),
(27, '2024-01-12 09:53:29', 'testtest has edited an employee information.', 12),
(28, '2024-01-12 09:53:36', 'testtest has deleted a employee.', 12),
(29, '2024-01-12 09:59:23', 'testtest has archived an order.', 12),
(30, '2024-01-12 09:59:26', 'testtest has unarchived an order.', 12),
(31, '2024-01-12 09:59:27', 'testtest has completed an order.', 12),
(32, '2024-01-12 10:07:34', 'testtest has added a new inventory item.', 12),
(33, '2024-01-12 10:07:39', 'testtest has edited an inventory item.', 12),
(34, '2024-01-12 10:07:42', 'testtest has deleted an inventory item.', 12),
(35, '2024-01-12 10:07:50', 'testtest has updated all inventory quantity.', 12),
(50, '2024-01-12 10:08:01', 'testtest has deleted an inventory category.', 12),
(51, '2024-01-12 10:08:06', 'testtest has added a new inventory category.', 12),
(52, '2024-01-12 10:08:09', 'testtest has edited an inventory category.', 12),
(53, '2024-01-12 10:08:13', 'testtest has deleted an inventory category.', 12),
(54, '2024-01-12 10:10:37', 'testtest has updated all inventory quantity.', 12),
(55, '2024-01-27 15:03:33', 'testtest has logged out.', 12),
(56, '2024-01-27 15:05:31', 'testtest has logged in.', 12),
(57, '2024-01-27 15:06:07', 'testtest has updated all inventory quantity.', 12),
(58, '2024-01-27 15:06:30', 'testtest has updated all inventory quantity.', 12),
(59, '2024-01-27 15:06:39', 'testtest has edited an inventory item.', 12),
(60, '2024-01-27 15:08:05', 'testtest has added a new inventory category.', 12),
(61, '2024-01-27 15:08:16', 'testtest has deleted an inventory category.', 12),
(62, '2024-01-27 15:31:39', 'testtest has completed an order.', 12),
(63, '2024-01-27 15:31:43', 'testtest has completed an order.', 12),
(64, '2024-01-27 15:38:21', 'testtest has inserted ingredients for a product.', 12),
(65, '2024-01-27 15:38:21', 'testtest has inserted ingredients for a product.', 12),
(66, '2024-01-27 15:38:21', 'testtest has inserted ingredients for a product.', 12),
(67, '2024-01-27 15:38:21', 'testtest has inserted ingredients for a product.', 12),
(68, '2024-01-27 15:38:21', 'testtest has inserted ingredients for a product.', 12),
(69, '2024-01-27 15:38:52', 'testtest has reset a product ingredients.', 12),
(70, '2024-01-27 15:39:04', 'testtest has deleted a product.', 12),
(71, '2024-01-27 17:25:12', 'testtest has logged out.', 12),
(72, '2024-01-27 17:26:14', 'testtest has logged in.', 12),
(73, '2024-01-27 17:30:36', 'testtest has archived an order.', 12),
(74, '2024-01-27 17:30:45', 'testtest has unarchived an order.', 12),
(75, '2024-01-27 17:30:51', 'testtest has unarchived an order.', 12),
(76, '2024-01-27 17:31:01', 'testtest has completed an order.', 12),
(77, '2024-01-27 17:33:17', 'testtest has added a new inventory category.', 12),
(78, '2024-01-27 17:33:26', 'testtest has deleted an inventory category.', 12),
(79, '2024-01-27 17:33:58', 'testtest has updated all inventory quantity.', 12),
(80, '2024-01-27 17:34:05', 'testtest has updated all inventory quantity.', 12),
(81, '2024-01-27 17:39:55', 'testtest has logged out.', 12),
(82, '2024-01-27 17:40:59', 'samtim has logged in.', 2),
(83, '2024-01-27 17:41:04', 'samtim has logged out.', 2),
(84, '2024-01-27 17:41:23', 'samtim has logged in.', 2),
(85, '2024-01-27 17:41:46', 'samtim has logged out.', 2),
(86, '2024-01-27 17:41:57', 'test has logged in.', 9),
(87, '2024-01-27 17:42:02', 'test has logged out.', 9),
(88, '2024-01-27 17:42:38', 'testtest has logged in.', 12),
(89, '2024-01-27 17:42:50', 'testtest has logged out.', 12),
(90, '2024-01-30 11:22:37', 'testtest has logged in.', 12),
(91, '2024-01-30 12:13:44', 'testtest has logged out.', 12),
(92, '2024-01-30 12:14:01', 'testtest has logged in.', 12),
(93, '2024-01-30 19:19:58', 'testtest has logged in.', 12),
(94, '2024-01-30 19:20:26', 'testtest has added a new inventory item.', 12),
(95, '2024-01-30 19:20:32', 'testtest has deleted an inventory item.', 12),
(96, '2024-01-30 19:20:35', 'testtest has deleted an inventory item.', 12),
(97, '2024-01-30 19:38:43', 'testtest has reset a product ingredients.', 12),
(98, '2024-01-30 19:38:43', 'testtest has deleted a product.', 12);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `tblcartitem`
--
ALTER TABLE `tblcartitem`
  ADD PRIMARY KEY (`cartitemID`),
  ADD KEY `productid` (`productid`),
  ADD KEY `cartid` (`cartid`);

--
-- Indexes for table `tblcategory_inventory`
--
ALTER TABLE `tblcategory_inventory`
  ADD PRIMARY KEY (`categoryInventory_id`);

--
-- Indexes for table `tblcategory_product`
--
ALTER TABLE `tblcategory_product`
  ADD PRIMARY KEY (`categoryProduct_id`);

--
-- Indexes for table `tblcoffeeshop`
--
ALTER TABLE `tblcoffeeshop`
  ADD PRIMARY KEY (`coffeeshopid`),
  ADD KEY `employees_id` (`employees_id`);

--
-- Indexes for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`employeeID`) USING BTREE;

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`feedbackid`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `tblinventory`
--
ALTER TABLE `tblinventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `tblorderitem`
--
ALTER TABLE `tblorderitem`
  ADD PRIMARY KEY (`orderitem_id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `orderid` (`orderid`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tblproducts_inventory`
--
ALTER TABLE `tblproducts_inventory`
  ADD PRIMARY KEY (`productsInventory_id`),
  ADD KEY `tblproducts_inventory_idfk_1` (`products_id`),
  ADD KEY `tblproducts_inventory_idfk_2` (`inventory_id`);

--
-- Indexes for table `tblpromo`
--
ALTER TABLE `tblpromo`
  ADD PRIMARY KEY (`promoid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluserlogs`
--
ALTER TABLE `tbluserlogs`
  ADD PRIMARY KEY (`logid`),
  ADD KEY `employeeid` (`employeeid`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcartitem`
--
ALTER TABLE `tblcartitem`
  MODIFY `cartitemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcategory_inventory`
--
ALTER TABLE `tblcategory_inventory`
  MODIFY `categoryInventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tblcategory_product`
--
ALTER TABLE `tblcategory_product`
  MODIFY `categoryProduct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblcoffeeshop`
--
ALTER TABLE `tblcoffeeshop`
  MODIFY `coffeeshopid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `feedbackid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblinventory`
--
ALTER TABLE `tblinventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblorderitem`
--
ALTER TABLE `tblorderitem`
  MODIFY `orderitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `paymentID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tblproducts_inventory`
--
ALTER TABLE `tblproducts_inventory`
  MODIFY `productsInventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tblpromo`
--
ALTER TABLE `tblpromo`
  MODIFY `promoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbluserlogs`
--
ALTER TABLE `tbluserlogs`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD CONSTRAINT `tblcart_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `tblcustomers` (`customerid`);

--
-- Constraints for table `tblcartitem`
--
ALTER TABLE `tblcartitem`
  ADD CONSTRAINT `tblcartitem_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `tblproducts` (`product_id`),
  ADD CONSTRAINT `tblcartitem_ibfk_2` FOREIGN KEY (`cartid`) REFERENCES `tblcart` (`cartID`);

--
-- Constraints for table `tblcoffeeshop`
--
ALTER TABLE `tblcoffeeshop`
  ADD CONSTRAINT `tblcoffeeshop_ibfk_1` FOREIGN KEY (`employees_id`) REFERENCES `tblemployees` (`employeeID`);

--
-- Constraints for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD CONSTRAINT `FK_tblfeedback_tbluser` FOREIGN KEY (`customerid`) REFERENCES `tblemployees` (`employeeID`);

--
-- Constraints for table `tblorderitem`
--
ALTER TABLE `tblorderitem`
  ADD CONSTRAINT `tblorderitem_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `tblorders` (`order_id`),
  ADD CONSTRAINT `tblorderitem_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `tblproducts` (`product_id`);

--
-- Constraints for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD CONSTRAINT `tblpayment_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `tblcustomers` (`customerid`),
  ADD CONSTRAINT `tblpayment_ibfk_2` FOREIGN KEY (`orderid`) REFERENCES `tblorders` (`order_id`);

--
-- Constraints for table `tblproducts_inventory`
--
ALTER TABLE `tblproducts_inventory`
  ADD CONSTRAINT `tblproducts_inventory_idfk_1` FOREIGN KEY (`products_id`) REFERENCES `tblproducts` (`product_id`),
  ADD CONSTRAINT `tblproducts_inventory_idfk_2` FOREIGN KEY (`inventory_id`) REFERENCES `tblinventory` (`inventory_id`);

--
-- Constraints for table `tbluserlogs`
--
ALTER TABLE `tbluserlogs`
  ADD CONSTRAINT `tbluserlogs_ibfk_2` FOREIGN KEY (`employeeid`) REFERENCES `tblemployees` (`employeeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
