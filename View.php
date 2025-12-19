<?php 
include 'Connection.php';

$query = "
SELECT d.dis_id, d.revisit_date, b.bill_id, p.pat_id, p.name
FROM discharge_sheet d
LEFT JOIN bill b ON d.bill_id = b.bill_id
LEFT JOIN patient p ON b.pat_id = p.pat_id
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Discharge Sheets</title>
    <style>
        /* CSS Styling remains unchanged, as given previously */
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 50px;
            background-color: white;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 65px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        <a href="admin.php">Dashbaord</a>
        <a href="add_discharge.php">Add Discharge Sheet</a>
        <a href="View.php">View Discharge Sheets</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="container">
    <h2>All Discharge Sheets</h2>

    <table>
        <tr>
            <th>Discharge ID</th>
            <th>Patient Name</th>
            <th>Patient ID</th>
            <th>Bill ID</th>
            <th>Revisit Date</th>
            <th>Actions</th>
        </tr>
        <?php if(mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?=$row['dis_id']?></td>
                    <td><?=htmlspecialchars($row['name'] ?? 'N/A')  ?></td>
                    <td><?=$row['pat_id']?></td>
                    <td><?=$row['bill_id']?></td>
                    <td><?=$row['revisit_date']?></td>
                    <td>
                        <a href="delete.php?id=<?=$row['dis_id']?>" class="button button-delete" onclick="return confirm('Delete this bill?')">Delete</a>
                        

                    </td>
            </tr>
                
              <?php endwhile; ?>
              <?php endif; ?>        
    </table>
</div>

</body>
</html>

