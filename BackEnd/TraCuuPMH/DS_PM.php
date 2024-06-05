<?php
include "../Form_login/db_conn.php";

$sql = "SELECT pm.SoPhieuMua, ncc.ten AS TenNCC, ncc.diaChi AS DiaChiNCC, ncc.sdt AS SoDienThoaiNCC, pm.TongTien, pm.NgayLap 
        FROM PHIEUMUA pm
        INNER JOIN SUPPLIERS ncc ON pm.NHACC = ncc.MaNCC";


$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>".$row['SoPhieuMua']."</td>
                <td>".$row['TenNCC']."</td>
                <td>".$row['TongTien']."</td>
                <td>".$row['NgayLap']."</td>
                <td>
                  <button type='button' class='btn ChiTietSanPham' data-id='".$row['SoPhieuMua']."' data-ncc='".$row['TenNCC']."' data-tongtien='".$row['TongTien']."' data-ngaylap='".$row['NgayLap']."' data-diaChi='".$row['DiaChiNCC']."' data-sdt='".$row['SoDienThoaiNCC']."'>Chi tiết</button>
                  <button type='button' class='btn Xoa' onclick='xoaSP(\"".$row['SoPhieuMua']."\")'>Xóa</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>Không tìm thấy phiếu mua nào</td></tr>";
}

mysqli_close($conn);

?>
