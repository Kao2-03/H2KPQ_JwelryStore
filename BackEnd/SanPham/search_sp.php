<?php
header('Content-Type: text/html; charset=utf-8');
include "../../Form_login/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'];

    // Prepare the SQL statement with a LIKE clause for searching
    $stmt = $conn->prepare("SELECT sp.MASP, sp.TENSP, lsp.TENLOAI as LOAISP, sp.DONGIAMUA, sp.SOLUONGKHO
                            FROM SANPHAM sp
                            JOIN LOAISP lsp ON sp.LOAISP = lsp.MALOAI
                            WHERE sp.TENSP LIKE CONCAT('%', ?, '%') OR lsp.TENLOAI LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param('ss', $search, $search);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
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

    $stmt->close();
    $conn->close();
} else {
    echo "<tr><td colspan='7'>Yêu cầu không hợp lệ</td></tr>";
}
?>
