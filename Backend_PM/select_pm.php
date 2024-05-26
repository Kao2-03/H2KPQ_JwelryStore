<?php
include '../db_connection.php';  

$sql = "SELECT * FROM suppliers";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<form action='process_selected_supplier.php' method='POST'>";
    echo "<select name='selected_supplier'>";
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $maNCC = htmlspecialchars($row["MaNCC"]);
        $ten = htmlspecialchars($row["ten"]);
        echo "<option value='$id'>$ten - $maNCC</option>";
    }
    echo "</select>";
    echo "<button type='submit'>Chọn nhà cung cấp</button>";
    echo "</form>";
} else {
    echo "Không có nhà cung cấp nào.";
}
$mysqli->close();
?>
