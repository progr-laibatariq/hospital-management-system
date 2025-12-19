<?php
// Include the database connection
require 'connection.php';

// Fetch all reports from the database
// Fetch all reports along with patient names
$sql_reports = "SELECT pr.*, p.Name AS patient_name FROM patient_report pr
                JOIN Patient p ON pr.pat_id = p.pat_id";
$result_reports = $conn->query($sql_reports);


// Default error message
$error_message = '';

if ($result_reports->num_rows == 0) {
    $error_message = "❌ No reports found.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Patient Reports</title>
    <style>
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
            margin-top: 80px; 
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
    <h1>Patient Reports</h1>

    <?php if ($error_message): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php else: ?>
       <table>
    <thead>
        <tr>
            <th>Patient Name</th>
            <th>Condition Before</th>
            <th>Condition After</th>
            <th>Instructions</th>
            <th>Lab Test</th>
            <th>Medicine Given</th>
            <th>Treatment Given</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result_reports->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['patient_name']; ?></td> <!-- Displaying patient name -->
                <td><?php echo $row['cnd_before']; ?></td>
                <td><?php echo $row['cnd_after']; ?></td>
                <td><?php echo $row['instructions']; ?></td>
                <td><?php echo $row['lab_test']; ?></td>
                <td><?php echo $row['medicine_given']; ?></td>
                <td><?php echo $row['treatment_given']; ?></td>
                <td>
                    <a href="viewPatientReport.php?rep_id=<?php echo $row['rep_id']; ?>">View Details</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

    <?php endif; ?>
</div>

</body>
</html>
