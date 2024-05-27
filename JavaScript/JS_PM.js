$(document).ready(function () {
  $("#data-container").submit(function (e) {
    e.preventDefault();
    var formData = $("#TimKiemNcc").val();
    if (formData) {
      $.ajax({
        type: "POST",
        url: "../Backend_PM/search_pm.php",
        data: {
          search_keyword_ncc: formData,
        },
        success: function (response) {
          $("#result-container").html(response);
        },
        error: function () {
          alert("Có lỗi xảy ra, vui lòng thử lại sau.");
        },
      });
    }
  });
});

function resetSearch(event) {
  event.preventDefault();
  $("#TimKiemNcc").val("");
  $.ajax({
    type: "POST",
    url: "../Backend_PM/display_pm.php",
    success: function (response) {
      $("#result-container").html(response);
    },
    error: function () {
      alert("Error resetting search.");
    },
  });
}

$(document).ready(function () {
  var selectedSupplier = localStorage.getItem("selectedSupplier");
  if (selectedSupplier) {
    selectedSupplier = JSON.parse(selectedSupplier);
    $(".tenCTY").text("Nhà cung cấp: " + selectedSupplier.name);
    $(".diaChi").text("Địa chỉ: " + selectedSupplier.address);
    $(".SDT").text("Số điện thoại: " + selectedSupplier.phone);
  }
});

$(document).on("click", ".select-supplier", function () {
  var supplierName = $(this).data("supplier-name");
  var supplierAddress = $(this).data("supplier-address");
  var supplierPhone = $(this).data("supplier-phone");
  selectSupplier(supplierName, supplierAddress, supplierPhone);
});

function selectSupplier(supplierName, supplierAddress, supplierPhone) {
  $.ajax({
    type: "POST",
    url: "../Backend_PM/select_supplier.php",
    data: {
      supplierName: supplierName,
      supplierAddress: supplierAddress,
      supplierPhone: supplierPhone,
    },
    success: function (response) {
      localStorage.setItem(
        "selectedSupplier",
        JSON.stringify({
          name: supplierName,
          address: supplierAddress,
          phone: supplierPhone,
        })
      );

      $(".tenCTY").text("Nhà cung cấp: " + supplierName);
      $(".diaChi").text("Địa chỉ: " + supplierAddress);
      $(".SDT").text("Số điện thoại: " + supplierPhone);

      togglePopupChonNCC();
    },
    error: function () {
      alert("Có lỗi xảy ra, vui lòng thử lại sau.");
    },
  });
}

//Search Product
$(document).ready(function () {
  $("#data-product").submit(function (e) {
    e.preventDefault();
    var formDataProduct = $("#TimKiemProduct").val();
    if (formDataProduct) {
      $.ajax({
        type: "POST",
        url: "../Backend_PM/search_product.php",
        data: {
          search_keyword_product: formDataProduct,
        },
        success: function (response) {
          $("#result-product").html(response);
        },
        error: function () {
          alert("Có lỗi xảy ra, vui lòng thử lại sau.");
        },
      });
    }
  });
});

function selectProduct(id, product_name, price, quantity, total_price) {
  $.ajax({
    type: "POST",
    url: "../Backend_PM/select_product.php",
    data: {
      product_id: id,
      product_name: product_name,
      price: price,
      quantity: quantity,
      total_price: total_price,
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

$(document).on("click", ".delete-product", function () {
  var index = $(this).data("index");
  $.ajax({
    type: "POST",
    url: "../Backend_PM/delete_product.php",
    data: {
      product_index: index,
    },
    success: function (response) {
      var result = JSON.parse(response);
      if (result.status === "success") {
        toastr.success("Sản phẩm đã được xóa thành công.");
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

function resetSearchProduct(event) {
  event.preventDefault();
  $("#TimKiemProduct").val("");
  $.ajax({
    type: "POST",
    url: "../Backend_PM/products.php",
    success: function (response) {
      $("#result-product").html(response);
    },
    error: function () {
      alert("Error resetting search.");
    },
  });
}

function togglePopupThemGioHang() {
  document.getElementById("popup-2").classList.toggle("active");
}

function togglePopupChonNCC() {
  document.getElementById("popup-1").classList.toggle("active");
}
