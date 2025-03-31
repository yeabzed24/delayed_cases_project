<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Registration</title>
</head>
<body>
    <h1>Register Delayed Case</h1>
    <form action="technician_submission_form.php" method="POST">
        <label for="case_id">Case ID (Integer):</label>
        <input type="number" id="case_id" name="case_id" required><br><br>

        <label for="bank_name">Bank Name:</label>
        <select id="bank_name" name="bank_name" required>
            <option value="Awash Bank">Awash Bank</option>
            <option value="Dashen Bank">Dashen Bank</option>
            <option value="Amhara Bank">Amhara Bank</option>
            <option value="Ahadu Bank">Ahadu Bank</option>
            <option value="Zemen Bank">Zemen Bank</option>
            <option value="Global Bank">Global Bank</option>
        </select><br><br>

        <label for="branch_name">Branch Name:</label>
        <input type="text" id="branch_name" name="branch_name" required><br><br>

        <label for="district">District:</label>
        <select id="district" name="district" required>
            <option value="West">West</option>
            <option value="North">North</option>
            <option value="South">South</option>
            <option value="East">East</option>
            <option value="Central">Central</option>
            <option value="Bahirdar">Bahirdar</option>
            <option value="Mekele">Mekele</option>
            <option value="Jimma">Jimma</option>
            <option value="Diredawa">Diredawa</option>
            <option value="Wolaita">Wolaita</option>
        </select><br><br>

        <label for="delay_reason">Delay Reason:</label><br>
        <textarea id="delay_reason" name="delay_reason" rows="4" cols="50" required></textarea><br><br>

        <label for="technician_name">Submitted By (Technician Name):</label>
        <input type="text" id="technician_name" name="technician_name" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>