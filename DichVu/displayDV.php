<?php
// Include the database connection file
include 'db_connection.php';

// Check if the $mysqli variable is set
if (isset($mysqli)) {
    $sql = "SELECT ID, TenLoai, DonGia FROM Loaidv"; // Adjust table and column names as per your database structure
    $result = $mysqli->query($sql);

    // Check if the query was successful
    if ($result) {
        // Check if there are results
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover table-bordered' align='center'>";
            echo "<thead>
                    <tr>
                      <th scope='col'># </th>
                      <th scope='col'>Tên loại dịch vụ</th>
                      <th scope='col'>Mã loại dịch vụ</th>
                      <th scope='col'>Đơn giá</th>
                      <th scope='col'>Thao tác</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            // Loop through the result set and generate table rows
            while($row = $result->fetch_assoc()) {
                $id = $row["ID"];
                $tenDV = htmlspecialchars($row["TenLoai"]);
                $maLoaiDV = htmlspecialchars($row["ID"]);
                $gia = htmlspecialchars($row["DonGia"]);
                echo "<tr>";
                echo "<td>" . $id . "</td>";
                echo "<td>". $tenDV ."</td>";
                echo "<td>" . $maLoaiDV . "</td>";
                echo "<td>" . $gia. "</td>";
                echo "<td>
                        <button class='btn btn-primary btn-sm' onclick='openEditPopup(\"$id\", \"$tenDV\", \"$maLoaiDV\", \"$gia\")'>Chỉnh sửa</button>
                        <button class='btn btn-primary btn-sm' onclick='deleteService(\"$id\")'>Xóa</button>
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
