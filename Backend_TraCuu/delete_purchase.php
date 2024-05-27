<?php
include '../Backend_PM/db_connection.php'; // Include file kết nối

if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
    $id = $_POST['id'];
    
    // Bắt đầu giao dịch
    $mysqli->begin_transaction();

    try {
        // Xóa các sản phẩm liên quan đến phiếu mua hàng
        $deleteProductsSql = "DELETE FROM purchase_products WHERE purchase_code = ?";
        $stmt = $mysqli->prepare($deleteProductsSql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Xóa phiếu mua hàng
        $deleteSlipSql = "DELETE FROM purchase_slip WHERE id = ?";
        $stmt = $mysqli->prepare($deleteSlipSql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Xác nhận giao dịch
        $mysqli->commit();
        echo json_encode(["status" => "success", "message" => "Phiếu mua và các sản phẩm liên quan đã được xóa thành công"]);
    } catch (Exception $e) {
        // Hủy giao dịch nếu có lỗi
        $mysqli->rollback();
        echo json_encode(["status" => "error", "message" => "Lỗi khi xóa phiếu mua: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ID không hợp lệ hoặc không được cung cấp"]);
}

$mysqli->close();
?>
