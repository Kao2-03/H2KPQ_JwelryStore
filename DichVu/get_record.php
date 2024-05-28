<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Truy vấn thông tin bản ghi dựa trên ID
    $sql = "SELECT ID, TenLoai, DonGia FROM LOAIDV WHERE ID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        echo '<form id="editForm" onsubmit="event.preventDefault(); updateRecord();">
                <input type="hidden" id="editID" value="' . $row['ID'] . '">
                <label for="editTenLoai">Tên Loại:</label>
                <input type="text" id="editTenLoai" value="' . $row['TenLoai'] . '" required>
                <br>
                <label for="editDonGia">Đơn Giá:</label>
                <input type="text" id="editDonGia" value="' . $row['DonGia'] . '" required>
                <br>
                <input type="submit" value="Update">
              </form>';
    } else {
        echo "Record not found";
    }
    
    $stmt->close();
    $mysqli->close();
} else {
    echo "Invalid ID";
}
?>
