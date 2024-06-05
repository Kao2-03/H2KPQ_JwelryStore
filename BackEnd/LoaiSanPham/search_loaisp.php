<?php
include "../../Form_login/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $searchValue = $_POST['search'];

    $sql = "SELECT MALOAI, TENLOAI, PHANTRAM, DVTINH FROM LOAISP WHERE TENLOAI LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $searchValue . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr data-id='".$row['MALOAI']."'>
                    <td>".$i."</td>
                    <td>".$row['MALOAI']."</td>
                    <td>".$row['TENLOAI']."</td>
                    <td>".$row['PHANTRAM']."</td>
                    <td>".$row['DVTINH']."</td>
                    <td>
                        <button type='button' class='btn ChiTiet' data-id='".$row['MALOAI']."' data-name='".$row['TENLOAI']."' data-phantram='".$row['PHANTRAM']."' data-dvtinh='".$row['DVTINH']."'>Chỉnh sửa</button>
                        <button type='button' class='btn Xoa' onclick='xoaLoaiSP(\"".$row['MALOAI']."\")'>Xóa</button>
                    </td>
                  </tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='6'>Không tìm thấy loại sản phẩm nào</td></tr>";
    }

    $stmt->close();
    $conn->close();
}
?>
