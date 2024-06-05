//Search Product
$(document).ready(function () {
  $("#data-dv").submit(function (e) {
    e.preventDefault();
    var formDatadv = $("#TimKiemdv").val();
    if (formDatadv) {
      $.ajax({
        type: "POST",
        url: "../BackEnd_PDV/search_dv.php",
        data: {
          search_keyword_dv: formDatadv,
        },
        success: function (response) {
          $("#result-dv").html(response);
        },
        error: function () {
          alert("Có lỗi xảy ra, vui lòng thử lại sau.");
        },
      });
    }
  });
});

function selectdv(ID, TenLoai, DonGia) {
  $.ajax({
      type: "POST",
      url: "../BackEnd_PDV/add_dv_to_session.php",
      data: {
          ID: ID,
          TenLoai: TenLoai,
          DonGia: DonGia
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



$(document).on("click", ".delete-dv", function () {
  var index = $(this).data("index");
  $.ajax({
    type: "POST",
    url: "../Backend_PDV/delete_dv.php",
    data: {
      dv_index: index,
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
$(document).on('change', '.so-luong', function() {
  var index = $(this).data('index');
  var soLuong = $(this).val();
  var donGia = parseFloat($('#DonGia_' + index).text()); // Lấy giá trị đơn giá từ dòng tương ứng

  // Tính toán thành tiền
  var thanhTien = donGia * soLuong;

  // Hiển thị thành tiền
  $('#ThanhTien_' + index).text(thanhTien);
});


function resetSearchdv(event) {
  event.preventDefault();
  $("#TimKiemdv").val("");
  $.ajax({
    type: "POST",
    url: "../Backend_PDV/DSDV.php",
    success: function (response) {
      $("#result-dv").html(response);
    },
    error: function () {
      alert("Error resetting search.");
    },
  });
}

document.addEventListener('DOMContentLoaded', function () {
  // Lấy tất cả các input số lượng
  var soLuongInputs = document.querySelectorAll('.so-luong');

  soLuongInputs.forEach(function (input) {
      input.addEventListener('input', function () {
          var dongia = parseFloat(input.getAttribute('data-dongia'));
          var index = input.getAttribute('data-index');
          var soLuong = parseFloat(input.value);
          var thanhTien = dongia * soLuong;

          // Cập nhật giá trị thành tiền
          document.getElementById('ThanhTien_' + index).textContent = thanhTien.toLocaleString('vi-VN');

          // Cập nhật tổng thanh toán
          updateTotalPrice();
      });
  });

  function updateTotalPrice() {
      var total = 0;
      var thanhTienElements = document.querySelectorAll('.thanh-tien');

      thanhTienElements.forEach(function (element) {
          total += parseFloat(element.textContent.replace(/\./g, '').replace(/,/g, ''));
      });

      document.querySelector('.price-total').textContent = total.toLocaleString('vi-VN');
  }

  document.getElementById('LapPhieu').addEventListener('click', function () {
      var form = document.getElementById('submitForm');
      var formData = new FormData(form);

      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../BackEnd_TraCuuPDV/dv_orders.php', true);
      xhr.onload = function () {
          if (xhr.status === 200) {
              var response = JSON.parse(xhr.responseText);
              if (response.status === 'success') {
                  alert(response.message);
                  location.reload();
              } else {
                  alert(response.message);
              }
          } else {
              alert('Có lỗi xảy ra, vui lòng thử lại sau.');
          }
      };
      xhr.send(formData);
  });
});

function updateThanhTien(index) {
  const soLuong = document.getElementById('SoLuong_' + index).value;
  const donGia = document.getElementById('SoLuong_' + index).getAttribute('data-dongia');
  const thanhTien = soLuong * donGia;
  document.getElementById('ThanhTien_' + index).innerText = thanhTien;

  // Lấy phần trăm trả trước từ input
  const salePercentage = document.getElementById('Sale').value.replace('%', '') / 100;
  const traTruoc = thanhTien * salePercentage;
  const conLai = thanhTien - traTruoc;

  // Cập nhật giá trị trả trước và còn lại
  document.getElementById('TraTruoc_' + index).innerText = traTruoc.toFixed(2);
  document.getElementById('ConLai_' + index).innerText = conLai.toFixed(2);

  // Update the total price
  updateTotalPrice();
}

function updateSale() {
  // Lặp qua tất cả các dòng trong bảng để cập nhật giá trị trả trước và còn lại
  const soLuongElements = document.querySelectorAll('.so-luong');
  soLuongElements.forEach(element => {
      const index = element.getAttribute('data-index');
      updateThanhTien(index);
  });
}

function updateTotalPrice() {
  let totalPrice = 0;
  let totalTraTruoc = 0;
  let totalConLai = 0;

  const thanhTienElements = document.querySelectorAll('.thanh-tien');
  thanhTienElements.forEach(element => {
      totalPrice += parseFloat(element.innerText);
  });

  const traTruocElements = document.querySelectorAll('.tra-truoc');
  traTruocElements.forEach(element => {
      totalTraTruoc += parseFloat(element.innerText);
  });

  const conLaiElements = document.querySelectorAll('.con-lai');
  conLaiElements.forEach(element => {
      totalConLai += parseFloat(element.innerText);
  });

  document.querySelector('.price-total').innerText = new Intl.NumberFormat('vi-VN').format(totalPrice);
  // You can add totalTraTruoc and totalConLai to the form or display them as needed
}


function togglePopupThemGioHang() {
  document.getElementById("popup-2").classList.toggle("active");
}

function togglePopupChonNCC() {
  document.getElementById("popup-1").classList.toggle("active");
}
