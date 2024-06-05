<?php
include '../Backend_PDV/db_connection.php'; // Include file kết nối

// Kiểm tra xem có dữ liệu id được gửi từ phía client không
if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
    $id = $_POST['id'];
    
    // Bắt đầu giao dịch
    $mysqli->begin_transaction();

    try {
        // Xóa các dịch vụ liên quan trong bảng ctphieudv
        $deleteDSDVSql = "DELETE FROM ctphieudv WHERE SoPhieu = ?";
        $stmt = $mysqli->prepare($deleteDSDVSql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close(); // Đóng statement để giải phóng tài nguyên

        // Xóa phiếu dịch vụ trong bảng phieudichvu
        $deleteSlipSql = "DELETE FROM phieudichvu WHERE id = ?";
        $stmt = $mysqli->prepare($deleteSlipSql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close(); // Đóng statement để giải phóng tài nguyên

        // Commit giao dịch nếu mọi thứ thành công
        $mysqli->commit();
        echo json_encode(["status" => "success", "message" => "Phiếu dịch vụ và các dịch vụ liên quan đã được xóa thành công"]);
    } catch (Exception $e) {
        // Nếu có lỗi, rollback giao dịch và trả về thông báo lỗi
        $mysqli->rollback();
        echo json_encode(["status" => "error", "message" => "Lỗi khi xóa phiếu dịch vụ: " . $e->getMessage()]);
    }
} else {
    // Nếu id không hợp lệ hoặc không được cung cấp, trả về thông báo lỗi
    echo json_encode(["status" => "error", "message" => "ID không hợp lệ hoặc không được cung cấp"]);
}

// Đóng kết nối với cơ sở dữ liệu
$mysqli->close();
?>
