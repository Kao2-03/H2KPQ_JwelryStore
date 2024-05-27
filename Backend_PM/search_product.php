<?php
include '../Backend_PM/db_connection.php';

if (isset($mysqli)) {

    $search_keyword = isset($_POST['search_keyword_product']) ? $_POST['search_keyword_product'] : '';
    $sql = "SELECT id, product_name, price, quantity, total_price 
            FROM products 
            WHERE product_name LIKE ?";
    
    $stmt = $mysqli->prepare($sql);
    $search_keyword_param = "%" . $search_keyword . "%";
    $stmt->bind_param("s", $search_keyword_param);
    $stmt->execute();
    $result = $stmt->get_result();
    $search_results = [];

    while ($row = $result->fetch_assoc()) {
        $search_results[] = $row;
    }

    if (count($search_results) > 0) {
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
        foreach ($search_results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            echo "<td>" . htmlspecialchars($row['total_price']) . "</td>";
            echo "<td>
                    <button class='btn btn-primary btn-sm center' onclick='selectProduct(\"" . htmlspecialchars($row['id']) . "\", \"" . htmlspecialchars($row['product_name']) . "\", \"" . htmlspecialchars($row['price']) . "\", \"" . htmlspecialchars($row['quantity']) . "\", \"" . htmlspecialchars($row['total_price']) . "\")'>Chọn</button>
                  </td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p align='center'>Không tìm thấy sản phẩm</p>";
    }
    $stmt->close();
    $mysqli->close();
} else {
    echo "Lỗi kết nối cơ sở dữ liệu.";
}
?>
