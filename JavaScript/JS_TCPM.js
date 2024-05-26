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
                                text: 'Phiếu mua đã được xóa thành công!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi xóa phiếu mua.',
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

function togglePopupChiTiet_TTPM(id, paymentDate, supplierName, totalPayment, supplierAddress, supplierPhone, productsJson) {
    document.getElementById("popup-1").classList.toggle("active");
    $('#maHD').val(id);
    $('#current-date').text('Ngày lập: ' + paymentDate);
    $('#tenNCC').val(supplierName);
    $('#diaChi').val(supplierAddress);
    $('#sdt').val(supplierPhone);
    $('#total-payment').text(totalPayment);

    $('#product-list-body').empty();
    // Parse the products JSON string to an array
    var products = JSON.parse(productsJson);

    // Fill in the product table
    if (products && products.length > 0) {
        products.forEach(function (product, index) {
            var productRow = '<tr>' +
                '<td>' + (index + 1) + '</td>' +
                '<td>' + product.productName + '</td>' +
                '<td>' + product.unitPrice + '</td>' +
                '<td>' + product.quantity + '</td>' +
                '<td>' + product.totalPrice + '</td>' +
                '</tr>';
            $('#product-list-body').append(productRow);
        });
    }
}