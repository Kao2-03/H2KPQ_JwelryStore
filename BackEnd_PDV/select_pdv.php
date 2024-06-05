<?php
include '../Backend_PDV/db_connection.php';  

$sql = "SELECT * FROM phieudichvu";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<form action='process_selected_dv.php' method='POST'>";
    echo "<select name='selectdv'>";
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $khachhang = htmlspecialchars($row["KhachHang"]);
        $SDT = htmlspecialchars($row["SDT"]);
        echo "<option value='$id'>$tenKhachHang - $SDT</option>"; // Thêm tùy chọn vào danh sách chọn

    }
    echo "</select>";
    echo "<button type='submit'>Chọn khách hàng</button>";
    echo "</form>";
} else {
    echo "Không có khách hàng nào.";
}
$mysqli->close();
?>
