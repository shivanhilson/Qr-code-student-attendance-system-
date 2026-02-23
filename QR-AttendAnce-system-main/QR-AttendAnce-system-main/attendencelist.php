<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Attendance</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        h2{
            align-items: center;
            margin-top: 10px;
        }

        .comment-textarea {
            width: 50%; /* Reduce the comment text area width */
            margin-top: 10px;
            padding: 8px;
            border-radius: 15px;
            border-color: 1px solid #4CAF50; /* Add border radius */
        }

        button[type="submit"] {
            margin-top: 10px;
            padding: 10px;
            background-color: #4CAF50; /* Change background color */
            color: white; /* Change text color */
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Change select button background color and text color */
        select {
            background-color: #4CAF50;
            color: white;
        }

        /* Change border color of table cells */
        th,
        td {
            border: 1px solid #4CAF50;
            padding: 8px;
            text-align: left;
        }
        .table-container {
            overflow-x: auto; 
            margin-bottom: 20px; 
        }
    </style>
</head>

<body>
    <?php
    // Include database connection
    include 'config/db_connection.php';

    $course_units = [];

    // Fetch course units
    $course_units_query = "SELECT * FROM course_units";
    $course_units_result = $mysqli->query($course_units_query);
    if ($course_units_result === false) {
        echo "Error fetching course_units: " . $mysqli->error;
    } else {
        if ($course_units_result->num_rows > 0) {
            $course_units = $course_units_result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "";
        }
    }

    // Initialize variables
    $intake = $result = '';

    // Check if intake is selected
    if (isset($_GET['intake'])) {
        // Sanitize the input
        $intake = $mysqli->real_escape_string($_GET['intake']);

        // Retrieve students from the selected intake
        $sql = "SELECT * FROM students WHERE intake = '$intake'";
        $result = $mysqli->query($sql);

        // Check if the query was successful
        if (!$result) {
            echo "Error: Unable to fetch attendance data.";
            exit;
        }
    ?>

        <h2>Take Attendance for Intake: <?php echo $intake; ?></h2>
        <form action="process_attendance.php" method="post">
            <input type="hidden" name="intake" value="<?php echo $intake; ?>">
            <label for="cu"><b>Course Unit:</b></label><br>
            <select name="cu" id="cu" required>
                <option value="">Select Course Unit</option>
                <!-- Populate with options from database -->
                <?php
                // Include database connection
                include 'config/db_connection.php';

                // Fetch course units from the database
                $course_unit_query = "SELECT * FROM course_units";
                $course_unit_result = $mysqli->query($course_unit_query);

                // Check if query executed successfully
                if ($course_unit_result && $course_unit_result->num_rows > 0) {
                    // Fetch and display course units
                    while ($row = $course_unit_result->fetch_assoc()) {
                        echo "<option value='" . $row['course_unit_id'] . "'>" . $row['course_unit_name'] . "</option>"; // Updated to use course unit ID and name
                    }
                } else {
                    echo "<option value=''>No course units found</option>";
                }
                ?>
            </select><br>

            <table>
                <thead>
                    <tr>
                        <th>Registration Number</th>
                        <th>Student Name</th>
                        <th>Attendance Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Output each student's data in a table row with radio buttons for attendance status
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['reg_no'] . "</td>";
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td>";
                        echo "<label><input type='radio' name='attendance[{$row['reg_no']}]' value='present' required> Present</label>";
                        echo "<label><input type='radio' name='attendance[{$row['reg_no']}]' value='absent'> Absent</label>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <textarea class="comment-textarea" name="comment" rows="4" placeholder="Enter your comment here"></textarea>
            <button type="submit">Submit Attendance</button>
        </form>
    <?php
    } else {
        // Redirect to the page with the intake selection form if no intake is selected
        header("Location: select_intake.php");
        exit;
    }

    // Close database connection
    $mysqli->close();
    ?>
</body>

</html>
