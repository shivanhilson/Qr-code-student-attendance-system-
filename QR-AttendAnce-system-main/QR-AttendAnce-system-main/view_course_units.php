

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Course Units</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            color: #04AA6D;
            padding: 10px;
        }
        hr {
            color: rgb(255, 136, 0);
            margin-bottom: 20px;
        }
        h1 {
            color:#04AA6D;
            padding: 10px;
            margin-bottom: 10px;
        }
        table {
            width: 98%;
            border-collapse: collapse;
        }
        th, td {
            padding: 7px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #04AA6D;
        }
        @media screen and (max-width: 480px) {
            /* Responsive layout for screens up to 480px */
            table {
                overflow-x: auto;
            }
            table {
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }


        }
.delete-btn {
    background-color: orange;
    color: green;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}
.delete-btn:hover {
    color: white;
    background-color: #04AA6D;
}    
    </style>
</head>
<body>
    <h1>Course Units</h1>
    <hr>
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th>Course Code</th>
                <th>Course Unit Name</th>
                <th>Description</th>
                <th>Program</th>
                <th>Lecturer</th>
                <th>Actions</th>
            </tr>
            <!-- Fetch and display data from the 'course_units' table here -->
            <?php
            // Include database connection
            include 'config/db_connection.php';

            // SQL query to fetch course units data with program name and lecturer name
            $sql = "SELECT cu.course_unit_id, cu.course_code, cu.course_unit_name, cu.description, p.program_name, l.lecturer_name 
                    FROM course_units cu 
                    JOIN programs p ON cu.program_id = p.program_id 
                    JOIN lecturers l ON cu.lecturer_id = l.lecturer_id";
            $result = $mysqli->query($sql);

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['course_code'] . "</td>";
                echo "<td>" . $row['course_unit_name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['program_name'] . "</td>";
                echo "<td>" . $row['lecturer_name'] . "</td>";
                echo "<td class='action-buttons'>
                <a class='delete-btn' href='delete/delete_course_units.php?id=" . $row['course_unit_id'] . "' onclick='return confirm(\"Are you sure you want to delete this course unit?\")'>Delete</a>
                </td>";
                echo "</tr>";
            }

            // Close database connection
            $mysqli->close();
            ?>
        </table>
    </div>
</body>
</html>
