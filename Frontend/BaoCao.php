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
  <link rel="stylesheet" href="../css/styleBC.css">
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
    </script>
</head>
<body style="background-color: #D4DAE6;">
    <!-- cái bảng trắng lớn -->
    <div id="main-container">
      <!-- khối nav bar dọc gồm logo và navbar-->
      <div id="nav-bar-ne">
        <div id="logo">
          <a href="PhieuBan.html" style="text-decoration: none;">
            <span>Kimberly</span>
          </a>
        </div>
        <!-- khối navbar -->
        <div class="nav_ne">
          <nav class="nav flex-column">
            <a class="nav-link" href="phieuBan.html">Phiếu bán</a>
            <a class="nav-link " href="phieuMua.html">Phiếu mua</a>
            <a class="nav-link" href="dichVu.html">Phiếu dịch vụ</a>
            <a class="nav-link" href="sanPham.html">Sản phẩm</a>
            <a class="nav-link" href="nhaCungCap.html">Nhà cung cấp</a>
            <a class="nav-link active" href="BaoCao.html">Báo cáo</a>
          </nav>
        </div>
      </div>
  
      <!-- khối còn lại của bảng là màn hình thao tác gồm các tab và table... -->
      <div class="working-area">
        <div class="tab-container">
            <ul class="ul-tab">
             
              <li class="tab_btn active"><a href="traCuuPhieuBan.html"
                  style="text-decoration: none;">Báo cáo tồn kho</a></li>
            </ul>
        </div>

        <div class="logout_button">
            <button type="button" class="btn btn-danger" href="../Form_login/logout.php"
            style=
            " position: absolute;
              top: 45px;
              right: 50px;
            "
            onclick="navigate()"
            >Log out</button>
          </div>

        <!-- khối các tab chuyển qua lại -->
        <!-- tab lập phiếu -->
        <form class="content active" id="tabLapPhieu" action="nehe.php" method="post">
           
            <div class="btn-and-labels">
                <!-- <span onclick="togglePopupThemSP()">Thêm mới sản phẩm</span> -->
                <div class="form-group mx-sm-3 mb-2">
                    <input type="month" class="form-control" id="thang" name="thang">
                  </div>
                  
            </div>
            <div class="table-of-content"> <!--id="collapse1"-->
                <div class="heading-part">
                    
                    
                </div>
                
                <div class="scroll-table" id="collapse1">
                  <table class="table table-hover table-bordered" >
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Tồn đầu</th>
                        <th scope="col">Mua vào</th>
                        <th scope="col">Bán ra</th>
                        <th scope="col">Tồn cuối</th>
                        <th scope="col">Đơn vị</th>
                        
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
                          
                        </tr>
                        <tr>
                            <!-- <th scope="row">2</th> -->
                            <td>6</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                          <td>-</td>    
                            
                          </tr>
                          <tr>
                            <!-- <th scope="row">2</th> -->
                            <td>7</td>
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
                
            </div>

            <div class="total-price-panel">
                <button type="button" class="btn btn-primary" id="close" >Tải xuống</button>
                <div class="label-sl-sp-price-btn">
                  
                  <button type="submit" class="btn btn-primary" id="LapPhieu" >Cập nhật báo cáo</button>
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
                  <tr>
                  <!-- <th scope="row">1</th> -->
                    <td>1</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <button type="button" class="btn ChiTiet" data-bs-toggle="button"
                        onclick="togglePopupChinhSua()">Thêm vào giỏ</button>
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
                        onclick="togglePopupChinhSua()">Thêm vào giỏ</button>
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
                          onclick="togglePopupChinhSua()">Thêm vào giỏ</button>
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
                        onclick="togglePopupChinhSua()">Thêm vào giỏ</button>
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
                        onclick="togglePopupChinhSua()">Thêm vào giỏ</button>
                    </td>
                  </tr>
              </tbody>
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
      function navigate() {
                window.location.href = '../Form_login/logout.php';
            };
      
    </script>

</body>
</html>
<?php
}

?>