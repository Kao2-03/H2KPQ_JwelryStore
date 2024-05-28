<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TenLoai = $_POST['TenLoai'];
    $DonGia = $_POST['DonGia'];
    $ID = $_POST['ID'];

    $sql = "UPDATE loaidv SET TenLoai=?, DonGia=? WHERE ID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssi", $TenLoai, $DonGia, $ID);
    
    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();

    header("Location: /H2KPQ_JwelryStore/Frontend/danhMucDichVu.php"); 
    exit();
}
?>
