<?php
include("connection.php");

$sql = "
        SELECT 
            d.name AS doctor_name,
            p.name AS patient_name,
            pc.name AS caretaker_name,
            pc.shift_time
        FROM 
            pat_caretaker pc
        JOIN 
            Patient p ON pc.pat_id = p.pat_id
        JOIN 
            collab_with cw ON pc.id = cw.id
        JOIN 
            Doctor d ON cw.doc_id = d.doc_id
        WHERE 
            pc.pat_id IS NOT NULL 
            AND pc.shift_time IS NOT NULL
        ";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assignments Table</title>
    <style>
         body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 50px;
            background-color: #eef3fc;
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
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #003366;
            color: white;
            border: 1px solid #0056b3;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Navbar Styling */
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
        <a href="assignFormPatientCaretaker.php" class="create-appointments">Assign CareTaker</a>
        <a href="showCaretakerReport.php" class="view-appointments">View Assignments</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<h2 style="text-align:center;color: #003366;margin-top: 80px;">Assigned Patient-Caretaker-Doctor Records</h2>
<table>
    <tr>
        <th>Sr No.</th>
        <th>Doctor Name</th>
        <th>Patient Name</th>
        <th>Caretaker Name</th>
        <th>Shift Time</th>
    </tr>
    <?php
    $sr = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$sr}</td>
            <td>" . ($row['doctor_name'] ?? 'Not Assigned') . "</td>
            <td>" . ($row['patient_name'] ?? 'Not Assigned') . "</td>
            <td>{$row['caretaker_name']}</td>
            <td>{$row['shift_time']}</td>
        </tr>";
        $sr++;
    }
    ?>
</table>

</body>
</html>
