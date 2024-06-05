<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../JavaScript/DonVi.js"></script>
  <script src="../JavaScript/LoaiSanPham.js"></script>
  <script src="../JavaScript/SanPham.js"></script>
  <title>Nhập Môn công nghệ phần mềm</title>
</head>
<body style="background-color: #D4DAE6;">
  <!-- cái bảng trắng lớn  -->
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
          <a class="nav-link" href="phieuMua.php">Phiếu mua</a>
          <a class="nav-link" href="dichVu.php">Phiếu dịch vụ</a>
          <a class="nav-link active" href="sanPham.php">Sản phẩm</a>
          <a class="nav-link" href="nhaCungCap.php">Nhà cung cấp</a>
          <a class="nav-link" href="BaoCao.php">Báo cáo</a>
        </nav>
      </div>
    </div>
    <!-- khối còn lại của bảng là màn hình thao tác gồm các tab và table... -->
    <div class="working-area">
      <div class="tab-container">
        <ul class="ul-tab">
          <li class="tab_btn active">Sản phẩm</li>
          <li class="tab_btn">Loại sản phẩm</li>
          <li class="tab_btn">Đơn vị tính</li>
        </ul>
      </div>
      <!-- khối các tab chuyển qua lại -->
      <!-- tab sản phẩm -->
      <div class="content active" id="tabSanPham">
    <div class="heading-text">
        <span>Danh mục sản phẩm</span>
    </div>
    <div class="search-box">
        <form class="form-inline" id="FormTimKiemSanPham" method="post">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control TimKiemSanPham" id="searchSanPham" placeholder="Tìm gì nè">
            </div>
            <button type="submit" class="btn btn-primary mb-2 TimKiemSanPhamBtn">Ô kê</button>
        </form>
    </div>
    <div class="primary-add-btn">
        <span onclick="togglePopupThemSP()">Thêm mới sản phẩm</span>
    </div>
    <div class="table-of-content" id="collapse1-sanpham" style="overflow-y: auto;">
    <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Mã sản phẩm</th>
              <th scope="col">Tên sản phẩm</th>
              <th scope="col">Loại sản phẩm</th>
              <th scope="col">Giá</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Thao tác</th>
            </tr>
          </thead>
          <tbody id="DanhSachSP">
            <?php include "../BackEnd/SanPham/load_sp.php" ?>
          </tbody>
        </table>
    </div>
</div>
<!-- tab loại sản phẩm -->
<div class="content" id="tabLoaisanPham" >
  <div class="heading-text">
    <span>Danh mục loại sản phẩm</span>
  </div>
  <div class="search-box">
    <form class="form-inline" method="post" id="FormTimKiemLoaiSP">
      <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control TimKiemLoaiSP" id="searchLoaiSP" placeholder="Tìm gì nè">
      </div>
      <button type="submit" class="btn btn-primary mb-2 TimKiemLoaiSPBtn">Ô kê</button>
    </form>
    </div>
      <div class="primary-add-btn">
        <span onclick="togglePopupThemLoaiSP()">Thêm mới loại sản phẩm</span>
      </div>
      <div class="table-of-content" id="collapse1-loaisanpham" style="overflow-y: auto;" >
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Mã loại sản phẩm</th>
              <th scope="col">Tên loại sản phẩm</th>
              <th scope="col">Phần trăm</th>
              <th scope="col">Đơn vị</th>
              <th scope="col">Thao tác</th>
            </tr>
          </thead>
          <tbody id="DanhSachLSP">
              <?php include "../BackEnd/LoaiSanPham/load_lsp.php" ?>
          </tbody>
        </table>
      </div>
</div>         
<!-- tab đơn vị tính -->
<div class="content" id="tabDonViTinh">
    <div class="heading-text">
        <span>Danh sách đơn vị</span>
    </div>
    <div class="search-box">
        <form class="form-inline" method="post" id="FormTimKiemDonVi">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control TimKiemDonViTinh" id="searchDonVi" placeholder="Tìm gì nè">
            </div>
            <button type="submit" class="btn btn-primary mb-2 TimKiemDonViTinhBtn">Ô kê</button>
        </form>
    </div>
    <div class="primary-add-btn">
        <span onclick="togglePopupThemDV()">Thêm mới đơn vị</span>
    </div>
    <div class="table-of-content" id="collapse1-donvitinh" style="overflow-y: auto;" >
    <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã đơn vị</th>
                    <th scope="col">Tên đơn vị</th>
                    <th scope="col">Thao tác</th>
                  </tr>
                </thead>
                <tbody id="DanhSachDV">
                      <?php  include "../BackEnd/DonVi/load_dv.php"?>
                </tbody>
              </table>
    </div>
