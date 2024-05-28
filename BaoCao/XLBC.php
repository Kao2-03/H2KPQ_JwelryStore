<?php
session_start();
include 'db_connection.php'; // Kết nối đến cơ sở dữ liệu
require '../vendor/autoload.php'; // Tải các thư viện cần thiết

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Hàm để lấy dữ liệu tồn kho từ cơ sở dữ liệu
function getInventoryData($month, $year, $mysqli) {
    $data = array();

    // Truy vấn cơ sở dữ liệu để lấy dữ liệu tồn kho cho tháng và năm cụ thể
    $sql = "SELECT MaCT, SanPham, TonDau, MuaVao, BanRa, TonCuoi
            FROM ctbaocaokho 
            WHERE MONTH(Ngaybaocao) = ? AND YEAR(Ngaybaocao) = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $month, $year);
    $stmt->execute();
    $result = $stmt->get_result();

    // Lặp qua kết quả và thêm vào mảng dữ liệu
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

// Kiểm tra nếu người dùng đã yêu cầu cập nhật báo cáo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['thang'])) {
    $monthYear = $_POST['thang'];
    list($year, $month) = explode('-', $monthYear);

    // Lấy dữ liệu tồn kho từ cơ sở dữ liệu
    $inventoryData = getInventoryData($month, $year, $mysqli);

    // Trả về dữ liệu dưới dạng JSON
    echo json_encode($inventoryData);
    exit();
}
?>