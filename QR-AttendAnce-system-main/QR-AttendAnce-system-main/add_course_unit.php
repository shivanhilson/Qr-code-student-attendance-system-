<?php
// Include database connection
include 'config/db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $course_code = $_POST["course_code"];
    $course_unit_name = $_POST["course_unit_name"];
    $description = $_POST["description"];
    $program_id = $_POST["program"];
    $lecturer_id = $_POST["lecturer_id"];

    // Prepare SQL statement to insert data into course_units table
    $insert_query = "INSERT INTO course_units (course_code, course_unit_name, description, program_id, lecturer_id) 
                     VALUES (?, ?, ?, ?, ?)";
                     
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("sssss", $course_code, $course_unit_name, $description, $program_id, $lecturer_id);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "New course unit added successfully!";
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close statement and database connection
    $stmt->close();
    $mysqli->close();
}
?>
