<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $MaNCC = $_POST['MaNCC'];
    $ten = $_POST['ten'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];

    $sql = "UPDATE suppliers SET MaNCC=?, ten=?, diachi=?, sdt=? WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssi", $MaNCC, $ten, $diachi, $sdt, $id);
    
    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();

    header("Location: /H2KPQ_JwelryStore/Frontend/nhaCungCap.php"); 
    exit();
}
?>
