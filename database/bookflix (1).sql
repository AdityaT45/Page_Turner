-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 11:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE `book_info` (
  `bid` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`bid`, `name`, `author`, `price`, `category`, `image`, `description`, `date`) VALUES
(1, 'Agnes', 'Anne Bronte', 500, 'Novel', 'Agnes.jpg', '', '2024-04-03 20:10:02'),
(2, 'Atomic Habits', 'James C', 699, 'Knowledge', 'AtomicHabits.png', '', '2024-04-09 22:23:42'),
(3, 'Darwin', 'Darwin D', 799, 'Knowledge', 'Darwins-Doubt.jpg', '', '2024-04-09 22:24:58'),
(4, 'Capture The Crown ', 'Jennifer E.', 633, 'Magical', 'CaptureTheCrown.jpg', '', '2024-04-09 22:25:39'),
(5, 'Crush The King ', 'Jennifer L', 566, 'Knowledge', 'CrushTheKing.jpg', '', '2024-04-09 22:26:30'),
(6, 'Agnipankh', 'Dr.APJ Abdul Kalam', 999, 'Novel', 'agnipankh.jpg', '', '2024-04-09 22:28:42'),
(7, 'Stephen King', 'Carre', 455, 'Adventure', 'StephenKing.jpg', '', '2024-04-09 22:29:33'),
(8, 'Chhawa', 'Shivaji Sawant', 499, 'Novel', 'ChhawaBook.jpg', '', '2024-04-09 22:30:55'),
(9, 'The Winter King', 'Christ C', 65, 'Knowledge', 'TheWinterKing.jpg', '', '2024-04-09 22:32:08'),
(10, 'Ray Bearer', 'Jordan I', 999, 'Magical', 'RayBearer.jpg', '', '2024-04-09 22:37:05'),
(11, 'Love Boat', 'Abile Hing', 499, 'Adventure', 'LoveBoat.jpg', '', '2024-04-09 22:40:40'),
(12, 'india', 'yash pawar', 1900, 'Knowledge', 'india.jpg', 'Timepass', '2024-04-25 18:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `book_id` int(20) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  `total` double(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `book_id`, `user_id`, `name`, `price`, `image`, `quantity`, `total`, `date`) VALUES
(4, 11, 3, 'Love Boat', 499, 'LoveBoat.jpg', 1, 499.00, '2024-04-25 16:18:12'),
(5, 8, 3, 'Chhawa', 499, 'ChhawaBook.jpg', 1, 499.00, '2024-04-25 16:18:50'),
(6, 3, 3, 'Darwin', 799, 'Darwins-Doubt.jpg', 1, 799.00, '2024-04-25 17:43:02'),
(7, 2, 3, 'Atomic Habits', 699, 'AtomicHabits.png', 1, 699.00, '2024-04-25 17:50:21'),
(8, 6, 5, 'Agnipankh', 999, 'agnipankh.jpg', 1, 999.00, '2024-04-25 21:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `confirm_order`
--

CREATE TABLE `confirm_order` (
  `order_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(12) NOT NULL,
  `address` varchar(500) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `total_books` varchar(500) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `payment_status` varchar(30) NOT NULL DEFAULT 'PENDING',
  `date` varchar(20) NOT NULL,
  `total_price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirm_order`
--

INSERT INTO `confirm_order` (`order_id`, `user_id`, `name`, `email`, `number`, `address`, `payment_method`, `total_books`, `order_date`, `payment_status`, `date`, `total_price`) VALUES
(3, 3, 'Shubham Pustake', 'shubham@gmail.com', 2147483647, 'Mohan Nagar,Chinchwad, Chinchwad, Maharashtra, India - 416416', 'cash on delivery', ' Stephen King #7,(1) ', '19-04-2024', 'PENDING', '', 455.00),
(4, 3, 'Shubham Pustake', 'shubhaam@gmail.com', 2147483647, 'chichwad, Chinchwad, Maharashtra, India - 416416', 'cash on delivery', ' Ray Bearer #10,(2) ', '20-04-2024', 'PENDING', '', 1998.00);

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `number` int(20) NOT NULL,
  `msg` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`id`, `user_id`, `name`, `email`, `number`, `msg`, `date`) VALUES
(1, 3, 'Shubham Pustake', 'shubham@gmail.com', 2147483647, 'Is any book of cooking is available \r\n', '2024-04-20 00:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(225) NOT NULL,
  `user_id` int(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pincode` int(6) NOT NULL,
  `book` varchar(50) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `city`, `state`, `country`, `pincode`, `book`, `unit_price`, `quantity`, `sub_total`, `payment_status`) VALUES
(1, 3, 'Mohan Nagar,Chinchwad', 'Chinchwad', 'Maharashtra', 'Indai', 416416, 'Chhawa', 499.00, 1, 499.00, 'pending'),
(3, 3, 'Mohan Nagar,Chinchwad', 'Chinchwad', 'Maharashtra', 'India', 416416, 'Stephen King', 455.00, 1, 455.00, 'pending'),
(4, 3, 'chichwad', 'Chinchwad', 'Maharashtra', 'India', 416416, 'Ray Bearer', 999.00, 2, 1998.00, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `Id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`Id`, `name`, `surname`, `username`, `email`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@pageturner.com', 'admin', 'Admin'),
(3, 'Shubham', 'P', 'shubham', 'shubham@gmail.com', '1122', 'User'),
(4, 'jayesh ', 'jagtap', 'jayesh169', 'jagtapjayesh3410@gma', 'jayeshjm', 'User'),
(5, 'jayesh ', 'jagtap', 'jayesh169', 'jagtapjayesh3410@gma', 'Jayesh12', 'User'),
(6, 'Priya ', 'pawar', 'priya123', 'priyavpawar2@gmail.c', '12345678', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirm_order`
--
ALTER TABLE `confirm_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
  MODIFY `bid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `confirm_order`
--
ALTER TABLE `confirm_order`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
