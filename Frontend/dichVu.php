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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/styleDV.css">
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
            <a class="nav-link " href="phieuBan.php">Phiếu bán</a>
            <a class="nav-link " href="phieuMua.php">Phiếu mua</a>
            <a class="nav-link active " href="dichVu.php">Phiếu dịch vụ</a>
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
              <li class="tab_btn active">
                <a href="dichVu.php" style="text-decoration: none;">Lập phiếu</a>
              </li>
              <li class="tab_btn"><a href="traCuuDichVu.php"
                  style="text-decoration: none;">Tra cứu</a></li>
                  <li class="tab_btn"><a href="frontend/traCuuDichVu.php"
                    style="text-decoration: none;">Danh mục dịch vụ</a></li>
            </ul>
        </div>

        

        <!-- khối các tab chuyển qua lại -->
        <!-- tab lập phiếu -->
        <form class="content active" id="tabLapPhieu" action="nehe.php" method="post">
            <div class="heading-text">
                <span>Lập phiếu dịch vụ</span><br>
                <labe for="">Ngày lập: <?php echo date('d/m/Y');?></label>
            </div>
            <div class="btn-and-labels">
                <!-- <span onclick="togglePopupThemSP()">Thêm mới sản phẩm</span> -->
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" id="TimKiem" placeholder="Tên khách hàng">
                    
                    <input type="text" class="form-control" id="TimKiemSDT" placeholder="Số điện thoại">
                  </div>
                  <div class="form-group mx-sm-3 mb-1">
                    <label for="">quy định trả trước tối thiểu 50%, thay đổi</label>
                    <input type="text" class="form-control" id="Sale" placeholder="50%">

                    <button type="button" class="btn btn-primary" >Cập nhật</button>
                  </div>
                
            </div>
            <div class="table-of-content"> <!--id="collapse1"-->
                <div class="heading-part">
                    <label for="" class="secondary-heading">Dịch vụ</label>
                    <button type="button" class="btn btn-primary" onclick="togglePopupThemGioHang()">Thêm</button>
                </div>
                
                <div class="scroll-table" id="collapse1">
                  <table class="table table-hover table-bordered" >
                  <?php
              if (isset($_SESSION['selectedDV']) && count($_SESSION['selectedDV']) > 0) : ?>
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">loại dịch vụ</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Còn lại</th>
                        <th scope="col">Tùy chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($_SESSION['selectedDV'] as $index => $service) : ?>
                    <tr>
                      <td><?php echo htmlspecialchars($index + 1); ?></td>
                      <td><?php echo htmlspecialchars($service['LoaiDV']); ?></td>
                      <td><?php echo htmlspecialchars($service['DonGia']); ?></td>
                      <td><?php echo htmlspecialchars($service['SoLuong']); ?></td>
                      <td><?php echo htmlspecialchars($service['TongTien']); ?></td>
                      <td><button type="button" class="btn btn-danger delete-product" data-index="<?php echo $index; ?>">-</button></td>
                    </tr>
                  <?php endforeach; ?>
                    </tbody>
                    <?php else : ?>
                <p>Không có sản phẩm nào được chọn.</p>
              <?php endif; ?>
                  </table>
                </div>
                
            </div>

            <div class="total-price-panel">
                <button type="button" class="btn btn-primary" id="close" onclick="togglePopupThemSP()">X</button>
                <div class="label-sl-sp-price-btn">
                  <label for="" class="count-total">Tổng thanh toán (3 dịch vụ)</label>
                  <label for="" class="price-total">76.090.999</label>
                  <button type="submit" class="btn btn-primary" id="LapPhieu" onclick="togglePopupThemSP()">Lập phiếu</button>
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
              <form class="form-inline" method="post">
                <div class="form-group mx-sm-3 mb-2">
                  <input type="text" class="form-control" id="TimKiem" placeholder="Tìm kiếm">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Tìm</button>
              </form>
            </div>
          </div>

          <div class="ncc table-part scroll-table" id="collapse1">
            <table class="table table-hover table-bordered" style="width: 920px;">
            <?php include '../DichVu/displayDV.php'; ?>
            </table>
          </div>

          <div class="ncc close-footer">
            <button class="btn btn-primary close" onclick="togglePopupThemGioHang()">Đóng</button>
          </div>

        </div>

  
      </div>
    </div>

    <div class="popup" id="popup-1">
      <div class="overlay"></div>
      <div class="content-popup chinhSua">
        <div class="form-container">
          <div class="ncc Head-of-table">
            <span>Chọn nhà cung cấp</span>
            <div class="search-box">
              <form class="form-inline" method="post">
                <div class="form-group mx-sm-3 mb-2">
                  <input type="text" class="form-control" id="TimKiem" placeholder="Tìm gì nè">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Ô kê</button>
              </form>
            </div>
          </div>

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
              <tbody>
                  <tr>
                  <!-- <th scope="row">1</th> -->
                    <td>1</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <button type="button" class="btn ChiTiet" data-bs-toggle="button"
                        onclick="togglePopupChinhSua()">Chọn</button>
                    </td>
                  </tr>
                  <tr>
                  <!-- <th scope="row">2</th> -->
                    <td>2</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>    
                    <td>
                        <button type="button" class="btn ChiTiet" data-bs-toggle="button"
                        onclick="togglePopupChinhSua()">Chọn</button>
                    </td>
                  </tr>
                  <tr>
                    <!-- <th scope="row">2</th> -->
                      <td>3</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>    
                      <td>
                          <button type="button" class="btn ChiTiet" data-bs-toggle="button"
                          onclick="togglePopupChinhSua()">Chọn</button>
                      </td>
                  </tr>
                  <tr>
                    <!-- <th scope="row">2</th> -->
                    <td>4</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>    
                    <td>
                        <button type="button" class="btn ChiTiet" data-bs-toggle="button"
                        onclick="togglePopupChinhSua()">Chọn</button>
                    </td>
                  </tr>
                  <tr>
                    <!-- <th scope="row">2</th> -->
                    <td>5</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>    
                    <td>
                        <button type="button" class="btn ChiTiet" data-bs-toggle="button"
                        onclick="togglePopupChinhSua()">Chọn</button>
                    </td>
                  </tr>
              </tbody>
            </table>
          </div>

          <div class="ncc close-footer">
            <button class="btn btn-primary close" onclick="togglePopupChonNCC()">Đóng</button>
          </div>

        </div>

        


      </div>
    </div>

    <script>
      // popup
      function togglePopupThemGioHang(){
        document.getElementById("popup-2").classList.toggle("active");
      };

      function togglePopupChonNCC(){
        document.getElementById("popup-1").classList.toggle("active");
      };
    </script>

</body>
</html>
<?php
}

?>