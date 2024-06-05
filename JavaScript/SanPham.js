function loadProductCategories(selectElementId) {
    $.ajax({
        url: '../BackEnd/SanPham/load_dsloaisp.php',
        method: 'GET',
        success: function(response) {
            console.log('Phản hồi từ máy chủ:', response); // Logging response

            if (Array.isArray(response)) {
                var select = $(selectElementId);
                select.empty(); // Clear existing options
                response.forEach(function(category) {
                    var option = $('<option></option>').attr('value', category.MALOAI).text(category.TENLOAI);
                    select.append(option);
                });
            } else {
                console.error('Error: ', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading categories:', xhr.responseText);
        }
    });
}

// Example usage: Load categories into combo boxes on document ready
$(document).ready(function() {
    loadProductCategories('#themTenLoaiSP');
    loadProductCategories('#suaTenLoaiSP');
});

// thêm sản phẩm
$(document).ready(function() {
    $('#FormThemSanPham').on('submit', function(event) {
        event.preventDefault();

        const data = {
            tenSP: $('#themtenSP').val(),
            loaiSP: $('#themTenLoaiSP').val(),
            gia: $('#themgia').val(),
            soluong: $('#themsoluong').val()
        };

        $.ajax({
            url: '../BackEnd/SanPham/add_sp.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                if (response.success) {
                    alert('Thêm sản phẩm thành công.');
                    location.reload();
                } else {
                    alert('Lỗi khi thêm sản phẩm: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi thêm sản phẩm:', xhr.responseText);
                alert('Lỗi khi thêm sản phẩm: ' + xhr.responseText);
            }
        });
    });

    // Load product categories on document ready
    loadProductCategories('#themTenLoaiSP');
});

// chỉnh sửa sản phẩm
$(document).ready(function() {
    $(document).on('click', '.ChiTietSanPham', function() {
        const maSP = $(this).data('id');
        const tenSP = $(this).data('name');
        const loaiSP = $(this).data('loaisp');
        const gia = $(this).data('gia');
        const soluong = $(this).data('soluong');

        $('#maSPEdit').val(maSP);
        $('#tenSPEdit').val(tenSP);
        $('#giaEdit').val(gia);
        $('#soluongEdit').val(soluong);

        togglePopupChinhSua();
    });

    $('#FormSuaSanPham').on('submit', function(event) {
        event.preventDefault();

        const data = {
            maSP: $('#maSPEdit').val(),
            tenSP: $('#tenSPEdit').val(),
            gia: $('#giaEdit').val(),
            soluong: $('#soluongEdit').val()
        };

        $.ajax({
            url: '../BackEnd/SanPham/edit_sp.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                if (response.success) {
                    alert('Cập nhật sản phẩm thành công');
                    location.reload();
                } else {
                    alert('Lỗi khi cập nhật sản phẩm: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi cập nhật sản phẩm:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });
});



// Xóa sản phẩm
function xoaSP(maSP) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
        $.ajax({
            url: '../BackEnd/SanPham/delete_sp.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ maSP: maSP }),
            success: function(response) {
                if (response.success) {
                    alert('Xóa sản phẩm thành công.');
                    location.reload();
                } else {
                    alert('Lỗi khi xóa sản phẩm: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi xóa sản phẩm:', xhr.responseText);
                alert('Lỗi khi xóa sản phẩm: ' + xhr.responseText);
            }
        });
    }
}

// Tìm kiếm sản phẩm
$(document).ready(function() {
    $('#FormTimKiemSanPham').on('submit', function(event) {
        event.preventDefault();

        var searchValue = $('#searchSanPham').val();

        $.ajax({
            url: '../BackEnd/SanPham/search_sp.php',
            method: 'POST',
            data: { search: searchValue },
            success: function(response) {
                $('#DanhSachSP').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tìm kiếm sản phẩm:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });
});
