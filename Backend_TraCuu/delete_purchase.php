<?php
include '../db_connection.php'; 

if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
    $id = $_POST['id'];
    
    $mysqli->begin_transaction();

    try {
        $deleteProductsSql = "DELETE FROM purchase_products WHERE purchase_code = ?";
        $stmt = $mysqli->prepare($deleteProductsSql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $deleteSlipSql = "DELETE FROM purchase_slip WHERE id = ?";
        $stmt = $mysqli->prepare($deleteSlipSql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $mysqli->commit();
        echo json_encode(["status" => "success", "message" => "Phiếu mua và các sản phẩm liên quan đã được xóa thành công"]);
    } catch (Exception $e) {
        $mysqli->rollback();
        echo json_encode(["status" => "error", "message" => "Lỗi khi xóa phiếu mua: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ID không hợp lệ hoặc không được cung cấp"]);
}

$mysqli->close();
?>
