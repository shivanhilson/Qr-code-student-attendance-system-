<?php
// Include database connection
include 'config/db_connection.php';

// Query to get the total number of students
$query = "SELECT COUNT(*) AS total_students FROM students";
$result = $mysqli->query($query);

// Check if the query executed successfully
if ($result) {
    $row = $result->fetch_assoc();
    $total_students = $row['total_students'];
} else {
    // Error handling
    $total_students = "Error fetching total students";
}

// Close database connection
$mysqli->close();
?>