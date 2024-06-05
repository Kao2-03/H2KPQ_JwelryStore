<?php
// Include the database connection file
include 'db_connection.php';

// Check if the $mysqli variable is set
if (isset($mysqli)) {
    $sql = "SELECT ctbc.MaCT, ctbc.SanPham, ctbc.TonDau, ctbc.MuaVao, ctbc.BanRa, ctbc.TonCuoi FROM ctbaocaokho ctbc "; // Adjust table and column names as per your database structure
    $result = $mysqli->query($sql);

    // Check if the query was successful
    if ($result) {
        // Check if there are results
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover table-bordered' align='center'>";
            echo "<thead>
                    <tr>
                      <th scope='col'># </th>
                      <th scope='col'>Sản phẩm</th>
                      <th scope='col'>Tồn đầu</th>
                      <th scope='col'>Mua vào</th>
                      <th scope='col'>Bán ra</th>
                      <th scope='col'>Tồn cuối</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            // Loop through the result set and generate table rows
            while($row = $result->fetch_assoc())
             {
                $id = htmlspecialchars($row["MaCT"]);
                $tenSP = htmlspecialchars($row["SanPham"]);
                $TD = htmlspecialchars($row["TonDau"]);
                $MV = htmlspecialchars($row["MuaVao"]);
                $BR = htmlspecialchars($row["BanRa"]);
                $TC = htmlspecialchars($row["TonCuoi"]);
                echo "<tr>";
                echo "<tr>";
                echo "<td>" . $id . "</td>";
                echo "<td>". $tenSP ."</td>";
                echo "<td>" . $TD . "</td>";
                echo "<td>" . $MV. "</td>";
                echo "<td>" . $BR . "</td>";
                echo "<td>" . $TC. "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p align='center'>No service found</p>";
        }
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
} else {
    echo "Database connection error.";
}
?>
