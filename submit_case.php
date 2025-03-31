<?php
// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include('db_connect.php');

// Get the form data
$case_id = $_POST['case_id'];
$bank_name = $_POST['bank_name'];
$branch_name = $_POST['branch_name'];
$district = $_POST['district'];
$delay_reason = $_POST['delay_reason'];
$technician_name = $_POST['technician_name'];

// Insert data into the database
$sql = "INSERT INTO cases (case_id, bank_name, branch_name, district, delay_reason, technician_name)
        VALUES ('$case_id', '$bank_name', '$branch_name', '$district', '$delay_reason', '$technician_name')";

if ($conn->query($sql) === TRUE) {
    echo "New case registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>