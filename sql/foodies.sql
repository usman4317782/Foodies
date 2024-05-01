-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 09:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodies`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`) VALUES
(1, 'Begum Kot Shahdara'),
(2, 'Yousif Park'),
(3, 'Kot Kamboh'),
(4, 'Shamsabad Shahdara'),
(5, 'Chah Jhabbay Wala'),
(6, 'Aziz Colony Shahdra'),
(7, 'Lajpat'),
(8, 'Faisal Park'),
(9, 'Javid Park'),
(10, 'Qaisar Town'),
(11, 'Majeed Park'),
(12, 'Qazi Park'),
(13, 'Ravi Clifton Colony'),
(14, 'Ladhay Shah'),
(15, 'Qila Lakshan Singh'),
(16, 'Auqaf Colony'),
(17, 'Farooq Ganjj'),
(18, 'Hanif Park'),
(19, 'Siddique Pura'),
(20, 'Larix Park'),
(21, 'Badar Colony'),
(22, 'Data Nagar'),
(23, 'Siddiqa Colony'),
(24, 'Bhagat Pura'),
(25, 'Jhuggian'),
(26, 'Akram Park'),
(27, 'Fazal Park'),
(28, 'Jahangir Park'),
(29, 'Usman Ganjj'),
(30, 'Manzorabad'),
(31, 'Faiz Bagh'),
(32, 'Mochi Gate'),
(33, 'Azam Market'),
(34, 'Shah Alam Market'),
(35, 'Rang Mahal'),
(36, 'Lohari Gate'),
(37, 'Bhati Gate'),
(38, 'Shahi Qila'),
(39, 'Sutar Mandi'),
(40, 'Hussain Park'),
(41, 'Makhan Pura'),
(42, 'Dhobi Ghat'),
(43, 'Sultan Pura'),
(44, 'Misri Shah'),
(45, 'Chah Miran'),
(46, 'Kajhho Pura'),
(47, 'Wasan Pura'),
(48, 'Razipura'),
(49, 'Kasur Pura'),
(50, 'Shafiqabad'),
(51, 'Amin Park'),
(52, 'Nasir Park'),
(53, 'Karim Park'),
(54, 'Darbar Pir Makki'),
(55, 'Mian Shamsuddin Park'),
(56, 'Mian Munshi Park'),
(57, 'Tauheed Park'),
(58, 'Sunt Nagar'),
(59, 'Chohan Park'),
(60, 'Outfall Road / Chohan Road'),
(61, 'Purana Anarkali'),
(62, 'Beadon Road'),
(63, 'New Anarkali'),
(64, 'Riwaz Garden'),
(65, 'Islam Pura'),
(66, 'Sanda'),
(67, 'Sadaqat Park'),
(68, 'Mozang'),
(69, 'Sir Ganga Ram Hospital'),
(70, 'Sarai Sultan'),
(71, 'Shibli Town'),
(72, 'Usman Ganjj'),
(73, 'Raj Garh'),
(74, 'Sanda Khurd'),
(75, 'Gulshan e Ravi'),
(76, 'New Chauburji Park'),
(77, 'Gulshan Ravi F Block'),
(78, 'Gulshan Ravi A Block'),
(79, 'Rustam Park'),
(80, 'Gulgasht Colony'),
(81, 'Islamia Park'),
(82, 'Bahawalpur House'),
(83, 'Pir Ghazi Road Ichra'),
(84, 'Rehman Pura'),
(85, 'New Samanabad'),
(86, 'Muhammad Pura'),
(87, 'Kamboh Colony'),
(88, 'Nawan Kot Samanabad'),
(89, 'Zubaida Park'),
(90, 'Dongi Ground Samanabad'),
(91, 'Union Park'),
(92, 'Shaheenabad / Shera Kot'),
(93, 'Sodiwal / Tariq Colony'),
(94, 'New Shalimar Colony'),
(95, 'Dholan Wal'),
(96, 'Sabzazar Block B'),
(97, 'Syedpur'),
(98, 'Sabza Zar'),
(99, 'Kot Kamboh Khurd'),
(100, 'Jhugian Nagra'),
(101, 'Sabzazar K Block'),
(102, 'Hassan Town / Awan Town'),
(103, 'Mustafa Park'),
(104, 'Margzar Colony'),
(105, 'Thokar Niaz Baig'),
(106, 'Hanjarwal'),
(107, 'Mustafa Town'),
(108, 'Ayaz Baig Kanal View'),
(109, 'Johar Town'),
(110, 'Johar Town / PIA Society'),
(111, 'EME Society'),
(112, 'Shahpur Kanjraan'),
(113, 'Wafaqi Colony'),
(114, 'E Block Johar Town'),
(115, 'Jodhapur'),
(116, 'Township Sector B-1'),
(117, 'Sector 2 Township'),
(118, 'Sector 1 Township'),
(119, 'Sattao Katlah'),
(120, 'Ali Razaabad'),
(121, 'Wapda Town'),
(122, 'Chuhang Panj Garian'),
(123, 'Izmir Town/Colony'),
(124, 'Marakah'),
(125, 'Mohalowal'),
(126, 'Shamkay Bhattian'),
(127, 'Manga'),
(128, 'Sultankay'),
(129, 'Manga Lotar'),
(130, 'Tallab Saraiy'),
(131, 'Mank'),
(132, 'Jodhu Dhair'),
(133, 'Raiwind Rural'),
(134, 'Raiwind Urban'),
(135, 'Bablian Otar'),
(136, 'Hear'),
(137, 'Jalman'),
(138, 'Dhalway'),
(139, 'Bostan Colony'),
(140, 'Chungi Amar Sadhu'),
(141, 'Qauid e Millat Colony'),
(142, 'Sittara Colony'),
(143, 'Pak Colony'),
(144, 'Township Sector B-2'),
(145, 'Sector 11 Green Town C'),
(146, 'Sector 11 D Green Town'),
(147, 'Marryum Colony'),
(148, 'Kair Killan Green Town'),
(149, 'Bagrian Dharam Chand'),
(150, 'Chandraiy Karim Park'),
(151, 'Attari Saroba'),
(152, 'Nishtar Colony'),
(153, 'Gajju Mattah'),
(154, 'Dillo Kallan'),
(155, 'Yuhanabad'),
(156, 'Kahana Kohana'),
(157, 'Shazwah'),
(158, 'Kamahan'),
(159, 'Thapanjo'),
(160, 'Baloki'),
(161, 'Pandoki'),
(162, 'Saraich'),
(163, 'Viewkhurd Kallan'),
(164, 'Bhoptian'),
(165, 'Araiyan'),
(166, 'Jia Bagga');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `SenderID` int(11) DEFAULT NULL,
  `ReceiverID` int(11) DEFAULT NULL,
  `Message` text NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Message` text NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `OfferID` int(11) NOT NULL,
  `RestaurantID` int(11) DEFAULT NULL,
  `OfferText` text NOT NULL,
  `ExpiryDate` date NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`OfferID`, `RestaurantID`, `OfferText`, `ExpiryDate`, `Created_at`, `Updated_at`) VALUES
(2, 9, 'offer is for the life time just in Rs. 12345', '2024-05-15', '2024-03-10 09:38:20', '2024-03-10 10:00:28'),
(3, 6, 'new offer coming soon till rest of the offers are closed.', '2024-03-13', '2024-03-10 09:38:38', '2024-03-12 08:29:40'),
(5, 11, ' new offer raheel rasut', '2024-03-10', '2024-03-10 09:45:07', '2024-03-10 09:45:07'),
(6, 9, ' another new post by usman.', '2024-03-21', '2024-03-10 10:21:21', '2024-03-10 10:21:21'),
(7, 9, ' details details', '2024-03-21', '2024-03-10 10:31:05', '2024-03-10 10:31:05'),
(8, 11, ' new offer.', '2024-03-12', '2024-03-11 15:50:27', '2024-03-11 15:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `RestaurantID` int(11) DEFAULT NULL,
  `MenuItemID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `Status` enum('Pending','Confirmed','Cancelled') DEFAULT 'Pending',
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `RestaurantID`, `MenuItemID`, `Quantity`, `address`, `contact`, `Status`, `Created_at`, `Updated_at`) VALUES
(22, 23, 6, 3, 4, 'Main Bazar Chah Jhabbay walas', '32244785424', 'Cancelled', '2024-03-12 08:29:57', '2024-03-20 08:55:17'),
(24, 3, 9, 6, 11, 'Dharampura Lahore Cantt Lahore', '03224471922', 'Confirmed', '2024-03-20 09:35:15', '2024-03-20 09:35:34'),
(25, 3, 9, 7, 7, 'Ghulistan Colony Dharampura Lahore', '03086522008', 'Confirmed', '2024-03-20 19:49:23', '2024-03-20 19:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `RatingID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `RestaurantID` int(11) DEFAULT NULL,
  `Rating` int(11) NOT NULL,
  `Comment` text DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`RatingID`, `UserID`, `RestaurantID`, `Rating`, `Comment`, `Created_at`) VALUES