</div>
  <!-- phần popup để hiện lên khi nhấn chỉnh sửa và thêm mới của tab SẢN PHẨM-->
  <!-- TAB SẢN PHẨM -->
  <!-- popup của chỉnh sửa -->
<div class="popup" id="popup-1">
    <div class="overlay" onclick="togglePopupChinhSua()"></div>
    <div class="content-popup chinhSua">
        <div class="form-container">
            <span>Sửa sản phẩm</span>
            <form action="" method="post" id="FormSuaSanPham">
                <div style="display: flex; justify-content: space-between;">
                    <div class="form-group">
                        <label for="maSPEdit">Mã sản phẩm</label>
                        <input type="text" class="form-control" id="maSPEdit" name="maSPEdit" placeholder="Mã sản phẩm ở đây">
                    </div>
                    <div class="form-group">
                        <label for="soluongEdit">Số lượng trong kho</label>
                        <input type="number" class="form-control" id="soluongEdit" name="soluongEdit" placeholder="Số lượng ở đây" min="0" style="width: 280px;">
                    </div>
                </div>
                <div class="ThongTinChinhSua">
                    <span>Điền thông tin chỉnh sửa</span>
                    <input type="text" class="form-control EditText1" id="tenSPEdit" name="tenSPEdit" placeholder="Tên sản phẩm ở đây">
                    <input type="number" class="form-control EditText2" id="giaEdit" name="giaEdit" placeholder="Giá" min="1">
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-primary complete" id="complete">Xong</button>
                    <button type="button" class="btn btn-primary close" onclick="togglePopupChinhSua()">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Popup them san pham -->
<div class="popup" id="popup-2">
    <div class="overlay"></div>
    <div class="content-popup themMoi">
        <div class="form-container">
            <span>Thêm sản phẩm mới</span><br>
            <span class="annouce">Nhập đầy đủ vào ô bên dưới</span>
            <form id="FormThemSanPham" method="post" class="form-them" action="">
                <div class="form-group">
                    <label>Loại sản phẩm</label>
                    <select id="themTenLoaiSP" name="tenloaiSP" class="form-select" aria-label="Default select example">
                    </select>
                </div>
                <input type="text" class="form-control" id="themtenSP" name="tenSP" placeholder="Tên sản phẩm ở đây" required>
                <input type="number" class="form-control" id="themgia" name="gia" min="1" placeholder="Giá" required>
                <input type="number" class="form-control" id="themsoluong" name="soluong" min="0" placeholder="Số lượng trong kho" required>
                <div class="button">
                    <button type="submit" class="btn btn-primary complete" id="complete" style="margin-top: -65px;">Xong</button>
                </div>
            </form>
            <button class="btn btn-primary close" onclick="togglePopupThemSP()">Đóng</button>
        </div>
    </div>
</div>
  <!-- POP UP CỦA TAB LOẠI SP -->
  <!-- phần popup của tab Loại sản phẩm cho nút thêm loại sản phẩm, và nút chỉnh sửa loại -->
 <!-- popup của Chỉnh sửa loại sản phẩm -->
<div class="popup" id="popup-3">
  <div class="overlay" onclick="togglePopupSuaLoaiSP()"></div>
  <div class="content-popup chinhSua">
    <div class="form-container">
      <span>Sửa loại sản phẩm</span>
      <form id="FormSuaLoaiSanPham" action="" method="post">
        <div class="form-group">
          <label for="maLoaiSPEdit">Mã loại sản phẩm</label>
          <input type="text" class="form-control" id="maLoaiSPEdit" name="maLoaiSPEdit" placeholder="Mã loại sản phẩm ở đây">
        </div>
        <div class="ThongTinChinhSua" style="height: 285px;" >
          <span>Điền thông tin chỉnh sửa</span>
          <input type="text" class="form-control EditText1" id="tenLoaiSPEdit" name="tenLoaiSPEdit" placeholder="Tên loại sản phẩm ở đây">
          <input type="text" class="form-control EditText2" id="phanTramEdit" name="phanTramEdit" placeholder="Phần trăm lợi nhuận">
          <select id="SuaDVTinh" name="dvtinhEdit" class="form-select" aria-label="Default select example">
          </select>
        </div>
        <div class="button">
          <button type="submit" class="btn btn-primary complete" id="complete">Xong</button>
          <button type="button" class="btn btn-primary close" onclick="togglePopupSuaLoaiSP()">Đóng</button>
        </div>
      </form>
    </div>
  </div>
</div>
 <!-- popup của thêm mới loại sản phẩm -->
