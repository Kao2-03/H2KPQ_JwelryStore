<?php
include '../Backend_TraCuuPDV/db_connection.php';

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SoPhieu = $_POST['SoPhieu'];

    // Chuẩn bị câu lệnh SQL để xóa phiếu dịch vụ
    $sql = "DELETE FROM phieudichvu WHERE SoPhieu = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $SoPhieu);

    if ($stmt->execute()) {
        // Xóa thành công phiếu dịch vụ
        $response['success'] = true;
    } else {
        // Xóa thất bại, trả về thông báo lỗi
        $response['message'] = "Lỗi SQL: " . $stmt->error;
    }

    $stmt->close();
} else {
    $response['message'] = "Yêu cầu không hợp lệ.";
}

$mysqli->close();

echo json_encode($response);
?>
