<?php
include "../../Form_login/db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['soPhieuMua'])) {
    $soPhieuMua = $_POST['soPhieuMua'];

    // Xóa các dòng liên quan từ bảng ctphieumua
    $sqlDeleteCT = "DELETE FROM ctphieumua WHERE SOPHIEUMUA = '$soPhieuMua'";
    if ($conn->query($sqlDeleteCT) === TRUE) {
        // Sau khi xóa ctphieumua, xóa phiếu mua từ bảng phieumua
        $sqlDeletePM = "DELETE FROM phieumua WHERE SoPhieuMua = '$soPhieuMua'";
        if ($conn->query($sqlDeletePM) === TRUE) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "error" => "Lỗi khi xóa phiếu mua: " . $conn->error));
        }
    } else {
        echo json_encode(array("success" => false, "error" => "Lỗi khi xóa chi tiết phiếu mua: " . $conn->error));
    }
} else {
    echo json_encode(array("success" => false, "error" => "Yêu cầu không hợp lệ."));
}

$conn->close();
?>
