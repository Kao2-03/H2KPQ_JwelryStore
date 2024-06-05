$(document).ready(function() {
    $('#search-form').on('submit', function(event) {
        event.preventDefault();
        var keyword = $('#TimKiem').val();
        if (keyword) {
            $.ajax({
                type: 'POST',
                url: '../Backend/NCC/search_supplier.php',
                data: {
                    search_keyword: keyword
                },
                success: function(response) {
                    $('#collapse3').html(response);
                },
                error: function() {
                    alert('Error searching suppliers.');
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
        url: '../BackEnd/NCC/display_suppliers.php',
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

function openEditPopup(maNCC, ten, diachi, sdt) {
    document.getElementById('edit-MaNCC').value = maNCC;
    document.getElementById('edit-ten').value = ten;
    document.getElementById('edit-diachi').value = diachi;
    document.getElementById('edit-sdt').value = sdt;

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
        form.setAttribute("action", "../BackEnd/NCC/delete_supplier.php");

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


