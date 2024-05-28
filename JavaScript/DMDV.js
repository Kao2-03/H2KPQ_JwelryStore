// Hàm để tải và hiển thị danh sách dịch vụ từ server
function displayDV() {
    // Sử dụng AJAX để gửi yêu cầu lấy dữ liệu dịch vụ
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

// Gọi hàm hiển thị danh sách dịch vụ khi trang web được tải
$(document).ready(function() {
    displayDV();
});

// Hàm để chỉnh sửa bản ghi dịch vụ
function editRecord(id) {
    // Gửi yêu cầu AJAX để lấy thông tin bản ghi
    $.ajax({
        url: 'DichVu/get_record.php?id=' + id,
        type: 'GET',
        dataType: 'html',
        success: function(response) {
            // Hiển thị biểu mẫu chỉnh sửa với thông tin nhận được
            $('#editFormContainer').html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

// Hàm để cập nhật bản ghi dịch vụ
function updateRecord() {
    // Lấy dữ liệu từ biểu mẫu
    var tenLoai = $('#editTenLoai').val();
    var donGia = $('#editDonGia').val();

    // Gửi yêu cầu AJAX để cập nhật thông tin bản ghi
    $.ajax({
        url: 'DichVu/update_record.php',
        type: 'POST',
        data: { TenLoai: tenLoai, DonGia: donGia },
        success: function(response) {
            alert(response);
            location.reload(); // Tải lại trang sau khi cập nhật thành công
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('Có lỗi xảy ra khi cập nhật bản ghi.');
        }
    });
}
$(document).ready(function() {
    $('#search-form').on('submit', function(event) {
        event.preventDefault();
        var keyword = $('#TimKiem').val();
        if (keyword) {
            $.ajax({
                type: 'POST',
                url: '../DichVu/searchLoaiDV.php',
                data: {
                    search_keyword: keyword
                },
                success: function(response) {
                    $('#collapse3').html(response);
                },
                error: function() {
                    alert('Error searching.');
                }
            });
        }
    });
});

// Function to reset search
function resetSearch() {
    $('#TimKiem').val('');
    $.ajax({
        type: 'POST',
        url: '../DichVu/displayDV.php',
        success: function(response) {
            $('#collapse3').html(response);
        },
        error: function() {
            alert('Error resetting search.');
        }
    });
}

// Popup toggle functions
function togglePopupThemNCC() {
    document.getElementById("popup-1").classList.toggle("active");
}

function openEditPopup(ten, gia) {
    document.getElementById('edit-TenLoai').value = TenLoai;
    document.getElementById('edit-DonGia').value = DonGia;

    document.getElementById('popup-2').classList.add('active');
    document.getElementById('overlay-edit').classList.add('active');
}

function closeEditPopup() {
    document.getElementById('popup-2').classList.remove('active');
    document.getElementById('overlay-edit').classList.remove('active');
}

function deleteSupplier(id) {
    document.getElementById("confirm-popup").style.display = 'block';
    document.getElementById("confirm-overlay").style.display = 'block';

    document.getElementById("confirm-yes").onclick = function() {
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "../DichVu/deleteDV.php");

        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "id");
        hiddenField.setAttribute("value", id);

        form.appendChild(hiddenField);

        document.body.appendChild(form);
        form.submit();
    };

    document.getElementById("confirm-no").onclick = function() {
        document.getElementById("confirm-popup").style.display = 'none';
        document.getElementById("confirm-overlay").style.display = 'none';
    };
}




//Search Product
$(document).ready(function () {
    $("#data-service").submit(function (e) {
      e.preventDefault();
      var formDataService = $("#TimKiemDV").val();
      if (formDataService) {
        $.ajax({
          type: "POST",
          url: "../DichVu/searchphieuDV.php",
          data: {
            search_keyword_service: formDataService,
          },
          success: function (response) {
            $("#result-service").html(response);
          },
          error: function () {
            alert("Có lỗi xảy ra, vui lòng thử lại sau.");
          },
        });
      }
    });
  });
  
  function selectDV(id, TenLoai, DonGia, SoLuong, ThanhTien) {
    $.ajax({
      type: "POST",
      url: "../DichVu/selectDV.php",
      data: {
        DV_id: id,
        LoaiDV: TenLoai, // sửa từ LoaiDV thành TenLoai
        DonGia: DonGia,
        SoLuong: SoLuong,
        ThanhTien: ThanhTien,
      },
      success: function (response) {
        var result = JSON.parse(response);
        if (result.status === "success") {
          location.reload();
        } else {
          alert(result.message);
        }
      },
      error: function () {
        alert("Có lỗi xảy ra, vui lòng thử lại sau.");
      },
    });
  }
  
  $(document).on("click", ".delete-service", function () {
    var index = $(this).data("index");
    $.ajax({
      type: "POST",
      url: "../DichVu/deleteDV.php",
      data: {
        service_index: index,
      },
      success: function (response) {
        var result = JSON.parse(response);
        if (result.status === "success") {
          toastr.success("Dịch vụ đã được xóa thành công.");
          location.reload();
        } else {
          toastr.error(result.message);
        }
      },
      error: function () {
        toastr.error("Có lỗi xảy ra, vui lòng thử lại sau.");
      },
    });
  });
  
  function resetSearchService(event) {
    event.preventDefault();
    $("#TimKiemDV").val("");
    $.ajax({
      type: "POST",
      url: "../DV/lapPhieuDV.php",
      success: function (response) {
        $("#result-product").html(response);
      },
      error: function () {
        alert("Error resetting search.");
      },
    });
  }
  
  function submitForm() {
    var Tenkhachhang = $(".tenKH").text();
    var SDT = $(".sdt").text();
    var tratruoc = $(".tratrc").text();
    var currentDateStr = $(".heading-text label")
      .text()
      .replace("Ngày lập: ", "");
    var currentDateParts = currentDateStr.split("/");
    var currentDate = `${currentDateParts[2]}-${currentDateParts[1]}-${currentDateParts[0]}`;
    var totalPayment = $(".thanhtien")
      .text()
      .replace(/\./g, "")
      .replace(/\,/g, "");
    totalPayment = parseInt(totalPayment);
  
    var service = [];
    $(".service-table tbody tr").each(function () {
      var tenDV = $(this).find("td").eq(1).text();
      var gia = $(this)
        .find("td")
        .eq(2)
        .text()
        .replace(/\./g, "")
        .replace(/\,/g, "");
      var soluong = $(this).find("td").eq(3).text();
      var thanhtien = $(this)
        .find("td")
        .eq(4)
        .text()
        .replace(/\./g, "")
        .replace(/\,/g, "");
  
      if (tenDV && gia && soluong && thanhtien) {
        service.push({
          name: tenDV,
          gia: parseInt(gia),
          soluong: parseInt(soluong),
          thanhtien: parseInt(thanhtien),
        });
      }
    });
  
    var formData = {
      tenKh: Tenkhachhang,
      Sdt: SDT,
      current_date: currentDate,
      total_payment: totalPayment,
      service: JSON.stringify(service),
    };
  
    $.ajax({
      type: "POST",
      url: "../Backend_TraCuu/save_purchase_order.php",
      data: formData,
      success: function (response) {
        var result = JSON.parse(response);
        if (result.status === "success") {
          toastr.success("Phiếu đã được lập thành công!");
          console.log(response);
        } else {
          alert(result.message);
          console.log(response);
        }
      },
      error: function (xhr, status, error) {
        console.error("Error submitting purchase order:", error);
        alert("Có lỗi xảy ra khi lập phiếu. Vui lòng thử lại sau.");
      },
    });
  }
  
  function togglePopupThemGioHang() {
    document.getElementById("popup-2").classList.toggle("active");
  }
  