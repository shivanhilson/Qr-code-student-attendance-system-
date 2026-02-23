<?php
$user = 'root';
$password = '';
$database = 'school_db';
$servername = 'localhost';

// Create connection
$mysqli = new mysqli($servername, $user, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die('' . $mysqli->connect_error);
} else {
    echo '';
}
?>