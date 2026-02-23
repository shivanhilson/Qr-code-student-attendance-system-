<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include 'config/db_connection.php';

    // Escape user inputs for security
    $program_name = mysqli_real_escape_string($mysqli, $_POST['pn']);
    $period = mysqli_real_escape_string($mysqli, $_POST['period']);

    // Attempt to insert the data into the database
    $sql = "INSERT INTO programs (program_name, period) 
            VALUES ('$program_name', '$period')";

    if ($mysqli->query($sql) === true) {
        echo "<script>alert('Program added successfully');</script>";
    } else {
        echo "<script>alert('Error: Unable to add program');</script>";
    }

    // Close database connection
    $mysqli->close();
}
?>
