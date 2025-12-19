<?php
// Include the database connection
require 'connection.php';

// Check if rep_id is passed in the URL
if (isset($_GET['rep_id'])) {
    $rep_id = $_GET['rep_id']; // Get the rep_id from the URL

    // Fetch the necessary columns for the report from the patient_report table
    $sql = "SELECT pr.rep_id, pr.pat_id, pr.doc_id, p.Medical_Condition 
            FROM patient_report pr
            INNER JOIN Patient p ON pr.pat_id = p.pat_id
            WHERE pr.rep_id = $rep_id"; 
    $result = $conn->query($sql);

    // Check if any record is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the row data

        // Start the form to edit the report
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Edit Report to Doctor</title>
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
                <span>MedCare</span>
            </div>
            <div class='menu'>
                <a href='admin.php' class='dashboard'>Dashboard</a>
                <a href='reporttodoc.php' class='add-report'>Add New Report</a>
                <a href='view_report_to_doc.php' class='manage-reports'>Manage Reports</a>
            </div>
            <a href='logout.php' class='logout'>Logout</a>
        </div>

        <!-- Edit Report Form -->
        <form action='update_report_to_doc.php' method='POST'  style='margin-top: 150px;'>    

            <h2 style='text-align: center;margin-bottom: 30px;color: #003366;'>📝 Edit Medical Condition</h2>

            <!-- Hidden input for rep_id -->
            <input type='hidden' name='rep_id' value='" . $row['rep_id'] . "'>

            <label>Medical Condition</label>
            <textarea name='medical_condition' placeholder='Edit Medical Condition'>" . $row['Medical_Condition'] . "</textarea><br>

            <input type='submit' name='submit' value='Update'>
        </form>

        </body>
        </html>";
    } else {
        echo "<h3>No report found with the given ID.</h3>";
    }
} else {
    echo "<h3>No report ID specified.</h3>";
}
?>
