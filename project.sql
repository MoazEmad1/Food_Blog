-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2023 at 04:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `type_of_authority` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `user_name`, `pass`, `type_of_authority`) VALUES
(1, 'zeyad', 'zeyad', 'social'),
(2, 'moaz', 'moaz', 'grocery');

-- --------------------------------------------------------

--
-- Table structure for table `ban_table`
--

CREATE TABLE `ban_table` (
  `ban_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `banned_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `quantity`, `timestamp`) VALUES
(1, 1, 2, 10, '2023-12-22 16:03:31'),
(2, 1, 3, 20, '2023-12-26 00:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE `follower` (
  `follower_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grocery_item`
--

CREATE TABLE `grocery_item` (
  `gid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `img_url` varchar(2048) NOT NULL,
  `is_veg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grocery_item`
--

INSERT INTO `grocery_item` (`gid`, `quantity`, `price`, `item_name`, `img_url`, `is_veg`) VALUES
(1, 0, 2, 'Apple', 'apple.jpg', 1),
(2, 3, 3, 'Banana', 'banana.jpg', 1),
(3, 20, 1, 'Carrot', 'carrot.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_confirmation`
--

CREATE TABLE `item_confirmation` (
  `admin_id` int(11) NOT NULL,
  `giid` int(11) NOT NULL,
  `item_action` varchar(255) NOT NULL,
  `confirmaiton_time` datetime NOT NULL,
  `quantity_added` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` int(11) NOT NULL,
  `personA` int(11) NOT NULL,
  `personB` int(11) NOT NULL,
  `mesageContent` varchar(2048) NOT NULL,
  `sent_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `personA`, `personB`, `mesageContent`, `sent_at`) VALUES
(1, 1, 2, 'hello', '2023-12-26 17:04:07'),
(2, 2, 1, 'hey\r\n', '2023-12-26 17:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `address_id`, `total_amount`, `payment_method`, `order_date`, `status`) VALUES
(1, 2, 1, 5.00, 'cod', '2023-12-26 15:07:48', 'Pending'),
(2, 2, 1, 5.00, 'cod', '2023-12-26 15:10:19', 'Pending'),
(3, 2, 1, 40.00, 'cod', '2023-12-26 15:11:17', 'Pending'),
(4, 2, 1, 15.00, 'cod', '2023-12-26 15:13:14', 'Pending'),
(5, 2, 1, 21.00, 'cod', '2023-12-26 15:14:31', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `page_user`
--

CREATE TABLE `page_user` (
  `uid` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `dob` date DEFAULT '2003-10-28',
  `last_seen` datetime DEFAULT current_timestamp(),
  `gender` bit(1) DEFAULT b'0' COMMENT 'male is zero female is one',
  `pic_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_user`
--

INSERT INTO `page_user` (`uid`, `first_name`, `last_name`, `user_name`, `email`, `pass`, `dob`, `last_seen`, `gender`, `pic_url`) VALUES
(1, 'John', 'Doe', 'john_doe', 'john@john', 'pass', '1990-01-01', '2023-12-22 16:00:00', b'0', ''),
(2, 'Jane', 'Doe', 'jane_doe', 'jane@jane', 'pass', '1995-05-15', '2023-12-22 16:05:00', b'0', ''),
(3, 'zeyad', 'mahmoud', '@zeyad_mahmoud', 'zeyad@gmail.com', 'pass', '2003-10-28', '2023-12-23 04:22:04', b'0', ''),
(12, 'zeyad', 'zeyad', '@zeyad_zeyad', 'zeyad@z', 'pass', '2003-10-28', '2023-12-23 04:55:40', b'0', ''),
(16, 'zeyadsf', 'zedsf', '@zeyadsf_zedsf', 'zsdf@asfd', 'pass', '2003-10-28', '2023-12-23 05:16:27', b'0', ''),
(19, 'testtt', 'testtt', '@testtt_testtt', 'testt@agfd', 'pass', '2003-10-28', '2023-12-23 14:52:25', b'0', ''),
(22, 'zeyada', 'zeyad', '@zeyada_zeyad', 'zeyad@adfasf', 'pass', '2003-10-28', '2023-12-23 15:02:11', b'0', ''),
(23, 'ali', 'mohamed', '@ali_mohamed', 'ali@mohamed', 'pass', '2003-10-28', '2023-12-23 15:41:58', b'0', ''),
(26, 'johny', 'johny', '@johny_johny', 'johny@gmail.com', 'pass', '2003-10-28', '2023-12-23 16:21:32', b'0', '');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `pid` int(11) NOT NULL,
  `img_url` varchar(2048) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `published_at` datetime NOT NULL,
  `is_veg` int(1) NOT NULL,
  `caption` varchar(2048) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`pid`, `img_url`, `title`, `published_at`, `is_veg`, `caption`, `user_id`) VALUES
(1, 'post1.jpg', 'Delicious Salad', '2023-12-22 16:10:00', 1, 'Enjoy this fresh salad!', 1),
(2, 'post2.jpg', 'Fruit Smoothie', '2023-12-22 16:15:00', 1, 'Refreshing smoothie recipe.', 1),
(3, 'post3.jpg', 'Vegetarian Pizza', '2023-12-22 16:20:00', 1, 'Homemade pizza with veggies.', 1),
(4, 'Users/test/images/apple.jpg', 'test', '2023-12-22 20:32:47', 1, 'delicious', 2),
(5, 'Users/test/images/palette.png', 'chicken tikka', '2023-12-26 02:27:23', 0, 'chikcalkdjfalksnvla;kjoiwrj', 1),
(6, 'assets/img/posts/', 'food recipe', '2023-12-26 04:29:50', 0, 'config', 1),
(7, 'assets/img/posts/logo3.jpeg', 'food recipe', '2023-12-26 04:30:49', 0, 'leeeeh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `postingredient`
--

CREATE TABLE `postingredient` (
  `ingredient_name` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postingredient`
--

INSERT INTO `postingredient` (`ingredient_name`, `post_id`, `quantity`) VALUES
('Banana', 2, NULL),
('chicken', 5, NULL),
('kaffo', 5, NULL),
('Lettuce', 1, NULL),
('Tomato', 3, NULL),
('whatever', 6, NULL),
('whatever', 7, NULL),
('yum', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment` (
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `commented_at` datetime NOT NULL,
  `content` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`uid`, `pid`, `commented_at`, `content`) VALUES
(1, 1, '2023-12-22 16:25:00', 'Looks delicious!'),
(2, 2, '2023-12-22 16:30:00', 'Great recipe!'),
(2, 2, '2023-12-22 22:47:54', 'af'),
(2, 1, '2023-12-22 23:00:30', 'lll'),
(2, 1, '2023-12-22 23:00:52', 'primary 2'),
(1, 1, '2023-12-22 16:25:00', 'Looks delicious!'),
(2, 2, '2023-12-22 16:30:00', 'Great recipe!'),
(2, 2, '2023-12-22 22:47:54', 'af'),
(2, 1, '2023-12-22 23:00:30', 'lll'),
(2, 1, '2023-12-22 23:00:52', 'primary 2'),
(1, 5, '2023-12-26 02:27:52', 'Hello there how you doing'),
(1, 5, '2023-12-26 02:28:07', 'What time is it now?');

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `liked_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`uid`, `pid`, `liked_at`) VALUES
(1, 1, '2023-12-22 23:26:52'),
(1, 2, '2023-12-22 23:26:55'),
(1, 3, '2023-12-22 23:28:31'),
(1, 5, '2023-12-26 02:27:41'),
(2, 1, '2023-12-22 22:32:51'),
(2, 2, '2023-12-22 22:34:43'),
(2, 3, '2023-12-22 22:35:29'),
(2, 4, '2023-12-22 22:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `post_save`
--

CREATE TABLE `post_save` (
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `saved_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_save`
--

INSERT INTO `post_save` (`uid`, `pid`, `saved_at`) VALUES
(1, 2, '2023-12-22 16:45:00'),
(2, 3, '2023-12-22 16:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `giid` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `quantity_bought` int(11) NOT NULL,
  `total_item_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `uid`, `giid`, `total_price`, `quantity_bought`, `total_item_price`) VALUES
(1, 1, 1, 20, 5, 10),
(2, 2, 2, 15, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_prefix` varchar(10) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `additional_phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `additional_info` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `set_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`address_id`, `user_id`, `first_name`, `last_name`, `phone_prefix`, `phone_number`, `additional_phone`, `address`, `additional_info`, `city`, `set_default`) VALUES
(1, 2, 'Moaz', 'Hussein', '+20', '1005854360', '', 'Fifth Settlement, Narges Buildings, Mohamed Sabry Abu Alam Street, building 317', '', 'Cairo', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `ban_table`
--
ALTER TABLE `ban_table`
  ADD PRIMARY KEY (`ban_id`),
  ADD KEY `uidFK` (`uid`),
  ADD KEY `adIDFK` (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`follower_id`,`following_id`),
  ADD KEY `flwingFK` (`following_id`);

--
-- Indexes for table `grocery_item`
--
ALTER TABLE `grocery_item`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `item_confirmation`
--
ALTER TABLE `item_confirmation`
  ADD KEY `adIDFKConf` (`admin_id`),
  ADD KEY `giidFK` (`giid`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `PAFK` (`personA`),
  ADD KEY `PBFK` (`personB`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `page_user`
--
ALTER TABLE `page_user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `postingredient`
--
ALTER TABLE `postingredient`
  ADD PRIMARY KEY (`ingredient_name`,`post_id`),
  ADD KEY `pidFK` (`post_id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`uid`,`pid`),
  ADD KEY `pidFKLike` (`pid`);

--
-- Indexes for table `post_save`
--
ALTER TABLE `post_save`
  ADD PRIMARY KEY (`uid`,`pid`),
  ADD KEY `pidFKSave` (`pid`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `userIDFKRec` (`uid`),
  ADD KEY `giidFKRec` (`giid`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ban_table`
--
ALTER TABLE `ban_table`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grocery_item`
--
ALTER TABLE `grocery_item`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page_user`
--
ALTER TABLE `page_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ban_table`
--
ALTER TABLE `ban_table`
  ADD CONSTRAINT `adIDFK` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`adminid`),
  ADD CONSTRAINT `uidFK` FOREIGN KEY (`uid`) REFERENCES `page_user` (`uid`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `grocery_item` (`gid`);

--
-- Constraints for table `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `flwingFK` FOREIGN KEY (`following_id`) REFERENCES `page_user` (`uid`),
  ADD CONSTRAINT `flwrFK` FOREIGN KEY (`follower_id`) REFERENCES `page_user` (`uid`);

--
-- Constraints for table `item_confirmation`
--
ALTER TABLE `item_confirmation`
  ADD CONSTRAINT `adIDFKConf` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`adminid`),
  ADD CONSTRAINT `giidFK` FOREIGN KEY (`giid`) REFERENCES `grocery_item` (`gid`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `PAFK` FOREIGN KEY (`personA`) REFERENCES `page_user` (`uid`),
  ADD CONSTRAINT `PBFK` FOREIGN KEY (`personB`) REFERENCES `page_user` (`uid`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `page_user` (`uid`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `user_address` (`address_id`);

--
-- Constraints for table `postingredient`
--
ALTER TABLE `postingredient`
  ADD CONSTRAINT `pidFK` FOREIGN KEY (`post_id`) REFERENCES `post` (`pid`);

--
-- Constraints for table `post_like`
--
ALTER TABLE `post_like`
  ADD CONSTRAINT `pidFKLike` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`),
  ADD CONSTRAINT `uidFKLike` FOREIGN KEY (`uid`) REFERENCES `page_user` (`uid`);

--
-- Constraints for table `post_save`
--
ALTER TABLE `post_save`
  ADD CONSTRAINT `pidFKSave` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`),
  ADD CONSTRAINT `uidFKSave` FOREIGN KEY (`uid`) REFERENCES `page_user` (`uid`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `giidFKRec` FOREIGN KEY (`giid`) REFERENCES `grocery_item` (`gid`),
  ADD CONSTRAINT `userIDFKRec` FOREIGN KEY (`uid`) REFERENCES `page_user` (`uid`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `page_user` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
