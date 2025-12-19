<?php
session_start();
require 'connection.php';

// Get caretaker ID from session
if (!isset($_SESSION['caretaker_id'])) {
    die("Access denied. Please log in.");
}
$caretaker_id = (int)$_SESSION['caretaker_id']; // or wherever you get it

$sql = "
    SELECT 
        p.name AS patient_name,
        pr.treatment_given,
        pr.medicine_given,
        pr.instructions,
        pr.lab_test
    FROM patient_report pr
    INNER JOIN patient p ON pr.pat_id = p.pat_id
    INNER JOIN pat_caretaker pc ON p.pat_id = pc.pat_id
    WHERE pc.id = $caretaker_id
";

$result = mysqli_query($conn, $sql);


if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient Reports</title>
    <style>
         body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f8fb;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 10px;
        }

        .subheading {
            text-align: center;
            font-size: 18px;
            color: #444;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 30px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
        td button{
            padding: 7px;
            background-color: lightgrey;
            color:  black;
            transition: 0.3s ease;
            border: none;
            border-radius: 5px;
        }
        td button:hover{
            background-color: #003366;
            color:  #f1f1f1;
            transform: scale(1.05);
            cursor: pointer;

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
    </style>
</head>
<body>
 <div class="navbar">
        <div class="logo">
            <span>MEDCARE</span>
        </div>
        <div class="menu">
            <a href="nurse.php">Dashboard</a>
            <a href="caretaker_Patient_report.php">View Reports</a>
            <a href="view_caretaker_doctors.php">Assigned Doctors</a>
            <a href="view_caretaker_patients.php">Assigned Patients</a>
        </div>
        <a href="logout.php" class="logout">Logout</a>
    </div>


<h2 style="margin-top: 80px;">Patient Reports</h2>
  
<table>
    <tr>
        <th>S.No</th>
        <th>Patient Name</th>
        <th>Treatment</th>
        <th>Medicine</th>
        <th>Instructions</th>
        <th>Lab Test</th>
    </tr>

    <?php
    $serial = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $serial++ . "</td>";
        echo "<td>" . htmlspecialchars($row['patient_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['treatment_given']) . "</td>";
        echo "<td>" . htmlspecialchars($row['medicine_given']) . "</td>";
        echo "<td>" . htmlspecialchars($row['instructions']) . "</td>";

        // Display lab test result with color
        $labTest = ucfirst(strtolower($row['lab_test']));
        $class = ($labTest === "Yes") ? "yes" : "no";
        echo "<td class='$class'>" . $labTest . "</td>";

        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
