<?php
include 'db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maNCC = $_POST['MaNCC'];
    $ten = $_POST['Ten'];
    $diachi = $_POST['Diachi'];
    $sdt = $_POST['SDT'];

    $sql = "INSERT INTO suppliers (maNCC, ten, diachi, sdt) VALUES ('$maNCC','$ten', '$diachi', '$sdt')";

    if ($mysqli->query($sql) === TRUE) {
        echo "New supplier added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
        header("Location: /H2KPQ_JwelryStore/Frontend/nhaCungCap.php"); // Bỏ bình luận dòng này nếu cần chuyển hướng
    exit();
}
?>
