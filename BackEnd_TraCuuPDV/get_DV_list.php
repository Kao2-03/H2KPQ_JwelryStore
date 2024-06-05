<?php
include '../Backend_TraCuuPDV/db_connection.php'; // Include file kết nối

// Lấy giá trị SoPhieu từ POST hoặc gán mặc định là chuỗi rỗng
$SoPhieu = $_POST['SoPhieu'] ?? '';

if (!$SoPhieu) {
    echo json_encode(['status' => 'error', 'message' => 'Không có mã phiếu được cung cấp.']);
    exit;
}

// Sử dụng Prepared Statement để tránh SQL Injection
$sql = "SELECT * FROM ctphieudv WHERE SoPhieu = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $SoPhieu);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $DSDV = [];
    while ($row = $result->fetch_assoc()) {
        $DSDV[] = [
            'SoPhieu' => $row['SoPhieu'],
            'LoaiDV' => $row['LoaiDV'],
            'DonGia' => $row['DonGia'],
            'SoLuong' => $row['SoLuong'],
            'ThanhTien' => $row['ThanhTien']
        ];
    }
    echo json_encode(['status' => 'success', 'DSPDV' => $DSDV]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Không có dịch vụ được tìm thấy cho mã phiếu này.']);
}

$stmt->close(); // Đóng statement để giải phóng tài nguyên
$mysqli->close();
?>
