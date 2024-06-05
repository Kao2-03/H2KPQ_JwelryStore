// Thêm đơn vị
$(document).ready(function() {
  $('#FormThemDonVi').on('submit', function(event) {
      event.preventDefault();
      var tenDV = $('#themDonVi').val();
      console.log("Đơn vị gửi đi:", { TenDV: tenDV });

      $.ajax({
          url: '../BackEnd/DonVi/add_dv.php',
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({ TenDV: tenDV }),
          success: function(response) {
              console.log("Phản hồi từ server:", response);
              if (response.success) {
                  location.reload();
              } else {
                  alert('Đã có lỗi xảy ra: ' + response.error);
              }
          },
          error: function(xhr, status, error) {
              console.error('Lỗi khi thêm đơn vị:', xhr.responseText);
              alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
          }
      });
  });
});

// Xóa đơn vị
  function xoaDV(maDV) {
    if (confirm('Bạn có chắc chắn muốn xóa đơn vị này?')) {
      $.ajax({
        url: '../BackEnd/DonVi/delete_dv.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ maDV: maDV }),
        success: function(response) {
          if (response.success) {
            location.reload();
          } else {
            alert('Đã có lỗi xảy ra: ' + response.error);
          }
        },
        error: function(xhr, status, error) {
          console.error('Lỗi khi xóa đơn vị:', xhr.responseText);
          alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
        }
      });
    }
  }

  $(document).ready(function() {
    $(document).on('click', '.ChiTietDonVi', function() {
        const maDV = $(this).data('id');
        const tenDV = $(this).data('name');

        togglePopupSuaDV(maDV, tenDV);
    });

    $('#FormChinhSuaDonVi').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn gửi form mặc định

        // Thu thập dữ liệu từ form
        var formData = $(this).serialize();

        // Gửi yêu cầu AJAX để cập nhật dữ liệu đơn vị
        $.ajax({
            url: '../BackEnd/DonVi/edit_dv.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Cập nhật đơn vị thành công');
                    location.reload(); // Reload lại trang để cập nhật dữ liệu
                } else {
                    console.error('Lỗi khi cập nhật đơn vị:', response.error);
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi cập nhật đơn vị:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });
});

// Tìm kiếm đơn vị
  $(document).ready(function() {
    $('#FormTimKiemDonVi').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn việc gửi form mặc định

        var searchValue = $('#searchDonVi').val();

        // Gửi yêu cầu tìm kiếm bằng AJAX
        $.ajax({
            url: '../BackEnd/DonVi/search_dv.php', // URL tới file PHP xử lý tìm kiếm
            type: 'POST',
            data: { search: searchValue },
            success: function(response) {
                $('#DanhSachDV').html(response); // Cập nhật bảng dữ liệu
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tìm kiếm đơn vị:', xhr.responseText);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    });
});
