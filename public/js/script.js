// Show confirmation modal
function showConfirmModal() {
    document.getElementById('confirmModal').style.display = 'flex'; 
}

// Close the confirmation modal
function closeConfirmModal() {
    document.getElementById('confirmModal').style.display = 'none';
}

function submitForm() {
    document.getElementById('profileForm').submit();
}

$(document).ready(function() {
    if ('{{ Session::get("success") }}') {
        $('#customModal').fadeIn();

        var isSuccess = '{{ Session::get("success") }}' ? true : false;
        $('#modalTitle').text(isSuccess ? 'Success' : 'Error');
        $('#modalMessage').text('{{ Session::get("success") ?? Session::get("error") }}');
    }

    // Close the modal when the user clicks "OK"
    $('.close-modal-btn').click(function() {
        $('#customModal').fadeOut();
    });
});
