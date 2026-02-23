<?php
// Include the database connection file
include_once '../config/db_connection.php';

// Check if the registration number is provided
if (isset($_GET['id'])) {
    $reg_no = mysqli_real_escape_string($mysqli, $_GET['id']);
    
    // Delete the administrator record from the database
    $query = "DELETE FROM administrators WHERE admin_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $reg_no);
    if ($stmt->execute()) {
        header("Location: ../view_administrators.php?success=administrator deleted successfully");
        exit();
    } else {
        header("Location: ../view_administrator.php?error=Error deleting administrator: " . $mysqli->error);
        exit();
    }
} else {
    header("Location: ../view_administrators.php?error= administrator_id not provided");
    exit();
}
?>