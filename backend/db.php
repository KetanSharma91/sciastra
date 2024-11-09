<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sciastra";  // Ensure your database name is correct

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
