<?php
session_start();  // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Check if the user is logged in and is a manager
if (!isset($_SESSION['loggedin']) ||
$_SESSION['loggedin'] != true ||
$_SESSION['role'] != 'manager') {
    header("Location: login.php");
    // Redirect to login page if not logged in  or not a manager
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delayed Cases Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(250, 248, 248);
            margin: 0;
        }
        .header {
            background-color:rgb(236, 131, 32);
            color: white;
            padding: 10px;
            text-align: center;
        }
        .sidebar {
            height: 100%;
            width: 200px;
            background-color:rgb(255, 255, 255);
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 8px 16px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
            border-bottom: 1px solid #ddd;
        }
        .sidebar a:hover {
            background-color: #ddd;
            color: Black;
        }
        .content {
            margin-left: 210px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color:rgb(203, 209, 203);
            color: Black;
        }
        tr:hover {
            background-color:rgb(159, 250, 39);
        }
        .logout-btn {
            background-color:rgb(255, 254, 254);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>Delayed Cases Dashboard</h1>
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="manager_dashboard.php">Dashboard</a>
        <a href="view_reports.php">View Reports</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Main Content Area -->
    <div class="content">
        <h2>Submitted Cases</h2>

        <?php
        // Include your database connection file
        require_once 'db_connect.php';

        // Query to get the case submissions from the database
        $sql = "SELECT * FROM cases";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Case ID</th><th>Bank Name</th><th>Branch Name</th><th>District</th><th>Case Delay Reason</th><th>Technician</th><th>Submitted At</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Case_id'] . "</td>";
                echo "<td>" . $row['bank_name'] . "</td>";
                echo "<td>" . $row['branch_name'] . "</td>";
                echo "<td>" . $row['district'] . "</td>";
                echo "<td>" . $row['delay_reason'] . "</td>";
                echo "<td>" . $row['technician_name'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No case submissions found.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>

    </div>

</body>
</html>