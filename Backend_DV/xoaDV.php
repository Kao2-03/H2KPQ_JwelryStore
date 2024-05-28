<?php
    include "db_connection.php";

    $maDV = $_POST['maDV'];

    $sql = "DELETE FROM unit WHERE id = $maDV";
    $result = mysqli_query($conn, $sql);
?>