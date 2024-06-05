<?php
include "../Form_login/db_conn.php";
$sql = "SELECT MALOAI, TENLOAI, DVTINH, PHANTRAM FROM LOAISP";
$result = mysqli_query($conn, $sql);
$i = 1;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr data-id='".$row['MALOAI']."'>
                <td>".$i."</td>
                <td>".$row['MALOAI']."</td>
                <td>".$row['TENLOAI']."</td>
                <td>".$row['PHANTRAM']."</td>
                <td>".$row['DVTINH']."</td>
                <td>
                <button type='button' class='btn ChiTietLoaiSP' data-id='".$row['MALOAI']."' data-name='".$row['TENLOAI']."' data-dvtinh='".$row['DVTINH']."' data-phantram='".$row['PHANTRAM']."' >Chỉnh sửa</button>
                <button type='button' class='btn Xoa' onclick='xoaLoaiSP(\"".$row['MALOAI']."\")'>Xóa</button>
                </td>
              </tr>";
        $i++;
    }
} else {
    echo "<tr><td colspan='6'>Không tìm thấy loại sản phẩm nào</td></tr>";
}
?>

