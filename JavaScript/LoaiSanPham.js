// Load tên đơm vị vào combobox
function loadUnitNames(selectElementId) {
    $.ajax({
        url: '../BackEnd/LoaiSanPham/load_loaidv.php',
        method: 'GET',
        success: function(response) {
            console.log('Phản hồi từ máy chủ:', response); // Thêm logging để kiểm tra phản hồi
            // Kiểm tra nếu phản hồi là một mảng
            if (Array.isArray(response)) {
                var select = $(selectElementId);
                select.empty(); // Xóa các tùy chọn hiện có
                response.forEach(function(donVi) {
                    var option = $('<option></option>').attr('value', donVi).text(donVi);
                    select.append(option);
                });
            } else {
                console.error('Phản hồi không phải là một mảng:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi tải đơn vị tính:', xhr.responseText);
        }
    });
}
// Thêm loại sản phẩm
$(document).ready(function() {
    $('#FormThemLoaiSanPham').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn gửi form mặc định

        const data = {
            tenLoaiSP: $('#themloaiSP').val(),
            phanTram: $('#themphanTram').val(),
            dvtinh: $('#themLoaiDonVi').val()
        };

        console.log('Dữ liệu gửi đi:', data); // Ghi nhật ký dữ liệu trước khi gửi

        $.ajax({
            url: '../BackEnd/LoaiSanPham/add_loaisp.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                console.log('Phản hồi từ server:', response); // Ghi nhật ký phản hồi từ server

                if (response.success) {
                    alert('Thêm loại sản phẩm thành công.');
                    location.reload(); // Tải lại trang sau khi thêm thành công
                } else {
                    alert('Lỗi khi thêm loại sản phẩm: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi thêm loại sản phẩm:', xhr.responseText);
                alert('Lỗi khi thêm loại sản phẩm: ' + xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    $(document).on('click', '.ChiTietLoaiSP', function() {
        const maLoaiSP = $(this).data('id');
        const tenLoaiSP = $(this).data('name');
        const phanTram = $(this).data('phantram');
        const dvtinh = $(this).data('dvtinh');

        togglePopupSuaLoaiSP(maLoaiSP, tenLoaiSP, phanTram, dvtinh);
    });

    $('#FormSuaLoaiSanPham').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn việc gửi form mặc định

        // Thu thập dữ liệu từ form chỉnh sửa
        var formData = $(this).serialize();

        // Gửi yêu cầu AJAX để cập nhật dữ liệu loại sản phẩm
        $.ajax({
            url: '../BackEnd/LoaiSanPham/edit_loaisp.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Cập nhật loại sản phẩm thành công');
                    location.reload(); // Reload lại trang để cập nhật dữ liệu
                } else {
                    console.error('Lỗi khi cập nhật loại sản phẩm:', response.error);
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi cập nhật loại sản phẩm:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });
});


    // Sự kiện tìm kiếm loại sản phẩm
    $(document).ready(function() {
        $('#FormTimKiemLoaiSP').on('submit', function(event) {
            event.preventDefault(); // Ngăn chặn việc gửi form mặc định
    
            var searchValue = $('#searchLoaiSP').val();
    
            // Gửi yêu cầu tìm kiếm bằng AJAX
            $.ajax({
                url: '../BackEnd/LoaiSanPham/search_loaisp.php',
                type: 'POST',
                data: { search: searchValue },
                success: function(response) {
                    $('#DanhSachLSP').html(response); // Cập nhật bảng dữ liệu
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi tìm kiếm đơn vị:', xhr.responseText);
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
                }
            });
        });
    });
    // Xóa loại sản phẩm
    function xoaLoaiSP(maLoaiSP) {
        if (confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này không?')) {
            $.ajax({
                url: '../BackEnd/LoaiSanPham/delete_loaisp.php',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ MaLoai: maLoaiSP }),
                success: function(response) {
                    if (response.success) {
                        alert('Xóa loại sản phẩm thành công.');
                        location.reload(); // Tải lại trang sau khi xóa thành công
                    } else {
                        alert('Lỗi khi xóa loại sản phẩm: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi xóa loại sản phẩm:', xhr.responseText);
                    alert('Lỗi khi xóa loại sản phẩm: ' + xhr.responseText);
                }
            });
        }
    }
    