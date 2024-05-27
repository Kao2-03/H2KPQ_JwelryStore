<?php

include '../Backend_PM/db_connection.php'; // Include file kết nối

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $_POST['supplier_name'] ?? '';
    $total_payment = $_POST['total_payment'] ?? 0;
    $current_date = $_POST['current_date'] ?? date('Y-m-d');
    $products = isset($_POST['products']) ? json_decode($_POST['products'], true) : [];

    if (empty($supplier_name) || empty($current_date) || $total_payment <= 0 || empty($products)) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu yêu cầu không hợp lệ"]);
        exit;
    }

    if ($mysqli->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'Kết nối cơ sở dữ liệu thất bại: ' . $mysqli->connect_error]));
    }

    $mysqli->begin_transaction();

    try {
        $stmt = $mysqli->prepare("INSERT INTO purchase_slip (supplier_name, total_payment, payment_date) VALUES (?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed for purchase_slip: " . $mysqli->error);
        }
        $stmt->bind_param("sds", $supplier_name, $total_payment, $current_date);

        if ($stmt->execute()) {
            $purchase_code = $stmt->insert_id;
            $stmt = $mysqli->prepare("INSERT INTO purchase_products (purchase_code, product_name, unit_price, quantity, total_price) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare failed for purchase_products: " . $mysqli->error);
            }

            foreach ($products as $product) {
                $stmt->bind_param("isdis", $purchase_code, $product['name'], $product['unit_price'], $product['quantity'], $product['total_price']);
                $stmt->execute();

                // Update product quantity in the products table
                $update_stmt = $mysqli->prepare("INSERT INTO products (product_name, price, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)");
                if (!$update_stmt) {
                    throw new Exception("Prepare failed for products: " . $mysqli->error);
                }
                $update_stmt->bind_param("sdi", $product['name'], $product['unit_price'], $product['quantity']);
                $update_stmt->execute();
                $update_stmt->close();
            }

            $mysqli->commit();
            echo json_encode(['status' => 'success', 'message' => 'Phiếu đã được lập thành công!', 'purchase_code' => $purchase_code]);
        } else {
            throw new Exception('Có lỗi xảy ra khi lập phiếu. Vui lòng thử lại sau.');
        }
    } catch (Exception $e) {
        $mysqli->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        $stmt->close();
        $mysqli->close();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ']);
}
?>
