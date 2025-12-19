<?php
// Include the database connection
require 'connection.php';

// Query to get patient details from the Patient table
$sql = "SELECT * FROM Patient";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Patients</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 50px;
            background-color: white;
        }

        h1 {
            text-align: center;
            color: #003366;
            margin-top: 65px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #1560BD;
            color: white;
            border: 1px solid #0056b3;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .button {
            padding: 8px 15px;
            text-align: center;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .button-edit {
            background-color: #007bff;
            color: white;
            border: none;
            transition: 0.3s;
        }

        .button-edit:hover {
            background-color: #0056b3;
        }

        .button-delete {
            background-color: #ff4d4d;
            color: white;
            border: none;
            transition: 0.3s;
        }

        .button-delete:hover {
            background-color: #cc0000;
        }

        .no-records {
            text-align: center;
            font-size: 18px;
            color: #777;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #003366;
            padding: 15px 20px;
            display: flex;
            justify-content: center; /* Center the navbar items */
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
            justify-content: center; /* Centering menu items */
            width: 100%; /* Ensure it takes the full width */
            text-align: center; /* Align text to the center */
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

        /* Hover Effect (Underlining effect) */
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
            right: 60px; /* Adjust the position of the logout button to the left */
            color: white;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            font-size: 16px;
            text-decoration: none;
            background-color: red;
        }

        /* Same hover effect as menu links for logout */
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

        /* Adjust content to account for fixed navbar */
        .container {
            margin-top: 80px; /* Space the container content below the fixed navbar */
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
        <a href="adminregisterPat.php" class="add-new-patient">Add New Patient</a>
        <a href="view_register_patient.php" class="manage-patients">Manage Patients</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<h1>Patient Details</h1>   

<div class="container">

    <?php
    if ($result->num_rows > 0) {
    // Start the table to display the patient details
        echo "<table>
        <tr>
        <th>Patient No</th>
        <th>Name</th>
        <th>SSN</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Medical Condition</th>
        <th>Seriousness Level</th>
        <th>Police Case</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>";

    // Fetch and display patient details
        while($row = $result->fetch_assoc()){
        // Apply if-else logic to display 'Yes' or 'No' based on the Police Case value
            if ($row['Police_Case'] == 1) {
                $police_case = 'Yes';
            } else if ($row['Police_Case'] == 0){
                $police_case = 'No';
            }

            echo "<tr>
            <td>" . $row['pat_id'] . "</td>
            <td>" . $row['Name'] . "</td>
            <td>" . $row['SSN'] . "</td>
            <td>" . $row['Age'] . "</td>
            <td>" . $row['Gender'] . "</td>
            <td>" . $row['Medical_Condition'] . "</td>
            <td>" . $row['Srs_Level'] . "</td>
            <td>$police_case</td>
            <td>
            <a href='edit_patient.php?pat_id=" . $row['pat_id'] . "'><button class='button button-edit'>Edit</button></a>

            </td>
            <td>
            <a href='delete_register_patient.php?pat_id=" . $row['pat_id'] . "'><button class='button button-delete'>Delete</button></a>
            </td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "<div class='no-records'>❌ No Patients Found</div>";
    }
    ?>

</div>

</body>
</html>