(10, 5, 7, 1, 'commetn', '2024-03-11 20:05:50'),
(11, 5, 9, 4, 'another comment', '2024-03-11 20:10:13'),
(12, 23, 6, 2, 'good service', '2024-03-12 08:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `RestaurantID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `area` varchar(255) NOT NULL,
  `Location` varchar(200) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `details` longtext NOT NULL,
  `OwnerID` int(11) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`RestaurantID`, `Name`, `area`, `Location`, `contact`, `details`, `OwnerID`, `Created_at`, `Updated_at`) VALUES
(6, 'Restaurant B', 'Chah Jhabbay Wala', 'Main Bazar Chah Jhabbay Wala', '0254-5785535', 'New location added added', 2, '2024-03-04 10:59:16', '2024-03-12 08:31:34'),
(7, 'Fast Food Restaurant', 'Kot Kamboh', 'Location B', '0322-1454874', 'New Resturant added into the list. New offer has been posted.', 5, '2024-03-05 10:31:02', '2024-03-08 13:27:57'),
(9, 'Fast Food New Restaurant', 'Kot Kamboh', 'Near Govt. School Kot Kamboh', '0325-4597875', 'New Menu has been. Details are as under.', 2, '2024-03-08 06:39:49', '2024-03-08 07:00:15'),
(10, 'hahism rest', 'Yousif Park', 'near main road', '0234-8754568', 'detailed menu', 10, '2024-03-10 08:48:49', '2024-03-10 08:48:49'),
(11, 'raheel rastu', 'Kot Kamboh', 'main road', '0321-5457984', 'offers', 12, '2024-03-10 09:44:54', '2024-03-10 09:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `UserType` enum('RestaurantOwner','FoodLover','Admin') NOT NULL,
  `Email` varchar(100) NOT NULL,
  `area` varchar(255) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `UserType`, `Email`, `area`, `Created_at`, `Updated_at`) VALUES
