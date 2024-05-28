<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "test_db";

    $conn = mysqli_connect($host, $username, $password, $database);

    if(!$conn){
        die("Không thể kết nối database". mysqli_connect_error());
    }
?>