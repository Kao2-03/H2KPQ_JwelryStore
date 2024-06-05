<?php
include "../../Form_login/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $searchValue = $_POST['search'];

    $sql = "SELECT MaSP, TenSP, DonGiaMua, SoLuongKho FROM sanpham WHERE TenSP LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $searchValue . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr data-id='".$row['MaSP']."'>
                    <td>".$i."</td>
                    <td>".$row['TenSP']."</td>
                    <td class='don-gia'>".$row['DonGiaMua']."</td>
                    <td>
                        <input type='number' class='form-control quantity-input' value='1' min='1' max='".$row['SoLuongKho']."' onchange='updateTotal(this)'>
                    </td>
                    <td class='thanh-tien'>".$row['DonGiaMua']."</td>
                    <td>
                        <button type='button' class='btn btn-primary add-to-cart-btn' data-id='".$row['MaSP']."' data-name='".$row['TenSP']."' data-price='".$row['DonGiaMua']."'>Thêm vào giỏ</button>
                    </td>
                  </tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='6' align='center'>Không tìm thấy sản phẩm</td></tr>";
    }

    $stmt->close();
    $conn->close();
}
?>
