<?php
session_start();
include 'connection.php';

// Ensure caretaker is logged in
// if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'pat_caretaker') {
//     header("Location: login.php");
//     exit();
// }
// if (!isset($_SESSION['id']) || strtolower($_SESSION['role']) !== 'pat_caretaker') {
//     header("Location: login.php");
//     exit();
// }


// $caretaker_id = (int)$_SESSION['id'];
if (!isset($_SESSION['caretaker_id']) || strtolower($_SESSION['role']) !== 'pat_caretaker') {
    header("Location: login.php");
    exit();
}

$caretaker_id = (int)$_SESSION['caretaker_id'];


// Count Assigned Doctors
$sqlDoctors = "
    SELECT COUNT(DISTINCT doc_id) AS total_doctors 
    FROM collab_with 
    WHERE id = $caretaker_id
";
$resultDoctors = mysqli_query($conn, $sqlDoctors);
$totalDoctors = $resultDoctors && ($row = mysqli_fetch_assoc($resultDoctors)) ? (int)$row['total_doctors'] : 0;

// Count Assigned Patients
$sqlPatients = "
    SELECT COUNT(DISTINCT pat_id) AS total_patients
    FROM pat_caretaker
    WHERE id = $caretaker_id AND pat_id IS NOT NULL
";
$resultPatients = mysqli_query($conn, $sqlPatients);
$totalPatients = $resultPatients && ($row = mysqli_fetch_assoc($resultPatients)) ? (int)$row['total_patients'] : 0;

// Count Reports for caretaker's patients (only where doctor is assigned to caretaker)
$sql_reports = "
    SELECT COUNT(*) AS total_reports
    FROM patient_report pr
    INNER JOIN pat_caretaker pc 
        ON pr.pat_id = pc.pat_id
    INNER JOIN collab_with cw 
        ON pc.id = cw.id
       AND pr.doc_id = cw.doc_id
    WHERE pc.id = $caretaker_id
";
$result_reports = mysqli_query($conn, $sql_reports);
$total_reports = $result_reports && ($row = mysqli_fetch_assoc($result_reports)) ? (int)$row['total_reports'] : 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse Dashboard - Medcare</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styleN.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-logo">
            <i class="fas fa-hospital"></i>
            <span>MEDCARE HOSPITAL</span>
        </div>
        <button class="logout-btn" onclick="handleLogout()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
            <span class="toggle-btn-text">Menu</span>
        </button>

        <div class="sidebar-profile">
            <img src="nurse.png" alt="Nurse Picture" class="sidebar-img">
            <div class="admin-name">Pat-care</div>
        </div>

        <div class="nav-item active">
            <i class="fas fa-tachometer-alt"></i>
            <span class="nav-text">Dashboard</span>
        </div>
        <div class="nav-item">
            <i class="fas fa-user-md"></i>
            <a href="view_caretaker_doctors.php" class="nav-link"><span class="nav-text">Assigned Doctors</span></a>
        </div>
        <div class="nav-item">
            <i class="fas fa-procedures"></i>
            <a href="view_caretaker_patients.php" class="nav-link"><span class="nav-text">My Patients</span></a>
        </div>
        <div class="nav-item">
            <i class="fas fa-file-medical"></i>
            <a href="caretaker_Patient_report.php" class="nav-link"><span class="nav-text">Patient Reports</span></a>
        </div>
    </div>

    <!-- Main -->
    <div class="main" id="main">
        <h1 class="welcome-header">Welcome Back !</h1>
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="stat-icon patients">
                    <i class="fas fa-user-injured"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $totalPatients; ?></h3>
                    <p>Assigned Patients</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon doctors">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $totalDoctors; ?></h3>
                    <p>Assigned Doctors</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon reports">
                    <i class="fas fa-file-medical"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $total_reports; ?></h3>
                    <p>New Reports</p>
                </div>
            </div>
        </div>
        
        <h2 class="section-title">
            <i class="fas fa-bolt"></i>
            <span>Quick Actions</span>
        </h2>

        <div class="card-container">
            <div class="card">
                <div class="card-icon"><i class="fas fa-user-md"></i></div>
                <div class="card-title">View Assigned Doctors</div>         
                <a href="view_caretaker_doctors.php" class="card-link">View Now</a>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-user-injured"></i></div>
                <div class="card-title">View Assigned Patients</div>
                <a href="view_caretaker_patients.php" class="card-link">View Now</a>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-file-medical"></i></div>
                <div class="card-title">View Reports</div>
                <a href="caretaker_Patient_report.php" class="card-link">View Now</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2023 Medcare Hospital. All rights reserved. | 
           <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
        </p>
    </div>

    <script>
        function handleLogout() {
            if(confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const main = document.getElementById("main");
            const footer = document.querySelector(".footer-bottom");
            
            sidebar.classList.toggle("sidebar-collapsed");
            main.classList.toggle("main-expanded");
            footer.classList.toggle("footer-expanded");
        }
    </script>
</body>
</html>
