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
                <label for="">Ngày lập: <?php echo date('d/m/Y'); ?></label>
    </div>
    <div class="btn-and-labels">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" id="TenKhachHang" name="KhachHang" placeholder="Tên khách hàng">
            <input type="text" class="form-control" id="SoDienThoai" name="SDT" placeholder="Số điện thoại">
        </div>
        <div class="form-group mx-sm-3 mb-1">
        <label for="">Quy định trả trước tối thiểu 50%, thay đổi</label>
    <input type="text" class="form-control" id="Sale" placeholder="50%">
    <button type="button" class="btn btn-primary" onclick="updateSale()">Cập nhật</button>
        </div>
    </div>
    
    <div class="table-of-content">
    <div class="heading-part">
        <label for="" class="secondary-heading">Dịch vụ</label>
        <button type="button" class="btn btn-primary" onclick="togglePopupThemGioHang()">Thêm</button>
    </div>
    <div class="scroll-table" id="collapse1">
        <table class="table table-hover table-bordered">
            <?php if (isset($_SESSION['selectdv']) && count($_SESSION['selectdv']) > 0) : ?>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã loại dịch vụ</th>
                    <th scope="col">Loại dịch vụ</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                    <th scope="col">Trả trước</th>
                    <th scope="col">Còn lại</th>
                    <th scope="col">Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['selectdv'] as $index => $dv) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($index + 1); ?></td>
                    <td><?php echo htmlspecialchars($dv['ID']); ?></td>
                    <td><?php echo htmlspecialchars($dv['TenLoai']); ?></td>
                    <td><?php echo htmlspecialchars($dv['DonGia']); ?></td>
                    <td>
                        <input type="number" class="form-control so-luong" id="SoLuong_<?php echo $index; ?>" value="<?php echo htmlspecialchars($dv['SoLuong']); ?>" data-dongia="<?php echo htmlspecialchars($dv['DonGia']); ?>" data-index="<?php echo $index; ?>">
                    </td>
                    <td>
                        <span class="thanh-tien" id="ThanhTien_<?php echo $index; ?>" style="font-size: 16px; color: blue;">
                        <?php echo number_format($dv['ThanhTien'], 2, ',', '.'); ?>
                      </span>
                    </td>
                    <td>
                        <span class="tra-truoc" id="TraTruoc_<?php echo $index; ?>" style="font-size: 16px; color: blue;">
                    </span>                        
                    </td>
                    <td>
                        <span class="con-lai" id="ConLai_<?php echo $index; ?>" style="font-size: 16px; color: blue;">
                        </span>
                    </td>
                    <td><button type="button" class="btn btn-danger delete-dv" data-index="<?php echo $index; ?>">-</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <?php else : ?>
            <p>Không có dịch vụ nào được chọn.</p>
            <?php endif; ?>
        </table>
    </div>
</div>
<div class="total-price-panel">
        <div class="label-sl-sp-price-btn">
            <label for="" class="count-total" style="margin-left: 420px;">Tổng thanh toán (<?php echo count($_SESSION['selectdv'] ?? []); ?> dịch vụ)</label>
            <label for="" class="price-total">
                <?php
                $total_price = array_sum(array_column($_SESSION['selectdv'] ?? [], ''));
                echo number_format($total_price, 2, ',', '.');
                ?>
            </label>
            <button type="button" class="btn btn-primary" id="LapPhieu" onclick="submitForm()" method="post" action="../BackEnd_TraCuuPDV/dv_orders.php">
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
                    <span>Thêm dịch vụ</span>
                    <div class="search-box">
                    <form class="form-inline" id="data-dv">
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" style="margin-right: 60px;" name="search_keyword_dv" id="TimKiemdv" placeholder="Tìm dịch vụ">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2" style="margin-right: 60px;">Tìm</button>
                <button type="button" class="btn btn-secondary" onclick="resetSearchdv(event)">Hủy</button>
              </form>
                    </div>
                </div>
                <div style="width: 920px; overflow-y: scroll;" class="table-of-content" id="result-dv">
                    <table class="table table-hover table-bordered" style="width: 920px;">
                        <?php include '../BackEnd_PDV/DSDV.php'; ?>
                    </table>
                </div>
                <div class="ncc close-footer">
                    <button class="btn btn-primary close" onclick="togglePopupThemGioHang()">Đóng</button>
                </div>
            </div>
        </div>
    </div>
   
          <div class="ncc close-footer">
            <button class="btn btn-primary close" onclick="togglePopupChonNCC()">
              Đóng
            </button>
          </div>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Thêm thư viện jQuery -->
    <script src="../JavaScript/JS_PDV.js"></script>
    <script>
function submitForm() {
    const formData = new FormData(); // Tạo một đối tượng FormData

    formData.append('KhachHang', document.getElementById('TenKhachHang').value);
    formData.append('SDT', document.getElementById('SoDienThoai').value);
    formData.append('ThanhTien', calculateTotalPrice());

    const dvList = <?php echo json_encode($_SESSION['selectdv'] ?? []); ?>;
    formData.append('DSDV', JSON.stringify(dvList)); // Chuyển đổi danh sách dịch vụ thành chuỗi JSON và thêm vào FormData

    fetch('../BackEnd_TraCuuPDV/save_dv_order.php', {
        method: 'POST',
        body: formData // Truyền FormData vào fetch
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Phiếu đã được lập thành công!');
            location.reload(); // Reload the page to update the service list
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert('Có lỗi xảy ra, vui lòng thử lại sau.');
        console.error('Error:', error);
    });
}


function calculateTotalPrice() {
    const dvList = <?php echo json_encode($_SESSION['selectdv'] ?? []); ?>;
    let totalPrice = 0;
    dvList.forEach(dv => {
        totalPrice += dv.ThanhTien;
    });
    return totalPrice;
}

</script>


  </body>
  </html>
<?php
}
?>