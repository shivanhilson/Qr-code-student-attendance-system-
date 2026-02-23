<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include 'config/db_connection.php';

    // Escape user inputs for security
    $department_name = mysqli_real_escape_string($mysqli, $_POST['dp']);
    $description = mysqli_real_escape_string($mysqli, $_POST['dd']);

    // Attempt to insert the data into the database
    $sql = "INSERT INTO departments (department_name, description) 
            VALUES ('$department_name', '$description')";

    if ($mysqli->query($sql) === true) {
        echo "<script>alert('Department added successfully');</script>";
    } else {
        echo "<script>alert('Error: Unable to add department');</script>";
    }

    // Close database connection
    $mysqli->close();
}
?>
