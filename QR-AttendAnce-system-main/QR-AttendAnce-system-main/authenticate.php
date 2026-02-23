<?php
// Include database connection
include 'config/db_connection.php';

// Check if both username and role are received from the AJAX request
if(isset($_POST['username']) && isset($_POST['role'])){
    // Retrieve username and role from AJAX request
    $username = $_POST['username']; // Assuming sent via POST method
    $role = $_POST['role']; // Assuming sent via POST method

    if ($role == 'admin') {
        // Search for the username in the administrators table
        $query = "SELECT * FROM administrators WHERE admin_name = '$username'";
        $dashboardPage = 'admindash.php'; // Admin dashboard page
    } elseif ($role == 'lecturer') {
        // Search for the username in the lecturers table
        $query = "SELECT * FROM lecturers WHERE lecturer_name = '$username'";
        $dashboardPage = 'lecturer_dashboard.php'; // Lecturer dashboard page
    } else {
        // Invalid role selected
        http_response_code(401);
        exit;
    }

    $result = $mysqli->query($query);

    // Check if the username exists in the selected role table
    if ($result && $result->num_rows == 1) {
        // Authentication successful, redirect to the corresponding dashboard page
        http_response_code(200);
        echo $dashboardPage;
        exit;
    } else {
        // Username not found in the selected role table
        http_response_code(401);
        exit;
    }
} else {
    // Username or role not provided in the AJAX request
    http_response_code(400);
    exit;
}
?>