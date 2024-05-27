<?php
// Include the database configuration file
include '../Backend_PM/db_connection.php'; // Make sure this file contains your DB connection details

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_phone = $_POST['supplier_phone'];
    $current_date_save = $_POST['current_date'];
    $total_payment = $_POST['total_payment'];
    $products = $_POST['products'];


    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("INSERT INTO purchase_orders (supplier_name, supplier_address, supplier_phone, current_date_save, total_payment, products) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $supplier_name, $supplier_address, $supplier_phone, $current_date_save, $total_payment, $products);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Phiếu đã được lập thành công!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra khi lập phiếu. Vui lòng thử lại sau.']);
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ.']);
}
?>
