<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplierName = $_POST['supplierName'];
    $supplierAddress = $_POST['supplierAddress'];
    $supplierPhone = $_POST['supplierPhone'];

    $_SESSION['supplierName'] = $supplierName;
    $_SESSION['supplierAddress'] = $supplierAddress;
    $_SESSION['supplierPhone'] = $supplierPhone;

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
