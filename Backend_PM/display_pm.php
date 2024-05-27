<?php
include '../Backend_PM/db_connection.php';

if (isset($mysqli)) {
    $sql = "SELECT id, MaNCC, ten, sdt, diachi FROM suppliers"; 
    $result = $mysqli->query($sql);

    if ($result) {
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
            echo "<p align='center'>No suppliers found</p>";
        }
    } else {
        echo "Error: " . $mysqli->error;
    }
    $mysqli->close();
} else {
    echo "Database connection error.";
}
?>
