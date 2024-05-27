<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/style_DMDV.css">
  <link rel="stylesheet" href="../css/style_danhMucDV.css">
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
                  <a class="nav-link active" href="./dichVu.php">Phiếu dịch vụ</a>
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
                    <li class="tab_btn ">
                      <a href="dichVu.php"
                      style="text-decoration: none;">Lập phiếu</a></li>
                    <li class="tab_btn"><a href="traCuuDichVu.php"
                        style="text-decoration: none;">Tra cứu</a></li>
                        <li class="tab_btn active"><a href="danhMucDichVu.php"
                          style="text-decoration: none;">Danh mục dịch vụ</a></li>
                  </ul>
              </div>

            <div class="content active" id="tabDonViTinh">
              <div class="heading-text">
                <button type="button" class="btn NCC" data-bs-toggle="button" onclick="togglePopupThemNCC()">Thêm loại dịch vụ mới</button>
                
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
               <?php include "../DichVu/displayDV.php"; ?>
              </div>
            </div>
            </div>
          </div>
            
        </div>
        <!-- popup của thêm nhà cung cấp -->
        <div class="popup" id="popup-1">
          <div class="overlay"></div>
          <div class="content-popup traCuu">
            <div class="form-container">
              <div class="header">
                <label class="text1">Thêm loại dịch vụ</label>
                <label class="text2">Nhập thông tin dưới</label>
              </div>

              <div class="mb-3">
                <input type="text" class="form-control" id="Ten" placeholder="Tên Loại dịch vụ">
              </div>

              

              <div class="thongKh">
                <input type="text" class="form-control" id="Diachi" placeholder="Giá">
                
              </div>    
 

            
              

             
              <div class="btn-dong">
                <button class="btn btn-primary" type="submit" onclick="togglePopupThemNCC()">Xong</button>
              </div>
              
            </div>
          </div>
        </div>
      
<!-- popup của chỉnh sửa nhà cung cấp -->
<div class="popup" id="popup-2">
    <div class="overlay"></div>
    <div class="content-popup traCuu">
      <div class="form-container">
        <div class="header">
          <label class="text1">Thêm nhà cung cấp</label>
          <label class="text2">Nhập thông tin dưới</label>
        </div>


        <div class="grid-container">
            <div class="mb-3 half-width">
                <input type="text" class="form-control" id="maNCC" placeholder="Mã nhà cung cấp">
            </div>
            <div class="separator"></div>
            <div class="mb-3">
              <div class="nested-container">
                  <input type="text" class="form-control" id="Ten" placeholder="Tên Nhà Cung Cấp">
                  <input type="text" class="form-control" id="Diachi" placeholder="Địa Chỉ Nhà Cung Cấp">
                  <input type="text" class="form-control" id="SDT" placeholder="Số Điện Thoại Nhà Cung Cấp">
              </div>
          </div>
      </div>
         
        
        

       
        <div class="btn-dong">
          <button class="btn btn-primary" type="submit" onclick="togglePopupChiTiet_TTPM()">Xong</button>
        </div>
        
      </div>
    </div>
  </div>

        <script>
      
          // popup
          function togglePopupThemNCC(){
            document.getElementById("popup-1").classList.toggle("active");
          };
          // popup 2
          function togglePopupChiTiet_TTPM(){
            document.getElementById("popup-2").classList.toggle("active");
          };
        </script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/DMDV.js"></script> <!-- Nhúng tệp JavaScript vào trang -->
      </body>
</html>