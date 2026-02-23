<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Attendance</title>
    <style>
        /* CSS for responsive table */
        .table-responsive {
            overflow-x: auto;
        }

        .attendance-table {
            width: 98%;
            border-collapse: collapse;
        }

        .attendance-table th, .attendance-table td {
            padding: 8px;
        }

        /* CSS for color */
        .orange-text,.orange-line {
            color: orange;
        }

        /* CSS for background colors */
        .status-present {
            background-color: orange;
            padding: 4px;
            border-radius: 8px;
        }

        .status-absent {
            background-color: red;
            padding: 4px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <h1>Student Attendance Records</h1>
    <hr class="orange-line">
    <?php
    // Include database connection
    include 'config/db_connection.php';

    // Check if an intake is selected
    if(isset($_GET['intake'])) {
        // Sanitize the input
        $intake = mysqli_real_escape_string($mysqli, $_GET['intake']);

        // Query to fetch attendance records with program and course unit names for the selected intake
        $sql = "SELECT a.reg_no, a.full_name, a.time, a.date, a.status, a.comment
                FROM attendance a
                WHERE a.intake = '$intake'";
        
        $result = $mysqli->query($sql);

        // Check if there are attendance records
        if ($result->num_rows > 0) {
            // Display intake
            echo "<h2>Intake: <span class='orange-text'>$intake</span></h2>";

            // Output program name and course unit
            $program_query = "SELECT DISTINCT p.program_name, c.course_unit_name 
                              FROM programs p 
                              INNER JOIN attendance a ON p.program_id = a.program_id 
                              INNER JOIN course_units c ON c.course_unit_id = a.course_unit_id 
                              WHERE a.intake = '$intake'";
            $program_result = $mysqli->query($program_query);
            if ($program_result->num_rows > 0) {
                $row = $program_result->fetch_assoc();
                echo "<h3>Program Name: <span class='orange-text'>" . $row['program_name'] . "</span></h3>";
                echo "<h3>Course Unit: <span class='orange-text'>" . $row['course_unit_name'] . "</span></h3>";
            }

            // Output attendance records as a table
            echo "<div class='table-responsive'>";
            echo "<table class='attendance-table' border='1'>";
            echo "<tr><th>Reg No</th><th>Full Name</th><th>Time</th><th>Date</th><th>Status</th></tr>";
            while ($row = $result->fetch_assoc()) {
                // Determine the CSS class for the status word based on its content
                $status_class = ($row['status'] == 'present') ? 'status-present' : 'status-absent';
                
                echo "<tr>";
                echo "<td>" . $row['reg_no'] . "</td>";
                echo "<td>" . $row['full_name'] . "</td>";
                echo "<td>" . $row['time'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>";
                // Apply background color to the status word
                echo str_replace($row['status'], "<span class='$status_class'>" . $row['status'] . "</span>", $row['status']);
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";

            // Output comment
            $comment_query = "SELECT comment FROM attendance WHERE intake = '$intake' LIMIT 1";
            $comment_result = $mysqli->query($comment_query);
            if ($comment_result->num_rows > 0) {
                $row = $comment_result->fetch_assoc();
                echo "<h3>Comment: <br><span class='orange-text'>" . $row['comment'] . "</span></h3>";

            }
        } else {
            echo "No attendance records found for intake: $intake";
        }
    } else {
        echo "Please select an intake.";
    }

    // Close database connection
    $mysqli->close();
    ?>
</body>
</html>
