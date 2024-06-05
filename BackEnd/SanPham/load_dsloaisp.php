<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    // Execute the query to fetch category names
    $sql = "SELECT MALOAI, TENLOAI FROM loaisp";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
        echo json_encode($response);
    } else {
        $response['error'] = 'Lỗi truy vấn cơ sở dữ liệu.';
        echo json_encode($response);
    }

    mysqli_close($conn);
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
    echo json_encode($response);
}
?>
