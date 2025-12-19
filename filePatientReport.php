  <?php
            session_start();
            include "connection.php";

            if (!isset($_SESSION['doc_id'])) {
                echo "<script>alert('Access Denied. Please log in.'); window.location.href='login.html';</script>";
                exit;
            }

            $doc_id = $_SESSION['doc_id'];
            ?>
<!DOCTYPE html>
<html>
<head>
    <title>Filing Patient Report</title>
    <style>
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
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: auto;
            background-color: #e0eafc;
            padding: 50px;
            display: flex;
        }

        form {
            background-color: white;
            padding: 30px 50px;
            width: 700px;
            margin: auto;
            margin-top: 60px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #333;
        }

        input, textarea, select {
            width: 100%;
            padding: 7px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 18px;
            border: 1px solid lightgrey;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #003366;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
            position: relative;
            margin-right: 8px;
        }

        input[type="checkbox"]:checked {
            background-color: #003366;
            border-color: #003366;
        }

        input[type="checkbox"]:checked::after {
            content: '✔';
            color: white;
            font-size: 14px;
            position: absolute;
            left: 2px;
            top: -1px;
        }

        input[type="submit"] {
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
    </style>
</head>
<body>
     <div class="navbar">
    <div class="logo">
        <span>MEDCARE</span>
    </div>
    <div class="menu">
        <a href="doc_dashboard.php">Dashboard</a>
        <a href="filePatientReport.php">File Report</a>
        <a href="view_reports.php">View Reports</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>
    <form action="processFilePatientReport.php" method="POST">
        <h2 style="text-align: center; margin-bottom: 30px; color: #003366;">🩺 Filing Patient Report</h2>

      

            <!-- Hidden doctor ID -->
            <input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">

            <!-- Select patient -->
            <label>Select Patient:</label>
            <select name="pat_id" required>
                <option value="">-- Choose Patient --</option>
                <?php
                $query = mysqli_query($conn, "
                    SELECT DISTINCT p.pat_id, p.name 
                    FROM assigned_to a
                    INNER JOIN patient p ON a.pat_id = p.pat_id
                    WHERE a.doc_id = '$doc_id'
                    
                    UNION
                    
                    SELECT DISTINCT p.pat_id, p.name
                    FROM appointments ap
                    INNER JOIN patient p ON ap.pat_id = p.pat_id
                    WHERE ap.doc_id = '$doc_id'
                ");

                if ($query) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo '<option value="' . $row['pat_id'] . '">' . htmlspecialchars($row['name']) . ' (ID: ' . $row['pat_id'] . ')</option>';
                    }
                } else {
                    echo "<option disabled>Error fetching patients</option>";
                }
                ?>
            </select>


        <label>Medical Condition (Before):</label>
        <textarea name="cBefore" placeholder="Enter Condition (Before)"></textarea>

        <label>Medical Condition (After):</label>
        <textarea name="cAfter" placeholder="Enter Condition After"></textarea>

        <label>Treatment Given:</label>
        <textarea name="tGiven" placeholder="Enter Given Treatment"></textarea>

        <label>Lab Test Required</label>
        <input type="checkbox" name="lab_test" value="1">

        <label>Medicines to Give:</label>
        <textarea name="medicine" placeholder="Enter Medicines for Patient"></textarea>

        <label>Follow-up Instruction:</label>
        <select name="action" required>
            <option value="">Choose an Option</option>
            <option value="Go Home">Go Home</option>
            <option value="Transfer to ward">Transfer to Ward</option>
            <option value="Transfer to ICU">Transfer to ICU</option>
            <option value="Stay in Emergency">Stay in Emergency</option>
        </select>

        <input type="submit" name="submit" value="Submit Report">
    </form>

</body>
</html>
