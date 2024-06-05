<?php
session_start();
include 'db_connection.php'; // Kết nối đến cơ sở dữ liệu
require '../BackEnd_BaoCao/fpdf186/fpdf.php'; // Include the FPDF library

// Kiểm tra kết nối cơ sở dữ liệu
if ($mysqli->connect_errno) {
    die("Kết nối cơ sở dữ liệu không thành công: " . $mysqli->connect_error);
}

// Kiểm tra nếu người dùng đã gửi yêu cầu và có dữ liệu tháng
if (isset($_GET['thang'])) {
    $monthYear = $_GET['thang'];
    list($year, $month) = explode('-', $monthYear);

    // Truy vấn cơ sở dữ liệu để lấy dữ liệu báo cáo cho tháng và năm cụ thể
    $sql = "SELECT * FROM ctbaocaokho WHERE MONTH(Ngaybaocao) = ? AND YEAR(Ngaybaocao) = ?";
    $stmt = $mysqli->prepare($sql);

    // Kiểm tra nếu chuẩn bị câu lệnh thành công
    if ($stmt === false) {
        die("Chuẩn bị câu lệnh thất bại: " . $mysqli->error);
    }

    $stmt->bind_param('ii', $month, $year);
    $stmt->execute();
    $result = $stmt->get_result();

    // Tạo file PDF và thêm dữ liệu vào
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Bao cao ton kho', 0, 1, 'C');
    $pdf->Ln(10);

    // Kiểm tra kết quả truy vấn
    if ($result->num_rows > 0) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 10, 'MaCT', 1);
        $pdf->Cell(40, 10, 'SanPham', 1);
        $pdf->Cell(20, 10, 'TonDau', 1);
        $pdf->Cell(20, 10, 'MuaVao', 1);
        $pdf->Cell(20, 10, 'BanRa', 1);
        $pdf->Cell(20, 10, 'TonCuoi', 1);
        $pdf->Cell(30, 10, 'Ngaybaocao', 1);
        $pdf->Ln();

        // Lặp qua kết quả và thêm vào file PDF
        while ($row = $result->fetch_assoc()) {
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(30, 10, $row["MaCT"], 1);
            $pdf->Cell(40, 10, $row["SanPham"], 1);
            $pdf->Cell(20, 10, $row["TonDau"], 1);
            $pdf->Cell(20, 10, $row["MuaVao"], 1);
            $pdf->Cell(20, 10, $row["BanRa"], 1);
            $pdf->Cell(20, 10, $row["TonCuoi"], 1);
            $pdf->Cell(30, 10, $row["Ngaybaocao"], 1);
            $pdf->Ln();
        }
    } else {
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, 'No data found for the selected month and year.', 0, 1, 'C');
    }

    $stmt->close();
    $mysqli->close();

    // Gửi file PDF đến trình duyệt
    $pdf->Output('D', 'Bao_cao_ton_kho.pdf');
    exit();
} else {
    echo "Vui lòng chọn tháng và năm.";
}
?>
