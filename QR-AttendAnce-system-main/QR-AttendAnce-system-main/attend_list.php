<!-- HTML Form -->
<form id="viewStudentsForm" method="GET" action="attendencelist.php">
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

<!-- JavaScript -->
<script>
function loadAttendanceList() {
    // Serialize form data
    var formData = $('#viewStudentsForm').serialize();

    // AJAX request to load attendance list
    $.ajax({
        type: 'GET',
        url: $('#viewStudentsForm').attr('action'),
        data: formData,
        success: function(response) {
            // Load attendance list into container in index.php
            $('#viewContainer').html(response);
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}
</script>
