<?php
include "../../Form_login/db_conn.php";

if (isset($_POST['soPhieuMua'])) {
    $soPhieu = $_POST['soPhieuMua'];

    // Truy vấn kết hợp để lấy thông tin chi tiết sản phẩm của phiếu bán
    $sql = "SELECT ct.SoLuong, sp.TenSP, sp.DonGiaMua, ct.SoLuong, ct.ThanhTien 
            FROM ctphieumua ct
            INNER JOIN sanpham sp ON ct.SanPham = sp.MaSP
            WHERE ct.SoPhieuMua = '$soPhieuMua'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>".$row['SoLuong']."</td>
                    <td>".$row['TenSP']."</td>
                    <td>".$row['DonGiaMua']."</td>
                    <td>".$row['SoLuong']."</td>
                    <td>".$row['ThanhTien']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Không có sản phẩm trong phiếu bán này</td></tr>";
    }

    mysqli_close($conn);
}
?>
