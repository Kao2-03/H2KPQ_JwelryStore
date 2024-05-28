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

              <div class="search-box">
                <form class="form-inline" method="post">
                  <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" id="TimKiem" placeholder="Tìm kiếm">
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Tìm</button>
                </form>
              </div>
      
              <div class="table-of-content" id="collapse3">
              <?php include "../DichVu/displayTCDV.php"; ?>
                        <button type="button" class="btn ChiTiet" data-bs-toggle="button" onclick="togglePopupChiTiet_TTPM()">Chi tiết</button>
                        <button type="button" class="btn Xoa" data-bs-toggle="button">Xóa</button>
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
                <label class="text1">Phiếu dịch vụ</label>
                <label class="text2">Ngày lập 13/4/2024</label>
              </div>

              <div class="mb-3">
    <input type="text" class="form-control" id="maphieu" placeholder="Mã phiếu" disabled>
</div>

<div class="flex-container">
    <div class="thongKh">
        <input type="text" class="form-control" id="tenKH" placeholder="Tên Khách hàng" disabled>
    </div>
    
    <div class="thongKh">
        <input type="text" class="form-control" id="SDT" placeholder="Số điện thoại" disabled>
    </div>
</div>

              <div class="bangGioHang" id="collapse2">
                <table class="table table-hover table-bordered" style="width: 920px;">
                  <thead>
                      <tr>
                      <th scope="col">#</th>
                      <th scope="col">Sản phẩm</th>
                      <th scope="col">Đơn giá</th>
                      <th scope="col">Số lượng</th>
                      <th scope="col">Thành tiền</th><th scope="col">Sản phẩm</th>
                      <th scope="col">Đơn giá</th>
                      <th scope="col">Số lượng</th>
                      <th scope="col">Thành tiền</th>
                      <th scope="col">Thành tiền</th>
                      
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                      <!-- <th scope="row">1</th> -->
                        <td>1</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        
                      </tr>
                      <tr>
                      <!-- <th scope="row">2</th> -->
                        <td>2</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        
                      </tr>
                      <tr>
                        <!-- <th scope="row">2</th> -->
                          <td>3</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        
                      </tr>
                      <tr>
                        <!-- <th scope="row">2</th> -->
                          <td>4</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        
                      </tr>
                      <tr>
                        <!-- <th scope="row">2</th> -->
                          <td>5</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        
                      </tr>
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
<?php
}

?>