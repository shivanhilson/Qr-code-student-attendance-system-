<?php
// Include database connection
include_once 'config/db_connection.php';

// Check if registration number is provided
if(isset($_POST['reg_no'])) {
    $reg_no = $_POST['reg_no'];

    // Retrieve updated student data from the form
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $program_id = $_POST['program'];
    $intake = $_POST['intake'];
    $phone = $_POST['phone'];

    // Prepare and execute the update query
    $update_query = "UPDATE students 
                     SET full_name = '$full_name', dob = '$dob', gender = '$gender', program_id = '$program_id', intake = '$intake', phone = '$phone' 
                     WHERE reg_no = '$reg_no'";
    $update_result = $mysqli->query($update_query);

    // Check if the query executed successfully
    if ($update_result === false) {
        echo "Error updating student data: " . $mysqli->error;
    } else {
        echo "Student data updated successfully.";
    }
} else {
    echo "Registration number not provided.";
}
?>
