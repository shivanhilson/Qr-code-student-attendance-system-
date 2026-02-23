<?php
// Include database connection
include 'config/db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $intake = $mysqli->real_escape_string($_POST['intake']);
    $comment = $mysqli->real_escape_string($_POST['comment']);
    $course_unit_id = $mysqli->real_escape_string($_POST['cu']); // Retrieve course_unit_id from the form data

    // Check if intake and course unit are selected
    if (isset($intake) && isset($course_unit_id)) {
        // Get program_id associated with the selected course unit
        $program_query = "SELECT program_id FROM course_units WHERE course_unit_id = '$course_unit_id'";
        $program_result = $mysqli->query($program_query);

        if ($program_result && $program_result->num_rows == 1) {
            $row = $program_result->fetch_assoc();
            $program_id = $row['program_id'];

            // Loop through attendance data
            foreach ($_POST['attendance'] as $reg_no => $status) {
                // Sanitize reg_no and status
                $reg_no = $mysqli->real_escape_string($reg_no);
                $status = $mysqli->real_escape_string($status);

                // Retrieve student_id and full_name based on reg_no
                $student_query = "SELECT reg_no, full_name FROM students WHERE reg_no = '$reg_no'";
                $student_result = $mysqli->query($student_query);

                if ($student_result->num_rows == 1) {
                    $student_row = $student_result->fetch_assoc();
                    $full_name = $student_row['full_name'];

                    // Get current time and date
                    $current_time = date('H:i:s');
                    $current_date = date('Y-m-d');

                    // Insert attendance record into database
                    $insert_query = "INSERT INTO attendance (reg_no, full_name, program_id, course_unit_id, time, date, status, intake, comment) 
                                     VALUES ('$reg_no', '$full_name', '$program_id', '$course_unit_id', '$current_time', '$current_date', '$status', '$intake', '$comment')";
                    
                    if ($mysqli->query($insert_query)) {
                        echo "Attendance submitted successfully.";
                    } else {
                        echo "Error: " . $mysqli->error;
                    }
                } else {
                    echo "Error: Student with registration number $reg_no not found.";
                }
            }
        } else {
            echo "Error: Program ID not found for the selected course unit.";
        }
    } else {
        echo "Error: Intake or Course unit not selected.";
    }
} else {
    echo "Error: Form not submitted.";
}

// Close database connection
$mysqli->close();
?>
