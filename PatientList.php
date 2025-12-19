<?php
session_start();
include("connection.php");


if (!isset($_SESSION['doc_id'])) {
    echo "<script>alert('Access Denied. Please log in.'); window.location.href='login.html';</script>";
    exit;
}

$doc_id = $_SESSION['doc_id'];
$doc_name = "";

$doc_sql = "SELECT name FROM Doctor WHERE doc_id = $doc_id";
$doc_result = $conn->query($doc_sql);

if ($doc_row = mysqli_fetch_assoc($doc_result)) {
    $doc_name = $doc_row['name'];
}


$sql = "
SELECT DISTINCT 
    p.name AS patient_name,
    ph.ph_Nmbr AS patient_contact
FROM (
    SELECT pat_id
    FROM appointments
    WHERE doc_id = $doc_id
    
    UNION
    
    SELECT pat_id
    FROM assigned_to
    WHERE doc_id = $doc_id
) AS combined
INNER JOIN Patient p ON combined.pat_id = p.pat_id
INNER JOIN patient_ph_nmbr ph ON combined.pat_id = ph.pat_id
";




$result = mysqli_query($conn, $sql);
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
    </style>
</head>
<body>
      <div class="navbar">
    <div class="logo">
        <span>MEDCARE</span>
    </div>
    <div class="menu">
        <a href="doc_dashboard.php">Dashboard</a>
        <a href="PatientList.php">Patients</a>
        <a href="showMessages.php">Messages</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

    <h2 style="margin-top: 80px;">Patient Reports</h2>
    <div class="subheading">List of all patients treated by <?php echo "<strong>$doc_name</strong>" ?></div>

    <table>
        <tr>
            <th>Serial No.</th>
            <th>Patient Name</th>
            <th>Contact</th>
          <!--   <th>Condition After</th>
            <th>Report Date</th> -->
        </tr>

        <?php
        $serial = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $serial++ . "</td>";
            echo "<td>" . htmlspecialchars($row['patient_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['patient_contact']) . "</td>";
            // echo "<td>" . htmlspecialchars($row['cnd_after']) . "</td>";
            // echo "<td>" . htmlspecialchars($row['report_date']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
