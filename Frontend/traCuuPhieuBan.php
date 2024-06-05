<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/stylePB.css">
  <link rel="stylesheet" href="../css/style_traCuuPhieuBan.css">
  <script src="../JavaScript/TraCuuPB.js"></script>
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
                    <li class="tab_btn"><a href="phieuBan.php"
                        style="text-decoration: none;">Lập phiếu</a></li>
                    <li class="tab_btn active"><a href="traCuuPhieuBan.php"
                        style="text-decoration: none;">Tra cứu</a></li>
                </ul>
            </div>

            <div class="content active" id="tabDonViTinh">
              <div class="heading-text">
                <span>Tra cứu phiếu bán</span>
              </div>

              <div class="search-box">
                <form class="form-inline" id="FormTimKiemPhieuBan" method="post">
                  <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control TimKiemPhieuBan" id="searchPhieuBan" placeholder="Tìm kiếm">
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Tìm</button>
                </form>
              </div>
      
              <div class="table-of-content" id="collapse3">
                <table class="table table-hover table-bordered" >
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Mã phiếu</th>
                      <th scope="col">Khách hàng</th>
                      <th scope="col">Tổng thanh toán</th>
                      <th scope="col">Ngày thanh toán</th>
                      <th scope="col">Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php include "../BackEnd/TraCuuPBH/DS_PB.php" ?>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>          
        </div>
        <!-- popup của chi tiết -->
        <div class="popup" id="popup-1">
          <div class="overlay"></div>
          <div class="content-popup traCuu">
            <div class="form-container">
              <div class="header">
                <label class="text1">Phiếu bán hàng</label>
                <label class="text2">Ngày lập 13/4/2024</label>
              </div>

              <div class="mb-3">
                <input type="text" class="form-control" id="maHD" placeholder="Mã hóa đơn" disabled>
              </div>

              <div class="thongKh">
                <input type="text" class="form-control" id="tenKH" placeholder="Tên Khách hàng" disabled>
              </div>

              <div>
                <label class="label-for-table" for="">Giỏ hàng</label>
              </div>

              <div class="bangGioHang" id="collapse2">
                <table class="table table-hover table-bordered" style="width: 920px;">
                  <thead>
                      <tr>
                      <th scope="col">#</th>
                      <th scope="col">Sản phẩm</th>
                      <th scope="col">Đơn giá</th>
                      <th scope="col">Số lượng</th>
                      <th scope="col">Thành tiền</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>

              <div class="tongCong">
                <label class="lable-for-count" for="">Tổng thanh toán (3 sản phẩm)</label>
                <label class="label-for-total-price" for="">76.090.999</label>
              </div>

              <div class="btn-dong">
                <button class="btn btn-primary" type="submit" onclick="togglePopupChiTiet_TTPM()">Đóng</button>
              </div>
              
            </div>
          </div>
        </div>
        <script>
          // popup
          function togglePopupChiTiet_TTPM(){
            document.getElementById("popup-1").classList.toggle("active");
          };
        </script>
      </body>
</html>