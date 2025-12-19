<?php
// Include the database connection
require 'connection.php';

// Check if the form is submitted
if (isset($_POST['send'])) {
    // Retrieve the form data
    $doc_id = isset($_POST['doc_id']) ? $_POST['doc_id'] : '';
    $pat_id = isset($_POST['pat_id']) ? $_POST['pat_id'] : '';

    // Debugging: Output the values of doc_id and pat_id to check if they are correctly set
    echo "Doctor ID: $doc_id <br>";
    echo "Patient ID: $pat_id <br>";

    // Check if both doctor and patient are selected
    if (empty($doc_id) || empty($pat_id)) {
        echo "<h2 style='color:red; text-align:center;'>❌ Please select both a doctor and a patient.</h2>";
    } else {
        // Step 1: Check if the combination of doctor and patient already exists
        $check_sql = "SELECT * FROM assigned_to WHERE doc_id = '$doc_id' AND pat_id = '$pat_id'";
        $check_result = $conn->query($check_sql);

        // If the combination already exists, display an error message
        if ($check_result->num_rows > 0) {
            echo "<h2 style='color:red; text-align:center;'>❌ This doctor is already assigned to this patient.</h2>";
        } else {
            // Step 2: Insert the doctor-patient assignment into the 'Assigned_To' table
            $sql = "INSERT INTO assigned_to (pat_id, doc_id) VALUES ('$pat_id', '$doc_id')";

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                // Success message
                echo "<h2 style='color:green; text-align:center;'>✔️ Doctor assigned successfully!</h2>";
                // Optionally, redirect to another page, like the admin dashboard
                header("Location: view_assign_doc_to_pat.php");
                exit(); // Stop further script execution after the header redirect
            } else {
                // Error message
                echo "<h2 style='color:red; text-align:center;'>❌ Failed to assign doctor to patient: " . $conn->error . "</h2>";
            }
        }
    }
} else {
    // If the form wasn't submitted correctly
    echo "<h2 style='color:red; text-align:center;'>❌ Invalid form submission.</h2>";
}
?>
