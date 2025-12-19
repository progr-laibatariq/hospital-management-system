<?php
// Include the database connection
require 'connection.php';
require 'header.php';
// Fetch doctor details and phone numbers
$sql = "SELECT 
            doctor.doc_id, 
            doctor.name, 
            doctor.username, 
            doctor.gender, 
            doctor.specialization, 
            doctor.email, 
            doctor_ph_nmbr.ph_Nmbr
        FROM 
            doctor
        JOIN 
            doctor_ph_nmbr ON doctor.doc_id = doctor_ph_nmbr.doc_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

       

        .main {
            margin: 80px auto 0;
            padding: 20px;
            text-align: center;
            max-width: 1200px; /* Set a max width to keep the content centered */
        }

        h2 {
            color: #003366;
            margin-bottom: 40px;
        }

        /* Styling for doctor list */
        .doctor-table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
            margin: 0 auto; /* Center the table horizontally */
        }

        .doctor-table th, .doctor-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .doctor-table th {
            background-color: #1560BD;
            color: white;
        }

        .doctor-table tr:hover {
            background-color: ghostwhite;
        }

        .doctor-table td {
            color: #333;
        }

        /* Center table */
        .doctor-table {
            margin: 0 auto;
        }

        /* Footer Style (Optional if you want to include) */
      
    </style>
</head>
<body>

  

    <div class="main">
        <h2>Doctor List</h2>

        <table class="doctor-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Specialization</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if we have results
                if ($result->num_rows > 0) {
                    // Output data for each doctor
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>" . $row['gender'] . "</td>
                                <td>" . $row['specialization'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['ph_Nmbr'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No doctors found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Optional Footer -->
    <!-- <div class="footer">
        &copy; 2025 Global Hospital. All rights reserved.
    </div> -->

</body>
</html>
<?php require 'footer.php'; ?>
<?php
// Close the database connection
$conn->close();
?>
