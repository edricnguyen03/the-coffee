-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 13, 2024 lúc 11:40 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

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
(1, 'Cà Phê Hoà Tan Đậm Vị Việt (18 gói x 16 gam)', 'ca-phe-hoa-tan', '1.jpg', 1, 'Cà Phê Hoà Tan Đậm Vị Việt', 'tặng kèm phin nhôm', 500, 337000, 1, 152),
(2, 'Cà Phê Sữa Đá Hòa Tan Túi 25x22G', 'ca-phe-sua-da', '2.jpg', 1, 'Cà Phê Sữa Đá Hòa Tan Túi', 'tặng kèm phin nhôm', 390, 110000, 1, 147),
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

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_category_id` (`category_id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
