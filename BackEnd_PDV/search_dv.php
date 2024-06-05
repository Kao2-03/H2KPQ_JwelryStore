<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_keyword_dv'])) {
    $keyword = $mysqli->real_escape_string($_POST['search_keyword_dv']);
    $sql = "SELECT * FROM loaidv WHERE TenLoai LIKE '%$keyword%'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>{$row['TenLoai']} - {$row['DonGia']}</div>";
        }
    } else {
        echo "No results found.";
    }
}
?>
