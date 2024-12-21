-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 21, 2024 lúc 03:02 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bku_printers`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `unit_currency` varchar(10) NOT NULL DEFAULT 'vnd',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `price`, `unit_currency`, `created_at`) VALUES
(1, 'A0', 10000, 'vnd', '2024-12-04 03:08:43'),
(2, 'A1', 5000, 'vnd', '2024-12-04 03:08:43'),
(3, 'A2', 4000, 'vnd', '2024-12-04 03:08:43'),
(4, 'A3', 3000, 'vnd', '2024-12-04 03:08:43'),
(5, 'A4', 2000, 'vnd', '2024-12-04 03:08:43'),
(6, 'A5', 1000, 'vnd', '2024-12-04 03:08:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page_orders`
--

CREATE TABLE `page_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `mode of payment` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `page_orders`
--

INSERT INTO `page_orders` (`id`, `user_id`, `status`, `mode of payment`, `created_at`, `update_at`) VALUES
(1, 1, 'Chưa thanh toán', NULL, '2024-12-04 03:21:31', '2024-12-04 03:21:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page_order_details`
--

CREATE TABLE `page_order_details` (
  `order_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_currency` varchar(10) NOT NULL DEFAULT 'vnd'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `page_order_details`
--

INSERT INTO `page_order_details` (`order_id`, `page_id`, `price`, `quantity`, `unit_currency`) VALUES
(1, 2, 5000, 50, 'vnd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `resource` varchar(100) NOT NULL,
  `action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `resource`, `action`) VALUES
(1, 1, 'printers', 'view'),
(6, 1, 'print_history', 'create'),
(7, 1, 'print_history', 'view_own'),
(4, 2, 'printers', 'create'),
(5, 2, 'printers', 'delete'),
(3, 2, 'printers', 'view');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `printers`
--

CREATE TABLE `printers` (
  `id` int(11) NOT NULL,
  `printer_name` varchar(100) NOT NULL,
  `ip_address` varchar(12) NOT NULL DEFAULT '127.0.0.1',
  `status` varchar(50) DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `printers`
--

INSERT INTO `printers` (`id`, `printer_name`, `ip_address`, `status`) VALUES
(1, 'Printer A', '192.1.0.1', 'Hoạt động'),
(2, 'Printer B', '192.1.0.2', 'Hoạt động'),
(3, 'C', '127.0.0.1', 'Không hoạt động'),
(6, 'C1', '127.0.0.1', 'Hoạt động'),
(23, 'C12', '127.0.0.1', 'Hoạt động'),
(25, 'C13', '127.0.0.1', 'Hoạt động'),
(27, 'C14', '127.0.0.1', 'Hoạt động'),
(29, 'C16', '127.0.0.1', 'Hoạt động'),
(31, 'C17', '127.0.0.1', 'Hoạt động'),
(33, 'C18', '127.0.0.1', 'Hoạt động'),
(35, 'C19', '127.0.0.1', 'Hoạt động'),
(41, 'A2', '127.0.0.1', 'Hoạt động'),
(69, 'A22', '127.0.0.1', 'Hoạt động'),
(78, 'A222', '127.0.0.1', 'Hoạt động'),
(83, 'A2212', '127.0.0.1', 'Hoạt động');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `printer_file_types`
--

CREATE TABLE `printer_file_types` (
  `id` int(11) NOT NULL,
  `printer_id` int(11) NOT NULL,
  `file_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `printer_file_types`
--

INSERT INTO `printer_file_types` (`id`, `printer_id`, `file_type`) VALUES
(1, 1, 'PDF'),
(2, 1, 'DOCX'),
(3, 2, 'JPEG'),
(4, 2, 'PNG');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `print_history`
--

CREATE TABLE `print_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `printer_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `print_history`
--

INSERT INTO `print_history` (`id`, `user_id`, `printer_id`, `file_name`, `pages`, `created_at`) VALUES
(1, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 12:41:39'),
(2, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 12:45:39'),
(3, 1, 1, 'test_upload_pdf.pdf', 24, '2024-12-05 12:45:44'),
(4, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 12:45:47'),
(5, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 12:45:51'),
(6, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 12:49:09'),
(7, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 12:50:24'),
(8, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 12:51:57'),
(9, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 12:53:19'),
(10, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 14:51:26'),
(11, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 16:11:40'),
(12, 1, 1, 'test_upload_pdf.pdf', 24, '2024-12-05 16:14:59'),
(13, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 16:17:45'),
(14, 1, 1, 'test_upload_pdf.pdf', 24, '2024-12-05 16:19:55'),
(15, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 16:29:43'),
(16, 1, 2, 'test_upload_pdf.pdf', 24, '2024-12-05 16:31:30'),
(17, 1, 1, 'test_upload_pdf.pdf', 24, '2024-12-08 07:09:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(2, 'Nhân viên'),
(1, 'Sinh viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trays`
--

CREATE TABLE `trays` (
  `id` int(11) NOT NULL,
  `tray_name` varchar(50) NOT NULL,
  `total_page` varchar(255) NOT NULL,
  `printer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `trays`
--

INSERT INTO `trays` (`id`, `tray_name`, `total_page`, `printer_id`) VALUES
(1, 'A1', '200', 1),
(2, 'A2', '100', 1),
(3, 'A3', '100', 1),
(5, 'A1', '500', 2),
(6, 'A2', '500', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password_hash`, `role_id`, `created_at`) VALUES
(1, 'Tín Tôn', 'tin.tontrong@hcmut.edu.vn', '$2y$10$hY6KmsRKH059WegZT7WLLeBaawJ1lzk8aK7Tg4HiuriO9UKPxUYXi', 1, '2024-12-01 17:53:19'),
(2, 'Nhân viên In', 'qly@gmail.com', '$2y$10$hY6KmsRKH059WegZT7WLLeBaawJ1lzk8aK7Tg4HiuriO9UKPxUYXi', 2, '2024-12-01 17:53:19'),
(3, 'Huy Trần', 'huytran@hcmut.edu.vn', '$2y$10$hY6KmsRKH059WegZT7WLLeBaawJ1lzk8aK7Tg4HiuriO9UKPxUYXi', 1, '2024-12-01 17:53:19');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page_orders`
--
ALTER TABLE `page_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `page_order_details`
--
ALTER TABLE `page_order_details`
  ADD KEY `page_id` (`page_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_id` (`role_id`,`resource`,`action`);

--
-- Chỉ mục cho bảng `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`printer_name`);

--
-- Chỉ mục cho bảng `printer_file_types`
--
ALTER TABLE `printer_file_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `printer_id` (`printer_id`);

--
-- Chỉ mục cho bảng `print_history`
--
ALTER TABLE `print_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `record_id` (`user_id`),
  ADD KEY `printer_id` (`printer_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`role_name`);

--
-- Chỉ mục cho bảng `trays`
--
ALTER TABLE `trays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `printer_id` (`printer_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`user_name`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `page_orders`
--
ALTER TABLE `page_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `printers`
--
ALTER TABLE `printers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `printer_file_types`
--
ALTER TABLE `printer_file_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `print_history`
--
ALTER TABLE `print_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `trays`
--
ALTER TABLE `trays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `page_orders`
--
ALTER TABLE `page_orders`
  ADD CONSTRAINT `page_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `page_order_details`
--
ALTER TABLE `page_order_details`
  ADD CONSTRAINT `page_order_details_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `page_orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Các ràng buộc cho bảng `printer_file_types`
--
ALTER TABLE `printer_file_types`
  ADD CONSTRAINT `printer_file_types_ibfk_1` FOREIGN KEY (`printer_id`) REFERENCES `printers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `print_history`
--
ALTER TABLE `print_history`
  ADD CONSTRAINT `print_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `print_history_ibfk_2` FOREIGN KEY (`printer_id`) REFERENCES `printers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `trays`
--
ALTER TABLE `trays`
  ADD CONSTRAINT `trays_ibfk_1` FOREIGN KEY (`printer_id`) REFERENCES `printers` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
