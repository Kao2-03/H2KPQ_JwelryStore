<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "h2kpq_jwelrystore";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
