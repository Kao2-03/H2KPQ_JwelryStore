<?php
    include "db_connection.php";

    $tenDV = $_POST['tenDV'];

    $sql = "INSERT INTO unit (name) VALUE ('$tenDV')";
    $result = mysqli_query($conn, $sql);
?>