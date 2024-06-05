<?php
include "../../Form_login/db_conn.php";

$sql = "SELECT TENDV FROM DONVI";
$result = mysqli_query($conn, $sql);
$donViTinhs = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $donViTinhs[] = $row['TENDV'];
    }
}

// Logging dữ liệu để kiểm tra
error_log("Danh sách đơn vị tính: " . print_r($donViTinhs, true));

header('Content-Type: application/json');
echo json_encode($donViTinhs);

mysqli_close($conn);
?>
