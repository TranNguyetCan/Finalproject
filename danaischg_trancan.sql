-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 03:32 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `danaischg_trancan`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `pro_size_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `descriptions`) VALUES
(1, 'Shirt', 'shirt black'),
(2, 'Dresses', 'dresses for women\r\n'),
(3, 'Pans', 'pans clothing'),
(4, 'Blazer', 'blazer clothing'),
(5, 'Bomber', 'bomber clothing'),
(6, 'Long tee', 'long tee clothing'),
(7, 'Jacket', 'jacket clothing'),
(8, 'Short Skirt', 'Short Skirt for women\'s clothing');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230213124128', '2023-02-13 13:41:47', 430),
('DoctrineMigrations\\Version20230213124350', '2023-02-13 13:43:56', 48),
('DoctrineMigrations\\Version20230213131931', '2023-02-13 14:19:36', 43),
('DoctrineMigrations\\Version20230213132453', '2023-02-13 14:24:57', 79),
('DoctrineMigrations\\Version20230213132634', '2023-02-13 14:26:38', 33),
('DoctrineMigrations\\Version20230213132807', '2023-02-13 14:28:11', 66),
('DoctrineMigrations\\Version20230213133412', '2023-02-13 14:34:15', 30),
('DoctrineMigrations\\Version20230213133700', '2023-02-13 14:37:03', 44),
('DoctrineMigrations\\Version20230215085750', '2023-02-15 09:57:56', 425),
('DoctrineMigrations\\Version20230217141047', '2023-02-17 15:10:57', 734),
('DoctrineMigrations\\Version20230217160203', '2023-02-17 17:02:08', 68),
('DoctrineMigrations\\Version20230217180003', '2023-02-17 19:00:11', 37),
('DoctrineMigrations\\Version20230217180242', '2023-02-17 19:02:45', 23),
('DoctrineMigrations\\Version20230217180638', '2023-02-17 19:06:41', 72),
('DoctrineMigrations\\Version20230217183851', '2023-02-17 19:38:55', 68),
('DoctrineMigrations\\Version20230224103447', '2023-02-24 11:34:52', 132),
('DoctrineMigrations\\Version20230224103703', '2023-02-24 11:37:09', 34),
('DoctrineMigrations\\Version20230224103840', '2023-02-24 11:38:44', 152),
('DoctrineMigrations\\Version20230226182624', '2023-02-26 19:26:30', 84),
('DoctrineMigrations\\Version20230226192849', '2023-02-26 20:35:58', 45),
('DoctrineMigrations\\Version20230226200045', '2023-02-26 21:00:50', 37),
('DoctrineMigrations\\Version20230227094147', '2023-02-27 10:41:53', 540),
('DoctrineMigrations\\Version20230227145751', '2023-02-27 15:57:56', 586);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `delivery_local` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `username_id` int(11) NOT NULL,
  `cus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `date`, `total`, `delivery_local`, `status`, `username_id`, `cus_name`, `cus_phone`) VALUES
