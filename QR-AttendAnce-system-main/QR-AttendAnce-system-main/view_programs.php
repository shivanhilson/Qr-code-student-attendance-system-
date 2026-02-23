<?php
// Include database connection
include 'config/db_connection.php';


// Retrieve data from the programs table
$sql = "SELECT * FROM programs";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Programs</title>
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
    <h1>Programs</h1>
    <hr>
    <table>
        <tr>
            <th>ID</th>
            <th>Program Name</th>
            <th>Period</th>
           
        </tr>
        <?php
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['program_id'] . "</td>";
            echo "<td>" . $row['program_name'] . "</td>";
            echo "<td>" . $row['period'] . "</td>";
           
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
