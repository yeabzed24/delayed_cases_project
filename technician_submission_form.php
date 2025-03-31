<?php
// Start the session to use session variables
session_start();

// Include the database connection file
require_once 'db_connect.php'; // Make sure db_connect.php has your correct DB connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $case_id = $_POST['case_id'];
    $district = $_POST['district'];
    $bank_name = $_POST['bank_name'];
    $branch_name = $_POST['branch_name'];
    $delay_reason = $_POST['delay_reason'];
    $technician_name = $_POST['technician_name'];

    // Insert the data into the database (assuming the table is named 'cases')
    $sql = "INSERT INTO cases (case_id, district, bank_name, branch_name, delay_reason, technician_name) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $case_id, $district, $bank_name, $branch_name, $delay_reason, $technician_name);
        if ($stmt->execute()) {
            // Success message (popup)
            echo "<script>alert('Case submitted successfully'); window.location.href = 'technician_submission_form.php';</script>";
        } else {
            echo "<script>alert('There was an error with your submission. Please try again.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing the query.');</script>";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Case Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(247, 243, 243);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 300px;
            text-align: center;
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
            border-color: hsl(110, 94.10%, 26.50%);
        }
        .submit-btn {
            background-color: rgb(11, 146, 22);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: rgb(250, 119, 13);
        }
        select.form-input {
            width: 100%;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
        /* Logout button styling */
.logout-btn {
    background-color: #ff0000; /* Red background */
    color: white; /* White text */
    padding: 10px 20px; /* Add padding */
    text-decoration: none; /* Remove underline */
    border-radius: 10px; /* Round the corners */
    font-size: 14px; /* Font size */
    display: inline-block; /* Align it inline */
    margin-bottom: 20px; /* Bottom margin */
}

.logout-btn:hover {
    background-color: #cc0000; /* Darker red on hover */
}
    </style>
    </head>
    <a href="logout.php" class="logout-btn">Logout</a>
<body>

<div class="form-container">
    <h2>Technician Case Submission</h2>
    <form action="technician_submission_form.php" method="POST">
        <input type="text" name="case_id" class="form-input" placeholder="Case ID" required>
        
        <!-- District Dropdown -->
        <select name="district" class="form-input" required>
            <option value="" disabled selected>Select District</option>
            <option value="East">East</option>
            <option value="South">South</option>
            <option value="North">North</option>
            <option value="Central">Central</option>
            <option value="West">West</option>
            <option value="Wolaita">Wolaita</option>
            <option value="Jimma">Jimma</option>
            <option value="Mekelle">Mekelle</option>
            <option value="Dessie">Dessie</option>
            <option value="DireDawa">DireDawa</option>
            <option value="Bahirdar">Bahirdar</option>
        </select>
        
        <!-- Bank Name Dropdown -->
        <select name="bank_name" class="form-input" required>
            <option value="" disabled selected>Select Bank Name</option>
            <option value="Awash Bank">Awash Bank</option>
            <option value="Dashen Bank">Dashen Bank</option>
            <option value="Amhara Bank">Amhara Bank</option>
            <option value="Zemen Bank">Zemen Bank</option>
            <option value="Ahadu Bank">Ahadu Bank</option>
            <option value="Global Bank">Global Bank</option>
        </select>
        
        <input type="text" name="branch_name" class="form-input" placeholder="Branch Name" required>
        <textarea name="delay_reason" class="form-input" placeholder="Reason for Delay" rows="4" required></textarea>
        <input type="text" name="technician_name" class="form-input" placeholder="Technician Name" required>
        
        <button type="submit" class="submit-btn">Submit</button>

        </form>
    
<!-- Error Message (if any) -->
    <?php
    if (isset($_GET['error'])) {
        echo "<p class='error-message'>There was an error with your submission. Please try again.</p>";
    }
    ?>
</div>

</body>
</html>