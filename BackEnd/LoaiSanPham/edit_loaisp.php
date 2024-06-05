<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    // Đảm bảo dữ liệu được gửi đi từ form thông qua phương thức POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Thu thập dữ liệu từ form
        $maLoaiSP = $_POST['maLoaiSPEdit'];
        $tenLoaiSP = $_POST['tenLoaiSPEdit'];
        $phanTram = $_POST['phanTramEdit'];
        $dvtinh = $_POST['dvtinhEdit'];

        // Kiểm tra xem các trường dữ liệu cần thiết đã được gửi đi và không trống
        if (!empty($maLoaiSP) && !empty($tenLoaiSP) && !empty($phanTram) && !empty($dvtinh)) {
            // Chuẩn bị truy vấn SQL để cập nhật thông tin loại sản phẩm
            $stmt = $conn->prepare("UPDATE LOAISP SET TENLOAI = ?, DVTINH = ?, PHANTRAM = ? WHERE MALOAI = ?");
            $stmt->bind_param("ssds", $tenLoaiSP, $dvtinh, $phanTram, $maLoaiSP);

            // Thực thi truy vấn SQL
            if ($stmt->execute()) {
                // Trả về phản hồi thành công nếu truy vấn thành công
                $response['success'] = true;
                $response['maLoaiSP'] = $maLoaiSP;
                $response['tenLoaiSP'] = $tenLoaiSP;
                $response['phanTram'] = $phanTram;
                $response['dvtinh'] = $dvtinh;
            } else {
                // Trả về phản hồi lỗi nếu truy vấn thất bại
                $response['success'] = false;
                $response['error'] = 'Không thể cập nhật loại sản phẩm.';
            }

            // Đóng kết nối và truy vấn SQL
            $stmt->close();
        } else {
            // Trả về phản hồi lỗi nếu dữ liệu không hợp lệ
            $response['success'] = false;
            $response['error'] = 'Dữ liệu không hợp lệ.';
        }
    } else {
        // Trả về phản hồi lỗi nếu không phải phương thức POST
        $response['success'] = false;
        $response['error'] = 'Yêu cầu không hợp lệ.';
    }
} catch (Exception $e) {
    // Trả về phản hồi lỗi nếu có ngoại lệ xảy ra
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();

// Trả về phản hồi dưới dạng JSON
echo json_encode($response);
?>
