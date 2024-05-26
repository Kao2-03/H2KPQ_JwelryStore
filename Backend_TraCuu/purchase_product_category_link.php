<?php
include '../db_connection.php'; // Include file kết nối

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ POST request
    $supplier_name = htmlspecialchars($_POST['supplier_name'] ?? '');
    $total_payment = floatval($_POST['total_payment'] ?? 0);
    $current_date = $_POST['current_date'] ?? date('Y-m-d');
    $product_category = htmlspecialchars($_POST['product_category'] ?? '');

    // Kiểm tra dữ liệu
    if (empty($supplier_name) || empty($current_date) || $total_payment <= 0 || empty($product_category)) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu yêu cầu không hợp lệ"]);
        exit;
    }

    // Kiểm tra định dạng ngày
    if (!DateTime::createFromFormat('Y-m-d', $current_date)) {
        echo json_encode(["status" => "error", "message" => "Định dạng ngày không hợp lệ"]);
        exit;
    }

    // Bước 1: Chèn dữ liệu vào bảng purchase_slip
    $stmt_insert_purchase = $mysqli->prepare("INSERT INTO purchase_slip (supplier_name, total_payment, payment_date) VALUES (?, ?, ?)");
    $stmt_insert_purchase->bind_param("sds", $supplier_name, $total_payment, $current_date);

    if ($stmt_insert_purchase->execute()) {
        // Lấy ID của phiếu mua hàng vừa chèn
        $purchase_id = $stmt_insert_purchase->insert_id;
        $stmt_insert_purchase->close();

        // Bước 2: Chèn dữ liệu vào bảng product_category nếu danh mục sản phẩm chưa tồn tại
        $stmt_insert_category = $mysqli->prepare("INSERT INTO product_category (name) VALUES (?) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
        $stmt_insert_category->bind_param("s", $product_category);
        $stmt_insert_category->execute();
        
        // Lấy ID của danh mục sản phẩm
        $category_id = $stmt_insert_category->insert_id;
        $stmt_insert_category->close();

        // Bước 3: Chèn dữ liệu vào bảng liên kết giữa phiếu mua hàng và danh mục sản phẩm
        $stmt_insert_link = $mysqli->prepare("INSERT INTO purchase_product_category_link (purchase_id, category_id) VALUES (?, ?)");
        $stmt_insert_link->bind_param("ii", $purchase_id, $category_id);

        if ($stmt_insert_link->execute()) {
            // Trả về dữ liệu dưới dạng JSON
            echo json_encode(["status" => "success", "message" => "Dữ liệu đã được lưu vào cơ sở dữ liệu"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Lỗi khi liên kết danh mục sản phẩm với phiếu mua hàng"]);
        }
        $stmt_insert_link->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi lưu dữ liệu vào phiếu mua hàng"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Phương thức yêu cầu không hợp lệ"]);
}

// Đóng kết nối
$mysqli->close();
?>
