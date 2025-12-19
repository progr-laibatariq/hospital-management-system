<?php
session_start();
require 'connection.php';

// Ensure caretaker is logged in
if (!isset($_SESSION['caretaker_id'])) {
    die("Access denied. Please log in.");
}

$caretaker_id = (int)$_SESSION['caretaker_id'];
$sqlDoctors = "
    SELECT 
        d.name AS doctor_name,
        d.specialization,
        d.email,
        ph.ph_Nmbr AS contact
    FROM collab_with cw
    INNER JOIN doctor d ON cw.doc_id = d.doc_id
    LEFT JOIN doctor_ph_nmbr ph ON d.doc_id = ph.doc_id
    WHERE cw.id = $caretaker_id
";

$resultDoctors = mysqli_query($conn, $sqlDoctors);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient List</title>
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

        /* Navbar styling */
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
            background-color: red;
            font-size: 16px;
            text-decoration: none;
        }

        .navbar .logout:hover {
            background-color: darkred;
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

    <h2 style="margin-top: 80px;">Related Doctors</h2>
  
    <table>
        <tr>
            <th>S.No</th>
            <th>Doctor Name</th>
            <th>Email</th>
            <th>Contact</th>
        </tr>

        <?php
        $serial = 1;
        while ($row = mysqli_fetch_assoc($resultDoctors)) {
            echo "<tr>";
            echo "<td>" . $serial++ . "</td>";
            echo "<td>" . htmlspecialchars($row['doctor_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
