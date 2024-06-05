$(document).ready(function() {
    $('#search-form').on('submit', function(event) {
        event.preventDefault();
        var keyword = $('#TimKiem').val();
        if (keyword) {
            $.ajax({
                type: 'POST',
                url: '../Backend_DV/search_loaidv.php',
                data: {
                    search_keyword: keyword
                },
                success: function(response) {
                    $('#collapse3').html(response);
                },
                error: function() {
                    alert('Error searching service.');
                }
            });
        }
    });
});

function resetSearch() {
    $('#TimKiem').val('');
    $.ajax({
        type: 'POST',
        url: '../Backend_DV/display_loaidv.php',
        success: function(response) {
            $('#collapse3').html(response);
        },
        error: function() {
            alert('Error resetting search.');
        }
    });
}

function togglePopupThemNCC() {
    document.getElementById("popup-1").classList.toggle("active");
}

function openEditPopup(ID, TenLoai, DonGia) {
    document.getElementById('edit-ID').value = ID;
    document.getElementById('edit-TenLoai').value = TenLoai;
    document.getElementById('edit-DonGia').value = DonGia;
    document.getElementById('edit-id-display').innerText = ID;

    document.getElementById('popup-2').classList.add('active');
    document.getElementById('overlay-edit').classList.add('active');
}

function closeEditPopup() {
    document.getElementById('popup-2').classList.remove('active');
    document.getElementById('overlay-edit').classList.remove('active');
}

function deleteloaidv(ID) {
    document.getElementById("confirm-popup").style.display = 'block';
    document.getElementById("confirm-overlay").style.display = 'block';

    document.getElementById("confirm-yes").onclick = function() {
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "../Backend_DV/delete_loaidv.php");

        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "ID");
        hiddenField.setAttribute("value", ID);

        form.appendChild(hiddenField);

        document.body.appendChild(form);
        form.submit();
    };

    document.getElementById("confirm-no").onclick = function() {
        document.getElementById("confirm-popup").style.display = 'none';
        document.getElementById("confirm-overlay").style.display = 'none';
    };
}

