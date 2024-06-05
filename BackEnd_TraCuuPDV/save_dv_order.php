<?php
include '../Backend_PDV/db_connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $KhachHang = $_POST['KhachHang'] ?? '';
    $SDT = $_POST['SDT'] ?? '';
    $SoLuong = $_POST['soLuong'] ?? '';
    $ThanhTien = $_POST['thanhTien'] ?? '';
    $TraTruoc = $_POST['traTruoc'] ?? '';
    $ConLai = $_POST['conLai'] ?? '';

    // Kiểm tra dữ liệu đầu vào
    if (empty($KhachHang) || empty($SDT) || empty($SoLuong) || empty($ThanhTien) || empty($TraTruoc) || empty($ConLai)) {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu yêu cầu không hợp lệ']);
        exit;
    }

    // Kiểm tra kết nối cơ sở dữ liệu
    if ($mysqli->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Kết nối cơ sở dữ liệu thất bại: ' . $mysqli->connect_error]);
        exit;
    }

    // Thực hiện truy vấn SQL để lưu thông tin vào bảng phieudichvu
    $stmt = $mysqli->prepare("INSERT INTO phieudichvu (KhachHang, SDT, SoLuong, ThanhTien, TraTruoc, ConLai) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Chuẩn bị truy vấn thất bại: ' . $mysqli->error]);
        exit;
    }

    // Bind các tham số vào câu lệnh SQL và thực thi câu lệnh
    $stmt->bind_param("ssssss", $KhachHang, $SDT, $SoLuong, $ThanhTien, $TraTruoc, $ConLai);
    if ($stmt->execute()) {
        // Lấy ID của phiếu vừa được lập
        $phieuID = $stmt->insert_id;

        // Đóng kết nối và thông báo thành công
        $stmt->close();
        $mysqli->close();
        echo json_encode(['status' => 'success', 'message' => 'Phiếu đã được lập thành công!', 'phieuID' => $phieuID]);
    } else {
        // Đóng kết nối và thông báo lỗi nếu có
        $stmt->close();
        $mysqli->close();
        echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra khi lập phiếu: ' . $stmt->error]);
    }
} else {
    // Phương thức yêu cầu không hợp lệ
    echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ.']);
}
?>