(2, 'hafizusman243', '$2y$10$h4kSxPOSsmSo6wlHCfKZzeii8GMVGGmhsag3H4OrMHyDA1QcWTSUy', 'RestaurantOwner', 'adminbos@demos.com', '', '2024-03-01 07:15:20', '2024-03-07 08:11:05'),
(3, 'admin123', '$2y$10$tE23JfX/yPVK8MBA3y3oDe64ZWcyPxVN6juwasCT1fRIKB59EiiHC', 'Admin', 'adminbos@hotmail.com', '', '2024-03-02 02:58:31', '2024-03-02 02:58:31'),
(5, 'imran123456', '$2y$10$mQiuAPsX5SNNX7Sw5ret0.8ySwPLMRt14cEP5nsNJFvQJMimhVHQ6', 'FoodLover', 'imranshahid@bing.com', 'Kot Kamboh', '2024-03-05 10:28:50', '2024-03-08 13:13:46'),
(9, 'yaseen', '$2y$10$k0YsC1q5Kriv9ZMRU6wZveSvX3F28xnlvj5rm77us1hNJUkgQX1ke', 'FoodLover', 'yaseen@hotmail.com', 'Hanif Park', '2024-03-05 16:05:39', '2024-03-07 08:20:28'),
(10, 'hashim123', '$2y$10$9bmF/sLa/xfCrPagWJpvguZ8rfgMO.hiN8sljBEk.Cn.ML.h.36hu', 'RestaurantOwner', 'hashim123@gmail.com', 'Chah Jhabbay Wala', '2024-03-06 14:06:02', '2024-03-12 08:23:29'),
(11, 'raheel', '$2y$10$afR66NNF13veTqUsFQ7b/.equCQklJrsJMNM.aBgwdOgFxh5P8D9S', 'RestaurantOwner', 'raheel@gmail.com', 'Chah Jhabbay Wala', '2024-03-06 14:35:20', '2024-03-12 08:23:35'),
(12, 'raheel123', '$2y$10$Us5RkVGxE75gV82ED3N5QeTHs4K2yaz5ZC7ZmSZ3GW6IP3v9KrWLC', 'RestaurantOwner', 'raheel@yahoo.com', '', '2024-03-06 14:37:55', '2024-03-06 14:37:55'),
(13, 'hafizusman23', '$2y$10$2YfTUqxZdZMG7uPaHOB/..Xq1K5R0zJg16wsJDohxA5EFaRuG0hJy', 'RestaurantOwner', 'hafizusman@gmail.com', '', '2024-03-06 14:43:20', '2024-03-06 14:43:20'),
(14, 'imranshahid', '$2y$10$D2E9zeJpKtEM94rvBT.9geg5G5FLXISZrW63iTJfSpGDPOMlz.3Pq', 'RestaurantOwner', 'imran123@bing.com', '', '2024-03-06 14:43:46', '2024-03-06 14:43:46'),
(15, 'usera', '$2y$10$WTEaqNVvU7GTy1MygeN.ReakKdY54OBX2.WxCYtg846YshGYzHif.', 'RestaurantOwner', 'usera@hotmail.com', '', '2024-03-06 14:47:03', '2024-03-06 14:47:03'),
(16, 'buser', '$2y$10$vcFbZ4F6.4wgX4XaxEVaeOYdSy/zXV2XT3UoJo6a9Y9nnEPOABaNy', 'RestaurantOwner', 'buser@hotmail.com', '', '2024-03-06 14:55:47', '2024-03-06 14:55:47'),
(17, 'imran', '$2y$10$CdXY6u1h1wTH04dSvYcj4uSXa3nr0ZfvVA84Wh/ugN.BHCKzcfy2a', 'FoodLover', 'qasim@yahoo.com', 'Shahi Qila', '2024-03-06 14:57:37', '2024-03-08 13:47:45'),
(18, 'kamran', '$2y$10$Q0HST3.72SYedn//phtFmuY2XPtXNRpY9sElhzQPyFSHKyNtxD.9e', 'RestaurantOwner', 'kamran@yahoo.com', '', '2024-03-06 14:58:03', '2024-03-06 14:58:03'),
(19, 'omer', '$2y$10$WTI.guBpHEuxi496SlBu4eSxpdaGBd3pK2wRO1HsyLTp5Di24.FMy', 'FoodLover', 'omer@hotmail.com', 'Chungi Amar Sadhu', '2024-03-06 15:02:26', '2024-03-07 08:21:12'),
(20, 'luqman23', '$2y$10$x5HIXALZafYGtcA2VTh/mutcodd0YQTfryXFLbqvpr9uQPHFSRFom', 'RestaurantOwner', 'luqman@gmail.com', '', '2024-03-07 07:42:40', '2024-03-07 07:42:40'),
(23, 'luqman13', '$2y$10$0l7elkMRyrG5g319WQfU.ebi4b.yuAjnvrYVt.ngD4EsCeaaEi5bW', 'FoodLover', 'luqman@yahoo.com', 'Chah Jhabbay Wala', '2024-03-07 07:49:53', '2024-03-12 08:24:40'),
(24, 'yousaf', '$2y$10$SBKB3e.1Goxdllb7WNVls.507qaR1N30F5l6WCkAvWWZpcq2EYr6O', 'FoodLover', 'yousafimran@hotmail.com', 'Yuhanabad', '2024-03-07 07:51:35', '2024-03-07 07:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_chat_contact`
--

CREATE TABLE `whatsapp_chat_contact` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `SenderID` (`SenderID`),
  ADD KEY `ReceiverID` (`ReceiverID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`OfferID`),
  ADD KEY `RestaurantID` (`RestaurantID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`RatingID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `RestaurantID` (`RestaurantID`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`RestaurantID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `whatsapp_chat_contact`
--
ALTER TABLE `whatsapp_chat_contact`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `OfferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `RatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `RestaurantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `whatsapp_chat_contact`
--
ALTER TABLE `whatsapp_chat_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`SenderID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ReceiverID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`RestaurantID`) REFERENCES `restaurants` (`RestaurantID`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`RestaurantID`) REFERENCES `restaurants` (`RestaurantID`);

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
