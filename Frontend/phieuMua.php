<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/stylePhieuMua.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <title>Nhập Môn công nghệ phần mềm</title>
</head>

<body style="background-color: #d4dae6">
  <div id="main-container">
    <div id="nav-bar-ne">
      <div id="logo">
        <a href="PhieuBan.html" style="text-decoration: none">
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
          <li class="tab_btn active">
            <a href="phieuMua.html" style="text-decoration: none">Lập phiếu</a>
          </li>
          <li class="tab_btn">
            <a href="../Frontend/traCuuPhieuMua.php" style="text-decoration: none">Tra cứu</a>
          </li>
        </ul>
      </div>
      <form class="content active" id="tabLapPhieu" action="nehe.php" method="post">
        <div class="heading-text">
          <span>Lập phiếu mua hàng</span><br />
          <label for="">Ngày lập: <?php echo date('d/m/Y'); ?></label>
        </div>
        <button type="button" class="btn btn-primary" style="margin-top: 90px; margin-bottom: -80px; margin-left: 35px;" onclick="togglePopupChonNCC()">
            Chọn NCC
          </button>
        <div class="btn-and-labels" style="width: 850px">
          <label for="" class="info tenCTY" style="margin-left: 10px;">Nhà cung cấp: </label>
          <label for="" class="info diaChi" style="margin-left: 2px;">Địa chỉ: </label>
          <label for="" class="info SDT" style="margin-left: 2px;">Số điện thoại: </label>
        </div>
        <div class="table-of-content">
          <div class="heading-part">
            <label for="" class="secondary-heading">Giỏ hàng</label>
            <button type="button" class="btn btn-primary" onclick="togglePopupThemGioHang()">
              +
            </button>
          </div>
          <div class="scroll-table" id="collapse3" style="overflow-y: scroll; height: 260px">
            <table class="table table-hover table-bordered product-table">
              <?php
              session_start();
              if (isset($_SESSION['selected_products']) && count($_SESSION['selected_products']) > 0) : ?>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                    <th scope="col">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($_SESSION['selected_products'] as $index => $product) : ?>
                    <tr>
                      <td><?php echo htmlspecialchars($index + 1); ?></td>
                      <td><?php echo htmlspecialchars($product['name']); ?></td>
                      <td><?php echo htmlspecialchars($product['unit_price']); ?></td>
                      <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                      <td><?php echo htmlspecialchars($product['total_price']); ?></td>
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
          <div class="label-sl-sp-price-btn">
            <label for="" class="count-total" style="margin-left: 420px;">Tổng thanh toán (<?php echo count($_SESSION['selected_products'] ?? []); ?> sản phẩm)</label>
            <label for="" class="price-total">
              <?php
              $total_price = array_sum(array_column($_SESSION['selected_products'] ?? [], 'total_price'));
              echo number_format($total_price, 0, ',', '.');
              ?>
            </label>
            <button type="button" class="btn btn-primary" id="LapPhieu" onclick="submitForm()" method="post" action="../Backend_TraCuu/purchase_orders.php">
              Lập phiếu
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>



  <div class="popup" id="popup-2">
    <div class="overlay"></div>
    <div class="content-popup chinhSua">
      <div class="form-container">
        <div class="ncc Head-of-table">
          <span>Thêm sản phẩm</span>
          <div class="search-box">
            <form class="form-inline" id="data-product">
              <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" style="margin-right: 60px;" name="search_keyword_product" id="TimKiemProduct" placeholder="Tìm sản phẩm">
              </div>
              <button type="submit" class="btn btn-primary mb-2" style="margin-right: 60px;">Tìm</button>
              <button type="button" class="btn btn-secondary" onclick="resetSearchProduct(event)">Hủy</button>
            </form>
          </div>
        </div>
        <div style="width: 920px; overflow-y: scroll;" class="table-of-content" id="result-product">
          <table class="table table-hover table-bordered" style="width: 920px">
            <?php include '../Backend_PM/products.php'; ?>
          </table>
        </div>
        <div class="ncc close-footer">
          <button class="btn btn-primary close" onclick="togglePopupThemGioHang()">
            Đóng
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="popup" id="popup-1">
    <div class="overlay"></div>
    <div class="content-popup chinhSua">
      <div class="form-container">
        <span>Chọn nhà cung cấp</span>
        <div style="margin-top: 30px" class="search-box">
          <form class="form-inline" id="data-container">
            <div class="form-group mx-sm-3 mb-2">
              <input type="text" class="form-control" style="margin-right: 60px;" name="search_keyword_ncc" id="TimKiemNcc" placeholder="Tìm nhà cung cấp">
            </div>
            <button type="submit" class="btn btn-primary" style="margin-right: 60px;">Tìm</button>
            <button type="button" class="btn btn-secondary" onclick="resetSearch(event)">Hủy</button>
          </form>
        </div>

        <div style="width: 920px; overflow-y: scroll;" class="table-of-content" id="result-container">
          <?php include '../Backend_PM/display_pm.php'; ?>
        </div>
        <div class="ncc close-footer">
          <button class="btn btn-primary close" onclick="togglePopupChonNCC()">
            Đóng
          </button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Thêm thư viện jQuery -->
  <script src="../JavaScript/JS_PM.js"></script>
</body>

</html>