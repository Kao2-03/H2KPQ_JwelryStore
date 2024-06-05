<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        error_log("Dữ liệu POST nhận được: " . print_r($_POST, true));

        if (isset($_POST['maDVEdit']) && isset($_POST['tenDVEdit']) && !empty($_POST['maDVEdit']) && !empty($_POST['tenDVEdit'])) {
            $maDV = $_POST['maDVEdit'];
            $tenDV = $_POST['tenDVEdit'];

            $stmt = $conn->prepare("UPDATE DONVI SET TENDV = ? WHERE MADV = ?");
            $stmt->bind_param("ss", $tenDV, $maDV);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['maDV'] = $maDV;
                $response['tenDV'] = $tenDV;
            } else {
                $response['success'] = false;
                $response['error'] = 'Không thể cập nhật thông tin đơn vị.';
            }
            $stmt->close();
        } else {
            $response['success'] = false;
            $response['error'] = 'Dữ liệu không hợp lệ.';
            error_log("Dữ liệu không hợp lệ: " . print_r($_POST, true)); // Add more details to error log
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Yêu cầu không hợp lệ.';
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}
$conn->close();
echo json_encode($response);
?>
