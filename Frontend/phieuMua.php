<?php
session_start();
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
  header("Location: ../Form_login/index.php");
  exit();
}
// Ngăn chặn bộ nhớ cache
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Pragma: no-cache");
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/stylePhieuMua.css">
  <title>Nhập Môn công nghệ phần mềm</title>
  <script>
   window.onbeforeunload = function() {
            return "Bạn có chắc chắn muốn rời khỏi trang này?";
        };

        // Ngăn việc quay lại trang login khi nhấn nút "Lùi" của trình duyệt
        history.pushState(null, null, location.href);
        window.addEventListener('popstate', function(event) {
            history.pushState(null, null, location.href);
            alert("Bạn cần phải đăng xuất để rời khỏi trang này!");
        });

        function logout() {
            window.location.href = '../Form_login/logout.php';
        }
        history.pushState(null, null, location.href);
window.addEventListener('popstate', function(event) {
    history.pushState(null, null, location.href);
    alert("Bạn cần phải đăng xuất để rời khỏi trang này!");
});
    </script>
    <script src="../JavaScript/PhieuMH.js"></script>
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
            <a class="nav-link active" href="phieuMua.php">Phiếu mua</a>
            <a class="nav-link" href="dichVu.php">Phiếu dịch vụ</a>
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
              <li class="tab_btn active"><a href="phieuMua.php"
                style="text-decoration: none;">Lập phiếu</a></li>
              <li class="tab_btn"><a href="traCuuPhieuMua.php"
                  style="text-decoration: none;">Tra cứu</a></li>
            </ul>
        </div>
        <!-- khối các tab chuyển qua lại -->
        <!-- tab lập phiếu -->
        <form class="content active" id="tabLapPhieu"  method="post">
            <div class="heading-text">
                <span>Lập phiếu mua hàng</span><br>
                <input type="text" class="form-control" style="width: fit-content;" name="ngay_lap" id="ngay_lap" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <!-- Chọn nhà cung cấp -->
            <div class="btn-and-labels">
                <button type="button" class="btn btn-primary" onclick="togglePopupChonNCC()">Chọn nhà cung cấp</button>
                <label for="" class="info tenCTY" >Tên:</label>
                <label for="" class="info diaChi">Địa chỉ:</label>
                <label for="" class="info SDT"  >Số điện thoại:</label>

                <input type="hidden" id="ten_ncc" name="ten_ncc">
                <input type="hidden" id="dia_chi" name="dia_chi">
                <input type="hidden" id="sdt" name="sdt">
            </div>
            <!-- Giỏ hàng -->
<div class="table-of-content"> 
    <div class="heading-part">
        <label class="secondary-heading">Giỏ hàng</label>
        <button type="button" class="btn btn-primary" onclick="togglePopupThemGioHang()">+</button>
    </div>
    <!-- Load bảng giỏ hàng -->
    <div class="scroll-table" id="collapse1" style="overflow-y: scroll; height: 260px">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody id="cartTableBody">
            </tbody>
        </table>
    </div> 
</div>

            <!-- Tổng thanh toán -->
            <div class="total-price-panel">
                <button type="button" class="btn btn-primary" id="close" onclick="LapPhieu()">X</button>
                <div class="label-sl-sp-price-btn">
                  <label for="" class="count-total">Tổng thanh toán (<span style="font-size: 16px; color: black;" id="product-count">0</span> sản phẩm)</label>
                  <label for="" class="price-total">0</label>
                  <input type="hidden" name="tong_tien" id="tong_tien" value="0">
                  <button id="submitButton" type="button" onclick="prepareAndSubmitForm(event)">Lập phiếu</button>

                </div>
            </div>
        </form>
      </div>
    </div>
 <!-- Popup thêm sản phẩm -->
<div class="popup" id="popup-2">
    <div class="overlay"></div>
    <div class="content-popup chinhSua">
        <div class="form-container">
            <div class="ncc Head-of-table">
                <span>Thêm sản phẩm</span>
                <div class="search-box">
                    <form class="form-inline" id="data-product" method="post">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" style="margin-right: 60px;" name="search_keyword_product" id="TimKiemProduct" placeholder="Tìm kiếm">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" style="margin-right: 60px;">Tìm</button>
                    </form>
                </div>
            </div>
            <div style="width: 830px; overflow-y: scroll;" class="table-of-content" id="result-product">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../BackEnd/PhieuMua/products.php" ?>
                    </tbody>
                </table>
            </div>
            <div class="ncc close-footer">
                <button class="btn btn-primary close" onclick="togglePopupThemGioHang()">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Popup Nhà cung cấp -->
<div class="popup" id="popup-1-Mua">
  <div class="overlay"></div>
  <div class="content-popup chinhSua">
    <div class="form-container">
      <div class="ncc Head-of-table">
        <span>Chọn nhà cung cấp</span>
        <div class="search-box">
          <form class="form-inline" id="searchSupplierForm" method="post">
            <div class="form-group mx-sm-3 mb-2">
              <input type="text" class="form-control" style="margin-right: 60px;" name="search_keyword_ncc" id="TimKiemNCC" placeholder="Tìm gì nè">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Ô kê</button>
          </form>
        </div>
      </div>
      <!-- Bảng nhà cung cấp -->
      <div class="ncc table-part scroll-table" id="collapse1">
        <table class="table table-hover table-bordered" style="width: 920px;">
          <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">Mã</th>
              <th scope="col">Tên nhà cung cấp</th>
              <th scope="col">Địa chỉ</th>
              <th scope="col">Số điện thoại</th>
              <th scope="col">Thao tác</th>
              </tr>
          </thead>
          <tbody id="searchSupplierResult">
              <!-- Kết quả tìm kiếm sẽ được chèn vào đây -->
              <?php include "../BackEnd/PhieuMua/display_pm.php" ?>
          </tbody>
        </table>
      </div>
      <div class="ncc close-footer">
        <button class="btn btn-primary close" onclick="togglePopupChonNCC()">Đóng</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?php
}
?>