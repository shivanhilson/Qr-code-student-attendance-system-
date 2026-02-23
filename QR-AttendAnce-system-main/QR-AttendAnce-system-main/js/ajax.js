$(document).ready(function () {
    // Function to fetch and display student records
    function displayStudents() {
        $.ajax({
            url: 'get_students.php',
            type: 'GET',
            success: function (response) {
                $('#student_table tbody').html(response); // Populate table with student records
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Log error message
                alert('Error: ' + xhr.responseText); // Show error message
            }
        });
    }

    // Function to open modal for adding/editing students
    $('#new_student_btn').click(function () {
        $('#student_modal').show(); // Show modal
    });

    // Function to handle form submission for adding/editing students
    $('#student_form').submit(function (e) {
        e.preventDefault(); // Prevent default form submission
        // Send AJAX request to add/edit student
        $.ajax({
            url: 'add_edit_student.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                alert(response); // Show success/error message
                $('#student_modal').hide(); // Hide modal
                displayStudents(); // Refresh student records
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Log error message
                alert('Error: ' + xhr.responseText); // Show error message
            }
        });
    });

    // Function to handle click event on close button of modal
    $('.close').click(function () {
        $('#student_modal').hide(); // Hide modal
    });

    // Initial display of student records
    displayStudents();
});
