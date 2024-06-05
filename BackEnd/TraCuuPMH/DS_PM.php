<?php
include "../Form_login/db_conn.php";

$sql = "SELECT * FROM PHIEUMUA";
$result = mysqli_query($conn, $sql);
$i = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>".$i."</td>
                <td>".$row['SoPhieuMua']."</td>
                <td>".$row['NhaCC']."</td>
                <td>".$row['TongTien']."</td>
                <td>".$row['NgayLap']."</td>
                <td>
                  <button type='button' class='btn ChiTietSanPham' data-id='".$row['SoPhieuMua']."' data-kh='".$row['NhaCC']."' data-tongtien='".$row['TongTien']."' data-ngaylap='".$row['NgayLap']."' >Chi tiết</button>
                  <button type='button' class='btn Xoa' onclick='xoaSP(\"".$row['SoPhieuMua']."\")'>Xóa</button>
                </td>
              </tr>";
        $i++;
    }
} else {
    echo "<tr><td colspan='5'>Không tìm thấy phiếu bán nào</td></tr>";
}

mysqli_close($conn);
?>
