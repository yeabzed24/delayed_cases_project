<?php
// db_connect.php
$servername = "localhost";
$username = "root";  // Use your DB username
$password = "";      // Use your DB password
$dbname = "delayed_case";  // Use your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>