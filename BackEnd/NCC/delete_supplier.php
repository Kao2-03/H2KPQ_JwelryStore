<?php
include "../../Form_login/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ trường POST
    $MaNCC = isset($_POST['id']) ? $_POST['id'] : '';

    if ($MaNCC) {
        $sql = "DELETE FROM suppliers WHERE MaNCC = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $MaNCC);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
            header("Location: ../../Frontend/nhaCungCap.php");
        } else {
            echo json_encode(["success" => false, "error" => "Không thể xóa nhà cung cấp."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Mã nhà cung cấp không hợp lệ."]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "error" => "Yêu cầu không hợp lệ."]);
}
?>
