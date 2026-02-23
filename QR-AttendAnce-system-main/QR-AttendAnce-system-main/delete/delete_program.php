<?php
// Include the database connection file
include_once '../config/db_connection.php';

// Check if the program ID is provided
if (isset($_GET['id'])) {
    $program_id = $_GET['id'];

    // Delete the program record from the database
    $delete_query = "DELETE FROM programs WHERE program_id = ?";
    $delete_stmt = $mysqli->prepare($delete_query);
    $delete_stmt->bind_param("i", $program_id);

    // Attempt to execute the delete statement
    if ($delete_stmt->execute()) {
        // Redirect with a success message
        header("Location: ../view_programs.php?success=Program deleted successfully");
        exit();
    } else {
        // Redirect with an error message
        header("Location: ../view_programs.php?error=Error deleting program: " . $mysqli->error);
        exit();
    }
} else {
    // Redirect with an error message if program ID is not provided
    header("Location: ../view_programs.php?error=Program ID not provided");
    exit();
}
?>



