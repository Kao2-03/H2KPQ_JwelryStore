<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    // Nhận dữ liệu gửi từ AJAX
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['MaNCC'], $data['ten'], $data['diachi'], $data['sdt'])) {
        $mancc = $data['MaNCC'];
        $tenNCC = $data['ten'];
        $diachiNCC = $data['diachi'];
        $sdtNCC = $data['sdt'];

        // Chuẩn bị câu truy vấn SQL để cập nhật thông tin nhà cung cấp
        $stmt = $conn->prepare("UPDATE suppliers SET ten = ?, diachi = ?, sdt = ? WHERE MaNCC = ?");
        $stmt->bind_param("ssss", $tenNCC, $diachiNCC, $sdtNCC, $mancc);

        // Thực thi câu truy vấn
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = 'Không thể cập nhật nhà cung cấp.';
        }

        $stmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Thông tin nhà cung cấp không hợp lệ.';
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

$conn->close();
echo json_encode($response);
?>
