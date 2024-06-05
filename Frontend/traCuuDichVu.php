<?php
session_start();
if (!isset($_SESSION['id']) && $_SESSION[''] !== true) {
  header("Location: ../Form_login/index.php");
  exit();
}

// Ngăn chặn bộ nhớ cache
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Pragma: no-cache");

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleDV.css">
  <link rel="stylesheet" href="../css/style_TraCuuDV.css">
  <title>Nhập Môn công nghệ phần mềm</title>

</head>
    <body style="background-color: #D4DAE6;">

        <!-- cái bảng trắng lớn -->
        <div id="main-container">
          <!-- khối nav bar dọc gồm logo và navbar-->
          <div id="nav-bar-ne">
            <div id="logo">
              <a href="PhieuBan.php" style="text-decoration: none;">
                <span>Kimberly</span>
              </a>
            </div>
            <!-- khối navbar -->
            <div class="nav_ne">
              <nav class="nav flex-column">
                <a class="nav-link" href="phieuBan.php">Phiếu bán</a>
                <a class="nav-link " href="phieuBan.php">Phiếu mua</a>
                <a class="nav-link active" href="dichVu.php">Phiếu dịch vụ</a>
                <a class="nav-link" href="sanPham.php">Sản phẩm</a>
                <a class="nav-link" href="nhaCungCap.php">Nhà cung cấp</a>
                <a class="nav-link" href="BaoCao.php">Báo cáo</a>
              </nav>
            </div>
          </div>
      
          <!-- khối còn lại của bảng là màn hình thao tác gồm các tab và table... -->
          <div class="working-area">
            <div class="tab-container">
                <ul class="ul-tab">
                    <li class="tab_btn"><a href="dichVu.php"
                        style="text-decoration: none;">Lập phiếu</a></li>
                    <li class="tab_btn active"><a href="traCuuDichVu.php"
                        style="text-decoration: none;">Tra cứu</a></li>
                        <li class="tab_btn "><a href="danhMucDichVu.php"
                            style="text-decoration: none;">Danh mục dịch vụ</a></li>
                </ul>
            </div>

            <div class="content active" id="tabDonViTinh">
    <div class="heading-text">
        <span>Tra cứu phiếu dịch vụ</span>
    </div>

    <div class="search-box"></div>
    <div class="table-of-content" id="collapse3" style="overflow-y: scroll; height: 400px;">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Mã phiếu</th>
                    <th scope="col">Khách hàng</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Ngày lập</th>
                    <th scope="col">Tổng</th>
                    <th scope="col">Tổng trả trước</th>
                    <th scope="col">Tổng còn lại</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody id="phieu-dich-vu-list">
                <?php include '../Backend_TraCuuPDV/get_DV_slip_data.php'; ?>
            </tbody>
        </table>
    </div>

    <!-- Popup của chi tiết -->
    <div class="popup" id="popup-1">
        <div class="overlay" id="overlay" onclick="togglePopupChiTiet_TTPDV()"></div>
        <div class="content-popup traCuu" style="width: 950px">
            <div class="form-container">
                <div class="header">
                    <label class="text1">Phiếu dịch vụ</label>
                    <label class="text2" id="current-date">Ngày lập: <span id="popup-ngay-lap"></span></label>
                </div>
                <label class="label-ttncc" for="">Mã phiếu</label>
                <div class="mb-3">
                    <input type="text" class="form-control" id="popup-ma-phieu" placeholder="Mã hóa đơn" readonly>
                </div>
                <label class="label-ttncc" for="">Thông tin khách hàng</label>
                <div class="thongtinkh">
                    <input type="text" class="form-control" id="popup-khach-hang" placeholder="Tên khách hàng" readonly>
                    <br>
                    <input type="text" class="form-control" style="width: 180px;" id="popup-sdt" placeholder="Số điện thoại" readonly>
                </div>
                <br>
                <div>
                    <label class="label-for-table" for="">Dịch vụ</label>
                </div>
                <div class="bangGioHang" id="collapse2" style="overflow-y: scroll; height: 200px">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên dịch vụ</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody id="dv-list-body">
                        </tbody>
                    </table>
                </div>
                <div class="tongCong">
                    <label class="label-for-count" for="">Tổng thanh toán</label>
                    <label class="label-for-total-price" id="total-payment"></label>
                </div>
                <div class="btn-dong">
                    <button class="btn btn-primary" type="button" onclick="togglePopupChiTiet_TTPDV()">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hàm để mở/đóng popup chi tiết phiếu dịch vụ
        function togglePopupChiTiet_TTPDV() {
            const popup = document.getElementById("popup-1");
            const overlay = document.getElementById("overlay");
            popup.classList.toggle("active");
            overlay.classList.toggle("active");
        }

        // Hàm để hiển thị thông tin chi tiết phiếu dịch vụ
        function showServiceDetails(SoPhieu, NgayLap, KhachHang, Tong, SDT, dichVuJson) {
            document.getElementById("popup-ma-phieu").value = SoPhieu;
            document.getElementById("popup-ngay-lap").innerText = NgayLap;
            document.getElementById("popup-khach-hang").value = KhachHang;
            document.getElementById("popup-sdt").value = SDT;

            // Cập nhật danh sách dịch vụ
            const dvListBody = document.getElementById("dv-list-body");
            dvListBody.innerHTML = '';
            const dichVu = JSON.parse(dichVuJson);
            dichVu.forEach((dv, index) => {
                const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${dv.TenLoai}</td>
                    <td>${dv.DonGia}</td>
                    <td>${dv.SoLuong}</td>
                    <td>${dv.ThanhTien}</td>
                </tr>`;
                dvListBody.innerHTML += row;
            });

            // Cập nhật tổng thanh toán
            document.getElementById("total-payment").textContent = Tong;

            // Hiển thị popup
            togglePopupChiTiet_TTPDV();
        }
    </script>
    <script>
    function deletePurchase(SoPhieu) {
        if (confirm("Bạn có chắc chắn muốn xóa phiếu này không?")) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_purchase.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById("purchase-" + SoPhieu).remove();
                        alert("Xóa phiếu thành công!");
                    } else {
                        alert("Lỗi khi xóa phiếu: " + response.message);
                    }
                }
            };
            xhr.send("SoPhieu=" + SoPhieu);
        }
    }
</script>

</body>
</html>
<?php
}

?>