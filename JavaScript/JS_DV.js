function populateTable(){
    $.ajax({
        type: "GET",
        url: "../Backend_DV/loadDV.php",
        success: function(data){
            $("#DanhSachDV").html(data);
        },
        error: function(xhr, status, error){
            alert("Đã xảy ra lỗi: " + error);
        }
    });
}


function themDV(){
    var tenDV = $("#themDonVi").val();
    if (!tenDV) {
        alert("Vui lòng nhập tên đơn vị");
        return;
    }
    $.ajax({
        type: "POST",
        url: "../Backend_DV/themDV.php",
        data: {tenDV: tenDV},
        success: function(data){
            alert(data); // Hiển thị thông báo từ server
            populateTable(); // Gọi hàm populateTable() sau khi thêm đơn vị thành công
        },
    });
}

function xoaDV(madv){
    $.ajax({
        type: "POST",
        url: "../Backend_DV/xoaDV.php",
        data: {maDV: madv},
        success: function(data){
            alert(data); // Hiển thị thông báo từ server
            populateTable();
        },
        error: function(xhr, status, error){
            alert("Đã xảy ra lỗi: " + error);
        }
    });
}
