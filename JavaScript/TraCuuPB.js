// tìm kiếm phiếu bán
$(document).ready(function() {
    $('#FormTimKiemPhieuBan').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn việc gửi form mặc định

        var searchValue = $('#searchPhieuBan').val();

        // Gửi yêu cầu tìm kiếm bằng AJAX
        $.ajax({
            url: '../BackEnd/TraCuuPBH/search_pb.php', // URL tới file PHP xử lý tìm kiếm
            type: 'POST',
            data: { search: searchValue },
            success: function(response) {
                $('#collapse3 tbody').html(response); // Cập nhật bảng dữ liệu
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tìm kiếm phiếu bán:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });
});

// Hàm xóa phiếu bán
function xoaSP(soPhieu) {
    if (confirm("Bạn có chắc chắn muốn xóa phiếu bán này không?")) {
        $.ajax({
            url: '../BackEnd/TraCuuPBH/delete_pb.php', // URL tới file PHP xử lý xóa
            type: 'POST',
            data: { soPhieu: soPhieu },
            success: function(response) {
                alert('Xóa phiếu bán thành công.');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi xóa phiếu bán:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    }
}

$(document).ready(function() {
    $(document).on('click', '.ChiTietSanPham', function() {
        var soPhieu = $(this).data('id');
        var khachHang = $(this).data('kh');
        var tongTien = $(this).data('tongtien');
        var ngayLap = $(this).data('ngaylap');

        // Gửi yêu cầu lấy dữ liệu chi tiết sản phẩm qua AJAX
        $.ajax({
            url: '../BackEnd/TraCuuPBH/ct_pb.php', // URL tới file PHP xử lý lấy chi tiết phiếu bán
            type: 'POST',
            data: { soPhieu: soPhieu },
            success: function(response) {
                // Hiển thị thông tin chi tiết phiếu bán trong popup
                $('#maHD').val(soPhieu);

                $('#tenKH').val(khachHang);
                $('#collapse2 tbody').html(response); // Cập nhật bảng dữ liệu sản phẩm
                $('.label-for-total-price').text(tongTien); // Hiển thị tổng tiền
                $('.text2').text('Ngày lập ' + ngayLap);
                togglePopupChiTiet_TTPM(); // Mở popup
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy chi tiết phiếu bán:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });
});

