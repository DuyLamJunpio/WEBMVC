-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 07:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websitet7`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_product`
--

CREATE TABLE `ad_product` (
  `ma_loaisp` varchar(50) NOT NULL,
  `masp` int(11) NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `hinhanh` text DEFAULT NULL,
  `gianhap` bigint(20) DEFAULT NULL,
  `giaxuat` bigint(20) DEFAULT NULL,
  `khuyenmai` int(11) DEFAULT 0,
  `soluong` int(11) DEFAULT NULL,
  `mota_sp` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ad_product`
--

INSERT INTO `ad_product` (`ma_loaisp`, `masp`, `tensp`, `hinhanh`, `gianhap`, `giaxuat`, `khuyenmai`, `soluong`, `mota_sp`, `created_at`) VALUES
('1', 1, 'KIT Arduino DUE 2013 R3 ARM32', 'kit-arduino.png', 120000, 399000, 50, 12, 'Kit Arduino Due R3 ARM32 Đây là 1 bộ KIT vô cùng mạnh mẽ, là kit đầu tiên được dùng vi xử lí ARM 32-bit. Số lượng chân Digital I/O của nó là 54 chân. Số lượng chân PWM cũng gấp đôi Arduino UNO R3 (12 chân).\r\n\r\nVới các thông số hết sức ấn tượng, arduino due r3 là sản phẩm hoàn hảo cho các dự án lớn đòi hỏi bộ điều khiển phải mạnh mẽ như các hệ thống IoT thông minh.', '2024-11-26 03:54:42'),
('2', 2, 'Pin aaa', 'Ảnh chụp màn hình 2024-02-05 234129.png', 123, 456, 0, 10, 'dsfgsdgsdfgsedf', '2024-11-27 17:01:10'),
('2', 4, 'haohao2024', '2.png', 100000999, 999999901111, 20, 150, 'abc2024', '2024-12-02 13:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `ad_producttype`
--

CREATE TABLE `ad_producttype` (
  `ma_loaisp` int(11) NOT NULL,
  `ten_loaisp` varchar(50) NOT NULL,
  `mota_loaisp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ad_producttype`
--

INSERT INTO `ad_producttype` (`ma_loaisp`, `ten_loaisp`, `mota_loaisp`) VALUES
(1, 'Cảm biến', 'Linh kiện cảm biến'),
(2, 'Pin', 'Pin gì đó ...'),
(3, 'abc', 'hhhhh'),
(4, '4333', 'sdgsdgss'),
(5, 'rrrrr121223hhh', 'rrrrrr34534ffff'),
(7, '33333', '444444');

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `id` int(11) NOT NULL,
  `ma_hoa_don` int(11) DEFAULT NULL,
  `masp` int(11) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `tong_tien` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chi_tiet_hoa_don`
--

INSERT INTO `chi_tiet_hoa_don` (`id`, `ma_hoa_don`, `masp`, `so_luong`, `tong_tien`) VALUES
(3, 3, 1, 5, 997500),
(4, 4, 1, 2, 399000),
(5, 5, 1, 3, 598500),
(6, 6, 1, 12, 2394000),
(7, 7, 1, 74, 14763000),
(8, 7, 2, 44, 20064),
(9, 8, 1, 5, 997500),
(10, 8, 2, 4, 1824),
(11, 9, 1, 3, 598500),
(12, 10, 1, 1, 199500),
(13, 11, 4, 5, 3999999604445);

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id` int(11) NOT NULL,
  `ma_khach_hang` int(11) DEFAULT NULL,
  `masp` int(11) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gio_hang`
--

INSERT INTO `gio_hang` (`id`, `ma_khach_hang`, `masp`, `so_luong`, `created_at`) VALUES
(10, 3, 1, 5, '2024-12-02 11:23:05'),
(11, 3, 2, 4, '2024-12-02 11:23:30'),
(12, 3, 4, 5, '2024-12-02 13:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `ma_hoa_don` int(11) NOT NULL,
  `ma_khach_hang` int(11) NOT NULL,
  `tong_thanh_toan` bigint(20) NOT NULL,
  `trangthai` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoa_don`
--

INSERT INTO `hoa_don` (`ma_hoa_don`, `ma_khach_hang`, `tong_thanh_toan`, `trangthai`, `created_at`) VALUES
(3, 3, 997500, 2, '2024-11-30 08:28:12'),
(4, 3, 399000, 1, '2024-11-30 08:29:43'),
(5, 3, 598500, 0, '2024-11-30 14:48:42'),
(6, 3, 2394000, 0, '2024-12-01 08:19:29'),
(7, 3, 14783064, 0, '2024-12-01 16:49:18'),
(8, 3, 999324, 0, '2024-12-02 11:24:27'),
(9, 5, 598500, 0, '2024-12-02 11:27:04'),
(10, 5, 199500, 0, '2024-12-02 11:28:34'),
(11, 3, 3999999604445, 3, '2024-12-02 13:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `tendangnhap` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `sodienthoai` varchar(20) DEFAULT NULL,
  `gioitinh` tinyint(4) DEFAULT 2 CHECK (`gioitinh` in (0,1,2)),
  `diachi` text DEFAULT NULL,
  `mucdotruycap` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `hoten`, `tendangnhap`, `email`, `matkhau`, `sodienthoai`, `gioitinh`, `diachi`, `mucdotruycap`, `created_at`) VALUES
(2, 'Thanh Hao', 'hao123', 'hao123@gmail.com', '$2y$10$OveqCMJfjoTOcQLVKQ1ape8zBXX61dMgXcGcqELgioY5ZJg9Bqype', '0862850761', 0, NULL, 1, '2024-11-23 17:10:13'),
(3, 'Vũ Thanh Hảo', 'vuthanhhao', 'thanhhao@gmail.com', '$2y$10$jabFJGoKOikO9FJd9X15MOpK7yHjdcg7pdjk/yJLKgwvoVVtsbxHi', '0123456789', 1, 'Số nhà 23, Phúc Diễn, Bắc Từ Liêm, Hà Nội', 0, '2024-11-23 18:37:44'),
(5, 'Hẻo Hẻo', 'Hẻo béo', 'thanhhao2203@gmail.com', '$2y$10$XmFxHqpWiQOmwBZZ0VqCe.T9QTPNhO49XX43OHBkzH1vuiXSammAi', '0123456789', 1, 'Ân Thi, Hưng Yên', 0, '2024-12-02 11:26:22'),
(6, 'thanh hao2203', 'thanhhhaovuu', 'thanhhaovu19@gmail.com', '$2y$10$xr6Pr9GFCwGtWXlNh/IpWeZvqeKeTfNAcGhUxS3O4zZIXE58rOvoS', '0123456789', 1, NULL, 0, '2024-12-02 13:56:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_product`
--
ALTER TABLE `ad_product`
  ADD PRIMARY KEY (`masp`);

--
-- Indexes for table `ad_producttype`
--
ALTER TABLE `ad_producttype`
  ADD PRIMARY KEY (`ma_loaisp`);

--
-- Indexes for table `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`ma_hoa_don`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tendangnhap` (`tendangnhap`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_product`
--
ALTER TABLE `ad_product`
  MODIFY `masp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ad_producttype`
--
ALTER TABLE `ad_producttype`
  MODIFY `ma_loaisp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `ma_hoa_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
