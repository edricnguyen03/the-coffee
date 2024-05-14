-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2024 at 03:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the-coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `cart_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `cart_items`) VALUES
(1, 2, '[{\"idProduct\":\"3\",\"quantity\":27},{\"idProduct\":\"4\",\"quantity\":8}]'),
(2, 5, '[{\"idProduct\":\"2\",\"quantity\":8},{\"idProduct\":\"3\",\"quantity\":9}]'),
(3, 4, '[{\"idProduct\":\"2\",\"quantity\":3},{\"idProduct\":\"3\",\"quantity\":2},{\"idProduct\":\"1\",\"quantity\":1}]');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(1, 'Cà Phê đóng gói', 1),
(2, 'Quà tặng cao cấp', 1),
(3, 'Vật phẩm bán lẻ', 1),
(4, 'Cà phê nhập khẩu', 1),
(5, 'Đặc sản bản địa', 1),
(6, '  ', 1),
(7, '123123123123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `name_receiver` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address_receiver` text COLLATE utf8mb4_general_ci NOT NULL,
  `phone_receiver` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `total` double NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `order_status` tinyint NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name_receiver`, `address_receiver`, `phone_receiver`, `note`, `total`, `payment_status`, `order_status`, `create_at`) VALUES
(1, 2, 'Nguyễn Thanh Duy', 'Long an 1, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0334202221', NULL, 100000, 1, 5, '2024-04-30 07:02:42'),
(2, 3, 'Nguyễn Hòa', 'Long an 2, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0334202331', NULL, 200000, 0, 5, '2024-04-30 07:02:42'),
(3, 5, 'Tiến Phan', 'Phạm Văn Hai, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0334202331', NULL, 300000, 1, 5, '2024-04-30 07:02:42'),
(4, 7, 'Nguyễn Hoàng', 'Đường 835, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0332231331', NULL, 400000, 1, 5, '2024-04-30 07:02:42'),
(5, 2, 'Huy Lê', 'Đường CMT8, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0342221414', NULL, 500000, 1, 2, '2024-04-30 07:02:42'),
(6, 4, 'Nguyễn Minh', 'Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0981214422', NULL, 600000, 1, 4, '2024-04-30 07:02:42'),
(7, 5, 'Nguyễn Bí', 'Đường 835, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0332231331', NULL, 700000, 1, 5, '2024-04-30 07:02:42'),
(8, 6, 'Nguyễn Hoàng', 'Đường 835, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0332231331', NULL, 1000000, 1, 1, '2024-04-30 07:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint NOT NULL,
  `order_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `qty`) VALUES
