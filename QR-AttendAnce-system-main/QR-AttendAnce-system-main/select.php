<!-- HTML Form -->

<link rel="stylesheet" href="css/select.css">

<div class="title-container">
    <h2 class="title" style="color: green;">View Student Attendance Records</h2>
</div>


<form id="viewStudentsForm">
    <label for="intake">Select Intake:</label>
    <select name="intake" id="intake">
        <?php
        // Include database connection
        include 'config/db_connection.php';

        // Retrieve existing intakes from the database
        $sql = "SELECT DISTINCT intake FROM students";
        $result = $mysqli->query($sql);

        // Check if there are intakes
        if ($result->num_rows > 0) {
            // Output each intake as an option in the select dropdown
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['intake'] . "'>" . $row['intake'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>No intakes found</option>";
        }

        // Close database connection
        $mysqli->close();
        ?>
    </select>
    <button type="button" onclick="loadAttendanceList()">View Students</button>
</form>

<!-- Container to display the attendance list -->
<div id="viewContainer" class="section"></div>

<script>
function loadAttendanceList() {
    // Serialize form data
    var formData = $('#viewStudentsForm').serialize();

    // AJAX request to load attendance list
    $.ajax({
        type: 'GET',
        url: 'view_student_attendance.php', // Update with the correct URL
        data: formData,
        success: function(response) {
            // Load attendance list into container
            $('#viewContainer').html(response);
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}
</script>
