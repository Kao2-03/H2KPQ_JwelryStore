<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $KhachHang = $_POST['KhachHang'];
    $SDT = $_POST['SDT'];

    $_SESSION['KhachHang'] = $KhachHang;
    $_SESSION['SDT'] = $SDT;

    $response = array(
        'status' => 'success',
        'message' => 'Nhà cung cấp đã được chọn thành công.'
    );
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method.'
    );
    echo json_encode($response);
}
?>
