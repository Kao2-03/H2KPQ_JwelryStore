<?php
include '../Backend_PDV/db_connection.php'; // Include file kết nối

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $KhachHang = htmlspecialchars($_POST['KhachHang'] ?? '');
    $TongTien = floatval($_POST['TongTien'] ?? 0);
    $NgayLap = $_POST['NgayLap'] ?? date('Y-m-d');
    $LoaiDV = htmlspecialchars($_POST['LoaiDV'] ?? '');

    if (empty($KhachHang) || empty($NgayLap) || $TongTien <= 0 || empty($LoaiDV)) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu yêu cầu không hợp lệ"]);
        exit;
    }

    if (!DateTime::createFromFormat('Y-m-d', $NgayLap)) {
        echo json_encode(["status" => "error", "message" => "Định dạng ngày không hợp lệ"]);
        exit;
    }

    $stmt_insert_pdv = $mysqli->prepare("INSERT INTO phieudichvu (KhachHang, TongTien, NgayLap) VALUES (?, ?, ?)");
    $stmt_insert_pdv->bind_param("sds", $KhachHang, $TongTien, $NgayLap);

    if ($stmt_insert_pdv->execute()) {
        $SoPhieu = $stmt_insert_pdv->insert_id;
        $stmt_insert_pdv->close();

        $stmt_insert_category = $mysqli->prepare("INSERT INTO LoaiDV (name) VALUES (?) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
        $stmt_insert_category->bind_param("s", $LoaiDV);
        $stmt_insert_category->execute();
        
        $category_id = $stmt_insert_category->insert_id;
        $stmt_insert_category->close();

        $stmt_insert_link = $mysqli->prepare("INSERT INTO purchase_product_category_link (SoPhieu, category_id) VALUES (?, ?)");
        $stmt_insert_link->bind_param("ii", $SoPhieu, $category_id);

        if ($stmt_insert_link->execute()) {
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
