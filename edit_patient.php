<?php  
require 'connection.php';

if (isset($_GET['pat_id'])) {
    $id = $_GET['pat_id'];

    $sql = "SELECT * FROM Patient WHERE pat_id = $id";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Update Patient</title>
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

                textarea {
                    width: 101%;
                    padding: 7px;
                    margin-bottom: 20px;
                    border-radius: 6px;
                    font-size: 18px;
                    border-color: lightgrey;
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

                textarea {
                    resize: vertical;
                    min-height: 50px;
                }

                input[type='submit'] {
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

                input[type='submit']:hover {
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

                /* Hover Effect (Underlining effect) */
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

                /* Same hover effect as menu links for logout */
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
                    margin-top: 80px;
                }
            </style>
        </head>
        <body>

        <!-- Navbar -->
        <div class='navbar'>
            <div class='logo'>
                <span>MEDCARE</span>
            </div>
            <div class='menu'>
                <a href='admin.php' class='dashboard'>Dashboard</a>
                <a href='adminregisterPat.php' class='add-new-patient'>Add New Patient</a>
                <a href='view_register_patient.php' class='manage-patients'>Manage Patients</a>
            </div>
            <a href='logout.php' class='logout'>Logout</a>
        </div>

        <form action='update_patient.php' method='POST' style='margin-top: 100px;'>
           
              <h2 style='text-align: center;margin-bottom: 30px;color: #003366;'>📝 Edit Patient</h2>

                <!-- Hidden input for pat_id -->
                <input type='hidden' name='id' value='" . $row['pat_id'] . "'>

                <label>Name</label>
                <input type='text' name='name' placeholder='Enter name' value='" . $row['Name'] . "' ><br><br>

                <label>Age</label>
                <input type='number' name='age' placeholder='Enter Age' value='" . $row['Age'] . "' ><br><br>

                <label>Gender</label>
                <select name='gender'>
                    <option value=''>Choose an Option</option>
                    <option value='male' " . ($row['Gender'] == 'male' ? 'selected' : '') . ">Male</option>
                    <option value='female' " . ($row['Gender'] == 'female' ? 'selected' : '') . ">Female</option>
                </select><br><br>

                <input type='submit' name='submit' value='Update'>
       
        </form>

        </body>
        </html>
        ";
    }
}
?>
