<?php
include '../Backend_PM/db_connection.php';  

$search_keyword = isset($_POST['search_keyword_ncc']) ? $_POST['search_keyword_ncc'] : '';

$sql = "SELECT * FROM suppliers WHERE MaNCC LIKE ?";
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
              <th scope='col'>Id</th>
              <th scope='col'>Mã nhà cung cấp</th>
              <th scope='col'>Tên nhà cung cấp</th>
              <th scope='col'>Số điện thoại</th>
              <th scope='col'>Địa chỉ</th>
              <th scope='col'>Thao tác</th>
            </tr>
          </thead>";
  echo "<tbody>";
  foreach ($search_results as $row) {
    $id = $row["id"];
    $maNCC = htmlspecialchars($row["MaNCC"]);
    $ten = htmlspecialchars($row["ten"]);
    $diachi = htmlspecialchars($row["diachi"]);
    $sdt = htmlspecialchars($row["sdt"]);
    echo "<tr>";
    echo "<td>" . $id . "</td>";
    echo "<td>" . $maNCC . "</td>";
    echo "<td>" . $ten . "</td>";
    echo "<td>" . $sdt . "</td>";
    echo "<td>" . $diachi . "</td>";
    echo "<td>
        <button class='btn btn-primary btn-sm select-supplier' 
        data-supplier-name='$ten' 
        data-supplier-address='$diachi' 
        data-supplier-phone='$sdt'>Chọn</button>
              </td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
} else {
  echo "<p>No results found</p>";
}
