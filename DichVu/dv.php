<?php
include 'db_connect.php';

$sql = "SELECT ID, TenLoai, DonGia FROM LOAIDV";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Tên Loại</th>
                <th>Đơn Giá</th>
                <th>Hành Động</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['TenLoai']}</td>
                <td>{$row['DonGia']}</td>
                <td><button onclick='editRecord({$row['ID']})'>Edit</button></td>
                <td><button onclick='deleteRecord({$row['ID']})'>Delete</button></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$mysqli->close();
?>
<!-- Div to hold the edit form -->
<div id="editFormContainer"></div>

<script src="script.js"></script>
