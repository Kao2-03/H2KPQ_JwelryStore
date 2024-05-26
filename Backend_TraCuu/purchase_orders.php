<?php
// Include the database configuration file
include '../db_connection.php'; // Make sure this file contains your DB connection details

// Start the session
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from POST request
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_phone = $_POST['supplier_phone'];
    $current_date_save = $_POST['current_date'];
    $total_payment = $_POST['total_payment'];
    $products = $_POST['products'];


    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare an insert statement
    $stmt = $mysqli->prepare("INSERT INTO purchase_orders (supplier_name, supplier_address, supplier_phone, current_date_save, total_payment, products) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $supplier_name, $supplier_address, $supplier_phone, $current_date_save, $total_payment, $products);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Phiếu đã được lập thành công!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra khi lập phiếu. Vui lòng thử lại sau.']);
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
} else {
    // Handle invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ.']);
}
?>
