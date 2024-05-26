<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/styleNCC.css" />
    <link rel="stylesheet" href="../css/style_nhaCungCap.css" />
    <link rel="stylesheet" href="../css/NCC_CSS/NCC_php.css" />
    <link rel="stylesheet" href="../css/NCC_CSS/ncc_php_edit.css" />
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
                    <a class="nav-link" href="phieuBan.html">Phiếu bán</a>
                    <a class="nav-link" href="./phieuMua.php">Phiếu mua</a>
                    <a class="nav-link" href="dichVu.html">Phiếu dịch vụ</a>
                    <a class="nav-link" href="sanPham.html">Sản phẩm</a>
                    <a class="nav-link active" href="nhaCungCap.html">Nhà cung cấp</a>
                    <a class="nav-link" href="BaoCao.html">Báo cáo</a>
                </nav>
            </div>
        </div>
        <div class="working-area">
            <div class="tab-container">
                <ul class="ul-tab">
                    <li class="tab_btn active">
                        <a href="" style="text-decoration: none">Danh mục nhà cung cấp</a>
                    </li>
                </ul>
            </div>
            <div class="content active" id="tabDonViTinh">
                <div class="heading-text">
                    <button type="button" class="btn NCC" data-bs-toggle="button" onclick="togglePopupThemNCC()">
                        Thêm nhà cung cấp
                    </button>
                </div>

                <div class="search-box">
                    <form class="form-inline" id="search-form">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" style="margin-right: 40px;" name="search_keyword" id="TimKiem" placeholder="Tìm kiếm" required />
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin: 0px 42px;">Tìm</button>
                        <button type="button" class="btn btn-secondary" onclick="resetSearch()">X</button>
                    </form>
                </div>

                <div class="table-of-content" id="collapse3">
                    <?php include '../Backend_NCC/display_suppliers.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup for Adding Supplier -->
    <div class="popup" id="popup-1">
        <div class="overlay" onclick="togglePopupThemNCC()"></div>
        <div class="content-popup traCuu">
            <button class="close-btn" onclick="togglePopupThemNCC()">×</button>
            <div class="form-container">
                <div class="header">
                    <label class="text1">Thêm nhà cung cấp</label>
                    <label class="text2">Nhập thông tin dưới</label>
                </div>
                <form method="post" action="../Backend_NCC/add_supplier.php">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="MaNCC" placeholder="Mã Nhà Cung Cấp" required />
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="Ten" placeholder="Tên Nhà Cung Cấp" required />
                    </div>
                    <div class="thongKh">
                        <input type="text" class="form-control" name="Diachi" placeholder="Địa Chỉ Nhà Cung Cấp" required />
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="SDT" placeholder="Số Điện Thoại Nhà Cung Cấp" required />
                    </div>
                    <div class="btn-dong">
                        <button class="btn btn-primary" type="submit">Xong</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Popup for Editing Supplier -->
    <div class="overlay-edit" id="overlay-edit"></div>

    <!-- Popup for Editing Supplier -->
    <div class="popup-edit" id="popup-2">
        <button class="close-btn-edit" onclick="closeEditPopup()">×</button>
        <div class="form-container-edit">
            <div class="header-edit">
                <label class="text1">Chỉnh sửa nhà cung cấp</label>

            </div>
            <form method="post" action="../Backend_NCC/edit_supplier.php">
                <div class="grid-container-edit">
                    <div class="mb-3 half-width-edit">
                        <p class="id-display">Chỉnh sửa thông tin: <span id="edit-id-display"></span></p>
                        <input type="text" class="form-control" name="id" id="edit-id" placeholder="Mã nhà cung cấp" readonly />
                    </div>
                    <div class="separator-edit"></div>
                    <div class="mb-3">
                        <div class="nested-container-edit">
                            <input type="text" class="form-control" name="MaNCC" id="edit-MaNCC" placeholder="Mã Nhà Cung Cấp" required />
                            <input type="text" class="form-control" name="ten" id="edit-ten" placeholder="Tên Nhà Cung Cấp" required />
                            <input type="text" class="form-control" name="diachi" id="edit-diachi" placeholder="Địa Chỉ Nhà Cung Cấp" required />
                            <input type="text" class="form-control" name="sdt" id="edit-sdt" placeholder="Số Điện Thoại Nhà Cung Cấp" required />
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
        <p>Bạn có chắc chắn muốn xóa nhà cung cấp này không?</p>
        <button id="confirm-yes" class="btn btn-danger">Có</button>
        <button id="confirm-no" class="btn btn-secondary">Không</button>
    </div>
    <div id="confirm-overlay" class="confirm-overlay" style="display: none;"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../JavaScript/JS_NCC.js"></script>
</body>

</html>