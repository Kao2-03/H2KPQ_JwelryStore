<?php
include '../Backend_PDV/db_connection.php'; // Include file kết nối

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $KhachHang = $_POST['KhachHang'] ?? '';
    $ThanhTien = $_POST['ThanhTien'] ?? 0;
    $NgayLap = $_POST['NgayLap'] ?? date('Y-m-d');
    $LoaiDV = isset($_POST['LoaiDV']) ? json_decode($_POST['LoaiDV'], true) : [];

    if (empty($KhachHang) || empty($NgayLap) || $ThanhTien <= 0 || empty($LoaiDV)) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu yêu cầu không hợp lệ"]);
        exit;
    }

    if ($mysqli->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'Kết nối cơ sở dữ liệu thất bại: ' . $mysqli->connect_error]));
    }

    $mysqli->begin_transaction();

    try {
        $stmt = $mysqli->prepare("INSERT INTO phieudichvu (KhachHang, ThanhTien, NgayLap) VALUES (?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed for phieudichvu: " . $mysqli->error);
        }
        $stmt->bind_param("sds", $KhachHang, $ThanhTien, $NgayLap);

        if ($stmt->execute()) {
            $SoPhieu = $stmt->insert_id;
            $stmt = $mysqli->prepare("INSERT INTO ctphieudv (SoPhieu, LoaiDV, DonGia, SoLuong, ThanhTien, TraTruoc, ConLai, NgayGiao, TinhTrang) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare failed for ctphieudv: " . $mysqli->error);
            }

            foreach ($LoaiDV as $loaidv) {
                $TenLoai = $loaidv['TenLoai'];
                $DonGia = $loaidv['DonGia'];
                $SoLuong = $loaidv['SoLuong'] ?? 0;
                $TraTruoc = $loaidv['TraTruoc'] ?? 0;
                $ConLai = $loaidv['ConLai'] ?? 0;
                $NgayLap = $loaidv['NgayLap'] ?? date('Y-m-d');
                $TinhTrang = $loaidv['TinhTrang'] ?? '';

                $stmt->bind_param("isdiiiss", $SoPhieu, $TenLoai, $DonGia, $SoLuong, $ThanhTien, $TraTruoc, $ConLai, $NgayLap, $TinhTrang);
                $stmt->execute();
            }

            $mysqli->commit();
            echo json_encode(['status' => 'success', 'message' => 'Phiếu đã được lập thành công!', 'SoPhieu' => $SoPhieu]);
        } else {
            throw new Exception('Có lỗi xảy ra khi lập phiếu. Vui lòng thử lại sau.');
        }
    } catch (Exception $e) {
        $mysqli->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $mysqli->close();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ']);
}
?>