(1, 1, 1, 1),
(2, 1, 3, 1),
(3, 2, 5, 1),
(4, 2, 4, 1),
(5, 3, 4, 3),
(6, 4, 7, 1),
(7, 4, 5, 2),
(8, 5, 1, 1),
(9, 6, 3, 2),
(10, 7, 5, 1),
(11, 7, 2, 1),
(12, 8, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`) VALUES
(1, 'admin.user', 'Quản lý người dùng'),
(2, 'admin.category', 'Quản lý danh mục'),
(3, 'admin.product', 'Quản lý sản phẩm'),
(4, 'admin.order', 'Xử lý đơn hàng'),
(5, 'admin.role', 'Quản lý vai trò'),
(6, 'admin.dashboard', 'Xem thống kê'),
(7, 'admin.provider', 'Quản lý nhà cung cấp'),
(8, 'admin.receipt', 'Quản lý phiếu nhập'),
(9, 'admin.permission', 'Phân quyền');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint NOT NULL,
  `role_id` bigint NOT NULL,
  `permission_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(37, 3, 9),
(40, 4, 1),
(41, 4, 2),
(42, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `thumb_image` text COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` bigint NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `weight` int NOT NULL DEFAULT '500',
  `price` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `stock` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `thumb_image`, `category_id`, `description`, `content`, `weight`, `price`, `status`, `stock`) VALUES
(1, 'Cà Phê Hoà Tan Đậm Vị Việt (18 gói x 16 gam)', 'c-a-ph-e-ho-a-tan-dm-v-vit-18-g-oi-x-16-gam', '1.jpg', 1, 'Cà Phê Hoà Tan Đậm Vị Việt', 'tặng kèm phin nhôm', 500, 337000, 1, 188),
(2, 'Cà Phê Sữa Đá Hòa Tan Túi 25x22G', 'ca-phe-sua-da', '2.jpg', 1, 'Cà Phê Sữa Đá Hòa Tan Túi', 'tặng kèm phin nhôm', 390, 110000, 1, 170),
(3, 'Thùng 24 Lon Cà Phê Sữa Đá', 'thung-24-lon', '3.jpg', 2, 'Thùng 24 Lon Cà Phê Sữa Đá', 'tặng kèm phin nhôm', 400, 190000, 1, 101),
(4, 'Cà Phê Đen Đá Túi (30 gói x 16g)', 'ca-phe-den-da-tui', '4.jpg', 1, 'Cà Phê Đen Đá Túi (30 gói x 16g)', 'tặng kèm phin nhôm', 150, 99000, 1, 101),
(5, 'Cà Phê Sữa Đá Chai Fresh 250ML', 'ca-phe-sua-da', '5.jpg', 3, 'Cà Phê Sữa Đá Chai Fresh 250ML', 'tặng kèm phin nhôm', 520, 346000, 1, 103),
(6, 'Trà Sữa Oolong Nướng Trân Châu Chai Fresh 500ML', 'tra-sua-o-long', '6.jpg', 3, 'Trà Sữa Oolong Nướng Trân Châu Chai Fresh 500ML', 'tặng kèm phin nhôm', 430, 200000, 1, 98),
(7, 'Trà Đào Cam Sả Chai Fresh 500ML', 'tra-dao-cam-sa', '7.jpg', 3, 'Trà Đào Cam Sả Chai Fresh 500ML', 'tặng kèm phin nhôm', 560, 400000, 1, 101),
(8, 'Cà Phê Sữa Đá Hòa Tan (10 gói x 22g)', 'ca-phe-sua-hoa-tan', '8.jpg', 1, 'Cà Phê Sữa Đá Hòa Tan (10 gói x 22g)', 'tặng kèm phin nhôm', 770, 559000, 1, 100),
(9, 'Cà Phê Sữa Đá Pack 6 Lon', 'ca-phe-sua-da-pack', '9.jpg', 2, 'Cà Phê Sữa Đá Pack 6 Lon', 'tặng kèm phin nhôm', 1000, 700000, 1, 100),
(10, 'Tri Ân Thầy Cô Loại A', 'tri-an-thay-co-loai-a', 'product-default.png', 2, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 200, 95000, 1, 100),
(11, 'Tri Ân Thầy Cô Loại B', 'tri-an-thay-co-loai-b', 'product-default.png', 2, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 600, 500000, 1, 100),
(12, 'Espresso Nóng', 'espresso', '10.jpg', 3, 'Cà phê đậm đà hương vị Ý', 'tặng kèm phin nhôm', 390, 110000, 1, 150),
(13, 'Americano Nóng', 'americano', '11.jpg', 3, 'Hương vị nhẹ nhàng americano', 'tặng kèm phin nhôm', 400, 190000, 1, 101),
(14, 'Cold Brew Truyền Thống', 'cold-brew', '12.jpg', 3, 'Độc lạ cà phê ủ lạnh', 'tặng kèm phin nhôm', 500, 800000, 1, 103),
(15, 'Cold Brew Phúc Bồn Tử', 'cold-brew-phuc-bon-tu', '14.jpg', 3, 'Cà phê sinh viên nổi tiếng', 'tặng kèm phin nhôm', 560, 45000, 1, 101),
(16, 'Phin Sữa Tươi Bánh Flan', 'phin-sua-tuoi-banh-flan', '15.jpg', 3, 'Món quà ý nghĩa cho cha mẹ', 'tặng kèm phin nhôm', 770, 559000, 1, 100),
(17, 'Trà Xanh Espresso Marble', 'tra-xanh-espresso-marble', '16.jpg', 3, 'Đặc sắc bản địa người việt nam', 'tặng kèm phin nhôm', 1000, 60000, 1, 100),
(18, 'Cà Phê Đen Đá Không Đường', 'den-da-khong-duong', '17.jpg', 3, 'Tận hưởng vị đắng mát lạnh của cà phê', 'tặng kèm phin nhôm', 200, 45000, 1, 100),
(19, 'Cà Phê Sữa Đá', 'ca-phe-sua-da', '18.jpg', 3, 'Thức uống hoàn hảo cho phố phường', 'tặng kèm phin nhôm', 300, 50000, 1, 100),
(20, 'Cappuccino Đá', 'cappuccino', '19.jpg', 3, 'Béo ngậy cappuccino', 'Tặng kèm pin nhôm', 500, 300000, 1, 200);

-- --------------------------------------------------------

--
-- Table structure for table `product_receipt`
--

CREATE TABLE `product_receipt` (
  `id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `receipt_id` bigint NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `product_price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_receipt`
--

INSERT INTO `product_receipt` (`id`, `product_id`, `receipt_id`, `quantity`, `product_price`) VALUES
(1, 1, 1, 50, 10000),
(2, 2, 1, 50, 80000),
(3, 3, 1, 50, 80000),
(4, 4, 1, 50, 100000),
(5, 5, 2, 50, 80000),
(6, 6, 2, 50, 100000),
(7, 7, 2, 50, 100000),
(8, 8, 2, 50, 50000),
(9, 9, 3, 50, 30000),
(10, 10, 3, 50, 80000),
(11, 11, 3, 50, 80000),
(12, 1, 3, 50, 100000),
(13, 2, 4, 50, 40000),
(14, 3, 4, 50, 40000),
(15, 4, 4, 50, 60000),
(16, 5, 4, 50, 70000),
(17, 6, 5, 50, 40000),
(18, 7, 5, 50, 50000),
(19, 8, 5, 50, 70000),
(20, 9, 5, 50, 100000),
(21, 10, 6, 50, 110000),
(22, 11, 6, 50, 70000),
(23, 1, 6, 50, 30000),
(24, 2, 6, 50, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `name`, `description`, `status`) VALUES
(1, 'Cà phê Trung Nguyên', 'Nhà cung cấp chính của của hàng', 1),
(2, 'Cà phê chồn DakLak', 'Nhà cung cấp sản phẩm sấy khô hàng đầu', 1),
(3, 'Công ty cà phê Quyết Thắng', 'Sản phẩm chất lượng hàng đầu', 1),
(4, 'Cà phê Việt Nam VinaCoffee', 'Giá cả đi kèm với chất lượng', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `provider_id` bigint NOT NULL,
  `total` int NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `name`, `provider_id`, `total`, `create_at`) VALUES
(1, 'Hóa đơn nhập hàng 1', 1, 200, '2024-05-14 11:25:18'),
(2, 'Hóa đơn nhập hàng 2', 2, 200, '2024-05-14 11:25:18'),
(3, 'Hóa đơn nhập hàng 3', 3, 200, '2024-05-14 11:25:18'),
(4, 'Hóa đơn nhập hàng 4', 4, 200, '2024-05-14 11:25:18'),
(5, 'Hóa đơn nhập hàng 5', 3, 200, '2024-05-14 11:25:18'),
(6, 'Hóa đơn nhập hàng 6', 1, 200, '2024-05-14 11:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `is_employee` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `is_employee`) VALUES
(1, 'Super Admin', 'Người dùng quyền lực', 1),
(2, 'User', 'Người dùng', 0),
(3, 'Chức trò chơi', 'sdfsdfsfsdf', 0),
(4, 'haáy ém jú fd gì', 'fdsfsdfsdffdsfsd 42432@@$$$', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '$2y$10$1DrA6DFLnvGNiwxDuwLKT.LmAnRir1J51q4ii41pw.08pNKoL8JfC',
  `role_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `password`, `role_id`) VALUES
(1, 'Người dùng tối cao', 'admin@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 1),
(2, 'Usertest', 'user1@gmail.com', 1, '$2y$10$ars8ZBKnJYi7W7PLlTNG4eT3M1taj7g2bWBdOMYVb.fI1d5AZM95W', 2),
(3, 'Người dùng', 'user2@gmail.com', 1, '1$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(4, 'Người dùng', 'user3@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(5, 'Người dùng', 'user4@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(6, 'Người dùng', 'user5@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(7, 'Tài khoản bị khoá', 'ban1@gmail.com', 0, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(8, 'Tài khoản bị khoá', 'ban2@gmail.com', 0, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(9, 'Tài khoản bị khoá', 'ban3@gmail.com', 0, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(10, 'Tài khoản bị khoá', 'ban4@gmail.com', 0, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(11, 'Người dùng', 'tester@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 1),
(12, 'Người dùng', 'coffeelover@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(13, 'Người dùng', 'coffeehater@gmail.com', 1, '1$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(14, 'Người dùng', 'undefined@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(15, 'Người dùng', '404notfound4@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(16, 'Người dùng', 'coffeelar@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(17, 'Edric', 'test123@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carts_user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user_id` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_products_order_id` (`order_id`),
  ADD KEY `fk_order_products_product_id` (`product_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_id` (`role_id`,`permission_id`),
  ADD KEY `fk_permission_role_permission_id` (`permission_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_category_id` (`category_id`);

--
-- Indexes for table `product_receipt`
--
ALTER TABLE `product_receipt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_receipt_receipt_id` (`receipt_id`),
  ADD KEY `fk_product_receipt_product_id` (`product_id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_receipt_provider_id` (`provider_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_receipt`
--
ALTER TABLE `product_receipt`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `fk_order_products_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_order_products_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `fk_permission_role_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_permission_role_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_receipt`
--
ALTER TABLE `product_receipt`
  ADD CONSTRAINT `fk_product_receipt_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_product_receipt_receipt_id` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `fk_receipt_provider_id` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
