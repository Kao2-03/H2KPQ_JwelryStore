<?php
include '../Backend_PM/db_connection.php'; // Include file kết nối

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $_POST['supplier_name'] ?? '';
    $total_payment = $_POST['total_payment'] ?? 0;
    
    $current_date = isset($_POST['current_date']) ? $_POST['current_date'] : date('Y-m-d');

    if (empty($supplier_name) || empty($current_date) || $total_payment <= 0) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu yêu cầu không hợp lệ"]);
        exit;
    }

    $sql = "INSERT INTO purchase_slip (supplier_name, total_payment, payment_date)
            VALUES ('$supplier_name', $total_payment, '$current_date')";

    if ($mysqli->query($sql) === TRUE) {
        $inserted_id = $mysqli->insert_id; 
        echo json_encode(["status" => "success", "message" => "Dữ liệu đã được lưu vào cơ sở dữ liệu", "purchase_code" => $inserted_id]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi lưu dữ liệu: " . mysqli_error($mysqli)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Phương thức yêu cầu không hợp lệ"]);
}

$mysqli->close();
?>
