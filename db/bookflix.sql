-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 14, 2025 at 07:50 AM
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
  `language` varchar(50) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `binding` varchar(50) NOT NULL,
  `no_of_pages` int(11) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `publisher_date` date DEFAULT NULL,
  `height` decimal(10,2) NOT NULL,
  `spine_width` decimal(10,2) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`bid`, `name`, `author`, `price`, `category`, `language`, `publisher`, `binding`, `no_of_pages`, `weight`, `publisher_date`, `height`, `spine_width`, `width`, `image`, `description`, `date`) VALUES
(1, 'Agnes', 'Anne Bronte', 500, 'Novel', 'marathi', 'sad', 'qsad', 231, 1.00, '0000-00-00', 0.00, 0.00, 0.00, 'Agnes.jpg', '', '2024-04-03 20:10:02'),
(3, 'Darwin', 'Darwin D', 799, 'Knowledge', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'Darwins-Doubt.jpg', '', '2024-04-09 22:24:58'),
(4, 'Capture The Crown ', 'Jennifer E.', 633, 'Magical', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'CaptureTheCrown.jpg', '', '2024-04-09 22:25:39'),
(5, 'Crush The King ', 'Jennifer L', 566, 'Knowledge', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'CrushTheKing.jpg', '', '2024-04-09 22:26:30'),
(7, 'Stephen King', 'Carre', 455, 'Adventure', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'StephenKing.jpg', '', '2024-04-09 22:29:33'),
(8, 'Chhawa', 'Shivaji Sawant', 499, 'Novel', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'ChhawaBook.jpg', '', '2024-04-09 22:30:55'),
(9, 'The Winter King', 'Christ C', 65, 'Knowledge', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'TheWinterKing.jpg', '', '2024-04-09 22:32:08'),
(10, 'Ray Bearer', 'Jordan I', 999, 'Magical', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'RayBearer.jpg', '', '2024-04-09 22:37:05'),
(11, 'Love Boat', 'Abile Hing', 499, 'Adventure', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'LoveBoat.jpg', '\"Love Boat\" by Abigail Hing Wen is a young adult contemporary novel that follows Ever Wong, a Chinese-American teenager whose strict parents send her to a summer program in Taiwan. Expecting a rigid academic environment, she instead discovers \"Love Boat\"—a place where freedom, romance, and self-discovery thrive. As Ever navigates friendships, love interests, and cultural expectations, she begins to question her future and what she truly wants.', '2024-04-09 22:40:40'),
(12, 'india', 'yash pawar', 1900, 'Knowledge', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'india.jpg', 'Timepass', '2024-04-25 18:02:31'),
(13, 'aditya ', 'sd', 231, 'Adventure', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, '0303.jpg', 'csvacvsa', '2025-03-03 15:43:14'),
(14, 'asd', 'sda', 123, 'Adventure', 'marathi', 'asd', 'sda', 123, 12345.00, '2025-03-27', 12.00, 21.00, 12.00, '95032642_709659699772027_2394568349125181440_n.jpg', 'asddsfdgsfdsafgfdgfe,n,dbfjkdsfkjd fjfhkjdsbkfjbasdfjkbdas', '2025-03-27 00:00:00');

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
(8, 6, 5, 'Agnipankh', 999, 'agnipankh.jpg', 1, 999.00, '2024-04-25 21:13:02'),
(37, 11, 3, 'Love Boat', 499, 'LoveBoat.jpg', 1, 499.00, '2025-04-01 11:52:20'),
(38, 10, 3, 'Ray Bearer', 999, 'RayBearer.jpg', 1, 999.00, '2025-04-01 11:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender` enum('user','admin') NOT NULL,
  `admin_reply` text DEFAULT NULL,
  `reply_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `user_id`, `message`, `sender`, `admin_reply`, `reply_time`, `timestamp`) VALUES
(1, 3, 'asad', 'user', NULL, '2025-03-06 11:40:55', '2025-03-06 11:40:55'),
(2, 3, 'asad', 'user', NULL, '2025-03-06 11:41:00', '2025-03-06 11:41:00'),
(3, 3, 'asad', 'user', 'fsdfs', '2025-03-06 11:42:33', '2025-03-06 11:42:33'),
(4, 3, 'sd', 'user', NULL, '2025-03-06 11:42:36', '2025-03-06 11:42:36'),
(5, 3, 'dsa', 'user', NULL, '2025-03-06 11:42:46', '2025-03-06 11:42:46'),
(6, 3, 'as', 'user', NULL, '2025-03-06 11:43:44', '2025-03-06 11:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `confirm_order`
--

CREATE TABLE `confirm_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `total_books` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` date NOT NULL DEFAULT curdate(),
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `delivery_staff_id` int(11) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `district` varchar(255) NOT NULL,
  `taluka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirm_order`
--

INSERT INTO `confirm_order` (`id`, `user_id`, `name`, `number`, `email`, `address`, `total_books`, `total_price`, `order_date`, `payment_id`, `payment_status`, `delivery_staff_id`, `order_status`, `district`, `taluka`) VALUES
(11, 3, 'Shubham Pawar', '', 'shubham@gmail.com', 'at wakodi,post darewadi,tal nagar, dist ahmednagar.414002', 'aditya  x 1, Chhawa x 1, Darwin x 1', 1529.00, '2025-03-27', 'pay_QBlSGBnwl5O0Z7', 'success', 1, 'Assigned', '', ''),
(13, 3, 'aditya todmal', '', 'adi@gmail.com', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'aditya  x 1, india x 1', 2131.00, '2025-03-29', 'pay_QCYUNyeuhZSZOR', 'success', 1, 'pending', '', ''),
(14, 3, 'aditya todmal', '', 'adi@gmail.com', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'india x 1', 1900.00, '2025-03-29', 'pay_QCYe0lVgnv2UhZ', 'success', 4, 'delivered', 'Ahmednagar', 'Karjat'),
(15, 3, 'aditya todmal', '', 'adi@gmail.com', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'india x 1', 1900.00, '2025-04-01', 'pay_QDgz032djZY1be', 'success', 4, 'Assigned', 'Ahmednagar', 'Karjat');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_staff`
--

CREATE TABLE `delivery_staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `state` varchar(255) NOT NULL DEFAULT 'Maharashtra',
  `district` varchar(255) NOT NULL,
  `taluka` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_staff`
--

INSERT INTO `delivery_staff` (`id`, `name`, `email`, `phone`, `password`, `status`, `created_at`, `state`, `district`, `taluka`) VALUES
(2, 'asdas', 'adityatodmal416@gmail.com', '08767062627', '123', 'Active', '2025-03-29 10:15:09', 'Maharashtra', 'Ahmednagar', 'Karjat'),
(3, 'ganesh', 'g@gmail.com', '9876543210', '1122', 'Active', '2025-03-29 10:26:50', 'Maharashtra', 'Ahmednagar', 'Akole, Jamkhed, Karjat, Kopargaon, Nevasa, Parner'),
(4, 'sangram', 'sp@gmail.com', '9876543211', '$2y$10$ke/KXAbuj4F7dwvDpgmyhe1xLyMmExERJ7xLYrgXh1oRlJNlkGjeC', 'Active', '2025-03-30 07:15:08', 'Maharashtra', 'Ahmednagar', 'Akole, Jamkhed, Karjat, Shrigonda, Shrirampur'),
(5, 'ruturaj', 'r@gmail.com', '9876541234', '$2y$10$BG28diO.4fUwyp8rzCCL/un7N5m1RkR3VtZazhkMZS9l1SuJ48RPC', 'Active', '2025-03-30 18:40:10', 'Maharashtra', 'Pune', 'Baramati, Bhor, Daund, Haveli, Indapur, Junnar, Khed');

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
(1, 3, 'Shubham Pustake', 'shubham@gmail.com', 2147483647, 'Is any book of cooking is available \r\n', '2024-04-20 00:00:02'),
(2, 7, 'zxxzczc', 'admin@gmail.com', 2147483647, 'sadfgbvv', '2025-03-03 20:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `otp_verification`
--

CREATE TABLE `otp_verification` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_verification`
--

INSERT INTO `otp_verification` (`id`, `email`, `otp`, `created_at`) VALUES
(9, 'gandhibapu009@gmail.com', '364562', '2025-03-31 17:18:38'),
(10, 'gandhibapu009@gmail.com', '708456', '2025-03-31 17:25:06'),
(18, 'adityatodmal47@gmail.com', '511835', '2025-03-31 18:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `query` text DEFAULT NULL,
  `response` text DEFAULT NULL,
  `status` enum('Pending','Answered') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `user_id`, `query`, `response`, `status`, `created_at`) VALUES
(1, 3, 'hello when will delivered myparsel', NULL, 'Pending', '2025-03-06 10:47:16'),
(2, 3, 'hello when will delivered myparsel', NULL, 'Pending', '2025-03-06 10:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'asasda', 'asdf@gmail.com', '$2y$10$4aXbDyS2lvje4HYe4EhnweFA7WANnuE19odcRzFGSRcy0YL1RgXzy', '2025-03-04 13:58:52');

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
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `address` varchar(255) NOT NULL,
  `district` varchar(100) DEFAULT NULL,
  `taluka` varchar(100) DEFAULT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL DEFAULT 'India',
  `pincode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`Id`, `name`, `surname`, `username`, `email`, `password`, `user_type`, `address`, `district`, `taluka`, `state`, `country`, `pincode`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@pageturner.com', 'admin', 'Admin', '', NULL, NULL, '', 'India', ''),
(3, 'aditya', 'todmal', 'a45', 'adi@gmail.com', '1122', 'User', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'Ahmednagar', 'Karjat', 'Maharashtra', 'India', '414002'),
(6, 'Priya ', 'pawar', 'priya123', 'priyavpawar2@gmail.c', '12345678', 'User', '', NULL, NULL, '', 'India', ''),
(7, 'aditya', 'todmal', 'user', 'a@gmail.com', 'a123456', 'User', '', NULL, NULL, '', 'India', '');

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
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `confirm_order`
--
ALTER TABLE `confirm_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_staff`
--
ALTER TABLE `delivery_staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `bid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `confirm_order`
--
ALTER TABLE `confirm_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `delivery_staff`
--
ALTER TABLE `delivery_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `otp_verification`
--
ALTER TABLE `otp_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`Id`);

--
-- Constraints for table `queries`
--
ALTER TABLE `queries`
  ADD CONSTRAINT `queries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
