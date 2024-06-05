-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 04:18 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `ctphieuban`
--

CREATE TABLE `ctphieuban` (
  `SoPhieu` varchar(50) NOT NULL,
  `SanPham` varchar(50) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `DonGia` float DEFAULT NULL,
  `ThanhTien` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctphieuban`
--

INSERT INTO `ctphieuban` (`SoPhieu`, `SanPham`, `SoLuong`, `DonGia`, `ThanhTien`) VALUES
('PB14', 'SP03', 3, 10192, 30576),
('PB14', 'SP04', 2, 2500, 5000),
('PB14', 'SP05', 1, 50000, 50000),
('PB15', 'SP02', 5, 117822, 589110),
('PB15', 'SP05', 2, 50000, 100000),
('PB15', 'SP06', 3, 36731, 110193),
('PB16', 'SP05', 3, 50000, 150000),
('PB17', 'SP01', 1, 36237, 36237),
('PB17', 'SP02', 1, 117822, 117822);

-- --------------------------------------------------------

--
-- Table structure for table `ctphieumua`
--

CREATE TABLE `ctphieumua` (
  `SOPHIEUMUA` varchar(50) NOT NULL,
  `SANPHAM` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DONGIA` float DEFAULT NULL,
  `SOLUONG` int(11) DEFAULT NULL,
  `THANHTIEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donvi`
--

CREATE TABLE `donvi` (
  `MADV` varchar(50) NOT NULL,
  `TENDV` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donvi`
--

INSERT INTO `donvi` (`MADV`, `TENDV`) VALUES
('DV02', 'Kg'),
('DV03', 'Chiếc'),
('DV04', 'Cái'),
('DV05', 'Bộ'),
('DV06', 'Đôi'),
('DV07', 'Carat'),
('DV08', 'Sợi'),
('DV09', 'Cặp');

-- --------------------------------------------------------

--
-- Table structure for table `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoai` varchar(50) NOT NULL,
  `TenLoai` varchar(50) DEFAULT NULL,
  `DVTinh` varchar(50) DEFAULT NULL,
  `PhanTram` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaisp`
--

INSERT INTO `loaisp` (`MaLoai`, `TenLoai`, `DVTinh`, `PhanTram`) VALUES
('LSP01', 'Bông tai ', 'Đôi', 15),
('LSP02', 'Nhẫn vàng', 'Chiếc', 15),
('LSP03', 'Nhẫn đính đá Ruby', 'Cặp', 50),
('LSP05', 'Trang sức ', 'Bộ', 57),
('LSP06', 'Nhẫn bạc', 'Chiếc', 20),
('LSP07', 'Dây chuyền vàng', 'Sợi', 15),
('LSP08', 'Dây chuyền bạc', 'Sợi', 12),
('LSP09', 'Kiềng vàng', 'Bộ', 33),
('LSP10', 'Kiềng bạc', 'Bộ', 29),
('LSP11', 'Đồng hồ vàng', 'Cái', 40),
('LSP12', 'Đồng hồ bạc', 'Cái', 25),
('LSP13', 'Xi men vàng', 'Bộ', 10),
('LSP14', 'Xi men bạc', 'Bộ', 5),
('LSP15', 'Vòng tay vàng', 'Chiếc', 13),
('LSP16', 'Vòng tay bạc', 'Chiếc', 7),
('LSP17', 'Lắc tay bạc', 'Chiếc', 15),
('LSP18', 'Lắc tay vàng', 'Chiếc', 5),
('LSP19', 'Lắc chân vàng', 'Chiếc', 20),
('LSP20', 'Lắc chân bạc', 'Chiếc', 17);

-- --------------------------------------------------------

--
-- Table structure for table `phieuban`
--

CREATE TABLE `phieuban` (
  `SoPhieu` varchar(10) NOT NULL,
  `NgayLap` date DEFAULT NULL,
  `KhachHang` varchar(50) DEFAULT NULL,
  `TongTien` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phieuban`
--

INSERT INTO `phieuban` (`SoPhieu`, `NgayLap`, `KhachHang`, `TongTien`) VALUES
('PB14', '2024-06-04', 'Lê Khoa', 85576),
('PB15', '2024-06-04', 'Phụng', 799303),
('PB16', '2024-06-04', 'Quang', 150000),
('PB17', '2024-06-05', 'Tú', 154059);

-- --------------------------------------------------------

--
-- Table structure for table `phieumua`
--

CREATE TABLE `phieumua` (
  `SOPHIEUMUA` varchar(50) NOT NULL,
  `NGAYLAP` date DEFAULT NULL,
  `NHACC` varchar(20) DEFAULT NULL,
  `TONGTIEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(50) NOT NULL,
  `TenSP` varchar(50) DEFAULT NULL,
  `LoaiSP` varchar(50) DEFAULT NULL,
  `DonGiaMua` float DEFAULT NULL,
  `SoLuongKho` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `LoaiSP`, `DonGiaMua`, `SoLuongKho`) VALUES
('SP01', 'Bông tai hồ điệp', 'LSP01', 36237, 689),
('SP02', 'Kiềng cưới Vàng 18K đính đá ECZ PNJ Trầu Cau XMXMY', 'LSP09', 117822, 49),
('SP03', 'Đồng Hồ Nữ Classic Petite Melrose White ', 'LSP11', 10192, 997),
('SP04', 'Bộ xi men 7 chiếc khắc tên', 'LSP13', 2500, 98),
('SP05', 'Đồng hồ Rado Coupole Classic Nam R22894203 Dây Kim', 'LSP12', 50000, 494),
('SP06', 'Lắc tay nam Vàng trắng 10K đính đá ECZ PNJ XM00W00', 'LSP17', 36731, 7);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `MaNCC` varchar(20) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`MaNCC`, `ten`, `diachi`, `sdt`) VALUES
('NCC01', 'Công ty TNHH PNJ', '56 Dien Bien Phu, TP Ho Chi Minh', '01122553'),
('NCC02', 'Tiem vang kim hung', '107 Nguyen Tri Phuong, TPHCM', '09785661'),
('NCC03', 'Tiem Vang Quang Nam', 'Tran Hung Dao', '0999876551'),
('NCC04', 'Tiem vang Kim Tien', 'Quan 7, TP HCM', '0112233467');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`) VALUES
(1, '', '111'),
(2, '', '12345'),
(4, 'admin', '2310');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ctphieuban`
--
ALTER TABLE `ctphieuban`
  ADD PRIMARY KEY (`SoPhieu`,`SanPham`),
  ADD KEY `SanPham` (`SanPham`);

--
-- Indexes for table `ctphieumua`
--
ALTER TABLE `ctphieumua`
  ADD PRIMARY KEY (`SOPHIEUMUA`,`SANPHAM`),
  ADD KEY `SANPHAM` (`SANPHAM`);

--
-- Indexes for table `donvi`
--
ALTER TABLE `donvi`
  ADD PRIMARY KEY (`MADV`);

--
-- Indexes for table `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Indexes for table `phieuban`
--
ALTER TABLE `phieuban`
  ADD PRIMARY KEY (`SoPhieu`);

--
-- Indexes for table `phieumua`
--
ALTER TABLE `phieumua`
  ADD PRIMARY KEY (`SOPHIEUMUA`),
  ADD KEY `NHACC` (`NHACC`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `LoaiSP` (`LoaiSP`),
  ADD KEY `MaSP` (`MaSP`),
  ADD KEY `MaSP_2` (`MaSP`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`MaNCC`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ctphieuban`
--
ALTER TABLE `ctphieuban`
  ADD CONSTRAINT `ctphieuban_ibfk_1` FOREIGN KEY (`SoPhieu`) REFERENCES `phieuban` (`SoPhieu`),
  ADD CONSTRAINT `ctphieuban_ibfk_2` FOREIGN KEY (`SanPham`) REFERENCES `sanpham` (`MaSP`);

--
-- Constraints for table `ctphieumua`
--
ALTER TABLE `ctphieumua`
  ADD CONSTRAINT `ctphieumua_ibfk_1` FOREIGN KEY (`SOPHIEUMUA`) REFERENCES `phieumua` (`SOPHIEUMUA`),
  ADD CONSTRAINT `ctphieumua_ibfk_2` FOREIGN KEY (`SANPHAM`) REFERENCES `sanpham` (`MaSP`);

--
-- Constraints for table `phieumua`
--
ALTER TABLE `phieumua`
  ADD CONSTRAINT `phieumua_ibfk_1` FOREIGN KEY (`NHACC`) REFERENCES `suppliers` (`MaNCC`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`LoaiSP`) REFERENCES `loaisp` (`MaLoai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
