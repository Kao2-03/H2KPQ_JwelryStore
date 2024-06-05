<?php
include "../../Form_login/db_conn.php";

$search_keyword = isset($_POST['search_keyword']) ? $_POST['search_keyword'] : '';

$sql = "SELECT * FROM suppliers WHERE MaNCC LIKE ? OR ten LIKE ? OR sdt LIKE ? OR diachi LIKE ?";
$stmt = $conn->prepare($sql);
$search_keyword_param = "%" . $search_keyword . "%";
$stmt->bind_param("ssss", $search_keyword_param, $search_keyword_param, $search_keyword_param, $search_keyword_param);
$stmt->execute();
$result = $stmt->get_result();

$search_results = [];
while ($row = $result->fetch_assoc()) {
    $search_results[] = $row;
}

$stmt->close();
$conn->close();

if (count($search_results) > 0) {
    echo "<table class='table table-hover table-bordered' align='center'>";
    echo "<thead>
            <tr>
              <th scope='col'>Mã nhà cung cấp</th>
              <th scope='col'>Tên nhà cung cấp</th>
              <th scope='col'>Số điện thoại</th>
              <th scope='col'>Địa chỉ</th>
              <th scope='col'>Thao tác</th>
            </tr>
          </thead>";
    echo "<tbody>";
    foreach ($search_results as $row) {
        $maNCC = htmlspecialchars($row["MaNCC"]);
        $ten = htmlspecialchars($row["ten"]);
        $diachi = htmlspecialchars($row["diachi"]);
        $sdt = htmlspecialchars($row["sdt"]);
        echo "<tr>";
        echo "<td>". $maNCC ."</td>";
        echo "<td>" . $ten . "</td>";
        echo "<td>" . $sdt . "</td>";
        echo "<td>" . $diachi . "</td>";
        echo "<td>
                <button class='btn btn-primary btn-sm' onclick='openEditPopup(\"$maNCC\", \"$ten\", \"$diachi\", \"$sdt\")'>Edit</button>
                <button class='btn btn-primary btn-sm' onclick='deleteSupplier(\"$maNCC\")'>Delete</button>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No results found</p>";
}
?>