<div class="popup" id="popup-4">
  <div class="overlay"></div>
  <div class="content-popup themMoi">
    <div class="form-container">
      <span>Thêm loại sản phẩm mới</span><br>
      <span class="annouce">Nhập đầy đủ vào ô bên dưới</span>
      <form id="FormThemLoaiSanPham" action="" method="post" class="form-them">
        <div class="form-group">
          <label>Đơn vị</label>
          <select id="themLoaiDonVi" name="dvtinh" class="form-select" aria-label="Default select example">
          </select>
        </div>
        <input type="text" class="form-control" id="themloaiSP" name="tenLoaiSP" placeholder="Tên loại sản phẩm ở đây">
        <input type="text" class="form-control" id="themphanTram" name="phanTram" placeholder="Phần trăm lợi nhuận">
        <div class="button">
          <button type="submit" class="btn btn-primary complete" id="complete">Xong</button>
        </div>
      </form>
      <button class="btn btn-primary close" onclick="togglePopupThemLoaiSP()">Đóng</button>
    </div>
  </div>
</div>
  <!-- POPUP cho tab DON VI -->
<!-- popup của Sửa đơn vị -->
<div class="popup" id="popup-5">
  <div class="overlay" onclick="togglePopupSuaDV()"></div>
  <div class="content-popup chinhSua">
    <div class="form-container">
      <span>Sửa đơn vị</span>
      <form id="FormChinhSuaDonVi" action="" method="post">
        <div class="form-group">
          <label for="maDVEdit">Mã đơn vị</label>
          <input type="text" class="form-control" id="maDVEdit" name="maDVEdit" placeholder="Mã đơn vị ở đây">
        </div>
        <div class="ThongTinChinhSua">
          <span>Điền thông tin chỉnh sửa</span>
          <input type="text" class="form-control EditText1" id="TenDVEdit" name="tenDVEdit" placeholder="Tên đơn vị ở đây">
        </div>
        <div class="button">
          <button type="submit" class="btn btn-primary complete" id="complete">Xong</button>
          <button type="button" class="btn btn-primary close" onclick="togglePopupSuaDV()">Đóng</button>
        </div>
      </form>
    </div>
  </div>
</div>
  <!-- thêm đơn vị -->
<div class="popup" id="popup-6">
  <div class="overlay"></div>
  <div class="content-popup themMoi">
      <div class="form-container">
          <span>Thêm loại đơn vị mới</span><br>
          <span class="annouce">Nhập đầy đủ vào ô bên dưới</span>
          <form id="FormThemDonVi" action="../BackEnd/DonVi/add_dv.php" method="post" class="form-them">
              <input type="text" class="form-control" id="themDonVi" name="TenDV" placeholder="Tên đơn vị mới">
              <button type="submit" class="btn btn-primary complete" id="complete">Xong</button>
          </form>
      </div>
  </div>
</div>
<script>
    const tabs = document.querySelectorAll('.tab_btn');
    const all_content = document.querySelectorAll('.content');
    tabs.forEach((tab, index) => {
      tab.addEventListener('click', () => {
        tabs.forEach(tab => { tab.classList.remove('active') })
        tab.classList.add('active');

        all_content.forEach(content => { content.classList.remove('active') });
        all_content[index].classList.add('active');
      })
    })
// Popup toggling functions
function togglePopupChinhSua() {
  document.getElementById("popup-1").classList.toggle("active");
};
function togglePopupThemSP() {
  document.getElementById("popup-2").classList.toggle("active");
};
function togglePopupThemLoaiSP() {
  document.getElementById("popup-4").classList.toggle("active");
  loadUnitNames('#themLoaiDonVi');
};
function togglePopupSuaLoaiSP(maLoaiSP = null, tenLoaiSP = null, phanTram = null, dvtinh = null) {
    const popup = document.getElementById("popup-3");
    // Đóng các popup khác
    document.querySelectorAll('.popup').forEach(p => {
        if (p !== popup) {
            p.classList.remove('active');
        }
    });
    popup.classList.toggle("active");
    if (popup.classList.contains("active")) {
        // Load data into form fields
        $('#maLoaiSPEdit').val(maLoaiSP);
        $('#tenLoaiSPEdit').val(tenLoaiSP);
        $('#phanTramEdit').val(phanTram);
        // Load unit names and set the current value
        loadUnitNames('#SuaDVTinh');
        $('#SuaDVTinh').val(dvtinh);
    }
}
function togglePopupSuaDV(maDV = null, tenDV = null) {
    const popup = document.getElementById("popup-5");

    // Đóng các popup khác
    document.querySelectorAll('.popup').forEach(p => {
        if (p !== popup) {
            p.classList.remove('active');
        }
    });

    popup.classList.toggle("active");

    if (popup.classList.contains("active")) {
        // Load data into form fields
        $('#maDVEdit').val(maDV);
        $('#TenDVEdit').val(tenDV);
    }
}
function togglePopupThemDV() {
  document.getElementById("popup-6").classList.toggle("active");
};
</script>
</body>
</html>