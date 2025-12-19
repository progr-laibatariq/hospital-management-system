<?php
// Include the database connection
require 'connection.php';

// Fetch all assignments (doctor-patient pairs)
$sql = "SELECT at.pat_id, at.doc_id, p.Name AS patient_name, d.name AS doctor_name, at.assigned_at
        FROM assigned_to at
        JOIN Patient p ON at.pat_id = p.pat_id
        JOIN Doctor d ON at.doc_id = d.doc_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assignments</title>
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
            justify-content: center; /* Centering menu items */
            width: 100%; /* Ensure it takes the full width */
            text-align: center; /* Align text to the center */
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
            right: 60px; /* Adjust the position of the logout button to the left */
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
        <a href="assign_doc_to_pat.php" class="assign-doc">Assign New Doctor to Patient</a>
        <a href="view_assign_doc_to_pat.php" class="manage-assignments">Manage Assignments</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<h1>Assigned Doctors to Patients</h1>   

<div class="container">

<?php
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Assignment ID</th>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Doctor ID</th>
                <th>Doctor Name</th>
                <th>Assigned At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        // Generate a combined assignment ID (virtual)
        $assignment_id = "PAT" . $row['pat_id'] . "-DOC" . $row['doc_id'];

        echo "<tr>
                <td>" . $assignment_id . "</td>
                <td>" . $row['pat_id'] . "</td>
                <td>" . $row['patient_name'] . "</td>
                <td>" . $row['doc_id'] . "</td>
                <td>" . $row['doctor_name'] . "</td>
                <td>" . $row['assigned_at'] . "</td>
                <td>
                    <a href='edit_assign_doc_to_pat.php?pat_id=" . $row['pat_id'] . "&doc_id=" . $row['doc_id'] . "' class='button button-edit'>Edit</a>
                </td>
                <td>
                    <a href='delete_assign_doc_to_pat.php?pat_id=" . $row['pat_id'] . "&doc_id=" . $row['doc_id'] . "' class='button button-delete'>Delete</a>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "<div class='no-records'>❌ No Assignments Found</div>";
}
?>

</div>

</body>
</html>
