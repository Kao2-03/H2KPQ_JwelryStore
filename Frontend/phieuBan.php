<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/stylePB.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../JavaScript/PhieuBH.js"></script>
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
          <a class="nav-link active" href="phieuBan.php">Phiếu bán</a>
          <a class="nav-link " href="phieuMua.php">Phiếu mua</a>
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
          <li class="tab_btn active"><a href="phieuBan.php" style="text-decoration: none;">Lập phiếu</a></li>
          <li class="tab_btn"><a href="traCuuPhieuBan.php" style="text-decoration: none;">Tra cứu</a></li>
        </ul>
      </div>

      <!-- khối các tab chuyển qua lại -->
      <!-- tab lập phiếu -->
      <form class="content active" id="tabLapPhieu"  method="post">
    <div class="heading-text">
        <span>Lập phiếu bán hàng</span><br>
        <input type="text" class="form-control" name="ngay_lap" id="ngay_lap" value="<?php echo date('Y-m-d'); ?>" hidden>
    </div>
    <div class="btn-and-labels">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="khach_hang" id="khach_hang" placeholder="Tên khách hàng">
        </div>
    </div>
    <div class="table-of-content">
        <div class="heading-part">
            <label for="" class="secondary-heading">Giỏ hàng</label>
            <button type="button" class="btn btn-primary" onclick="togglePopupThemGioHang()">+</button>
        </div>
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
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="total-price-panel">
        <button type="button" class="btn btn-primary" id="close" onclick="LapPhieu()">X</button>
        <div class="label-sl-sp-price-btn">
            <label for="" class="count-total">Tổng thanh toán (<span id="product-count">0</span> sản phẩm)</label>
            <label for="" class="price-total">0</label>
            <input type="hidden" name="tong_tien" id="tong_tien" value="0">
            <button type="submit" class="btn btn-primary" id="LapPhieu" onclick="prepareAndSubmitForm()">Lập phiếu</button>
        </div>
    </div>
</form>

      <!-- popup của thêm sản phẩm -->
    </div>
  </div>
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
                  <?php include "../BackEnd/PhieuBH/DanhSachSP.php" ?>
                </tbody>
            </table>
        </div>
        <div class="ncc close-footer">
          <button class="btn btn-primary close" onclick="togglePopupThemGioHang()">Đóng</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    // popup
    window.togglePopupThemGioHang = function() {
    document.getElementById("popup-2").classList.toggle("active");
  };
  </script>
</body>
</html>