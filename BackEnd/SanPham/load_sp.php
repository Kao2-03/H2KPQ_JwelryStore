<?php
include "../Form_login/db_conn.php";

$sql = "SELECT sp.MASP, sp.TENSP, lsp.TENLOAI as LOAISP, sp.DONGIAMUA, sp.SOLUONGKHO
        FROM SANPHAM sp
        JOIN LOAISP lsp ON sp.LOAISP = lsp.MALOAI";

$result = mysqli_query($conn, $sql);
$i = 1;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr data-id='".$row['MASP']."'>
                <td>".$i."</td>
                <td>".$row['MASP']."</td>
                <td>".$row['TENSP']."</td>
                <td>".$row['LOAISP']."</td>
                <td>".$row['DONGIAMUA']."</td>
                <td>".$row['SOLUONGKHO']."</td>
                <td>
                <button type='button' class='btn ChiTietSanPham' data-id='".$row['MASP']."' data-name='".$row['TENSP']."' data-loaisp='".$row['LOAISP']."' data-gia='".$row['DONGIAMUA']."' data-soluong='".$row['SOLUONGKHO']."'>Chỉnh sửa</button>
                <button type='button' class='btn Xoa' onclick='xoaSP(\"".$row['MASP']."\")'>Xóa</button>
                </td>
              </tr>";
        $i++;
    }
} else {
    echo "<tr><td colspan='7'>Không tìm thấy sản phẩm nào</td></tr>";
}

mysqli_close($conn);
?>
