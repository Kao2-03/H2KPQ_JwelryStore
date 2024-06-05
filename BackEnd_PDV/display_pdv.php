<?php
include '../Backend_PDV/db_connection.php';

if (isset($mysqli)) {
    $sql = "SELECT SoPhieu, LoaiDV, DonGia, SoLuong, ThanhTien, ConLai FROM ctphieudv"; 
    $result = $mysqli->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            ?>
            <table class='table table-hover table-bordered' align='center'>
                <thead>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Mã loại dịch vụ</th>
                        <th scope='col'>Đơn giá</th>
                        <th scope='col'>Số lượng</th>
                        <th scope='col'>Thành tiền</th>
                        <th scope='col'>Còn lại</th>
                        <th scope='col'>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                $ID = htmlspecialchars($row["SoPhieu"]);
                $LoaiDV = htmlspecialchars($row["LoaiDV"]);
                $DonGia = htmlspecialchars($row["DonGia"]);
                $SoLuong = htmlspecialchars($row["SoLuong"]);
                $ThanhTien = htmlspecialchars($row["ThanhTien"]);
                $ConLai = htmlspecialchars($row["ConLai"]);

                ?>
                <tr>
                    <td><?= $ID ?></td>
                    <td><?= $LoaiDV ?></td>
                    <td><?= $DonGia ?></td>
                    <td><?= $SoLuong ?></td>
                    <td><?= $ThanhTien ?></td>
                    <td><?= $ConLai ?></td>
                    <td>
                        <button class='btn btn-primary btn-sm select-dv' 
                            data-dv-name='<?= $LoaiDV ?>' 
                            data-dv-price='<?= $DonGia ?>'>Chọn</button>
                    </td>
                </tr>
                <?php
            }
            ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<p align='center'>Không tìm thấy dịch vụ</p>";
        }
    } else {
        echo "Lỗi: " . $mysqli->error;
    }
    $mysqli->close();
} else {
    echo "Lỗi kết nối cơ sở dữ liệu.";
}
?>
