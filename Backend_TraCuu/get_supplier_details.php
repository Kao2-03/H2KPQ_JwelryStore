<?php
include '../db_connection.php'; // Include file kết nối

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $purchaseCode = htmlspecialchars($_GET['id']);

        $stmt = $mysqli->prepare("
            SELECT ps.id AS purchase_code, ps.payment_date, ps.total_payment, ps.supplier_name, s.address AS supplier_address, s.phone AS supplier_phone
            FROM purchase_slip ps
            LEFT JOIN suppliers s ON ps.supplier_id = s.id
            WHERE ps.id = ?
        ");

        if ($stmt) {
            $stmt->bind_param("i", $purchaseCode);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $purchaseDetails = $result->fetch_assoc();

                $stmt = $mysqli->prepare("
                    SELECT p.product_name, pp.unit_price, pp.quantity, (pp.unit_price * pp.quantity) AS total_price
                    FROM purchase_products pp
                    JOIN products p ON pp.product_id = p.id
                    WHERE pp.purchase_code = ?
                ");
             
                if ($stmt) {
                    $stmt->bind_param("i", $purchaseCode);
                    $stmt->execute();
                    $productResult = $stmt->get_result();

                    $products = [];
                    while ($product = $productResult->fetch_assoc()) {
                        $products[] = $product;
                    }

                    echo json_encode([
                        'status' => 'success',
                        'purchase_details' => array_merge($purchaseDetails, ['products' => $products])
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Không thể lấy danh sách sản phẩm từ cơ sở dữ liệu.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Không tìm thấy chi tiết phiếu mua.'
                ]);
            }

            $stmt->close();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Không thể chuẩn bị truy vấn.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Mã phiếu mua không được cung cấp hoặc không hợp lệ.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Phương thức yêu cầu không hợp lệ.'
    ]);
}

$mysqli->close();
?>
