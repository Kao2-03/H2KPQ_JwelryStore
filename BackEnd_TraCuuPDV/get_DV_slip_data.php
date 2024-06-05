<?php
include '../Backend_TraCuuPDV/db_connection.php';

$sql = "SELECT ct.SoPhieu, p.KhachHang, p.SDT, p.NgayLap, ct.ThanhTien, p.TraTrc, p.ConLai, p.TinhTrang 
        FROM ctphieudv ct
        JOIN loaidv l ON l.ID = ct.LoaiDV
        JOIN phieudichvu p ON p.SoPhieu = ct.SoPhieu";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo "Lỗi SQL: " . $mysqli->error;
    exit;
}

$DVDisplayed = array(); 

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $SoPhieu = htmlspecialchars($row['SoPhieu'], ENT_QUOTES, 'UTF-8');
        $KhachHang = htmlspecialchars($row['KhachHang'], ENT_QUOTES, 'UTF-8');
        $SDT = htmlspecialchars($row['SDT'], ENT_QUOTES, 'UTF-8');
        $NgayLap = htmlspecialchars($row['NgayLap'], ENT_QUOTES, 'UTF-8');
        $ThanhTien = htmlspecialchars($row['ThanhTien'], ENT_QUOTES, 'UTF-8');
        $TraTrc = htmlspecialchars($row['TraTrc'], ENT_QUOTES, 'UTF-8');
        $ConLai = htmlspecialchars($row['ConLai'], ENT_QUOTES, 'UTF-8');
        $TinhTrang = htmlspecialchars($row['TinhTrang'], ENT_QUOTES, 'UTF-8');

        if (!in_array($SoPhieu, $DVDisplayed)) {
            $loaidvSql = "SELECT l.TenLoai, ct.DonGia, ct.SoLuong, ct.ThanhTien 
                          FROM ctphieudv ct 
                          JOIN loaidv l ON ct.LoaiDV = l.ID 
                          WHERE SoPhieu = ?";
            $loaidvStmt = $mysqli->prepare($loaidvSql);
            $loaidvStmt->bind_param("s", $SoPhieu);
            $loaidvStmt->execute();
            $loaidvResult = $loaidvStmt->get_result();

            if (!$loaidvResult) {
                echo "Lỗi SQL khi truy vấn chi tiết loại dịch vụ: " . $mysqli->error;
                exit;
            }

            $DSDV = array(); 

            if ($loaidvResult->num_rows > 0) {
                while ($loaidvRow = $loaidvResult->fetch_assoc()) {
                    $DV = array(
                        'TenLoai' => htmlspecialchars($loaidvRow['TenLoai'], ENT_QUOTES, 'UTF-8'),
                        'DonGia' => htmlspecialchars($loaidvRow['DonGia'], ENT_QUOTES, 'UTF-8'),
                        'SoLuong' => htmlspecialchars($loaidvRow['SoLuong'], ENT_QUOTES, 'UTF-8'),
                        'ThanhTien' => htmlspecialchars($loaidvRow['ThanhTien'], ENT_QUOTES, 'UTF-8')
                    );
                    $DSDV[] = $DV; 
                }
            }

            $DSDVJson = json_encode($DSDV);

            echo '<tr id="purchase-' . $SoPhieu . '">';
            echo '<td>' . $SoPhieu . '</td>';
            echo '<td>' . $KhachHang . '</td>';
            echo '<td>' . $SDT . '</td>';
            echo '<td>' . $NgayLap . '</td>';
            echo '<td>' . $ThanhTien . '</td>';
            echo '<td>' . $TraTrc . '</td>';
            echo '<td>' . $ConLai . '</td>';
            echo '<td>' . $TinhTrang . '</td>';
            echo '<td>
                    <button type="button" class="btn ChiTiet" onclick="showServiceDetails(\'' . $SoPhieu . '\', \'' . $NgayLap . '\', \'' . $KhachHang . '\', \'' . $ThanhTien . '\', \'' . $SDT . '\', \'' . htmlspecialchars($DSDVJson, ENT_QUOTES, 'UTF-8') . '\')">Chi tiết</button>
                    <button type="button" class="btn Xoa" onclick="deletePurchase(\'' . $SoPhieu . '\')">Xóa</button>
                  </td>';
            echo '</tr>';
            $DVDisplayed[] = $SoPhieu;

            $loaidvStmt->close(); // Đóng statement chi tiết loại dịch vụ để giải phóng tài nguyên
        }
    }
} else {
    echo '<tr><td colspan="9">Không có dữ liệu</td></tr>';
}

$stmt->close(); // Đóng statement chính để giải phóng tài nguyên
$mysqli->close();
?>

