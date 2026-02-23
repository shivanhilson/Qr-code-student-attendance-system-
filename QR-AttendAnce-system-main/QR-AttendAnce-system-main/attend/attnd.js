
function loadView(view) {
    // AJAX request to load view
    $.ajax({
        type: 'GET',
        url: view,
        success: function(response) {
            // Load view into container
            $('#viewContainer').html(response);
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}


