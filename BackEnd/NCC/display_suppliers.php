<?php
// Include the database connection file
include "../Form_login/db_conn.php";

if (isset($conn)) {
    $sql = "SELECT MaNCC, ten, sdt, diachi FROM suppliers"; 
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover table-bordered' align='center'>";
            echo "<thead>
                    <tr>
                      <th scope='col'>#</th>
                      <th scope='col'>Mã nhà cung cấp</th>
                      <th scope='col'>Tên nhà cung cấp</th>
                      <th scope='col'>Số điện thoại</th>
                      <th scope='col'>Địa chỉ</th>
                      <th scope='col'>Thao tác</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            $i = 1; // Khởi tạo biến đếm
            while($row = $result->fetch_assoc()) {
                $maNCC = htmlspecialchars($row["MaNCC"]);
                $ten = htmlspecialchars($row["ten"]);
                $diachi = htmlspecialchars($row["diachi"]);
                $sdt = htmlspecialchars($row["sdt"]);
                echo "<tr>";
                echo "<td>". $i++ ."</td>"; // Sử dụng biến đếm và tăng giá trị sau mỗi lần in
                echo "<td>". $maNCC ."</td>";
                echo "<td>" . $ten . "</td>";
                echo "<td>" . $diachi . "</td>";
                echo "<td>" . $sdt . "</td>";
                echo "<td>
                <button class='btn btn-primary btn-sm' onclick='openEditPopup(\"$maNCC\", \"$ten\", \"$diachi\", \"$sdt\")'>Edit</button>
                <button class='btn btn-primary btn-sm' onclick='deleteSupplier(\"$maNCC\")'>Delete</button>
                    </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p align='center'>Không có nhà cung cấp nào</p>";
        }
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Lỗi kết nối cơ sở dữ liệu.";
}
?>
