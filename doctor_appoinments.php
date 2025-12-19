<?php
session_start();
include("connection.php");

if (!isset($_SESSION['doc_id'])) {
    echo "<script>alert('Access denied. Please log in first.'); window.location.href = 'login.html';</script>";
    exit;
}

$doc_id = $_SESSION['doc_id']; 


$sql = "SELECT a.appointment_id, p.name AS patient_name, a.description, a.appointment_date, a.appointment_time
        FROM appointments a
        JOIN Patient p ON a.pat_id = p.pat_id
        WHERE a.doc_id = $doc_id AND a.status = 'Pending'
        ORDER BY a.appointment_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Appointments</title>
    <style>
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
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 30px;
            background-color: #f0f4fc;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-top: 70px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:hover {
            background-color: #f5faff;
        }

        button {
            background-color: #0077cc;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="navbar">
    <div class="logo">
        <span>MEDCARE</span>
    </div>
    <div class="menu">
        <a href="doc_dashboard.php">Dashboard</a>
        <a href="doctor_appoinments.php">View Appoinments</a>
        <!-- <a href="view_reports.php" class="view-appointments">View Assignments</a> -->
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<h2>Pending Appointments</h2>

<?php if ($result->num_rows > 0): ?>
<table>
    <tr>
        <th>Sr No</th>
        <th>Patient Name</th>
        <th>Description</th>
        <th>Appointment Date</th>
        <th>Appointment Time</th>
        <th>Action</th>
    </tr>
    <?php
    $sr = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$sr}</td>
                <td>{$row['patient_name']}</td>
                <td>{$row['description']}</td>
                <td>{$row['appointment_date']}</td>
                <td>{$row['appointment_time']}</td>
                <td>
                    <form method='POST' action='filePatientReport.php'>
                        <input type='hidden' name='appointment_id' value='{$row['appointment_id']}'>
                        <button type='submit'>Generate Report</button>
                    </form>
                </td>
              </tr>";
        $sr++;
    }
    ?>
</table>
<?php else: ?>
    <p style="text-align:center; color:#555;">No pending appointments found.</p>
<?php endif; ?>

</body>
</html>
