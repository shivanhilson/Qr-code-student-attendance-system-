<?php
// Include database connection
include '../config/db_connection.php'; // Adjust the path as needed

// Retrieve form data and sanitize inputs
$intake = isset($_POST['intake']) ? $mysqli->real_escape_string($_POST['intake']) : '';
$start_date = isset($_POST['start_date']) ? $mysqli->real_escape_string($_POST['start_date']) : '';
$end_date = isset($_POST['end_date']) ? $mysqli->real_escape_string($_POST['end_date']) : '';

// Prepare and execute SQL statement to insert data into database
$sql = "INSERT INTO settings (intake, start_date, end_date) VALUES ('$intake', '$start_date', '$end_date')";
if ($mysqli->query($sql) === true) {
    // Data inserted successfully
    echo "Settings saved successfully";
} else {
    // Error occurred while inserting data
    echo "Error: " . $mysqli->error;
}

// Close database connection
$mysqli->close();
?>
