-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2020 at 10:49 PM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corephpadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(25) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `series_id` varchar(60) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `admin_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `user_name`, `password`, `series_id`, `remember_token`, `expires`, `admin_type`) VALUES
(3, 'root', '$2y$10$q.JhGHXJ7bStQwqlxBt9JeCfRsgAAQl5CkAWvUmBdT5M2VnkBUr2.', NULL, NULL, NULL, 'admin'),
(4, 'superadmin', '$2y$10$HJ9XgJOyYs.PkV5aek/qB.2XZF5ItzY36W90HM5a2J0IdoOcwtM5W', 'DJf6u76sLwu3CVpw', '$2y$10$ltxNketjQ7xG.XjwoDIqAOB5TxlUr6QQdzAFqkf6y8UMIKWDHX0Ji', '2018-12-21 15:17:46', 'super');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `notification_id` int(11) NOT NULL,
  `notification_type` varchar(255) NOT NULL,
  `created-at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `associate_notifications`
--

CREATE TABLE `associate_notifications` (
  `notification_id` int(11) NOT NULL,
  `notification_type` varchar(255) NOT NULL,
  `created-at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL,
  `associate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `associate_products`
--

CREATE TABLE `associate_products` (
  `id` int(10) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `product_owner` int(25) NOT NULL,
  `product_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `file_name` text NOT NULL,
  `product_price` varchar(6) DEFAULT NULL,
  `product_status` varchar(255) NOT NULL DEFAULT 'Checking',
  `product_quality` varchar(15) DEFAULT NULL,
  `product_status_reason` text,
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `associate_products`
--
DELIMITER $$
CREATE TRIGGER `new_associate_product` AFTER INSERT ON `associate_products` FOR EACH ROW INSERT INTO `admin_notifications`
   ( 
     notification_type,
       id
   )
   VALUES
   ( 'new_associate_product',
     NEW.id
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `remove_admin_notifications` AFTER DELETE ON `associate_products` FOR EACH ROW delete from `admin_notifications`  where id = old.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `remove_associate_notifications` AFTER DELETE ON `associate_products` FOR EACH ROW delete from `associate_notifications` 
where id=old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_account`
--

CREATE TABLE `auth_user_account` (
  `id` int(22) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `account_status` varchar(255) NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(25) NOT NULL,
  `category_base` varchar(50) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_base`, `category_name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(16, 'Bridal Wear', 'Bridal-Gown', 4, '2020-05-16 14:58:20', 0, NULL),
(18, 'Cosmotics', 'Bridal-Makeup', 4, '2020-05-16 14:59:23', 0, NULL),
(17, 'Bridal Wear', 'Brocket-Suits', 4, '2020-05-16 14:58:44', 0, NULL),
(10, 'Electronics', 'Ear-buds', 4, '2020-05-16 14:55:58', 0, NULL),
(14, 'Accessories', 'Handbags', 4, '2020-05-16 14:57:39', 0, NULL),
(11, 'Electronics', 'Head-phones', 4, '2020-05-16 14:56:19', 0, NULL),
(15, 'Bridal Wear', 'Lehanga', 4, '2020-05-16 14:58:00', 0, NULL),
(3, 'Clothing', 'Mens-Fashion', 4, '2020-05-16 06:22:08', 5, '2020-05-16 11:43:05'),
(7, 'Accessories', 'Shoes', 5, '2020-05-16 11:04:40', 0, NULL),
(12, 'Electronics', 'Smart-watches', 4, '2020-05-16 14:56:46', 0, NULL),
(9, 'Electronics', 'Speakers', 5, '2020-05-16 11:07:08', 5, '2020-05-16 11:07:25'),
(6, 'Accessories ', 'Watches', 5, '2020-05-16 11:03:53', 0, NULL),
(4, 'Clothing', 'Womens-Fashion', 5, '2020-05-16 11:01:30', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `owner` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'confirming',
  `order_status_reason` text,
  `delivery_medium` varchar(255) DEFAULT NULL,
  `delivery_tracking_number` varchar(255) DEFAULT NULL,
  `order_updated_on` timestamp NULL DEFAULT NULL,
  `ordered_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `new_order` AFTER INSERT ON `orders` FOR EACH ROW INSERT INTO `order_notifcations` (  notification_type,owner,order_id,product_id
,user_id)
VALUES ('new_order',NEW.owner,NEW.order_id,NEW.product_id,NEW.user_id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_notifcations`
--

CREATE TABLE `order_notifcations` (
  `notification_id` int(11) NOT NULL,
  `owner` int(11) DEFAULT NULL,
  `notification_type` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `product_owner` int(255) DEFAULT NULL,
  `product_belongs_to` varchar(255) NOT NULL DEFAULT 'owner',
  `product_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `file_name` text NOT NULL,
  `product_cost_price` int(11) DEFAULT NULL,
  `product_price` varchar(6) DEFAULT NULL,
  `product_discount_price` varchar(100) DEFAULT NULL,
  `product_quality` varchar(15) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_owner`, `product_belongs_to`, `product_desc`, `product_category`, `file_name`, `product_cost_price`, `product_price`, `product_discount_price`, `product_quality`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(26, 'Allen solley', NULL, 'owner', '*_ALLEN SOLLY _ SHIRTS*\\r\\n\\r\\n*High QUALITY  print FULL Sleeves Shirts*\\r\\n\\r\\n *Size : M L XL*\\r\\n*Shipping free*\\r\\n\\r\\n*QUALITY Assured\\r\\n\\r\\n*FULL STOCK AVAILABLE SET WISE ALSO AVAILABLE*\\r\\n\\r\\n *OPEN ORDERS*', 'Mens-Fashion', '5ebfd99a45bcf-IMG-20200516-WA0063.jpg,5ebfd99a46228-IMG-20200516-WA0062.jpg,5ebfd99a46642-IMG-20200516-WA0061.jpg', NULL, '1100', '800', 'IST COPY ', 5, '2020-04-16', 0, NULL),
(27, 'Niki boxers ', NULL, 'owner', '*BRAND — NIKE*\\r\\n\\r\\n*Tracksuit*\\r\\n*Superior Quality*\\r\\n*HALF SLEEVES *\\r\\n*Imported Dryfit Fabric*\\r\\n*Sizes M / L / XL / XXL*\\r\\n*Dry Fit stuff with comfort Fit & full brand Look*', 'Mens-Fashion', '5ebfdad04e865-IMG-20200516-WA0065.jpg,5ebfdad04efe4-IMG-20200516-WA0064.jpg', NULL, '1750', '1400', 'IST COPY ', 5, '2020-03-16', 0, NULL),
(28, 'Denim shirts', NULL, 'owner', '*Denim Shirts*\\r\\n\\r\\n*us polo*\\r\\n*Denim*\\r\\n* 3Colors*\\r\\n*sky, blue, Black*\\r\\nSize :M, L, XL*\\r\\nAvailable full stoke*\\r\\n', 'Mens-Fashion', '5ebfdb3c057d6-IMG-20200516-WA0066.jpg,5ebfdb3c05c0e-IMG-20200516-WA0067.jpg,5ebfdb3c060bb-IMG-20200516-WA0068.jpg', NULL, '1150', '800', 'IST COPY ', 5, '2020-05-29', 0, NULL),
(29, 'Gshock ', NULL, 'owner', '*G-Shock Colour Update, 7A Premium Quality, All 3 colours FULL Stock Available.* \\r\\n\\r\\nBlack Silver \\r\\n White (Autolight) \\r\\nGreen Camouflage\\r\\n\\r\\nBook your orders *NOW.*\\r\\n*Free  Normal box.* \\r\\n\\r\\n *Note - This is World Time Watch. Quality of the delivered Product will be same as shown in pictures. No compromise or changes seen.* ', 'Watches', '5ec01f698a72a-IMG-20200516-WA0070.jpg,5ec01f698aacc-IMG-20200516-WA0071.jpg,5ec01f698ad95-IMG-20200516-WA0072.jpg', NULL, '1950', '1550', 'IST COPY ', 3, '2020-05-16', 0, NULL),
(30, 'Patek Philippe', NULL, 'owner', '*Full Stock\r\n\r\n*Exclusively designed* \r\n\r\n*Patek philippe now in rose gold case with steel back. A perfect combination of brown leather and rose gold dail.*\r\n\r\n\r\n* Patek Philippe\r\n* For men\r\n* 7A\r\n* Feature;\r\n-Medium dial size \r\n-Rose gold case\r\n-Best patek philippe\r\n-Fully Automatic\r\n-12 hr dial\r\n-Brown leather strap \r\n-Round Case\r\n-Quartz movement \r\n\r\n*With Brand Box *\r\n', 'Watches', '5ec02a4ce2765-IMG-20200516-WA0112.jpg,5ec02a4ce2c84-IMG-20200516-WA0111.jpg', NULL, '2850', '2300', 'IST COPY ', 3, '2020-05-29', 3, '2020-05-16 18:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `init_address` varchar(255) DEFAULT NULL,
  `final_address` varchar(255) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `fk_assocaiates_product` (`id`);

--
-- Indexes for table `associate_notifications`
--
ALTER TABLE `associate_notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `fk_assocaiates_account_notific` (`associate_id`);

--
-- Indexes for table `associate_products`
--
ALTER TABLE `associate_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_owner_fk` (`product_owner`);

--
-- Indexes for table `auth_user_account`
--
ALTER TABLE `auth_user_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_product` (`product_id`),
  ADD KEY `fk_users` (`user_id`),
  ADD KEY `fk_assocaites` (`owner`);

--
-- Indexes for table `order_notifcations`
--
ALTER TABLE `order_notifcations`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `order_fk` (`order_id`),
  ADD KEY `product_fk` (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `associate_fk` (`owner`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `owner_fk` (`product_owner`),
  ADD KEY `category_fk` (`product_category`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `associate_notifications`
--
ALTER TABLE `associate_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `associate_products`
--
ALTER TABLE `associate_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auth_user_account`
--
ALTER TABLE `auth_user_account`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_notifcations`
--
ALTER TABLE `order_notifcations`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `associate_notifications`
--
ALTER TABLE `associate_notifications`
  ADD CONSTRAINT `fk_assocaiates_account_notific` FOREIGN KEY (`associate_id`) REFERENCES `associate_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `associate_products`
--
ALTER TABLE `associate_products`
  ADD CONSTRAINT `product_owner_fk` FOREIGN KEY (`product_owner`) REFERENCES `associate_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_assocaites` FOREIGN KEY (`owner`) REFERENCES `associate_accounts` (`id`),
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`user_id`) REFERENCES `user_profiles` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_notifcations`
--
ALTER TABLE `order_notifcations`
  ADD CONSTRAINT `associate_fk` FOREIGN KEY (`owner`) REFERENCES `associate_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `orders` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`product_category`) REFERENCES `categories` (`category_name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `owner_fk` FOREIGN KEY (`product_owner`) REFERENCES `associate_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_pk_profile` FOREIGN KEY (`user`) REFERENCES `auth_user_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
