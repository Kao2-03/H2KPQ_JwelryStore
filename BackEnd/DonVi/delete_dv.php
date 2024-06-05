<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['maDV']) && !empty($data['maDV'])) {
        $maDV = $data['maDV'];

        $stmt = $conn->prepare("DELETE FROM DONVI WHERE MADV = ?");
        $stmt->bind_param("s", $maDV);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = 'Không thể xóa đơn vị.';
        }

        $stmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Mã đơn vị không hợp lệ.';
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

$conn->close();
echo json_encode($response);
?>
