<?php
include 'db_connection.php';

$sql = "SELECT ID, TenLoai, DonGia FROM loaidv"; 
$result = $mysqli->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        echo "<table class='table table-hover table-bordered' align='center'>";
        echo "<thead>
                <tr>
                  <th scope='col'>ID</th>
                  <th scope='col'>Tên loại dịch vụ</th>
                  <th scope='col'>Đơn giá</th>
                  <th scope='col'>Thao tác</th>
                </tr>
              </thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            $ID = htmlspecialchars($row["ID"]);
            $TenLoai = htmlspecialchars($row["TenLoai"]);
            $DonGia = htmlspecialchars($row["DonGia"]);
            echo "<tr>";
            echo "<td>". $ID ."</td>";
            echo "<td>" . $TenLoai . "</td>";
            echo "<td>" . $DonGia . "</td>";
            echo "<td>
                    <button class='btn btn-primary btn-sm' onclick='openEditPopup(\"$ID\", \"$TenLoai\", \"$DonGia\")'>Edit</button>
                    <button class='btn btn-primary btn-sm' onclick='deleteloaidv(\"$ID\")'>Delete</button>
                  </td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No service found</p>";
    }
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();
?>
