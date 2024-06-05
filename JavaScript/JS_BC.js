document.getElementById('update-btn').addEventListener('click', function() {
    var month = document.getElementById('thang').value;
    if (month) {
        fetch('../BackEnd_BaoCao/generate_report.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'thang=' + encodeURIComponent(month)
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('report-content').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
        alert('Vui lòng chọn tháng.');
    }
});

document.getElementById('download-btn').addEventListener('click', function() {
    var month = document.getElementById('thang').value;
    if (month) {
        window.location.href = '../BackEnd_BaoCao/download_report.php?thang=' + encodeURIComponent(month);
    } else {
        alert('Vui lòng chọn tháng.');
    }
});
