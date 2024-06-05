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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.6/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="/H2KPQ_JwelryStore/css/stylePhieuMua.css">
  <link rel="stylesheet" href="/H2KPQ_JwelryStore/css/style_traCuuPhieuMua.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Tải jQuery trước -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.6/dist/sweetalert2.min.js"></script> <!-- Tải SweetAlert2 sau -->
  <script src="../JavaScript/TraCuuPM.js"></script> <!-- Tải file JS của bạn cuối cùng -->
  <title>Nhập Môn công nghệ phần mềm</title>
</head>

<body style="background-color: #D4DAE6;">
  <div id="main-container">
    <div id="nav-bar-ne">
      <div id="logo">
        <a href="PhieuBan.html" style="text-decoration: none;">
          <span>Kimberly</span>
        </a>
      </div>
      <div class="nav_ne">
        <nav class="nav flex-column">
          <a class="nav-link" href="phieuBan.php">Phiếu bán</a>
          <a class="nav-link active" href="phieuMua.php">Phiếu mua</a>
          <a class="nav-link" href="dichVu.php">Phiếu dịch vụ</a>
          <a class="nav-link" href="sanPham.php">Sản phẩm</a>
          <a class="nav-link" href="nhaCungCap.php">Nhà cung cấp</a>
          <a class="nav-link" href="BaoCao.php">Báo cáo</a>
        </nav>
      </div>
    </div>
    <div class="working-area">
      <div class="tab-container">
        <ul class="ul-tab">
          <li class="tab_btn"><a href="./phieuMua.php" style="text-decoration: none;">Lập phiếu</a></li>
          <li class="tab_btn active"><a href="traCuuPhieuMua.php" style="text-decoration: none;">Tra cứu</a></li>
        </ul>
      </div>
      <div class="content active" id="tabDonViTinh">
        <div class="heading-text">
          <span>Tra cứu phiếu mua</span>
        </div>
        <div class="search-box">
        </div>
        <div class="table-of-content" id="collapse3" style="overflow-y: scroll;height: 400px;">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th scope="col">Mã phiếu</th>
                <th scope="col">Nhà cung cấp</th>
                <th scope="col">Tổng thanh toán</th>
                <th scope="col">Ngày thanh toán</th>
                <th scope="col">Thao tác</th>
              </tr>
            </thead>
            <?php include '../BackEnd/TraCuuPMH/DS_PM.php'; ?>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="popup" id="popup-1">
    <div class="overlay" onclick="togglePopupChiTiet_TTPM()"></div>
    <div class="content-popup traCuu" style="width: 950px">
      <div class="form-container">
        <div class="header">
          <label class="text1">Phiếu mua hàng</label>
          <label class="text2" id="current-date">Ngày lập: <?php echo date('d/m/Y'); ?></label>
        </div>
        <label class="label-ttncc" for="">Mã phiếu</label>
        <div class="mb-3">
          <input type="text" class="form-control" id="maHD" placeholder="Mã hóa đơn" readonly>
        </div>
        <label class="label-ttncc" for="">Thông tin nhà cung cấp</label>
        <div class="thongtinNCC">
          <input type="text" class="form-control" id="tenNCC" placeholder="Tên nhà cung cấp" readonly>
          <input type="text" class="form-control" style="width: 380px;" id="diaChi" placeholder="Địa chỉ" readonly>
          <input type="text" class="form-control" style="width: 180px;" id="sdt" placeholder="Số điện thoại" readonly>
        </div>

        <!-- Dòng trống giữa thông tin nhà cung cấp và bảng sản phẩm -->
        <br>
        <div>
          <label class="label-for-table" for="">Giỏ hàng</label>
        </div>
        <div class="bangGioHang" id="collapse2" style="overflow-y: scroll; height: 200px">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
              </tr>
            </thead>
            <tbody id="product-list-body">
            </tbody>
          </table>
        </div>
        <div class="tongCong">
          <label class="lable-for-count" for="">Tổng thanh toán</label>
          <label class="label-for-total-price" id="total-payment"></label>
        </div>
        <div class="btn-dong">
          <button class="btn btn-primary" type="button" onclick="togglePopupChiTiet_TTPM()">Đóng</button>
        </div>
      </div>
    </div>
  </div>
  
</body>

</html>
<?php
}

?>