(93, '2023-02-27 11:17:17', '163.00', 'Spain', 0, 1, 'Que Tran', 934654321),
(94, '2023-02-27 11:21:31', '103.00', 'Spain', 1, 1, 'Que Tran', 934654321),
(95, '2023-02-27 11:23:58', '35.00', 'Spain', 1, 1, 'Que Tran', 934654321),
(96, '2023-02-27 18:20:37', '403.00', 'Spain', 0, 1, 'Que Tran', 987654322),
(97, '2023-02-27 20:43:42', '277.00', 'Spain', 0, 1, 'Que Tran', 987654322),
(99, '2023-02-27 20:47:44', '320.00', 'Spain', 0, 1, 'Que Tran', 987654321);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `pro_size_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `orders_id`, `quantity`, `pro_size_id`) VALUES
(150, 93, 1, 7),
(151, 93, 1, 41),
(152, 93, 1, 39),
(153, 94, 1, 7),
(154, 95, 1, 39),
(155, 96, 1, 66),
(156, 96, 10, 41),
(157, 97, 4, 8),
(158, 99, 7, 19);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `descriptions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `for_gender` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `status`, `descriptions`, `price`, `for_gender`, `image`, `supplier_id`) VALUES
(1, 1, 'Flower Shirt', 1, 'A Flower Shirt is a shirt clothing for women', '30.00', 1, 'Pleated_Short_Skirt_1.png', 1),
(3, 5, 'Storm Bomber Black', 1, 'Storm Bomber Black is a bomber clothing', '98.00', 0, 'Storm_Bomber_Black_2.png', 2),
(5, 6, 'Vintage Tee Natural ', 1, 'Vintage Tee Natural is a long tee', '68.00', 0, 'Vintage_Tee_Natural_2.png', 2),
(6, 7, 'Herdsman Turtleneck', 1, 'Herdsman Turtleneck is a long tee for men\'s clothing', '56.00', 0, 'Herdsman-Turtleneck-2-63f6eea9cae09.webp', 2),
(7, 7, 'Wool CPO Jacket Khaki Men', 1, 'Wool CPO Jacket Khaki Men is a jacket for men', '85.00', 0, 'Wool_CPO_Jacket_Khaki_Men_1.png', 1),
(16, 4, 'Leo Cutout Wool Blazer Blue', 1, 'Leo Cutout Wool Blazer Blue for women', '85.00', 1, 'Leo_Cutout_Wool_Blazer_Blue_1.png', 2),
(26, 3, 'Loopback Trouser Natural', 0, 'Brushed Loopback Trouser Natural is a pans for men\'s clothing', '57.00', 0, 'Brushed_Loopback_Trouser_Natural_1.png', 2),
(27, 7, 'Wool CPO Jacket Black Men', 0, 'Wool CPO Jacket Black Men is jacket for men\'s', '45.00', 0, 'Wool-CPO-Jacket-Black-Men-1-63f87b5caa222.webp', 2),
(28, 3, 'Brushed Trouser Venice', 0, 'Brushed Trouser Venice is a pans for men\'s clothing', '54.00', 0, 'Brushed-Trouser-Venice-1-63f88e6dc3c2f.webp', 1),
(32, 4, 'Leo Cutout Brown Blazer ', 0, 'Leo Cutout Wool Blazer Brown for women\'s clothing', '43.00', 1, 'Leo-Cutout-Wool-Blazer-Brown-3-63f9d22cec171.png', 2),
(33, 2, 'Camellia Floral Minidress', 0, 'Camellia Floral Minidress is a dresses for women\'s clothing', '54.00', 1, 'Camellia-Floral-Minidress-3-63f22e9d7e426.png', 2),
(35, 8, 'Cropped Jacket', 0, 'Cropped Jacket is a croptop for women\'s clothing', '54.00', 1, 'Cropped_Jacket.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pro_size`
--

CREATE TABLE `pro_size` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pro_size`
--

INSERT INTO `pro_size` (`id`, `product_id`, `size_id`, `quantity`) VALUES
(4, 6, 1, 278),
(7, 3, 2, 51),
(8, 5, 1, 0),
(14, 7, 2, 123),
(19, 27, 1, 0),
(39, 1, 2, 67),
(41, 1, 4, 4),
(48, 1, 1, 53),
(49, 1, 3, 3),
(66, 3, 1, 42),
(70, 32, 1, 43),
(72, 35, 1, 32);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `name`, `descriptions`) VALUES
(1, 'S', 'small size'),
(2, 'M', 'medium size'),
(3, 'L', 'large size'),
(4, 'XL', 'Big size');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`, `email`, `address`) VALUES
(1, 'Balenciaga', 984105896, 'balenciage@gmail.com', 'New York'),
(2, 'Versace', 876543212, 'versace@gmail.com', 'American');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `birthday`, `address`, `phone`, `gender`, `fullname`) VALUES
(1, 'tran', '[\"ROLE_USER\"]', '$2y$13$dNE8bsgxif7sssMhqxeCIuLKCfADM0HGt2aTQ2JhAgrTFxB85gIqG', '2023-02-05', 'Spain', '0987654322', 1, 'Que Tran'),
(2, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$24njYveqicBJCqqPCrIxBOn0phmwzivu/KaQr/tP0LRM.FEH1FBpe', '2023-02-01', 'Can Tho', '0987654321', 1, 'tran'),
(3, 'quangnd', '[\"ROLE_USER\"]', '$2y$13$ifygjgZKJy4XJ9Zf2Xn0NeThP.ZVD8JdF8gOJTrEqOrPQyHtks8f2', '2023-01-31', 'Can Tho', '0123456789', 0, 'Nguyen Duy Quang'),
(5, 'quetran', '[\"ROLE_USER\"]', '$2y$13$b3e5Zf9Y89bFYMuManPlfeXp/qx8.Nu44sNzw0JN2nf2pEfabvCBG', '2023-02-27', 'NewYork', '0934654321', 1, 'Tran Que');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA388B7A76ED395` (`user_id`),
  ADD KEY `IDX_BA388B7BC246EFC` (`pro_size_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398ED766068` (`username_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED896F46CFFE9AD6` (`orders_id`),
  ADD KEY `IDX_ED896F46BC246EFC` (`pro_size_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`),
  ADD KEY `IDX_D34A04AD2ADD6D8C` (`supplier_id`);

--
-- Indexes for table `pro_size`
--
ALTER TABLE `pro_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_27E091184584665A` (`product_id`),
  ADD KEY `IDX_27E09118498DA827` (`size_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pro_size`
--
ALTER TABLE `pro_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_BA388B7BC246EFC` FOREIGN KEY (`pro_size_id`) REFERENCES `pro_size` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398ED766068` FOREIGN KEY (`username_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_ED896F46BC246EFC` FOREIGN KEY (`pro_size_id`) REFERENCES `pro_size` (`id`),
  ADD CONSTRAINT `FK_ED896F46CFFE9AD6` FOREIGN KEY (`orders_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_D34A04AD2ADD6D8C` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `pro_size`
--
ALTER TABLE `pro_size`
  ADD CONSTRAINT `FK_27E091184584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_27E09118498DA827` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
