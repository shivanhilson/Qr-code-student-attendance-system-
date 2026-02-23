<?php
// Include the database connection file
include_once '../config/db_connection.php';

// Check if the registration number is provided
if (isset($_GET['id'])) {
    $reg_no = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Delete attendance records associated with the student
    $delete_attendance_query = "DELETE FROM attendance WHERE reg_no = ?";
    $stmt_attendance = $mysqli->prepare($delete_attendance_query);
    $stmt_attendance->bind_param("s", $reg_no);
    $stmt_attendance->execute();
    $stmt_attendance->close();
    
    // Delete the student record from the database
    $delete_query = "DELETE FROM students WHERE reg_no = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param("s", $reg_no);
    if ($stmt->execute()) {
        header("Location: ../view_students.php?success=Student deleted successfully");
        exit();
    } else {
        header("Location: ../view_students.php?error=Error deleting student: " . $mysqli->error);
        exit();
    }
} else {
    header("Location: ../view_students.php?error=Registration number not provided");
    exit();
}
?>
