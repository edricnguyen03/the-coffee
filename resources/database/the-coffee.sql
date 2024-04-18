-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 09, 2024 lúc 03:55 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `the-coffee`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `cart_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cart_items`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `status`) VALUES
(1, 'Cà Phê đóng gói', 'ca-phe-dong-goi', 'fas fa-coffee', 1),
(2, 'Quà tặng cao cấp', 'qua-tang-cao-cap', 'fas fa-gift', 1),
(3, 'Vật phẩm bán lẻ', 'vat-pham-ban-le', 'fas fa-prescription-bottle', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name_receiver` varchar(255) NOT NULL,
  `address_receiver` text NOT NULL,
  `phone_receiver` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `total` double NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `order_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name_receiver`, `address_receiver`, `phone_receiver`, `note`, `total`, `payment_status`, `order_status`) VALUES
(1, 2, 'Nguyễn Thanh Duy', 'Long an 1, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0334202221', NULL, 100000, 1, 1),
(2, 3, 'Nguyễn Hòa', 'Long an 2, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0334202331', NULL, 200000, 0, 1),
(3, 5, 'Tiến Phan', 'Phạm Văn Hai, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0334202331', NULL, 300000, 1, 1),
(4, 7, 'Nguyễn Hoàng', 'Đường 835, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0332231331', NULL, 400000, 1, 1),
(5, 2, 'Huy Lê', 'Đường CMT8, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0342221414', NULL, 500000, 1, 1),
(6, 4, 'Nguyễn Minh', 'Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0981214422', NULL, 600000, 1, 1),
(7, 5, 'Nguyễn Bí', 'Đường 835, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0332231331', NULL, 700000, 1, 1),
(8, 6, 'Nguyễn Hoàng', 'Đường 835, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0332231331', NULL, 1000000, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_price` double NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `product_price`, `product_name`, `qty`) VALUES
(1, 1, 1, 80000, 'Tri ân thầy cô', 1),
(2, 1, 3, 20000, 'Cà Phê Hòa Tan Đậm Vị Việt Túi 40x16G', 1),
(3, 2, 5, 100000, 'Cà Phê Sữa Nóng', 1),
(4, 2, 4, 100000, 'Cà Phê Sữa Nóng', 1),
(5, 3, 4, 100000, 'Cà Phê Sữa Đá', 3),
(6, 4, 7, 300000, 'Cà Phê Sữa Nóng', 1),
(7, 4, 5, 50000, 'Cà Phê Sữa Nóng', 2),
(8, 5, 1, 500000, 'Cà Phê Sữa Nóng', 1),
(9, 6, 3, 300000, 'Cappuccino Nóng', 2),
(10, 7, 5, 500000, 'Cà Phê Hòa Tan Đậm Vị Việt Túi 40x16G', 1),
(11, 7, 2, 200000, 'Cà Phê Sữa Nóng', 1),
(12, 8, 6, 600000, 'Cà Phê Sữa Nóng', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`) VALUES
(1, 'admin.user', 'Quản lý người dùng'),
(2, 'admin.category', 'Quản lý danh mục'),
(3, 'admin.product', 'Quản lý sản phẩm'),
(4, 'admin.order', 'Xử lý đơn hàng'),
(5, 'admin.role', 'Quản lý vai trò'),
(6, 'admin.dashboard', 'Xem thống kê');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `permission_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumb_image` text NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `weight` int(11) NOT NULL DEFAULT 500,
  `price` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `thumb_image`, `category_id`, `description`, `content`, `weight`, `price`, `status`, `stock`) VALUES
(1, 'Tri Ân Thầy Cô 1', 'tri-an-thay-co-1', '1.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 500, 337000, 1, 148),
(2, 'Tri Ân Thầy Cô 2', 'tri-an-thay-co-2', '2.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 390, 110000, 1, 149),
(3, 'Tri Ân Thầy Cô 3', 'tri-an-thay-co-3', '3.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 400, 190000, 1, 97),
(4, 'Tri Ân Thầy Cô 4', 'tri-an-thay-co-4', '4.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 150, 99000, 1, 96),
(5, 'Tri Ân Thầy Cô 5', 'tri-an-thay-co-5', '5.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 520, 346000, 1, 96),
(6, 'Tri Ân Thầy Cô 6', 'tri-an-thay-co-6', '6.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 430, 200000, 1, 98),
(7, 'Tri Ân Thầy Cô 7', 'tri-an-thay-co-7', '7.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 560, 400000, 1, 99),
(8, 'Tri Ân Thầy Cô 8', 'tri-an-thay-co-8', '8.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 770, 559000, 1, 100),
(9, 'Tri Ân Thầy Cô 9', 'tri-an-thay-co-9', '9.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 1000, 700000, 1, 100),
(10, 'Tri Ân Thầy Cô 10', 'tri-an-thay-co-10', '10.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 200, 95000, 1, 100),
(11, 'Tri Ân Thầy Cô 11', 'tri-an-thay-co-11', '11.png', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 600, 500000, 1, 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_receipt`
--

CREATE TABLE `product_receipt` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `receipt_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_receipt`
--

INSERT INTO `product_receipt` (`id`, `product_id`, `receipt_id`, `quantity`) VALUES
(1, 1, 1, 50),
(2, 2, 1, 50),
(3, 3, 1, 50),
(4, 4, 1, 50),
(5, 5, 2, 50),
(6, 6, 2, 50),
(7, 7, 2, 50),
(8, 8, 2, 50),
(9, 9, 3, 50),
(10, 10, 3, 50),
(11, 11, 3, 50),
(12, 1, 3, 50),
(13, 2, 4, 50),
(14, 3, 4, 50),
(15, 4, 4, 50),
(16, 5, 4, 50),
(17, 6, 5, 50),
(18, 7, 5, 50),
(19, 8, 5, 50),
(20, 9, 5, 50),
(21, 10, 6, 50),
(22, 11, 6, 50),
(23, 1, 6, 50),
(24, 2, 6, 50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `providers`
--

INSERT INTO `providers` (`id`, `name`, `description`) VALUES
(1, 'Cà phê Trung Nguyên', 'Nhà cung cấp chính của của hàng'),
(2, 'Cà phê chồn DakLak', 'Nhà cung cấp sản phẩm sấy khô hàng đầu'),
(3, 'Công ty cà phê Quyết Thắng', 'Sản phẩm chất lượng hàng đầu'),
(4, 'Cà phê Việt Nam VinaCoffee', 'Giá cả đi kèm với chất lượng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `provider_id` bigint(20) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `receipts`
--

INSERT INTO `receipts` (`id`, `name`, `provider_id`, `total`) VALUES
(1, 'Hóa đơn nhập hàng 1', 1, 200),
(2, 'Hóa đơn nhập hàng 2', 2, 200),
(3, 'Hóa đơn nhập hàng 3', 3, 200),
(4, 'Hóa đơn nhập hàng 4', 4, 200),
(5, 'Hóa đơn nhập hàng 5', 3, 200),
(6, 'Hóa đơn nhập hàng 6', 1, 200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `is_employee` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `is_employee`) VALUES
(1, 'Super Admin', NULL, 1),
(2, 'User', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL DEFAULT '$2y$10$1DrA6DFLnvGNiwxDuwLKT.LmAnRir1J51q4ii41pw.08pNKoL8JfC',
  `role_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `password`, `role_id`) VALUES
(1, 'Người dùng tối cao', 'admin@gmail.com', 1, '1', 1),
(2, 'Người dùng', 'user1@gmail.com', 1, '1', 2),
(3, 'Người dùng', 'user2@gmail.com', 1, '1', 2),
(4, 'Người dùng', 'user3@gmail.com', 1, '1', 2),
(5, 'Người dùng', 'user4@gmail.com', 1, '1', 2),
(6, 'Người dùng', 'user5@gmail.com', 1, '1', 2),
(7, 'Tài khoản bị khoá', 'ban1@gmail.com', 0, '1', 2),
(8, 'Tài khoản bị khoá', 'ban2@gmail.com', 0, '1', 2),
(9, 'Tài khoản bị khoá', 'ban3@gmail.com', 0, '1', 2),
(10, 'Tài khoản bị khoá', 'ban4@gmail.com', 0, '1', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carts_user_id` (`user_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_products_order_id` (`order_id`),
  ADD KEY `fk_order_products_product_id` (`product_id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_id` (`role_id`,`permission_id`),
  ADD KEY `fk_permission_role_permission_id` (`permission_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_receipt`
--
ALTER TABLE `product_receipt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_receipt_receipt_id` (`receipt_id`),
  ADD KEY `fk_product_receipt_product_id` (`product_id`);

--
-- Chỉ mục cho bảng `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_receipt_provider_id` (`provider_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_carts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `fk_order_products_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_order_products_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `fk_permission_role_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_permission_role_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_receipt`
--
ALTER TABLE `product_receipt`
  ADD CONSTRAINT `fk_product_receipt_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_receipt_receipt_id` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `fk_receipt_provider_id` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
