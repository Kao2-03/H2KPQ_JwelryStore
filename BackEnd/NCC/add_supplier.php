<?php
header('Content-Type: application/json');
include "../../Form_login/db_conn.php";

$response = array();

try {
    // Nhận dữ liệu gửi từ AJAX
    $maNCC = $_POST['MaNCC'];
    $tenNCC = $_POST['Ten'];
    $diachiNCC = $_POST['Diachi'];
    $sdtNCC = $_POST['SDT'];

    // Kiểm tra xem mã nhà cung cấp đã tồn tại chưa
    $check_query = "SELECT * FROM SUPPLIERS WHERE MaNCC = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $maNCC);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $response['success'] = false;
        $response['error'] = 'Mã nhà cung cấp đã tồn tại.';
    } else {
        // Chuẩn bị câu truy vấn SQL để thêm nhà cung cấp mới
        $stmt = $conn->prepare("INSERT INTO SUPPLIERS (MaNCC, Ten, DiaChi, SDT) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $maNCC, $tenNCC, $diachiNCC, $sdtNCC);

        // Thực thi câu truy vấn
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['mancc'] = $maNCC;
            $response['tenNCC'] = $tenNCC;
            $response['diachiNCC'] = $diachiNCC;
            $response['sdtNCC'] = $sdtNCC;
            header("Location: ../../Frontend/nhaCungCap.php");
        } else {
            $response['success'] = false;
            $response['error'] = 'Không thể thêm nhà cung cấp.';
        }

        $stmt->close();
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

$conn->close();
echo json_encode($response);
?>
