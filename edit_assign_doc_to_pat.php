<?php
// Include the database connection
require 'connection.php';

// Get the pat_id and doc_id from the URL
if (isset($_GET['pat_id']) && isset($_GET['doc_id'])) {
    $pat_id = $_GET['pat_id'];
    $doc_id = $_GET['doc_id'];

    // Fetch the current assignment data from the database
    $sql = "SELECT at.pat_id, at.doc_id, p.Name AS patient_name, d.name AS doctor_name, at.assigned_at
            FROM assigned_to at
            JOIN Patient p ON at.pat_id = p.pat_id
            JOIN Doctor d ON at.doc_id = d.doc_id
            WHERE at.pat_id = '$pat_id' AND at.doc_id = '$doc_id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the assignment data
        $row = $result->fetch_assoc();
        $patient_name = $row['patient_name'];
        $doctor_name = $row['doctor_name'];
        $assigned_at = $row['assigned_at'];
    } else {
        echo "<h2 style='color:red; text-align:center;'>❌ No assignment found for this patient and doctor.</h2>";
        exit;
    }
} else {
    echo "<h2 style='color:red; text-align:center;'>❌ Invalid request. Missing parameters.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Assignment</title>
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

        input {
            width: 101%;
            padding: 7px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 18px;
            border-color: lightgrey;
            border-style: solid;
        }

        select {
            width: 101%;
            padding: 7px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
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
        <span>MEDCARE</span>
    </div>
    <div class="menu">
        <a href="admin.php" class="dashboard">Dashboard</a>
        <a href="assign_doc_to_pat" class="add-report">Assign New Doctor to Patient </a>
        <a href="view_assign_doc_to_pat.php" class="manage-reports">Manage Assignments</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>


<form action="update_assign_doc_to_pat.php" method="POST" style="margin-top: 100px;">
    <input type="hidden" name="pat_id" value="<?php echo $pat_id; ?>">
    <input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">

   <h2 style="text-align: center; margin-bottom: 30px; color: #003366;">📝 Edit Doctor-Patient Assignment</h2> 

    <label>What do you want to change?</label>
    <select name="field_to_update">
        <option value="doctor">Change Doctor</option>
        <option value="patient">Change Patient</option>
    </select>

    <div id="doctor-selection">
        <label>Doctor Name:</label>
        <select name="new_doc_id">
            <option value="<?php echo $doc_id; ?>"><?php echo $doctor_name; ?> (Currently Assigned)</option>
            <?php
            // Fetch available doctors from the database
            $sql = "SELECT doc_id, name FROM Doctor";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['doc_id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>
    </div>

    <div id="patient-selection">
        <label>Patient Name:</label>
        <select name="new_pat_id">
            <option value="<?php echo $pat_id; ?>"><?php echo $patient_name; ?> (Currently Assigned)</option>
            <?php
            // Fetch available patients from the database
            $sql = "SELECT pat_id, Name FROM Patient";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['pat_id'] . "'>" . $row['Name'] . "</option>";
            }
            ?>
        </select>
    </div>

    <label>Assigned At:</label>
    <input type="text" name="assigned_at" value="<?php echo $assigned_at; ?>" readonly>

    <input type="submit" name="update" value="Update Assignment">
</form>

<script>
    document.querySelector('[name="field_to_update"]').addEventListener('change', function() {
        const fieldToUpdate = this.value;
        if (fieldToUpdate === 'doctor') {
            document.getElementById('doctor-selection').style.display = 'block';
            document.getElementById('patient-selection').style.display = 'none';
        } else {
            document.getElementById('doctor-selection').style.display = 'none';
            document.getElementById('patient-selection').style.display = 'block';
        }
    });
</script>

</body>
</html>
