function togglePopupChonNCC() {
    let popup = document.getElementById("popup-1");
    if (popup) {
        popup.classList.toggle("active");
    } else {
        console.error('Element with ID "popup-1" not found');
    }
}
function togglePopupThemGioHang(){
    let popup = document.getElementById("popup-2");
    if (popup) {
        popup.classList.toggle("active");
    } else {
        console.error('Element with ID "popup-2" not found');
    }
}
function prepareAndSubmitForm() {
    updateTotal(); // Đảm bảo tổng giá đã được cập nhật

    // Lấy dữ liệu giỏ hàng từ bảng và chuyển thành mảng đối tượng
    var cartData = [];
    $('#cartTableBody tr').each(function() {
        var productId = $(this).data('id');
        var productQuantity = parseInt($(this).find('.quantity-input').val());
        var productPrice = parseFloat($(this).find('.don-gia').text());
        var productTotal = parseFloat($(this).find('.thanh-tien').text());

        // Tạo đối tượng sản phẩm và thêm vào mảng giỏ hàng
        var product = {
            SanPham: productId,
            SoLuong: productQuantity,
            DonGia: productPrice,
            ThanhTien: productTotal
        };
        cartData.push(product);
    });

    // Thêm dữ liệu giỏ hàng vào dữ liệu biểu mẫu trước khi gửi đi
    var formData = new FormData(document.getElementById('tabLapPhieu'));
    formData.append('cart', JSON.stringify(cartData));

    // Gửi form thông qua AJAX
    $.ajax({
        url: '../BackEnd/PhieuMua/lapPhieuMua.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
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
    // Function to display error message
    function hienThiPopupLoi(errorMessage) {
        alert("Lỗi: " + errorMessage);
    }

    // Function to update total price
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

    // Function to update total product count
    function updateTotalLabel() {
        var productCount = $('#cartTableBody tr').length;
        $('#product-count').text(productCount);
    }
// Function to prepare and submit form

    // Other jQuery related code
    $(document).ready(function() {
        // Search supplier form submission
        $('#searchSupplierForm').on('submit', function(event) {
            event.preventDefault();
            var searchValue = $('#TimKiemNCC').val();
            $.ajax({
                url: '../BackEnd/PhieuMua/search_pm.php',
                type: 'POST',
                data: { search_keyword_ncc: searchValue },
                success: function(response) {
                    $('#searchSupplierResult').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi tìm kiếm nhà cung cấp:', xhr.responseText);
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
                }
            });
        });

        // Select supplier
        $(document).on('click', '.select-supplier', function() {
            var supplierID = $(this).data('supplier-id');
            var supplierName = $(this).data('supplier-name');
            var supplierAddress = $(this).data('supplier-address');
            var supplierPhone = $(this).data('supplier-phone');
            $('.tenCTY').text('Tên: ' + supplierName);
            $('.diaChi').text('Địa chỉ: ' + supplierAddress);
            $('.SDT').text('Số điện thoại: ' + supplierPhone);

            $('#nhacc').val(supplierID)
            $('#ten_ncc').val(supplierName);
            $('#dia_chi').val(supplierAddress);
            $('#sdt').val(supplierPhone);
            togglePopupChonNCC();
        });

        // Search product
        $('#data-product').on('submit', function(event) {
            event.preventDefault();
            var searchValue = $('#TimKiemProduct').val();
            $.ajax({
                url: '../BackEnd/PhieuMua/search_product.php',
                type: 'POST',
                data: { search: searchValue },
                success: function(response) {
                    $('#result-product tbody').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi tìm kiếm sản phẩm:', xhr.responseText);
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
                }
            });
        });

        // Add product to cart
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

        // Remove product from cart
        $(document).on('click', '.remove-from-cart-btn', function() {
            $(this).closest('tr').remove();
            updateTotal();
        });

        // Update total price when quantity changes
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
