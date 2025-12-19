<?php
session_start();
include("connection.php");

$docName = "";
$specialization = "";
$ph_number = "";
$appointments_count = "";
$filedPatients = "";
$total_patients = "";

if (isset($_SESSION['doc_id'])) {
    $doc_id = $_SESSION['doc_id'];
  
    $query = "SELECT name, specialization FROM Doctor WHERE doc_id = '$doc_id'";
    $result = $conn->query($query);
    if ($result && $row1 = mysqli_fetch_assoc($result)) {
        $docName = $row1['name'];
        $specialization = $row1['specialization'];
    }
    $sql = "SELECT ph_Nmbr FROM doctor_ph_Nmbr WHERE doc_id = '$doc_id'";
    $result2 = $conn->query($sql);
    if ($result2 && $row2 = mysqli_fetch_assoc($result2)) {
        $ph_number = $row2['ph_Nmbr']; 
    }

    $sql1 = "SELECT COUNT(*) AS appointments_count FROM appointments ap INNER JOIN doctor d ON d.doc_id = ap.doc_id WHERE d.doc_id = '$doc_id' AND ap.status = 'pending'";
    $result3 = $conn->query($sql1);
    if ($result3 && $row3 = mysqli_fetch_assoc($result3)) {
        $appointments_count = $row3['appointments_count']; 
    }
    $sql2= "SELECT count(*) AS filedPatients FROM patient_report WHERE doc_id = '$doc_id'";
    $result4 = $conn->query($sql2);
    if($result4 && $row4 = mysqli_fetch_assoc($result4))
    {
      $filedPatients = $row4['filedPatients'];
    }

    $sql3 = "SELECT COUNT(DISTINCT pat_id) AS total_patients
FROM (
    SELECT pat_id 
    FROM appointments
    WHERE doc_id = '$doc_id'   

    UNION

    SELECT pat_id
    FROM assigned_to
    WHERE doc_id = '$doc_id'
) AS combined";

   $result5 = $conn->query($sql3);
    if($result5 && $row5 = mysqli_fetch_assoc($result5))
    {
      $total_patients = $row5['total_patients'];
    }
    $sql4 = "SELECT *
    FROM appointments
    WHERE appointment_date = CURDATE()
    ORDER BY appointment_time";
    $result6 = $conn->query($sql4);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Dashboard - Medcare</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="styleD.css">
</head>
<body>
  <!-- Navbar -->
  <div class="navbar">
    <div class="navbar-logo">
      <i class="fas fa-hospital"></i>
      <span>MEDCARE HOSPITAL</span>
    </div>
      <script>
          function handleLogout() {
  // You can add confirmation dialog if you want
            if(confirm('Are you sure you want to logout?')) {
              window.location.href = 'logout.php';
            }
          }
        </script>

<!-- In your navbar section -->
<button class="logout-btn" onclick="handleLogout()">
  <i class="fas fa-sign-out-alt"></i>
  <span>Logout</span>
</button>
  </div>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()">
      <i class="fas fa-bars"></i>
      <span class="nav-text">Menu</span>
    </button>

    <!-- Doctor Profile -->
    <div class="sidebar-profile">
      <img src="doctor_logo.png" alt="Doctor" class="sidebar-img">
      <div class="doctor-name"><?php echo $docName; ?></div>
      <div class="doctor-specialization"><?php echo $specialization; ?></div>
      <div class="doctor-details"><i class="fas fa-phone"></i> <?php echo $ph_number; ?></div>
      <div class="doctor-details"><i class="fas fa-envelope"></i> <?php echo strtolower(str_replace(' ', '', $docName)); ?>@medcare.com</div>
      <div class="doctor-details"><i class="fas fa-briefcase"></i> 12+ years experience</div>
    </div>

    <!-- Sidebar Links -->
    <div class="nav-item active">
      <i class="fas fa-tachometer-alt"></i>
      <span class="nav-text">Dashboard</span>
    </div>
    <div class="nav-item" onclick="location.href='PatientList.php'">
      <i class="fas fa-procedures"></i>
      <span class="nav-text">Your Patients</span>
    </div>
    <div class="nav-item" onclick="location.href='view_updated_reports.php'">
      <i class="fas fa-file-medical-alt"></i>
      <span class="nav-text">View Reports</span>
    </div>
    <div class="nav-item" onclick="location.href='showMessages.php'">
      <i class="fas fa-comments"></i>
      <span class="nav-text">Messages</span>
    </div>
    <div class="nav-item">
      <i class="fas fa-calendar-check"></i>
      <span class="nav-text">Appointments</span>
    </div>
  </div>

  <!-- Main Content Area -->
  <div class="main" id="main">
    <h1 class="welcome-header">Doctor Dashboard</h1>
    
    <!-- Welcome Card -->
    <div class="welcome-card">
      <div class="welcome-content">
        <h2 class="welcome-title">Welcome, <?php echo $docName; ?></h2>
        <p class="welcome-subtitle">Here's what's happening today</p>
        
        <div class="stats">
          <div class="stat">
            <div class="stat-value"><?php echo $appointments_count; ?></div>
            <div class="stat-label">Appointments</div>
          </div>
          <div class="stat">
            <div class="stat-value"><?php echo $filedPatients ?></div>
            <div class="stat-label">Filed Patients</div>
          </div>
          <div class="stat">
            <div class="stat-value"><?php echo $total_patients ?></div>
            <div class="stat-label">Patients</div>
          </div>
        </div>
      </div>
      
      <div class="welcome-image">
        <img src="medical-team.png" alt="Doctor Illustration">
<!--         <img src="https://cdn-icons-png.flaticon.com/512/5993/5993656.png" 
     alt="Medical Team" 
     style="height: 180px; filter: hue-rotate(15deg) saturate(1.2);"> -->

      </div>
    </div>
    
    <!-- Activity Card -->
    <div class="activity-card">
  <div class="activity-header">
    <h3 class="activity-title">Today's Schedule</h3>
    <button class="card-link">View All</button>
  </div>

  <?php
  if ($result6 && $result6->num_rows > 0) {
      while ($row = $result6->fetch_assoc()) {
          // Format date and time nicely
          $day = date("D", strtotime($row['appointment_date'])); // e.g. Thu
          $dayNum = date("d", strtotime($row['appointment_date'])); // e.g. 23
          $time = date("g:i A", strtotime($row['appointment_time'])); // e.g. 2:30 PM

          echo '<div class="activity-item">
                  <div>
                    <div class="activity-date">' . $day . ' ' . $dayNum . '</div>
                    <div class="activity-patient">' . htmlspecialchars($row['description']) . '</div>
                  </div>
                  <div class="activity-time">' . $time . '</div>
                </div>';
      }
  } else {
      echo '<div class="activity-item">
              <div>
                <div class="activity-patient">No appointments for today</div>
              </div>
            </div>';
  }
  ?>
</div>

    
    <!-- Quick Actions Section -->
    <h2 class="section-title">
      <i class="fas fa-bolt"></i>
      <span>Quick Actions</span>
    </h2>

    <div class="card-container">
      <div class="card">
        <div class="card-icon"><i class="fas fa-file-medical"></i></div>
        <div class="card-title">File Patient Report</div>
        <p class="card-desc">Create and submit patient medical reports</p>
        <a href="filePatientReport.php" class="card-link">File Report</a>
      </div>

      <div class="card">
        <div class="card-icon"><i class="fas fa-calendar-check"></i></div>
        <div class="card-title">Appointments</div>
        <p class="card-desc">View and manage your appointments</p>
        <a href="doctor_appoinments.php" class="card-link">View Appointments</a>
      </div>

      <div class="card">
        <div class="card-icon"><i class="fas fa-file-edit"></i></div>
        <div class="card-title">Update Report</div>
        <p class="card-desc">Modify existing patient reports</p>
        <a href="update_patient_report.php" class="card-link">Update Report</a>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer" id="footer">
    <p>&copy; 2025 Medcare Hospital. All rights reserved.</p>
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
</body>
</html>