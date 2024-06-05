-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 05, 2024 at 04:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `baocaokho`
--

CREATE TABLE `baocaokho` (
  `MaBaoCao` int(10) NOT NULL,
  `Ngaybaocao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baocaokho`
--

INSERT INTO `baocaokho` (`MaBaoCao`, `Ngaybaocao`) VALUES
(1, '2024-06-05 13:05:59'),
(2, '2024-01-01 18:05:24'),
(3, '2024-01-01 00:00:00'),
(4, '2024-02-02 00:00:00'),
(5, '2024-03-01 00:00:00'),
(6, '2024-04-01 00:00:00'),
(7, '2024-02-01 18:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `ctbaocaokho`
--

CREATE TABLE `ctbaocaokho` (
  `MaCT` int(10) NOT NULL,
  `Ngaybaocao` datetime NOT NULL,
  `SanPham` int(11) NOT NULL,
  `TonDau` int(10) NOT NULL,
  `TonCuoi` int(10) NOT NULL,
  `MuaVao` int(10) NOT NULL,
  `BanRa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctbaocaokho`
--

INSERT INTO `ctbaocaokho` (`MaCT`, `Ngaybaocao`, `SanPham`, `TonDau`, `TonCuoi`, `MuaVao`, `BanRa`) VALUES
(1, '2024-01-01 18:09:38', 10, 20, 20, 100, 100),
(2, '2024-01-01 18:09:07', 5, 20, 80, 60, 0),
(3, '2024-01-01 00:00:00', 1, 100, 50, 150, 200),
(4, '2024-02-01 00:00:00', 3, 5, 40, 100, 65),
(5, '2024-03-01 00:00:00', 4, 50, 20, 0, 30);

-- --------------------------------------------------------

--
-- Table structure for table `ctphieudv`
--

CREATE TABLE `ctphieudv` (
  `SoPhieu` int(10) NOT NULL,
  `LoaiDV` int(10) NOT NULL,
  `DonGia` bigint(50) NOT NULL,
  `SoLuong` int(10) NOT NULL,
  `ThanhTien` bigint(50) NOT NULL,
  `TraTruoc` bigint(50) NOT NULL,
  `ConLai` bigint(50) NOT NULL,
  `NgayGiao` datetime NOT NULL,
  `TinhTrang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctphieudv`
--

INSERT INTO `ctphieudv` (`SoPhieu`, `LoaiDV`, `DonGia`, `SoLuong`, `ThanhTien`, `TraTruoc`, `ConLai`, `NgayGiao`, `TinhTrang`) VALUES
(1, 4, 500000, 7, 3500000, 2500000, 1000000, '2024-05-27 03:20:01', 'Chưa hoàn thành'),
(2, 5, 700000, 1, 700000, 700000, 0, '2024-05-27 03:22:43', 'Đã hoàn thành'),
(3, 1, 500000, 1, 500000, 500000, 0, '2024-05-27 03:23:43', 'Đã hoàn thành');

-- --------------------------------------------------------

--
-- Table structure for table `loaidv`
--

CREATE TABLE `loaidv` (
  `ID` int(10) NOT NULL,
  `TenLoai` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `DonGia` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaidv`
--

INSERT INTO `loaidv` (`ID`, `TenLoai`, `DonGia`) VALUES
(2, 'Tư vấn', 600000),
(3, 'Đúc theo yêu cầu', 2500000),
(4, 'Bảo trì, bảo dưỡng', 500000),
(5, 'Đánh bóng, làm mới', 700000),
(6, 'Sửa chữa', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `phieudichvu`
--

CREATE TABLE `phieudichvu` (
  `SoPhieu` int(10) NOT NULL,
  `NgayLap` datetime NOT NULL,
  `KhachHang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SDT` varchar(255) NOT NULL,
  `TongTien` bigint(50) NOT NULL,
  `TraTrc` bigint(50) NOT NULL,
  `ConLai` bigint(50) NOT NULL,
  `TinhTrang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phieudichvu`
--

INSERT INTO `phieudichvu` (`SoPhieu`, `NgayLap`, `KhachHang`, `SDT`, `TongTien`, `TraTrc`, `ConLai`, `TinhTrang`) VALUES
(1, '2024-05-27 03:15:09', 'Nguyễn Văn Hậu', '0984561787', 3500000, 2500000, 1000000, 'Chưa hoàn thành'),
(2, '2024-05-27 03:17:14', 'Lê Thị Ngọc Châu', '0334511976', 700000, 700000, 0, 'Đã hoàn thành'),
(3, '2024-05-27 03:18:14', 'Trần Văn Tuấn', '0978566123', 500000, 500000, 0, 'Đã hoàn thành');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `quantity`, `total_price`) VALUES
(1, 'Laptop Dell XPS 13', 1500, 11, 0),
(2, 'Tablet Samsung Galaxy Tab S7', 650, 15, 0),
(3, 'Monitor LG UltraWide', 350, 30, 0),
(4, 'Laptop HP Spectre x360', 1600, 8, 0),
(5, 'Mouse Logitech MX Master 3', 100, 20, 0),
(6, 'Keyboard Razer BlackWidow Elite', 200, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` int(11) NOT NULL,
  `purchase_code` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_slip`
--

CREATE TABLE `purchase_slip` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `total_payment` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `MaNCC` varchar(20) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `MaNCC`, `ten`, `diachi`, `sdt`) VALUES
(1, '1237', 'hh', 'hi', '0546254298');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`) VALUES
(1, '', '111'),
(2, '', '12345'),
(4, '3', '33'),
(5, '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baocaokho`
--
ALTER TABLE `baocaokho`
  ADD PRIMARY KEY (`MaBaoCao`);

--
-- Indexes for table `ctbaocaokho`
--
ALTER TABLE `ctbaocaokho`
  ADD PRIMARY KEY (`MaCT`);

--
-- Indexes for table `ctphieudv`
--
ALTER TABLE `ctphieudv`
  ADD PRIMARY KEY (`SoPhieu`);

--
-- Indexes for table `loaidv`
--
ALTER TABLE `loaidv`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `phieudichvu`
--
ALTER TABLE `phieudichvu`
  ADD PRIMARY KEY (`SoPhieu`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_code` (`purchase_code`);

--
-- Indexes for table `purchase_slip`
--
ALTER TABLE `purchase_slip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baocaokho`
--
ALTER TABLE `baocaokho`
  MODIFY `MaBaoCao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loaidv`
--
ALTER TABLE `loaidv`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `phieudichvu`
--
ALTER TABLE `phieudichvu`
  MODIFY `SoPhieu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_slip`
--
ALTER TABLE `purchase_slip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ctbaocaokho`
--
ALTER TABLE `ctbaocaokho`
  ADD CONSTRAINT `ctbaocaokho_ibfk_1` FOREIGN KEY (`MaCT`) REFERENCES `baocaokho` (`MaBaoCao`);

--
-- Constraints for table `ctphieudv`
--
ALTER TABLE `ctphieudv`
  ADD CONSTRAINT `ctphieudv_ibfk_1` FOREIGN KEY (`SoPhieu`) REFERENCES `phieudichvu` (`SoPhieu`);

--
-- Constraints for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD CONSTRAINT `purchase_products_ibfk_1` FOREIGN KEY (`purchase_code`) REFERENCES `purchase_slip` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
