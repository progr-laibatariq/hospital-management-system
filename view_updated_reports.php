<?php
session_start();
include("connection.php");

// Check if doctor is logged in
if (!isset($_SESSION['doc_id'])) {
    echo "<script>alert('Access Denied. Please log in.'); window.location.href='login.html';</script>";
    exit;
}

$doc_id = $_SESSION['doc_id'];

// Fetch doctor's name
$docQuery = "SELECT Name FROM Doctor WHERE doc_id = '$doc_id'";
$docResult = mysqli_query($conn, $docQuery);
$doctorName = "Doctor";

if ($docResult && mysqli_num_rows($docResult) == 1) {
    $docRow = mysqli_fetch_assoc($docResult);
    $doctorName = $docRow['Name'];
}

// Fetch reports for this doctor
$sql = "SELECT pr.*, p.Name AS patient_name 
        FROM patient_report pr
        JOIN Patient p ON pr.pat_id = p.pat_id
        WHERE pr.doc_id = '$doc_id'
        ORDER BY pr.report_date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Updated Reports</title>
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
        <a href="doc_dashboard.php">Dashboard</a>
        <a href="update_patient_report.php">Update Reports</a>
        <a href="view_updated_reports.php">View Reports</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<h2 style="margin-top: 80px;">🩺 Patient Reports</h2>
<div class="subheading">Logged in as <strong><?php echo htmlspecialchars($doctorName); ?></strong></div>

<table>
    <tr>
        <th>Patient Name</th>
        <th>Condition Before</th>
        <th>Condition After</th>
        <th>Treatment</th>
        <th>Lab Test</th>
        <th>Medicines</th>
        <th>Instructions</th>
        <th>Report Date</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['patient_name']}</td>
                    <td>{$row['cnd_before']}</td>
                    <td>{$row['cnd_after']}</td>
                    <td>{$row['treatment_given']}</td>
                    <td>" . ($row['lab_test'] ? 'Yes' : 'No') . "</td>
                    <td>{$row['medicine_given']}</td>
                    <td>{$row['instructions']}</td>
                    <td>{$row['report_date']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8' style='text-align:center;'>No reports found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
