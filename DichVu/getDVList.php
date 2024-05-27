<?php
include '../db_connection.php'; // Include file kết nối

// Lấy id của phiếu mua hàng từ yêu cầu POST
$id = $_POST['SoPhieu'] ?? '';

// Kiểm tra xem id có tồn tại không
if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'Không có mã phiếu được cung cấp.']);
    exit;
}

// Thực hiện truy vấn để lấy thông tin dựa trên id của phiếu 
$sql = "SELECT * FROM CTPhieuDV WHERE SoPhieu = '$id'";
$result = $mysqli->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
    $service = [];
    // Duyệt qua từng hàng kết quả và lưu thông tin vào mảng
    while ($row = $result->fetch_assoc()) {
        $service[] = [
            'SoPhieu' => $row['SoPhieu'],
            'LoaiDV' => $row['LoaiDV'],
            'DonGia' => $row['DonGia'],
            'SoLuong' => $row['SoLuong'],
            'ThanhTien' => $row['ThanhTien']
        ];
    }
    // Trả về thông tin dưới dạng chuỗi JSON
    echo json_encode(['status' => 'success', 'service' => $service]);
} else {
    // Nếu không tìm thấy, trả về thông báo lỗi
    echo json_encode(['status' => 'error', 'message' => 'Không có dịch vụ được tìm thấy cho mã phiếu này.']);
}

// Đóng kết nối
$mysqli->close();
?>
