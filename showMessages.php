<?php
session_start();
include("connection.php");

if (!isset($_SESSION['doc_id'])) {
    echo "<script>alert('Access denied. Please login first.'); window.location.href='login.html';</script>";
    exit;
}

$doc_id = $_SESSION['doc_id'];

// Direct query
$sql = "SELECT m.description, m.timestamp, p.name AS patient_name
        FROM message m
        INNER JOIN patient p ON m.pat_id = p.pat_id
        WHERE m.doc_id = $doc_id
        ORDER BY m.timestamp DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Messages</title>
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
            width: 90%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-left: 70px;
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
        <a href="showMessages.php">Messages</a>
        <a href="PatientList.php">Patients</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<h2 style="margin-top: 80px;">📬Messages for You</h2>

<?php if ($result->num_rows > 0): ?>
    <table style="margin-top: 50px;">
        <tr style="background-color: #aec8f2; color :#06152e ;">
            <th>Description</th>
            <th>Patient Name</th>
            <th>Time</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= htmlspecialchars($row['patient_name']) ?></td>
            <td><?= date("d M Y, h:i A", strtotime($row['timestamp'])) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">No messages found.</p>
<?php endif; ?>

</body>
</html>

