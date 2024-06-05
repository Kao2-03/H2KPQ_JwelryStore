<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    // Nhận dữ liệu gửi từ AJAX
    $data = json_decode(file_get_contents('php://input'), true);
    error_log("Dữ liệu nhận được: " . print_r($data, true)); // Ghi nhật ký dữ liệu nhận được

    if (isset($data['tenLoaiSP'], $data['phanTram'], $data['dvtinh'])) {
        $tenLoaiSP = $data['tenLoaiSP'];
        $phanTram = $data['phanTram'];
        $dvtinh = $data['dvtinh'];

        // Lấy mã loại sản phẩm lớn nhất hiện tại
        $result = $conn->query("SELECT MAX(MaLoai) AS max_maloai FROM loaisp");
        if ($result) {
            $row = $result->fetch_assoc();
            $max_maloai = $row['max_maloai'];

            if ($max_maloai) {
                $new_maloai = 'LSP' . str_pad((int)substr($max_maloai, 3) + 1, 2, '0', STR_PAD_LEFT);
            } else {
                $new_maloai = 'LSP01';
            }

            // Ghi nhật ký mã loại sản phẩm mới
            error_log("Mã loại sản phẩm mới: " . $new_maloai);

            // Chuẩn bị câu truy vấn SQL để thêm loại sản phẩm mới
            $stmt = $conn->prepare("INSERT INTO loaisp (MaLoai, TenLoai, DVTinh, PhanTram) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssd", $new_maloai, $tenLoaiSP, $dvtinh, $phanTram);

            // Thực thi câu truy vấn
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['maLoaiSP'] = $new_maloai;
                $response['tenLoaiSP'] = $tenLoaiSP;
                $response['phanTram'] = $phanTram;
                $response['dvtinh'] = $dvtinh;
            } else {
                $response['success'] = false;
                $response['error'] = 'Không thể thêm loại sản phẩm.';
            }

            $stmt->close();
        } else {
            $response['success'] = false;
            $response['error'] = 'Lỗi truy vấn cơ sở dữ liệu.';
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Thông tin loại sản phẩm không hợp lệ.';
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

$conn->close();
error_log("Phản hồi: " . print_r($response, true)); // Ghi nhật ký phản hồi
echo json_encode($response);
?>
