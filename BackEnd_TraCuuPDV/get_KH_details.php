<?php
include '../Backend_PDV/db_connection.php'; // Include file kết nối

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $SoPhieu = htmlspecialchars($_GET['id']);

        $stmt = $mysqli->prepare("
            SELECT p.SoPhieu, p.NgayLap, p.TongTien, p.KhachHang, p.SDT, l.TenLoai, l.DonGia, p.TraTrc, p.Conlai
            FROM ctphieudv ct
            JOIN loaidv l ON l.id = ct.LoaiDV
            JOIN phieudichvu p ON o.SoPhieu = ct.SoPhieu
            WHERE p.SoPhieu = ?
        ");

        if ($stmt) {
            $stmt->bind_param("i", $SoPhieu);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $dvDetails = $result->fetch_assoc();

                $stmt = $mysqli->prepare("
                SELECT p.SoPhieu, p.NgayLap, p.TongTien, p.KhachHang, p.SDT, l.TenLoai, l.DonGia, p.TraTrc, p.Conlai
                FROM ctphieudv ct
                JOIN loaidv l ON l.id = ct.LoaiDV
                JOIN phieudichvu p ON o.SoPhieu = ct.SoPhieu
                WHERE p.SoPhieu = ?
                ");
             
                if ($stmt) {
                    $stmt->bind_param("i", $SoPhieu);
                    $stmt->execute();
                    $productResult = $stmt->get_result();

                    $products = [];
                    while ($dv = $dvResult->fetch_assoc()) {
                        $DSDV[] = $dv;
                    }

                    echo json_encode([
                        'status' => 'success',
                        'dv_details' => array_merge($dvDetails, ['DSDV' => $DSDV])
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Không thể lấy danh sách dịch vụ từ cơ sở dữ liệu.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Không tìm thấy chi tiết phiếu dịch vụ.'
                ]);
            }

            $stmt->close();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Không thể chuẩn bị truy vấn.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Mã phiếu mua không được cung cấp hoặc không hợp lệ.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Phương thức yêu cầu không hợp lệ.'
    ]);
}

$mysqli->close();
?>
