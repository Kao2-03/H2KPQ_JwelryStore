<?php
include "../../Form_login/db_conn.php";
header('Content-Type: application/json');

// Function to create a new invoice number
function taoSoPhieu($conn) {
    $sql = "SELECT MAX(SUBSTRING(SOPHIEUMUA, 3)) AS maxSoPhieu FROM phieumua";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $maxSoPhieu = $row["maxSoPhieu"];
        $nextSoPhieu = intval($maxSoPhieu) + 1;
        return "PM" . sprintf("%02d", $nextSoPhieu);
    } else {
        return "PM01";
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required data is sent
    if (!isset($_POST["ngay_lap"]) || !isset($_POST["nhacc"]) || !isset($_POST["tong_tien"]) || !isset($_POST["cart"])) {
        echo json_encode(array("success" => false, "error" => "Dữ liệu không hợp lệ."));
        exit();
    }

    // Check data types
    $ngayLap = $_POST["ngay_lap"];
    $nhacc = $_POST["nhacc"];
    $tongTien = $_POST["tong_tien"];
    $cartItems = json_decode($_POST["cart"], true);

    if (!is_numeric($tongTien) || !is_array($cartItems)) {
        echo json_encode(array("success" => false, "error" => "Dữ liệu không hợp lệ."));
        exit();
    }

    // Verify supplier ID
    $sqlVerifySupplier = "SELECT MaNCC FROM suppliers WHERE MaNCC = '$nhacc'";
    $resultVerifySupplier = $conn->query($sqlVerifySupplier);
    if ($resultVerifySupplier->num_rows === 0) {
        echo json_encode(array("success" => false, "error" => "Nhà cung cấp không tồn tại."));
        exit();
    }

    // Create a new invoice number
    $soPhieu = taoSoPhieu($conn);

    // Insert data into the phieumua table
    $sqlPhieuMua = "INSERT INTO phieumua (SOPHIEUMUA, NGAYLAP, NHACC, TONGTIEN)
                    VALUES ('$soPhieu', '$ngayLap', '$nhacc', '$tongTien')";

    if ($conn->query($sqlPhieuMua) === TRUE) {
        // Get product information from the cart and save it to the ctphieumua table
        foreach ($cartItems as $item) {
            $sanPham = $item['SanPham'];
            $soLuong = $item['SoLuong'];
            $donGia = $item['DonGia'];
            $thanhTien = $item['ThanhTien'];

            // Insert data into the ctphieumua table
            $sqlCTPhieuMua = "INSERT INTO ctphieumua (SOPHIEUMUA, SANPHAM, SOLUONG, DONGIA, THANHTIEN)
                              VALUES ('$soPhieu', '$sanPham', '$soLuong', '$donGia', '$thanhTien')";
            $conn->query($sqlCTPhieuMua);

            // Update the product inventory after purchasing
            $sqlUpdateInventory = "UPDATE sanpham SET SoLuongKho = SoLuongKho + $soLuong WHERE MaSP = '$sanPham'";
            if ($conn->query($sqlUpdateInventory) !== TRUE) {
                // Log error if update fails
                error_log("Error updating inventory for product $sanPham: " . $conn->error);
            }
        }

        // Return a JSON object for frontend processing
        echo json_encode(array("success" => true));
    } else {
        // Return a JSON object for frontend processing
        echo json_encode(array("success" => false, "error" => "Lỗi khi lập phiếu: " . $conn->error));
    }
}

// Close the database connection
$conn->close();
?>
