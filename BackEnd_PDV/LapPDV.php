<?php
session_start();

// Thu thập dữ liệu từ form
$KhachHang = $_POST['KhachHang'] ?? '';
$SDT = $_POST['SDT'] ?? '';
$SoDienThoai = $_POST['SoDienThoai'] ?? '';
$Sale = $_POST['Sale'] ?? ''; // Phần trăm trả trước

// Tính toán các giá trị cần thiết
$DSDV = $_SESSION['selectdv'] ?? [];
$ThanhTien = array_sum(array_column($DSDV, 'ThanhTien'));
$TraTruoc = $ThanhTien * ($Sale / 100); // Tính số tiền trả trước
$ConLai = $ThanhTien - $TraTruoc; // Tính số tiền còn lại

// Lưu thông tin vào cơ sở dữ liệu
include '../Backend_PM/db_connection.php';

$current_date_save = date('Y-m-d');

$stmt1 = $mysqli->prepare("INSERT INTO phieudichvu (KhachHang, SDT, NgayLap, TongTien, TraTruoc, ConLai) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt1) {
    // Xử lý lỗi khi chuẩn bị truy vấn
    exit;
}

$stmt1->bind_param("ssssid", $KhachHang, $SoDienThoai, $current_date_save, $ThanhTien, $TraTruoc, $ConLai);
if (!$stmt1->execute()) {
    // Xử lý lỗi khi thực hiện truy vấn
    exit;
}

// Lấy ID của phiếu dịch vụ vừa được tạo
$phieudv_id = $stmt1->insert_id;

$stmt1->close();

// Lưu thông tin chi tiết dịch vụ vào bảng ctphieudv
$stmt2 = $mysqli->prepare("INSERT INTO ctphieudv (SoPhieu, LoaiDV, TenLoaiDV, DonGia, SoLuong, ThanhTien) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt2) {
    // Xử lý lỗi khi chuẩn bị truy vấn
    exit;
}

foreach ($DSDV as $dv) {
    $stmt2->bind_param("isssii", $phieudv_id, $dv['ID'], $dv['TenLoai'], $dv['DonGia'], $dv['SoLuong'], $dv['ThanhTien']);
    if (!$stmt2->execute()) {
        // Xử lý lỗi khi thực hiện truy vấn
        exit;
    }
}

$stmt2->close();
$mysqli->close();

// Xóa session sau khi lưu thông tin thành công
unset($_SESSION['selectdv']);

// Redirect hoặc hiển thị thông báo thành công
?>
