<?php
// Include database connection
include 'config/db_connection.php';



// Retrieve data from the departments table
$sql = "SELECT * FROM departments";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Departments</title>
    <link rel="stylesheet" href="css/views.css">
    <style>
        body{
    color: #04AA6D;
    padding: 10px;
}
hr{
    color: rgb(255, 136, 0);
    margin-bottom: 20px;
    
}
h1{
    color:#04AA6D ;
    padding: 10px;
    margin-bottom: 10px;
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
    <h1>Departments</h1>
    <hr>
    <table>
        <tr>
            <th>ID</th>
            <th>Department Name</th>
            <th>Description</th>
            <th>Actions</th>

        </tr>
        <?php
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['department_id'] . "</td>";
            echo "<td>" . $row['department_name'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td class='action-buttons'>
            <a class='delete-btn' href='delete/delete_department.php?id=" . $row['department_id'] . "' onclick='return confirm(\"Are you sure you want to delete this department?\")'>Delete</a>
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
