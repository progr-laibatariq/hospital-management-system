<?php
include("connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Patient Caretaker</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f8fb;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 30px;
        }

        form {
            width: 35%;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #003366;
        }

        select, input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"] {
            background-color: #003366;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #005599;
        }
        #time{
             width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
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

  <!-- Navbar -->
  <div class="navbar">
    <div class="logo">
      <span>MedCare</span>
    </div>
    <div class="menu">
      <a href="admin.php" class="dashboard">Dashboard</a>
      <a href="assignFormPatientCaretaker.php" class="create-appointments">Assign CareTaker</a>
      <a href="showCaretakerReport.php" class="view-appointments">View Assignments</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
  </div>

  <!-- Caretaker Assignment Form -->
  <form method="post" action="assign_caretaker.php" style="margin-top: 100px;">
    <h2>
      <span style="font-size: 15px; vertical-align: middle; color: #003366; ">🏥</span> 
      Assign Patient Caretaker
    </h2>
    <label for="caretaker_id">Select Caretaker:</label>
    <select name="caretaker_id" required>
      <option value="">-- Select Caretaker --</option>
      <?php
        $caretaker_query = mysqli_query($conn, "SELECT id, name FROM pat_caretaker");
        while ($ct = mysqli_fetch_assoc($caretaker_query)) {
          echo "<option value='{$ct['id']}'>{$ct['name']} (ID: {$ct['id']})</option>";
        }
      ?>
    </select>

    <label for="patient_id">Select Patient:</label>
    <select name="patient_id" required>
      <option value="">-- Select Patient --</option>
      <?php
        $patient_query = mysqli_query($conn, "SELECT pat_id, name FROM Patient");
        while ($pt = mysqli_fetch_assoc($patient_query)) {
          echo "<option value='{$pt['pat_id']}'>{$pt['name']} (ID: {$pt['pat_id']})</option>";
        }
      ?>
    </select>

    <!-- Doctor dropdown -->
    <label for="doctor_id">Assign to Doctor:</label>
    <select name="doctor_id" required>
      <option value="">-- Select Doctor --</option>
      <?php
        $doctor_query = mysqli_query($conn, "SELECT doc_id, name FROM Doctor");
        while ($doc = mysqli_fetch_assoc($doctor_query)) {
          echo "<option value='{$doc['doc_id']}'>{$doc['name']} (ID: {$doc['doc_id']})</option>";
        }
      ?>
    </select>

    <label>Shift Time:</label>
    <input id="time" type="time" name="shift_time"><br><br>

    <input type="submit" value="Assign Caretaker">
  </form>

</body>
</html>
