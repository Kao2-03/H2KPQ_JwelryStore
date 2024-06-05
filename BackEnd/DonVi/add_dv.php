<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    $data = json_decode(file_get_contents('php://input'), true);
    error_log("Dữ liệu nhận được: " . print_r($data, true)); // Kiểm tra dữ liệu nhận được

    if (isset($data['TenDV']) && !empty($data['TenDV'])) {
        $tenDV = $data['TenDV'];
        error_log("Tên đơn vị nhận được: " . $tenDV); // Log tên đơn vị nhận được

        // Tạo mã đơn vị mới
        $result = $conn->query("SELECT MAX(MADV) AS max_madv FROM DONVI");
        if ($result) {
            $row = $result->fetch_assoc();
            $max_madv = $row['max_madv'];

            if ($max_madv) {
                $new_madv = 'DV' . str_pad((int)substr($max_madv, 2) + 1, 2, '0', STR_PAD_LEFT);
            } else {
                $new_madv = 'DV01';
            }

            $stmt = $conn->prepare("INSERT INTO DONVI (MADV, TENDV) VALUES (?, ?)");
            $stmt->bind_param("ss", $new_madv, $tenDV);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['maDV'] = $new_madv;
                $response['tenDV'] = $tenDV;
            } else {
                $response['success'] = false;
                $response['error'] = 'Không thể thêm đơn vị.';
            }

            $stmt->close();
        } else {
            $response['success'] = false;
            $response['error'] = 'Lỗi truy vấn cơ sở dữ liệu.';
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Tên đơn vị không hợp lệ.';
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

$conn->close();
error_log("Phản hồi: " . print_r($response, true)); // Kiểm tra phản hồi
echo json_encode($response);
?>
