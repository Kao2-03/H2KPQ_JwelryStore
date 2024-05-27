<?php
include '../Backend_PM/db_connection.php'; // Include file kết nối

// Lấy id của phiếu mua hàng từ yêu cầu POST
$id = $_POST['id'] ?? '';

// Kiểm tra xem id có tồn tại không
if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'Không có mã phiếu được cung cấp.']);
    exit;
}

// Thực hiện truy vấn để lấy thông tin sản phẩm từ bảng purchase_products dựa trên id của phiếu mua hàng
$sql = "SELECT * FROM purchase_products WHERE purchase_code = '$id'";
$result = $mysqli->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
    $products = [];
    // Duyệt qua từng hàng kết quả và lưu thông tin sản phẩm vào mảng
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'],
            'product_name' => $row['product_name'],
            'unit_price' => $row['unit_price'],
            'quantity' => $row['quantity'],
            'total_price' => $row['total_price']
        ];
    }
    // Trả về thông tin sản phẩm dưới dạng chuỗi JSON
    echo json_encode(['status' => 'success', 'products' => $products]);
} else {
    // Nếu không có sản phẩm nào được tìm thấy, trả về thông báo lỗi
    echo json_encode(['status' => 'error', 'message' => 'Không có sản phẩm được tìm thấy cho mã phiếu này.']);
}

// Đóng kết nối
$mysqli->close();
?>
