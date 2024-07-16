-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 09:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

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
-- Table structure for table `brach_product`
--

CREATE TABLE `brach_product` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch_name`, `branch_address`, `phone_number`, `name`, `address`, `product`) VALUES
(1, 'Ho Chi Minh', '123 Main St, Springfield', '555-1234', 'John Doe', '456 Elm St, Springfield', 'Books'),
(2, 'Can Tho\r\n', '456 North St, Springfield', '555-5678', 'Jane Smith', '789 Pine St, Springfield', 'Electronics'),
(3, 'An Giang', '789 South St, Springfield', '555-8765', 'Alice Johnson', '101 Maple St, Springfield', 'Clothing'),
(4, 'Ha Noi\r\n', '101 East St, Springfield', '555-4321', 'Bob Brown', '202 Oak St, Springfield', 'Furniture'),
(5, 'Binh Dinh\r\n', '202 West St, Springfield', '555-3456', 'Charlie Davis', '303 Birch St, Springfield', 'Groceries'),
(6, 'Central Branch', '303 Central St, Springfield', '555-6543', 'Diana Evans', '404 Cedar St, Springfield', 'Hardware'),
(7, 'Uptown Branch', '404 Uptown St, Springfield', '555-7890', 'Eve Harris', '505 Walnut St, Springfield', 'Pharmacy'),
(8, 'Downtown Branch', '505 Downtown St, Springfield', '555-0987', 'Frank Moore', '606 Cherry St, Springfield', 'Sporting Goods'),
(9, 'Suburb Branch', '606 Suburb St, Springfield', '555-2345', 'Grace King', '707 Ash St, Springfield', 'Toys'),
(10, 'Riverside Branch', '707 Riverside St, Springfield', '555-6789', 'Henry Lee', '808 Willow St, Springfield', 'Jewelry');

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
  `name` varchar(255) NOT NULL,
  `descriptions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `descriptions`) VALUES
(1, 'Tealight Candle', 'This is the smallest type of candle and is often used to float on water or place in small flower pots to create a highlight.  Although the duration of Tealight candles is quite short, only about 3.5 to 6 hours, that is the attraction of this type of candl'),
(2, 'Votive Candle', 'This type of candle is commonly used in churches with a thick and short candle body, perfect for aromatherapy. When placing Votive candles in a heat-resistant cup, the candle will burn completely without wasting wax, allowing you to enjoy the fragrance to'),
(3, 'Gel Candle', 'Gel candles are a great choice if you want to use scented candles as an interior decoration. Gel candles are made from transparent gel covering dried flowers and seashells, creating an eye-catching beauty. You can place them in the living room, bedroom or'),
(4, 'Candle Cup', 'Scented candles stored in tin boxes or glass jars are called cup candles and are very popular today. With cup candles, you do not need to prepare a candle holder but can light the candle right after opening the lid, so it is very convenient when traveling');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `end_date` date NOT NULL,
  `discount_code` varchar(255) NOT NULL,
  `discount_percentage` varchar(255) NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `end_date`, `discount_code`, `discount_percentage`, `start_date`) VALUES
