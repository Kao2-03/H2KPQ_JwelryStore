<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "test_db";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
