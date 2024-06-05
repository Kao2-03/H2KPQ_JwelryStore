<?php
include "../../Form_login/db_conn.php";

// Kiểm tra xem có tham số soPhieu được gửi từ AJAX hay không
if(isset($_POST['soPhieu'])) {
    $soPhieu = $_POST['soPhieu'];
    
    // Xóa các chi tiết phiếu bán từ bảng CTPHIEUBAN
    $sql_delete_ct = "DELETE FROM CTPHIEUBAN WHERE SoPhieu = '$soPhieu'";
    if(mysqli_query($conn, $sql_delete_ct)) {
        // Xóa phiếu bán từ bảng PHIEUBAN
        $sql_delete_pb = "DELETE FROM PHIEUBAN WHERE SoPhieu = '$soPhieu'";
        if(mysqli_query($conn, $sql_delete_pb)) {
            // Cập nhật số lượng trong bảng SANPHAM (nếu cần)
            // Ví dụ: Giả sử cập nhật số lượng khi xóa phiếu bán là không cần thiết

            echo "Xóa phiếu bán thành công";
        } else {
            echo "Lỗi khi xóa phiếu bán: " . mysqli_error($conn);
        }
    } else {
        echo "Lỗi khi xóa chi tiết phiếu bán: " . mysqli_error($conn);
    }
} else {
    echo "Không có số phiếu được gửi";
}

mysqli_close($conn);
?>
