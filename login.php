<?php
session_start();

// Prevent the page from being cached
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if ($_SESSION['role'] == 'manager') {
        header("Location: manager_dashboard.php");  // Redirect to manager dashboard
    } elseif ($_SESSION['role'] == 'technician') {
        header("Location: technician_submission_form.php");  // Redirect to technician submission form
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(247, 243, 243);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(250, 245, 245, 0.97);
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }
        .logo {
            width: 280px; /* Adjust the logo size */
            margin-bottom: 20px0px;
        }
        .form-input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-input:focus {
            outline: none;
            border-color:hsl(110, 94.10%, 26.50%); /* Focus border color */
        }
        .submit-btn {
            background-color:rgb(11, 146, 22);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .submit-btn:hover {
            background-color:rgb(250, 119, 13);
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Company Logo -->
    <img src="logo.png" alt="Company Logo" class="logo"> <!-- Add your logo here -->
    
    <!-- Login Form -->
    <form action="login_process.php" method="POST">
        <input type="text" name="username" class="form-input" placeholder="Username" required>
        <input type="password" name="password" class="form-input" placeholder="Password" required>
        <button type="submit" class="submit-btn">Login</button>
    </form>

    <!-- Error Message (if any) -->
    <?php
    if (isset($_GET['error'])) {
        echo "<p class='error-message'>Invalid username or password!</p>";
    }
    ?>
</div>

</body>
</html>