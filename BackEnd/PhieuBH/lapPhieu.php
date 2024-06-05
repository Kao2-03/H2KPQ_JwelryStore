<?php
include "../../Form_login/db_conn.php";
header('Content-Type: application/json');

// Function to create a new invoice number
function taoSoPhieu($conn) {
    $sql = "SELECT MAX(SUBSTRING(SoPhieu, 3)) AS maxSoPhieu FROM phieuban";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $maxSoPhieu = $row["maxSoPhieu"];
        $nextSoPhieu = intval($maxSoPhieu) + 1;
        return "PB" . sprintf("%02d", $nextSoPhieu);
    } else {
        return "PB01";
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required data is sent
    if (!isset($_POST["ngay_lap"]) || !isset($_POST["khach_hang"]) || !isset($_POST["tong_tien"]) || !isset($_POST["cart"])) {
        echo json_encode(array("success" => false, "error" => "Dữ liệu không hợp lệ."));
        exit();
    }

    // Check data types
    $ngayLap = $_POST["ngay_lap"];
    $khachHang = $_POST["khach_hang"];
    $tongTien = $_POST["tong_tien"];
    $cartItems = json_decode($_POST["cart"], true);

    if (!is_numeric($tongTien) || !is_array($cartItems)) {
        echo json_encode(array("success" => false, "error" => "Dữ liệu không hợp lệ."));
        exit();
    }

    // Create a new invoice number
    $soPhieu = taoSoPhieu($conn);

    // Insert data into the phieuban table
    $sqlPhieuBan = "INSERT INTO phieuban (SoPhieu, NgayLap, KhachHang, TongTien)
                    VALUES ('$soPhieu', '$ngayLap', '$khachHang', '$tongTien')";

    if ($conn->query($sqlPhieuBan) === TRUE) {
        // Get product information from the cart and save it to the ctphieuban table
        foreach ($cartItems as $item) {
            $sanPham = $item['SanPham'];
            $soLuong = $item['SoLuong'];
            $donGia = $item['DonGia'];
            $thanhTien = $item['ThanhTien'];
            
            // Insert data into the ctphieuban table
            $sqlCTPhieuBan = "INSERT INTO ctphieuban (SoPhieu, SanPham, SoLuong, DonGia, ThanhTien)
                              VALUES ('$soPhieu', '$sanPham', '$soLuong', '$donGia', '$thanhTien')";
            $conn->query($sqlCTPhieuBan);

            // Update product inventory
            $sqlUpdateInventory = "UPDATE sanpham SET SoLuongKho = SoLuongKho - $soLuong WHERE MaSP = '$sanPham'";
            $conn->query($sqlUpdateInventory);
        }

        // Return a JSON object for frontend processing
        echo json_encode(array("success" => true));
    } else {
        // Return a JSON object for frontend processing
        echo json_encode(array("success" => false, "error" => $conn->error));
    }
}

// Close the connection
$conn->close();
?>
