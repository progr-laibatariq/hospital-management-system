<?php
// Include the database connection
require 'connection.php';

if (isset($_POST['submit'])) {

    // Retrieve form data
    $name = $_POST['name'];
    $ssn = $_POST['ssn'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $condition = $_POST['condition'];
    $s_level = $_POST['level'];
    $p_case = $_POST['police'];

    // ✅ Correct police case conversion
    if ($p_case === 'yes') {
        $p_case = 1;
    } else {
        $p_case = 0;
    }
    $sql_patient = "INSERT INTO Patient (Name, SSN, Age, Gender, Medical_Condition, Srs_Level, Police_Case) 
                    VALUES ('$name', '$ssn', '$age', '$gender', '$condition', '$s_level', '$p_case')";

    if ($conn->query($sql_patient) === TRUE) {
        $pat_id = $conn->insert_id;
        $sql_ph = "INSERT INTO patient_ph_nmbr (pat_id, ph_Nmbr) VALUES ('$pat_id', '$mobile')";
        if ($conn->query($sql_ph) !== TRUE) {
            echo "<h3><center>⚠️ Phone number insertion failed: " . $conn->error . "</center></h3>";
        }

        header("Location: view_register_patient.php?pat_id=" . $pat_id);
        exit();
    } else {
        echo "<h2><center>❌ Patient Registration Failed! Error: " . $conn->error . "</center></h2>";
    }
}
?>