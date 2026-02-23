<?php
// Include the database connection file
include_once '../config/db_connection.php';

// Check if the registration number is provided
if (isset($_GET['id'])) {
    $reg_no = mysqli_real_escape_string($mysqli, $_GET['id']);
    
    // Delete the lecturer record from the database
    $query = "DELETE FROM lecturers WHERE lecturer_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $reg_no);
    if ($stmt->execute()) {
        header("Location: ../view_lecturers.php?success=lecturer deleted successfully");
        exit();
    } else {
        header("Location: ../view_lecturers.php?error=Error deleting lecturer: " . $mysqli->error);
        exit();
    }
} else {
    header("Location: ../view_lecturers.php?error= lecturer_id not provided");
    exit();
}
?>