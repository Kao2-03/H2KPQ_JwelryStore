<?php
include "../../Form_login/db_conn.php";

$search_keyword = isset($_POST['search_keyword_ncc']) ? $_POST['search_keyword_ncc'] : '';

$sql = "SELECT * FROM suppliers WHERE MaNCC LIKE ? OR ten LIKE ? OR diachi LIKE ? OR sdt LIKE ?";
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
  foreach ($search_results as $row) {
    $i=1;
    $maNCC = htmlspecialchars($row["MaNCC"]);
    $ten = htmlspecialchars($row["ten"]);
    $diachi = htmlspecialchars($row["diachi"]);
    $sdt = htmlspecialchars($row["sdt"]);
    echo "<tr>";
    echo "<td>" . $i . "</td>";
    echo "<td>" . $maNCC . "</td>";
    echo "<td>" . $ten . "</td>";
    echo "<td>" . $diachi . "</td>";
    echo "<td>" . $sdt . "</td>";
    echo "<td>
        <button class='btn btn-primary btn-sm select-supplier' 
        data-supplier-name='$ten' 
        data-supplier-address='$diachi' 
        data-supplier-phone='$sdt'>Chọn</button>
          </td>";
    echo "</tr>";
    $i++;
  }
} else {
  echo "<tr><td colspan='6'>Không tìm thấy kết quả</td></tr>";
}
?>
