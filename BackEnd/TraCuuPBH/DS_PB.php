<?php
include "../Form_login/db_conn.php";

$sql = "SELECT * FROM PHIEUBAN";
$result = mysqli_query($conn, $sql);
$i = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>".$i."</td>
                <td>".$row['SoPhieu']."</td>
                <td>".$row['KhachHang']."</td>
                <td>".$row['TongTien']."</td>
                <td>".$row['NgayLap']."</td>
                <td>
                  <button type='button' class='btn ChiTietSanPham' data-id='".$row['SoPhieu']."' data-kh='".$row['KhachHang']."' data-tongtien='".$row['TongTien']."' data-ngaylap='".$row['NgayLap']."' >Chi tiết</button>
                  <button type='button' class='btn Xoa' onclick='xoaSP(\"".$row['SoPhieu']."\")'>Xóa</button>
                </td>
              </tr>";
        $i++;
    }
} else {
    echo "<tr><td colspan='5'>Không tìm thấy phiếu bán nào</td></tr>";
}

mysqli_close($conn);
?>
