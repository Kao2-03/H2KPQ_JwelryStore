<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra dữ liệu đầu vào
    $required_fields = ['ID', 'TenLoai', 'DonGia'];
    $missing_fields = array_diff($required_fields, array_keys($_POST));
    if (!empty($missing_fields)) {
        echo json_encode(array('status' => 'error', 'message' => 'Missing fields: ' . implode(', ', $missing_fields)));
        exit;
    }

    // Bảo vệ dữ liệu đầu vào
    $ID = htmlspecialchars($_POST['ID']);
    $TenLoai = htmlspecialchars($_POST['TenLoai']);
    $DonGia = floatval($_POST['DonGia']);
    $SoLuong = isset($_POST['SoLuong']) ? intval($_POST['SoLuong']) : 1;

    // Kiểm tra tính hợp lệ của dữ liệu
    if ($DonGia <= 0 || $SoLuong <= 0) {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid data: Price and quantity must be greater than zero.'));
        exit;
    }

    // Tính thành tiền
    $ThanhTien = $SoLuong * $DonGia;

    // Tạo mảng dịch vụ mới
    $DV = array(
        'ID' => $ID,
        'TenLoai' => $TenLoai,
        'DonGia' => $DonGia,
        'SoLuong' => $SoLuong,
        'ThanhTien' => $ThanhTien,
    );

    // Thêm dịch vụ vào session
    if (!isset($_SESSION['selectdv'])) {
        $_SESSION['selectdv'] = array();
    }

    $_SESSION['selectdv'][] = $DV;

    echo json_encode(array('status' => 'success', 'message' => 'Service selected successfully'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
