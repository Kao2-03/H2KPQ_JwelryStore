
    function capNhatBaoCao() {
        var thang = document.getElementById("thang").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true); // Gửi đến cùng file PHP hiện tại
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                hienThiBaoCao(data);
            }
        };
        xhr.send("thang=" + thang);
    }

    function hienThiBaoCao(data) {
        var container = document.getElementById("baoCaoContainer");
        container.innerHTML = ""; // Xóa dữ liệu cũ trước khi hiển thị mới

        if (data.length > 0) {
            var table = "<table class='table table-bordered'><thead class='thead-dark'><tr><th>Mã CT</th><th>Sản phẩm</th><th>Tồn đầu</th><th>Mua vào</th><th>Bán ra</th><th>Tồn cuối</th></tr></thead><tbody>";
            for (var i = 0; i < data.length; i++) {
                table += "<tr><td>" + data[i].MaCT + "</td><td>" + data[i].SanPham + "</td><td>" + data[i].TonDau + "</td><td>" + data[i].MuaVao + "</td><td>" + data[i].BanRa + "</td><td>" + data[i].TonCuoi + "</td></tr>";
            }
            table += "</tbody></table>";
            container.innerHTML = table;
        } else {
            container.innerHTML = "Không có dữ liệu báo cáo cho tháng này.";
        }
    }
