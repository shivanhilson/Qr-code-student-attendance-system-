<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include 'config/db_connection.php';

    // Retrieve form data and sanitize inputs
    $admin_name = mysqli_real_escape_string($mysqli, $_POST['admin_name']);
    $role = mysqli_real_escape_string($mysqli, $_POST['role']);
    $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);

    // Prepare SQL statement
    $sql = "INSERT INTO administrators (admin_name, role, gender, phone) 
            VALUES ('$admin_name', '$role', '$gender', '$phone')";

    // Execute SQL statement
    if ($mysqli->query($sql) === true) {
        // Success message
        echo "Administrator registered successfully";
    } else {
        // Error message
        echo "Error: " . $mysqli->error;
    }

    // Close database connection
    $mysqli->close();
}
?>