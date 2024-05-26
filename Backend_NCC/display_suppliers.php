<?php
// Include the database connection file
include 'db_connection.php';

// Check if the $mysqli variable is set
if (isset($mysqli)) {
    // SQL query to fetch supplier data
    $sql = "SELECT id, MaNCC, ten, sdt, diachi FROM suppliers"; // Adjust table and column names as per your database structure
    $result = $mysqli->query($sql);

    // Check if the query was successful
    if ($result) {
        // Check if there are results
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover table-bordered' align='center'>";
            echo "<thead>
                    <tr>
                      <th scope='col'># </th>
                      <th scope='col'>Mã nhà cung cấp</th>
                      <th scope='col'>Tên nhà cung cấp</th>
                      <th scope='col'>Số điện thoại</th>
                      <th scope='col'>Địa chỉ</th>
                      <th scope='col'>Thao tác</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            // Loop through the result set and generate table rows
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $maNCC = htmlspecialchars($row["MaNCC"]);
                $ten = htmlspecialchars($row["ten"]);
                $diachi = htmlspecialchars($row["diachi"]);
                $sdt = htmlspecialchars($row["sdt"]);
                echo "<tr>";
                echo "<td>" . $id . "</td>";
                echo "<td>". $maNCC ."</td>";
                echo "<td>" . $ten . "</td>";
                echo "<td>" . $diachi . "</td>";
                echo "<td>" . $sdt . "</td>";
                echo "<td>
                        <button class='btn btn-primary btn-sm' onclick='openEditPopup(\"$id\", \"$maNCC\", \"$ten\", \"$diachi\", \"$sdt\")'>Chỉnh sửa</button>
                        <button class='btn btn-primary btn-sm' onclick='deleteSupplier(\"$id\")'>Xóa</button>
                    </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p align='center'>No suppliers found</p>";
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
