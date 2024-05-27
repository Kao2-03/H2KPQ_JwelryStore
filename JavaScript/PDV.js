
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
        LoaiDV: LoaiDV,
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
    var Tenkhachhang = $(".tenKH").text()
    var SDT = $(".sdt").text()
    var tratruoc = $(".tratrc").text()
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
      };
  
    var formData = {
      tenKh: KhachHang,
      Sdt: SDT,
      current_date: NgayLap,
      total_payment: ThanhTien,
      service: JSON.stringify(loaiDV),
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
    })

  function togglePopupThemGioHang() {
    document.getElementById("popup-2").classList.toggle("active");
  }
  