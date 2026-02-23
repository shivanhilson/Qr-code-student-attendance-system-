<?php
// Include database connection
include '../config/db_connection.php'; // Assuming the config folder is one level above the current directory

// Check if the connection is successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve all settings from the database
$sql = "SELECT * FROM settings ORDER BY id DESC"; // Assuming settings are stored in a table named 'settings'
$result = $mysqli->query($sql);

// Check if settings exist
if ($result && $result->num_rows > 0) {
    $settings = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $settings = array(); // Empty array if no settings found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance System Settings</title>
    <link rel="stylesheet" href="view_settings.css">
    <style>

:root {
    --background-color1: #fafaff; 
    --background-color2: #f5ecdd; 
    --background-color3: #f5ecdd; 
    --background-color4: rgb(255, 255, 223); 
    --primary-color: #ff8902; 
    --secondary-color: #ff8902; 
    --Border-color: #04AA6D; 
    --one-use-color: #04AA6D;
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--background-color1);
    margin: 0;
    padding: 20px;
    color: var(--Border-color);
}

.container {
    max-width: 600px;
    margin: 0 auto;
    background-color: var(--background-color2);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
}

.settings {
    margin-top: 20px;
}

h2 {
    margin-bottom: 10px;
}

p {
    margin-bottom: 5px;
}

strong {
    font-weight: bold;
}
    </style>
    <!-- Link to external CSS file -->
</head>
<body>
    <div class="container">
        <h1>View Attendance System Settings</h1>
        <hr style="color: #ff8902;">
        <?php if (!empty($settings)) : ?>
            <div class="settings">
                <h2>All Intakes and Dates:</h2>
                <ul>
                    <?php foreach ($settings as $setting) : ?>
                        <li>
                            <strong>Intake:</strong> <?php echo $setting['intake']; ?> |
                            <strong>Start Date:</strong> <?php echo $setting['start_date']; ?> |
                            <strong>End Date:</strong> <?php echo $setting['end_date']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else : ?>
            <p>No settings found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
