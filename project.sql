-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 06:59 PM
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
(1, 1, 2, 16, '2023-12-22 16:03:31');

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
(2, 10, 3, 'Banana', 'banana.jpg', 1),
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
-- Table structure for table `page_user`
--

CREATE TABLE `page_user` (
  `uid` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `last_seen` datetime NOT NULL,
  `gender` bit(1) NOT NULL COMMENT 'male is zero female is one'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_user`
--

INSERT INTO `page_user` (`uid`, `first_name`, `last_name`, `user_name`, `email`, `pass`, `dob`, `last_seen`, `gender`) VALUES
(1, 'John', 'Doe', 'john_doe', '', 'password123', '1990-01-01', '2023-12-22 16:00:00', b'0'),
(2, 'Jane', 'Doe', 'jane_doe', '', 'password456', '1995-05-15', '2023-12-22 16:05:00', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `pid` int(11) NOT NULL,
  `img_url` varchar(2048) NOT NULL,
  `title` varchar(255) NOT NULL,
  `published_at` datetime NOT NULL,
  `is_veg` int(1) NOT NULL,
  `caption` varchar(2048) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`pid`, `img_url`, `title`, `published_at`, `is_veg`, `caption`, `user_id`) VALUES
(1, 'post1.jpg', 'Delicious Salad', '2023-12-22 16:10:00', 1, 'Enjoy this fresh salad!', 0),
(2, 'post2.jpg', 'Fruit Smoothie', '2023-12-22 16:15:00', 1, 'Refreshing smoothie recipe.', 0),
(3, 'post3.jpg', 'Vegetarian Pizza', '2023-12-22 16:20:00', 1, 'Homemade pizza with veggies.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `postingredient`
--

CREATE TABLE `postingredient` (
  `ingredient_name` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postingredient`
--

INSERT INTO `postingredient` (`ingredient_name`, `post_id`) VALUES
('Banana', 2),
('Lettuce', 1),
('Tomato', 3);

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
(2, 2, '2023-12-22 16:30:00', 'Great recipe!');

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
(1, 1, '2023-12-22 16:35:00'),
(2, 3, '2023-12-22 16:40:00');

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
-- Indexes for table `page_user`
--
ALTER TABLE `page_user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `pass` (`pass`);

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
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`uid`,`pid`),
  ADD KEY `pidFKCom` (`pid`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ban_table`
--
ALTER TABLE `ban_table`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grocery_item`
--
ALTER TABLE `grocery_item`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page_user`
--
ALTER TABLE `page_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `postingredient`
--
ALTER TABLE `postingredient`
  ADD CONSTRAINT `pidFK` FOREIGN KEY (`post_id`) REFERENCES `post` (`pid`);

--
-- Constraints for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD CONSTRAINT `pidFKCom` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`),
  ADD CONSTRAINT `uidFKCom` FOREIGN KEY (`uid`) REFERENCES `page_user` (`uid`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
