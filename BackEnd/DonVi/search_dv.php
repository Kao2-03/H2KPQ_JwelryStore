<?php
include "../../Form_login/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $searchValue = $_POST['search'];

    // Truy vấn SQL tìm kiếm
    $sql = "SELECT MADV, TENDV FROM DONVI WHERE TENDV LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $searchValue . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$i."</td>
                    <td>".$row['MADV']."</td>
                    <td>".$row['TENDV']."</td>
                    <td>
                        <button type='button' class='btn ChiTiet' data-bs-toggle='button' data-id='".$row['MADV']."' data-name='".$row['TENDV']."' onclick='togglePopupSuaDV(\"".$row['MADV']."\", \"".$row['TENDV']."\")'>Chỉnh sửa</button>
                        <button type='button' class='btn Xoa' data-bs-toggle='button' onclick='xoaDV(\"".$row['MADV']."\")'>Xóa</button>
                    </td>
                  </tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='4'>Không tìm thấy đơn vị nào</td></tr>";
    }

    $stmt->close();
    $conn->close();
}
?>
