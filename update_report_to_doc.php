<?php
// Include the database connection
require 'connection.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $rep_id = $_POST['rep_id'];  // Report ID (hidden field)
    $medical_condition = $_POST['medical_condition'];  // Updated medical condition

    // Ensure that the medical condition is not empty (optional validation)
    if (!empty($medical_condition)) {
        // Update the Patient table (current medical condition)
        $sql_patient = "UPDATE Patient 
                        SET Medical_Condition = '$medical_condition' 
                        WHERE pat_id = (SELECT pat_id FROM patient_report WHERE rep_id = '$rep_id')";

        // Update the patient_report table (historical data - cnd_before)
        $sql_report = "UPDATE patient_report 
                       SET cnd_before = '$medical_condition' 
                       WHERE rep_id = '$rep_id'";

        // Execute the Patient update query
        if ($conn->query($sql_patient) === TRUE && $conn->query($sql_report) === TRUE) {
            // Redirect to the page to view the updated report
            header("Location: view_report_to_doc.php");
            exit();
        } else {
            echo "<h3>Error updating the report and patient medical condition.</h3>";
        }
    } else {
        echo "<h3>❌ Medical Condition cannot be empty.</h3>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Report to Doctor</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 50px;
            background-color: #e0eafc;
            display: flex;
            flex-direction: column;
        }

        form {
            background-color: white;
            padding: 30px 50px;
            width: 700px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            padding-right: 60px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #333;
        }

        input {
            width: 101%;
            padding: 7px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 18px;
            border-color: lightgrey;
            border-style: solid;
        }

        textarea {
            width: 101%;
            padding: 7px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 18px;
            border-color: lightgrey;
        }

        select {
            width: 101%;
            padding: 7px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            border-color: lightgrey;
        }

        textarea {
            resize: vertical;
            min-height: 50px;
        }

        input[type='submit'] {
            margin-top: 5px;
            background-color: #003366;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: bold;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type='submit']:hover {
            background-color: #0059b3;
            transition: 0.3s;
        }

        .navbar {
            background-color: #003366;
            padding: 15px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
            width: 100%;
        }

        .navbar .logo {
            position: absolute;
            left: 20px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        .navbar .menu {
            display: flex;
            gap: 20px;
            justify-content: center;
            width: 100%;
            text-align: center;
        }

        .navbar .menu a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar .menu a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 3px;
            bottom: 0;
            left: 50%;
            background: white;
            border-radius: 2px;
            transition: all 0.4s ease-in-out;
            transform: translateX(-50%);
        }

        .navbar .menu a:hover::after {
            width: 60%;
        }

        .navbar .logout {
            position: absolute;
            right: 60px;
            color: white;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            font-size: 16px;
            text-decoration: none;
            background-color: red;
        }

        .navbar .logout:hover::after {
            width: 60%;
        }

        .container {
            margin-top: 80px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">
        <span>MEDCARE</span>
    </div>
    <div class="menu">
        <a href="admin.php" class="dashboard">Dashboard</a>
        <a href="reporttodoc.php" class="add-report">Add New Report</a>
        <a href="view_report_to_doc.php" class="manage-reports">Manage Reports</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<!-- Edit Report Form -->
<form action="update_report_to_doc.php" method="POST"  style="margin-top: 150px;">    

    <h2 style="text-align: center; margin-bottom: 30px; color: #003366;">📝 Edit Medical Condition</h2>

    <!-- Hidden input for rep_id -->
    <input type="hidden" name="rep_id" value="<?php echo $row['rep_id']; ?>">

    <label>Medical Condition</label>
    <textarea name="medical_condition" placeholder="Edit Medical Condition"><?php echo $row['Medical_Condition']; ?></textarea><br>

    <input type="submit" name="submit" value="Update">
</form>

</body>
</html>
