<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include 'config/db_connection.php';

    // Retrieve form data and sanitize inputs
    $lecturer_name = mysqli_real_escape_string($mysqli, $_POST['lecturer_name']);
    $program_id = mysqli_real_escape_string($mysqli, $_POST['program']);
    $department_id = mysqli_real_escape_string($mysqli, $_POST['department']);
    $qualifications = mysqli_real_escape_string($mysqli, $_POST['qualifications']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);

    // Prepare SQL statement
    $sql = "INSERT INTO lecturers (lecturer_name, program_id, qualifications, phone, gender) 
            VALUES ('$lecturer_name', '$program_id', '$qualifications', '$phone', '$gender')";

    // Execute SQL statement
    if ($mysqli->query($sql) === true) {
        // Success message
        echo "Lecturer registered successfully";
    } else {
        // Error message
        echo "Error: " . $mysqli->error;
    }

    // Close database connection
    $mysqli->close();
}
?>