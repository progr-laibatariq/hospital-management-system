<?php
// Include the database connection
require 'connection.php';

// Query to fetch admin's name
$sql = "SELECT username FROM admin WHERE Adm_ID = 1"; // Assuming admin_id = 1
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $admin_name = $row['username'];
} else {
    $admin_name = "Admin";
}

// Fetch dynamic counts
$patient_count = 0;
$doctor_count = 0;
$today_appointments_count = 0;
$today_messages_count = 0;

// Get total patients count
$patient_query = "SELECT COUNT(*) AS total FROM patient";
$patient_result = $conn->query($patient_query);
if ($patient_result && $patient_row = $patient_result->fetch_assoc()) {
    $patient_count = $patient_row['total'];
}

// Get total doctors count
$doctor_query = "SELECT COUNT(*) AS total FROM doctor";
$doctor_result = $conn->query($doctor_query);
if ($doctor_result && $doctor_row = $doctor_result->fetch_assoc()) {
    $doctor_count = $doctor_row['total'];
}

// Get today's appointments count
$appointment_query = "SELECT COUNT(*) AS total FROM appointments WHERE appointment_date = CURDATE()";
$appointment_result = $conn->query($appointment_query);
if ($appointment_result && $appointment_row = $appointment_result->fetch_assoc()) {
    $today_appointments_count = $appointment_row['total'];
}

// Get today's messages count
$message_query = "SELECT COUNT(*) AS total FROM message WHERE DATE(timestamp) = CURDATE()";
$message_result = $conn->query($message_query);
if ($message_result && $message_row = $message_result->fetch_assoc()) {
    $today_messages_count = $message_row['total'];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Medcare</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styleA.css">
    <script>
        function handleLogout() {
            if(confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }
    </script>
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

        <!-- Admin Profile -->
        <div class="sidebar-profile">
            <img src="admin.png" alt="Admin Picture" class="sidebar-img">
            <div class="admin-name"><?php echo $admin_name; ?></div>
        </div>

        <!-- Sidebar Links -->
        <div class="nav-item active">
            <i class="fas fa-tachometer-alt"></i>
            <span class="nav-text">Dashboard</span>
        </div>
        <div class="nav-item">
            <i class="fas fa-user-md"></i>
            <a href="sidebarD.php" class="nav-link">
                <span class="nav-text">Doctor List</span>
            </a>
        </div>
        <div class="nav-item">
            <i class="fas fa-procedures"></i>
            <a href="sidebarP.php" class="nav-link">
                <span class="nav-text">Patient List</span>
            </a>
        </div>
        <div class="nav-item">
            <i class="fas fa-calendar-check"></i>
            <a href="sidebarA.php" class="nav-link">
                <span class="nav-text">Appointments</span>
            </a>
        </div>
        <div class="nav-item">
            <i class="fas fa-comments"></i>
            <a href="sidebarM.php" class="nav-link">
                <span class="nav-text">Messages</span>
            </a>
        </div>
        <div class="nav-item">
            <i class="fas fa-cog"></i>
            <a href="#" class="nav-link">
                <span class="nav-text">Settings</span>
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main" id="main">
        <h1 class="welcome-header">Welcome Back, <?php echo $admin_name; ?></h1>
        
        <!-- Statistics Cards -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="stat-icon patients">
                    <i class="fas fa-user-injured"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $patient_count; ?></h3>
                    <p>Total Patients</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon doctors">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $doctor_count; ?></h3>
                    <p>Active Doctors</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon appointments">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $today_appointments_count; ?></h3>
                    <p>Today's Appointments</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon messages">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $today_messages_count; ?></h3>
                    <p>Today's Messages</p>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions Section -->
        <h2 class="section-title">
            <i class="fas fa-bolt"></i>
            <span>Quick Actions</span>
        </h2>

        <div class="card-container">
            <!-- Cards for various admin actions -->
            <div class="card">
                <div class="card-icon"><i class="fas fa-user-plus"></i></div>
                <div class="card-title">Register Patient</div>
                <p class="card-desc">Add new patient to the hospital system</p>
                <a href="adminregisterPat.php" class="card-link">Register Now</a>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-envelope"></i></div>
                <div class="card-title">Send Message</div>
                <p class="card-desc">Communicate with staff or patients</p>
                <a href="adminSendMessage.php" class="card-link">Send Now</a>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-share-square"></i></div>
                <div class="card-title">Send to Pat-Care</div>
                <p class="card-desc">Transfer patient reports to caretakers</p>
                <a href="sendReportToPatcare.php" class="card-link">Send Report</a>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-user-friends"></i></div>
                <div class="card-title">Assign Doctor</div>
                <p class="card-desc">Assign doctor to patient</p>
                <a href="assign_doc_to_pat.php" class="card-link">Assign Now</a>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                <div class="card-title">Generate Bill</div>
                <p class="card-desc">Create and send patient bills</p>
                <a href="billform.php" class="card-link">Generate Bill</a>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-file-export"></i></div>
                <div class="card-title">Discharge Sheet</div>
                <p class="card-desc">Create patient discharge documents</p>
                <a href="add_discharge.php" class="card-link">Create Sheet</a>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-user-cog"></i></div>
                <div class="card-title">Assign Caretaker</div>
                <p class="card-desc">Assign caretaker to patient</p>
                <a href="assignFormPatientCaretaker.php" class="card-link">Assign Now</a>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-calendar-plus"></i></div>
                <div class="card-title">Create Appointment</div>
                <p class="card-desc">Schedule new appointments</p>
                <a href="create_appointment.php" class="card-link">Schedule Now</a>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const main = document.getElementById("main");
            const footer = document.getElementById("footer");
            
            sidebar.classList.toggle("sidebar-collapsed");
            main.classList.toggle("main-expanded");
            footer.classList.toggle("footer-expanded");
        }
        
        // For mobile responsiveness
        function checkScreenSize() {
            if (window.innerWidth <= 992) {
                document.getElementById("sidebar").classList.remove("sidebar-collapsed");
                document.getElementById("main").classList.remove("main-expanded");
                document.getElementById("footer").classList.remove("footer-expanded");
            }
        }
        
        window.addEventListener('resize', checkScreenSize);
        checkScreenSize(); // Check on initial load
        
        // Add active class to clicked nav item
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', () => {
                navItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
            });
        });
    </script>

    <div class="footer-bottom">
        <p>&copy; 2025 Medcare Hospital. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </div>
</body>
</html>