<?php
include "../Form_login/db_conn.php";

if (isset($conn)) {
    $sql = "SELECT MaNCC, ten, sdt, diachi FROM suppliers"; 
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $i =1;
            $maNCC = htmlspecialchars($row["MaNCC"]);
            $ten = htmlspecialchars($row["ten"]);
            $diachi = htmlspecialchars($row["diachi"]);
            $sdt = htmlspecialchars($row["sdt"]);
            echo "<tr>";
            echo "<td>" . $i . "</td>";
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
            $i++;
        }
    } else {
        echo "<tr><td colspan='6' align='center'>Không tìm thấy nhà cung cấp</td></tr>";
    }
 } else {
    echo "Database connection error.";
}
?>
