<?php
    include "db_connection.php";

    $sql = "SELECT id, name from unit";
    $result = mysqli_query($conn, $sql);
    $i = 1;

    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_row($result)){
            $maDV = $row[0];

            echo "<tr><td>".$i."</td>";
            echo"<td>".$row[0]."</td>";
            echo"<td>".$row[1]."</td>";
            echo'<td>
            <button type="button" class="btn ChiTiet" data-bs-toggle="button" data-id="'.$row[0].'" data-name="'.$row[1].'" onclick="togglePopupSuaDV()">Chỉnh
                        sửa</button>
            <button type="button" class="btn Xoa" data-bs-toggle="button" onclick = "xoaDV('.$row[0].')">Xóa</button>
                </td>
                  </tr>';
            $i++;
        }
    }
    else {
        echo "<tr><td colspan='3'>No unit found</td></tr>";
    }
?>