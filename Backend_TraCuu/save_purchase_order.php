<?php
include '../db_connection.php'; // Include file kết nối

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ POST request
    $supplier_name = $_POST['supplier_name'] ?? '';
    $total_payment = $_POST['total_payment'] ?? 0;
    $current_date = $_POST['current_date'] ?? date('Y-m-d');
    $products = isset($_POST['products']) ? json_decode($_POST['products'], true) : [];

    // Kiểm tra dữ liệu
    if (empty($supplier_name) || empty($current_date) || $total_payment <= 0 || empty($products)) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu yêu cầu không hợp lệ"]);
        exit;
    }

    // Kiểm tra kết nối
    if ($mysqli->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'Kết nối cơ sở dữ liệu thất bại: ' . $mysqli->connect_error]));
    }

    // Bắt đầu giao dịch
    $mysqli->begin_transaction();

    try {
        // Thực hiện truy vấn để chèn dữ liệu vào bảng purchase_slip
        $stmt = $mysqli->prepare("INSERT INTO purchase_slip (supplier_name, total_payment, payment_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $supplier_name, $total_payment, $current_date);

        if ($stmt->execute()) {
            $purchase_code = $stmt->insert_id; // Lấy ID của bản ghi vừa chèn

            // Chèn sản phẩm vào bảng purchase_products
            $stmt = $mysqli->prepare("INSERT INTO purchase_products (purchase_code, product_name, unit_price, quantity, total_price) VALUES (?, ?, ?, ?, ?)");

            foreach ($products as $product) {
                $stmt->bind_param("isdis", $purchase_code, $product['name'], $product['unit_price'], $product['quantity'], $product['total_price']);
                $stmt->execute();
            }

            // Xác nhận giao dịch
            $mysqli->commit();
            echo json_encode(['status' => 'success', 'message' => 'Phiếu đã được lập thành công!', 'purchase_code' => $purchase_code]);
        } else {
            throw new Exception('Có lỗi xảy ra khi lập phiếu. Vui lòng thử lại sau.');
        }
    } catch (Exception $e) {
        // Hủy giao dịch nếu có lỗi
        $mysqli->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        // Đóng câu lệnh truy vấn và kết nối
        $mysqli->close();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ']);
}
?>
