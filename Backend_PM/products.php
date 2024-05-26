<?php
include '../db_connection.php';

if (isset($mysqli)) {
    $sql = "SELECT id, product_name, price, quantity, total_price FROM products";
    $result = $mysqli->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover table-bordered' align='center'>";
            echo "<thead>
                    <tr>
                      <th scope='col'>#</th>
                      <th scope='col'>Sản phẩm</th>
                      <th scope='col'>Đơn giá</th>
                      <th scope='col'>Số lượng</th>
                      <th scope='col'>Thành tiền</th>
                      <th scope='col'>Thao tác</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['total_price']) . "</td>";
                echo "<td>
                        <button class='btn btn-primary btn-sm' onclick='selectProduct(\"" . htmlspecialchars($row['id']) . "\", \"" . htmlspecialchars($row['product_name']) . "\", \"" . htmlspecialchars($row['price']) . "\", \"" . htmlspecialchars($row['quantity']) . "\", \"" . htmlspecialchars($row['total_price']) . "\")'>Chọn</button>
                    </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p align='center'>No products found</p>";
        }
    } else {
        echo "Error: " . $mysqli->error;
    }
    $mysqli->close();
} else {
    echo "Database connection error.";
}
?>