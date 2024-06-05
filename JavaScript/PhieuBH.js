function updateTotal() {
    var total = 0;
    $('#collapse1 tbody tr').each(function(index) {
        var row = $(this);
        row.find('td:first-child').text(index + 1); // Update index
        var quantity = row.find('.quantity-input').val();
        var price = parseFloat(row.find('td:nth-child(3)').text()); // Get product price from the 3rd column
        var subtotal = quantity * price;
        row.find('td:nth-child(5)').text(subtotal); // Update subtotal in the 5th column
        total += subtotal;
    });
    $('.price-total').text(total); // Update total price
    $('#tong_tien').val(total); // Set the total price in the hidden input
}
// Xóa sản phẩm khỏi giỏ hàng
$(document).on('click', '.remove-from-cart-btn', function() {
    $(this).closest('tr').remove(); // Xóa dòng sản phẩm ra khỏi bảng giỏ hàng
    updateTotal(); // Cập nhật lại số thứ tự và tổng tiền
});

// Tìm kiếm
$(document).ready(function() {
    $('#data-product').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn việc gửi form mặc định

        var searchValue = $('#TimKiemProduct').val();

        // Gửi yêu cầu tìm kiếm bằng AJAX
        $.ajax({
            url: '../BackEnd/PhieuBH/search_form.php',
            type: 'POST',
            data: { search: searchValue },
            success: function(response) {
                $('#result-product tbody').html(response); // Cập nhật bảng dữ liệu
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tìm kiếm sản phẩm:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });
});

// thêm vào giỏ
$(document).ready(function() {
    $('.add-to-cart-btn').click(function() {
        var productId = $(this).data('id');
        var productName = $(this).data('name');
        var productPrice = $(this).data('price');
        var productQuantity = 1; // Số lượng ban đầu là 1
        var productTotal = productPrice * productQuantity;

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        var productExists = false;
        $('#collapse1 tbody tr').each(function() {
            var existingProductId = $(this).data('id');
            if (existingProductId === productId) {
                productExists = true;
                var existingQuantity = parseInt($(this).find('.quantity-input').val());
                $(this).find('.quantity-input').val(existingQuantity + 1); // Tăng số lượng lên 1
                $(this).find('.thanh-tien').text((existingQuantity + 1) * productPrice); // Cập nhật thành tiền
                updateTotal(); // Cập nhật tổng tiền
            }
        });

        // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào
        if (!productExists) {
            var newRow = '<tr data-id="' + productId + '">' +
                '<td></td>' +
                '<td>' + productName + '</td>' +
                '<td>' + productPrice + '</td>' +
                '<td><input type="number" class="form-control quantity-input" value="1" min="1"></td>' +
                '<td>' + productTotal + '</td>' +
                '<td><button class="btn btn-danger remove-from-cart-btn">Xóa</button></td>' +
                '</tr>';
            $('#collapse1 tbody').append(newRow);
            updateTotal(); // Cập nhật tổng tiền
        }
    });
});


$(document).on('input', '.quantity-input', function() {
    var row = $(this).closest('tr');
    var quantity = $(this).val();
    var price = row.find('td:nth-child(3)').text(); // Lấy giá sản phẩm từ cột thứ 3
    row.find('td:nth-child(5)').text(quantity * price); // Cập nhật thành tiền trong cột thứ 5
    updateTotal(); // Cập nhật tổng tiền
});

function updateTotalLabel() {
    var productCount = $('#collapse1 tbody tr').length; // Đếm số lượng dòng trong bảng giỏ hàng
    $('.count-total').text("Tổng thanh toán (" + productCount + " sản phẩm)"); // Hiển thị số lượng sản phẩm
}

$(document).ready(function() {
    // Gọi hàm updateTotalLabel khi trang được tải
    updateTotalLabel();
    
    // Cập nhật tổng số lượng sản phẩm sau mỗi lần thêm hoặc xóa sản phẩm khỏi giỏ hàng
    $(document).on('click', '.add-to-cart-btn, .remove-from-cart-btn', function() {
        updateTotalLabel();
    });
});

// Thông báo lập phiếu
function hienThiPopupThanhCong() {
    alert("Phiếu bán đã được lập thành công.");
    window.location = "phieuBan.php"; // Chuyển hướng về trang danh sách phiếu bán
}

function hienThiPopupLoi(message) {
    alert("Lỗi: " + message);
    window.location = "phieuBan.php"; // Chuyển hướng về trang danh sách phiếu bán
}

function prepareAndSubmitForm() {
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

    // Thêm dữ liệu giỏ hàng vào dữ liệu biểu mẫu trước khi gửi đi
    var formData = $('#tabLapPhieu').serializeArray();
    formData.push({ name: 'cart', value: JSON.stringify(cartData) });

    // Gửi form thông qua AJAX
    $.ajax({
        url: '../BackEnd/PhieuBH/lapPhieu.php',
        type: 'POST',
        data: formData, // Dữ liệu biểu mẫu với dữ liệu giỏ hàng đã được thêm vào
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


// Initialize total price when the page is ready
$(document).ready(function() {
    updateTotal();
});

