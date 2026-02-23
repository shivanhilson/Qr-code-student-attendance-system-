<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #04AA6D;
            font-weight: 500;
        }
        form{
            border: 1px solid orange;
            border-radius: 6px;
            padding: 15px;
            
        }
        

        h1 {
            text-align: center;
        }

        form {
            width: 50%;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            color: orange;
            font-weight: 800;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Student</h1>
    <hr>
    <form action="update-student.php" method="post">
        <?php
        // Include database connection
        include_once 'config/db_connection.php';

        // Initialize an empty array to store programs
        $programs = [];

        // Fetch programs
        $program_query = "SELECT * FROM programs";
        $program_result = $mysqli->query($program_query);
        if ($program_result === false) {
            echo "Error fetching programs: " . $mysqli->error;
        } else {
            if ($program_result->num_rows > 0) {
                $programs = $program_result->fetch_all(MYSQLI_ASSOC);
            }
        }

        // Check if registration number is provided
        if(isset($_GET['reg_no'])) {
            $reg_no = $_GET['reg_no'];

            // Fetch student data based on registration number
            $query = "SELECT students.*, programs.program_name 
                      FROM students 
                      LEFT JOIN programs ON students.program_id = programs.program_id 
                      WHERE students.reg_no = '$reg_no'";
            $result = $mysqli->query($query);

            // Check if the query executed successfully
            if ($result === false) {
                echo "Error fetching student data: " . $mysqli->error;
            } else {
                if ($result->num_rows > 0) {
                    $student = $result->fetch_assoc();
                    ?>
                    <input type="hidden" name="reg_no" value="<?php echo $student['reg_no']; ?>">
                    <label for="full_name">Full Name:</label><br>
                    <input type="text" id="full_name" name="full_name" value="<?php echo $student['full_name']; ?>"><br>
                    <label for="dob">Date of Birth:</label><br>
                    <input type="text" id="dob" name="dob" value="<?php echo $student['dob']; ?>"><br>
                    <label for="gender">Gender:</label><br>
                    <input type="text" id="gender" name="gender" value="<?php echo $student['gender']; ?>"><br>
                    <label for="program">Program:</label><br>
                    <select id="program" name="program">
                        <?php foreach ($programs as $program) : ?>
                            <option value="<?php echo $program['program_id']; ?>" <?php echo ($program['program_id'] == $student['program_id']) ? 'selected' : ''; ?>>
                                <?php echo $program['program_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
                    <label for="intake">Intake/Class:</label><br>
                    <input type="text" id="intake" name="intake" value="<?php echo $student['intake']; ?>"><br>
                    <label for="phone">Phone Number:</label><br>
                    <input type="text" id="phone" name="phone" value="<?php echo $student['phone']; ?>"><br><br>
                    <input type="submit" value="Update">
                    <?php
                } else {
                    echo "Student not found.";
                }
            }
        } else {
            echo "Registration number not provided.";
        }
        ?>
    </form>
</body>
</html>
