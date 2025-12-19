<?php
// Include the database connection
require 'connection.php';
require 'header.php';

// Fetch patient details and phone numbers
$sql = "SELECT 
            patient.pat_id, 
            patient.Name, 
            patient.Age, 
            patient.Gender, 
            patient.Medical_Condition, 
            patient.SSN, 
            patient.Srs_Level, 
            patient.Police_Case, 
            patient_ph_nmbr.ph_Nmbr
        FROM 
            patient
        JOIN 
            patient_ph_nmbr ON patient.pat_id = patient_ph_nmbr.pat_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient List</title>
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
            margin-top: 0px;
            color: #003366;
            margin-bottom: 30px;
        }

        /* Styling for patient list */
        .patient-table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
            margin: 0 auto; /* Center the table horizontally */
        }

        .patient-table th, .patient-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .patient-table th {
           background-color: #1560BD;
            color: white;
        }

        .patient-table tr:hover {
            background-color: ghostwhite;
        }

        .patient-table td {
            color: #333;
        }

        /* Center table */
        .patient-table {
            margin: 0 auto;
        }

      
    </style>
</head>
<body>

    <div class="main">
        <h2>Patient List</h2>

        <table class="patient-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Medical Condition</th>
                    <th>SSN</th>
                    <th>Seriousness Level</th>
                    <th>Police Case</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if we have results
                if ($result->num_rows > 0) {
                    // Output data for each patient
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['Name'] . "</td>
                                <td>" . $row['Age'] . "</td>
                                <td>" . $row['Gender'] . "</td>
                                <td>" . $row['Medical_Condition'] . "</td>
                                <td>" . $row['SSN'] . "</td>
                                <td>" . $row['Srs_Level'] . "</td>
                                <td>" . ($row['Police_Case'] == 1 ? 'Yes' : 'No') . "</td>
                                <td>" . $row['ph_Nmbr'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align: center;'>No patients found</td></tr>";
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
