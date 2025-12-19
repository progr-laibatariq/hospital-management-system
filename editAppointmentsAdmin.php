<?php
// Include the database connection
require 'connection.php';

// Check if appointment ID is passed in the URL
if (isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // Fetch the existing appointment details
    $sql = "SELECT a.appointment_id, a.pat_id, a.doc_id, a.description, p.Name AS patient_name, d.name AS doctor_name
    FROM appointments a
    INNER JOIN Patient p ON a.pat_id = p.pat_id
    INNER JOIN Doctor d ON a.doc_id = d.doc_id
    WHERE a.appointment_id = '$appointment_id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Show the form to edit the appointment
        echo "<form action='updateAppointmentsAdmin.php' method='POST'>
        <h2 style='text-align: center; margin-bottom: 30px;'>Edit Appointment</h2>

        <label for='pat_id'>Patient Name:</label>
        <select name='pat_id' id='pat_id' required>
        <option value='" . $row['pat_id'] . "' selected>" . $row['patient_name'] . "</option>";

        // Fetch all patients for dropdown
        $sql_patient = "SELECT pat_id, Name FROM Patient";
        $result_patient = $conn->query($sql_patient);
        while ($patient = $result_patient->fetch_assoc()) {
            echo "<option value='" . $patient['pat_id'] . "'>" . $patient['Name'] . "</option>";
        }

        echo "</select><br><br>

        <label for='doc_id'>Doctor Name:</label>
        <select name='doc_id' id='doc_id' required>
        <option value='" . $row['doc_id'] . "' selected>" . $row['doctor_name'] . "</option>";

        // Fetch all doctors for dropdown
        $sql_doctor = "SELECT doc_id, name FROM Doctor";
        $result_doctor = $conn->query($sql_doctor);
        while ($doctor = $result_doctor->fetch_assoc()) {
            echo "<option value='" . $doctor['doc_id'] . "'>" . $doctor['name'] . "</option>";
        }

        echo "</select><br><br>

        <label for='description'>Description:</label>
        <textarea name='description' id='description' required>" . $row['description'] . "</textarea><br><br>

        <input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>
        <input type='submit' value='Update Appointment'>
        </form>";
    } else {
        echo "<h3>No appointment found with this ID.</h3>";
    }
} else {
    echo "<h3>Invalid appointment ID.</h3>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Appointment</title>
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
      margin-top: 100px;
      color: #003366;
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
      margin-top: 80px; /* Space the container content below the fixed navbar */
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
        <a href="create_appointment.php" class="create-appointments">Create Appointment</a>
        <a href="viewAppointments.php" class="view-appointments">View Appointments</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

</body>
</html>
