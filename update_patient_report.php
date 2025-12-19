<?php
// Initialization
$showUpdateForm = false;
$patientId = "";
$submitted = false;
$existingCondition = "";
$existingTreatment = "";
$existingMedicines = "";
$existingAction = "";
$existingLabTest = 0; // new

// Database connection
include "connection.php";

// Step 1: Handle "Proceed" after selecting Patient ID
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['find_id'])) {
    $patientId = trim($_POST['pat_id']);
    if (!empty($patientId)) {
        $showUpdateForm = true;

        // Fetch existing report data
        $sql = "SELECT cnd_after, treatment_given, medicine_given, instructions, lab_test 
                FROM patient_report 
                WHERE pat_id = $patientId";

        $result = $conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            $existingCondition = $row['cnd_after'];
            $existingTreatment = $row['treatment_given'];
            $existingMedicines = $row['medicine_given'];
            $existingAction = $row['instructions'];
            $existingLabTest = $row['lab_test'];
        }
    }
}


// Step 2: Handle final report update form
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_report'])) {
    $patientId = $_POST['patient_id_hidden'];
    $condition = $_POST['cAfter'];
    $treatment = $_POST['tGiven'];
    $medicines = $_POST['medicine'];
    $followUp = $_POST['action'];
    $labTest = isset($_POST['lab_test']) ? 1 : 0;

    // Update patient report in database
    $sql = "
        UPDATE patient_report 
        SET 
            cnd_after = '$condition',
            treatment_given = '$treatment',
            medicine_given = '$medicines',
            instructions = '$followUp',
            lab_test = $labTest
        WHERE pat_id = $patientId
    ";

    if ($conn->query($sql)) {
        // Redirect after successful update
        header("Location: view_updated_reports.php?updated=1");
        exit;
    } else {
        echo "Error updating report: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Patient Report</title>
  <style>
    body {
      font-family: Arial;
      background-color: #eef3fc;
      display: flex;
      justify-content: center;
      padding: 40px;
      margin-top: 110px;
    }
    .form-box {
      background: white;
      padding: 25px;
      border-radius: 12px;
      width: 400px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h3 {
      margin-bottom: 20px;
      text-align: center;
    }
    label {
      font-weight: bold;
    }
    input, select, button {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    resize: none; /* prevents resizing of textarea */
}
textarea{
    width: 93%;
    padding: 10px;
    margin-top: 6px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    resize: none; /* prevents resizing of textarea */

}

    input[type="checkbox"] {
      width: auto;
      margin-top: 20px;
      margin-bottom: 0;
      transform: scale(1.2);
    }
    .checkbox-label {
      display: flex;
      align-items: center;
      gap: 10px;
      display: block;
      margin: 10px 0 20px 0;
    }
    button {
      background-color: #003366;
      color: white;
      cursor: pointer;
      font-weight: bold;
    }
    button:hover {
      background-color: #005599;
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


<div class="form-box">

<?php if ($submitted): ?>
  <!-- Step 3: Confirmation -->
  <h3>✅ Report Updated</h3>
  <p>Patient ID <strong><?= htmlspecialchars($patientId) ?></strong> has been successfully updated.</p>

<?php elseif (!$showUpdateForm): ?>
  <div class="navbar">
    <div class="logo">
        <span>MEDCARE</span>
    </div>
    <div class="menu">
        <a href="doc_dashboard.php">Dashboard</a>
        <a href="update_patient_report.php">Update Reports</a>
        <a href="view_updated_reports.php">View Reports</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>
  <h3>🔍 Select Patient to Update</h3>
  <form method="POST">
    <label>Select Patient ID:</label>
    <select name="pat_id" required>
      <option value="">-- Choose Patient --</option>
      <?php
      // Fetch only patients that exist in patient_report
      $query = mysqli_query($conn, "
          SELECT DISTINCT p.pat_id, p.Name 
          FROM Patient p 
          INNER JOIN patient_report r ON p.pat_id = r.pat_id
      ");
      while ($row = mysqli_fetch_assoc($query)) {
          echo "<option value='" . $row['pat_id'] . "'>" . $row['Name'] . " (ID: " . $row['pat_id'] . ")</option>";
      }
      ?>
    </select>
    <button type="submit" name="find_id">Proceed</button>
  </form>

<?php else: ?>
  <!-- Step 2: Show Update Form -->
  <h3>📝 Update Report for ID: <?= htmlspecialchars($patientId) ?></h3>
  <form method="POST">
    <input type="hidden" name="patient_id_hidden" value="<?= htmlspecialchars($patientId) ?>">

    <label>Medical Condition (After):</label>
    <textarea name="cAfter" required><?= htmlspecialchars($existingCondition) ?></textarea>

    <label>Treatment Given:</label>
    <textarea name="tGiven"><?= htmlspecialchars($existingTreatment) ?></textarea>

    <div class="checkbox-label">
      <label for="lab_test">Lab Test Required</label><br>
      <input type="checkbox" name="lab_test" id="lab_test" <?= $existingLabTest ? 'checked' : '' ?>>
    </div>

    <label>Medicines to Give:</label>
    <textarea name="medicine"><?= htmlspecialchars($existingMedicines) ?></textarea>

    <label>Follow-up Instruction:</label>
    <select name="action">
      <option value="">Choose an Option</option>
      <option value="Go home" <?= $existingAction === 'Go home' ? 'selected' : '' ?>>Go Home</option>
      <option value="Tranfer to ward" <?= $existingAction === 'Tranfer to ward' ? 'selected' : '' ?>>Transfer to Ward</option>
      <option value="Tranfer to ICU" <?= $existingAction === 'Tranfer to ICU' ? 'selected' : '' ?>>Transfer to ICU</option>
      <option value="Stay in Emergency" <?= $existingAction === 'Stay in Emergency' ? 'selected' : '' ?>>Stay in Emergency</option>
    </select>

    <button type="submit" name="update_report">Submit Updated Report</button>
  </form>
<?php endif; ?>

</div>
</body>
</html>