(2, '2025-01-01', 'CODE789000', '50', '2024-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240601145243', '2024-06-01 16:52:51', 152),
('DoctrineMigrations\\Version20240601172527', '2024-06-01 19:25:33', 46),
('DoctrineMigrations\\Version20240602194704', '2024-06-02 21:47:40', 1134),
('DoctrineMigrations\\Version20240603144730', '2024-06-03 21:47:38', 36),
('DoctrineMigrations\\Version20240603162454', '2024-06-03 18:25:04', 46),
('DoctrineMigrations\\Version20240603162739', '2024-06-03 18:27:45', 27),
('DoctrineMigrations\\Version20240603190248', '2024-06-03 21:02:58', 3507),
('DoctrineMigrations\\Version20240605182559', '2024-06-05 20:26:08', 4241),
('DoctrineMigrations\\Version20240612172821', '2024-06-12 19:28:30', 41),
('DoctrineMigrations\\Version20240612172935', '2024-06-12 19:29:43', 39),
('DoctrineMigrations\\Version20240714173000', '2024-07-14 19:34:29', 39),
('DoctrineMigrations\\Version20240716025724', '2024-07-16 04:57:34', 1746);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `delivery_local` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `username_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`) VALUES
(2, 'PayPal'),
(4, 'Cash on Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `paypal`
--

CREATE TABLE `paypal` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paypal`
--

INSERT INTO `paypal` (`id`, `full_name`, `email`, `address`, `password`, `confirmpassword`) VALUES
(4, 'tran nguyet can', 'Nguyetcan@Paypal.com', 'Can Tho', '$2y$13$AlNb.Mf7pZ6WzDn0woeLsOMMXDJdgQzl1tg7FjnCL7d7PHOUDzu.a', '123456'),
(5, 'tran nguyet can', 'Nguyetcan@Paypal.com', 'Can Tho', '$2y$13$Fs35FQV7VY090/jw5w5.oulzYyzg2iUWeEO3NRtBkb.PbtY7X6u3G', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `descriptions` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `for_gender` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `branch` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `status`, `descriptions`, `price`, `for_gender`, `image`, `supplier_id`, `rating`, `branch`) VALUES
(1, 2, 'VESTA VANILA', 0, 'White tea is a type of tea that is gently processed from young tea leaves and has not undergone much oxidation, retaining its fresh flavor and natural aroma. When transformed into a scented candle scent, white tea brings a peaceful and sophisticated atmos', 5.00, 1, 'cinnamon-flavor-6695de167c3ed.webp', 4, NULL, ''),
(5, 1, 'Cat\'s legs', 0, 'The soothing scent from candles can help reduce stress, anxiety and create a feeling of peace. Popular aromas such as lavender, lemon, and jasmine are widely used in scented candles to bring wonderful moments of relaxation.', 8.00, 0, 'd2661efbb0db530902d22f4b2dcc789e-6690172921f3a.jpg', 4, NULL, ''),
(6, 3, 'VESTA Startfish', 0, 'The meticulousness and beauty of the gel candle jar will make you stunned and surprised. Made from beautiful dried flowers, the candle also has a gentle scent from natural essential oils, helping you feel more relaxed and comfortable. This is not only a g', 6.00, 1, 'Starfish-6690182cdb36c.jpg', 4, NULL, ''),
(7, 2, 'VESTA Lemon', 0, 'Lemon scent is also one of the popular ingredients and should be present in your candle. The main ingredient in lemon essential oil has very strong antioxidant properties as well as creating a faint, not too harsh scent, suitable for use when needing to d', 8.00, 0, 'Lemon-6690188a27d06.jpg', 4, NULL, ''),
(16, 4, 'VESTA Cinnamon Vanilla', 0, 'The delicate combination of spicy Cinnamon scent with sweet Vanilla scent, scented candles evoke a feeling of togetherness and familiarity, helping to relax the spirit and warm the space.', 8.00, 1, 'Cinnamon-Vanilla-669018d10dc8a.webp', 4, NULL, ''),
(26, 3, 'VESTA Chrysanthemum Gel Candle', 0, 'The candlelight no longer simply shimmers through the candle wick, but will spread through the decorative gel layer as if shining on a beautiful mirror. This is not only a great aroma therapy but also a useful \"virtual living\" tool.', 7.00, 1, 'ChrysanthemumMini-669021dee1804.jpg', 4, NULL, ''),
(27, 1, 'VESTA Bear Candle', 0, 'The soothing scent from candles can help reduce stress, anxiety and create a feeling of peace. Popular aromas such as lavender, lemon, and jasmine are widely used in scented candles to bring wonderful moments of relaxation.', 4.00, 1, 'gau-jpg-6690222d637c8.webp', 4, NULL, ''),
(28, 2, 'VESTA Tea plant', 0, 'Purify and nourish the soul with natural tea scent. Closing your eyes to meditate makes people feel comfortable and relaxed.', 8.00, 0, 'tea-plant-66902384c5e5f.jpg', 4, NULL, ''),
(32, 1, 'VESTA Orange Candle', 0, 'the smell of oranges, exchanging hugs, holding hands tightly, a little sweetness for the couple for the season of love. After a day of reeling from life, returning home, lighting a jar of candles, seeing the words \"Darling, I\'m home\" sparkling brightly, m', 3.00, 1, 'Orange-669024003a036.webp', 4, NULL, ''),
(33, 1, 'VESTA flower', 0, 'The soothing scent from candles can help reduce stress, anxiety and create a feeling of peace. Popular aromas such as lavender, lemon, and jasmine are widely used in scented candles to bring wonderful moments of relaxation.', 2.00, 1, 'vn-11134201-7qukw-liifb8wobh7619-669024bcd46b3.jpg', 4, NULL, ''),
(35, 4, 'VESTA White tea', 0, 'White tea is a type of tea that is gently processed from young tea leaves and has not undergone much oxidation, retaining its fresh flavor and natural aroma. When transformed into a scented candle scent, white tea brings a peaceful and sophisticated atmos', 5.00, 1, 'white-tea-669024e56c34c.jpg', 4, NULL, '');

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
(4, 6, 1, 277),
(8, 5, 1, 0),
(14, 7, 2, 123),
(19, 27, 1, -1),
(39, 1, 2, 67),
(41, 1, 4, 3),
(48, 1, 1, 53),
(49, 1, 3, 2),
(70, 32, 1, 42),
(72, 35, 1, 32);

-- --------------------------------------------------------

--
-- Table structure for table `pro_sup`
--

CREATE TABLE `pro_sup` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `date_to_deliver` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descriptions` varchar(255) NOT NULL
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
  `name` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`, `email`, `address`) VALUES
(4, 'CANDLE', 2147483647, 'Candle@gmail.com', 'Vietnam');

-- --------------------------------------------------------

--
-- Table structure for table `used_voucher`
--

CREATE TABLE `used_voucher` (
  `id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `voucher` varchar(255) NOT NULL,
  `deal` varchar(255) NOT NULL,
  `use_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `used_voucher`
--

INSERT INTO `used_voucher` (`id`, `cus_name`, `voucher`, `deal`, `use_at`) VALUES
(2, 'Dat 2', 'CODE789000', '4', '2024-07-15 01:41:00'),
(3, 'bao anh', 'ttt382', '3', '2024-07-10 02:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` tinyint(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `birthday`, `address`, `phone`, `gender`, `fullname`, `avatar`) VALUES
(1, 'Baoanh', '[\"ROLE_USER\"]', '$2y$13$WsJ4.0R.9FweR8NVCzx6q.GRU/ptFa0geYHmLVqt4IAm6X4ghMJz2', '2003-07-12', 'Can tho', '0987654324', 1, 'Lam Bao Anh', 'avatar-6695dd5f9fce9.jpg'),
(3, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$jvt2X9A84leeUri3MjDL3eLbYbE9tZ6Mjr2wszDf1Nsvp1HPb35Z6', '2024-07-07', 'Can tho', '987654324', 1, 'Tran Nguyet Can', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `deal` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `product_id`, `deal`, `start_date`, `end_date`, `description`) VALUES
(3, 14, 2, '2024-07-10 22:31:00', '2024-07-15 22:31:00', 'qwww'),
(8, 4, 9, '2024-07-12 09:58:00', '2024-07-31 09:58:00', 'hhh');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_id`, `user_id`) VALUES
(2, 1, 8),
(3, 5, 8),
(4, 27, 8),
(7, 7, 8),
(8, 26, 8),
(9, 33, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brach_product`
--
ALTER TABLE `brach_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `discount`
--
ALTER TABLE `discount`
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
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal`
--
ALTER TABLE `paypal`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pro_sup`
--
ALTER TABLE `pro_sup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EB1876714584665A` (`product_id`),
  ADD KEY `IDX_EB1876712ADD6D8C` (`supplier_id`);

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
-- Indexes for table `used_voucher`
--
ALTER TABLE `used_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1392A5D84584665A` (`product_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9CE12A314584665A` (`product_id`),
  ADD KEY `IDX_9CE12A31A76ED395` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brach_product`
--
ALTER TABLE `brach_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paypal`
--
ALTER TABLE `paypal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `pro_sup`
--
ALTER TABLE `pro_sup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `used_voucher`
--
ALTER TABLE `used_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

--
-- Constraints for table `pro_sup`
--
ALTER TABLE `pro_sup`
  ADD CONSTRAINT `FK_EB1876712ADD6D8C` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
  ADD CONSTRAINT `FK_EB1876714584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `FK_1392A5D84584665A` FOREIGN KEY (`product_id`) REFERENCES `pro_size` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `FK_9CE12A314584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_9CE12A31A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
