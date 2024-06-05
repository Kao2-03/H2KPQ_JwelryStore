<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];

    $sql = "DELETE FROM loaidv WHERE ID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $ID);
    
    if ($stmt->execute() === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
    header("Location: /H2KPQ_JwelryStore/Frontend/danhMucDichVu.php");
    exit();
}
?>
