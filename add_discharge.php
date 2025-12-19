<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Discharge</title>
    <style>
        /* Styling for body and form */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f7fc;
            padding: 30px;
        }

        form {
            background-color: white;
            padding: 40px;
            width: 500px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #003366;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 16px;
            border: 1px solid lightgray;
        }

        input[type="submit"] {
            background-color: #003366;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0059b3;
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
        <span>MEDCARE</span>
    </div>
    <div class="menu">
        <a href="admin.php">Dashboard</a>
        <a href="add_discharge.php">Add Discharge Sheet</a>
        <a href="View.php">View Discharge Sheets</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
    </div>

<!-- Form to Add Discharge Sheet -->
<form action="Discharge_details.php" method="POST" style="margin-top: 100px;">
    <h1>Discharge Sheet</h1>

    <!-- Patient and Bill Dropdown -->
    <label for="pat_id">Patient and Bill:</label>
    <select name="pat_id" id="pat_id" required>
        <option value="">Select Patient and Bill</option>
        <?php 
            require 'connection.php'; // your connection file
            $sql = "SELECT b.bill_id, p.pat_id, p.Name FROM bill b 
                    JOIN patient p ON b.pat_id = p.pat_id";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['pat_id'] . "'>" . $row['bill_id'] . " ------- " . $row['Name'] . "</option>";
            }
        ?>
    </select><br><br>

    <!-- Revisit Date -->
    <label for="revisit_date">Revisit Date:</label>
    <input type="date" name="revisit_date" required><br><br>

    <!-- Submit Button -->
    <input type="submit" value="Add Discharge Sheet" name="submit">
</form>

</body>
</html>
