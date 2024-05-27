<?php
include 'db_connect.php';

if (isset($mysqli)) {
    $sql = "SELECT ID, TenLoai, DonGia FROM CTPHIEUDV"; 
    $result = $mysqli->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover table-bordered' align='center'>";
            echo "<thead>
                    <tr>
                      <th scope='col'># </th>
                      <th scope='col'Tên loại dịch vụ></th>
                      <th scope='col'>Mã loại dịch vụ</th>
                      <th scope='col'>Đơn giá</th>
                      <th scope='col'>Thao tác</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['LoaiDV']) . "</td>";
                echo "<td>" . htmlspecialchars($row['DonGia']) . "</td>";
                echo "<td>" . htmlspecialchars($row['SoLuong']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ThanhTien']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ConLai']) . "</td>";
                echo "<td>
                        <button class='btn btn-primary btn-sm' onclick='selectDV(\"" . htmlspecialchars($row['id']) . "\", \"" . htmlspecialchars($row['TenLoai']) . "\", \"" . htmlspecialchars($row['DonGia']) . "\", \"" . htmlspecialchars($row['SoLuong']) . "\", \"" . htmlspecialchars($row['ThanhTien']) . "\")'>Chọn</button>
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