<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];
    $TenLoai = $_POST['TenLoai'];
    $DonGia = $_POST['DonGia'];

    // Sử dụng câu lệnh chuẩn bị để tránh SQL Injection
    $stmt = $mysqli->prepare("UPDATE loaidv SET TenLoai=?, DonGia=? WHERE ID=?");
    $stmt->bind_param("ssi", $TenLoai, $DonGia, $ID);
    
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();

    // Chuyển hướng sau khi thực thi câu lệnh
    header("Location: /H2KPQ_JwelryStore/Frontend/danhMucDichVu.php"); 
    exit();
}
?>
