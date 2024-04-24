-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 24, 2024 lúc 12:04 PM
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
(11, 'Edric', 'test123@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2),
(12, 'Edric Nguyen', 'user44@gmail.com', 1, '$2y$10$EBsBg44sWN.yNHD5vmWDl.WbwWbuevEoYU6HaWVUrUAym1iv4dYQC', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_role_id` (`role_id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
