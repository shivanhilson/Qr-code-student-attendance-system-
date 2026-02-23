<?php
// Include the database connection file
include_once '../config/db_connection.php';

// Check if the course unit ID is provided
if (isset($_GET['id'])) {
    $course_unit_id = mysqli_real_escape_string($mysqli, $_GET['id']);
    
    // Delete the course unit record from the database
    $query = "DELETE FROM `course_units` WHERE course_unit_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $course_unit_id);
    if ($stmt->execute()) {
        header("Location: ../view_course_units.php?success=Course unit deleted successfully");
        exit();
    } else {
        header("Location: ../view_course_units.php?error=Error deleting course unit: " . $mysqli->error);
        exit();
    }
} else {
    header("Location: ../view_course_units.php?error=Course unit ID not provided");
    exit();
}
?>

