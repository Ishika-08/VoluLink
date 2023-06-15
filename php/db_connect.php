<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create a global variable to hold the database connection
global $connection;

$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
