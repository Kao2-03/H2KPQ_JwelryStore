// Hàm xóa phiếu bán
function xoaSP(soPhieuMua) {
    if (confirm("Bạn có chắc chắn muốn xóa phiếu bán này không?")) {
        $.ajax({
            url: '../BackEnd/TraCuuPMH/delete_pm.php', // URL tới file PHP xử lý xóa
            type: 'POST',
            data: { soPhieuMua: soPhieuMua },
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

// Hàm mở popup và hiển thị chi tiết phiếu mua
function togglePopupChiTiet_TTPM() {
    $('#popup-1').toggleClass('active');
}

$(document).ready(function() {
    $(document).on('click', '.ChiTietSanPham', function() {
        var soPhieu = $(this).data('id');
        var nhaCC = $(this).data('ncc');
        var diaChi = $(this).data('diachi');
        var sdt = $(this).data('sdt');
        var tongTien = $(this).data('tongtien');
        var ngayLap = $(this).data('ngaylap');

        // Gửi yêu cầu lấy dữ liệu chi tiết sản phẩm qua AJAX
        $.ajax({
            url: '../BackEnd/TraCuuPMH/ct_pm.php', // URL tới file PHP xử lý lấy chi tiết phiếu mua
            type: 'POST',
            data: { soPhieu: soPhieu },
            success: function(response) {
                // Hiển thị thông tin chi tiết phiếu mua trong popup
                $('#maHD').val(soPhieu);
                $('#tenNCC').val(nhaCC);
                $('#diaChi').val(diaChi);
                $('#sdt').val(sdt);
                $('#collapse2 tbody').html(response); // Cập nhật bảng dữ liệu sản phẩm
                $('#total-payment').text(tongTien); // Hiển thị tổng tiền
                $('#current-date').text('Ngày lập: ' + ngayLap);
                togglePopupChiTiet_TTPM(); // Mở popup
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy chi tiết phiếu mua:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });
});


