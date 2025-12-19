<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Bill</title>
    <style>
        /* Global Styling */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f7fc;  /* Light background color */
            padding: 30px;
            color: #333;  /* Dark text for better contrast */
        }

        h1 {
            text-align: center;
            color: #003366;  /* Dark blue for headings */
            margin-bottom: 50px;
        }

        /* Form Styling */
        form {
            background-color: white;
            padding: 40px;
            width: 500px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
            color: #003366;  /* Dark blue for labels */
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 16px;
            border: 1px solid #ddd;  /* Light border color */
            transition: all 0.3s ease;
        }

        /* Input and Select Focus Styling */
        input:focus, select:focus {
            border-color: #0059b3;  /* Blue border when focused */
            outline: none;
        }

        /* Submit Button Styling */
        input[type="submit"] {
            background-color: #003366;  /* Primary blue for the button */
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0059b3;  /* Darker blue on hover */
        }

        /* Navbar Styling */
        .navbar {
            background-color: #003366;  /* Primary blue for navbar */
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
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <span>MEDCARE</span>
        </div>
        <div class="menu">
            <a href="admin.php">Dashbaord</a>
            <a href="billform.php">Generate Bill</a>
            <a href="view_bills.php">View Bills</a>
        </div>
        <a href="logout.php" class="logout">Logout</a>
    </nav>

    

    <form method="POST" action="bill_details.php" style="margin-top: 100px;">
        <h1>Patient Bill Details</h1>
        <label>Patient Name: </label> 
        <select name="pat_id"> 
            <option value="">Select Patient</option>
            <?php 
                require 'connection.php';
                $sql = "SELECT pat_id, Name FROM Patient";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo " <option value = '".$row['pat_id']."'>". $row['pat_id'] . " ------- " . $row['Name'] . "</option>";
                }
            ?>
        </select><br><br>

        <label for="room_charge">Room Charges per Day:</label>
        <input type="text" id="room_charge" name="room_charges" required>

        <label for="days_stay">Number of Days Stayed:</label>
        <input type="text" id="days_stay" name="stayed_days" required>

        <label for="ward_charge">Ward Charges:</label>
        <input type="text" id="ward_charge" name="ward_charges" required>

        <label for="doc_fee">Doctor Fee:</label>
        <input type="text" id="doc_fee" name="doc_fee" required>

        <label for="surgeon_fee">Surgeon Fee:</label>
        <input type="text" id="surgeon_fee" name="surgeon_fee" required>

        <label for="icu_fee">ICU Fee:</label>
        <input type="text" id="icu_fee" name="icu_fee" required>

        <label for="medicine_fee">Medicine Fee:</label>
        <input type="text" id="medicine_fee" name="medicine_fee" required>

        <label for="lab_fee">Lab Fee:</label>
        <input type="text" id="lab_fee" name="lab_fee" required>

        <label for="food_charges">Food Charges:</label>
        <input type="text" id="food_charges" name="food_charges" required>

        <label for="theatre_fee">Theatre Fee:</label>
        <input type="text" id="theatre_fee" name="theatre_fee" required>

        <input type="submit" name="submit" value="Calculate Bill">
    </form>
</body>
</html>
