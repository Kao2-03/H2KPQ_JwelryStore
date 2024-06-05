document.addEventListener('DOMContentLoaded', function() {
    // Add event listener for form submission
    document.getElementById('submitButton').addEventListener('click', prepareAndSubmitForm);
});

// Toggle popup functions
function togglePopupThemGioHang() {
    document.getElementById("popup-2").classList.toggle("active");
}

function togglePopupChonNCC() {
    document.getElementById("popup-1-Mua").classList.toggle("active");
}

// Function to display error message
function hienThiPopupLoi(errorMessage) {
    // Here you can use any method to display the error message
    // For simplicity, using an alert
    alert("Lỗi: " + errorMessage);
}

// Tìm kiếm nhà cung cấp
$(document).ready(function() {
    $('#searchSupplierForm').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn việc gửi form mặc định

        var searchValue = $('#TimKiemNCC').val();

        // Gửi yêu cầu tìm kiếm bằng AJAX
        $.ajax({
            url: '../BackEnd/PhieuMua/search_pm.php',
            type: 'POST',
            data: { search_keyword_ncc: searchValue },
            success: function(response) {
                // Cập nhật kết quả tìm kiếm vào tbody của bảng nhà cung cấp trong popup
                $('#searchSupplierResult').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tìm kiếm nhà cung cấp:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });

    // Chọn nhà cung cấp
    $(document).on('click', '.select-supplier', function() {
        var supplierName = $(this).data('supplier-name');
        var supplierAddress = $(this).data('supplier-address');
        var supplierPhone = $(this).data('supplier-phone');
        $('.tenCTY').text('Tên: ' + supplierName);
        $('.diaChi').text('Địa chỉ: ' + supplierAddress);
        $('.SDT').text('Số điện thoại: ' + supplierPhone);
        $('#ten_ncc').val(supplierName);
        $('#dia_chi').val(supplierAddress);
        $('#sdt').val(supplierPhone);

        togglePopupChonNCC(); // Đóng popup sau khi chọn nhà cung cấp
    });
});

// Tìm kiếm sản phẩm
$(document).ready(function() {
    $('#data-product').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn việc gửi form mặc định

        var searchValue = $('#TimKiemProduct').val();

        // Gửi yêu cầu tìm kiếm bằng AJAX
        $.ajax({
            url: '../BackEnd/PhieuMua/search_product.php',
            type: 'POST',
            data: { search: searchValue },
            success: function(response) {
                // Cập nhật kết quả tìm kiếm vào tbody của bảng sản phẩm trong popup
                $('#result-product tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tìm kiếm sản phẩm:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });

    // Thêm sản phẩm vào giỏ hàng
    $(document).on('click', '.add-to-cart-btn', function() {
        var productId = $(this).data('id');
        var productName = $(this).data('name');
        var productPrice = parseFloat($(this).data('price'));
        var productQuantity = 1;
        var productTotal = productPrice * productQuantity;

        var productExists = false;
        $('#cartTableBody tr').each(function() {
            var existingProductId = $(this).data('id');
            if (existingProductId === productId) {
                productExists = true;
                var existingQuantity = parseInt($(this).find('.quantity-input').val());
                $(this).find('.quantity-input').val(existingQuantity + 1);
                $(this).find('.thanh-tien').text((existingQuantity + 1) * productPrice);
                updateTotal();
            }
        });

        if (!productExists) {
            var newRow = '<tr data-id="' + productId + '">' +
                '<td></td>' +
                '<td>' + productName + '</td>' +
                '<td class="don-gia">' + productPrice + '</td>' +
                '<td><input type="number" class="form-control quantity-input" value="1" min="1"></td>' +
                '<td class="thanh-tien">' + productTotal + '</td>' +
                '<td><button class="btn btn-danger remove-from-cart-btn">Xóa</button></td>' +
                '</tr>';
            $('#cartTableBody').append(newRow);
            updateTotal();
        }
    });

    // Xóa sản phẩm khỏi giỏ hàng
    $(document).on('click', '.remove-from-cart-btn', function() {
        $(this).closest('tr').remove();
        updateTotal();
    });

    // Cập nhật thành tiền khi thay đổi số lượng
    $(document).on('input', '.quantity-input', function() {
        var row = $(this).closest('tr');
        var quantity = $(this).val();
        var price = parseFloat(row.find('.don-gia').text());
        row.find('.thanh-tien').text(quantity * price);
        updateTotal();
    });

    // Initialize total price when the page is ready
    updateTotal();
});

// Hàm cập nhật tổng tiền
function updateTotal() {
    var total = 0;
    $('#cartTableBody tr').each(function(index) {
        var row = $(this);
        row.find('td:first-child').text(index + 1);
        var quantity = row.find('.quantity-input').val();
        var price = parseFloat(row.find('.don-gia').text());
        var subtotal = quantity * price;
        row.find('.thanh-tien').text(subtotal);
        total += subtotal;
    });
    $('.price-total').text(total);
    $('#tong_tien').val(total);
    updateTotalLabel();
}

// Hàm cập nhật tổng số sản phẩm trong giỏ hàng
function updateTotalLabel() {
    var productCount = $('#cartTableBody tr').length;
    $('#product-count').text(productCount);
}

// Hàm lập phiếu mua hàng
function prepareAndSubmitForm(event) {
    event.preventDefault(); // Ngăn chặn việc gửi form mặc định

    updateTotal(); // Đảm bảo tổng giá đã được cập nhật

    // Lấy dữ liệu giỏ hàng từ bảng và chuyển thành mảng đối tượng
    var cartData = [];
    $('#collapse1 tbody tr').each(function() {
        var productId = $(this).data('id');
        var productName = $(this).find('td:nth-child(2)').text(); // Sản phẩm ở cột 2
        var productPrice = parseFloat($(this).find('td:nth-child(3)').text()); // Giá sản phẩm ở cột 3
        var productQuantity = parseInt($(this).find('.quantity-input').val()); // Số lượng sản phẩm
        var productTotal = productPrice * productQuantity; // Tổng giá của sản phẩm

        // Tạo đối tượng sản phẩm và thêm vào mảng giỏ hàng
        var product = {
            SanPham: productId,
            SoLuong: productQuantity,
            DonGia: productPrice,
            ThanhTien: productTotal
        };
        cartData.push(product);
    });

    // Tạo một đối tượng FormData và thêm dữ liệu của form vào đó
    var formData = new FormData(document.getElementById('tabLapPhieu'));
    // Thêm dữ liệu giỏ hàng dưới dạng JSON vào FormData
    formData.append('cart', JSON.stringify(cartData));

    // Gửi form thông qua AJAX
    $.ajax({
        url: '../BackEnd/PhieuMua/lapPhieuMua.php', // Đường dẫn đến tệp xử lý PHP
        type: 'POST',
        data: formData, // Dữ liệu biểu mẫu với dữ liệu giỏ hàng đã được thêm vào
        processData: false, // Không xử lý dữ liệu form
        contentType: false, // Không set header Content-Type
        dataType: 'json',
        success: function(response) {
            // Xử lý phản hồi từ máy chủ
            if (response.success) {
                hienThiPopupThanhCong(); // Hiển thị thông báo thành công
            } else {
                hienThiPopupLoi(response.error); // Hiển thị thông báo lỗi
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi lập phiếu:', xhr.responseText);
            alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    });
}


