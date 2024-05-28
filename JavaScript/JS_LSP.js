function populateTable(){
    $.ajax({
        type: "GET",
        url: "../Backend_LSP/loadLSP.php",
        success: function(data){
            $("#DanhSachLSP").html(data);
        },
        error: function(xhr, status, error){
            alert("Đã xảy ra lỗi: " + error);
        }
    });
}


function themLSP(){
    var tenDV = $("#themDonVi").val();
    if (!tenDV) {
        alert("Vui lòng nhập tên đơn vị");
        return;
    }
    $.ajax({
        type: "POST",
        url: "../Backend_LSP/themLSP.php",
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
        url: "../Backend_LSP/xoaLSP.php",
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
