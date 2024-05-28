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
                  <input type="text" class="form-control" style="margin-right: 40px;" name="search_keyword" id="TimKiem" placeholder="Tìm kiếm" required />
                </div>
                <button type="submit" class="btn btn-primary" style="margin: 0px 42px;">Tìm</button>
                        <button type="button" class="btn btn-secondary" onclick="resetSearch()">X</button>
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
<div class="overlay-edit" id="overlay-edit"></div>
<div class="popup-edit" id="popup-2">
        <button class="close-btn-edit" onclick="closeEditPopup()">×</button>
        <div class="form-container-edit">
            <div class="header-edit">
                <label class="text1">Chỉnh sửa dịch vụ</label>

            </div>
            <form method="post" action="../DichVu/editDV.php">
                <div class="grid-container-edit">
                    <div class="mb-3 half-width-edit">
                        <p class="id-display">Chỉnh sửa thông tin: <span id="edit-id-display"></span></p>
                    </div>
                    <div class="separator-edit"></div>
                    <div class="mb-3">
                        <div class="nested-container-edit">
                            <input type="text" class="form-control" name="ten" id="edit-TenLoai" placeholder="Tên dịch vụ" required />
                            <input type="text" class="form-control" name="gia" id="edit-DonGia" placeholder="Đơn giá" required />
                        </div>
                    </div>
                </div>
                <div class="btn-dong-edit">
                    <button class="btn btn-primary" type="submit">Xong</button>
                </div>
            </form>
        </div>
    </div>

         
    <div id="confirm-popup" class="confirm-popup" style="display: none;">
        <p>Bạn có chắc chắn muốn xóa dịch vụ này không?</p>
        <button id="confirm-yes" class="btn btn-danger">Có</button>
        <button id="confirm-no" class="btn btn-secondary">Không</button>
    </div>
    <div id="confirm-overlay" class="confirm-overlay" style="display: none;"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../JavaScript/DMDV.js"></script>
</body>

</html>
<?php
}

?>