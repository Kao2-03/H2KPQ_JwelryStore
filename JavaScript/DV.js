function deletePurchase(id) {
    if (!isNaN(id)) {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: 'Bạn có chắc chắn muốn xóa phiếu mua này không?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vâng, xóa nó!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '../Backend_TraCuu/delete_purchase.php',
                    data: { id: id },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            Swal.fire({
                                title: 'Đã xóa!',
                                text: 'Phiếu đã được xóa thành công!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi xóa phiếu.',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Lỗi!',
                            text: 'Có lỗi xảy ra khi lập phiếu. Vui lòng thử lại sau.',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    } else {
        Swal.fire({
            title: 'ID không hợp lệ!',
            text: 'ID không hợp lệ.',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }
}

function togglePopupChiTiet_TTPDV(id, paymentDate, supplierName, totalPayment, supplierAddress, supplierPhone, productsJson) {
    document.getElementById("popup-1").classList.toggle("active");
    $('#maHD').val(id);
    $('#current-date').text('Ngày lập: ' + paymentDate);
    $('#tenKhachHang').val(KhachHang);
    $('#sdt').val(SDT);
    $('#total-payment').text(thanhtien);

    $('#service-list-body').empty();
    // Parse the products JSON string to an array
    var service = JSON.parse(serviceJson);

    // Fill in the product table
    if (service && service.length > 0) {
        service.forEach(function (service, index) {
            var serviceRow = '<tr>' +
                '<td>' + (index + 1) + '</td>' +
                '<td>' + service.tenDV + '</td>' +
                '<td>' + service.gia + '</td>' +
                '<td>' + service.soluong + '</td>' +
                '<td>' + service.thanhtien + '</td>' +
                '</tr>';
            $('#service-list-body').append(serviceRow);
        });
    }
}