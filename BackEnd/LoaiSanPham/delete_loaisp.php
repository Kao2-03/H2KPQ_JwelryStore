<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    $data = json_decode(file_get_contents('php://input'), true);
    error_log("Dữ liệu nhận được: " . print_r($data, true)); // Kiểm tra dữ liệu nhận được

    if (isset($data['MaLoai'])) {
        $maLoai = $data['MaLoai'];
        error_log("Mã loại sản phẩm nhận được: " . $maLoai); // Log mã loại sản phẩm nhận được

        // Bắt đầu transaction
        $conn->begin_transaction();

        // Xóa tất cả các chi tiết phiếu bán liên quan trước
        $stmt1 = $conn->prepare("DELETE ct FROM CTPHIEUBAN ct 
                                 INNER JOIN SANPHAM sp ON ct.SanPham = sp.MaSP 
                                 WHERE sp.LoaiSP = ?");
        $stmt1->bind_param("s", $maLoai);
        $stmt1->execute();
        $stmt1->close();

        // Xóa tất cả các sản phẩm liên quan trước
        $stmt2 = $conn->prepare("DELETE FROM SANPHAM WHERE LoaiSP = ?");
        $stmt2->bind_param("s", $maLoai);
        $stmt2->execute();
        $stmt2->close();

        // Xóa loại sản phẩm
        $stmt3 = $conn->prepare("DELETE FROM LOAISP WHERE MaLoai = ?");
        $stmt3->bind_param("s", $maLoai);
        
        if ($stmt3->execute()) {
            $response['success'] = true;
            $conn->commit(); // Commit transaction nếu tất cả các lệnh xóa thành công
        } else {
            $response['success'] = false;
            $response['error'] = 'Không thể xóa loại sản phẩm.';
            $conn->rollback(); // Rollback transaction nếu có lỗi
        }

        $stmt3->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Mã loại sản phẩm không hợp lệ.';
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
    $conn->rollback(); // Rollback transaction nếu có ngoại lệ
}

$conn->close();
error_log("Phản hồi: " . print_r($response, true)); // Kiểm tra phản hồi
echo json_encode($response);
?>
