<?php
include 'db_connection.php';

if (isset($mysqli)) {
    $sql = "SELECT ID, TenLoai, DonGia FROM loaidv";
    $result = $mysqli->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover table-bordered' align='center'>";
            echo "<thead>
                    <tr>
                      <th scope='col'>#</th>
                      <th scope='col'>Tên loại dịch vụ</th>
                      <th scope='col'>Mã loại dịch vụ</th>
                      <th scope='col'>Đơn giá</th>
                      <th scope='col'>Thao tác</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            $index = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $index++ . "</td>";
                echo "<td>" . htmlspecialchars($row['TenLoai']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['DonGia']) . "</td>";
                echo "<td>
                        <button class='btn btn-primary btn-sm' onclick='selectdv(\"" . htmlspecialchars($row['ID']) . "\", \"" . htmlspecialchars($row['TenLoai']) . "\", \"" . htmlspecialchars($row['DonGia']) . "\")'>Chọn</button>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p align='center'>No service found</p>";
        }
    } else {
        echo "Error: " . $mysqli->error;
    }
    $mysqli->close();
} else {
    echo "Database connection error.";
}
?>
