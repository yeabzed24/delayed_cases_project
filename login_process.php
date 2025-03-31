<?php
session_start();

// Include the database connection file
require_once 'db_connect.php';  // Make sure the path is correct to your db_connect.php file

// Get the username and password from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// Define the SQL query
$sql = "SELECT * FROM users WHERE username = ?";  // This should be the correct SQL query

// Check if the query is prepared
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $username);  // Bind the username parameter to the query
    $stmt->execute();  // Execute the query
    $result = $stmt->get_result();  // Get the result of the query

    // Check if any rows are returned (i.e., if the username exists)
    if ($result->num_rows > 0) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();

        // Compare the password entered by the user with the password in the database (plain text comparison)
        if ($password == $row['password']) {
            // Password is correct, start the session and log the user in
            $_SESSION['loggedin'] = true;  // Set session variable for logged-in status
            $_SESSION['username'] = $row['username'];  // Store the username in session for later use
            $_SESSION['role'] = $row['role'];  // Store the role in session
            
            // Redirect the user to the appropriate page (manager or technician dashboard)
            if ($row['role'] == 'manager') {
                // Redirect to the manager's dashboard
                header("Location: manager_dashboard.php");
            } elseif ($row['role'] == 'technician') {
                // Redirect to the technician's dashboard (case submission form)
                header("Location: technician_submission_form.php");
            }
            exit();
        } else {
            // Password is incorrect
            echo "Invalid username or password!";
        }
    } else {
        // Username does not exist
        echo "Invalid username or password!";
    }

    // Close the statement
    $stmt->close();
} else {
    // If there was an issue with preparing the statement
    echo "There was an error with the query!";
}

// Close the database connection
$conn->close();
?>