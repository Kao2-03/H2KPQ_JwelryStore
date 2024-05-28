<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idDV = $_POST['ID'];
    $tenDV = $_POST['TenLoai'];
    $dongia = $_POST['DonGia'];

    $sql = "INSERT INTO LOAIDV (ID, TenLoai, DonGia) VALUES ('$idDV','$tenDV', '$dongia')";

    if ($mysqli->query($sql) === TRUE) {
        echo "New supplier added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
        header("Location: /H2KPQ_JwelryStore/Frontend/danhMucDichVu.php");
    exit();
}
?>
