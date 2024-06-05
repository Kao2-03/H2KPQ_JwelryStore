<?php
// Kết nối đến cơ sở dữ liệu
include "../../Form_login/db_conn.php";

// Lấy từ khóa tìm kiếm từ biến POST
if(isset($_POST['search'])) {
    $search = $_POST['search'];
    
    // Tạo truy vấn SQL để tìm kiếm trong cơ sở dữ liệu
    $sql = "SELECT * FROM PHIEUBAN 
            WHERE SoPhieu LIKE '%$search%' 
            OR KhachHang LIKE '%$search%' 
            OR TongTien LIKE '%$search%' 
            OR NgayLap LIKE '%$search%'";

    // Thực thi truy vấn
    $result = mysqli_query($conn, $sql);
    $i = 1;
    // Kiểm tra xem có kết quả hay không
    if(mysqli_num_rows($result) > 0) {
        // Duyệt qua các dòng kết quả và hiển thị chúng
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>".$i."</td>
                    <td>".$row['SoPhieu']."</td>
                    <td>".$row['KhachHang']."</td>
                    <td>".$row['TongTien']."</td>
                    <td>".$row['NgayLap']."</td>
                    <td>
                      <button type='button' class='btn ChiTietSanPham' data-id='".$row['SoPhieu']."' data-kh='".$row['KhachHang']."' data-tongtien='".$row['TongTien']."' data-ngaylap='".$row['NgayLap']."' >Chi tiết</button>
                      <button type='button' class='btn Xoa' onclick='xoaSP(\"".$row['SoPhieu']."\")'>Xóa</button>
                    </td>
                  </tr>";
                  $i++;
        }
    } else {
        // Nếu không có kết quả, hiển thị thông báo không tìm thấy
        echo "<tr><td colspan='5'>Không tìm thấy kết quả</td></tr>";
    }
} else {
    // Nếu không có dữ liệu gửi lên từ form tìm kiếm, hiển thị thông báo
    echo "<tr><td colspan='5'>Vui lòng nhập từ khóa tìm kiếm</td></tr>";
}

// Đóng kết nối đến cơ sở dữ liệu
mysqli_close($conn);
?>
