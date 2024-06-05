<?php
include '../Backend_PDV/db_connection.php'; // Include file kết nối

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $KhachHang = $_POST['KhachHang'] ?? '';
    $ThanhTien = $_POST['ThanhTien'] ?? 0;
    $NgayLap = isset($_POST['NgayLap']) ? $_POST['NgayLap'] : date('Y-m-d');
    $SDT = $_POST['SDT'] ?? '';

    if (empty($KhachHang) || empty($NgayLap) || $ThanhTien <= 0 || empty($SDT)) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu yêu cầu không hợp lệ"]);
        exit;
    }

    if ($mysqli->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'Kết nối cơ sở dữ liệu thất bại: ' . $mysqli->connect_error]));
    }

    // Sử dụng Prepared Statement để tránh SQL Injection
    $stmt = $mysqli->prepare("INSERT INTO phieudichvu (NgayLap, KhachHang, SDT, TongTien, TraTruoc, Conlai) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Chuẩn bị truy vấn thất bại: " . $mysqli->error]);
        exit;
    }

    $TraTruoc = 0; // Giá trị mặc định ban đầu
    $ConLai = $ThanhTien; // Giá trị mặc định ban đầu

    $stmt->bind_param("ssdddd", $NgayLap, $KhachHang, $SDT, $ThanhTien, $TraTruoc, $ConLai);

    if ($stmt->execute()) {
        $inserted_id = $stmt->insert_id;
        echo json_encode(["status" => "success", "message" => "Dữ liệu đã được lưu vào cơ sở dữ liệu", "SoPhieu" => $inserted_id]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi lưu dữ liệu: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Phương thức yêu cầu không hợp lệ"]);
}

$mysqli->close();
?>
