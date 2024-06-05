<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenDV = $_POST['TenLoai'];
    $dongia = $_POST['DonGia'];

    // Sử dụng câu lệnh chuẩn bị để tránh SQL Injection
    $stmt = $mysqli->prepare("INSERT INTO loaidv (TenLoai, DonGia) VALUES (?, ?)");
    $stmt->bind_param("ss", $tenDV, $dongia);

    if ($stmt->execute()) {
        // Chuyển hướng sau khi thực thi câu lệnh
        header("Location: /H2KPQ_JwelryStore/Frontend/danhMucDichVu.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>
