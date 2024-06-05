<?php
include "../Form_login/db_conn.php";

// Lấy danh sách sản phẩm từ CSDL
$sql = "SELECT MaSP, TenSP, DonGiaMua, SoLuongKho FROM sanpham";
$result = mysqli_query($conn, $sql);
$i = 1;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr data-id='".$row['MaSP']."'>
                <td>".$i."</td>
                <td>".$row['TenSP']."</td>
                <td class='don-gia'>".$row['DonGiaMua']."</td>
                <td>
                    <input type='number' class='form-control quantity-input' value='1' min='1' max='".$row['SoLuongKho']."' onchange='updateTotal(this)'>
                </td>
                <td class='thanh-tien'>".($row['DonGiaMua'])."</td>
                <td>
                    <button type='button' class='btn btn-primary add-to-cart-btn' data-id='".$row['MaSP']."' data-name='".$row['TenSP']."' data-price='".$row['DonGiaMua']."'>Thêm vào giỏ</button>
                </td>
              </tr>";
        $i++;
    }
} else {
    echo "<tr><td colspan='6' align='center'>Không tìm thấy sản phẩm</td></tr>";
}
?>
