<?php
// Include file kết nối đến cơ sở dữ liệu
include '../Backend_PDV/db_connection.php';

// Start the session
session_start();

// Xử lý khi nhận phương thức POST từ biểu mẫu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu và kiểm tra tính hợp lệ
    $KhachHang = htmlspecialchars($_POST['KhachHang'] ?? '');
    $ThanhTien = floatval($_POST['ThanhTien'] ?? 0);
    $NgayLap = $_POST['NgayLap'] ?? date('Y-m-d');
    $LoaiDV = isset($_POST['LoaiDV']) ? json_decode($_POST['LoaiDV'], true) : [];

    // Kiểm tra xem dữ liệu có hợp lệ không
    if (empty($KhachHang) || empty($NgayLap) || $ThanhTien <= 0 || empty($LoaiDV)) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu yêu cầu không hợp lệ"]);
        exit;
    }

    // Kiểm tra định dạng ngày
    if (!DateTime::createFromFormat('Y-m-d', $NgayLap)) {
        echo json_encode(["status" => "error", "message" => "Định dạng ngày không hợp lệ"]);
        exit;
    }

    // Bắt đầu giao dịch
    $mysqli->begin_transaction();

    try {
        // Thêm phiếu dịch vụ vào bảng phieudichvu
        $stmt = $mysqli->prepare("INSERT INTO phieudichvu (KhachHang, ThanhTien, NgayLap) VALUES (?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed for phieudichvu: " . $mysqli->error);
        }
        $stmt->bind_param("sds", $KhachHang, $ThanhTien, $NgayLap);

        if ($stmt->execute()) {
            $SoPhieu = $stmt->insert_id;
            $stmt->close();

            // Thêm từng loại dịch vụ vào bảng ctphieudv
            $stmt = $mysqli->prepare("INSERT INTO ctphieudv (SoPhieu, TenLoai, DonGia, SoLuong, ThanhTien) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare failed for ctphieudv: " . $mysqli->error);
            }

            foreach ($LoaiDV as $loaidv) {
                $TenLoai = $loaidv['TenLoai'];
                $DonGia = $loaidv['DonGia'];
                $SoLuong = $loaidv['SoLuong'] ?? 1; // Giả sử mỗi loại dịch vụ ít nhất có 1
                $stmt->bind_param("ssddd", $SoPhieu, $TenLoai, $DonGia, $SoLuong, $DonGia * $SoLuong);
                $stmt->execute();
            }

            // Commit giao dịch
            $mysqli->commit();
            echo json_encode(['status' => 'success', 'message' => 'Phiếu dịch vụ đã được lưu thành công!', 'SoPhieu' => $SoPhieu]);
        } else {
            throw new Exception('Có lỗi xảy ra khi lưu phiếu dịch vụ. Vui lòng thử lại sau.');
        }
    } catch (Exception $e) {
        // Nếu có lỗi, rollback giao dịch
        $mysqli->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        // Đóng kết nối
        if (isset($stmt)) {
            $stmt->close();
        }
        $mysqli->close();
    }
} else {
    // Nếu không phải là phương thức POST, trả về lỗi
    echo json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ']);
}
?>
