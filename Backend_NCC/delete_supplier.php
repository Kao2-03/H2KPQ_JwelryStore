<?php
include 'db_connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM suppliers WHERE id='$id'";

    if ($mysqli->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }

    $mysqli->close();

    header("Location: /H2KPQ_JwelryStore/Frontend/nhaCungCap.php");
    exit();
}
?>
