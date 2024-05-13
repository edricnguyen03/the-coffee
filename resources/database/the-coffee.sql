-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 13, 2024 lúc 06:50 AM
-- Phiên bản máy phục vụ: 8.0.36
-- Phiên bản PHP: 8.2.12

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
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `cart_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `cart_items`) VALUES
(1, 2, '[{\"idProduct\":\"3\",\"quantity\":27},{\"idProduct\":\"4\",\"quantity\":8}]'),
(2, 5, '[{\"idProduct\":\"2\",\"quantity\":8},{\"idProduct\":\"3\",\"quantity\":9}]'),
(3, 4, '[{\"idProduct\":\"2\",\"quantity\":3},{\"idProduct\":\"3\",\"quantity\":2},{\"idProduct\":\"1\",\"quantity\":1}]'),
(4, 25, '[]');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `status`) VALUES
(1, 'Cà Phê đóng gói', 'ca-phe-dong-goi', 'fas fa-coffee', 1),
(2, 'Quà tặng cao cấp', 'qua-tang-cao-cap', 'fas fa-gift', 1),
(3, 'Vật phẩm bán lẻ', 'vat-pham-ban-le', 'fas fa-prescription-bottle', 1),
(4, 'Cà phê nhập khẩu', 'ca-phe-nhap-khau', 'fas fa-gift', 1),
(5, 'Đặc sản bản địa', 'dac-san-ban-dia', 'fas fa-gift', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
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
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name_receiver`, `address_receiver`, `phone_receiver`, `note`, `total`, `payment_status`, `order_status`, `create_at`) VALUES
(1, 2, 'Nguyễn Thanh Duy', 'Long an 1, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0334202221', NULL, 100000, 1, 5, '2024-04-30 07:02:42'),
(2, 3, 'Nguyễn Hòa', 'Long an 2, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0334202331', NULL, 200000, 0, 5, '2024-04-30 07:02:42'),
(3, 5, 'Tiến Phan', 'Phạm Văn Hai, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0334202331', NULL, 300000, 1, 5, '2024-04-30 07:02:42'),
(4, 7, 'Nguyễn Hoàng', 'Đường 835, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0332231331', NULL, 400000, 1, 5, '2024-04-30 07:02:42'),
(5, 2, 'Huy Lê', 'Đường CMT8, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0342221414', NULL, 500000, 1, 2, '2024-04-30 07:02:42'),
(6, 4, 'Nguyễn Minh', 'Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0981214422', NULL, 600000, 1, 4, '2024-04-30 07:02:42'),
(7, 5, 'Nguyễn Bí', 'Đường 835, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0332231331', NULL, 700000, 1, 5, '2024-04-30 07:02:42'),
(8, 6, 'Nguyễn Hoàng', 'Đường 835, Thị trấn Tân Túc, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0332231331', NULL, 1000000, 1, 1, '2024-04-30 07:02:42'),
(9, 25, 'Đăng Nam', 'Tổ 11, Xã Vĩnh Lộc B, Huyện Bình Chánh, Thành phố Hồ Chí Minh', '0123456789', '', 330000, 1, 1, '2024-05-12 19:55:02'),
(10, 25, 'Đăng Nam', 'Tổ 12, Phường Bình Trị Đông B, Quận Bình Tân, Thành phố Hồ Chí Minh', '0123456789', '', 0, 1, 1, '2024-05-12 20:02:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint NOT NULL,
  `order_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_products`
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
(12, 8, 6, 2),
(13, 9, 2, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci
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
(6, 'admin.dashboard', 'Xem thống kê'),
(7, 'Abcd', 'acnd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint NOT NULL,
  `role_id` bigint NOT NULL,
  `permission_id` bigint NOT NULL
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
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `thumb_image`, `category_id`, `description`, `content`, `weight`, `price`, `status`, `stock`) VALUES
(1, 'Cà Phê Hoà Tan Đậm Vị Việt (18 gói x 16 gam)', 'ca-phe-hoa-tan', '1.jpg', 1, 'Cà Phê Hoà Tan Đậm Vị Việt', 'tặng kèm phin nhôm', 500, 337000, 1, 152),
(2, 'Cà Phê Sữa Đá Hòa Tan Túi 25x22G', 'ca-phe-sua-da', '2.jpg', 1, 'Cà Phê Sữa Đá Hòa Tan Túi', 'tặng kèm phin nhôm', 390, 110000, 1, 147),
(3, 'Thùng 24 Lon Cà Phê Sữa Đá', 'thung-24-lon', '3.jpg', 1, 'Thùng 24 Lon Cà Phê Sữa Đá', 'tặng kèm phin nhôm', 400, 190000, 1, 101),
(4, 'Cà Phê Đen Đá Túi (30 gói x 16g)', 'ca-phe-den-da-tui', '4.jpg', 1, 'Cà Phê Đen Đá Túi (30 gói x 16g)', 'tặng kèm phin nhôm', 150, 99000, 1, 101),
(5, 'Cà Phê Sữa Đá Chai Fresh 250ML', 'ca-phe-sua-da', '5.jpg', 1, 'Cà Phê Sữa Đá Chai Fresh 250ML', 'tặng kèm phin nhôm', 520, 346000, 1, 103),
(6, 'Trà Sữa Oolong Nướng Trân Châu Chai Fresh 500ML', 'tra-sua-o-long', '6.jpg', 1, 'Trà Sữa Oolong Nướng Trân Châu Chai Fresh 500ML', 'tặng kèm phin nhôm', 430, 200000, 1, 98),
(7, 'Trà Đào Cam Sả Chai Fresh 500ML', 'tra-dao-cam-sa', '7.jpg', 2, 'Trà Đào Cam Sả Chai Fresh 500ML', 'tặng kèm phin nhôm', 560, 400000, 1, 101),
(8, 'Cà Phê Sữa Đá Hòa Tan (10 gói x 22g)', 'ca-phe-sua-hoa-tan', '8.jpg', 1, 'Cà Phê Sữa Đá Hòa Tan (10 gói x 22g)', 'tặng kèm phin nhôm', 770, 559000, 1, 100),
(9, 'Cà Phê Sữa Đá Pack 6 Lon', 'ca-phe-sua-da-pack', '9.jpg', 1, 'Cà Phê Sữa Đá Pack 6 Lon', 'tặng kèm phin nhôm', 1000, 700000, 1, 100),
(10, 'Tri Ân Thầy Cô Loại A', 'tri-an-thay-co-loai-a', 'product-default.jpg', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 200, 95000, 1, 100),
(11, 'Tri Ân Thầy Cô Loại B', 'tri-an-thay-co-loai-b', 'product-default.jpg', 1, 'Món quà ý nghĩa ngày nhà giáo', 'tặng kèm phin nhôm', 600, 500000, 1, 100),
(12, 'Espresso Nóng', 'espresso', '10.jpg', 1, 'Cà phê đậm đà hương vị Ý', 'tặng kèm phin nhôm', 390, 110000, 1, 150),
(13, 'Americano Nóng', 'americano', '11.jpg', 1, 'Hương vị nhẹ nhàng americano', 'tặng kèm phin nhôm', 400, 190000, 1, 101),
(14, 'Cold Brew Truyền Thống', 'cold-brew', '12.jpg', 1, 'Độc lạ cà phê ủ lạnh', 'tặng kèm phin nhôm', 500, 800000, 1, 103),
(15, 'Cold Brew Phúc Bồn Tử', 'cold-brew-phuc-bon-tu', '14.jpg', 1, 'Cà phê sinh viên nổi tiếng', 'tặng kèm phin nhôm', 560, 45000, 1, 101),
(16, 'Phin Sữa Tươi Bánh Flan', 'phin-sua-tuoi-banh-flan', '15.jpg', 1, 'Món quà ý nghĩa cho cha mẹ', 'tặng kèm phin nhôm', 770, 559000, 1, 100),
(17, 'Trà Xanh Espresso Marble', 'tra-xanh-espresso-marble', '16.jpg', 1, 'Đặc sắc bản địa người việt nam', 'tặng kèm phin nhôm', 1000, 60000, 1, 100),
(18, 'Cà Phê Đen Đá Không Đường', 'den-da-khong-duong', '17.jpg', 1, 'Tận hưởng vị đắng mát lạnh của cà phê', 'tặng kèm phin nhôm', 200, 45000, 1, 100),
(19, 'Cà Phê Sữa Đá', 'ca-phe-sua-da', '18.jpg', 1, 'Thức uống hoàn hảo cho phố phường', 'tặng kèm phin nhôm', 300, 50000, 1, 100),
(20, 'Cappuccino Đá', 'cappuccino', '19.jpg', 4, 'Béo ngậy cappuccino', 'Tặng kèm pin nhôm', 500, 300000, 1, 200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_receipt`
--

CREATE TABLE `product_receipt` (
  `id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `receipt_id` bigint NOT NULL,
  `quantity` int NOT NULL DEFAULT '0'
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
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
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
  `id` bigint NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `provider_id` bigint NOT NULL,
  `total` int NOT NULL DEFAULT '0'
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
  `id` bigint NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `is_employee` tinyint(1) NOT NULL DEFAULT '0'
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
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '$2y$10$1DrA6DFLnvGNiwxDuwLKT.LmAnRir1J51q4ii41pw.08pNKoL8JfC',
  `role_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `password`, `role_id`) VALUES
(1, 'Người dùng tối cao', 'admin@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 1),
(2, 'Người dùng', 'user1@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
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
(17, 'Edric', 'test123@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(18, 'Tien Pham', 'tienphan09098@gmail.com', 1, '$2y$10$.sZWPnW8jj2WWuC48E.i1enl7M3grP6MQxPffW6iNyphs2UZjk7qO', 2),
(19, 'Đăng Nam', 'trandangnam056@gmail.com', 1, '$2y$10$LXuvHiCDxx2dT7dUygRK6u/09RN6fRfGB0kIDihw7y8eBuQDe02VW', 2);

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
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
