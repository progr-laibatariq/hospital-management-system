<?php
// Include the database connection
require 'connection.php';

// Query to get all appointment details using INNER JOIN
$sql = "SELECT a.appointment_id, a.pat_id, a.doc_id, a.appointment_date, a.appointment_time, a.description, 
            p.Name AS patient_name, d.Name AS doctor_name 
        FROM appointments a
        INNER JOIN Patient p ON a.pat_id = p.pat_id
        INNER JOIN Doctor d ON a.doc_id = d.doc_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Appointments</title>
  <style>
    /* Same styles as previously defined */
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 50px;
      background-color: white;
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
      padding: 15px;
      text-align: center;
      border: 1px solid #ddd;
    }

    th {
      background-color: #1560BD;
      color: white;
      border: 1px solid #0056b3;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .button {
      padding: 8px 15px;
      text-align: center;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      text-decoration: none;
      display: inline-block;
    }

    .button-edit {
      background-color: #007bff;
      color: white;
      border: none;
      transition: 0.3s;
    }

    .button-edit:hover {
      background-color: #0056b3;
    }

    .button-delete {
      background-color: #ff4d4d;
      color: white;
      border: none;
      transition: 0.3s;
    }

    .button-delete:hover {
      background-color: #cc0000;
    }

    .no-records {
      text-align: center;
      font-size: 18px;
      color: #777;
    }

    .container {
      width: 90%;
      margin: auto;
      padding: 20px;
    }

    /* Navbar Styling */
    .navbar {
      background-color: #003366;
      padding: 15px 20px;
      display: flex;
      justify-content: center; /* Center the navbar items */
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

    /* Hover Effect (Underlining effect from the provided code) */
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

    /* Logout Button Styling */
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

<h1>Appointments List</h1>   

<div class="container">

<?php
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Appointment ID</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['appointment_id'] . "</td>
                <td>" . $row['patient_name'] . "</td>
                <td>" . $row['doctor_name'] . "</td>
                <td>" . $row['appointment_date'] . "</td>
                <td>" . $row['appointment_time'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>
                    <a href='editAppointmentsAdmin.php?appointment_id=" . $row['appointment_id'] . "'><button class='button button-edit'>Edit</button></a>
                </td>
                <td>
                    <a href='deleteAppointmentsAdmin.php?appointment_id=" . $row['appointment_id'] . "'><button class='button button-delete'>Delete</button></a>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "<div class='no-records'>❌ No Appointments Found</div>";
}
?>

</div>

</body>
</html>
