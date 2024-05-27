<?php

include '../Backend_PM/db_connection.php'; // Include file kết nối

$id = $_POST['id'] ?? '';

if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'Không có mã phiếu được cung cấp.']);
    exit;
}

$sql = "SELECT * FROM purchase_products WHERE purchase_code = '$id'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'],
            'product_name' => $row['product_name'],
            'unit_price' => $row['unit_price'],
            'quantity' => $row['quantity'],
            'total_price' => $row['total_price']
        ];
    }
    echo json_encode(['status' => 'success', 'products' => $products]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Không có sản phẩm được tìm thấy cho mã phiếu này.']);
}

$mysqli->close();
?>
