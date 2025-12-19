<?php
// Include the database connection
require 'connection.php';

// Query to get message details from the Message table along with Doctor and Patient names
$sql = "SELECT m.msg_id, m.doc_id, m.pat_id, m.description, m.timestamp, 
               d.name AS doctor_name, p.Name AS patient_name 
        FROM message m
        INNER JOIN Doctor d ON m.doc_id = d.doc_id
        INNER JOIN Patient p ON m.pat_id = p.pat_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch and display message details
    echo "<h2>Message Details</h2>";
    echo "<table>
    <tr>
    <th>Message ID</th>
    <th>Doctor ID</th>
    <th>Doctor Name</th>
    <th>Patient ID</th>
    <th>Patient Name</th>
    <th>Gender</th>
    <th>Message</th>
    <th>Timestamp</th>
    <th>Edit</th>
    <th>Delete</th>
    </tr>";

    while($row = $result->fetch_assoc()){
        // Fetch gender from Patient table
        $pat_id = $row['pat_id'];
        $sql_gender = "SELECT Gender FROM Patient WHERE pat_id = '$pat_id'";
        $gender_result = $conn->query($sql_gender);
        if ($gender_result->num_rows > 0) {
            $gender_row = $gender_result->fetch_assoc();
            $gender = $gender_row['Gender'];
        } else {
            $gender = "N/A"; // If no gender is found, display "N/A"
        }

        echo "<tr>
        <td>" . $row['msg_id'] . "</td>  
        <td>" . $row['doc_id'] . "</td>
        <td>" . $row['doctor_name'] . "</td>
        <td>" . $row['pat_id'] . "</td>
        <td>" . $row['patient_name'] . "</td>
        <td>" . $gender . "</td>
        <td>" . $row['description'] . "</td>
        <td>" . $row['timestamp'] . "</td>
        <td>
        <a href='edit_message.php?msg_id=" . $row['msg_id'] . "'><button class='button button-edit'>Edit</button></a>
        </td>
        <td>
        <a href='delete_message.php?msg_id=" . $row['msg_id'] . "'><button class='button button-delete'>Delete</button></a>
        </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<br><br><br><br><br><br><br>";
    echo "<h3><center>❌ No Messages Found </center></h3>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Messages</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 50px;
            background-color: white;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 65px;
            margin-top: 100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        /* Adjust content to account for fixed navbar */
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
        <a href="adminSendMessage.php" class="add-new-message">Add New Message</a>
        <a href="view_message.php" class="manage-messages">Manage Messages</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

</body>
</html>
