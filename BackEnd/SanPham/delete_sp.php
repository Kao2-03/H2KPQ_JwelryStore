<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    // Get the data sent from the AJAX request
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the product ID is present
    if (isset($data['maSP'])) {
        $maSP = $data['maSP'];

        // Prepare the SQL query to delete the product
        $stmt = $conn->prepare("DELETE FROM SANPHAM WHERE MASP = ?");
        $stmt->bind_param("s", $maSP);

        // Execute the query
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = 'Không thể xóa sản phẩm.';
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
