<?php
// Include database connection
include 'config/db_connection.php';



// Retrieve data from the lecturers table with program name
$sql = "SELECT lecturers.lecturer_id, lecturers.lecturer_name, programs.program_name, lecturers.qualifications, lecturers.phone, lecturers.gender
        FROM lecturers
        INNER JOIN programs ON lecturers.program_id = programs.program_id"; // Assuming 'program_id' is the foreign key in the 'lecturers' table
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lecturers</title>
    <link rel="stylesheet" href="css/views.css">
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
</head>

<body>
    <h1>Lecturers</h1>
    <hr><br>
    <table>
        <tr>
            <th>Lecturer Name</th>
            <th>Program</th>
            <th>Qualifications</th>
            <th>Phone Number</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
        <?php
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['lecturer_name'] . "</td>";
            echo "<td>" . $row['program_name'] . "</td>"; // Fetching program name from joined table
            echo "<td>" . $row['qualifications'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td class='action-buttons'>
            <a class='delete-btn' href='delete/delete_lecturer.php?id=" . $row['lecturer_id'] . "' onclick='return confirm(\"Are you sure you want to delete this lecturer?\")'>Delete</a>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
// Close database connection
$mysqli->close();
?>