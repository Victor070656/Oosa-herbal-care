-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2025 at 11:37 PM
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
-- Database: `helenz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'admin@helenz.com', '@admin', '2024-05-28 16:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `service_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `userid`, `fname`, `lname`, `email`, `phone`, `service_id`, `location`, `date`, `time`, `price`, `created_at`) VALUES
(1, '14040134', 'Knox', 'Patterson', 'rugamymur@example.com', '+1 (683) 222-7124', 3, 'Lagos State, Nigeria', '1973-04-24', '1:30 PM - 2:15 PM', 850, '2025-05-20 07:05:06'),
(2, '43711987', 'Larissa', 'Scott', 'tewi@example.com', '+1 (438) 228-5909', 1, 'Ikenegbu, Owerri, Imo State', '2021-08-05', '3:40 PM - 4:25 PM', 10300, '2025-05-26 21:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `productid` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userid`, `productid`, `quantity`, `created_at`) VALUES
(3, '11184314', '751411', 5, '2024-06-02 15:47:06'),
(4, '11184314', '871939', 1, '2024-06-02 17:35:32'),
(10, '14040134', '641037', 1, '2024-06-10 17:43:06'),
(11, '14040134', '840028', 1, '2024-06-10 17:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`) VALUES
(4, 'cream', '2025-05-21 21:54:09'),
(5, 'Accusamus', '2025-05-22 09:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderid` varchar(20) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `items` text NOT NULL,
  `amount` float NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'In queue',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderid`, `userid`, `ref`, `items`, `amount`, `firstname`, `lastname`, `email`, `phone`, `country`, `city`, `zipcode`, `address1`, `address2`, `status`, `created_at`) VALUES
(4, '2418899843', '43711987', NULL, '[{\"userid\":\"43711987\",\"productid\":\"641037\",\"quantity\":\"1\"}]', 68.2, 'Victor', 'Ikechukwu', 'ikechukwuv052@gmail.com', '07065606123', 'Nigeria', 'Port Harcourt', '560104', 'Woji', '', 'In queue', '2024-06-07 00:00:00'),
(5, '9588526046', '43711987', NULL, '[{\"userid\":\"43711987\",\"productid\":\"751411\",\"quantity\":\"2\"},{\"userid\":\"43711987\",\"productid\":\"871939\",\"quantity\":\"3\"}]', 159.5, 'Victor', 'Ikechukwu', 'ikechukwuv052@gmail.com', '07065606123', 'Nigeria', 'Port Harcourt', '560104', 'Woji', 'woji estate', 'In queue', '2024-06-07 00:00:00'),
(6, '5943638645', '43711987', NULL, '[{\"userid\":\"43711987\",\"productid\":\"744689\",\"quantity\":\"1\"},{\"userid\":\"43711987\",\"productid\":\"873264\",\"quantity\":\"1\"}]', 728.84, 'Jameson', 'Wyatt', 'jozoxe@example.com', '+1 (567) 335-5841', 'Similique in rem des', 'Sacramento', '97497', 'Non dolor neque moll', 'Proident placeat n', 'In queue', '2025-05-30 00:00:00'),
(7, '6743080428', '43711987', '0C8b9722HcF6Yaf74Jf1', '[{\"userid\":\"43711987\",\"productid\":\"873264\",\"quantity\":\"1\"}]', 8786, 'Quon', 'Dale', 'qogon@example.com', '+1 (865) 754-5834', 'Autem labore et ipsa', 'Miami', '31605', 'Earum voluptatem eiu', 'Numquam dignissimos ', 'In queue', '2025-05-30 16:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `productid` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` float NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'available',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `productid`, `name`, `tags`, `price`, `discount`, `description`, `image`, `status`, `created_at`) VALUES
(14, 4, '744689', 'Ryan Riddle', 'Velit ut consequatur', 89, 98, 'Ex inventore expedit', '202505221025321721.jpg', 'available', '2025-05-22 09:25:32'),
(16, 5, '873264', 'Austin Richmond', 'Enim quia neque ipsu', 7640, 10, 'Aliqua Aliquid id ', '202505221215123d-male-character-with-laptop_952161-92624.jpg', 'available', '2025-05-22 11:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `id` int(11) NOT NULL,
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `rate`) VALUES
(1, 1480);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `price`, `category_id`, `created_at`) VALUES
(1, 'Sint quos id vitae i', 10300, 3, '2025-05-19 15:15:36'),
(3, 'Commodo sint maxime', 850, 2, '2025-05-19 15:16:44');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `category_name`, `created_at`) VALUES
(1, 'Dental Care', '2025-05-19 14:50:27'),
(2, 'Keegan Torres', '2025-05-19 15:16:08'),
(3, 'Stewart Gibson', '2025-05-19 15:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `firstname`, `lastname`, `username`, `phone`, `email`, `password`, `code`, `created_at`) VALUES
(1, '43711987', 'John', 'Doe', 'doen24', '+167896567122', 'abc@example.com', '000000', '', '2024-05-28 22:17:12'),
(2, '11184314', 'Samuel', 'Odinga', 'sam12344', '+234908848387', 'sammy@example.com', '000000', '', '2024-06-01 13:20:09'),
(3, '14040134', 'Victor', 'Ikechukwu', 'vpro_services', '+2347065606123', 'ikechukwuv052@gmail.com', '080808', '27187', '2024-06-08 12:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `wish`
--

CREATE TABLE `wish` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `productid` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wish`
--

INSERT INTO `wish` (`id`, `userid`, `productid`, `created_at`) VALUES
(3, '11184314', '641037', '2024-06-02 15:59:31'),
(5, '43711987', '873264', '2025-05-29 22:03:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_appointment` (`service_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productid` (`productid`),
  ADD KEY `product_category` (`category_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_category` (`category_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wish`
--
ALTER TABLE `wish`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wish`
--
ALTER TABLE `wish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `service_appointment` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `service_category` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
