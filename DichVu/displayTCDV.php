<?php
// Include the database connection file
include 'db_connection.php';

// Check if the $mysqli variable is set
if (isset($mysqli)) {
    $sql = "SELECT SoPhieu, KhachHang, SDT, NgayLap, TongTien, TraTrc, ConLai, TinhTrang FROM phieudichvu"; // Adjust table and column names as per your database structure
    $result = $mysqli->query($sql);

    // Check if the query was successful
    if ($result) {
        // Check if there are results
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover table-bordered' align='center'>";
            echo "<thead>
                    <tr>
                      <th scope='col'># </th>
                      <th scope='col'>Mã phiếu</th>
                      <th scope='col'>Khách hàng</th>
                      <th scope='col'>Số điện thoại</th>
                      <th scope='col'>Ngày lập</th>
                      <th scope='col'>Tổng</th>
                      <th scope='col'>Tổng trả trước</th>
                      <th scope='col'>Tổng còn lại</th>
                      <th scope='col'>Tình trạng</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            //
            while($row = $result->fetch_assoc()) {
                $id = $row["SoPhieu"];
                $MaPhieu = $row['SoPhieu'];
                $KhachHang = htmlspecialchars($row["KhachHang"]);
                $sdt = htmlspecialchars($row["SDT"]);
                $ngaylap = htmlspecialchars($row["NgayLap"]);
                $Tong = htmlspecialchars($row["TongTien"]);
                $Tongtratruoc = htmlspecialchars($row["TraTrc"]);
                $Tongconlai = htmlspecialchars($row["ConLai"]);
                $Tinhtrang = htmlspecialchars($row["TinhTrang"]);
                echo "<tr>";
                echo "<td>" . $id . "</td>";
                echo "<td>". $MaPhieu ."</td>";
                echo "<td>" . $KhachHang . "</td>";
                echo "<td>" . $sdt. "</td>";
                echo "<td>" . $ngaylap . "</td>";
                echo "<td>". $Tong ."</td>";
                echo "<td>" . $Tongtratruoc . "</td>";
                echo "<td>" . $Tongconlai. "</td>";
                echo "<td>" . $Tinhtrang. "</td>";
                echo "<td>
                        <button class='btn btn-primary btn-sm' onclick='openEditPopup(\"$MaPhieu\", \"$KhachHang\", \"$sdt\")'>Chỉnh sửa</button>
                        <button class='btn btn-primary btn-sm' onclick='deleteService(\"$MaPhieu\")'>Xóa</button>
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

    // Close the database connection
    $mysqli->close();
} else {
    echo "Database connection error.";
}
?>
