// Hàm để tải và hiển thị danh sách đơn đặt hàng từ server
function displayDV() {
    // Sử dụng AJAX để gửi yêu cầu lấy dữ liệu đơn đặt hàng
    $.ajax({
        url: 'DichVu/displayDV.php', // Đường dẫn tới file PHP xử lý
        type: 'GET', // Phương thức yêu cầu
        dataType: 'html', // Kiểu dữ liệu trả về
        success: function(response) {
            // Thêm nội dung trả về vào vị trí mong muốn trên trang web
            $('#collapse3').html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Log lỗi ra console nếu có
        }
    });
}

// Gọi hàm hiển thị danh sách đơn đặt hàng khi trang web được tải
$(document).ready(function() {
    displayDV();
});


function editRecord(id) {
    // Gửi yêu cầu AJAX để lấy thông tin bản ghi
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_record.php?id=' + id, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Hiển thị biểu mẫu chỉnh sửa với thông tin nhận được
            document.getElementById('editFormContainer').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function updateRecord() {
    // Lấy dữ liệu từ biểu mẫu
    var id = document.getElementById('editID').value;
    var tenLoai = document.getElementById('editTenLoai').value;
    var donGia = document.getElementById('editDonGia').value;

    // Gửi yêu cầu AJAX để cập nhật thông tin bản ghi
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_record.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
            location.reload(); // Tải lại trang sau khi cập nhật thành công
        }
    };
    xhr.send('ID=' + id + '&TenLoai=' + tenLoai + '&DonGia=' + donGia);
}
