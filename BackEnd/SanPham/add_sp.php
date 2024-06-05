<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    // Nhận dữ liệu gửi từ AJAX
    $data = json_decode(file_get_contents('php://input'), true);
    error_log("Dữ liệu nhận được: " . print_r($data, true)); // Ghi nhật ký dữ liệu nhận được

    if (isset($data['tenSP'], $data['loaiSP'], $data['gia'], $data['soluong'])) {
        $tenSP = $data['tenSP'];
        $loaiSP = $data['loaiSP'];
        $gia = $data['gia'];
        $soluong = $data['soluong'];

        // Lấy mã sản phẩm lớn nhất hiện tại
        $result = $conn->query("SELECT MAX(MASP) AS max_masp FROM SANPHAM");
        if ($result) {
            $row = $result->fetch_assoc();
            $max_masp = $row['max_masp'];

            if ($max_masp) {
                $new_masp = 'SP' . str_pad((int)substr($max_masp, 2) + 1, 2, '0', STR_PAD_LEFT);
            } else {
                $new_masp = 'SP01';
            }

            // Ghi nhật ký mã sản phẩm mới
            error_log("Mã sản phẩm mới: " . $new_masp);

            // Chuẩn bị câu truy vấn SQL để thêm sản phẩm mới
            $stmt = $conn->prepare("INSERT INTO SANPHAM (MASP, TENSP, LOAISP, DONGIAMUA, SOLUONGKHO) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssii", $new_masp, $tenSP, $loaiSP, $gia, $soluong);

            // Thực thi câu truy vấn
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['masp'] = $new_masp;
                $response['tenSP'] = $tenSP;
                $response['loaiSP'] = $loaiSP;
                $response['gia'] = $gia;
                $response['soluong'] = $soluong;
            } else {
                $response['success'] = false;
                $response['error'] = 'Không thể thêm sản phẩm.';
            }

            $stmt->close();
        } else {
            $response['success'] = false;
            $response['error'] = 'Lỗi truy vấn cơ sở dữ liệu.';
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Thông tin sản phẩm không hợp lệ.';
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

$conn->close();
error_log("Phản hồi: " . print_r($response, true)); // Ghi nhật ký phản hồi
echo json_encode($response);
?>
