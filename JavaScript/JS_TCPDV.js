// Hàm để mở/đóng popup chi tiết phiếu dịch vụ
function togglePopupChiTiet_TTPDV() {
    const popup = document.getElementById("popup-1");
    popup.style.display = popup.style.display === "flex" ? "none" : "flex";
}

// Hàm để cập nhật thông tin vào popup khi người dùng click vào một phiếu dịch vụ cụ thể
function showdvDetails(SoPhieu, khachHang, sdt, TongTien) {
    document.getElementById("SoPhieu").value = SoPhieu;
    document.getElementById("KhachHang").value = khachHang;
    document.getElementById("SDT").value = sdt;
    
    // Cập nhật danh sách dịch vụ
    const dvListBody = document.getElementById("dv-list-body");
    dvListBody.innerHTML = '';
    dichVu.forEach((dv, index) => {
        const row = `<tr>
            <td>${index + 1}</td>
            <td>${dv.TenLoai}</td>
            <td>${dv.DonGia}</td>
            <td>${dv.SoLuong}</td>
            <td>${dv.ThanhTien}</td>
        </tr>`;
        dvListBody.innerHTML += row;
    });
    
    // Cập nhật tổng thanh toán
    document.getElementById("total-payment").textContent = TongTien;

    // Hiển thị popup
    togglePopupChiTiet_TTPDV();
}

// Lấy dữ liệu phiếu dịch vụ từ backend và hiển thị lên bảng
fetch('../Backend_TraCuuPDV/get_DV_slip_data.php')
    .then(response => response.json())
    .then(data => {
        const phieuDichVuList = document.getElementById('phieu-dich-vu-list');
        data.forEach(phieu => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${phieu.maPhieu}</td>
                <td>${phieu.khachHang}</td>
                <td>${phieu.soDienThoai}</td>
                <td>${phieu.ngayLap}</td>
                <td>${phieu.tong}</td>
                <td>${phieu.tongTraTruoc}</td>
                <td>${phieu.tongConLai}</td>
                <td>${phieu.tinhTrang}</td>
                <td><button onclick="showdvDetails('${phieu.SoPhieu}', '${phieu.KhachHang}', '${phieu.SDT}', ${JSON.stringify(phieu.dichVu)}, '${phieu.TongTien}')">Chi tiết</button></td>
            `;
            phieuDichVuList.appendChild(row);
        });
    })
    .catch(error => console.error('Error fetching data:', error));

function deletePDV(id) {
    if (!isNaN(id)) {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: 'Bạn có chắc chắn muốn xóa phiếu dịch vụ này không?',
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
                    url: '../Backend_TraCuuPDV/delete_PDV.php',
                    data: { id: id },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            Swal.fire({
                                title: 'Đã xóa!',
                                text: 'Phiếu dịch vụ đã được xóa thành công!',
                                icon: 'success', // Đổi icon thành success
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi xóa phiếu dịch vụ.',
                                icon: 'error', // Đổi icon thành error
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

