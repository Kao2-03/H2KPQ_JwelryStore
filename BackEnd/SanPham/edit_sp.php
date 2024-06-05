<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    // Get the data sent from the AJAX request
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if all required fields are present
    if (isset($data['maSP'], $data['tenSP'], $data['gia'], $data['soluong'])) {
        $maSP = $data['maSP'];
        $tenSP = $data['tenSP'];
        $gia = $data['gia'];
        $soluong = $data['soluong'];

        // Prepare the SQL query to update the product
        $stmt = $conn->prepare("UPDATE SANPHAM SET TENSP = ?, DONGIAMUA = ?, SOLUONGKHO = ? WHERE MASP = ?");
        $stmt->bind_param("ssis", $tenSP, $gia, $soluong, $maSP);        

        // Execute the query
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = 'Không thể cập nhật sản phẩm.';
        }

        $stmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Thông tin sản phẩm không hợp lệ.';
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

$conn->close();
echo json_encode($response);
?>
