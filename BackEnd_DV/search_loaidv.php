<?php
include 'db_connection.php';

$search_keyword = isset($_POST['search_keyword']) ? $_POST['search_keyword'] : '';

$sql = "SELECT * FROM loaidv WHERE TenLoai LIKE ?";
$stmt = $mysqli->prepare($sql);
$search_keyword_param = "%" . $search_keyword . "%";
$stmt->bind_param("s", $search_keyword_param);
$stmt->execute();
$result = $stmt->get_result();

$search_results = [];
while ($row = $result->fetch_assoc()) {
    $search_results[] = $row;
}

$stmt->close();
$mysqli->close();

if (count($search_results) > 0) {
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
    foreach ($search_results as $row) {
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
    echo "<p>No results found</p>";
}
?>
