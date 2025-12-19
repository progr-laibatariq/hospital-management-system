<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Appointment - Medcare</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 50px;
      background-color: #e0eafc;
      display: flex;
      flex-direction: column;
    }

    form {
      background-color: white;
      padding: 30px 50px;
      width: 700px;
      margin: auto;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      box-sizing: border-box;
      padding-right: 60px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 6px;
      color: #333;
    }

    input, select, textarea {
      width: 101%;
      padding: 7px;
      margin-bottom: 20px;
      border-radius: 6px;
      font-size: 18px;
      border-color: lightgrey;
    }

    input[type="submit"] {
      margin-top: 5px;
      background-color: #003366;
      color: white;
      border: none;
      font-size: 16px;
      font-weight: bold;
      padding: 12px;
      border-radius: 6px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0059b3;
      transition: 0.3s;
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

    .container {
      margin-top: 80px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <div class="logo">
      <span>MedCare</span>
    </div>
    <div class="menu">
      <a href="admin.php" class="dashboard">Dashboard</a>
      <a href="create_appointment.php" class="create-appointments">Create Appointment</a>
      <a href="viewAppointments.php" class="view-appointments">View Appointments</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
  </div>

  <!-- Appointment Form -->
  <form action="process_appointments.php" method="POST" style="margin-top: 100px;">
    <h2 style="text-align: center;margin-bottom: 30px;color: #003366;">Create Appointment</h2>

    <!-- Patient Dropdown -->
    <label for="pat_id">Patient Name:</label>
    <select name="pat_id" id="pat_id" required>
      <option value="">Select Patient</option>
      <?php 
        require 'connection.php';
        $sql_patient = "SELECT pat_id, Name FROM Patient";
        $result_patient = $conn->query($sql_patient);
        while ($row = $result_patient->fetch_assoc()) {
          echo "<option value='".$row['pat_id']."'>".$row['Name']."</option>";
        }
      ?>
    </select><br><br>

    <!-- Doctor Dropdown -->
    <label for="doc_id">Doctor Name:</label>
    <select name="doc_id" id="doc_id" required>
      <option value="">Select Doctor</option>
      <?php 
        $sql_doctor = "SELECT doc_id, name FROM Doctor";
        $result_doctor = $conn->query($sql_doctor);
        while ($row = $result_doctor->fetch_assoc()) {
          echo "<option value='".$row['doc_id']."'>".$row['name']."</option>";
        }
      ?>
    </select><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required></textarea>

    <input type="submit" name="submit" value="Create Appointment">
  </form>

</body>
</html>
