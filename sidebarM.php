<?php
// Include the database connection
require 'connection.php';
require 'header.php';

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
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: white;
            margin-left: 150px;
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

      
        /* Adjust content to account for fixed navbar */
        .container {
            margin-top: 80px;
        }
    </style>
</head>
<body>


</body>
</html>
<?php require 'footer.php'; ?>
<?php
