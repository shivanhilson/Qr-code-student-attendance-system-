

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Students</title>
    <style>
        /* Define styles for the delete button */
        .delete-btn, .edit-btn {
            background-color: orange;
            color: green;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        /* Style the delete button on hover */
        .edit-btn:hover {
            color: white;
            background-color: #04AA6D;
        }

        .delete-btn:hover {
            color: white;
            background-color: #04AA6D;
        }

        .new_student_btn {
            color: white;
            background-color: #04AA6D;
            border-radius: 8px;
            text-decoration: none;
            padding: 5px;
            display: inline-block;
            margin-bottom: 10px; /* Add margin at the bottom */
        }

        .action-buttons {
            white-space: nowrap; /* Prevent line breaks */
        }

        /* Table styles */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 98%;
            border-collapse: collapse;
            border-collapse: collapse;
         
        }

        th, td {
            border: 1px solid green; /* Set border color to green */
            padding: 7px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Media query for smaller screens */
        @media screen and (max-width: 480px) {
            .new_student_btn {
                display: block;
                width: 100%;
            }
        }

        /* Media query for very small screens */
        @media screen and (max-width: 310px) {
            .new_student_btn {
                display: block;
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="pop.css">
    <link rel="stylesheet" href="pop2.css">
</head>
<body>
    <h1>Students</h1>
    <hr><br>
    <a class='new_student_btn' href="" onclick="openForm('student-popup')">Add New Student</a><br><br>

    <div class="table-container">
        <table>
            <tr>
                <th>Registration Number</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Program</th>
                <th>Intake</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
            <?php
            include_once 'config/db_connection.php';

            // Fetch all data
            $query = "SELECT s.reg_no, s.full_name, s.dob, s.gender, p.program_name, s.intake, s.phone 
                      FROM students s 
                      INNER JOIN programs p ON s.program_id = p.program_id";
                      
            $result = $mysqli->query($query);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['reg_no'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['program_name'] . "</td>";
                    echo "<td>" . $row['intake'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td class='action-buttons'>
                          <a class='edit-btn' href='edit-student.php?reg_no=" . $row['reg_no'] . "'>Edit</a>
                          <a class='delete-btn' href='delete/delete_student.php?id=" . $row['reg_no'] . "' onclick='return confirm(\"Are you sure you want to delete this student?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found.</td></tr>";
            }
            ?>
        </table>
    </div>

    

    <section id="student-popup" class="forms-popup">
        <span class="close" onclick="closeForm('student-popup')">&times;</span>
        <form action="register_student.php" method="post" class="form-container">
            <h2>Register Student</h2>

            <label for="fname"><b>Full Name:</b></label>
            <input type="text" placeholder="Enter Full Name" name="fname" required><br>

            <label for="reg_no"><b>Reg. No:</b></label>
            <input type="text" placeholder="Reg. No" name="reg_no" required><br>

            <label for="dob"><b>Date of Birth:</b></label>
            <input type="date" name="dob" required><br>

            <label for="gender"><b>Gender:</b></label><br>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>

            <label for="pn"><b>Program:</b></label><br>
            <select name="pn" id="pn" required onchange="updateProgramName()">
                <option value="">Select Program</option>
                <!-- Populate with options from database -->
                <?php
                // Include database connection
                include 'config/db_connection.php';

                // Fetch programs from the database
                $program_query = "SELECT * FROM programs";
                $program_result = $mysqli->query($program_query);

                // Check if query executed successfully
                if ($program_result && $program_result->num_rows > 0) {
                    // Fetch and display programs
                    while ($row = $program_result->fetch_assoc()) {
                        echo "<option value='" . $row['program_id'] . "'>" . $row['program_name'] . "</option>"; // Updated to use program ID
                    }
                } else {
                    echo "<option value=''>No programs found</option>";
                }
                ?>
            </select><br>

            <label for="intake"><b>Intake/Class</b></label>
            <input type="text" placeholder="Enter Intake" name="intake" required><br>

            <label for="phone"><b>Phone Number:</b></label>
            <input type="tel" placeholder="Enter Phone Number" name="phone" required><br>

            <!-- Submit button -->
            <button type="submit">Register</button>
        </form>
    </section>

    <script src="pops.js"></script>
    <script src="pop.js"></script>

</body>
</html>
