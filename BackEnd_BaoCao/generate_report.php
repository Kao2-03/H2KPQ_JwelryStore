<?php
session_start();
include 'db_connection.php'; // Đảm bảo đường dẫn đúng

// Kiểm tra kết nối cơ sở dữ liệu
if (!$mysqli) {
    die("Kết nối cơ sở dữ liệu không thành công: " . mysqli_connect_error());
}

// Kiểm tra nếu người dùng đã gửi yêu cầu và có dữ liệu tháng
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['thang'])) {
    $monthYear = $_POST['thang'];
    list($year, $month) = explode('-', $monthYear);

    // Truy vấn cơ sở dữ liệu để lấy dữ liệu báo cáo cho tháng và năm cụ thể
    $sql = "SELECT * FROM ctbaocaokho WHERE MONTH(Ngaybaocao) = ? AND YEAR(Ngaybaocao) = ?";
    $stmt = $mysqli->prepare($sql);

    // Kiểm tra nếu chuẩn bị câu lệnh thành công
    if ($stmt === false) {
        die("Chuẩn bị câu lệnh thất bại: " . $mysqli->error);
    }

    $stmt->bind_param('ii', $month, $year);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả truy vấn
    if ($result === false) {
        die("Thực thi truy vấn thất bại: " . $stmt->error);
    }

    // Tạo một mảng chứa dữ liệu báo cáo
    if ($result->num_rows > 0) {
        echo "<table class='table table-hover table-bordered' align='center'>";
        echo "<thead>
                <tr>
                  <th scope='col'>Mã chi tiết báo cáo</th>
                  <th scope='col'>Mã sản phẩm</th>
                  <th scope='col'>Tồn đầu</th>
                  <th scope='col'>Mua vào</th>
                  <th scope='col'>Bán ra</th>
                  <th scope='col'>Tồn cuối</th>
                  <th scope='col'>Ngày báo cáo</th>
                </tr>
              </thead>";
        echo "<tbody>";
        // Lặp qua kết quả và thêm vào mảng dữ liệu báo cáo
        while ($row = $result->fetch_assoc()) {
            $MaCT = htmlspecialchars($row["MaCT"]);
            $MaSP = htmlspecialchars($row["SanPham"]);
            $TonDau = htmlspecialchars($row["TonDau"]);
            $MuaVao = htmlspecialchars($row["MuaVao"]);
            $BanRa = htmlspecialchars($row["BanRa"]);
            $TonCuoi = htmlspecialchars($row["TonCuoi"]);
            $Ngaybaocao = htmlspecialchars($row["Ngaybaocao"]);
            echo "<tr>";
            echo "<td>". $MaCT ."</td>";
            echo "<td>" . $MaSP . "</td>";
            echo "<td>" . $TonDau . "</td>";
            echo "<td>" . $MuaVao . "</td>";
            echo "<td>" . $BanRa . "</td>";
            echo "<td>" . $TonCuoi . "</td>";
            echo "<td>" . $Ngaybaocao . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No data found</p>";
    }
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();
?>
