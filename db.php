<?php
$servername = "localhost";  // Change if you're using a remote server
$username = "root";         // Change to your MySQL username
$password = "";             // Change to your MySQL password
$dbname = "regform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
