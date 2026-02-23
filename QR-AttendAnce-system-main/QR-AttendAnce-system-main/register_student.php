<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include 'config/db_connection.php';

    // Retrieve form data and sanitize inputs
    $fname = mysqli_real_escape_string($mysqli, $_POST['fname']);
    $reg_no = mysqli_real_escape_string($mysqli, $_POST['reg_no']);
    $dob = mysqli_real_escape_string($mysqli, $_POST['dob']);
    $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
    $program_id = mysqli_real_escape_string($mysqli, $_POST['pn']);
    $intake_id = mysqli_real_escape_string($mysqli, $_POST['intake']); // Get the selected intake ID
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);

    // Retrieve intake name based on intake ID
    $intake_query = "SELECT intake FROM settings WHERE id = '$intake_id'";
    $intake_result = $mysqli->query($intake_query);
    if ($intake_result && $intake_result->num_rows > 0) {
        $intake_row = $intake_result->fetch_assoc();
        $intake = $intake_row['intake'];

        // Prepare SQL statement
        $sql = "INSERT INTO students (full_name, reg_no, dob, gender, program_id, intake, phone) 
                VALUES ('$fname', '$reg_no', '$dob', '$gender', '$program_id', '$intake', '$phone')";

        // Execute SQL statement
        if ($mysqli->query($sql) === true) {
            // Success message
            echo "Student registered successfully";
        } else {
            // Check if the error is a duplicate entry error
            if ($mysqli->errno == 1062) { // Error code for duplicate entry
                // Debugging code
                echo "Duplicate entry error occurred. Redirecting...";
                
                // Meta tag redirect
                echo "<meta http-equiv='refresh' content='0;URL=duplicate_entry_error.php'>";
                exit();
            } else {
                // Error message for other errors
                echo "Error: " . $mysqli->error;
            }
        }
    } else {
        echo "Error: Intake ID not found";
    }

    // Close database connection
    $mysqli->close();
}
?>
