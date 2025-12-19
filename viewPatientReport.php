<?php
// Include the database connection
require 'connection.php';

// Fetch the report details based on the passed report ID
if (isset($_GET['rep_id'])) {
    $rep_id = $_GET['rep_id'];

    // Query to fetch the report details
    $sql_report = "SELECT * FROM patient_report WHERE rep_id = '$rep_id'";
    $result_report = $conn->query($sql_report);

    // Default error message
    $error_message = '';

    // If a report is found
    if ($result_report->num_rows > 0) {
        $report = $result_report->fetch_assoc();
    } else {
        $error_message = "❌ Report not found.";
    }
} else {
    $error_message = "⚠️ Invalid request. Report ID is missing.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Report Details</title>
    <style>
        /* Basic Styling */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #003366;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #1560BD;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .error {
            color: red;
            text-align: center;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #003366;
            padding: 15px 20px;
            display: flex;
            justify-content: center;
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

        /* Logout Button Styling */
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

        .navbar .logout::after {
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

        .navbar .logout:hover::after {
            width: 60%;
        }

        /* Adjust content */
        .container {
            margin-top: 100px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">MedCare</div>
    <div class="menu">
        <a href="admin.php">Dashboard</a>
        <a href="viewReports.php">View Reports</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="container">
    <?php if ($error_message): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php else: ?>
        <h1>Patient Report</h1>
        <table>
            <tr>
                <th>Condition Before</th>
                <td><?php echo $report['cnd_before']; ?></td>
            </tr>
            <tr>
                <th>Condition After</th>
                <td><?php echo $report['cnd_after']; ?></td>
            </tr>
            <tr>
                <th>Instructions</th>
                <td><?php echo $report['instructions']; ?></td>
            </tr>
            <tr>
                <th>Lab Test</th>
                <td><?php echo $report['lab_test']; ?></td>
            </tr>
            <tr>
                <th>Medicine Given</th>
                <td><?php echo $report['medicine_given']; ?></td>
            </tr>
            <tr>
                <th>Treatment Given</th>
                <td><?php echo $report['treatment_given']; ?></td>
            </tr>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
