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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo tồn kho</title>
</head>
<body>

<form id="reportForm">
    <label for="thang">Chọn tháng:</label>
    <input type="month" id="thang" name="thang" required>
    <button type="button" onclick="capNhatBaoCao()">Cập nhật báo cáo</button>
</form>

<div id="baoCaoContainer"></div>

<script>
    function capNhatBaoCao() {
        var thang = document.getElementById("thang").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "XLBC.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                hienThiBaoCao(data);
            }
        };
        xhr.send("thang=" + thang);
    }

    function hienThiBaoCao(data) {
        var container = document.getElementById("baoCaoContainer");
        container.innerHTML = ""; // Xóa dữ liệu cũ trước khi hiển thị mới

        if (data.length > 0) {
            var table = "<table border='1'><tr><th>Mã CT</th><th>Sản phẩm</th><th>Tồn đầu</th><th>Mua vào</th><th>Bán ra</th><th>Tồn cuối</th></tr>";
            for (var i = 0; i < data.length; i++) {
                table += "<tr><td>" + data[i].MaCT + "</td><td>" + data[i].SanPham + "</td><td>" + data[i].TonDau + "</td><td>" + data[i].MuaVao + "</td><td>" + data[i].BanRa + "</td><td>" + data[i].TonCuoi + "</td></tr>";
            }
            table += "</table>";
            container.innerHTML = table;
        } else {
            container.innerHTML = "Không có dữ liệu báo cáo cho tháng này.";
        }
    }
</script>

</body>
</html>