<?php
include "../Form_login/db_conn.php";
$sql = "SELECT MADV, TENDV FROM DONVI";
$result = mysqli_query($conn, $sql);
$i = 1;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr data-id='".$row['MADV']."'>
                <td>".$i."</td>
                <td>".$row['MADV']."</td>
                <td>".$row['TENDV']."</td>
                <td>
                <button type='button' class='btn ChiTietDonVi' data-id='".$row['MADV']."' data-name='".$row['TENDV']."'>Chỉnh sửa</button>
                <button type='button' class='btn Xoa' onclick='xoaDV(\"".$row['MADV']."\")'>Xóa</button>
                </td>
              </tr>";
        $i++;
    }
} else {
    echo "<tr><td colspan='4'>Không tìm thấy đơn vị nào</td></tr>";
}
?>
